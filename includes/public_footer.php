  <footer class="site-footer">
    <div class="container footer-grid">
      <div class="footer-col">
        <img src="<?= e(get_setting('site_logo', 'images/logo.png')) ?>" alt="<?= e(get_setting('school_name', 'Overhill Junior School')) ?>" class="footer-logo">
        <h3><?= e(get_setting('school_name', 'Overhill Junior School')) ?></h3>
        <p class="muted"><?= e(get_setting('motto', 'Knowledge Is Power')) ?></p>
        <p class="muted"><?= e(get_setting('footer_about', 'A private primary & nursery school nurturing confident, curious learners.')) ?></p>
      </div>
      <div class="footer-col">
        <h4>Quick Links</h4>
        <ul class="footer-links">
          <li><a href="index.php">Home</a></li>
          <li><a href="why-overhill.php">Why Overhill</a></li>
          <li><a href="facilities.php">Facilities</a></li>
          <li><a href="parents.php">Parents</a></li>
          <li><a href="students.php">Students</a></li>
          <li><a href="special-programmes.php">Special Programmes</a></li>
          <li><a href="news-events.php">News & Events</a></li>
          <li><a href="contact.php">Contact Us</a></li>
          <li><a href="faqs.php">FAQs</a></li>
        </ul>
      </div>
      <div class="footer-col">
        <h4>Explore</h4>
        <ul class="footer-links">
          <li><a href="admission-information.php">Admissions</a></li>
          <li><a href="fee-structure.php">Fee Structure</a></li>
          <li><a href="school-calendar.php">School Calendar</a></li>
          <li><a href="download-forms.php">Download Forms</a></li>
          <li><a href="school-news.php">News &amp; Events</a></li>
        </ul>
      </div>
      <div class="footer-col">
        <h4>Get In Touch</h4>
        <p class="muted"><?= nl2br(e(get_setting('address', "Wakiso, Uganda\nP.O. Box 119654"))) ?></p>
        <p class="muted">Tel: <?= e(get_setting('phone', '+256 752 913 759')) ?></p>
        <p class="muted">Email: <?= e(get_setting('email', 'overhilljuniorschool@gmail.com')) ?></p>
        <div class="footer-social">
          <?php if($fb = get_setting('facebook_url')): ?><a href="<?= e($fb) ?>" aria-label="Facebook">f</a><?php endif; ?>
          <?php if($tw = get_setting('twitter_url')): ?><a href="<?= e($tw) ?>" aria-label="Twitter">t</a><?php endif; ?>
          <?php if($ig = get_setting('instagram_url')): ?><a href="<?= e($ig) ?>" aria-label="Instagram">ig</a><?php endif; ?>
          <?php if($yt = get_setting('youtube_url')): ?><a href="<?= e($yt) ?>" aria-label="YouTube">yt</a><?php endif; ?>
          <a href="admin/login.php" class="admin-link">Admin</a>
        </div>
      </div>
    </div>
    <div class="footer-bottom">
      <div class="container">
        <p>&copy; <?= date('Y') ?> <?= e(get_setting('school_name', 'Overhill Junior School')) ?>. All rights reserved.</p>
      </div>
    </div>
  </footer>
  <a href="https://wa.me/<?= preg_replace('/[^0-9]/', '', get_setting('phone', '256752913759')) ?>" class="whatsapp-float" aria-label="WhatsApp">WhatsApp</a>
  <script src="js/main.js"></script>
  <script src="js/api.js"></script>
</body>
</html>
