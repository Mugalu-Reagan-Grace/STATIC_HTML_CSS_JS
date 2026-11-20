<?php include_once 'brand.php'; ?>
<header>
  <a class="skip-link" href="#main-content">Skip to main content</a>
  <section
    id="mobile-sidebar"
    class="sidebar"
    aria-label="Mobile navigation"
    aria-hidden="true">
    <ul class="nav-links">
      <li class="close-sidebar">
        <button type="button" class="sidebar-close" aria-label="Close menu">
          <i class="fa-solid fa-x" aria-hidden="true"></i>
        </button>
      </li>
      <?= $navigation ?>
    </ul>
  </section>
  <div class="container">
    <nav class="navbar" aria-label="Main Navigation">
      <div class="logo">
        <div class="logo-icon">
          <img
            src="<?= $school['logo_no_bg'] ?>"
            alt="<?= $school['logo_alt'] ?>"
            width="70"
            height="70"
            loading="eager" />
          <div class="logo-labels">
            <div class="logo-text">
              <?= $school['name_markup'] ?>
            </div>
            <div class="logo-motto"><?= $school['motto'] ?></div>
          </div>
        </div>
      </div>
      <ul class="nav-links">
        <?= $navigation ?>
        <li class="open-sidebar">
          <button
            type="button"
            class="menu-toggle"
            aria-label="Open main menu"
            aria-controls="mobile-sidebar"
            aria-expanded="false">
            <i class="fa-solid fa-bars" aria-hidden="true"></i>
            <span class="menu-toggle-label">Menu</span>
          </button>
        </li>
      </ul>
    </nav>
  </div>
</header>
<?php
$pageNameMap = [
  'home.php' => 'Home',
  'about.php' => 'About',
  'admissions.php' => 'Admissions',
  'fees.php' => 'Fees',
  'gallery.php' => 'Gallery',
  'gallery_academics.php' => 'Academic Gallery',
  'programs.php' => 'Programs',
  'news-events.php' => 'News & Events',
  'staff.php' => 'Staff',
  'contact_us.php' => 'Contact',
  'privacy-policy.php' => 'Privacy Policy',
  'terms-of-service.php' => 'Terms of Service',
];
$currentPageFile = basename(parse_url($_SERVER['REQUEST_URI'] ?? 'home.php', PHP_URL_PATH));
if (!isset($pageNameMap[$currentPageFile]) && $currentPageFile !== 'home.php') {
  $currentPageFile = '';
}
?>
<?php if ($currentPageFile !== '' && $currentPageFile !== 'home.php'): ?>
<nav class="public-breadcrumb" aria-label="Breadcrumb">
  <div class="container">
    <ol>
      <li><a href="./home.php">Home</a></li>
      <li aria-current="page"><?= htmlspecialchars($pageNameMap[$currentPageFile] ?? 'Page', ENT_QUOTES, 'UTF-8') ?></li>
    </ol>
  </div>
</nav>
<?php endif; ?>
<button class="back-to-top" type="button" aria-label="Back to top" hidden>
  <i class="fa-solid fa-arrow-up" aria-hidden="true"></i>
</button>
<script src="./ASSETS/js/image-fallback.js"></script>
<script>
  (() => {
    const button = document.querySelector(".back-to-top");
    if (!button) return;
    const update = () => {
      button.hidden = window.scrollY < 500;
    };
    button.addEventListener("click", () => {
      window.scrollTo({ top: 0, behavior: "smooth" });
    });
    window.addEventListener("scroll", update, { passive: true });
    update();
  })();
</script>
