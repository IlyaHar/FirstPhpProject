<!DOCTYPE html>
<html lang="ru">
<?php
$website_title = "Регистрация";
require "blocks/head.php"
?>

<body>
    <?php require "blocks/header.php" ?>
    <main>
        <h1>Регистрация</h1>
        <div class="success_register" id="success_block"></div>
        <form id="register_form">
            <label for="username">Ваше имя</label>
            <input type="text" name="username" id="username">
            <label for="email">Email</label>
            <input type="email" name="email" id="email">
            <label for="login">Логин</label>
            <input type="text" name="login" id="login">
            <label for="password">Пароль</label>
            <input type="password" name="password" id="password">
            <div class="error_mess" id="error_block"></div>
            <button type="button" id="reg_user">Зарегистрироваться</button>
        </form>
    </main>
    <?php require "blocks/aside.php" ?>
    <?php require "blocks/footer.php" ?>

    <script>
        $('#reg_user').click(function() {
            let username = $('#username').val();
            let email = $('#email').val();
            let login = $('#login').val();
            let password = $('#password').val();

            $.ajax({
                url: 'ajax/checkRegister.php',
                type: 'POST',
                cache: false,
                data: {
                    'username': username,
                    'email': email,
                    'login': login,
                    'password': password
                },
                dataType: 'html',
                success: function(data) {
                    if (data === "Done") {
                        $('#reg_user').prop('disabled', true);
                        $('#reg_user').css('font-weight', '600');
                        $('#reg_user').text("Все готово");
                        $('#error_block').hide();
                        $('#register_form').trigger('reset');
                        $('#success_block').fadeIn();
                        $('#success_block').text(`Поздравляем вас ${username} ! Вы успешно зарегистрировались!`);
                        setTimeout(function() {
                            $('#success_block').fadeOut();
                        }, 5000);
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