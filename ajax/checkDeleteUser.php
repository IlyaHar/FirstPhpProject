<?php
require "../lib/mysql.php";

$userId = $_POST['id'];

$sql = "DELETE FROM `users` WHERE `id` = :id";
$query = $pdo->prepare($sql);
$query->execute(['id' => $userId]);

