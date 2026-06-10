<?php
require_once __DIR__ . '/_bootstrap.php';
only('GET');
$stats = [
    'news_count' => count_rows('news'),
    'events_count' => count_rows('events'),
    'pupils_count' => count_rows('admissions'), // Assuming happy pupils is related to admissions or a setting
    'staff_count' => count_rows('staff'),
    'clubs_count' => 6, // Default or could be dynamic if there was a clubs table
    'years_count' => date('Y') - 2024 + 1
];

// Allow overriding from site_settings if they exist
$rows = db()->query("SELECT setting_key, setting_value FROM site_settings WHERE setting_key LIKE '%_count'")->fetchAll();
foreach ($rows as $row) {
    $stats[$row['setting_key']] = $row['setting_value'];
}

json_response(['ok' => true, 'stats' => $stats]);
