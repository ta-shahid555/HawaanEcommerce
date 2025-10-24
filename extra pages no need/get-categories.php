<?php
header('Content-Type: application/json');

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

$collection = $_GET['collection'] ?? '';

if(array_key_exists($collection, $categories)) {
    echo json_encode($categories[$collection]);
} else {
    echo json_encode([]);
}