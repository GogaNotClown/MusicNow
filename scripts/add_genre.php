<?php
session_start();
require_once 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $new_genre_name = $_POST['new_genre_name'];

    $sql = "INSERT INTO genres (name) VALUES ('$new_genre_name')";

    if (mysqli_query($connect, $sql)) {
        header('Location: ../admin.php');
        exit();
    } else {
        header('Location: ../errors/500.php');
        exit();
    }
}