<?php
include 'model.php';

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $message = register_user($username, $password);
}

include 'view.php';
?>