<?php
require_once dirname(__DIR__) . '/includes/auth.php';
if (is_logged_in()) { header('Location: index.php'); exit; }
$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verify_csrf($_POST['csrf_token'] ?? '')) {
        $error = 'Session expired. Please try again.';
    } elseif (!admin_exists()) {
        $error = 'No administrator account exists. Run install.php first.';
    } else {
        $u = clean($_POST['username'] ?? '');
        $p = $_POST['password'] ?? '';
        if (login_admin($u, $p)) { header('Location: index.php'); exit; }
        $error = 'Invalid username or password.';
    }
}
?>
<!doctype html>
<html lang="en"><head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title>Admin Login · Overhill Junior School</title>
<link rel="icon" href="../images/logo.jpeg">
<link rel="stylesheet" href="../css/admin.css">
</head>
<body class="login-body">
  <form class="login-card" method="post" autocomplete="off">
    <img src="../images/logo.jpeg" alt="Overhill Junior School" class="login-logo">
    <h1>Administrator Login</h1>
    <?php if ($error): ?><p class="login-error"><?= e($error) ?></p><?php endif; ?>
    <?= csrf_field() ?>
    <label>Username</label>
    <input type="text" name="username" required autofocus>
    <label>Password</label>
    <input type="password" name="password" required>
    <button type="submit">Sign In</button>
    <a class="back-site" href="../index.php">&larr; Back to website</a>
  </form>
</body></html>
