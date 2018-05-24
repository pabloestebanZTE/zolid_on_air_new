var TD = {
    exec: false,
    init: function () {
        TD.events();
        TD.configView();
//        TD.getDetail();
//        TD.fillTable([]);
        TD.getInfoForms();
        TD.getDetails();
        TD.getDetail();
    },
    events: function () {
        $('#btnDetails').on('click', TD.onClickDetails);
        $('.hour-step').on('click', TD.onClickHourStep);
        $('.comment-step').on('click', TD.onClickCommentStep);
    },
    onClickCommentStep: function () {
        $('.row.content-wiget').addClass('hidden');
        $('.hour-step').removeClass('active');
        $(this).addClass('active');
        $('#contentComments').removeClass('hidden');
        TD.getComments();
    },    
    getComments: function () {
        var idTicket = $('#idProceso').val();
        var content = $('#contentComments .wiget');
        var alert = dom.printAlert('Consultando...', 'loading', $('#alertComments'));
        app.post('TicketOnair/getCommentsTicket', {
            idTicket: idTicket
        }).success(function (response) {
            var data = app.parseResponse(response);
            if (data && data.length > 0) {
                content.show();
                content.html('');
                for (var i = 0; i < data.length; i++) {
                    var dat = data[i];
                    alert.hide();
                    var comment = '<div class="form-group row wiget-comment">'
                            + '<div class="col-md-3 wiget-list">'
                            + '<div class="item-wiget">'
                            + '<div class="icon-wiget"><i class="fa fa-fw fa-calendar"></i></div>'
                            + '<div class="details-wiget">'
                            + '<span class="title display-block">Fecha: </span>'
                            + '<span class="text display-block" id="d_start">{hora_actualizacion_resucomen}</span>'
                            + '</div>'
                            + '</div>'
                            + '</div>'
                            + '<div class="col-md-5">'
                            + '<p class="text-left m-all-0 p-all-0"><b class="display-block m-b-5"><i class="fa fa-fw fa-comment"></i> Comentario:</b><span id="n_comentario">{comentario_resucoment}</span></p>'
                            + '</div>'
                            + '<div class="wiget-list p-l-25 users"><div class="item-wiget">'
                            + '<div class="icon-wiget"><i class="fa fa-fw fa-user"></i></div>'
                            + '<div class="details-wiget">'
                            + '<span class="title display-block">{usuario_resucomen}</span>'
                            + ' </div>'
                            + '</div></div>'
                            + '</div>';
                    content.append(dom.fillString(comment, dat));
                }
            } else {
                alert.print("No se encontraron comentarios.", "warning");
                content.hide();
            }
        }).error(function (e) {
            alert.print("Se ha producido un error inesperado.", "danger");
            content.hide();
        }).send();
    },
    onClickHourStep: function () {
        $hourStep = $(this);
        $('.row.wiget').addClass('hidden');
        $('.row.content-wiget').addClass('hidden');
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
    /**
     * Básicamente llenará los formuarios de los dos paneles principales del acordión.
     * @returns {undefined}
     */
    getDetail: function () {
        var alert = dom.printAlert('Consultando detalles, por favor espere...', 'loading', $('#principalAlert'));
        //Consultamos...
        app.post('TicketOnair/getAllService', {id: app.getParamURL('id')})
                .success(function (response) {
                    if (response.code > 0) {
                        $('#trackingDetails').removeClass('hidden');
                        var form = $('#formDetallesBasicos');
                        form.fillForm(response.data);
                        console.log("OBJETO: ", response.data);
                        $('#cmbTecnologia').trigger('change');
                        $('#cmbBanda').on('selectfilled', function () {
                            $(this).val(response.data.k_id_band.k_id_band).trigger('change.select2');
                        });
                        $('#n_enteejecutor').trigger('change.select2');
                        var objTemp = {ticket_on_air: response.data};
                        var form = $('#formTrackingDetails');
                        form.fillForm(objTemp);
                        try {
                            if (response.data.n_json_sectores) {
                                vista.fillTableSectores(response.data);
                            }
                        } catch (e) {
                        }
                        objTemp = {preparation_stage: response.data.k_id_preparation};
                        form.fillForm(objTemp);
                        form.find('#cmbEstadosTD').attr("data-value", response.data.k_id_status_onair.k_id_status.k_id_status);
                        form.find('#cmbSubEstadosTD').attr("data-value", response.data.k_id_status_onair.k_id_status_onair);
                        form.find('.select-fill').trigger('select2fill');
                        form.find('select').trigger('change.select2');
                        $('#cmbSubEstadosTD').on('filledStatic', function () {
                            $(this).val($(this).attr('data-value')).trigger('change.select2');
                        });


                        rg.getTickets(response.data.k_id_station.k_id_station);
                        rg.getRelatedTickets(response.data.k_id_onair);

                        var stateVMm = (response.data.k_id_preparation.b_vistamm) ? ((response.data.k_id_preparation.b_vistamm.toUpperCase() == "TRUE") ? true : false) : false;
                        $('[name="preparation_stage.b_vistamm"]').prop('checked', stateVMm);
                        var priority = (response.data.i_priority == 1) ? true : false;
                        $('[name="ticket_on_air.i_priority"]').prop('checked', priority);
//                        vista.listCombox();
                    } else {
                        alert.print("No se encontró ninguna coincidencia", "warning");
                    }
                })
                .complete(function () {
                    alert.hide();
                })
                .error(function (error) {
                    alert.print("Se ha producido un error desconocido, compruebe su conexión a internet y vuelva a intentarlo.", "danger");
                    console.error(error);
                }).send();
    },
    getDetails: function () {
        dom.printAlert('Consultando, por favor espere...', 'loading', $('#alertFases'));
        app.post('TicketOnair/getProcessTicket', {id: app.getParamURL("id")})
                .success(function (response) {
//                    dom.alertControl(response, $('#alertFases'), true);
                    $('#alertFases').hide();
                    if (response.code > 0) {
                        $('#contentFases').removeClass('hidden').hide().fadeIn(500);
                        //Listamos los grupos...
                        if (!TD.exec) {
                            TD.listGroups(response.data.groups, response.data.group);
                            TD.listDetails(response.data.details);
                        }
                        TD.setTimers(response.data);
                    } else {
                        $('#contentFases').removeClass('hidden').hide().fadeIn(500);
                        $('#contentFases .hour-step').addClass('hidden');
                        $('.comment-step').trigger('click');
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
                        rg.getTickets(response.data.k_id_station.k_id_station);
                        rg.getRelatedTickets(response.data.k_id_onair);
                    } else {
                        alert.print("No se encontró ninguna coincidencia", "warning");
                    }
                }).error(function (error) {
            alert.print("Se ha producido un error desconocido, compruebe su conexión a internet y vuelva a intentarlo.", "danger");
            console.error(error);
        }).send();
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
            case "escalado":
                $('[data-ref="#contentDetails_12h_content"]').addClass('active').removeClass('disabled');
                $('.timerstamp').html('<i class="fa fa-fw fa-undo"></i> Escalado');
                $('.progress-step').css('width', 100 + '%');
                $('#contentDetails_12h_content').removeClass('hidden');
                $('.hour-step').removeClass('disabled').addClass('escalado');
                break;
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
}

$(function () {
    TD.init();
})
