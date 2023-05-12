<?php
session_start();
require_once 'connect.php';
require '../phpmailer/PHPMailer.php';
require '../phpmailer/SMTP.php';
require '../phpmailer/Exception.php';

$username = $_POST["login"];
$password = $_POST["password"];
$email = $_POST["email"];

$sql = "SELECT * FROM users WHERE username='$username' OR email='$email'";
$result = mysqli_query($connect, $sql);

if (mysqli_num_rows($result) > 0) {
    header('Location: ../errors/409.php');
} else {
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO users (username, password, email, avatar, premium) VALUES ('$username', '$hashed_password', '$email', 'user_avatar.svg', false)";
    if (mysqli_query($connect, $sql)) {
        $mail = new PHPMailer\PHPMailer\PHPMailer();
        $mail->isSMTP();
        $mail->CharSet = "UTF-8";
        $mail->SMTPAuth   = true;
        $mail->Debugoutput = function($str, $level) {$GLOBALS['status'][] = $str;};
        $mail->Host = 'smtp.mail.ru';
        $mail->SMTPAuth = true;
        $mail->Username = 'sisteykin228@mail.ru'; // замените на свой email
        $mail->Password = '3LpgJDFfnJf2Jbkv2eq3'; // замените на свой пароль
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;
        $mail->setFrom('sisteykin228@mail.ru', 'MusicNow'); // замените на свой email и имя
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'Добро пожаловать!';
        $mail->Body = '
<style>
* {
margin: 0;
padding: 0;
box-sizing: border-box;
list-style: none;
font-family: "Google Sans", sans-serif;
}

.card__email {
    background-color: #1c1c1c;
    padding: 20px 20px;
    border-radius: 20px;
    display: block;
    margin: auto;
    width: 450px;
}

.card__email-emoji {
    text-align: center;
}

.card__email-title {
    text-align: center;
    margin: 20px 0 20px;
    font-weight: 600;
    color: white;
    font-size: 25px;
}

.card__email-copyright {
    text-align: center;
    font-weight: 600;
    color: white;
}
</style>
<section class="email">
    <div class="email__container">
        <div class="card__email">
            <p class="card__email-emoji"><img src="https://i.postimg.cc/4yH59340/logo-1.png" alt="Логотип"></p>
            <h2 class="card__email-title">Добро пожаловать!</h2>
            <p class="card__email-copyright">© 2023 MusicNow</p>
        </div>
    </div>
</section>';
        if (!$mail->send()) {
            echo 'Ошибка при отправке письма: ' . $mail->ErrorInfo;
        }
        header('Location: ../main.php');
    } else {
        echo "Ошибка при регистрации: " . mysqli_error($connect);
        header('Location: ../errors/500.php');
    }
}

mysqli_close($connect);