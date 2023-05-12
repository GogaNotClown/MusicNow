<?php
session_start();
require_once 'scripts/connect.php';

if (!isset($_SESSION["username"]) || $_SESSION["username"] !== "$2y$10$0H") {
    header("Location: index.php");
    exit();
}
?>

<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MusicNow</title>
    <link rel="stylesheet" href="css/main.css">
    <link rel="icon" href="assets/logo.svg" type="image/svg+xml">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.0.0/fonts/remixicon.css" rel="stylesheet">
</head>
<body>
<header class="header">
    <div class="header-logo">
        <a href="main.php">
            <img loading="lazy" src="assets/logo.svg" alt="Логотип">
        </a>
    </div>
    <nav class="nav">
        <ul class="nav-list">
            <li class="nav-elem"><a class="nav-link" href="search.php"><i class="ri-search-line"></i></a></li>
            <li class="nav-elem"><a class="nav-link" href="scripts/logout.php"><i class="ri-logout-box-line"></i></a>
            </li>
        </ul>
    </nav>
</header>
<div class="modal modal-artist">
    <div class="modal-content">
        <h2 class="modal-title">Новый исполнитель</h2>
        <form class="admin-card-form" action="scripts/add_artist.php" method="post"
              enctype="multipart/form-data">
            <input required type="file" name="artist_cover">
            <input required name="artist_name" type="text" placeholder="Имя исполнителя *" class="admin-card-input">
            <button class="admin-card-button" type="submit">Добавить</button>
        </form>
        <button class="modal-close">&times;</button>
    </div>
</div>
<div class="modal modal-album">
    <div class="modal-content">
        <h2 class="modal-title">Новый альбом</h2>
        <form class="admin-card-form" action="scripts/add_album.php" method="post"
              enctype="multipart/form-data">
            <input required type="file" name="album_cover">
            <input required name="album_name" type="text" placeholder="Название альбома *" class="admin-card-input">
            <input required name="album_year" type="text" placeholder="Год альбома *" class="admin-card-input">

            <select required name="artist_id" class="admin-card-input">
                <?php
                $artists = mysqli_query($connect, "SELECT * FROM `artists`");
                while ($artist = mysqli_fetch_assoc($artists)) {
                    echo "<option value='{$artist['id']}'>{$artist['name']}</option>";
                }
                ?>
            </select>

            <select required name="genre_id" class="admin-card-input">
                <?php
                $genres = mysqli_query($connect, "SELECT * FROM `genres`");
                while ($genre = mysqli_fetch_assoc($genres)) {
                    echo "<option value='{$genre['id']}'>{$genre['name']}</option>";
                }
                ?>
            </select>

            <button class="admin-card-button" type="submit">Добавить</button>
        </form>
        <button class="modal-close">&times;</button>
    </div>
</div>
<div class="modal modal-tracks">
    <div class="modal-content">
        <h2 class="modal-title">Песни в альбоме</h2>
        <form class="admin-card-form" action="scripts/add_track_in_album.php" method="post"
              enctype="multipart/form-data">
            <input required type="file" name="music_file">
            <input required name="track_name" type="text" placeholder="Имя трека *" class="admin-card-input">
            <input required name="track_duration" type="text" placeholder="Длительность трека (Формат 1:50)"
                   class="admin-card-input" pattern="^\d+:\d{2}$">
            <select required name="album_id" class="admin-card-input">
                <?php
                $albums = mysqli_query($connect, "SELECT * FROM `albums`");
                while ($album = mysqli_fetch_assoc($albums)) {
                    echo "<option value='{$album['id']}'>{$album['name']}</option>";
                }
                ?>
            </select>
            <button class="admin-card-button" type="submit">Добавить</button>
        </form>
        <button class="modal-close">&times;</button>
    </div>
</div>
<div class="modal modal-del-artist">
    <div class="modal-content">
        <h2 class="modal-title">Удалить исполнителя</h2>
        <form class="admin-card-form" action="scripts/del_artist.php" method="post"
              enctype="multipart/form-data">
            <select required name="del_artist_id" class="admin-card-input">
                <?php
                $del_artists = mysqli_query($connect, "SELECT * FROM `artists`");
                while ($del_artist = mysqli_fetch_assoc($del_artists)) {
                    echo "<option value='{$del_artist['id']}'>{$del_artist['name']}</option>";
                }
                ?>
            </select>
            <button class="admin-card-button danger" type="submit">Удалить</button>
        </form>
        <button class="modal-close">&times;</button>
    </div>
</div>
<div class="modal modal-del-album">
    <div class="modal-content">
        <h2 class="modal-title">Удалить альбом</h2>
        <form class="admin-card-form" action="scripts/del_album.php" method="post"
              enctype="multipart/form-data">
            <select required name="del_album_id" class="admin-card-input">
                <?php
                $del_albums = mysqli_query($connect, "SELECT * FROM `albums`");
                while ($del_album = mysqli_fetch_assoc($del_albums)) {
                    echo "<option value='{$del_album['id']}'>{$del_album['name']}</option>";
                }
                ?>
            </select>
            <button class="admin-card-button danger" type="submit">Удалить</button>
        </form>
        <button class="modal-close">&times;</button>
    </div>
</div>
<div class="modal modal-genre">
    <div class="modal-content">
        <h2 class="modal-title">Новый жанр</h2>
        <form class="admin-card-form" action="scripts/add_genre.php" method="post"
              enctype="multipart/form-data">
            <input required name="new_genre_name" type="text" placeholder="Название жанра *" class="admin-card-input">
            <button class="admin-card-button" type="submit">Добавить</button>
        </form>
        <button class="modal-close">&times;</button>
    </div>
</div>
<div class="modal modal-del-genre">
    <div class="modal-content">
        <h2 class="modal-title">Удалить жанр</h2>
        <form class="admin-card-form" action="scripts/del_genre.php" method="post"
              enctype="multipart/form-data">
            <select required name="del_genre_id" class="admin-card-input">
                <?php
                $del_genres = mysqli_query($connect, "SELECT * FROM `genres`");
                while ($del_genre = mysqli_fetch_assoc($del_genres)) {
                    echo "<option value='{$del_genre['id']}'>{$del_genre['name']}</option>";
                }
                ?>
            </select>
            <button class="admin-card-button danger" type="submit">Удалить</button>
        </form>
        <button class="modal-close">&times;</button>
    </div>
</div>
<section class="admin">
    <div class="container">
        <h1 class="admin-title">Добро пожаловать</h1>
        <div class="accordion">
            <ul>
                <li class="accordion-question">
                    <div class="accordion-title">
                        <h3>Добавление</h3>
                        <span class="accordion-icon"></span>
                    </div>
                    <div class="accordion-content">
                        <div class="admin-card">
                            <div class="admin-card-info">
                                <h1 class="admin-card-title">Новый исполнитель</h1>
                            </div>
                            <div class="admin-card-add">
                                <button class="admin-card-button btn-artist" type="submit">Добавить</button>
                            </div>
                        </div>
                        <div class="admin-card">
                            <div class="admin-card-info">
                                <h1 class="admin-card-title">Новый альбом</h1>
                            </div>
                            <div class="admin-card-add">
                                <button class="admin-card-button btn-album" type="submit">Добавить</button>
                            </div>
                        </div>
                        <div class="admin-card">
                            <div class="admin-card-info">
                                <h1 class="admin-card-title">Песни в альбоме</h1>
                            </div>
                            <div class="admin-card-add">
                                <button class="admin-card-button btn-tracks" type="submit">Добавить</button>
                            </div>
                        </div>
                        <div class="admin-card">
                            <div class="admin-card-info">
                                <h1 class="admin-card-title">Новый жанр</h1>
                            </div>
                            <div class="admin-card-add">
                                <button class="admin-card-button btn-genre" type="submit">Добавить</button>
                            </div>
                        </div>
                    </div>
                </li>
                <li class="accordion-question">
                    <div class="accordion-title">
                        <h3>Удаление</h3>
                        <span class="accordion-icon"></span>
                    </div>
                    <div class="accordion-content">
                        <div class="admin-card">
                            <div class="admin-card-info">
                                <h1 class="admin-card-title">Удалить исполнителя</h1>
                            </div>
                            <div class="admin-card-add">
                                <button class="admin-card-button btn-del-artist danger" type="submit">Удалить</button>
                            </div>
                        </div>
                        <div class="admin-card">
                            <div class="admin-card-info">
                                <h1 class="admin-card-title">Удалить альбом</h1>
                            </div>
                            <div class="admin-card-add">
                                <button class="admin-card-button btn-del-album danger" type="submit">Удалить</button>
                            </div>
                        </div>
                        <div class="admin-card">
                            <div class="admin-card-info">
                                <h1 class="admin-card-title">Удалить жанр</h1>
                            </div>
                            <div class="admin-card-add">
                                <button class="admin-card-button btn-del-genre danger" type="submit">Удалить</button>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</section>
<script src="js/accordion.js"></script>
<script src="js/admin.js"></script>
</body>
</html>