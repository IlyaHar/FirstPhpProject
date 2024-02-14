<?php
$mess = trim(filter_var($_POST['mess'], FILTER_SANITIZE_SPECIAL_CHARS));

$error = '';

if ($mess == '') {
    $error = "Введите сообщение";
}

if ($error != '') {
    echo $error;
    exit();
}

require "../lib/mysql.php";

$sql = "INSERT INTO `chat` (`message`, `sender`) VALUES (?, ?)";
$query = $pdo->prepare($sql);
$query->execute([$mess, isset($_COOKIE['login']) ? $_COOKIE['login'] : 'NoName']);

echo "Done";
