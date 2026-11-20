<?php
require_once __DIR__ . '/brand.php';
require_once __DIR__ . '/components/managed-content.php';
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="Ask Calyst Christian School for the current tuition, additional charges, and payment information.">
  <title>Fees - <?= SCHOOL_NAME_UPPER ?></title>
  <link rel="icon" type="image/x-icon" href="./ASSETS/images/favicon_io no bg/favicon.ico">
  <link rel="stylesheet" href="./ASSETS/css/calyst.css?v=4">
</head>
<body class="fees-page">
  <?php include_once 'components/header.php'; ?>
  <main id="main-content">
    <section class="page-hero">
      <div class="container">
        <span class="eyebrow">School fees</span>
        <h1>Fees &amp; Payments</h1>
        <p>For accurate, current tuition and payment details, check the published schedule below or contact the school office.</p>
      </div>
    </section>
    <?php renderManagedContentForCurrentPage(); ?>
    <section class="section fees-contact-prompt">
      <div class="container">
        <h2>Need the current fee schedule?</h2>
        <p>Contact the school office to confirm current charges, payment dates, and any additional costs before making a payment.</p>
        <a class="btn" href="./contact_us.php">Ask the school office</a>
        <a class="fees-phone-link" href="tel:+256774744394">Call +256 774-744-394</a>
      </div>
    </section>
  </main>
  <?php include_once 'components/footer.php'; ?>
  <script src="./ASSETS/js/config.js?v=7"></script>
  <script src="./ASSETS/js/main.js?v=6"></script>
</body>
</html>
