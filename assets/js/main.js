      
'use strict';

// Global variables
let products = {};

// Initialize page
document.addEventListener('DOMContentLoaded', function() {
  initializeApp();
});

// Initialize the application
async function initializeApp() {
  try {
    await loadProductsFromJSON();
    
    // Check which page we're on
    const currentPage = window.location.pathname;
    
    if (currentPage.includes('cart.php')) {
      loadCartPage();
    } else {
      loadCategoryProducts();
    }
    
    // Initialize search functionality
    initSearch();
    
    // Render Deal of the Day
    renderDealOfTheDay();
    
  } catch (error) {
    console.error('Failed to initialize app:', error);
    showNotification('Failed to load products. Please refresh the page.', 'error');
  }
}

// Load products from JSON file
async function loadProductsFromJSON() {
  try {
    const response = await fetch('/HawaanEcommerce/data/products.json');
    if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
    products = await response.json();
  } catch (error) {
    console.error('Error loading products:', error);
    throw error;
  }
}

// Load products for current category
function loadCategoryProducts() {
  const path = window.location.pathname;
  const pathParts = path.split('/').filter(part => part);
  
  // Try to get category from data attributes first
  const categoryElement = document.querySelector('[data-category]');
  const subCategoryElement = document.querySelector('[data-subcategory]');
  
  let category, subCategory;
  
  if (categoryElement && subCategoryElement) {
    category = categoryElement.dataset.category;
    subCategory = subCategoryElement.dataset.subcategory;
  } 
  // Fallback to URL parsing
  else if (pathParts.length >= 4) {
    category = pathParts[pathParts.length-2];
    subCategory = pathParts[pathParts.length-1].replace('.php', '');
  }
  
  if (category && subCategory) {
    renderCategoryProducts(category, subCategory);
  } else {
    // If no category detected, show all products
    showAllProducts();
  }
}

// Render products for specific category
function renderCategoryProducts(category, subCategory) {
  const productContainer = document.querySelector('.product-grid');
  if (!productContainer) return;

  // Get products for current category/subcategory
  const categoryProducts = products[category];
  if (!categoryProducts) {
    showError(`No products found for category: ${category}`);
    return;
  }

  const subCategoryProducts = categoryProducts[subCategory];
  if (!subCategoryProducts || subCategoryProducts.length === 0) {
    showError(`No products found for subcategory: ${subCategory}`);
    return;
  }

  // Update page title
  updatePageTitle(category, subCategory);

  // Render products
  renderProducts(subCategoryProducts);
}

// Show all products (for search results or home page)
function showAllProducts() {
  const productContainer = document.querySelector('.product-grid');
  if (!productContainer) return;

  let allProducts = [];
  for (const category in products) {
    for (const subCategory in products[category]) {
      allProducts = allProducts.concat(products[category][subCategory]);
    }
  }

  renderProducts(allProducts);
}

// Update page title based on category
function updatePageTitle(category, subCategory) {
  const titleElement = document.querySelector('.title, h2.title');
  if (titleElement) {
    const formattedCategory = formatCategoryName(category);
    const formattedSubCategory = formatCategoryName(subCategory);
    titleElement.textContent = `${formattedCategory} - ${formattedSubCategory}`;
  }
}

// Format category names for display
function formatCategoryName(name) {
  return name.replace(/-/g, ' ')
             .replace(/\b\w/g, l => l.toUpperCase())
             .replace(/&/g, ' & ');
}

// Render array of products
function renderProducts(productsArray) {
  const productContainer = document.querySelector('.product-grid');
  if (!productContainer) return;

  productContainer.innerHTML = '';
  
  productsArray.forEach(product => {
    const productCard = createProductCard(product);
    productContainer.appendChild(productCard);
  });
}
// Find product by ID
function findProductById(productId) {
  for (const category in products) {
    for (const subCategory in products[category]) {
      const product = products[category][subCategory].find(p => p.id === productId);
      if (product) return product;
    }
  }
  return null;
}
function createProductCard(product) {
  const productDiv = document.createElement('div');
  productDiv.className = 'showcase';
  productDiv.setAttribute('data-product-id', product.id);
  productDiv.style.cursor = 'pointer';

  productDiv.addEventListener('click', function() {
    localStorage.setItem('selectedProduct', product.id);
    window.location.href = `/HawaanEcommerce/product-details.php?id=${product.id}`;
  });

  const discount = product.originalPrice ? 
    Math.round(((product.originalPrice - product.price) / product.originalPrice) * 100) : 0;

  productDiv.innerHTML = `
    <div class="showcase-banner">
      <img src="${product.image}" alt="${product.name}" width="300" class="product-img default">
      <img src="${product.hoverImage}" alt="${product.name}" width="300" class="product-img hover">
      
      ${discount > 0 ? `<p class="showcase-badge">${discount}%</p>` : ''}
      ${!product.inStock ? `<p class="showcase-badge angle black">Out of Stock</p>` : ''}
      
      <div class="showcase-actions">
        <button class="btn-action" onclick="event.stopPropagation(); window.location.href='/HawaanEcommerce/product-details.php?id=${product.id}'" title="View Details">
          <ion-icon name="eye-outline"></ion-icon>
        </button>
      </div>
    </div>
    
    <div class="showcase-content">
      <div class="product-brand">${product.brand || ''}</div>
      <h3 class="showcase-title">${product.name}</h3>
      <div class="product-description">${product.description ? product.description.substring(0, 60) + '...' : ''}</div>
      <div class="price-box">
        <p class="price">$${product.price.toFixed(2)}</p>
        ${product.originalPrice ? `<del>$${product.originalPrice.toFixed(2)}</del>` : ''}
      </div>
    </div>
  `;

  return productDiv;
}

// Cart page functions
function loadCartPage() {
  const cart = cartManager.getCart();
  const cartItemsContainer = document.getElementById('cart-items');
  const emptyCartContainer = document.getElementById('empty-cart');
  
  if (cart.length === 0) {
    if (cartItemsContainer) cartItemsContainer.style.display = 'none';
    if (emptyCartContainer) emptyCartContainer.style.display = 'block';
    const cartSummary = document.querySelector('.cart-summary');
    if (cartSummary) cartSummary.style.display = 'none';
  } else {
    if (cartItemsContainer) cartItemsContainer.style.display = 'block';
    if (emptyCartContainer) emptyCartContainer.style.display = 'none';
    const cartSummary = document.querySelector('.cart-summary');
    if (cartSummary) cartSummary.style.display = 'block';
    
    renderCartItems();
    updateCartSummary();
  }
  
  // Listen for cart updates
  document.addEventListener('cartUpdated', function(e) {
    loadCartPage();
  });
}

function renderCartItems() {
  const cart = cartManager.getCart();
  const cartItemsContainer = document.getElementById('cart-items');
  if (!cartItemsContainer) return;
  
  cartItemsContainer.innerHTML = '';
  
  cart.forEach(item => {
    const cartItemHTML = `
      <div class="cart-item" data-product-id="${item.id}">
        <img src="${item.image}" alt="${item.name}" class="cart-item-image">
        <div class="cart-item-details">
          <h3 class="cart-item-title">${item.name}</h3>
          <p class="cart-item-price">$${item.price.toFixed(2)}</p>
        </div>
        <div class="cart-item-controls">
          <div class="quantity-controls">
            <button class="qty-btn" onclick="updateCartQuantity('${item.id}', ${item.quantity - 1})">-</button>
            <input type="number" value="${item.quantity}" min="1" readonly>
            <button class="qty-btn" onclick="updateCartQuantity('${item.id}', ${item.quantity + 1})">+</button>
          </div>
          <button class="remove-btn" onclick="removeFromCart('${item.id}')">Remove</button>
        </div>
      </div>
    `;
    cartItemsContainer.innerHTML += cartItemHTML;
  });
}

function updateCartSummary() {
  const cart = cartManager.getCart();
  const subtotal = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
  const shipping = subtotal > 55 ? 0 : 5.00;
  const tax = subtotal * 0.08;
  const total = subtotal + shipping + tax;
  
  document.getElementById('subtotal').textContent = `$${subtotal.toFixed(2)}`;
  document.getElementById('shipping').textContent = shipping === 0 ? 'Free' : `$${shipping.toFixed(2)}`;
  document.getElementById('tax').textContent = `$${tax.toFixed(2)}`;
  document.getElementById('total').textContent = `$${total.toFixed(2)}`;
}

function proceedToCheckout() {
  const cart = cartManager.getCart();
  if (cart.length === 0) {
    showNotification('Your cart is empty!', 'error');
    return;
  }
  
  showNotification('Order placed successfully! Thank you for shopping with us.', 'success');
  clearCart();
  loadCartPage();
}

// Search functionality
function initSearch() {
  const searchField = document.querySelector('.search-field');
  const searchBtn = document.querySelector('.search-btn');
  
  if (!searchField) return;
  
  const performSearch = () => {
    const searchTerm = searchField.value.toLowerCase().trim();
    
    if (!searchTerm) {
      // Reload original category products if search is empty
      loadCategoryProducts();
      return;
    }
    
    let allProducts = [];
    for (const category in products) {
      for (const subCategory in products[category]) {
        allProducts = allProducts.concat(products[category][subCategory]);
      }
    }
    
    const filteredProducts = allProducts.filter(product => {
      return product.name.toLowerCase().includes(searchTerm) || 
             product.description.toLowerCase().includes(searchTerm) ||
             product.brand.toLowerCase().includes(searchTerm);
    });
    
    renderProducts(filteredProducts);
    
    // Show no results message if needed
    const productContainer = document.querySelector('.product-grid');
    const existingMessage = document.getElementById('no-results-message');
    
    if (filteredProducts.length === 0 && !existingMessage && productContainer) {
      const noResults = document.createElement('div');
      noResults.id = 'no-results-message';
      noResults.style.gridColumn = '1 / -1';
      noResults.style.textAlign = 'center';
      noResults.style.padding = '40px';
      noResults.innerHTML = `
        <h3>No products found for "${searchTerm}"</h3>
        <p>Try different search terms</p>
      `;
      productContainer.appendChild(noResults);
    } else if (filteredProducts.length > 0 && existingMessage) {
      existingMessage.remove();
    }
  };
  
  if (searchBtn) searchBtn.addEventListener('click', performSearch);
  searchField.addEventListener('keypress', (e) => e.key === 'Enter' && performSearch());
}

// Notification system
function showNotification(message, type = 'info') {
  const notification = document.createElement('div');
  notification.className = `notification-popup ${type}`;
  notification.style.cssText = `
    position: fixed;
    top: 40px;
    left: 50px;
    background: ${type === 'success' ? '#4CAF50' : type === 'error' ? '#f44336' : '#2196F3'};
    color: white;
    padding: 15px 20px;
    border-radius: 5px;
    z-index: 1000;
    font-size: 14px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
  `;
  notification.textContent = message;
  document.body.appendChild(notification);
  setTimeout(() => notification.remove(), 3000);
}

// Error display
function showError(message) {
  const productContainer = document.querySelector('.product-grid');
  if (productContainer) {
    productContainer.innerHTML = `
      <div class="error-message">
        <ion-icon name="alert-circle-outline"></ion-icon>
        <h3>${message}</h3>
        <p>Please check back later</p>
      </div>
    `;
  }
}

// Navigation
function navigateToCart() {
  window.location.href = '/HawaanEcommerce/cart.php';
}

// Product details page functions
function loadProductDetailsPage() {
  // Get product ID from URL parameter
  const urlParams = new URLSearchParams(window.location.search);
  const productId = urlParams.get('id') || localStorage.getItem('selectedProduct');
  
  if (!productId) {
    window.location.href = '/HawaanEcommerce/index.php';
    return;
  }
  
  const product = findProductById(productId);
  if (!product) {
    window.location.href = '/HawaanEcommerce/index.php';
    return;
  }
  
  // Update page content
  document.getElementById('product-name').textContent = product.name;
  document.getElementById('product-title').textContent = product.name;
  document.getElementById('current-price').textContent = `$${product.price.toFixed(2)}`;
  
  if (product.originalPrice) {
    document.getElementById('original-price').textContent = `$${product.originalPrice.toFixed(2)}`;
    const discount = Math.round(((product.originalPrice - product.price) / product.originalPrice) * 100);
    document.getElementById('discount-badge').textContent = `${discount}% OFF`;
  } else {
    document.getElementById('original-price').style.display = 'none';
    document.getElementById('discount-badge').style.display = 'none';
  }
  
  document.getElementById('product-desc').textContent = product.description;
  document.getElementById('main-product-image').src = product.image;
  
  // Set brand in breadcrumb
  const brandElement = document.getElementById('product-brand');
  if (brandElement && product.brand) {
    brandElement.textContent = product.brand;
  }
  
  // Set up quantity controls
  document.getElementById('quantity').addEventListener('change', function() {
    const value = parseInt(this.value);
    if (value < 1) this.value = 1;
    if (value > 10) this.value = 10;
  });
}

// Add to cart from product details
function addToCartFromDetails() {
  const urlParams = new URLSearchParams(window.location.search);
  const productId = urlParams.get('id');
  const quantity = parseInt(document.getElementById('quantity').value) || 1;
  
  const product = findProductById(productId);
  if (!product) {
    showNotification('Product not found!', 'error');
    return;
  }

  if (!product.inStock) {
    showNotification('Product is out of stock!', 'error');
    return;
  }

  cartManager.addToCart({
    product_id: productId,
    product_name: product.name,
    product_price: product.price,
    product_image: product.image,
    product_category: product.category || 'General',
    quantity: quantity
  });
}

// Filter Sidebar Functionality
document.addEventListener('DOMContentLoaded', function() {
  // Toggle filter sections
  const filterTitles = document.querySelectorAll('.filter-title');
  filterTitles.forEach(title => {
    title.addEventListener('click', function() {
      const section = this.parentElement;
      section.classList.toggle('active');
    });
  });

  // Close all filter sections when clicking outside
  document.addEventListener('click', function(e) {
    if (!e.target.closest('.filter-section') && !e.target.closest('.filter-toggle-btn')) {
      document.querySelectorAll('.filter-section').forEach(section => {
        section.classList.remove('active');
      });
    }
  });

  // Toggle filter sidebar on mobile
  const filterToggleBtn = document.querySelector('.filter-toggle-btn');
  const filterSidebar = document.querySelector('.filter-sidebar');
  const filterCloseBtn = document.querySelector('.filter-close-btn');

  if (filterToggleBtn && filterSidebar) {
    filterToggleBtn.addEventListener('click', function() {
      filterSidebar.classList.add('active');
    });
    
    if (filterCloseBtn) {
      filterCloseBtn.addEventListener('click', function() {
        filterSidebar.classList.remove('active');
      });
    }
  }
  
  // Price range slider
  const priceSlider = document.querySelector('.price-slider');
  const priceMin = document.querySelector('.price-min');
  const priceMax = document.querySelector('.price-max');
  
  if (priceSlider && priceMin && priceMax) {
    // Set initial values
    priceSlider.value = priceSlider.max;
    priceMin.value = 0;
    priceMax.value = priceSlider.max;
    
    // Update max price when slider changes
    priceSlider.addEventListener('input', function() {
      priceMax.value = this.value;
    });
    
    // Update slider when max price changes
    priceMax.addEventListener('input', function() {
      if (parseInt(this.value) > parseInt(priceSlider.max)) {
        this.value = priceSlider.max;
      }
      priceSlider.value = this.value;
    });
    
    // Validate min price
    priceMin.addEventListener('input', function() {
      if (parseInt(this.value) < 0) {
        this.value = 0;
      }
      if (parseInt(this.value) > parseInt(priceMax.value)) {
        this.value = priceMax.value;
      }
    });
  }
  
  // Apply filters
  const applyFiltersBtn = document.querySelector('.apply-filters');
  if (applyFiltersBtn) {
    applyFiltersBtn.addEventListener('click', function() {
      applyFilters();
    });
  }

  // Reset filters
  const resetFiltersBtn = document.querySelector('.reset-filters');
  if (resetFiltersBtn) {
    resetFiltersBtn.addEventListener('click', function() {
      resetFilters();
    });
  }
});

// Apply filters function
function applyFilters() {
  // Get selected ratings
  const selectedRatings = [];
  document.querySelectorAll('input[name="rating"]:checked').forEach(checkbox => {
    selectedRatings.push(parseInt(checkbox.value));
  });
  
  // Get selected brands
  const selectedBrands = [];
  document.querySelectorAll('input[name="brand"]:checked').forEach(checkbox => {
    selectedBrands.push(checkbox.id.replace('brand-', ''));
  });
  
  const minPrice = parseFloat(document.querySelector('.price-min')?.value) || 0;
  const maxPrice = parseFloat(document.querySelector('.price-max')?.value) || Infinity;
  
  // Filter products
  document.querySelectorAll('.showcase').forEach(product => {
    const productId = product.getAttribute('data-product-id');
    const productData = findProductById(productId);
    
    if (!productData) {
      product.style.display = 'none';
      return;
    }
    
    const productPrice = productData.price;
    const productRating = productData.rating;
    const productBrand = productData.brand;
    
    const priceMatch = productPrice >= minPrice && productPrice <= maxPrice;
    const ratingMatch = selectedRatings.length === 0 || selectedRatings.includes(productRating);
    const brandMatch = selectedBrands.length === 0 || 
                      selectedBrands.some(brand => productBrand.toLowerCase().includes(brand.toLowerCase()));
    
    if (priceMatch && ratingMatch && brandMatch) {
      product.style.display = 'block';
    } else {
      product.style.display = 'none';
    }
  });
  
  // Close sidebar on mobile
  const filterSidebar = document.querySelector('.filter-sidebar');
  if (window.innerWidth <= 1024 && filterSidebar) {
    filterSidebar.classList.remove('active');
  }
}

// Reset filters function
function resetFilters() {
  // Uncheck all checkboxes
  document.querySelectorAll('.filter-option input[type="checkbox"]').forEach(checkbox => {
    checkbox.checked = false;
  });
  
  // Reset price range
  const priceSlider = document.querySelector('.price-slider');
  const priceMin = document.querySelector('.price-min');
  const priceMax = document.querySelector('.price-max');
  
  if (priceSlider && priceMin && priceMax) {
    priceSlider.value = priceSlider.max;
    priceMin.value = 0;
    priceMax.value = priceSlider.max;
  }
  
  // Show all products
  document.querySelectorAll('.showcase').forEach(product => {
    product.style.display = 'block';
  });
}

// Search functionality
const searchField = document.querySelector('.search-field');
const searchBtn = document.querySelector('.search-btn');

function performSearch() {
  if (!searchField) return;
  
  const searchTerm = searchField.value.toLowerCase().trim();
  
  if (!searchTerm) {
    // Show all products if search is empty
    document.querySelectorAll('.showcase').forEach(product => {
      product.style.display = 'block';
    });
    // Remove any existing no-results message
    const noResults = document.getElementById('no-results-message');
    if (noResults) noResults.remove();
    return;
  }
  
  let foundMatches = false;
  
  // Search through all products
  document.querySelectorAll('.showcase').forEach(product => {
    const productId = product.getAttribute('data-product-id');
    const productData = findProductById(productId);
    
    if (!productData) {
      product.style.display = 'none';
      return;
    }
    
    const productName = productData.name.toLowerCase();
    const productBrand = productData.brand.toLowerCase();
    const productDesc = productData.description.toLowerCase();
    
    // Check if search term matches name, brand or description
    if (productName.includes(searchTerm) || 
        productBrand.includes(searchTerm) ||
        productDesc.includes(searchTerm)) {
      product.style.display = 'block';
      foundMatches = true;
    } else {
      product.style.display = 'none';
    }
  });
  
  // Handle no results
  const productGrid = document.querySelector('.product-grid');
  const existingMessage = document.getElementById('no-results-message');
  
  if (!foundMatches && !existingMessage && productGrid) {
    const noResults = document.createElement('div');
    noResults.id = 'no-results-message';
    noResults.style.gridColumn = '1 / -1';
    noResults.style.textAlign = 'center';
    noResults.style.padding = '40px';
    noResults.innerHTML = `
      <h3>No products found for "${searchTerm}"</h3>
      <p>Try different search terms</p>
    `;
    productGrid.appendChild(noResults);
  } else if (foundMatches && existingMessage) {
    existingMessage.remove();
  }
}

// Add event listeners for search
if (searchBtn) {
  searchBtn.addEventListener('click', performSearch);
}

if (searchField) {
  searchField.addEventListener('keypress', function(e) {
    if (e.key === 'Enter') {
      performSearch();
    }
  });
}

// featured product deals of the day

// Get featured products from all categories
function getFeaturedProducts() {
  let featuredProducts = [];
  
  // Loop through all categories and subcategories
  for (const category in products) {
    for (const subCategory in products[category]) {
      products[category][subCategory].forEach(product => {
        if (product.is_featured) {
          featuredProducts.push(product);
        }
      });
    }
  }
  
  // Shuffle array to get random order
  return shuffleArray(featuredProducts);
}

// Helper function to shuffle array
function shuffleArray(array) {
  for (let i = array.length - 1; i > 0; i--) {
    const j = Math.floor(Math.random() * (i + 1));
    [array[i], array[j]] = [array[j], array[i]];
  }
  return array;
}


// Render Deal of the Day section
function renderDealOfTheDay() {
  const featuredProducts = getFeaturedProducts();
  const dealContainer = document.querySelector('.product-featured .showcase-wrapper');
  
  if (!dealContainer || featuredProducts.length === 0) return;
  
  // Clear existing content
  dealContainer.innerHTML = '';
  
  // Take first 2 featured products (or adjust as needed)
  const productsToShow = featuredProducts.slice(0, 2);
  
  productsToShow.forEach(product => {
    const discount = product.originalPrice ? 
      Math.round(((product.originalPrice - product.price) / product.originalPrice) * 100) : 0;
    
    const dealHTML = `
      <div class="showcase-container">
        <div class="showcase">
          <div class="showcase-banner">
            <img src="${product.image}" alt="${product.name}" class="showcase-img">
          </div>
          
          <div class="showcase-content">
            <div class="showcase-rating">
              ${generateRatingStars(product.rating || 4)}
            </div>
            
            <h3 class="showcase-title">
              <a href="/HawaanEcommerce/product-details.php?id=${product.id}">${product.name}</a>
            </h3>
            
            <p class="showcase-desc">${product.description || 'Premium quality product'}</p>
            
            <div class="price-box">
              <p class="price">$${product.price.toFixed(2)}</p>
              ${product.originalPrice ? `<del>$${product.originalPrice.toFixed(2)}</del>` : ''}
            </div>
            
            <button class="add-cart-btn" onclick="addToCart('${product.id}')">add to cart</button>
            
            <div class="showcase-status">
              <div class="wrapper">
                <p>already sold: <b>${Math.floor(Math.random() * 20) + 5}</b></p>
                <p>available: <b>${Math.floor(Math.random() * 30) + 10}</b></p>
              </div>
              <div class="showcase-status-bar"></div>
            </div>
            
            <div class="countdown-box">
              <p class="countdown-desc">Hurry Up! Offer ends in:</p>
              <div class="countdown" data-countdown="${getNextMidnight()}"></div>
            </div>
          </div>
        </div>
      </div>
    `;
    
    dealContainer.insertAdjacentHTML('beforeend', dealHTML);
  });
  
  // Initialize countdown timers
  initCountdowns();
}

// Helper function to generate rating stars
function generateRatingStars(rating) {
  let stars = '';
  for (let i = 1; i <= 5; i++) {
    stars += `<ion-icon name="${i <= rating ? 'star' : 'star-outline'}"></ion-icon>`;
  }
  return stars;
}

// Get next midnight for countdown
function getNextMidnight() {
  const now = new Date();
  const midnight = new Date(
    now.getFullYear(),
    now.getMonth(),
    now.getDate() + 1,
    0, 0, 0
  );
  return midnight.toISOString();
}

// Initialize countdown timers
// Initialize countdown timers
function initCountdowns() {
  const countdownElements = document.querySelectorAll('.countdown');
  
  if (countdownElements.length === 0) {
    console.log('No countdown elements found');
    return;
  }

  countdownElements.forEach(countdownEl => {
    const endDate = new Date(countdownEl.dataset.countdown).getTime();
    
    // Create countdown structure if it doesn't exist
    if (!countdownEl.innerHTML.trim()) {
      countdownEl.innerHTML = `
        <div class="countdown-content">
          <p class="display-number days">00</p>
          <p class="display-text">Days</p>
        </div>
        <div class="countdown-content">
          <p class="display-number hours">00</p>
          <p class="display-text">Hours</p>
        </div>
        <div class="countdown-content">
          <p class="display-number minutes">00</p>
          <p class="display-text">Min</p>
        </div>
        <div class="countdown-content">
          <p class="display-number seconds">00</p>
          <p class="display-text">Sec</p>
        </div>
      `;
    }

    const timer = setInterval(() => {
      const now = new Date().getTime();
      const distance = endDate - now;
      
      if (distance < 0) {
        clearInterval(timer);
        countdownEl.innerHTML = '<p>Offer expired!</p>';
        return;
      }
      
      const days = Math.floor(distance / (1000 * 60 * 60 * 24));
      const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
      const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
      const seconds = Math.floor((distance % (1000 * 60)) / 1000);
      
      // Update the countdown display
      const daysEl = countdownEl.querySelector('.days');
      const hoursEl = countdownEl.querySelector('.hours');
      const minutesEl = countdownEl.querySelector('.minutes');
      const secondsEl = countdownEl.querySelector('.seconds');
      
      if (daysEl) daysEl.textContent = days.toString().padStart(2, '0');
      if (hoursEl) hoursEl.textContent = hours.toString().padStart(2, '0');
      if (minutesEl) minutesEl.textContent = minutes.toString().padStart(2, '0');
      if (secondsEl) secondsEl.textContent = seconds.toString().padStart(2, '0');
    }, 1000);
  });
}


// featured product deals of the day