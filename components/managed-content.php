<?php

function managedContentEscape($value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}

function managedContentDate(?string $date, ?string $time = null): string
{
    if (!$date) {
        return '';
    }

    $formatted = date('F j, Y', strtotime($date));
    if ($time) {
        $formatted .= ' - ' . date('g:i A', strtotime($time));
    }

    return $formatted;
}

function renderManagedContentForCurrentPage(): void
{
    try {
        global $conn;
        require_once __DIR__ . '/../admin/config.php';
        $page = basename($_SERVER['SCRIPT_NAME'] ?? '');
        $pageSlugs = [
            'about.php' => 'about',
            'admissions.php' => 'admissions',
            'contact_us.php' => 'contact',
            'fees.php' => 'fees',
            'gallery.php' => 'gallery',
            'home.php' => 'home',
            'news-events.php' => 'news-events',
            'programs.php' => 'programs',
            'staff.php' => 'staff',
        ];
        $slug = $pageSlugs[$page] ?? null;

        if ($slug !== null) {
            $statement = $conn->prepare('SELECT page_title, page_content FROM pages_content WHERE page_slug = ? LIMIT 1');
            $statement->bind_param('s', $slug);
            $statement->execute();
            $copy = $statement->get_result()->fetch_assoc();

            if ($copy && (trim((string) $copy['page_title']) !== '' || trim((string) $copy['page_content']) !== '')) {
                echo '<section class="cms-page-copy" aria-label="School update"><div class="container">';
                if (trim((string) $copy['page_title']) !== '') {
                    echo '<h2>' . managedContentEscape($copy['page_title']) . '</h2>';
                }
                if (trim((string) $copy['page_content']) !== '') {
                    echo '<p>' . nl2br(managedContentEscape($copy['page_content'])) . '</p>';
                }
                echo '</div></section>';
            }
        }

        if ($page === 'news-events.php' || $page === 'home.php') {
            $limit = $page === 'home.php' ? 3 : 24;
            $sql = 'SELECT title, description, category, event_date, event_time, featured_image, featured_image_alt, created_at
                FROM news_events
                WHERE is_published = 1 AND (category = \'news\' OR event_date >= CURDATE() OR event_date IS NULL)
                ORDER BY CASE WHEN category = \'event\' THEN 0 ELSE 1 END, event_date ASC, created_at DESC
                LIMIT ' . $limit;
            $items = $conn->query($sql)->fetch_all(MYSQLI_ASSOC);

            if ($items) {
                echo '<section class="cms-managed-section" aria-labelledby="managed-news-heading"><div class="container"><div class="section-title"><h2 id="managed-news-heading">' . ($page === 'home.php' ? 'Latest school updates' : 'News and upcoming events') . '</h2><p>Updates published by the school.</p></div><div class="cms-managed-grid">';
                foreach ($items as $item) {
                    $title = managedContentEscape($item['title']);
                    echo '<article class="cms-managed-card">';
                    if ($item['featured_image'] !== '') {
                        $alt = trim((string) ($item['featured_image_alt'] ?? '')) !== ''
                            ? managedContentEscape($item['featured_image_alt'])
                            : $title;
                        echo '<img src="' . managedContentEscape($item['featured_image']) . '" alt="' . $alt . '" loading="lazy">';
                    }
                    echo '<div class="cms-managed-card-body"><span class="cms-managed-tag">' . managedContentEscape(ucfirst($item['category'])) . '</span><h3>' . $title . '</h3>';
                    $date = managedContentDate($item['event_date'], $item['event_time']);
                    if ($date !== '') {
                        echo '<p class="cms-managed-meta">' . managedContentEscape($date) . '</p>';
                    }
                    if (trim((string) $item['description']) !== '') {
                        echo '<p>' . nl2br(managedContentEscape($item['description'])) . '</p>';
                    }
                    echo '</div></article>';
                }
                echo '</div></div></section>';
            } elseif ($page === 'news-events.php') {
                echo '<section class="cms-empty-state" aria-live="polite"><div class="container"><h2>School updates</h2><p>There are no current updates to show. Please check back soon or <a href="./contact_us.php">contact the school office</a>.</p></div></section>';
            }
        }

        if ($page === 'gallery.php') {
            $items = $conn->query('SELECT title, description, image_url, image_alt, category FROM gallery WHERE is_active = 1 ORDER BY display_order ASC, created_at DESC LIMIT 60')->fetch_all(MYSQLI_ASSOC);
            if ($items) {
                echo '<section class="cms-managed-section" aria-labelledby="managed-gallery-heading"><div class="container"><div class="section-title"><h2 id="managed-gallery-heading">School moments</h2><p>Photos shared by the school community.</p></div><div class="cms-photo-grid">';
                foreach ($items as $item) {
                    $title = managedContentEscape($item['title']);
                    $category = trim((string) $item['category']);
                    $alt = trim((string) ($item['image_alt'] ?? '')) !== ''
                        ? managedContentEscape($item['image_alt'])
                        : $title;
                    echo '<figure class="cms-photo-card" data-photo-card data-title="' . $title . '" data-category="' . managedContentEscape(strtolower($category)) . '"><img src="' . managedContentEscape($item['image_url']) . '" alt="' . $alt . '" loading="lazy"><figcaption><strong>' . $title . '</strong>';
                    if ($category !== '') {
                        echo '<span class="cms-managed-tag">' . managedContentEscape($category) . '</span>';
                    }
                    if (trim((string) $item['description']) !== '') {
                        echo '<span>' . managedContentEscape($item['description']) . '</span>';
                    }
                    echo '</figcaption></figure>';
                }
                echo '</div></div></section>';
            } else {
                echo '<section class="cms-empty-state cms-gallery-empty" aria-labelledby="gallery-empty-heading"><div class="container"><div class="cms-empty-card"><span class="cms-empty-icon" aria-hidden="true"><i class="fa-regular fa-images"></i></span><div><h2 id="gallery-empty-heading">Photos are being prepared</h2><p>New school photos will be added here. In the meantime, you can learn about school programmes or ask the school office a question.</p><div class="cms-empty-actions"><a href="./programs.php">Explore learning programmes <span aria-hidden="true">→</span></a><a href="./contact_us.php">Contact the school <span aria-hidden="true">→</span></a></div></div></div></div></section>';
            }
        } elseif ($page === 'staff.php') {
            $items = $conn->query('SELECT full_name, title, bio, photo_url, photo_alt FROM staff WHERE is_active = 1 ORDER BY display_order ASC, full_name ASC LIMIT 60')->fetch_all(MYSQLI_ASSOC);
            if ($items) {
                echo '<section class="cms-managed-section" aria-labelledby="managed-staff-heading"><div class="container"><div class="section-title"><h2 id="managed-staff-heading">Our team</h2><p>Meet the people supporting our students and families.</p></div><div class="cms-managed-grid">';
                foreach ($items as $item) {
                    echo '<article class="cms-managed-card cms-staff-card">';
                    if (trim((string) $item['photo_url']) !== '') {
                        $alt = trim((string) ($item['photo_alt'] ?? '')) !== ''
                            ? managedContentEscape($item['photo_alt'])
                            : managedContentEscape($item['full_name']);
                        echo '<img src="' . managedContentEscape($item['photo_url']) . '" alt="' . $alt . '" loading="lazy">';
                    }
                    echo '<div class="cms-managed-card-body"><h3>' . managedContentEscape($item['full_name']) . '</h3><span class="cms-managed-tag">' . managedContentEscape($item['title']) . '</span>';
                    if (trim((string) $item['bio']) !== '') {
                        echo '<p>' . nl2br(managedContentEscape($item['bio'])) . '</p>';
                    }
                    echo '</div></article>';
                }
                echo '</div></div></section>';
            } else {
                echo '<section class="cms-empty-state"><div class="container"><h2>Meet our staff</h2><p>Staff profiles are being prepared. Contact the school office if you have a question for a specific team member.</p></div></section>';
            }
        } elseif ($page === 'fees.php') {
            $items = $conn->query('SELECT class_name, tuition_amount, activity_fee, transport_fee, other_fees FROM fees WHERE is_active = 1 ORDER BY class_name ASC LIMIT 100')->fetch_all(MYSQLI_ASSOC);
            if ($items) {
                echo '<section class="cms-managed-section" aria-labelledby="managed-fees-heading"><div class="container"><div class="section-title"><h2 id="managed-fees-heading">Current fee schedule</h2><p>Amounts are shown in Ugandan shillings (UGX). Please confirm the current term charges with the school office.</p></div><div class="cms-fee-table-wrap"><table class="cms-fee-table"><thead><tr><th>Class</th><th>Tuition (UGX)</th><th>Activities</th><th>Transport</th><th>Other notes</th></tr></thead><tbody>';
                foreach ($items as $item) {
                    echo '<tr><th>' . managedContentEscape($item['class_name']) . '</th><td>' . number_format((float) $item['tuition_amount']) . '</td><td>' . ($item['activity_fee'] === null ? '&mdash;' : number_format((float) $item['activity_fee'])) . '</td><td>' . ($item['transport_fee'] === null ? '&mdash;' : number_format((float) $item['transport_fee'])) . '</td><td>' . nl2br(managedContentEscape($item['other_fees'] ?? '')) . '</td></tr>';
                }
                echo '</tbody></table></div></div></section>';
            } else {
                echo '<section class="cms-empty-state"><div class="container"><h2>Request the current fee schedule</h2><p>Contact the school office for current tuition, additional charges, and uniform information.</p><a class="btn" href="./contact_us.php">Ask about fees</a></div></section>';
            }
        } elseif ($page === 'home.php') {
            $items = $conn->query('SELECT author_name, author_title, testimonial_text FROM testimonials WHERE is_published = 1 ORDER BY created_at DESC LIMIT 3')->fetch_all(MYSQLI_ASSOC);
            if ($items) {
                echo '<section class="cms-managed-section"><div class="container"><div class="section-title"><h2>What families say</h2></div><div class="cms-managed-grid">';
                foreach ($items as $item) {
                    echo '<blockquote class="cms-quote-card"><p>&ldquo;' . nl2br(managedContentEscape($item['testimonial_text'])) . '&rdquo;</p><footer><strong>' . managedContentEscape($item['author_name']) . '</strong>';
                    if (trim((string) $item['author_title']) !== '') {
                        echo '<span>' . managedContentEscape($item['author_title']) . '</span>';
                    }
                    echo '</footer></blockquote>';
                }
                echo '</div></div></section>';
            }
        }
    } catch (RuntimeException $exception) {
        error_log('Managed public content unavailable: ' . $exception->getMessage());
        echo '<section class="cms-error-state" role="status"><div class="container"><p>School updates are temporarily unavailable. Please contact the school office directly.</p><a href="./contact_us.php">Contact the school</a></div></section>';
    }
}
