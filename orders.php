<?php
// Add this at the very top
session_start();
if (!isset($_SESSION['user_email'])) {
    header("Location: auth.php");
    exit;
}

require 'config.php';

// Initialize variables
$errors = [];
$success = false;

// Process form submission BEFORE including header
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submitorder'])) {
    // Validate and sanitize inputs
    $fullName = trim($_POST['fullName'] ?? '');
    $email = $_SESSION['user_email'];
    $mobile = trim($_POST['mobile'] ?? '');
    $address = trim($_POST['address'] ?? '');
    $city = trim($_POST['city'] ?? '');
    $zipCode = trim($_POST['zipCode'] ?? '');
    $paymentMethod = trim($_POST['paymentMethod'] ?? '');
    $orderNotes = trim($_POST['orderNotes'] ?? '');
    
    // Get cart items from POST data
    $cartItems = json_decode($_POST['cartItems'] ?? '[]', true);

    // Validation
    if(empty($fullName)) $errors['fullName'] = 'Full name is required';
    if(empty($email)) $errors['email'] = 'Email is required';
    elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors['email'] = 'Invalid email format';
    if(empty($mobile)) $errors['mobile'] = 'Mobile number is required';
    if(empty($address)) $errors['address'] = 'Address is required';
    if(empty($city)) $errors['city'] = 'City is required';
    if(empty($zipCode)) $errors['zipCode'] = 'Zip code is required';
    if(empty($paymentMethod)) $errors['paymentMethod'] = 'Payment method is required';
    if(empty($cartItems)) $errors['cart'] = 'Your cart is empty';

    if (empty($errors)) {
    try {
        // Start transaction
        $pdo->beginTransaction();
        
        // Create a string of all product names, quantities, and categories
        $productsInfo = array_map(function($item) {
            return "{$item['name']} (Qty: {$item['quantity']}, Category: {$item['category']})";
        }, $cartItems);
        
        $productsSummary = implode("\n", $productsInfo);
        
        // Calculate order subtotal (before any discounts)
        $orderSubtotal = array_reduce($cartItems, function($sum, $item) {
            return $sum + ($item['price'] * $item['quantity']);
        }, 0);
        
        // Apply coupon if available
        $discountAmount = 0;
        $couponCode = '';
        $couponDetails = '';

        if (isset($_SESSION['applied_coupon'])) {
            $coupon = $_SESSION['applied_coupon'];
            
            // Apply discount to order total
            if ($coupon['type'] === 'percentage') {
                $discountAmount = ($orderSubtotal * $coupon['amount']) / 100;
            } else {
                $discountAmount = $coupon['amount'];
            }
            
            // Ensure discount doesn't exceed order total
            $discountAmount = min($discountAmount, $orderSubtotal);
            
            $couponCode = $coupon['code'];
            $couponDetails = "\nCoupon Applied: {$coupon['code']} (Discount: $".number_format($discountAmount, 2).")";
            
            // Mark coupon as used in database
            $pdo->prepare("UPDATE spin_wheel_coupons SET is_used = 1, used_at = NOW() WHERE id = ?")
                ->execute([$coupon['coupon_id']]);
            
            // Clear coupon from session
            unset($_SESSION['applied_coupon']);
        } else {
            // Try to get coupon from POST data (if coming from cart with coupon)
            $couponData = json_decode($_POST['couponData'] ?? '{}', true);
            if (!empty($couponData)) {
                $_SESSION['applied_coupon'] = $couponData;
            }
        }

        // Calculate final order total
        $orderTotal = $orderSubtotal - $discountAmount;
        
        // Insert order with product details
        $stmt = $pdo->prepare("INSERT INTO orders (
            full_name, 
            email, 
            mobile, 
            address, 
            city, 
            zip_code, 
            payment_method, 
            order_notes, 
            order_total,
            products_names,
            products_quantities,
            products_categories,
            discount_amount,
            coupon_code
        ) VALUES (
            :fullName, 
            :email, 
            :mobile, 
            :address, 
            :city, 
            :zipCode, 
            :paymentMethod, 
            :orderNotes, 
            :orderTotal,
            :productsNames,
            :productsQuantities,
            :productsCategories,
            :discountAmount,
            :couponCode
        )");
        
        // Prepare products data for database
        $productsNames = implode(', ', array_column($cartItems, 'name'));
        $productsQuantities = implode(', ', array_column($cartItems, 'quantity'));
        $productsCategories = implode(', ', array_column($cartItems, 'category'));
        
        $stmt->execute([
            ':fullName' => $fullName,
            ':email' => $email,
            ':mobile' => $mobile,
            ':address' => $address,
            ':city' => $city,
            ':zipCode' => $zipCode,
            ':paymentMethod' => $paymentMethod,
            ':orderNotes' => $orderNotes . $couponDetails . "\n\nProducts:\n" . $productsSummary,
            ':orderTotal' => $orderTotal,
            ':productsNames' => $productsNames,
            ':productsQuantities' => $productsQuantities,
            ':productsCategories' => $productsCategories,
            ':discountAmount' => $discountAmount,
            ':couponCode' => $couponCode
        ]);
            
            $orderId = $pdo->lastInsertId();
            
            // Insert order items (detailed records)
            $stmt = $pdo->prepare("INSERT INTO order_items (
                order_id, 
                product_id, 
                product_name, 
                price, 
                quantity, 
                category
            ) VALUES (
                :orderId, 
                :productId, 
                :productName, 
                :price, 
                :quantity, 
                :category
            )");
            
            foreach ($cartItems as $item) {
                $stmt->execute([
                    ':orderId' => $orderId,
                    ':productId' => $item['id'],
                    ':productName' => $item['name'],
                    ':price' => $item['price'],
                    ':quantity' => $item['quantity'],
                    ':category' => $item['category'] ?? 'Unknown'
                ]);
            }
            
            // Clear the cart
            $pdo->commit();
            
            // Clear the cart in localStorage
            echo "<script>localStorage.removeItem('cart');</script>";
            
            $success = true;
            // Clear cart after successful order
            echo "<script>
                if (window.cartManager) {
                    window.cartManager.clearCart();
                } else {
                    localStorage.removeItem('cart');
                }
            </script>";

        } catch (PDOException $e) {
            $pdo->rollBack();
            $errors['database'] = 'Error saving order: ' . $e->getMessage();
        }
    }
}

include($_SERVER['DOCUMENT_ROOT'].'/HawaanEcommerce/header.php');

?>

<!-- Rest of your HTML remains the same -->
<style>
    /* Your existing styles remain the same */
    .cart-items-summary {
        margin: 30px 0;
        border: 1px solid #e1e8ed;
        border-radius: 8px;
        padding: 20px;
    }
    .cart-item-summary {
        display: flex;
        justify-content: space-between;
        padding: 10px 0;
        border-bottom: 1px solid #f0f0f0;
    }
    .cart-item-summary:last-child {
        border-bottom: none;
    }
    .cart-item-info {
        display: flex;
        align-items: center;
    }
    .cart-item-image {
        width: 60px;
        height: 60px;
        object-fit: cover;
        margin-right: 15px;
        border-radius: 4px;
    }
    .cart-item-name {
        font-weight: 600;
    }
    .cart-item-category {
        font-size: 0.85rem;
        color: #666;
    }
    .cart-item-price {
        font-weight: 600;
    }
    .cart-item-quantity {
        color: #666;
    }
       .containers {
            padding: 20px;
            max-width: 600px;
            margin: 0 auto;
            background: white;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            border: 1px solid #e9ecef;
        }

        .form-header {
            background: #fff;
            color: #333;
            padding: 30px;
            text-align: center;
            border-bottom: 1px solid #e9ecef;
        }

        .form-header h1 {
            font-size: 2rem;
            margin-bottom: 8px;
            font-weight: 600;
        }

        .form-header p {
            opacity: 0.7;
            font-size: 1.1rem;
        }

        .form-content {
            padding: 40px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #333;
            font-size: 0.95rem;
        }

        .required::after {
            content: " *";
            color: #e74c3c;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e1e8ed;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: #fff;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #007bff;
            box-shadow: 0 0 0 3px rgba(0, 123, 255, 0.1);
        }

        .form-group input.error,
        .form-group select.error,
        .form-group textarea.error {
            border-color: #e74c3c;
            box-shadow: 0 0 0 3px rgba(231, 76, 60, 0.1);
        }

        .form-group textarea {
            resize: vertical;
            min-height: 100px;
            font-family: inherit;
        }

        .radio-group {
            display: flex;
            gap: 20px;
            margin-top: 8px;
        }

        .radio-option {
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            padding: 10px 15px;
            border: 2px solid #e1e8ed;
            border-radius: 8px;
            transition: all 0.3s ease;
            flex: 1;
        }

        .radio-option:hover {
            border-color: #007bff;
            background: #f8f9fa;
        }

        .radio-option input[type="radio"] {
            width: auto;
            margin: 0;
            accent-color: #007bff;
        }

        .radio-option input[type="radio"]:checked + .radio-label {
            color: #007bff;
            font-weight: 600;
        }

        .radio-option:has(input[type="radio"]:checked) {
            border-color: #007bff;
            background: #f8f9fa;
        }

        .error-message {
            color: #e74c3c;
            font-size: 0.85rem;
            margin-top: 5px;
            display: none;
        }

        .submit-btn {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, #ff6b35 0%, #f7931e 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 20px;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(255, 107, 53, 0.3);
        }

        .submit-btn:active {
            transform: translateY(0);
        }

        .two-column {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        @media (max-width: 768px) {
            .container {
                margin: 10px;
                border-radius: 8px;
            }

            .form-header {
                padding: 20px;
            }

            .form-header h1 {
                font-size: 1.5rem;
            }

            .form-content {
                padding: 30px 20px;
            }

            .two-column {
                grid-template-columns: 1fr;
                gap: 15px;
            }

            .radio-group {
                flex-direction: column;
                gap: 10px;
            }

            .radio-option {
                justify-content: center;
            }
        }

        @media (max-width: 480px) {
            body {
                padding: 10px;
            }

            .form-header {
                padding: 15px;
            }

            .form-content {
                padding: 20px 15px;
            }

            .form-group {
                margin-bottom: 20px;
            }
        }    .error-message {
        color: #e74c3c;
        font-size: 0.85rem;
        margin-top: 5px;
    }
    .error-field {
        border-color: #e74c3c !important;
        box-shadow: 0 0 0 3px rgba(231, 76, 60, 0.1) !important;
    }
</style>

<div class="containers">
    <?php if ($success): ?>
        <div class="form-header">
            <h1>Thank You for Your Order!</h1>
            <p>Your order has been placed successfully. We'll contact you soon for confirmation.</p>
            <a href="/HawaanEcommerce/index.php" class="submit-btn" style="text-align: center; display: block; margin-top: 30px;">
                Back to Home
            </a>
        </div>
    <?php else: ?>
        <div class="form-header">
            <h1>Complete Your Order</h1>
            <p>Please fill in your details to place your order</p>
        </div>

        <?php if (!empty($errors['database'])): ?>
            <div class="alert alert-danger"><?php echo $errors['database']; ?></div>
        <?php endif; ?>
        
        <form id="orderForm" action="orders.php" method="POST" novalidate>
            <!-- Hidden input to store cart items -->
            <input type="hidden" id="cartItems" name="cartItems" value="">
            
            <!-- Your existing form fields remain the same -->
            <div class="form-group">
                <label for="fullName" class="required">Full Name</label>
                <input type="text" id="fullName" name="fullName" value="<?php echo htmlspecialchars($fullName ?? ''); ?>" 
                    class="<?php echo !empty($errors['fullName']) ? 'error-field' : ''; ?>" required>
                <?php if (!empty($errors['fullName'])): ?>
                    <div class="error-message"><?php echo $errors['fullName']; ?></div>
                <?php endif; ?>
            </div>
            
            <div class="form-group">
    <label>Email Address</label>
    <!-- <p><strong><?php echo htmlspecialchars($_SESSION['user_email']); ?></strong></p> -->
    <input type="email" name="email" value="<?php echo htmlspecialchars($_SESSION['user_email']); ?>">
</div>

            <div class="form-group">
                <label for="mobile" class="required">Mobile Number</label>
                <input type="tel" id="mobile" name="mobile" value="<?php echo htmlspecialchars($mobile ?? ''); ?>" 
                    placeholder="03XX-XXXXXXX" class="<?php echo !empty($errors['mobile']) ? 'error-field' : ''; ?>" required>
                <?php if (!empty($errors['mobile'])): ?>
                    <div class="error-message"><?php echo $errors['mobile']; ?></div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="address" class="required">Shipping Address</label>
                <textarea id="address" name="address" placeholder="Enter your complete shipping address" 
                    class="<?php echo !empty($errors['address']) ? 'error-field' : ''; ?>" required><?php echo htmlspecialchars($address ?? ''); ?></textarea>
                <?php if (!empty($errors['address'])): ?>
                    <div class="error-message"><?php echo $errors['address']; ?></div>
                <?php endif; ?>
            </div>

            <div class="two-column">
                <div class="form-group">
                    <label for="city" class="required">City</label>
                    <select id="city" name="city" class="<?php echo !empty($errors['city']) ? 'error-field' : ''; ?>" required>
                        <option value="">Select City</option>
                        <option value="karachi" <?php echo ($city ?? '') === 'karachi' ? 'selected' : ''; ?>>Karachi</option>
                        <option value="lahore" <?php echo ($city ?? '') === 'lahore' ? 'selected' : ''; ?>>Lahore</option>
                        <option value="islamabad" <?php echo ($city ?? '') === 'islamabad' ? 'selected' : ''; ?>>Islamabad</option>
                        <option value="multan" <?php echo ($city ?? '') === 'multan' ? 'selected' : ''; ?>>Multan</option>
                    </select>
                    <?php if (!empty($errors['city'])): ?>
                        <div class="error-message"><?php echo $errors['city']; ?></div>
                    <?php endif; ?>
                </div>

                <div class="form-group">
                    <label for="zipCode" class="required">Zip/Postal Code</label>
                    <input type="number" id="zipCode" name="zipCode" value="<?php echo htmlspecialchars($zipCode ?? ''); ?>" 
                        placeholder="54000" class="<?php echo !empty($errors['zipCode']) ? 'error-field' : ''; ?>" required>
                    <?php if (!empty($errors['zipCode'])): ?>
                        <div class="error-message"><?php echo $errors['zipCode']; ?></div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="form-group">
                <label class="required">Payment Method</label>
                <div class="radio-group <?php echo !empty($errors['paymentMethod']) ? 'error-field' : ''; ?>">
                    <div class="radio-option">
                        <input type="radio" id="cod" name="paymentMethod" value="cod" <?php echo ($paymentMethod ?? '') === 'cod' ? 'checked' : ''; ?> required>
                        <label for="cod" class="radio-label">Cash on Delivery</label>
                    </div>
                    <div class="radio-option">
                        <input type="radio" id="bank" name="paymentMethod" value="bank" <?php echo ($paymentMethod ?? '') === 'bank' ? 'checked' : ''; ?> required>
                        <label for="bank" class="radio-label">Manual Bank Transfer</label>
                    </div>
                </div>
                <?php if (!empty($errors['paymentMethod'])): ?>
                    <div class="error-message"><?php echo $errors['paymentMethod']; ?></div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="orderNotes">Order Notes (Optional)</label>
                <textarea id="orderNotes" name="orderNotes" placeholder="Any special instructions or notes for your order"><?php echo htmlspecialchars($orderNotes ?? ''); ?></textarea>
            </div>

            <!-- Other form fields (email, mobile, address, etc.) -->
            
            <!-- Cart Items Summary -->
            <div class="cart-items-summary">
                <h3>Your Order</h3>
                <div id="cartItemsContainer">
                    <!-- Cart items will be loaded here by JavaScript -->
                </div>
            </div>

            <button type="submit" name="submitorder" class="submit-btn">Place Order</button>
        </form>
    <?php endif; ?>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
     // Try to get coupon from sessionStorage (passed from cart)
    const checkoutCoupon = sessionStorage.getItem('checkout_coupon');
    if (checkoutCoupon) {
        const coupon = JSON.parse(checkoutCoupon);
        
        // Send coupon to server via AJAX to store in session
        fetch('/HawaanEcommerce/save-coupon-session.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({coupon: coupon})
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                console.log('Coupon saved to session');
                // Remove from sessionStorage
                sessionStorage.removeItem('checkout_coupon');
                
                // Reload the page to apply coupon
                window.location.reload();
            }
        })
        .catch(error => {
            console.error('Error saving coupon:', error);
        });
    }

    // Function to load cart data
    function loadCartData() {
        let cart = [];
        
        // Try to get cart from cartManager first
        if (window.cartManager && typeof window.cartManager.getCart === 'function') {
            cart = window.cartManager.getCart();
        }
        
        // If cart is empty, try localStorage as backup
        if (cart.length === 0) {
            try {
                const savedCart = localStorage.getItem('cart');
                if (savedCart) {
                    cart = JSON.parse(savedCart);
                }
            } catch (e) {
                console.error('Error loading cart from localStorage:', e);
            }
        }
        
        displayCartItems(cart);
    }
    
    function displayCartItems(cart) {
        const cartItemsContainer = document.getElementById('cartItemsContainer');
        const cartItemsInput = document.getElementById('cartItems');
        
        if (!cartItemsContainer || !cartItemsInput) {
            console.error('Cart containers not found');
            return;
        }
        
        if (cart.length === 0) {
            cartItemsContainer.innerHTML = '<p>Your cart is empty</p>';
            cartItemsInput.value = '[]';
            return;
        }
        
        // Calculate totals
        let subtotal = 0;
        let html = '';
        const cartData = [];
        
        cart.forEach(item => {
            const itemTotal = item.price * item.quantity;
            subtotal += itemTotal;
            
            html += `
                <div class="cart-item-summary">
                    <div class="cart-item-info">
                        <img src="${item.image}" alt="${item.name}" class="cart-item-image">
                        <div>
                            <div class="cart-item-name">${item.name}</div>
                            <div class="cart-item-category">${item.category || 'General'}</div>
                        </div>
                    </div>
                    <div>
                        <div class="cart-item-price">$${itemTotal.toFixed(2)}</div>
                        <div class="cart-item-quantity">Qty: ${item.quantity}</div>
                    </div>
                </div>
            `;
            
            cartData.push({
                id: item.id,
                name: item.name,
                price: item.price,
                quantity: item.quantity,
                category: item.category || 'General',
                image: item.image
            });
        });
        
        // Calculate discount
        let discountAmount = 0;
        let discountText = '';
        
        // Check if we have a coupon in PHP session (via AJAX)
        <?php if (isset($_SESSION['applied_coupon'])): ?>
        const coupon = <?php echo json_encode($_SESSION['applied_coupon']); ?>;
        if (coupon) {
            if (coupon.type === 'percentage') {
                discountAmount = (subtotal * coupon.amount) / 100;
            } else {
                discountAmount = coupon.amount;
            }
            // Ensure discount doesn't exceed subtotal
            discountAmount = Math.min(discountAmount, subtotal);
            discountText = `<div class="summary-row">
                <span>Discount (${coupon.code}):</span>
                <span>-$${discountAmount.toFixed(2)}</span>
            </div>`;
        }
        <?php endif; ?>
        
        const total = subtotal - discountAmount;
        
        // Add summary rows
        html += `
            <div style="margin-top: 20px; padding-top: 10px; border-top: 1px solid #e1e8ed;">
                <div class="summary-row">
                    <span>Subtotal:</span>
                    <span>$${subtotal.toFixed(2)}</span>
                </div>
                ${discountText}
                <div class="summary-row" style="font-weight: bold; margin-top: 10px;">
                    <span>Total:</span>
                    <span>$${total.toFixed(2)}</span>
                </div>
            </div>
        `;
        
        cartItemsContainer.innerHTML = html;
        cartItemsInput.value = JSON.stringify(cartData);
    }
    
    // Load cart data with multiple attempts
    let attempts = 0;
    const maxAttempts = 10;
    
    function tryLoadCart() {
        attempts++;
        
        // Try to load cart data
        loadCartData();
        
        // Check if cart was loaded successfully
        const cartItemsInput = document.getElementById('cartItems');
        const cartData = cartItemsInput ? cartItemsInput.value : '[]';
        
        // If cart is still empty and we haven't reached max attempts, try again
        if (cartData === '[]' && attempts < maxAttempts) {
            setTimeout(tryLoadCart, 200);
        }
    }
    
    // Start loading cart
    tryLoadCart();
    
    // Also listen for cart updates
    document.addEventListener('cartUpdated', function() {
        loadCartData();
    });
});
</script>

<script>
// Additional backup method - load cart from API directly
async function loadCartFromAPI() {
    const cartItemsContainer = document.getElementById('cartItemsContainer');
    const cartItemsInput = document.getElementById('cartItems');
    
    try {
        const response = await fetch('/HawaanEcommerce/cart-api.php?action=load');
        const data = await response.json();
        
        if (data.cart && data.cart.length > 0) {
            displayCartFromAPI(data.cart);
        } else {
            cartItemsContainer.innerHTML = '<p>Your cart is empty</p>';
            cartItemsInput.value = '[]';
        }
    } catch (error) {
        console.error('Error loading cart from API:', error);
    }
}

function displayCartFromAPI(cart) {
    const cartItemsContainer = document.getElementById('cartItemsContainer');
    const cartItemsInput = document.getElementById('cartItems');
    
    let html = '';
    let total = 0;
    const cartData = [];
    
    cart.forEach(item => {
        const itemTotal = item.price * item.quantity;
        total += itemTotal;
        
        html += `
            <div class="cart-item-summary">
                <div class="cart-item-info">
                    <img src="${item.image}" alt="${item.name}" class="cart-item-image">
                    <div>
                        <div class="cart-item-name">${item.name}</div>
                        <div class="cart-item-category">${item.category || 'General'}</div>
                    </div>
                </div>
                <div>
                    <div class="cart-item-price">$${itemTotal.toFixed(2)}</div>
                    <div class="cart-item-quantity">Qty: ${item.quantity}</div>
                </div>
            </div>
        `;
        
        cartData.push({
            id: item.id,
            name: item.name,
            price: item.price,
            quantity: item.quantity,
            category: item.category || 'General',
            image: item.image
        });
    });
    
    // Add total row
    html += `
        <div style="margin-top: 20px; padding-top: 10px; border-top: 1px solid #e1e8ed; text-align: right;">
            <strong>Total: $${total.toFixed(2)}</strong>
        </div>
    `;
    
    cartItemsContainer.innerHTML = html;
    cartItemsInput.value = JSON.stringify(cartData);
}

// Try API method as backup after 2 seconds
setTimeout(() => {
    const cartItemsInput = document.getElementById('cartItems');
    if (cartItemsInput && cartItemsInput.value === '[]') {
        loadCartFromAPI();
    }
}, 2000);
</script>

<?php if ($success): ?>
<script>
// Clear the cart after successful order
if (window.cartManager) {
    window.cartManager.clearCart();
} else {
    localStorage.removeItem('cart');
}

// Redirect to order display page after 2 seconds
setTimeout(function() {
    window.location.href = '/HawaanEcommerce/orderDisplay.php';
}, 2000);
</script>
<?php endif; ?>

<?php include($_SERVER['DOCUMENT_ROOT'].'/HawaanEcommerce/footer.php'); ?>