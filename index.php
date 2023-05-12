<?php
session_start();
require_once 'scripts/connect.php';

if (isset($_SESSION["username"])) {
    header("Location: main.php");
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
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="assets/logo.svg" type="image/svg+xml">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.0.0/fonts/remixicon.css" rel="stylesheet">
</head>
<body>
<header class="header">
    <div class="header-logo">
        <img loading="lazy" src="assets/logo.svg" alt="Логотип">
    </div>
    <nav class="nav">
        <ul class="nav-list">
            <li class="nav-elem btn-register"><a class="nav-link" href="#">Регистрация</a></li>
            <li class="nav-elem btn-login"><a class="nav-link" href="#">Вход</a></li>
        </ul>
    </nav>
</header>
<div class="modal modal-register">
    <div class="modal-content">
        <h2 class="modal-title">Регистрация</h2>
        <form class="modal-form" action="scripts/reg.php" method="post">
            <input pattern="[a-zA-Z0-9._-]{3,10}" required placeholder="Ваш логин" class="modal-input" type="text" name="login">
            <input pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required placeholder="Ваша почта" class="modal-input" type="email" name="email">
            <input pattern="[a-zA-Z0-9]{6,20}" required placeholder="Ваш пароль" class="modal-input" type="password" name="password">
            <button class="modal-button" type="submit">Зарегистрироваться</button>
        </form>
        <button class="modal-close">&times;</button>
    </div>
</div>

<div class="modal modal-login">
    <div class="modal-content">
        <h2 class="modal-title">Вход</h2>
        <form class="modal-form" action="scripts/log.php" method="post">
            <input required placeholder="Ваш логин" class="modal-input" type="text" name="login">
            <input required placeholder="Ваш пароль" class="modal-input" type="password" name="password">
            <button class="modal-button" type="submit">Войти</button>
        </form>
        <button class="modal-close">&times;</button>
    </div>
</div>

<section class="hero">
    <div class="container">
        <div class="hero-content">
            <div class="hero-text">
                <h1 class="hero-title">Музыкальный рай только на MusicNow</h1>
                <p class="hero-desc">Здесь вы сможете наслаждаться самыми разнообразными жанрами музыки от лучших
                    исполнителей со всего мира.</p>
            </div>
            <div class="hero-img">
                <img loading="lazy" src="assets/logo.svg" class="hero-img" alt="Логотип">
            </div>
        </div>
    </div>
</section>
<footer class="footer">
    <div class="container">
        <div class="footer-blocks">
            <div class="footer-block">
                <h1 class="footer-logo">MusicNow</h1>
            </div>
            <div class="footer-block">
                <div class="social-icons">
                    <a href="https://twitter.com"><i class="ri-twitter-fill social-icon"></i></a>
                    <a href="https://youtube.com"><i class="ri-youtube-fill social-icon"></i></a>
                    <a href="https://instagram.com"><i class="ri-instagram-fill social-icon"></i></a>
                </div>
            </div>
        </div>
    </div>
</footer>
<script src="js/script.js"></script>
</body>
</html>