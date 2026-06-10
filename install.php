<?php
/**
 * One-time installer.
 *  1. Creates all database tables from config/schema.sql
 *  2. Lets you create the single administrator account (no hardcoded credentials)
 * Delete this file after installation is complete.
 */
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/auth.php';

$messages = [];
$error = '';
$done = false;

// Step 1: build schema
if (isset($_POST['create_schema'])) {
    try {
        $pdo = new PDO('mysql:host=' . DB_HOST . ';charset=' . DB_CHARSET, DB_USER, DB_PASS,
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
        $sql = file_get_contents(__DIR__ . '/config/schema.sql');
        $pdo->exec($sql);
        $messages[] = 'Database & tables created successfully.';
    } catch (Throwable $e) {
        $error = 'Schema error: ' . $e->getMessage();
    }
}

// Step 2: create admin
if (isset($_POST['create_admin'])) {
    $u = clean($_POST['username'] ?? '');
    $n = clean($_POST['full_name'] ?? '');
    $p = $_POST['password'] ?? '';
    $c = $_POST['confirm'] ?? '';
    if (strlen($u) < 3 || strlen($n) < 2) {
        $error = 'Username (min 3) and full name are required.';
    } elseif (strlen($p) < 8) {
        $error = 'Password must be at least 8 characters.';
    } elseif ($p !== $c) {
        $error = 'Passwords do not match.';
    } elseif (admin_exists()) {
        $error = 'An administrator already exists. Delete it from the DB to recreate.';
    } else {
        $hash = password_hash($p, PASSWORD_DEFAULT);
        db()->prepare('INSERT INTO admins (username, full_name, password_hash) VALUES (?,?,?)')
            ->execute([$u, $n, $hash]);
        $done = true;
        $messages[] = 'Administrator created. You can now log in.';
    }
}
?>
<!doctype html>
<html lang="en"><head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title>Install · Overhill Junior School</title>
<link rel="stylesheet" href="css/style.css"><link rel="stylesheet" href="css/admin.css">
<style>body{background:#0f2a4a;padding:40px 16px}.install{max-width:520px;margin:auto;background:#fff;border-radius:12px;padding:28px}.install h1{margin-top:0}.install .field{margin-bottom:14px}.install label{display:block;font-weight:600;margin-bottom:4px}.install input{width:100%;padding:10px;border:1px solid #ccc;border-radius:8px}.msg{background:#e6f7ec;color:#0a6b34;padding:10px;border-radius:8px;margin-bottom:10px}.err{background:#fdecea;color:#b3261e;padding:10px;border-radius:8px;margin-bottom:10px}.btn{background:#0f2a4a;color:#fff;border:0;padding:11px 18px;border-radius:8px;cursor:pointer;font-weight:600}</style>
</head><body>
<div class="install">
  <h1>Overhill Junior School — Installer</h1>
  <?php foreach ($messages as $m): ?><div class="msg"><?= e($m) ?></div><?php endforeach; ?>
  <?php if ($error): ?><div class="err"><?= e($error) ?></div><?php endif; ?>

  <h2>Step 1 — Create database tables</h2>
  <form method="post"><input type="hidden" name="create_schema" value="1">
    <button class="btn" type="submit">Run schema.sql</button>
  </form>

  <h2 style="margin-top:24px">Step 2 — Create administrator</h2>
  <?php if ($done): ?>
    <div class="msg">Setup complete. <a href="admin/login.php">Go to admin login →</a><br>
    <strong>Important:</strong> delete <code>install.php</code> now.</div>
  <?php else: ?>
  <form method="post">
    <input type="hidden" name="create_admin" value="1">
    <div class="field"><label>Full name</label><input name="full_name" required></div>
    <div class="field"><label>Username</label><input name="username" required></div>
    <div class="field"><label>Password (min 8)</label><input type="password" name="password" required></div>
    <div class="field"><label>Confirm password</label><input type="password" name="confirm" required></div>
    <button class="btn" type="submit">Create administrator</button>
  </form>
  <?php endif; ?>
</div>
</body></html>
