<?php
require_once __DIR__ . '/brand.php';
require_once __DIR__ . '/components/managed-content.php';
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Learn about the mission and vision of <?= SCHOOL_NAME_UPPER ?>.">
  <title>About Us - <?= SCHOOL_NAME_UPPER ?></title>
  <link rel="icon" type="image/x-icon" href="./ASSETS/images/favicon_io no bg/favicon.ico">
  <link rel="stylesheet" href="./ASSETS/css/calyst.css?v=4">
</head>
<body>
  <?php include_once 'components/header.php'; ?>
  <main id="main-content">
    <section class="page-hero">
      <div class="container">
        <span class="eyebrow">About our school</span>
        <h1><?= SCHOOL_NAME ?></h1>
        <p><?= SCHOOL_MOTTO ?></p>
      </div>
    </section>
    <?php renderManagedContentForCurrentPage(); ?>
    <section class="section">
      <div class="container home-explore-grid">
        <article class="admissions-guidance-card">
          <h2>Our mission</h2>
          <p>We are a learning community with a reputation for delivering great education and enhancing talents and competencies beyond traditional education for all our learners.</p>
        </article>
        <article class="admissions-guidance-card">
          <h2>Our vision</h2>
          <p>To provide quality education incorporating a holistic programme with opportunities for social, emotional, physical, and educational development.</p>
        </article>
      </div>
    </section>
    <section class="home-contact-cta">
      <div class="container home-contact-content">
        <div>
          <span class="eyebrow">Learn more</span>
          <h2>Questions about Calyst?</h2>
          <p>Contact the school office for current information about classes and admissions.</p>
        </div>
        <a class="btn" href="./contact_us.php">Contact the school</a>
      </div>
    </section>
  </main>
  <?php include_once 'components/footer.php'; ?>
  <script src="./ASSETS/js/config.js?v=7"></script>
  <script src="./ASSETS/js/main.js?v=6"></script>
</body>
</html>
