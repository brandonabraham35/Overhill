<?php
$pageTitle = 'Clubs and Societies';
$current = 'clubs-societies.php';
include 'includes/public_header.php';
?>

  <section class="page-banner">
    <div class="container">
      <h1>Clubs and Societies</h1>
      <p class="breadcrumb"><a href="index.php">Home</a> &raquo; Clubs and Societies</p>
    </div>
  </section>
  <section class="section"><div class="container">
    <div class="content-layout with-sidebar">
      <div class="content-main">
        <p class="lead">There is something for everyone! Pupils develop talents and make friends through our clubs.</p><div class="cms-placeholder"><span class="cms-tag"><?php display_content('clubs_societies'); ?></span><p>This content area will be populated from the admin dashboard / CMS.</p></div><div class="card-grid"><div class="info-card"><div class="card-icon">&#9917;</div><h3>Sports Club</h3><p>Football, netball, athletics and more.</p></div><div class="info-card"><div class="card-icon">&#127916;</div><h3>Drama & Music</h3><p>Performance, dance and creative arts.</p></div><div class="info-card"><div class="card-icon">&#128218;</div><h3>Debate & Reading</h3><p>Confidence, language and public speaking.</p></div><div class="info-card"><div class="card-icon">&#128300;</div><h3>Science Club</h3><p>Curiosity-driven experiments and discovery.</p></div><div class="info-card"><div class="card-icon">&#127912;</div><h3>Art & Craft</h3><p>Imagination and hands-on creativity.</p></div><div class="info-card"><div class="card-icon">&#127759;</div><h3>Environment Club</h3><p>Caring for our school and planet.</p></div></div>
      </div>

        <aside class="sidebar">
          <h3>In This Section</h3>
          <ul class="side-nav"><li class=""><a href="school-anthem.php">School Anthem</a></li><li class=""><a href="school-prayer.php">School Prayer</a></li><li class="active"><a href="clubs-societies.php">Clubs and Societies</a></li><li class=""><a href="student-leadership.php">Leadership</a></li><li class=""><a href="student-articles.php">Student Articles</a></li><li class=""><a href="student-welfare.php">Student Welfare</a></li></ul>
          <div class="side-cta">
            <h4>Ready to Join?</h4>
            <p>Give your child the gift of quality education.</p>
            <a href="admission-information.php" class="btn btn-light btn-block">Apply Now</a>
          </div>
        </aside>
    </div></div></section>


<?php include 'includes/public_footer.php'; ?>