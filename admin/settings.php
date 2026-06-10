<?php
require_once dirname(__DIR__) . '/includes/auth.php';
require_login();
$pdo = db();
$keys = ['school_name'=>'School Name','phone'=>'Phone','email'=>'Email','address'=>'Address','motto'=>'Motto'];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verify_csrf($_POST['csrf_token'] ?? '')) { header('Location: settings.php'); exit; }
    if (($_POST['_action']??'')==='settings') {
        foreach ($keys as $k=>$lbl) {
            $v = clean($_POST[$k] ?? '');
            $pdo->prepare('INSERT INTO site_settings (setting_key,setting_value) VALUES (?,?) ON DUPLICATE KEY UPDATE setting_value=?')->execute([$k,$v,$v]);
        }
        $_SESSION['flash']='Settings saved.';
    } elseif (($_POST['_action']??'')==='password') {
        $cur=$_POST['current']??''; $new=$_POST['new']??''; $conf=$_POST['confirm']??'';
        $adm=current_admin();
        $row=crud_findadmin($adm['id']);
        if (!password_verify($cur,$row['password_hash'])) $_SESSION['flash_err']='Current password incorrect.';
        elseif (strlen($new)<8) $_SESSION['flash_err']='New password too short (min 8).';
        elseif ($new!==$conf) $_SESSION['flash_err']='Passwords do not match.';
        else { $pdo->prepare('UPDATE admins SET password_hash=? WHERE id=?')->execute([password_hash($new,PASSWORD_DEFAULT),$adm['id']]); $_SESSION['flash']='Password updated.'; }
    }
    header('Location: settings.php'); exit;
}
function crud_findadmin($id){ $s=db()->prepare('SELECT * FROM admins WHERE id=?'); $s->execute([$id]); return $s->fetch(); }
$settings=[]; foreach($pdo->query('SELECT setting_key,setting_value FROM site_settings') as $r){ $settings[$r['setting_key']]=$r['setting_value']; }
$flash=$_SESSION['flash']??''; $flashErr=$_SESSION['flash_err']??''; unset($_SESSION['flash'],$_SESSION['flash_err']);
$pageTitle='Settings'; include __DIR__.'/includes/header.php';
?>
<?php if($flash):?><div class="flash ok"><?=e($flash)?></div><?php endif;?>
<?php if($flashErr):?><div class="flash err"><?=e($flashErr)?></div><?php endif;?>
<form class="resource-form" method="post">
  <?=csrf_field()?><input type="hidden" name="_action" value="settings">
  <h3>Site Settings</h3>
  <?php foreach($keys as $k=>$lbl):?>
    <div class="form-field"><label><?=e($lbl)?></label><input type="text" name="<?=$k?>" value="<?=e($settings[$k]??'')?>"></div>
  <?php endforeach;?>
  <button class="btn-primary">Save Settings</button>
</form>
<form class="resource-form" method="post">
  <?=csrf_field()?><input type="hidden" name="_action" value="password">
  <h3>Change Password</h3>
  <div class="form-field"><label>Current Password</label><input type="password" name="current" required></div>
  <div class="form-field"><label>New Password</label><input type="password" name="new" required></div>
  <div class="form-field"><label>Confirm New Password</label><input type="password" name="confirm" required></div>
  <button class="btn-primary">Update Password</button>
</form>
<?php include __DIR__.'/includes/footer.php'; ?>
