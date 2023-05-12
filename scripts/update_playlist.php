<?php
session_start();
require_once 'connect.php';

$user_id = $_POST['user_id'];
$track_id = $_POST['track_id'];
$playlist_id = $_POST['playlist_id'];

$playlist_track = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM playlists_tracks WHERE user_id=$user_id AND track_id=$track_id AND playlist_id=$playlist_id"));

if ($playlist_track) {
    mysqli_query($connect, "DELETE FROM playlists_tracks WHERE user_id=$user_id AND track_id=$track_id AND playlist_id=$playlist_id");
} else {
    mysqli_query($connect, "INSERT INTO playlists_tracks (user_id, track_id, playlist_id) VALUES ($user_id, $track_id, $playlist_id)");
}

header('Location: ../account.php');
exit();