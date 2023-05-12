<?php
session_start();
require_once 'connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $album_name = mysqli_real_escape_string($connect, $_POST['album_name']);
    $album_year = mysqli_real_escape_string($connect, $_POST['album_year']);
    $artist_id = mysqli_real_escape_string($connect, $_POST['artist_id']);
    $genre_id = mysqli_real_escape_string($connect, $_POST['genre_id']);

    if (isset($_FILES['album_cover'])) {
        $file_name = $_FILES['album_cover']['name'];
        $file_tmp = $_FILES['album_cover']['tmp_name'];
        $file_type = $_FILES['album_cover']['type'];
        $file_size = $_FILES['album_cover']['size'];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $extensions = ['jpeg', 'jpg', 'png'];

        if (in_array($file_ext, $extensions) === false) {
            header('Location: ../errors/415.php');
            exit();
        }

        if ($file_size > 2097152) {
            header('Location: ../errors/413.php');
            exit();
        }

        $new_file_name = uniqid('album_', true) . '.' . $file_ext;
        $upload_path = '../assets/albums/' . $new_file_name;

        if (!move_uploaded_file($file_tmp, $upload_path)) {
            header('Location: ../errors/500.php');
            exit();
        }
    }

    $sql = "INSERT INTO `albums` (`name`, `year`, `artist_id`, `genre_id`, `cover`) VALUES ('$album_name', '$album_year', '$artist_id', '$genre_id', '$new_file_name')";

    if (mysqli_query($connect, $sql)) {
        header("Location: ../admin.php");
        exit();
    } else {
        header('Location: ../errors/500.php');
        exit();
    }
}

$artists = mysqli_query($connect, "SELECT * FROM `artists`");

$genres = mysqli_query($connect, "SELECT * FROM `genres`");