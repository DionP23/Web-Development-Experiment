<?php
session_start();

$response = ['loggedIn' => false];

if (isset($_SESSION['user'])) {
    $response['loggedIn'] = true;
    $response['userId'] = $_SESSION['user']['id'];
}

echo json_encode($response);


?>
