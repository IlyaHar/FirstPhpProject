<?php
if (!isset($_COOKIE['login'])) {
    header('Location: register.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="ru">
<?php
$website_title = "Добавить статью";
require "blocks/head.php"
?>

<body>
    <?php require "blocks/header.php" ?>
    <main>
        <h1>Добавить статью</h1>
        <div class="success_mess" id="success_block"></div>
        <form id="article_form">
            <label for="title">Название статьи</label>
            <input type="text" name="title" id="title">
            <label for="anons">Анонс</label>
            <textarea name="anons" id="anons"></textarea>
            <label for="full_text">Основной текст</label>
            <textarea name="full_text" id="full_text"></textarea>
            <div class="error_mess" id="error_block"></div>
            <button type="button" id="add_article">Добавить</button>
        </form>
    </main>
    <?php require "blocks/aside.php" ?>
    <?php require "blocks/footer.php" ?>

    <script>
        $('#add_article').click(function() {
            let title = $('#title').val();
            let anons = $('#anons').val();
            let full_text = $('#full_text').val();

            $.ajax({
                url: 'ajax/checkAddArticle.php',
                type: 'POST',
                cache: false,
                data: {
                    'title': title,
                    'anons': anons,
                    'full_text': full_text
                },
                dataType: 'html',
                success: function(data) {
                    if (data === "Done") {
                        $('#add_article').prop('disabled', true);
                        $('#add_article').text("Все готово");
                        $('#add_article').css('font-weight', '600');
                        $('#error_block').hide();
                        $('#article_form').trigger('reset');
                        $('#success_block').fadeIn();
                        $('#success_block').text(`Cтатья '${title}' успешно опубликована!`);
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