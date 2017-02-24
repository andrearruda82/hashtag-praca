$(function(){
    $('.table .bt_action').click(function(){
        var url = $(this).attr('data-url');

        window.location = url;
    });

    $('.table .bt_action_confirm_delete').click(function(){
        var url = $(this).attr('data-url');
        var object_delete = $(this).attr('data-object-delete');

        bootbox.dialog({
            title: 'Confirme',
            message: '<p class="lead">Você realmente deseja <strong>deletar</strong> o registro "<strong>' + object_delete + '</strong>"?<br />Clique em <strong class="col-red">OK</strong> para confirmar!</p>',
            buttons: {
                cancel:{
                    label: 'Cancelar',
                    className: 'btn btn-default waves-effect',
                    callback: function() {
                    }
                },
                confirm:{
                    label: 'OK',
                    className: 'btn btn-lg btn-danger waves-effect',
                    callback: function() {
                        window.location = url;
                    }
                }
            }
        });
    });
});