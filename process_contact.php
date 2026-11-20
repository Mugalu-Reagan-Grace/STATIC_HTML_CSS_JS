<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

function contactRedirect(string $result): void
{
    $_SESSION['contact_result'] = $result;
    header('Location: ./contact_us.php', true, 303);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    header('Allow: POST');
    exit('Method not allowed.');
}

$token = $_POST['csrf_token'] ?? '';
$sessionToken = $_SESSION['contact_csrf_token'] ?? '';
if (!is_string($token) || !is_string($sessionToken) || $sessionToken === '' || !hash_equals($sessionToken, $token)) {
    contactRedirect('error');
}

$honeypot = $_POST['website'] ?? '';
if (is_string($honeypot) && trim($honeypot) !== '') {
    contactRedirect('error');
}

$now = time();
$attempts = $_SESSION['contact_submission_attempts'] ?? [];
$attempts = is_array($attempts) ? array_filter($attempts, static fn($time) => is_int($time) && $time > $now - 900) : [];
if (count($attempts) >= 5) {
    contactRedirect('wait');
}
$attempts[] = $now;
$_SESSION['contact_submission_attempts'] = array_values($attempts);

$nameInput = $_POST['name'] ?? '';
$emailInput = $_POST['email'] ?? '';
$phoneInput = $_POST['phone'] ?? '';
$subjectInput = $_POST['subject'] ?? '';
$messageInput = $_POST['message'] ?? '';
if (!is_string($nameInput) || !is_string($emailInput) || !is_string($phoneInput) || !is_string($subjectInput) || !is_string($messageInput)) {
    contactRedirect('error');
}

$name = trim($nameInput);
$email = trim($emailInput);
$phone = trim($phoneInput);
$subject = trim($subjectInput);
$message = trim($messageInput);
$allowedSubjects = ['Admissions', 'School visit', 'Fees', 'General enquiry'];
$length = static fn(string $value): int => function_exists('mb_strlen') ? mb_strlen($value, 'UTF-8') : strlen($value);

if (
    $name === '' || $length($name) > 100 ||
    !filter_var($email, FILTER_VALIDATE_EMAIL) || $length($email) > 100 ||
    ($phone !== '' && (!preg_match('/\A[\d+\-\s()]{7,20}\z/', $phone) || $length($phone) > 20)) ||
    !in_array($subject, $allowedSubjects, true) ||
    $message === '' || $length($message) > 5000
) {
    contactRedirect('error');
}

try {
    require_once __DIR__ . '/admin/config.php';
    $statement = $conn->prepare('INSERT INTO contact_submissions (name, email, phone, subject, message) VALUES (?, ?, ?, ?, ?)');
    $statement->bind_param('sssss', $name, $email, $phone, $subject, $message);
    $statement->execute();
    unset($_SESSION['contact_csrf_token']);
    contactRedirect('sent');
} catch (RuntimeException $exception) {
    error_log('Public contact submission failed: ' . $exception->getMessage());
    contactRedirect('error');
}
