<!DOCTYPE html>
<html lang="ru">
<?php
$id = $_GET['id'];

require "lib/mysql.php";

$sql = "SELECT * FROM `articles` WHERE `id` = :id";
$query = $pdo->prepare($sql);
$query->execute(['id' => $id]);

$article = $query->fetch(PDO::FETCH_OBJ);

$website_title = $article->title;
require "blocks/head.php"
?>

<body>
    <?php require "blocks/header.php" ?>
    <main>
        <div class='post'>
            <h1><?= $article->title ?></h1>
            <p><?= $article->anons ?></p><br>
            <p><?= $article->full_text ?></p>
            <p class='avtor'>Автор: <span><?= $article->avtor ?></span></p><br>
            <p><b>Время публикации: </b><?= date("H-i-s", $article->date) ?></p>
        </div>
        <h3>Комментарии</h3>
        <form id="register_form">
            <label for="username">Ваше имя</label>
            <?php if (isset($_COOKIE['login'])) : ?>
                <input type="text" name="username" id="username" value="<?= $_COOKIE['login'] ?>" readonly>
            <?php else : ?>
                <input type="text" name="username" id="username">
            <?php endif; ?>
            <label for="comment">Комментарий</label>
            <textarea type="text" name="comment" id="comment"></textarea>
            <div class="error_mess" id="error_block"></div>
            <button type="button" id="send_comment">Добавить комментарий</button>
        </form>
        <div class="comments">
            <?php
            require "lib/mysql.php";

            $sql = "SELECT * FROM `comments` WHERE `article_id` = :id ORDER BY `id` DESC";
            $query = $pdo->prepare($sql);
            $query->execute(['id' => $id]);

            if ($query->rowCount() == 0) {
                echo "<p id='NoComment'><b>Комментариев к этой статье нет.</b></p>";
            }
            

            $comments = $query->fetchAll(PDO::FETCH_OBJ);


            foreach ($comments as $comment) {
                echo "<div class='comment'>
                <h2>$comment->name</h2>
                <p>$comment->comment</p>
                
                </div>";
            }



            ?>
        </div>
    </main>
    <?php require "blocks/aside.php" ?>
    <?php require "blocks/footer.php" ?>
    <script>
        $('#send_comment').click(function() {
            let username = $('#username').val();
            let comment = $('#comment').val();

            $.ajax({
                url: 'ajax/checkAddComment.php',
                type: 'POST',
                cache: false,
                data: {
                    'username': username,
                    'comment': comment,
                    'id': '<?= $_GET['id'] ?>'
                },
                dataType: 'html',
                success: function(data) {
                    if (data === "Done") {
                        $('#NoComment').hide();
                        $('.comments').prepend(`<div class='comment'>
                        <h2>${username}</h2>
                        <p>${comment}</p>
                </div>`);
                        $('#send_comment').text("Все готово");
                        $('#send_comment').css('font-weight', '600');
                        $('#error_block').hide();
                        $('#comment').val('');
                    } else {
                        $('#error_block').show();
                        $('#error_block').text(data);
                    }
                }
            });
        });
    </script>
</body>

</html>