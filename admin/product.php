<?php 
require_once('header.php');
require_once('json-helper.php');

// Check if data directory is writable
if(!isDataDirWritable()) {
    die('<div class="alert alert-danger">Data directory is not writable. Please check permissions.</div>');
}
// Handle delete action
if(isset($_POST['delete_product'])) {
    if(deleteProductFromJson($_POST['product_id'])) {
        $_SESSION['success_message'] = "Product deleted successfully!";
    } else {
        $_SESSION['error_message'] = "Failed to delete product!";
    }
    header("Location: product.php");
    exit();
}

// Get all products
$products_data = getProductsFromJson();
$all_products = [];

foreach($products_data as $collection => $categories) {
    foreach($categories as $category => $products) {
        foreach($products as $product) {
            $product['collection'] = $collection;
            $product['category'] = $category;
            $all_products[] = $product;
        }
    }
}
?>

<section class="content-header">
    <div class="content-header-left">
        <h1>View Products</h1>
    </div>
    <div class="content-header-right">
        <a href="product-add.php" class="btn btn-primary btn-sm">Add Product</a>
    </div>
</section>

<?php if(isset($_SESSION['success_message'])): ?>
    <div class="alert alert-success">
        <?php 
        echo $_SESSION['success_message']; 
        unset($_SESSION['success_message']);
        ?>
    </div>
<?php endif; ?>

<?php if(isset($_SESSION['error_message'])): ?>
    <div class="alert alert-danger">
        <?php 
        echo $_SESSION['error_message']; 
        unset($_SESSION['error_message']);
        ?>
    </div>
<?php endif; ?>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-body table-responsive">
                    <table id="example1" class="table table-bordered table-hover table-striped">
                        <thead class="thead-dark">
                            <tr>
                                <th width="10">#</th>
                                <th>Photo</th>
                                <th width="160">Product Name</th>
                                <th width="60">Old Price</th>
                                <th width="60">(C) Price</th>
                                <th width="60">Quantity</th>
                                <th>Featured?</th>
                                <th>Active?</th>
                                <th>Category</th>
                                <th width="80">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(empty($all_products)): ?>
                                <tr>
                                    <td colspan="10" class="text-center">No products found</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($all_products as $i => $row): ?>
                                    <tr>
                                        <td><?php echo $i+1; ?></td>
                                        <td style="width:82px;">
                                            <?php if(!empty($row['image'])): ?>
                                                <img src="<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>" style="width:80px;">
                                            <?php else: ?>
                                                <div style="width:80px; height:80px; background:#eee; display:flex; align-items:center; justify-content:center;">
                                                    No Image
                                                </div>
                                            <?php endif; ?>
                                        </td>
                                        <td><?php echo $row['name']; ?></td>
                                        <td>$<?php echo $row['originalPrice']; ?></td>
                                        <td>$<?php echo $row['price']; ?></td>
                                        <td><?php echo $row['inStock'] ? 'In Stock' : 'Out of Stock'; ?></td>
                                        <td>
                                            <?php echo isset($row['is_featured']) && $row['is_featured'] ? '<span class="badge badge-success" style="background-color:green;">Yes</span>' : '<span class="badge badge-danger" style="background-color:red;">No</span>'; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['inStock'] ? '<span class="badge badge-success" style="background-color:green;">Yes</span>' : '<span class="badge badge-danger" style="background-color:red;">No</span>'; ?>
                                        </td>
                                        <td>
                                            <?php echo ucfirst(str_replace('-', ' ', $row['collection'])); ?>
                                            <br>
                                            <?php echo ucfirst(str_replace(['-', '&'], [' ', ' & '], $row['category'])); ?>
                                        </td>
                                        <td>
                                            <a href="product-edit.php?id=<?php echo $row['id']; ?>" class="btn btn-primary btn-xs">Edit</a>
                                            <form method="POST" style="display:inline;">
                                                <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                                                <button type="submit" name="delete_product" class="btn btn-danger btn-xs" onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once('footer.php'); ?>