<?php
session_start();
require_once 'connect.php';

$track_name = $_POST['track_name'];
$duration = $_POST['track_duration'];
$album_id = $_POST['album_id'];

$music_file = $_FILES['music_file']['name'];
$tmp_name = $_FILES['music_file']['tmp_name'];
$uploads_dir = '../assets/albums_tracks/';
move_uploaded_file($tmp_name, $uploads_dir . $music_file);

$query = "INSERT INTO `tracks` (`name`, `duration`, `file_path`, `album_id`) VALUES ('$track_name', '$duration', '$music_file', '$album_id')";
mysqli_query($connect, $query);

header("Location: ../admin.php");
exit();