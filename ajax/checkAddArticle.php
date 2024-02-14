<?php
$title = trim(filter_var($_POST['title'], FILTER_SANITIZE_SPECIAL_CHARS));
$anons = trim(filter_var($_POST['anons'], FILTER_SANITIZE_SPECIAL_CHARS));
$full_text = trim(filter_var($_POST['full_text'], FILTER_SANITIZE_SPECIAL_CHARS));

$error = '';

if (mb_strlen($title) < 5) {
    $error = "Название статьи должно быть не менее 5 символов";
} else if (mb_strlen($anons) < 10) {
    $error = "Анонс статьи должен быть не менее 10 символов";
} else if (mb_strlen($full_text) < 20) {
    $error = "Основной текст статьи должен быть не менее 20 символов";
}

if ($error != '') {
    echo $error;
    exit();
}

require "../lib/mysql.php";

$sql = "INSERT INTO `articles` (`title`, `anons`, `full_text`, `date`, `avtor`) VALUES (?, ?, ?, ?, ?)";
$query = $pdo->prepare($sql);
$query->execute([$title, $anons, $full_text, time(), $_COOKIE['login']]);


echo "Done";
