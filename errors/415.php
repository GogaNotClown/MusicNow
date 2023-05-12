<?php
require_once '../scripts/connect.php';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>500 Internal Server Error</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            list-style: none;
            font-family: "Google Sans", sans-serif;
        }

        body {
            background-color: #ffffff;
            font-size: 16px;
            color: #1c1c1c;
            text-align: center;
        }

        .container {
            margin: 300px auto auto;
            max-width: 600px;
            padding: 40px 20px;
        }

        h1 {
            font-size: 36px;
            margin-bottom: 20px;
        }

        p {
            font-size: 1.50rem;
            margin-bottom: 30px;
        }

        a {
            color: #1c1c1c;
            text-decoration: underline;
        }

        a:hover {
            text-decoration: none;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Тип файла не поддерживается</h1>
    <p>Пожалуйста, загрузите JPEG или PNG файл</p>
    <a href="../main.php">Вернуться на главную</a>
</div>
</body>
</html>
