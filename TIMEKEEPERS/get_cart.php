<?php
session_start();
header('Content-Type: application/json');
require_once 'database/connection.php';

if (isset($_SESSION['user'])) {
    $userId = $_SESSION['user']['id'];


    $cartQuery = $db->prepare("
        SELECT keranjang.*, barang.name, barang.price, barang.image 
        FROM keranjang 
        JOIN barang ON keranjang.barang_id = barang.id 
        WHERE keranjang.users_id = ?
    ");
    $cartQuery->bind_param('i', $userId);
    $cartQuery->execute();
    $cartItems = $cartQuery->get_result()->fetch_all(MYSQLI_ASSOC);


    $mergedCartItems = [];
    foreach ($cartItems as $item) {
        $productId = $item['barang_id'];
        if (isset($mergedCartItems[$productId])) {
            $mergedCartItems[$productId]['quantity'] += $item['quantity'];
        } else {
            $mergedCartItems[$productId] = $item;
        }
    }
    $mergedCartItems = array_values($mergedCartItems);

    
    $totalItems = 0;
    $totalPrice = 0;
    foreach ($mergedCartItems as $item) {
        $totalItems += $item['quantity'];
        $totalPrice += $item['price'] * $item['quantity'];
    }

    echo json_encode([
        'cartItems' => $mergedCartItems,
        'totalItems' => $totalItems,
        'totalPrice' => $totalPrice
    ]);
} else {
    echo json_encode([
        'cartItems' => [],
        'totalItems' => 0,
        'totalPrice' => 0
    ]);
}
?>
