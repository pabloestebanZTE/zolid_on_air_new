var TD = {
    contentFases: $('#contentFases'),
    exec: false,
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
        $('.hour-step').on('click', TD.onClickHourStep);
        $('.states-modal li a').on('click', TD.onClickItemState);
        $('.select-fill').on('select2fill', function () {
            var cmb = $(this);
            cmb.val(cmb.attr('data-value'));
            cmb.trigger('change.select2');
        });
        $('#btnAceptarModal').on('click', TD.onClickAceptarModal);
    },
    onClickHourStep: function () {
        $hourStep = $(this);
        $('.row.wiget').addClass('hidden');
        $($hourStep.attr('data-ref')).removeClass('hidden');
        $('.hour-step').removeClass('active');
        $hourStep.addClass('active');
    },
    onClickAceptarModal: function () {
        var action = $('.states-modal a.active').attr('data-action');
        switch (action) {
            case "PROR":
                TD.createProrroga();
                break;
            case "NEXT":
                TD.nextFase();
                break;
        }
    },
    createProrroga: function () {
        //Validamos...
        var txtHorasProrroga = $('#txtTiempoProrroga');
        if (txtHorasProrroga.val().trim() === "" || txtHorasProrroga.val() == 0) {
            swal("Error", "El tiempo asignado para la prórroga es inválido.", "error");
            return;
        }
        var obj = {
            idProceso: $('#idProceso').val(),
            hours: txtHorasProrroga.val(),
            comment: $('#modalChangeState #txtObservations').val()
        };
        app.post('TicketOnair/createProrroga', obj)
                .success(function (response) {
                    console.log(response);
                    var v = app.validResponse(response);
                    if (v) {
                        swal("Guardado", "Se ha registrado la prórroga éxitosamente.", "success");
                        TD.getDetails();
                    } else {
                        swal("Atención", "No se pudo registrar la prórroga.", "warning");
                    }
                }).error(function (e) {
            swal("Error", "Se ha producido un error desconocido, compruebe su conexión y vuelva a intentarlo.", "error");
            console.log(e);
        }).send();
    },
    nextFase: function () {
        console.log("SIGUIENTE FASE");
        var cmb = $('#cmbSiguienteFase');
        if (cmb.val().trim() === "") {
            swal("Error", "La fase seleccionada es inválida.", "error");
            return;
        }
        var obj = {
            idProceso: $('#idProceso').val(),
            fase: cmb.val(),
            comment: $('#modalChangeState #txtObservations').val()
        };
        app.post('TicketOnair/nextFase', obj)
                .success(function (response) {
                    console.log(response);
                    var v = app.validResponse(response);
                    if (v) {
                        swal("Guardado", "Se ha terminado la fase correctamente.", "success");
                        TD.getDetails();
                    } else {
                        swal("Atención", response.message, "warning");
                    }
                }).error(function (e) {
            swal("Error", "Se ha producido un error desconocido, compruebe su conexión y vuelva a intentarlo.", "error");
            console.log(e);
        }).send();
    },
    onClickItemState: function (e) {
        var link = $(this);
        var ul = link.parents('ul');
        if (link.hasClass('active')) {
            link.next().slideUp(500);
            return;
        }
        if (link.next()) {
            ul.find('.content-state').slideUp(500);
            link.next().removeClass('hidden').hide().slideDown(500);
            $(link.attr('data-focus')).focus();
        }
        ul.find('a.active').removeClass('active');
        link.addClass('active');
    },
    onClickIconStep: function () {
        var icon = $(this);
        var parent = icon.parents('.hour-step');
        var hr = parseInt(parent.attr('data-value')) + 12;
        hr = (hr > 36) ? 36 : hr;
        $('#txtTiempoProrroga').val("12");
        $('#cmbSiguienteFase').val(hr + "h").trigger('change.select2');
        $('#modalChangeState .content-state').hide();
        $('#modalChangeState a.active').removeClass('active');
        if (parent.hasClass('prorroga')) {
            $('#modalChangeState .states-modal a:eq(0)').addClass('disabled');
        } else if (parent.hasClass('escalado')) {
            $('#modalChangeState .states-modal a:eq(0)').addClass('disabled');
            $('#modalChangeState .states-modal a:eq(1)').addClass('disabled');
            $('#modalChangeState .states-modal a:eq(2)').addClass('disabled');
        } else {
            $('#modalChangeState .states-modal a').removeClass('disabled');
        }
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
                        //Listamos los grupos...
                        if (!TD.exec) {
                            TD.listGroups(response.data.groups, response.data.group);
                            TD.listDetails(response.data.details);
                        }
                        TD.setTimers(response.data);
                    }
                })
                .error(function (e) {
                    console.error(e);
                    dom.alertError($('#alertFases'));
                })
                .send();
    },
    setTimers: function (obj) {
        $('.timerstamp').html('<i class="fa fa-fw fa-info-circle"></i> No definido');
        var fn = function () {
            if (TD.exec) {
                return true;
            }
            TD.getDetails();
            TD.exec = true;
        };
        $('.hour-step').removeClass('active').addClass('disabled');
        $('.row.wiget').addClass('hidden');
        $('.hour-step').removeClass('active');

        switch (obj.actual_status) {
            case "12h":
                $('[data-ref="#contentDetails_12h"]').addClass('active').removeClass('disabled');
                dom.timer($('[data-ref="#contentDetails_12h"] #timeStep'), $('[data-ref="#contentDetails_12h"] .progress-step'), fn, obj);
                $('#contentDetails_12h').removeClass('hidden');
                break;
            case "24h":
                $('[data-ref="#contentDetails_12h"]').removeClass('disabled');
                $('[data-ref="#contentDetails_24h"]').addClass('active').removeClass('disabled');
                dom.timer($('[data-ref="#contentDetails_24h"] #timeStep'), $('[data-ref="#contentDetails_24h"] .progress-step'), fn, obj);
                $('#contentDetails_24h').removeClass('hidden');
                break;
            case "36h":
                $('[data-ref="#contentDetails_12h"]').removeClass('disabled');
                $('[data-ref="#contentDetails_24h"]').removeClass('disabled');
                dom.timer($('[data-ref="#contentDetails_36h"] #timeStep'), $('[data-ref="#contentDetails_36h"] .progress-step'), fn, obj);
                $('[data-ref="#contentDetails_36h"]').addClass('active').removeClass('disabled');
                $('#contentDetails_36h').removeClass('hidden');
                break;
        }
    },
    listGroups: function (groups, group) {
        var cmb = $('#cmbGruposTracking');
        if (!Array.isArray(groups)) {
            cmb.html('<option value="">No hay grupos</option>');
            return;
        }
        cmb.html('');
        for (var i = 0; i < groups.length; i++) {
            var text = ((groups[i].date_start) ? dom.formatDate(groups[i].date_start, "month") : "Indefinido");
            text += " - " + ((groups[i].date_end) ? dom.formatDate(groups[i].date_end, "month") : "Indefinido");
            cmb.append(new Option(text, groups[i].group));
        }
        cmb.val(group).trigger('change.select2');
    },
    listDetails: function (details) {
        //List 12h...
        var content = $('#contentDetails_12h');
        content.html('');
        var model = $('#modelWiget');
        var clone = model.clone().removeClass('hidden').removeAttr('id');
        for (var i = 0, dat; dat = details["12h"][i], i < details["12h"].length; i++) {
            clone.find('#d_start').html(dom.formatDate(dat.d_start12h, 'month'));
            clone.find('#d_end').html(dom.formatDate(dat.d_fin12h, 'month'));
            clone.find('#n_comentario').html(dat.n_comentario, 'month');
            //Listamos los usuarios...
            var ctx = clone.find('.users');
            var item = ctx.find('.item-wiget').clone();
            ctx.html('');
            if (Array.isArray(dat.k_id_follow_up_12h)) {
                for (var j = 0, dt; dt = dat.k_id_follow_up_12h[j], j < dat.k_id_follow_up_12h.length; j++) {
                    var cln = item.clone();
                    cln.find('.title').html(dt.n_last_name_user + ' (' + dt.n_username_user + ')');
                    ctx.append(cln);
                }
            }
            content.append(clone);
        }
        //List 24h...
        var content = $('#contentDetails_24h');
        content.html('');
        var model = $('#modelWiget');
        var clone = model.clone().removeClass('hidden').removeAttr('id');
        for (var i = 0, dat; dat = details["24h"][i], i < details["24h"].length; i++) {
            clone.find('#d_start').html(dom.formatDate(dat.d_start24h, 'month'));
            clone.find('#d_end').html(dom.formatDate(dat.d_fin24h, 'month'));
            clone.find('#n_comentario').html(dat.n_comentario, 'month');
            //Listamos los usuarios...
            var ctx = clone.find('.users');
            var item = ctx.find('.item-wiget').clone();
            ctx.html('');
            if (Array.isArray(dat.k_id_follow_up_24h)) {
                for (var j = 0, dt; dt = dat.k_id_follow_up_24h[j], j < dat.k_id_follow_up_24h.length; j++) {
                    var cln = item.clone();
                    cln.find('.title').html(dt.n_last_name_user + ' (' + dt.n_username_user + ')');
                    ctx.append(cln);
                }
            }
            content.append(clone);
        }
        //List 36h
        var content = $('#contentDetails_36h');
        content.html('');
        var model = $('#modelWiget');
        var clone = model.clone().removeClass('hidden').removeAttr('id');
        for (var i = 0, dat; dat = details["36h"][i], i < details["36h"].length; i++) {
            clone.find('#d_start').html(dom.formatDate(dat.d_start36h, 'month'));
            clone.find('#d_end').html(dom.formatDate(dat.d_fin36h, 'month'));
            clone.find('#n_comentario').html(dat.n_comentario, 'month');
            //Listamos los usuarios...
            var ctx = clone.find('.users');
            var item = ctx.find('.item-wiget').clone();
            ctx.html('');
            if (Array.isArray(dat.k_id_follow_up_36h)) {
                for (var j = 0, dt; dt = dat.k_id_follow_up_36h[j], j < dat.k_id_follow_up_36h.length; j++) {
                    var cln = item.clone();
                    cln.find('.title').html(dt.n_last_name_user + ' (' + dt.n_username_user + ')');
                    ctx.append(cln);
                }
            }
            content.append(clone);
        }
    },
    getStatesProduction: function () {
        var cmb = $('#cmbEstadosProcesos');
        app.post('');
    }
};

$(function () {
    TD.init();
})
