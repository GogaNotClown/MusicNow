<?php
session_start();
require_once 'scripts/connect.php';

$user_username = mysqli_real_escape_string($connect, $_SESSION['username']);
$result = mysqli_query($connect, "SELECT * FROM users WHERE username = '$user_username'");
if (!$result) {
    die("Ошибка выполнения запроса: " . mysqli_error($connect));
}
$user = mysqli_fetch_assoc($result);

$user_id = $user['id'];

$trackNumber = 1;

$favorite_tracks = mysqli_query($connect, "SELECT t.id as track_id, t.name as track_name, t.duration, a.name as album_name, ar.name as artist_name, a.cover as album_cover, t.file_path as file_path FROM favorite_tracks ft 
        INNER JOIN tracks t ON ft.track_id = t.id
        INNER JOIN albums a ON t.album_id = a.id
        INNER JOIN artists ar ON a.artist_id = ar.id
        WHERE ft.user_id=$user_id");

if (mysqli_num_rows($favorite_tracks) == 0) {
    header('Location: errors/404.php');
} else {
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
<section class="favorite-page">
    <div class="container">
        <div class="album-page-info">
            <div class="album-page-cover">
                <img loading="lazy" src="assets/favorite_cover.svg" alt="Обложка альбома">
            </div>
            <div class="album-page-text">
                <h1 class="album-page-title">Любимые треки</h1>
                <p class="album-page-genre"><?= $user['username'] ?></p>
            </div>
        </div>
        <ul class="favorite-tracks-list plus minus">
            <?php while ($favorite_track = mysqli_fetch_assoc($favorite_tracks)): ?>
                <li class="track-list-elem">
                    <button class="play-button" data-src="assets/albums_tracks/<?= $favorite_track['file_path'] ?>"
                            data-title="<?= $favorite_track['track_name'] ?>"
                            data-artist="<?= $favorite_track['artist_name'] ?>"><i class="ri-play-mini-fill"></i></button>
                    <div class="track-id"><?= $trackNumber ?></div>
                    <img loading="lazy" class="favorite-track-cover" src="assets/albums/<?= $favorite_track['album_cover'] ?>"
                         alt="<?= $favorite_track['album_name'] ?>">
                    <div class="favorite-track-other-info">
                        <div title="<?= $favorite_track['track_name'] ?>"
                             class="favorite-track-title"><?= $favorite_track['track_name'] ?></div>
                        <div class="favorite-track-artist"><?= $favorite_track['artist_name'] ?></div>
                    </div>
                    <div class="favorite-heart-or-not">
                        <form method="POST" action="scripts/update_favorite.php">
                            <input type="hidden" name="track_id" value="
                    <?= $favorite_track['track_id'] ?>">
                            <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                            <button type="submit" class="favorite-track"><i class="ri-heart-fill"></i></button>
                        </form>
                    </div>
                    <?php if ($user['premium']): ?>
                        <button title="Скачать" class="download-button"
                                data-file="assets/albums_tracks/<?= $favorite_track['file_path'] ?>"><i
                                class="ri-download-2-fill"></i></button>
                    <?php endif; ?>
                    <input type="range" min="0" max="1" step="0.1" value="0.2" class="volume-range">
                    <div class="track-duration"><?= $favorite_track['duration'] ?></div>
                </li>
                <?php $trackNumber++; endwhile; ?>
        </ul>
        <div id="current-track-info">Никакая песня не проигрывается</div>
        <?php
        }
        ?>
    </div>
</section>
<script src="js/premium.js"></script>
<script src="js/main.js"></script>
</body>
</html>