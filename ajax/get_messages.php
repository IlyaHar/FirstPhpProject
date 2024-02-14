<?php
require_once '../lib/mysql.php';

$sql = 'SELECT * FROM `chat` ORDER BY `id` DESC';
$query = $pdo->query($sql);
$messages = $query->fetchAll(PDO::FETCH_OBJ);

if (count($messages) == 0) {
  echo '<div class="noMessage">Пока сообщений еще нет</div>';
  exit();
}

foreach ($messages as $message) {
  echo "<div class='message'>
  <b><p>$message->sender</p><br></b>
  <p>$message->message</p>
  </div>";
}
