<?php
/**
 * Lightweight CRUD engine for simple admin resources.
 * $cfg = [
 *   'table' => 'news', 'title' => 'News', 'singular' => 'Article',
 *   'order' => 'created_at DESC',
 *   'search' => ['title','body'],
 *   'fields' => [ ['name'=>'title','label'=>'Title','type'=>'text','required'=>true,'list'=>true], ... ],
 * ]
 * Field types: text, textarea, number, date, time, select(options), checkbox, image, document, slug(from)
 */
require_once dirname(__DIR__, 2) . '/includes/auth.php';

function slugify(string $s): string {
    $s = strtolower(trim($s));
    $s = preg_replace('/[^a-z0-9]+/', '-', $s);
    return trim($s, '-') . '-' . substr(bin2hex(random_bytes(2)), 0, 4);
}

function crud_handle(array $cfg): void
{
    require_login();
    $pdo = db();
    $table = $cfg['table'];
    $fields = $cfg['fields'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (!verify_csrf($_POST['csrf_token'] ?? '')) {
            $_SESSION['flash_err'] = 'Invalid session token.';
            header('Location: ' . basename($_SERVER['PHP_SELF'])); exit;
        }
        $action = $_POST['_action'] ?? '';
        if ($action === 'delete') {
            $id = (int)($_POST['id'] ?? 0);
            // delete attached files
            $row = crud_find($table, $id);
            if ($row) {
                foreach ($fields as $f) {
                    if (in_array($f['type'], ['image','document'], true) && !empty($row[$f['name']])) {
                        delete_upload($row[$f['name']]);
                    }
                }
                $pdo->prepare("DELETE FROM `$table` WHERE id = ?")->execute([$id]);
                $_SESSION['flash'] = $cfg['singular'] . ' deleted.';
            }
            header('Location: ' . basename($_SERVER['PHP_SELF'])); exit;
        }

        // create / update
        $cols = []; $vals = []; $errors = [];
        $existing = null;
        $id = (int)($_POST['id'] ?? 0);
        if ($action === 'update' && $id) $existing = crud_find($table, $id);

        foreach ($fields as $f) {
            $n = $f['name']; $type = $f['type'];
            if ($type === 'slug') {
                $src = clean($_POST[$f['from']] ?? '');
                if ($existing && !empty($existing[$n])) { $val = $existing[$n]; }
                else { $val = slugify($src ?: 'item'); }
                $cols[$n] = $val; continue;
            }
            if ($type === 'image' || $type === 'document') {
                if (!empty($_FILES[$n]['name'])) {
                    $up = handle_upload($_FILES[$n], $type === 'image' ? 'image' : 'document');
                    if (!$up['ok']) { $errors[] = $up['error']; continue; }
                    if ($existing && !empty($existing[$n])) delete_upload($existing[$n]);
                    $cols[$n] = $up['path'];
                    if ($type === 'document' && in_array('file_size', array_column($fields,'name'), true) === false) {}
                } elseif ($existing) {
                    $cols[$n] = $existing[$n];
                } else {
                    $cols[$n] = null;
                }
                if (!empty($f['required']) && empty($cols[$n])) $errors[] = $f['label'] . ' is required.';
                continue;
            }
            if ($type === 'checkbox') { $cols[$n] = isset($_POST[$n]) ? 1 : 0; continue; }
            $val = clean($_POST[$n] ?? '');
            if (!empty($f['required']) && $val === '') $errors[] = $f['label'] . ' is required.';
            if ($type === 'number') $val = $val === '' ? null : (int)$val;
            $cols[$n] = $val === '' ? null : $val;
        }

        if ($errors) {
            $_SESSION['flash_err'] = implode(' ', $errors);
            header('Location: ' . basename($_SERVER['PHP_SELF']) . ($id ? '?edit=' . $id : '?new=1')); exit;
        }

        if ($action === 'update' && $id) {
            $set = implode(', ', array_map(fn($c) => "`$c` = ?", array_keys($cols)));
            $params = array_values($cols); $params[] = $id;
            $pdo->prepare("UPDATE `$table` SET $set WHERE id = ?")->execute($params);
            $_SESSION['flash'] = $cfg['singular'] . ' updated.';
        } else {
            $colNames = implode(', ', array_map(fn($c) => "`$c`", array_keys($cols)));
            $ph = implode(', ', array_fill(0, count($cols), '?'));
            $pdo->prepare("INSERT INTO `$table` ($colNames) VALUES ($ph)")->execute(array_values($cols));
            $_SESSION['flash'] = $cfg['singular'] . ' created.';
        }
        header('Location: ' . basename($_SERVER['PHP_SELF'])); exit;
    }
}

function crud_find(string $table, int $id): ?array
{
    $stmt = db()->prepare("SELECT * FROM `$table` WHERE id = ? LIMIT 1");
    $stmt->execute([$id]);
    return $stmt->fetch() ?: null;
}

function crud_render(array $cfg): void
{
    $pdo = db();
    $table = $cfg['table'];
    $fields = $cfg['fields'];
    $perPage = 10;
    $page = max(1, (int)($_GET['page'] ?? 1));
    $search = clean($_GET['q'] ?? '');

    $where = ''; $params = [];
    if ($search !== '' && !empty($cfg['search'])) {
        $parts = [];
        foreach ($cfg['search'] as $col) { $parts[] = "`$col` LIKE ?"; $params[] = '%' . $search . '%'; }
        $where = 'WHERE ' . implode(' OR ', $parts);
    }
    $total = (int)(function() use ($pdo,$table,$where,$params){
        $s = $pdo->prepare("SELECT COUNT(*) FROM `$table` $where"); $s->execute($params); return $s->fetchColumn();
    })();
    $pg = paginate($total, $page, $perPage);
    $order = $cfg['order'] ?? 'id DESC';
    $sql = "SELECT * FROM `$table` $where ORDER BY $order LIMIT {$pg['perPage']} OFFSET {$pg['offset']}";
    $stmt = $pdo->prepare($sql); $stmt->execute($params);
    $rows = $stmt->fetchAll();

    $editRow = null;
    if (!empty($_GET['edit'])) $editRow = crud_find($table, (int)$_GET['edit']);
    $showForm = $editRow || isset($_GET['new']);
    $self = basename($_SERVER['PHP_SELF']);
    $flash = $_SESSION['flash'] ?? ''; $flashErr = $_SESSION['flash_err'] ?? '';
    unset($_SESSION['flash'], $_SESSION['flash_err']);
    ?>
    <?php if ($flash): ?><div class="flash ok"><?= e($flash) ?></div><?php endif; ?>
    <?php if ($flashErr): ?><div class="flash err"><?= e($flashErr) ?></div><?php endif; ?>

    <div class="content-head">
      <form class="search-form" method="get">
        <input type="text" name="q" value="<?= e($search) ?>" placeholder="Search <?= e($cfg['title']) ?>...">
        <button type="submit">Search</button>
      </form>
      <a class="btn-primary" href="?new=1">+ Add <?= e($cfg['singular']) ?></a>
    </div>

    <?php if ($showForm): ?>
    <form class="resource-form" method="post" enctype="multipart/form-data">
      <?= csrf_field() ?>
      <input type="hidden" name="_action" value="<?= $editRow ? 'update' : 'create' ?>">
      <?php if ($editRow): ?><input type="hidden" name="id" value="<?= (int)$editRow['id'] ?>"><?php endif; ?>
      <h3><?= $editRow ? 'Edit' : 'New' ?> <?= e($cfg['singular']) ?></h3>
      <?php foreach ($fields as $f): if ($f['type'] === 'slug') continue; $n=$f['name']; $v=$editRow[$n] ?? ''; ?>
        <div class="form-field">
          <label><?= e($f['label']) ?><?= !empty($f['required']) ? ' *' : '' ?></label>
          <?php if ($f['type']==='textarea'): ?>
            <textarea name="<?= $n ?>" rows="6"<?= !empty($f['required'])?' required':'' ?>><?= e($v) ?></textarea>
          <?php elseif ($f['type']==='select'): ?>
            <select name="<?= $n ?>"<?= !empty($f['required'])?' required':'' ?>>
              <option value="">— select —</option>
              <?php foreach ($f['options'] as $opt): ?>
                <option value="<?= e($opt) ?>"<?= ($v===$opt)?' selected':'' ?>><?= e($opt) ?></option>
              <?php endforeach; ?>
            </select>
          <?php elseif ($f['type']==='checkbox'): ?>
            <input type="checkbox" name="<?= $n ?>" value="1"<?= $v ? ' checked':'' ?>>
          <?php elseif ($f['type']==='image' || $f['type']==='document'): ?>
            <input type="file" name="<?= $n ?>" accept="<?= $f['type']==='image' ? 'image/*' : '.pdf,.docx' ?>">
            <?php if ($v): ?><small class="current-file">Current: <a href="../<?= e(ltrim($v,'/')) ?>" target="_blank"><?= e(basename($v)) ?></a></small><?php endif; ?>
          <?php else: ?>
            <input type="<?= $f['type'] ?>" name="<?= $n ?>" value="<?= e($v) ?>"<?= !empty($f['required'])?' required':'' ?>>
          <?php endif; ?>
        </div>
      <?php endforeach; ?>
      <div class="form-actions">
        <button type="submit" class="btn-primary">Save</button>
        <a class="btn-ghost" href="<?= $self ?>">Cancel</a>
      </div>
    </form>
    <?php endif; ?>

    <table class="data-table">
      <thead><tr>
        <?php foreach ($fields as $f): if (empty($f['list'])) continue; ?><th><?= e($f['label']) ?></th><?php endforeach; ?>
        <th>Actions</th>
      </tr></thead>
      <tbody>
        <?php if (!$rows): ?><tr><td colspan="20" class="empty">No records yet.</td></tr><?php endif; ?>
        <?php foreach ($rows as $r): ?>
        <tr>
          <?php foreach ($fields as $f): if (empty($f['list'])) continue; $val=$r[$f['name']] ?? ''; ?>
            <td>
              <?php if ($f['type']==='image' && $val): ?><img class="thumb" src="../<?= e(ltrim($val,'/')) ?>" alt="">
              <?php elseif ($f['type']==='document' && $val): ?><a href="../<?= e(ltrim($val,'/')) ?>" target="_blank">file</a>
              <?php elseif ($f['type']==='checkbox'): ?><?= $val ? 'Yes' : 'No' ?>
              <?php else: ?><?= e(mb_strimwidth((string)$val, 0, 80, '…')) ?><?php endif; ?>
            </td>
          <?php endforeach; ?>
          <td class="row-actions">
            <a href="?edit=<?= (int)$r['id'] ?>">Edit</a>
            <form method="post" onsubmit="return confirm('Delete this <?= e($cfg['singular']) ?>?');">
              <?= csrf_field() ?>
              <input type="hidden" name="_action" value="delete">
              <input type="hidden" name="id" value="<?= (int)$r['id'] ?>">
              <button type="submit" class="link-danger">Delete</button>
            </form>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>

    <?php if ($pg['pages'] > 1): ?>
    <div class="pagination">
      <?php for ($i=1; $i<=$pg['pages']; $i++): ?>
        <a class="<?= $i===$pg['page']?'active':'' ?>" href="?page=<?= $i ?><?= $search?'&q='.urlencode($search):'' ?>"><?= $i ?></a>
      <?php endfor; ?>
    </div>
    <?php endif;
}
