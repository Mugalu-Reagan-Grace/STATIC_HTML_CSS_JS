<?php require_once __DIR__ . '/brand.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found</title>
    <link rel="icon" type="image/x-icon" href="./ASSETS/IMAGES/favicon_io no bg/favicon.ico">
    <link rel="stylesheet" href="calyst.css">
    <link rel="stylesheet" href="./ASSETS/js/animations.css">
    <style>
        .error-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 20px;
            text-align: center;
            background: linear-gradient(135deg, #1e3a8a, #3b82f6);
            color: white;
        }
        
        .error-code {
            font-size: 120px;
            font-weight: bold;
            margin: 0;
            line-height: 1;
            animation: fadeIn 0.6s ease-in-out;
        }
        
        .error-message {
            font-size: 36px;
            margin: 20px 0;
            animation: fadeIn 0.8s ease-in-out 0.2s both;
        }
        
        .error-description {
            font-size: 18px;
            margin: 20px 0 40px 0;
            max-width: 600px;
            opacity: 0.9;
            animation: fadeIn 1s ease-in-out 0.4s both;
        }
        
        .error-actions {
            display: flex;
            gap: 20px;
            justify-content: center;
            flex-wrap: wrap;
            animation: fadeIn 1.2s ease-in-out 0.6s both;
        }
        
        .error-btn {
            padding: 12px 30px;
            background-color: white;
            color: #1e3a8a;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        
        .error-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }
        
        .error-btn.secondary {
            background-color: transparent;
            color: white;
            border: 2px solid white;
        }
        
        .error-btn.secondary:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }
        
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    <div class="error-container">
        <h1 class="error-code">404</h1>
        <h2 class="error-message">Page Not Found</h2>
        <p class="error-description">
            Sorry, the page you're looking for doesn't exist.
            It may have been moved or deleted. Let's get you back on track.
        </p>
        <div class="error-actions">
            <a href="./home.php" class="error-btn">Go to Home</a>
            <button class="error-btn secondary" onclick="window.history.back()">Go Back</button>
        </div>
    </div>
    
    <script src="./ASSETS/js/utils.js"></script>
    <script>
        // Log 404 error for analytics
        console.warn("404 Error: User attempted to access a non-existent page");
        CalystUtils.log("404 Page accessed", "warn");
    </script>
</body>
</html>




