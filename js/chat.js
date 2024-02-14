$('#send_mess').click(function () {
    let mess = $('#mess').val();
    $.ajax({
        url: '../ajax/checkChat.php',
        type: 'POST',
        cache: false,
        data: {
            'mess': mess
        },
        dataType: 'html',
        success: function (data) {
            if (data === "Done") {
                
                $('#reg_user').prop('disabled', true);
                $('#reg_user').text("Все готово");
                $('#reg_user').css('font-weight', '600');
                $('.noMessage').hide();
                $('#error_block').hide();
                $('#send_form').trigger('reset');
            } else {
                $('#error_block').show();
                $('#error_block').text(data);
            }
        }
    });
});

setInterval(function() {
    $.ajax({
      url: '../ajax/get_messages.php',
      type: 'POST',
      cache: false,
      dataType: 'html',
      success: function(data) {
        $(".allMessages").html(data);
      }
    });
}, 3000);


$('#clean_chat').click(function () {
    $.ajax({
        url: '../ajax/cleanChat.php',
        type: 'POST',
        cache: false,
        data: { },
        dataType: 'html',
        success: function (data) {
            if (data === "Done") {
                $('#clean_chat').text("Все готово");
                $('#clean_chat').css('font-weight', '600');
                setTimeout(function() {
                    $('#clean_chat').text("Очистить чат");
                    $('#clean_chat').css('font-weight', '300');
                }, 3000);
            } else {
                $('#error_block').show();
                $('#error_block').text(data);
            }
        }
    });
});
