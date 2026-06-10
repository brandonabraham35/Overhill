<?php
require_once dirname(__DIR__) . '/includes/auth.php';
require_login();
$pageTitle = 'Dashboard';
$stats = [
    'News'             => count_rows('news'),
    'Events'           => count_rows('events'),
    'Applications'     => count_rows('admissions'),
    'Gallery Images'   => count_rows('gallery_images'),
    'Contact Messages' => count_rows('contact_messages'),
    'Staff'            => count_rows('staff'),
];
$recentMsgs = db()->query('SELECT * FROM contact_messages ORDER BY created_at DESC LIMIT 5')->fetchAll();
$recentApps = db()->query('SELECT * FROM admissions ORDER BY created_at DESC LIMIT 5')->fetchAll();
include __DIR__ . '/includes/header.php';
?>
<div class="stat-grid">
  <?php foreach ($stats as $label => $n): ?>
    <div class="stat-card">
      <div class="stat-num"><?= (int)$n ?></div>
      <div class="stat-label">Total <?= e($label) ?></div>
    </div>
  <?php endforeach; ?>
</div>

<div class="dash-cols">
  <section class="panel">
    <h3>Recent Messages</h3>
    <table class="data-table">
      <thead><tr><th>Name</th><th>Subject</th><th>Date</th></tr></thead>
      <tbody>
      <?php if(!$recentMsgs):?><tr><td colspan="3" class="empty">No messages.</td></tr><?php endif;?>
      <?php foreach ($recentMsgs as $m): ?>
        <tr><td><?= e($m['name']) ?></td><td><?= e($m['subject']) ?></td><td><?= e(date('d M Y', strtotime($m['created_at']))) ?></td></tr>
      <?php endforeach; ?>
      </tbody>
    </table>
    <a class="btn-ghost" href="messages.php">View all</a>
  </section>
  <section class="panel">
    <h3>Recent Applications</h3>
    <table class="data-table">
      <thead><tr><th>Student</th><th>Class</th><th>Status</th></tr></thead>
      <tbody>
      <?php if(!$recentApps):?><tr><td colspan="3" class="empty">No applications.</td></tr><?php endif;?>
      <?php foreach ($recentApps as $a): ?>
        <tr><td><?= e($a['student_name']) ?></td><td><?= e($a['desired_class']) ?></td><td><span class="badge b-<?= e($a['status']) ?>"><?= e($a['status']) ?></span></td></tr>
      <?php endforeach; ?>
      </tbody>
    </table>
    <a class="btn-ghost" href="admissions.php">View all</a>
  </section>
</div>
<?php include __DIR__ . '/includes/footer.php'; ?>
