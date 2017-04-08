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

    var $formCultureFest = $('form#contact-culture-fest');
    $formCultureFest.ajaxForm({
        dataType: 'json',
        success: function(data) {
            if (data.success) {
                $formCultureFest.find('input[type="text"], input[type="email"], textarea').val('');
                $formCultureFest.slideUp();
                $formCultureFest.parent().find('.alert-success').slideDown();
                $formCultureFest.parent().find('.alert-danger').slideUp();
                setTimeout(function() {
                    $('#ouibounce-modal').fadeOut();
                }, 3000);
            } else {
                $formCultureFest.parent().find('.alert-danger').slideDown();
                $formCultureFest.parent().find('.alert-success').slideUp();
                setTimeout(function() {
                    $formCultureFest.parent().find('.alert-danger').slideUp();
                }, 3000);
            }
        }
    });
});
