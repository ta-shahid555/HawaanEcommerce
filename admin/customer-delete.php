<?php
require_once('header.php');

// Check if ID parameter exists
if(!isset($_REQUEST['id'])) {
    header('location: logout.php');
    exit;
}

// Delete the customer directly from users table
try {
    $statement = $pdo->prepare("DELETE FROM users WHERE id = ?");
    $statement->execute([$_REQUEST['id']]);
    
    // Redirect with success message
    header('location: customer.php?msg=Customer deleted successfully');
    exit;
    
} catch(PDOException $e) {
    // Redirect with error message if deletion fails
    header('location: customer.php?error=Failed to delete customer');
    exit;
}
?>