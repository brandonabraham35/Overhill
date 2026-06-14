<?php
$pageTitle = 'Day Care';
$current = 'programme-daycare.php';
include 'includes/public_header.php';
?>

  <section class="page-banner">
    <div class="container">
      <h1>Day Care</h1>
      <p class="breadcrumb"><a href="index.php">Home</a> &raquo; Day Care</p>
    </div>
  </section>
  <section class="section"><div class="container">
    <div class="content-layout with-sidebar">
      <div class="content-main">
        <div class="img-frame wide"><img src="images/hero3.jpg" alt="Day Care"></div><p class="lead">Safe, caring day care for our youngest children in a nurturing setting.</p><p>This programme is part of our commitment to holistic education that develops the whole child &mdash; academically, socially, physically and creatively.</p><div class="cms-placeholder"><span class="cms-tag"><?php display_content('programme_daycare_content'); ?></span><p>This content area will be populated from the admin dashboard / CMS.</p></div><div class="card-grid"><div class="info-card"><div class="card-icon">&#10003;</div><h3>Age Appropriate</h3><p>Tailored for nursery and primary learners.</p></div><div class="info-card"><div class="card-icon">&#10003;</div><h3>Expert Guidance</h3><p>Led by trained, caring teachers.</p></div><div class="info-card"><div class="card-icon">&#10003;</div><h3>Fun & Engaging</h3><p>Learning through play and discovery.</p></div></div>
      </div>

        <aside class="sidebar">
          <h3>In This Section</h3>
          <ul class="side-nav"><li class=""><a href="programme-computer.php">Computer Lessons</a></li><li class=""><a href="programme-reading.php">Reading Programme</a></li><li class=""><a href="programme-handwriting.php">Handwriting Programme</a></li><li class=""><a href="programme-games.php">Games and Sports</a></li><li class=""><a href="programme-vocational.php">Vocational Skills</a></li><li class="active"><a href="programme-daycare.php">Day Care</a></li><li class=""><a href="programme-cocurricular.php"><?php display_content('quick_card_3_title'); ?> Activities</a></li></ul>
          <div class="side-cta">
            <h4>Ready to Join?</h4>
            <p>Give your child the gift of quality education.</p>
            <a href="admission-information.php" class="btn btn-light btn-block">Apply Now</a>
          </div>
        </aside>
    </div></div></section>


<?php include 'includes/public_footer.php'; ?>