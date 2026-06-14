<?php
$pageTitle = 'Photo Gallery';
$current = 'gallery.php';
include 'includes/public_header.php';

$pdo = db();
$album_slug = clean($_GET['album'] ?? '');

if (!empty($album_slug)) {
    $stmt = $pdo->prepare("SELECT * FROM gallery_albums WHERE slug = ?");
    $stmt->execute([$album_slug]);
    $album = $stmt->fetch();

    if ($album) {
        $imgs = $pdo->prepare("SELECT * FROM gallery_images WHERE album_id = ? ORDER BY id DESC");
        $imgs->execute([$album['id']]);
        $images = $imgs->fetchAll();
        ?>
        <section class="page-banner">
          <div class="container">
            <h1><?= e($album['title']) ?></h1>
            <p class="breadcrumb"><a href="index.php">Home</a> &raquo; <a href="gallery.php">Gallery</a> &raquo; <?= e($album['title']) ?></p>
          </div>
        </section>
        <section class="section">
          <div class="container">
            <div class="section-head">
              <p><?= e($album['description']) ?></p>
            </div>
            <div class="gallery-grid">
              <?php foreach ($images as $img): ?>
                <div class="gallery-item">
                  <a href="<?= e($img['image']) ?>" target="_blank">
                    <img src="<?= e($img['image']) ?>" alt="<?= e($img['caption']) ?>">
                  </a>
                  <?php if (!empty($img['caption'])): ?><p><?= e($img['caption']) ?></p><?php endif; ?>
                </div>
              <?php endforeach; ?>
            </div>
            <div class="center" style="margin-top:40px">
              <a href="gallery.php" class="btn btn-outline">&larr; Back to Albums</a>
            </div>
          </div>
        </section>
        <?php
    } else {
        echo "<div class='container'><p>Album not found.</p></div>";
    }
} else {
    $albums = $pdo->query("SELECT a.*, (SELECT COUNT(*) FROM gallery_images gi WHERE gi.album_id=a.id) as image_count FROM gallery_albums a ORDER BY a.created_at DESC")->fetchAll();
    ?>
    <section class="page-banner">
      <div class="container">
        <h1>Photo Gallery</h1>
        <p class="breadcrumb"><a href="index.php">Home</a> &raquo; Photo Gallery</p>
      </div>
    </section>
    <section class="section">
      <div class="container">
        <?php if (!empty($albums)): ?>
          <div class="prog-grid">
            <?php foreach ($albums as $al):
                $cover = $al['cover_image'] ?: 'images/facility.jpg';
            ?>
              <a class="prog-card" href="gallery.php?album=<?= e($al['slug']) ?>">
                <div class="prog-img" style="background-image:url('<?= e($cover) ?>')"></div>
                <div class="prog-body">
                  <h3><?= e($al['title']) ?></h3>
                  <p><?= (int)$al['image_count'] ?> Photos</p>
                  <span class="arrow">View Album &rarr;</span>
                </div>
              </a>
            <?php endforeach; ?>
          </div>
        <?php else: ?>
          <p class="center">No albums found yet.</p>
        <?php endif; ?>
      </div>
    </section>
    <?php
}

include 'includes/public_footer.php';
?>
