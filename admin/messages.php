<?php
require_once dirname(__DIR__) . '/includes/auth.php';
require_login();
$pdo = db();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verify_csrf($_POST['csrf_token'] ?? '')) { header('Location: messages.php'); exit; }
    $id=(int)($_POST['id']??0); $act=$_POST['_action']??'';
    if ($act==='delete'){ $pdo->prepare('DELETE FROM contact_messages WHERE id=?')->execute([$id]); $_SESSION['flash']='Message deleted.'; }
    elseif ($act==='read'){ $pdo->prepare('UPDATE contact_messages SET is_read=1 WHERE id=?')->execute([$id]); }
    header('Location: messages.php'); exit;
}
$perPage=10; $page=max(1,(int)($_GET['page']??1));
$q=clean($_GET['q']??''); $where=''; $params=[];
if($q!==''){ $where='WHERE name LIKE ? OR email LIKE ? OR subject LIKE ?'; $params=["%$q%","%$q%","%$q%"]; }
$cnt=$pdo->prepare("SELECT COUNT(*) FROM contact_messages $where"); $cnt->execute($params); $total=(int)$cnt->fetchColumn();
$pg=paginate($total,$page,$perPage);
$stmt=$pdo->prepare("SELECT * FROM contact_messages $where ORDER BY created_at DESC LIMIT {$pg['perPage']} OFFSET {$pg['offset']}");
$stmt->execute($params); $rows=$stmt->fetchAll();
$flash=$_SESSION['flash']??''; unset($_SESSION['flash']);
$pageTitle='Messages'; include __DIR__.'/includes/header.php';
?>
<?php if($flash):?><div class="flash ok"><?=e($flash)?></div><?php endif;?>
<form class="search-form" method="get" style="margin-bottom:16px">
  <input type="text" name="q" value="<?=e($q)?>" placeholder="Search messages..."><button>Search</button>
</form>
<table class="data-table">
  <thead><tr><th>Name</th><th>Email</th><th>Phone</th><th>Subject</th><th>Message</th><th>Date</th><th>Actions</th></tr></thead>
  <tbody>
  <?php if(!$rows):?><tr><td colspan="7" class="empty">No messages.</td></tr><?php endif;?>
  <?php foreach($rows as $r):?>
    <tr class="<?=$r['is_read']?'':'unread'?>">
      <td><?=e($r['name'])?></td><td><?=e($r['email'])?></td><td><?=e($r['phone'])?></td>
      <td><?=e($r['subject'])?></td><td><?=e(mb_strimwidth($r['message'],0,120,'…'))?></td>
      <td><?=e(date('d M Y H:i',strtotime($r['created_at'])))?></td>
      <td class="row-actions">
        <form method="post" onsubmit="return confirm('Delete this message?');">
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
