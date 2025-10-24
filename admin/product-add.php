<?php
require_once('header.php');
require_once('json-helper.php');

// Define collections and categories based on data.json structure
$collections = [
    'mens-collection' => 'Men\'s Collection',
    'womens-collection' => 'Women\'s Collection',
    'kids-collection' => 'Kids Collection',
    'makeup' => 'Makeup',
    'perfumes' => 'Perfumes',
    'jewellery' => 'Jewellery',
    'mens-accessories' => 'Men\'s Accessories',
    'electronics' => 'Electronics'
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
    ],
    'makeup' => [
        'lipstick' => 'Lipstick',
        'eyeliner' => 'Eyeliner',
        'primer' => 'Primer',
        'mascara' => 'Mascara'
    ],
    'perfumes' => [
        'floral' => 'Floral',
        'oriental' => 'Oriental',
        'woody' => 'Woody',
        'fougere' => 'Fougere'
    ],
    'jewellery' => [
        'earrings' => 'Earrings',
        'couplerings' => 'Couple Rings',
        'necklace' => 'Necklace',
        'bracelet' => 'Bracelet'
    ],
    'mens-accessories' => [
        'sunglasses' => 'Sunglasses',
        'watches' => 'Watches',
        'wallets' => 'Wallets',
        'shoes' => 'Shoes'
    ],
    'electronics' => [
        'sw' => 'Smart Watches',
        'stv' => 'Smart TVs',
        'mouse' => 'Mouse',
        'microphone' => 'Microphone'
    ]
];

if(isset($_POST['add_product'])) {
    $collection = $_POST['collection'];
    $category = $_POST['category'];
    
    $new_product = [
        'id' => generateProductId(substr($collection, 0, 1) . substr($category, 0, 1)),
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
    
    if(addProductToJson($collection, $category, $new_product)) {
        $_SESSION['success_message'] = "Product added successfully!";
        header("Location: product.php");
        exit();
    } else {
        $error_message = "Failed to add product!";
    }
}
?>

<section class="content-header">
    <div class="content-header-left">
        <h1>Add New Product</h1>
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
                            <label for="" class="col-sm-2 control-label">Collection <span>*</span></label>
                            <div class="col-sm-4">
                                <select class="form-control" name="collection" id="collection" required>
                                    <option value="">Select Collection</option>
                                    <?php foreach($collections as $key => $value): ?>
                                        <option value="<?php echo $key; ?>" <?php echo isset($_POST['collection']) && $_POST['collection'] == $key ? 'selected' : ''; ?>>
                                            <?php echo $value; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Category <span>*</span></label>
                            <div class="col-sm-4">
                                <select class="form-control" name="category" id="category" required>
                                    <option value="">Select Collection First</option>
                                    <?php 
                                    // Preselect category if form was submitted but had errors
                                    if(isset($_POST['collection'])) {
                                        if(isset($categories[$_POST['collection']])) {
                                            foreach($categories[$_POST['collection']] as $key => $value) {
                                                echo '<option value="'.$key.'"';
                                                echo (isset($_POST['category']) && $_POST['category'] == $key) ? ' selected' : '';
                                                echo '>'.$value.'</option>';
                                            }
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Product Name <span>*</span></label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="name" value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Current Price <span>*</span></label>
                            <div class="col-sm-4">
                                <input type="number" step="0.01" class="form-control" name="price" value="<?php echo isset($_POST['price']) ? htmlspecialchars($_POST['price']) : ''; ?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Original Price <span>*</span></label>
                            <div class="col-sm-4">
                                <input type="number" step="0.01" class="form-control" name="original_price" value="<?php echo isset($_POST['original_price']) ? htmlspecialchars($_POST['original_price']) : ''; ?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Image URL <span>*</span></label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="image" value="<?php echo isset($_POST['image']) ? htmlspecialchars($_POST['image']) : ''; ?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Hover Image URL</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="hover_image" value="<?php echo isset($_POST['hover_image']) ? htmlspecialchars($_POST['hover_image']) : ''; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Description <span>*</span></label>
                            <div class="col-sm-8">
                                <textarea class="form-control" name="description" rows="3" required><?php echo isset($_POST['description']) ? htmlspecialchars($_POST['description']) : ''; ?></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Brand</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="brand" value="<?php echo isset($_POST['brand']) ? htmlspecialchars($_POST['brand']) : ''; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Rating (1-5)</label>
                            <div class="col-sm-4">
                                <input type="number" min="1" max="5" class="form-control" name="rating" value="<?php echo isset($_POST['rating']) ? htmlspecialchars($_POST['rating']) : '3'; ?>">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Available Sizes (comma separated)</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="sizes" value="<?php echo isset($_POST['sizes']) ? htmlspecialchars($_POST['sizes']) : ''; ?>" placeholder="S,M,L,XL">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Available Colors (comma separated)</label>
                            <div class="col-sm-4">
                                <input type="text" class="form-control" name="colors" value="<?php echo isset($_POST['colors']) ? htmlspecialchars($_POST['colors']) : ''; ?>" placeholder="Black,Blue,Red">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">In Stock?</label>
                            <div class="col-sm-4">
                                <input type="checkbox" name="in_stock" <?php echo !isset($_POST['in_stock']) || $_POST['in_stock'] ? 'checked' : ''; ?>>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="" class="col-sm-2 control-label">Featured Product?</label>
                            <div class="col-sm-4">
                                <input type="checkbox" name="is_featured" <?php echo isset($_POST['is_featured']) && $_POST['is_featured'] ? 'checked' : ''; ?>>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn btn-success pull-left" name="add_product">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $('#collection').change(function() {
        var collection = $(this).val();
        var $category = $('#category');
        
        $category.empty().prop('disabled', true);
        
        if(!collection) {
            $category.append('<option value="">First select a Collection</option>');
            return;
        }
        
        // Show loading
        $category.append('<option value="">Loading...</option>');
        
        $.ajax({
            url: 'get-categories.php',
            type: 'GET',
            dataType: 'json',
            data: { collection: collection },
            success: function(data) {
                $category.empty();
                
                if(data && Object.keys(data).length > 0) {
                    $category.append('<option value="">Select Category</option>');
                    $.each(data, function(key, value) {
                        $category.append($('<option>', {
                            value: key,
                            text: value
                        }));
                    });
                    $category.prop('disabled', false);
                } else {
                    $category.append('<option value="">No categories found</option>');
                }
            },
            error: function(xhr, status, error) {
                $category.empty().append('<option value="">Error loading categories</option>');
            }
        });
    });
});
</script>

<?php require_once('footer.php'); ?>