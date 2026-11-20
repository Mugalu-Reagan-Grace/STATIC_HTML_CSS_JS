<?php
require_once __DIR__ . '/cms_helpers.php';
require_once __DIR__ . '/mailer.php';

adminRequireRole('admin');

$actorId = (int) $_SESSION['admin_id'];
$error = '';
$formData = [
    'full_name' => '',
    'username' => '',
    'email' => '',
    'role' => 'editor',
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        adminRequirePost();
        $action = $_POST['action'] ?? '';
        $targetId = filter_var($_POST['id'] ?? null, FILTER_VALIDATE_INT);

        if ($action === 'update-role') {
            if (!$targetId || $targetId < 1 || $targetId === $actorId) {
                throw new RuntimeException('Choose another active account to change.');
            }
            $role = $_POST['role'] ?? '';
            if (!in_array($role, ['admin', 'editor'], true)) {
                throw new RuntimeException('Choose a valid CMS account role.');
            }
            $update = $conn->prepare('UPDATE admins SET role = ? WHERE id = ? AND is_active = 1');
            $update->bind_param('si', $role, $targetId);
            $update->execute();
            if ($update->affected_rows !== 1) {
                throw new RuntimeException('The account is not active or no longer exists.');
            }
            adminFlash('success', 'CMS account role updated.');
            header('Location: ./accounts.php');
            exit;
        }

        if ($action === 'deactivate' || $action === 'reactivate') {
            if (!$targetId || $targetId < 1 || $targetId === $actorId) {
                throw new RuntimeException('You cannot deactivate or reactivate your own account.');
            }
            $isActive = $action === 'reactivate' ? 1 : 0;
            $update = $conn->prepare('UPDATE admins SET is_active = ? WHERE id = ?');
            $update->bind_param('ii', $isActive, $targetId);
            $update->execute();
            if ($update->affected_rows !== 1) {
                throw new RuntimeException('The account status could not be changed.');
            }
            if (!$isActive) {
                $remove = $conn->prepare('DELETE FROM admin_account_invites WHERE admin_id = ?');
                $remove->bind_param('i', $targetId);
                $remove->execute();
            }
            adminFlash('success', $isActive ? 'CMS account reactivated.' : 'CMS account deactivated.');
            header('Location: ./accounts.php');
            exit;
        }

        if ($action === 'revoke') {
            if (!$targetId || $targetId < 1 || $targetId === $actorId) {
                throw new RuntimeException('Choose a valid pending account.');
            }

            $delete = $conn->prepare('DELETE FROM admins WHERE id = ? AND is_active = 0');
            $delete->bind_param('i', $targetId);
            $delete->execute();
            if ($delete->affected_rows !== 1) {
                throw new RuntimeException('That account is active or no longer exists.');
            }

            adminFlash('success', 'Pending invitation revoked.');
            header('Location: ./accounts.php');
            exit;
        }

        if ($action === 'invite' || $action === 'resend') {
            if ($action === 'invite') {
                foreach (array_keys($formData) as $field) {
                    $value = $_POST[$field] ?? '';
                    $formData[$field] = is_string($value) ? trim($value) : '';
                }

                if ($formData['full_name'] === '' || strlen($formData['full_name']) > 100) {
                    throw new RuntimeException('Enter a name of at most 100 characters.');
                }
                if (
                    $formData['username'] === '' ||
                    strlen($formData['username']) > 50 ||
                    !preg_match('/\A[a-zA-Z0-9._-]+\z/', $formData['username'])
                ) {
                    throw new RuntimeException('Username must use letters, numbers, dots, underscores, or hyphens.');
                }
                if (
                    strlen($formData['email']) > 100 ||
                    !filter_var($formData['email'], FILTER_VALIDATE_EMAIL)
                ) {
                    throw new RuntimeException('Enter a valid email address.');
                }
                if (!in_array($formData['role'], ['admin', 'editor'], true)) {
                    throw new RuntimeException('Choose a valid CMS account role.');
                }

                $invitedAdminId = 0;
                $token = bin2hex(random_bytes(32));
                $tokenHash = hash('sha256', $token);
                $placeholderPassword = bin2hex(random_bytes(36));
                $placeholderHash = password_hash($placeholderPassword, PASSWORD_DEFAULT);

                $conn->begin_transaction();
                try {
                    $insert = $conn->prepare('INSERT INTO admins (username, email, password_hash, full_name, role, is_active) VALUES (?, ?, ?, ?, ?, 0)');
                    $insert->bind_param(
                        'sssss',
                        $formData['username'],
                        $formData['email'],
                        $placeholderHash,
                        $formData['full_name'],
                        $formData['role']
                    );
                    $insert->execute();
                    $invitedAdminId = (int) $conn->insert_id;

                    $invite = $conn->prepare('INSERT INTO admin_account_invites (admin_id, token_hash, invited_by, expires_at) VALUES (?, ?, ?, DATE_ADD(NOW(), INTERVAL 48 HOUR))');
                    $invite->bind_param('isi', $invitedAdminId, $tokenHash, $actorId);
                    $invite->execute();
                    $conn->commit();
                } catch (Throwable $exception) {
                    $conn->rollback();
                    throw $exception;
                }
            } else {
                if (!$targetId || $targetId < 1 || $targetId === $actorId) {
                    throw new RuntimeException('Choose a valid pending account.');
                }

                $token = bin2hex(random_bytes(32));
                $tokenHash = hash('sha256', $token);
                $conn->begin_transaction();
                try {
                    $find = $conn->prepare('SELECT id, username, email, full_name, role FROM admins WHERE id = ? AND is_active = 0 LIMIT 1 FOR UPDATE');
                    $find->bind_param('i', $targetId);
                    $find->execute();
                    $pendingAccount = $find->get_result()->fetch_assoc();
                    if (!$pendingAccount) {
                        throw new RuntimeException('That pending account no longer exists.');
                    }

                    $invitedAdminId = (int) $pendingAccount['id'];
                    $invite = $conn->prepare('INSERT INTO admin_account_invites (admin_id, token_hash, invited_by, expires_at) VALUES (?, ?, ?, DATE_ADD(NOW(), INTERVAL 48 HOUR)) ON DUPLICATE KEY UPDATE token_hash = VALUES(token_hash), invited_by = VALUES(invited_by), created_at = NOW(), expires_at = VALUES(expires_at)');
                    $invite->bind_param('isi', $invitedAdminId, $tokenHash, $actorId);
                    $invite->execute();
                    $conn->commit();
                } catch (Throwable $exception) {
                    $conn->rollback();
                    throw $exception;
                }
            }

            $inviteUrl = APP_URL . '/admin/accept-invite.php?token=' . rawurlencode($token);
            $inviteeName = $action === 'invite' ? $formData['full_name'] : $pendingAccount['full_name'];
            $inviteeUsername = $action === 'invite' ? $formData['username'] : $pendingAccount['username'];
            $roleLabel = ($action === 'invite' ? $formData['role'] : $pendingAccount['role']) === 'admin'
                ? 'CMS administrator'
                : 'CMS content editor';
            $safeName = htmlspecialchars($inviteeName, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
            $safeUsername = htmlspecialchars($inviteeUsername, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
            $safeRole = htmlspecialchars($roleLabel, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
            $safeUrl = htmlspecialchars($inviteUrl, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
            $recipient = $action === 'invite' ? $formData['email'] : $pendingAccount['email'];
            $subject = 'Invitation to Calyst Christian School CMS';
            $html = '<p>Hello ' . $safeName . ',</p><p>An administrator invited you to access the Calyst Christian School CMS as a ' . $safeRole . '.</p><p>Your username is <strong>' . $safeUsername . '</strong>. Use the secure link below within 48 hours to verify your email and set your password:</p><p><a href="' . $safeUrl . '">Accept CMS invitation</a></p><p>If you were not expecting this invitation, contact the school administrator and ignore this email.</p>';
            $text = "Hello {$inviteeName},\n\nAn administrator invited you to access the Calyst Christian School CMS as a {$roleLabel}.\nYour username is {$inviteeUsername}.\n\nUse this secure link within 48 hours to verify your email and set your password:\n{$inviteUrl}\n\nIf you were not expecting this invitation, contact the school administrator and ignore this email.";

            try {
                sendAdminEmail($recipient, $subject, $html, $text);
            } catch (RuntimeException $exception) {
                error_log('CMS account invitation email failed: ' . $exception->getMessage());
                if ($action === 'invite') {
                    try {
                        $conn->begin_transaction();
                        $remove = $conn->prepare('DELETE FROM admins WHERE id = ? AND is_active = 0');
                        $remove->bind_param('i', $invitedAdminId);
                        $remove->execute();
                        $conn->commit();
                    } catch (Throwable $cleanupException) {
                        $conn->rollback();
                        error_log('CMS pending account cleanup failed: ' . $cleanupException->getMessage());
                    }
                }
                throw new RuntimeException('The invitation email could not be sent. Check email settings and retry from CMS accounts.');
            }

            adminFlash('success', $action === 'invite' ? 'Invitation sent. The account will activate after email verification.' : 'Invitation email sent again.');
            header('Location: ./accounts.php');
            exit;
        }

        throw new RuntimeException('Choose a valid account action.');
    } catch (mysqli_sql_exception $exception) {
        if ((int) $exception->getCode() === 1062) {
            $error = 'That username or email address is already in use.';
        } else {
            error_log('CMS account update failed: ' . $exception->getMessage());
            $error = 'Unable to update CMS accounts right now.';
        }
    } catch (RuntimeException $exception) {
        $error = $exception->getMessage();
    } catch (Throwable $exception) {
        error_log('CMS account update failed: ' . $exception->getMessage());
        $error = 'Unable to update CMS accounts right now.';
    }
}

$accounts = $conn->query('SELECT admins.id, admins.full_name, admins.username, admins.email, admins.role, admins.is_active, admins.created_at, admins.last_login, admin_account_invites.expires_at, (admin_account_invites.expires_at > NOW()) AS invite_is_valid FROM admins LEFT JOIN admin_account_invites ON admin_account_invites.admin_id = admins.id ORDER BY admins.is_active DESC, admins.created_at ASC')->fetch_all(MYSQLI_ASSOC);

adminPageStart('CMS accounts', 'accounts.php', 'Invite and manage people who can sign in to the school CMS.');
adminPageHeading('CMS accounts', 'Only an existing administrator can invite accounts. Invitees verify their email before they can sign in.');
adminShowFlash();
if ($error !== ''): ?><div class="admin-alert error" role="alert"><?= adminEscape($error); ?></div><?php endif; ?>

<section class="admin-card" id="invite">
    <h2 class="admin-card-title">Create CMS account</h2>
    <p class="admin-account-note">The invitation expires in 48 hours. The recipient chooses their password after opening the link from their email.</p>
    <form method="POST" class="admin-account-invite-form">
        <?php adminCsrfField(); ?>
        <input type="hidden" name="action" value="invite">
        <div class="admin-form-grid">
            <div class="admin-field">
                <label for="full-name">Full name *</label>
                <input id="full-name" name="full_name" value="<?= adminEscape($formData['full_name']); ?>" maxlength="100" autocomplete="name" required>
            </div>
            <div class="admin-field">
                <label for="username">Username *</label>
                <input id="username" name="username" value="<?= adminEscape($formData['username']); ?>" maxlength="50" pattern="[a-zA-Z0-9._-]+" autocomplete="username" required>
                <small class="admin-help">Use letters, numbers, dots, underscores, or hyphens.</small>
            </div>
            <div class="admin-field">
                <label for="email">Email address *</label>
                <input id="email" type="email" name="email" value="<?= adminEscape($formData['email']); ?>" maxlength="100" autocomplete="email" required>
            </div>
            <div class="admin-field">
                <label for="role">CMS role</label>
                <select id="role" name="role" required>
                    <option value="editor" <?= $formData['role'] === 'editor' ? 'selected' : ''; ?>>Content editor</option>
                    <option value="admin" <?= $formData['role'] === 'admin' ? 'selected' : ''; ?>>Administrator</option>
                </select>
                <small class="admin-help">Only administrators can invite or revoke CMS accounts.</small>
            </div>
        </div>
        <div class="admin-form-actions">
            <button class="admin-btn" type="submit"><i class="fa-solid fa-paper-plane"></i> Send invitation</button>
        </div>
    </form>
</section>

<section class="admin-card admin-account-list">
    <div class="admin-toolbar">
        <h2 class="admin-card-title" style="margin:0">Accounts <span class="admin-badge"><?= count($accounts); ?></span></h2>
    </div>
    <?php if (!$accounts): ?>
        <div class="admin-empty" role="status"><i class="fa-regular fa-user"></i><strong>No CMS accounts</strong><p>Invite a colleague using the form above.</p></div>
    <?php else: ?>
        <div class="admin-table-wrap">
            <table class="admin-table">
                <thead><tr><th>Name</th><th>Username</th><th>Role</th><th>Status</th><th>Last sign in</th><th>Actions</th></tr></thead>
                <tbody>
                <?php foreach ($accounts as $account): ?>
                    <?php
                    $active = (int) $account['is_active'] === 1;
                    $hasInvitation = $account['expires_at'] !== null;
                    $inviteIsValid = (int) $account['invite_is_valid'] === 1;
                    $statusLabel = $active
                        ? 'Active'
                        : ($hasInvitation ? ($inviteIsValid ? 'Invitation pending' : 'Invitation expired') : 'Inactive');
                    ?>
                    <tr>
                        <td><strong><?= adminEscape($account['full_name']); ?></strong><br><span class="admin-muted"><?= adminEscape($account['email']); ?></span></td>
                        <td><?= adminEscape($account['username']); ?></td>
                        <td><?= $account['role'] === 'admin' ? 'Administrator' : 'Content editor'; ?></td>
                        <td><span class="admin-badge <?= $active ? 'success' : ($hasInvitation && !$inviteIsValid ? 'danger' : 'warning'); ?>"><?= adminEscape($statusLabel); ?></span></td>
                        <td><?= $account['last_login'] ? adminEscape(date('M j, Y', strtotime($account['last_login']))) : 'Never'; ?></td>
                        <td>
                            <?php if ($active && (int) $account['id'] !== $actorId): ?>
                                <div class="admin-actions">
                                    <form method="POST" class="admin-inline-form">
                                        <?php adminCsrfField(); ?>
                                        <input type="hidden" name="action" value="update-role">
                                        <input type="hidden" name="id" value="<?= (int) $account['id']; ?>">
                                        <select name="role" aria-label="CMS role for <?= adminEscape($account['full_name']); ?>" onchange="this.form.submit()" style="min-height:31px;border:1px solid var(--admin-line);border-radius:8px;padding:5px 8px">
                                            <option value="editor" <?= $account['role'] === 'editor' ? 'selected' : ''; ?>>Editor</option>
                                            <option value="admin" <?= $account['role'] === 'admin' ? 'selected' : ''; ?>>Administrator</option>
                                        </select>
                                    </form>
                                    <form method="POST" class="admin-inline-form" onsubmit="return confirm('Deactivate this CMS account? They will immediately lose access.');">
                                        <?php adminCsrfField(); ?>
                                        <input type="hidden" name="action" value="deactivate">
                                        <input type="hidden" name="id" value="<?= (int) $account['id']; ?>">
                                        <button class="admin-btn danger small" type="submit">Deactivate</button>
                                    </form>
                                </div>
                            <?php elseif (!$active && $hasInvitation && (int) $account['id'] !== $actorId): ?>
                                <div class="admin-actions">
                                    <form method="POST" class="admin-inline-form">
                                        <?php adminCsrfField(); ?>
                                        <input type="hidden" name="action" value="resend">
                                        <input type="hidden" name="id" value="<?= (int) $account['id']; ?>">
                                        <button class="admin-btn secondary small" type="submit"><i class="fa-solid fa-paper-plane"></i> <?= $hasInvitation ? 'Resend invite' : 'Send invite'; ?></button>
                                    </form>
                                    <form method="POST" class="admin-inline-form" onsubmit="return confirm('Revoke this pending CMS account?');">
                                        <?php adminCsrfField(); ?>
                                        <input type="hidden" name="action" value="revoke">
                                        <input type="hidden" name="id" value="<?= (int) $account['id']; ?>">
                                        <button class="admin-btn danger small" type="submit">Revoke</button>
                                    </form>
                                </div>
                            <?php elseif (!$active && !$hasInvitation && (int) $account['id'] !== $actorId): ?>
                                <form method="POST" class="admin-inline-form" onsubmit="return confirm('Reactivate this CMS account?');">
                                    <?php adminCsrfField(); ?>
                                    <input type="hidden" name="action" value="reactivate">
                                    <input type="hidden" name="id" value="<?= (int) $account['id']; ?>">
                                    <button class="admin-btn secondary small" type="submit">Reactivate</button>
                                </form>
                            <?php elseif ((int) $account['id'] === $actorId): ?>
                                <span class="admin-muted">You</span>
                            <?php else: ?>
                                <span class="admin-muted">—</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</section>
<?php adminPageEnd(); ?>
