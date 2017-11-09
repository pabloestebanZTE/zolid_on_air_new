var TD = {
    contentFases: $('#contentFases'),
    init: function () {
        TD.events();
        TD.configView();
        TD.getDetail();
        TD.listCombox();
        TD.getDetails();
        dom.submit($('#formTrackingDetails'), null, false);
    },
    events: function () {
        $('#btnDetails').on('click', TD.onClickDetails);
        $('.hour-step .icon-step').on('click', TD.onClickIconStep);
        $('.states-modal li a').on('click', TD.onClickItemState);
        $('.select-fill').on('select2fill', function () {
            var cmb = $(this);
            cmb.val(cmb.attr('data-value'));
            cmb.trigger('change.select2');
        });
    },
    onClickItemState: function (e) {
//        app.stopEvent(e);
        var link = $(this);
        var ul = link.parents('ul');
        ul.find('a.active').removeClass('active');
        link.addClass('active');
    },
    onClickIconStep: function () {
        var icon = $(this);
        $('#modalChangeState').modal('show');
    },
    listCombox: function () {
        TD.listStates();
    },
    listStates: function () {
        var cmbStatus = $('#cmbEstadosTD');
        var cmbSubStatus = $('#cmbSubEstadosTD');
        app.post('TicketOnair/getAllStates').success(function (response) {
            if (response.code > 0) {
                dom.llenarCombo(cmbStatus, response.data["states"], {text: 'n_name_status', value: 'k_id_status'});
                dom.llenarCombo(cmbSubStatus, response.data["substates"], {text: 'n_name_substatus', value: 'k_id_substatus'});
            } else {
                dom.comboVacio(cmbStatus);
            }
        }).error(function (e) {
            console.error(e);
            dom.comboVacio(cmbStatus);
        }).send();
    },
    configView: function () {
        dom.configCalendar($('#txtFechaIngresoOnAir'));
        dom.configCalendar($('#txtCorrecionPendientes'));
        dom.configCalendar($('#txtFechaApertura'));
        dom.configCalendar($('#txtFechaRFT'));
        dom.configCalendar($('#txtFechaCG'));
        dom.configCalendar($('#txtFechaBloqueado'));
        dom.configCalendar($('#txtFechaDesBloqueado'));
//        dom.timer($('#timeStep'), 1509706921000, $('#progressStep1'));
        $('select').select2({'width': '100%'});
    },
    getDetail: function () {
        var alert = dom.printAlert('Consultando detalles, por favor espere...', 'loading', $('#principalAlert'));
        //Consultamos...
        app.post('TicketOnair/getAllService', {id: app.getParamURL('id')})
                .success(function (response) {
                    console.log(response);
                    if (response.code > 0) {
                        $('#trackingDetails').removeClass('hidden');
                        alert.hide();
                        $('#formDetallesBasicos').fillForm(response.data);
                        var objTemp = {ticket_on_air: response.data};
                        var form = $('#formTrackingDetails');
                        form.fillForm(objTemp);
                        objTemp = {preparation_stage: response.data.k_id_preparation};
                        form.fillForm(objTemp);
                        form.find('#cmbEstadosTD').attr("data-value", response.data.k_id_status_onair.k_id_status.k_id_status);
                        form.find('#cmbSubEstadosTD').attr("data-value", response.data.k_id_status_onair.k_id_substatus.k_id_substatus);
                        form.find('.select-fill').trigger('select2fill');
                        form.find('select').trigger('change.select2');
                    } else {
                        alert.print("No se encontró ninguna coincidencia", "warning");
                    }
                }).error(function (error) {
            alert.print("Se ha producido un error desconocido, compruebe su conexión a internet y vuelva a intentarlo.", "danger");
            console.error(error);
        }).send();
    },
    onClickDetails: function () {
        $('#modalDetailsInit').modal('show');
    },
    getDetails: function () {
        dom.printAlert('Consultando, por favor espere...', 'loading', $('#alertFases'));
        app.post('TicketOnair/getProcessTicket', {id: app.getParamURL("id")})
                .success(function (response) {
                    dom.alertControl(response, $('#alertFases'), true);
                    if (response.code > 0) {
                        $('#contentFases').removeClass('hidden').hide().fadeIn(500);
                    }
                })
                .error(function (e) {
                    console.error(e);
                    dom.alertError($('#alertFases'));
                })
                .send();
    },
};

$(function () {
    TD.init();
})
