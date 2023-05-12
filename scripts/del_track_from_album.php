<?php
session_start();
require_once 'connect.php';

$track_id = $_POST['track_id'];
$album_id = $_POST['album_id'];

mysqli_query($connect, "DELETE FROM tracks WHERE id = '$track_id'");

header("Location: ../album_page.php?id=" . $album_id);
exit();