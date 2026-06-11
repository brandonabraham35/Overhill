<?php
/**
 * Overhill Junior School - Global configuration
 * Edit the DB_* values to match your MySQL server.
 */
define('DB_HOST', getenv('OJS_DB_HOST') ?: 'localhost');
define('DB_NAME', getenv('OJS_DB_NAME') ?: 'overhill_school');
define('DB_USER', getenv('OJS_DB_USER') ?: 'root');
define('DB_PASS', getenv('OJS_DB_PASS') ?: '');
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

date_default_timezone_set('Africa/Kampala');
