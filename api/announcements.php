<?php
require_once __DIR__ . '/_bootstrap.php';
only('GET');
$rows = db()->query('SELECT * FROM announcements WHERE is_active = 1 ORDER BY created_at DESC')->fetchAll();
json_response(['ok' => true, 'items' => $rows]);
