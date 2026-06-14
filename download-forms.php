<?php
$pageTitle = 'Download Forms';
$current = 'download-forms.php';
include 'includes/public_header.php';

$pdo = db();
$downloads = $pdo->query("SELECT * FROM downloads ORDER BY id DESC")->fetchAll();
?>

<section class="page-banner">
  <div class="container">
    <h1>Download Forms</h1>
    <p class="breadcrumb"><a href="index.php">Home</a> &raquo; Download Forms</p>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="content-layout with-sidebar">
      <div class="content-main">
        <p class="lead"><?php display_content('downloads_intro'); ?></p>
        <div class="download-list">
          <?php if (!empty($downloads)): ?>
            <?php foreach ($downloads as $d): ?>
              <a class="download-row" href="<?= e($d['file']) ?>" download>
                <?= e($d['title']) ?>
                <span><?= e($d['category'] ?? '') ?></span>
              </a>
            <?php endforeach; ?>
          <?php else: ?>
            <p>No downloadable forms available at the moment.</p>
          <?php endif; ?>
        </div>
      </div>

      <aside class="sidebar">
        <h3>In This Section</h3>
        <ul class="side-nav">
          <li><a href="admission-information.php">Admission Information</a></li>
          <li><a href="fee-structure.php">Fee Structure</a></li>
          <li><a href="school-calendar.php">School Calendar</a></li>
          <li><a href="school-rules.php">School Rules</a></li>
          <li><a href="parent-guidelines.php">Parent Guidelines</a></li>
          <li><a href="communication-policy.php">Communication Policy</a></li>
          <li class="active"><a href="download-forms.php">Download Forms</a></li>
        </ul>
        <div class="side-cta">
          <h4>Ready to Join?</h4>
          <p>Give your child the gift of quality education.</p>
          <a href="admission-information.php" class="btn btn-light btn-block">Apply Now</a>
        </div>
      </aside>
    </div>
  </div>
</section>

<?php include 'includes/public_footer.php'; ?>
