<?php
require_once('header.php');

if(!isset($_REQUEST['id'])) {
    header('location: logout.php');
    exit;
}

// Get current status
$statement = $pdo->prepare("SELECT status FROM users WHERE id=?");
$statement->execute([$_REQUEST['id']]);
$current_status = $statement->fetchColumn();

// Toggle status
$new_status = ($current_status == 1) ? 0 : 1;

$statement = $pdo->prepare("UPDATE users SET status=? WHERE id=?");
$statement->execute([$new_status, $_REQUEST['id']]);

header('location: customer.php?msg='.($new_status == 1 ? 'activated' : 'deactivated'));
exit;
?>