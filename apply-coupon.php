<?php
session_start();
require_once __DIR__ . '/config.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

$response = ['success' => false, 'message' => ''];

try {
    if (!isset($_SESSION['user_id'])) {
        throw new Exception('Please login to apply coupon');
    }
    
    if (empty($_POST['coupon_code'])) {
        throw new Exception('Coupon code is required');
    }
    
    $couponCode = trim($_POST['coupon_code']);
    $userId = $_SESSION['user_id'];
    
    // Validate coupon
    $stmt = $pdo->prepare("
        SELECT sc.*, swp.discount_type, swp.discount_value 
        FROM spin_wheel_coupons sc
        JOIN spin_wheel_prizes swp ON sc.prize_id = swp.id
        WHERE sc.code = ? AND sc.user_id = ? AND sc.is_used = 0 AND sc.expires_at > NOW()
    ");
    $stmt->execute([$couponCode, $userId]);
    $coupon = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$coupon) {
        throw new Exception('Invalid or expired coupon code');
    }
    
    $response = [
        'success' => true,
        'message' => 'Coupon applied successfully!',
        'discount' => [
            'code' => $coupon['code'],
            'amount' => $coupon['discount_type'] === 'percentage' 
                ? $coupon['discount_value'] 
                : (float)$coupon['discount_value'],
            'type' => $coupon['discount_type'],
            'coupon_id' => $coupon['id']
        ]
    ];
    
    $_SESSION['applied_coupon'] = $response['discount'];
    
} catch (Exception $e) {
    $response['message'] = $e->getMessage();
}

echo json_encode($response);