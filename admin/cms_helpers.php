<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/layout.php';
redirectIfNotAdmin();

function adminEscape($value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function adminRequirePost(): void
{
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        http_response_code(405);
        exit('Method not allowed.');
    }

    if (!isValidCsrfToken($_POST['csrf_token'] ?? null)) {
        http_response_code(400);
        exit('Your session expired. Refresh the page and try again.');
    }
}

function adminCsrfField(): void
{
    echo '<input type="hidden" name="csrf_token" value="' . adminEscape(csrfToken()) . '">';
}

function adminRequireRole(string $requiredRole): void
{
    global $conn;
    redirectIfNotAdmin();

    $adminId = (int) ($_SESSION['admin_id'] ?? 0);
    $statement = $conn->prepare('SELECT role, is_active FROM admins WHERE id = ? LIMIT 1');
    $statement->bind_param('i', $adminId);
    $statement->execute();
    $account = $statement->get_result()->fetch_assoc();

    if (!$account || !(int) $account['is_active']) {
        $_SESSION = [];
        session_destroy();
        header('Location: ./login.php');
        exit;
    }

    $_SESSION['admin_role'] = $account['role'];
    if ($account['role'] !== $requiredRole) {
        http_response_code(403);
        exit('Administrator access required.');
    }
}

function adminFlash(string $type, string $message): void
{
    $_SESSION['admin_flash'] = ['type' => $type, 'message' => $message];
}

function adminShowFlash(): void
{
    if (empty($_SESSION['admin_flash'])) {
        return;
    }

    $flash = $_SESSION['admin_flash'];
    unset($_SESSION['admin_flash']);
    $type = $flash['type'] === 'success' ? 'success' : 'error';
    echo '<div class="admin-alert ' . $type . '" role="status">' . adminEscape($flash['message']) . '</div>';
}

function adminUploadImage(string $field, ?string $existingPath = null): ?string
{
    if (!isset($_FILES[$field]) || $_FILES[$field]['error'] === UPLOAD_ERR_NO_FILE) {
        return $existingPath;
    }

    $file = $_FILES[$field];
    if ($file['error'] !== UPLOAD_ERR_OK || $file['size'] > 5 * 1024 * 1024) {
        throw new RuntimeException('Image upload failed or is larger than 5 MB.');
    }

    $mime = (new finfo(FILEINFO_MIME_TYPE))->file($file['tmp_name']);
    $extensions = ['image/jpeg' => 'jpg', 'image/png' => 'png', 'image/webp' => 'webp'];
    if (!isset($extensions[$mime])) {
        throw new RuntimeException('Choose a JPG, PNG, or WebP image.');
    }

    $relativeDirectory = 'uploads/cms';
    $absoluteDirectory = dirname(__DIR__) . DIRECTORY_SEPARATOR . $relativeDirectory;
    if (!is_dir($absoluteDirectory) && !mkdir($absoluteDirectory, 0755, true) && !is_dir($absoluteDirectory)) {
        throw new RuntimeException('The image upload folder could not be created.');
    }

    $fileName = bin2hex(random_bytes(16)) . '.' . $extensions[$mime];
    if (!move_uploaded_file($file['tmp_name'], $absoluteDirectory . DIRECTORY_SEPARATOR . $fileName)) {
        throw new RuntimeException('The image could not be saved.');
    }

    return $relativeDirectory . '/' . $fileName;
}

function adminDeleteUploadedImage(?string $path): void
{
    if (!$path || !preg_match('~\Auploads/cms/[a-f0-9]{32}\.(?:jpg|png|webp)\z~', $path)) {
        return;
    }

    $absolutePath = dirname(__DIR__) . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $path);
    if (is_file($absolutePath) && !unlink($absolutePath)) {
        throw new RuntimeException('The uploaded image file could not be deleted.');
    }
}

function adminImageUrl(string $path): string
{
    if (preg_match('~\Ahttps?://~i', $path) || str_starts_with($path, '/')) {
        return $path;
    }

    return preg_match('~\A(?:ASSETS/images|uploads/cms)/~', $path) ? '../' . $path : $path;
}

function adminValidateField(string $name, $value, array $field): string
{
    $value = is_string($value) ? trim($value) : '';
    if (!empty($field['required']) && $value === '') {
        throw new RuntimeException($field['label'] . ' is required.');
    }

    if (isset($field['max']) && strlen($value) > $field['max']) {
        throw new RuntimeException($field['label'] . ' must be at most ' . $field['max'] . ' characters.');
    }

    if ($value !== '' && $field['type'] === 'email' && !filter_var($value, FILTER_VALIDATE_EMAIL)) {
        throw new RuntimeException('Enter a valid email address.');
    }

    if ($value !== '' && $field['type'] === 'url') {
        $parts = parse_url($value);
        if (
            !filter_var($value, FILTER_VALIDATE_URL) ||
            $parts === false ||
            !in_array($parts['scheme'] ?? '', ['http', 'https'], true)
        ) {
            throw new RuntimeException($field['label'] . ' must be a complete HTTP or HTTPS URL.');
        }
    }

    if ($value !== '' && $field['type'] === 'select' && !in_array($value, $field['options'], true)) {
        throw new RuntimeException('Choose a valid ' . strtolower($field['label']) . '.');
    }

    if ($value !== '' && $field['type'] === 'number' && !is_numeric($value)) {
        throw new RuntimeException($field['label'] . ' must be a number.');
    }

    return $value;
}
