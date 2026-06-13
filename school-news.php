<?php
$pageTitle = 'School News';
$current = 'school-news.php';
include 'includes/public_header.php';

$pdo = db();
$search = clean($_GET['search'] ?? '');
$page = max(1, (int)($_GET['page'] ?? 1));
$perPage = 6;
$offset = ($page - 1) * $perPage;

$where = "WHERE published_at <= NOW()";
$params = [];
if (!empty($search)) {
    $where .= " AND (title LIKE ? OR content LIKE ?)";
    $params[] = "%$search%";
    $params[] = "%$search%";
}

$total = $pdo->prepare("SELECT COUNT(*) FROM news $where");
$total->execute($params);
$totalCount = $total->fetchColumn();
$pages = ceil($totalCount / $perPage);

$stmt = $pdo->prepare("SELECT * FROM news $where ORDER BY published_at DESC LIMIT $perPage OFFSET $offset");
$stmt->execute($params);
$news = $stmt->fetchAll();
?>

<section class="page-banner">
  <div class="container">
    <h1>School News</h1>
    <p class="breadcrumb"><a href="index.php">Home</a> &raquo; School News</p>
  </div>
</section>

<section class="section">
  <div class="container">
    <div class="content-layout with-sidebar">
      <div class="content-main">
        <p class="lead">The latest news and stories from around our school.</p>

        <div class="search-bar" style="margin-bottom: 2rem;">
          <form action="school-news.php" method="GET" style="display:flex; gap:10px;">
            <input type="text" name="search" value="<?= e($search) ?>" placeholder="Search news..." style="flex:1; padding: 12px; border: 1px solid #ddd; border-radius: 8px;">
            <button type="submit" class="btn btn-primary">Search</button>
          </form>
        </div>

        <?php if (!empty($news)): ?>
          <div class="news-grid">
            <?php foreach ($news as $n):
                $date = strtotime($n['published_at']);
                $day = date('d', $date);
                $month = date('M', $date);
            ?>
              <article class="news-card">
                <div class="news-date"><span class="d"><?= $day ?></span><span class="m"><?= $month ?></span></div>
                <div class="news-body">
                  <h3><?= e($n['title']) ?></h3>
                  <p><?= e($n['excerpt'] ?? substr(strip_tags($n['content']), 0, 150) . '...') ?></p>
                  <a href="news-detail.php?slug=<?= e($n['slug']) ?>">Read more &rarr;</a>
                </div>
              </article>
            <?php endforeach; ?>
          </div>

          <?php if ($pages > 1): ?>
            <div class="pagination" style="margin-top: 2rem; display: flex; gap: 5px; justify-content: center;">
              <?php for ($i = 1; $i <= $pages; $i++): ?>
                <a href="school-news.php?page=<?= $i ?>&search=<?= urlencode($search) ?>" class="btn <?= $i == $page ? 'btn-primary' : 'btn-outline' ?>"><?= $i ?></a>
              <?php endfor; ?>
            </div>
          <?php endif; ?>

        <?php else: ?>
          <p>No news articles found.</p>
        <?php endif; ?>
      </div>

      <aside class="sidebar">
        <h3>In This Section</h3>
        <ul class="side-nav">
          <li class="active"><a href="school-news.php">School News</a></li>
          <li><a href="school-events.php">School Events</a></li>
          <li><a href="announcements.php">Announcements</a></li>
          <li><a href="newsletter-archive.php">Newsletter Archive</a></li>
        </ul>
        <div class="side-cta">
          <h4>Ready to Join?</h4>
          <p>Give your child the gift of quality education.</p>
          <a href="admission-information.php" class="btn btn-light btn-block">Apply Now</a>
        </div>
      </aside>
    </div>
  </div>
</section>

<?php include 'includes/public_footer.php'; ?>
