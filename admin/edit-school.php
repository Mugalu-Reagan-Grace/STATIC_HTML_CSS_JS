<?php
require_once __DIR__ . '/cms_helpers.php';

$settingsFields = [
    'school_name' => ['label' => 'School name', 'type' => 'text', 'required' => true, 'max' => 100],
    'school_motto' => ['label' => 'School motto', 'type' => 'text', 'required' => true, 'max' => 150],
    'school_phone_1' => ['label' => 'Primary phone', 'type' => 'text', 'max' => 30],
    'school_phone_2' => ['label' => 'Secondary phone', 'type' => 'text', 'max' => 30],
    'school_email' => ['label' => 'Public email', 'type' => 'email', 'max' => 100],
    'school_address' => ['label' => 'Address', 'type' => 'text', 'max' => 255],
    'facebook_url' => ['label' => 'Facebook URL', 'type' => 'url', 'max' => 255],
    'instagram_url' => ['label' => 'Instagram URL', 'type' => 'url', 'max' => 255],
    'youtube_url' => ['label' => 'YouTube URL', 'type' => 'url', 'max' => 255],
];
$dynamicGroups = [
    'contact_phones' => ['title' => 'Phone numbers', 'label' => 'Phone number', 'item_label' => 'Label', 'item_value' => 'Number', 'value_type' => 'text'],
    'contact_emails' => ['title' => 'Email addresses', 'label' => 'Email address', 'item_label' => 'Label', 'item_value' => 'Email', 'value_type' => 'email'],
    'contact_addresses' => ['title' => 'Addresses and locations', 'label' => 'Address', 'item_label' => 'Label', 'item_value' => 'Address', 'value_type' => 'text'],
    'school_hours' => ['title' => 'Opening hours', 'label' => 'Opening hours', 'item_label' => 'Label', 'item_value' => 'Hours', 'value_type' => 'text'],
    'social_profiles' => ['title' => 'Additional social profiles', 'label' => 'Social profile', 'item_label' => 'Platform', 'item_value' => 'Profile URL', 'value_type' => 'url'],
];
$settings = [];
$dynamic = [];
$result = $conn->query('SELECT setting_key, setting_value FROM school_settings');
while ($row = $result->fetch_assoc()) {
    $settings[$row['setting_key']] = $row['setting_value'];
    if (isset($dynamicGroups[$row['setting_key']])) {
        $decoded = json_decode((string) $row['setting_value'], true);
        $dynamic[$row['setting_key']] = is_array($decoded) ? $decoded : [];
    }
}
foreach ($dynamicGroups as $key => $definition) {
    if (!isset($dynamic[$key])) {
        $dynamic[$key] = [['label' => '', 'value' => '']];
    }
}
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        adminRequirePost();
        $conn->begin_transaction();
        $save = $conn->prepare('INSERT INTO school_settings (setting_key, setting_value) VALUES (?, ?) ON DUPLICATE KEY UPDATE setting_value = VALUES(setting_value)');
        foreach ($settingsFields as $key => $field) {
            $value = adminValidateField($key, $_POST['setting_' . $key] ?? '', $field);
            $settings[$key] = $value;
            $save->bind_param('ss', $key, $value);
            $save->execute();
        }
        foreach ($dynamicGroups as $key => $definition) {
            $labels = $_POST[$key . '_label'] ?? [];
            $values = $_POST[$key . '_value'] ?? [];
            $items = [];
            if (is_array($labels) && is_array($values)) {
                foreach ($labels as $index => $label) {
                    $cleanLabel = is_string($label) ? trim($label) : '';
                    $cleanValue = is_string($values[$index] ?? null) ? trim($values[$index]) : '';
                    if ($cleanLabel !== '' && $cleanValue !== '') {
                        if ($definition['value_type'] === 'email' && !filter_var($cleanValue, FILTER_VALIDATE_EMAIL)) {
                            throw new RuntimeException('Enter a valid email address in ' . $definition['title'] . '.');
                        }
                        if ($definition['value_type'] === 'url' && !filter_var($cleanValue, FILTER_VALIDATE_URL)) {
                            throw new RuntimeException('Enter a valid URL in ' . $definition['title'] . '.');
                        }
                        $items[] = ['label' => $cleanLabel, 'value' => $cleanValue];
                    }
                }
            }
            $json = json_encode(array_values($items), JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
            if (!is_string($json)) {
                throw new RuntimeException('Unable to prepare ' . $definition['title'] . '.');
            }
            $dynamic[$key] = $items;
            $save->bind_param('ss', $key, $json);
            $save->execute();
        }
        $conn->commit();
        adminFlash('success', 'School settings saved.');
        header('Location: ./edit-school.php');
        exit;
    } catch (RuntimeException $exception) {
        if ($conn->errno || $conn->error) {
            $conn->rollback();
        }
        $error = $exception->getMessage();
        foreach ($settingsFields as $key => $field) {
            if (isset($_POST['setting_' . $key]) && is_string($_POST['setting_' . $key])) {
                $settings[$key] = $_POST['setting_' . $key];
            }
        }
    } catch (Throwable $exception) {
        $conn->rollback();
        error_log('School settings update failed: ' . $exception->getMessage());
        $error = 'Unable to save settings. Please try again.';
    }
}

$groups = [
    'School identity' => ['school_name', 'school_motto'],
    'Contact details' => ['school_phone_1', 'school_phone_2', 'school_email', 'school_address'],
    'Social profiles' => ['facebook_url', 'instagram_url', 'youtube_url'],
];

adminPageStart('School settings', 'edit-school.php', 'Manage the public contact information for your school.');
adminPageHeading('School settings', 'Keep the school identity, contact details, and social links up to date.');
adminShowFlash();
if ($error !== ''): ?><div class="admin-alert error" role="alert"><?= adminEscape($error); ?></div><?php endif; ?>
<form class="admin-card" method="POST">
    <?php adminCsrfField(); ?>
    <?php foreach ($groups as $groupTitle => $keys): ?>
        <section<?= $groupTitle !== 'School identity' ? ' style="margin-top:24px;padding-top:22px;border-top:1px solid var(--admin-line)"' : ''; ?>>
            <h2 class="admin-card-title"><?= adminEscape($groupTitle); ?></h2>
            <div class="admin-form-grid">
                <?php foreach ($keys as $key): $field = $settingsFields[$key]; ?>
                    <div class="admin-field">
                        <label for="setting-<?= adminEscape($key); ?>"><?= adminEscape($field['label']); ?></label>
                        <input id="setting-<?= adminEscape($key); ?>" type="<?= adminEscape($field['type']); ?>" name="setting_<?= adminEscape($key); ?>" value="<?= adminEscape($settings[$key] ?? ''); ?>" <?= !empty($field['required']) ? 'required' : ''; ?> maxlength="<?= (int) ($field['max'] ?? 255); ?>">
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
    <?php endforeach; ?>
    <?php foreach ($dynamicGroups as $key => $definition): ?>
        <section style="margin-top:24px;padding-top:22px;border-top:1px solid var(--admin-line)" data-repeatable-group data-value-type="<?= adminEscape($definition['value_type']); ?>">
            <div class="admin-toolbar">
                <h2 class="admin-card-title" style="margin:0"><?= adminEscape($definition['title']); ?></h2>
                <button class="admin-btn secondary small" type="button" data-add-row="<?= adminEscape($key); ?>"><i class="fa-solid fa-plus"></i> Add <?= adminEscape($definition['label']); ?></button>
            </div>
            <div class="admin-repeatable" data-repeatable="<?= adminEscape($key); ?>">
                <?php $items = $dynamic[$key] ?: [['label' => '', 'value' => '']]; ?>
                <?php foreach ($items as $item): ?>
                    <div class="admin-form-grid" data-repeatable-row style="margin-bottom:12px">
                        <div class="admin-field">
                            <label><?= adminEscape($definition['item_label']); ?></label>
                            <input type="text" name="<?= adminEscape($key); ?>_label[]" value="<?= adminEscape($item['label'] ?? ''); ?>" maxlength="100" placeholder="<?= adminEscape($definition['item_label']); ?>">
                        </div>
                        <div class="admin-field">
                            <label><?= adminEscape($definition['item_value']); ?></label>
                            <div style="display:flex;gap:8px">
                                <input type="<?= adminEscape($definition['value_type']); ?>" name="<?= adminEscape($key); ?>_value[]" value="<?= adminEscape($item['value'] ?? ''); ?>" maxlength="255" placeholder="<?= adminEscape($definition['item_value']); ?>" style="min-width:0">
                                <button class="admin-btn danger small" type="button" data-remove-row aria-label="Remove row"><i class="fa-solid fa-trash"></i></button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </section>
    <?php endforeach; ?>
    <div class="admin-form-actions"><button class="admin-btn" type="submit"><i class="fa-solid fa-floppy-disk"></i> Save settings</button></div>
</form>
<template id="repeatable-row-template">
    <div class="admin-form-grid" data-repeatable-row style="margin-bottom:12px">
        <div class="admin-field"><label>Label</label><input type="text" name="LABEL_NAME_label[]" value="" maxlength="100"></div>
        <div class="admin-field"><label>Value</label><div style="display:flex;gap:8px"><input type="VALUE_TYPE" name="LABEL_NAME_value[]" value="" maxlength="255" style="min-width:0"><button class="admin-btn danger small" type="button" data-remove-row aria-label="Remove row"><i class="fa-solid fa-trash"></i></button></div></div>
    </div>
</template>
<script>
document.querySelectorAll("[data-add-row]").forEach((button) => {
    button.addEventListener("click", () => {
        const key = button.dataset.addRow;
        const container = document.querySelector(`[data-repeatable="${key}"]`);
        const template = document.getElementById("repeatable-row-template");
        const row = template.content.firstElementChild.cloneNode(true);
        const group = container.closest("[data-repeatable-group]");
        const valueType = group.dataset.valueType || "text";
        row.querySelectorAll("input").forEach((input) => {
            if (input.name.includes("LABEL_NAME")) input.name = input.name.replace("LABEL_NAME", key);
        });
        row.querySelectorAll('input[name$="_value[]"]').forEach((input) => { input.type = valueType; });
        container.appendChild(row);
    });
});
document.addEventListener("click", (event) => {
    const remove = event.target.closest("[data-remove-row]");
    if (!remove) return;
    const row = remove.closest("[data-repeatable-row]");
    row?.remove();
});
</script>
<?php adminPageEnd(); ?>
