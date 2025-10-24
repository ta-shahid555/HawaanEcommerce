<?php $base_path = '/HawaanEcommerce/'; ?>

<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'config.php';

if (isset($_POST['subscriber_name']) && isset($_POST['subscriber_email'])) {
    $name = $_POST['subscriber_name'];
    $email = $_POST['subscriber_email'];

    try {
        $stmt = $pdo->prepare("INSERT INTO tbl_subscriber (name, email) VALUES (?, ?)");
        $stmt->execute([$name, $email]);

        echo "<script>alert('Thanks for subscribing!'); window.location.href='index.php';</script>";
    } catch (PDOException $e) {
        echo "Error inserting subscriber: " . $e->getMessage();
    }
}

include 'chatbot/index.php';
include __DIR__ . '../spin.php'; // ek folder upar jao


?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>HAWAAN - e-Commerce Website</title>

  <!--
    - favicon
  -->
  <link rel="shortcut icon" href="<?php echo $base_path; ?>assets/uploads/favicon.png" type="image/x-icon">

  <!--
    - custom css link
  -->
    <link rel="stylesheet" href="<?php echo $base_path; ?>assets/css/styles.css">
    <link rel="stylesheet" href="<?php echo $base_path; ?>assets/css/pages.css">
    <link rel="stylesheet" href="<?php echo $base_path; ?>assets/css/modules.css">

  <!--
    - google font link
  -->
    <!-- Bootstrap Icons CDN -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
    rel="stylesheet">

  <!-- Cart Management Scripts -->
  <script src="<?php echo $base_path; ?>assets/js/cart.js"></script>

</head>

<body>


  <div class="overlay" data-overlay></div>

  <!--
    - MODAL
  -->

  <div id="modal" class="modal" data-modal>

    <div class="modal-close-overlay" data-modal-overlay></div>

    <div class="modal-content">

      <button class="modal-close-btn"  onclick="modalFunction()" data-modal-close>
  <i class="bi bi-x-lg"></i>
      </button>

      <div class="newsletter-img">
        <img src="<?php echo $base_path; ?>assets/images/newsletter.png" alt="subscribe newsletter" width="400" height="400">
      </div>

      <div class="newsletter">

<form action="header.php" method="POST">

  <div class="newsletter-header">
    <h3 class="newsletter-title">Subscribe Newsletter.</h3>
    <p class="newsletter-desc">
      Subscribe the <b>hawaan</b> to get latest products and discount update.
    </p>
  </div>

  <!-- 🔹 Name field added -->
  <input type="text" name="subscriber_name" class="email-field" placeholder="Your Name" required>

  <!-- 🔹 Email field -->
  <input type="email" name="subscriber_email" class="email-field" placeholder="Email Address" required>

  <!-- 🔹 Submit button -->
  <button type="submit" class="btn-newsletter">Subscribe</button>

</form>


      </div>

    </div>

  </div>

<script>
  // Get modal and related elements
function modalFunction (){
  document.getElementById('modal').style.display = 'none'
}

</script>




  <!--
    - NOTIFICATION TOAST
  -->

  <div class="notification-toast" data-toast>

    <button class="toast-close-btn" data-toast-close>
      <i class="bi bi-x-lg"></i>
    </button>

    <div class="toast-banner">
      <img src="<?php echo $base_path; ?>assets/images/products/jewellery-1.jpg" alt="Rose Gold Earrings" width="80" height="70">
    </div>

    <div class="toast-detail">

      <p class="toast-message">
        Someone in new just bought
      </p>

      <p class="toast-title">
        Rose Gold Earrings
      </p>

      <p class="toast-meta">
        <time datetime="PT2M">2 Minutes</time> ago
      </p>

    </div>

  </div>





  <!--
    - HEADER
  -->

  <header>

    <div class="header-main">
      <nav class="desktop-navigation-menu">
        <div class="container">

          <a href="<?php echo $base_path; ?>index.php" class="header-logo">
            <img src="<?php echo $base_path; ?>assets/uploads/logo.png" alt="" height="100px">
          </a>

          <ul class="desktop-menu-category-list">

            <li class="menu-category">
              <a href="<?php echo $base_path; ?>index.php" class="menu-title">Home</a>
            </li>

            <li class="menu-category ">
              <a href="<?php echo $base_path; ?>#" class="menu-title">Categories</a>

              <div class="dropdown-panel">

                <ul class="dropdown-panel-list">

                  <li class="menu-title">
                    <a href="<?php echo $base_path; ?>#">Jewellery</a>
                  </li>

                  <li class="panel-list-item">
                    <a href="<?php echo $base_path; ?>other pages/Categories/jewellery/earring.php">Earrings</a>
                  </li>

                  <li class="panel-list-item">
                    <a href="<?php echo $base_path; ?>other pages/Categories/jewellery/couplerings.php">Couple Rings</a>
                  </li>

                  <li class="panel-list-item">
                    <a href="<?php echo $base_path; ?>other pages/Categories/jewellery/necklace.php">Necklace</a>
                  </li>

                  <li class="panel-list-item">
                    <a href="<?php echo $base_path; ?>other pages/Categories/jewellery/bracelet.php">Bracelets</a>
                  </li>

                  

                  <li class="panel-list-item">
                    <a href="<?php echo $base_path; ?>#">
                      <img src="<?php echo $base_path; ?>/assets/images/electronics-banner-1.jpg" alt="headphone collection" width="250" height="119">
                    </a>
                  </li>

                </ul>

                <ul class="dropdown-panel-list">

                  <li class="menu-title">
                    <a href="<?php echo $base_path; ?>#">Perfumes</a>
                  </li>

                  <li class="panel-list-item">
                    <a href="<?php echo $base_path; ?>other pages/Categories/perfumes/floral.php">Floral</a>
                  </li>

                  <li class="panel-list-item">
                    <a href="<?php echo $base_path; ?>other pages/Categories/perfumes/oriental.php">Oriental</a>
                  </li>

                  <li class="panel-list-item">
                    <a href="<?php echo $base_path; ?>other pages/Categories/perfumes/woody.php">Woody</a>
                  </li>

                  <li class="panel-list-item">
                    <a href="<?php echo $base_path; ?>other pages/Categories/perfumes/fougere.php">Fougère</a>
                  </li>

                  

                  <li class="panel-list-item">
                    <a href="<?php echo $base_path; ?>#">
                      <img src="<?php echo $base_path; ?>/assets/images/electronics-banner-1.jpg" alt="headphone collection" width="250" height="119">
                    </a>
                  </li>

                </ul><ul class="dropdown-panel-list">

                  <li class="menu-title">
                    <a href="<?php echo $base_path; ?>#">Men's</a>
                  </li>

                  <li class="panel-list-item">
                    <a href="<?php echo $base_path; ?>other pages/Categories/mens-accessories/sunglasses.php">Sun Glasses</a>
                  </li>

                  <li class="panel-list-item">
                    <a href="<?php echo $base_path; ?>other pages/Categories/mens-accessories/watches.php">Watches</a>
                  </li>

                  <li class="panel-list-item">
                    <a href="<?php echo $base_path; ?>other pages/Categories/mens-accessories/wallets.php">Wallets</a>
                  </li>

                  <li class="panel-list-item">
                    <a href="<?php echo $base_path; ?>other pages/Categories/mens-accessories/shoes.php">Shoes</a>
                  </li>

                  <li class="panel-list-item">
                    <a href="<?php echo $base_path; ?>#">
                      <img src="<?php echo $base_path; ?>/assets/images/mens-banner.jpg" alt="men's fashion" width="250" height="119">
                    </a>
                  </li>

                </ul>

                <ul class="dropdown-panel-list">

                  <li class="menu-title">
                    <a href="<?php echo $base_path; ?>#">Women's</a>
                  </li>

                  <li class="panel-list-item">
                    <a href="<?php echo $base_path; ?>other pages/Categories/makeup/lipstick.php">Lipstick</a>
                  </li>

                  <li class="panel-list-item">
                    <a href="<?php echo $base_path; ?>other pages/Categories/makeup/eyeliner.php">Eyeliner</a>
                  </li>

                  <li class="panel-list-item">
                    <a href="<?php echo $base_path; ?>other pages/Categories/makeup/primer.php">Primer</a>
                  </li>

                  

                  <li class="panel-list-item">
                    <a href="<?php echo $base_path; ?>other pages/Categories/makeup/mascara.php">Mascara</a>
                  </li>

                  <li class="panel-list-item">
                    <a href="<?php echo $base_path; ?>#">
                      <img src="<?php echo $base_path; ?>/assets/images/womens-banner.jpg" alt="women's fashion" width="250" height="119">
                    </a>
                  </li>

                </ul>

                <ul class="dropdown-panel-list">

                  <li class="menu-title">
                    <a href="<?php echo $base_path; ?>#">Electronics</a>
                  </li>

                  <li class="panel-list-item">
                    <a href="<?php echo $base_path; ?>other pages/Categories/electronics/sw.php">Smart Watch</a>
                  </li>

                  <li class="panel-list-item">
                    <a href="<?php echo $base_path; ?>other pages/Categories/electronics/stv.php">Smart TV</a>
                  </li>

                  

                  <li class="panel-list-item">
                    <a href="<?php echo $base_path; ?>other pages/Categories/electronics/mouse.php">Mouse</a>
                  </li>

                  <li class="panel-list-item">
                    <a href="<?php echo $base_path; ?>other pages/Categories/electronics/microphone.php">Microphone</a>
                  </li>

                  <li class="panel-list-item">
                    <a href="<?php echo $base_path; ?>#">
                      <img src="<?php echo $base_path; ?>/assets/images/electronics-banner-2.jpg" alt="mouse collection" width="250" height="119">
                    </a>
                  </li>

                </ul>

              </div>
            </li>

            <li class="menu-category">
              <a href="<?php echo $base_path; ?>#" class="menu-title">Men's</a>

              <ul class="dropdown-list">

                <li class="dropdown-item">
                  <a href="<?php echo $base_path; ?>other pages/Categories/mens-collection/formal.php">Formal</a>
                </li>

                <li class="dropdown-item">
                  <a href="<?php echo $base_path; ?>other pages/Categories/mens-collection/casual.php">Casual</a>
                </li>

                <li class="dropdown-item">
                  <a href="<?php echo $base_path; ?>other pages/Categories/mens-collection/tshirts.php">Tshirts</a>
                </li>

                <li class="dropdown-item">
                  <a href="<?php echo $base_path; ?>other pages/Categories/mens-collection/jackets.php">Jackets</a>
                </li>

              <li class="dropdown-item">
                  <a href="<?php echo $base_path; ?>other pages/Categories/mens-collection/shorts.php">Shorts</a>
                </li></ul>
            </li>

            <li class="menu-category">
              <a href="<?php echo $base_path; ?>#" class="menu-title">Women's</a>

              <ul class="dropdown-list">

                <li class="dropdown-item">
                  <a href="<?php echo $base_path; ?>other pages/Categories/womens-collection/formal.php">Formal</a>
                </li>

                <li class="dropdown-item">
                  <a href="<?php echo $base_path; ?>other pages/Categories/womens-collection/kurtas&suits.php">Kurtas &amp; Suits</a>
                </li><li class="dropdown-item">
                  <a href="<?php echo $base_path; ?>other pages/Categories/womens-collection/saree.php">Saree</a>
                </li>

                <li class="dropdown-item">
                  <a href="<?php echo $base_path; ?>other pages/Categories/womens-collection/lehenga&cholis.php">Lehenga Cholis</a>
                </li>

                <li class="dropdown-item">
                  <a href="<?php echo $base_path; ?>other pages/Categories/womens-collection/dupattas&shawls.php">Dupattas &amp; Shawls</a>
                </li>

              </ul>
            </li>

            <li class="menu-category">
              <a href="<?php echo $base_path; ?>#" class="menu-title">Kid's</a>

              <ul class="dropdown-list">

                <li class="dropdown-item">
                  <a href="<?php echo $base_path; ?>other pages/Categories/kids-collection/formal.php">Formal</a>
                </li>

                <li class="dropdown-item">
                  <a href="<?php echo $base_path; ?>other pages/Categories/kids-collection/casual.php">Casual</a>
                </li><li class="dropdown-item">
                  <a href="<?php echo $base_path; ?>other pages/Categories/kids-collection/shorts.php">Shorts</a>
                </li>

                <li class="dropdown-item">
                  <a href="<?php echo $base_path; ?>other pages/Categories/kids-collection/trousers.php">Trousers</a>
                </li>

                <li class="dropdown-item">
                  <a href="<?php echo $base_path; ?>other pages/Categories/kids-collection/tshirts.php">Tshirts</a>
                </li>

              </ul>
            </li>

            

            <li class="menu-category">
              <a href="<?php echo $base_path; ?>other pages/blogs.php" class="menu-title">Blog</a>
            </li>

          </ul>

          <div class="header-user-actions">

              <!-- Close Icon -->

              <!-- Profile Icon -->
            <!-- User Icon with Login Status Check -->
            <button class="action-btn">
              <?php if(isset($_SESSION['user_email'])): ?>
                <!-- Show user profile and orders link when logged in -->
                <div class="dropdown">
                  <a href="/HawaanEcommerce/orderDisplay.php" class="dropdown-toggle" data-bs-toggle="dropdown">
                    <i class="bi bi-person-check"></i>
                  </a>
                </div>
              <?php else: ?>
                <!-- Show regular login icon when not logged in -->
                <a href="/HawaanEcommerce/auth.php">
                  <i class="bi bi-person-x"></i>
                  
                </a>
              <?php endif; ?>
            </button>

            <!-- Cart Icon -->
            <button class="action-btn" onclick="navigateToCart()">
              <i class="bi bi-bag"></i>
              <span class="count" id="cart-count">0</span>
            </button>
          </div>


          </div>

        </div>
      </nav>
    </div>

    <div class="mobile-bottom-navigation">

      <button class="action-btn" data-mobile-menu-open-btn>
        <ion-icon name="menu-outline"></ion-icon>
      </button>

      <button class="action-btn" onclick="navigateToCart()">
        <ion-icon name="bag-handle-outline"></ion-icon>
        <span class="count" id="mobile-cart-count">0</span>
      </button>

      <button class="action-btn" onclick="window.location.href='index.php'">
        <ion-icon name="home-outline"></ion-icon>
      </button>

      <button class="action-btn" data-mobile-menu-open-btn>
        <ion-icon name="grid-outline"></ion-icon>
      </button>
      
      <button class="action-btn">
              <?php if(isset($_SESSION['user_email'])): ?>
                <!-- Show user profile and orders link when logged in -->
                <div class="dropdown">
                  <a href="/HawaanEcommerce/orderDisplay.php" class="dropdown-toggle" data-bs-toggle="dropdown">
                    <i class="bi bi-person-check"></i>
                  </a>
                </div>
              <?php else: ?>
                <!-- Show regular login icon when not logged in -->
                <a href="/HawaanEcommerce/auth.php">
                  <i class="bi bi-person-x"></i>
                  
                </a>
              <?php endif; ?>
            </button>

    </div>

    <nav class="mobile-navigation-menu has-scrollbar" data-mobile-menu="">

        <div class="menu-top">
          <h2 class="menu-title">Menu</h2>
          <button class="menu-close-btn" data-mobile-menu-close-btn="">
            <ion-icon name="close-outline"></ion-icon>
          </button>
        </div>

        <ul class="mobile-menu-category-list">

          <li class="menu-category">
            <a href="<?php echo $base_path; ?>index.php" class="menu-title">Home</a>
          </li>

          <!-- Men's -->
          <li class="menu-category">
            <button class="accordion-menu active" data-accordion-btn="">
              <p class="menu-title">Men's</p>
              <div>
                <ion-icon name="add-outline" class="add-icon"></ion-icon>
                <ion-icon name="remove-outline" class="remove-icon"></ion-icon>
              </div>
            </button>
            <ul class="submenu-category-list active" data-accordion="">
              <li class="submenu-category"><a href="<?php echo $base_path; ?>other pages/Categories/mens-collection/formal.php" class="submenu-title">Formal</a></li>
              <li class="submenu-category"><a href="<?php echo $base_path; ?>other pages/Categories/mens-collection/casual.php" class="submenu-title">Casual</a></li>
              <li class="submenu-category"><a href="<?php echo $base_path; ?>other pages/Categories/mens-collection/tshirts.php" class="submenu-title">Tshirts</a></li>
              <li class="submenu-category"><a href="<?php echo $base_path; ?>other pages/Categories/mens-collection/jackets.php" class="submenu-title">Jackets</a></li>
              <li class="submenu-category"><a href="<?php echo $base_path; ?>other pages/Categories/mens-collection/shorts.php" class="submenu-title">Shorts</a></li>
            </ul>
          </li>

          <!-- Women's -->
          <li class="menu-category">
            <button class="accordion-menu" data-accordion-btn="">
              <p class="menu-title">Women's</p>
              <div>
                <ion-icon name="add-outline" class="add-icon"></ion-icon>
                <ion-icon name="remove-outline" class="remove-icon"></ion-icon>
              </div>
            </button>
            <ul class="submenu-category-list" data-accordion="">
              <li class="submenu-category"><a href="<?php echo $base_path; ?>other pages/Categories/womens-collection/formal.php" class="submenu-title">Formal</a></li>
              <li class="submenu-category"><a href="<?php echo $base_path; ?>other pages/Categories/womens-collection/kurtas&suits.php" class="submenu-title">Kurtas & Suits</a></li>
              <li class="submenu-category"><a href="<?php echo $base_path; ?>other pages/Categories/womens-collection/saree.php" class="submenu-title">Saree</a></li>
              <li class="submenu-category"><a href="<?php echo $base_path; ?>other pages/Categories/womens-collection/lehenga&cholis.php" class="submenu-title">Lehenga Cholis</a></li>
              <li class="submenu-category"><a href="<?php echo $base_path; ?>other pages/Categories/womens-collection/dupattas&shawls.php" class="submenu-title">Dupattas & Shawls</a></li>
            </ul>
          </li>

          <!-- Kid's -->
          <li class="menu-category">
            <button class="accordion-menu" data-accordion-btn="">
              <p class="menu-title">Kid's</p>
              <div>
                <ion-icon name="add-outline" class="add-icon"></ion-icon>
                <ion-icon name="remove-outline" class="remove-icon"></ion-icon>
              </div>
            </button>
            <ul class="submenu-category-list" data-accordion="">
              <li class="submenu-category"><a href="<?php echo $base_path; ?>other pages/Categories/kids-collection/formal.php" class="submenu-title">Formal</a></li>
              <li class="submenu-category"><a href="<?php echo $base_path; ?>other pages/Categories/kids-collection/casual.php" class="submenu-title">Casual</a></li>
              <li class="submenu-category"><a href="<?php echo $base_path; ?>other pages/Categories/kids-collection/shorts.php" class="submenu-title">Shorts</a></li>
              <li class="submenu-category"><a href="<?php echo $base_path; ?>other pages/Categories/kids-collection/trousers.php" class="submenu-title">Trousers</a></li>
              <li class="submenu-category"><a href="<?php echo $base_path; ?>other pages/Categories/kids-collection/tshirts.php" class="submenu-title">Tshirts</a></li>
            </ul>
          </li>

          <!-- Blog -->
          <li class="menu-category">
            <a href="<?php echo $base_path; ?>other pages/blogs.php" class="menu-title">Blog</a>
          </li>

        </ul>

        <div class="menu-bottom">

          <ul class="menu-social-container">
            <li><a href="<?php echo $base_path; ?>#" class="social-link"><ion-icon name="logo-facebook"></ion-icon></a></li>
            <li><a href="<?php echo $base_path; ?>#" class="social-link"><ion-icon name="logo-twitter"></ion-icon></a></li>
            <li><a href="<?php echo $base_path; ?>#" class="social-link"><ion-icon name="logo-instagram"></ion-icon></a></li>
            <li><a href="<?php echo $base_path; ?>#" class="social-link"><ion-icon name="logo-linkedin"></ion-icon></a></li>
          </ul>

        </div>

    </nav>
 <div class="sidebar  has-scrollbar" data-mobile-menu>

          <div class="sidebar-category">

              <div class="sidebar-top">
                <h2 class="sidebar-title">Category</h2>
                <button class="sidebar-close-btn" data-mobile-menu-close-btn="">
                  <ion-icon name="close-outline" role="img" class="md hydrated" aria-label="close outline"></ion-icon>
                </button>
              </div>

              <ul class="sidebar-menu-category-list">

                <!-- Jewellery -->
                <li class="sidebar-menu-category">
                  <button class="sidebar-accordion-menu" data-accordion-btn="">
                    <div class="menu-title-flex">
                      <img src="/assets/images/icons/jewelry.svg" alt="jewellery" width="20" height="20" class="menu-title-img">
                      <p class="menu-title">Jewellery</p>
                    </div>
                    <div>
                      <ion-icon name="add-outline" class="add-icon"></ion-icon>
                      <ion-icon name="remove-outline" class="remove-icon"></ion-icon>
                    </div>
                  </button>
                  <ul class="sidebar-submenu-category-list" data-accordion="">
                    <li class="sidebar-submenu-category"><a href="/other pages/Categories/jewellery/earring.html" class="sidebar-submenu-title"><p class="product-name">Earrings</p></a></li>
                    <li class="sidebar-submenu-category"><a href="/other pages/Categories/jewellery/couplerings.html" class="sidebar-submenu-title"><p class="product-name">Couple Rings</p></a></li>
                    <li class="sidebar-submenu-category"><a href="/other pages/Categories/jewellery/necklace.html" class="sidebar-submenu-title"><p class="product-name">Necklace</p></a></li>
                    <li class="sidebar-submenu-category"><a href="/other pages/Categories/jewellery/bracelet.html" class="sidebar-submenu-title"><p class="product-name">Bracelets</p></a></li>
                  </ul>
                </li>

                <!-- Perfumes -->
                <li class="sidebar-menu-category">
                  <button class="sidebar-accordion-menu" data-accordion-btn="">
                    <div class="menu-title-flex">
                      <img src="/assets/images/icons/perfume.svg" alt="perfumes" width="20" height="20" class="menu-title-img">
                      <p class="menu-title">Perfumes</p>
                    </div>
                    <div>
                      <ion-icon name="add-outline" class="add-icon"></ion-icon>
                      <ion-icon name="remove-outline" class="remove-icon"></ion-icon>
                    </div>
                  </button>
                  <ul class="sidebar-submenu-category-list" data-accordion="">
                    <li class="sidebar-submenu-category"><a href="/other pages/Categories/perfumes/floral.html" class="sidebar-submenu-title"><p class="product-name">Floral</p></a></li>
                    <li class="sidebar-submenu-category"><a href="/other pages/Categories/perfumes/oriental.html" class="sidebar-submenu-title"><p class="product-name">Oriental</p></a></li>
                    <li class="sidebar-submenu-category"><a href="/other pages/Categories/perfumes/woody.html" class="sidebar-submenu-title"><p class="product-name">Woody</p></a></li>
                    <li class="sidebar-submenu-category"><a href="/other pages/Categories/perfumes/fougere.html" class="sidebar-submenu-title"><p class="product-name">Fougère</p></a></li>
                  </ul>
                </li>

                <!-- Men's -->
                <li class="sidebar-menu-category">
                  <button class="sidebar-accordion-menu" data-accordion-btn="">
                    <div class="menu-title-flex">
                      <img src="/assets/images/icons/shoes.svg" alt="men's" width="20" height="20" class="menu-title-img">
                      <p class="menu-title">Men's</p>
                    </div>
                    <div>
                      <ion-icon name="add-outline" class="add-icon"></ion-icon>
                      <ion-icon name="remove-outline" class="remove-icon"></ion-icon>
                    </div>
                  </button>
                  <ul class="sidebar-submenu-category-list" data-accordion="">
                    <li class="sidebar-submenu-category"><a href="/other pages/Categories/mens/sunglasses.html" class="sidebar-submenu-title"><p class="product-name">Sun Glasses</p></a></li>
                    <li class="sidebar-submenu-category"><a href="/other pages/Categories/mens/watches.htm" class="sidebar-submenu-title"><p class="product-name">Watches</p></a></li>
                    <li class="sidebar-submenu-category"><a href="/other pages/Categories/mens/wallets.html" class="sidebar-submenu-title"><p class="product-name">Wallets</p></a></li>
                    <li class="sidebar-submenu-category"><a href="/other pages/Categories/mens/shoes.html" class="sidebar-submenu-title"><p class="product-name">Shoes</p></a></li>
                  </ul>
                </li>

                <!-- Women's -->
                <li class="sidebar-menu-category">
                  <button class="sidebar-accordion-menu" data-accordion-btn="">
                    <div class="menu-title-flex">
                      <img src="/assets/images/icons/jewelry.svg" alt="women's" width="20" height="20" class="menu-title-img">
                      <p class="menu-title">Women's</p>
                    </div>
                    <div>
                      <ion-icon name="add-outline" class="add-icon"></ion-icon>
                      <ion-icon name="remove-outline" class="remove-icon"></ion-icon>
                    </div>
                  </button>
                  <ul class="sidebar-submenu-category-list" data-accordion="">
                    <li class="sidebar-submenu-category"><a href="/other pages/Categories/womens/lipstick.html" class="sidebar-submenu-title"><p class="product-name">Lipstick</p></a></li>
                    <li class="sidebar-submenu-category"><a href="/other pages/Categories/womens/eyeliner.html" class="sidebar-submenu-title"><p class="product-name">Eyeliner</p></a></li>
                    <li class="sidebar-submenu-category"><a href="/other pages/Categories/womens/primer.html" class="sidebar-submenu-title"><p class="product-name">Primer</p></a></li>
                    <li class="sidebar-submenu-category"><a href="/other pages/Categories/womens/mascara.html" class="sidebar-submenu-title"><p class="product-name">Mascara</p></a></li>
                  </ul>
                </li>

                <!-- Electronics -->
                <li class="sidebar-menu-category">
                  <button class="sidebar-accordion-menu" data-accordion-btn="">
                    <div class="menu-title-flex">
                      <img src="/assets/images/icons/electronics.svg" alt="electronics" width="20" height="20" class="menu-title-img">
                      <p class="menu-title">Electronics</p>
                    </div>
                    <div>
                      <ion-icon name="add-outline" class="add-icon"></ion-icon>
                      <ion-icon name="remove-outline" class="remove-icon"></ion-icon>
                    </div>
                  </button>
                  <ul class="sidebar-submenu-category-list" data-accordion="">
                    <li class="sidebar-submenu-category"><a href="/other pages/Categories/electronics/sw.html" class="sidebar-submenu-title"><p class="product-name">Smart Watch</p></a></li>
                    <li class="sidebar-submenu-category"><a href="/other pages/Categories/electronics/stv.html" class="sidebar-submenu-title"><p class="product-name">Smart TV</p></a></li>
                    <li class="sidebar-submenu-category"><a href="/other pages/Categories/electronics/mouse.html" class="sidebar-submenu-title"><p class="product-name">Mouse</p></a></li>
                    <li class="sidebar-submenu-category"><a href="/other pages/Categories/electronics/microphone.html" class="sidebar-submenu-title"><p class="product-name">Microphone</p></a></li>
                  </ul>
                </li>

            </ul>

          </div>

        </div>               




  </header>
<script>// Mobile menu toggle functionality
const mobileMenuOpenBtn = document.querySelectorAll('[data-mobile-menu-open-btn]');
const mobileMenuCloseBtn = document.querySelectorAll('[data-mobile-menu-close-btn]');
const mobileMenu = document.querySelectorAll('[data-mobile-menu]');

for (let i = 0; i < mobileMenuOpenBtn.length; i++) {
  mobileMenuOpenBtn[i].addEventListener('click', function() {
    mobileMenu[i].classList.add('active');
  });
}

for (let i = 0; i < mobileMenuCloseBtn.length; i++) {
  mobileMenuCloseBtn[i].addEventListener('click', function() {
    mobileMenu[i].classList.remove('active');
  });
}

// Accordion functionality
const accordionBtns = document.querySelectorAll('[data-accordion-btn]');

accordionBtns.forEach(btn => {
  btn.addEventListener('click', function() {
    // Toggle active class on button parent (menu-category)
    this.parentElement.classList.toggle('active');
    
    // Toggle active class on the submenu
    const submenu = this.nextElementSibling;
    submenu.classList.toggle('active');
    
    // Toggle icon visibility
    const addIcon = this.querySelector('.add-icon');
    const removeIcon = this.querySelector('.remove-icon');
    addIcon.classList.toggle('active');
    removeIcon.classList.toggle('active');
  });
});

// Cart navigation function
function navigateToCart() {
  window.location.href = '<?php echo $base_path; ?>cart.php';
}</script>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

