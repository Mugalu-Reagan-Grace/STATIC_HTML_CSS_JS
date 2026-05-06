<?php require_once __DIR__ . '/brand.php'; ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Our Staff - <?= SCHOOL_NAME_UPPER ?></title>
    <meta
      name="description"
      content="Meet the dedicated educators and staff members at <?= SCHOOL_NAME_UPPER ?> who are committed to student success."
    />
    <link
      rel="icon"
      type="image/x-icon"
      href="./ASSETS/IMAGES/favicon_io no bg/favicon.ico"
    />
    <link rel="stylesheet" href="calyst.css" />
    <link rel="stylesheet" href="./ASSETS/fonts/fontawesome/css/solid.css" />
    <link
      rel="stylesheet"
      href="./ASSETS/fonts/fontawesome/css/fontawesome.css"
    />
  </head>
  <body class="staff-page">
    <!-- Header -->
    <?php include_once 'components/header.php'; ?>

    <!-- Main Content -->
    <main>
      <section class="page-hero">
        <div class="container">
          <span class="eyebrow">Our Team</span>
          <h1>Our Dedicated Staff</h1>
          <p>
            Meet the educators and administrators who are committed to your
            child's success
          </p>
        </div>
      </section>

      <section class="section photo-showcase">
        <div class="container">
          <div class="section-title">
            <h2>Guiding Students Every Day</h2>
            <p>Dedicated teachers, joyful classrooms, and caring support.</p>
          </div>
          <div class="photo-strip">
            <figure class="photo-item">
              <img
                src="./ASSETS/images/ccs pics/BACK 2 SCH PICS 2024/AMUG4243.jpg"
                alt="Teachers supporting students throughout the day"
                loading="lazy"
              />
              <figcaption class="photo-caption">Dedicated Support</figcaption>
            </figure>
            <figure class="photo-item">
              <img
                src="./ASSETS/images/ccs pics/Calyst Career day 2025/AMUG0068.JPG"
                alt="Staff engaging with students during activities"
                loading="lazy"
              />
              <figcaption class="photo-caption">Active Engagement</figcaption>
            </figure>
            <figure class="photo-item">
              <img
                src="./ASSETS/images/ccs pics/BACK 2 SCH PICS 2024/AMUG4255.jpg"
                alt="Staff mentoring and guiding students"
                loading="lazy"
              />
              <figcaption class="photo-caption">Mentorship Moments</figcaption>
            </figure>
          </div>
        </div>
      </section>

      <section class="staff-container">
        <div class="container">
          <!-- Administration Section -->
          <div class="department-section">
            <h2 class="department-title">
              <i class="fa-solid fa-users-gear"></i> Administration
            </h2>
            <div class="staff-grid">
              <div class="staff-card">
                <div class="staff-image">
                  <i class="fa-solid fa-user-tie"></i>
                </div>
                <div class="staff-info">
                  <h3>Nakibuuka Noeline</h3>
                  <p class="staff-position">Director</p>
                  <p class="staff-bio">
                    With over 15 years of educational leadership experience, Dr.
                    Name is dedicated to fostering an environment of academic
                    excellence.
                  </p>
                  <div class="staff-contact">
                    <a href="mailto:principal@calystschool.edu" title="Email"
                      ><i class="fa-solid fa-envelope"></i
                    ></a>
                    <a href="tel:+1234567890" title="Phone"
                      ><i class="fa-solid fa-phone"></i
                    ></a>
                  </div>
                </div>
              </div>

              <div class="staff-card">
                <div class="staff-image">
                  <i class="fa-solid fa-user-tie"></i>
                </div>
                <div class="staff-info">
                  <h3>Nakiruuta Flavia</h3>
                  <p class="staff-position">Principal</p>
                  <p class="staff-bio">
                    Committed to student development and school operations, the
                    Principal ensures a safe and conducive learning
                    environment.
                  </p>
                  <div class="staff-contact">
                    <a
                      href="mailto:principal@calystschool.edu"
                      title="Email"
                      ><i class="fa-solid fa-envelope"></i
                    ></a>
                    <a href="tel:+1234567890" title="Phone"
                      ><i class="fa-solid fa-phone"></i
                    ></a>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Academic Staff Section -->
          <div class="department-section">
            <h2 class="department-title">
              <i class="fa-solid fa-chalkboard-user"></i> Academic Staff
            </h2>
            <div class="staff-grid">
              <div class="staff-card">
                <div class="staff-image">
                  <i class="fa-solid fa-book"></i>
                </div>
                <div class="staff-info">
                  <h3>Teacher Name</h3>
                  <p class="staff-position">Mathematics Department</p>
                  <p class="staff-bio">
                    Passionate about making mathematics accessible and engaging,
                    with a focus on problem-solving skills.
                  </p>
                  <div class="staff-contact">
                    <a href="mailto:teacher@calystschool.edu" title="Email"
                      ><i class="fa-solid fa-envelope"></i
                    ></a>
                  </div>
                </div>
              </div>

              <div class="staff-card">
                <div class="staff-image">
                  <i class="fa-solid fa-book"></i>
                </div>
                <div class="staff-info">
                  <h3>Teacher Name</h3>
                  <p class="staff-position">English Language Arts</p>
                  <p class="staff-bio">
                    Dedicated to developing critical thinking and communication
                    skills through literature and writing.
                  </p>
                  <div class="staff-contact">
                    <a href="mailto:teacher@calystschool.edu" title="Email"
                      ><i class="fa-solid fa-envelope"></i
                    ></a>
                  </div>
                </div>
              </div>

              <div class="staff-card">
                <div class="staff-image">
                  <i class="fa-solid fa-flask"></i>
                </div>
                <div class="staff-info">
                  <h3>Teacher Name</h3>
                  <p class="staff-position">Science Department</p>
                  <p class="staff-bio">
                    Encourages experiential learning and scientific inquiry
                    through hands-on laboratory experiences.
                  </p>
                  <div class="staff-contact">
                    <a href="mailto:teacher@calystschool.edu" title="Email"
                      ><i class="fa-solid fa-envelope"></i
                    ></a>
                  </div>
                </div>
              </div>

              <div class="staff-card">
                <div class="staff-image">
                  <i class="fa-solid fa-globe"></i>
                </div>
                <div class="staff-info">
                  <h3>Teacher Name</h3>
                  <p class="staff-position">Social Studies</p>
                  <p class="staff-bio">
                    Fosters global awareness and critical citizenship through
                    culturally responsive teaching methods.
                  </p>
                  <div class="staff-contact">
                    <a href="mailto:teacher@calystschool.edu" title="Email"
                      ><i class="fa-solid fa-envelope"></i
                    ></a>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Support Staff Section -->
          <div class="department-section">
            <h2 class="department-title">
              <i class="fa-solid fa-people-group"></i> Support Staff
            </h2>
            <div class="staff-grid">
              <div class="staff-card">
                <div class="staff-image">
                  <i class="fa-solid fa-stethoscope"></i>
                </div>
                <div class="staff-info">
                  <h3>School Nurse</h3>
                  <p class="staff-position">Health Services</p>
                  <p class="staff-bio">
                    Provides comprehensive health services and maintains a safe,
                    healthy school environment for all students.
                  </p>
                  <div class="staff-contact">
                    <a href="mailto:nurse@calystschool.edu" title="Email"
                      ><i class="fa-solid fa-envelope"></i
                    ></a>
                  </div>
                </div>
              </div>

              <div class="staff-card">
                <div class="staff-image">
                  <i class="fa-solid fa-brain"></i>
                </div>
                <div class="staff-info">
                  <h3>School Counselor</h3>
                  <p class="staff-position">Student Support</p>
                  <p class="staff-bio">
                    Supports student mental health, academic planning, and
                    personal development through individual and group
                    counseling.
                  </p>
                  <div class="staff-contact">
                    <a href="mailto:counselor@calystschool.edu" title="Email"
                      ><i class="fa-solid fa-envelope"></i
                    ></a>
                  </div>
                </div>
              </div>

              <div class="staff-card">
                <div class="staff-image">
                  <i class="fa-solid fa-graduation-cap"></i>
                </div>
                <div class="staff-info">
                  <h3>Librarian</h3>
                  <p class="staff-position">Information Services</p>
                  <p class="staff-bio">
                    Manages the school library and promotes information literacy
                    and a love of reading among students.
                  </p>
                  <div class="staff-contact">
                    <a href="mailto:librarian@calystschool.edu" title="Email"
                      ><i class="fa-solid fa-envelope"></i
                    ></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </main>

    <!-- Footer -->
    <?php include_once 'components/footer.php'; ?>

    <script src="./config.js"></script>
  <script src="./ASSETS/js/main.js"></script>
  </body>
</html>




