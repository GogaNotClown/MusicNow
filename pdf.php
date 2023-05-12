<?php
require_once 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;

$username = $_GET['username'];
$userEmail = $_GET['email'];

$dompdf = new Dompdf();

$dompdf->setPaper('A4', 'portrait');

$html = '<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Данные пользователя</title>
    <style>
        @font-face {
            font-family: "DejaVu Sans";
            src: url("https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.3.200/pdf.worker.min.js");
        }
        body {
            font-family: "DejaVu Sans", sans-serif;
        }
    </style>
</head>
<body>
    <h1>Данные пользователя</h1>
    <p>Логин: ' . $username . '</p>
    <p>Почта: ' . $userEmail . '</p>
</body>
</html>';

$dompdf->loadHtml($html);

$dompdf->render();

file_put_contents('assets/user_data.pdf', $dompdf->output());

$dompdf->stream('user_data.pdf');
