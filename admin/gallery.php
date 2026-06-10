<?php
require_once dirname(__DIR__) . '/includes/auth.php';
require_login();
$pdo = db();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verify_csrf($_POST['csrf_token'] ?? '')) { header('Location: gallery.php'); exit; }
    $act = $_POST['_action'] ?? '';
    if ($act === 'create_album') {
        $title = clean($_POST['title'] ?? ''); $desc = clean($_POST['description'] ?? '');
        if ($title==='') { $_SESSION['flash_err']='Album title required.'; }
        else {
            $slug = strtolower(preg_replace('/[^a-z0-9]+/i','-',$title)).'-'.substr(bin2hex(random_bytes(2)),0,4);
            $cover=null;
            if (!empty($_FILES['cover_image']['name'])) { $up=handle_upload($_FILES['cover_image'],'image'); if($up['ok']) $cover=$up['path']; }
            $pdo->prepare('INSERT INTO gallery_albums (title,slug,description,cover_image) VALUES (?,?,?,?)')->execute([$title,$slug,$desc,$cover]);
            $_SESSION['flash']='Album created.';
        }
    } elseif ($act === 'delete_album') {
        $id=(int)$_POST['id'];
        $imgs=$pdo->prepare('SELECT image FROM gallery_images WHERE album_id=?'); $imgs->execute([$id]);
        foreach($imgs as $im) delete_upload($im['image']);
        $a=$pdo->prepare('SELECT cover_image FROM gallery_albums WHERE id=?'); $a->execute([$id]); $r=$a->fetch();
        if($r) delete_upload($r['cover_image']);
        $pdo->prepare('DELETE FROM gallery_albums WHERE id=?')->execute([$id]);
        $_SESSION['flash']='Album deleted.'; header('Location: gallery.php'); exit;
    } elseif ($act === 'upload_image') {
        $album=(int)$_POST['album_id']; $caption=clean($_POST['caption']??'');
        if (!empty($_FILES['image']['name'])) {
            $up=handle_upload($_FILES['image'],'image');
            if($up['ok']){ $pdo->prepare('INSERT INTO gallery_images (album_id,image,caption) VALUES (?,?,?)')->execute([$album,$up['path'],$caption]); $_SESSION['flash']='Image uploaded.'; }
            else $_SESSION['flash_err']=$up['error'];
        }
        header('Location: gallery.php?album='.$album); exit;
    } elseif ($act === 'delete_image') {
        $id=(int)$_POST['id']; $album=(int)$_POST['album_id'];
        $im=$pdo->prepare('SELECT image FROM gallery_images WHERE id=?'); $im->execute([$id]); $r=$im->fetch();
        if($r) delete_upload($r['image']);
        $pdo->prepare('DELETE FROM gallery_images WHERE id=?')->execute([$id]);
        $_SESSION['flash']='Image deleted.'; header('Location: gallery.php?album='.$album); exit;
    }
    header('Location: gallery.php'); exit;
}
$flash=$_SESSION['flash']??''; $flashErr=$_SESSION['flash_err']??''; unset($_SESSION['flash'],$_SESSION['flash_err']);
$viewAlbum = isset($_GET['album']) ? (int)$_GET['album'] : 0;
$pageTitle='Gallery'; include __DIR__.'/includes/header.php';
?>
<?php if($flash):?><div class="flash ok"><?=e($flash)?></div><?php endif;?>
<?php if($flashErr):?><div class="flash err"><?=e($flashErr)?></div><?php endif;?>
<?php if($viewAlbum):
  $al=$pdo->prepare('SELECT * FROM gallery_albums WHERE id=?'); $al->execute([$viewAlbum]); $album=$al->fetch();
  if(!$album){echo '<p>Album not found.</p>'; include __DIR__.'/includes/footer.php'; exit;}
  $imgs=$pdo->prepare('SELECT * FROM gallery_images WHERE album_id=? ORDER BY id DESC'); $imgs->execute([$viewAlbum]); $images=$imgs->fetchAll();
?>
  <a class="btn-ghost" href="gallery.php">&larr; All albums</a>
  <h3><?=e($album['title'])?></h3>
  <form class="resource-form" method="post" enctype="multipart/form-data">
    <?=csrf_field()?><input type="hidden" name="_action" value="upload_image"><input type="hidden" name="album_id" value="<?=$viewAlbum?>">
    <div class="form-field"><label>Add Image *</label><input type="file" name="image" accept="image/*" required></div>
    <div class="form-field"><label>Caption</label><input type="text" name="caption"></div>
    <button class="btn-primary">Upload Image</button>
  </form>
  <div class="gallery-grid">
    <?php foreach($images as $im):?>
      <div class="gallery-item">
        <img src="../<?=e(ltrim($im['image'],'/'))?>" alt="<?=e($im['caption'])?>">
        <form method="post" onsubmit="return confirm('Delete image?');">
          <?=csrf_field()?><input type="hidden" name="_action" value="delete_image"><input type="hidden" name="id" value="<?=(int)$im['id']?>"><input type="hidden" name="album_id" value="<?=$viewAlbum?>">
          <button class="link-danger">Delete</button>
        </form>
      </div>
    <?php endforeach;?>
    <?php if(!$images):?><p class="empty">No images yet.</p><?php endif;?>
  </div>
<?php else:
  $albums=$pdo->query('SELECT a.*,(SELECT COUNT(*) FROM gallery_images gi WHERE gi.album_id=a.id) c FROM gallery_albums a ORDER BY a.created_at DESC')->fetchAll();
?>
  <form class="resource-form" method="post" enctype="multipart/form-data">
    <?=csrf_field()?><input type="hidden" name="_action" value="create_album">
    <h3>New Album</h3>
    <div class="form-field"><label>Title *</label><input type="text" name="title" required></div>
    <div class="form-field"><label>Description</label><textarea name="description" rows="3"></textarea></div>
    <div class="form-field"><label>Cover Image</label><input type="file" name="cover_image" accept="image/*"></div>
    <button class="btn-primary">Create Album</button>
  </form>
  <div class="gallery-grid">
    <?php foreach($albums as $al):?>
      <div class="gallery-item">
        <?php if($al['cover_image']):?><img src="../<?=e(ltrim($al['cover_image'],'/'))?>" alt=""><?php endif;?>
        <strong><?=e($al['title'])?></strong>
        <small><?=(int)$al['c']?> images</small>
        <div class="row-actions">
          <a href="gallery.php?album=<?=(int)$al['id']?>">Manage</a>
          <form method="post" onsubmit="return confirm('Delete album and all images?');">
            <?=csrf_field()?><input type="hidden" name="_action" value="delete_album"><input type="hidden" name="id" value="<?=(int)$al['id']?>">
            <button class="link-danger">Delete</button>
          </form>
        </div>
      </div>
    <?php endforeach;?>
    <?php if(!$albums):?><p class="empty">No albums yet.</p><?php endif;?>
  </div>
<?php endif; include __DIR__.'/includes/footer.php'; ?>
