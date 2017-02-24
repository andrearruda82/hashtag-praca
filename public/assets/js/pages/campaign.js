$(function () {
    $('#period_start').datetimepicker({
        format: 'DD/MM/YYYY',
        locale: 'pt-br'
    });

    $('#period_final').datetimepicker({
        format: 'DD/MM/YYYY',
        locale: 'pt-br',
        useCurrent: false
    });

    $("#period_start").on("dp.change", function (e) {
        $('#period_final').data("DateTimePicker").minDate(e.date);
    });
    $("#period_final").on("dp.change", function (e) {
        $('#period_start').data("DateTimePicker").maxDate(e.date);
    });
});