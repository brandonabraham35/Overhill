<?php
require_once __DIR__ . '/_bootstrap.php';
only('GET');
$rows = db()->query('SELECT * FROM events ORDER BY event_date ASC')->fetchAll();
json_response(['ok' => true, 'items' => $rows]);
