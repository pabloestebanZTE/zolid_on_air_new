var TD = {
    contentFases: $('#contentFases'),
    exec: false,
    init: function () {
        TD.events();
        TD.configView();
        TD.getDetail();
        TD.listCombox();
        TD.getDetails();
        TD.getStatesProduction();
        dom.submit($('#formDetallesBasicos'), null, false);
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
        TD.resizeWigets();
        $hourStep = $(this);
        $('.row.content-wiget').addClass('hidden');
        $($hourStep.attr('data-ref')).removeClass('hidden').hide().fadeIn(500);
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
            case "PROD":
                TD.toProduction();
                break;
            case "STANDBY":
                TD.toStandBy();
                break;
            case "QUITSTANDBY":
                TD.quitStandBy();
                break;
        }
    },
    quitStandBy: function () {
        app.post("TicketOnair/quitStandBy", {
            'idTicket': $('#idProceso').val(),
            'comment': $('#txtObservations').val(),
        }).success(function (response) {
            if (response.code > 0) {
                swal({
                    title: "Actualizado",
                    text: "Se ha acutalizado el proceso correctamente.",
                    type: "success",
                    button: "Aceptar"
                }).then(function () {
                    location.reload();
                });
            } else {
                swal("Error", response.message, "error");
            }
        }).error(function () {
            swal("Error", "Se ha producido un error inesperado.", "error");
        }).send();
    },
    toStandBy: function () {
        app.post("TicketOnair/toStandBy", {
            'idTicket': $('#idProceso').val(),
            'comment': $('#txtObservations').val(),
        })
                .success(function (response) {
                    if (response.code > 0) {
                        swal({
                            title: "Actualizado",
                            text: "Se ha acutalizado el proceso correctamente.",
                            type: "success",
                            button: "Aceptar"
                        }).then(function () {
                            location.reload();
                        });
                    } else {
                        swal("Error", response.message, "success");
                    }
                }).error(function () {
            swal("Error", "Se ha producido un error inesperado.", "error");
        }).send();
    },
    toProduction: function () {
        var cmbProduccion = $('#cmbEstadosProcesos');
        //Validamos...
        if (cmbProduccion.val().trim() === "" || cmbProduccion.val() == -1) {
            swal("Error", "Seleccione un subestado para pasar el proceso a producción.", "error");
            return;
        }
        var joinText = "";
        var joinItems = $('#productionList').find('input:checked');
        for (var i = 0; i < joinItems.length; i++) {
            joinText += $(joinItems[i]).next('label').text() + ((i < (joinItems.length - 1)) ? ", " : "");
        }
        var obj = {
            idProceso: $('#idProceso').val(),
            idStatus: cmbProduccion.val(),
            comment: joinText + "-----\n" + $('#modalChangeState #txtObservations').val()
        };
        app.post('TicketOnair/toProduction', obj)
                .success(function (response) {
                    console.log(response);
                    if (response.code > 0) {
                        swal({
                            title: "Actualizado",
                            text: "Se ha acutalizado el proceso correctamente.",
                            type: "success",
                            button: "Aceptar"
                        }).then(function () {
                            location.reload();
                        });
                    } else {
                        swal("Información", response.message, "warning");
                    }
                })
                .error(function (e) {
                    console.error(e);
                    swal("Error", "Se ha producio un error desconocido, por favor compruebe su conexión a internet y vuelva a intentarlo.", "error");
                })
                .send();
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
            link.removeClass('active');
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
        $('#modalChangeState #txtObservations').val("");
        $('#cmbSiguienteFase').val(hr + "h").trigger('change.select2');
        $('#modalChangeState .content-state').hide();
        $('#modalChangeState a.active').removeClass('active');
        if (parent.hasClass('prorroga')) {
            $('#modalChangeState .states-modal a:eq(0)').addClass('disabled');
        } else if (parent.hasClass('escalado')) {
            $('#modalChangeState .states-modal a:eq(0)').addClass('disabled');
            $('#modalChangeState .states-modal a:eq(1)').addClass('disabled');
            $('#modalChangeState .states-modal a:eq(2)').addClass('disabled');
        } else if (parent.hasClass('produccion')) {
            $('#modalChangeState .states-modal a:eq(0)').addClass('disabled');
            $('#modalChangeState .states-modal a:eq(1)').addClass('disabled');
            $('#modalChangeState .states-modal a:eq(2)').addClass('disabled');
        } else if (parent.hasClass('standby')) {
            $('#modalChangeState .states-modal a:eq(0)').addClass('disabled');
            $('#modalChangeState .states-modal a:eq(1)').addClass('disabled');
            $('#modalChangeState .states-modal a:eq(2)').addClass('disabled');
            var item = $('#modalChangeState .states-modal a:eq(3)').removeClass('disabled');
            item.html('<span class="icon-state theme2"><i class="fa fa-fw fa-play-circle"></i></span> Detener Stand By');
            item.attr('data-action', 'QUITSTANDBY');
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
//        dom.configCalendar($('#txtFechaIngresoOnAir'));
//        dom.configCalendar($('#txtCorrecionPendientes'));
//        dom.configCalendar($('#txtFechaApertura'));
//        dom.configCalendar($('#txtFechaRFT'));
//        dom.configCalendar($('#txtFechaCG'));
//        dom.configCalendar($('#txtFechaBloqueado'));
//        dom.configCalendar($('#txtFechaDesBloqueado'));
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
                        $('#n_enteejecutor').trigger('change.select2');
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
        $('.hour-step .progress-step').css('width', '100%');
        $('.timerstamp').html('<i class="fa fa-fw fa-info-circle"></i> No definido');
        var fn = function () {
            if (TD.exec) {
                return true;
            }
            TD.getDetails();
            TD.exec = true;
        };
        $('.hour-step').removeClass('active').addClass('disabled');
        $('.row.content-wiget').addClass('hidden');
        $('.hour-step').removeClass('active');

        switch (obj.actual_status) {
            case "12h":
                $('[data-ref="#contentDetails_12h_content"]').addClass('active').removeClass('disabled');
                dom.timer($('[data-ref="#contentDetails_12h_content"] #timeStep'), $('[data-ref="#contentDetails_12h_content"] .progress-step'), fn, obj);
                $('#contentDetails_12h_content').removeClass('hidden').hide().fadeIn(500);
                break;
            case "24h":
                $('[data-ref="#contentDetails_12h_content"]').removeClass('disabled').addClass('finish').find('#timeStep').html('<i class="fa fa-fw fa-flag-checkered"></i> Finalizado');
                $('[data-ref="#contentDetails_24h_content"]').addClass('active').removeClass('disabled');
                dom.timer($('[data-ref="#contentDetails_24h_content"] #timeStep'), $('[data-ref="#contentDetails_24h_content"] .progress-step'), fn, obj);
                $('#contentDetails_24h_content').removeClass('hidden');
                break;
            case "36h":
                $('[data-ref="#contentDetails_12h_content"]').removeClass('disabled').addClass('finish').find('#timeStep').html('<i class="fa fa-fw fa-flag-checkered"></i> Finalizado');
                $('[data-ref="#contentDetails_24h_content"]').removeClass('disabled').addClass('finish').find('#timeStep').html('<i class="fa fa-fw fa-flag-checkered"></i> Finalizado');
                dom.timer($('[data-ref="#contentDetails_36h_content"] #timeStep'), $('[data-ref="#contentDetails_36h_content"] .progress-step'), fn, obj);
                $('[data-ref="#contentDetails_36h_content"]').addClass('active').removeClass('disabled');
                $('#contentDetails_36h_content_content').removeClass('hidden');
                break;
            case "32": //Substatus => Standby...
                $('[data-ref="#contentDetails_12h_content"]').addClass('active').removeClass('disabled');
                $('.timerstamp').html('<i class="fa fa-fw fa-stop-circle"></i> Stand By');
                $('.progress-step').css('width', 100 + '%');
                $('#contentDetails_12h_content').removeClass('hidden');
                $('.hour-step').removeClass('disabled').addClass('standby');
                break;
            case "18":
                $('[data-ref="#contentDetails_12h_content"]').addClass('active').removeClass('disabled');
                $('.timerstamp').html('<i class="fa fa-fw fa-check"></i> En Precheck');
                $('.progress-step').css('width', 100 + '%');
                $('#contentDetails_12h_content').removeClass('hidden');
                $('.hour-step').removeClass('disabled').addClass('produccion');
                break;
            case "19":
                $('[data-ref="#contentDetails_12h_content"]').addClass('active').removeClass('disabled');
                $('.timerstamp').html('<i class="fa fa-fw fa-undo"></i> Reinicio 12H');
                $('.progress-step').css('width', 100 + '%');
                $('.hour-step').removeClass('disabled').addClass('produccion');
                $('#contentDetails_12h_content').removeClass('hidden');
                $('#alertReinicio12h').removeClass('hidden');
                TD.contentFases.addClass('hidden').hide();
                $('#btnRunActividad').on('click', function () {
                    dom.confirmar("Se iniciará la actividad, ¿Está seguro de continuar con esta operación?", function () {
                        app.post('TicketOnair/restart12h', {
                            idTicket: $('#idProceso').val()
                        }).success(function (response) {
                            if (response.code > 0) {
                                swal({
                                    title: "Iniciado",
                                    type: "success",
                                    text: "Se ha iniciado el proceso correctamente.",
                                    button: "Aceptar"
                                }).then(function () {
                                    location.reload();
                                });
                            } else {
                                swal("Error", response.message);
                            }
                        }).error(function (e) {
                            swal("Error", "Se ha producido un error inesperado.", "error");
                        }).send();
                    }, function () {
                        swal("Cancelado", "Se ha cancelado la operación", "error");
                    });
                });
                break
            case "20":
                $('[data-ref="#contentDetails_12h_content"]').addClass('active').removeClass('disabled');
                $('.timerstamp').html('<i class="fa fa-fw fa-undo"></i> Reinicio Precheck');
                $('.progress-step').css('width', 100 + '%');
                $('#contentDetails_12h_content').removeClass('hidden');
                $('.hour-step').removeClass('disabled').addClass('produccion');
                break
            default :
                $('[data-ref="#contentDetails_12h_content"]').addClass('active').removeClass('disabled');
                $('.timerstamp').html('<i class="fa fa-fw fa-play-circle"></i> En producción');
                $('.progress-step').css('width', 100 + '%');
                $('#contentDetails_12h_content').removeClass('hidden');
                $('.hour-step').removeClass('disabled').addClass('produccion');
                break;
        }
        $('.hour-step.disabled .progress-step').css('width', '0%');
        TD.resizeWigets();
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
        var users = $('#contentDetails_12h_users');
        content.html('');
        var model = $('#modelWiget');
        var modelUser = $('#wigetUser');
        for (var i = 0, dat; dat = details["12h"][i], i < details["12h"].length; i++) {
//            Listamos los usuarios...
            var ctx = users.find('.users');
            var item = modelUser;
            ctx.html('');
            if (Array.isArray(dat.k_id_follow_up_12h)) {
                for (var j = 0, dt; dt = dat.k_id_follow_up_12h[j], j < dat.k_id_follow_up_12h.length; j++) {
                    var cln = item.clone().removeClass('hidden').removeAttr('id');
                    cln.find('.title').html(dt.n_last_name_user + ' (' + dt.n_username_user + ')');
                    ctx.append(cln);
                }
            }

            //Listamos los comentarios...
            //- Primero detectamos si hay un JSON de comentarios...
            if (dat.n_comentario) {
                var cmns = JSON.parse(dat.n_comentario);
                for (var k = (cmns.length - 1); k >= 0; k--) {
                    var clone = model.clone().removeClass('hidden').removeAttr('id');
                    clone.find('#d_start').html(dom.formatDate(cmns[k].date, 'month'));
                    clone.find('#n_comentario').html(cmns[k].comment);
                    content.append(clone);
                }
            }
        }
        //List 24h...
        var content = $('#contentDetails_24h');
        content.html('');
        var model = $('#modelWiget');
        var users = $('#contentDetails_24h_users');
        var clone = model.clone().removeClass('hidden').removeAttr('id');
        for (var i = 0, dat; dat = details["24h"][i], i < details["24h"].length; i++) {
            //Listamos los usuarios...
            var ctx = users.find('.users');
            var item = modelUser;
            ctx.html('');
            if (Array.isArray(dat.k_id_follow_up_24h)) {
                for (var j = 0, dt; dt = dat.k_id_follow_up_24h[j], j < dat.k_id_follow_up_24h.length; j++) {
                    var cln = item.clone().removeClass('hidden').removeAttr('id');
                    cln.find('.title').html(dt.n_last_name_user + ' (' + dt.n_username_user + ')');
                    ctx.append(cln);
                }
            }

            //Listamos los comentarios...
            //- Primero detectamos si hay un JSON de comentarios...
            if (dat.n_comentario) {
                var cmns = JSON.parse(dat.n_comentario);
                for (var k = (cmns.length - 1); k >= 0; k--) {
                    var clone = model.clone().removeClass('hidden').removeAttr('id');
                    clone.find('#d_start').html(dom.formatDate(cmns[k].date, 'month'));
                    clone.find('#n_comentario').html(cmns[k].comment);
                    content.append(clone);
                }
            }
        }
        //List 36h
        var content = $('#contentDetails_36h');
        content.html('');
        var model = $('#modelWiget');
        var users = $('#contentDetails_36h_users');
        var clone = model.clone().removeClass('hidden').removeAttr('id');
        for (var i = 0, dat; dat = details["36h"][i], i < details["36h"].length; i++) {
            //Listamos los usuarios...
            var ctx = users.find('.users');
            var item = modelUser;
            ctx.html('');
            if (Array.isArray(dat.k_id_follow_up_36h)) {
                for (var j = 0, dt; dt = dat.k_id_follow_up_36h[j], j < dat.k_id_follow_up_36h.length; j++) {
                    var cln = item.clone().removeClass('hidden').removeAttr('id');
                    cln.find('.title').html(dt.n_last_name_user + ' (' + dt.n_username_user + ')');
                    ctx.append(cln);
                }
            }

            //Listamos los comentarios...
            //- Primero detectamos si hay un JSON de comentarios...
            if (dat.n_comentario) {
                var cmns = JSON.parse(dat.n_comentario);
                for (var k = (cmns.length - 1); k >= 0; k--) {
                    var clone = model.clone().removeClass('hidden').removeAttr('id');
                    clone.find('#d_start').html(dom.formatDate(cmns[k].date, 'month'));
                    clone.find('#n_comentario').html(cmns[k].comment);
                    content.append(clone);
                }
            }
        }

        //Configuramos las alturas de las secciones...
        TD.resizeWigets();
    },
    resizeWigets: function () {
        window.setTimeout(function () {
            var cw = $('.content-wiget');
            for (var i = 0, w; w = $(cw[i]), i < cw.length; i++) {
                var ws = w.find('.wiget');
                if (ws.length == 2) {
                    var hEsMayor = $(ws[0])[0].offsetHeight > $(ws[1])[0].offsetHeight;
                    if (hEsMayor) {
                        $(ws[1]).css('min-height', $(ws[0])[0].offsetHeight + 'px');
                    } else {
                        $(ws[0]).css('min-height', $(ws[1])[0].offsetHeight + 'px');
                    }
                }
            }
        }, 1000);
    },
    getStatesProduction: function () {
//        var cmb = $('#cmbEstadosProcesos');
//        app.post('TicketOnair/getStatesProduction')
//                .success(function (response) {
//                    console.log(response);
//                    var datos = app.parseResponse(response);
//                    if (datos) {
//                        dom.llenarCombo(cmb, datos, {text: "n_name_substatus", value: "k_id_status_onair"});
//                    }
//                }).error(function (e) {
//            dom.comboVacio(cmb);
//        }).send();
    }
};

$(function () {
    TD.init();
})
