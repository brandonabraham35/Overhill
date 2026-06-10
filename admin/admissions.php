<?php
require_once dirname(__DIR__) . '/includes/auth.php';
require_login();
$pdo = db();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verify_csrf($_POST['csrf_token'] ?? '')) { $_SESSION['flash_err']='Invalid token.'; header('Location: admissions.php'); exit; }
    $id = (int)($_POST['id'] ?? 0);
    if (($_POST['_action'] ?? '') === 'delete') {
        $row = crud_find2('admissions',$id);
        if ($row && $row['document']) delete_upload($row['document']);
        $pdo->prepare('DELETE FROM admissions WHERE id=?')->execute([$id]);
        $_SESSION['flash']='Application deleted.';
    } elseif (($_POST['_action'] ?? '') === 'status') {
        $status = $_POST['status'] ?? 'pending';
        if (in_array($status,['pending','reviewing','accepted','rejected'],true)) {
            $pdo->prepare('UPDATE admissions SET status=? WHERE id=?')->execute([$status,$id]);
            $_SESSION['flash']='Status updated.';
        }
    }
    header('Location: admissions.php'); exit;
}
function crud_find2($t,$id){ $s=db()->prepare("SELECT * FROM `$t` WHERE id=?"); $s->execute([$id]); return $s->fetch()?:null; }
$perPage=10; $page=max(1,(int)($_GET['page']??1));
$q=clean($_GET['q']??''); $where=''; $params=[];
if($q!==''){ $where='WHERE student_name LIKE ? OR parent_name LIKE ? OR desired_class LIKE ?'; $params=["%$q%","%$q%","%$q%"]; }
$cnt=$pdo->prepare("SELECT COUNT(*) FROM admissions $where"); $cnt->execute($params); $total=(int)$cnt->fetchColumn();
$pg=paginate($total,$page,$perPage);
$stmt=$pdo->prepare("SELECT * FROM admissions $where ORDER BY created_at DESC LIMIT {$pg['perPage']} OFFSET {$pg['offset']}");
$stmt->execute($params); $rows=$stmt->fetchAll();
$flash=$_SESSION['flash']??''; $flashErr=$_SESSION['flash_err']??''; unset($_SESSION['flash'],$_SESSION['flash_err']);
$pageTitle='Admissions'; include __DIR__.'/includes/header.php';
?>
<?php if($flash):?><div class="flash ok"><?=e($flash)?></div><?php endif;?>
<?php if($flashErr):?><div class="flash err"><?=e($flashErr)?></div><?php endif;?>
<form class="search-form" method="get" style="margin-bottom:16px">
  <input type="text" name="q" value="<?=e($q)?>" placeholder="Search applications..."><button>Search</button>
</form>
<table class="data-table">
  <thead><tr><th>Student</th><th>DOB</th><th>Gender</th><th>Parent</th><th>Contact</th><th>Class</th><th>Doc</th><th>Status</th><th>Actions</th></tr></thead>
  <tbody>
  <?php if(!$rows):?><tr><td colspan="9" class="empty">No applications.</td></tr><?php endif;?>
  <?php foreach($rows as $r):?>
    <tr>
      <td><?=e($r['student_name'])?></td>
      <td><?=e($r['date_of_birth'])?></td>
      <td><?=e($r['gender'])?></td>
      <td><?=e($r['parent_name'])?></td>
      <td><?=e($r['parent_contact'])?><?php if($r['parent_email']):?><br><small><?=e($r['parent_email'])?></small><?php endif;?></td>
      <td><?=e($r['desired_class'])?></td>
      <td><?php if($r['document']):?><a href="../<?=e(ltrim($r['document'],'/'))?>" target="_blank">view</a><?php else:?>—<?php endif;?></td>
      <td>
        <form method="post" class="inline-status">
          <?=csrf_field()?><input type="hidden" name="_action" value="status"><input type="hidden" name="id" value="<?=(int)$r['id']?>">
          <select name="status" onchange="this.form.submit()">
            <?php foreach(['pending','reviewing','accepted','rejected'] as $s):?>
              <option value="<?=$s?>"<?=$r['status']===$s?' selected':''?>><?=ucfirst($s)?></option>
            <?php endforeach;?>
          </select>
        </form>
      </td>
      <td class="row-actions">
        <form method="post" onsubmit="return confirm('Delete this application?');">
          <?=csrf_field()?><input type="hidden" name="_action" value="delete"><input type="hidden" name="id" value="<?=(int)$r['id']?>">
          <button class="link-danger">Delete</button>
        </form>
      </td>
    </tr>
  <?php endforeach;?>
  </tbody>
</table>
<?php if($pg['pages']>1):?><div class="pagination"><?php for($i=1;$i<=$pg['pages'];$i++):?><a class="<?=$i===$pg['page']?'active':''?>" href="?page=<?=$i?><?=$q?'&q='.urlencode($q):''?>"><?=$i?></a><?php endfor;?></div><?php endif;?>
<?php include __DIR__.'/includes/footer.php'; ?>
