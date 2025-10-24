<?php require_once('header.php'); ?>

<?php
// Change Logo
if(isset($_POST['form1'])) {
    $valid = 1;
    $path = $_FILES['photo_logo']['name'];
    $path_tmp = $_FILES['photo_logo']['tmp_name'];

    if($path == '') {
        $valid = 0;
        $error_message = 'You must select a logo image.<br>';
    } else {
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        if( !in_array($ext, ['jpg','jpeg','png','gif']) ) {
            $valid = 0;
            $error_message = 'Only JPG, JPEG, PNG, GIF allowed.<br>';
        }
    }

    if($valid) {
        $statement = $pdo->prepare("SELECT logo FROM tbl_settings WHERE id=1");
        $statement->execute();
        $row = $statement->fetch();
        if(file_exists('../assets/uploads/'.$row['logo'])) {
            unlink('../assets/uploads/'.$row['logo']);
        }

        $final_name = 'logo.'.$ext;
        move_uploaded_file($path_tmp, '../assets/uploads/'.$final_name);

        $statement = $pdo->prepare("UPDATE tbl_settings SET logo=? WHERE id=1");
        $statement->execute([$final_name]);

        $success_message = 'Logo updated successfully.';
    }
}

// Change Favicon
if(isset($_POST['form2'])) {
    $valid = 1;
    $path = $_FILES['photo_favicon']['name'];
    $path_tmp = $_FILES['photo_favicon']['tmp_name'];

    if($path == '') {
        $valid = 0;
        $error_message = 'You must select a favicon image.<br>';
    } else {
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        if( !in_array($ext, ['jpg','jpeg','png','gif']) ) {
            $valid = 0;
            $error_message = 'Only JPG, JPEG, PNG, GIF allowed.<br>';
        }
    }

    if($valid) {
        $statement = $pdo->prepare("SELECT favicon FROM tbl_settings WHERE id=1");
        $statement->execute();
        $row = $statement->fetch();
        if(file_exists('../assets/uploads/'.$row['favicon'])) {
            unlink('../assets/uploads/'.$row['favicon']);
        }

        $final_name = 'favicon.'.$ext;
        move_uploaded_file($path_tmp, '../assets/uploads/'.$final_name);

        $statement = $pdo->prepare("UPDATE tbl_settings SET favicon=? WHERE id=1");
        $statement->execute([$final_name]);

        $success_message = 'Favicon updated successfully.';
    }
}

// Fetch footer settings
$statement = $pdo->prepare("SELECT * FROM tbl_footer_settings LIMIT 1");
$statement->execute();
$footer_row = $statement->fetch(PDO::FETCH_ASSOC);

// Extract values or assign default
$footer_values = [
    'footer_copyright' => $footer_row['footer_copyright'] ?? '',
    'footer_address'   => $footer_row['contact_address'] ?? '',
    'footer_email'     => $footer_row['contact_email'] ?? '',
    'footer_phone'     => $footer_row['contact_phone'] ?? ''
];

// Fetch all footer links (without section_name filtering)
$statement = $pdo->prepare("SELECT * FROM tbl_footer_settings WHERE id = 1");
$statement->execute();
$footer_links = $statement->fetchAll(PDO::FETCH_ASSOC);

// Form submit for footer
if (isset($_POST['form3'])) {
    try {
        // Update main footer fields (assuming 1 row)
        $statement = $pdo->prepare("UPDATE tbl_footer_settings SET 
            footer_copyright = ?, 
            contact_address = ?, 
            contact_email = ?, 
            contact_phone = ?
            WHERE id = ?
        ");
        $statement->execute([
            $_POST['footer_copyright'] ?? '',
            $_POST['contact_address'] ?? '',
            $_POST['contact_email'] ?? '',
            $_POST['contact_phone'] ?? '',
            $footer_row['id'] ?? 1
        ]);

        // Update footer links (if provided)
        if (!empty($_POST['footer_links'])) {
            foreach ($_POST['footer_links'] as $id => $link) {
                $text = $link['text'] ?? '';
                $url = $link['url'] ?? '';
                $stmt = $pdo->prepare("UPDATE tbl_footer_settings SET link_text = ?, link_url = ? WHERE id = ?");
                $stmt->execute([$text, $url, $id]);
            }
        }

        $success_message = "Footer updated successfully.";
        header("Refresh:2");
    } catch (Exception $e) {
        $error_message = "Update error: " . $e->getMessage();
    }
}
?>

<section class="content-header">
  <h1>Website Settings</h1>
</section>

<section class="content">
    <?php if(isset($error_message)): ?>
    <div class="callout callout-danger"><p><?php echo $error_message; ?></p></div>
    <?php endif; ?>

    <?php if(isset($success_message)): ?>
    <div class="callout callout-success"><p><?php echo $success_message; ?></p></div>
    <?php endif; ?>

    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_1" data-toggle="tab">Logo</a></li>
            <li><a href="#tab_2" data-toggle="tab">Favicon</a></li>
            <li><a href="#tab_3" data-toggle="tab">Footer & Contact</a></li>
        </ul>
        <div class="tab-content">
            <!-- Logo -->
            <div class="tab-pane active" id="tab_1">
                <form class="form-horizontal" method="post" enctype="multipart/form-data">
                    <div class="box box-info">
                        <div class="box-body">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Current Logo</label>
                                <div class="col-sm-6">
                                    <img src="../assets/uploads/<?php echo $logo; ?>" height="80">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">New Logo</label>
                                <div class="col-sm-6">
                                    <input type="file" name="photo_logo">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-6">
                                    <button type="submit" name="form1" class="btn btn-success">Update Logo</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Favicon -->
            <div class="tab-pane" id="tab_2">
                <form class="form-horizontal" method="post" enctype="multipart/form-data">
                    <div class="box box-info">
                        <div class="box-body">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Current Favicon</label>
                                <div class="col-sm-6">
                                    <img src="../assets/uploads/<?php echo $favicon; ?>" height="40">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">New Favicon</label>
                                <div class="col-sm-6">
                                    <input type="file" name="photo_favicon">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-6">
                                    <button type="submit" name="form2" class="btn btn-success">Update Favicon</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Footer & Contact -->
            <div class="tab-pane" id="tab_3">
                <form class="form-horizontal" method="post">
                    <div class="box box-info">
                        <div class="box-body">
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Copyright</label>
                                <div class="col-sm-9">
                                    <input type="text" name="footer_copyright" class="form-control" value="<?php echo htmlspecialchars($footer_values['footer_copyright']); ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Address</label>
                                <div class="col-sm-6">
                                    <textarea name="contact_address" class="form-control"><?php echo htmlspecialchars($footer_values['footer_address']); ?></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Email</label>
                                <div class="col-sm-6">
                                    <input type="text" name="contact_email" class="form-control" value="<?php echo htmlspecialchars($footer_values['footer_email']); ?>">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Phone</label>
                                <div class="col-sm-6">
                                    <input type="text" name="contact_phone" class="form-control" value="<?php echo htmlspecialchars($footer_values['footer_phone']); ?>">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-6">
                                    <button type="submit" name="form3" class="btn btn-success">Update Footer</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<script>
setTimeout(() => {
    document.querySelectorAll('.callout').forEach(el => el.style.display = 'none');
}, 2000);
</script>

<?php require_once('footer.php'); ?>