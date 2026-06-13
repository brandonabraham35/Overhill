<?php
$pageTitle = 'Leadership';
$current = 'student-leadership.php';
include 'includes/public_header.php';
?>

  <section class="page-banner">
    <div class="container">
      <h1>Leadership</h1>
      <p class="breadcrumb"><a href="index.php">Home</a> &raquo; Leadership</p>
    </div>
  </section>
  <section class="section"><div class="container">
    <div class="content-layout with-sidebar">
      <div class="content-main">
        <p class="lead">We nurture leadership through our prefects and student council.</p><?php display_content('student_leadership'); ?><div class="person-grid"><div class="person-card"><div class="person-img" style="background-image:url('images/staff.jpg')"></div><div class="person-body"><h3><?php display_content('prefect_name_1'); ?></h3><span class="person-role"><?php display_content('prefect_role_1'); ?></span><p><?php display_content('prefect_bio_1'); ?></p></div></div><div class="person-card"><div class="person-img" style="background-image:url('images/staff.jpg')"></div><div class="person-body"><h3><?php display_content('prefect_name_2'); ?></h3><span class="person-role"><?php display_content('prefect_role_2'); ?></span><p><?php display_content('prefect_bio_2'); ?></p></div></div><div class="person-card"><div class="person-img" style="background-image:url('images/staff.jpg')"></div><div class="person-body"><h3><?php display_content('prefect_name_3'); ?></h3><span class="person-role"><?php display_content('prefect_role_3'); ?></span><p><?php display_content('prefect_bio_3'); ?></p></div></div><div class="person-card"><div class="person-img" style="background-image:url('images/staff.jpg')"></div><div class="person-body"><h3><?php display_content('prefect_name_4'); ?></h3><span class="person-role"><?php display_content('prefect_role_4'); ?></span><p><?php display_content('prefect_bio_4'); ?></p></div></div></div>
      </div>

        <aside class="sidebar">
          <h3>In This Section</h3>
          <ul class="side-nav"><li class=""><a href="school-anthem.php">School Anthem</a></li><li class=""><a href="school-prayer.php">School Prayer</a></li><li class=""><a href="clubs-societies.php">Clubs and Societies</a></li><li class="active"><a href="student-leadership.php">Leadership</a></li><li class=""><a href="student-articles.php">Student Articles</a></li><li class=""><a href="student-welfare.php">Student Welfare</a></li></ul>
          <div class="side-cta">
            <h4>Ready to Join?</h4>
            <p>Give your child the gift of quality education.</p>
            <a href="admission-information.php" class="btn btn-light btn-block">Apply Now</a>
          </div>
        </aside>
    </div></div></section>


<?php include 'includes/public_footer.php'; ?>