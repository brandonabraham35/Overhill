<?php
$pageTitle = 'Fee Structure';
$current = 'fee-structure.php';
include 'includes/public_header.php';
?>

  <section class="page-banner">
    <div class="container">
      <h1>Fee Structure</h1>
      <p class="breadcrumb"><a href="index.php">Home</a> &raquo; Fee Structure</p>
    </div>
  </section>
  <section class="section"><div class="container">
    <div class="content-layout with-sidebar">
      <div class="content-main">
        <p class="lead">Affordable, transparent fees for quality education. Figures below are managed via the admin dashboard.</p><div class="cms-placeholder"><span class="cms-tag"><?php display_content('fee_structure'); ?></span><p>This content area will be populated from the admin dashboard / CMS.</p></div><table class="data-table"><thead><tr><th>Class / Section</th><th>Tuition (per term)</th><th>Requirements</th><th>Total</th></tr></thead><tbody><tr><td><?php display_content('fee_class_1'); ?></td><td><?php display_content('fee_tuition_1'); ?></td><td><?php display_content('fee_req_1'); ?></td><td><?php display_content('fee_total_1'); ?></td></tr><tr><td><?php display_content('fee_class_2'); ?></td><td><?php display_content('fee_tuition_2'); ?></td><td><?php display_content('fee_req_2'); ?></td><td><?php display_content('fee_total_2'); ?></td></tr><tr><td><?php display_content('fee_class_3'); ?></td><td><?php display_content('fee_tuition_3'); ?></td><td><?php display_content('fee_req_3'); ?></td><td><?php display_content('fee_total_3'); ?></td></tr><tr><td><?php display_content('fee_class_4'); ?></td><td><?php display_content('fee_tuition_4'); ?></td><td><?php display_content('fee_req_4'); ?></td><td><?php display_content('fee_total_4'); ?></td></tr><tr><td><?php display_content('fee_class_5'); ?></td><td><?php display_content('fee_tuition_5'); ?></td><td><?php display_content('fee_req_5'); ?></td><td><?php display_content('fee_total_5'); ?></td></tr></tbody></table><div class="note-box"><h3>Payment Information</h3><p>Fees are payable per term. For bank details and payment plans, please contact the school office.</p></div>
      </div>

        <aside class="sidebar">
          <h3>In This Section</h3>
          <ul class="side-nav"><li class=""><a href="admission-information.php">Admission Information</a></li><li class="active"><a href="fee-structure.php">Fee Structure</a></li><li class=""><a href="school-calendar.php">School Calendar</a></li><li class=""><a href="school-rules.php">School Rules</a></li><li class=""><a href="parent-guidelines.php">Parent Guidelines</a></li><li class=""><a href="communication-policy.php">Communication Policy</a></li><li class=""><a href="download-forms.php">Download Forms</a></li></ul>
          <div class="side-cta">
            <h4>Ready to Join?</h4>
            <p>Give your child the gift of quality education.</p>
            <a href="admission-information.php" class="btn btn-light btn-block">Apply Now</a>
          </div>
        </aside>
    </div></div></section>


<?php include 'includes/public_footer.php'; ?>