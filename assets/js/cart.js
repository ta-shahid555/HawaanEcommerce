/**
 * User-Specific Cart Management System
 * Handles cart operations for both logged-in users and guests
 */

class CartManager {
    constructor() {
        this.cart = [];
        this.coupon = null; // Add coupon property
        this.isLoading = false;
        this.init();
    }

    async init() {
        await this.loadCart();
        this.updateCartCount();
        this.bindEvents();
    }

    bindEvents() {
        // Listen for storage changes (for multi-tab sync)
        window.addEventListener('storage', (e) => {
            if (e.key === 'cart_updated') {
                this.loadCart();
            }
        });

        // Listen for user login/logout events
        document.addEventListener('userLoggedIn', () => {
            this.loadCart();
        });

        document.addEventListener('userLoggedOut', () => {
            this.loadCart();
        });
    }

    async loadCart() {
        try {
            this.isLoading = true;
            const response = await fetch('/HawaanEcommerce/cart-api.php?action=load');
            const data = await response.json();
            
            if (data.error) {
                throw new Error(data.error);
            }
            
            this.cart = data.cart || [];
            this.updateCartCount();
            this.notifyCartUpdate();
            
        } catch (error) {
            console.error('Error loading cart:', error);
            // Fallback to localStorage for offline functionality
            this.loadFromLocalStorage();
        } finally {
            this.isLoading = false;
        }
    }

    async addToCart(productData) {
    try {
        const response = await fetch('/HawaanEcommerce/cart-api.php?action=add', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(productData)
        });

        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        
        const result = await response.json();
        
        if (result.error) {
            throw new Error(result.error);
        }

        await this.loadCart();
        this.showNotification(`${productData.product_name} added to cart!`, 'success');
        
    } catch (error) {
        console.error('Error adding to cart:', error);
        this.addToLocalStorage(productData);
    }
}

    async updateQuantity(productId, quantity) {
        try {
            const response = await fetch('/HawaanEcommerce/cart-api.php?action=update', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    product_id: productId,
                    quantity: quantity
                })
            });

            const result = await response.json();
            
            if (result.error) {
                throw new Error(result.error);
            }

            await this.loadCart(); // Refresh cart
            
        } catch (error) {
            console.error('Error updating cart:', error);
            this.updateLocalStorageQuantity(productId, quantity);
        }
    }

    async removeFromCart(productId) {
        try {
            const response = await fetch(`/HawaanEcommerce/cart-api.php?action=remove&product_id=${productId}`, {
                method: 'DELETE'
            });

            const result = await response.json();
            
            if (result.error) {
                throw new Error(result.error);
            }

            await this.loadCart(); // Refresh cart
            this.showNotification('Item removed from cart', 'info');
            
        } catch (error) {
            console.error('Error removing from cart:', error);
            this.removeFromLocalStorage(productId);
        }
    }

    async clearCart() {
        try {
            const response = await fetch('/HawaanEcommerce/cart-api.php?action=clear', {
                method: 'DELETE'
            });

            const result = await response.json();
            
            if (result.error) {
                throw new Error(result.error);
            }

            this.cart = [];
            this.coupon = null; // Clear coupon too
            localStorage.removeItem('coupon');
            this.updateCartCount();
            this.notifyCartUpdate();
            this.showNotification('Cart cleared', 'info');
            
        } catch (error) {
            console.error('Error clearing cart:', error);
            this.clearLocalStorage();
        }
    }

    // LocalStorage fallback methods
    loadFromLocalStorage() {
        const savedCart = localStorage.getItem('cart');
        if (savedCart) {
            this.cart = JSON.parse(savedCart);
            this.updateCartCount();
        }
    }

    saveToLocalStorage() {
        localStorage.setItem('cart', JSON.stringify(this.cart));
        localStorage.setItem('cart_updated', Date.now().toString());
    }

    addToLocalStorage(productData) {
        const existingItem = this.cart.find(item => item.id === productData.product_id);
        
        if (existingItem) {
            existingItem.quantity += productData.quantity || 1;
        } else {
            this.cart.push({
                id: productData.product_id,
                name: productData.product_name,
                price: productData.product_price,
                image: productData.product_image,
                category: productData.product_category || 'General',
                quantity: productData.quantity || 1
            });
        }
        
        this.saveToLocalStorage();
        this.updateCartCount();
        this.showNotification(`${productData.product_name} added to cart!`, 'success');
    }

    updateLocalStorageQuantity(productId, quantity) {
        const item = this.cart.find(item => item.id === productId);
        if (item) {
            item.quantity = Math.max(1, quantity);
            this.saveToLocalStorage();
            this.updateCartCount();
        }
    }

    removeFromLocalStorage(productId) {
        this.cart = this.cart.filter(item => item.id !== productId);
        this.saveToLocalStorage();
        this.updateCartCount();
        this.showNotification('Item removed from cart', 'info');
    }

    clearLocalStorage() {
        this.cart = [];
        localStorage.removeItem('cart');
        this.updateCartCount();
        this.showNotification('Cart cleared', 'info');
    }

    updateCartCount() {
        const totalItems = this.cart.reduce((sum, item) => sum + item.quantity, 0);
        
        // Update all cart count elements
        document.querySelectorAll('#cart-count, #mobile-cart-count').forEach(el => {
            if (el) el.textContent = totalItems;
        });
    }

    notifyCartUpdate() {
        // Dispatch custom event for cart updates
        document.dispatchEvent(new CustomEvent('cartUpdated', {
            detail: { cart: this.cart }
        }));
    }

    showNotification(message, type = 'info') {
        // Create notification element
        const notification = document.createElement('div');
        notification.className = `cart-notification cart-notification-${type}`;
        notification.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            background: ${type === 'success' ? '#4CAF50' : type === 'error' ? '#f44336' : '#2196F3'};
            color: white;
            padding: 12px 20px;
            border-radius: 6px;
            z-index: 10000;
            font-size: 14px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            transform: translateX(100%);
            transition: transform 0.3s ease;
        `;
        notification.textContent = message;
        
        document.body.appendChild(notification);
        
        // Animate in
        setTimeout(() => {
            notification.style.transform = 'translateX(0)';
        }, 100);
        
        // Remove after 3 seconds
        setTimeout(() => {
            notification.style.transform = 'translateX(100%)';
            setTimeout(() => {
                if (notification.parentNode) {
                    notification.parentNode.removeChild(notification);
                }
            }, 300);
        }, 3000);
    }
    applyCoupon(couponData) {
        this.coupon = couponData;
        this.saveCouponToLocalStorage();
        this.notifyCartUpdate();
        return true;
    }

    removeCoupon() {
        this.coupon = null;
        localStorage.removeItem('coupon');
        this.notifyCartUpdate();
        return true;
    }

    getCoupon() {
        if (!this.coupon) {
            this.loadCouponFromLocalStorage();
        }
        return this.coupon;
    }

    saveCouponToLocalStorage() {
        if (this.coupon) {
            localStorage.setItem('coupon', JSON.stringify(this.coupon));
        }
    }

    loadCouponFromLocalStorage() {
        try {
            const savedCoupon = localStorage.getItem('coupon');
            if (savedCoupon) {
                this.coupon = JSON.parse(savedCoupon);
            }
        } catch (e) {
            console.error('Error loading coupon:', e);
        }
    }

    calculateDiscount(subtotal) {
        if (!this.coupon) return 0;
        
        if (this.coupon.type === 'percentage') {
            return (subtotal * this.coupon.amount) / 100;
        } else {
            return Math.min(this.coupon.amount, subtotal);
        }
    }

    // Public methods for external use
    getCart() {
        return this.cart;
    }

    getCartTotal() {
        const subtotal = this.cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
        const discount = this.calculateDiscount(subtotal);
        return subtotal - discount;
    }

    getCartItemCount() {
        return this.cart.reduce((sum, item) => sum + item.quantity, 0);
    }
}

// Initialize cart manager
const cartManager = new CartManager();

// Global functions for backward compatibility
window.addToCart = function(productId) {
    const product = findProductById(productId);
    if (!product) {
        cartManager.showNotification('Product not found!', 'error');
        return;
    }

    if (!product.inStock) {
        cartManager.showNotification('Product is out of stock!', 'error');
        return;
    }

    cartManager.addToCart({
        product_id: productId,
        product_name: product.name,
        product_price: product.price,
        product_image: product.image,
        product_category: product.category || 'General',
        quantity: 1
    });
};

window.updateCartQuantity = function(productId, quantity) {
    cartManager.updateQuantity(productId, quantity);
};

window.removeFromCart = function(productId) {
    cartManager.removeFromCart(productId);
};

window.clearCart = function() {
    if (confirm('Are you sure you want to clear your cart?')) {
        cartManager.clearCart();
    }
};

window.navigateToCart = function() {
    window.location.href = '/HawaanEcommerce/cart.php';
};

// Export for use in other scripts
window.cartManager = cartManager;