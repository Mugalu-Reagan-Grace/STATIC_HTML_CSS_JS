<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

define('DB_HOST', getenv('DB_HOST') ?: '127.0.0.1');
define('DB_PORT', (int) (getenv('DB_PORT') ?: 3307));
define('DB_USER', getenv('DB_USER') ?: 'root');
define('DB_PASS', getenv('DB_PASS') ?: '');
define('DB_NAME', getenv('DB_NAME') ?: 'calyst_school');

// SMTP / Mail settings (used by form processors and PHPMailer)
// For Gmail: use smtp.gmail.com, port 587, enable "Less secure app access" or use App Password
// For other providers: configure accordingly; override via environment variables
define('SMTP_HOST', getenv('SMTP_HOST') ?: 'smtp.gmail.com');
define('SMTP_PORT', (int) (getenv('SMTP_PORT') ?: 587));
define('SMTP_USER', getenv('SMTP_USER') ?: 'your-email@gmail.com');
define('SMTP_PASS', getenv('SMTP_PASS') ?: 'your-app-password');
define('SMTP_SECURE', getenv('SMTP_SECURE') ?: 'tls'); // 'tls', 'ssl', or ''
define('SMTP_FROM_EMAIL', getenv('SMTP_FROM_EMAIL') ?: 'mugalureagan18@gmail.com');
define('SMTP_FROM_NAME', getenv('SMTP_FROM_NAME') ?: (defined('SCHOOL_NAME') ? SCHOOL_NAME : 'Calyst Christian School'));

function createDatabaseConnection() {
    $ports = array_values(array_unique(array_filter([
        DB_PORT,
        3307,
        3306,
    ], static function ($port) {
        return is_int($port) && $port > 0;
    })));

    $lastError = null;

    foreach ($ports as $port) {
        $conn = @new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME, $port);

        if (!$conn->connect_error) {
            $conn->set_charset('utf8mb4');
            return $conn;
        }

        $lastError = $conn->connect_error;
    }

    throw new RuntimeException(
        'Unable to connect to MySQL at ' . DB_HOST . ' using ports ' . implode(', ', $ports) .
        '. Last error: ' . ($lastError ?: 'unknown connection failure')
    );
}

try {
    $conn = createDatabaseConnection();
} catch (Exception $e) {
    die('Database error: ' . $e->getMessage());
}

define('ADMIN_SESSION_TIMEOUT', 3600);

function isAdminLoggedIn() {
    if (!isset($_SESSION['admin_id'])) {
        return false;
    }
    
    if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > ADMIN_SESSION_TIMEOUT)) {
        session_destroy();
        return false;
    }
    
    $_SESSION['last_activity'] = time();
    return true;
}

function redirectIfNotAdmin() {
    if (!isAdminLoggedIn()) {
        header('Location: ./login.php');
        exit;
    }
}

function sanitizeInput($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}

function escapeSql($data) {
    global $conn;
    return $conn->real_escape_string($data);
}

