<?php require_once __DIR__ . '/brand.php'; ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Programs - <?= SCHOOL_NAME_UPPER ?></title>
    <meta
      name="description"
      content="Explore the programs, learning stages, enrichment opportunities, and daily rhythm at <?= SCHOOL_NAME_UPPER ?>."
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
  <body>
    <?php include_once 'components/header.php'; ?>

    <main>
      <section class="program-hero">
        <div class="container">
          <div class="program-hero-content">
            <span class="eyebrow">Learning pathways</span>
            <h1>Programs designed to build confidence and character</h1>
            <p class="lead">
              From early years to upper primary, every stage is guided by strong
              academics, faith formation, and enrichment that helps students grow.
            </p>
            <div class="program-hero-stats">
              <div class="stat-card">
                <span class="stat-label">Age groups served</span>
                <span class="stat-value">3-14</span>
                <span class="stat-hint">Early years through upper primary</span>
              </div>
              <div class="stat-card">
                <span class="stat-label">Faith in action</span>
                <span class="stat-value">Weekly</span>
                <span class="stat-hint">Chapel, devotions, and service</span>
              </div>
            </div>
          </div>
        </div>
      </section>

    <section class="section photo-showcase">
      <div class="container">
        <div class="section-title">
          <h2>Learning in Every Moment</h2>
          <p>Hands-on projects, joyful discovery, and student leadership.</p>
        </div>
        <div class="photo-strip">
          <figure class="photo-item">
            <img
              src="./ASSETS/IMAGES/ccs pics/Graduation pics 2024/AMUG9568.JPG"
              alt="Early years learners in class"
              loading="lazy"
            />
            <figcaption class="photo-caption">Early Years Discovery</figcaption>
          </figure>
          <figure class="photo-item">
            <img
              src="./ASSETS/IMAGES/ccs pics/Graduation pics 2024/AMUG9576.JPG"
              alt="Lower primary students collaborating"
              loading="lazy"
            />
            <figcaption class="photo-caption">
              Lower Primary Teamwork
            </figcaption>
          </figure>
          <figure class="photo-item">
            <img
              src="./ASSETS/IMAGES/ccs pics/Graduation pics 2024/AMUG9648.JPG"
              alt="Students presenting a project"
              loading="lazy"
            />
            <figcaption class="photo-caption">
              Project-Based Learning
            </figcaption>
          </figure>
        </div>
      </div>
    </section>

    <!-- Programs Section -->
    <section id="programs" class="section programs">
      <div class="container">
        <div class="section-title">
          <h2>Programs by stage</h2>
          <p>Clear pathways with the right challenge, care, and support.</p>
        </div>
        <div class="programs-grid">
          <div class="program-card">
            <div class="program-icon">
              <img
                src="./ASSETS/IMAGES/ccs pics/Graduation pics 2024/AMUG9568.JPG"
                alt="Kindergarten classroom"
              />
            </div>
            <div class="program-meta">
              <span class="pill">Ages 3-5</span>
              <span class="pill">Early Years</span>
            </div>
            <h3>Kindergarten</h3>
            <p>
              Play-based foundations in literacy, numeracy, wonder, and faith.
            </p>
            <ul class="program-list">
              <li>Hands-on centers and sensory learning</li>
              <li>Daily phonics, storytelling, and songs</li>
              <li>Social-emotional growth with Bible truths</li>
            </ul>
          </div>
          <div class="program-card">
            <div class="program-icon">
              <img
                src="./ASSETS/IMAGES/ccs pics/Graduation pics 2024/AMUG9576.JPG"
                alt="Lower primary students"
              />
            </div>
            <div class="program-meta">
              <span class="pill">Grades P1-P3</span>
              <span class="pill">Core Skills</span>
            </div>
            <h3>Lower Primary</h3>
            <p>
              Strong literacy and numeracy anchored in curiosity and character.
            </p>
            <ul class="program-list">
              <li>Guided reading and writing workshops</li>
              <li>Math fluency through games and practice</li>
              <li>Nature, art, and music for joyful discovery</li>
            </ul>
          </div>
          <div class="program-card">
            <div class="program-icon">
              <img
                src="./ASSETS/IMAGES/ccs pics/Graduation pics 2024/AMUG9648.JPG"
                alt="Middle primary project work"
              />
            </div>
            <div class="program-meta">
              <span class="pill">Grades P4-P5</span>
              <span class="pill">Inquiry</span>
            </div>
            <h3>Middle Primary</h3>
            <p>
              Deeper inquiry, collaboration, and problem-solving across
              subjects.
            </p>
            <ul class="program-list">
              <li>Project-based science and social studies</li>
              <li>Digital literacy and research skills</li>
              <li>Service projects that connect learning to community</li>
            </ul>
          </div>
          <div class="program-card">
            <div class="program-icon">
              <img
                src="./ASSETS/IMAGES/ccs pics/Graduation pics 2024/AMUG9545.JPG"
                alt="Upper primary students"
              />
            </div>
            <div class="program-meta">
              <span class="pill">Grades P6-P7</span>
              <span class="pill">Readiness</span>
            </div>
            <h3>Upper Primary</h3>
            <p>
              High expectations, leadership, and exam readiness with balance.
            </p>
            <ul class="program-list">
              <li>Strengthened math, literacy, and science labs</li>
              <li>Study skills, goal setting, and feedback</li>
              <li>Leadership roles and chapel mentoring</li>
            </ul>
          </div>
          <div class="program-card">
            <div class="program-icon">
              <img
                src="./ASSETS/IMAGES/ccs pics/computer.jpg"
                alt="Holiday program activities"
              />
            </div>
            <div class="program-meta">
              <span class="pill">Term Breaks</span>
              <span class="pill">Enrichment</span>
            </div>
            <h3>Holiday Programs</h3>
            <p>
              Fun, skill-building camps that keep students curious and active.
            </p>
            <ul class="program-list">
              <li>STEM labs, coding, and robotics</li>
              <li>Sports clinics and arts intensives</li>
              <li>Reading clubs and creative challenges</li>
            </ul>
          </div>
        </div>
      </div>
    </section>

    <!-- Learning Pillars -->
    <section class="section learning-pillars">
      <div class="container">
        <div class="section-title">
          <h2>How we teach and nurture</h2>
          <p>
            Balanced academics, faith formation, and habits for lifelong
            learning.
          </p>
        </div>
        <div class="grid two-col">
          <div class="card">
            <h3>Academic pillars</h3>
            <ul class="program-list">
              <li>
                Literacy & communication: reading, writing, speaking with
                confidence
              </li>
              <li>
                Numeracy & reasoning: fluency, problem-solving, real-world math
              </li>
              <li>
                Science & inquiry: experiments, observation, reflective thinking
              </li>
              <li>Creativity & arts: music, visual arts, drama, and design</li>
              <li>Digital fluency: safe, purposeful use of technology</li>
            </ul>
          </div>
          <div class="card">
            <h3>Character & faith</h3>
            <ul class="program-list">
              <li>Daily devotions and weekly chapel</li>
              <li>Service learning that puts love in action</li>
              <li>Growth mindset and perseverance coaching</li>
              <li>Peer leadership and conflict resolution</li>
              <li>Wellbeing routines: movement, mindfulness, and prayer</li>
            </ul>
          </div>
        </div>
      </div>
    </section>

    <!-- Enrichment Section -->
    <section class="section enrichment">
      <div class="container">
        <div class="section-title">
          <h2>Co-curricular & enrichment</h2>
          <p>Opportunities that stretch talents and spark new passions.</p>
        </div>
        <div class="enrichment-grid">
          <div class="enrichment-card">
            <h3>STEM & Innovation</h3>
            <p>Robotics, coding, science clubs, and maker challenges.</p>
          </div>
          <div class="enrichment-card">
            <h3>Sports & Wellness</h3>
            <p>
              Football, athletics, dance, fitness clubs, and inter-house games.
            </p>
          </div>
          <div class="enrichment-card">
            <h3>Arts & Performance</h3>
            <p>Choir, drama, visual arts studios, and cultural showcases.</p>
          </div>
          <div class="enrichment-card">
            <h3>Leadership & Service</h3>
            <p>
              Prefectship, peer mentoring, chapel teams, and community outreach.
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- Daily Rhythm -->
    <section class="section daily-rhythm">
      <div class="container">
        <div class="section-title">
          <h2>A day at Calyst</h2>
          <p>Structured for focus, movement, and connection.</p>
        </div>
        <ul class="timeline">
          <li>
            <span>07:30</span> Arrival, morning greeting, and soft start
            activities
          </li>
          <li><span>08:00</span> Devotions and homeroom</li>
          <li><span>08:30</span> Literacy & numeracy blocks</li>
          <li><span>11:00</span> Science, social studies, or project time</li>
          <li><span>13:00</span> Lunch, play, and wellbeing breaks</li>
          <li><span>14:00</span> Arts, sports, or clubs</li>
          <li><span>15:30</span> Reflection, homework support, dismissal</li>
        </ul>
      </div>
    </section>

    <!-- Admissions CTA -->
    <section class="section admissions-steps">
      <div class="container">
        <div class="section-title">
          <h2>Ready to find the right fit?</h2>
          <p>
            We guide families through placement, readiness checks, and next
            steps.
          </p>
        </div>
        <div class="admission-steps-grid">
          <div class="step-card">
            <div class="step-number">1</div>
            <h3>Connect</h3>
            <p>
              Schedule a tour or call to share your child’s needs and goals.
            </p>
          </div>
          <div class="step-card">
            <div class="step-number">2</div>
            <h3>Assess & place</h3>
            <p>Readiness check, past reports review, and a warm class visit.</p>
          </div>
          <div class="step-card">
            <div class="step-number">3</div>
            <h3>Start strong</h3>
            <p>
              Onboarding plan, teacher meet-and-greet, and family partnership.
            </p>
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




