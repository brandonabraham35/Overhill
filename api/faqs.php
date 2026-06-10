<?php
require_once __DIR__ . '/_bootstrap.php';
only('GET');
$rows = db()->query('SELECT * FROM faqs ORDER BY sort_order ASC, id ASC')->fetchAll();
json_response(['ok' => true, 'items' => $rows]);
