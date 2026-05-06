<?php
require_once __DIR__ . '/config.php';
redirectIfNotAdmin();

$admin_name = $_SESSION['admin_name'] ?? 'Admin';

// Get dashboard statistics
$stats = [];
$stats['news_count'] = $conn->query("SELECT COUNT(*) as count FROM news_events")->fetch_assoc()['count'];
$stats['staff_count'] = $conn->query("SELECT COUNT(*) as count FROM staff WHERE is_active = TRUE")->fetch_assoc()['count'];
$stats['gallery_count'] = $conn->query("SELECT COUNT(*) as count FROM gallery WHERE is_active = TRUE")->fetch_assoc()['count'];
$stats['contacts'] = $conn->query("SELECT COUNT(*) as count FROM contact_submissions WHERE status = 'new'")->fetch_assoc()['count'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Calyst Christian School</title>
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
        
        .dashboard-container {
            display: grid;
            grid-template-columns: 250px 1fr;
            min-height: 100vh;
        }
        
        /* Sidebar */
        .sidebar {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 0;
            position: fixed;
            width: 250px;
            height: 100vh;
            overflow-y: auto;
        }
        
        .sidebar-header {
            padding: 30px 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            text-align: center;
        }
        
        .sidebar-header h2 {
            font-size: 20px;
            margin-bottom: 5px;
        }
        
        .sidebar-header p {
            font-size: 12px;
            opacity: 0.9;
        }
        
        .sidebar-menu {
            list-style: none;
            padding: 20px 0;
        }
        
        .sidebar-menu li {
            margin: 0;
        }
        
        .sidebar-menu a {
            display: block;
            padding: 15px 20px;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: all 0.3s;
            border-left: 3px solid transparent;
        }
        
        .sidebar-menu a:hover,
        .sidebar-menu a.active {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            border-left-color: white;
        }
        
        .sidebar-menu a i {
            margin-right: 10px;
            width: 20px;
        }
        
        .sidebar-footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            padding: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .sidebar-footer a {
            display: block;
            text-align: center;
            padding: 10px;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: color 0.3s;
            font-size: 14px;
        }
        
        .sidebar-footer a:hover {
            color: white;
        }
        
        /* Main content */
        .main-content {
            margin-left: 250px;
            padding: 30px;
        }
        
        .topbar {
            background: white;
            padding: 20px 30px;
            border-radius: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }
        
        .topbar h1 {
            font-size: 24px;
            color: #333;
        }
        
        .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .user-info span {
            font-size: 14px;
            color: #666;
        }
        
        /* Dashboard grid */
        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .stat-card {
            background: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            text-align: center;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }
        
        .stat-card-icon {
            font-size: 32px;
            margin-bottom: 15px;
        }
        
        .stat-card-value {
            font-size: 32px;
            font-weight: bold;
            color: #667eea;
            margin-bottom: 5px;
        }
        
        .stat-card-label {
            color: #999;
            font-size: 14px;
        }
        
        /* Management section */
        .management-section {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            margin-bottom: 30px;
        }
        
        .management-section h2 {
            margin-bottom: 20px;
            font-size: 20px;
            color: #333;
        }
        
        .management-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
        }
        
        .management-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px;
            border-radius: 8px;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 15px;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        
        .management-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
        }
        
        .management-card i {
            font-size: 24px;
        }
        
        .management-card-text h3 {
            font-size: 16px;
            margin-bottom: 3px;
        }
        
        .management-card-text p {
            font-size: 12px;
            opacity: 0.9;
        }
        
        @media (max-width: 768px) {
            .dashboard-container {
                grid-template-columns: 1fr;
            }
            
            .sidebar {
                width: 100%;
                height: auto;
                position: static;
            }
            
            .main-content {
                margin-left: 0;
            }
            
            .sidebar-menu {
                display: grid;
                grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
                padding: 10px;
            }
            
            .sidebar-footer {
                position: static;
                padding: 10px;
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                gap: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <nav class="sidebar">
            <div class="sidebar-header">
                <h2>Admin Panel</h2>
                <p>Calyst Christian School</p>
            </div>
            
            <ul class="sidebar-menu">
                <li><a href="./dashboard.php" class="active"><i class="fas fa-th-large"></i> Dashboard</a></li>
                <li><a href="./edit-school.php"><i class="fas fa-school"></i> School Info</a></li>
                <li><a href="./edit-pages.php"><i class="fas fa-file-alt"></i> Pages</a></li>
                <li><a href="./manage-news.php"><i class="fas fa-newspaper"></i> News & Events</a></li>
                <li><a href="./manage-staff.php"><i class="fas fa-users"></i> Staff</a></li>
                <li><a href="./manage-gallery.php"><i class="fas fa-images"></i> Gallery</a></li>
                <li><a href="./manage-testimonials.php"><i class="fas fa-quote-left"></i> Testimonials</a></li>
                <li><a href="./manage-fees.php"><i class="fas fa-dollar-sign"></i> Fees</a></li>
                <li><a href="./contact-submissions.php"><i class="fas fa-envelope"></i> Messages <span style="background: red; border-radius: 50%; padding: 2px 6px; font-size: 10px; margin-left: 5px;"><?= $stats['contacts']; ?></span></a></li>
            </ul>
            
            <div class="sidebar-footer">
                <a href="./profile.php"><i class="fas fa-user"></i> Profile</a>
                <a href="./logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
            </div>
        </nav>
        
        <!-- Main content -->
        <div class="main-content">
            <div class="topbar">
                <h1>Dashboard</h1>
                <div class="user-info">
                    <span>Welcome, <strong><?= htmlspecialchars($admin_name); ?></strong></span>
                </div>
            </div>
            
            <!-- Statistics -->
            <div class="dashboard-grid">
                <div class="stat-card">
                    <div class="stat-card-icon" style="color: #667eea;">📰</div>
                    <div class="stat-card-value"><?= $stats['news_count']; ?></div>
                    <div class="stat-card-label">News & Events</div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-card-icon" style="color: #764ba2;">👥</div>
                    <div class="stat-card-value"><?= $stats['staff_count']; ?></div>
                    <div class="stat-card-label">Staff Members</div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-card-icon" style="color: #f093fb;">📸</div>
                    <div class="stat-card-value"><?= $stats['gallery_count']; ?></div>
                    <div class="stat-card-label">Gallery Images</div>
                </div>
                
                <div class="stat-card">
                    <div class="stat-card-icon" style="color: #4facfe;">✉️</div>
                    <div class="stat-card-value"><?= $stats['contacts']; ?></div>
                    <div class="stat-card-label">New Messages</div>
                </div>
            </div>
            
            <!-- Management section -->
            <div class="management-section">
                <h2>Content Management</h2>
                <div class="management-grid">
                    <a href="./edit-school.php" class="management-card">
                        <i class="fas fa-cog"></i>
                        <div class="management-card-text">
                            <h3>School Settings</h3>
                            <p>Update school info</p>
                        </div>
                    </a>
                    
                    <a href="./edit-pages.php" class="management-card" style="background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);">
                        <i class="fas fa-file-alt"></i>
                        <div class="management-card-text">
                            <h3>Pages</h3>
                            <p>Edit page content</p>
                        </div>
                    </a>
                    
                    <a href="./manage-news.php" class="management-card" style="background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);">
                        <i class="fas fa-plus-circle"></i>
                        <div class="management-card-text">
                            <h3>Add News</h3>
                            <p>Create events/news</p>
                        </div>
                    </a>
                    
                    <a href="./manage-staff.php" class="management-card" style="background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);">
                        <i class="fas fa-user-plus"></i>
                        <div class="management-card-text">
                            <h3>Staff</h3>
                            <p>Manage staff info</p>
                        </div>
                    </a>
                    
                    <a href="./manage-gallery.php" class="management-card" style="background: linear-gradient(135deg, #30cfd0 0%, #330867 100%);">
                        <i class="fas fa-upload"></i>
                        <div class="management-card-text">
                            <h3>Gallery</h3>
                            <p>Upload images</p>
                        </div>
                    </a>
                    
                    <a href="./contact-submissions.php" class="management-card" style="background: linear-gradient(135deg, #a8edea 0%, #fed6e3 100%); color: #333;">
                        <i class="fas fa-inbox"></i>
                        <div class="management-card-text">
                            <h3>Messages</h3>
                            <p>View submissions</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

