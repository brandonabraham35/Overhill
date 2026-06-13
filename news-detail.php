<?php
$pageTitle = 'News Detail';
$current = 'school-news.php';
include 'includes/public_header.php';

$pdo = db();
$slug = clean($_GET['slug'] ?? '');

if (empty($slug)) {
    echo "<script>window.location.href='school-news.php';</script>";
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM news WHERE slug = ? AND published_at <= NOW()");
$stmt->execute([$slug]);
$article = $stmt->fetch();

if (!$article) {
    echo "<div class='container' style='padding:100px 20px; text-align:center;'><h2>Article not found.</h2><p><a href='school-news.php'>Back to News</a></p></div>";
} else {
    $date = strtotime($article['published_at']);
    ?>
    <section class="page-banner">
      <div class="container">
        <h1><?= e($article['title']) ?></h1>
        <p class="breadcrumb"><a href="index.php">Home</a> &raquo; <a href="school-news.php">News</a> &raquo; <?= e($article['title']) ?></p>
      </div>
    </section>

    <section class="section">
      <div class="container">
        <div class="content-layout with-sidebar">
          <article class="content-main">
            <div class="news-meta" style="margin-bottom: 2rem; color: #666;">
                <span>Published on <?= date('d M Y', $date) ?></span>
            </div>
            <?php if (!empty($article['image'])): ?>
                <img src="<?= e($article['image']) ?>" alt="<?= e($article['title']) ?>" style="width:100%; border-radius:12px; margin-bottom:2rem;">
            <?php endif; ?>
            <div class="article-content">
                <?= $article['content'] ?>
            </div>
            <div style="margin-top:4rem; border-top:1px solid #eee; padding-top:2rem;">
                <a href="school-news.php" class="btn btn-outline">&larr; Back to News</a>
            </div>
          </article>

          <aside class="sidebar">
            <h3>Recent News</h3>
            <?php
            $recent = $pdo->prepare("SELECT title, slug, published_at FROM news WHERE slug != ? AND published_at <= NOW() ORDER BY published_at DESC LIMIT 5");
            $recent->execute([$slug]);
            $recent_news = $recent->fetchAll();
            if (!empty($recent_news)): ?>
                <ul class="side-nav">
                <?php foreach ($recent_news as $r): ?>
                    <li><a href="news-detail.php?slug=<?= e($r['slug']) ?>"><?= e($r['title']) ?></a></li>
                <?php endforeach; ?>
                </ul>
            <?php endif; ?>
          </aside>
        </div>
      </div>
    </section>
    <?php
}

include 'includes/public_footer.php';
?>
