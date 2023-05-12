<?php
session_start();
require_once 'connect.php';

$del_genre_id = $_POST['del_genre_id'];

mysqli_query($connect, "DELETE FROM `genres` WHERE `id` = $del_genre_id");

header("Location: ../admin.php");
exit();