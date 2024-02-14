<?php
$login = trim(filter_var($_POST['login'], FILTER_SANITIZE_SPECIAL_CHARS));
$password = trim(filter_var($_POST['password'], FILTER_SANITIZE_SPECIAL_CHARS));

$error = '';

if (mb_strlen($login) < 3) {
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

$sql = "SELECT `id` FROM `users` WHERE  `login` = :login AND `password` = :password";
$query = $pdo->prepare($sql);
$query->execute(['login' => $login, 'password' => $password]);

if ($query->rowCount() == 0) {
    echo "Пользыватель с такими данными не найден. Вы ввели не верно логин или пароль.";
    exit();
}


setcookie('login', $login, time() + 3600 * 24 * 30, '/');


echo "Done";
