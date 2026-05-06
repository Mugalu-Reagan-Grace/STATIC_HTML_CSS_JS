<?php require_once __DIR__ . '/config.php'; redirectIfNotAdmin(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Calyst School</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f5f7fa; }
        .container { margin-left: 250px; padding: 30px; }
        .header { display: flex; gap: 10px; align-items: center; margin-bottom: 30px; }
        .header a { padding: 10px 20px; background: #f0f0f0; border-radius: 5px; text-decoration: none; color: #333; }
        .card { background: white; padding: 30px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
        .card h1 { margin-bottom: 20px; font-size: 24px; }
        .coming-soon { text-align: center; padding: 60px 30px; color: #999; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <a href="./dashboard.php"><i class="fas fa-arrow-left"></i> Back to Dashboard</a>
        </div>
        <div class="card">
            <h1><i class="fas fa-wrench"></i> Management</h1>
            <div class="coming-soon">
                <p style="font-size: 48px; margin-bottom: 15px;">🚀</p>
                <p style="font-size: 18px; margin-bottom: 10px;">Coming Soon</p>
                <p>This section is under development. More features will be added soon!</p>
            </div>
        </div>
    </div>
</body>
</html>
