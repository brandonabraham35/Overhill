<?php
$pageTitle = 'Frequently Asked Questions';
$current = 'faqs.php';
include 'includes/public_header.php';

$pdo = db();
$faqs = $pdo->query("SELECT * FROM faqs ORDER BY sort_order ASC, created_at DESC")->fetchAll();
?>

<section class="page-banner">
  <div class="container">
    <h1>Frequently Asked Questions</h1>
    <p class="breadcrumb"><a href="index.php">Home</a> &raquo; FAQs</p>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="content-layout with-sidebar">
      <div class="content-main">
        <p class="lead">Find answers to common questions about admissions, academics, and school life.</p>

        <div class="faq-list">
          <?php if (!empty($faqs)): ?>
            <?php foreach ($faqs as $f): ?>
              <details class="faq-item">
                <summary><?= e($f['question']) ?></summary>
                <div class="faq-answer">
                  <p><?= nl2br(e($f['answer'])) ?></p>
                </div>
              </details>
            <?php endforeach; ?>
          <?php else: ?>
            <p>No FAQs listed yet. Please contact us if you have any questions.</p>
          <?php endif; ?>
        </div>
      </div>

      <aside class="sidebar">
        <h3>Need More Help?</h3>
        <p>If you can't find the answer you're looking for, please don't hesitate to reach out.</p>
        <a href="contact.php" class="btn btn-primary btn-block">Contact Us</a>

        <div class="side-cta" style="margin-top:2rem;">
          <h4>Join Our School</h4>
          <a href="admission-information.php" class="btn btn-light btn-block">Apply Now</a>
        </div>
      </aside>
    </div>
  </div>
</section>

<?php include 'includes/public_footer.php'; ?>
