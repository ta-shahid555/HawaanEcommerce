<?php require_once('header.php'); ?>

<?php
if (!isset($_REQUEST['id'])) {
    header('location: logout.php');
    exit;
} else {
    // Check if the order ID exists
    $statement = $pdo->prepare("SELECT * FROM orders WHERE id=?");
    $statement->execute([$_REQUEST['id']]);
    $total = $statement->rowCount();

    if ($total == 0) {
        header('location: logout.php');
        exit;
    }
}

// Now delete the order
$statement = $pdo->prepare("DELETE FROM orders WHERE id=?");
$statement->execute([$_REQUEST['id']]);

header('location: order.php');
exit;
?>
