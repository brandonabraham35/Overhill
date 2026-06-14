<?php
$pageTitle = 'School Calendar';
$current = 'school-calendar.php';
include 'includes/public_header.php';
?>

  <section class="page-banner">
    <div class="container">
      <h1>School Calendar</h1>
      <p class="breadcrumb"><a href="index.php">Home</a> &raquo; School Calendar</p>
    </div>
  </section>
  <section class="section"><div class="container">
    <div class="content-layout with-sidebar">
      <div class="content-main">
        <p class="lead">Key dates and terms for the academic year. Calendar entries are managed in the admin dashboard.</p><?php display_content('school_calendar'); ?><table class="data-table"><thead><tr><th>Term</th><th>Opening Date</th><th>Closing Date</th><th>Key Events</th></tr></thead><tbody><tr><td>Term 1</td><td><?php display_content('term_1_open'); ?></td><td><?php display_content('term_1_close'); ?></td><td><?php display_content('term_1_events'); ?></td></tr><tr><td>Term 2</td><td><?php display_content('term_2_open'); ?></td><td><?php display_content('term_2_close'); ?></td><td><?php display_content('term_2_events'); ?></td></tr><tr><td>Term 3</td><td><?php display_content('term_3_open'); ?></td><td><?php display_content('term_3_close'); ?></td><td><?php display_content('term_3_events'); ?></td></tr></tbody></table>
      </div>

        <aside class="sidebar">
          <h3>In This Section</h3>
          <ul class="side-nav"><li class=""><a href="admission-information.php">Admission Information</a></li><li class=""><a href="fee-structure.php">Fee Structure</a></li><li class="active"><a href="school-calendar.php">School Calendar</a></li><li class=""><a href="school-rules.php">School Rules</a></li><li class=""><a href="parent-guidelines.php">Parent Guidelines</a></li><li class=""><a href="communication-policy.php">Communication Policy</a></li><li class=""><a href="download-forms.php">Download Forms</a></li></ul>
          <div class="side-cta">
            <h4>Ready to Join?</h4>
            <p>Give your child the gift of quality education.</p>
            <a href="admission-information.php" class="btn btn-light btn-block">Apply Now</a>
          </div>
        </aside>
    </div></div></section>


<?php include 'includes/public_footer.php'; ?>