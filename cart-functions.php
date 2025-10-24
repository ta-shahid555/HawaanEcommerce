<?php
require 'config.php';

function saveCartToDatabase($userId, $cart) {
    global $pdo;
    
    try {
        // Start transaction
        $pdo->beginTransaction();
        
        // First clear existing cart items for this user
        $stmt = $pdo->prepare("DELETE FROM user_cart WHERE user_id = ?");
        $stmt->execute([$userId]);
        
        // Insert new cart items
        $stmt = $pdo->prepare("INSERT INTO user_cart (user_id, product_id, quantity) VALUES (?, ?, ?)");
        
        foreach ($cart as $item) {
            $stmt->execute([$userId, $item['id'], $item['quantity']]);
        }
        
        $pdo->commit();
        return true;
    } catch (Exception $e) {
        $pdo->rollBack();
        error_log("Error saving cart to database: " . $e->getMessage());
        return false;
    }
}

function loadCartFromDatabase($userId) {
    global $pdo;
    
    try {
        $stmt = $pdo->prepare("SELECT p.id, p.name, p.price, p.image, uc.quantity 
                              FROM user_cart uc
                              JOIN products p ON uc.product_id = p.id
                              WHERE uc.user_id = ?");
        $stmt->execute([$userId]);
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        error_log("Error loading cart from database: " . $e->getMessage());
        return [];
    }
}

// For session-based cart (guests)
function getGuestCart() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    return $_SESSION['cart'] ?? [];
}

function saveGuestCart($cart) {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    $_SESSION['cart'] = $cart;
}

// Helper function to find product (modify according to your product storage)
function findProductById($productId) {
    // If using database:
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
    $stmt->execute([$productId]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
    
    // If using JSON:
    // $products = json_decode(file_get_contents('products.json'), true);
    // Search through products array to find matching ID
}
?>