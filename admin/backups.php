<?php
require_once dirname(__DIR__) . '/includes/auth.php';
require_login();
$pdo = db();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verify_csrf($_POST['csrf_token'] ?? '')) {
        $_SESSION['flash_err'] = 'Invalid token.';
        header('Location: backups.php'); exit;
    }

    $action = $_POST['_action'] ?? '';
    $backupDir = __DIR__ . '/backups/';

    if ($action === 'db_backup') {
        try {
            $tables = [];
            $result = $pdo->query("SHOW TABLES");
            while ($row = $result->fetch(PDO::FETCH_NUM)) {
                $tables[] = $row[0];
            }

            $return = "-- Overhill Junior School DB Backup\n";
            $return .= "-- Generated: " . date('Y-m-d H:i:s') . "\n\n";
            $return .= "SET FOREIGN_KEY_CHECKS=0;\n\n";

            foreach ($tables as $table) {
                $return .= "DROP TABLE IF EXISTS `$table`;\n";
                $createTable = $pdo->query("SHOW CREATE TABLE `$table`")->fetch(PDO::FETCH_NUM);
                $return .= $createTable[1] . ";\n\n";

                $rows = $pdo->query("SELECT * FROM `$table`");
                while ($row = $rows->fetch(PDO::FETCH_ASSOC)) {
                    $return .= "INSERT INTO `$table` VALUES(";
                    $first = true;
                    foreach ($row as $val) {
                        if (!$first) $return .= ",";
                        if ($val === null) $return .= "NULL";
                        else $return .= $pdo->quote($val);
                        $first = false;
                    }
                    $return .= ");\n";
                }
                $return .= "\n";
            }
            $return .= "SET FOREIGN_KEY_CHECKS=1;\n";

            $filename = 'db-backup-' . time() . '.sql';
            file_put_contents($backupDir . $filename, $return);
            $_SESSION['flash'] = 'Database backup created: ' . $filename;
        } catch (Exception $e) {
            $_SESSION['flash_err'] = 'Backup failed: ' . $e->getMessage();
        }

    } elseif ($action === 'file_backup') {
        if (!class_exists('ZipArchive')) {
            $_SESSION['flash_err'] = 'ZipArchive extension not enabled on this server.';
        } else {
            $filename = 'file-backup-' . time() . '.zip';
            $zip = new ZipArchive();
            if ($zip->open($backupDir . $filename, ZipArchive::CREATE) === TRUE) {
                $rootPath = realpath(BASE_PATH);
                $files = new RecursiveIteratorIterator(
                    new RecursiveDirectoryIterator($rootPath),
                    RecursiveIteratorIterator::LEAVES_ONLY
                );

                foreach ($files as $name => $file) {
                    if (!$file->isDir()) {
                        $filePath = $file->getRealPath();
                        $relativePath = substr($filePath, strlen($rootPath) + 1);

                        // Exclusions
                        if (strpos($relativePath, 'admin/backups') === 0 ||
                            strpos($relativePath, 'vendor') === 0 ||
                            strpos($relativePath, '.git') === 0 ||
                            strpos($relativePath, 'php_server.log') === 0) {
                            continue;
                        }

                        $zip->addFile($filePath, $relativePath);
                    }
                }
                $zip->close();
                $_SESSION['flash'] = 'File backup created: ' . $filename;
            } else {
                $_SESSION['flash_err'] = 'Failed to create zip backup.';
            }
        }
    } elseif ($action === 'delete') {
        $file = $_POST['file'] ?? '';
        if ($file && file_exists($backupDir . $file) && strpos($file, '..') === false) {
            unlink($backupDir . $file);
            $_SESSION['flash'] = 'Backup deleted.';
        }
    }

    header('Location: backups.php'); exit;
}

if (isset($_GET['download'])) {
    $file = $_GET['download'];
    $path = __DIR__ . '/backups/' . $file;
    if (file_exists($path) && strpos($file, '..') === false) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($path) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($path));
        readfile($path);
        exit;
    }
}

$backups = array_diff(scandir(__DIR__ . '/backups/'), ['.', '..', '.htaccess']);
rsort($backups);

$flash = $_SESSION['flash'] ?? '';
$flashErr = $_SESSION['flash_err'] ?? '';
unset($_SESSION['flash'], $_SESSION['flash_err']);

$pageTitle = 'Backups';
include __DIR__ . '/includes/header.php';
?>

<?php if ($flash): ?><div class="flash ok"><?= e($flash) ?></div><?php endif; ?>
<?php if ($flashErr): ?><div class="flash err"><?= e($flashErr) ?></div><?php endif; ?>

<div class="panel">
    <div class="content-head">
        <div>
            <form method="post" style="display:inline">
                <?= csrf_field() ?>
                <input type="hidden" name="_action" value="db_backup">
                <button type="submit" class="btn-primary">Backup Database</button>
            </form>
            <form method="post" style="display:inline; margin-left: 10px;">
                <?= csrf_field() ?>
                <input type="hidden" name="_action" value="file_backup">
                <button type="submit" class="btn-primary">Backup Files</button>
            </form>
        </div>
    </div>

    <table class="data-table">
        <thead>
            <tr>
                <th>Filename</th>
                <th>Size</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!$backups): ?>
                <tr><td colspan="4" class="empty">No backups found.</td></tr>
            <?php endif; ?>
            <?php foreach ($backups as $b):
                $path = __DIR__ . '/backups/' . $b;
                $size = round(filesize($path) / 1024 / 1024, 2) . ' MB';
                $date = date('d M Y H:i', filemtime($path));
            ?>
                <tr>
                    <td><?= e($b) ?></td>
                    <td><?= $size ?></td>
                    <td><?= $date ?></td>
                    <td class="row-actions">
                        <a href="?download=<?= urlencode($b) ?>" class="btn-small">Download</a>
                        <form method="post" class="inline-form" onsubmit="return confirm('Delete this backup?');">
                            <?= csrf_field() ?>
                            <input type="hidden" name="_action" value="delete">
                            <input type="hidden" name="file" value="<?= e($b) ?>">
                            <button type="submit" class="link-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php include __DIR__ . '/includes/footer.php'; ?>
