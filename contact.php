<?php
$pageTitle = 'Contact Us';
$current = 'contact.php';
include 'includes/public_header.php';
?>

  <section class="page-banner">
    <div class="container">
      <h1>Contact Us</h1>
      <p class="breadcrumb"><a href="index.php">Home</a> &raquo; Contact Us</p>
    </div>
  </section>
  <section class="section"><div class="container">
      <div class="contact-grid">
        <div class="contact-info">
          <h2>Get In Touch</h2>
          <p class="lead">We would love to hear from you. Reach out using any of the details below.</p>
          <ul class="contact-list">
            <li><span class="ci-icon">&#9873;</span><div><strong>Address</strong><p><?php display_content('address'); ?><br>P.O. Box 119654</p></div></li>
            <li><span class="ci-icon">&#9742;</span><div><strong>Telephone</strong><p><?php display_content('phone'); ?><br>+256 749 567 732</p></div></li>
            <li><span class="ci-icon">&#9993;</span><div><strong>Email</strong><p><?php display_content('email'); ?></p></div></li>
            <li><span class="ci-icon">&#128172;</span><div><strong>WhatsApp</strong><p><?php display_content('phone'); ?></p></div></li>
          </ul>
          <div class="footer-social dark">
            <?php if($fb = get_setting('facebook_url')): ?><a aria-label="Facebook" href="<?= e($fb) ?>">f</a><?php endif; ?>
            <?php if($tw = get_setting('twitter_url')): ?><a aria-label="Twitter" href="<?= e($tw) ?>">t</a><?php endif; ?>
            <?php if($ig = get_setting('instagram_url')): ?><a aria-label="Instagram" href="<?= e($ig) ?>">ig</a><?php endif; ?>
            <?php if($yt = get_setting('youtube_url')): ?><a aria-label="YouTube" href="<?= e($yt) ?>">yt</a><?php endif; ?>
            <a href="admin/login.php" class="admin-link">Admin</a>
          </div>
        </div>
        <div class="contact-form-card">
          <h2>Send Us a Message</h2>
          <form data-api="api/contact.php">
            <div class="form-row">
              <div class="form-group"><label>Full Name</label><input type="text" name="name" placeholder="Your name" required></div>
              <div class="form-group"><label>Email</label><input type="email" name="email" placeholder="you@example.com" required></div>
            </div>
            <div class="form-row">
              <div class="form-group"><label>Phone</label><input type="tel" name="phone" placeholder="+256..."></div>
              <div class="form-group"><label>Subject</label><input type="text" name="subject" placeholder="Subject"></div>
            </div>
            <div class="form-group"><label>Message</label><textarea name="message" rows="5" placeholder="How can we help?" required></textarea></div>
            <button type="submit" class="btn btn-primary btn-block">Send Message</button>
          </form>
        </div>
      </div>
      <div class="map-placeholder">
        <div class="map-inner">
          <span class="map-pin">&#128205;</span>
          <h3>Find Us in <?php display_content('address'); ?></h3>
          <p>Google Maps embed placeholder &mdash; map will be added here.</p>
        </div>
      </div></div></section>

<?php include 'includes/public_footer.php'; ?>
