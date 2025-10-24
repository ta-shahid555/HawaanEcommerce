<?php
require_once('header.php');
require_once('json-helper.php');

$collections = [
    'mens-collection' => 'Men\'s Collection',
    'womens-collection' => 'Women\'s Collection',
    'kids-collection' => 'Kids Collection'
];

$categories = [
    'mens-collection' => [
        'formal' => 'Formal Wear',
        'casual' => 'Casual Wear',
        'tshirts' => 'T-Shirts',
        'jackets' => 'Jackets',
        'shorts' => 'Shorts'
    ],
    'womens-collection' => [
        'formal' => 'Formal Wear',
        'kurtas&suits' => 'Kurtas & Suits',
        'saree' => 'Saree',
        'lehenga&cholis' => 'Lehenga & Cholis',
        'dupattas&shawls' => 'Dupattas & Shawls'
    ],
    'kids-collection' => [
        'formal' => 'Formal Wear',
        'casual' => 'Casual Wear',
        'shorts' => 'Shorts',
        'trousers' => 'Trousers',
        'tshirts' => 'T-Shirts'
    ]
];

$product = null;
$collection = '';
$category = '';

if(isset($_GET['id'])) {
    $data = getProductsFromJson();
    foreach($data as $col => $cats) {
        foreach($cats as $cat => $products) {
            foreach($products as $p) {
                if($p['id'] == $_GET['id']) {
                    $product = $p;
                    $collection = $col;
                    $category = $cat;
                    break 3;
                }
            }
        }
    }
}

if(!$product) {
    $_SESSION['error_message'] = "Product not found!";
    header("Location: product.php");
    exit();
}

if(isset($_POST['update_product'])) {
    $updated_product = [
        'id' => $product['id'],
        'name' => $_POST['name'],
        'price' => floatval($_POST['price']),
        'originalPrice' => floatval($_POST['original_price']),
        'image' => $_POST['image'],
        'hoverImage' => $_POST['hover_image'],
        'description' => $_POST['description'],
        'brand' => $_POST['brand'],
        'rating' => intval($_POST['rating']),
        'inStock' => isset($_POST['in_stock']),
        'is_featured' => isset($_POST['is_featured']),
        'sizes' => explode(',', $_POST['sizes']),
        'colors' => explode(',', $_POST['colors'])
    ];
    
    if(updateProductInJson($product['id'], $updated_product)) {
        $_SESSION['success_message'] = "Product updated successfully!";
        header("Location: product.php");
        exit();
    } else {
        $error_message = "Failed to update product!";
    }
}
?>

<section class="content-header">
    <div class="content-header-left">
        <h1>Edit Product</h1>
    </div>
    <div class="content-header-right">
        <a href="product.php" class="btn btn-primary btn-sm">View All</a>
    </div>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <?php if(isset($error_message)): ?>
                <div class="alert alert-danger">
                    <?php echo $error_message; ?>
                </div>
            <?php endif; ?>
            
            <form class="form-horizontal" action="" method="post">
                <div class="box box-info">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Collection</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" value="<?php echo isset($collections[$collection]) ? $collections[$collection] : 'Unknown Collection'; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Category</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" value="<?php 
                                    if(isset($categories[$collection]) && isset($categories[$collection][$category])) {
                                        echo $categories[$collection][$category];
                                    } else {
                                        echo 'Unknown Category';
                                    }
                                ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Product Name <span>*</span></label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="name" value="<?php echo htmlspecialchars($product['name']); ?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Current Price <span>*</span></label>
                            <div class="col-sm-4">
                                <input type="number" step="0.01" class="form-control" name="price" value="<?php echo htmlspecialchars($product['price']); ?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Original Price <span>*</span></label>
                            <div class="col-sm-4">
                                <input type="number" step="0.01" class="form-control" name="original_price" value="<?php echo htmlspecialchars($product['originalPrice']); ?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Image URL <span>*</span></label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="image" value="<?php echo htmlspecialchars($product['image']); ?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Hover Image URL</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="hover_image" value="<?php echo htmlspecialchars($product['hoverImage']); ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Description <span>*</span></label>
                            <div class="col-sm-8">
                                <textarea class="form-control" name="description" rows="3" required><?php echo htmlspecialchars($product['description']); ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Brand</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="brand" value="<?php echo htmlspecialchars($product['brand']); ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Rating (1-5)</label>
                            <div class="col-sm-4">
                                <input type="number" min="1" max="5" class="form-control" name="rating" value="<?php echo htmlspecialchars($product['rating']); ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Available Sizes (comma separated)</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="sizes" value="<?php echo htmlspecialchars(implode(',', $product['sizes'])); ?>" placeholder="S,M,L,XL">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Available Colors (comma separated)</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="colors" value="<?php echo htmlspecialchars(implode(',', $product['colors'])); ?>" placeholder="Black,Blue,Red">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">In Stock?</label>
                            <div class="col-sm-4">
                                <input type="checkbox" name="in_stock" <?php echo $product['inStock'] ? 'checked' : ''; ?>>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Featured Product?</label>
                            <div class="col-sm-4">
                                <input type="checkbox" name="is_featured" <?php echo isset($product['is_featured']) && $product['is_featured'] ? 'checked' : ''; ?>>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-success pull-left" name="update_product">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

<?php require_once('footer.php'); ?>