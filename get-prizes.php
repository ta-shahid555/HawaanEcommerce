<?php
require_once 'config.php';

header('Content-Type: application/json');

$prizes = $pdo->query("SELECT id, name, discount_type, discount_value FROM spin_wheel_prizes WHERE is_active = 1")
    ->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($prizes);