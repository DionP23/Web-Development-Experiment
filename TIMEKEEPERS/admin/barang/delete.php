<?php

require_once '../../database/crud.php';

session_start();
use Timekeepers\Database\App;
use Timekeepers\Database\Crud;
use Timekeepers\Database\Query;

$db = new App();
$query = new Query();
$crud = new Crud('barang');


if ($_POST) {
    $data = $query->select()->from('barang')->where('id', $_POST['id'])->get();
    if ($data) {
        $targetDir =  "../../assets/img/barang/";
        if (!empty($data[0]->image) && file_exists($targetDir . $data[0]->image)) {
            unlink($targetDir . $_POST['imageLama']);
        }

        $crud->delete($data[0]->id);
    }
    $_SESSION['message'] = "Data barang berhasil dihapuskan.";
    $_SESSION['message_type'] = "success";
    header('location:index.php');
    exit;
}

header('location:index.php');
