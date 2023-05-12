<?php
session_start();
require_once 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $target_dir = "../assets/artists/";
    $target_file = $target_dir . basename($_FILES["artist_cover"]["name"]);
    move_uploaded_file($_FILES["artist_cover"]["tmp_name"], $target_file);
    $artist_cover = basename($target_file);

    $artist_name = $_POST["artist_name"];
    $sql = "INSERT INTO artists (name, artist_cover) VALUES ('$artist_name', '$artist_cover')";

    if ($connect->query($sql) === TRUE) {
        header("Location: ../admin.php");
        exit();
    } else {
        header('Location: ../errors/500.php');
        exit();
    }
}