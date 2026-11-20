<?php
require_once __DIR__ . '/config.php';

$error = '';
$success = isset($_GET['updated']) ? 'Password updated. You can now sign in with your new password.' : '';
$tokenInput = $_SERVER['REQUEST_METHOD'] === 'POST'
    ? ($_POST['token'] ?? '')
    : ($_GET['token'] ?? '');
$token = is_string($tokenInput) ? trim($tokenInput) : '';
$tokenHash = preg_match('/\A[a-f0-9]{64}\z/i', $token) ? hash('sha256', $token) : '';
$adminId = null;

if ($tokenHash !== '') {
    $lookup = $conn->prepare('SELECT admins.id FROM admin_password_resets JOIN admins ON admins.id = admin_password_resets.admin_id WHERE admin_password_resets.token_hash = ? AND admin_password_resets.expires_at > NOW() AND admins.is_active = TRUE LIMIT 1');
    $lookup->bind_param('s', $tokenHash);
    $lookup->execute();
    $reset = $lookup->get_result()->fetch_assoc();
    $adminId = $reset ? (int) $reset['id'] : null;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isValidCsrfToken($_POST['csrf_token'] ?? null)) {
        http_response_code(400);
        $error = 'Your session expired. Refresh the page and try again.';
    } elseif ($adminId === null) {
        $error = 'This reset link is invalid or expired. Request a new one.';
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
            $conn->begin_transaction();
            $transactionActive = true;
            try {
                $lock = $conn->prepare('SELECT admin_id FROM admin_password_resets WHERE token_hash = ? AND expires_at > NOW() FOR UPDATE');
                $lock->bind_param('s', $tokenHash);
                $lock->execute();
                $lockedReset = $lock->get_result()->fetch_assoc();

                if (!$lockedReset || (int) $lockedReset['admin_id'] !== $adminId) {
                    $conn->rollback();
                    $transactionActive = false;
                    $adminId = null;
                    $error = 'This reset link is invalid or expired. Request a new one.';
                } else {
                    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                    $update = $conn->prepare('UPDATE admins SET password_hash = ? WHERE id = ? AND is_active = TRUE');
                    $update->bind_param('si', $passwordHash, $adminId);
                    $update->execute();

                    if ($update->affected_rows !== 1) {
                        throw new RuntimeException('Admin password was not updated.');
                    }

                    $delete = $conn->prepare('DELETE FROM admin_password_resets WHERE admin_id = ?');
                    $delete->bind_param('i', $adminId);
                    $delete->execute();
                    $conn->commit();
                    $transactionActive = false;

                    session_regenerate_id(true);
                    $_SESSION = [];
                    header('Location: ./reset-password.php?updated=1');
                    exit;
                }
            } catch (Throwable $exception) {
                if ($transactionActive) {
                    $conn->rollback();
                }
                throw $exception;
            }
        }
    }
} elseif ($adminId === null && $success === '') {
    $error = 'This reset link is invalid or expired. Request a new one.';
}
header('Cache-Control: no-store, private');
header('Referrer-Policy: no-referrer');
header('X-Robots-Tag: noindex, nofollow');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <meta name="theme-color" content="#1e3a8a">
    <title>Reset Password - Calyst Christian School</title>
    <link rel="icon" type="image/x-icon" href="../ASSETS/images/favicon_io no bg/favicon.ico">
    <link rel="icon" type="image/png" sizes="32x32" href="../ASSETS/images/favicon_io no bg/favicon-32x32.png">
    <link rel="apple-touch-icon" href="../ASSETS/images/favicon_io no bg/apple-touch-icon.png">
    <link rel="stylesheet" href="./admin-auth.css?v=2">
</head>
<body>
    <main class="auth-card">
        <header class="auth-brand">
            <img src="../ASSETS/images/calyst budge better no bg.png" alt="">
            <h1>Set a new password</h1>
            <p>Calyst Christian School admin portal</p>
        </header>
        <?php if ($error): ?><div class="auth-alert error" role="alert" aria-live="polite"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></div><?php endif; ?>
        <?php if ($success): ?><div class="auth-alert success" role="status" aria-live="polite"><?= htmlspecialchars($success, ENT_QUOTES, 'UTF-8'); ?></div><?php endif; ?>
        <?php if ($adminId !== null && $success === ''): ?>
            <form method="POST" action="./reset-password.php">
                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(csrfToken(), ENT_QUOTES, 'UTF-8'); ?>">
                <input type="hidden" name="token" value="<?= htmlspecialchars($token, ENT_QUOTES, 'UTF-8'); ?>">
                <p class="auth-description">Choose a password with at least 12 characters.</p>
                <div class="auth-field">
                    <label for="password">New password</label>
                    <input type="password" id="password" name="password" minlength="12" maxlength="72" autocomplete="new-password" required>
                </div>
                <div class="auth-field">
                    <label for="password_confirmation">Confirm new password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" minlength="12" maxlength="72" autocomplete="new-password" required>
                </div>
                <button class="auth-submit" type="submit">Update password</button>
            </form>
        <?php endif; ?>
        <nav class="auth-links" aria-label="Account help">
            <a href="./login.php">Back to login</a>
            <?php if ($adminId === null && $success === ''): ?><a href="./forgot-password.php">Request a new reset link</a><?php endif; ?>
            <a href="../home.php">Return to school website</a>
        </nav>
    </main>
</body>
</html>
