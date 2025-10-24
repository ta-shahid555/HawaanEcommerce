<?php
          include($_SERVER['DOCUMENT_ROOT'].'/HawaanEcommerce/config.php'); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName  = $_POST['firstName'];
    $lastName   = $_POST['lastName'];
    $email      = $_POST['email'];
    $phone      = $_POST['phone'];
    $subject    = $_POST['subject'];
    $message    = $_POST['message'];
    $newsletter = isset($_POST['newsletter']) ? 1 : 0;

    try {
        $stmt = $pdo->prepare("INSERT INTO contact_messages 
            (first_name, last_name, email, phone, subject, message, newsletter) 
            VALUES (:first_name, :last_name, :email, :phone, :subject, :message, :newsletter)");

        $stmt->execute([
            ':first_name' => $firstName,
            ':last_name' => $lastName,
            ':email' => $email,
            ':phone' => $phone,
            ':subject' => $subject,
            ':message' => $message,
            ':newsletter' => $newsletter
        ]);

        echo "success";
    } catch (PDOException $e) {
        echo "error: " . $e->getMessage();
    }
}
?>
