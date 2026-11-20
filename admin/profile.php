<?php
require_once __DIR__ . '/cms_helpers.php';

$adminId = (int) $_SESSION['admin_id'];
$accountQuery = $conn->prepare('SELECT username, email, full_name, password_hash FROM admins WHERE id = ? AND is_active = 1 LIMIT 1');
$accountQuery->bind_param('i', $adminId);
$accountQuery->execute();
$account = $accountQuery->get_result()->fetch_assoc();
if (!$account) {
    session_destroy();
    header('Location: ./login.php');
    exit;
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        adminRequirePost();
        $action = $_POST['action'] ?? '';
        $username = trim(is_string($_POST['username'] ?? null) ? $_POST['username'] : '');
        $email = trim(is_string($_POST['email'] ?? null) ? $_POST['email'] : '');
        $fullName = trim(is_string($_POST['full_name'] ?? null) ? $_POST['full_name'] : '');
        if ($action === 'profile') {
            if ($username === '' || strlen($username) > 50 || !preg_match('/\A[a-zA-Z0-9._-]+\z/', $username)) {
                throw new RuntimeException('Username must use letters, numbers, dots, underscores, or hyphens.');
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($email) > 100) {
                throw new RuntimeException('Enter a valid email address.');
            }
            if ($fullName === '' || strlen($fullName) > 100) {
                throw new RuntimeException('Name is required and must be at most 100 characters.');
            }
            $update = $conn->prepare('UPDATE admins SET username = ?, email = ?, full_name = ? WHERE id = ?');
            $update->bind_param('sssi', $username, $email, $fullName, $adminId);
            $update->execute();
            $_SESSION['admin_username'] = $username;
            $_SESSION['admin_name'] = $fullName;
            adminFlash('success', 'Account details updated.');
        } elseif ($action === 'password') {
            $currentPassword = is_string($_POST['current_password'] ?? null) ? $_POST['current_password'] : '';
            $newPassword = is_string($_POST['new_password'] ?? null) ? $_POST['new_password'] : '';
            $confirmPassword = is_string($_POST['confirm_password'] ?? null) ? $_POST['confirm_password'] : '';
            if (!password_verify($currentPassword, $account['password_hash'])) {
                throw new RuntimeException('Your current password is incorrect.');
            }
            if (strlen($newPassword) < 12 || strlen($newPassword) > 72) {
                throw new RuntimeException('Choose a password between 12 and 72 characters.');
            }
            if (!hash_equals($newPassword, $confirmPassword)) {
                throw new RuntimeException('The new passwords do not match.');
            }
            $hash = password_hash($newPassword, PASSWORD_DEFAULT);
            $update = $conn->prepare('UPDATE admins SET password_hash = ? WHERE id = ?');
            $update->bind_param('si', $hash, $adminId);
            $update->execute();
            session_regenerate_id(true);
            adminFlash('success', 'Password updated.');
        } else {
            throw new RuntimeException('Choose a valid account action.');
        }

        header('Location: ./profile.php');
        exit;
    } catch (mysqli_sql_exception $exception) {
        $error = 'That username or email address is already in use.';
    } catch (RuntimeException $exception) {
        $error = $exception->getMessage();
        $account['username'] = $username;
        $account['email'] = $email;
        $account['full_name'] = $fullName;
    } catch (Throwable $exception) {
        error_log('Admin profile update failed: ' . $exception->getMessage());
        $error = 'Unable to update your account right now.';
    }
}

adminPageStart('Account profile', 'profile.php', 'Manage your admin identity and sign-in security.');
adminPageHeading('Account profile', 'Update your admin contact information and password.');
adminShowFlash();
if ($error !== ''): ?><div class="admin-alert error" role="alert"><?= adminEscape($error); ?></div><?php endif; ?>
<div class="admin-grid two">
    <section class="admin-card">
        <h2 class="admin-card-title">Profile details</h2>
        <form method="POST">
            <?php adminCsrfField(); ?><input type="hidden" name="action" value="profile">
            <div class="admin-field"><label for="full-name">Full name</label><input id="full-name" name="full_name" value="<?= adminEscape($account['full_name']); ?>" maxlength="100" required></div>
            <div class="admin-field" style="margin-top:16px"><label for="username">Username</label><input id="username" name="username" value="<?= adminEscape($account['username']); ?>" maxlength="50" autocomplete="username" required></div>
            <div class="admin-field" style="margin-top:16px"><label for="email">Recovery email</label><input id="email" type="email" name="email" value="<?= adminEscape($account['email']); ?>" maxlength="100" autocomplete="email" required><small class="admin-help">Password reset links are sent to this address.</small></div>
            <div class="admin-form-actions"><button class="admin-btn" type="submit"><i class="fa-solid fa-floppy-disk"></i> Save profile</button></div>
        </form>
    </section>
    <section class="admin-card">
        <h2 class="admin-card-title">Change password</h2>
        <form method="POST">
            <?php adminCsrfField(); ?><input type="hidden" name="action" value="password">
            <div class="admin-field"><label for="current-password">Current password</label><input id="current-password" type="password" name="current_password" autocomplete="current-password" required></div>
            <div class="admin-field" style="margin-top:16px"><label for="new-password">New password</label><input id="new-password" type="password" name="new_password" minlength="12" maxlength="72" autocomplete="new-password" required><small class="admin-help">Use at least 12 characters.</small></div>
            <div class="admin-field" style="margin-top:16px"><label for="confirm-password">Confirm new password</label><input id="confirm-password" type="password" name="confirm_password" minlength="12" maxlength="72" autocomplete="new-password" required></div>
            <div class="admin-form-actions"><button class="admin-btn" type="submit"><i class="fa-solid fa-key"></i> Update password</button></div>
        </form>
    </section>
</div>
<?php adminPageEnd(); ?>
