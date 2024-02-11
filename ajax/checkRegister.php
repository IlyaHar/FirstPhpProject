<?php
$username = trim(filter_var($_POST['username'], FILTER_SANITIZE_SPECIAL_CHARS));
$email = trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
$login = trim(filter_var($_POST['login'], FILTER_SANITIZE_SPECIAL_CHARS));
$password = trim(filter_var($_POST['password'], FILTER_SANITIZE_SPECIAL_CHARS));

$error = '';

if (mb_strlen($username) < 2) {
    $error = "Введите имя не менее 2 символов";
} else if (mb_strlen($email) < 5 || !strpos($email, '@')) {
    $error = "Введите корректный email";
} else if (mb_strlen($login) < 3) {
    $error = "Введите логин не менее 3 символов";
} else if (mb_strlen($password) < 5) {
    $error = "Введите пароль не менее 5 символов";
}

if ($error != '') {
    echo $error;
    exit();
}

require "../lib/mysql.php";

$salt = "asda12412edokqwodaws@$";
$password = md5($salt . $password);

$sql = "SELECT `id` FROM `users` WHERE `email` = :email OR `login` = :login";
$query = $pdo->prepare($sql);
$query->execute(['email' => $email, 'login' => $login]);

if ($query->rowCount() >= 1) {
    echo "Пользыватель с таким логином или электронной почтой уже существует";
    exit();
}

$sql = "INSERT INTO `users` (`name`, `email`, `login`, `password`) VALUES (?, ?, ?, ?)";
$query = $pdo->prepare($sql);
$query->execute([$username, $email, $login, $password]);


echo "Done";
