<?php
$username = trim(filter_var($_POST['username'], FILTER_SANITIZE_SPECIAL_CHARS));
$email = trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
$message = trim(filter_var($_POST['message'], FILTER_SANITIZE_SPECIAL_CHARS));

$error = '';

if (mb_strlen($username) < 2) {
    $error = "Введите имя не менее 2 символов";
} else if (mb_strlen($email) < 5 || !strpos($email, '@')) {
    $error = "Введите корректный email";
} else if (mb_strlen($message) < 10) {
    $error = "Введите сообщение не менее 10 символов";
} 

if ($error != '') {
    echo $error;
    exit();
}

$to = "harcenkoila278@gmail.com";
$subject = "=?utf-8?B?" . base64_encode("Новое сообщение") . "?=";
$mess = "Имя пользывателя: $username.<br>$message";
$headers = "From: $email\r\nReply-to: $email\r\nContent-type: text/html; charset=utf-8\r\n";

mail($to, $subject, $mess, $headers);

echo "Done";
