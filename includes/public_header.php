<?php require_once __DIR__ . '/functions.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= e($pageTitle ?? 'Overhill Junior School') ?> | Nurturing Bright Futures</title>
  <meta name="description" content="<?= e(get_setting('site_description', 'A leading private primary and nursery school in Wakiso, Uganda.')) ?>">
  <link rel="stylesheet" href="css/style.css">
  <link rel="icon" href="images/logo.png">
</head>
<body>
  <div class="top-bar">
    <div class="container top-bar-flex">
      <div class="top-info">
        <span>&#128205; <?= e(get_setting('address', 'Wakiso, Uganda')) ?></span>
        <span>&#9742; <?= e(get_setting('phone', '+256 752 913 759')) ?></span>
      </div>
      <div class="top-social">
        <?php if($fb = get_setting('facebook_url')): ?><a href="<?= e($fb) ?>">f</a><?php endif; ?>
        <?php if($tw = get_setting('twitter_url')): ?><a href="<?= e($tw) ?>">t</a><?php endif; ?>
        <?php if($ig = get_setting('instagram_url')): ?><a href="<?= e($ig) ?>">ig</a><?php endif; ?>
        <?php if($yt = get_setting('youtube_url')): ?><a href="<?= e($yt) ?>">yt</a><?php endif; ?>
      </div>
    </div>
  </div>

  <header class="site-header" id="mainHeader">
    <div class="container nav-flex">
      <a href="index.php" class="logo">
        <img src="<?= e(get_setting('site_logo', 'images/logo.png')) ?>" alt="Logo">
        <div class="logo-text">
          <span class="school-name"><?= e(get_setting('school_name', 'Overhill Junior School')) ?></span>
          <span class="motto"><?= e(get_setting('motto', 'Knowledge Is Power')) ?></span>
        </div>
      </a>

      <button class="nav-toggle" id="navToggle" aria-label="Toggle navigation">
        <span></span><span></span><span></span>
      </button>

      <nav class="main-nav" id="mainNav">
        <ul>
          <li><a href="index.php" class="<?= $current == 'index.php' ? 'active' : '' ?>">Home</a></li>
          <li class="has-dropdown">
            <a href="why-overhill.php" class="<?= in_array($current, ['why-overhill.php', 'school-history.php', 'vision-mission.php', 'core-values.php', 'proprietor-message.php', 'chairman-message.php', 'headteacher-message.php', 'leadership-team.php', 'staff-directory.php']) ? 'active' : '' ?>">About Us</a>
            <ul class="dropdown">
              <li><a href="why-overhill.php">Why Overhill</a></li>
              <li><a href="school-history.php">School History</a></li>
              <li><a href="vision-mission.php">Vision & Mission</a></li>
              <li><a href="core-values.php">Core Values</a></li>
              <li><a href="proprietor-message.php">Proprietor's Message</a></li>
              <li><a href="chairman-message.php">Chairman's Message</a></li>
              <li><a href="headteacher-message.php">Headteacher's Message</a></li>
              <li><a href="leadership-team.php">Leadership Team</a></li>
              <li><a href="staff-directory.php">Staff Directory</a></li>
            </ul>
          </li>
          <li><a href="facilities.php" class="<?= $current == 'facilities.php' ? 'active' : '' ?>">Facilities</a></li>
          <li class="has-dropdown">
            <a href="parents.php" class="<?= in_array($current, ['parents.php', 'admission-information.php', 'fee-structure.php', 'school-calendar.php', 'download-forms.php', 'school-rules.php', 'parent-guidelines.php', 'communication-policy.php']) ? 'active' : '' ?>">Parents</a>
            <ul class="dropdown">
              <li><a href="admission-information.php">Admissions</a></li>
              <li><a href="fee-structure.php">Fee Structure</a></li>
              <li><a href="school-calendar.php">School Calendar</a></li>
              <li><a href="download-forms.php">Download Forms</a></li>
              <li><a href="school-rules.php">School Rules</a></li>
              <li><a href="parent-guidelines.php">Parent Guidelines</a></li>
              <li><a href="communication-policy.php">Communication Policy</a></li>
            </ul>
          </li>
          <li class="has-dropdown">
            <a href="students.php" class="<?= in_array($current, ['students.php', 'clubs-societies.php', 'student-leadership.php', 'student-welfare.php', 'student-articles.php']) ? 'active' : '' ?>">Students</a>
            <ul class="dropdown">
              <li><a href="clubs-societies.php">Clubs & Societies</a></li>
              <li><a href="student-leadership.php">Student Leadership</a></li>
              <li><a href="student-welfare.php">Student Welfare</a></li>
              <li><a href="student-articles.php">Student Articles</a></li>
            </ul>
          </li>
          <li><a href="special-programmes.php" class="<?= $current == 'special-programmes.php' ? 'active' : '' ?>">Programmes</a></li>
          <li class="has-dropdown">
            <a href="news-events.php" class="<?= in_array($current, ['news-events.php', 'school-news.php', 'school-events.php', 'announcements.php', 'newsletter-archive.php', 'gallery.php']) ? 'active' : '' ?>">Gallery & News</a>
            <ul class="dropdown">
              <li><a href="school-news.php">School News</a></li>
              <li><a href="school-events.php">School Events</a></li>
              <li><a href="announcements.php">Announcements</a></li>
              <li><a href="newsletter-archive.php">Newsletter Archive</a></li>
              <li><a href="gallery.php">Photo Gallery</a></li>
            </ul>
          </li>
          <li><a href="contact.php" class="<?= $current == 'contact.php' ? 'active' : '' ?>">Contact</a></li>
        </ul>
      </nav>

      <a href="admission-information.php" class="nav-cta">Apply Now</a>
    </div>
  </header>
