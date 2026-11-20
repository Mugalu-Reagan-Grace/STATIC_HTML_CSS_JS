<?php
require_once __DIR__ . '/brand.php';
require_once __DIR__ . '/components/managed-content.php';
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Ask about current classes, learning programmes, and availability at <?= SCHOOL_NAME_UPPER ?>.">
  <title>Programmes - <?= SCHOOL_NAME_UPPER ?></title>
  <link rel="icon" type="image/x-icon" href="./ASSETS/images/favicon_io no bg/favicon.ico">
  <link rel="stylesheet" href="./ASSETS/css/calyst.css?v=4">
</head>
<body>
  <?php include_once 'components/header.php'; ?>
  <main id="main-content">
    <section class="page-hero">
      <div class="container">
        <span class="eyebrow">Learning at Calyst</span>
        <h1>Programmes</h1>
        <p>For current class levels, curriculum details, and availability, contact the school office.</p>
        <a class="btn" href="./contact_us.php">Ask about programmes</a>
      </div>
    </section>
    <?php renderManagedContentForCurrentPage(); ?>
    <section class="section">
      <div class="container">
        <div class="admissions-guidance-card">
          <h2>Choosing a class</h2>
          <p>Class placement and availability can change. Please confirm details directly with the school before applying.</p>
          <p><a href="./admissions.php">Read admissions information</a> or <a href="./contact_us.php">send the school a question</a>.</p>
        </div>
      </div>
    </section>
  </main>
  <?php include_once 'components/footer.php'; ?>
  <script src="./ASSETS/js/config.js?v=7"></script>
  <script src="./ASSETS/js/main.js?v=6"></script>
</body>
</html>
