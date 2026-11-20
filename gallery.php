<?php
require_once __DIR__ . '/brand.php';
require_once __DIR__ . '/components/managed-content.php';
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Browse photographs shared by the <?= SCHOOL_NAME_UPPER ?> school community.">
  <title>Gallery - <?= SCHOOL_NAME_UPPER ?></title>
  <link rel="icon" type="image/x-icon" href="./ASSETS/images/favicon_io no bg/favicon.ico">
  <link rel="stylesheet" href="./ASSETS/css/calyst.css?v=4">
</head>
<body>
  <?php include_once 'components/header.php'; ?>
  <main id="main-content">
    <section class="page-hero">
      <div class="container">
        <span class="eyebrow">School community</span>
        <h1>Photo Gallery</h1>
        <p>Browse photographs shared by the school community.</p>
      </div>
    </section>
    <?php renderManagedContentForCurrentPage(); ?>
  </main>
  <?php include_once 'components/footer.php'; ?>
  <script src="./ASSETS/js/config.js?v=7"></script>
  <script src="./ASSETS/js/main.js?v=6"></script>
</body>
</html>
