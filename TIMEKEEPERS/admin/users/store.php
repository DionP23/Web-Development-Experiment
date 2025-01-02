<?php
// upload.php

require_once '../../database/crud.php';

use Timekeepers\Database\App;
use Timekeepers\Database\Crud;

$db = new App();
$crud = new Crud('users');

if (empty($_REQUEST)) {
    header('location:index.php');
    exit;
}

$crud->create([
    'name' => $_REQUEST['name'],
    'email' => $_REQUEST['email'],
    'password' => $_REQUEST['password'],
    'level' => $_REQUEST['level'],
]);

$_SESSION['message'] = "Data barang berhasil ditambahkan.";
$_SESSION['message_type'] = "success";

header('location:index.php');
exit;
