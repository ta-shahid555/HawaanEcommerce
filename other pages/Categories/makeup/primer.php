<?php include($_SERVER['DOCUMENT_ROOT'].'/HawaanEcommerce/header.php'); ?>


    <!--
    - MAIN
  -->

    <main>
      <!--
      - BANNER
    -->
<?php include($_SERVER['DOCUMENT_ROOT'].'/HawaanEcommerce/slider.php'); ?>

      <!--
      - CATEGORY
    -->
      <!-- Search Bar Section -->
      <div class="header-search-container">
        <input
          type="search"
          name="search"
          class="search-field"
          placeholder="Enter your product name..."
          aria-label="Search for products"
        />
        <button class="search-btn" type="button" aria-label="Search">
          <ion-icon name="search-outline"></ion-icon>
        </button>
      </div>
      <!--
      - PRODUCT
    -->
      <button class="filter-toggle-btn">
        <ion-icon name="filter-outline"></ion-icon>
        <span>Filters</span>
      </button>
      <div class="product-container">
        <div class="container">
          <!--
          - SIDEBAR
        -->

          <div class="sidebar has-scrollbar" data-mobile-menu="">
            <div class="sidebar-category">
              <div class="sidebar-top">
                <h2 class="sidebar-title">Category</h2>
                <button class="sidebar-close-btn" data-mobile-menu-close-btn="">
                  <ion-icon
                    name="close-outline"
                    role="img"
                    class="md hydrated"
                    aria-label="close outline"
                  ></ion-icon>
                </button>
              </div>

              <ul class="sidebar-menu-category-list">
                <!-- Jewellery -->
                <li class="sidebar-menu-category">
                  <button class="sidebar-accordion-menu" data-accordion-btn="">
                    <div class="menu-title-flex">
                      <img
                        src="assets/images/icons/jewelry.svg"
                        alt="jewellery"
                        width="20"
                        height="20"
                        class="menu-title-img"
                      />
                      <p class="menu-title">Jewellery</p>
                    </div>
                    <div>
                      <ion-icon
                        name="add-outline"
                        class="add-icon md hydrated"
                        role="img"
                        aria-label="add outline"
                      ></ion-icon>
                      <ion-icon
                        name="remove-outline"
                        class="remove-icon md hydrated"
                        role="img"
                        aria-label="remove outline"
                      ></ion-icon>
                    </div>
                  </button>
                  <ul class="sidebar-submenu-category-list" data-accordion="">
                    <li class="sidebar-submenu-category">
                      <a
                        href="other pages/Categories/jewellery/earring.html"
                        class="sidebar-submenu-title"
                        ><p class="product-name">Earrings</p></a
                      >
                    </li>
                    <li class="sidebar-submenu-category">
                      <a
                        href="other pages/Categories/jewellery/couplerings.html"
                        class="sidebar-submenu-title"
                        ><p class="product-name">Couple Rings</p></a
                      >
                    </li>
                    <li class="sidebar-submenu-category">
                      <a
                        href="other pages/Categories/jewellery/necklace.html"
                        class="sidebar-submenu-title"
                        ><p class="product-name">Necklace</p></a
                      >
                    </li>
                    <li class="sidebar-submenu-category">
                      <a
                        href="other pages/Categories/jewellery/bracelet.html"
                        class="sidebar-submenu-title"
                        ><p class="product-name">Bracelets</p></a
                      >
                    </li>
                  </ul>
                </li>

                <!-- Perfumes -->
                <li class="sidebar-menu-category">
                  <button class="sidebar-accordion-menu" data-accordion-btn="">
                    <div class="menu-title-flex">
                      <img
                        src="assets/images/icons/perfume.svg"
                        alt="perfumes"
                        width="20"
                        height="20"
                        class="menu-title-img"
                      />
                      <p class="menu-title">Perfumes</p>
                    </div>
                    <div>
                      <ion-icon
                        name="add-outline"
                        class="add-icon md hydrated"
                        role="img"
                        aria-label="add outline"
                      ></ion-icon>
                      <ion-icon
                        name="remove-outline"
                        class="remove-icon md hydrated"
                        role="img"
                        aria-label="remove outline"
                      ></ion-icon>
                    </div>
                  </button>
                  <ul class="sidebar-submenu-category-list" data-accordion="">
                    <li class="sidebar-submenu-category">
                      <a
                        href="other pages/Categories/perfumes/floral.html"
                        class="sidebar-submenu-title"
                        ><p class="product-name">Floral</p></a
                      >
                    </li>
                    <li class="sidebar-submenu-category">
                      <a
                        href="other pages/Categories/perfumes/oriental.html"
                        class="sidebar-submenu-title"
                        ><p class="product-name">Oriental</p></a
                      >
                    </li>
                    <li class="sidebar-submenu-category">
                      <a
                        href="other pages/Categories/perfumes/woody.html"
                        class="sidebar-submenu-title"
                        ><p class="product-name">Woody</p></a
                      >
                    </li>
                    <li class="sidebar-submenu-category">
                      <a
                        href="other pages/Categories/perfumes/fougere.html"
                        class="sidebar-submenu-title"
                        ><p class="product-name">Fougère</p></a
                      >
                    </li>
                  </ul>
                </li>

                <!-- Men's -->
                <li class="sidebar-menu-category">
                  <button class="sidebar-accordion-menu" data-accordion-btn="">
                    <div class="menu-title-flex">
                      <img
                        src="assets/images/icons/shoes.svg"
                        alt="men's"
                        width="20"
                        height="20"
                        class="menu-title-img"
                      />
                      <p class="menu-title">Men's</p>
                    </div>
                    <div>
                      <ion-icon
                        name="add-outline"
                        class="add-icon md hydrated"
                        role="img"
                        aria-label="add outline"
                      ></ion-icon>
                      <ion-icon
                        name="remove-outline"
                        class="remove-icon md hydrated"
                        role="img"
                        aria-label="remove outline"
                      ></ion-icon>
                    </div>
                  </button>
                  <ul class="sidebar-submenu-category-list" data-accordion="">
                    <li class="sidebar-submenu-category">
                      <a
                        href="other pages/Categories/mens/sunglasses.html"
                        class="sidebar-submenu-title"
                        ><p class="product-name">Sun Glasses</p></a
                      >
                    </li>
                    <li class="sidebar-submenu-category">
                      <a
                        href="other pages/Categories/mens/watches.htm"
                        class="sidebar-submenu-title"
                        ><p class="product-name">Watches</p></a
                      >
                    </li>
                    <li class="sidebar-submenu-category">
                      <a
                        href="other pages/Categories/mens/wallets.html"
                        class="sidebar-submenu-title"
                        ><p class="product-name">Wallets</p></a
                      >
                    </li>
                    <li class="sidebar-submenu-category">
                      <a
                        href="other pages/Categories/mens/shoes.html"
                        class="sidebar-submenu-title"
                        ><p class="product-name">Shoes</p></a
                      >
                    </li>
                  </ul>
                </li>

                <!-- Women's -->
                <li class="sidebar-menu-category">
                  <button class="sidebar-accordion-menu" data-accordion-btn="">
                    <div class="menu-title-flex">
                      <img
                        src="assets/images/icons/jewelry.svg"
                        alt="women's"
                        width="20"
                        height="20"
                        class="menu-title-img"
                      />
                      <p class="menu-title">Women's</p>
                    </div>
                    <div>
                      <ion-icon
                        name="add-outline"
                        class="add-icon md hydrated"
                        role="img"
                        aria-label="add outline"
                      ></ion-icon>
                      <ion-icon
                        name="remove-outline"
                        class="remove-icon md hydrated"
                        role="img"
                        aria-label="remove outline"
                      ></ion-icon>
                    </div>
                  </button>
                  <ul class="sidebar-submenu-category-list" data-accordion="">
                    <li class="sidebar-submenu-category">
                      <a
                        href="other pages/Categories/womens/lipstick.html"
                        class="sidebar-submenu-title"
                        ><p class="product-name">Lipstick</p></a
                      >
                    </li>
                    <li class="sidebar-submenu-category">
                      <a
                        href="other pages/Categories/womens/eyeliner.html"
                        class="sidebar-submenu-title"
                        ><p class="product-name">Eyeliner</p></a
                      >
                    </li>
                    <li class="sidebar-submenu-category">
                      <a
                        href="other pages/Categories/womens/primer.html"
                        class="sidebar-submenu-title"
                        ><p class="product-name">Primer</p></a
                      >
                    </li>
                    <li class="sidebar-submenu-category">
                      <a
                        href="other pages/Categories/womens/mascara.html"
                        class="sidebar-submenu-title"
                        ><p class="product-name">Mascara</p></a
                      >
                    </li>
                  </ul>
                </li>

                <!-- Electronics -->
                <li class="sidebar-menu-category">
                  <button class="sidebar-accordion-menu" data-accordion-btn="">
                    <div class="menu-title-flex">
                      <img
                        src="assets/images/icons/electronics.svg"
                        alt="electronics"
                        width="20"
                        height="20"
                        class="menu-title-img"
                      />
                      <p class="menu-title">Electronics</p>
                    </div>
                    <div>
                      <ion-icon
                        name="add-outline"
                        class="add-icon md hydrated"
                        role="img"
                        aria-label="add outline"
                      ></ion-icon>
                      <ion-icon
                        name="remove-outline"
                        class="remove-icon md hydrated"
                        role="img"
                        aria-label="remove outline"
                      ></ion-icon>
                    </div>
                  </button>
                  <ul class="sidebar-submenu-category-list" data-accordion="">
                    <li class="sidebar-submenu-category">
                      <a
                        href="other pages/Categories/electronics/sw.html"
                        class="sidebar-submenu-title"
                        ><p class="product-name">Smart Watch</p></a
                      >
                    </li>
                    <li class="sidebar-submenu-category">
                      <a
                        href="other pages/Categories/electronics/stv.html"
                        class="sidebar-submenu-title"
                        ><p class="product-name">Smart TV</p></a
                      >
                    </li>
                    <li class="sidebar-submenu-category">
                      <a
                        href="other pages/Categories/electronics/mouse.html"
                        class="sidebar-submenu-title"
                        ><p class="product-name">Mouse</p></a
                      >
                    </li>
                    <li class="sidebar-submenu-category">
                      <a
                        href="other pages/Categories/electronics/microphone.html"
                        class="sidebar-submenu-title"
                        ><p class="product-name">Microphone</p></a
                      >
                    </li>
                  </ul>
                </li>
              </ul>
            </div>

            <div class="product-showcase">
              <h3 class="showcase-heading">best sellers</h3>

              <div class="showcase-wrapper">
                <div class="showcase-container">
                  <div class="showcase">
                    <a
                      href="other pages/Categories/mens-accessories/wallets.html"
                      class="showcase-img-box"
                    >
                      <img
                        src="assets/images/products/wallet.png"
                        alt="Men's Leather Wallet"
                        width="75"
                        height="75"
                        class="showcase-img"
                      />
                    </a>

                    <div class="showcase-content">
                      <a
                        href="other pages/Categories/mens-accessories/wallets.html"
                      >
                        <h4 class="showcase-title">Men's Leather Wallet</h4>
                      </a>

                      <div class="showcase-rating">
                        <ion-icon name="star"></ion-icon>
                        <ion-icon name="star"></ion-icon>
                        <ion-icon name="star"></ion-icon>
                        <ion-icon name="star"></ion-icon>
                        <ion-icon name="star"></ion-icon>
                      </div>

                      <div class="price-box">
                        <del>$24.00</del>
                        <p class="price">$10.00</p>
                      </div>
                    </div>
                  </div>

                  <div class="showcase">
                    <a
                      href="other pages/Categories/mens-collection/jackets.html"
                      class="showcase-img-box"
                    >
                      <img
                        src="assets/images/products/2.jpg"
                        alt="men's hoodies t-shirt"
                        class="showcase-img"
                        width="75"
                        height="75"
                      />
                    </a>

                    <div class="showcase-content">
                      <a
                        href="other pages/Categories/mens-collection/jackets.html"
                      >
                        <h4 class="showcase-title">men's hoodies t-shirt</h4>
                      </a>
                      <div class="showcase-rating">
                        <ion-icon name="star"></ion-icon>
                        <ion-icon name="star"></ion-icon>
                        <ion-icon name="star"></ion-icon>
                        <ion-icon name="star"></ion-icon>
                        <ion-icon name="star-half-outline"></ion-icon>
                      </div>

                      <div class="price-box">
                        <del>$17.00</del>
                        <p class="price">$7.00</p>
                      </div>
                    </div>
                  </div>

                  <div class="showcase">
                    <a
                      href="other pages/Categories/womens-collection/formal.html"
                      class="showcase-img-box"
                    >
                      <img
                        src="assets/images/products/3.jpg"
                        alt="girls t-shirt"
                        class="showcase-img"
                        width="75"
                        height="75"
                      />
                    </a>

                    <div class="showcase-content">
                      <a
                        href="other pages/Categories/womens-collection/formal.html"
                      >
                        <h4 class="showcase-title">girls t-shirt</h4>
                      </a>
                      <div class="showcase-rating">
                        <ion-icon name="star"></ion-icon>
                        <ion-icon name="star"></ion-icon>
                        <ion-icon name="star"></ion-icon>
                        <ion-icon name="star"></ion-icon>
                        <ion-icon name="star-half-outline"></ion-icon>
                      </div>

                      <div class="price-box">
                        <del>$5.00</del>
                        <p class="price">$3.00</p>
                      </div>
                    </div>
                  </div>

                  <div class="showcase">
                    <a
                      href="other pages/Categories/mens-accessories/watches.htm"
                      class="showcase-img-box"
                    >
                      <img
                        src="assets/images/products/watch-2.jpg"
                        alt="Smart Watch for men"
                        class="showcase-img"
                        width="75"
                        height="75"
                      />
                    </a>

                    <div class="showcase-content">
                      <a
                        href="other pages/Categories/mens-accessories/watches.htm"
                      >
                        <h4 class="showcase-title">Smart Watch for men</h4>
                      </a>
                      <div class="showcase-rating">
                        <ion-icon name="star"></ion-icon>
                        <ion-icon name="star"></ion-icon>
                        <ion-icon name="star"></ion-icon>
                        <ion-icon name="star"></ion-icon>
                        <ion-icon name="star"></ion-icon>
                      </div>

                      <div class="price-box">
                        <del>$15.00</del>
                        <p class="price">$12.00</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Add this inside your product-container div, before the product-box div -->
          <div class="filter-sidebar">
            <div class="filter-header">
              <h3>Filters</h3>
              <button class="filter-close-btn">
                <ion-icon name="close-outline"></ion-icon>
              </button>
            </div>

            <div class="filter-section">
              <div class="filter-title">
                <h4>Rating</h4>
                <ion-icon
                  name="chevron-down-outline"
                  class="toggle-icon"
                ></ion-icon>
              </div>
              <div class="filter-content">
                <div class="rating-options">
                  <div class="rating-option">
                    <input
                      type="checkbox"
                      id="rating-5"
                      name="rating"
                      value="5"
                    />
                    <label for="rating-5">
                      <span class="stars">
                        <ion-icon name="star"></ion-icon>
                        <ion-icon name="star"></ion-icon>
                        <ion-icon name="star"></ion-icon>
                        <ion-icon name="star"></ion-icon>
                        <ion-icon name="star"></ion-icon>
                      </span>
                      <span class="rating-text">& Up</span>
                    </label>
                  </div>
                  <div class="rating-option">
                    <input
                      type="checkbox"
                      id="rating-4"
                      name="rating"
                      value="4"
                    />
                    <label for="rating-4">
                      <span class="stars">
                        <ion-icon name="star"></ion-icon>
                        <ion-icon name="star"></ion-icon>
                        <ion-icon name="star"></ion-icon>
                        <ion-icon name="star"></ion-icon>
                        <ion-icon name="star-outline"></ion-icon>
                      </span>
                      <span class="rating-text">& Up</span>
                    </label>
                  </div>
                  <div class="rating-option">
                    <input
                      type="checkbox"
                      id="rating-3"
                      name="rating"
                      value="3"
                    />
                    <label for="rating-3">
                      <span class="stars">
                        <ion-icon name="star"></ion-icon>
                        <ion-icon name="star"></ion-icon>
                        <ion-icon name="star"></ion-icon>
                        <ion-icon name="star-outline"></ion-icon>
                        <ion-icon name="star-outline"></ion-icon>
                      </span>
                      <span class="rating-text">& Up</span>
                    </label>
                  </div>
                  <div class="rating-option">
                    <input
                      type="checkbox"
                      id="rating-2"
                      name="rating"
                      value="2"
                    />
                    <label for="rating-2">
                      <span class="stars">
                        <ion-icon name="star"></ion-icon>
                        <ion-icon name="star"></ion-icon>
                        <ion-icon name="star-outline"></ion-icon>
                        <ion-icon name="star-outline"></ion-icon>
                        <ion-icon name="star-outline"></ion-icon>
                      </span>
                      <span class="rating-text">& Up</span>
                    </label>
                  </div>
                  <div class="rating-option">
                    <input
                      type="checkbox"
                      id="rating-1"
                      name="rating"
                      value="1"
                    />
                    <label for="rating-1">
                      <span class="stars">
                        <ion-icon name="star"></ion-icon>
                        <ion-icon name="star-outline"></ion-icon>
                        <ion-icon name="star-outline"></ion-icon>
                        <ion-icon name="star-outline"></ion-icon>
                        <ion-icon name="star-outline"></ion-icon>
                      </span>
                      <span class="rating-text">& Up</span>
                    </label>
                  </div>
                </div>
              </div>
            </div>

            <div class="filter-section">
              <div class="filter-title">
                <h4>Price Range</h4>
                <ion-icon
                  name="chevron-down-outline"
                  class="toggle-icon"
                ></ion-icon>
              </div>
              <div class="filter-content">
                <div class="price-range">
                  <div class="price-inputs">
                    <input type="number" placeholder="Min" class="price-min" />
                    <span>-</span>
                    <input type="number" placeholder="Max" class="price-max" />
                  </div>
                  <input
                    type="range"
                    class="price-slider"
                    min="0"
                    max="500"
                    step="10"
                  />
                </div>
              </div>
            </div>

            <div class="filter-section">
              <div class="filter-title">
                <h4>Brand</h4>
                <ion-icon
                  name="chevron-down-outline"
                  class="toggle-icon"
                ></ion-icon>
              </div>
              <div class="filter-content">
                <div class="filter-option">
                  <input type="checkbox" id="brand-nike" name="brand" />
                  <label for="brand-nike">Nike</label>
                </div>
                <div class="filter-option">
                  <input type="checkbox" id="brand-adidas" name="brand" />
                  <label for="brand-adidas">Adidas</label>
                </div>
                <div class="filter-option">
                  <input type="checkbox" id="brand-apple" name="brand" />
                  <label for="brand-apple">apple</label>
                </div>
              </div>
            </div>

            <div class="filter-buttons">
              <button class="btn apply-filters">Apply Filters</button>
              <button class="btn reset-filters">Reset</button>
            </div>
          </div>

          <div class="product-box">
            <!--
            - PRODUCT GRID
          -->

            <div class="product-main">
              <h2 class="title">Primer</h2>

              <div
                class="product-grid"
                data-category="makeup"
                data-subcategory="primer"
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

      <div></div>
    </main>

    <!--
    - FOOTER
  -->
<?php include($_SERVER['DOCUMENT_ROOT'].'/HawaanEcommerce/footer.php'); ?>




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