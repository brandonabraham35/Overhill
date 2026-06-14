<?php
$pageTitle = 'School Events';
$current = 'school-events.php';
include 'includes/public_header.php';
?>

  <section class="page-banner">
    <div class="container">
      <h1>School Events</h1>
      <p class="breadcrumb"><a href="index.php">Home</a> &raquo; School Events</p>
    </div>
  </section>
  <section class="section"><div class="container">
    <div class="content-layout with-sidebar">
      <div class="content-main">
        <p class="lead">Upcoming and recent events at Overhill Junior School.</p>
        <div class="news-grid" id="eventsList">
          <p>Loading events...</p>
        </div>
      </div>

        <aside class="sidebar">
          <h3>In This Section</h3>
          <ul class="side-nav"><li class=""><a href="school-news.php">School News</a></li><li class="active"><a href="school-events.php">School Events</a></li><li class=""><a href="announcements.php">Announcements</a></li><li class=""><a href="newsletter-archive.php">Newsletter Archive</a></li></ul>
          <div class="side-cta">
            <h4>Ready to Join?</h4>
            <p>Give your child the gift of quality education.</p>
            <a href="admission-information.php" class="btn btn-light btn-block">Apply Now</a>
          </div>
        </aside>
    </div></div></section>


<?php include 'includes/public_footer.php'; ?>