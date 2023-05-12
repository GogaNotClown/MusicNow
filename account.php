<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();
require_once 'scripts/connect.php';

if (!isset($_SESSION["username"])) {
    header("Location: index.php");
    exit();
}

if (isset($_SESSION['username']) && $_SESSION['username'] === '$2y$10$0H') {
    header('Location: admin.php');
    exit();
}

$user_username = mysqli_real_escape_string($connect, $_SESSION['username']);
$result = mysqli_query($connect, "SELECT * FROM users WHERE username = '$user_username'");
if (!$result) {
    die("Ошибка выполнения запроса: " . mysqli_error($connect));
}
$user = mysqli_fetch_assoc($result);

$user_id = $user['id'];
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
<div class="modal modal-edit">
    <div class="modal-content">
        <h2 class="modal-title">Изменить данные</h2>
        <form class="modal-form" action="scripts/update_account.php" method="post" enctype="multipart/form-data">
            <div class="upload-container">
                <label for="avatar" class="upload-label">
                    <img loading="lazy" id="avatar-preview" src="assets/users/<?php echo $user['avatar']; ?>" alt="Аватар"
                         class="account-info-avatar">
                </label>
                <input style="display: none;" type="file" name="avatar" id="avatar" class="upload-input">
            </div>
            <input pattern="[a-zA-Z0-9._-]{3,10}" required placeholder="Ваш новый логин" class="modal-input" type="text"
                   name="username"
                   value="<?php echo $user['username']; ?>">
            <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
            <button class="modal-button" type="submit">Сохранить</button>
        </form>

        <button class="modal-close">&times;</button>
    </div>
</div>
<div class="modal modal-create">
    <div class="modal-content">
        <h2 class="modal-title">Создать плейлист</h2>
        <form class="modal-form" action="scripts/create_playlist.php" method="post" enctype="multipart/form-data">
            <div class="upload-container">
                <label for="cover" class="upload-label">
                    <img loading="lazy" id="cover-preview" src="assets/create_playlist.svg" alt="Аватар"
                         class="account-info-avatar">
                </label>
                <input required style="display: none;" type="file" name="playlist_cover" id="cover"
                       class="upload-input">
            </div>
            <input pattern="[a-zA-Z0-9._ -]{3,15}" required name="playlist_name" type="text"
                   placeholder="Название плейлиста" class="modal-input">
            <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
            <textarea required name="playlist_desc" placeholder="Описание плейлиста" class="modal-input"></textarea>
            <button class="modal-button" type="submit">Создать</button>
        </form>

        <button class="modal-close">&times;</button>
    </div>
</div>
<section class="account">
    <div class="container">
        <h1 class="account-title">Мой аккаунт</h1>
        <div class="account-info">
            <img loading="lazy" src="assets/users/<?php echo $user['avatar']; ?>" alt="Аватар" class="account-info-avatar">
            <div class="account-super-info">
                <p class="account-status"><?php echo $user['premium'] ? 'Премиум' : 'Пользователь'; ?></p>
                <p class="account-nickname"><?php echo $user['username']; ?><?php echo $user['premium'] ? ' <i class="ri-bard-fill premium"></i>' : ''; ?></p>
                <button title="Изменить данные" class="btn-edit"><i class="ri-pencil-fill"></i></button>
                <a download
                   href="pdf.php?username=<?php echo $user['username']; ?>&email=<?php echo $user['email']; ?>">
                    <button title="Скачать PDF" class="btn-edit"><i class="ri-file-fill"></i></button>
                </a>
            </div>
        </div>
        <h1 class="account-title plus">Плейлисты</h1>
        <div class="playlists_result">
            <a href="favorite_tracks.php">
                <div class="playlist">
                    <img loading="lazy" src="assets/favorite_cover.svg" alt="Любимые треки" class="playlist-cover">
                    <div class="playlist-info">
                        <h3 class="playlist-title">Любимые треки</h3>
                        <p class="playlist-author"><?= $user['username'] ?></p>
                    </div>
                </div>
            </a>
            <?php $playlists = mysqli_query($connect, "SELECT * FROM `playlists` WHERE `user_id` = '$user_id'"); ?>
            <div class="playlist create-playlist">
                <img loading="lazy" src="assets/create_playlist.svg" alt="Создать свой плейлист" class="playlist-cover">
                <div class="playlist-info">
                    <h3 class="playlist-title">Создать плейлист</h3>
                </div>
            </div>
            <?php while ($playlist = mysqli_fetch_assoc($playlists)): ?>
                <a href="playlist_page.php?id=<?= $playlist['id'] ?>">
                    <div class="playlist">
                        <img loading="lazy" src="<?= $playlist['image'] ?>" alt="Обложка <?= $playlist['name'] ?>"
                             class="playlist-cover">
                        <div class="playlist-info">
                            <h1 title="<?= $playlist['name'] ?>"
                                class="playlist-title"><?= $playlist['name'] ?></h1>
                        </div>
                    </div>
                </a>
            <?php endwhile; ?>
        </div>
    </div>
</section>
<script src="js/cover.js"></script>
<script src="js/main.js"></script>
</body>
</html>