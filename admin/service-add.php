<?php require_once('header.php'); ?>

<?php
if (isset($_POST['form1'])) {
	$valid = 1;
	$error_message = '';

	if (empty($_POST['title'])) {
		$valid = 0;
		$error_message .= 'Title cannot be empty<br>';
	}

	if (empty($_POST['content'])) {
		$valid = 0;
		$error_message .= 'Content cannot be empty<br>';
	}

	if (empty($_POST['icon'])) {
		$valid = 0;
		$error_message .= 'Icon class cannot be empty<br>';
	}

	if ($valid == 1) {
		$statement = $pdo->prepare("INSERT INTO tbl_service (title, content, icon) VALUES (?, ?, ?)");
		$statement->execute([
			$_POST['title'],
			$_POST['content'],
			$_POST['icon']
		]);

		$success_message = 'Service added successfully!';
		unset($_POST['title'], $_POST['content'], $_POST['icon']);
	}
}
?>

<section class="content-header">
	<div class="content-header-left">
		<h1>Add Service</h1>
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
								<input type="text" autocomplete="off" class="form-control" name="title" value="<?php if (isset($_POST['title'])) echo htmlspecialchars($_POST['title']); ?>">
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 control-label">Content <span>*</span></label>
							<div class="col-sm-6">
								<textarea class="form-control" name="content" style="height:200px;"><?php if (isset($_POST['content'])) echo htmlspecialchars($_POST['content']); ?></textarea>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 control-label">Icon Class <span>*</span></label>
							<div class="col-sm-6">
								<input type="text" class="form-control" name="icon" placeholder="e.g., bi bi-rocket-fill" value="<?php if (isset($_POST['icon'])) echo htmlspecialchars($_POST['icon']); ?>">
								<p class="help-block">Use Bootstrap Icons like <code>bi bi-rocket-fill</code></p>
							</div>
						</div>

						<div class="form-group">
							<label class="col-sm-2 control-label"></label>
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
