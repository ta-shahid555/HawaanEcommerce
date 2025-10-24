<?php
require_once '../config.php';

header('Content-Type: application/json');

if (!isset($_GET['id'])) {
    echo json_encode(['error' => 'No ID provided']);
    exit;
}

$id = $_GET['id'];
$prize = $pdo->prepare("SELECT * FROM spin_wheel_prizes WHERE id = ?");
$prize->execute([$id]);
$result = $prize->fetch(PDO::FETCH_ASSOC);

if (!$result) {
    echo json_encode(['error' => 'Prize not found']);
    exit;
}

echo json_encode($result);