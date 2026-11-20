<?php
require_once __DIR__ . '/cms_helpers.php';

$stats = [
    ['label' => 'News & events', 'icon' => 'fa-newspaper', 'count' => (int) $conn->query('SELECT COUNT(*) AS count FROM news_events')->fetch_assoc()['count'], 'url' => './manage-news.php'],
    ['label' => 'Active staff', 'icon' => 'fa-users', 'count' => (int) $conn->query('SELECT COUNT(*) AS count FROM staff WHERE is_active = 1')->fetch_assoc()['count'], 'url' => './manage-staff.php'],
    ['label' => 'Gallery photos', 'icon' => 'fa-images', 'count' => (int) $conn->query('SELECT COUNT(*) AS count FROM gallery WHERE is_active = 1')->fetch_assoc()['count'], 'url' => './manage-gallery.php'],
    ['label' => 'Unread messages', 'icon' => 'fa-envelope', 'count' => (int) $conn->query("SELECT COUNT(*) AS count FROM contact_submissions WHERE status = 'new'")->fetch_assoc()['count'], 'url' => './contact-submissions.php'],
];
$GLOBALS['adminUnreadCount'] = $stats[3]['count'];
$recentNews = $conn->query('SELECT id, title, category, is_published, created_at FROM news_events ORDER BY created_at DESC LIMIT 6')->fetch_all(MYSQLI_ASSOC);
$recentMessages = $conn->query("SELECT id, name, subject, created_at FROM contact_submissions WHERE status = 'new' ORDER BY created_at DESC LIMIT 5")->fetch_all(MYSQLI_ASSOC);

adminPageStart('Dashboard', 'dashboard.php', 'Your school website at a glance.');
adminPageHeading('Good day, ' . ($_SESSION['admin_name'] ?? 'Administrator'), 'Here is what is happening across your school website.');
adminShowFlash();
?>
<section class="admin-grid four" aria-label="Website overview">
    <?php foreach ($stats as $stat): ?>
        <article class="admin-stat">
            <span class="admin-stat-icon"><i class="fa-solid <?= adminEscape($stat['icon']); ?>"></i></span>
            <div class="admin-stat-value"><?= number_format($stat['count']); ?></div>
            <div class="admin-stat-label"><?= adminEscape($stat['label']); ?></div>
            <a class="admin-stat-link" href="<?= adminEscape($stat['url']); ?>" aria-label="Open <?= adminEscape($stat['label']); ?>"></a>
        </article>
    <?php endforeach; ?>
</section>

<section class="admin-card" style="margin-top:22px">
    <h2 class="admin-card-title">Quick actions</h2>
    <div class="admin-shortcuts">
        <a class="admin-shortcut" href="./manage-news.php#editor"><span class="admin-shortcut-icon"><i class="fa-solid fa-plus"></i></span><span><strong>Publish an update</strong><small>Share news and events</small></span></a>
        <a class="admin-shortcut" href="./manage-gallery.php#editor"><span class="admin-shortcut-icon"><i class="fa-solid fa-cloud-arrow-up"></i></span><span><strong>Add school photos</strong><small>Upload JPG, PNG, or WebP</small></span></a>
        <a class="admin-shortcut" href="./manage-staff.php#editor"><span class="admin-shortcut-icon"><i class="fa-solid fa-user-plus"></i></span><span><strong>Add a staff member</strong><small>Update your staff directory</small></span></a>
        <a class="admin-shortcut" href="./contact-submissions.php"><span class="admin-shortcut-icon"><i class="fa-solid fa-inbox"></i></span><span><strong>Review messages</strong><small><?= number_format($stats[3]['count']); ?> unread submissions</small></span></a>
        <a class="admin-shortcut" href="./edit-school.php"><span class="admin-shortcut-icon"><i class="fa-solid fa-sliders"></i></span><span><strong>School settings</strong><small>Contact details and social links</small></span></a>
        <a class="admin-shortcut" href="./profile.php"><span class="admin-shortcut-icon"><i class="fa-solid fa-shield-halved"></i></span><span><strong>Account security</strong><small>Update your password and email</small></span></a>
        <?php if (($_SESSION['admin_role'] ?? '') === 'admin'): ?>
            <a class="admin-shortcut" href="./accounts.php#invite"><span class="admin-shortcut-icon"><i class="fa-solid fa-user-plus"></i></span><span><strong>Invite a CMS user</strong><small>Send a verified account invitation</small></span></a>
        <?php endif; ?>
    </div>
</section>

<div class="admin-grid two" style="margin-top:22px">
    <section class="admin-card">
        <div class="admin-toolbar"><h2 class="admin-card-title" style="margin:0">Latest news & events</h2><a class="admin-btn secondary small" href="./manage-news.php">Manage all</a></div>
        <?php if (!$recentNews): ?>
            <div class="admin-empty"><i class="fa-regular fa-newspaper"></i><strong>No updates yet</strong><p>Create your first school update when you are ready.</p></div>
        <?php else: ?>
            <div class="admin-table-wrap"><table class="admin-table">
                <thead><tr><th>Title</th><th>Type</th><th>Status</th></tr></thead>
                <tbody><?php foreach ($recentNews as $item): ?><tr>
                    <td><a href="./manage-news.php?edit=<?= (int) $item['id']; ?>#editor"><strong><?= adminEscape($item['title']); ?></strong></a></td>
                    <td><?= adminEscape(ucfirst($item['category'])); ?></td>
                    <td><span class="admin-badge <?= $item['is_published'] ? 'success' : 'warning'; ?>"><?= $item['is_published'] ? 'Published' : 'Draft'; ?></span></td>
                </tr><?php endforeach; ?></tbody>
            </table></div>
        <?php endif; ?>
    </section>
    <section class="admin-card">
        <div class="admin-toolbar"><h2 class="admin-card-title" style="margin:0">New messages</h2><a class="admin-btn secondary small" href="./contact-submissions.php">View inbox</a></div>
        <?php if (!$recentMessages): ?>
            <div class="admin-empty"><i class="fa-regular fa-envelope-open"></i><strong>Inbox is clear</strong><p>New contact form submissions will appear here.</p></div>
        <?php else: ?>
            <div class="admin-table-wrap"><table class="admin-table">
                <thead><tr><th>From</th><th>Subject</th><th>Received</th></tr></thead>
                <tbody><?php foreach ($recentMessages as $message): ?><tr>
                    <td><strong><?= adminEscape($message['name']); ?></strong></td>
                    <td><?= adminEscape($message['subject'] ?: 'No subject'); ?></td>
                    <td><?= adminEscape(date('M j', strtotime($message['created_at']))); ?></td>
                </tr><?php endforeach; ?></tbody>
            </table></div>
        <?php endif; ?>
    </section>
</div>
<?php adminPageEnd(); ?>
