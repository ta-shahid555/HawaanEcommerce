<?php require_once('header.php'); ?>

<?php
// Initialize error and success messages
$error_message = '';
$success_message = '';

if(isset($_POST['form1'])) {
    $valid = 1;

    if(empty($_POST['full_name'])) {
        $valid = 0;
        $error_message .= "Name can not be empty<br>";
    }

    if(empty($_POST['email'])) {
        $valid = 0;
        $error_message .= "Email can not be empty<br>";
    } else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $valid = 0;
        $error_message .= "Invalid Email format<br>";
    } else {
        // Check if email already exists (exclude current user)
        $stmt = $pdo->prepare("SELECT * FROM tbl_user WHERE email=? AND id!=?");
        $stmt->execute([$_POST['email'], $_SESSION['user']['id']]);
        if($stmt->rowCount() > 0) {
            $valid = 0;
            $error_message .= "Email already exists<br>";
        }
    }

    if($valid) {
        // Update database
        $stmt = $pdo->prepare("UPDATE tbl_user SET full_name=?, email=? WHERE id=?");
        $stmt->execute([$_POST['full_name'], $_POST['email'], $_SESSION['user']['id']]);

        // Update session data
        $_SESSION['user']['full_name'] = $_POST['full_name'];
        $_SESSION['user']['email'] = $_POST['email'];

        $success_message = "Profile updated successfully.";
    }
}

// Fetch current user data from DB to populate form
$stmt = $pdo->prepare("SELECT * FROM tbl_user WHERE id=?");
$stmt->execute([$_SESSION['user']['id']]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

$full_name = $user['full_name'] ?? '';
$email = $user['email'] ?? '';

if(isset($_POST['form2'])) {
    $valid = 1;
    $error_message = '';

    $path = $_FILES['photo']['name'];
    $path_tmp = $_FILES['photo']['tmp_name'];

    if($path != '') {
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        $allowed = ['jpg', 'jpeg', 'png', 'gif'];

        if(!in_array(strtolower($ext), $allowed)) {
            $valid = 0;
            $error_message .= "Only JPG, JPEG, PNG and GIF files are allowed.<br>";
        }
    } else {
        $valid = 0;
        $error_message .= "Please select an image to upload.<br>";
    }

    if($valid) {
        $final_name = 'user-' . $_SESSION['user']['id'] . '.' . $ext;
        $destination = '../assets/uploads/' . $final_name;

        if(move_uploaded_file($path_tmp, $destination)) {
            // update DB
            $stmt = $pdo->prepare("UPDATE tbl_user SET photo=? WHERE id=?");
            $stmt->execute([$final_name, $_SESSION['user']['id']]);

            // update session
            $_SESSION['user']['photo'] = $final_name;

            $success_message = "Photo uploaded successfully.";
        } else {
            $error_message .= "File move failed. Check folder permission.<br>";
        }
    }
}
?>

<section class="content-header">
	<div class="content-header-left">
		<h1>Edit Profile</h1>
	</div>
</section>

<section class="content">

	<div class="row">
		<div class="col-md-12">

            <?php if($error_message != ''): ?>
                <div class="alert alert-danger"><?php echo $error_message; ?></div>
            <?php endif; ?>

            <?php if($success_message != ''): ?>
                <div class="alert alert-success"><?php echo $success_message; ?></div>
            <?php endif; ?>

			<div class="nav-tabs-custom">
				<ul class="nav nav-tabs">
					<li class="active"><a href="#tab_1" data-toggle="tab">Update Information</a></li>
					<li><a href="#tab_2" data-toggle="tab">Update Photo</a></li>
					<li><a href="#tab_3" data-toggle="tab">Update Password</a></li>
				</ul>
				<div class="tab-content">
      				<div class="tab-pane active" id="tab_1">
					
					<form action="" method="post" class="form-horizontal">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Name *</label>
                            <div class="col-sm-6">
                                <input type="text" name="full_name" class="form-control" value="<?php echo htmlspecialchars($full_name); ?>" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label">Email *</label>
                            <div class="col-sm-6">
                                <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($email); ?>" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-6">
                                <button type="submit" name="form1" class="btn btn-success">Update Information</button>
                            </div>
                        </div>
                    </form>

      				</div>

      				<div class="tab-pane" id="tab_2">
						<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
							<div class="box box-info">
								<div class="box-body">
									<div class="form-group">
							            <label for="" class="col-sm-2 control-label">New Photo</label>
							            <div class="col-sm-6" style="padding-top:6px;">
							                <input type="file" name="photo">
							            </div>
							        </div>
							        <div class="form-group">
										<label for="" class="col-sm-2 control-label"></label>
										<div class="col-sm-6">
											<button type="submit" class="btn btn-success pull-left" name="form2">Update Photo</button>
										</div>
									</div>
								</div>
							</div>
						</form>
      				</div>

      				<div class="tab-pane" id="tab_3">
						<form class="form-horizontal" action="" method="post">
						<div class="box box-info">
							<div class="box-body">
								<div class="form-group">
									<label for="" class="col-sm-2 control-label">Password </label>
									<div class="col-sm-4">
										<input type="password" class="form-control" name="password">
									</div>
								</div>
								<div class="form-group">
									<label for="" class="col-sm-2 control-label">Retype Password </label>
									<div class="col-sm-4">
										<input type="password" class="form-control" name="re_password">
									</div>
								</div>
						        <div class="form-group">
									<label for="" class="col-sm-2 control-label"></label>
									<div class="col-sm-6">
										<button type="submit" class="btn btn-success pull-left" name="form3">Update Password</button>
									</div>
								</div>
							</div>
						</div>
						</form>
      				</div>
      			</div>
			</div>			

		</div>
	</div>
</section>

<?php require_once('footer.php'); ?>
