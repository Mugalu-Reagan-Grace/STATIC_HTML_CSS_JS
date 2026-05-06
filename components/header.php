<?php include_once 'brand.php'; ?>
<header>
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
