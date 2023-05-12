<?php
session_start();
require_once 'scripts/connect.php';

$playlist_id = $_GET['id'];
$playlist = mysqli_query($connect, "SELECT * FROM `playlists` WHERE `id` = '$playlist_id'");
$playlist = mysqli_fetch_assoc($playlist);
$tracks = mysqli_query($connect, "SELECT * FROM `tracks` WHERE `playlist_id` = '$playlist_id'");

$user_username = mysqli_real_escape_string($connect, $_SESSION['username']);
$result = mysqli_query($connect, "SELECT * FROM `users` WHERE username = '$user_username'");
if (!$result) {
    die("Ошибка выполнения запроса: " . mysqli_error($connect));
}
$user = mysqli_fetch_assoc($result);
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
<section class="playlist">
    <div class="container">
        <form action="playlist_page.php" method="get">
            <input required class="search-input" type="text" name="search" placeholder="Поиск песен...">
            <input type="hidden" name="playlist_id" value="<?= $playlist['id'] ?>">
            <input type="hidden" name="id" value="<?= $playlist['id'] ?>">
        </form>
        <ul class="favorite-tracks-list mini-plus">
            <?php
            if (isset($_GET['search'])) {
            $search = mysqli_real_escape_string($connect, $_GET['search']);
            $playlist_id = mysqli_real_escape_string($connect, $_GET['playlist_id']);
            $playlist_result = mysqli_query($connect, "SELECT * FROM playlists WHERE id = '$playlist_id'");
            $playlist = mysqli_fetch_array($playlist_result);
            $tracks = mysqli_query($connect, "SELECT t.*, a.name AS artist_name, al.name AS album_name, al.cover AS album_cover
                FROM tracks t
                INNER JOIN albums al ON t.album_id = al.id
                INNER JOIN artists a ON al.artist_id = a.id
                WHERE t.name LIKE '%{$search}%'");

            $trackNumber = 1;
            $album = $_GET['id'];

            if (mysqli_num_rows($tracks) > 0) {
            ?>
            <?php while ($track = mysqli_fetch_assoc($tracks)): ?>
                <li class="track-list-elem">
                    <button class="play-button" data-src="assets/albums_tracks/<?= $track['file_path'] ?>"
                            data-title="<?= $track['name'] ?>"
                            data-artist="<?= $track['artist_name'] ?>"><i class="ri-play-mini-fill"></i>
                    </button>
                    <div class="track-id"><?= $trackNumber ?></div>
                    <img loading="lazy" class="favorite-track-cover" src="assets/albums/<?= $track['album_cover'] ?>"
                         alt="<?= $track['album_name'] ?>">
                    <div class="favorite-track-other-info">
                        <div title="<?= $track['name'] ?>"
                             class="favorite-track-title"><?= $track['name'] ?></div>
                        <div class="favorite-track-artist"><?= $track['artist_name'] ?></div>
                    </div>
                    <div class="favorite-heart-or-not">
                        <form method="POST" action="scripts/add_to_playlist.php">
                            <input type="hidden" name="track_id" value="<?= $track['id'] ?>">
                            <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                            <input type="hidden" name="album_id" value="<?= $album['id'] ?>">
                            <input type="hidden" name="playlist_id" value="<?= $playlist['id'] ?>">
                            <?php
                            $result = mysqli_query($connect, "SELECT * FROM playlists_tracks WHERE user_id={$user['id']} AND track_id={$track['id']}");
                            if (mysqli_num_rows($result) == 0) {
                                ?>
                                <button type="submit" class="favorite-track"><i class="ri-add-box-line"></i></button>
                                <?php
                            } else {
                                ?>
                                <button type="submit" class="favorite-track"><i class="ri-add-box-fill"></i></button>
                                <?php
                            }
                            ?>
                        </form>
                    </div>
                    <?php if ($user['premium']): ?>
                        <button title="Скачать" class="download-button"
                                data-file="assets/albums_tracks/<?= $track['file_path'] ?>"><i
                                class="ri-download-2-fill"></i></button>
                    <?php endif; ?>
                    <input type="range" min="0" max="1" step="0.1" value="0.2" class="volume-range">
                    <div class="track-duration"><?= $track['duration'] ?></div>
                </li>
                <?php $trackNumber++; endwhile; ?>
        </ul>
        <?php
        } else {
            echo "<p class='not-found'>Ничего не найдено.</p>";
        }
        }
        ?>
        <?php
        $playlist_info = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM `playlists` WHERE `id` = '$playlist_id'"));
        ?>
        <div class="playlist-page-info">
            <img loading="lazy" src="<?= $playlist_info['image'] ?>" alt="<?= $playlist_info['name'] ?>" class="cover">
            <div class="account-super-info">
                <p class="account-nickname"><?= $playlist_info['name'] ?></p>
                <p class="album-page-genre"><?= $playlist_info['description'] ?></p>
<!--                <p class="album-page-genre">--><?php //= $user['username'] ?><!--</p>-->
            </div>
        </div>
        <ul class="favorite-tracks-list plus minus">
            <?php
            $tracks_results = mysqli_query($connect, "SELECT t.*, al.name AS album_name, al.cover AS album_cover, ar.name AS artist_name
            FROM tracks t
            INNER JOIN albums al ON t.album_id = al.id
            INNER JOIN artists ar ON al.artist_id = ar.id
            INNER JOIN playlists_tracks pt ON t.id = pt.track_id
            WHERE pt.playlist_id = '$playlist_id'
            ");

            if (mysqli_num_rows($tracks_results) == 0) {
                echo "<p class='not-found'>Плейлист пуст</p>";
            }
            ?>
            <?php $trackNumber = 1;
            while ($tracks_result = mysqli_fetch_assoc($tracks_results)): ?>
                <li class="track-list-elem">
                    <button class="play-button" data-src="assets/albums_tracks/<?= $tracks_result['file_path'] ?>"
                            data-title="<?= $tracks_result['name'] ?>"
                            data-artist="<?= $tracks_result['artist_name'] ?>"><i class="ri-play-mini-fill"></i>
                    </button>
                    <div class="track-id"><?= $trackNumber ?></div>
                    <img loading="lazy" class="favorite-track-cover" src="assets/albums/<?= $tracks_result['album_cover'] ?>"
                         alt="<?= $tracks_result['album_name'] ?>">
                    <div class="favorite-track-other-info">
                        <div title="<?= $tracks_result['name'] ?>"
                             class="favorite-track-title"><?= $tracks_result['name'] ?></div>
                        <div class="favorite-track-artist"><?= $tracks_result['artist_name'] ?></div>
                    </div>
                    <div class="favorite-heart-or-not">
                        <form method="POST" action="scripts/update_playlist.php">
                            <input type="hidden" name="track_id" value="<?= $tracks_result['id'] ?>">
                            <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                            <input type="hidden" name="playlist_id" value="<?= $playlist_id ?>">
                            <button type="submit" class="favorite-track"><i class="ri-add-box-fill"></i></button>
                        </form>
                    </div>
                    <?php if ($user['premium']): ?>
                        <button title="Скачать" class="download-button"
                                data-file="assets/albums_tracks/<?= $tracks_result['file_path'] ?>"><i
                                class="ri-download-2-fill"></i></button>
                    <?php endif; ?>
                    <input type="range" min="0" max="1" step="0.1" value="0.2" class="volume-range">
                    <div class="track-duration"><?= $tracks_result['duration'] ?></div>
                </li>
                <?php $trackNumber++; endwhile; ?>
        </ul>
        <div id="current-track-info">Никакая песня не проигрывается</div>
    </div>
</section>
<script src="js/premium.js"></script>
<script src="js/main.js"></script>
</body>
</html>