<?php require_once __DIR__ . '/brand.php'; ?>
<!doctype html>
<html lang="en">
    <?php include_once 'components/header.php'; ?>
          </ul>
          <button
            type="button"
            class="hamburger"
            aria-label="Open menu"
            onclick="showSidebar()"
            onkeydown="
              if (event.key === 'Enter' || event.key === ' ') {
                showSidebar();
              }
            "
          >
            <span></span>
            <span></span>
            <span></span>
          </button>
        </nav>
      </div>
    </header>

    <!-- Main Content -->
    <main>
      <section class="policy-hero">
        <div class="container">
          <h1>Privacy Policy</h1>
          <p>Last updated: January 2026</p>
        </div>
      </section>

      <section class="policy-content">
        <div class="container">
          <h2>Introduction</h2>
          <p>
            <?= SCHOOL_NAME_UPPER ?> ("School," "we," "us," or "our") respects
            your privacy and is committed to protecting your personal
            information. This Privacy Policy explains how we collect, use,
            disclose, and otherwise process your personal information in
            connection with our website and school operations.
          </p>

          <h2>Information We Collect</h2>
          <h3>Information You Provide</h3>
          <ul>
            <li>Contact information (name, email address, phone number)</li>
            <li>Inquiry and form submission data</li>
            <li>Student and parent information for admissions</li>
            <li>Newsletter subscription preferences</li>
            <li>Communications and correspondence</li>
          </ul>

          <h3>Information Collected Automatically</h3>
          <ul>
            <li>Browser type and version</li>
            <li>IP address</li>
            <li>Pages visited and time spent on site</li>
            <li>Device information</li>
            <li>Referral source</li>
          </ul>

          <h2>How We Use Your Information</h2>
          <ul>
            <li>Process admissions applications and inquiries</li>
            <li>Respond to your communications</li>
            <li>Provide requested information about our programs</li>
            <li>Send newsletters and updates (with your consent)</li>
            <li>Improve our website and services</li>
            <li>Comply with legal obligations</li>
          </ul>

          <h2>Data Security</h2>
          <p>
            We implement appropriate technical and organizational measures to
            protect your personal information against unauthorized access,
            alteration, disclosure, or destruction. However, no method of
            transmission over the internet is completely secure.
          </p>

          <h2>Third-Party Sharing</h2>
          <p>
            We do not sell, trade, or rent your personal information to third
            parties. We may share information with trusted service providers who
            assist us in operating our website and conducting our business,
            subject to confidentiality agreements.
          </p>

          <h2>Cookies</h2>
          <p>
            Our website may use cookies to enhance your browsing experience. You
            can control cookie preferences through your browser settings.
          </p>

          <h2>Children's Privacy</h2>
          <p>
            Our website is not directed to children under 13. If we become aware
            that we have collected personal information from a child under 13,
            we will take steps to delete such information promptly.
          </p>

          <h2>Your Rights</h2>
          <p>You have the right to:</p>
          <ul>
            <li>Access your personal information</li>
            <li>Request corrections to inaccurate information</li>
            <li>Request deletion of your information</li>
            <li>Opt-out of marketing communications</li>
          </ul>

          <h2>Contact Us</h2>
          <p>
            If you have questions about this Privacy Policy or our privacy
            practices, please contact us at:
          </p>
          <p>
            <strong><?= SCHOOL_NAME_UPPER ?></strong><br />
            Email: info@calystschool.edu<br />
            Phone: (XXX) XXX-XXXX
          </p>

          <h2>Policy Changes</h2>
          <p>
            We may update this Privacy Policy from time to time. We will notify
            you of any significant changes by posting the updated policy on this
            page.
          </p>
        </div>
      </section>
    </main>

    <!-- Footer -->
    <?php include_once 'components/footer.php'; ?>

    <script src="./config.js"></script>
  <script src="./ASSETS/js/main.js"></script>
  </body>
</html>




