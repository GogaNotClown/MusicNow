<?php
session_start();
require_once 'connect.php';

$del_album_id = $_POST['del_album_id'];

mysqli_query($connect, "DELETE FROM `albums` WHERE `id` = $del_album_id");

header("Location: ../admin.php");
exit();