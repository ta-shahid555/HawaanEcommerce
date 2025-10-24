<?php
session_start();
require 'config.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

$method = $_SERVER['REQUEST_METHOD'];
$action = $_GET['action'] ?? '';

try {
    switch ($method) {
        case 'GET':
            if ($action === 'load') {
                loadCart();
            }
            break;
            
        case 'POST':
            if ($action === 'add') {
                addToCart();
            } elseif ($action === 'update') {
                updateCartQuantity();
            }
            break;
            
        case 'DELETE':
            if ($action === 'remove') {
                removeFromCart();
            } elseif ($action === 'clear') {
                clearCart();
            }
            break;
            
        default:
            throw new Exception('Method not allowed');
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}

function loadCart() {
    global $pdo;
    
    if (isset($_SESSION['user_id'])) {
        // Load cart for logged-in user
        $stmt = $pdo->prepare("
            SELECT product_id, product_name, product_price, product_image, 
                   product_category, quantity 
            FROM user_cart 
            WHERE user_id = ? 
            ORDER BY created_at DESC
        ");
        $stmt->execute([$_SESSION['user_id']]);
        $cartItems = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        // Load cart for guest user using session
        $sessionId = session_id();
        $stmt = $pdo->prepare("
            SELECT product_id, product_name, product_price, product_image, 
                   product_category, quantity 
            FROM session_cart 
            WHERE session_id = ? 
            ORDER BY created_at DESC
        ");
        $stmt->execute([$sessionId]);
        $cartItems = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    // Format cart items for frontend
    $formattedCart = [];
    foreach ($cartItems as $item) {
        $formattedCart[] = [
            'id' => $item['product_id'],
            'name' => $item['product_name'],
            'price' => (float)$item['product_price'],
            'image' => $item['product_image'],
            'category' => $item['product_category'],
            'quantity' => (int)$item['quantity']
        ];
    }
    
    echo json_encode(['cart' => $formattedCart]);
}

function addToCart() {
    global $pdo; // Add this to access database connection
    
    $input = json_decode(file_get_contents('php://input'), true);
    
    // Add validation
    if (!$input || !isset($input['product_id'])) {
        http_response_code(400);
        echo json_encode(['error' => 'Invalid input data']);
        exit;
    }
    
    $productId = $input['product_id'];
    $productName = $input['product_name'] ?? '';
    $productPrice = $input['product_price'] ?? 0;
    $productImage = $input['product_image'] ?? '';
    $productCategory = $input['product_category'] ?? 'General';
    $quantity = $input['quantity'] ?? 1;
    
    if (isset($_SESSION['user_id'])) {
        // Add to user cart
        $stmt = $pdo->prepare("
            INSERT INTO user_cart (user_id, product_id, product_name, product_price, 
                                 product_image, product_category, quantity)
            VALUES (?, ?, ?, ?, ?, ?, ?)
            ON DUPLICATE KEY UPDATE 
            quantity = quantity + VALUES(quantity),
            updated_at = CURRENT_TIMESTAMP
        ");
        $stmt->execute([
            $_SESSION['user_id'], $productId, $productName, 
            $productPrice, $productImage, $productCategory, $quantity
        ]);
    } else {
        // Add to session cart
        $sessionId = session_id();
        $stmt = $pdo->prepare("
            INSERT INTO session_cart (session_id, product_id, product_name, product_price, 
                                    product_image, product_category, quantity)
            VALUES (?, ?, ?, ?, ?, ?, ?)
            ON DUPLICATE KEY UPDATE 
            quantity = quantity + VALUES(quantity),
            updated_at = CURRENT_TIMESTAMP
        ");
        $stmt->execute([
            $sessionId, $productId, $productName, 
            $productPrice, $productImage, $productCategory, $quantity
        ]);
    }
    
    echo json_encode(['success' => true, 'message' => 'Item added to cart']);
}

function updateCartQuantity() {
    global $pdo;
    
    $input = json_decode(file_get_contents('php://input'), true);
    
    if (!$input || !isset($input['product_id']) || !isset($input['quantity'])) {
        throw new Exception('Invalid input data');
    }
    
    $productId = $input['product_id'];
    $quantity = max(1, (int)$input['quantity']); // Ensure quantity is at least 1
    
    if (isset($_SESSION['user_id'])) {
        // Update user cart
        $stmt = $pdo->prepare("
            UPDATE user_cart 
            SET quantity = ?, updated_at = CURRENT_TIMESTAMP 
            WHERE user_id = ? AND product_id = ?
        ");
        $stmt->execute([$quantity, $_SESSION['user_id'], $productId]);
    } else {
        // Update session cart
        $sessionId = session_id();
        $stmt = $pdo->prepare("
            UPDATE session_cart 
            SET quantity = ?, updated_at = CURRENT_TIMESTAMP 
            WHERE session_id = ? AND product_id = ?
        ");
        $stmt->execute([$quantity, $sessionId, $productId]);
    }
    
    echo json_encode(['success' => true, 'message' => 'Cart updated']);
}

function removeFromCart() {
    global $pdo;
    
    $productId = $_GET['product_id'] ?? '';
    
    if (!$productId) {
        throw new Exception('Product ID required');
    }
    
    if (isset($_SESSION['user_id'])) {
        // Remove from user cart
        $stmt = $pdo->prepare("DELETE FROM user_cart WHERE user_id = ? AND product_id = ?");
        $stmt->execute([$_SESSION['user_id'], $productId]);
    } else {
        // Remove from session cart
        $sessionId = session_id();
        $stmt = $pdo->prepare("DELETE FROM session_cart WHERE session_id = ? AND product_id = ?");
        $stmt->execute([$sessionId, $productId]);
    }
    
    echo json_encode(['success' => true, 'message' => 'Item removed from cart']);
}

function clearCart() {
    global $pdo;
    
    if (isset($_SESSION['user_id'])) {
        // Clear user cart
        $stmt = $pdo->prepare("DELETE FROM user_cart WHERE user_id = ?");
        $stmt->execute([$_SESSION['user_id']]);
    } else {
        // Clear session cart
        $sessionId = session_id();
        $stmt = $pdo->prepare("DELETE FROM session_cart WHERE session_id = ?");
        $stmt->execute([$sessionId]);
    }
    
    echo json_encode(['success' => true, 'message' => 'Cart cleared']);
}

// Function to migrate guest cart to user cart when user logs in
function migrateGuestCartToUser($userId, $sessionId) {
    global $pdo;
    
    try {
        $pdo->beginTransaction();
        
        // Get guest cart items
        $stmt = $pdo->prepare("SELECT * FROM session_cart WHERE session_id = ?");
        $stmt->execute([$sessionId]);
        $guestItems = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        // Move items to user cart
        foreach ($guestItems as $item) {
            $stmt = $pdo->prepare("
                INSERT INTO user_cart (user_id, product_id, product_name, product_price, 
                                     product_image, product_category, quantity)
                VALUES (?, ?, ?, ?, ?, ?, ?)
                ON DUPLICATE KEY UPDATE 
                quantity = quantity + VALUES(quantity)
            ");
            $stmt->execute([
                $userId, $item['product_id'], $item['product_name'],
                $item['product_price'], $item['product_image'], 
                $item['product_category'], $item['quantity']
            ]);
        }
        
        // Clear guest cart
        $stmt = $pdo->prepare("DELETE FROM session_cart WHERE session_id = ?");
        $stmt->execute([$sessionId]);
        
        $pdo->commit();
        return true;
    } catch (Exception $e) {
        $pdo->rollBack();
        return false;
    }
}
?>