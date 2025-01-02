<?php
session_start(); 
require_once 'database/connection.php';


$email = $_POST['email'];
$password = $_POST['password'];
$password_confirmation = $_POST['password_confirmation'];


if ($password != $password_confirmation) {
    $_SESSION['message'] = "Password and confirmation do not match.";
    $_SESSION['message_type'] = "danger";
    header("Location: notif.php"); 
    exit;
}

// Cek apakah email ada di database
$query = "SELECT * FROM users WHERE email = ?";
$stmt = $db->prepare($query);
$stmt->bind_param('s', $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    $_SESSION['message'] = "Email not found in our records.";
    $_SESSION['message_type'] = "danger";
    header("Location: notif.php"); 
    exit;
}


$hashed_password = $password;

$update_query = "UPDATE users SET password = ? WHERE email = ?";
$update_stmt = $db->prepare($update_query);
$update_stmt->bind_param('ss', $hashed_password, $email);
$update_stmt->execute();

if ($update_stmt->affected_rows > 0) {
    $_SESSION['message'] = "Password updated successfully.";
    $_SESSION['message_type'] = "success";
    header("Location: notif.php");
    exit;
} else {
    $_SESSION['message'] = "Failed to update password. Please try again later.";
    $_SESSION['message_type'] = "danger";
    header("Location: notif.php"); 
    exit;
}
