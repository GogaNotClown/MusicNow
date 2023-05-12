<?php
$connect = mysqli_connect("localhost", "GogaNotClown", "fuckniggers", "musicnow");

if (!$connect) {
    die("Ошибка с подключением: " . mysqli_connect_error());
}