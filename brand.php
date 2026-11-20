<?php

declare(strict_types=1);

require_once __DIR__ . '/admin/config.php';

if (!defined('SCHOOL_NAME')) {
    define('SCHOOL_NAME', 'Calyst Christian School');
    define('SCHOOL_NAME_MARKUP', 'Calyst <span>Christian</span> School');
    define('SCHOOL_NAME_UPPER', 'CALYST CHRISTIAN SCHOOL');
    define('SCHOOL_MOTTO', 'HOFU YA BWANA');

    define('SCHOOL_LOGO_MAIN', './ASSETS/images/calyst budge final.png');
    define('SCHOOL_LOGO_NO_BG', './ASSETS/images/calyst budge better no bg.png');
    define('SCHOOL_LOGO_ALT', SCHOOL_NAME . ' logo');
}

$home_url = './home.php';
$home_name = 'Home';
$about_url = './about.php';
$about_name = 'About';
$fees_url = './fees.php';
$fees_name = 'Fees';
$gallery_url = './gallery.php';
$gallery_name = 'Gallery';
$programs_url = './programs.php';
$programs_name = 'Programs';
$contact_url = './contact_us.php';
$contact_name = 'Contact';
$news_events_url = './news-events.php';
$news_events_name = 'News & Events';
$admissions_url = './admissions.php';
$admissions_name = 'Admissions';
$staff_url = './staff.php';
$staff_name = 'Staff';

$navigation =
    '<li><a href="' . $home_url . '">' . $home_name . '</a></li>' .
    '<li class="dropdown"><a href="' . $about_url . '">School</a>' .
    '<ul class="dropdown-menu">' .
    '<li><a href="' . $about_url . '">' . $about_name . '</a></li>' .
    '<li><a href="' . $staff_url . '">' . $staff_name . '</a></li>' .
    '<li><a href="' . $fees_url . '">' . $fees_name . '</a></li>' .
    '<li><a href="' . $gallery_url . '">' . $gallery_name . '</a></li>' .
    '</ul></li>' .
    '<li><a href="' . $programs_url . '">' . $programs_name . '</a></li>' .
    '<li><a href="' . $news_events_url . '">' . $news_events_name . '</a></li>' .
    '<li><a href="' . $contact_url . '">' . $contact_name . '</a></li>' .
    '<li class="nav-admissions"><a class="btn-admissions" href="' . $admissions_url . '">' . $admissions_name . '</a></li>';

$school = [
    'name' => SCHOOL_NAME,
    'name_markup' => SCHOOL_NAME_MARKUP,
    'name_upper' => SCHOOL_NAME_UPPER,
    'motto' => SCHOOL_MOTTO,
    'logo_main' => SCHOOL_LOGO_MAIN,
    'logo_no_bg' => SCHOOL_LOGO_NO_BG,
    'logo_alt' => SCHOOL_LOGO_ALT,
];

$publicSettings = [];
if (isset($conn) && $conn instanceof mysqli) {
    $settingsResult = $conn->query('SELECT setting_key, setting_value FROM school_settings');
    if ($settingsResult) {
        while ($row = $settingsResult->fetch_assoc()) {
            $publicSettings[$row['setting_key']] = $row['setting_value'];
        }
    }
}

$school['phone_1'] = $publicSettings['school_phone_1'] ?? '(+256) 774-744-394';
$school['phone_2'] = $publicSettings['school_phone_2'] ?? '(+256) 752-482-066';
$school['email'] = $publicSettings['school_email'] ?? 'mugalureagan18@gmail.com';
$school['address'] = $publicSettings['school_address'] ?? 'P.O. BOX 124666, Kampala, Uganda';

$school['dynamic'] = [];
foreach (['contact_phones', 'contact_emails', 'contact_addresses', 'school_hours', 'social_profiles'] as $key) {
    $decoded = json_decode((string) ($publicSettings[$key] ?? '[]'), true);
    $school['dynamic'][$key] = is_array($decoded) ? array_values(array_filter($decoded, static function ($item) {
        return is_array($item) && trim((string) ($item['label'] ?? '')) !== '' && trim((string) ($item['value'] ?? '')) !== '';
    })) : [];
}
