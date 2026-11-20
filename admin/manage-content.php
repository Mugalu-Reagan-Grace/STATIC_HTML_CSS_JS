<?php
require_once __DIR__ . '/cms_helpers.php';

$resources = [
    'news' => [
        'table' => 'news_events', 'key' => 'id', 'title' => 'News & events',
        'description' => 'Publish school announcements and upcoming events.',
        'singular' => 'news item', 'icon' => 'fa-newspaper', 'active' => 'manage-news.php',
        'columns' => ['title' => 'Title', 'category' => 'Type', 'event_date' => 'Event date', 'is_published' => 'Status'],
        'fields' => [
            'title' => ['label' => 'Title', 'type' => 'text', 'required' => true, 'max' => 200],
            'category' => ['label' => 'Type', 'type' => 'select', 'options' => ['news', 'event'], 'required' => true],
            'description' => ['label' => 'Description', 'type' => 'textarea'],
            'event_date' => ['label' => 'Event date', 'type' => 'date'],
            'event_time' => ['label' => 'Event time', 'type' => 'time'],
            'featured_image' => ['label' => 'Featured image URL', 'type' => 'image_path', 'upload' => true],
            'featured_image_alt' => ['label' => 'Featured image description (alt text)', 'type' => 'text', 'max' => 255],
            'is_published' => ['label' => 'Publish on website', 'type' => 'checkbox'],
        ],
        'order' => 'created_at DESC',
    ],
    'staff' => [
        'table' => 'staff', 'key' => 'id', 'title' => 'Staff directory',
        'description' => 'Manage staff profiles and the order they appear in.',
        'singular' => 'staff profile', 'icon' => 'fa-users', 'active' => 'manage-staff.php',
        'columns' => ['full_name' => 'Name', 'title' => 'Role', 'email' => 'Email', 'display_order' => 'Order', 'is_active' => 'Status'],
        'fields' => [
            'full_name' => ['label' => 'Full name', 'type' => 'text', 'required' => true, 'max' => 100],
            'title' => ['label' => 'Job title', 'type' => 'text', 'required' => true, 'max' => 100],
            'email' => ['label' => 'Email', 'type' => 'email', 'max' => 100],
            'phone' => ['label' => 'Phone', 'type' => 'text', 'max' => 20],
            'bio' => ['label' => 'Biography', 'type' => 'textarea'],
            'photo_url' => ['label' => 'Photo URL', 'type' => 'image_path', 'upload' => true],
            'photo_alt' => ['label' => 'Photo description (alt text)', 'type' => 'text', 'max' => 255],
            'display_order' => ['label' => 'Display order', 'type' => 'number'],
            'is_active' => ['label' => 'Show on website', 'type' => 'checkbox'],
        ],
        'order' => 'display_order ASC, full_name ASC',
    ],
    'gallery' => [
        'table' => 'gallery', 'key' => 'id', 'title' => 'Photo gallery',
        'description' => 'Upload and organize school photos. JPG, PNG, and WebP files up to 5 MB are supported.',
        'singular' => 'gallery image', 'icon' => 'fa-images', 'active' => 'manage-gallery.php',
        'columns' => ['image_url' => 'Photo', 'title' => 'Title', 'category' => 'Category', 'is_active' => 'Status'],
        'fields' => [
            'title' => ['label' => 'Photo title', 'type' => 'text', 'required' => true, 'max' => 200],
            'description' => ['label' => 'Description', 'type' => 'textarea'],
            'image_url' => ['label' => 'Image path or URL', 'type' => 'image_path', 'required' => true, 'upload' => true],
            'image_alt' => ['label' => 'Image description (alt text)', 'type' => 'text', 'required' => true, 'max' => 255],
            'category' => ['label' => 'Category', 'type' => 'text', 'max' => 50],
            'display_order' => ['label' => 'Display order', 'type' => 'number'],
            'is_active' => ['label' => 'Show on website', 'type' => 'checkbox'],
        ],
        'order' => 'display_order ASC, created_at DESC',
    ],
    'testimonials' => [
        'table' => 'testimonials', 'key' => 'id', 'title' => 'Testimonials',
        'description' => 'Manage parent, student, and community testimonials.',
        'singular' => 'testimonial', 'icon' => 'fa-quote-left', 'active' => 'manage-testimonials.php',
        'columns' => ['author_name' => 'Author', 'author_title' => 'Relationship', 'testimonial_text' => 'Testimonial', 'is_published' => 'Status'],
        'fields' => [
            'author_name' => ['label' => 'Author name', 'type' => 'text', 'required' => true, 'max' => 100],
            'author_title' => ['label' => 'Relationship or title', 'type' => 'text', 'max' => 100],
            'testimonial_text' => ['label' => 'Testimonial', 'type' => 'textarea', 'required' => true],
            'is_published' => ['label' => 'Publish on website', 'type' => 'checkbox'],
        ],
        'order' => 'created_at DESC',
    ],
    'fees' => [
        'table' => 'fees', 'key' => 'id', 'title' => 'School fees',
        'description' => 'Maintain fee amounts and optional charges for each class.',
        'singular' => 'fee record', 'icon' => 'fa-money-bill-wave', 'active' => 'manage-fees.php',
        'columns' => ['class_name' => 'Class', 'tuition_amount' => 'Tuition', 'activity_fee' => 'Activities', 'transport_fee' => 'Transport', 'is_active' => 'Status'],
        'fields' => [
            'class_name' => ['label' => 'Class or level', 'type' => 'text', 'required' => true, 'max' => 100],
            'tuition_amount' => ['label' => 'Tuition amount (UGX)', 'type' => 'number', 'required' => true],
            'activity_fee' => ['label' => 'Activity fee (UGX)', 'type' => 'number'],
            'transport_fee' => ['label' => 'Transport fee (UGX)', 'type' => 'number'],
            'other_fees' => ['label' => 'Other fees or notes', 'type' => 'textarea'],
            'is_active' => ['label' => 'Show on website', 'type' => 'checkbox'],
        ],
        'order' => 'class_name ASC',
    ],
    'pages' => [
        'table' => 'pages_content', 'key' => 'id', 'title' => 'Page content',
        'description' => 'Create and maintain page copy and search metadata in the CMS.',
        'singular' => 'page', 'icon' => 'fa-file-lines', 'active' => 'edit-pages.php',
        'columns' => ['page_title' => 'Page title', 'page_slug' => 'Page key', 'meta_description' => 'Search description', 'updated_at' => 'Last updated'],
        'fields' => [
            'page_slug' => ['label' => 'Page key (for example: about)', 'type' => 'slug', 'required' => true, 'max' => 50],
            'page_title' => ['label' => 'Page title', 'type' => 'text', 'required' => true, 'max' => 200],
            'page_content' => ['label' => 'Page copy', 'type' => 'textarea'],
            'meta_description' => ['label' => 'Search description', 'type' => 'textarea', 'max' => 160],
            'meta_keywords' => ['label' => 'Search keywords', 'type' => 'text', 'max' => 200],
        ],
        'order' => 'page_title ASC',
    ],
];

$resourceKey = $_GET['type'] ?? ($resource ?? 'news');
if (!is_string($resourceKey) || !isset($resources[$resourceKey])) {
    http_response_code(404);
    exit('Content type not found.');
}
$resource = $resources[$resourceKey];
$table = $resource['table'];
$keyColumn = $resource['key'];
$fields = $resource['fields'];
$error = '';
$formData = [];
$createdUploads = [];
$imageColumn = isset($fields['image_url']) ? 'image_url' : (isset($fields['photo_url']) ? 'photo_url' : (isset($fields['featured_image']) ? 'featured_image' : null));
$originalImage = null;
$editing = isset($_GET['edit']) && ctype_digit((string) $_GET['edit']) ? (int) $_GET['edit'] : 0;

if ($editing > 0) {
    $select = $conn->prepare("SELECT * FROM `{$table}` WHERE `{$keyColumn}` = ? LIMIT 1");
    $select->bind_param('i', $editing);
    $select->execute();
    $formData = $select->get_result()->fetch_assoc() ?: [];
    if (!$formData) {
        $editing = 0;
        adminFlash('error', ucfirst($resource['singular']) . ' not found.');
        header('Location: ./' . $resource['active']);
        exit;
    }
    if ($imageColumn !== null) {
        $originalImage = $formData[$imageColumn] ?? null;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        adminRequirePost();
        $action = $_POST['action'] ?? '';
        $recordId = filter_var($_POST['id'] ?? 0, FILTER_VALIDATE_INT);

        if ($action === 'delete' && $recordId && $recordId > 0) {
            $oldImage = null;
            if ($imageColumn !== null) {
                $old = $conn->prepare("SELECT `{$imageColumn}` FROM `{$table}` WHERE `{$keyColumn}` = ? LIMIT 1");
                $old->bind_param('i', $recordId);
                $old->execute();
                $oldRecord = $old->get_result()->fetch_assoc();
                $oldImage = $oldRecord[$imageColumn] ?? null;
            }
            $delete = $conn->prepare("DELETE FROM `{$table}` WHERE `{$keyColumn}` = ?");
            $delete->bind_param('i', $recordId);
            $delete->execute();
            if ($delete->affected_rows !== 1) {
                throw new RuntimeException('The record could not be found or deleted.');
            }
            adminDeleteUploadedImage($oldImage);
            adminFlash('success', ucfirst($resource['singular']) . ' deleted.');
            header('Location: ./' . $resource['active']);
            exit;
        }

        if ($action !== 'save') {
            throw new RuntimeException('Choose a valid action.');
        }

        $formData = [];
        $columns = [];
        $values = [];
        foreach ($fields as $name => $field) {
            if ($field['type'] === 'upload') {
                continue;
            }

            if ($field['type'] === 'checkbox') {
                $value = isset($_POST[$name]) ? 1 : 0;
                $formData[$name] = $value;
            } elseif (!empty($field['upload'])) {
                $rawPath = $_POST[$name] ?? '';
                if (!is_string($rawPath)) {
                    throw new RuntimeException($field['label'] . ' is invalid.');
                }
                $rawPath = trim($rawPath);
                $path = adminUploadImage('image_file', $rawPath !== '' ? $rawPath : ($formData[$name] ?? null));
                if (isset($_FILES['image_file']) && $_FILES['image_file']['error'] === UPLOAD_ERR_OK) {
                    $createdUploads[] = $path;
                }
                if ($path !== null && $path !== '') {
                    if (
                        !(filter_var($path, FILTER_VALIDATE_URL) && preg_match('~\Ahttps?://~i', $path)) &&
                        !preg_match('~\A(?:ASSETS/images|uploads/cms)/[A-Za-z0-9._% /-]+\.(?:jpe?g|png|webp|gif)\z~i', $path)
                    ) {
                        throw new RuntimeException($field['label'] . ' must be a valid URL or a project image path.');
                    }
                }
                $value = (string) $path;
                if (!empty($field['required']) && $value === '') {
                    throw new RuntimeException('Upload an image or enter an image path.');
                }
                $formData[$name] = $value;
            } else {
                $value = adminValidateField($name, $_POST[$name] ?? '', $field);
                $formData[$name] = $value;
            }

            if (in_array($field['type'], ['number', 'date', 'time'], true) && $value === '') {
                $value = $name === 'display_order' ? '0' : null;
                $formData[$name] = '';
            }
            $columns[] = $name;
            $values[] = $value;
        }

        if ($resourceKey === 'pages') {
            if (!preg_match('/\A[a-z0-9]+(?:-[a-z0-9]+)*\z/', $formData['page_slug'])) {
                throw new RuntimeException('Use lowercase letters, numbers, and hyphens for the page key.');
            }
            if (strlen($formData['meta_description']) > 160) {
                throw new RuntimeException('Search description must be at most 160 characters.');
            }
        }

        if ($resourceKey === 'news') {
            if (!in_array($formData['category'], ['news', 'event'], true)) {
                throw new RuntimeException('Choose news or event.');
            }
        }

        if ($editing > 0 && $resourceKey === 'pages') {
            $columns[] = 'updated_by';
            $values[] = (int) $_SESSION['admin_id'];
        } elseif ($resourceKey === 'news') {
            $columns[] = 'created_by';
            $values[] = (int) $_SESSION['admin_id'];
        } elseif ($resourceKey === 'pages') {
            $columns[] = 'updated_by';
            $values[] = (int) $_SESSION['admin_id'];
        }

        $escapedColumns = array_map(static fn($column) => '`' . $column . '`', $columns);
        $types = str_repeat('s', count($values));
        $values = array_map(static fn($value) => $value === null ? null : (string) $value, $values);

        if ($editing > 0) {
            $assignments = implode(', ', array_map(static fn($column) => '`' . $column . '` = ?', $columns));
            $sql = "UPDATE `{$table}` SET {$assignments} WHERE `{$keyColumn}` = ?";
            $values[] = (string) $editing;
            $types .= 's';
        } else {
            $placeholders = implode(', ', array_fill(0, count($values), '?'));
            $sql = "INSERT INTO `{$table}` (" . implode(', ', $escapedColumns) . ") VALUES ({$placeholders})";
        }

        $save = $conn->prepare($sql);
        $references = [];
        foreach ($values as $index => &$value) {
            $references[$index] = &$value;
        }
        unset($value);
        $save->bind_param($types, ...$references);
        $save->execute();

        $message = ucfirst($resource['singular']) . ($editing > 0 ? ' updated.' : ' created.');
        $flashType = 'success';
        if ($editing > 0 && $originalImage && $imageColumn !== null && $formData[$imageColumn] !== $originalImage) {
            try {
                adminDeleteUploadedImage($originalImage);
            } catch (Throwable $cleanupException) {
                error_log('Admin content image cleanup failed for ' . $resourceKey . ': ' . $cleanupException->getMessage());
                $message .= ' The previous uploaded image could not be removed.';
                $flashType = 'error';
            }
        }
        adminFlash($flashType, $message);
        header('Location: ./' . $resource['active']);
        exit;
    } catch (mysqli_sql_exception $exception) {
        foreach ($createdUploads as $uploadedPath) {
            try {
                adminDeleteUploadedImage($uploadedPath);
            } catch (Throwable $cleanupException) {
                error_log('Admin content upload cleanup failed for ' . $resourceKey . ': ' . $cleanupException->getMessage());
            }
        }
        error_log('Admin content save failed for ' . $resourceKey . ': ' . $exception->getMessage());
        $error = 'Unable to save this record. Check the information and try again.';
        if (isset($_POST['id']) && ctype_digit((string) $_POST['id'])) {
            $editing = (int) $_POST['id'];
        }
        foreach ($fields as $name => $field) {
            if ($field['type'] === 'checkbox') {
                $formData[$name] = isset($_POST[$name]) ? 1 : 0;
            } elseif (isset($_POST[$name]) && is_string($_POST[$name])) {
                $formData[$name] = $_POST[$name];
            }
        }
    } catch (RuntimeException $exception) {
        foreach ($createdUploads as $uploadedPath) {
            try {
                adminDeleteUploadedImage($uploadedPath);
            } catch (Throwable $cleanupException) {
                error_log('Admin content upload cleanup failed for ' . $resourceKey . ': ' . $cleanupException->getMessage());
            }
        }
        $error = $exception->getMessage();
        if (isset($_POST['id']) && ctype_digit((string) $_POST['id'])) {
            $editing = (int) $_POST['id'];
        }
        foreach ($fields as $name => $field) {
            if ($field['type'] === 'checkbox') {
                $formData[$name] = isset($_POST[$name]) ? 1 : 0;
            } elseif (isset($_POST[$name]) && is_string($_POST[$name])) {
                $formData[$name] = $_POST[$name];
            }
        }
    } catch (Throwable $exception) {
        foreach ($createdUploads as $uploadedPath) {
            try {
                adminDeleteUploadedImage($uploadedPath);
            } catch (Throwable $cleanupException) {
                error_log('Admin content upload cleanup failed for ' . $resourceKey . ': ' . $cleanupException->getMessage());
            }
        }
        error_log('Admin content save failed for ' . $resourceKey . ': ' . $exception->getMessage());
        $error = 'Unable to save this record. Check the information and try again.';
    }
}

$searchInput = $_GET['q'] ?? '';
$search = is_string($searchInput) ? trim($searchInput) : '';
$page = max(1, (int) ($_GET['page'] ?? 1));
$perPage = 20;
$offset = ($page - 1) * $perPage;
$searchColumns = array_keys($resource['columns']);
$where = '';
$params = [];
$types = '';
if ($search !== '' && $searchColumns) {
    $parts = [];
    foreach ($searchColumns as $column) {
        $parts[] = "`{$column}` LIKE ?";
        $params[] = '%' . $search . '%';
        $types .= 's';
    }
    $where = ' WHERE (' . implode(' OR ', $parts) . ')';
}
$countQuery = $conn->prepare("SELECT COUNT(*) AS total FROM `{$table}`{$where}");
if ($params) {
    $references = [];
    foreach ($params as $index => &$value) {
        $references[$index] = &$value;
    }
    unset($value);
    $countQuery->bind_param($types, ...$references);
}
$countQuery->execute();
$total = (int) $countQuery->get_result()->fetch_assoc()['total'];
$selectColumns = array_unique(array_merge([$keyColumn], array_keys($resource['columns'])));
$listSql = "SELECT " . implode(', ', array_map(static fn($column) => "`{$column}`", $selectColumns)) . " FROM `{$table}`{$where} ORDER BY {$resource['order']} LIMIT ? OFFSET ?";
$list = $conn->prepare($listSql);
$listValues = $params;
$listTypes = $types;
$listValues[] = (string) $perPage;
$listValues[] = (string) $offset;
$listTypes .= 'ss';
if ($listValues) {
    $references = [];
    foreach ($listValues as $index => &$value) {
        $references[$index] = &$value;
    }
    unset($value);
    $list->bind_param($listTypes, ...$references);
}
$list->execute();
$rows = $list->get_result()->fetch_all(MYSQLI_ASSOC);

adminPageStart($resource['title'], $resource['active'], $resource['description']);
adminPageHeading($resource['title'], $resource['description']);
adminShowFlash();
if ($error !== ''):
    ?>
    <div class="admin-alert error" role="alert"><?= adminEscape($error); ?></div>
<?php endif; ?>
<section class="admin-card" id="editor">
    <h2 class="admin-card-title"><span><i class="fa-solid <?= adminEscape($resource['icon']); ?>"></i> <?= $editing > 0 ? 'Edit' : 'Add'; ?> <?= adminEscape($resource['singular']); ?></span>
        <?php if ($editing > 0): ?><a class="admin-btn secondary small" href="./<?= adminEscape($resource['active']); ?>">Cancel edit</a><?php endif; ?>
    </h2>
    <p class="admin-form-note">Fields marked <strong>*</strong> are required.</p>
    <form method="POST" enctype="multipart/form-data">
        <?php adminCsrfField(); ?>
        <input type="hidden" name="action" value="save">
        <?php if ($editing > 0): ?><input type="hidden" name="id" value="<?= $editing; ?>"><?php endif; ?>
        <div class="admin-form-grid">
            <?php foreach ($fields as $name => $field): ?>
                <?php
                $type = $field['type'];
                if ($type === 'upload') {
                    continue;
                }
                $value = $formData[$name] ?? ($type === 'checkbox' ? ($name === 'is_published' ? 0 : 1) : '');
                $full = $type === 'textarea' || $type === 'image_path';
                ?>
                <div class="admin-field<?= $full ? ' full' : ''; ?>">
                    <?php if ($type === 'checkbox'): ?>
                        <label class="admin-check"><input type="checkbox" name="<?= adminEscape($name); ?>" value="1" <?= !empty($value) ? 'checked' : ''; ?>> <?= adminEscape($field['label']); ?></label>
                        <?php if ($name === 'is_published'): ?><small class="admin-help">Leave unchecked to save as a draft. Published items appear on the website.</small><?php endif; ?>
                    <?php else: ?>
                        <label for="field-<?= adminEscape($name); ?>"><?= adminEscape($field['label']); ?><?= !empty($field['required']) ? ' *' : ''; ?></label>
                        <?php if ($type === 'textarea'): ?>
                            <textarea id="field-<?= adminEscape($name); ?>" name="<?= adminEscape($name); ?>" <?= !empty($field['required']) ? 'required' : ''; ?> <?= isset($field['max']) ? 'maxlength="' . (int) $field['max'] . '"' : ''; ?>><?= adminEscape($value); ?></textarea>
                        <?php elseif ($type === 'select'): ?>
                            <select id="field-<?= adminEscape($name); ?>" name="<?= adminEscape($name); ?>" required>
                                <?php foreach ($field['options'] as $option): ?><option value="<?= adminEscape($option); ?>" <?= $value === $option ? 'selected' : ''; ?>><?= adminEscape(ucfirst($option)); ?></option><?php endforeach; ?>
                            </select>
                        <?php elseif ($type === 'slug'): ?>
                            <input id="field-<?= adminEscape($name); ?>" type="text" name="<?= adminEscape($name); ?>" value="<?= adminEscape($value); ?>" pattern="[a-z0-9]+(?:-[a-z0-9]+)*" <?= !empty($field['required']) ? 'required' : ''; ?> maxlength="<?= (int) $field['max']; ?>">
                        <?php else: ?>
                            <input id="field-<?= adminEscape($name); ?>" type="<?= $type === 'image_path' ? 'text' : adminEscape($type); ?>" name="<?= adminEscape($name); ?>" value="<?= adminEscape($value); ?>" <?= !empty($field['required']) && empty($field['upload']) ? 'required' : ''; ?> <?= isset($field['max']) ? 'maxlength="' . (int) $field['max'] . '"' : ''; ?>>
                        <?php endif; ?>
                        <?php if (!empty($field['upload'])): ?>
                            <?php if ($value !== ''): ?><div style="display:flex;align-items:center;gap:12px;margin-top:10px"><img class="admin-preview-image" src="<?= adminEscape(adminImageUrl((string) $value)); ?>" alt="Current image"><span class="admin-muted" style="font-size:12px">Current image</span></div><?php endif; ?>
                            <label for="image-file" style="margin-top:12px">Or upload a new image</label>
                            <input id="image-file" type="file" name="image_file" accept="image/jpeg,image/png,image/webp">
                            <small class="admin-help">Maximum 5 MB; JPG, PNG, or WebP.</small>
                        <?php endif; ?>
                        <?php if ($type === 'slug'): ?><small class="admin-help">A unique key used to identify this page in the CMS.</small><?php endif; ?>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="admin-form-actions"><button class="admin-btn" type="submit"><i class="fa-solid fa-floppy-disk"></i> Save <?= adminEscape($resource['singular']); ?></button></div>
    </form>
</section>

<section class="admin-card">
    <div class="admin-toolbar">
        <h2 class="admin-card-title" style="margin:0">All <?= adminEscape($resource['title']); ?> <span class="admin-badge"><?= $total; ?></span></h2>
        <form class="admin-search" method="GET" action="./<?= adminEscape($resource['active']); ?>">
            <label class="admin-field" style="display:block"><span class="admin-muted" style="display:block;margin-bottom:6px;font-size:11px">Search records</span>
                <input type="search" name="q" value="<?= adminEscape($search); ?>" placeholder="Search <?= adminEscape(strtolower($resource['title'])); ?>...">
            </label>
        </form>
    </div>
    <?php if (!$rows): ?>
        <div class="admin-empty" role="status">
            <i class="fa-regular <?= $search !== '' ? 'fa-magnifying-glass' : 'fa-folder-open'; ?>"></i>
            <?php if ($search !== ''): ?>
                <strong>No matching records</strong>
                <p>No <?= adminEscape(strtolower($resource['title'])); ?> match “<?= adminEscape($search); ?>”.</p>
                <a class="admin-btn secondary small" href="./<?= adminEscape($resource['active']); ?>">Clear search</a>
            <?php else: ?>
                <strong>No records yet</strong>
                <p>Add your first <?= adminEscape($resource['singular']); ?> using the form above.</p>
            <?php endif; ?>
        </div>
    <?php else: ?>
        <div class="admin-table-wrap">
            <table class="admin-table">
                <thead><tr><?php foreach ($resource['columns'] as $label): ?><th><?= adminEscape($label); ?></th><?php endforeach; ?><th>Actions</th></tr></thead>
                <tbody>
                <?php foreach ($rows as $row): ?>
                    <tr>
                        <?php foreach ($resource['columns'] as $column => $label): ?>
                            <td>
                                <?php if (in_array($column, ['is_active', 'is_published'], true)): ?>
                                    <?php
                                    $visible = !empty($row[$column]);
                                    $statusLabel = $column === 'is_published'
                                        ? ($visible ? 'Published' : 'Draft')
                                        : ($visible ? 'Visible' : 'Hidden');
                                    ?>
                                    <span class="admin-badge <?= $visible ? 'success' : 'warning'; ?>"><?= adminEscape($statusLabel); ?></span>
                                <?php elseif (in_array($column, ['image_url', 'photo_url', 'featured_image'], true) && $row[$column] !== ''): ?>
                                    <img class="admin-preview-image" src="<?= adminEscape(adminImageUrl((string) $row[$column])); ?>" alt="">
                                <?php elseif ($column === 'testimonial_text' || $column === 'page_content' || $column === 'meta_description'): ?>
                                    <?= adminEscape(mb_strimwidth((string) $row[$column], 0, 90, '…')); ?>
                                <?php else: ?>
                                    <?= adminEscape($row[$column] ?? '—'); ?>
                                <?php endif; ?>
                            </td>
                        <?php endforeach; ?>
                        <td><div class="admin-actions">
                            <a class="admin-btn secondary small" href="./<?= adminEscape($resource['active']); ?>?edit=<?= (int) $row[$keyColumn]; ?>#editor"><i class="fa-solid fa-pen"></i> Edit</a>
                            <form class="admin-inline-form" method="POST" onsubmit="return confirm('Delete this <?= adminEscape($resource['singular']); ?>? This cannot be undone.');">
                                <?php adminCsrfField(); ?>
                                <input type="hidden" name="action" value="delete"><input type="hidden" name="id" value="<?= (int) $row[$keyColumn]; ?>">
                                <button class="admin-btn danger small" type="submit"><i class="fa-solid fa-trash"></i> Delete</button>
                            </form>
                        </div></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="admin-pagination"><span>Showing <?= $offset + 1; ?>–<?= $offset + count($rows); ?> of <?= $total; ?></span>
            <span>
                <?php if ($page > 1): ?><a class="admin-btn secondary small" href="?page=<?= $page - 1; ?>&amp;q=<?= rawurlencode($search); ?>">Previous</a><?php endif; ?>
                <?php if ($offset + count($rows) < $total): ?><a class="admin-btn secondary small" href="?page=<?= $page + 1; ?>&amp;q=<?= rawurlencode($search); ?>">Next</a><?php endif; ?>
            </span>
        </div>
    <?php endif; ?>
</section>
<?php adminPageEnd(); ?>
