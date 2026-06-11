<?php
require_once __DIR__ . '/_bootstrap.php';
only('POST');
require_csrf();
$d = $_POST ?: read_json_body();
$name = clean($d['name'] ?? '');
$email = clean($d['email'] ?? '');
$phone = clean($d['phone'] ?? '');
$subject = clean($d['subject'] ?? '');
$message = clean($d['message'] ?? '');
$errors = [];
if (strlen($name) < 2 || strlen($name) > 150) $errors[] = 'Valid name required.';
if (!valid_email($email)) $errors[] = 'Valid email required.';
if (strlen($message) < 5 || strlen($message) > 2000) $errors[] = 'Message must be 5-2000 chars.';
if ($phone && !preg_match('/^[0-9+\\-\\s()]{6,40}$/', $phone)) $errors[] = 'Invalid phone.';
if ($errors) json_response(['ok' => false, 'error' => implode(' ', $errors)], 422);

db()->prepare('INSERT INTO contact_messages (name,email,phone,subject,message) VALUES (?,?,?,?,?)')
    ->execute([$name, $email, $phone, mb_substr($subject,0,200), $message]);

// Email Notification
require_once BASE_PATH . '/includes/EmailService.php';
$emailData = [
    'name' => $name,
    'subject' => $subject
];
EmailService::sendContactConfirmation($email, $emailData);

// Admin Notification
$adminDetails = "<li>From: $name ($email)</li><li>Subject: $subject</li><li>Message: $message</li>";
EmailService::sendAdminNotification("New Contact Message: $subject", [
    'action' => 'New Contact Message',
    'details' => $adminDetails
]);

json_response(['ok' => true, 'message' => 'Thank you! Your message has been received.']);
