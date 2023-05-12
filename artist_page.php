<?php
session_start();
require_once 'scripts/connect.php';

$artist_id = $_GET['id'];

$artist_query = mysqli_query($connect, "SELECT * FROM artists WHERE id = $artist_id");
$artist = mysqli_fetch_assoc($artist_query);

$albums_query = mysqli_query($connect, "SELECT * FROM albums WHERE artist_id = $artist_id");
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
            <li class="nav-elem"><a class="nav-link" href="account.php"><i class="ri-account-box-fill"></i></a></li>
            <li class="nav-elem"><a class="nav-link" href="scripts/logout.php"><i class="ri-logout-box-line"></i></a>
            </li>
        </ul>
    </nav>
</header>
<section class="artist-page">
    <div class="container">
        <div class="artist-page-info">
            <img loading="lazy" class="artist-page-cover" src="assets/artists/<?= $artist['artist_cover'] ?>" alt="Обложка артиста">
            <div class="artist-page-text">
                <p class="artist-status">Исполнитель</p>
                <h1 class="artist-page-title"><?= $artist['name'] ?></h1>
            </div>
        </div>
        <h2 class="artist-page-title plus down">Альбомы</h2>
        <div class="albums">
            <?php while ($album = mysqli_fetch_assoc($albums_query)): ?>
                <a href="album_page.php?id=<?= $album['id'] ?>">
                    <div class="album">
                        <img loading="lazy" class="album-cover" src="assets/albums/<?= $album['cover'] ?>" alt="<?= $album['name'] ?>">
                        <div class="album-info">
                            <h3 title="<?= $album['name'] ?>" class="album-title"><?= $album['name'] ?></h3>
                            <p class="album-artist"><?= $artist['name'] ?></p>
                        </div>
                    </div>
                </a>
            <?php endwhile; ?>
        </div>
    </div>
</section>
<script src="js/main.js"></script>
</body>
</html>