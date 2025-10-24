<?php require_once('header.php'); ?>

<?php
if (isset($_POST['form1'])) {
    $valid = 1;
    $blog_img_path = '';
    $author_img_path = '';

    $blog_img = $_FILES['blog_img']['name'];
    $author_img = $_FILES['auther_img']['name'];
    $blog_img_tmp = $_FILES['blog_img']['tmp_name'];
    $author_img_tmp = $_FILES['auther_img']['tmp_name'];

    if ($blog_img != '') {
        $ext = pathinfo($blog_img, PATHINFO_EXTENSION);
        if (!in_array($ext, ['jpg', 'jpeg', 'png', 'gif'])) {
            $valid = 0;
            $error_message = 'Blog image must be jpg, jpeg, png or gif<br>';
        } else {
            $blog_img_path = 'assets/uploads/blog_' . time() . '.' . $ext;
            move_uploaded_file($blog_img_tmp, '../' . $blog_img_path);
        }
    }

    if ($author_img != '') {
        $ext2 = pathinfo($author_img, PATHINFO_EXTENSION);
        if (!in_array($ext2, ['jpg', 'jpeg', 'png', 'gif'])) {
            $valid = 0;
            $error_message .= 'Author image must be jpg, jpeg, png or gif<br>';
        } else {
            $author_img_path = 'assets/uploads/author_' . time() . '.' . $ext2;
            move_uploaded_file($author_img_tmp, '../' . $author_img_path);
        }
    }

    if ($valid) {
        $stmt = $pdo->prepare("INSERT INTO blogs (blog_img, auther_img, auther_name, blog_name, heading, content, date) VALUES (?, ?, ?, ?, ?, ?, NOW())");
        $stmt->execute([
            $blog_img_path,
            $author_img_path,
            $_POST['auther_name'],
            $_POST['blog_name'],
            $_POST['heading'],
            $_POST['content']
        ]);
        $success_message = "Blog added successfully!";
    }
}
?>

<section class="content-header">
    <div class="content-header-left">
        <h1>Add Blog</h1>
    </div>
    <div class="content-header-right">
        <a href="blog.php" class="btn btn-primary btn-sm">View All</a>
    </div>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <?php if (!empty($error_message)): ?>
                <div class="callout callout-danger">
                    <p><?php echo $error_message; ?></p>
                </div>
            <?php endif; ?>

            <?php if (!empty($success_message)): ?>
                <div class="callout callout-success">
                    <p><?php echo $success_message; ?></p>
                </div>
            <?php endif; ?>

            <form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
                <div class="box box-info">
                    <div class="box-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Blog Image *</label>
                            <div class="col-sm-6">
                                <input type="file" name="blog_img" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Author Image *</label>
                            <div class="col-sm-6">
                                <input type="file" name="auther_img" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Author Name *</label>
                            <div class="col-sm-6">
                                <input type="text" name="auther_name" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Blog Category *</label>
                            <div class="col-sm-6">
                                <input type="text" name="blog_name" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Heading *</label>
                            <div class="col-sm-6">
                                <input type="text" name="heading" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Content *</label>
                            <div class="col-sm-6">
                                <textarea name="content" class="form-control" rows="8" required></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-6 col-sm-offset-2">
                                <button type="submit" class="btn btn-success" name="form1">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

<?php require_once('footer.php'); ?>
