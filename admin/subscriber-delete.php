<?php
require_once('inc/config.php');
session_start();

if (!isset($_GET['id']) || empty($_GET['id'])) {
    $_SESSION['error_message'] = "Invalid subscriber ID.";
    header('Location: view-subscribers.php');
    exit;
}

$id = $_GET['id'];

try {
    $statement = $pdo->prepare("DELETE FROM tbl_subscriber WHERE id = ?");
    $statement->execute([$id]);

    $_SESSION['success_message'] = "Subscriber deleted successfully.";
} catch (PDOException $e) {
    $_SESSION['error_message'] = "Error deleting subscriber: " . $e->getMessage();
}

header('Location: subscriber.php');
exit;
?>
