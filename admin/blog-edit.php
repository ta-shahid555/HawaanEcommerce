<?php require_once('header.php'); ?>

<?php
if(!isset($_REQUEST['id'])) {
    header('location: logout.php');
    exit;
}

// Check valid blog id
$statement = $pdo->prepare("SELECT * FROM blogs WHERE id=?");
$statement->execute([$_REQUEST['id']]);
$total = $statement->rowCount();
if($total == 0) {
    header('location: logout.php');
    exit;
}

$error_message = '';
$success_message = '';

// Fetch blog data
$blog = $statement->fetch(PDO::FETCH_ASSOC);

if(isset($_POST['form1'])) {
    $valid = 1;

    // Validate required fields
    if(empty($_POST['heading']) || empty($_POST['auther_name']) || empty($_POST['blog_name']) || empty($_POST['content'])) {
        $valid = 0;
        $error_message .= "Please fill all required fields.<br>";
    }

    // Image upload handling for blog image
    $blog_img = $blog['blog_img'];
    if(isset($_FILES['blog_img']) && $_FILES['blog_img']['name'] != '') {
        $path = $_FILES['blog_img']['name'];
        $path_tmp = $_FILES['blog_img']['tmp_name'];
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        if(!in_array(strtolower($ext), ['jpg', 'jpeg', 'png', 'gif'])) {
            $valid = 0;
            $error_message .= "You must upload jpg, jpeg, gif, or png file for blog image.<br>";
        } else {
            // Delete old image if exists
            if($blog_img != '' && file_exists('../' . $blog_img)) {
                unlink('../' . $blog_img);
            }
            $final_name = 'blog-' . $_REQUEST['id'] . '.' . $ext;
            move_uploaded_file($path_tmp, '../assets/uploads/' . $final_name);
            $blog_img = 'assets/uploads/' . $final_name;
        }
    }

    // Author image upload
    $author_img = $blog['auther_img'];
    if(isset($_FILES['auther_img']) && $_FILES['auther_img']['name'] != '') {
        $path2 = $_FILES['auther_img']['name'];
        $path_tmp2 = $_FILES['auther_img']['tmp_name'];
        $ext2 = pathinfo($path2, PATHINFO_EXTENSION);
        if(!in_array(strtolower($ext2), ['jpg', 'jpeg', 'png', 'gif'])) {
            $valid = 0;
            $error_message .= "You must upload jpg, jpeg, gif, or png file for author image.<br>";
        } else {
            if($author_img != '' && file_exists('../' . $author_img)) {
                unlink('../' . $author_img);
            }
            $final_name2 = 'author-' . $_REQUEST['id'] . '.' . $ext2;
            move_uploaded_file($path_tmp2, '../assets/uploads/' . $final_name2);
            $author_img = 'assets/uploads/' . $final_name2;
        }
    }

    if($valid == 1) {
        $statement = $pdo->prepare("UPDATE blogs SET heading=?, auther_name=?, auther_img=?, blog_name=?, blog_img=?, content=? WHERE id=?");
        $statement->execute([
            $_POST['heading'],
            $_POST['auther_name'],
            $author_img,
            $_POST['blog_name'],
            $blog_img,
            $_POST['content'],
            $_REQUEST['id']
        ]);
        $success_message = 'Blog updated successfully!';
        header("location: blogs.php");
    }
}
?>

<section class="content-header">
    <div class="content-header-left">
        <h1>Edit Blog</h1>
    </div>
    <div class="content-header-right">
        <a href="blogs.php" class="btn btn-primary btn-sm">View All</a>
    </div>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">

            <?php if($error_message): ?>
            <div class="callout callout-danger">
                <p><?php echo $error_message; ?></p>
            </div>
            <?php endif; ?>

            <?php if($success_message): ?>
            <div class="callout callout-success">
                <p><?php echo $success_message; ?></p>
            </div>
            <?php endif; ?>

            <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                <div class="box box-info">
                    <div class="box-body">

                        <!-- Existing Blog Image -->
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Existing Blog Image</label>
                            <div class="col-sm-9" style="padding-top:5px;">
                                <img src="../<?php echo $blog['blog_img']; ?>" alt="Blog Image" style="width:400px;">
                            </div>
                        </div>

                        <!-- Upload New Blog Image -->
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Change Blog Image</label>
                            <div class="col-sm-6" style="padding-top:5px;">
                                <input type="file" name="blog_img">(jpg, jpeg, gif, png allowed)
                            </div>
                        </div>

                        <!-- Existing Author Image -->
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Existing Author Image</label>
                            <div class="col-sm-9" style="padding-top:5px;">
                                <img src="../<?php echo $blog['auther_img']; ?>" alt="Author Image" style="width:100px; border-radius:50%;">
                            </div>
                        </div>

                        <!-- Upload New Author Image -->
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Change Author Image</label>
                            <div class="col-sm-6" style="padding-top:5px;">
                                <input type="file" name="auther_img">(jpg, jpeg, gif, png allowed)
                            </div>
                        </div>

                        <!-- Heading -->
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Heading <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" name="heading" class="form-control" value="<?php echo htmlspecialchars($blog['heading']); ?>" required>
                            </div>
                        </div>

                        <!-- Author Name -->
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Author Name <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" name="auther_name" class="form-control" value="<?php echo htmlspecialchars($blog['auther_name']); ?>" required>
                            </div>
                        </div>

                        <!-- Blog Category -->
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Blog Category <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" name="blog_name" class="form-control" value="<?php echo htmlspecialchars($blog['blog_name']); ?>" required>
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Content <span>*</span></label>
                            <div class="col-sm-8">
                                <textarea name="content" class="form-control" style="height:200px;" required><?php echo htmlspecialchars($blog['content']); ?></textarea>
                            </div>
                        </div>

                        <!-- Submit -->
                        <div class="form-group">
                            <label class="col-sm-2 control-label"></label>
                            <div class="col-sm-6">
                                <button type="submit" name="form1" class="btn btn-success pull-left">Update</button>
                            </div>
                        </div>
                        
                    </div>
                </div>
            </form>

        </div>
    </div>
</section>

<?php require_once('footer.php'); ?>
