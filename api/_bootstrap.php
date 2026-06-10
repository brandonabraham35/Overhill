<?php
require_once dirname(__DIR__) . '/includes/functions.php';
header('Content-Type: application/json; charset=utf-8');
function only(string $method): void {
    if (($_SERVER['REQUEST_METHOD'] ?? 'GET') !== $method) {
        json_response(['ok' => false, 'error' => 'Method not allowed.'], 405);
    }
}
