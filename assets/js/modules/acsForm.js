var contControles = 0;
var contCausas = 0;
$(document).ready(function () {
    $("div.bhoechie-tab-menu>div.list-group>a").click(function (e) {
        e.preventDefault();
        $(this).siblings('a.active').removeClass("active");
        $(this).addClass("active");
        var index = $(this).index();
        $("div.bhoechie-tab>div.bhoechie-tab-content").removeClass("active");
        $("div.bhoechie-tab>div.bhoechie-tab-content").eq(index).addClass("active");
    });

    $("input:checkbox[name=checklist1]").click(function () {
        var checkList = $("input:checkbox[name=checklist1]").length;
        var cheked = $("input:checkbox[name=checklist1]:checked").length;
        if (checkList === cheked) {
            $('#btnGenerarVm').attr("disabled", false);
        } else {
            $('#btnGenerarVm').attr("disabled", true);
        }
    });

    $("input:checkbox[name=checklist2]").click(function () {
        var checkList = $("input:checkbox[name=checklist2]").length;
        var cheked = $("input:checkbox[name=checklist2]:checked").length;
        if (checkList === cheked) {
            $('#btnGenerarApertura').attr("disabled", false);
        } else {
            $('#btnGenerarApertura').attr("disabled", true);
        }
    });

    $("#btnMinus").click(function (e) {
        e.preventDefault();
        if ($("#containerSubject").is(":visible")) {
            $("#btnMinus").html('<i class="fa fa-plus"></i>');
        } else {
            $("#btnMinus").html('<i class="fa fa-minus"></i>');
        }
        $("#containerSubject").toggle();
        $("#containerEmail").toggle();
    });

    $("#btnMinusRemedy").click(function (e) {
        e.preventDefault();
        if ($("#containerRemedy").is(":visible")) {
            $("#btnMinusRemedy").html('<i class="fa fa-plus"></i>');
        } else {
            $("#btnMinusRemedy").html('<i class="fa fa-minus"></i>');
        }
        $("#containerRemedy").toggle();
    });

    $("#n_persona_solicita_vmlc").autocomplete({
        source: function (request, response) {
            $.ajax({
                url: "getAllPersonRequests",
                type: 'post',
                dataType: "json",
                data: {
                    search: request.term
                },
                success: function (data) {
                    console.log(data.data);
                    response(data.data);
                }
            });
        },
        select: function (event, ui) {
            $('#n_persona_solicita_vmlc').val(ui.item.n_persona_solicita_vmlc);
//            $('#selectuser_id').val(ui.item.value); // save selected id to input
            return false;
        }
    });

});

var vista = {
    init: function () {
        vista.events();
        vista.configView();
        vista.onChangeCrqChg();
        window.setTimeout(function () {
            vista.get();
            vista.onChangeText();
            vista.onChangeEmail();
            vista.onControlFm();
            vista.onChangeFineFault();
            vista.onChangeTypeSolution();
        }, 15);
    },
    events: function () {
        $('form').on('submit', vista.onSumitForm);
        $('.control-change').on('change', vista.onControlChange);
        $('.select-checklist').on('change', vista.onChangeChecklist);
        $('#n_sub_estado').on('change', vista.onActivateRemedyForm);
        $('.control-text').on('change', vista.onChangeText);
        $('.control-email').on('change', vista.onChangeEmail);
        $('.radio-code').on('click', vista.onChangeCrqChg);
        $('#n_crq').on('focusout', vista.onValidateCrqChg);
        $('.control-fm').on('change', vista.onControlFm);
        $('#k_tecnologia_afectada').on('change', vista.onValidateRncBsc);
        $('#n_ampliacion_dualbeam').on('change', vista.onChangeDualBeam);
        $('#n_falla_final').on('change', vista.onChangeFineFault);
        $('.change-solution').on('change', vista.onChangeTypeSolution);
        $('.select-note').on('change', vista.onChangeNote);
        $('.estado_ticket_remedy').on('change', vista.onActivateRemedyClosing);
        $('.estado_ticket_remedy').on('change', vista.onChangeTypeAffectation);
    },
    onChangeTypeAffectation: function () {
        var estado_remedy = $('#n_estado_ticket option:selected').text();
        var option = '';
        switch (estado_remedy) {
            case 'Cerrado':
                option = '<option value="Seleccione">Seleccione</option>'
                        + '<option value="Afectacion Finalizada">Afectacion Finalizada</option>'
                        + '<option value="Degradacion Superada">Degradacion Superada</option>'
                        + '<option value="Notificacion Finalizada">Notificacion Finalizada</option>';
                break;

            case 'Cancelado':
                option = '<option value="">Seleccione</option>'
                        + '<option value="Afectacion Finalizada">Afectacion Finalizada</option>'
                        + '<option value="Degradacion Superada">Degradacion Superada</option>'
                        + '<option value="Notificacion Finalizada">Notificacion Finalizada</option>'
                        + '<option value="Cancelado">Cancelado</option>';
                break;

            default :
                option = '<option value="">Seleccione</option>'
                        + '<option value="Afectacion de servicio">Afectacion de servicio</option>'
                        + '<option value="Notificacion">Notificacion</option>'
                        + '<option value="Performance - Degradacion">Performance - Degradacion</option>';
                break;
        }

        $('#n_tipo_afectacion').empty();
        $('#n_tipo_afectacion').append(option);
        $('#n_tipo_afectacion').trigger('selectfilled');

    },
    onActivateRemedyClosing: function () {
        var estado_remedy = $('#n_estado_ticket option:selected').text();
        if (estado_remedy == 'Cancelado' || estado_remedy == 'Cerrado') {
            $('#remedy_cierre').show();
        } else {
            $('#remedy_cierre').hide();
        }
    },
    onChangeNote: function () {
        var tecnologia = $('#k_id_technology option:selected').text();
        var tipo_trabajo = $('#k_id_work option:selected').text();
        var nota = '';
        switch (tipo_trabajo) {
            case 'Migración de alarmas externas':
                if (tecnologia == '2G/3G' || tecnologia == '2G/3G/LTE') {
                    nota = '<h2 class="h4"><i class="fa fa-fw fa-exclamation-triangle"></i> Aval por parte implementacion Claro en caso que no presenten alarmas externas para migracion (FPMA FLEXI POWER MODULE)</h2>';
                }
                break;

            case 'Modernización Multiradio':
                if (tecnologia == '2G' || tecnologia == '2G/3G') {
                    nota = '<h2 class="h4"><i class="fa fa-fw fa-exclamation-triangle"></i> Validar VM ACS y/o CG Migracion de alarmas y/o - Aval por parte implementacion Claro en caso que no presenten alarmas externas para migracion (FPMA FLEXI POWER MODULE)</h2>';
                }
                break;

            case 'Reubicacion de Equipos':
                nota = '<h2 class="h4"><i class="fa fa-fw fa-exclamation-triangle"></i> Validar se mantiene o se realiza migracion alarmas a otro equipo de Power</h2>';
                break;
        }
        $('#note_checklist').html(nota);
    },
    onChangeTypeSolution: function () {
        var tecnologia = $('#k_id_technology option:selected').text();
        var tipo_trabajo = $('#k_id_work option:selected').text();
        var option = '';
        if (tipo_trabajo == 'Modernización Multiradio') {
            switch (tecnologia) {
                case '2G':
                    option = '<option value="Modernización concurrente">Modernización concurrente</option>'
                            + '<option value="Modernización dedicada">Modernización dedicada</option>';
                    break;

                case '2G/3G':
                    option = '<option value="Modernización RX diversity">Modernización RX diversity</option>'
                            + '<option value="Modernización RF scharig">Modernización RF scharig</option>';
                    break;

                default:
                    option = '<option value="N/A">N/A</option>';
                    break;
            }
        } else {
            option = '<option value="N/A">N/A</option>';
        }

        $('#n_tipo_solucion').empty();
        $('#n_tipo_solucion').append(option);
        $('#n_tipo_solucion').trigger('selectfilled');
    },
    onChangeFineFault: function () {
        var falla_final = $('#n_falla_final option:selected').text();
        var option = '';
        switch (falla_final) {
            case "SI":
                option = '<option value="Degradacion activa">Degradación activa</option>'
                        + '<option value="Afectación activa">Afectación activa</option>';
                break;
            case "NO":
                $("#n_tipo_falla_final").val('N/A').trigger('change.select2');
                option = '<option value="">Seleccione</option>'
                        + '<option value="Activo">Activo</option>'
                        + '<option value="Cancelado">Cancelado</option>'
                        + '<option value="Cerrado">Cerrado</option>'
                        + '<option value="Pendiente Apertura">Pendiente Apertura</option>'
                        + '<option value="Rechazado">Rechazado</option>'
                        + '<option value="Suspendido">Suspendido</option>';
                break;
            default:
                option = '<option value="">Seleccione</option>'
                        + '<option value="Activo">Activo</option>'
                        + '<option value="Cancelado">Cancelado</option>'
                        + '<option value="Cerrado">Cerrado</option>'
                        + '<option value="Pendiente Apertura">Pendiente Apertura</option>'
                        + '<option value="Rechazado">Rechazado</option>'
                        + '<option value="Suspendido">Suspendido</option>';
                break;
        }

        $('#n_estado_vm').empty();
        $('#n_estado_vm').append(option);
        $('#n_estado_vm').trigger('selectfilled');
    },
    onChangeDualBeam: function () {
        var ampliacion_dualbeam = $('#n_ampliacion_dualbeam option:selected').text();
        switch (ampliacion_dualbeam) {
            case "FALSO":
                $("#n_sectores_dualbeam").val('N/A');
                break;
            default:
                $("#n_sectores_dualbeam").val('');
                break;
        }
    },
    onValidateRncBsc: function () {
        var tecnologia_afectada = $('#k_tecnologia_afectada option:selected').text();
        switch (tecnologia_afectada) {
            case "2G":
                $('#n_rnc_name').attr('disabled', true);
                $('#n_bsc_name').removeAttr('disabled');
                $("#n_rnc_name").val('N/A');
                $("#n_bsc_name").val('');
                break;
            case "3G":
                $('#n_bsc_name').attr('disabled', true);
                $('#n_rnc_name').removeAttr('disabled');
                $("#n_bsc_name").val('N/A');
                $("#n_rnc_name").val('');
                break;
            default:
                $('#n_rnc_name').removeAttr('disabled');
                $('#n_bsc_name').removeAttr('disabled');
                $("#n_rnc_name").val('N/A');
                $("#n_bsc_name").val('N/A');
                break;
        }
    },
    onControlFm: function () {
        var ente_ejecutor = $('#n_enteejecutor option:selected').text();
        switch (ente_ejecutor) {
            case "Claro":
                $("#n_fm_nokia").val('N/A').trigger('change.select2');
                $('#n_fm_nokia').attr('disabled', true);
                $('#n_wp').removeAttr('required');
                $('#n_fm_claro').removeAttr('disabled');
                break;
            case "Nokia":
                $("#n_fm_claro").val('N/A').trigger('change.select2');
                $('#n_fm_claro').attr('disabled', true);
                $('#n_wp').attr('required', true);
                $('#n_fm_nokia').removeAttr('disabled');
                break;
        }
    },
    onChangeText: function () {
        var estacion = $('#k_id_station option:selected').text();
        var tipo_trabajo = $('#k_id_work option:selected').text()
        var fin_programado = $('#d_fin_programado_sa').val().split('T');
//        console.log(fin_programado[1]);
        var texto = "*" + estacion + "* - Se confirma Apertura de VM para los siguientes 1 trabajos: " + tipo_trabajo
                + " Sectores WO. Por favor tenga en cuenta que el tiempo de la revisión por parte del grupo integrador está incluido dentro del tiempo de la ejecución de la VM y la hora de cierre programada para esta ventana es a las *" + fin_programado[1] + "*."
                + "Tenga en cuenta estas observaciones con el fin de no generar Afectación de Servicio."
                + "*Recuerde que al momento del solicitar el cierre los valores de VSWR deben estar entre 1.6 y 2.6 y los features Antena Line supervision y RX signal debe estar activos durante toda la actividad.*";
        $('#texto').html(texto);
    },
    onChangeEmail: function () {
        var tecnologia = $('#k_id_technology option:selected').text();
        var banda = $('#k_id_band option:selected').text();
        var estacion = $('#k_id_station option:selected').text();
        var site_access = $('#i_id_site_access').val()
        var crq = $('#n_crq').val();
        var wp = $('#n_wp').val();
        var rftools = $('#n_id_rftools').val();
        var ret = $('#n_ret').val();
        var am_dualbeam = $('#n_ampliacion_dualbeam').val();
        var se_dualbeam = $('#n_sectores_dualbeam').val();
        var tipo_solucion = $('#n_tipo_solucion').val();
        var ente_ejecutor = $('#n_enteejecutor').val();
        var contratista = $('#n_contratista').val();
        var responsable_sitio = $('#n_lider_cuadrilla_vm').val();
        var tel_lider_cambio = $('#i_telefono_lider_cuadrilla').val();
        var integrador = $('#n_integrador_backoffice').val();
        var ing_cierre = $('#i_ingeniero_cierre option:selected').text();
        var valor = $('#k_id_work').val();
        if (valor != "") {
            var abrev_tipo_trabajo = $("#n_abrev_work option[value=" + valor + "]").text();
        }
        var lider_cambio = "";
        switch (ente_ejecutor) {
            case "Claro":
                lider_cambio = $('#n_fm_claro').val();
                break;
            case "Nokia":
                lider_cambio = $("#n_fm_nokia").val();
                break;
        }
        $('#affair_station').html(estacion);
        $('#affair_band').html(banda);
        $('#affair_technology').html(tecnologia);
        $('#affair_type_work').html(abrev_tipo_trabajo);
        $('#body_station').html(estacion);
        $('#body_id_site_access').html(site_access);
        $('#body_crq').html(crq);
        $('#body_wp').html(wp);
        $('#body_rftool').html(rftools);
        $('#body_ret').html(ret);
        $('#body_ampliacion_dualbeam').html(am_dualbeam);
        $('#body_sectores_dualbeam').html(se_dualbeam);
        $('#body_tipo_solucion').html(tipo_solucion);
        $('#body_enteejecutor').html(ente_ejecutor);
        $('#body_contratista').html(contratista);
        $('#body_lider_cambio').html(lider_cambio);
        $('#body_telefono_lider_cambio').html(tel_lider_cambio);
        $('#body_responsable_sitio').html(responsable_sitio);
        $('#body_integrador').html(integrador);
        $('#body_ing_cierre').html(ing_cierre);
        $('#body_fecha_integracion').html(vista.fechaActual());
    },
    onActivateRemedyForm: function () {
        var subEstado = $('#n_sub_estado').val();
        var ente_ejecutor = $('#n_enteejecutor').val();
        if (subEstado === 'Exitoso') {
            $("#n_tipo_falla_final").val('N/A').trigger('change.select2');
        }

        if (subEstado === 'Afectación Activa' || subEstado === 'Notificacion activa' || subEstado === 'Degradacion Activa') {
            switch (subEstado) {
                case 'Afectación Activa':
                    $("#n_tipo_afectación").val('Afectacion de servicio').trigger('change.select2');
                    $("#n_falla_final").val('SI').trigger('change.select2');
                    break;
                case 'Notificacion activa':
                    $("#n_tipo_afectación").val('Notificacion').trigger('change.select2');
                    $("#n_falla_final").val('NO').trigger('change.select2');
                    break;
                case 'Degradacion Activa':
                    $("#n_tipo_afectación").val('Performance - Degradacion').trigger('change.select2');
                    $("#n_falla_final").val('SI').trigger('change.select2');
                    break;
            }

            $('#n_responsable_ticket').val(ente_ejecutor).trigger('change.select2');
            switch (ente_ejecutor) {
                case "Claro":
                    $('#n_fm_claro_remedy').val($('#n_fm_claro').val()).trigger('change.select2');
                    $('#n_fm_nokia_remedy').val('N/A').trigger('change.select2');
                    break;
                case "Nokia":
                    $('#n_fm_nokia_remedy').val($('#n_fm_nokia').val()).trigger('change.select2');
                    $('#n_fm_claro_remedy').val('N/A').trigger('change.select2');
                    break;
            }
            $('#form5').show();
        } else {
            $("#n_falla_final").val('NO').trigger('change.select2');
            $('#form5').hide();
        }
    },
    onChangeCrqChg: function () {
        var valRadio = $('input:radio[name=crq_chg]:checked').val();
        switch (valRadio) {
            case "CRQ":
                $('#n_crq').mask("CRQ999999999999", {placeholder: "CRQ000009999999"});
                break;
            case "CHG":
                $('#n_crq').mask("CHG99999", {placeholder: "CHG99999"});
                break;
        }
    },
    onValidateCrqChg: function () {
        var valinput = $('#n_crq').val();
        var valRadio = $('input:radio[name=crq_chg]:checked').val();
        var info = dataForm;
        for (var m = 0; m < info.crq.data.length; m++) {
            if (valinput == info.crq.data[m].n_crq) {
                swal("Código " + valRadio + " invalido", "Lo sentimos, el código " + valRadio + " ya existe.", "warning");
            }
        }
    },
    fechaActual: function () {
        var hoy = new Date();
        var dd = hoy.getDate();
        var mm = hoy.getMonth() + 1;
        var yyyy = hoy.getFullYear();
        if (dd < 10) {
            dd = '0' + dd;
        }
        if (mm < 10) {
            mm = '0' + mm;
        }
        hoy = dd + '/' + mm + '/' + yyyy;
        return hoy;
    },
    onChangeChecklist: function (callback) {
        $('#items_checklist').html('');
        if ($('#k_id_work').val().trim() == "" || $('#k_id_technology').val().trim() == "") {
            return;
        }
        app.post('Utils/getCheckList', {
            idTipoTrabajo: $('#k_id_work').val(),
            idTecnologia: $('#k_id_technology').val()
        })
                .success(function (response) {
                    var data = app.parseResponse(response);
                    if (data) {
                        //Listamos los nuevos items del checklist...
                        console.info("Se han consultado los items para el checklist...");
//                        console.log(data);
                        for (var i = 0; i < data.length; i++) {
                            var dat = data[i];
                            vista.addItemCheckList(dat);
                        }
                        if (typeof callback === "function") {
                            callback();
                        }
                    } else {
                        console.warn("No se pudo consultar el checklist...");
                    }
                })
                .error(function (e) {
                    console.error("Error al consultar el checklist...", e);
                })
                .send();
    },
    addItemCheckList: function (obj) {
        var content = $('#items_checklist');
        var html = dom.fillString('<div class="display-block"><input id="chk_p_{k_id_checklist}" name="vm.checklist[]"  type="checkbox"><label for="chk_p_{k_id_checklist}" class="text-bold">{nombre_documento}.</label></div>', obj);
        content.append(html);
    },
    onControlChange: function () {
        var formGlobal = $('#formGlobalAcs');
        var control = $(this);
        var name = control.attr('name');
        var controls = null;
        if (control.attr('data-name')) {
            name = control.attr('data-name');
            controls = formGlobal.find('[data-name="' + name + '"]');
        } else {
            controls = formGlobal.find('[name="' + name + '"]');
        }
        controls.val(control.val()).trigger('change.select2');
    },
    configView: function () {
        dom.llenarCombo($('.select-banda'), dataForm.bands.data, {text: "n_name_band", value: "k_id_band"});
        dom.llenarCombo($('.select-tecnologia'), dataForm.technologies.data, {text: "n_name_technology", value: "k_id_technology"});
        dom.llenarCombo($('.select-tipotrabajo'), dataForm.works.data, {text: "n_name_ork", value: "k_id_work"});
        dom.llenarCombo($('#n_abrev_work'), dataForm.works.data, {text: "n_abreviacion", value: "k_id_work"});
        dom.llenarCombo($('.select-estacion'), dataForm.stations.data, {text: "n_name_station", value: "k_id_station"});
        dom.llenarCombo($('.select-ingeniero'), dataForm.users.data, {text: ["n_name_user", "n_last_name_user"], value: "k_id_user"});
        $('select').select2({width: '100%'});
        $('#i_telefono_lider_cambio').mask("(999) 999-9999");
        $('#i_telefono_fm').mask("(999) 999-9999");
        $('#i_telefono_lider_cuadrilla').mask("(999) 999-9999");
        var inputs = $('input[type="time"]');
        inputs.attr('type', 'text').addClass('for-time');
        inputs.mask("99:99", {placeholder: "HH:mm"});
        $('#n_numero_incidente').mask("INC999999999999", {placeholder: "INC999999999999"});
    },
    get: function () {
        var id = app.getParamURL('id');
        if (id) {
            if (!dataForm.record) {
                swal("Registro no existe", "Lo sentimos, el registro actual no existe o se ha eliminado.", "warning");
            }
            var formGlobal = $('#formGlobalAcs');
            var data = dataForm.record;
            if (data) {
                $('#idAcs').val(id);
                formGlobal.attr('data-mode', "FOR_UPDATE");
                formGlobal.fillForm(data);
                if (data.vm) {
                    vista.onChangeChecklist(function () {
                        $('#form1').find('input:checkbox').prop('checked', true);
                    });
                    var btn = $('#form1 button:submit');
                    btn.html(btn.attr('data-update-text'));
                    $('.list-group-item:eq(1)').removeClass('disabled').trigger('click');
                    $("#i_ingeniero_apertura").val(data.vm.i_ingeniero_apertura).trigger('change.select2');
                }
                if (data.avm) {
                    $('#form2').find('input:checkbox').prop('checked', true);
                    var btn = $('#form2 button:submit');
                    btn.html(btn.attr('data-update-text'));
                    $('.list-group-item:eq(2)').removeClass('disabled').trigger('click');
                    $("#i_ingeniero_control").val(data.vm.i_ingeniero_punto_control).trigger('change.select2');
                }
                if ($('#form3 #i_ingeniero_control').val().trim() != "") {
                    $('.list-group-item:eq(3)').removeClass('disabled').trigger('click');
                }
                if (data.cvm) {
                    var btn = $('#form4 button:submit');
                    btn.html(btn.attr('data-update-text'));
                    $('.list-group-item:eq(3)').removeClass('disabled').trigger('click');
                    $("#i_ingeniero_cierre").val(data.vm.i_ingeniero_cierre).trigger('change.select2');

                }
                if (data.tiketRemedy) {
                    formGlobal.fillForm(data.tiketRemedy);
                    vista.onChangeTypeAffectation();
                    $('#n_tipo_afectacion').val(data.tiketRemedy.n_tipo_afectacion).trigger('change.select2');
                    if (data.tiketRemedy.n_estado_ticket == "Cerrado") {
                        $('#remedy_cierre').show();
                    }
                    $('#form5').show();
                }
                if (data.exeded_time) {
                    dom.printAlert('El registro se encuentra fuera de tiempo límite.', 'warning', $('.alert'));
                }
            }
        }
    },
    onSumitForm: function (e) {
        var form = $(this);
        form.validate();
        if (e.isDefaultPrevented())
        {
            return;
        }
        app.stopEvent(e);
        var form1 = $('#form1');
        var form2 = $('#form2');
        var form3 = $('#form3');
        var form4 = $('#form4');
        var form5 = $('#form5');

        //Función genérica para validar el checklist de los dos formuarios...
        var validateChecklist = function (form) {
            var listCheck = form.find('#productionList input:checkbox');
            var valid = 0;
            for (var i = 0; i < listCheck.length; i++) {
                var chk = $(listCheck[i]);
                if (!chk.is(':checked')) {
                    valid--;
                }
            }
            return valid == 0;
        };

        var inputs = $('.for-time');
        //Validamos los inputs time...
        for (var i = 0; i < inputs.length; i++) {
            var input = $(inputs[i]);
            if (input.val().trim() != "") {
                var parts = input.val().split(":");
                var h = parts[0];
                var m = parts[1];
                var v = parseInt(h) >= 8 && parseInt(h) <= 20;
                var v2 = parseInt(m) >= 0 && parseInt(m) <= 59;
                if (!v || !v2) {
                    var html = input.parent().parent().find('label').text().replace(/\:/g, '');
                    swal("Error", "Ingrese una " + html + " válida.", "error");
                    return;
                }
            }
        }

        //Validación cehceklist...
        if ((form.attr('id')) == "form1" && (!validateChecklist(form1))) {
            swal("Error", "Debe completar el checklist.", "error");
            return;
        }

        if ((form.attr('id')) == "form2" && (!validateChecklist(form2))) {
            swal("Error", "Debe completar el checklist.", "error");
            return;
        }

        if (form.attr('id') == "form1") {
            var f1 = $('#n_hora_apertura_grupo');
            var f2 = $('#n_hora_solicitud');
            if (f1.val().trim() != "" && f2.val().trim() != "") {
                if (f1.val().replace(/^\D+/g, '') <= f2.val().replace(/^\D+/g, '')) {
                    swal("Atención", "La Hora Apertura Grupo debe ser mayor a la Hora de Solicitud", "warning");
                    return;
                }
            }
        }

        if (form.attr('id') == "form2") {
            var f1 = $('#d_inicio_programado_sa');
            var f2 = $('#d_fin_programado_sa');
            if (f1.val().trim() != "" && f2.val().trim() != "") {
                var d1 = new Date(f1.val());
                var d2 = new Date(f2.val());
                if (d1.getTime() >= d2.getTime()) {
                    swal("Atención", "La Fecha de Inicio Programado SA debe ser inferior a la Fecha Fin Programado SA", "warning");
                    return;
                }
            }

            f1 = $('#n_hora_atencion_vm');
            f2 = $('#n_hora_inicio_real_vm');
            if (f1.val().trim() != "" && f2.val().trim() != "") {
                if (f1.val().replace(/^\D+/g, '') >= f2.val().replace(/^\D+/g, '')) {
                    swal("Atención", "La Hora Atención VM debe ser inferior a la Hora Inicio Real VM", "warning");
                    return;
                }
            }

            f1 = $('#n_hora_atencion_vm');
            f2 = $('#n_hora_solicitud');
            if (f1.val().trim() != "" && f2.val().trim() != "") {
                if (f1.val().replace(/^\D+/g, '') <= f2.val().replace(/^\D+/g, '')) {
                    swal("Atención", "La Hora Atención VM debe ser mayor a la Hora de Solicitud", "warning");
                    return;
                }
            }

            f1 = $('#n_hora_inicio_real_vm');
            f2 = $('#n_hora_solicitud');
            if (f1.val().trim() != "" && f2.val().trim() != "") {
                if (f1.val().replace(/^\D+/g, '') <= f2.val().replace(/^\D+/g, '')) {
                    swal("Atención", "La Hora Inicio Real VM debe ser mayor a la Hora de Solicitud", "warning");
                    return;
                }
            }
        }

        if (form.attr('id') == "form3") {
            f1 = $('#n_hora_revision');
            f2 = $('#n_hora_apertura_grupo');
            if (f1.val().trim() != "" && f2.val().trim() != "") {
                if (f1.val().replace(/^\D+/g, '') <= f2.val().replace(/^\D+/g, '')) {
                    swal("Atención", "La Hora revisión debe ser mayor a la Hora Apertura Grupo", "warning");
                    return;
                }
            }

            f1 = $('#n_hora_revision');
            f2 = $('#n_hora_solicitud');
            if (f1.val().trim() != "" && f2.val().trim() != "") {
                if (f1.val().replace(/^\D+/g, '') <= f2.val().replace(/^\D+/g, '')) {
                    swal("Atención", "La Hora revisión debe ser mayor a la Hora de Solicitud", "warning");
                    return;
                }
            }
        }

        if (form.attr('id') == "form4") {
            var f1 = form.find('#d_hora_atencion_cierre');
            var f2 = form.find('#d_hora_cierre_confirmado');
            if (f1.val().trim() != "" && f2.val().trim() != "") {
                if (f1.val().replace(/^\D+/g, '') >= f2.val().replace(/^\D+/g, '')) {
                    swal("Atención", "La Fecha de Hora de atención cierre debe ser inferior a la Hora de cierre confirmado", "warning");
                    return;
                }
            }

            f1 = $('#d_hora_atencion_cierre');
            f2 = $('#n_hora_solicitud');
            if (f1.val().trim() != "" && f2.val().trim() != "") {
                if (f1.val().replace(/^\D+/g, '') <= f2.val().replace(/^\D+/g, '')) {
                    swal("Atención", "Hora de atención cierre debe ser mayor a la Hora de Solicitud", "warning");
                    return;
                }
            }

            f1 = $('#d_hora_cierre_confirmado');
            f2 = $('#n_hora_solicitud');
            if (f1.val().trim() != "" && f2.val().trim() != "") {
                if (f1.val().replace(/^\D+/g, '') <= f2.val().replace(/^\D+/g, '')) {
                    swal("Atención", "Hora de cierre confirmado debe ser mayor a la Hora de Solicitud", "warning");
                    return;
                }
            }
        }

        //Si todo ha salido bien construimos el objeto y nos preparamos para insertar...

        var obj = new Object();
        __mergeObj(obj, form1.getFormData());
        __mergeObj(obj, form2.getFormData());
        __mergeObj(obj, form3.getFormData());
        __mergeObj(obj, form4.getFormData());

        switch (form.attr('id')) {
            case "form1":
                obj.vm.n_fase_ventana = 'apertura vm';
                break;
            case "form2":
                obj.vm.n_fase_ventana = 'punto control';
                break;
            case "form3":
                obj.vm.n_fase_ventana = 'cierre vm';
                break;
        }

        obj.vm.n_asignado = 'N';
        obj.vm.i_ingeniero_actual = 0;
        var formGlobal = $('#formGlobalAcs');
        var uri = formGlobal.attr('data-action');
        obj.form = form.attr('id');
        var forInsert = true;
        if (formGlobal.attr('data-mode') == "FOR_UPDATE") {
            uri = formGlobal.attr('data-action-update');
            forInsert = false;
            obj.id = $('#idAcs').val();
        }

        //Realizamos la petición ajax...
        formGlobal.find('fieldset, input, textarea, button, fieldset, select').not('.disabled-control').prop('disabled', true);
        app.post(uri, obj)
                .complete(function () {
                    formGlobal.find('fieldset, input, textarea, button, fieldset, select').not('.disabled-control').prop('disabled', false);
                })
                .success(function (response) {
                    var v = app.successResponse(response);
                    if (v) {
                        if (forInsert) {
                            $('#idAcs').val(response.data);
                            $('#txtIdZTE').val(response.data);
                            $('#k_id_vm').val(response.data);
                            formGlobal.attr('data-mode', 'FOR_UPDATE');
                            var btn = form.find('button:submit');
//                            var index = form.parents('.bhoechie-tab-content').next().index();
//                            $('.list-group-item').removeClass('active');
//                            $('.list-group-item:eq(' + (index - 1) + ')').removeClass('disabled').addClass('active').trigger('click');
                            btn.html(btn.attr('data-update-text'));
                        }
                        if (form.attr('id') == "form5") {
                            vista.insertRemedy();
                        }
                        swal(((forInsert) ? "Guardado" : "Actualizado"), "Se ha " + ((forInsert) ? "registrado" : "actualizado") + " el registro correctamente.", "success").then(function (isConfirm) {
                            if (isConfirm.value) {
                                location.href = app.urlTo('Acs/principal');
                            }
                        });
                    } else {
                        swal("Lo sentimos", response.message, "error");
                    }
                })
                .error(function () {
                    swal("Error inesperado", "Se ha producido un error al " + ((forInsert) ? "insertar" : "actualizar") + " el registro.", "error");
                }).send();

        console.log(obj);
    },
    insertRemedy: function () {
        var idAcs = $('#idAcs').val();
        $('#k_id_vm').val(idAcs);
        var form5 = $('#form5');
        app.post('Acs/insertTiketRemedy', form5.getFormData())
                .success(function (response) {
                    var v = app.successResponse(response);
                    if (v) {
                        swal("Guardado", "recuerde que debe crear un ticket en remedy.", "success");
                    } else {
                        swal("Lo sentimos", response.message, "error");
                    }
                })
                .error(function () {
                    swal("Error inesperado", "Se ha producido un error al insertar el registro.", "error");
                }).send();
    }
};
$(function () {
    vista.init();
});
