<?php
$pageTitle = 'School Events';
$current = 'school-events.php';
include 'includes/public_header.php';

$pdo = db();
$events = $pdo->query("SELECT * FROM events WHERE event_date >= CURDATE() ORDER BY event_date ASC")->fetchAll();
?>

<section class="page-banner">
  <div class="container">
    <h1>School Events</h1>
    <p class="breadcrumb"><a href="index.php">Home</a> &raquo; School Events</p>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="content-layout with-sidebar">
      <div class="content-main">
        <p class="lead">Upcoming events at Overhill Junior School.</p>
        <div class="news-grid">
          <?php if (!empty($events)): ?>
            <?php foreach ($events as $e):
                $date = strtotime($e['event_date']);
                $day = date('d', $date);
                $month = date('M', $date);
            ?>
              <article class="news-card">
                <div class="news-date"><span class="d"><?= $day ?></span><span class="m"><?= $month ?></span></div>
                <div class="news-body">
                  <h3><?= e($e['title']) ?></h3>
                  <p><?= nl2br(e($e['description'])) ?></p>
                </div>
              </article>
            <?php endforeach; ?>
          <?php else: ?>
            <p>No upcoming events at the moment. Please check back later.</p>
          <?php endif; ?>
        </div>
      </div>

      <aside class="sidebar">
        <h3>In This Section</h3>
        <ul class="side-nav">
          <li><a href="school-news.php">School News</a></li>
          <li class="active"><a href="school-events.php">School Events</a></li>
          <li><a href="announcements.php">Announcements</a></li>
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
