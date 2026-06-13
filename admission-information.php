<?php
$pageTitle = 'Admission Information';
$current = 'admission-information.php';
include 'includes/public_header.php';
?>

  <section class="page-banner">
    <div class="container">
      <h1>Admission Information</h1>
      <p class="breadcrumb"><a href="index.php">Home</a> &raquo; Admission Information</p>
    </div>
  </section>
  <section class="section"><div class="container">
    <div class="content-layout with-sidebar">
      <div class="content-main">
        <h2>Join Overhill Junior School</h2>
        <p class="lead">We are delighted that you are considering Overhill Junior School for your child's education. Our admission process is designed to be friendly and straightforward.</p>

        <h3>Admission Steps</h3>
        <ol class="step-list">
          <li><strong>Visit Us:</strong> We encourage parents to visit the school for a tour and to meet the staff.</li>
          <li><strong>Application:</strong> Fill out the admission form below or collect a physical form from the school office.</li>
          <li><strong>Interview/Assessment:</strong> A brief interaction with the child to determine their learning level.</li>
          <li><strong>Registration:</strong> Complete the necessary paperwork and pay the registration fees.</li>
        </ol>

        <div class="contact-form-card" style="margin-top: 3rem;">
          <h3>Online Admission Form</h3>
          <form data-api="api/admissions.php" enctype="multipart/form-data">
            <div class="form-group">
              <label>Student's Full Name</label>
              <input type="text" name="student_name" required placeholder="Enter student's full name">
            </div>
            <div class="form-row">
              <div class="form-group">
                <label>Date of Birth</label>
                <input type="date" name="date_of_birth">
              </div>
              <div class="form-group">
                <label>Gender</label>
                <select name="gender">
                  <option value="">Select Gender</option>
                  <option value="Male">Male</option>
                  <option value="Female">Female</option>
                  <option value="Other">Other</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label>Parent/Guardian Name</label>
              <input type="text" name="parent_name" required placeholder="Enter parent or guardian name">
            </div>
            <div class="form-row">
              <div class="form-group">
                <label>Parent Contact Number</label>
                <input type="tel" name="parent_contact" required placeholder="+256...">
              </div>
              <div class="form-group">
                <label>Parent Email (Optional)</label>
                <input type="email" name="parent_email" placeholder="email@example.com">
              </div>
            </div>
            <div class="form-group">
              <label>Desired Class</label>
              <input type="text" name="desired_class" required placeholder="e.g. Primary 1, Baby Class">
            </div>
            <div class="form-group">
              <label>Previous School (If any)</label>
              <input type="text" name="previous_school" placeholder="Name of previous school">
            </div>
            <div class="form-group">
              <label>Birth Certificate / Report Card (Optional)</label>
              <input type="file" name="document">
            </div>
            <button type="submit" class="btn btn-primary btn-block">Submit Application</button>
          </form>
        </div>
      </div>

        <aside class="sidebar">
          <h3>In This Section</h3>
          <ul class="side-nav">
            <li class="active"><a href="admission-information.php">Admission Information</a></li>
            <li><a href="fee-structure.php">Fee Structure</a></li>
            <li><a href="school-calendar.php">School Calendar</a></li>
            <li><a href="school-rules.php">School Rules</a></li>
            <li><a href="parent-guidelines.php">Parent Guidelines</a></li>
            <li><a href="communication-policy.php">Communication Policy</a></li>
            <li><a href="download-forms.php">Download Forms</a></li>
          </ul>
          <div class="side-cta">
            <h4>Ready to Join?</h4>
            <p>Give your child the gift of quality education.</p>
            <a href="admission-information.php" class="btn btn-light btn-block">Apply Now</a>
          </div>
        </aside>
    </div></div></section>

<?php include 'includes/public_footer.php'; ?>
