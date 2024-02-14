<?php
if (!isset($_COOKIE['login'])) {
    header('Location: error.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="ru">
<?php
$website_title = "Cписок пользывателей";
require "blocks/head.php"
?>

<body>
    <?php require "blocks/header.php" ?>
    <main>
        <h1>
            Список пользывателей
        </h1>
        <?php 
        require "lib/mysql.php";

        $sql = "SELECT `id`, `name`, `login` FROM `users`";
        $query = $pdo->prepare($sql);
        $query->execute();

        $users = $query->fetchAll(PDO::FETCH_OBJ);

        foreach ($users as $user):   
        ?>

        <div class="user_block" id="<?= $user->id ?>">
            <div>
            <span><strong>Имя: </strong><?= $user->name ?></span>
            <span><strong>Логин: </strong><?= $user->login ?></span>
            </div>
            <button class="btn_delete" onclick=" return deleteUser(<?= $user->id ?>);">Удалить</button>
        </div>

        <?php endforeach; ?>
    </main>
    <?php require "blocks/aside.php" ?>
    <?php require "blocks/footer.php" ?>

    <script>
        function deleteUser(id) {
            $.ajax({
                url: 'ajax/checkDeleteUser.php',
                type: 'POST',
                cache: false,
                data: {
                    'id': id
                },
                dataType: 'html',
                success: function(data) {
                    $('#' + id).remove();
                }
            });
        }
    
        </script>

</body>

</html>