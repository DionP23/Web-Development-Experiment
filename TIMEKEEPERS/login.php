<?php
use Timekeepers\Database\App;
use Timekeepers\Database\Query;



// require_once 'database/query.php';
require_once 'database/connection.php';

session_start();



if ($_POST) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    
    // Prepare the query to prevent SQL injection
    $stmt = $db->prepare("SELECT id, name, email, password, level FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    // var_dump($user['password'] == $password);die;
    if ($user && $password === $user['password']) {
        // Jika password cocok
        // var_dump($user);die;
        // session_start();
        $_SESSION['user'] = [
            'id' => $user['id'],
            'name' => $user['name'],
            'email' => $user['email'],
            'level' => $user['level']
        ];
        $_SESSION['message'] = "Login successful!";
        $_SESSION['message_type'] = "success";
    } else {
        $_SESSION['message'] = "Email or password is incorrect.";
        $_SESSION['message_type'] = "danger";
    }

    header("Location: notif.php");
    exit();
}

?>
