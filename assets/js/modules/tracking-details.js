var vista = {
    contentFases: $('#contentFases'),
    exec: false,
    init: function () {
        vista.events();
        vista.configView();
        vista.listCombox();
        vista.getDetails();
        vista.getStatesProduction();
        dom.submit($('#formDetallesBasicos'), null, false);
        $('#formTrackingDetails').on('submit', function (e) {
            app.stopEvent(e);
            $('#formTrackingDetails').find('#typeBlock_Dinamic').remove();
            $('#formTrackingDetails').append('<input type="hidden" id="typeBlock_Dinamic" name="typeBlock" value="' + $('#cmbEstadoSectores').val() + '" />');
            vista.configSectores();
            dom.submitDirect($('#formTrackingDetails'), null, false);
        });
    },
    onClickPushSector: function () {
        var btn = $(this);
        var tr = btn.parents('tr');
        var table = $('#tblSectores');
        if (tr.find('input').val().trim() == "") {
            return;
        }
        table.find('tr.no-found').remove();
        var dat = {
            id: tr.find('input').val(),
            name: tr.find('input').val(),
            state: 1,
        };
        tr.remove();
        table.append(dom.fillString('<tr data-id="{id}" data-name="{name}"><td>{name}</td><td colspan="2"><div class="checkbox checkbox-primary" style=""><input ' + ((dat.state == 1 || dat.state == 0) ? 'checked="true"' : '') + ' id="checkbox_block_{id}" type="checkbox" name="check_{id}" value="1" ><label for="checkbox_block_{id}" class="text-bold">Seleccionar</label> <button class="close btn-remove-sector-added m-r-15" title="Eliminar sector">&times</button></div></td></tr>', dat));
    },
    onClickDeleteSector: function () {
        var btn = $(this);
        var tr = btn.parents('tr');
        tr.remove();
    },
    events: function () {
        $('#tblSectores').on('click', '.push-sector-btn', vista.onClickPushSector);
        $('#tblSectores').on('click', '.delete-sector-btn', vista.onClickRemoveSector);
        $('#tblSectores').on('click', '.btn-remove-sector-added', vista.onClickRemoveSector);
        $('#btnDetails').on('click', vista.onClickDetails);
        $('.hour-step .icon-step').on('click', vista.onClickIconStep);
        $('.hour-step').on('click', vista.onClickHourStep);
        $('.states-modal li a').on('click', vista.onClickItemState);
        $('.btn-add-sector').on('click', vista.addSector);
        $('.select-fill').on('select2fill', function () {
            var cmb = $(this);
            cmb.val(cmb.attr('data-value'));
            cmb.trigger('change.select2');
        });
        $('#btnAceptarModal').on('click', vista.onClickAceptarModal);
        $('#btnEditarSectores').on('click', vista.onClickEditarSectores);
        $('#btnAceptarModalSectores').on('click', vista.onClickAceptarModalSectores);
        $('.comment-step').on('click', vista.onClickCommentStep);
        $('#tblSectores').on('change', 'input:checkbox', vista.onClickCheckTblSectores);
        $('#cmbEstadoSectores').on('change', function () {
            $('#txtEstadoSectores').val($(this).val());
        });
        $('.btn-sectores').on('click', vista.onClickBtnSectores);

        $('#cmbTecnologia').on('change', vista.onChangeTecnologia);

        $('#cmbEstadosTD').on('change', vista.onChangeCmbEstados);
        $('#cmbSubEstadosTD').on('change', vista.onChangeState);
    },
    onClickRemoveSector: function () {
        var tr = $(this).parents('tr');
        tr.remove();
    },
    createSubstates: function () {
        vista.substates = {};
        for (var i = 0; i < vista.states.substates.length; i++) {
            vista.substates[vista.states.substates[i].k_id_substatus] = vista.states.substates[i];
        }
    },
    onChangeState: function () {
        $('#formTrackingDetails').append('<input type="hidden" name="ticket_on_air.statuschanged" value="true" />');
        $('#comment_change_stated').removeClass('hidden').slideDown(500);
    },
    onChangeCmbEstados: function (e) {
        var status = $("#cmbEstadosTD").val();
        var cmb = $('#cmbSubEstadosTD');
        if (e != false) {
            vista.onChangeState();
        }
        cmb.empty();
        if (!vista.substates) {
            vista.createSubstates();
        }
        var length = 0;
        for (var j = 0; j < vista.states.statusOnAir.length; j++) {
            if (status == vista.states.statusOnAir[j].k_id_status) {
                var subStatus = vista.substates[vista.states.statusOnAir[j].k_id_substatus];
                cmb.append($('<option>', {
                    value: vista.states.statusOnAir[j].k_id_status_onair,
                    text: subStatus.n_name_substatus
                }));
                length++;
            }
            if (status == 9) {
                cmb.val(97);
            }
        }
        console.log("LENGTH:", length);
        if (length == 0) {
            dom.comboVacio(cmb);
        } else {
            cmb.find('option:eq(0)').prop('selected', true);
        }
        cmb.trigger('change.select2');
    },
    onChangeTecnologia: function () {
        app.get('Utils/bandsByTech', {
            id_technology: $('#cmbTecnologia').val()
        })
                .success(function (response) {
                    var data = app.parseResponse(response);
                    if (data) {
                        dom.llenarCombo($('#cmbBanda'), data, {text: "n_name_band", value: "k_id_band"});
                    }
                    dom.comboVacio($('#cmbBanda'));
                })
                .error(function () {
                    dom.comboVacio($('#cmbBanda'));
                })
                .send();
    },
    onClickCheckTblSectores: function () {
        var chk = $(this);
        if (chk.hasClass('checkbox-head')) {
            $('#tblSectores input:checkbox').prop('checked', chk.is(':checked'));
            return;
        }
        if ($('#tblSectores td input:checked').length == 0 || chk.is(':checked')) {
            $('#tblSectores input.checkbox-head').prop('checked', chk.is(':checked'));
        }
    },
    onClickBtnSectores: function () {
        var btn = $(this);
        if (btn.hasClass('view')) {
            $('#txtBandaModal').val($('#cmbBanda option:selected').text());
            $('#txtTecnologiaModal').val($('#cmbTecnologia option:selected').text());
            $('#txtTipoTrabajoModal').val($('#cmbTipoTrabajo option:selected').text());
            $('#modalSectores').modal('show');
        } else if (btn.hasClass('lock')) {
            $('.btn-sectores.unlock').prop('disabled', false).show();
            $('#cmbEstadoSectores').val(1).trigger('change.select2');
            btn.prop('disabled', true).hide();
            $('#modalSectores').addClass('updated');
        } else if (btn.hasClass('unlock')) {
            $('.btn-sectores.lock').prop('disabled', false).show();
            btn.prop('disabled', true).hide();
            $('#cmbEstadoSectores').val(0).trigger('change.select2');
            $('#modalSectores').addClass('updated');
        }
        vista.configSectores();
    },
    onClickCommentStep: function () {
        $('.row.content-wiget').addClass('hidden');
        $('.hour-step').removeClass('active');
        $(this).addClass('active');
        $('#contentComments').removeClass('hidden');
        vista.getComments();
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
                            + '<p class="text-left m-all-0 p-all-0">' + '' + '<b class="display-block m-b-0"><i class="fa fa-fw fa-tag"></i> {n_estado_eb_resucomen}:</b><span id="n_comentario" class="m-l-20">{comentario_resucoment}</span></p>'
                            + '</div>'
                            + '<div class="wiget-list p-l-25 users"><div class="item-wiget">'
                            + '<div class="icon-wiget"><i class="fa fa-fw fa-user"></i></div>'
                            + '<div class="details-wiget">'
                            + '<span class="title display-block">{usuario_resucomen}</span>'
                            + ' </div>'
                            + '</div></div>'
                            + '</div>';
                    content.append(dom.fillString(comment, dat));
//                    '<h2 class="h5 m-t-0"><span class="text-muted text-normal"><i class="fa fa-fw fa-tag"></i> {n_estado_eb_resucomen}</span></h2>'
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
    onClickAceptarModalSectores: function () {
        vista.configSectores();
        if ($('#modalSectores').attr('data-action') === "REINICIO_12H") {
            vista.restart12h();
        }
        $('#modalSectores').modal('hide');
        $('#modalSectores').addClass('updated');
    },
    configSectores: function () {
        var cmbSectores = $('#cmbEstadoSectores');
        if (cmbSectores.val().trim() == "") {
            if (!cmbSectores.parents('.input-group').next().hasClass('error')) {
                cmbSectores.parents('.input-group').after('<label class="error m-l-40 m-t-5 text-right center-block"><i class="fa fa-fw fa-warning"></i> Seleccione el estado para los sectores.</label>');
                $('#modalSectores').addClass('updated');
                $('#modalSectores').modal('show');
            }
            return;
        }
        var sectores = [];
        var sectoresBloqueados = "";
        var sectoresDesbloqueados = "";
        var estadoSectores = "";
        var sectoresSeleccionados = 0;
        var inputs = $('#tblSectores').find('input:checkbox').not('.checkbox-head');
        for (var i = 0; i < inputs.length; i++) {
            var input = $(inputs[i]);
            var tr = input.parents('tr');
            var temp = {
                id: tr.attr('data-id'),
                name: tr.attr('data-name'),
                state: ((input.is(':checked')) ? cmbSectores.val() : -1)
            };
            sectores.push(temp);
            if (temp.state == 1) {
                sectoresBloqueados += temp.name + ((i < (inputs.length - 1) ? ", " : ""));
            } else if (temp.state == 0) {
                sectoresDesbloqueados += temp.name + ((i < (inputs.length - 1) ? ", " : ""));
            }
            if (temp.state != -1) {
                sectoresSeleccionados++;
                estadoSectores = temp.state;
            }
        }
        $('#jsonSectores').val(JSON.stringify(sectores));
//        sectoresBloqueados = sectoresBloqueados.trim(",");
//        sectoresDesbloqueados = sectoresDesbloqueados.trim(",");

        $('#sectoresBloqueados').val(sectoresBloqueados);
        $('#sectoresDebloqueados').val(sectoresDesbloqueados);
        $('#btnEditarSectores').html('<i class="fa fa-fw fa-check-square-o"></i> (' + sectoresSeleccionados + ') Sectores selecionados');

        $('.length-sectores').html(sectoresSeleccionados);
        console.log("ESTADO SECTORES: ", estadoSectores);
        if (estadoSectores == 1) {
            $('.btn-sectores.lock').prop('disabled', true).hide();
            $('.btn-sectores.unlock').prop('disabled', false).show();
            $('.state-sectores').html(' Bloqueados');
        } else if (estadoSectores == 0) {
            $('.btn-sectores.unlock').prop('disabled', true).hide();
            $('.btn-sectores.lock').prop('disabled', false).show();
            $('.state-sectores').html(' Desbloqueados');
        }
        console.log("SECTORES: ", sectores);
//        $('#btnEditarSectores').html('<i class="fa fa-fw fa-check-square-o"></i> (' + selecteds + ') Sectores seleccionados');
        cmbSectores.parents('.input-group').next('.error').remove();
    },
    onClickEditarSectores: function () {
        $('#txtBandaModal').val($('#cmbBanda option:selected').text());
        $('#txtTecnologiaModal').val($('#cmbTecnologia option:selected').text());
        $('#txtTipoTrabajoModal').val($('#cmbTipoTrabajo option:selected').text());
        $('#modalSectores').modal('show');
    },
    addSector: function () {
        var table = $('#tblSectores tbody');
        var tr = $('<tr><td class="" colspan="3"><div style="width: 100%; display: table" class="input-group"><div class="input-group-addon">Sector:</div><input type="text" class="form-control" placeholder="Nombre del sector" /><div class="input-group-btn"><button type="button" class="btn btn-success push-sector-btn"><i class="fa fa-fw fa-save"></i></button><button type="button" class="btn btn-danger delete-sector-btn"><i class="fa fa-fw fa-trash"></i></button></div></div></td></tr>');
        table.find('.no-found').remove();
        table.prepend(tr);
        tr.find('input').focus();
    },
    fillTableSectores: function (data) {
        data = JSON.parse(data.n_json_sectores);
        if (data && data.length > 0) {
            $('#jsonSectores').val(data.n_json_sectores);
            $('#sectoresBloqueados').val(data.n_sectoresbloqueados);
            $('#sectoresDebloqueados').val(data.n_sectoresdesbloqueados);
            var estadoSectores = "";
            var table = $('#tblSectores tbody');
            table.html('');
            var selecteds = 0;
            //Llenamos la tabla sectores...
            for (var i = 0; i < data.length; i++) {
                var dat = data[i];
                if (dat.state != -1) {
                    selecteds++;
                    estadoSectores = dat.state;
                }
                table.append(dom.fillString('<tr data-id="{id}" data-name="{name}"><td>{name}</td><td colspan="2"><div class="checkbox checkbox-primary" style=""><input ' + ((dat.state == 1 || dat.state == 0) ? 'checked="true"' : '') + ' id="checkbox_block_{id}" type="checkbox" name="check_{id}" value="1" ><label for="checkbox_block_{id}" class="text-bold">Seleccionar</label></div></td></tr>', dat));
            }
            $('#cmbEstadoSectores').val(estadoSectores).trigger('change.select2');
            $('.length-sectores').html(selecteds);
            if (estadoSectores == 1) {
                $('.btn-sectores.lock').prop('disabled', true).hide();
                $('.state-sectores').html(' Bloqueados');
            } else if (estadoSectores == 0) {
                $('.btn-sectores.unlock').prop('disabled', true).hide();
                $('.state-sectores').html(' Desbloqueados');
            }
            $('#btnEditarSectores').html('<i class="fa fa-fw fa-check-square-o"></i> (' + selecteds + ') Sectores seleccionados');
        } else {
            $('#tblSectores tbody').html('<tr class="no-found"><td colspan="3"><i class="fa fa-fw fa-warning"></i> No hay sectores disponibles.</td></tr>');
            $('.btn-group').hide();
            $('#lblSectoresSeleccionados').hide().after('<label class="center-block"><i class="fa fa-fw fa-warning"></i> No aplica para sectores.</label>');
        }
        if ($('#tblSectores td input:checked').length > 0) {
            $('#tblSectores input.checkbox-head').prop('checked', true);
        }
    },
    onClickHourStep: function () {
        vista.resizeWigets();
        $hourStep = $(this);
        $('.row.content-wiget').addClass('hidden');
        $($hourStep.attr('data-ref')).removeClass('hidden').hide().fadeIn(500);
        $('.hour-step').removeClass('active');
        $('.comment-step').removeClass('active');
        $hourStep.addClass('active');
    },
    onClickAceptarModal: function () {
        var action = $('.states-modal a.active').attr('data-action');
        switch (action) {
            case "PROR":
                vista.createProrroga();
                break;
            case "NEXT":
                vista.nextFase();
                break;
            case "PROD":
                vista.toProduction();
                break;
            case "STANDBY":
                vista.toStandBy();
                break;
            case "QUITSTANDBY":
                vista.quitStandBy();
                break;
            default :
                swal("Error", "No ha seleccionado ninguna acción de la lista", "error").then(function () {
                    $('#modalChangeState').modal('show');
                });
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
                            location.href = app.urlTo("User/principal");
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
            comment: (joinText + "-----\n" + $('#modalChangeState #txtObservations').val()).trim()
        };
//        vista.appendSectores(obj);
        app.post('TicketOnair/toProduction', obj)
                .success(function (response) {
//                    console.log(response);
                    if (response.code > 0) {
                        swal({
                            title: "Actualizado",
                            text: "Se ha acutalizado el proceso correctamente.",
                            type: "success",
                            button: "Aceptar"
                        }).then(function () {
                            location.href = app.urlTo("User/principal");
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
    appendSectores: function (obj) {
        if ($('#modalSectores').hasClass('updated')) {
            vista.configSectores();
//            $('#btnAceptarModalSectores').trigger('click');
            obj.jsonSectores = $('#jsonSectores').val();
            obj.typeBlock = $('#cmbEstadoSectores').val();
            obj.sectoresBloqueados = $('#sectoresBloqueados').val();
            obj.sectoresDesbloqueados = $('#sectoresDebloqueados').val();
            obj.comentario_reinicio12h = $('#sectionComentarioSectores #txtComentarioStartPrecheck').val();
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
        vista.appendSectores(obj);
        app.post('TicketOnair/createProrroga', obj)
                .success(function (response) {
                    var v = app.validResponse(response);
                    if (v) {
                        swal({
                            title: "Guardado",
                            text: "Se ha registrado la prórroga éxitosamente.",
                            type: "success",
                            button: "Aceptar"
                        }).then(function () {
                            location.href = app.urlTo("User/principal");
                        });
                    } else {
                        swal("Atención", "No se pudo registrar la prórroga.", "warning");
                    }
                }).error(function (e) {
            swal("Error", "Se ha producido un error desconocido, compruebe su conexión y vuelva a intentarlo.", "error");
            console.log(e);
        }).send();
    },
    nextFase: function () {
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
        vista.appendSectores(obj);
        app.post('TicketOnair/nextFase', obj)
                .success(function (response) {
                    var v = app.validResponse(response);
                    if (v) {
                        swal({
                            title: "Guardado",
                            text: "Se ha terminado la fase correctamente.",
                            type: "success",
                            button: "Aceptar"
                        }).then(function () {
                            location.href = app.urlTo("User/principal");
                        });
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
        if (parent.hasClass('finish')) {
            return;
        }
        if (parent.hasClass('prorroga')) {
            $('#modalChangeState .states-modal a:eq(0)').addClass('disabled');
        } else if (parent.hasClass('escalado')) {
            $('#modalChangeState .states-modal a:eq(0)').addClass('disabled');
            $('#modalChangeState .states-modal a:eq(1)').addClass('disabled');
            $('#modalChangeState .states-modal a:eq(2)').addClass('disabled');
            $('#modalChangeState .states-modal a:eq(3)').addClass('disabled');
        } else if (parent.hasClass('produccion')) {
            $('#modalChangeState .states-modal a:eq(0)').addClass('disabled');
            $('#modalChangeState .states-modal a:eq(1)').addClass('disabled');
            $('#modalChangeState .states-modal a:eq(2)').addClass('disabled');
            $('#modalChangeState .states-modal a:eq(3)').addClass('disabled');
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
        vista.listStates();
    },
    listStates: function () {
        var cmbStatus = $('#cmbEstadosTD');
        var cmbSubStatus = $('#cmbSubEstadosTD');
        var cmbWorks = $('#cmbTipoTrabajo');
        var cmbTechnolgies = $('#cmbTecnologia');
        var cmbBands = $('#cmbBanda');
        app.post('TicketOnair/getAllStates').success(function (response) {
            if (response.code > 0) {
                vista.states = response.data;
                dom.llenarCombo(cmbStatus, response.data["states"], {text: 'n_name_status', value: 'k_id_status'});
                cmbStatus.on('selectfilled', function () {
//                    $('#cmbEstadosTD').val($('#cmbEstadosTD').attr('data-value')).trigger('change.select2');
                    window.setTimeout(function () {
                        vista.onChangeCmbEstados(false);
                        $('#cmbSubEstadosTD').trigger('filledStatic');
                    }, 500);
                });
//                dom.llenarCombo(cmbSubStatus, response.data["substates"], {text: 'n_name_substatus', value: 'k_id_substatus'});
                dom.llenarCombo(cmbTechnolgies, response.data["technologies"], {text: 'n_name_technology', value: 'k_id_technology'});
                dom.llenarCombo(cmbWorks, response.data["works"], {text: 'n_name_ork', value: 'k_id_work'});
//                dom.llenarCombo(cmbBands, response.data["bands"], {text: 'n_name_band', value: 'k_id_band'});
            } else {
                dom.comboVacio(cmbStatus);
                dom.comboVacio(cmbSubStatus);
                dom.comboVacio(cmbTechnolgies);
//                dom.comboVacio(cmbBands);
                dom.comboVacio(cmbWorks);
            }
            vista.getDetail();
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
                        alert.hide();
                        var form = $('#formDetallesBasicos');
                        form.fillForm(response.data);
                        $('#cmbTecnologia').trigger('change');
                        $('#cmbBanda').on('selectfilled', function () {
                            console.log("OKAY", response.data.k_id_band.k_id_band);
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
                        rg.getRelatedTickets(response.data.k_id_onair)

//                        vista.listCombox();
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
//                    dom.alertControl(response, $('#alertFases'), true);
                    $('#alertFases').hide();
                    if (response.code > 0) {
                        $('#contentFases').removeClass('hidden').hide().fadeIn(500);
                        //Listamos los grupos...
                        if (!vista.exec) {
                            vista.listGroups(response.data.groups, response.data.group);
                            vista.listDetails(response.data.details);
                        }
                        vista.setTimers(response.data);
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
    setTimers: function (obj) {
        $('.hour-step .progress-step').css('width', '100%');
        $('.timerstamp').html('<i class="fa fa-fw fa-info-circle"></i> No definido');
        var fn = function () {
            if (vista.exec) {
                return true;
            }
            vista.getDetails();
            vista.exec = true;
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
                vista.contentFases.addClass('hidden').hide();
                $('#btnRunActividad').on('click', function () {
                    dom.confirmar("Se iniciará la actividad, ¿Está seguro de continuar con esta operación?", function () {
                        $('#modalSectores').attr('data-action', 'REINICIO_12H').modal('show');
                        $('#sectionComentarioSectores').removeClass('hidden');
                        $('#txtBandaModal').val($('#cmbBanda option:selected').text());
                        $('#txtTecnologiaModal').val($('#cmbTecnologia option:selected').text());
                        $('#txtTipoTrabajoModal').val($('#cmbTipoTrabajo option:selected').text());
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
        vista.resizeWigets();

        //Se instancia la pestaña de comentarios como la principal...
        $('.row.content-wiget').addClass('hidden');
        $('.comment-step').addClass('active');
        $('#contentComments').removeClass('hidden');
        vista.getComments();
    },
    restart12h: function () {
        var obj = {
            idTicket: $('#idProceso').val(),
            comentario_reinicio12h: $('#txtComentarioStartPrecheck').val()
        };
        vista.appendSectores(obj);
        app.post('TicketOnair/restart12h', obj).success(function (response) {
            if (response.code > 0) {
                swal({
                    title: "Iniciado",
                    type: "success",
                    text: "Se ha iniciado el proceso correctamente.",
                    button: "Aceptar"
                }).then(function () {
                    location.href = app.urlTo("User/principal");
                });
            } else {
                swal("Error", response.message);
            }
        }).error(function (e) {
            swal("Error", "Se ha producido un error inesperado.", "error");
        }).send();
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
        vista.resizeWigets();
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
    vista.init();
})
