<?php
session_start();
header('Content-Type: application/json');
require_once 'database/connection.php';

$input = json_decode(file_get_contents('php://input'), true);
$action = $input['action'];
$productId = $input['productId'];

if (isset($_SESSION['user'])) {
    $userId = $_SESSION['user']['id'];
    
    switch ($action) {
        case 'plus':
            $query = $db->prepare("UPDATE keranjang SET quantity = quantity + 1 WHERE users_id = ? AND barang_id = ?");
            break;
        case 'minus':
            $query = $db->prepare("UPDATE keranjang SET quantity = quantity - 1 WHERE users_id = ? AND barang_id = ?");
            break;
        case 'remove':
            $query = $db->prepare("DELETE FROM keranjang WHERE users_id = ? AND barang_id = ?");
            break;
        default:
            echo json_encode(['success' => false]);
            exit;
    }
    
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
