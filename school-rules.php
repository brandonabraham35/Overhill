<?php
$pageTitle = 'School Rules';
$current = 'school-rules.php';
include 'includes/public_header.php';
?>

  <section class="page-banner">
    <div class="container">
      <h1>School Rules</h1>
      <p class="breadcrumb"><a href="index.php">Home</a> &raquo; School Rules</p>
    </div>
  </section>
  <section class="section"><div class="container">
    <div class="content-layout with-sidebar">
      <div class="content-main">
        <p class="lead"><?php display_content('school_rules'); ?></p><div class="cms-placeholder"><span class="cms-tag"><?php display_content('school_rules'); ?></span><p>This content area will be populated from the admin dashboard / CMS.</p></div><ul class="check-list"><li>Arrive at school on time every day.</li><li>Wear the correct, clean school uniform.</li><li>Respect teachers, staff and fellow pupils.</li><li>Keep the school clean and take care of property.</li><li>No bullying, fighting or use of abusive language.</li><li>Complete all homework and class assignments.</li></ul>
      </div>

        <aside class="sidebar">
          <h3>In This Section</h3>
          <ul class="side-nav"><li class=""><a href="admission-information.php">Admission Information</a></li><li class=""><a href="fee-structure.php">Fee Structure</a></li><li class=""><a href="school-calendar.php">School Calendar</a></li><li class="active"><a href="school-rules.php">School Rules</a></li><li class=""><a href="parent-guidelines.php">Parent Guidelines</a></li><li class=""><a href="communication-policy.php">Communication Policy</a></li><li class=""><a href="download-forms.php">Download Forms</a></li></ul>
          <div class="side-cta">
            <h4>Ready to Join?</h4>
            <p>Give your child the gift of quality education.</p>
            <a href="admission-information.php" class="btn btn-light btn-block">Apply Now</a>
          </div>
        </aside>
    </div></div></section>


<?php include 'includes/public_footer.php'; ?>