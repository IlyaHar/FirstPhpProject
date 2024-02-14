<!DOCTYPE html>
<html lang="ru">
<?php
$website_title = "Контакти";
require "blocks/head.php"
?>

<body>
    <?php require "blocks/header.php" ?>
    <main>
        <h1>Обратная связь</h1>
        <div class="success_mess" id="success_block"></div>
        <form id="contact_form">
            <label for="username">Ваше имя</label>
            <input type="text" name="username" id="username">
            <label for="email">Email</label>
            <input type="email" name="email" id="email">
            <label for="message">Сообщение</label>
            <textarea name="message" id="message"></textarea>

            <div class="error_mess" id="error_block"></div>
            <button type="button" id="send_mess">Отправить</button>
        </form>
    </main>
    <?php require "blocks/aside.php" ?>
    <?php require "blocks/footer.php" ?>

    <script>
        $('#send_mess').click(function() {
            let username = $('#username').val();
            let email = $('#email').val();
            let message = $('#message').val();

            $.ajax({
                url: 'ajax/checkContact.php',
                type: 'POST',
                cache: false,
                data: {
                    'username': username,
                    'email': email,
                    'message': message
                },
                dataType: 'html',
                success: function(data) {
                    if (data === "Done") {
                        $('#send_mess').prop('disabled', true);
                        $('#send_mess').text("Все готово");
                        $('#send_mess').css('font-weight', '600');
                        $('#error_block').hide();
                        $('#contact_form').trigger('reset');
                        $('#success_block').fadeIn();
                        $('#success_block').text(`Вы успешно отправили сообщение!`);
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