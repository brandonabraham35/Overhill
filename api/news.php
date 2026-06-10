<?php
require_once __DIR__ . '/_bootstrap.php';
only('GET');
$pdo = db();
if (!empty($_GET['slug'])) {
    $stmt = $pdo->prepare('SELECT * FROM news WHERE slug = ? AND is_published = 1 LIMIT 1');
    $stmt->execute([clean($_GET['slug'])]);
    $row = $stmt->fetch();
    if (!$row) json_response(['ok' => false, 'error' => 'Article not found.'], 404);
    json_response(['ok' => true, 'article' => $row]);
}
$search = clean($_GET['search'] ?? '');
$page = max(1, (int)($_GET['page'] ?? 1));
$perPage = 6;
if ($search !== '') {
    $like = '%' . $search . '%';
    $cnt = $pdo->prepare('SELECT COUNT(*) FROM news WHERE is_published=1 AND (title LIKE ? OR excerpt LIKE ? OR body LIKE ?)');
    $cnt->execute([$like,$like,$like]); $total = (int)$cnt->fetchColumn();
    $pg = paginate($total, $page, $perPage);
    $stmt = $pdo->prepare('SELECT id,title,slug,excerpt,image,published_at FROM news WHERE is_published=1 AND (title LIKE ? OR excerpt LIKE ? OR body LIKE ?) ORDER BY published_at DESC, id DESC LIMIT ? OFFSET ?');
    $stmt->bindValue(1,$like); $stmt->bindValue(2,$like); $stmt->bindValue(3,$like);
    $stmt->bindValue(4,$pg['perPage'],PDO::PARAM_INT); $stmt->bindValue(5,$pg['offset'],PDO::PARAM_INT);
    $stmt->execute();
} else {
    $total = (int)$pdo->query('SELECT COUNT(*) FROM news WHERE is_published=1')->fetchColumn();
    $pg = paginate($total, $page, $perPage);
    $stmt = $pdo->prepare('SELECT id,title,slug,excerpt,image,published_at FROM news WHERE is_published=1 ORDER BY published_at DESC, id DESC LIMIT ? OFFSET ?');
    $stmt->bindValue(1,$pg['perPage'],PDO::PARAM_INT); $stmt->bindValue(2,$pg['offset'],PDO::PARAM_INT);
    $stmt->execute();
}
json_response(['ok' => true, 'items' => $stmt->fetchAll(), 'pagination' => $pg]);
