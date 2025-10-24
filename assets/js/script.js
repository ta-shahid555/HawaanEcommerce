/**
 * Enhanced Cart Script with User-Specific Functionality
 * This script handles cart operations and integrates with the new cart system
 */
let cartManager;

// Load cart when page loads
document.addEventListener("DOMContentLoaded", function () {
  // Initialize cart manager
  cartManager = new CartManager();
  // Initialize cart display if on cart page
  if (window.location.pathname.includes("cart.php")) {
    loadCartPage();
  }

  // Listen for cart updates
  document.addEventListener("cartUpdated", function (e) {
    if (window.location.pathname.includes("cart.php")) {
      loadCartPage();
    }
  });
});

// Enhanced cart page loading
function loadCartPage() {
  if (!window.cartManager) {
    console.error("Cart manager not initialized");
    return;
  }

  const cart = cartManager.getCart();
  const cartItemsContainer = document.getElementById("cart-items");
  const emptyCartContainer = document.getElementById("empty-cart");

  if (cart.length === 0) {
    showEmptyCart();
  } else {
    showCartItems(cart);
    updateCartSummary();
  }
}

function showEmptyCart() {
  const cartItemsContainer = document.getElementById("cart-items");
  const emptyCartContainer = document.getElementById("empty-cart");
  const cartSummary = document.querySelector(".cart-summary");

  if (cartItemsContainer) cartItemsContainer.style.display = "none";
  if (emptyCartContainer) emptyCartContainer.style.display = "block";
  if (cartSummary) cartSummary.style.display = "none";
}

function showCartItems(cart) {
  const cartItemsContainer = document.getElementById("cart-items");
  const emptyCartContainer = document.getElementById("empty-cart");
  const cartSummary = document.querySelector(".cart-summary");

  if (cartItemsContainer) cartItemsContainer.style.display = "block";
  if (emptyCartContainer) emptyCartContainer.style.display = "none";
  if (cartSummary) cartSummary.style.display = "block";

  renderCartItems(cart);
}

function renderCartItems(cart) {
  const cartItemsContainer = document.getElementById("cart-items");
  if (!cartItemsContainer) return;

  cartItemsContainer.innerHTML = "";

  cart.forEach((item) => {
    const cartItemElement = createCartItemElement(item);
    cartItemsContainer.appendChild(cartItemElement);
  });
}

// Update renderCartItems function
function renderCartItems(cart) {
    const cartItemsContainer = document.getElementById('cart-items');
    if (!cartItemsContainer) return;
    
    cartItemsContainer.innerHTML = '';
    
    cart.forEach(item => {
        // Make sure to use correct property names
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

function increaseQuantity(productId, currentQuantity) {
  const newQuantity = currentQuantity + 1;
  updateCartQuantity(productId, newQuantity);
}

function decreaseQuantity(productId, currentQuantity) {
  if (currentQuantity <= 1) {
    removeFromCart(productId);
  } else {
    const newQuantity = currentQuantity - 1;
    updateCartQuantity(productId, newQuantity);
  }
}

// Enhanced product card click handling
function handleProductClick(productId) {
  localStorage.setItem("selectedProduct", productId);
  window.location.href = `/HawaanEcommerce/product-details.php?id=${productId}`;
}

// User authentication event handlers
function handleUserLogin() {
  // Dispatch custom event
  document.dispatchEvent(new CustomEvent("userLoggedIn"));
}

function handleUserLogout() {
  // Dispatch custom event
  document.dispatchEvent(new CustomEvent("userLoggedOut"));
}

// Enhanced notification system
function showNotification(message, type = "info") {
  if (window.cartManager) {
    cartManager.showNotification(message, type);
  } else {
    // Fallback notification
    const notification = document.createElement("div");
    notification.className = `notification-popup ${type}`;
    notification.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            background: ${
              type === "success"
                ? "#4CAF50"
                : type === "error"
                ? "#f44336"
                : "#2196F3"
            };
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
}


function removeCoupon() {
    cartManager.removeCoupon();
    showNotification('Coupon removed', 'info');
    document.getElementById('coupon-code').value = '';
    document.getElementById('remove-coupon-btn').style.display = 'none';
    document.getElementById('coupon-message').textContent = '';
    updateCartSummary();
}

// Load any existing coupon when page loads
document.addEventListener('DOMContentLoaded', function() {
    if (cartManager.getCoupon()) {
        document.getElementById('coupon-code').value = cartManager.getCoupon().code;
        document.getElementById('remove-coupon-btn').style.display = 'inline-block';
        updateCartSummary();
    }
});
// Checkout preparation
function prepareCheckoutData() {
  if (!window.cartManager) return null;

  const cart = cartManager.getCart();
  return cart.map((item) => ({
    id: item.id,
    name: item.name,
    price: item.price,
    quantity: item.quantity,
    category: item.category || "General",
    image: item.image,
  }));
}

// Export functions for global use
window.loadCartPage = loadCartPage;
window.updateCartSummary = updateCartSummary;
window.handleProductClick = handleProductClick;
window.handleUserLogin = handleUserLogin;
window.handleUserLogout = handleUserLogout;
window.prepareCheckoutData = prepareCheckoutData;
