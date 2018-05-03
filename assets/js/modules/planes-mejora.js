var modeloControles = $('<select class="form-control m-r-0" data-combox="6" '
        + 'id="cmbControles" name="controles[]" >'
        + '<option value="">Seleccione</option>'
        + '</select>');
var contControles = 0;
var contCausas = 0;
var vista = {
    causasForDelete: [],
    controlsForDelete: [],
    init: function () {
        vista.evetns();
        vista.configView();
        vista.get();
    },
    evetns: function () {
        $("div.bhoechie-tab-menu>div.list-group>a").on('click', vista.onClickTab); //*ESTA LINEA NO SE TOCA. NO SE TOCAA! */
        
    },
    onChangeCmbPlataforma: function () {
        $('.txt-plataforma').val($('#cmbPlataforma option:selected').text());
    },
    onChangeDescriptionRisk: function () {
        $("#cmbRiesgoDescripcion").val($('#cmbRiesgoId').val()).trigger('change.select2');
    },
    onClickBtnAddActividad: function () {
        vista.addTipoActividad().select2({width: '100%'});
    },
    onChangeRisk: function () {
        var cmb = $('#cmbPlataforma');
        if (cmb.val().trim() != "") {
            if (cmb.attr('data-val') == cmb.val()) {
                return;
            }
            cmb.attr('data-val', cmb.val());
            app.post('Risk/listRiskByIdPlataform', {
                id: $('#cmbPlataforma').val()
            }).success(function (response) {
                dom.llenarCombo($('#cmbRiesgoId'), response.data, {text: "n_riesgo", value: "k_id_riesgo"});
                dom.llenarCombo($('#cmbRiesgoDescripcion'), response.data, {text: "n_riesgo_descripcion", value: "k_id_riesgo"});
            }).error(function () {
                swal("Error inesperado", "Lo sentimos, se ha producido un error inesperado.", "error");
            }).send();
        }
    },
    onClickBtnRemoveActividad: function () {
        var btn = $(this);
        var parent = btn.parents('.group-tipo-actividad');
        if ($('.group-tipo-actividad').length > 1) {
            parent.remove();
            var groups = $('.group-tipo-actividad');
            for (var i = 0; i < groups.length; i++) {
                var group = $(groups[i]);
                group.find('label').html('Tipo de Actividad [' + (i + 1) + ']');
            }
        } else {
            parent.find('Tipo de Actividad [1]');
        }
    },
    addTipoActividad: function (value) {
        var num = ((num = $('.group-tipo-actividad').length + 1) > 0) ? ' [' + num + ']' : '';
        var target = (value) ? 'data-target="' + value + '"' : '';
        var html = '<div class="form-group group-tipo-actividad" ' + target + '>'
                + '<label for="txtTipoActividad" class="col-sm-2 control-label">Tipo de Actividad' + num + '</label>'
                + '<div class="col-sm-10"><div class="input-group">'
                + '<select class="form-control" name="riesgo_especifico.n_tipo_activad[]">'
                + '<option value="">Seleccione</option>'
                + '<option value="OT" ' + ((value == "OT") ? 'selected="true"' : '') + '>OT</option>'
                + '<option value="MANTENIMIENTO" ' + ((value == "MANTENIMIENTO") ? 'selected="selected"' : '') + '>MANTENIMIENTO</option>'
                + '<option value="INCIDENCIAS/EVENTOS" ' + ((value == "INCIDENCIAS/EVENTOS") ? 'selected="selected"' : '') + '>INCIDENCIAS/EVENTOS</option>'
                + '<option value="FACTURACIÓN" ' + ((value == "FACTURACIÓN") ? 'selected="selected"' : '') + '>FACTURACIÓN</option>'
                + '<option value="APROVISIONAMIENTO" ' + ((value == "APROVISIONAMIENTO") ? 'selected="selected"' : '') + '>APROVISIONAMIENTO</option>'
                + '<option value="CONTROL DE ACCESSO" ' + ((value == "CONTROL DE ACCESSO") ? 'selected="selected"' : '') + '>CONTROL DE ACCESSO</option>'
                + '<option value="ADMINISTRATIVO" ' + ((value == "ADMINISTRATIVO") ? 'selected="selected"' : '') + '>ADMINISTRATIVO</option>'
                + '<option value="SEGURIDAD" ' + ((value == "SEGURIDAD") ? 'selected="selected"' : '') + '>SEGURIDAD</option>'
                + '</select>'
                + '<div class="input-group-btn">'
                + '<button type="button" class="btn-add-actividad btn btn-primary" title="Agregar" >'
                + '<i class="fa fa-fw fa-plus"></i></button>'
                + '<button type="button" class="btn-remove-actividad btn btn-danger" title="Eliminar" >'
                + '<i class="fa fa-fw fa-minus"></i></button>'
                + '</div>'
                + '</div></div>'
                + '</div>';
        var select = $(html);
        $('#tiposDeActividad').append(select);
        return select.find('select');
    },
    onChangeSelectSeveridad: function () {
        if ($('.select-severidad#cmbProbabilidad').val().trim() != "" && $('.select-severidad#cmbImpacto').val().trim() != "") {
            app.post('Utils/getSeveridad', {
                idProbabilidad: $('#cmbProbabilidad').val(),
                idImpacto: $('#cmbImpacto').val()
            })
                    .success(function (response) {
                        if (response.code > 0) {
                            var input = $('#txtSeveridadRiesgoInherente');
                            input.val(response.data.n_calificacion);
                            input.css('background-color', response.data.n_color);
                            input.css('color', response.data.n_text_color);
                        } else {
                            $('#txtSeveridadRiesgoInherente').val("DESCONOCIDO");
                        }
                    })
                    .error(function () {
                        $('#txtSeveridadRiesgoInherente').val("ERROR INESPERADO");
                    })
                    .send();
        }
    },
    get: function () {
        var id = app.getParamURL('id');
        if (id) {
            if (!dataForm.record) {
                swal("Registro no existe", "Lo sentimos, el registro actual no existe o se ha eliminado.", "warning");
            }
            var formGlobal = $('#formsRisk');
            var data = dataForm.record;
            if (data) {
                formGlobal.attr('data-mode', "FOR_UPDATE");
                formGlobal.fillForm(data);
                formGlobal.find('#cmbSoporteImpacto1').attr('data-value', data["soporte_impacto[]"][0]);
                formGlobal.find('#cmbSoporteImpacto2').attr('data-value', data["soporte_impacto[]"][1]);
                formGlobal.find('button:submit').html('<i class="fa fa-fw fa-save"></i> Actualizar');
                vista.listCausas(data.causas);
                try {
                    var args = dataForm.record.riesgo_especifico.n_tipo_activad;
                    if (args) {
                        var tiposActividad = JSON.parse(args);
                        if (tiposActividad.length) {
                            for (var i = 0; i < tiposActividad.length; i++) {
                                vista.addTipoActividad(tiposActividad[i]).select2({width: '100%'});
                            }
                        }
                    }
                } catch (e) {
                    console.error(e);
                }
            }
        } else {
            vista.addTipoActividad().select2({width: '100%'});
            $('select').select2({width: '100%'});
        }
    },
    listCausas: function (causas) {
        if (Array.isArray(causas)) {
            for (var i = 0; i < causas.length; i++) {
                var causa = causas[i];
                vista.addCausa(causa);
            }
        }
    },
    onClickAddCausa: function () {
        vista.addCausa();
    },
    onClickRemoveCausa: function () {
        var btn = $(this);
        var causaItem = btn.parents('.item-causa');
        if (causaItem.attr('data-id')) {
            var obj = {
                idRecord: causaItem.attr('data-id')
            };
            vista.causasForDelete.push(obj);
        }
        causaItem.remove();
        if ($('.causa-added').length == 0) {
            $('#form3').find('button:submit').addClass('hidden');
            $('#btnAddCausa').removeClass('hidden');
        }
    },
    onClickAddControl: function () {
        var btn = $(this);
        var contentControl = btn.parents('.body-causa');
        vista.addControl(contentControl);
        if (contentControl.find('.item-control').length > 0) {
            contentControl.find('.btn-unic').parents('.item-control').remove();
        }
    },
    addControl: function (contentControl, control) {
        var model = $('#controlIndex');
        var run = function () {
            var clon = model.clone();
            contentControl.append(clon);
            clon.find('#numControl').html(contentControl.find('.item-control:not(.btn-added)').length);
            var selects = clon.find('select');
            selects.attr('class', 'form-control input-sm cmb-control');
            selects.removeAttr('tabindex');
            selects.removeAttr('aria-hidden');
            selects.next('.select2').remove();
            selects.select2({width: '100%'});
            if (control) {
                clon.find('select:eq(0)').attr('data-id', control.k_id_control_especifico);
                dom.fillCombo(clon.find('select:eq(0)'), control.k_id_control);
                dom.fillCombo(clon.find('select:eq(1)'), control.k_id_factor_riesgo);
            } else if (control == false) {
                clon.addClass('btn-added').find('.content-control').html('<button class="btn btn-primary btn-add-control btn-unic"><i class="fa fa-fw fa-plus"></i> Agregar control</button>');
            }
        };
        if (model.find('option').length > 2) {
            run();
        } else {
            var interval = window.setTimeout(function () {
                vista.addControl(contentControl, control);
                clearInterval(interval);
            }, 100);
        }
    },
    onClickRemoveControl: function () {
        var btn = $(this);
        var controlItem = btn.parents('.item-control');
        if (controlItem.find('select:eq(0)').attr('data-id')) {
            var obj = {
                idRecord: controlItem.find('select:eq(0)').attr('data-id')
            };
            vista.controlsForDelete.push(obj);
        }
        contentCausa = controlItem.parents('.body-causa');
        controlItem.remove();
        if (contentCausa.find('.item-control').length == 0) {
            vista.addControl(contentCausa, false);
        }
    },
    addCausa: function (causa) {
        var model = $('#itemCausaIndex');
        var clon = model.clone();
        clon.find('input:eq(0)').prop('disabled', false);
        clon.removeAttr('id').removeClass('hidden').addClass('causa-added');
        //Jugamos con los select de los controles...
        var select = clon.find('select:eq(0)');
        select.attr('class', 'form-control input-sm notDisabled cmb-control');
        select.removeAttr('tabindex');
        select.removeAttr('aria-hidden');
        select.html(model.find('select:eq(0)').html());
        select.next('.select2').remove();
        select.select2({'width': '100%'});
        var select2 = clon.find('select:eq(1)');
        select2.attr('class', 'form-control input-sm notDisabled cmb-factor-riesgo');
        select2.removeAttr('tabindex');
        select2.removeAttr('aria-hidden');
        select2.html(model.find('select:eq(1)').html());
        select2.next('.select2').remove();
        select2.select2({'width': '100%'});
        $('#contentCausas').append(clon);
        clon.find('#numCausa').html($('.causa-added').length);
        clon.find('input:eq(0)').focus();
        $('#form3').find('button:submit').removeClass('hidden');
        $('#btnAddCausa').addClass('hidden');
        if (causa) {
            clon.find('input:eq(0)').val(causa.n_nombre);
            clon.attr('data-id', causa.k_id_causa);
            //Recorremos los controles...
            if (causa.controls.length) {
                for (var i = 0; i < causa.controls.length; i++) {
                    var control = causa.controls[i];
                    clon.find('.body-causa').html('');
                    vista.addControl(clon.find('.body-causa'), control);
                }
            } else {
                clon.find('.body-causa').html('');
                vista.addControl(clon.find('.body-causa'), false);
            }
        }
    },
    onSubmitForm: function (e) {
        var form = $(this);
        form.validate();
        if (e.isDefaultPrevented())
        {
            return;
        }

        //Se envia la información de los formularios...
        app.stopEvent(e);
        var form1 = $('#form1');
        var form2 = $('#form2');

        var obj = new Object();
        __mergeObj(obj, form1.getFormData());
        __mergeObj(obj, form2.getFormData());
        obj.causas = [];
        var confirmar = false;
        if (vista.causasForDelete.length > 0) {
            confirmar = true;
            obj.causasForDelete = vista.causasForDelete;
        }
        if (vista.controlsForDelete.length > 0) {
            confirmar = true;
            obj.controlsForDelete = vista.controlsForDelete;
        }

        var start = function (obj) {
            //Buscamos las causas agregadas...
            var causasAdded = $('#form3').find('.causa-added');
            for (var i = 0; i < causasAdded.length; i++) {
                var causaItem = $(causasAdded[i]);
                //Buscamos los controles dentro de esa causa...
                var controlsItems = causaItem.find('.item-control:not(.btn-added)');
                var controls = [];
                for (var j = 0; j < controlsItems.length; j++) {
                    var controlItem = $(controlsItems[j]);
                    if (controlItem.find('select:eq(0)').val().trim() != "" && controlItem.find('select:eq(1)').val().trim() != "") {
                        var ctrl = {
                            id: controlItem.find('select:eq(0)').val(),
                            factorRiesgo: controlItem.find('select:eq(1)').val()
                        }
                        if (controlItem.find('select:eq(0)').attr('data-id')) {
                            ctrl.idRecord = controlItem.find('select:eq(0)').attr('data-id');
                        }
                        controls.push(ctrl);
                    }
                }
                if (causaItem.find('input:eq(0)').val().trim("") != "") {
                    var causaObj = {
                        text: causaItem.find('input:eq(0)').val(),
                        controls: controls,
                    };
                    if (causaItem.attr('data-id')) {
                        causaObj.idRecord = causaItem.attr('data-id');
                    }
                    obj.causas.push(causaObj);
                }
            }
            var formGlobal = $('#formsRisk');
            formGlobal.find('input, textarea, button, fieldset, select:not(.notDisabled)').prop('disabled', true);
            var uri = formGlobal.attr('data-action');
            var forUpdate = false;
            if (formGlobal.attr('data-mode') === "FOR_UPDATE") {
                uri = formGlobal.attr('data-action-update');
                obj.idRecord = $('#idRecord').val();
                forUpdate = true;
            }

            obj.riesgo_especifico.n_tipo_activad = JSON.stringify(obj.riesgo_especifico["n_tipo_activad[]"]);

            //Se hace la petición AJAX y se envia el objeto completo con toda la información de los tres formularios para ser procesada...
            console.log(obj);
            obj.soporte_impacto = obj["soporte_impacto[]"];
            delete obj["soporte_impacto[]"];
            app.post(uri, obj)
                    .complete(function () {
                        formGlobal.find('input:not(.disabled), textarea, button, fieldset, select').prop('disabled', false);
                    })
                    .success(function (response) {
                        var v = app.validResponse(response);
                        if (v) {
                            swal((forUpdate ? "Actualizado" : "Guardado"), (forUpdate ? "Se ha actualizado correctamente el registro." : "Se ha guardado correctamente el registro."), "success");
                            if (!forUpdate) {
                                $('#idRecord').val(response.data);
                            }
                            formGlobal.attr('data-mode', 'FOR_UPDATE');
                            form.find('button:submit').not('.btn-unic').html('<i class="fa fa-fw fa-save"></i> Actualizar');
                        } else {
                            swal((forUpdate ? "Error al actualizar" : "Error al guardar"), (forUpdate ? "Se ha producido un error al intentar actualizar el registro." : "Se ha producido un error al intentar guardar el registro."), "warning");
                        }
                    })
                    .error(function () {
                        swal("Error inesperado", "Lo sentimos, se ha producido un error inesperado.", "error");
                    }).send();
        };
        if (confirmar) {
            swal({
                title: 'Confirmación',
                text: "Se eliminarán algunas causas y/o controles, ¿está seguro?",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Confirmar',
                cancelButtonText: 'Cancelar'
            }).then(function (result) {
                if (result.value) {
                    start(obj);
                } else {
                    swal({
                        title: "Cancelado",
                        text: "Se han cancelado los cambios.",
                        type: "warning"
                    }).then(function () {
                        location.reload();
                    });
                }
            });
        } else {
            start(obj);
        }
    },
    onChangeCmbTipoEventoNivel1: function () {
        if ($('#cmbTipoEventoNivel1').val().trim("") === "") {
            return;

        }
        var cmb = $('#cmbTipoEventoNivel2');
        app.get('Utils/getListComboxCmbTipoEventoNvl2', {
            idNivel1: $('#cmbTipoEventoNivel1').val(),
        }).success(function (response) {
            var data = app.parseResponse(response);
            if (data) {
                dom.llenarCombo(cmb, data, {text: "text", value: "value"});
            }
            if (typeof callback === "function") {
                callback(data);
            }
        }).error(function () {
            dom.comboVacio(cmb);
        }).send();
    },
    onClickTab: function (e) {
        e.preventDefault();
        $(this).siblings('a.active').removeClass("active");
        $(this).addClass("active");
        var index = $(this).index();
        $("div.bhoechie-tab-content").removeClass("active");
        $("div.bhoechie-tab-content").eq(index).addClass("active");
        if ($(this).attr("id") === 'contentAll') {
            $("div.bhoechie-tab-content").addClass("active");
        }
        $('.cmb-control').prop('disabled', false).trigger('selectfilled');
        $('.cmb-factor-riesgo').prop('disabled', false).trigger('selectfilled');
    },
    configView: function () {
    }
};
$(document).ready(function () {
    vista.init();
});

$('#form1 .input-group.date').datepicker({
    format: "dd/mm/yyyy",
    language: "es",
    autoclose: true,
    todayHighlight: true
});

$('#form3 .input-daterange').datepicker({
    format: "dd/mm/yyyy",    
    language: "es",
    autoclose: true,
    todayHighlight: true
});
