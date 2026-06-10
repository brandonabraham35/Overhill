<?php
require_once __DIR__ . '/_bootstrap.php';
only('POST');
require_csrf();
$student = clean($_POST['student_name'] ?? '');
$dob = clean($_POST['date_of_birth'] ?? '');
$gender = clean($_POST['gender'] ?? '');
$parent = clean($_POST['parent_name'] ?? '');
$contact = clean($_POST['parent_contact'] ?? '');
$pemail = clean($_POST['parent_email'] ?? '');
$prev = clean($_POST['previous_school'] ?? '');
$class = clean($_POST['desired_class'] ?? '');
$errors = [];
if (strlen($student) < 2) $errors[] = 'Student name required.';
if (strlen($parent) < 2) $errors[] = 'Parent name required.';
if (!preg_match('/^[0-9+\\-\\s()]{6,40}$/', $contact)) $errors[] = 'Valid contact required.';
if ($pemail && !valid_email($pemail)) $errors[] = 'Invalid email.';
if (strlen($class) < 1) $errors[] = 'Desired class required.';
if (!in_array($gender, ['Male','Female','Other',''], true)) $errors[] = 'Invalid gender.';
if ($errors) json_response(['ok' => false, 'error' => implode(' ', $errors)], 422);

$docUrl = null;
if (!empty($_FILES['document']['name'])) {
    $up = handle_upload($_FILES['document'], 'document');
    if (!$up['ok']) json_response(['ok' => false, 'error' => $up['error']], 422);
    $docUrl = $up['path'];
}
db()->prepare('INSERT INTO admissions (student_name,date_of_birth,gender,parent_name,parent_contact,parent_email,previous_school,desired_class,document) VALUES (?,?,?,?,?,?,?,?,?)')
    ->execute([$student, $dob ?: null, $gender ?: null, $parent, $contact, $pemail ?: null, $prev ?: null, $class, $docUrl]);
json_response(['ok' => true, 'message' => 'Application submitted successfully. We will contact you soon.']);
