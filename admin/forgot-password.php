<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/mailer.php';

$error = '';
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isValidCsrfToken($_POST['csrf_token'] ?? null)) {
        http_response_code(400);
        $error = 'Your session expired. Refresh the page and try again.';
    } else {
        $message = 'If an active admin account matches that email, a password reset link will be sent shortly.';
        $emailInput = $_POST['email'] ?? '';
        $email = is_string($emailInput) ? trim($emailInput) : '';
        $window = $_SESSION['password_reset_window'] ?? ['started_at' => time(), 'count' => 0];

        if (time() - $window['started_at'] >= 900) {
            $window = ['started_at' => time(), 'count' => 0];
        }

        $window['count']++;
        $_SESSION['password_reset_window'] = $window;

        if ($window['count'] <= 5 && filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $stmt = $conn->prepare('SELECT id, email, full_name FROM admins WHERE email = ? AND is_active = TRUE LIMIT 1');
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $admin = $stmt->get_result()->fetch_assoc();

            if ($admin) {
                $cooldown = $conn->prepare('SELECT id FROM admin_password_resets WHERE admin_id = ? AND created_at > DATE_SUB(NOW(), INTERVAL 60 SECOND) LIMIT 1');
                $cooldown->bind_param('i', $admin['id']);
                $cooldown->execute();

                if ($cooldown->get_result()->num_rows === 0) {
                    $token = bin2hex(random_bytes(32));
                    $tokenHash = hash('sha256', $token);

                    $conn->begin_transaction();
                    try {
                        $delete = $conn->prepare('DELETE FROM admin_password_resets WHERE admin_id = ?');
                        $delete->bind_param('i', $admin['id']);
                        $delete->execute();

                        $insert = $conn->prepare('INSERT INTO admin_password_resets (admin_id, token_hash, expires_at) VALUES (?, ?, DATE_ADD(NOW(), INTERVAL 30 MINUTE))');
                        $insert->bind_param('is', $admin['id'], $tokenHash);
                        $insert->execute();
                        $conn->commit();
                    } catch (Throwable $exception) {
                        $conn->rollback();
                        error_log('Unable to create admin password reset token.');
                        $tokenHash = '';
                    }

                    if ($tokenHash !== '') {
                        $resetUrl = APP_URL . '/admin/reset-password.php?token=' . rawurlencode($token);
                        $safeName = htmlspecialchars($admin['full_name'], ENT_QUOTES, 'UTF-8');
                        $safeUrl = htmlspecialchars($resetUrl, ENT_QUOTES, 'UTF-8');
                        $subject = 'Calyst Christian School admin password reset';
                        $html = '<p>Hello ' . $safeName . ',</p><p>A request was made to reset your admin portal password. Use the link below within 30 minutes:</p><p><a href="' . $safeUrl . '">Reset admin password</a></p><p>If you did not request this, you can ignore this message. Your password will not change unless the link is used.</p>';
                        $text = "Hello {$admin['full_name']},\n\nUse this link within 30 minutes to reset your admin portal password:\n{$resetUrl}\n\nIf you did not request this, ignore this email. Your password will not change unless the link is used.";

                        try {
                            sendAdminEmail($admin['email'], $subject, $html, $text);
                        } catch (RuntimeException $exception) {
                            $delete = $conn->prepare('DELETE FROM admin_password_resets WHERE token_hash = ?');
                            $delete->bind_param('s', $tokenHash);
                            $delete->execute();
                            error_log('Admin password reset email could not be delivered. Check SMTP configuration.');
                        }
                    }
                }
            }
        }
    }
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
    <title>Forgot Password - Calyst Christian School</title>
    <link rel="icon" type="image/x-icon" href="../ASSETS/images/favicon_io no bg/favicon.ico">
    <link rel="icon" type="image/png" sizes="32x32" href="../ASSETS/images/favicon_io no bg/favicon-32x32.png">
    <link rel="apple-touch-icon" href="../ASSETS/images/favicon_io no bg/apple-touch-icon.png">
    <link rel="stylesheet" href="./admin-auth.css?v=2">
</head>
<body>
    <main class="auth-card">
        <header class="auth-brand">
            <img src="../ASSETS/images/calyst budge better no bg.png" alt="">
            <h1>Forgot password?</h1>
            <p>Calyst Christian School admin portal</p>
        </header>
        <p class="auth-description">Enter the email address on your admin account. If it matches, we’ll email you a reset link.</p>
        <?php if ($error): ?><div class="auth-alert error" role="alert" aria-live="polite"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></div><?php endif; ?>
        <?php if ($message): ?><div class="auth-alert success" role="status" aria-live="polite"><?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8'); ?></div><?php endif; ?>
        <form method="POST" action="./forgot-password.php">
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(csrfToken(), ENT_QUOTES, 'UTF-8'); ?>">
            <div class="auth-field">
                <label for="email">Admin email</label>
                <input type="email" id="email" name="email" value="<?= htmlspecialchars(is_string($_POST['email'] ?? null) ? $_POST['email'] : '', ENT_QUOTES, 'UTF-8'); ?>" autocomplete="email" maxlength="100" required>
            </div>
            <button class="auth-submit" type="submit">Send reset link</button>
        </form>
        <nav class="auth-links" aria-label="Account help">
            <a href="./login.php">Back to login</a>
            <a href="../home.php">Return to school website</a>
        </nav>
    </main>
</body>
</html>
