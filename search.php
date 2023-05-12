<?php
session_start();
require_once 'scripts/connect.php';

if (!isset($_SESSION["username"])) {
    header("Location: index.php");
    exit();
}

if (isset($_GET['query'])) {
    $query = $_GET['query'];

    $sql = "SELECT * FROM albums WHERE name LIKE '%$query%'";
    $result = mysqli_query($connect, $sql);

    $sql = "SELECT * FROM artists WHERE name LIKE '%$query%'";
    $result2 = mysqli_query($connect, $sql);

    $sql = "SELECT * FROM tracks WHERE name LIKE '%$query%'";
    $result3 = mysqli_query($connect, $sql);

    $sql = "SELECT * FROM genres WHERE name LIKE '%$query%'";
    $result4 = mysqli_query($connect, $sql);
}
?>

<!doctype html>
<html lang="en">
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
            <li class="nav-elem"><a class="nav-link" href="account.php"><i class="ri-account-box-fill"></i></a></li>
            <li class="nav-elem"><a class="nav-link" href="scripts/logout.php"><i class="ri-logout-box-line"></i></a>
            </li>
        </ul>
    </nav>
</header>
<section class="search">
    <div class="container">
        <h1 class="search-title">Поиск по сайту</h1>
        <form class="search-form" action="search.php" method="get">
            <input required class="search-input" type="text" name="query" placeholder="Поиск...">
        </form>
        <?php

        if (($result && mysqli_num_rows($result) > 0) || ($result2 && mysqli_num_rows($result2) > 0) || ($result3 && mysqli_num_rows($result3) > 0) || ($result4 && mysqli_num_rows($result4) > 0)) {
            echo "<h2 class='search-title plus'>Результаты поиска:</h2>";

            if ($result && mysqli_num_rows($result) > 0) {
                echo "<h3 class='search-title-result'>Альбомы:</h3>";
                while ($album = mysqli_fetch_assoc($result)) {
                    echo "<div class='mini-plus'><a title='{$album['name']}' class='search-title-result search-link' href='album_page.php?id={$album['id']}'>{$album['name']}</a></div>";
                }
            }

            if ($result2 && mysqli_num_rows($result2) > 0) {
                echo "<h3 class='search-title-result'>Исполнители:</h3>";
                while ($artist = mysqli_fetch_assoc($result2)) {
                    echo "<div class='mini-plus'><a title='{$artist['name']}' class='search-title-result search-link' href='artist_page.php?id={$artist['id']}'>{$artist['name']}</a></div>";
                }
            }

            if ($result3 && mysqli_num_rows($result3) > 0) {
                echo "<h3 class='search-title-result'>Треки:</h3>";
                while ($track = mysqli_fetch_assoc($result3)) {
                    $album_query = mysqli_query($connect, "SELECT albums.id FROM albums JOIN tracks ON albums.id = tracks.album_id WHERE tracks.id = {$track['id']}");
                    $album = mysqli_fetch_assoc($album_query);
                    echo "<div class='mini-plus'><a title='{$track['name']}' class='search-title-result search-link' href='album_page.php?id={$album['id']}'>{$track['name']}</a></div>";
                }
            }

            if ($result4 && mysqli_num_rows($result4) > 0) {
                echo "<h3 class='search-title-result'>Жанры:</h3>";
                while ($genre = mysqli_fetch_assoc($result4)) {
                    echo "<div class='mini-plus'><a title='{$genre['name']}' class='search-title-result search-link' href='main.php?genre_id={$genre['id']}'>{$genre['name']}</a></div>";
                }
            }
        } else if (isset($_GET['query'])) {
            echo "<p class='not-found mini-plus'>Ничего не найдено.</p>";
        }

        ?>
        <?php
        $albums = mysqli_query($connect, "SELECT * FROM `albums`");
        ?>
        <h1 class="search-title plus">Рекомендуем</h1>
        <div class="albums plus">
            <?php
            $no_results = false;
            $sql = "SELECT albums.*, artists.name AS artist_name, genres.name AS genre_name 
            FROM albums 
            JOIN artists ON albums.artist_id = artists.id 
            LEFT JOIN genres ON albums.genre_id = genres.id
            WHERE 1=1 ORDER BY RAND()";
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
                        <img loading="lazy" class="album-cover" src="assets/albums/<?= $album['cover'] ?>"
                             alt="<?= $album['name'] ?>">
                        <div class="album-info">
                            <h3 title="<?= $album['name'] ?>" class="album-title"><?= $album['name'] ?></h3>
                            <p class="album-artist"><?= $album['artist_name'] ?></p>
                        </div>
                    </div>
                </a>
                <?php $counter++; endwhile; ?>
        </div>
    </div>
</section>
</body>
</html>