<?php
$pageTitle = 'Library';
$current = 'facility-library.php';
include 'includes/public_header.php';
?>

  <section class="page-banner">
    <div class="container">
      <h1>Library</h1>
      <p class="breadcrumb"><a href="index.php">Home</a> &raquo; Library</p>
    </div>
  </section>
  <section class="section"><div class="container">
    <div class="content-layout with-sidebar">
      <div class="content-main">
        <div class="img-frame wide"><img src="images/facility.jpg" alt="Library"></div><p class="lead">A well-stocked library that encourages reading, research and a lifelong love of books.</p><p>At Overhill Junior School, we invest in facilities that keep our learners safe, comfortable and inspired. This space is designed with the needs of young children in mind.</p><?php display_content('facility_library_content'); ?><div class="card-grid"><div class="info-card"><div class="card-icon">&#10003;</div><h3>Safe & Secure</h3><p>Child-friendly and regularly maintained.</p></div><div class="info-card"><div class="card-icon">&#10003;</div><h3>Well Equipped</h3><p>Resourced to support quality learning.</p></div><div class="info-card"><div class="card-icon">&#10003;</div><h3>Supervised</h3><p>Caring staff are always on hand.</p></div></div>
      </div>

        <aside class="sidebar">
          <h3>In This Section</h3>
          <ul class="side-nav"><li class=""><a href="facility-nursery.php">Nursery Section</a></li><li class=""><a href="facility-primary.php">Primary Section</a></li><li class="active"><a href="facility-library.php">Library</a></li><li class=""><a href="facility-computer-lab.php">Computer Laboratory</a></li><li class=""><a href="facility-science-lab.php">Science Laboratory</a></li><li class=""><a href="facility-hall.php">Multipurpose Hall</a></li><li class=""><a href="facility-sick-bay.php">Sick Bay</a></li><li class=""><a href="facility-kitchen.php">Kitchen</a></li><li class=""><a href="facility-transport.php">School Transport</a></li><li class=""><a href="facility-sports.php">Sports Facilities</a></li><li class=""><a href="facility-washrooms.php">School Washrooms</a></li></ul>
          <div class="side-cta">
            <h4>Ready to Join?</h4>
            <p>Give your child the gift of quality education.</p>
            <a href="admission-information.php" class="btn btn-light btn-block">Apply Now</a>
          </div>
        </aside>
    </div></div></section>


<?php include 'includes/public_footer.php'; ?>