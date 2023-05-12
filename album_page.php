<?php
session_start();
require_once 'scripts/connect.php';

$album_id = $_GET['id'];

$sql = "SELECT albums.*, artists.name AS artist_name, genres.name AS genre_name, albums.year
FROM albums
JOIN artists ON albums.artist_id = artists.id
LEFT JOIN genres ON albums.genre_id = genres.id
WHERE albums.id = $album_id";
$result = mysqli_query($connect, $sql);

if ($result && mysqli_num_rows($result) > 0) {
$album = mysqli_fetch_assoc($result);

$user_username = mysqli_real_escape_string($connect, $_SESSION['username']);
$result = mysqli_query($connect, "SELECT * FROM users WHERE username = '$user_username'");
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
<section class="album-page">
    <div class="container">
        <div class="album-page-info">
            <img loading="lazy" class="album-page-cover" src="assets/albums/<?= $album['cover'] ?>" alt="Обложка альбома">
            <div class="album-page-text">
                <h1 class="album-page-title"><?= $album['name'] ?></h1>
                <a href="artist_page.php?id=<?= $album['artist_id'] ?>">
                    <p class="album-page-author"><?= $album['artist_name'] ?></p>
                </a>
                <p class="album-page-genre"><?= $album['genre_name'] ?> — <?= $album['year'] ?></p>
            </div>
        </div>
        <ul class="tracks-list minus">
            <?php
            $tracks = mysqli_query($connect, "SELECT * FROM tracks WHERE album_id = $album_id");
            $trackNumber = 1;
            while ($track = mysqli_fetch_assoc($tracks)):
                ?>
                <li class="track-list-elem">
                    <button class="play-button" data-src="assets/albums_tracks/<?= $track['file_path'] ?>"
                            data-title="<?= $track['name'] ?>"
                            data-artist="<?= $album['artist_name'] ?>"><i class="ri-play-mini-fill"></i></button>
                    <span class="track-id"><?= $trackNumber ?></span>
                    <span class="track-title"><?= $track['name'] ?></span>
                    <form method="POST" action="scripts/add_favorite.php">
                        <input type="hidden" name="track_id" value="<?= $track['id'] ?>">
                        <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                        <input type="hidden" name="album_id" value="<?= $album['id'] ?>">
                        <?php
                        $result = mysqli_query($connect, "SELECT * FROM favorite_tracks WHERE user_id={$user['id']} AND track_id={$track['id']}");
                        if (mysqli_num_rows($result) == 0) {
                            ?>
                            <button title="Добавить в любимые" type="submit" class="favorite-track"><i
                                    class="ri-heart-line"></i></button>
                            <?php
                        } else {
                            ?>
                            <button title="Убрать из любимых" type="submit" class="favorite-track"><i
                                    class="ri-heart-fill"></i></button>
                            <?php
                        }
                        ?>
                    </form>
                    <?php if ($user['premium']): ?>
                        <button title="Скачать" class="download-button"
                                data-file="assets/albums_tracks/<?= $track['file_path'] ?>"><i
                                class="ri-download-2-fill"></i></button>
                    <?php endif; ?>
                    <?php
                    if (isset($_SESSION["username"]) && $_SESSION["username"] === "$2y$10$0H") {
                        ?>
                        <form method="POST" action="scripts/del_track_from_album.php">
                            <input type="hidden" name="track_id" value="<?= $track['id'] ?>">
                            <input type="hidden" name="album_id" value="<?= $album['id'] ?>">
                            <button type="submit" class="del-button" title="Удалить трек"><i
                                    class="ri-delete-bin-7-line"></i></button>
                        </form>
                        <?php
                    }
                    ?>
                    <input type="range" min="0" max="1" step="0.1" value="0.2" class="volume-range">
                    <span class="track-duration"><?= $track['duration'] ?></span>
                    <audio class="audio-player"></audio>
                </li>
                <?php $trackNumber++; endwhile; ?>
        </ul>
        <div id="current-track-info">
            Никакая песня не проигрывается
        </div>
    </div>
</section>

<?php
} else {
    header('Location: errors/404_2.php');
}
?>
<script src="js/premium.js"></script>
<script src="js/main.js"></script>
</body>
</html>