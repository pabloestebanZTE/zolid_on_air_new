var vista = {
    init: function () {
        vista.events();
        vista.configView();
    },
    events: function () {
        $('#status').on('change', vista.onChangeStatus);
        $('#createScaling').on('submit', vista.onSubmitFormScaling);
    },
    onSubmitFormScaling: function (e) {
        app.stopEvent(e);
        var form = $(this);
        dom.confirmar("¿Está seguro que desea escalar el ticket?", function () {
            dom.submitDirect(form, function (response) {
                if (response.code > 0) {
                    location.href = app.urlTo('User/principalView');
                } else {
                    swal("Error", "Lo sentimos se ha producido un error", "error");
                }
            });
        }, function () {
            swal("Cancelado", "Se ha cancelado la acción", "error");
        });
    },
    onChangeStatus: function () {
        var status = $("#status").val();
        $('#substatus').empty();
        for (var j = 0; j < items.statusOnAir.data.length; j++) {
            if (status === items.statusOnAir.data[j].k_id_status) {
                $('#substatus').append($('<option>', {
                    value: items.statusOnAir.data[j].k_id_status_onair,
                    text: items.statusOnAir.data[j].n_name_substatus
                }));
            }
        }
    },
    onClickItemState: function (e) {

    },
    configView: function () {
        console.log(items);
        vista.fillCmbStatus();
        vista.fillForm();
        $('#status').val(4).trigger('change');
    },
    fillCmbStatus: function () {
        for (var j = 0; j < items.status.data.length; j++) {
            if (items.status.data[j].k_id_status === '3' || items.status.data[j].k_id_status === '4' || items.status.data[j].k_id_status === '5' || items.status.data[j].k_id_status === '6' || items.status.data[j].k_id_status === '7' || items.status.data[j].k_id_status === '11' || items.status.data[j].k_id_status === '12' || items.status.data[j].k_id_status === '13') {
                $('#status').append($('<option>', {
                    value: items.status.data[j].k_id_status,
                    text: items.status.data[j].n_name_status
                }));
            }
        }
    },
    fillForm: function () {
        $('#createScaling').fillForm(scaling);
    }
};

$(function () {
    vista.init();
})
