<?php
require_once('header.php');
include($_SERVER['DOCUMENT_ROOT'].'/HawaanEcommerce/config.php');

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: contact-view.php');
    exit;
}

$id = intval($_GET['id']);

try {
    $stmt = $pdo->prepare("DELETE FROM contact_messages WHERE id = :id");
    $stmt->execute([':id' => $id]);
    header('Location: message.php');
    exit;
} catch (PDOException $e) {
    echo "Error deleting record: " . $e->getMessage();
}
?>
