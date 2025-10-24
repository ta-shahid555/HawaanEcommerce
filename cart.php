<?php 
include($_SERVER['DOCUMENT_ROOT'].'/HawaanEcommerce/header.php'); 
?>

<main>
  <div class="cart-container">
    <div class="container">
      <div class="cart-header">
        <h1 class="cart-title">Shopping Cart</h1>
        <button class="back-btn" onclick="window.location.href='/HawaanEcommerce/index.php'">
          <ion-icon name="arrow-back-outline"></ion-icon>
          Continue Shopping
        </button>
      </div>

      <div class="cart-content">
        <div class="cart-items" id="cart-items">
          <!-- Cart items will be loaded here by JavaScript -->
        </div>

        <div class="cart-summary">
          <div class="summary-card">
            <h3 class="summary-title">Order Summary</h3>
            
            <!-- Add this coupon section -->
            <div class="coupon-section">
              <div class="coupon-input-group">
                <input type="text" id="coupon-code" placeholder="Enter coupon code">
                <button class="apply-coupon-btn" onclick="applyCoupon()">Apply</button>
              </div>
              <div id="coupon-message"></div>
            </div>
            
            <div class="summary-row">
              <span>Subtotal:</span>
              <span id="subtotal">$0.00</span>
            </div>
            
            <!-- Add this discount row -->
            <div class="summary-row discount-row" style="display: none;">
              <span>Discount:</span>
              <span id="discount">-$0.00</span>
            </div>
            
            <hr class="summary-divider">
            
            <div class="summary-row total">
              <span>Total:</span>
              <span id="total">$0.00</span>
            </div>
            
    <a href="/HawaanEcommerce/orders.php" onclick="passCouponToCheckout(event)">
        <button class="checkout-btn">Proceed to Checkout</button>
    </a>
            <button class="clear-cart-btn" onclick="clearCart()">Clear Cart</button>
          </div>
        </div>
      </div>

      <div class="empty-cart" id="empty-cart" style="display: none;">
        <div class="empty-cart-content">
          <ion-icon name="bag-outline" class="empty-cart-icon"></ion-icon>
          <h2>Your cart is empty</h2>
          <p>Looks like you haven't added anything to your cart yet.</p>
          <button class="shop-now-btn" onclick="window.location.href='/HawaanEcommerce/index.php'">
            Start Shopping
          </button>
        </div>
      </div>
    </div>
  </div>
</main>

<?php include($_SERVER['DOCUMENT_ROOT'].'/HawaanEcommerce/footer.php'); ?>

<script>
// Initialize cart manager and load any existing coupon
document.addEventListener('DOMContentLoaded', function() {
    // Load cart from API
    cartManager.loadCart();
    
    // Render cart on page load
    if (typeof loadCartPage === 'function') {
        loadCartPage();
    }
    
    // Check for existing coupon
    if (window.cartManager && window.cartManager.getCoupon()) {
        const coupon = window.cartManager.getCoupon();
        document.getElementById('coupon-code').value = coupon.code;
        document.querySelector('.discount-row').style.display = 'flex';
        updateCartSummary();
    }
    document.getElementById('apply-coupon-button').addEventListener('click', applyCoupon);
});
async function applyCoupon() {
    const couponCode = document.getElementById('coupon-code').value.trim();
    if (!couponCode) {
        showNotification('Please enter a coupon code', 'error');
        return;
    }

    try {
        const response = await fetch('/HawaanEcommerce/apply-coupon.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `coupon_code=${encodeURIComponent(couponCode)}`
        });
        
        const result = await response.json();
        
        if (result.success) {
            // Apply coupon to cart manager
            if (window.cartManager) {
                window.cartManager.applyCoupon(result.discount);
                showNotification(result.message, 'success');
                updateCartSummary();
                
                // Show discount row
                document.querySelector('.discount-row').style.display = 'flex';
                document.getElementById('coupon-message').textContent = '';
                
                // Store coupon in localStorage for orders.php
                localStorage.setItem('applied_coupon', JSON.stringify(result.discount));
            } else {
                showNotification('Cart manager not available', 'error');
            }
        } else {
            showNotification(result.message, 'error');
            document.getElementById('coupon-message').textContent = result.message;
        }
    } catch (error) {
        console.error('Error applying coupon:', error);
        showNotification('Failed to apply coupon', 'error');
    }
}

function updateCartSummary() {
    if (!window.cartManager) return;

    const cart = cartManager.getCart();
    const subtotal = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
    
    // Calculate discount properly
    let discountAmount = 0;
    const coupon = cartManager.getCoupon();
    
    if (coupon) {
        if (coupon.type === 'percentage') {
            discountAmount = (subtotal * coupon.amount) / 100;
        } else {
            discountAmount = coupon.amount;
        }
        // Ensure discount doesn't exceed subtotal
        discountAmount = Math.min(discountAmount, subtotal);
    }

    const total = subtotal - discountAmount

    // Update display
    document.getElementById('subtotal').textContent = `$${subtotal.toFixed(2)}`;
    document.getElementById('discount').textContent = `-$${discountAmount.toFixed(2)}`;
    document.getElementById('total').textContent = `$${total.toFixed(2)}`;
}

</script>

<script src="/HawaanEcommerce/assets/js/script.js"></script>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>