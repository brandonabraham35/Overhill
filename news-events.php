<?php
$pageTitle = 'News & Events';
$current = 'news-events.php';
include 'includes/public_header.php';
?>

  <section class="page-banner">
    <div class="container">
      <h1>News & Events</h1>
      <p class="breadcrumb"><a href="index.php">Home</a> &raquo; News & Events</p>
    </div>
  </section>
  <section class="section"><div class="container">
    <div class="content-layout">
      <div class="content-main">
        <p class="lead">Keep up with the latest happenings, achievements and upcoming events at our school.</p><div class="cms-placeholder"><span class="cms-tag"><?php display_content('news_events_intro'); ?></span><p>This content area will be populated from the admin dashboard / CMS.</p></div><div class="link-card-grid"><a class="link-card" href="school-news.php"><h3>School News</h3><span class="arrow">&rarr;</span></a><a class="link-card" href="school-events.php"><h3>School Events</h3><span class="arrow">&rarr;</span></a><a class="link-card" href="announcements.php"><h3>Announcements</h3><span class="arrow">&rarr;</span></a><a class="link-card" href="newsletter-archive.php"><h3>Newsletter Archive</h3><span class="arrow">&rarr;</span></a></div>
      </div>

    </div></div></section>


<?php include 'includes/public_footer.php'; ?>