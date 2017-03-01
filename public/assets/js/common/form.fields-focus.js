$(function() {
    $('.form-float .form-line .form-control').each(function () {
        if($(this).val() != '')
        {
            $(this).parent().addClass('focused');
        }
    })
});