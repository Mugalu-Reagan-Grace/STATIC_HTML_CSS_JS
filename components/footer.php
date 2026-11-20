<?php include_once 'brand.php'; ?>
<footer>
  <div class="container">
    <div class="footer-content">
      <div class="footer-column">
        <h3><?= $school['name_upper'] ?></h3>
        <p>
          A Christian school in Kampala, Uganda. HOFU YA BWANA (Hope in the Lord).
        </p>
      </div>
      <div class="footer-column">
        <h3>Quick Links</h3>
        <ul>
          <li><a href="./home.php">Home</a></li>
          <li><a href="./about.php">About Us</a></li>
          <li><a href="./gallery.php">Gallery</a></li>
          <li><a href="./programs.php">Programs</a></li>
          <li><a href="./news-events.php">News &amp; Events</a></li>
          <li><a href="./admissions.php">Admissions</a></li>
          <li><a href="./fees.php">Fees</a></li>
          <li><a href="./contact_us.php">Contact</a></li>
          <li><a href="./privacy-policy.php">Privacy Policy</a></li>
        </ul>
      </div>
      <div class="footer-column">
        <h3>Connect With Us</h3>
        <ul>
          <?php
          $footerSocials = [];
          if (!empty($publicSettings['facebook_url'])) $footerSocials[] = ['label' => 'Facebook', 'value' => $publicSettings['facebook_url']];
          if (!empty($publicSettings['instagram_url'])) $footerSocials[] = ['label' => 'Instagram', 'value' => $publicSettings['instagram_url']];
          if (!empty($publicSettings['youtube_url'])) $footerSocials[] = ['label' => 'YouTube', 'value' => $publicSettings['youtube_url']];
          foreach ($school['dynamic']['social_profiles'] as $profile) $footerSocials[] = $profile;
          foreach ($footerSocials as $social):
              $label = htmlspecialchars((string) $social['label'], ENT_QUOTES, 'UTF-8');
              $url = htmlspecialchars((string) $social['value'], ENT_QUOTES, 'UTF-8');
          ?>
          <li><a href="<?= $url ?>" target="_blank" rel="noopener"><i class="fa-solid fa-share-nodes" aria-hidden="true"></i> <?= $label ?></a></li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>
    <div class="copyright">
      <p>
        &copy; <?= date("Y") ?> <?= $school['name_upper'] ?>. All Rights Reserved. |
        <a
          href="./admin/login.php"
          style="color: #888; text-decoration: none; font-size: 12px">Admin</a>
      </p>
    </div>
  </div>
</footer>
