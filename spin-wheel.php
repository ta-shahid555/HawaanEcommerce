<?php
session_start();
require_once 'config.php'; // Your database connection file

header('Content-Type: application/json');

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['error' => 'Please login to spin the wheel']);
    exit;
}

$userId = $_SESSION['user_id'];

// Check if user already spun today
$today = date('Y-m-d');
$spinLog = $pdo->prepare("SELECT * FROM user_spin_logs WHERE user_id = ? AND spin_date = ?");
$spinLog->execute([$userId, $today]);
$log = $spinLog->fetch(PDO::FETCH_ASSOC);

if ($log && $log['spin_count'] >= 1) {
    echo json_encode(['error' => 'You can only spin once per day']);
    exit;
}

// Get active prizes with probability
$prizes = $pdo->query("SELECT * FROM spin_wheel_prizes WHERE is_active = 1 ORDER BY probability DESC")->fetchAll(PDO::FETCH_ASSOC);

if (empty($prizes)) {
    echo json_encode(['error' => 'No prizes available']);
    exit;
}

// Weighted random selection
$totalProbability = array_sum(array_column($prizes, 'probability'));
$random = mt_rand(1, $totalProbability);
$current = 0;
$selectedPrize = null;

foreach ($prizes as $prize) {
    $current += $prize['probability'];
    if ($random <= $current) {
        $selectedPrize = $prize;
        break;
    }
}

// Generate coupon code
$couponCode = 'SPIN' . strtoupper(substr(md5(uniqid()), 0, 8));

// Calculate expiration (24 hours from now)
$expiresAt = date('Y-m-d H:i:s', strtotime('+24 hours'));

// Save coupon
$stmt = $pdo->prepare("INSERT INTO spin_wheel_coupons (user_id, prize_id, code, expires_at) VALUES (?, ?, ?, ?)");
$stmt->execute([$userId, $selectedPrize['id'], $couponCode, $expiresAt]);

// Update spin log
if ($log) {
    $pdo->prepare("UPDATE user_spin_logs SET spin_count = spin_count + 1, last_spin_at = NOW() WHERE id = ?")
        ->execute([$log['id']]);
} else {
    $pdo->prepare("INSERT INTO user_spin_logs (user_id, spin_date, spin_count) VALUES (?, ?, 1)")
        ->execute([$userId, $today]);
}

echo json_encode([
    'success' => true,
    'prize' => $selectedPrize['name'],
    'discount_type' => $selectedPrize['discount_type'],
    'discount_value' => $selectedPrize['discount_value'],
    'coupon_code' => $couponCode,
    'expires_at' => $expiresAt
]);