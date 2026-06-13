<?php
$pageTitle = 'Staff Directory';
$current = 'staff-directory.php';
include 'includes/public_header.php';

$pdo = db();
$staff = $pdo->query("SELECT * FROM staff ORDER BY sort_order ASC, name ASC")->fetchAll();
?>

<section class="page-banner">
  <div class="container">
    <h1>Staff Directory</h1>
    <p class="breadcrumb"><a href="index.php">Home</a> &raquo; Staff Directory</p>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="content-layout with-sidebar">
      <div class="content-main">
        <p class="lead">Our qualified and caring teaching and support staff.</p>
        <div class="staff-grid">
          <?php if (!empty($staff)): ?>
            <?php foreach ($staff as $s):
                $img = $s['photo'] ?: 'images/staff.jpg';
            ?>
              <div class="staff-card">
                <img src="<?= e($img) ?>" alt="<?= e($s['name']) ?>">
                <h4><?= e($s['name']) ?></h4>
                <p><?= e($s['position']) ?></p>
              </div>
            <?php endforeach; ?>
          <?php else: ?>
            <p>Staff profiles are being updated. Please check back soon.</p>
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
          <li><a href="leadership-team.php">Leadership Team</a></li>
          <li class="active"><a href="staff-directory.php">Staff Directory</a></li>
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
