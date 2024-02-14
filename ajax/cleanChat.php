<?php
require "../lib/mysql.php";

$sql = "TRUNCATE `chat`";
$query = $pdo->query($sql);

echo "Done";
