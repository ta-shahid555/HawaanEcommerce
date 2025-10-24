<style>
  .tab-btn {
    padding: 10px 20px;
    border: none;
    background-color: #f1f1f1;
    cursor: pointer;
    margin-right: 5px;
  }

  .tab-btn.active {
    background-color: #007bff;
    color: white;
  }

  /* ✨ Fix for tab content visibility */
  .tab-pane {
    display: none;
  }

  .tab-pane.active {
    display: block;
  }
</style>

<?php
include 'header.php';

// Error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Get product ID from URL
$productId = $_GET['id'] ?? null;

if (!$productId) {
    header("Location: index.php");
    exit();
}

// Load products data
$jsonFile = __DIR__ . '/data/products.json';
if (!file_exists($jsonFile)) {
    die("Products file not found at: " . $jsonFile);
}

$productsJson = file_get_contents($jsonFile);
if ($productsJson === false) {
    die("Failed to read products file");
}

$productsData = json_decode($productsJson, true);
if (json_last_error() !== JSON_ERROR_NONE) {
    die("Invalid JSON data: " . json_last_error_msg());
}

$product = null;

// Find product in data
foreach ($productsData as $category => $subCategories) {
    foreach ($subCategories as $subCategory => $items) {
        foreach ($items as $item) {
            if (isset($item['id']) && $item['id'] === $productId) {
                $product = $item;
                break 3;
            }
        }
    }
}

if (!$product) {
    die("Product with ID $productId not found");
}

// Helper functions
function renderStars($rating) {
    $rating = floatval($rating);
    $output = '';
    $fullStars = floor($rating);
    $hasHalfStar = ($rating - $fullStars) >= 0.5;
    
    for ($i = 1; $i <= 5; $i++) {
        if ($i <= $fullStars) {
            $output .= '<ion-icon name="star"></ion-icon>';
        } elseif ($i == $fullStars + 1 && $hasHalfStar) {
            $output .= '<ion-icon name="star-half"></ion-icon>';
        } else {
            $output .= '<ion-icon name="star-outline"></ion-icon>';
        }
    }
    
    return $output;
}

function calculateDiscount($price, $originalPrice) {
    if (!$originalPrice || $originalPrice <= 0) return 0;
    return round((($originalPrice - $price) / $originalPrice) * 100);
}

function getColorCode($colorName) {
    $colorMap = [
        'black' => '#000000',
        'white' => '#FFFFFF',
        'red' => '#FF0000',
        'blue' => '#0000FF',
        'green' => '#008000',
        'yellow' => '#FFFF00',
        'pink' => '#FFC0CB',
        'purple' => '#800080',
        'gray' => '#808080',
        'grey' => '#808080',
        'brown' => '#8B4513',
        'navy' => '#000080',
        'gold' => '#FFD700',
        'silver' => '#C0C0C0',
        'rose gold' => '#E0BFB8',
        'rose' => '#E0BFB8',
        'tan' => '#D2B48C',
        'charcoal' => '#36454F',
        'burgundy' => '#800020',
        'khaki' => '#C3B091'
    ];
    
    $colorName = strtolower(trim($colorName));
    return $colorMap[$colorName] ?? '#CCCCCC';
}
?>

<main>
  <div class="product-details-container">
    <div class="container">
      <div class="breadcrumb">
        <a href="index.php">Home</a>
        <span>/</span>
        <span><?php echo htmlspecialchars($product['brand'] ?? 'Brand'); ?></span>
        <span>/</span>
        <span><?php echo htmlspecialchars($product['name']); ?></span>
      </div>

      <div class="product-details-content">
        <div class="product-images">
          <div class="main-image">
            <img id="main-product-image" src="<?php echo htmlspecialchars($product['image']); ?>" 
                 alt="<?php echo htmlspecialchars($product['name']); ?>" />
          </div>
          <div class="thumbnail-images">
            <img src="<?php echo htmlspecialchars($product['image']); ?>" 
                 alt="Thumbnail 1" class="thumbnail active" 
                 onclick="changeMainImage('<?php echo htmlspecialchars($product['image']); ?>', this)">
            <?php if (!empty($product['hoverImage'])): ?>
            <img src="<?php echo htmlspecialchars($product['hoverImage']); ?>" 
                 alt="Thumbnail 2" class="thumbnail" 
                 onclick="changeMainImage('<?php echo htmlspecialchars($product['hoverImage']); ?>', this)">
            <?php endif; ?>
          </div>
        </div>

        <div class="product-info">
          <h1><?php echo htmlspecialchars($product['name']); ?></h1>
          
          <div class="product-rating">
            <div class="stars" id="product-stars">
              <?php echo renderStars($product['rating'] ?? 0); ?>
            </div>
            <span class="rating-text">(<?php echo ($product['rating'] ?? 0); ?> out of 5)</span>
          </div>

          <div class="product-price">
            <span class="current-price">$<?php echo number_format($product['price'], 2); ?></span>
            <?php if (isset($product['originalPrice']) && $product['originalPrice'] > 0): ?>
            <span class="original-price">$<?php echo number_format($product['originalPrice'], 2); ?></span>
            <span class="discount-badge">
              <?php echo calculateDiscount($product['price'], $product['originalPrice']); ?>% OFF
            </span>
            <?php endif; ?>
          </div>

          <div class="product-description">
            <h3>Description</h3>
            <p><?php echo htmlspecialchars($product['description'] ?? 'No description available'); ?></p>
          </div>

          <div class="product-options">
            <?php if (!empty($product['sizes'])): ?>
            <div class="size-selector">
              <h4>Size:</h4>
              <div class="size-options">
                <?php foreach ($product['sizes'] as $index => $size): ?>
                <button class="size-btn <?php echo $index === 0 ? 'active' : ''; ?>" 
                        data-size="<?php echo htmlspecialchars($size); ?>">
                  <?php echo htmlspecialchars($size); ?>
                </button>
                <?php endforeach; ?>
              </div>
            </div>
            <?php endif; ?>

            <?php if (!empty($product['colors'])): ?>
            <div class="color-selector">
              <h4>Color:</h4>
              <div class="color-options">
                <?php foreach ($product['colors'] as $index => $color): ?>
                <button class="color-btn <?php echo $index === 0 ? 'active' : ''; ?>" 
                        data-color="<?php echo htmlspecialchars($color); ?>"
                        style="background-color: <?php echo getColorCode($color); ?>;
                               <?php echo strtolower($color) === 'white' ? 'border: 1px solid #ddd' : ''; ?>"
                        onclick="selectColor(this)">
                </button>
                <?php endforeach; ?>
              </div>
            </div>
            <?php endif; ?>
            
            <div class="quantity-selector">
              <h4>Quantity:</h4>
              <div class="quantity-controls">
                <button class="qty-btn" onclick="decreaseQuantity()">-</button>
                <input type="number" id="quantity" value="1" min="1" max="10" readonly>
                <button class="qty-btn" onclick="increaseQuantity()">+</button>
              </div>
            </div>
          </div>

          <div class="product-actions">
            <button class="add-to-cart-btn" onclick="addToCartFromDetails()">
              <ion-icon name="bag-add-outline"></ion-icon>
              Add to Cart
            </button>
            <button class="buy-now-btn" onclick="buyNow()">
              Buy Now
            </button>
          </div>

          <div class="product-features">
            <div class="feature">
              <ion-icon name="shield-checkmark-outline"></ion-icon>
              <span>1 Year Warranty</span>
            </div>
            <div class="feature">
              <ion-icon name="car-outline"></ion-icon>
              <span>Free Shipping</span>
            </div>
            <div class="feature">
              <ion-icon name="return-up-back-outline"></ion-icon>
              <span>30 Days Return</span>
            </div>
          </div>
        </div>
      </div>

      <div class="product-tabs">
        <div class="tab-buttons">
          <button class="tab-btn active" data-tab="description">Description</button>
          <button class="tab-btn" data-tab="specifications">Specifications</button>
          <button class="tab-btn" data-tab="reviews">Reviews</button>

        </div>

        <div class="tab-content">
          <div id="description-tab" class="tab-pane active">
            <h3>Product Description</h3>
            <p><?php echo htmlspecialchars($product['description'] ?? 'No detailed description available'); ?></p>
          </div>

          <div id="specifications-tab" class="tab-pane">
            <h3>Specifications</h3>
            <table class="specs-table">
              <tr>
                <td>Brand</td>
                <td><?php echo htmlspecialchars($product['brand'] ?? 'N/A'); ?></td>
              </tr>
              <tr>
                <td>Category</td>
                <td><?php echo htmlspecialchars($product['category'] ?? 'General'); ?></td>
              </tr>
              <?php if (!empty($product['sizes'])): ?>
              <tr>
                <td>Available Sizes</td>
                <td><?php echo implode(', ', array_map('htmlspecialchars', $product['sizes'])); ?></td>
              </tr>
              <?php endif; ?>
              <?php if (!empty($product['colors'])): ?>
              <tr>
                <td>Available Colors</td>
                <td><?php echo implode(', ', array_map('htmlspecialchars', $product['colors'])); ?></td>
              </tr>
              <?php endif; ?>
              <tr>
                <td>In Stock</td>
                <td><?php echo !empty($product['inStock']) ? 'Yes' : 'No'; ?></td>
              </tr>
            </table>
          </div>

          <div id="reviews-tab" class="tab-pane">
            <h3>Customer Reviews</h3>
            <div class="review-summary">
              <div class="average-rating">
                <span class="rating-number"><?php echo ($product['rating'] ?? 0); ?></span>
                <div class="rating-stars">
                  <?php echo renderStars($product['rating'] ?? 0); ?>
                </div>
                <span class="total-reviews">Based on sample reviews</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

<script>
// Global initialization when DOM is ready
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM fully loaded');
    initializeProductPage();
});

function initializeProductPage() {
    // Initialize thumbnail switching
    const thumbnails = document.querySelectorAll('.thumbnail');
    thumbnails.forEach(thumb => {
        thumb.addEventListener('click', function() {
            const newSrc = this.getAttribute('src');
            changeMainImage(newSrc, this);
        });
    });

    // Initialize color selection
    const colorButtons = document.querySelectorAll('.color-btn');
    colorButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            selectColor(this);
        });
    });

    // Initialize size selection
    const sizeButtons = document.querySelectorAll('.size-btn');
    sizeButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            selectSize(this);
        });
    });

    // Initialize tab switching
    const tabButtons = document.querySelectorAll('.tab-btn');
    tabButtons.forEach(btn => {
      btn.addEventListener('click', function() {
        const tabId = this.getAttribute('data-tab');
        showTab(tabId, this);
      });
    });

}

// Thumbnail image switching
function changeMainImage(newSrc, clickedThumb) {
    console.log('Changing main image to:', newSrc);
    const mainImage = document.getElementById('main-product-image');
    if (mainImage) {
        mainImage.src = newSrc;
        // Update active thumbnail
        document.querySelectorAll('.thumbnail').forEach(thumb => {
            thumb.classList.remove('active');
        });
        clickedThumb.classList.add('active');
    }
}

// Color selection
function selectColor(clickedButton) {
    console.log('Selected color:', clickedButton.getAttribute('data-color'));
    document.querySelectorAll('.color-btn').forEach(btn => {
        btn.classList.remove('active');
    });
    clickedButton.classList.add('active');
}

// Size selection
function selectSize(clickedButton) {
    console.log('Selected size:', clickedButton.getAttribute('data-size'));
    document.querySelectorAll('.size-btn').forEach(btn => {
        btn.classList.remove('active');
    });
    clickedButton.classList.add('active');
}

// Tab switching
function showTab(tabId, clickedBtn) {
    console.log('Showing tab:', tabId);

    // Hide all tab panes
    document.querySelectorAll('.tab-pane').forEach(pane => {
        pane.classList.remove('active');
    });

    // Deactivate all tab buttons
    document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.classList.remove('active');
    });

    // Show selected tab pane
    const tabPane = document.getElementById(tabId + '-tab');
    if (tabPane) {
        tabPane.classList.add('active');
    }

    // Activate clicked tab button
    if (clickedBtn) {
        clickedBtn.classList.add('active');
    }
}


// Quantity controls
function increaseQuantity() {
    const quantityInput = document.getElementById('quantity');
    if (quantityInput) {
        let value = parseInt(quantityInput.value);
        if (value < 10) {
            quantityInput.value = value + 1;
        }
    }
}

function decreaseQuantity() {
    const quantityInput = document.getElementById('quantity');
    if (quantityInput) {
        let value = parseInt(quantityInput.value);
        if (value > 1) {
            quantityInput.value = value - 1;
        }
    }
}

// Cart functions
function addToCartFromDetails() {
    const quantity = parseInt(document.getElementById('quantity').value) || 1;
    console.log('Adding to cart:', quantity);
    alert('Added to cart: ' + quantity + ' items');
}

function buyNow() {
    addToCartFromDetails();
    window.location.href = 'checkout.php';
}

// Make functions available globally
window.changeMainImage = changeMainImage;
window.selectColor = selectColor;
window.selectSize = selectSize;
window.showTab = showTab;
window.increaseQuantity = increaseQuantity;
window.decreaseQuantity = decreaseQuantity;
window.addToCartFromDetails = addToCartFromDetails;
window.buyNow = buyNow;
</script>

<?php include 'footer.php'; ?>