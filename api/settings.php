<?php
require_once __DIR__ . '/_bootstrap.php';
only('GET');
$rows = db()->query('SELECT setting_key, setting_value FROM site_settings')->fetchAll();
$settings = [];
foreach ($rows as $row) {
    $settings[$row['setting_key']] = $row['setting_value'];
}
json_response(['ok' => true, 'settings' => $settings]);
