<?php

function adminPageStart(string $title, string $active, string $subtitle = ''): void
{
    $adminName = $_SESSION['admin_name'] ?? 'Administrator';
    $initial = strtoupper(substr($adminName, 0, 1));
    $navItems = [
        ['dashboard.php', 'Dashboard', 'fa-chart-pie'],
        ['edit-school.php', 'School settings', 'fa-school'],
        ['edit-pages.php', 'Pages', 'fa-file-lines'],
        ['manage-news.php', 'News & events', 'fa-newspaper'],
        ['manage-staff.php', 'Staff', 'fa-users'],
        ['manage-gallery.php', 'Gallery', 'fa-images'],
        ['manage-testimonials.php', 'Testimonials', 'fa-quote-left'],
        ['manage-fees.php', 'Fees', 'fa-money-bill-wave'],
        ['contact-submissions.php', 'Messages', 'fa-inbox'],
    ];
    if (($_SESSION['admin_role'] ?? '') === 'admin') {
        $navItems[] = ['accounts.php', 'CMS accounts', 'fa-user-plus'];
    }
    ?>
    <!doctype html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="robots" content="noindex, nofollow">
        <meta name="theme-color" content="#1e3a8a">
        <title><?= adminEscape($title); ?> - Calyst Admin</title>
        <link rel="icon" type="image/x-icon" href="../ASSETS/images/favicon_io no bg/favicon.ico">
        <link rel="icon" type="image/png" sizes="32x32" href="../ASSETS/images/favicon_io no bg/favicon-32x32.png">
        <link rel="apple-touch-icon" href="../ASSETS/images/favicon_io no bg/apple-touch-icon.png">
        <link rel="stylesheet" href="./admin.css?v=3">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    </head>
    <body>
    <div class="admin-shell" id="admin-shell">
        <a class="admin-skip-link" href="#admin-content">Skip to main content</a>
        <nav class="admin-sidebar" id="admin-navigation" aria-label="Admin navigation">
            <a class="admin-brand" href="./dashboard.php" style="color:inherit;text-decoration:none">
                <span class="admin-brand-mark">
                    <span class="admin-brand-icon"><img src="../ASSETS/images/calyst budge better no bg.png" alt=""></span>
                    <span><h1>Calyst Admin</h1><p>School management</p></span>
                </span>
            </a>
            <div class="admin-nav">
                <span class="admin-nav-label">Workspace</span>
                <?php foreach ($navItems as [$file, $label, $icon]): ?>
                    <a href="./<?= adminEscape($file); ?>" <?= $active === $file ? 'aria-current="page"' : ''; ?>>
                        <i class="fa-solid <?= adminEscape($icon); ?>"></i><span><?= adminEscape($label); ?></span>
                        <?php if ($file === 'contact-submissions.php' && isset($GLOBALS['adminUnreadCount']) && $GLOBALS['adminUnreadCount'] > 0): ?>
                            <span class="admin-badge danger" style="margin-left:auto"><?= (int) $GLOBALS['adminUnreadCount']; ?></span>
                        <?php endif; ?>
                    </a>
                <?php endforeach; ?>
            </div>
            <div class="admin-side-bottom">
                <a class="admin-side-action" href="./profile.php"><i class="fa-solid fa-user-gear"></i> Account profile</a>
                <a class="admin-side-action" href="../home.php" target="_blank" rel="noopener"><i class="fa-solid fa-arrow-up-right-from-square"></i> View website</a>
                <a class="admin-side-action" href="./logout.php"><i class="fa-solid fa-right-from-bracket"></i> Sign out</a>
            </div>
        </nav>
        <button class="admin-sidebar-backdrop" type="button" aria-label="Close navigation" data-menu-close></button>
        <main class="admin-main">
            <header class="admin-topbar">
                <div class="admin-topbar-left">
                    <button class="admin-mobile-toggle" type="button" aria-label="Open navigation" aria-controls="admin-navigation" aria-expanded="false" data-menu-toggle><i class="fa-solid fa-bars"></i></button>
                    <div><h2><?= adminEscape($title); ?></h2><?php if ($subtitle !== ''): ?><p><?= adminEscape($subtitle); ?></p><?php endif; ?></div>
                </div>
                <div class="admin-topbar-actions">
                    <a class="admin-btn secondary" href="../home.php" target="_blank" rel="noopener"><i class="fa-solid fa-arrow-up-right-from-square"></i><span>View site</span></a>
                    <a class="admin-user-chip" href="./profile.php" title="Edit account profile"><span class="admin-avatar"><?= adminEscape($initial); ?></span><span class="admin-user-label"><?= adminEscape($adminName); ?></span></a>
                </div>
            </header>
            <div class="admin-content" id="admin-content" tabindex="-1">
    <?php
}

function adminPageEnd(): void
{
    ?>
            </div>
        </main>
    </div>
    <script>
        const adminShell = document.getElementById("admin-shell");
        const menuToggle = document.querySelector("[data-menu-toggle]");
        const closeMenu = () => {
            adminShell.classList.remove("menu-open");
            menuToggle?.setAttribute("aria-expanded", "false");
        };
        menuToggle?.addEventListener("click", () => {
            const open = adminShell.classList.toggle("menu-open");
            menuToggle.setAttribute("aria-expanded", String(open));
        });
        document.querySelector("[data-menu-close]")?.addEventListener("click", closeMenu);
        document.addEventListener("keydown", (event) => {
            if (event.key === "Escape") closeMenu();
        });
    </script>
    </body>
    </html>
    <?php
}

function adminPageHeading(string $title, string $description, ?string $actionUrl = null, ?string $actionLabel = null): void
{
    ?>
    <div class="admin-page-heading">
        <div><h1><?= adminEscape($title); ?></h1><p><?= adminEscape($description); ?></p></div>
        <?php if ($actionUrl !== null && $actionLabel !== null): ?><a class="admin-btn" href="<?= adminEscape($actionUrl); ?>"><i class="fa-solid fa-plus"></i> <?= adminEscape($actionLabel); ?></a><?php endif; ?>
    </div>
    <?php
}
