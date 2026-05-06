<?php require_once __DIR__ . '/brand.php'; ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Child Registration Form - <?= SCHOOL_NAME_UPPER ?></title>
    <link
      rel="icon"
      type="image/x-icon"
      href="./ASSETS/IMAGES/favicon_io no bg/favicon.ico"
    />
    <link rel="stylesheet" href="calyst.css" />
    <link rel="stylesheet" href="./ASSETS/js/animations.css" />
  </head>
  <body style="background: linear-gradient(135deg, var(--primary-blue), var(--dark-blue));">
    <!-- Header -->
    <?php include_once 'components/header.php'; ?>

    <section class="section photo-showcase">
      <div class="container">
        <div class="section-title">
          <h2>Start Your Calyst Journey</h2>
          <p>A welcoming community where every child is known and nurtured.</p>
        </div>
        <div class="photo-strip">
          <figure class="photo-item">
            <img
              src="./ASSETS/images/ccs pics/BACK 2 SCH PICS 2024/AMUG4236.jpg"
              alt="Students excited to start their learning journey"
              loading="lazy"
            />
            <figcaption class="photo-caption">Ready to Learn</figcaption>
          </figure>
          <figure class="photo-item">
            <img
              src="./ASSETS/images/ccs pics/Calyst Career day 2025/AMUG0042.JPG"
              alt="Students exploring professional opportunities"
              loading="lazy"
            />
            <figcaption class="photo-caption">Future Pathways</figcaption>
          </figure>
          <figure class="photo-item">
            <img
              src="./ASSETS/images/ccs pics/Graduation pics 2024/AMUG9577.JPG"
              alt="Proud graduates at commencement ceremony"
              loading="lazy"
            />
            <figcaption class="photo-caption">Success Stories</figcaption>
          </figure>
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
                <span><i class="fa-solid fa-map-marker-alt"></i> P.O.BOX 124666, Kampala, Uganda</span>
                <span><i class="fa-solid fa-phone"></i> (+256) 774-744-394 | (+256) 752-482-066</span>
                <span><i class="fa-solid fa-envelope"></i> mugalureagan18@gmail.com</span>
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
            <div class="form-row">
              <div class="form-group">
                <label for="parent-nin">NIN</label>
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
                >Does your child have any special needs or requirements?</label
              >
              <textarea
                id="special-needs"
                name="special_needs"
                rows="4"
                placeholder="Please describe any special needs, allergies, medical conditions, or other important information"
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
      <h2>Have Questions? Schedule a Personalized Tour Today!</h2>
      <div class="cta-links">
        <a href="tel:(+256) 752-482-066">Call Us: <p>(+256) 774-744-394</p><p>(+256) 752-482-066</p></a> |
        <a href="mailto:mugalureagan18@gmail.com">Email Us</a>
      </div>
    </div>
  </section>

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
  <script src="./ASSETS/fonts/fontawesome/js/solid.js"></script>
  <script src="./ASSETS/fonts/fontawesome/js/fontawesome.js"></script>
  <script src="./ASSETS/js/utils.js"></script>
  <script src="./config.js"></script>
  <script src="./ASSETS/js/main.js"></script>
  </body>
</html>




