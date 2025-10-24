
<?php
require_once('header.php');

if(!isset($_REQUEST['id'])) {
    header('location: blogs.php');
    exit;
}

// Check blog id
$statement = $pdo->prepare("SELECT * FROM blogs WHERE id=?");
$statement->execute([$_REQUEST['id']]);
$total = $statement->rowCount();
if($total == 0) {
    header('location: blogs.php');
    exit;
}

// Fetch blog data
$blog = $statement->fetch(PDO::FETCH_ASSOC);

// Delete blog images
if($blog['blog_img'] != '' && file_exists('../' . $blog['blog_img'])) {
    unlink('../' . $blog['blog_img']);
}
if($blog['auther_img'] != '' && file_exists('../' . $blog['auther_img'])) {
    unlink('../' . $blog['auther_img']);
}

// Delete blog record
$statement = $pdo->prepare("DELETE FROM blogs WHERE id=?");
$statement->execute([$_REQUEST['id']]);

header('location: blogs.php');
exit;
?>
