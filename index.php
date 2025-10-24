<?php 

include 'header.php';

?>
<?php
// Include configuration file
require_once 'config.php';
// Display message if exists
if(isset($_SESSION['message'])) {
    $msg = $_SESSION['message'];
    echo "<script>alert('$msg')</script>";
    unset($_SESSION['message']);
}

?>

<?php
// Include configuration file
include 'slider.php';

?>

  <style>
    .action-btn {
      font-size: 24px;
      color: red;
      background: none;
      border: none;
    }

    ion-icon {
      vertical-align: middle;
      font-size: 24px;
    }
  </style>


    <!--
      - CATEGORY
    -->

    <div class="category">

      <div class="container">

        <div class="category-item-container has-scrollbar">

          <div class="category-item">

            <div class="category-img-box">
              <img src="assets/images/icons/dress.svg" alt="Kurtas & Suits" width="30">
            </div>

            <div class="category-content-box">

              <div class="category-content-flex">
                <h3 class="category-item-title">Kurtas & Suits</h3>

                <p class="category-item-amount">(50)</p>
              </div>

              <a href="other pages/Categories/womens-collection/formal.php" class="category-btn">Show all</a>

            </div>

          </div>

          <div class="category-item">

            <div class="category-img-box">
              <img src="assets/images/icons/coat.svg" alt="Winter Wear" width="30">
            </div>

            <div class="category-content-box">

              <div class="category-content-flex">
                <h3 class="category-item-title">Winter Wear</h3>

                <p class="category-item-amount">(58)</p>
              </div>

              <a href="other pages/Categories/mens-collection/casual.php" class="category-btn">Show all</a>

            </div>

          </div>

          <div class="category-item">

            <div class="category-img-box">
              <img src="assets/images/icons/glasses.svg" alt="glasses & lens" width="30">
            </div>

            <div class="category-content-box">

              <div class="category-content-flex">
                <h3 class="category-item-title">Glasses & lens</h3>

                <p class="category-item-amount">(68)</p>
              </div>

              <a href="other pages/Categories/mens-accessories/sunglasses.php" class="category-btn">Show all</a>

            </div>

          </div>

          <div class="category-item">

            <div class="category-img-box">
              <img src="assets/images/icons/shorts.svg" alt="shorts" width="30">
            </div>

            <div class="category-content-box">

              <div class="category-content-flex">
                <h3 class="category-item-title">Shorts</h3>

                <p class="category-item-amount">(14)</p>
              </div>

              <a href="other pages/Categories/mens-collection/shorts.php" class="category-btn">Show all</a>

            </div>

          </div>

          <div class="category-item">

            <div class="category-img-box">
              <img src="assets/images/icons/tee.svg" alt="t-shirts" width="30">
            </div>

            <div class="category-content-box">

              <div class="category-content-flex">
                <h3 class="category-item-title">T-shirts</h3>

                <p class="category-item-amount">(35)</p>
              </div>

              <a href="other pages/Categories/mens-collection/tshirts.php" class="category-btn">Show all</a>

            </div>

          </div>

          <div class="category-item">

            <div class="category-img-box">
              <img src="assets/images/icons/jacket.svg" alt="jacket" width="30">
            </div>

            <div class="category-content-box">

              <div class="category-content-flex">
                <h3 class="category-item-title">Jacket</h3>

                <p class="category-item-amount">(16)</p>
              </div>

              <a href="other pages/Categories/mens-collection/jackets.php" class="category-btn">Show all</a>

            </div>

          </div>

          <div class="category-item">

            <div class="category-img-box">
              <img src="assets/images/icons/watch.svg" alt="watch" width="30">
            </div>

            <div class="category-content-box">

              <div class="category-content-flex">
                <h3 class="category-item-title">Watch</h3>

                <p class="category-item-amount">(27)</p>
              </div>

              <a href="other pages/Categories/mens-accessories/watches.htm" class="category-btn">Show all</a>

            </div>

          </div>

          <div class="category-item">

            <div class="category-img-box">
              <img src="assets/images/icons/shoes.svg" alt="Shoes" width="30">
            </div>

            <div class="category-content-box">

              <div class="category-content-flex">
                <h3 class="category-item-title">Shoes</h3>

                <p class="category-item-amount">(39)</p>
              </div>

              <a href="other pages/Categories/mens-accessories/shoes.php" class="category-btn">Show all</a>

            </div>

          </div>

        </div>

      </div>

    </div>




    <!--
      - PRODUCT
    -->

    <div class="product-container">

      <div class="container">


        <!--
          - SIDEBAR
        -->

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
        <img src="assets/images/icons/jewelry.svg" alt="jewellery" width="20" height="20" class="menu-title-img">
        <p class="menu-title">Jewellery</p>
      </div>
      <div>
        <ion-icon name="add-outline" class="add-icon"></ion-icon>
        <ion-icon name="remove-outline" class="remove-icon"></ion-icon>
      </div>
    </button>
    <ul class="sidebar-submenu-category-list" data-accordion="">
      <li class="sidebar-submenu-category"><a href="other pages/Categories/jewellery/earring.php" class="sidebar-submenu-title"><p class="product-name">Earrings</p></a></li>
      <li class="sidebar-submenu-category"><a href="other pages/Categories/jewellery/couplerings.php" class="sidebar-submenu-title"><p class="product-name">Couple Rings</p></a></li>
      <li class="sidebar-submenu-category"><a href="other pages/Categories/jewellery/necklace.php" class="sidebar-submenu-title"><p class="product-name">Necklace</p></a></li>
      <li class="sidebar-submenu-category"><a href="other pages/Categories/jewellery/bracelet.php" class="sidebar-submenu-title"><p class="product-name">Bracelets</p></a></li>
    </ul>
  </li>

  <!-- Perfumes -->
  <li class="sidebar-menu-category">
    <button class="sidebar-accordion-menu" data-accordion-btn="">
      <div class="menu-title-flex">
        <img src="assets/images/icons/perfume.svg" alt="perfumes" width="20" height="20" class="menu-title-img">
        <p class="menu-title">Perfumes</p>
      </div>
      <div>
        <ion-icon name="add-outline" class="add-icon"></ion-icon>
        <ion-icon name="remove-outline" class="remove-icon"></ion-icon>
      </div>
    </button>
    <ul class="sidebar-submenu-category-list" data-accordion="">
      <li class="sidebar-submenu-category"><a href="other pages/Categories/perfumes/floral.php" class="sidebar-submenu-title"><p class="product-name">Floral</p></a></li>
      <li class="sidebar-submenu-category"><a href="other pages/Categories/perfumes/oriental.php" class="sidebar-submenu-title"><p class="product-name">Oriental</p></a></li>
      <li class="sidebar-submenu-category"><a href="other pages/Categories/perfumes/woody.php" class="sidebar-submenu-title"><p class="product-name">Woody</p></a></li>
      <li class="sidebar-submenu-category"><a href="other pages/Categories/perfumes/fougere.php" class="sidebar-submenu-title"><p class="product-name">Fougère</p></a></li>
    </ul>
  </li>

  <!-- Men's -->
  <li class="sidebar-menu-category">
    <button class="sidebar-accordion-menu" data-accordion-btn="">
      <div class="menu-title-flex">
        <img src="assets/images/icons/shoes.svg" alt="men's" width="20" height="20" class="menu-title-img">
        <p class="menu-title">Men's</p>
      </div>
      <div>
        <ion-icon name="add-outline" class="add-icon"></ion-icon>
        <ion-icon name="remove-outline" class="remove-icon"></ion-icon>
      </div>
    </button>
    <ul class="sidebar-submenu-category-list" data-accordion="">
      <li class="sidebar-submenu-category"><a href="other pages/Categories/mens/sunglasses.php" class="sidebar-submenu-title"><p class="product-name">Sun Glasses</p></a></li>
      <li class="sidebar-submenu-category"><a href="other pages/Categories/mens/watches.htm" class="sidebar-submenu-title"><p class="product-name">Watches</p></a></li>
      <li class="sidebar-submenu-category"><a href="other pages/Categories/mens/wallets.php" class="sidebar-submenu-title"><p class="product-name">Wallets</p></a></li>
      <li class="sidebar-submenu-category"><a href="other pages/Categories/mens/shoes.php" class="sidebar-submenu-title"><p class="product-name">Shoes</p></a></li>
    </ul>
  </li>

  <!-- Women's -->
  <li class="sidebar-menu-category">
    <button class="sidebar-accordion-menu" data-accordion-btn="">
      <div class="menu-title-flex">
        <img src="assets/images/icons/jewelry.svg" alt="women's" width="20" height="20" class="menu-title-img">
        <p class="menu-title">Women's</p>
      </div>
      <div>
        <ion-icon name="add-outline" class="add-icon"></ion-icon>
        <ion-icon name="remove-outline" class="remove-icon"></ion-icon>
      </div>
    </button>
    <ul class="sidebar-submenu-category-list" data-accordion="">
      <li class="sidebar-submenu-category"><a href="other pages/Categories/womens/lipstick.php" class="sidebar-submenu-title"><p class="product-name">Lipstick</p></a></li>
      <li class="sidebar-submenu-category"><a href="other pages/Categories/womens/eyeliner.php" class="sidebar-submenu-title"><p class="product-name">Eyeliner</p></a></li>
      <li class="sidebar-submenu-category"><a href="other pages/Categories/womens/primer.php" class="sidebar-submenu-title"><p class="product-name">Primer</p></a></li>
      <li class="sidebar-submenu-category"><a href="other pages/Categories/womens/mascara.php" class="sidebar-submenu-title"><p class="product-name">Mascara</p></a></li>
    </ul>
  </li>

  <!-- Electronics -->
  <li class="sidebar-menu-category">
    <button class="sidebar-accordion-menu" data-accordion-btn="">
      <div class="menu-title-flex">
        <img src="assets/images/icons/electronics.svg" alt="electronics" width="20" height="20" class="menu-title-img">
        <p class="menu-title">Electronics</p>
      </div>
      <div>
        <ion-icon name="add-outline" class="add-icon"></ion-icon>
        <ion-icon name="remove-outline" class="remove-icon"></ion-icon>
      </div>
    </button>
    <ul class="sidebar-submenu-category-list" data-accordion="">
      <li class="sidebar-submenu-category"><a href="other pages/Categories/electronics/sw.php" class="sidebar-submenu-title"><p class="product-name">Smart Watch</p></a></li>
      <li class="sidebar-submenu-category"><a href="other pages/Categories/electronics/stv.php" class="sidebar-submenu-title"><p class="product-name">Smart TV</p></a></li>
      <li class="sidebar-submenu-category"><a href="other pages/Categories/electronics/mouse.php" class="sidebar-submenu-title"><p class="product-name">Mouse</p></a></li>
      <li class="sidebar-submenu-category"><a href="other pages/Categories/electronics/microphone.php" class="sidebar-submenu-title"><p class="product-name">Microphone</p></a></li>
    </ul>
  </li>

</ul>

</div>


          <div class="product-showcase">

            <h3 class="showcase-heading">best sellers</h3>

            <div class="showcase-wrapper">

              

            </div>

          </div>

        </div>



        <div class="product-box">

          <!--
            - PRODUCT MINIMAL
          -->

          <div class="product-minimal">

            <div class="product-showcase">

              <h2 class="title">New Arrivals</h2>

              <div class="showcase-wrapper has-scrollbar">

                <div class="showcase-container">

                  <div class="showcase">

                    <a href="other pages/Categories/mens-collection/formal.php" class="showcase-img-box">
                      <img src="assets/images/products/jacket-1.jpg" alt="relaxed short full sleeve t-shirt" width="70" class="showcase-img">
                    </a>

                    <div class="showcase-content">

                      <a href="other pages/Categories/mens-collection/formal.php">
                        <h4 class="showcase-title">Classic Black Suit</h4>
                      </a>

                      <a href="other pages/Categories/mens-collection/formal.php" class="showcase-brand">Clothes</a>

                      <div class="price-box">
                        <p class="price">$45.00</p>
                        <del>$12.00</del>
                      </div>

                    </div>

                  </div>

                  <div class="showcase">
                  
                    <a href="other pages/Categories/mens-collection/formal.php" class="showcase-img-box">
                      <img src="assets/images/products/jacket-2.jpg" alt="girls pink embro design top" class="showcase-img" width="70">
                    </a>
                  
                    <div class="showcase-content">
                  
                      <a href="other pages/Categories/mens-collection/formal.php">
                        <h4 class="showcase-title">Goochi Gang Hoodie</h4>
                      </a>
                  
                      <a href="other pages/Categories/mens-collection/formal.php" class="showcase-brand">Clothes</a>
                  
                      <div class="price-box">
                        <p class="price">$61.00</p>
                        <del>$9.00</del>
                      </div>
                  
                    </div>
                  
                  </div>

                  <div class="showcase">
                  
                    <a href="" class="showcase-img-box">
                      <img src="assets/images/products/jacket-4.jpg" alt="black floral wrap midi skirt" class="showcase-img"
                        width="70">
                    </a>
                  
                    <div class="showcase-content">
                  
                      <a href="other pages/Categories/mens-collection/formal.php">
                        <h4 class="showcase-title">Backstreet Boys Collection Jacket</h4>
                      </a>
                  
                      <a href="other pages/Categories/mens-collection/formal.php" class="showcase-brand">Clothes</a>
                  
                      <div class="price-box">
                        <p class="price">$76.00</p>
                        <del>$25.00</del>
                      </div>
                  
                    </div>
                  
                  </div>

                  <div class="showcase">
                  
                    <a href="other pages/Categories/mens-collection/formal.php" class="showcase-img-box">
                      <img src="assets/images/products/shirt-1.jpg" alt="pure garment dyed cotton shirt" class="showcase-img"
                        width="70">
                    </a>
                  
                    <div class="showcase-content">
                  
                      <a href="other pages/Categories/mens-collection/formal.php">
                        <h4 class="showcase-title">Pure Garment Dyed Cotton Shirt</h4>
                      </a>
                  
                      <a href="other pages/Categories/mens-collection/formal.php" class="showcase-brand">Mens Fashion</a>
                  
                      <div class="price-box">
                        <p class="price">$68.00</p>
                        <del>$31.00</del>
                      </div>
                  
                    </div>
                  
                  </div>

                </div>

                <div class="showcase-container">
                
                  <div class="showcase">
                
                    <a href="other pages/Categories/mens-collection/formal.php" class="showcase-img-box">
                      <img src="assets/images/products/jacket-5.jpg" alt="men yarn fleece full-zip jacket" class="showcase-img"
                        width="70">
                    </a>
                
                    <div class="showcase-content">
                
                      <a href="other pages/Categories/mens-collection/formal.php">
                        <h4 class="showcase-title">MEN Yarn Fleece Full-Zip Jacket</h4>
                      </a>
                
                      <a href="other pages/Categories/mens-collection/formal.php" class="showcase-brand">Winter wear</a>
                
                      <div class="price-box">
                        <p class="price">$61.00</p>
                        <del>$11.00</del>
                      </div>
                
                    </div>
                
                  </div>
                
                  <div class="showcase">
                
                    <a href="other pages/Categories/mens-collection/formal.php" class="showcase-img-box">
                      <img src="assets/images/products/jacket-1.jpg" alt="mens winter leathers jackets" class="showcase-img"
                        width="70">
                    </a>
                
                    <div class="showcase-content">
                
                      <a href="other pages/Categories/mens-collection/formal.php">
                        <h4 class="showcase-title">Mens Winter Leathers Jackets</h4>
                      </a>
                
                      <a href="other pages/Categories/mens-collection/formal.php" class="showcase-brand">Winter wear</a>
                
                      <div class="price-box">
                        <p class="price">$32.00</p>
                        <del>$20.00</del>
                      </div>
                
                    </div>
                
                  </div>
                
                  <div class="showcase">
                
                    <a href="other pages/Categories/mens-collection/formal.php" class="showcase-img-box">
                      <img src="assets/images/products/jacket-3.jpg" alt="mens winter leathers jackets" class="showcase-img"
                        width="70">
                    </a>
                
                    <div class="showcase-content">
                
                      <a href="other pages/Categories/mens-collection/formal.php">
                        <h4 class="showcase-title">Mens Winter Leathers Jackets</h4>
                      </a>
                
                      <a href="other pages/Categories/mens-collection/formal.php" class="showcase-brand">Jackets</a>
                
                      <div class="price-box">
                        <p class="price">$50.00</p>
                        <del>$25.00</del>
                      </div>
                
                    </div>
                
                  </div>
                
                  <div class="showcase">
                
                    <a href="other pages/Categories/mens-collection/formal.php" class="showcase-img-box">
                      <img src="assets/images/products/shorts-1.jpg" alt="better basics french terry sweatshorts" class="showcase-img"
                        width="70">
                    </a>
                
                    <div class="showcase-content">
                
                      <a href="other pages/Categories/mens-collection/formal.php">
                        <h4 class="showcase-title">Better Basics French Terry Sweatshorts</h4>
                      </a>
                
                      <a href="other pages/Categories/mens-collection/formal.php" class="showcase-brand">Shorts</a>
                
                      <div class="price-box">
                        <p class="price">$20.00</p>
                        <del>$10.00</del>
                      </div>
                
                    </div>
                
                  </div>
                
                </div>

              </div>

            </div>

            <div class="product-showcase">
            
              <h2 class="title">Trending</h2>
            
              <div class="showcase-wrapper  has-scrollbar">
            
                <div class="showcase-container">
            
                  <div class="showcase">
            
                    <a href="other pages/Categories/mens-accessories/shoes.php" class="showcase-img-box">
                      <img src="assets/images/products/sports-1.jpg" alt="running & trekking shoes - white" class="showcase-img"
                        width="70">
                    </a>
            
                    <div class="showcase-content">
            
                      <a href="other pages/Categories/mens-accessories/shoes.php">
                        <h4 class="showcase-title">Running & Trekking Shoes - White</h4>
                      </a>
            
                      <a href="other pages/Categories/mens-accessories/shoes.php" class="showcase-brand">Sports</a>
            
                      <div class="price-box">
                        <p class="price">$49.00</p>
                        <del>$15.00</del>
                      </div>
            
                    </div>
            
                  </div>
            
                  <div class="showcase">
            
                    <a href="other pages/Categories/mens-accessories/shoes.php" class="showcase-img-box">
                      <img src="assets/images/products/sports-2.jpg" alt="trekking & running shoes - black" class="showcase-img"
                        width="70">
                    </a>
            
                    <div class="showcase-content">
            
                      <a href="other pages/Categories/mens-accessories/shoes.php">
                        <h4 class="showcase-title">Trekking & Running Shoes - black</h4>
                      </a>
            
                      <a href="other pages/Categories/mens-accessories/shoes.php" class="showcase-brand">Sports</a>
            
                      <div class="price-box">
                        <p class="price">$78.00</p>
                        <del>$36.00</del>
                      </div>
            
                    </div>
            
                  </div>
            
                  <div class="showcase">
            
                    <a href="other pages/Categories/mens-accessories/shoes.php" class="showcase-img-box">
                      <img src="assets/images/products/party-wear-1.jpg" alt="womens party wear shoes" class="showcase-img"
                        width="70">
                    </a>
            
                    <div class="showcase-content">
            
                      <a href="other pages/Categories/mens-accessories/shoes.php">
                        <h4 class="showcase-title">Womens Party Wear Shoes</h4>
                      </a>
            
                      <a href="other pages/Categories/mens-accessories/shoes.php" class="showcase-brand">Party wear</a>
            
                      <div class="price-box">
                        <p class="price">$94.00</p>
                        <del>$42.00</del>
                      </div>
            
                    </div>
            
                  </div>
            
                  <div class="showcase">
            
                    <a href="other pages/Categories/mens-accessories/shoes.php" class="showcase-img-box">
                      <img src="assets/images/products/sports-3.jpg" alt="sports claw women's shoes" class="showcase-img"
                        width="70">
                    </a>
            
                    <div class="showcase-content">
            
                      <a href="other pages/Categories/mens-accessories/shoes.php">
                        <h4 class="showcase-title">Sports Claw Women's Shoes</h4>
                      </a>
            
                      <a href="other pages/Categories/mens-accessories/shoes.php" class="showcase-brand">Sports</a>
            
                      <div class="price-box">
                        <p class="price">$54.00</p>
                        <del>$65.00</del>
                      </div>
            
                    </div>
            
                  </div>
            
                </div>
            
                <div class="showcase-container">
            
                  <div class="showcase">
            
                    <a href="other pages/Categories/mens-accessories/shoes.php" class="showcase-img-box">
                      <img src="assets/images/products/sports-6.jpg" alt="air tekking shoes - white" class="showcase-img"
                        width="70">
                    </a>
            
                    <div class="showcase-content">
            
                      <a href="other pages/Categories/mens-accessories/shoes.php">
                        <h4 class="showcase-title">Air Trekking Shoes - white</h4>
                      </a>
            
                      <a href="other pages/Categories/mens-accessories/shoes.php" class="showcase-brand">Sports</a>
            
                      <div class="price-box">
                        <p class="price">$52.00</p>
                        <del>$55.00</del>
                      </div>
            
                    </div>
            
                  </div>
            
                  <div class="showcase">
            
                    <a href="other pages/Categories/mens-accessories/shoes.php" class="showcase-img-box">
                      <img src="assets/images/products/shoe-3.jpg" alt="Boot With Suede Detail" class="showcase-img" width="70">
                    </a>
            
                    <div class="showcase-content">
            
                      <a href="other pages/Categories/mens-accessories/shoes.php">
                        <h4 class="showcase-title">Boot With Suede Detail</h4>
                      </a>
            
                      <a href="other pages/Categories/mens-accessories/shoes.php" class="showcase-brand">boots</a>
            
                      <div class="price-box">
                        <p class="price">$20.00</p>
                        <del>$30.00</del>
                      </div>
            
                    </div>
            
                  </div>
            
                  <div class="showcase">
            
                    <a href="other pages/Categories/mens-accessories/shoes.php" class="showcase-img-box">
                      <img src="assets/images/products/shoe-1.jpg" alt="men's leather formal wear shoes" class="showcase-img"
                        width="70">
                    </a>
            
                    <div class="showcase-content">
            
                      <a href="other pages/Categories/mens-accessories/shoes.php">
                        <h4 class="showcase-title">Men's Leather Formal Wear shoes</h4>
                      </a>
            
                      <a href="other pages/Categories/mens-accessories/shoes.php" class="showcase-brand">formal</a>
            
                      <div class="price-box">
                        <p class="price">$56.00</p>
                        <del>$78.00</del>
                      </div>
            
                    </div>
            
                  </div>
            
                  <div class="showcase">
            
                    <a href="other pages/Categories/mens-accessories/shoes.php" class="showcase-img-box">
                      <img src="assets/images/products/shoe-2.jpg" alt="casual men's brown shoes" class="showcase-img" width="70">
                    </a>
            
                    <div class="showcase-content">
            
                      <a href="other pages/Categories/mens-accessories/shoes.php">
                        <h4 class="showcase-title">Casual Men's Brown shoes</h4>
                      </a>
            
                      <a href="other pages/Categories/mens-accessories/shoes.php" class="showcase-brand">Casual</a>
            
                      <div class="price-box">
                        <p class="price">$50.00</p>
                        <del>$55.00</del>
                      </div>
            
                    </div>
            
                  </div>
            
                </div>
            
              </div>
            
            </div>

            <div class="product-showcase">
            
              <h2 class="title">Top Rated</h2>
            
              <div class="showcase-wrapper  has-scrollbar">
            
                <div class="showcase-container">
            
                  <div class="showcase">
            
                    <a href="other pages/Categories/mens-accessories/watches.htm" class="showcase-img-box">
                      <img src="assets/images/products/watch-3.jpg" alt="pocket watch leather pouch" class="showcase-img"
                        width="70">
                    </a>
            
                    <div class="showcase-content">
            
                      <a href="other pages/Categories/mens-accessories/watches.htm">
                        <h4 class="showcase-title">Pocket Watch Leather Pouch</h4>
                      </a>
            
                      <a href="other pages/Categories/mens-accessories/watches.htm" class="showcase-brand">Watches</a>
            
                      <div class="price-box">
                        <p class="price">$50.00</p>
                        <del>$34.00</del>
                      </div>
            
                    </div>
            
                  </div>
            
                  <div class="showcase">
            
                    <a href="other pages/Categories/jewellery/necklace.php" class="showcase-img-box">
                      <img src="assets/images/products/jewellery-3.jpg" alt="silver deer heart necklace" class="showcase-img"
                        width="70">
                    </a>
            
                    <div class="showcase-content">
            
                      <a href="other pages/Categories/jewellery/necklace.php">
                        <h4 class="showcase-title">Silver Deer Heart Necklace</h4>
                      </a>
            
                      <a href="other pages/Categories/jewellery/necklace.php" class="showcase-brand">Jewellery</a>
            
                      <div class="price-box">
                        <p class="price">$84.00</p>
                        <del>$30.00</del>
                      </div>
            
                    </div>
            
                  </div>
            
                  <div class="showcase">
            
                    <a href="other pages/Categories/perfumes/oriental.php" class="showcase-img-box">
                      <img src="assets/images/products/perfume.jpg" alt="titan 100 ml womens perfume" class="showcase-img"
                        width="70">
                    </a>
            
                    <div class="showcase-content">
            
                      <a href="other pages/Categories/perfumes/oriental.php">
                        <h4 class="showcase-title">Oriental 100 Ml Womens Perfume</h4>
                      </a>
            
                      <a href="other pages/Categories/perfumes/oriental.php" class="showcase-brand">Perfume</a>
            
                      <div class="price-box">
                        <p class="price">$42.00</p>
                        <del>$10.00</del>
                      </div>
            
                    </div>
            
                  </div>
            
                  <div class="showcase">
            
                    <a href="other pages/Categories/mens-accessories/wallets.php" class="showcase-img-box">
                      <img src="assets/images/products/wallet.png" alt="men's leather wallet" class="showcase-img"
                        width="70">
                    </a>
            
                    <div class="showcase-content">
            
                      <a href="other pages/Categories/mens-accessories/wallets.php">
                        <h4 class="showcase-title">Men's Leather wallet</h4>
                      </a>
            
                      <a href="other pages/Categories/mens-accessories/wallets.php" class="showcase-brand">Wallet</a>
            
                      <div class="price-box">
                        <p class="price">$24.00</p>
                        <del>$10.00</del>
                      </div>
            
                    </div>
            
                  </div>
            
                </div>
            
                <div class="showcase-container">
            
                  <div class="showcase">
            
                    <a href="other pages/Categories/jewellery/couplerings.php" class="showcase-img-box">
                      <img src="assets/images/products/jewellery-2.jpg" alt="platinum zircon classic ring" class="showcase-img"
                        width="70">
                    </a>
            
                    <div class="showcase-content">
            
                      <a href="other pages/Categories/jewellery/couplerings.php">
                        <h4 class="showcase-title">platinum Zircon Classic Ring</h4>
                      </a>
            
                      <a href="other pages/Categories/jewellery/couplerings.php" class="showcase-brand">jewellery</a>
            
                      <div class="price-box">
                        <p class="price">$62.00</p>
                        <del>$65.00</del>
                      </div>
            
                    </div>
            
                  </div>
            
                  <div class="showcase">
            
                    <a href="other pages/Categories/mens-accessories/watches.htm" class="showcase-img-box">
                      <img src="assets/images/products/watch-1.jpg" alt="smart watche vital plus" class="showcase-img" width="70">
                    </a>
            
                    <div class="showcase-content">
            
                      <a href="other pages/Categories/mens-accessories/watches.htm">
                        <h4 class="showcase-title">Smart watche Vital Plus</h4>
                      </a>
            
                      <a href="other pages/Categories/mens-accessories/watches.htm" class="showcase-brand">Watches</a>
            
                      <div class="price-box">
                        <p class="price">$56.00</p>
                        <del>$78.00</del>
                      </div>
            
                    </div>
            
                  </div>
            
                  <div class="showcase">
            
                    <a href="other pages/Categories/makeup/primer.php" class="showcase-img-box">
                      <img src="assets/images/products/shampoo.jpg" alt="Primer & Facewash" class="showcase-img"
                        width="70">
                    </a>
            
                    <div class="showcase-content">
            
                      <a href="other pages/Categories/makeup/primer.php">
                        <h4 class="showcase-title">Primer & Facewash</h4>
                      </a>
            
                      <a href="other pages/Categories/makeup/primer.php" class="showcase-brand">cosmetics</a>
            
                      <div class="price-box">
                        <p class="price">$20.00</p>
                        <del>$30.00</del>
                      </div>
            
                    </div>
            
                  </div>
            
                  <div class="showcase">
            
                    <a href="other pages/Categories/jewellery/earring.php" class="showcase-img-box">
                      <img src="assets/images/products/jewellery-1.jpg" alt="rose gold peacock earrings" class="showcase-img"
                        width="70">
                    </a>
            
                    <div class="showcase-content">
            
                      <a href="other pages/Categories/jewellery/earring.php">
                        <h4 class="showcase-title">Rose Gold Peacock Earrings</h4>
                      </a>
            
                      <a href="other pages/Categories/jewellery/earring.php" class="showcase-brand">jewellery</a>
            
                      <div class="price-box">
                        <p class="price">$20.00</p>
                        <del>$30.00</del>
                      </div>
            
                    </div>
            
                  </div>
            
                </div>
            
              </div>
            
            </div>

          </div>



          <!--
            - PRODUCT FEATURED
          -->

          <div class="product-featured">

            <h2 class="title">Deal of the day</h2>

            <div class="showcase-wrapper has-scrollbar">

              <div class="showcase-container">

                <div class="showcase">
                  
                  <div class="showcase-banner">
                    <img src="assets/images/products/shampoo.jpg" alt="shampoo, conditioner & facewash packs" class="showcase-img">
                  </div>

                  <div class="showcase-content">
                    
                    <div class="showcase-rating">
                      <ion-icon name="star"></ion-icon>
                      <ion-icon name="star"></ion-icon>
                      <ion-icon name="star"></ion-icon>
                      <ion-icon name="star-outline"></ion-icon>
                      <ion-icon name="star-outline"></ion-icon>
                    </div>

                    <a href="#">
                      <h3 class="showcase-title">shampoo, conditioner & facewash packs</h3>
                    </a>

                    <p class="showcase-desc">
                      Lorem ipsum dolor sit amet consectetur Lorem ipsum
                      dolor dolor sit amet consectetur Lorem ipsum dolor
                    </p>

                    <div class="price-box">
                      <p class="price">$150.00</p>

                      <del>$200.00</del>
                    </div>

                    <button class="add-cart-btn">add to cart</button>

                    <div class="showcase-status">
                      <div class="wrapper">
                        <p>
                          already sold: <b>20</b>
                        </p>

                        <p>
                          available: <b>40</b>
                        </p>
                      </div>

                      <div class="showcase-status-bar"></div>
                    </div>

                    <div class="countdown-box">

                      <p class="countdown-desc">
                        Hurry Up! Offer ends in:
                      </p>

                      <div class="countdown">

                        <div class="countdown-content">

                          <p class="display-number">360</p>

                          <p class="display-text">Days</p>

                        </div>

                        <div class="countdown-content">
                          <p class="display-number">24</p>
                          <p class="display-text">Hours</p>
                        </div>

                        <div class="countdown-content">
                          <p class="display-number">59</p>
                          <p class="display-text">Min</p>
                        </div>

                        <div class="countdown-content">
                          <p class="display-number">00</p>
                          <p class="display-text">Sec</p>
                        </div>

                      </div>

                    </div>

                  </div>

                </div>

              </div>

              <div class="showcase-container">
              
                <div class="showcase">
              
                  <div class="showcase-banner">
                    <img src="assets/images/products/jewellery-1.jpg" alt="Rose Gold diamonds Earring" class="showcase-img">
                  </div>
              
                  <div class="showcase-content">
              
                    <div class="showcase-rating">
                      <ion-icon name="star"></ion-icon>
                      <ion-icon name="star"></ion-icon>
                      <ion-icon name="star"></ion-icon>
                      <ion-icon name="star-outline"></ion-icon>
                      <ion-icon name="star-outline"></ion-icon>
                    </div>
              
                    <h3 class="showcase-title">
                      <a href="#" class="showcase-title">Rose Gold diamonds Earring</a>
                    </h3>
              
                    <p class="showcase-desc">
                      Lorem ipsum dolor sit amet consectetur Lorem ipsum
                      dolor dolor sit amet consectetur Lorem ipsum dolor
                    </p>
              
                    <div class="price-box">
                      <p class="price">$1990.00</p>
                      <del>$2000.00</del>
                    </div>
              
                    <button class="add-cart-btn">add to cart</button>
              
                    <div class="showcase-status">
                      <div class="wrapper">
                        <p> already sold: <b>15</b> </p>
              
                        <p> available: <b>40</b> </p>
                      </div>
              
                      <div class="showcase-status-bar"></div>
                    </div>
              
                    <div class="countdown-box">
              
                      <p class="countdown-desc">Hurry Up! Offer ends in:</p>
              
                      <div class="countdown">
                        <div class="countdown-content">
                          <p class="display-number">360</p>
                          <p class="display-text">Days</p>
                        </div>
              
                        <div class="countdown-content">
                          <p class="display-number">24</p>
                          <p class="display-text">Hours</p>
                        </div>
              
                        <div class="countdown-content">
                          <p class="display-number">59</p>
                          <p class="display-text">Min</p>
                        </div>
              
                        <div class="countdown-content">
                          <p class="display-number">00</p>
                          <p class="display-text">Sec</p>
                        </div>
                      </div>
              
                    </div>
              
                  </div>
              
                </div>
              
              </div>

            </div>

          </div>



          <!--
            - PRODUCT GRID
          -->

          <div class="product-main">

            <h2 class="title">New Products</h2>

              <div
                class="product-grid"
                data-category="mens-collection"
                data-subcategory="formal"
              >
                <!-- Products auto-load here -->
              </div>
          </div>

        </div>

      </div>

    </div>





    <!--
      - TESTIMONIALS, CTA & SERVICE
    -->

    <div>

      <div class="container">

        <div class="testimonials-box">

          <!--
            - TESTIMONIALS
          -->

          <div class="testimonial">

            <h2 class="title">testimonial</h2>

            <div class="testimonial-card">

              <img src="assets/images/testimonial-1.jpg" alt="alan doe" class="testimonial-banner" width="80" height="80">

              <p class="testimonial-name">Sarah Khan</p>

              <p class="testimonial-title">Founder of StyleVerse</p>

              <img src="assets/images/icons/quotes.svg" alt="quotation" class="quotation-img" width="26">

              <p class="testimonial-desc">
                This platform completely changed the way I shop online. The user experience is smooth, and the product quality exceeded my expectations
              </p>

            </div>

          </div>



          <!--
            - CTA
          -->

          <div class="cta-container">

            <img src="assets/images/cta-banner.jpg" alt="summer collection" class="cta-banner">

            <a href="#" class="cta-content">

              <p class="discount">25% Discount</p>

              <h2 class="cta-title">Summer collection</h2>

              <p class="cta-text">Starting @ $10</p>

              <button class="cta-btn">Shop now</button>

            </a>

          </div>



          <!--
            - SERVICE
          -->

          <div class="service">

            <h2 class="title">Our Services</h2>

            <div class="service-container">

              <a href="#" class="service-item">

                <div class="service-icon">
                  <ion-icon name="boat-outline"></ion-icon>
                </div>

                <div class="service-content">

                  <h3 class="service-title">Worldwide Delivery</h3>
                  <p class="service-desc">For Order Over $100</p>

                </div>

              </a>

              <a href="#" class="service-item">
              
                <div class="service-icon">
                  <ion-icon name="rocket-outline"></ion-icon>
                </div>
              
                <div class="service-content">
              
                  <h3 class="service-title">Next Day delivery</h3>
                  <p class="service-desc">UK Orders Only</p>
              
                </div>
              
              </a>

              <a href="#" class="service-item">
              
                <div class="service-icon">
                  <ion-icon name="call-outline"></ion-icon>
                </div>
              
                <div class="service-content">
              
                  <h3 class="service-title">Best Online Support</h3>
                  <p class="service-desc">Hours: 8AM - 11PM</p>
              
                </div>
              
              </a>

              <a href="#" class="service-item">
              
                <div class="service-icon">
                  <ion-icon name="arrow-undo-outline"></ion-icon>
                </div>
              
                <div class="service-content">
              
                  <h3 class="service-title">Return Policy</h3>
                  <p class="service-desc">Easy & Free Return</p>
              
                </div>
              
              </a>

              <a href="#" class="service-item">
              
                <div class="service-icon">
                  <ion-icon name="ticket-outline"></ion-icon>
                </div>
              
                <div class="service-content">
              
                  <h3 class="service-title">30% money back</h3>
                  <p class="service-desc">For Order Over $100</p>
              
                </div>
              
              </a>

            </div>

          </div>

        </div>

      </div>

    </div>





    <!--
      - BLOG
    -->

    <div class="blog">

      <div class="container">

        <div class="blog-container has-scrollbar">

<?php
// Fetch blogs from database
$statement = $pdo->prepare("SELECT * FROM blogs");
$statement->execute();
$blogs = $statement->fetchAll(PDO::FETCH_ASSOC);

foreach($blogs as $blog):
?>

<div class="blog-card">
          
<a href="other pages/blog-details.php?id=<?php echo $blog['id']; ?>">
              <img src="<?php echo $blog['blog_img']; ?>" alt="Curbside fashion Trends: How to Win the Pickup Battle."
                class="blog-banner" width="300">
            </a>
          
            <div class="blog-content">
          
              <a href="other pages/blog-details.php?id=<?php echo $blog['id']; ?>">
<?php echo $blog['blog_name']; ?></a>
          
              <h3>
                <a style="color: black;" href="other pages/blog-details.php?id=<?php echo $blog['id']; ?>">
<?php echo $blog['heading']; ?></a>
              </h3>
          
              <p class="blog-meta">
                By <cite><?php echo $blog['auther_name']; ?></cite> / <time datetime="2022-03-15"><?php echo $blog['date']; ?></time>
              </p>
          
            </div>
          
          </div>


<?php endforeach; ?>


        </div>

      </div>

    </div>

  </main>


  <!--
    - FOOTER
  -->
<?php 

include 'footer.php';
?>



    <!--
    - custom js link
  -->
    <script src="assets/js/script.js"></script>

    <!--
    - ionicon link
  -->
    <script
      type="module"
      src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"
    ></script>
    <script
      nomodule=""
      src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"
    ></script>

</body>

</html>

