<?php
$pageTitle = 'Student Articles';
$current = 'student-articles.php';
include 'includes/public_header.php';
?>

  <section class="page-banner">
    <div class="container">
      <h1>Student Articles</h1>
      <p class="breadcrumb"><a href="index.php">Home</a> &raquo; Student Articles</p>
    </div>
  </section>
  <section class="section"><div class="container">
    <div class="content-layout with-sidebar">
      <div class="content-main">
        <p class="lead">Creative writing, poems and stories by our talented pupils.</p><div class="cms-placeholder"><span class="cms-tag"><?php display_content('student_articles'); ?></span><p>This content area will be populated from the admin dashboard / CMS.</p></div><div class="news-grid"><article class="news-card"><div class="news-body"><h3><?php display_content('article_title_1'); ?></h3><p class="muted">By <?php display_content('article_author_1'); ?></p><p><?php display_content('article_excerpt_1'); ?></p><a href="#">Read more &rarr;</a></div></article><article class="news-card"><div class="news-body"><h3><?php display_content('article_title_2'); ?></h3><p class="muted">By <?php display_content('article_author_2'); ?></p><p><?php display_content('article_excerpt_2'); ?></p><a href="#">Read more &rarr;</a></div></article><article class="news-card"><div class="news-body"><h3><?php display_content('article_title_3'); ?></h3><p class="muted">By <?php display_content('article_author_3'); ?></p><p><?php display_content('article_excerpt_3'); ?></p><a href="#">Read more &rarr;</a></div></article></div>
      </div>

        <aside class="sidebar">
          <h3>In This Section</h3>
          <ul class="side-nav"><li class=""><a href="school-anthem.php">School Anthem</a></li><li class=""><a href="school-prayer.php">School Prayer</a></li><li class=""><a href="clubs-societies.php">Clubs and Societies</a></li><li class=""><a href="student-leadership.php">Leadership</a></li><li class="active"><a href="student-articles.php">Student Articles</a></li><li class=""><a href="student-welfare.php">Student Welfare</a></li></ul>
          <div class="side-cta">
            <h4>Ready to Join?</h4>
            <p>Give your child the gift of quality education.</p>
            <a href="admission-information.php" class="btn btn-light btn-block">Apply Now</a>
          </div>
        </aside>
    </div></div></section>


<?php include 'includes/public_footer.php'; ?>