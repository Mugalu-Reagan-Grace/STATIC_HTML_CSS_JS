<?php require_once __DIR__ . '/brand.php'; ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Gallery - <?= SCHOOL_NAME_UPPER ?></title>
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
    <!-- Photo Gallery Section -->
    <div class="container2">
      <header class="gallery-header">
        <h1>🎓 School <span>Photo</span> Gallery</h1>
        <p>Capturing precious moments from our school community</p>
      </header>
    </div>
    <div class="container2">
      <div class="controls">
        <div class="search-filter">
          <div class="search-box">
            <svg
              class="search-icon icon"
              viewBox="0 0 24 24"
              fill="none"
              stroke="currentColor"
            >
              <circle cx="11" cy="11" r="8"></circle>
              <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
            </svg>
            <input
              type="text"
              placeholder="Search photos, people, or events..."
              aria-label="Search gallery"
            />
          </div>
          <div class="category-filter">
            <button class="category-btn active" data-filter="all">
              All Photos
            </button>
            <button class="category-btn" data-filter="events">Events</button>
            <button class="category-btn" data-filter="sports">Sports</button>
            <button class="category-btn" data-filter="academics">
              Academics
            </button>
            <button class="category-btn" data-filter="arts">Arts</button>
          </div>
        </div>
        <p class="results-count" aria-live="polite"></p>
      </div>

      <section class="gallery-stats">
        <div class="stat-card">
          <span class="stat-label">Events Covered</span>
          <span class="stat-value">45+</span>
          <span class="stat-hint">From assemblies to graduations</span>
        </div>
        <div class="stat-card">
          <span class="stat-label">Student Moments</span>
          <span class="stat-value">1.2k</span>
          <span class="stat-hint">Joy, service, leadership</span>
        </div>
        <div class="stat-card">
          <span class="stat-label">Campus Highlights</span>
          <span class="stat-value">320</span>
          <span class="stat-hint">Labs, libraries, athletics</span>
        </div>
        <div class="stat-card">
          <span class="stat-label">New Uploads</span>
          <span class="stat-value">Weekly</span>
          <span class="stat-hint">Fresh stories every term</span>
        </div>
      </section>

      <div class="gallery">
        <!-- Photo 1 -->
        <div
          class="photo-card"
          data-category="events"
          data-tags="graduation,celebration,ceremony"
          data-title="Graduation Ceremony 2024"
        >
          <img
            src="./ASSETS/IMAGES/ccs pics/Graduation pics 2024/AMUG9597.JPG"
            alt="Graduation Ceremony 2024"
            class="photo-img"
          />
          <div class="photo-info">
            <h3 class="photo-title">Graduation Ceremony 2024</h3>
            <div class="photo-meta">
              <span>June 15, 2024</span>
              <div class="photo-tags">
                <span class="tag-chip">Events</span>
                <span class="tag-chip">Class of 2024</span>
              </div>
            </div>
          </div>
        </div>

        <!-- Photo 2 -->
        <div
          class="photo-card"
          data-category="academics"
          data-tags="career day,mentorship,exploration"
          data-title="Career Day 2025"
        >
          <img
            src="./ASSETS/IMAGES/ccs pics/Calyst Career day 2025/AMUG0665.JPG"
            alt="Science Fair Winners"
            class="photo-img"
          />
          <div class="photo-info">
            <h3 class="photo-title">Career Day 2025</h3>
            <div class="photo-meta">
              <span>May 20, 2024</span>
              <div class="photo-tags">
                <span class="tag-chip">Academics</span>
                <span class="tag-chip">Career Pathways</span>
              </div>
            </div>
          </div>
        </div>

        <!-- Photo 3 -->
        <div
          class="photo-card"
          data-category="events"
          data-tags="orientation,community,welcome"
          data-title="Back to School 2024"
        >
          <img
            src="./ASSETS/IMAGES/ccs pics/BACK 2 SCH PICS 2024/AMUG4319.jpg"
            alt="Back to School 2024"
            class="photo-img"
          />
          <div class="photo-info">
            <h3 class="photo-title">Back to School 2024</h3>
            <div class="photo-meta">
              <span>April 12, 2024</span>
              <div class="photo-tags">
                <span class="tag-chip">Events</span>
                <span class="tag-chip">Community</span>
              </div>
            </div>
          </div>
        </div>

        <!-- Photo 4 -->
        <div
          class="photo-card"
          data-category="events"
          data-tags="friendship,group,class"
          data-title="Class Groups"
        >
          <img
            src="./ASSETS/IMAGES/ccs pics/Graduation pics 2024/AMUG9573.JPG"
            alt="Class Group"
            class="photo-img"
          />
          <div class="photo-info">
            <h3 class="photo-title">Class Groups</h3>
            <div class="photo-meta">
              <span>March 28, 2024</span>
              <div class="photo-tags">
                <span class="tag-chip">Events</span>
                <span class="tag-chip">Friends</span>
              </div>
            </div>
          </div>
        </div>

        <!-- Photo 5 -->
        <div
          class="photo-card"
          data-category="academics"
          data-tags="learning,classroom,teamwork"
          data-title="Classroom Time"
        >
          <img
            src="./ASSETS/IMAGES/ccs pics/BACK 2 SCH PICS 2024/AMUG4376.jpg"
            alt="Classroom Time"
            class="photo-img"
          />
          <div class="photo-info">
            <h3 class="photo-title">Classroom Time</h3>
            <div class="photo-meta">
              <span>February 15, 2024</span>
              <div class="photo-tags">
                <span class="tag-chip">Academics</span>
                <span class="tag-chip">Teamwork</span>
              </div>
            </div>
          </div>
        </div>

        <!-- Photo 6 -->
        <div
          class="photo-card"
          data-category="events"
          data-tags="staff,team,community"
          data-title="Staff"
        >
          <img
            src="./ASSETS/IMAGES/ccs pics/BACK 2 SCH PICS 2024/AMUG4330.jpg"
            alt="Staff"
            class="photo-img"
          />
          <div class="photo-info">
            <h3 class="photo-title">Staff</h3>
            <div class="photo-meta">
              <span>January 25, 2024</span>
              <div class="photo-tags">
                <span class="tag-chip">Community</span>
                <span class="tag-chip">Team</span>
              </div>
            </div>
          </div>
        </div>
      </div>

      <section class="album-highlights">
        <div class="album-card">
          <h3>Events & Celebrations</h3>
          <p>
            Graduations, cultural days, and campus milestones captured with joy.
          </p>
          <ul>
            <li>Processions and keynote moments</li>
            <li>Family participation highlights</li>
            <li>Stage, music, and awards snapshots</li>
          </ul>
        </div>
        <div class="album-card">
          <h3>Academics & Leadership</h3>
          <p>
            Hands-on learning, student leadership, and classroom excellence.
          </p>
          <ul>
            <li>STEM fairs, debates, and projects</li>
            <li>Clubs and service learning</li>
            <li>Teacher spotlights and mentoring</li>
          </ul>
        </div>
        <div class="album-card">
          <h3>Sports & Wellness</h3>
          <p>Team spirit across athletics, fitness, and healthy living.</p>
          <ul>
            <li>Track, field, and inter-house games</li>
            <li>Coaching and teamwork drills</li>
            <li>Personal bests and celebrations</li>
          </ul>
        </div>
        <div class="album-card">
          <h3>Arts & Creativity</h3>
          <p>
            Performances, exhibitions, and the everyday spark of imagination.
          </p>
          <ul>
            <li>Music, dance, and drama moments</li>
            <li>Studios, galleries, and showcases</li>
            <li>Student-led creative projects</li>
          </ul>
        </div>
      </section>
    </div>

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
    <script>
      // Lightweight gallery filtering and search
      (function () {
        const searchInput = document.querySelector(".search-box input");
        const categoryButtons = document.querySelectorAll(".category-btn");
        const cards = Array.from(document.querySelectorAll(".photo-card"));
        const resultsCount = document.querySelector(".results-count");

        const normalize = (text) => text.toLowerCase();

        const applyFilter = () => {
          const query = normalize(searchInput.value || "");
          const activeCategory =
            document.querySelector(".category-btn.active")?.dataset.filter ||
            "all";

          let visible = 0;
          cards.forEach((card) => {
            const category = card.dataset.category || "all";
            const title = normalize(card.dataset.title || "");
            const tags = normalize(card.dataset.tags || "");
            const matchesCategory =
              activeCategory === "all" || category === activeCategory;
            const matchesSearch =
              !query || title.includes(query) || tags.includes(query);
            const show = matchesCategory && matchesSearch;
            card.classList.toggle("hidden", !show);
            if (show) visible += 1;
          });

          if (resultsCount) {
            const total = cards.length;
            resultsCount.textContent = `${visible} of ${total} moments visible`;
          }
        };

        categoryButtons.forEach((btn) => {
          btn.addEventListener("click", () => {
            categoryButtons.forEach((b) => b.classList.remove("active"));
            btn.classList.add("active");
            applyFilter();
          });
        });

        searchInput?.addEventListener("input", applyFilter);
        applyFilter();
      })();
    </script>
  </body>
</html>




