<?php
$pageTitle = 'School News';
$current = 'school-news.php';
include 'includes/public_header.php';
?>

  <section class="page-banner">
    <div class="container">
      <h1>School News</h1>
      <p class="breadcrumb"><a href="index.php">Home</a> &raquo; School News</p>
    </div>
  </section>
  <section class="section"><div class="container">
    <div class="content-layout with-sidebar">
      <div class="content-main">
        <p class="lead">The latest news and stories from around our school.</p>
        <div class="search-bar" style="margin-bottom: 2rem;">
          <input type="text" id="newsSearch" placeholder="Search news..." style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px;">
        </div>
        <div class="news-grid" id="newsList">
          <p>Loading news...</p>
        </div>
      </div>

        <aside class="sidebar">
          <h3>In This Section</h3>
          <ul class="side-nav"><li class="active"><a href="school-news.php">School News</a></li><li class=""><a href="school-events.php">School Events</a></li><li class=""><a href="announcements.php">Announcements</a></li><li class=""><a href="newsletter-archive.php">Newsletter Archive</a></li></ul>
          <div class="side-cta">
            <h4>Ready to Join?</h4>
            <p>Give your child the gift of quality education.</p>
            <a href="admission-information.php" class="btn btn-light btn-block">Apply Now</a>
          </div>
        </aside>
    </div></div></section>


<?php include 'includes/public_footer.php'; ?>