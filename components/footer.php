<?php include_once 'brand.php'; ?>
<footer>
  <div class="container">
    <div class="footer-content">
      <div class="footer-column">
        <h3><?= $school['name_upper'] ?></h3>
        <p>
          Providing Christ-centered education since 1995. HOFU YA BWANA
          (Hope in the Lord) - a commitment to academic excellence,
          character development, and faith.
        </p>
      </div>
      <div class="footer-column">
        <h3>Quick Links</h3>
        <ul>
          <li><a href="./home.php">Home</a></li>
          <li><a href="./about.php">About Us</a></li>
          <li><a href="./gallery.php">Gallery</a></li>
          <li><a href="./programs.php">Programs</a></li>
          <li><a href="./admissions.php">Admissions</a></li>
          <li><a href="./fees.php">Fees</a></li>
          <li><a href="./contact_us.php">Contact</a></li>
        </ul>
      </div>
      <div class="footer-col newsletter">
        <h3>Stay Updated</h3>
        <p>Join our mailing list for news and events.</p>
        <form>
          <input type="email" placeholder="Your email" required />
          <button type="submit">Subscribe</button>
        </form>
      </div>
      <div class="footer-column">
        <h3>Connect With Us</h3>
        <ul>
          <li>
            <a
              href="https://www.facebook.com/profile.php?id=100090556566888"><i class="fab fa-facebook"></i> Facebook</a>
          </li>
          <li>
            <a
              href="https://www.instagram.com/calystchristianschool?igsh=MXJyeGR0eXhqY2M5cA=="><i class="fab fa-instagram"></i> Instagram</a>
          </li>
          <li>
            <a href="#"><i class="fab fa-twitter"></i> Twitter</a>
          </li>
          <li>
            <a
              href="https://youtube.com/@calystchristianschools?si=bYJ8VI1UN6YCzrmH"><i class="fab fa-youtube"></i> YouTube</a>
          </li>
        </ul>
      </div>
    </div>
    <div class="copyright">
      <p>
        &copy; <?= date("Y") ?> <?= $school['name_upper'] ?>. All Rights Reserved. |
        <a
          href="./admin-login.php"
          style="color: #888; text-decoration: none; font-size: 12px">Admin</a>
      </p>
    </div>
  </div>
</footer>
