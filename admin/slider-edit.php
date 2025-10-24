<?php require_once('header.php'); ?>

<?php
if(isset($_POST['form1'])) {
    $valid = 1;

    $path = $_FILES['image_url']['name'];
    $path_tmp = $_FILES['image_url']['tmp_name'];

    if($path!='') {
        $ext = pathinfo( $path, PATHINFO_EXTENSION );
        $file_name = basename( $path, '.' . $ext );
        if( $ext!='jpg' && $ext!='png' && $ext!='jpeg' && $ext!='gif' ) {
            $valid = 0;
            $error_message .= 'You must have to upload jpg, jpeg, gif or png file<br>';
        }
    }

    if($valid == 1) {
        if($path == '') {
            $statement = $pdo->prepare("UPDATE tbl_slider SET title=?, subtitle=?, price_text=?, button_text=?, button_url=?, display_order=?, is_active=? WHERE id=?");
            $statement->execute(array(
                $_POST['title'],
                $_POST['subtitle'],
                $_POST['price_text'],
                $_POST['button_text'],
                $_POST['button_url'],
                $_POST['display_order'],
                $_POST['is_active'],
                $_REQUEST['id']
            ));
        } else {
            unlink('../'.$_POST['current_image']);

            $final_name = 'slider-'.$_REQUEST['id'].'.'.$ext;
            move_uploaded_file( $path_tmp, '../assets/uploads/'.$final_name );

            $statement = $pdo->prepare("UPDATE tbl_slider SET image_url=?, title=?, subtitle=?, price_text=?, button_text=?, button_url=?, display_order=?, is_active=? WHERE id=?");
            $statement->execute(array(
                'assets/uploads/'.$final_name,
                $_POST['title'],
                $_POST['subtitle'],
                $_POST['price_text'],
                $_POST['button_text'],
                $_POST['button_url'],
                $_POST['display_order'],
                $_POST['is_active'],
                $_REQUEST['id']
            ));
        }   

        $success_message = 'Slider is updated successfully!';
    }
}
?>

<?php
if(!isset($_REQUEST['id'])) {
    header('location: logout.php');
    exit;
} else {
    // Check the id is valid or not
    $statement = $pdo->prepare("SELECT * FROM tbl_slider WHERE id=?");
    $statement->execute(array($_REQUEST['id']));
    $total = $statement->rowCount();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    if( $total == 0 ) {
        header('location: logout.php');
        exit;
    }
}
?>

<section class="content-header">
    <div class="content-header-left">
        <h1>Edit Slider</h1>
    </div>
    <div class="content-header-right">
        <a href="slider.php" class="btn btn-primary btn-sm">View All</a>
    </div>
</section>

<?php
$statement = $pdo->prepare("SELECT * FROM tbl_slider WHERE id=?");
$statement->execute(array($_REQUEST['id']));
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
    $image_url    = $row['image_url'];
    $title        = $row['title'];
    $subtitle     = $row['subtitle'];
    $price_text   = $row['price_text'];
    $button_text  = $row['button_text'];
    $button_url   = $row['button_url'];
    $display_order = $row['display_order'];
    $is_active    = $row['is_active'];
}
?>

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
                <input type="hidden" name="current_image" value="<?php echo $image_url; ?>">
                <div class="box box-info">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Existing Photo</label>
                            <div class="col-sm-9" style="padding-top:5px">
                                <img src="../<?php echo $image_url; ?>" alt="Slider Photo" style="width:400px;">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Photo </label>
                            <div class="col-sm-6" style="padding-top:5px">
                                <input type="file" name="image_url">(Only jpg, jpeg, gif and png are allowed)
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Title </label>
                            <div class="col-sm-6">
                                <input type="text" autocomplete="off" class="form-control" name="title" value="<?php echo $title; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Subtitle </label>
                            <div class="col-sm-6">
                                <textarea class="form-control" name="subtitle" style="height:140px;"><?php echo $subtitle; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Price Text </label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="price_text" value="<?php echo $price_text; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Button Text </label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="button_text" value="<?php echo $button_text; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Button URL </label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="button_url" value="<?php echo $button_url; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Display Order </label>
                            <div class="col-sm-6">
                                <input type="number" class="form-control" name="display_order" value="<?php echo $display_order; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Active? </label>
                            <div class="col-sm-6">
                                <select name="is_active" class="form-control">
                                    <option value="1" <?php echo ($is_active == 1) ? 'selected' : ''; ?>>Active</option>
                                    <option value="0" <?php echo ($is_active == 0) ? 'selected' : ''; ?>>Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label"></label>
                            <div class="col-sm-6">
                                <button type="submit" class="btn btn-success pull-left" name="form1">Update</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

<?php require_once('footer.php'); ?>