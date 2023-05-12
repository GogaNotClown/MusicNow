<?php
session_start();
require_once 'connect.php';

if (!isset($_SESSION["username"])) {
    header("Location: index.php");
    exit();
}

$user_id = $_POST['user_id'];
$username = $_POST['username'];
$avatar = '';

if ($_FILES['avatar']['size'] > 0) {
    $avatar = '../assets/users/' . $_FILES['avatar']['name'];
    move_uploaded_file($_FILES['avatar']['tmp_name'], $avatar);
    $avatar = ", `avatar` = '{$_FILES['avatar']['name']}'";
}

$update = "UPDATE `users` SET `username` = '$username' $avatar WHERE id = $user_id";
$result = $connect->query($update);

$_SESSION['username'] = $username;
session_regenerate_id();

header('Location: ../account.php');
exit();