<?php
$pageTitle = 'Staff Directory';
$current = 'staff-directory.php';
include 'includes/public_header.php';
?>

  <section class="page-banner">
    <div class="container">
      <h1>Staff Directory</h1>
      <p class="breadcrumb"><a href="index.php">Home</a> &raquo; Staff Directory</p>
    </div>
  </section>
  <section class="section"><div class="container">
    <div class="content-layout with-sidebar">
      <div class="content-main">
        <p class="lead">Our qualified and caring teaching and support staff.</p>
        <div class="staff-grid" id="staffList">
          <p>Loading staff...</p>
        </div>
      </div>

        <aside class="sidebar">
          <h3>In This Section</h3>
          <ul class="side-nav"><li class=""><a href="school-history.php">School History</a></li><li class=""><a href="vision-mission.php">Vision & Mission</a></li><li class=""><a href="core-values.php">Core Values</a></li><li class=""><a href="proprietor-message.php">Proprietor's Message</a></li><li class=""><a href="chairman-message.php">Chairman's Message</a></li><li class=""><a href="headteacher-message.php">Headteacher's Message</a></li><li class=""><a href="leadership-team.php">Leadership Team</a></li><li class="active"><a href="staff-directory.php">Staff Directory</a></li></ul>
          <div class="side-cta">
            <h4>Ready to Join?</h4>
            <p>Give your child the gift of quality education.</p>
            <a href="admission-information.php" class="btn btn-light btn-block">Apply Now</a>
          </div>
        </aside>
    </div></div></section>


<?php include 'includes/public_footer.php'; ?>