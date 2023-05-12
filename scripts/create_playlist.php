<?php
session_start();
require_once 'connect.php';
error_reporting(E_ALL | E_STRICT);

$playlist_name = $_POST['playlist_name'];
$playlist_desc = $_POST['playlist_desc'];
$user_id = $_POST['user_id'];

$target_dir = "../assets/playlists/";
$target_file = $target_dir . urldecode(basename($_FILES["playlist_cover"]["name"]));
$target_file_for_db = substr($target_file, 3);

if (move_uploaded_file($_FILES["playlist_cover"]["tmp_name"], $target_file)) {
    $sql = "INSERT INTO playlists (user_id, name, description, image) VALUES ('$user_id', '$playlist_name', '$playlist_desc', '$target_file_for_db')";
} else {
    header('Location: ../errors/500.php');
    exit();
}

if (mysqli_query($connect, $sql)) {
    header('Location: ../account.php');
} else {
    header('Location: ../errors/500.php');
    exit();
}

mysqli_close($connect);
