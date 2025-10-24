<?php require_once('header.php'); ?>

<?php
if (isset($_POST['form1'])) {
	$valid = 1;
	$error_message = '';

	if (empty($_POST['title'])) {
		$valid = 0;
		$error_message .= 'Title can not be empty<br>';
	}

	if (empty($_POST['content'])) {
		$valid = 0;
		$error_message .= 'Content can not be empty<br>';
	}

	if ($valid == 1) {
		$statement = $pdo->prepare("UPDATE tbl_service SET title=?, content=? WHERE id=?");
		$statement->execute([$_POST['title'], $_POST['content'], $_REQUEST['id']]);

		$success_message = 'Service is updated successfully!';
	}
}
?>

<?php
if (!isset($_REQUEST['id'])) {
	header('location: logout.php');
	exit;
} else {
	$statement = $pdo->prepare("SELECT * FROM tbl_service WHERE id=?");
	$statement->execute([$_REQUEST['id']]);
	$total = $statement->rowCount();
	if ($total == 0) {
		header('location: logout.php');
		exit;
	}
	$row = $statement->fetch(PDO::FETCH_ASSOC);
	$title = $row['title'];
	$content = $row['content'];
}
?>

<section class="content-header">
	<div class="content-header-left">
		<h1>Edit Service</h1>
	</div>
	<div class="content-header-right">
		<a href="service.php" class="btn btn-primary btn-sm">View All</a>
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

			<form class="form-horizontal" action="" method="post">
				<div class="box box-info">
					<div class="box-body">
						<div class="form-group">
							<label class="col-sm-2 control-label">Title <span>*</span></label>
							<div class="col-sm-6">
								<input type="text" autocomplete="off" class="form-control" name="title" value="<?php echo htmlspecialchars($title); ?>">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 control-label">Content <span>*</span></label>
							<div class="col-sm-6">
								<textarea class="form-control" name="content" style="height:140px;"><?php echo htmlspecialchars($content); ?></textarea>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 control-label"></label>
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
