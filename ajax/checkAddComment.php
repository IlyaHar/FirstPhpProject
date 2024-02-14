<?php
$username = trim(filter_var($_POST['username'], FILTER_SANITIZE_SPECIAL_CHARS));
$comment = trim(filter_var($_POST['comment'], FILTER_SANITIZE_SPECIAL_CHARS));
$id = trim(filter_var($_POST['id'], FILTER_SANITIZE_SPECIAL_CHARS));

$error = '';

if (mb_strlen($username) < 2) {
    $error = "Введите имя не менее 2 символов";
} else if (mb_strlen($comment) < 5) {
    $error = "Введите комментарий не менее 5 символов";
} 

if ($error != '') {
    echo $error;
    exit();
}

require "../lib/mysql.php";

$sql = "INSERT INTO `comments` (`name`, `comment`, `article_id`) VALUES (?, ?, ?)";
$query = $pdo->prepare($sql);
$query->execute([$username, $comment, $id]);

echo "Done";
