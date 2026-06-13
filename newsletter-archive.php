<?php
$pageTitle = 'Newsletter Archive';
$current = 'newsletter-archive.php';
include 'includes/public_header.php';

$pdo = db();
// Newsletter is usually stored in downloads table with category 'Newsletter'
$newsletters = $pdo->query("SELECT * FROM downloads WHERE category = 'Newsletter' OR title LIKE '%Newsletter%' ORDER BY created_at DESC")->fetchAll();
?>

<section class="page-banner">
  <div class="container">
    <h1>Newsletter Archive</h1>
    <p class="breadcrumb"><a href="index.php">Home</a> &raquo; Newsletter Archive</p>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="content-layout with-sidebar">
      <div class="content-main">
        <p class="lead">Browse and download past editions of our school newsletter.</p>
        <?php display_content('newsletter_archive'); ?>

        <ul class="download-list">
          <?php if (!empty($newsletters)): ?>
            <?php foreach ($newsletters as $nl): ?>
              <li>
                <span class="file-icon">PDF</span>
                <div>
                  <strong><?= e($nl['title']) ?></strong>
                  <p><?= date('F Y', strtotime($nl['created_at'])) ?></p>
                </div>
                <a href="<?= e($nl['file']) ?>" class="btn btn-sm btn-primary" download>Download</a>
              </li>
            <?php endforeach; ?>
          <?php else: ?>
            <p>No newsletters in the archive yet.</p>
          <?php endif; ?>
        </ul>
      </div>

      <aside class="sidebar">
        <h3>In This Section</h3>
        <ul class="side-nav">
          <li><a href="school-news.php">School News</a></li>
          <li><a href="school-events.php">School Events</a></li>
          <li><a href="announcements.php">Announcements</a></li>
          <li class="active"><a href="newsletter-archive.php">Newsletter Archive</a></li>
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
