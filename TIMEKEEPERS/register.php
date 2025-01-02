<?php
use Timekeepers\Database\App;
use Timekeepers\Database\Crud;
use Timekeepers\Database\Query;

require_once 'database/crud.php';
require_once 'database/query.php';


$db = new App();
$crud = new Crud('users');
$query = new Query();

// var_dump($_POST);
session_start();
if ($_POST) {
    $email = $_POST['email'];
    $name = $_POST['name'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];


    $existingUsers = $query->select()->from('users')->get();
    foreach ($existingUsers as $user) {
        if ($user->email === $email) {
            $_SESSION['message'] = "Email sudah terdaftar.";
            $_SESSION['message_type'] = "danger";
            header("Location: notif.php");
            exit();
        }
        if ($user->name === $name) {
            $_SESSION['message'] = "Nama sudah terdaftar.";
            $_SESSION['message_type'] = "danger";
            header("Location: notif.php");
            exit();
        }
    }

    if ($password === $confirm_password) {
        
        $crud->create([
            'name' => $name,
            'email' => $email,
            'password' => $password,
        ]);
        $_SESSION['message'] = "Anda berhasil membuat akun.";
        $_SESSION['message_type'] = "success";
        
    } else {
        $_SESSION['message'] = "Maaf, Password tidak cocok.";
        $_SESSION['message_type'] = "danger";
        
    }
    header("Location: notif.php");
    exit();
}
?>
