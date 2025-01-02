<?php

require_once '../../database/crud.php';

session_start();

use Timekeepers\Database\App;
use Timekeepers\Database\Crud;
use Timekeepers\Database\Query;

$db = new App();
$query = new Query();
$crud = new Crud('users');


if ($_POST) {
    $data = $query->select()->from('users')->where('id', $_POST['id'])->get();


    $crud->delete($data[0]->id);

    $_SESSION['message'] = "Data barang berhasil dihapuskan.";
    $_SESSION['message_type'] = "success";
    header('location:index.php');
    exit;
}

header('location:index.php');
