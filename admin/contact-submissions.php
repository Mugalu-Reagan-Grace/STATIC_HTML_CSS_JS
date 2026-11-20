<?php
require_once __DIR__ . '/cms_helpers.php';

$error = '';
if (isset($_GET['export']) && $_GET['export'] === 'csv') {
    $status = $_GET['status'] ?? 'all';
    if (!is_string($status) || !in_array($status, ['all', 'new', 'read', 'replied', 'archived'], true)) {
        $status = 'all';
    }
    $sql = 'SELECT id, name, email, phone, subject, message, status, created_at FROM contact_submissions';
    if ($status !== 'all') {
        $sql .= ' WHERE status = ?';
    }
    $sql .= ' ORDER BY created_at DESC';
    $export = $conn->prepare($sql);
    if ($status !== 'all') {
        $export->bind_param('s', $status);
    }
    $export->execute();
    $rows = $export->get_result()->fetch_all(MYSQLI_ASSOC);
    header('Content-Type: text/csv; charset=UTF-8');
    header('Content-Disposition: attachment; filename="calyst-contact-messages.csv"');
    header('Cache-Control: no-store');
    $output = fopen('php://output', 'w');
    fputcsv($output, ['ID', 'Name', 'Email', 'Phone', 'Subject', 'Message', 'Status', 'Received']);
    foreach ($rows as $row) {
        fputcsv($output, [
            $row['id'],
            $row['name'],
            $row['email'],
            $row['phone'],
            $row['subject'],
            $row['message'],
            $row['status'],
            $row['created_at'],
        ]);
    }
    fclose($output);
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        adminRequirePost();
        $action = $_POST['action'] ?? '';
        $id = filter_var($_POST['id'] ?? null, FILTER_VALIDATE_INT);
        if (!$id || $id < 1) {
            throw new RuntimeException('Invalid message.');
        }

        if ($action === 'status') {
            $status = $_POST['status'] ?? '';
            if (!in_array($status, ['new', 'read', 'replied', 'archived'], true)) {
                throw new RuntimeException('Choose a valid message status.');
            }
            $stmt = $conn->prepare('UPDATE contact_submissions SET status = ? WHERE id = ?');
            $stmt->bind_param('si', $status, $id);
            $stmt->execute();
            if ($stmt->affected_rows === 0 && $conn->query('SELECT ROW_COUNT() AS count')->fetch_assoc()['count'] == 0) {
                $exists = $conn->prepare('SELECT id FROM contact_submissions WHERE id = ?');
                $exists->bind_param('i', $id);
                $exists->execute();
                if (!$exists->get_result()->fetch_assoc()) {
                    throw new RuntimeException('Message not found.');
                }
            }
            adminFlash('success', 'Message status updated.');
        } elseif ($action === 'delete') {
            $stmt = $conn->prepare('DELETE FROM contact_submissions WHERE id = ?');
            $stmt->bind_param('i', $id);
            $stmt->execute();
            if ($stmt->affected_rows !== 1) {
                throw new RuntimeException('Message not found.');
            }
            adminFlash('success', 'Message deleted.');
        } else {
            throw new RuntimeException('Choose a valid action.');
        }

        header('Location: ./contact-submissions.php');
        exit;
    } catch (RuntimeException $exception) {
        $error = $exception->getMessage();
    } catch (Throwable $exception) {
        error_log('Contact message update failed: ' . $exception->getMessage());
        $error = 'Unable to update the message.';
    }
}

$status = $_GET['status'] ?? 'all';
if (!is_string($status) || !in_array($status, ['all', 'new', 'read', 'replied', 'archived'], true)) {
    $status = 'all';
}
$page = max(1, (int) ($_GET['page'] ?? 1));
$perPage = 20;
$offset = ($page - 1) * $perPage;
$filterSql = $status === 'all' ? '' : ' WHERE status = ?';
$count = $conn->prepare('SELECT COUNT(*) AS total FROM contact_submissions' . $filterSql);
if ($status !== 'all') {
    $count->bind_param('s', $status);
}
$count->execute();
$total = (int) $count->get_result()->fetch_assoc()['total'];
$query = $conn->prepare('SELECT id, name, email, phone, subject, message, status, created_at FROM contact_submissions' . $filterSql . ' ORDER BY created_at DESC LIMIT ? OFFSET ?');
if ($status === 'all') {
    $query->bind_param('ii', $perPage, $offset);
} else {
    $query->bind_param('sii', $status, $perPage, $offset);
}
$query->execute();
$messages = $query->get_result()->fetch_all(MYSQLI_ASSOC);
$GLOBALS['adminUnreadCount'] = (int) $conn->query("SELECT COUNT(*) AS count FROM contact_submissions WHERE status = 'new'")->fetch_assoc()['count'];
$selected = filter_var($_GET['view'] ?? null, FILTER_VALIDATE_INT);
$message = null;
if ($selected) {
    $detail = $conn->prepare('SELECT * FROM contact_submissions WHERE id = ? LIMIT 1');
    $detail->bind_param('i', $selected);
    $detail->execute();
    $message = $detail->get_result()->fetch_assoc() ?: null;
}

adminPageStart('Messages', 'contact-submissions.php', 'Read and organize messages sent through the public contact form.');
adminPageHeading('Contact inbox', 'Review visitor questions and keep track of follow-up.');
adminShowFlash();
if ($error !== ''): ?><div class="admin-alert error" role="alert"><?= adminEscape($error); ?></div><?php endif; ?>

<?php if ($message): ?>
    <section class="admin-card" style="margin-bottom:20px">
        <div class="admin-toolbar">
            <h2 class="admin-card-title" style="margin:0"><?= adminEscape($message['subject'] ?: 'Message details'); ?></h2>
            <a class="admin-btn secondary small" href="./contact-submissions.php?status=<?= rawurlencode($status); ?>">Close</a>
        </div>
        <div class="admin-grid two">
            <p><strong>From:</strong> <?= adminEscape($message['name']); ?> &lt;<?= adminEscape($message['email']); ?>&gt;</p>
            <p><strong>Phone:</strong> <?= adminEscape($message['phone'] ?: 'Not provided'); ?></p>
            <p><strong>Received:</strong> <?= adminEscape($message['created_at']); ?></p>
            <p><strong>Status:</strong> <?= adminEscape(ucfirst($message['status'])); ?></p>
        </div>
        <div class="admin-card" style="margin-top:15px;background:#f8f9fc"><div class="admin-prose"><?= adminEscape($message['message']); ?></div></div>
        <div class="admin-form-actions">
            <a class="admin-btn" href="mailto:<?= adminEscape(rawurlencode($message['email'])); ?>?subject=<?= adminEscape(rawurlencode('Re: ' . ($message['subject'] ?: 'Your enquiry'))); ?>"><i class="fa-solid fa-reply"></i> Reply by email</a>
            <?php foreach (['read' => 'Mark read', 'replied' => 'Mark replied', 'archived' => 'Archive'] as $value => $label): ?>
                <form method="POST" class="admin-inline-form"><?php adminCsrfField(); ?><input type="hidden" name="action" value="status"><input type="hidden" name="id" value="<?= (int) $message['id']; ?>"><input type="hidden" name="status" value="<?= adminEscape($value); ?>"><button class="admin-btn secondary" type="submit"><?= adminEscape($label); ?></button></form>
            <?php endforeach; ?>
        </div>
    </section>
<?php endif; ?>

<section class="admin-card">
    <div class="admin-toolbar">
        <h2 class="admin-card-title" style="margin:0">Messages <span class="admin-badge"><?= $total; ?></span></h2>
        <div class="admin-actions">
            <a class="admin-btn secondary small" href="?status=<?= rawurlencode($status); ?>&amp;export=csv"><i class="fa-solid fa-download"></i> Export CSV</a>
            <form method="GET" class="admin-field" style="display:flex;align-items:center;gap:8px">
                <label for="status-filter" class="admin-muted" style="font-size:12px">Filter</label>
                <select id="status-filter" name="status" onchange="this.form.submit()" style="min-height:36px;padding:7px 10px;border:1px solid var(--admin-line);border-radius:8px;background:#fff">
                    <?php foreach (['all' => 'All messages', 'new' => 'New', 'read' => 'Read', 'replied' => 'Replied', 'archived' => 'Archived'] as $value => $label): ?><option value="<?= adminEscape($value); ?>" <?= $status === $value ? 'selected' : ''; ?>><?= adminEscape($label); ?></option><?php endforeach; ?>
                </select>
            </form>
        </div>
    </div>
    <?php if (!$messages): ?>
        <div class="admin-empty"><i class="fa-regular fa-envelope-open"></i><strong>No messages here</strong><p>Messages from your website contact form will appear in this inbox.</p></div>
    <?php else: ?>
        <div class="admin-table-wrap"><table class="admin-table">
            <thead><tr><th>Sender</th><th>Subject / message</th><th>Received</th><th>Status</th><th>Actions</th></tr></thead>
            <tbody><?php foreach ($messages as $item): ?><tr>
                <td><strong><?= adminEscape($item['name']); ?></strong><br><span class="admin-muted"><?= adminEscape($item['email']); ?></span></td>
                <td><?= adminEscape($item['subject'] ?: 'No subject'); ?><br><span class="admin-muted"><?= adminEscape(mb_strimwidth($item['message'], 0, 75, '…')); ?></span></td>
                <td><?= adminEscape(date('M j, Y', strtotime($item['created_at']))); ?></td>
                <td><span class="admin-badge <?= $item['status'] === 'new' ? 'warning' : 'success'; ?>"><?= adminEscape(ucfirst($item['status'])); ?></span></td>
                <td><div class="admin-actions">
                    <a class="admin-btn secondary small" href="?status=<?= rawurlencode($status); ?>&amp;view=<?= (int) $item['id']; ?>"><i class="fa-solid fa-eye"></i> Open</a>
                    <form method="POST" class="admin-inline-form" onsubmit="return confirm('Permanently delete this message?');"><?php adminCsrfField(); ?><input type="hidden" name="action" value="delete"><input type="hidden" name="id" value="<?= (int) $item['id']; ?>"><button class="admin-btn danger small" type="submit" aria-label="Delete message"><i class="fa-solid fa-trash"></i></button></form>
                </div></td>
            </tr><?php endforeach; ?></tbody>
        </table></div>
        <div class="admin-pagination"><span>Showing <?= $offset + 1; ?>–<?= $offset + count($messages); ?> of <?= $total; ?></span><span>
            <?php if ($page > 1): ?><a class="admin-btn secondary small" href="?status=<?= rawurlencode($status); ?>&amp;page=<?= $page - 1; ?>">Previous</a><?php endif; ?>
            <?php if ($offset + count($messages) < $total): ?><a class="admin-btn secondary small" href="?status=<?= rawurlencode($status); ?>&amp;page=<?= $page + 1; ?>">Next</a><?php endif; ?>
        </span></div>
    <?php endif; ?>
</section>
<?php adminPageEnd(); ?>
