<?php require_once('header.php'); ?>

<?php
if(isset($_POST['form1'])) {
    $valid = 1;

    if($valid == 1) {
        $statement = $pdo->prepare("INSERT INTO tbl_slider 
                                  (image_url, title, subtitle, price_text, button_text, button_url, display_order, is_active) 
                                  VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $statement->execute(array(
            'assets/images/default-slider.jpg', // Default image path
            $_POST['title'],
            $_POST['subtitle'],
            $_POST['price_text'],
            $_POST['button_text'],
            $_POST['button_url'],
            $_POST['display_order'],
            1 // Default active status
        ));
        
        $success_message = 'Slider is added successfully!';

        unset($_POST['title']);
        unset($_POST['subtitle']);
        unset($_POST['price_text']);
        unset($_POST['button_text']);
        unset($_POST['button_url']);
        unset($_POST['display_order']);
    }
}
?>

<section class="content-header">
    <div class="content-header-left">
        <h1>Add Slider</h1>
    </div>
    <div class="content-header-right">
        <a href="slider.php" class="btn btn-primary btn-sm">View All</a>
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

            <form class="form-horizontal" action="" method="post">
                <div class="box box-info">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Title <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="title" value="<?php if(isset($_POST['title'])){echo $_POST['title'];} ?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Subtitle <span>*</span></label>
                            <div class="col-sm-6">
                                <textarea class="form-control" name="subtitle" style="height:140px;" required><?php if(isset($_POST['subtitle'])){echo $_POST['subtitle'];} ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Price Text <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="price_text" value="<?php if(isset($_POST['price_text'])){echo $_POST['price_text'];} ?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Button Text <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="button_text" value="<?php if(isset($_POST['button_text'])){echo $_POST['button_text'];} ?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Button URL <span>*</span></label>
                            <div class="col-sm-6">
                                <input type="text" class="form-control" name="button_url" value="<?php if(isset($_POST['button_url'])){echo $_POST['button_url'];} ?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Display Order</label>
                            <div class="col-sm-6">
                                <input type="number" class="form-control" name="display_order" value="<?php if(isset($_POST['display_order'])){echo $_POST['display_order'];} else {echo 0;} ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label"></label>
                            <div class="col-sm-6">
                                <button type="submit" class="btn btn-success pull-left" name="form1">Submit</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

<?php require_once('footer.php'); ?>