<?php
session_start();
require_once 'connect.php';

$user_id = $_POST['user_id'];
$track_id = $_POST['track_id'];
$album_id = $_POST['album_id'];
$playlist_id = $_POST['playlist_id'];

$result = mysqli_query($connect, "SELECT * FROM playlists_tracks WHERE user_id=$user_id AND track_id=$track_id AND playlist_id=$playlist_id");

if (mysqli_num_rows($result) == 0) {
    $query = "INSERT INTO playlists_tracks (user_id, track_id, playlist_id) VALUES ($user_id, $track_id, $playlist_id)";
    $result = mysqli_query($connect, $query);

    if (!$result) {
        header('Location: ../errors/500.php');
        exit();
    }
    header('Location: ../playlist_page.php?id=' . $playlist_id);
    exit();
} else {
    mysqli_query($connect, "DELETE FROM playlists_tracks WHERE user_id=$user_id AND track_id=$track_id AND playlist_id=$playlist_id");
    header('Location: ../playlist_page.php?id=' . $playlist_id);
    exit();
}

mysqli_close($connect);