$(document).ready(function() {
    $('form[name=newsletter]').ajaxForm({
        dataType: 'html',
        success: function(response, status, xhr, $form) {
            $form.replaceWith(response);
        }
    });
});
