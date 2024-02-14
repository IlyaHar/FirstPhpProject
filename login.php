<!DOCTYPE html>
<html lang="ru">
<?php
$website_title = "Авторизация";
require "blocks/head.php"
?>

<body>
    <?php require "blocks/header.php" ?>
    <main>
        <?php if (!isset($_COOKIE['login'])) : ?>
            <h1>Авторизация</h1>
            <form id="login_form">
                <label for="login">Логин</label>
                <input type="text" name="login" id="login">
                <label for="password">Пароль</label>
                <input type="password" name="password" id="password">
                <div class="error_mess" id="error_block"></div>
                <button type="button" id="login_user">Войти</button>
            </form>
        <?php else : ?>
            <h2><?= $_COOKIE['login'] ?></h2>
            <form>
                <button type="button" id="exit_user">Выйти</button>
            </form>
        <?php endif; ?>
    </main>
    <?php require "blocks/aside.php" ?>
    <?php require "blocks/footer.php" ?>

    <script>
        $('#login_user').click(function() {
            let login = $('#login').val();
            let password = $('#password').val();

            $.ajax({
                url: 'ajax/checkLogin.php',
                type: 'POST',
                cache: false,
                data: {
                    'login': login,
                    'password': password
                },
                dataType: 'html',
                success: function(data) {
                    if (data === "Done") {
                        document.location.reload(true);
                        $('#login_user').prop('disabled', true);
                        $('#login_user').css('font-weight', '600');
                        $('#login_user').text("Все готово");
                        $('#error_block').hide();
                        $('#login_form').trigger('reset');
                    } else {
                        $('#error_block').show();
                        $('#error_block').text(data);
                    }
                }
            });
        });

        $('#exit_user').click(function() {
            $.ajax({
                url: 'ajax/checkExit.php',
                type: 'POST',
                cache: false,
                data: {},
                dataType: 'html',
                success: function(data) {
                    document.location.reload(true);
                }
            });
        });
    </script>
</body>

</html>