<?php
require_once '../../database/crud.php';

use Timekeepers\Database\App;
use Timekeepers\Database\Crud;

$db = new App();
$crud = new Crud('barang');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    $targetDir = "../../assets/img/barang/";
    $fileName = uniqid() . '_' . basename($_FILES["image"]["name"]);
    $targetFilePath = $targetDir . $fileName;
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    if (!empty($_FILES["image"]["tmp_name"])) {
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check !== false) {
            move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath);
            if (!empty($_POST['imageLama']) && file_exists($targetDir . $_POST['imageLama'])) {
                unlink($targetDir . $_POST['imageLama']);
            }
            $image = $fileName;
        } else {
            $_SESSION['message'] = "File is not an image.";
            $_SESSION['message_type'] = "danger";
            header('location: update.php?id=' . $id);
            exit;
        }
        $crud->update([
            'name' => $name,
            'description' => $description,
            'price' => $price,
            'image' => $image
        ], $id);
    } else {
        $crud->update([
            'name' => $name,
            'description' => $description,
            'price' => $price,
        ], $id);
    }
    $_SESSION['message'] = "Data barang berhasil diupdate.";
    $_SESSION['message_type'] = "success";

    header('location: index.php');
} else {
    header('location: index.php');
}
