<?php
require 'config.php';
require_once 'cart-api.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirmPassword = $_POST['confirm_password'] ?? '';

    // Validate required fields
    if (empty($name) || empty($email) || empty($password) || empty($confirmPassword)) {
        $_SESSION['message'] = "All fields are required";
        header('Location: auth.php');
        exit();
    }

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['message'] = "Invalid email format";
        header('Location: auth.php');
        exit();
    }

    // Validate password match
    if ($password !== $confirmPassword) {
        $_SESSION['message'] = "Passwords do not match";
        header('Location: auth.php');
        exit();
    }

    // Check password length
    if (strlen($password) < 6) {
        $_SESSION['message'] = "Password must be at least 6 characters";
        header('Location: auth.php');
        exit();
    }

    // Check if email exists
    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);

    if ($stmt->rowCount() > 0) {
        $_SESSION['message'] = "Email already exists";
        header('Location: auth.php');
        exit();
    }

    // Create user account
    $hashed = password_hash($password, PASSWORD_DEFAULT);
    $insert = $pdo->prepare("INSERT INTO users (full_name, email, password) VALUES (?, ?, ?)");
    $success = $insert->execute([$name, $email, $hashed]);

    if ($success) {
        $_SESSION['user_id'] = $pdo->lastInsertId();
        $_SESSION['user_email'] = $email;
        $_SESSION['user_name'] = $name;
        
        migrateGuestCartToUser($_SESSION['user_id'], session_id());
        $_SESSION['message'] = "Account created successfully";
        header('Location: /HawaanEcommerce/index.php');
        exit();
    } else {
        $_SESSION['message'] = "Error creating account";
        header('Location: auth.php');
        exit();
    }
}