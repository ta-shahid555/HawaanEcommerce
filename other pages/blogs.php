<?php
include($_SERVER['DOCUMENT_ROOT'].'/HawaanEcommerce/header.php');
include($_SERVER['DOCUMENT_ROOT'].'/HawaanEcommerce/config.php');

// Pagination setup
$limit = 3;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) $page = 1;
$offset = ($page - 1) * $limit;

// Total blogs
$totalStmt = $pdo->query("SELECT COUNT(*) AS total FROM blogs");
$total = $totalStmt->fetch()['total'];
$totalPages = ceil($total / $limit);

// Get paginated blogs
$stmt = $pdo->prepare("SELECT * FROM blogs ORDER BY date DESC LIMIT :limit OFFSET :offset");
$stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$blogs = $stmt->fetchAll();
?>

<main>
  <div class="page-container">
    <div class="container">
      <div class="page-header">
        <h1 class="page-title">Our Blog</h1>
        <p class="page-subtitle">Stay updated with the latest fashion trends, tips, and news</p>
      </div>

      <section class="recent-posts">
        <h2>Recent Posts</h2>
        <div class="posts-grid">

          <?php foreach($blogs as $blog): ?>
            <article class="blog-post">
              <div class="post-image">
                <img src="../<?= htmlspecialchars($blog['blog_img']) ?>" alt="Blog Image" />
              </div>
              <div class="post-content">
                <div class="post-meta">
                  <span class="post-category"><?= htmlspecialchars($blog['blog_name']) ?></span>
                  <span class="post-date"><?= date('F j, Y', strtotime($blog['date'])) ?></span>
                </div>
                <h3><?= htmlspecialchars($blog['heading']) ?></h3>
                <p><?= substr($blog['content'], 0, 120) . '...' ?></p>
                <div class="post-footer">
                  <div class="author-info">
                    <img src="../<?= htmlspecialchars($blog['auther_img']) ?>" alt="Author Image" />
                    <span><?= htmlspecialchars($blog['auther_name']) ?></span>
                  </div>
                  <a href="blog-details.php?id=<?= $blog['id'] ?>" class="read-more">Read More</a>
                </div>
              </div>
            </article>
          <?php endforeach; ?>

        </div>
      </section>

      <!-- Pagination -->
      <section class="pagination-section">
        <div class="pagination">
          <?php if($page > 1): ?>
            <a href="?page=<?= $page - 1 ?>" class="pagination-btn">
              <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
          <?php else: ?>
            <button class="pagination-btn disabled">
              <ion-icon name="chevron-back-outline"></ion-icon>
            </button>
          <?php endif; ?>

          <?php for($i = 1; $i <= $totalPages; $i++): ?>
            <a href="?page=<?= $i ?>" class="pagination-btn <?= ($i == $page ? 'active' : '') ?>">
              <?= $i ?>
            </a>
          <?php endfor; ?>

          <?php if($page < $totalPages): ?>
            <a href="?page=<?= $page + 1 ?>" class="pagination-btn">
              <ion-icon name="chevron-forward-outline"></ion-icon>
            </a>
          <?php else: ?>
            <button class="pagination-btn disabled">
              <ion-icon name="chevron-forward-outline"></ion-icon>
            </button>
          <?php endif; ?>
        </div>
      </section>

    </div>
  </div>
</main>

<?php include($_SERVER['DOCUMENT_ROOT'].'/HawaanEcommerce/footer.php'); ?>
