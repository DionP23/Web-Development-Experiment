<?php
// upload.php

require_once '../../database/crud.php';

use Timekeepers\Database\App;
use Timekeepers\Database\Crud;



$db = new App();
$crud = new Crud('barang');

if (empty($_REQUEST)) {
    header('location:index.php');
    exit;
}



$targetDir = "../../assets/img/barang/";

// Proses upload file
$fileName = uniqid() . '_' . basename($_FILES["image"]["name"]);
$targetFilePath = $targetDir . $fileName;
$fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

if (!empty($_FILES["image"]["tmp_name"])) {

    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check !== false) {
        
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
        
            $crud->create([
                'name' => $_REQUEST['name'],
                'description' => $_REQUEST['description'],
                'price' => $_REQUEST['price'],
                'image' => $fileName
            ]);

            
            $_SESSION['message'] = "Data barang berhasil ditambahkan.";
            $_SESSION['message_type'] = "success";
        } else {
            
            $_SESSION['message'] = "Maaf, terjadi kesalahan saat mengunggah file.";
            $_SESSION['message_type'] = "danger";
        }
    } else {
      
        $_SESSION['message'] = "File yang diunggah bukan merupakan gambar.";
        $_SESSION['message_type'] = "danger";
    }
} else {
    
    $_SESSION['message'] = "Mohon pilih file untuk diunggah.";
    $_SESSION['message_type'] = "danger";
}

header('location:index.php');
exit;

