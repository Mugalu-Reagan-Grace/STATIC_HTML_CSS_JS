<?php require_once __DIR__ . '/brand.php'; ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>About Us - <?= SCHOOL_NAME_UPPER ?></title>
    <link
      rel="icon"
      type="image/x-icon"
      href="./ASSETS/IMAGES/favicon_io no bg/favicon.ico"
    />
    <link rel="stylesheet" href="calyst.css" />
    <link rel="stylesheet" href="./ASSETS/js/animations.css" />
  </head>
  <body>
    <!-- Header -->
    <?php include_once 'components/header.php'; ?>
    <!-- About Section -->
    <section id="about" class="section">
      <div class="container">
        <div class="section-title">
          <h2>About Our School</h2>
          <p>
            Discover our mission, values, and commitment to providing
            exceptional Christian education.
          </p>
        </div>
        <div class="about-content">
          <div class="about-text">
            <h3 style="text-align: center">
              Our Mission, Vision & Core Values
            </h3>
            <h2>MISSION</h2>
            <p>
              We are a learning Community with a reputation of delivering great
              education, enhancing talents and competencies beyond the
              traditional education for all our learners.
            </p>
            <h2>VISION</h2>
            <p>
              To provide quality Education incorporating a holistic programme
              that includes opportunities for social, emotional, physical, and
              educational development.
            </p>
            <h2>CORE VALUES</h2>
            <ul>
              <li>
                <strong>Integrity:</strong> We prioritize spiritual growth and
                encourage students to develop a personal relationship with Jesus
                Christ.
              </li>
              <li>
                <strong>Excellence:</strong> We are committed to high academic
                standards and continuous improvement in all areas of school
                life.
              </li>
              <li>
                <strong>Respect:</strong> We teach and model honesty,
                responsibility, and ethical behavior.
              </li>
              <li>
                <strong>Communication:</strong> We foster a supportive and
                inclusive environment where everyone is valued and respected.
              </li>
              <li>
                <strong>Achievement:</strong> We encourage students to serve
                others and make a positive impact in their communities.
              </li>
              <li>
                <strong>Partnership:</strong> We promote teamwork and
                partnership among students, teachers, and families.
              </li>
            </ul>
          </div>
        </div>
      </div>
    </section>

    <section class="section photo-showcase">
      <div class="container">
        <div class="section-title">
          <h2>Campus Life in Focus</h2>
          <p>Joyful learning, faith in action, and memorable milestones.</p>
        </div>
        <div class="photo-grid">
          <div class="photo-card">
            <img
              src="./ASSETS/images/ccs pics/BACK 2 SCH PICS 2024/AMUG4227.jpg"
              alt="Students engaged in classroom learning"
              loading="lazy"
            />
            <div class="photo-caption">Active classroom engagement</div>
          </div>
          <div class="photo-card">
            <img
              src="./ASSETS/images/ccs pics/Calyst Career day 2025/AMUG0031.JPG"
              alt="Students exploring career opportunities"
              loading="lazy"
            />
            <div class="photo-caption">Exploring futures</div>
          </div>
          <div class="photo-card">
            <img
              src="./ASSETS/images/ccs pics/Graduation pics 2024/AMUG9556.JPG"
              alt="Celebrating graduation achievements"
              loading="lazy"
            />
            <div class="photo-caption">Student achievements</div>
          </div>
          <div class="photo-card">
            <img
              src="./ASSETS/images/ccs pics/class image.JPG"
              alt="Students collaborating in group activities"
              loading="lazy"
            />
            <div class="photo-caption">Collaborative learning</div>
          </div>
        </div>
      </div>
    </section>

    <!-- Our Story & Accreditation -->
    <section class="section story-accreditation">
      <div class="container">
        <div class="section-title">
          <h2>Our Story & Accreditation</h2>
          <p>
            Rooted in faith, focused on excellence, serving families since 1995.
          </p>
        </div>
        <div class="grid two-col">
          <div class="card story-card">
            <h3>Our Journey</h3>
            <ul class="timeline">
              <li><span>1995</span> School founded with 45 students.</li>
              <li><span>2008</span> Opened modern science & computer labs.</li>
              <li>
                <span>2016</span> Athletics complex and performing arts studio
                added.
              </li>
              <li>
                <span>2022</span> Expanded STEM & robotics across middle grades.
              </li>
            </ul>
          </div>
          <div class="card accreditation-card">
            <h3>Accreditation & Partnerships</h3>
            <ul class="accreditation-list">
              <li>
                <strong>National Ministry of Education</strong> – Fully
                accredited K-12.
              </li>
              <li>
                <strong>Faith-Based Schools Association</strong> – Member in
                good standing.
              </li>
              <li>
                <strong>Safety & Child Protection</strong> – Annual safeguarding
                audits.
              </li>
              <li>
                <strong>Community Partnerships</strong> – Local churches, NGOs,
                and universities.
              </li>
            </ul>
          </div>
        </div>
      </div>
    </section>

    <!-- Leadership -->
    <section class="section leadership">
      <div class="container">
        <div class="section-title">
          <h2>Leadership Team</h2>
          <p>
            Experienced, faith-driven leaders serving our students and families.
          </p>
        </div>
        <div class="grid leadership-grid">
          <div class="leader-card">
            <div class="leader-photo">
              <img
                src="./ASSETS/images/admin-placeholder.jpg"
                alt="Nakibuuka Noeline"
              />
            </div>
            <h3>Nakibuuka Noeline</h3>
            <p class="role">Director</p>
            <p class="bio">
              25+ years in Christian education; champion for whole-child
              formation.
            </p>
          </div>
          <div class="leader-card">
            <div class="leader-photo">
              <img
                src="./ASSETS/images/admin-placeholder.jpg"
                alt="Nakiruuta Flavia"
              />
            </div>
            <h3>Nakiruuta Flavia</h3>
            <p class="role">Principal</p>
            <p class="bio">
              Curriculum lead; integrates inquiry-based learning with faith.
            </p>
          </div>
          <div class="leader-card">
            <div class="leader-photo">
              <img
                src="./ASSETS/images/admin-placeholder.jpg"
                alt="Sanyu Slyvia"
              />
            </div>
            <h3>Sanyu Slyvia</h3>
            <p class="role">Deputy Principal</p>
            <p class="bio">
              Oversees academics, assessment, and teacher development.
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- Academic Approach -->
    <section class="section academics-approach">
      <div class="container">
        <div class="section-title">
          <h2>Our Academic Approach</h2>
          <p>Challenging minds, shaping character, honoring God.</p>
        </div>
        <div class="grid three-col">
          <div class="card pill-card">
            <h3>Curriculum</h3>
            <p>
              Standards-aligned core (Math, Science, English, Social Studies)
              enriched with Bible, ICT, Arts.
            </p>
          </div>
          <div class="card pill-card">
            <h3>Teaching & Assessment</h3>
            <p>
              Inquiry-based lessons, projects, labs, and formative feedback to
              grow mastery and confidence.
            </p>
          </div>
          <div class="card pill-card">
            <h3>Support</h3>
            <p>
              Small classes, tutoring blocks, parent conferencing, and
              differentiated pathways.
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- Student Life & Facilities -->
    <section class="section student-life">
      <div class="container">
        <div class="section-title">
          <h2>Student Life & Facilities</h2>
          <p>Spaces and programs that help students thrive.</p>
        </div>
        <div class="grid three-col">
          <div class="card facility-card">
            <h3>Clubs & Activities</h3>
            <p>
              Debate, choir, drama, robotics, coding, art, praise & worship,
              community service.
            </p>
          </div>
          <div class="card facility-card">
            <h3>Sports</h3>
            <p>
              Soccer, basketball, athletics, netball; fitness and coaching for
              all levels.
            </p>
          </div>
          <div class="card facility-card">
            <h3>Campus & Labs</h3>
            <p>
              STEM labs, library & media center, computer suites, multipurpose
              hall, safe play areas.
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- Safety & Wellbeing -->
    <section class="section safety">
      <div class="container">
        <div class="section-title">
          <h2>Safety & Wellbeing</h2>
          <p>Every student is known, safe, and cared for.</p>
        </div>
        <div class="grid two-col">
          <div class="card">
            <h3>Safeguarding</h3>
            <ul class="checklist">
              <li>Trained child-protection team & clear reporting pathways.</li>
              <li>Visitor management, secure gates, and ID verification.</li>
              <li>Background checks for all staff and volunteers.</li>
            </ul>
          </div>
          <div class="card">
            <h3>Student Support</h3>
            <ul class="checklist">
              <li>Counseling and pastoral care for students and families.</li>
              <li>Health protocols with first-aid and nurse access.</li>
              <li>Social-emotional learning and peer mentoring.</li>
            </ul>
          </div>
        </div>
      </div>
    </section>

    <!-- Outcomes & Highlights -->
    <section class="section outcomes">
      <div class="container">
        <div class="section-title">
          <h2>Outcomes & Highlights</h2>
          <p>Results that reflect our mission.</p>
        </div>
        <div class="stats-grid outcomes-grid">
          <div class="stat-item">
            <h3>100%</h3>
            <p>Graduation</p>
          </div>
          <div class="stat-item">
            <h3>98%</h3>
            <p>College Acceptance</p>
          </div>
          <div class="stat-item">
            <h3>1:12</h3>
            <p>Student-Teacher Ratio</p>
          </div>
          <div class="stat-item">
            <h3>25+</h3>
            <p>Clubs & Activities</p>
          </div>
        </div>
      </div>
    </section>

    <!-- CTA BANNER -->
    <section class="cta-banner" id="tour">
      <div class="container">
        <h2>Have Questions? Schedule a Personalized Tour Today!</h2>
        <div class="cta-links">
          <a href="tel:(+256) 752-482-066"
            >Call Us:
            <p>(+256) 774-744-394</p>
            <p>(+256) 752-482-066</p></a
          >
          |
          <a href="mailto:mugalureagan18@gmail.com">Email Us</a>
        </div>
      </div>
    </section>
    <!-- Footer -->
    <?php include_once 'components/footer.php'; ?>
    <script src="./ASSETS/fonts/fontawesome/js/solid.js"></script>
    <script src="./ASSETS/fonts/fontawesome/js/fontawesome.js"></script>
    <script src="./ASSETS/js/utils.js"></script>
    <script src="./config.js"></script>
  <script src="./ASSETS/js/main.js"></script>
  </body>
</html>




