$(document).ready(function() {
    var $form = $('form#contact');
    $form.ajaxForm({
        dataType: 'json',
        success: function(data) {
            if (data.success) {
                $form.find('input[type="text"], input[type="email"], textarea').val('');
                $('.alert-success').slideDown();
                $('.alert-danger').slideUp();
                setTimeout(function() {
                    $('.alert-success').slideUp();
                }, 3000);
            } else {
                $('.alert-danger').slideDown();
                $('.alert-success').slideUp();
            }
        }
    });
});
