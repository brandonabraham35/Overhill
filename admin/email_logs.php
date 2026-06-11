<?php
require_once dirname(__DIR__) . '/includes/auth.php';
require_once dirname(__DIR__) . '/includes/EmailService.php';
require_login();
$pdo = db();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verify_csrf($_POST['csrf_token'] ?? '')) {
        $_SESSION['flash_err'] = 'Invalid token.';
        header('Location: email_logs.php'); exit;
    }

    $id = (int)($_POST['id'] ?? 0);
    if (($_POST['_action'] ?? '') === 'resend') {
        $log = $pdo->prepare("SELECT * FROM email_logs WHERE id = ?");
        $log->execute([$id]);
        $email = $log->fetch();

        if ($email) {
            if (EmailService::sendEmail($email['recipient'], $email['subject'], $email['body'])) {
                $_SESSION['flash'] = 'Email resent successfully.';
            } else {
                $_SESSION['flash_err'] = 'Failed to resend email.';
            }
        }
    }
    header('Location: email_logs.php'); exit;
}

$perPage = 20;
$page = max(1, (int)($_GET['page'] ?? 1));
$status = clean($_GET['status'] ?? '');

$where = '';
$params = [];
if ($status === 'sent' || $status === 'failed') {
    $where = "WHERE status = ?";
    $params[] = $status;
}

$cnt = $pdo->prepare("SELECT COUNT(*) FROM email_logs $where");
$cnt->execute($params);
$total = (int)$cnt->fetchColumn();
$pg = paginate($total, $page, $perPage);

$stmt = $pdo->prepare("SELECT * FROM email_logs $where ORDER BY sent_at DESC LIMIT {$pg['perPage']} OFFSET {$pg['offset']}");
$stmt->execute($params);
$rows = $stmt->fetchAll();

$flash = $_SESSION['flash'] ?? '';
$flashErr = $_SESSION['flash_err'] ?? '';
unset($_SESSION['flash'], $_SESSION['flash_err']);

$pageTitle = 'Email Logs';
include __DIR__ . '/includes/header.php';
?>

<?php if ($flash): ?><div class="flash ok"><?= e($flash) ?></div><?php endif; ?>
<?php if ($flashErr): ?><div class="flash err"><?= e($flashErr) ?></div><?php endif; ?>

<div class="content-head">
    <form class="filter-form" method="get">
        <select name="status" onchange="this.form.submit()">
            <option value="">All Statuses</option>
            <option value="sent" <?= $status === 'sent' ? 'selected' : '' ?>>Sent</option>
            <option value="failed" <?= $status === 'failed' ? 'selected' : '' ?>>Failed</option>
        </select>
    </form>
</div>

<table class="data-table">
    <thead>
        <tr>
            <th>Recipient</th>
            <th>Subject</th>
            <th>Status</th>
            <th>Sent At</th>
            <th>Error</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!$rows): ?>
            <tr><td colspan="6" class="empty">No email logs found.</td></tr>
        <?php endif; ?>
        <?php foreach ($rows as $r): ?>
            <tr>
                <td><?= e($r['recipient']) ?></td>
                <td><?= e($r['subject']) ?></td>
                <td><span class="badge b-<?= e($r['status']) ?>"><?= e(ucfirst($r['status'])) ?></span></td>
                <td><?= e(date('d M Y H:i', strtotime($r['sent_at']))) ?></td>
                <td><small><?= e($r['error_message'] ?: 'None') ?></small></td>
                <td class="row-actions">
                    <form method="post" class="inline-form">
                        <?= csrf_field() ?>
                        <input type="hidden" name="_action" value="resend">
                        <input type="hidden" name="id" value="<?= (int)$r['id'] ?>">
                        <button type="submit" class="btn-small">Resend</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php if ($pg['pages'] > 1): ?>
    <div class="pagination">
        <?php for ($i = 1; $i <= $pg['pages']; $i++): ?>
            <a class="<?= $i === $pg['page'] ? 'active' : '' ?>" href="?page=<?= $i ?><?= $status ? '&status=' . urlencode($status) : '' ?>"><?= $i ?></a>
        <?php endfor; ?>
    </div>
<?php endif; ?>

<?php include __DIR__ . '/includes/footer.php'; ?>
