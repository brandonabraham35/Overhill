<?php
$pageTitle = 'Special Programmes';
$current = 'special-programmes.php';
include 'includes/public_header.php';
?>

  <section class="page-banner">
    <div class="container">
      <h1>Special Programmes</h1>
      <p class="breadcrumb"><a href="index.php">Home</a> &raquo; Special Programmes</p>
    </div>
  </section>
  <section class="section"><div class="container">
    <div class="content-layout">
      <div class="content-main">
        <p class="lead">Enriching programmes that go beyond the classroom to develop the whole child.</p><div class="cms-placeholder"><span class="cms-tag"><?php display_content('programmes_intro'); ?></span><p>This content area will be populated from the admin dashboard / CMS.</p></div><div class="link-card-grid"><a class="link-card" href="programme-computer.php"><h3>Computer Lessons</h3><span class="arrow">&rarr;</span></a><a class="link-card" href="programme-reading.php"><h3>Reading Programme</h3><span class="arrow">&rarr;</span></a><a class="link-card" href="programme-handwriting.php"><h3>Handwriting Programme</h3><span class="arrow">&rarr;</span></a><a class="link-card" href="programme-games.php"><h3>Games and Sports</h3><span class="arrow">&rarr;</span></a><a class="link-card" href="programme-vocational.php"><h3>Vocational Skills</h3><span class="arrow">&rarr;</span></a><a class="link-card" href="programme-daycare.php"><h3>Day Care</h3><span class="arrow">&rarr;</span></a><a class="link-card" href="programme-cocurricular.php"><h3><?php display_content('quick_card_3_title'); ?> Activities</h3><span class="arrow">&rarr;</span></a></div>
      </div>

    </div></div></section>


<?php include 'includes/public_footer.php'; ?>