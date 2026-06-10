<?php
require_once __DIR__ . '/_bootstrap.php';
only('GET');
$pdo = db();
if (!empty($_GET['album'])) {
    $stmt = $pdo->prepare('SELECT * FROM gallery_albums WHERE slug = ? LIMIT 1');
    $stmt->execute([clean($_GET['album'])]);
    $album = $stmt->fetch();
    if (!$album) json_response(['ok' => false, 'error' => 'Album not found.'], 404);
    $imgs = $pdo->prepare('SELECT * FROM gallery_images WHERE album_id = ? ORDER BY id DESC');
    $imgs->execute([$album['id']]);
    json_response(['ok' => true, 'album' => $album, 'images' => $imgs->fetchAll()]);
}
$rows = $pdo->query('SELECT a.*, (SELECT COUNT(*) FROM gallery_images gi WHERE gi.album_id=a.id) AS image_count FROM gallery_albums a ORDER BY a.created_at DESC')->fetchAll();
json_response(['ok' => true, 'items' => $rows]);
