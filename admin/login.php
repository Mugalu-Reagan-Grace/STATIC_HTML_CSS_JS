<?php
require_once __DIR__ . '/config.php';

$error = '';
$success = '';
$username = '';

$success = '';
if (isset($_GET['reset'])) {
    $success = 'Your password has been updated. Sign in with your new password.';
} elseif (isset($_GET['created'])) {
    $success = 'Your email is verified and your CMS account is ready. Sign in to continue.';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usernameInput = $_POST['username'] ?? '';
    $passwordInput = $_POST['password'] ?? '';
    $username = is_string($usernameInput) ? trim($usernameInput) : '';
    $password = is_string($passwordInput) ? $passwordInput : '';
    
    if (!isValidCsrfToken($_POST['csrf_token'] ?? null)) {
        http_response_code(400);
        $error = 'Your session expired. Refresh the page and try again.';
    } elseif (empty($username) || empty($password)) {
        $error = 'Username and password are required';
    } else {
        $stmt = $conn->prepare('SELECT id, username, password_hash, full_name, role FROM admins WHERE username = ? AND is_active = TRUE');
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows === 1) {
            $admin = $result->fetch_assoc();
            if (password_verify($password, $admin['password_hash'])) {
                session_regenerate_id(true);
                $_SESSION['admin_id'] = $admin['id'];
                $_SESSION['admin_username'] = $admin['username'];
                $_SESSION['admin_name'] = $admin['full_name'];
                $_SESSION['admin_role'] = $admin['role'];
                $_SESSION['last_activity'] = time();
                
                $update_stmt = $conn->prepare('UPDATE admins SET last_login = NOW() WHERE id = ?');
                $update_stmt->bind_param('i', $admin['id']);
                $update_stmt->execute();
                
                header('Location: ./dashboard.php');
                exit;
            } else {
                $error = 'Invalid username or password';
            }
        } else {
            $error = 'Invalid username or password';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <meta name="theme-color" content="#1e3a8a">
    <title>Admin Login - Calyst Christian School</title>
    <link rel="icon" type="image/x-icon" href="../ASSETS/images/favicon_io no bg/favicon.ico">
    <link rel="icon" type="image/png" sizes="32x32" href="../ASSETS/images/favicon_io no bg/favicon-32x32.png">
    <link rel="apple-touch-icon" href="../ASSETS/images/favicon_io no bg/apple-touch-icon.png">
    <link rel="stylesheet" href="./admin-auth.css?v=2">
</head>
<body>
    <main class="auth-card">
        <header class="auth-brand">
            <img src="../ASSETS/images/calyst budge better no bg.png" alt="">
            <h1>Admin portal</h1>
            <p>Calyst Christian School</p>
        </header>
        
        <?php if ($error): ?>
            <div class="auth-alert error" role="alert" aria-live="polite"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></div>
        <?php endif; ?>
        <?php if ($success): ?>
            <div class="auth-alert success" role="status" aria-live="polite"><?= htmlspecialchars($success, ENT_QUOTES, 'UTF-8'); ?></div>
        <?php endif; ?>
        
        <form method="POST" action="./login.php">
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars(csrfToken(), ENT_QUOTES, 'UTF-8'); ?>">
            <div class="auth-field">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" value="<?= htmlspecialchars($username, ENT_QUOTES, 'UTF-8'); ?>" autocomplete="username" required autofocus>
            </div>
            
            <div class="auth-field">
                <label for="password">Password</label>
                <div class="auth-password">
                    <input type="password" id="password" name="password" autocomplete="current-password" required>
                    <button class="auth-password-toggle" type="button" aria-label="Show password" aria-pressed="false" data-password-toggle>Show</button>
                </div>
            </div>
            
            <button type="submit" class="auth-submit">Sign in</button>
        </form>
        <nav class="auth-links" aria-label="Account help">
            <a href="./forgot-password.php">Forgot your password?</a>
            <a href="../home.php">Return to school website</a>
        </nav>
    </main>
    <script>
        const passwordInput = document.getElementById("password");
        const passwordToggle = document.querySelector("[data-password-toggle]");
        passwordToggle.addEventListener("click", () => {
            const showPassword = passwordInput.type === "password";
            passwordInput.type = showPassword ? "text" : "password";
            passwordToggle.textContent = showPassword ? "Hide" : "Show";
            passwordToggle.setAttribute("aria-label", showPassword ? "Hide password" : "Show password");
            passwordToggle.setAttribute("aria-pressed", String(showPassword));
        });
    </script>
</body>
</html>
