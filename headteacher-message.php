<?php
$pageTitle = 'Headteacher's Message';
$current = 'headteacher-message.php';
include 'includes/public_header.php';
?>

  <section class="page-banner">
    <div class="container">
      <h1>Headteacher's Message</h1>
      <p class="breadcrumb"><a href="index.php">Home</a> &raquo; Headteacher's Message</p>
    </div>
  </section>
  <section class="section"><div class="container">
    <div class="content-layout with-sidebar">
      <div class="content-main">
        <div class="message-layout"><div class="message-photo"><img src="images/staff.jpg" alt="Headteacher"><span class="msg-role">Headteacher</span><span class="msg-name"><?php display_content('headteacher_name'); ?></span></div><div class="message-text"><span class="eyebrow">A Message from the Headteacher</span><h2>Welcome to Overhill Junior School</h2><p class="lead">It is my great pleasure to welcome you to our school community.</p><p>At Overhill Junior School, we believe every child is unique and full of potential. Our dedicated team works tirelessly to provide a safe, nurturing and stimulating environment where children love to learn.</p><p>Thank you for considering us as partners in your child's education. We look forward to welcoming you to the Overhill family.</p><?php display_content('headteacher_message'); ?></div></div>
      </div>

        <aside class="sidebar">
          <h3>In This Section</h3>
          <ul class="side-nav"><li class=""><a href="school-history.php">School History</a></li><li class=""><a href="vision-mission.php">Vision & Mission</a></li><li class=""><a href="core-values.php">Core Values</a></li><li class=""><a href="proprietor-message.php">Proprietor's Message</a></li><li class=""><a href="chairman-message.php">Chairman's Message</a></li><li class="active"><a href="headteacher-message.php">Headteacher's Message</a></li><li class=""><a href="leadership-team.php">Leadership Team</a></li><li class=""><a href="staff-directory.php">Staff Directory</a></li></ul>
          <div class="side-cta">
            <h4>Ready to Join?</h4>
            <p>Give your child the gift of quality education.</p>
            <a href="admission-information.php" class="btn btn-light btn-block">Apply Now</a>
          </div>
        </aside>
    </div></div></section>


<?php include 'includes/public_footer.php'; ?>