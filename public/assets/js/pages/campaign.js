$(function () {
    $('#period_final').bootstrapMaterialDatePicker({
        lang: 'pt-BR',
        weekStart: 0,
        format: 'DD/MM/YYYY',
        time: false
    });

    $('#period_start').bootstrapMaterialDatePicker({
        lang: 'pt-BR',
        weekStart: 0,
        format: 'DD/MM/YYYY',
        time: false
    }).on('change', function(e, date) {
        $('#period_final').bootstrapMaterialDatePicker('setMinDate', date);
    })
});