<?php
require 'config.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Clear all session data
$_SESSION = array();
session_destroy();

// Start new session for guest cart
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Redirect to homepage
header('Location: /HawaanEcommerce/index.php');
exit;
?>