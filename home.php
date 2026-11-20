<?php
require_once __DIR__ . '/brand.php';
require_once __DIR__ . '/components/managed-content.php';
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Learn about Calyst Christian School in Kampala, Uganda. Explore school programmes, admissions, fees, and contact information.">
  <meta name="theme-color" content="#1e3a8a">
  <meta property="og:title" content="Calyst Christian School">
  <meta property="og:description" content="A Christian school in Kampala, Uganda, nurturing faith, knowledge, character, and service.">
  <meta property="og:type" content="website">
  <meta property="og:url" content="http://calyst.nsoft/home.php">
  <meta property="og:image" content="http://calyst.nsoft/ASSETS/images/calyst%20budge%20final.png">
  <title>Home - <?= SCHOOL_NAME_UPPER ?></title>
  <link rel="icon" type="image/x-icon" href="./ASSETS/images/favicon_io no bg/favicon.ico">
  <link rel="stylesheet" href="./ASSETS/css/calyst.css?v=4">
</head>
<body>
  <?php include_once 'components/header.php'; ?>
  <main id="main-content">
    <section class="home-hero">
      <div class="container home-hero-content">
        <p class="eyebrow"><?= SCHOOL_MOTTO ?></p>
        <h1>Welcome to <?= SCHOOL_NAME ?></h1>
        <p class="home-hero-lead">A Christian school in Kampala. Explore our programmes and admissions, or get in touch with the school office.</p>
        <div class="home-hero-actions">
          <a class="btn btn-primary" href="./admissions.php">Admissions information</a>
          <a class="btn btn-secondary" href="./contact_us.php">Contact the school</a>
        </div>
      </div>
    </section>

    <?php renderManagedContentForCurrentPage(); ?>

    <section class="section home-explore">
      <div class="container">
        <div class="section-title">
          <h2>Explore Calyst</h2>
          <p>Find the information you need or speak with our school office.</p>
        </div>
        <div class="home-explore-grid">
          <a class="home-explore-card" href="./programs.php">
            <span class="home-explore-icon" aria-hidden="true"><i class="fa-solid fa-book-open"></i></span>
            <h3>Programmes</h3>
            <p>Read about learning at Calyst Christian School.</p>
            <span class="home-explore-link">Explore programmes <span aria-hidden="true">→</span></span>
          </a>
          <a class="home-explore-card" href="./admissions.php">
            <span class="home-explore-icon" aria-hidden="true"><i class="fa-solid fa-file-signature"></i></span>
            <h3>Admissions</h3>
            <p>Review the application information and contact us with questions.</p>
            <span class="home-explore-link">View admissions <span aria-hidden="true">→</span></span>
          </a>
          <a class="home-explore-card" href="./fees.php">
            <span class="home-explore-icon" aria-hidden="true"><i class="fa-solid fa-coins"></i></span>
            <h3>Fees</h3>
            <p>Contact the school for the current fees and payment information.</p>
            <span class="home-explore-link">Fees information <span aria-hidden="true">→</span></span>
          </a>
          <a class="home-explore-card" href="./news-events.php">
            <span class="home-explore-icon" aria-hidden="true"><i class="fa-solid fa-calendar-days"></i></span>
            <h3>News &amp; Events</h3>
            <p>See updates and events currently published by the school.</p>
            <span class="home-explore-link">Latest updates <span aria-hidden="true">→</span></span>
          </a>
        </div>
      </div>
    </section>

    <section class="home-contact-cta">
      <div class="container home-contact-content">
        <div>
          <span class="eyebrow">We are here to help</span>
          <h2>Have a question?</h2>
          <p>Contact the school office about admissions, fees, or arranging a visit.</p>
        </div>
        <div class="home-contact-actions">
          <a class="btn" href="./contact_us.php">Send us a message</a>
          <a href="tel:+256774744394">Call +256 774-744-394</a>
        </div>
      </div>
    </section>
  </main>
  <?php include_once 'components/footer.php'; ?>
  <script src="./ASSETS/js/config.js?v=7"></script>
  <script src="./ASSETS/js/main.js?v=6"></script>
</body>
</html>
