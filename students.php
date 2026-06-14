<?php
$pageTitle = 'Students';
$current = 'students.php';
include 'includes/public_header.php';
?>

  <section class="page-banner">
    <div class="container">
      <h1>Students</h1>
      <p class="breadcrumb"><a href="index.php">Home</a> &raquo; Students</p>
    </div>
  </section>
  <section class="section"><div class="container">
    <div class="content-layout">
      <div class="content-main">
        <p class="lead">Student life, leadership, welfare and the many activities that shape our learners.</p><?php display_content('students_intro'); ?><div class="link-card-grid"><a class="link-card" href="school-anthem.php"><h3>School Anthem</h3><span class="arrow">&rarr;</span></a><a class="link-card" href="school-prayer.php"><h3>School Prayer</h3><span class="arrow">&rarr;</span></a><a class="link-card" href="clubs-societies.php"><h3>Clubs and Societies</h3><span class="arrow">&rarr;</span></a><a class="link-card" href="student-leadership.php"><h3>Leadership</h3><span class="arrow">&rarr;</span></a><a class="link-card" href="student-articles.php"><h3>Student Articles</h3><span class="arrow">&rarr;</span></a><a class="link-card" href="student-welfare.php"><h3>Student Welfare</h3><span class="arrow">&rarr;</span></a></div>
      </div>

    </div></div></section>


<?php include 'includes/public_footer.php'; ?>