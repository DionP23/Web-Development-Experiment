<?php
session_start();
header('Content-Type: application/json');
require_once 'database/connection.php';

$input = json_decode(file_get_contents('php://input'), true);
$userId = $input['userId'];
$productId = $input['productId'];

if (isset($_SESSION['user'])) {
    $query = $db->prepare("INSERT INTO keranjang (users_id, barang_id, quantity) VALUES (?, ?, 1) ON DUPLICATE KEY UPDATE quantity = quantity + 1");
    $query->bind_param('ii', $userId, $productId);
    $query->execute();

    if ($query->affected_rows > 0) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
} else {
    echo json_encode(['success' => false]);
}
?>
