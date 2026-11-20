<?php
require_once __DIR__ . '/config.php';

header('Cache-Control: no-store, private');
header('Referrer-Policy: no-referrer');
header('X-Robots-Tag: noindex, nofollow');

$error = '';
$tokenInput = $_SERVER['REQUEST_METHOD'] === 'POST'
    ? ($_POST['token'] ?? '')
    : ($_GET['token'] ?? '');
$token = is_string($tokenInput) ? trim($tokenInput) : '';
$tokenHash = preg_match('/\A[a-f0-9]{64}\z/i', $token) ? hash('sha256', $token) : '';
$adminId = null;

if ($tokenHash !== '') {
    $lookup = $conn->prepare('SELECT admins.id FROM admin_account_invites JOIN admins ON admins.id = admin_account_invites.admin_id WHERE admin_account_invites.token_hash = ? AND admin_account_invites.expires_at > NOW() AND admins.is_active = 0 LIMIT 1');
    $lookup->bind_param('s', $tokenHash);
    $lookup->execute();
    $invite = $lookup->get_result()->fetch_assoc();
    $adminId = $invite ? (int) $invite['id'] : null;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isValidCsrfToken($_POST['csrf_token'] ?? null)) {
        http_response_code(400);
        $error = 'Your session expired. Refresh the page and try again.';
    } elseif ($adminId === null) {
        $error = 'This invitation is invalid or expired. Ask the administrator who invited you to send another.';
    } else {
        $passwordInput = $_POST['password'] ?? '';
        $confirmationInput = $_POST['password_confirmation'] ?? '';
        $password = is_string($passwordInput) ? $passwordInput : '';
        $confirmation = is_string($confirmationInput) ? $confirmationInput : '';

        if (!is_string($passwordInput) || strlen($password) < 12 || strlen($password) > 72) {
            $error = 'Choose a password between 12 and 72 characters.';
        } elseif (!is_string($confirmationInput) || !hash_equals($password, $confirmation)) {
            $error = 'The password confirmation does not match.';
        } else {
            $transactionActive = false;
            try {
                $conn->begin_transaction();
                $transactionActive = true;
                $lock = $conn->prepare('SELECT admin_account_invites.admin_id FROM admin_account_invites JOIN admins ON admins.id = admin_account_invites.admin_id WHERE admin_account_invites.token_hash = ? AND admin_account_invites.expires_at > NOW() AND admins.is_active = 0 FOR UPDATE');
                $lock->bind_param('s', $tokenHash);
                $lock->execute();
                $lockedInvite = $lock->get_result()->fetch_assoc();

                if (!$lockedInvite || (int) $lockedInvite['admin_id'] !== $adminId) {
                    $conn->rollback();
                    $transactionActive = false;
                    $adminId = null;
                    $error = 'This invitation is invalid or expired. Ask the administrator who invited you to send another.';
                } else {
                    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                    $activate = $conn->prepare('UPDATE admins SET password_hash = ?, is_active = 1 WHERE id = ? AND is_active = 0');
                    $activate->bind_param('si', $passwordHash, $adminId);
                    $activate->execute();
                    if ($activate->affected_rows !== 1) {
                        throw new RuntimeException('The invited CMS account could not be activated.');
                    }

                    $delete = $conn->prepare('DELETE FROM admin_account_invites WHERE admin_id = ?');
                    $delete->bind_param('i', $adminId);
                    $delete->execute();
                    $conn->commit();
                    $transactionActive = false;

                    $_SESSION = [];
                    session_regenerate_id(true);
                    header('Location: ./login.php?created=1');
                    exit;
                }
            } catch (Throwable $exception) {
                if ($transactionActive) {
                    $conn->rollback();
                }
                error_log('CMS invitation acceptance failed: ' . $exception->getMessage());
                $error = 'The account could not be activated. Please ask the administrator to resend the invitation.';
            }
        }
    }
} elseif ($adminId === null) {
    $error = 'This invitation is invalid or expired. Ask the administrator who invited you to send another.';
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <meta name="theme-color" content="#1e3a8a">
    <title>Accept CMS Invitation - Calyst Christian School</title>
    <link rel="icon" type="image/x-icon" href="../ASSETS/images/favicon_io no bg/favicon.ico">
    <link rel="icon" type="image/png" sizes="32x32" href="../ASSETS/images/favicon_io no bg/favicon-32x32.png">
    <link rel="apple-touch-icon" href="../ASSETS/images/favicon_io no bg/apple-touch-icon.png">
    <link rel="stylesheet" href="./admin-auth.css?v=2">
</head>
<body>
    <main class="auth-card">
        <header class="auth-brand">
            <img src="../ASSETS/images/calyst budge better no bg.png" alt="">
            <h1>Set up your CMS account</h1>
            <p>Calyst Christian School</p>
        </header>
        <?php if ($error !== ''): ?>
            <div class="auth-alert error" role="alert" aria-live="polite"><?= htmlspecialchars($error, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?></div>
        <?php endif; ?>
        <?php if ($adminId !== null): ?>
            <p class="auth-description">Verify your email by opening this invitation and choose a password with at least 12 characters.</p>
            <form method="POST" action="./accept-invite.php">
                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(csrfToken(), ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?>">
                <input type="hidden" name="token" value="<?= htmlspecialchars($token, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?>">
                <div class="auth-field">
                    <label for="password">Create password</label>
                    <input type="password" id="password" name="password" minlength="12" maxlength="72" autocomplete="new-password" required>
                </div>
                <div class="auth-field">
                    <label for="password_confirmation">Confirm password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" minlength="12" maxlength="72" autocomplete="new-password" required>
                </div>
                <button class="auth-submit" type="submit">Verify email and activate account</button>
            </form>
        <?php endif; ?>
        <nav class="auth-links" aria-label="Account help">
            <a href="./login.php">Back to sign in</a>
            <a href="../home.php">Return to school website</a>
        </nav>
    </main>
</body>
</html>
