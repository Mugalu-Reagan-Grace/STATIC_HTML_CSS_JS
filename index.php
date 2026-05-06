<?php require_once __DIR__ . '/brand.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= SCHOOL_NAME_UPPER ?></title>
    <script>
        // Redirect to home.php if index.php is accessed
        globalThis.location.href = './home.php';
    </script>
    <link rel="canonical" href="./home.php" />
</head>
<body>
    <p>If you are not redirected automatically, <a href="./home.php">click here</a>.</p>
</body>
</html>
