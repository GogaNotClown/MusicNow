<?php
session_start();
require_once 'connect.php';

$user_id = $_POST['user_id'];
$track_id = $_POST['track_id'];
$album = $_POST['album_id'];

$result = mysqli_query($connect, "SELECT * FROM favorite_tracks WHERE user_id=$user_id AND track_id=$track_id");

if (mysqli_num_rows($result) == 0) {
    $query = "INSERT INTO favorite_tracks (user_id, track_id) VALUES ($user_id, $track_id)";
    $result = mysqli_query($connect, $query);

    if (!$result) {
        header('Location: ../errors/500.php');
        exit();
    }
    header('Location: ../album_page.php?id=' . $album);
} else {
    mysqli_query($connect, "DELETE FROM favorite_tracks WHERE user_id=$user_id AND track_id=$track_id");
    header('Location: ../album_page.php?id=' . $album);
}

mysqli_close($connect);