<?php
$connect = mysqli_connect("localhost", "root", "", "musicnow");

if (!$connect) {
    die("Ошибка с подключением: " . mysqli_connect_error());
}
