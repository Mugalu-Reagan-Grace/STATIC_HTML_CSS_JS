<?php
require_once __DIR__ . '/brand.php';
require_once __DIR__ . '/components/managed-content.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Child Registration Form - <?= SCHOOL_NAME_UPPER ?></title>
    <link
      rel="icon"
      type="image/x-icon"
      href="./ASSETS/images/favicon_io no bg/favicon.ico"
    />
    <link rel="stylesheet" href="./ASSETS/css/calyst.css?v=4" />
    <link rel="stylesheet" href="./ASSETS/css/animations.css" />
  </head>
  <body>
    <!-- Header -->
    <?php include_once 'components/header.php'; ?>

    <main id="main-content">
    <section class="page-hero">
      <div class="container">
        <span class="eyebrow">Admissions</span>
        <h1>Child Registration</h1>
        <p>Review the information requested before starting an application. If you have questions, contact the school office first.</p>
      </div>
    </section>

    <?php renderManagedContentForCurrentPage(); ?>

    <section class="section admissions-guidance">
      <div class="container">
        <div class="admissions-guidance-card">
          <h2>Before you apply</h2>
          <p>The form asks for child and parent or guardian details, including a guardian NIN, contact details, and residential address. A birth-certificate document is optional.</p>
          <p>This is personal information about a child. Submit it only if you are the parent or legal guardian and are ready to apply. Please do not include detailed medical information in the optional notes.</p>
          <p>For help before sharing application information, contact the <a href="./contact_us.php">school office</a>. See the <a href="./privacy-policy.php">Privacy Policy</a> for information about how submitted details are handled.</p>
        </div>
      </div>
    </section>

    <!-- Registration Form Section -->
    <section class="content-section">
      <div class="container3">
        <!-- Headed Paper / Letterhead -->
        <div class="headed-paper">
          <div class="letterhead-header">
            <div class="letterhead-logo">
              <img
                src="<?= SCHOOL_LOGO_MAIN ?>"
                alt="<?= SCHOOL_NAME_UPPER ?> Logo"
                width="80px"
                height="80px"
              />
            </div>
            <div class="letterhead-content">
              <h1><?= SCHOOL_NAME_UPPER ?></h1>
              <p class="school-motto"><?= SCHOOL_MOTTO ?></p>
              <div class="letterhead-contact">
                <span><i class="fa-solid fa-map-marker-alt"></i> <?= htmlspecialchars($school['address'], ENT_QUOTES, 'UTF-8') ?></span>
                <span><i class="fa-solid fa-phone"></i> <?= htmlspecialchars($school['phone_1'], ENT_QUOTES, 'UTF-8') ?><?= !empty($school['phone_2']) ? ' | ' . htmlspecialchars($school['phone_2'], ENT_QUOTES, 'UTF-8') : '' ?></span>
                <span><i class="fa-solid fa-envelope"></i> <?= htmlspecialchars($school['email'], ENT_QUOTES, 'UTF-8') ?></span>
              </div>
            </div>
          </div>
          <div class="letterhead-divider"></div>
        </div>

        <!-- Form Title -->
        <div class="form-title">
          <h2>Child Registration Form</h2>
          <p>Admission Application for <?= SCHOOL_NAME_UPPER ?></p>
        </div>

        <form
          class="registration-form"
          method="POST"
          action="./process_admission.php"
          enctype="multipart/form-data"
          novalidate
        >
          <div class="form-section">
            <h2>Child's Information</h2>
            <div class="form-row">
              <div class="form-group">
                <label for="child-name">Child's Full Name</label>
                <input type="text" id="child-name" name="child_name" required />
              </div>
              <div class="form-group">
                <label for="gender">Gender</label>
                <select id="gender" name="child_gender" required>
                  <option value="">Select Gender</option>
                  <option value="male">Male</option>
                  <option value="female">Female</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="birth-certificate">Birth Certificate (Upload)</label>
              <input
                type="file"
                id="birth-certificate"
                name="birth_certificate"
                accept=".pdf,.jpg,.jpeg,.png"
              />
              <span class="file-hint"
                >Accepted formats: PDF, JPG, PNG. Max file size: 5 MB.</span
              >
            </div>
          </div>

          <div class="form-section">
            <h2>Parents/Guardians Information</h2>
            <div class="form-row">
              <div class="form-group">
                <label for="parent-name">Full Name</label>
                <input
                  type="text"
                  id="parent-name"
                  name="parent_name"
                  required
                />
              </div>
            </div>
            <div class="form-row">
              <div class="form-group">
                <label for="parent-nin">Parent / Guardian NIN</label>
                <input
                  type="text"
                  id="parent-nin"
                  name="parent_nin"
                  required
                />
              </div>
              <div class="form-group">
                <label for="relationship">Relationship to Child</label>
                <select id="relationship" name="relationship" required>
                  <option value="">Select Relationship</option>
                  <option value="father">Father</option>
                  <option value="mother">Mother</option>
                  <option value="guardian">Guardian</option>
                </select>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group">
                <label for="parent-phone">Phone Number</label>
                <input
                  type="tel"
                  id="parent-phone"
                  name="parent_phone"
                  required
                />
              </div>
              <div class="form-group">
                <label for="parent-email">Email Address</label>
                <input
                  type="email"
                  id="parent-email"
                  name="parent_email"
                  required
                />
              </div>
            </div>
            <div class="form-group">
              <label for="address">Residential Address</label>
              <textarea
                id="address"
                name="address"
                rows="3"
                required
              ></textarea>
            </div>
          </div>

          <div class="form-section">
            <h2>Additional Information</h2>
            <div class="form-group">
              <label for="special-needs"
                >Is there anything the admissions team should know to support your child? (Optional)</label
              >
              <textarea
                id="special-needs"
                name="special_needs"
                rows="4"
                placeholder="Share only information relevant to this application. Please do not include detailed medical information."
              ></textarea>
            </div>

            <!-- Form Status Messages -->
            <div id="form-status-message" class="form-status-message" style="display: none;"></div>

            <!-- Consent Checkbox -->
            <div class="consent-group">
              <input
                type="checkbox"
                id="privacy-consent"
                name="privacy_consent"
                required
              />
              <label for="privacy-consent"
                >I agree to the <a href="./privacy-policy.php" target="_blank">Privacy Policy</a> and consent to the collection and use of my child's information
                for registration purposes.</label
              >
            </div>
            <button type="submit" class="btn btn-primary" id="submit-btn">
              Submit Registration
            </button>
          </div>
        </form>
      </div>
    </section>

      <!-- CTA BANNER -->
  <section class="cta-banner" id="tour">
    <div class="container">
    <h2>Questions about applying?</h2>
      <div class="cta-links">
      <a href="tel:+256774744394">Call +256 774-744-394</a>
      <a href="tel:+256752482066">Call +256 752-482-066</a>
        <a href="mailto:mugalureagan18@gmail.com">Email Us</a>
      </div>
    </div>
  </section>
  </main>

    <!-- Footer -->
    <?php include_once 'components/footer.php'; ?>
  <script>
    const admissionForm = document.querySelector(".registration-form");
    const statusMessage = document.getElementById("form-status-message");
    const submitBtn = document.getElementById("submit-btn");

    if (admissionForm) {
      admissionForm.addEventListener("submit", async (event) => {
        event.preventDefault();
        
        // Validate form
        if (!admissionForm.checkValidity()) {
          statusMessage.style.display = "block";
          statusMessage.className = "form-status-message error";
          statusMessage.innerHTML = "<i class='fa-solid fa-circle-exclamation'></i> Please fill in all required fields correctly.";
          return;
        }

        // Disable submit button and show loading state
        submitBtn.disabled = true;
        submitBtn.innerHTML = "<i class='fa-solid fa-spinner fa-spin'></i> Submitting...";

        try {
          const formData = new FormData(admissionForm);
          const response = await fetch("./process_admission.php", {
            method: "POST",
            body: formData
          });

          // Log response details for debugging
          console.log("Response status:", response.status);
          console.log("Response headers:", response.headers);
          
          const responseText = await response.text();
          console.log("Response text:", responseText);
          
          let result;
          try {
            result = JSON.parse(responseText);
          } catch (parseError) {
            throw new Error("Server returned invalid JSON: " + responseText);
          }

          statusMessage.style.display = "block";

          if (result.success) {
            statusMessage.className = "form-status-message success";
            statusMessage.innerHTML = `
              <div>
                <i class='fa-solid fa-circle-check'></i>
                <div>
                  <strong>Application Submitted Successfully!</strong>
                  <p>Thank you for your application. Your reference number is <strong>#${result.reference}</strong></p>
                  <p>A confirmation email has been sent to the provided email address. Our admissions team will review your application and contact you shortly.</p>
                </div>
              </div>
            `;
            
            // Reset form after 2 seconds
            setTimeout(() => {
              admissionForm.reset();
              statusMessage.style.display = "none";
              submitBtn.disabled = false;
              submitBtn.innerHTML = "Submit Registration";
              // Optionally redirect to home page or thank you page
              // window.location.href = "./home.php";
            }, 3000);
          } else {
            statusMessage.className = "form-status-message error";
            statusMessage.innerHTML = `
              <div>
                <i class='fa-solid fa-circle-exclamation'></i>
                <div>
                  <strong>Submission Error</strong>
                  <p>${result.message}</p>
                </div>
              </div>
            `;
            submitBtn.disabled = false;
            submitBtn.innerHTML = "Submit Registration";
          }
        } catch (error) {
          statusMessage.style.display = "block";
          statusMessage.className = "form-status-message error";
          statusMessage.innerHTML = `
            <div>
              <i class='fa-solid fa-circle-exclamation'></i>
              <div>
                <strong>Network Error</strong>
                <p>Error: ${error.message}</p>
                <p><small>Check browser console (F12) for more details.</small></p>
              </div>
            </div>
          `;
          submitBtn.disabled = false;
          submitBtn.innerHTML = "Submit Registration";
          console.error("Form submission error:", error);
        }
      });
    }
  </script>
  <script src="./ASSETS/js/utils.js"></script>
  <script src="./ASSETS/js/config.js?v=7"></script>
  <script src="./ASSETS/js/main.js?v=6"></script>
  </body>
</html>



