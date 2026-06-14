<?php
$pageTitle = 'Home';
$current = 'index.php';
include 'includes/public_header.php';
?>

  <section class="hero-slider" id="heroSlider">
    <div class="slide active" style="background-image:url('images/hero1.jpg')">
      <div class="slide-overlay"></div>
      <div class="container slide-content">
        <span class="slide-kicker"><?php display_content('motto'); ?></span>
        <h1>Welcome to Overhill Junior School</h1>
        <p>Nurturing confident, curious learners for a bright future.</p>
        <div class="slide-actions">
          <a href="admission-information.php" class="btn btn-primary">Apply for Admission</a>
          <a href="contact.php" class="btn btn-outline">Visit Us</a>
        </div>
      </div>
    </div>
  </section>

  <section class="section quick-cards">
    <div class="container"><div class="card-grid"><div class="info-card"><div class="card-icon">&#127891;</div><h3><?php display_content('quick_card_1_title'); ?></h3><p><?php display_content('quick_card_1_text'); ?></p></div><div class="info-card"><div class="card-icon">&#128218;</div><h3><?php display_content('quick_card_2_title'); ?></h3><p><?php display_content('quick_card_2_text'); ?></p></div><div class="info-card"><div class="card-icon">&#127942;</div><h3><?php display_content('quick_card_3_title'); ?></h3><p><?php display_content('quick_card_3_text'); ?></p></div><div class="info-card"><div class="card-icon">&#128205;</div><h3><?php display_content('quick_card_4_title'); ?></h3><p><?php display_content('quick_card_4_text'); ?></p></div></div></div>
  </section>

  <section class="section">
    <div class="container">
      <div class="two-col">
        <div>
          <span class="eyebrow">Welcome</span>
          <h2>A Place Where Every Child Shines</h2>
          <p class="lead">Overhill Junior School is a private primary and nursery school founded in 2024 with a vision to provide quality, affordable education to our community and beyond.</p>
          <p>Our beloved director, Mdm. Nabulya Bridget, founded the school to ensure local children attain quality education that lets them compete on the international stage. We combine caring teachers, a stimulating environment and modern facilities to bring out the best in every learner.</p>
          <div class="cms-placeholder"><span class="cms-tag"><?php display_content('welcome_message'); ?></span><p>This content area will be populated from the admin dashboard / CMS.</p></div>
          <a href="headteacher-message.php" class="btn btn-primary">Read the Headteacher's Message</a>
        </div>
        <div class="img-frame">
          <img src="images/hero2.jpg" alt="Pupils learning at Overhill Junior School">
        </div>
      </div></div>
  </section>

      <div class="stats-band">
        <div class="container stats-grid">
          <div class="stat"><span class="stat-num"><?php display_content('years_count'); ?></span><span class="stat-label">Years of Excellence</span></div>
          <div class="stat"><span class="stat-num"><?php display_content('pupils_count'); ?></span><span class="stat-label">Happy Pupils</span></div>
          <div class="stat"><span class="stat-num"><?php display_content('teachers_count'); ?></span><span class="stat-label">Qualified Teachers</span></div>
          <div class="stat"><span class="stat-num"><?php display_content('clubs_count'); ?></span><span class="stat-label">Clubs &amp; Activities</span></div>
        </div>
      </div>
  <section class="section section-muted">
    <div class="container">
      <div class="section-head"><span class="eyebrow">What We Offer</span><h2>Special Programmes</h2><p>Designed to make learning exciting and well-rounded for every child.</p></div>
      <div class="prog-grid"><a class="prog-card" href="programme-computer.php"><div class="prog-img" style="background-image:url('images/facility.jpg')"></div><div class="prog-body"><h3>Computer Lessons</h3><p>Hands-on digital skills from an early age.</p><span class="arrow">Learn more &rarr;</span></div></a><a class="prog-card" href="programme-reading.php"><div class="prog-img" style="background-image:url('images/hero2.jpg')"></div><div class="prog-body"><h3>Reading Programme</h3><p>Building a lifelong love of books and stories.</p><span class="arrow">Learn more &rarr;</span></div></a><a class="prog-card" href="programme-games.php"><div class="prog-img" style="background-image:url('images/hero3.jpg')"></div><div class="prog-body"><h3>Games & Sports</h3><p>Healthy bodies, healthy minds, great teamwork.</p><span class="arrow">Learn more &rarr;</span></div></a></div>
      <div class="center"><a href="special-programmes.php" class="btn btn-outline-dark">View All Programmes</a></div>
    </div>
  </section>
  <section class="section">
    <div class="container">
      <div class="section-head"><span class="eyebrow">Stay Updated</span><h2>Latest News &amp; Events</h2><p>News articles are managed through the admin dashboard.</p></div>

      <div class="news-grid" id="newsList">
        <p>Loading news...</p>
      </div>
      <div class="center"><a href="school-news.php" class="btn btn-outline-dark">All News &amp; Events</a></div>
    </div>
  </section>

      <section class="cta-band" style="background-image:url('images/hero1.jpg')">
        <div class="cta-overlay"></div>
        <div class="container cta-content">
          <h2>Give Your Child a Head Start</h2>
          <p>Admissions are open for Nursery and Primary classes. Join the Overhill family today.</p>
          <a href="admission-information.php" class="btn btn-primary btn-lg">Apply for Admission</a>
        </div>
      </section>


<?php include 'includes/public_footer.php'; ?>