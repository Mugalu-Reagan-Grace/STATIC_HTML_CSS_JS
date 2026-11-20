<?php
require_once __DIR__ . '/brand.php';
require_once __DIR__ . '/components/managed-content.php';
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Read current announcements and upcoming events published by <?= SCHOOL_NAME_UPPER ?>.">
  <title>News &amp; Events - <?= SCHOOL_NAME_UPPER ?></title>
  <link rel="icon" type="image/x-icon" href="./ASSETS/images/favicon_io no bg/favicon.ico">
  <link rel="stylesheet" href="./ASSETS/css/calyst.css?v=4">
</head>
<body class="news-events-page">
  <?php include_once 'components/header.php'; ?>
  <main id="main-content">
    <section class="page-hero">
      <div class="container">
        <span class="eyebrow">School updates</span>
        <h1>News &amp; Events</h1>
        <p>Announcements and upcoming events published by the school.</p>
      </div>
    </section>
    <?php renderManagedContentForCurrentPage(); ?>
  </main>
  <?php include_once 'components/footer.php'; ?>
  <script src="./ASSETS/js/config.js?v=7"></script>
  <script src="./ASSETS/js/main.js?v=6"></script>
</body>
</html>
