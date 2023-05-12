<?php
session_start();
require_once 'connect.php';

$user_id = $_POST['user_id'];
$track_id = $_POST['track_id'];

$favorite_track = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM favorite_tracks WHERE user_id=$user_id AND track_id=$track_id"));

if ($favorite_track) {
    mysqli_query($connect, "DELETE FROM favorite_tracks WHERE user_id=$user_id AND track_id=$track_id");
} else {
    mysqli_query($connect, "INSERT INTO favorite_tracks (user_id, track_id) VALUES ($user_id, $track_id)");
}

header('Location: ' . $_SERVER['HTTP_REFERER']);
exit();