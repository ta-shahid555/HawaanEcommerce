<?php
require 'config.php';
require_once 'cart-api.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user) {
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['user_name'] = $user['full_name'];
            
            migrateGuestCartToUser($user['id'], session_id());
            $_SESSION['message'] = "Login Success";
            header('Location: /HawaanEcommerce/index.php');
            exit();
        } else {
            $_SESSION['message'] = "Wrong Password";
            header('Location: auth.php');
            exit();
        }
    } else {
        $_SESSION['message'] = "Invalid User";
        header('Location: auth.php');
        exit();
    }
}
?>