<?php require_once __DIR__ . '/brand.php'; ?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>News & Events - <?= SCHOOL_NAME_UPPER ?></title>
  <meta
    name="description"
    content="Stay updated with upcoming events, school announcements, and recent stories from <?= SCHOOL_NAME_UPPER ?>." />
  <link
    rel="icon"
    type="image/x-icon"
    href="./ASSETS/IMAGES/favicon_io no bg/favicon.ico" />
  <link rel="stylesheet" href="calyst.css" />
  <link rel="stylesheet" href="./ASSETS/fonts/fontawesome/css/solid.css" />
  <link
    rel="stylesheet"
    href="./ASSETS/fonts/fontawesome/css/fontawesome.css" />
</head>

<body class="news-events-page">
  <?php include_once 'components/header.php'; ?>

  <main>
    <section class="page-hero">
      <div class="container">
        <span class="eyebrow">School updates</span>
        <h1>News & Events</h1>
        <p id="news-events-intro">
          Stay informed about what's happening at <?= SCHOOL_NAME_UPPER ?>.
        </p>
      </div>
    </section>

    <section class="news-events-container">
      <div class="container">
        <div class="section-title">
          <h2>What’s happening now</h2>
          <p>Upcoming events and recent announcements, grouped in one place.</p>
        </div>

        <div class="news-events-grid">
          <div class="section-column">
            <h2><i class="fa-solid fa-calendar-days"></i> Upcoming Events</h2>
            <div class="events-list" id="cms-events-list">
              <div class="event-card">
                <div class="event-date">
                  <span class="month">FEB</span>
                  <span class="day">14</span>
                </div>
                <div class="event-details">
                  <h3>Annual Science Fair</h3>
                  <p class="event-time">
                    <i class="fa-solid fa-clock"></i> 9:00 AM - 3:00 PM
                  </p>
                  <p class="event-location">
                    <i class="fa-solid fa-map-marker-alt"></i> School Auditorium
                  </p>
                  <p class="event-description">
                    Join us for our annual science fair where students showcase their innovative projects and discoveries.
                  </p>
                </div>
              </div>

              <div class="event-card">
                <div class="event-date">
                  <span class="month">MAR</span>
                  <span class="day">01</span>
                </div>
                <div class="event-details">
                  <h3>Parent-Teacher Conference</h3>
                  <p class="event-time">
                    <i class="fa-solid fa-clock"></i> 3:00 PM - 7:00 PM
                  </p>
                  <p class="event-location">
                    <i class="fa-solid fa-map-marker-alt"></i> School Campus
                  </p>
                  <p class="event-description">
                    Meet with teachers to discuss your child's academic progress and development.
                  </p>
                </div>
              </div>

              <div class="event-card">
                <div class="event-date">
                  <span class="month">MAR</span>
                  <span class="day">20</span>
                </div>
                <div class="event-details">
                  <h3>Sports Day</h3>
                  <p class="event-time">
                    <i class="fa-solid fa-clock"></i> 8:00 AM - 5:00 PM
                  </p>
                  <p class="event-location">
                    <i class="fa-solid fa-map-marker-alt"></i> School Grounds
                  </p>
                  <p class="event-description">
                    Celebrate athleticism and school spirit with inter-house competitions and games.
                  </p>
                </div>
              </div>

              <div class="event-card">
                <div class="event-date">
                  <span class="month">APR</span>
                  <span class="day">10</span>
                </div>
                <div class="event-details">
                  <h3>Educational Excursion</h3>
                  <p class="event-time">
                    <i class="fa-solid fa-clock"></i> 7:00 AM - 5:00 PM
                  </p>
                  <p class="event-location">
                    <i class="fa-solid fa-map-marker-alt"></i> National Museum
                  </p>
                  <p class="event-description">
                    Students will enjoy a guided tour of the National Museum to enhance their learning experience.
                  </p>
                </div>
              </div>
            </div>
          </div>

          <div class="section-column">
            <h2><i class="fa-solid fa-newspaper"></i> Latest News</h2>
            <div class="news-list" id="cms-news-list">
              <article class="news-card">
                <div class="news-header">
                  <h3>2024 Final Exam Results Released</h3>
                  <span class="news-date"><i class="fa-solid fa-calendar"></i> January 10, 2026</span>
                </div>
                <p class="news-excerpt">
                  Congratulations to all students on their outstanding performance! This year's results reflect the dedication of both students and teachers.
                </p>
                <a href="#" class="read-more">Read More →</a>
              </article>

              <article class="news-card">
                <div class="news-header">
                  <h3>New Scholarship Program Launched</h3>
                  <span class="news-date"><i class="fa-solid fa-calendar"></i> January 5, 2026</span>
                </div>
                <p class="news-excerpt">
                  <?= SCHOOL_NAME_UPPER ?> is proud to announce the launch of our new merit-based scholarship program to support talented students.
                </p>
                <a href="#" class="read-more">Read More →</a>
              </article>

              <article class="news-card">
                <div class="news-header">
                  <h3>Campus Renovation Project Completed</h3>
                  <span class="news-date"><i class="fa-solid fa-calendar"></i> December 28, 2025</span>
                </div>
                <p class="news-excerpt">
                  Our new state-of-the-art learning center and renovated sports facilities are now open and ready for use by all students.
                </p>
                <a href="#" class="read-more">Read More →</a>
              </article>

              <article class="news-card">
                <div class="news-header">
                  <h3>Students Win National Debate Competition</h3>
                  <span class="news-date"><i class="fa-solid fa-calendar"></i> December 20, 2025</span>
                </div>
                <p class="news-excerpt">
                  Our debate team showcased exceptional skills and won first place at the National Debate Championship. We are incredibly proud of their achievement!
                </p>
                <a href="#" class="read-more">Read More →</a>
              </article>

              <article class="news-card">
                <div class="news-header">
                  <h3>Career Fair 2025 Was a Great Success</h3>
                  <span class="news-date"><i class="fa-solid fa-calendar"></i> December 15, 2025</span>
                </div>
                <p class="news-excerpt">
                  Over 30 companies participated in our annual career fair, providing students with valuable insights into various career paths and opportunities.
                </p>
                <a href="#" class="read-more">Read More →</a>
              </article>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="newsletter-section">
      <div class="container">
        <div class="newsletter-box">
          <h2>Stay Updated</h2>
          <p>
            Subscribe to our newsletter to get the latest news and event updates delivered to your inbox.
          </p>
          <form class="newsletter-form">
            <input
              type="email"
              placeholder="Enter your email address"
              required />
            <button type="submit">Subscribe Now</button>
          </form>
        </div>
      </div>
    </section>
  </main>

  <?php include_once 'components/footer.php'; ?>

  <script src="./ASSETS/fonts/fontawesome/js/solid.js"></script>
  <script src="./ASSETS/fonts/fontawesome/js/fontawesome.js"></script>
  <script src="./ASSETS/js/utils.js"></script>
  <script src="./config.js"></script>
  <script src="./ASSETS/js/main.js"></script>
</body>

</html>
<button

  type="button"

  class="hamburger"

  aria-label="Open menu"


  
