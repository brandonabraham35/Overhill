<?php
require_once dirname(__DIR__, 2) . '/includes/auth.php';
require_login();
$admin = current_admin();
$current = basename($_SERVER['PHP_SELF']);
function nav_active(string $f): string { return basename($_SERVER['PHP_SELF']) === $f ? 'active' : ''; }
?>
<!doctype html>
<html lang="en"><head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= isset($pageTitle) ? e($pageTitle) . ' · ' : '' ?>Admin · Overhill Junior School</title>
<link rel="icon" href="../images/logo.png">
<link rel="stylesheet" href="../css/admin.css">
</head>
<body class="admin-body">
<div class="admin-shell">
  <aside class="admin-sidebar" id="adminSidebar">
    <div class="sidebar-brand">
      <img src="../images/logo.png" alt="Logo"><span>Overhill Admin</span>
    </div>
    <nav class="sidebar-nav">
      <a class="<?= nav_active('index.php') ?>" href="index.php">Dashboard</a>
      <a class="<?= nav_active('news.php') ?>" href="news.php">News</a>
      <a class="<?= nav_active('events.php') ?>" href="events.php">Events</a>
      <a class="<?= nav_active('admissions.php') ?>" href="admissions.php">Admissions</a>
      <a class="<?= nav_active('gallery.php') ?>" href="gallery.php">Gallery</a>
      <a class="<?= nav_active('downloads.php') ?>" href="downloads.php">Downloads</a>
      <a class="<?= nav_active('staff.php') ?>" href="staff.php">Staff</a>
      <a class="<?= nav_active('leadership.php') ?>" href="leadership.php">Leadership</a>
      <a class="<?= nav_active('faqs.php') ?>" href="faqs.php">FAQs</a>
      <a class="<?= nav_active('messages.php') ?>" href="messages.php">Messages</a>
      <a class="<?= nav_active('hero.php') ?>" href="hero.php">Hero Slides</a>
      <a class="<?= nav_active('announcements.php') ?>" href="announcements.php">Announcements</a>
      <a class="<?= nav_active('settings.php') ?>" href="settings.php">Settings</a>
    </nav>
  </aside>
  <div class="admin-main">
    <header class="admin-topbar">
      <button class="sb-toggle" onclick="document.getElementById('adminSidebar').classList.toggle('open')">&#9776;</button>
      <h1><?= e($pageTitle ?? 'Dashboard') ?></h1>
      <div class="topbar-right">
        <span>Hi, <?= e($admin['name']) ?></span>
        <a class="logout-btn" href="logout.php">Logout</a>
      </div>
    </header>
    <main class="admin-content">
