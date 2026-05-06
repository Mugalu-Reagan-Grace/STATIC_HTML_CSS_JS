<?php
require_once __DIR__ . '/config.php';
redirectIfNotAdmin();

$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($_POST as $key => $value) {
        if (str_starts_with($key, 'setting_')) {
            $setting_key = substr($key, 8);
            $setting_value = escapeSql($value);
            
            $stmt = $conn->prepare('INSERT INTO school_settings (setting_key, setting_value) VALUES (?, ?) ON DUPLICATE KEY UPDATE setting_value = ?');
            $stmt->bind_param('sss', $setting_key, $setting_value, $setting_value);
            
            if (!$stmt->execute()) {
                $error = 'Error updating settings';
            }
        }
    }
    if (!$error) {
        $success = 'Settings updated successfully!';
    }
}

// Get current settings
$settings = [];
$result = $conn->query('SELECT setting_key, setting_value FROM school_settings');
while ($row = $result->fetch_assoc()) {
    $settings[$row['setting_key']] = $row['setting_value'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit School Settings - Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f7fa;
            color: #333;
        }
        
        .container {
            margin-left: 250px;
            padding: 30px;
        }
        
        .header {
            display: flex;
            gap: 10px;
            align-items: center;
            margin-bottom: 30px;
        }
        
        .header a {
            padding: 10px 20px;
            background: #f0f0f0;
            border-radius: 5px;
            text-decoration: none;
            color: #333;
            transition: all 0.3s;
        }
        
        .header a:hover {
            background: #e0e0e0;
        }
        
        .card {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }
        
        .card h1 {
            margin-bottom: 30px;
            font-size: 24px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
        }
        
        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-family: inherit;
            font-size: 14px;
        }
        
        .form-group textarea {
            resize: vertical;
            min-height: 100px;
        }
        
        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }
        
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }
        
        .submit-btn {
            padding: 12px 30px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
            transition: transform 0.2s;
        }
        
        .submit-btn:hover {
            transform: translateY(-2px);
        }
        
        .alert {
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        
        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        
        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <a href="./dashboard.php"><i class="fas fa-arrow-left"></i> Back to Dashboard</a>
        </div>
        
        <div class="card">
            <h1><i class="fas fa-cog"></i> School Settings</h1>
            
            <?php if ($success): ?>
                <div class="alert alert-success"><?= $success; ?></div>
            <?php endif; ?>
            
            <?php if ($error): ?>
                <div class="alert alert-error"><?= $error; ?></div>
            <?php endif; ?>
            
            <form method="POST">
                <div class="form-row">
                    <div class="form-group">
                        <label for="setting_school_name">School Name</label>
                        <input type="text" id="setting_school_name" name="setting_school_name" value="<?= htmlspecialchars($settings['school_name'] ?? ''); ?>" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="setting_school_motto">School Motto</label>
                        <input type="text" id="setting_school_motto" name="setting_school_motto" value="<?= htmlspecialchars($settings['school_motto'] ?? ''); ?>" required>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="setting_school_phone_1">Phone 1</label>
                        <input type="tel" id="setting_school_phone_1" name="setting_school_phone_1" value="<?= htmlspecialchars($settings['school_phone_1'] ?? ''); ?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="setting_school_phone_2">Phone 2</label>
                        <input type="tel" id="setting_school_phone_2" name="setting_school_phone_2" value="<?= htmlspecialchars($settings['school_phone_2'] ?? ''); ?>">
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="setting_school_email">School Email</label>
                        <input type="email" id="setting_school_email" name="setting_school_email" value="<?= htmlspecialchars($settings['school_email'] ?? ''); ?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="setting_school_address">Address</label>
                        <input type="text" id="setting_school_address" name="setting_school_address" value="<?= htmlspecialchars($settings['school_address'] ?? ''); ?>">
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="setting_facebook_url">Facebook URL</label>
                    <input type="url" id="setting_facebook_url" name="setting_facebook_url" value="<?= htmlspecialchars($settings['facebook_url'] ?? ''); ?>" placeholder="https://facebook.com/...">
                </div>
                
                <div class="form-group">
                    <label for="setting_instagram_url">Instagram URL</label>
                    <input type="url" id="setting_instagram_url" name="setting_instagram_url" value="<?= htmlspecialchars($settings['instagram_url'] ?? ''); ?>" placeholder="https://instagram.com/...">
                </div>
                
                <div class="form-group">
                    <label for="setting_youtube_url">YouTube URL</label>
                    <input type="url" id="setting_youtube_url" name="setting_youtube_url" value="<?= htmlspecialchars($settings['youtube_url'] ?? ''); ?>" placeholder="https://youtube.com/...">
                </div>
                
                <button type="submit" class="submit-btn"><i class="fas fa-save"></i> Save Settings</button>
            </form>
        </div>
    </div>
</body>
</html>
