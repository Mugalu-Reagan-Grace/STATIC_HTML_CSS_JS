<?php require_once __DIR__ . '/brand.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - <?= SCHOOL_NAME_UPPER ?></title>
    <link rel="icon" type="image/x-icon" href="./ASSETS/IMAGES/favicon_io no bg/favicon.ico">
    <link rel="stylesheet" href="calyst.css">
    <link rel="stylesheet" href="./ASSETS/js/animations.css">
</head>
<body>
  <?php include_once 'components/header.php'; ?>

    <main>
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
                <p class="contact-highlight-label">Visit</p>
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
                <h2>(+256) 774-744-394</h2>
                <p>(+256) 752-482-066</p>
              </div>
            </article>

            <article class="contact-highlight-card">
              <span class="contact-highlight-icon">
                <i class="fas fa-envelope" aria-hidden="true"></i>
              </span>
              <div>
                <p class="contact-highlight-label">Email</p>
                <h2>Fast Response</h2>
                <p>mugalureagan18@gmail.com</p>
              </div>
            </article>

            <article class="contact-highlight-card">
              <span class="contact-highlight-icon">
                <i class="fas fa-clock" aria-hidden="true"></i>
              </span>
              <div>
                <p class="contact-highlight-label">Office Hours</p>
                <h2>Mon-Fri</h2>
                <p>8:00 AM - 5:00 PM</p>
              </div>
            </article>
          </div>
        </div>
      </section>

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
                    <h3>Visit Us</h3>
                    <p>Main school office and campus address</p>
                  </div>
                </div>
                <div class="contact-card-body">
                  <p class="contact-card-value">P.O. BOX 124666, Kampala, Uganda</p>
                  <a
                    class="contact-link"
                    href="https://maps.app.goo.gl/X8Y2kFKjBTET5jJG9"
                    target="_blank"
                    rel="noopener"
                  >
                    View on Google Maps
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
                    <a href="tel:+256774744394">(+256) 774-744-394</a>
                    <a href="tel:+256752482066">(+256) 752-482-066</a>
                  </div>
                </div>

                <div class="contact-mini">
                  <span class="contact-mini-icon">
                    <i class="fas fa-envelope" aria-hidden="true"></i>
                  </span>
                  <div>
                    <h4>Email</h4>
                    <a href="mailto:mugalureagan18@gmail.com">mugalureagan18@gmail.com</a>
                  </div>
                </div>

                <div class="contact-mini">
                  <span class="contact-mini-icon">
                    <i class="fas fa-clock" aria-hidden="true"></i>
                  </span>
                  <div>
                    <h4>Office Hours</h4>
                    <p>Monday to Friday</p>
                    <p>8:00 AM to 5:00 PM</p>
                  </div>
                </div>
              </div>
            </aside>

            <div class="contact-form-panel">
              <div class="contact-form-header">
                <h3>Send a Message</h3>
                <p>
                  Share your question and the appropriate office will respond as soon as possible.
                </p>
              </div>

              <form class="contact-form">
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
                  <div class="form-group form-group--full">
                    <label for="contact-message">Message</label>
                    <textarea id="contact-message" name="message" placeholder="Write your message here" required></textarea>
                  </div>
                </div>

                <button type="submit" class="btn">Send Message</button>
              </form>
            </div>
          </div>

          <div class="map-panel">
            <div class="map-panel-header">
              <h3>School Location</h3>
              <p>Find us quickly using the map below.</p>
            </div>
            <div class="map">
              <iframe
                src="https://www.google.com/maps?q=P.O.%20BOX%20124666,%20Kampala,%20Uganda&output=embed"
                width="100%"
                height="100%"
                style="border:0;"
                allowfullscreen=""
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"
                title="<?= SCHOOL_NAME_UPPER ?> location"
              ></iframe>
            </div>
          </div>
        </div>
      </section>
    </main>

        <!-- Footer -->
    <?php include_once 'components/footer.php'; ?>
  <script src="./ASSETS/fonts/fontawesome/js/solid.js"></script>
  <script src="./ASSETS/fonts/fontawesome/js/fontawesome.js"></script>
  <script src="./ASSETS/js/utils.js"></script>
  <script src="./config.js"></script>
  <script src="./ASSETS/js/main.js"></script>
</body>
</html>



