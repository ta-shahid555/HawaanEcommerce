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

$collection = $_GET['collection'] ?? '';

if(array_key_exists($collection, $categories)) {
    echo json_encode($categories[$collection]);
} else {
    echo json_encode([]);
}