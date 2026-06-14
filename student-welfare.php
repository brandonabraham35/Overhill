<?php
$pageTitle = 'Student Welfare';
$current = 'student-welfare.php';
include 'includes/public_header.php';
?>

  <section class="page-banner">
    <div class="container">
      <h1>Student Welfare</h1>
      <p class="breadcrumb"><a href="index.php">Home</a> &raquo; Student Welfare</p>
    </div>
  </section>
  <section class="section"><div class="container">
    <div class="content-layout with-sidebar">
      <div class="content-main">
        <p class="lead">The safety, health and happiness of every child is our top priority.</p><?php display_content('student_welfare'); ?><div class="card-grid"><div class="info-card"><div class="card-icon">&#10010;</div><h3>Health & Sick Bay</h3><p>On-site care and first aid.</p></div><div class="info-card"><div class="card-icon">&#127869;</div><h3>Nutrition</h3><p>Balanced, nutritious meals daily.</p></div><div class="info-card"><div class="card-icon">&#128737;</div><h3>Safeguarding</h3><p>A safe and protective environment.</p></div><div class="info-card"><div class="card-icon">&#128106;</div><h3>Guidance & Counselling</h3><p>Support for every learner's well-being.</p></div></div>
      </div>

        <aside class="sidebar">
          <h3>In This Section</h3>
          <ul class="side-nav"><li class=""><a href="school-anthem.php">School Anthem</a></li><li class=""><a href="school-prayer.php">School Prayer</a></li><li class=""><a href="clubs-societies.php">Clubs and Societies</a></li><li class=""><a href="student-leadership.php">Leadership</a></li><li class=""><a href="student-articles.php">Student Articles</a></li><li class="active"><a href="student-welfare.php">Student Welfare</a></li></ul>
          <div class="side-cta">
            <h4>Ready to Join?</h4>
            <p>Give your child the gift of quality education.</p>
            <a href="admission-information.php" class="btn btn-light btn-block">Apply Now</a>
          </div>
        </aside>
    </div></div></section>


<?php include 'includes/public_footer.php'; ?>