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
    },
    onChangeText: function () {
        var estacion = $('#k_id_station option:selected').text();
        var tipo_trabajo = $('#k_id_work option:selected').text()
        var fin_programado = $('#d_fin_programado_sa').val().split('T');
        $('#name_station').html(estacion);
        $('#type_work').html(tipo_trabajo);
        $('#closing_time').html(fin_programado[1]);
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
        var lider_cambio = $('#n_lider_cuadrilla_vm').val();
        var tel_lider_cambio = $('#i_telefono_lider_cuadrilla').val();
        var integrador = $('#n_integrador_backoffice').val();
        var ing_cierre = $('#i_ingeniero_cierre option:selected').text();
        var valor = $('#k_id_work').val();
        if (valor != "") {
            var abrev_tipo_trabajo = $("#n_abrev_work option[value="+ valor +"]").text();
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
        $('#body_integrador').html(integrador);
        $('#body_ing_cierre').html(ing_cierre);
        $('#body_fecha_integracion').html(vista.fechaActual());
    },
    onActivateRemedyForm: function () {
        var subEstado = $('#n_sub_estado').val();
        if (subEstado === 'No Exitoso') {
            $('#form5').show();
        } else {
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
                        console.log(data);
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
                }
                if (data.avm) {
                    $('#form2').find('input:checkbox').prop('checked', true);
                    var btn = $('#form2 button:submit');
                    btn.html(btn.attr('data-update-text'));
                    $('.list-group-item:eq(2)').removeClass('disabled').trigger('click');
                }
                if ($('#form3 #i_ingeniero_control').val().trim() != "") {
                    $('.list-group-item:eq(3)').removeClass('disabled').trigger('click');
                }
                if (data.cvm) {
                    var btn = $('#form4 button:submit');
                    btn.html(btn.attr('data-update-text'));
                    $('.list-group-item:eq(0)').removeClass('disabled').trigger('click');
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
        }

        //Si todo ha salido bien construimos el objeto y nos preparamos para insertar...

        var obj = new Object();
        __mergeObj(obj, form1.getFormData());
        __mergeObj(obj, form2.getFormData());
        __mergeObj(obj, form3.getFormData());
        __mergeObj(obj, form4.getFormData());

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
                        swal(((forInsert) ? "Guardado" : "Actualizado"), "Se ha " + ((forInsert) ? "registrado" : "actualizado") + " el registro correctamente.", "success");
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
                        swal("Guardado", "Se ha registrado el registro correctamente.", "success");
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