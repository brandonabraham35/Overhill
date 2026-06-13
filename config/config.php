<?php
/**
 * Overhill Junior School - Global configuration
 * Edit the DB_* values to match your MySQL server.
 */
define('DB_HOST', 'sql103.infinityfree.com');
define('DB_NAME', 'if0_41906047_overhill_school');
define('DB_USER', 'if0_41906047');
define('DB_PASS', '782243ben');
define('DB_CHARSET', 'utf8mb4');

// Absolute path to the project root (one level up from /config)
define('BASE_PATH', dirname(__DIR__));
define('UPLOAD_PATH', BASE_PATH . '/uploads');
define('UPLOAD_URL', 'uploads');

// Upload rules
define('MAX_IMAGE_SIZE', 5 * 1024 * 1024);     // 5 MB
define('MAX_DOC_SIZE', 10 * 1024 * 1024);      // 10 MB
$GLOBALS['ALLOWED_IMAGE_EXT'] = ['jpg', 'jpeg', 'png', 'webp'];
$GLOBALS['ALLOWED_DOC_EXT']   = ['pdf', 'docx'];

// Session lifetime (seconds) for idle timeout
define('SESSION_TIMEOUT', 30 * 60); // 30 minutes

// SMTP Settings
define('SMTP_HOST', getenv('SMTP_HOST') ?: 'smtp.gmail.com');
define('SMTP_PORT', getenv('SMTP_PORT') ?: 587);
define('SMTP_USER', getenv('SMTP_USER') ?: '');
define('SMTP_PASS', getenv('SMTP_PASS') ?: '');
define('SMTP_AUTH', true);
define('SMTP_SECURE', 'tls');
define('SMTP_FROM_EMAIL', getenv('SMTP_FROM_EMAIL') ?: 'overhilljuniorschool@gmail.com');
define('SMTP_FROM_NAME', 'Overhill Junior School');
define('ADMIN_EMAIL', getenv('ADMIN_EMAIL') ?: 'overhilljuniorschool@gmail.com');

date_default_timezone_set('Africa/Kampala');
