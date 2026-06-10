<?php
require_once __DIR__ . '/_bootstrap.php';
only('GET');
$scope = $_GET['scope'] ?? 'upcoming';
$pdo = db();
if ($scope === 'all') {
    $stmt = $pdo->query('SELECT * FROM events ORDER BY event_date DESC');
} else {
    $stmt = $pdo->prepare('SELECT * FROM events WHERE event_date >= CURDATE() ORDER BY event_date ASC');
    $stmt->execute();
}
json_response(['ok' => true, 'items' => $stmt->fetchAll()]);
