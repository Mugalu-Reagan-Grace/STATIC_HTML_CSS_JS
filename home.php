<?php require_once __DIR__ . '/brand.php'; ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta
      name="description"
      content="<?= $school['name_upper'] ?> - HOFU YA BWANA. Providing Christ-centered education since 1995 with focus on academics, character development, and faith-based learning for students."
    />
    <meta
      name="keywords"
      content="Christian school, Uganda, private school, faith-based education, Christ-centered learning, academic excellence"
    />
    <meta name="author" content="<?= $school['name_upper'] ?>" />
    <meta name="theme-color" content="#1e3a8a" />

    <!-- Open Graph / Social Media -->
    <meta property="og:type" content="website" />
    <meta property="og:url" content="https://calystchristianschool.com/" />
    <meta
      property="og:title"
      content="<?= $school['name_upper'] ?> - Excellence in Christian Education"
    />
    <meta
      property="og:description"
      content="Nurturing minds, hearts, and spirits through Christ-centered learning and academic excellence."
    />
    <meta
      property="og:image"
      content="<?= $school['logo_main'] ?>"
    />

    <title>
      Home - <?= $school['name_upper'] ?> | Excellence in Christian Education
    </title>
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
    <link rel="stylesheet" href="./ASSETS/js/animations.css" />
  </head>
  <body>
    <!-- Header -->
    <?php include_once 'components/header.php'; ?>

    <!-- Hero Section with Slideshow -->
    <section id="home" class="hero">
      <div class="slideshow-container">
        <div class="slide fade">
          <img
            src="./ASSETS/images/ccs pics/BACK 2 SCH PICS 2024/AMUG4213.jpg"
            alt="Students on campus during back to school season at <?= $school['name_upper'] ?>"
            loading="eager"
          />
          <div class="slide-caption">
            Welcome to <?= $school['name_upper'] ?>
            <span class="slide-caption-sub">Back-to-school joy</span>
          </div>
        </div>

        <div class="slide fade">
          <img
            src="./ASSETS/images/ccs pics/Calyst Career day 2025/AMUG0018.JPG"
            alt="Students participating in Career Day event at <?= $school['name_upper'] ?>"
            loading="lazy"
          />
          <div class="slide-caption">
            Building Futures Through Excellence
            <span class="slide-caption-sub">Career day inspiration</span>
          </div>
        </div>

        <div class="slide fade">
          <img
            src="./ASSETS/images/ccs pics/Graduation pics 2024/AMUG9550.JPG"
            alt="Graduation Ceremony at <?= $school['name_upper'] ?>"
            loading="lazy"
          />
          <div class="slide-caption">
            Celebrating Student Success
            <span class="slide-caption-sub">Graduation milestones</span>
          </div>
        </div>

        <!-- Slideshow controls -->
        <button
          class="prev"
          onclick="changeSlide(-1)"
          aria-label="Previous slide"
        >
          &#10094;
        </button>
        <button class="next" onclick="changeSlide(1)" aria-label="Next slide">
          &#10095;
        </button>

        <!-- Slide indicators -->
        <div class="slide-indicators">
          <button
            class="indicator"
            onclick="currentSlide(1)"
            aria-label="Go to slide 1"
          ></button>
          <button
            class="indicator"
            onclick="currentSlide(2)"
            aria-label="Go to slide 2"
          ></button>
          <button
            class="indicator"
            onclick="currentSlide(3)"
            aria-label="Go to slide 3"
          ></button>
        </div>
      </div>

      <div class="hero-container">
        <div class="hero-content">
          <h1>Excellence in Christian Education</h1>
          <p>
            Nurturing minds, hearts, and spirits through Christ-centered
            learning and academic excellence.
          </p>
          <a href="./admissions.php" class="btn">Enroll Today</a>
          <a href="#tour" class="btn btn-secondary">Schedule a Tour</a>
          <div class="testimonial">
            “Our child thrived academically and spiritually at <?= $school['name'] ?>.” –
            Parent, Class of ‘25
          </div>
        </div>
      </div>
    </section>

    <!-- HIGHLIGHTS -->
    <section class="highlights" id="about">
      <div class="container">
        <h2>Why Choose Calyst?</h2>
        <div class="highlights-grid">
          <div class="highlight-card">
            <div class="icon">📚</div>
            <h3>Academic Excellence</h3>
            <p>
              Rigorous curriculum aligned with state standards + biblical
              worldview.
            </p>
          </div>
          <div class="highlight-card">
            <div class="icon">❤️</div>
            <h3>Christ-Centered Values</h3>
            <p>
              Daily chapel, Bible classes, and character development in every
              subject.
            </p>
          </div>
          <div class="highlight-card">
            <div class="icon">🎯</div>
            <h3>Holistic Development</h3>
            <p>
              Sports, arts, leadership, and service opportunities for every
              student.
            </p>
          </div>
          <div class="highlight-card">
            <div class="icon">👨‍👩‍👧‍👦</div>
            <h3>Strong Community</h3>
            <p>
              Active parent involvement and family-centered events all year.
            </p>
          </div>
        </div>
      </div>
    </section>

    <section class="interactive-gallery" aria-labelledby="interactive-heading">
      <div class="container">
        <div class="section-title">
          <h2 id="interactive-heading">See Calyst in Action</h2>
          <p>Hover to explore the moments that shape our learners each day.</p>
        </div>
        <div class="interactive-controls" aria-label="Gallery controls">
          <button
            class="gallery-arrow"
            type="button"
            data-direction="prev"
            aria-label="Scroll gallery left"
          >
            &#10094;
          </button>
          <a class="gallery-link" href="./gallery.php">View Gallery</a>
          <button
            class="gallery-arrow"
            type="button"
            data-direction="next"
            aria-label="Scroll gallery right"
          >
            &#10095;
          </button>
        </div>
        <div class="interactive-grid">
          <article class="interactive-card">
            <img
              src="./ASSETS/images/ccs pics/BACK 2 SCH PICS 2024/AMUG4213.jpg"
              alt="Students arriving on campus"
              loading="lazy"
            />
            <div class="interactive-overlay">
              <h3>Welcoming Mornings</h3>
              <p>Smiles, greetings, and a safe start to the day.</p>
              <span class="interactive-actions">Explore moments</span>
            </div>
          </article>
          <article class="interactive-card">
            <img
              src="./ASSETS/images/ccs pics/Calyst Career day 2025/AMUG0018.JPG"
              alt="Students during career day"
              loading="lazy"
            />
            <div class="interactive-overlay">
              <h3>Career Day</h3>
              <p>Inspiring futures through real-world connections.</p>
              <span class="interactive-actions">Explore moments</span>
            </div>
          </article>
          <article class="interactive-card">
            <img
              src="./ASSETS/images/ccs pics/Graduation pics 2024/AMUG9550.JPG"
              alt="Graduation celebration"
              loading="lazy"
            />
            <div class="interactive-overlay">
              <h3>Graduation Day</h3>
              <p>Milestones that celebrate growth and excellence.</p>
              <span class="interactive-actions">Explore moments</span>
            </div>
          </article>
          <article class="interactive-card">
            <img
              src="./ASSETS/IMAGES/ccs pics/Graduation pics 2024/AMUG9648.JPG"
              alt="Students presenting a project"
              loading="lazy"
            />
            <div class="interactive-overlay">
              <h3>Project Learning</h3>
              <p>Hands-on work that builds confidence.</p>
              <span class="interactive-actions">Explore moments</span>
            </div>
          </article>
          <article class="interactive-card">
            <img
              src="./ASSETS/IMAGES/ccs pics/Graduation pics 2024/AMUG9545.JPG"
              alt="Students collaborating in class"
              loading="lazy"
            />
            <div class="interactive-overlay">
              <h3>Team Collaboration</h3>
              <p>Learning together with encouragement and care.</p>
              <span class="interactive-actions">Explore moments</span>
            </div>
          </article>
          <article class="interactive-card">
            <img
              src="./ASSETS/IMAGES/ccs pics/computer.jpg"
              alt="Students in the computer lab"
              loading="lazy"
            />
            <div class="interactive-overlay">
              <h3>Tech-Ready Classrooms</h3>
              <p>Digital skills for a changing world.</p>
              <span class="interactive-actions">Explore moments</span>
            </div>
          </article>
        </div>
      </div>
    </section>

    <!-- STATS -->
    <section class="stats">
      <div class="container">
        <h2>By the Numbers</h2>
        <div class="stats-grid">
          <div class="stat-item">
            <h3>1995</h3>
            <p>Founded</p>
          </div>
          <div class="stat-item">
            <h3>350+</h3>
            <p>Students</p>
          </div>
          <div class="stat-item">
            <h3>1:12</h3>
            <p>Teacher Ratio</p>
          </div>
          <div class="stat-item">
            <h3>100%</h3>
            <p>Graduation</p>
          </div>
          <div class="stat-item">
            <h3>98%</h3>
            <p>College Acceptance</p>
          </div>
        </div>
      </div>
    </section>

    <!-- SCHOOL ADMINISTRATION -->
    <section class="administration" id="administration">
      <div class="container">
        <h2>School Administration</h2>
        <p class="section-subtitle">
          Meet the leaders dedicated to your child's success
        </p>
        <div class="admin-grid">
          <div class="admin-card">
            <div class="admin-photo">
              <img
                src="./ASSETS/images/admin-placeholder.jpg"
                alt="Director Name"
                loading="lazy"
              />
            </div>
            <div class="admin-info">
              <h3 class="admin-name">Nakibuuka Noeline</h3>
              <p class="admin-title">School Director</p>
            </div>
          </div>
          <div class="admin-card">
            <div class="admin-photo">
              <img
                src="./ASSETS/images/admin-placeholder.jpg"
                alt="Principal Name"
                loading="lazy"
              />
            </div>
            <div class="admin-info">
              <h3 class="admin-name">Nakiruuta Flavia</h3>
              <p class="admin-title">School Principal</p>
            </div>
          </div>
          <div class="admin-card">
            <div class="admin-photo">
              <img
                src="./ASSETS/images/admin-placeholder.jpg"
                alt="Deputy Principal Name"
                loading="lazy"
              />
            </div>
            <div class="admin-info">
              <h3 class="admin-name">Sanyu Slyvia</h3>
              <p class="admin-title">Deputy Principal</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- WORD FROM THE PRINCIPAL -->
    <section class="principal-message" id="principal-message">
      <div class="container">
        <h2>Word from the Principal</h2>
        <div class="message-container">
          <div class="principal-photo-large">
            <img
              src="./ASSETS/images/principal-photo.jpg"
              alt="Nakiruuta Flavia - School Principal"
              loading="lazy"
            />
            <div class="principal-badge">
              <h4>Nakiruuta Flavia</h4>
              <p>School Principal</p>
            </div>
          </div>
          <div class="principal-message-content">
            <blockquote class="principal-quote">
              <p class="quote-mark">"</p>
              <p class="message-text">
                Welcome to <?= $school['name'] ?>, where we believe every child
                is a unique creation of God, gifted with potential and purpose.
                For over 25 years, we have been committed to providing an
                education that nurtures not only the mind, but also the heart
                and spirit.
              </p>
              <p class="message-text">
                Our mission is to partner with families in developing students
                who are academically excellent, spiritually grounded, and ready
                to make a positive impact in their communities. We combine
                rigorous academics with biblical principles, ensuring that every
                lesson reflects God's truth and love.
              </p>
              <p class="message-text">
                I invite you to visit our campus, meet our dedicated faculty,
                and experience firsthand the warm, Christ-centered community
                that makes <?= $school['name_upper'] ?> a special place for children
                to learn and grow.
              </p>
              <p class="message-text signature">
                Blessings,<br />
                <strong>Nakiruuta Flavia</strong>
              </p>
            </blockquote>
          </div>
        </div>
      </div>
    </section>

    <!-- EVENTS & NEWS -->
    <section class="events-news" id="events">
      <div class="container">
        <h2>Latest Updates</h2>
        <div class="tabs">
          <div class="tab active">Upcoming Events</div>
          <div class="tab"><a href="./news-events.php">News</a></div>
        </div>
        <ul class="event-list">
          <li class="event-item">
            <span class="event-date">Oct 25</span> – Fall Family Festival
          </li>
          <li class="event-item">
            <span class="event-date">Nov 1</span> – Open House (9 AM – 1 PM)
          </li>
          <li class="event-item">
            <span class="event-date">Dec 15</span> – Christmas Concert
          </li>
        </ul>
      </div>
    </section>

    <!-- TESTIMONIALS -->
    <section class="testimonials">
      <div class="container">
        <h2>What Families Say</h2>
        <div class="testimonial-grid">
          <div class="testimonial-card">
            “The teachers truly care about each child’s growth — not just in
            grades, but in faith and character.”
            <div class="testimonial-author">
              — Sarah T., Parent of 3rd Grader
            </div>
          </div>
          <div class="testimonial-card">
            “I love how we learn about God in every class. It makes school feel
            meaningful.”
            <div class="testimonial-author">— Jacob, 7th Grade Student</div>
          </div>
        </div>
      </div>
    </section>

    <!-- CTA BANNER -->
    <section class="cta-banner" id="tour" aria-labelledby="cta-heading">
      <div class="container">
        <h2 id="cta-heading">
          Have Questions? Schedule a Personalized Tour Today!
        </h2>
        <div class="cta-links">
          <div class="cta-phone">
            <span class="cta-label">Call Us:</span>
            <a href="tel:+256774744394">Call +256 774-744-394</a>
            <span class="cta-separator">or</span>
            <a href="tel:+256752482066">Call +256 752-482-066</a>
          </div>
          <span class="cta-divider" aria-hidden="true">|</span>
          <a href="mailto:mugalureagan18@gmail.com" class="cta-email"
            >Email Us</a
          >
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




