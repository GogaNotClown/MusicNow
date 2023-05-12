<?php
session_start();
require_once 'connect.php';

$del_artist_id = $_POST['del_artist_id'];

mysqli_query($connect, "DELETE FROM `artists` WHERE `id` = $del_artist_id");

header("Location: ../admin.php");
exit();