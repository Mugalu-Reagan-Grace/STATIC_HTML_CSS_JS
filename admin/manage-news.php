<?php
require_once __DIR__ . '/config.php';
redirectIfNotAdmin();

$success = '';
$error = '';
$admin_id = $_SESSION['admin_id'];

// Handle delete
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $stmt = $conn->prepare('DELETE FROM news_events WHERE id = ?');
    $stmt->bind_param('i', $id);
    if ($stmt->execute()) {
        $success = 'News/Event deleted successfully!';
    }
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = escapeSql($_POST['title'] ?? '');
    $description = escapeSql($_POST['description'] ?? '');
    $event_date = escapeSql($_POST['event_date'] ?? '');
    $event_time = escapeSql($_POST['event_time'] ?? '');
    $category = escapeSql($_POST['category'] ?? 'news');
    $is_published = isset($_POST['is_published']) ? 1 : 0;
    
    if (empty($title)) {
        $error = 'Title is required';
    } else {
        if (isset($_POST['id']) && !empty($_POST['id'])) {
            // Update
            $id = intval($_POST['id']);
            $stmt = $conn->prepare('UPDATE news_events SET title=?, description=?, event_date=?, event_time=?, category=?, is_published=? WHERE id=?');
            $stmt->bind_param('sssssii', $title, $description, $event_date, $event_time, $category, $is_published, $id);
        } else {
            // Create
            $stmt = $conn->prepare('INSERT INTO news_events (title, description, event_date, event_time, category, is_published, created_by) VALUES (?, ?, ?, ?, ?, ?, ?)');
            $stmt->bind_param('sssssii', $title, $description, $event_date, $event_time, $category, $is_published, $admin_id);
        }
        
        if ($stmt->execute()) {
            $success = 'News/Event saved successfully!';
        } else {
            $error = 'Error saving news/event';
        }
    }
}

// Get all news/events
$news_list = $conn->query('SELECT * FROM news_events ORDER BY created_at DESC');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage News & Events - Admin</title>
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
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 5px;
            text-decoration: none;
            transition: all 0.3s;
        }
        
        .header a:hover {
            transform: translateY(-2px);
        }
        
        .card {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            margin-bottom: 20px;
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
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-family: inherit;
            font-size: 14px;
        }
        
        .form-group textarea {
            resize: vertical;
            min-height: 120px;
        }
        
        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }
        
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }
        
        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .checkbox-group input[type="checkbox"] {
            width: auto;
        }
        
        .button-group {
            display: flex;
            gap: 10px;
            margin-top: 30px;
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
        
        .btn-secondary {
            background: #ccc;
            color: #333;
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
        
        .news-list {
            margin-top: 30px;
        }
        
        .news-item {
            background: #f9f9f9;
            padding: 20px;
            border-radius: 5px;
            margin-bottom: 15px;
            border-left: 4px solid #667eea;
        }
        
        .news-item-header {
            display: flex;
            justify-content: space-between;
            align-items: start;
            gap: 15px;
        }
        
        .news-item h3 {
            margin-bottom: 5px;
            color: #333;
        }
        
        .news-item-date {
            font-size: 12px;
            color: #999;
            margin-bottom: 10px;
        }
        
        .news-item-actions {
            display: flex;
            gap: 10px;
        }
        
        .btn-delete,
        .btn-edit {
            padding: 8px 15px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            font-size: 12px;
            text-decoration: none;
            color: white;
        }
        
        .btn-edit {
            background: #667eea;
        }
        
        .btn-delete {
            background: #dc3545;
        }
        
        .btn-delete:hover {
            background: #c82333;
        }
        
        .badge {
            display: inline-block;
            padding: 4px 8px;
            background: #667eea;
            color: white;
            border-radius: 3px;
            font-size: 11px;
            margin-right: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <a href="./dashboard.php"><i class="fas fa-arrow-left"></i> Back to Dashboard</a>
        </div>
        
        <div class="card">
            <h1><i class="fas fa-newspaper"></i> Manage News & Events</h1>
            
            <?php if ($success): ?>
                <div class="alert alert-success"><?= $success; ?></div>
            <?php endif; ?>
            
            <?php if ($error): ?>
                <div class="alert alert-error"><?= $error; ?></div>
            <?php endif; ?>
            
            <form method="POST">
                <div class="form-row">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" id="title" name="title" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="category">Category</label>
                        <select id="category" name="category">
                            <option value="news">News</option>
                            <option value="event">Event</option>
                        </select>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description" placeholder="Enter the full description..."></textarea>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="event_date">Event Date (optional)</label>
                        <input type="date" id="event_date" name="event_date">
                    </div>
                    
                    <div class="form-group">
                        <label for="event_time">Event Time (optional)</label>
                        <input type="time" id="event_time" name="event_time">
                    </div>
                </div>
                
                <div class="form-group checkbox-group">
                    <input type="checkbox" id="is_published" name="is_published" checked>
                    <label for="is_published" style="margin-bottom: 0;">Publish this news/event</label>
                </div>
                
                <div class="button-group">
                    <button type="submit" class="submit-btn"><i class="fas fa-save"></i> Save News/Event</button>
                </div>
            </form>
        </div>
        
        <div class="card">
            <h2 style="margin-bottom: 20px;">Recent News & Events</h2>
            
            <div class="news-list">
                <?php while ($item = $news_list->fetch_assoc()): ?>
                    <div class="news-item">
                        <div class="news-item-header">
                            <div style="flex: 1;">
                                <h3><?= htmlspecialchars($item['title']); ?></h3>
                                <div class="news-item-date">
                                    <span class="badge"><?= ucfirst($item['category']); ?></span>
                                    <?php if ($item['event_date']): ?>
                                        <span><?= $item['event_date']; ?> at <?= $item['event_time'] ?: 'Time TBA'; ?></span>
                                    <?php endif; ?>
                                </div>
                                <p><?= substr(htmlspecialchars($item['description']), 0, 100); ?>...</p>
                            </div>
                            <div class="news-item-actions">
                                <a href="?delete=<?= $item['id']; ?>" class="btn-delete" onclick="return confirm('Delete this item?')"><i class="fas fa-trash"></i> Delete</a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>
</body>
</html>
