<?php
$projectRoot = dirname(__DIR__);
$composerAutoload = $projectRoot . '/vendor/autoload.php';
if (is_file($composerAutoload)) {
    require_once $composerAutoload;

    if (class_exists(\Dotenv\Dotenv::class)) {
        \Dotenv\Dotenv::createImmutable($projectRoot)->safeLoad();
    }
}

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

function projectEnvironment(string $name, string $default): string
{
    $value = $_ENV[$name] ?? $_SERVER[$name] ?? getenv($name);
    return $value === false || $value === null ? $default : (string) $value;
}

define('DB_HOST', projectEnvironment('DB_HOST', '127.0.0.1'));
define('DB_PORT', (int) projectEnvironment('DB_PORT', '3307'));
define('DB_USER', projectEnvironment('DB_USER', 'root'));
define('DB_PASS', projectEnvironment('DB_PASS', ''));
define('DB_NAME', projectEnvironment('DB_NAME', 'calyst_school'));

// SMTP / Mail settings (used by form processors and PHPMailer)
// Use provider-approved SMTP credentials (for Gmail, use an App Password).
define('SMTP_HOST', projectEnvironment('SMTP_HOST', 'smtp.gmail.com'));
define('SMTP_PORT', (int) projectEnvironment('SMTP_PORT', '587'));
define('SMTP_USER', projectEnvironment('SMTP_USER', 'your-email@gmail.com'));
define('SMTP_PASS', projectEnvironment('SMTP_PASS', 'your-app-password'));
define('SMTP_SECURE', projectEnvironment('SMTP_SECURE', 'tls')); // 'tls', 'ssl', or ''
define('SMTP_FROM_EMAIL', projectEnvironment('SMTP_FROM_EMAIL', 'mugalureagan18@gmail.com'));
define('SMTP_FROM_NAME', projectEnvironment('SMTP_FROM_NAME', defined('SCHOOL_NAME') ? SCHOOL_NAME : 'Calyst Christian School'));
$appUrl = rtrim(projectEnvironment('APP_URL', 'http://calyst.nsoft'), '/');
$appUrlParts = parse_url($appUrl);
if (
    $appUrlParts === false ||
    !isset($appUrlParts['scheme'], $appUrlParts['host']) ||
    !in_array($appUrlParts['scheme'], ['http', 'https'], true) ||
    array_intersect(['user', 'pass', 'query', 'fragment'], array_keys($appUrlParts))
) {
    throw new RuntimeException('APP_URL must be an absolute HTTP or HTTPS URL without credentials, query, or fragment.');
}
define('APP_URL', $appUrl);

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
} catch (Throwable $e) {
    error_log('Admin database connection failed: ' . $e->getMessage());
    throw new RuntimeException('Database connection unavailable. Check the local database settings.', 0, $e);
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

function csrfToken(): string
{
    if (!isset($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }

    return $_SESSION['csrf_token'];
}

function isValidCsrfToken($token): bool
{
    return is_string($token)
        && isset($_SESSION['csrf_token'])
        && hash_equals($_SESSION['csrf_token'], $token);
}
