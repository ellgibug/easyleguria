$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var form = $( 'form' );

    var success_message = '<div class="alert alert-success">Ваше сообщение отправлено</div>';
    var error_message = '<div class="alert alert-danger">Ваше сообщение не отправлено<br>Проверьте правильность заполнения формы - все поля являются обязательными<br>Если письмо не получается отправить через контактную форму, то Вы можете отправить его на email адрес: info@your-test.site</div>';
    var alert_message = '<div class="alert alert-danger">Заполните все поля формы</div>';

    form.find( 'button' ).click(function( event ) {
        event.preventDefault();

        var field_name = form.find('input[name=name]').val().length;
        var field_email = form.find('input[name=email]').val().length;
        var field_subject = form.find('input[name=subject]').val().length;
        var field_message = form.find('textarea[name=message]').val().length;

        if(field_name && field_email && field_subject && field_message) {
            $.ajax({
                type: 'post',
                url: form.attr('action'),
                data: form.serialize(),
                success: function (data) {
                    if (data.data == 1) {
                        $('#contact_info').html(success_message);
                        form.trigger('reset');
                    } else {
                        $('#contact_info').html(error_message);
                    }
                },
                error: function () {
                    $('#contact_info').html(error_message);
                }
            });
        } else {
            $('#contact_info').html(alert_message);
        }
    });
})