<?php
$pageTitle = 'Newsletter Archive';
$current = 'newsletter-archive.php';
include 'includes/public_header.php';
?>

  <section class="page-banner">
    <div class="container">
      <h1>Newsletter Archive</h1>
      <p class="breadcrumb"><a href="index.php">Home</a> &raquo; Newsletter Archive</p>
    </div>
  </section>
  <section class="section"><div class="container">
    <div class="content-layout with-sidebar">
      <div class="content-main">
        <p class="lead">Browse and download past editions of our school newsletter.</p><div class="cms-placeholder"><span class="cms-tag"><?php display_content('newsletter_archive'); ?></span><p>This content area will be populated from the admin dashboard / CMS.</p></div><ul class="download-list"><li><span class="file-icon">PDF</span><div><strong><?php display_content('newsletter_title_1'); ?></strong><p><?php display_content('newsletter_date_1'); ?></p></div><a href="#" class="btn btn-sm btn-primary">Download</a></li><li><span class="file-icon">PDF</span><div><strong><?php display_content('newsletter_title_2'); ?></strong><p><?php display_content('newsletter_date_2'); ?></p></div><a href="#" class="btn btn-sm btn-primary">Download</a></li><li><span class="file-icon">PDF</span><div><strong><?php display_content('newsletter_title_3'); ?></strong><p><?php display_content('newsletter_date_3'); ?></p></div><a href="#" class="btn btn-sm btn-primary">Download</a></li><li><span class="file-icon">PDF</span><div><strong><?php display_content('newsletter_title_4'); ?></strong><p><?php display_content('newsletter_date_4'); ?></p></div><a href="#" class="btn btn-sm btn-primary">Download</a></li></ul>
      </div>

        <aside class="sidebar">
          <h3>In This Section</h3>
          <ul class="side-nav"><li class=""><a href="school-news.php">School News</a></li><li class=""><a href="school-events.php">School Events</a></li><li class=""><a href="announcements.php">Announcements</a></li><li class="active"><a href="newsletter-archive.php">Newsletter Archive</a></li></ul>
          <div class="side-cta">
            <h4>Ready to Join?</h4>
            <p>Give your child the gift of quality education.</p>
            <a href="admission-information.php" class="btn btn-light btn-block">Apply Now</a>
          </div>
        </aside>
    </div></div></section>


<?php include 'includes/public_footer.php'; ?>