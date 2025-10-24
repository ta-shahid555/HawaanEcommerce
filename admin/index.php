<?php require_once('header.php'); ?>

<section class="content-header">
	<h1>Dashboard Overview</h1>
</section>

<?php
// Total Products
$statement = $pdo->prepare("SELECT COUNT(*) FROM products");
$statement->execute();
$total_product = $statement->fetchColumn();

// Total Categories (unique)
$statement = $pdo->prepare("SELECT COUNT(DISTINCT category) FROM products");
$statement->execute();
$total_categories = $statement->fetchColumn();

// Total Orders
$statement = $pdo->prepare("SELECT COUNT(*) FROM orders");
$statement->execute();
$total_orders = $statement->fetchColumn();

// Pending Orders
$statement = $pdo->prepare("SELECT COUNT(*) FROM orders WHERE status = 'Pending'");
$statement->execute();
$pending_orders = $statement->fetchColumn();

// Completed Orders
$statement = $pdo->prepare("SELECT COUNT(*) FROM orders WHERE status = 'Completed'");
$statement->execute();
$completed_orders = $statement->fetchColumn();

// Removed Orders
$statement = $pdo->prepare("SELECT COUNT(*) FROM orders WHERE status = 'Removed'");
$statement->execute();
$removed_orders = $statement->fetchColumn();

// Total Users
$statement = $pdo->prepare("SELECT COUNT(*) FROM users");
$statement->execute();
$total_users = $statement->fetchColumn();

// Total Subscribers
$statement = $pdo->prepare("SELECT COUNT(*) FROM tbl_subscriber WHERE id = 1");
$statement->execute();
$total_subscribers = $statement->fetchColumn();
?>

<section class="content">
	<div class="row">
		<!-- Products -->
		<div class="col-lg-3 col-xs-6">
			<div class="small-box bg-primary">
				<div class="inner">
					<h3><?php echo $total_product; ?></h3>
					<p>Total Products</p>
				</div>
				<div class="icon">
					<i class="bi bi-box-seam"></i>
				</div>
			</div>
		</div>

		<!-- Categories -->
		<div class="col-lg-3 col-xs-6">
			<div class="small-box bg-success">
				<div class="inner">
					<h3><?php echo $total_categories; ?></h3>
					<p>Total Categories</p>
				</div>
				<div class="icon">
					<i class="bi bi-tags"></i>
				</div>
			</div>
		</div>

		<!-- Total Orders -->
		<div class="col-lg-3 col-xs-6">
			<div class="small-box bg-info">
				<div class="inner">
					<h3><?php echo $total_orders; ?></h3>
					<p>Total Orders</p>
				</div>
				<div class="icon">
					<i class="bi bi-cart-check"></i>
				</div>
			</div>
		</div>

		<!-- Pending Orders -->
		<div class="col-lg-3 col-xs-6">
			<div class="small-box bg-warning">
				<div class="inner">
					<h3><?php echo $pending_orders; ?></h3>
					<p>Pending Orders</p>
				</div>
				<div class="icon">
					<i class="bi bi-hourglass-split"></i>
				</div>
			</div>
		</div>

		<!-- Completed Orders -->
		<div class="col-lg-3 col-xs-6">
			<div class="small-box bg-teal">
				<div class="inner">
					<h3><?php echo $completed_orders; ?></h3>
					<p>Completed Orders</p>
				</div>
				<div class="icon">
					<i class="bi bi-check-circle"></i>
				</div>
			</div>
		</div>

		<!-- Removed Orders -->
		<div class="col-lg-3 col-xs-6">
			<div class="small-box bg-danger">
				<div class="inner">
					<h3><?php echo $removed_orders; ?></h3>
					<p>Removed Orders</p>
				</div>
				<div class="icon">
					<i class="bi bi-trash"></i>
				</div>
			</div>
		</div>

		<!-- Total Users -->
		<div class="col-lg-3 col-xs-6">
			<div class="small-box bg-purple">
				<div class="inner">
					<h3><?php echo $total_users; ?></h3>
					<p>Total Users</p>
				</div>
				<div class="icon">
					<i class="bi bi-people"></i>
				</div>
			</div>
		</div>

		<!-- Total Subscribers -->
		<div class="col-lg-3 col-xs-6">
			<div class="small-box bg-pink">
				<div class="inner">
					<h3><?php echo $total_subscribers; ?></h3>
					<p>Active Subscribers</p>
				</div>
				<div class="icon">
					<i class="bi bi-envelope-paper"></i>
				</div>
			</div>
		</div>
	</div>
</section>

<?php require_once('footer.php'); ?>
