<?php
function getProductsFromJson() {
    $json_file = __DIR__.'/../data/products.json';
    if(!file_exists($json_file)) {
        // Create directory if not exists
        if(!is_dir(dirname($json_file))) {
            mkdir(dirname($json_file), 0755, true);
        }
        // Initialize with empty structure
        file_put_contents($json_file, json_encode([
            'mens-collection' => [], 
            'womens-collection' => [], 
            'kids-collection' => []
        ], JSON_PRETTY_PRINT));
    }
    return json_decode(file_get_contents($json_file), true);
}

function saveProductsToJson($data) {
    $json_file = __DIR__.'/../data/products.json';
    // Create backup before saving
    if(file_exists($json_file)) {
        copy($json_file, $json_file.'.bak');
    }
    $result = file_put_contents($json_file, json_encode($data, JSON_PRETTY_PRINT));
    return $result !== false;
}

function addProductToJson($collection, $category, $product) {
    $data = getProductsFromJson();
    if(!isset($data[$collection][$category])) {
        $data[$collection][$category] = [];
    }
    $data[$collection][$category][] = $product;
    return saveProductsToJson($data);
}

function updateProductInJson($product_id, $updated_product) {
    $data = getProductsFromJson();
    foreach($data as $collection => $categories) {
        foreach($categories as $category => $products) {
            foreach($products as $index => $product) {
                if($product['id'] == $product_id) {
                    $data[$collection][$category][$index] = $updated_product;
                    return saveProductsToJson($data);
                }
            }
        }
    }
    return false;
}

function deleteProductFromJson($product_id) {
    $data = getProductsFromJson();
    foreach($data as $collection => $categories) {
        foreach($categories as $category => $products) {
            foreach($products as $index => $product) {
                if($product['id'] == $product_id) {
                    array_splice($data[$collection][$category], $index, 1);
                    return saveProductsToJson($data);
                }
            }
        }
    }
    return false;
}

function generateProductId($prefix) {
    return uniqid($prefix);
}

// Check if data directory is writable
function isDataDirWritable() {
    $data_dir = __DIR__.'/../data';
    if(!is_dir($data_dir)) {
        return mkdir($data_dir, 0755, true);
    }
    return is_writable($data_dir);
}
?>