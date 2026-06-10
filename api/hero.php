<?php
require_once __DIR__ . '/_bootstrap.php';
only('GET');
$rows = db()->query('SELECT * FROM hero_slides WHERE is_active=1 ORDER BY sort_order ASC, id ASC')->fetchAll();
json_response(['ok' => true, 'items' => $rows]);
