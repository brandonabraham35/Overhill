<?php
$pageTitle = 'Download Forms';
$current = 'download-forms.php';
include 'includes/public_header.php';
?>

  <section class="page-banner">
    <div class="container">
      <h1>Download Forms</h1>
      <p class="breadcrumb"><a href="index.php">Home</a> &raquo; Download Forms</p>
    </div>
  </section>
  <section class="section"><div class="container">
    <div class="content-layout with-sidebar">
      <div class="content-main">
        <p class="lead"><?php display_content('downloads_intro'); ?></p>
        <div class="download-list" id="downloadsList">
          <p>Loading downloads...</p>
        </div>
      </div>

        <aside class="sidebar">
          <h3>In This Section</h3>
          <ul class="side-nav"><li class=""><a href="admission-information.php">Admission Information</a></li><li class=""><a href="fee-structure.php">Fee Structure</a></li><li class=""><a href="school-calendar.php">School Calendar</a></li><li class=""><a href="school-rules.php">School Rules</a></li><li class=""><a href="parent-guidelines.php">Parent Guidelines</a></li><li class=""><a href="communication-policy.php">Communication Policy</a></li><li class="active"><a href="download-forms.php">Download Forms</a></li></ul>
          <div class="side-cta">
            <h4>Ready to Join?</h4>
            <p>Give your child the gift of quality education.</p>
            <a href="admission-information.php" class="btn btn-light btn-block">Apply Now</a>
          </div>
        </aside>
    </div></div></section>


<?php include 'includes/public_footer.php'; ?>