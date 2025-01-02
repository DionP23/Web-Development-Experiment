<?php
require_once '../../database/crud.php';

use Timekeepers\Database\App;
use Timekeepers\Database\Crud;

$db = new App();
$crud = new Crud('users');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $level = $_POST['level'];



    $crud->update([
        'name' => $name,
        'email' => $email,
        'password' => $password,
        'level' => $level,
    ], $id);

    $_SESSION['message'] = "Data barang berhasil diupdate.";
    $_SESSION['message_type'] = "success";

    header('location: index.php');
} else {
    header('location: index.php');
}
