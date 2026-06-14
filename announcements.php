<?php
$pageTitle = 'Announcements';
$current = 'announcements.php';
include 'includes/public_header.php';

$pdo = db();
$announcements = $pdo->query("SELECT * FROM announcements ORDER BY created_at DESC")->fetchAll();
?>

<section class="page-banner">
  <div class="container">
    <h1>Announcements</h1>
    <p class="breadcrumb"><a href="index.php">Home</a> &raquo; Announcements</p>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="content-layout with-sidebar">
      <div class="content-main">
        <p class="lead">Important notices and announcements for parents and pupils.</p>
        <ul class="announce-list">
          <?php if (!empty($announcements)): ?>
            <?php foreach ($announcements as $a):
                $date = date('d M Y', strtotime($a['created_at']));
            ?>
              <li>
                <span class="announce-date"><?= $date ?></span>
                <div>
                  <strong><?= e($a['title']) ?></strong>
                  <p><?= nl2br(e($a['body'])) ?></p>
                </div>
              </li>
            <?php endforeach; ?>
          <?php else: ?>
            <p>No announcements at this time.</p>
          <?php endif; ?>
        </ul>
      </div>

      <aside class="sidebar">
        <h3>In This Section</h3>
        <ul class="side-nav">
          <li><a href="school-news.php">School News</a></li>
          <li><a href="school-events.php">School Events</a></li>
          <li class="active"><a href="announcements.php">Announcements</a></li>
          <li><a href="newsletter-archive.php">Newsletter Archive</a></li>
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
