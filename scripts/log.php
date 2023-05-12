<?php
session_start();
require_once 'connect.php';

$username = $_POST["login"];
$password = $_POST["password"];

$sql = "SELECT password FROM users WHERE username='$username'";
$result = mysqli_query($connect, $sql);

if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
    if (password_verify($password, $row['password'])) {
        $_SESSION["username"] = $username;
        header("Location: ../main.php");
    } else {
        header('Location: ../errors/401.php');
    }
} else {
    header('Location: ../errors/401.php');
}

mysqli_close($connect);