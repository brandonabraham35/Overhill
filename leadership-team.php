<?php
$pageTitle = 'Leadership Team';
$current = 'leadership-team.php';
include 'includes/public_header.php';

$pdo = db();
$leadership = $pdo->query("SELECT * FROM leadership ORDER BY id ASC")->fetchAll();
?>

<section class="page-banner">
  <div class="container">
    <h1>Leadership Team</h1>
    <p class="breadcrumb"><a href="index.php">Home</a> &raquo; Leadership Team</p>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="content-layout with-sidebar">
      <div class="content-main">
        <p class="lead">Guided by a team of experienced and dedicated leaders.</p>
        <div class="person-grid">
          <?php if (!empty($leadership)): ?>
            <?php foreach ($leadership as $l):
                $img = $l['photo'] ?: 'images/staff.jpg';
            ?>
              <div class="person-card">
                <div class="person-img" style="background-image:url('<?= e($img) ?>')"></div>
                <div class="person-body">
                  <h3><?= e($l['name']) ?></h3>
                  <span class="person-role"><?= e($l['title']) ?></span>
                  <p><?= nl2br(e($l['message'])) ?></p>
                </div>
              </div>
            <?php endforeach; ?>
          <?php else: ?>
            <p>Leadership information is being updated.</p>
          <?php endif; ?>
        </div>
      </div>

      <aside class="sidebar">
        <h3>In This Section</h3>
        <ul class="side-nav">
          <li><a href="school-history.php">School History</a></li>
          <li><a href="vision-mission.php">Vision & Mission</a></li>
          <li><a href="core-values.php">Core Values</a></li>
          <li><a href="proprietor-message.php">Proprietor's Message</a></li>
          <li><a href="chairman-message.php">Chairman's Message</a></li>
          <li><a href="headteacher-message.php">Headteacher's Message</a></li>
          <li class="active"><a href="leadership-team.php">Leadership Team</a></li>
          <li><a href="staff-directory.php">Staff Directory</a></li>
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
