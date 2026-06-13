<?php
$pageTitle = 'School Prayer';
$current = 'school-prayer.php';
include 'includes/public_header.php';
?>

  <section class="page-banner">
    <div class="container">
      <h1>School Prayer</h1>
      <p class="breadcrumb"><a href="index.php">Home</a> &raquo; School Prayer</p>
    </div>
  </section>
  <section class="section"><div class="container">
    <div class="content-layout with-sidebar">
      <div class="content-main">
        <p class="lead">Our school prayer, recited together each day.</p><div class="anthem-box"><?php display_content('school_prayer'); ?><p class="anthem-lines"><?php display_content('prayer_text'); ?></p></div>
      </div>

        <aside class="sidebar">
          <h3>In This Section</h3>
          <ul class="side-nav"><li class=""><a href="school-anthem.php">School Anthem</a></li><li class="active"><a href="school-prayer.php">School Prayer</a></li><li class=""><a href="clubs-societies.php">Clubs and Societies</a></li><li class=""><a href="student-leadership.php">Leadership</a></li><li class=""><a href="student-articles.php">Student Articles</a></li><li class=""><a href="student-welfare.php">Student Welfare</a></li></ul>
          <div class="side-cta">
            <h4>Ready to Join?</h4>
            <p>Give your child the gift of quality education.</p>
            <a href="admission-information.php" class="btn btn-light btn-block">Apply Now</a>
          </div>
        </aside>
    </div></div></section>


<?php include 'includes/public_footer.php'; ?>