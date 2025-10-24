<?php
include($_SERVER['DOCUMENT_ROOT'].'/HawaanEcommerce/header.php');
include($_SERVER['DOCUMENT_ROOT'].'/HawaanEcommerce/config.php');

// Get blog ID from URL
$blog_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if (!$blog_id) {
    echo "<div class='container py-5 text-center'><h3>Invalid blog ID.</h3></div>";
    include($_SERVER['DOCUMENT_ROOT'].'/HawaanEcommerce/footer.php');
    exit;
}

// Fetch blog data
$stmt = $pdo->prepare("SELECT * FROM blogs WHERE id = :id");
$stmt->execute([':id' => $blog_id]);
$blog = $stmt->fetch();

if (!$blog) {
    echo "<div class='container py-5 text-center'><h3>Blog not found.</h3></div>";
    include($_SERVER['DOCUMENT_ROOT'].'/HawaanEcommerce/footer.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($blog['heading']) ?> - Hawaan Ecommerce</title>
    <style>
        :root {
            --primary-color: #4f6df5;
            --secondary-color: #ff6b6b;
            --dark-color: #2d3748;
            --light-color: #f8f9fa;
            --gray-color: #718096;
            --border-radius: 12px;
            --box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            --transition: all 0.3s ease;
        }
        
        body {
            font-family: 'Inter', 'Segoe UI', sans-serif;
            color: #333;
            line-height: 1.6;
            background-color: #f9fafc;
        }
        
        .blog-container-detail {
            max-width: 800px;
            margin: 0 auto;
        }
        
        .blog-banner-detail {
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: var(--box-shadow);
            margin-bottom: 2.5rem;
            transition: var(--transition);
        }
        
        .blog-banner:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
        }
        
        .blog-banner img {
            width: 100%;
            height: 400px;
            object-fit: cover;
            display: block;
        }
        
        .blog-meta-detail {
            display: flex;
            align-items: center;
            margin-bottom: 1.5rem;
            padding: 1.5rem;
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
        }
        
        .author-image {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 1rem;
            border: 3px solid var(--primary-color);
            padding: 2px;
        }
        
        .blog-title {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 1.5rem;
            color: var(--dark-color);
            line-height: 1.2;
        }
        
        .blog-content {
            background: white;
            padding: 2.5rem;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            margin-bottom: 2rem;
            font-size: 1.1rem;
            color: #444;
        }
        
        .blog-content p {
            margin-bottom: 1.5rem;
        }
        
        .back-btn {
            display: inline-flex;
            align-items: center;
            padding: 0.8rem 1.5rem;
            background: var(--primary-color);
            color: white;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            transition: var(--transition);
            box-shadow: 0 4px 15px rgba(79, 109, 245, 0.3);
        }
        
        .back-btn:hover {
            background: #3a57e3;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(79, 109, 245, 0.4);
            color: white;
        }
        
        .blog-category {
            display: inline-block;
            background: rgba(79, 109, 245, 0.1);
            color: var(--primary-color);
            padding: 0.4rem 1rem;
            border-radius: 50px;
            font-size: 0.85rem;
            font-weight: 600;
            margin-top: 0.5rem;
        }
        
        .divider {
            height: 1px;
            background: linear-gradient(to right, transparent, #e2e8f0, transparent);
            margin: 2rem 0;
        }
        
        @media (max-width: 768px) {
            .blog-title {
                font-size: 2rem;
            }
            
            .blog-content {
                padding: 1.5rem;
            }
            
            .blog-banner img {
                height: 250px;
            }
            
            .blog-meta {
                flex-direction: column;
                text-align: center;
            }
            
            .author-image {
                margin-right: 0;
                margin-bottom: 1rem;
            }
        }
    </style>
</head>
<body>
<main>
  <div class=" py-5">
    <div class="blog-container-detail">
        <!-- Blog Banner Image -->
        <div class="blog-banner-detail">
          <img src="<?= htmlspecialchars($blog['blog_img']) ?>" alt="<?= htmlspecialchars($blog['heading']) ?>">
        </div>

        <!-- Blog Meta -->
        <div class="blog-meta-detail">
          <img src="<?= htmlspecialchars($blog['auther_img']) ?>" class="author-image" alt="<?= htmlspecialchars($blog['auther_name']) ?>">
          <div>
            <h5 class="mb-1"><?= htmlspecialchars($blog['auther_name']) ?></h5>
            <p class="mb-1 text-muted"><?= date('F j, Y', strtotime($blog['date'])) ?></p>
            <span class="blog-category"><?= htmlspecialchars($blog['blog_name']) ?></span>
          </div>
        </div>

        <!-- Blog Heading -->
        <h1 class="blog-title"><?= htmlspecialchars($blog['heading']) ?></h1>

        <!-- Blog Content -->
        <div class="blog-content">
          <?= nl2br(htmlspecialchars($blog['content'])) ?>
        </div>
        
        <div class="divider"></div>

        <!-- Back Button -->
        <div class="text-center">
          <a href="/HawaanEcommerce/blog.php" class="back-btn">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16" style="margin-right: 8px;">
              <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
            </svg>
            Back to Blog
          </a>
        </div>
    </div>
  </div>
</main>

<?php include($_SERVER['DOCUMENT_ROOT'].'/HawaanEcommerce/footer.php'); ?>
</body>
</html>