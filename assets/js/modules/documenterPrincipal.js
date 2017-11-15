var TD = {
    exec: false,
    init: function () {
        TD.events();
        TD.configView();
//        TD.getDetail();
//        TD.fillTable([]);
        TD.getInfoForms();
        TD.getDetails();
    },
    events: function () {
        $('#btnDetails').on('click', TD.onClickDetails);
        $('.hour-step').on('click', TD.onClickHourStep);
    },
    onClickHourStep: function () {
        $hourStep = $(this);
        $('.row.wiget').addClass('hidden');
        $($hourStep.attr('data-ref')).removeClass('hidden');
        $('.hour-step').removeClass('active');
        $hourStep.addClass('active');
    },
    configView: function () {
        dom.configCalendar($('#txtCorrecionPendientes'));
        dom.configCalendar($('#txtFechaApertura'));
        dom.configCalendar($('#txtDesbloqueo'));
        dom.configCalendar($('#txtBloqueado'));
//        dom.notify.vencimiento();
//        dom.notify("NUEVOS TICKETS!!", "Tienes nuevos tickes para asignar", "info");
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
    getInfoForms: function () {
        var alert = dom.printAlert('Consultando detalles, por favor espere...', 'loading', $('#principalAlert'));
        //Consultamos...
        app.post('TicketOnair/getAllService', {id: app.getParamURL('id')})
                .success(function (response) {
                    console.log(response);
                    if (response.code > 0) {
                        $('#trackingDetails').removeClass('hidden');
                        alert.hide();
                        $('#formDetallesBasicos').fillForm(response.data);
                    } else {
                        alert.print("No se encontró ninguna coincidencia", "warning");
                    }
                }).error(function (error) {
            alert.print("Se ha producido un error desconocido, compruebe su conexión a internet y vuelva a intentarlo.", "danger");
            console.error(error);
        }).send();
    },
    fillNA: function () {
        return "Indefinido";
    },
    fillTable: function (data) {
        if (TD.tablaTD) {
            dom.refreshTable(TD.tablaTD, data);
            return;
        }
        TD.tablaTD = $('#tblTrackingDetails').DataTable(dom.configTable(data,
                [
                    {title: "Columna 1", data: TD.fillNA()},
                    {title: "Columna 2", data: TD.fillNA()},
                    {title: "Columna 3", data: TD.fillNA()},
                    {title: "Columna 4", data: TD.fillNA()},
                    {title: "Columna 5", data: TD.fillNA()},
                ]));
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
                dom.timer($('[data-ref="#contentDetails_36h"] #timeStep'), $('data-ref="#contentDetails_36h"] .progress-step'), fn, obj);
                $('[data-ref="#contentDetails_36h"]').addClass('active').removeClass('disabled');
                $('#contentDetails_36h').removeClass('hidden');
                break;
        }
    },
}

$(function () {
    TD.init();
})
