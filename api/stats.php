<?php
require_once __DIR__ . '/_bootstrap.php';
only('GET');

$stats = [
    'news_count' => count_rows('news'),
    'events_count' => count_rows('events'),
    'staff_count' => count_rows('staff'),
];

// Fetch counts and other stat settings from site_settings
$rows = db()->query("SELECT setting_key, setting_value FROM site_settings WHERE setting_key LIKE '%_count'")->fetchAll();
foreach ($rows as $row) {
    $stats[$row['setting_key']] = $row['setting_value'];
}

json_response(['ok' => true, 'stats' => $stats]);
