<?php
require_once __DIR__ . '/brand.php';
require_once __DIR__ . '/components/managed-content.php';
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}
if (empty($_SESSION['contact_csrf_token'])) {
    $_SESSION['contact_csrf_token'] = bin2hex(random_bytes(32));
}
$contactResult = $_SESSION['contact_result'] ?? '';
unset($_SESSION['contact_result']);
$contactMessage = '';
if ($contactResult === 'sent') {
    $contactMessage = 'Thank you. Your message has been received by the school office.';
} elseif ($contactResult === 'error') {
    $contactMessage = 'We could not send your message. Please check the form and try again, or call the school office.';
} elseif ($contactResult === 'wait') {
    $contactMessage = 'Please wait a little before sending another message.';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - <?= SCHOOL_NAME_UPPER ?></title>
    <link rel="icon" type="image/x-icon" href="./ASSETS/images/favicon_io no bg/favicon.ico">
    <link rel="stylesheet" href="./ASSETS/css/calyst.css?v=4">
    <link rel="stylesheet" href="./ASSETS/css/animations.css">
</head>
<body>
  <?php include_once 'components/header.php'; ?>

    <main id="main-content">
      <section class="page-hero contact-hero">
        <div class="container">
          <p class="contact-hero-kicker">We are here to help</p>
          <h1>Contact Us</h1>
          <p>
            Reach out to <?= SCHOOL_NAME_UPPER ?> for admissions, school visits,
            office support, and general inquiries.
          </p>
        </div>
      </section>

      <section class="contact-highlights">
        <div class="container">
          <div class="contact-highlights-grid">
            <article class="contact-highlight-card">
              <span class="contact-highlight-icon">
                <i class="fas fa-map-marker-alt" aria-hidden="true"></i>
              </span>
              <div>
                <p class="contact-highlight-label">Postal address</p>
                <h2>P.O. BOX 124666</h2>
                <p>Kampala, Uganda</p>
              </div>
            </article>

            <article class="contact-highlight-card">
              <span class="contact-highlight-icon">
                <i class="fas fa-phone" aria-hidden="true"></i>
              </span>
              <div>
                <p class="contact-highlight-label">Call</p>
                <h2><?= htmlspecialchars($school['phone_1'], ENT_QUOTES, 'UTF-8'); ?></h2>
                <?php if (!empty($school['phone_2'])): ?><p><?= htmlspecialchars($school['phone_2'], ENT_QUOTES, 'UTF-8'); ?></p><?php endif; ?>
                <?php foreach ($school['dynamic']['contact_phones'] as $phone): ?>
                  <p><strong><?= htmlspecialchars($phone['label'], ENT_QUOTES, 'UTF-8'); ?>:</strong> <?= htmlspecialchars($phone['value'], ENT_QUOTES, 'UTF-8'); ?></p>
                <?php endforeach; ?>
              </div>
            </article>

            <article class="contact-highlight-card">
              <span class="contact-highlight-icon">
                <i class="fas fa-envelope" aria-hidden="true"></i>
              </span>
              <div>
                <p class="contact-highlight-label">Email</p>
                <h2>Email the school</h2>
                <p><a href="mailto:<?= htmlspecialchars($school['email'], ENT_QUOTES, 'UTF-8'); ?>"><?= htmlspecialchars($school['email'], ENT_QUOTES, 'UTF-8'); ?></a></p>
                <?php foreach ($school['dynamic']['contact_emails'] as $email): ?>
                  <p><strong><?= htmlspecialchars($email['label'], ENT_QUOTES, 'UTF-8'); ?>:</strong> <a href="mailto:<?= htmlspecialchars($email['value'], ENT_QUOTES, 'UTF-8'); ?>"><?= htmlspecialchars($email['value'], ENT_QUOTES, 'UTF-8'); ?></a></p>
                <?php endforeach; ?>
              </div>
            </article>

          </div>
        </div>
      </section>

      <?php renderManagedContentForCurrentPage(); ?>

      <section class="section contact">
        <div class="container container-contact">
          <div class="contact-intro">
            <h2>Contact Information</h2>
            <p>
              For admissions, school visits, office support, and general enquiries,
              use the details below or send us a direct message.
            </p>
          </div>

          <div class="contact-layout">
            <aside class="contact-sidebar">
              <div class="contact-card contact-card--location">
                <div class="contact-card-head">
                  <span class="contact-card-icon">
                    <i class="fas fa-map-marker-alt" aria-hidden="true"></i>
                  </span>
                  <div>
                    <h3>School location</h3>
                      <p>Use the verified campus map below or open directions in Google Maps.</p>
                  </div>
                </div>
                <div class="contact-card-body">
                  <p class="contact-card-value"><?= htmlspecialchars($school['address'], ENT_QUOTES, 'UTF-8'); ?></p>
                  <?php foreach ($school['dynamic']['contact_addresses'] as $address): ?>
                    <p><strong><?= htmlspecialchars($address['label'], ENT_QUOTES, 'UTF-8'); ?>:</strong> <?= htmlspecialchars($address['value'], ENT_QUOTES, 'UTF-8'); ?></p>
                  <?php endforeach; ?>
                    <p class="contact-location-note">Please contact the school office to confirm your visit arrangements.</p>
                    <a class="contact-directions-link" href="https://maps.app.goo.gl/tVVdbtRzAP75tFuz8" target="_blank" rel="noopener">
                      Open directions in Google Maps <i class="fa-solid fa-arrow-up-right-from-square" aria-hidden="true"></i>
                    </a>
                </div>
              </div>

              <div class="contact-card contact-card--stacked">
                <div class="contact-mini">
                  <span class="contact-mini-icon">
                    <i class="fas fa-phone" aria-hidden="true"></i>
                  </span>
                  <div>
                    <h4>Phone</h4>
                    <?php foreach (array_filter([$school['phone_1'], $school['phone_2']]) as $phone): ?>
                      <a href="tel:<?= htmlspecialchars(preg_replace('/[^+\d]/', '', $phone), ENT_QUOTES, 'UTF-8'); ?>"><?= htmlspecialchars($phone, ENT_QUOTES, 'UTF-8'); ?></a>
                    <?php endforeach; ?>
                    <?php foreach ($school['dynamic']['contact_phones'] as $phone): ?>
                      <a href="tel:<?= htmlspecialchars(preg_replace('/[^+\d]/', '', $phone['value']), ENT_QUOTES, 'UTF-8'); ?>"><?= htmlspecialchars($phone['label'] . ': ' . $phone['value'], ENT_QUOTES, 'UTF-8'); ?></a>
                    <?php endforeach; ?>
                  </div>
                </div>

                <div class="contact-mini">
                  <span class="contact-mini-icon">
                    <i class="fas fa-envelope" aria-hidden="true"></i>
                  </span>
                  <div>
                    <h4>Email</h4>
                    <a href="mailto:<?= htmlspecialchars($school['email'], ENT_QUOTES, 'UTF-8'); ?>"><?= htmlspecialchars($school['email'], ENT_QUOTES, 'UTF-8'); ?></a>
                    <?php foreach ($school['dynamic']['contact_emails'] as $email): ?>
                      <a href="mailto:<?= htmlspecialchars($email['value'], ENT_QUOTES, 'UTF-8'); ?>"><?= htmlspecialchars($email['label'] . ': ' . $email['value'], ENT_QUOTES, 'UTF-8'); ?></a>
                    <?php endforeach; ?>
                  </div>
                </div>
                <?php if (!empty($school['dynamic']['school_hours'])): ?>
                  <div class="contact-mini">
                    <span class="contact-mini-icon">
                      <i class="fas fa-clock" aria-hidden="true"></i>
                    </span>
                    <div>
                      <h4>Opening hours</h4>
                      <?php foreach ($school['dynamic']['school_hours'] as $hours): ?>
                        <p><strong><?= htmlspecialchars($hours['label'], ENT_QUOTES, 'UTF-8'); ?>:</strong> <?= htmlspecialchars($hours['value'], ENT_QUOTES, 'UTF-8'); ?></p>
                      <?php endforeach; ?>
                    </div>
                  </div>
                <?php endif; ?>

              </div>
            </aside>

            <div class="contact-form-panel">
              <div class="contact-form-header">
                <h3>Send a Message</h3>
                <p>
                  Share your question and the appropriate office will respond as soon as possible.
                </p>
              </div>

              <?php if ($contactMessage !== ''): ?>
                <p class="form-status-message <?= $contactResult === 'sent' ? 'success' : 'error'; ?>" role="status" aria-live="polite"><?= htmlspecialchars($contactMessage, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?></p>
              <?php endif; ?>
              <form class="contact-form" method="POST" action="./process_contact.php">
                <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['contact_csrf_token'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8'); ?>">
                <div class="form-honeypot" aria-hidden="true">
                  <label for="contact-website">Leave this field empty</label>
                  <input id="contact-website" type="text" name="website" tabindex="-1" autocomplete="off">
                </div>
                <div class="form-grid">
                  <div class="form-group">
                    <label for="contact-name">Full Name</label>
                    <input id="contact-name" type="text" name="name" placeholder="Your full name" required>
                  </div>
                  <div class="form-group">
                    <label for="contact-email">Email Address</label>
                    <input id="contact-email" type="email" name="email" placeholder="you@example.com" required>
                  </div>
                  <div class="form-group">
                    <label for="contact-phone">Phone Number</label>
                    <input id="contact-phone" type="tel" name="phone" placeholder="(+256) ...">
                  </div>
                  <div class="form-group">
                    <label for="contact-subject">What is your message about?</label>
                    <select id="contact-subject" name="subject" required>
                      <option value="">Choose a topic</option>
                      <option value="Admissions">Admissions</option>
                      <option value="School visit">School visit</option>
                      <option value="Fees">Fees</option>
                      <option value="General enquiry">General enquiry</option>
                    </select>
                  </div>
                  <div class="form-group form-group--full">
                    <label for="contact-message">Message</label>
                    <textarea id="contact-message" name="message" placeholder="Write your message here" required></textarea>
                  </div>
                </div>

                <button type="submit" class="btn">Send Message</button>
                <p class="contact-privacy-note">Please do not include sensitive child or medical information in this general enquiry. See our <a href="./privacy-policy.php">Privacy Policy</a> or use the admissions process for application information.</p>
              </form>
            </div>
          </div>

          <div class="map-panel">
            <div class="map-panel-header">
              <h3>Planning a visit?</h3>
              <p>View Calyst Christian School on the map, then contact the office to arrange a visit.</p>
            </div>
            <div class="map">
              <iframe
                title="Map showing the location of Calyst Christian School"
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.752737458563!2d32.547529273630026!3d0.32851629966826384!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x177dbb3c2aaaac5f%3A0xd3446e181bb3d785!2sCalyst%20Christian%20School!5e0!3m2!1sen!2sug!4v1795202544298!5m2!1sen!2sug"
                width="800"
                height="600"
                style="border:0;"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="strict-origin-when-cross-origin"></iframe>
            </div>
          </div>
        </div>
      </section>
    </main>

        <!-- Footer -->
    <?php include_once 'components/footer.php'; ?>
  <script src="./ASSETS/js/utils.js"></script>
  <script src="./ASSETS/js/config.js?v=7"></script>
  <script src="./ASSETS/js/main.js?v=6"></script>
</body>
</html>


