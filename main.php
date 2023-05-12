<?php
session_start();
require_once 'scripts/connect.php';

if (!isset($_SESSION["username"])) {
    header("Location: index.php");
    exit();
}

$genres = mysqli_query($connect, "SELECT * FROM genres");
$years = mysqli_query($connect, "SELECT DISTINCT year FROM albums ORDER BY year DESC");

$selected_genre = isset($_GET['genre_id']) ? $_GET['genre_id'] : '';
$selected_year = isset($_GET['year']) ? $_GET['year'] : '';
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
<section class="all">
    <div class="container">
        <form class="filters-form" action="main.php" method="get">
            <select class="filters-form-select" name="genre_id">
                <option class="filters-form-option" value="">Все жанры</option>
                <?php while ($genre = mysqli_fetch_assoc($genres)): ?>
                    <option class="filters-form-option"
                            value="<?= $genre['id'] ?>" <?= $selected_genre == $genre['id'] ? 'selected' : '' ?>>
                        <?= $genre['name'] ?>
                    </option>
                <?php endwhile; ?>
            </select>

            <select class="filters-form-select" name="year">
                <option class="filters-form-option" value="">Все года</option>
                <?php while ($year = mysqli_fetch_assoc($years)): ?>
                    <option class="filters-form-option"
                            value="<?= $year['year'] ?>" <?= $selected_year == $year['year'] ? 'selected' : '' ?>>
                        <?= $year['year'] ?>
                    </option>
                <?php endwhile; ?>
            </select>
            <button class="filters-button" type="submit">Фильтровать</button>
        </form>

        <div class="all-start plus">
            <h1 class="all-title">Альбомы</h1>
            <p class="all-desc-albums" onclick="showAlbums()">Показать все</p>
        </div>

        <div class="albums">
            <?php
            $no_results = false;
            $sql = "SELECT albums.*, artists.name AS artist_name, genres.name AS genre_name 
    FROM albums 
    JOIN artists ON albums.artist_id = artists.id 
    LEFT JOIN genres ON albums.genre_id = genres.id
    WHERE 1=1";
            if (!empty($selected_genre)) {
                $sql .= " AND albums.genre_id = $selected_genre";
            }
            if (!empty($selected_year)) {
                $sql .= " AND albums.year = $selected_year";
            }
            $result = mysqli_query($connect, $sql);
            $num_albums = mysqli_num_rows($result);
            if ($num_albums == 0) {
                $no_results = true;
                echo '<p class="not-found">По данным фильтрам ничего не найдено</p>';
            }
            $counter = 1;
            while ($album = mysqli_fetch_assoc($result)): ?>
                <a href="album_page.php?id=<?= $album['id'] ?>">
                    <div class="album" <?= $counter > 5 ? 'style="display:none;"' : '' ?>>
                        <img loading="lazy" class="album-cover" src="assets/albums/<?= $album['cover'] ?>" alt="<?= $album['name'] ?>">
                        <div class="album-info">
                            <h3 title="<?= $album['name'] ?>" class="album-title"><?= $album['name'] ?></h3>
                            <p class="album-artist"><?= $album['artist_name'] ?></p>
                        </div>
                    </div>
                </a>
                <?php $counter++; endwhile; ?>
        </div>

        <div class="all-start plus">
            <h1 class="all-title">Исполнители</h1>
            <p class="all-desc-artists" onclick="showArtists()">Показать все</p>
        </div>

        <?php
        $artists = mysqli_query($connect, "SELECT * FROM `artists`");
        ?>

        <div class="artists">
            <?php $count = 0; ?>
            <?php while ($artist = mysqli_fetch_assoc($artists)): ?>
                <a href="artist_page.php?id=<?= $artist['id'] ?>">
                    <div class="artist" <?= $count > 4 ? 'style="display:none;"' : '' ?>>
                        <img loading="lazy" class="artist-cover" src="assets/artists/<?= $artist['artist_cover'] ?>"
                             alt="<?= $artist['name'] ?>">
                        <div class="artist-info">
                            <h3 title="<?= $artist['name'] ?>" class="artist-title"><?= $artist['name'] ?></h3>
                        </div>
                    </div>
                </a>
                <?php $count++; ?>
            <?php endwhile; ?>
        </div>
    </div>
</section>
<script>
    const albums = document.querySelectorAll('.album');
    const showAll = document.querySelector('.all-desc-albums');

    if (albums.length <= 5 || <?= $num_albums ?> <= 5) {
        showAll.style.display = 'none';
    }
</script>
<script src="js/main.js"></script>
</body>
</html>