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
        vista.get();
    },
    events: function () {
        $('form').on('submit', vista.onSumitForm);
        $('.control-change').on('change', vista.onControlChange);
    },
    onControlChange: function () {
        var formGlobal = $('#formGlobalAcs');
        var control = $(this);
        var name = control.attr('name');
        var controls = formGlobal.find('[name="' + name + '"]');
        controls.val(control.val()).trigger('change.select2');
    },
    configView: function () {
        dom.llenarCombo($('.select-banda'), dataForm.bands.data, {text: "n_name_band", value: "k_id_band"});
        dom.llenarCombo($('.select-tecnologia'), dataForm.technologies.data, {text: "n_name_technology", value: "k_id_technology"});
        dom.llenarCombo($('.select-tipotrabajo'), dataForm.works.data, {text: "n_name_ork", value: "k_id_work"});
        dom.llenarCombo($('.select-estacion'), dataForm.stations.data, {text: "n_name_station", value: "k_id_station"});
        dom.llenarCombo($('.select-ingeniero'), dataForm.users.data, {text: "n_name_user", value: "k_id_user"});
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
                formGlobal.attr('data-mode', "FOR_UPDATE");
                formGlobal.fillForm(data);
                vista.listCausas(data.causas);
                formGlobal.find('button:submit').html('<i class="fa fa-fw fa-save"></i> Actualizar');
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

        //Validación cehceklist...
        if ((form.attr('id')) == "form1" && (!validateChecklist(form1))) {
            swal("Error", "Debe completar el checklist.", "error");
            return;
        }

        if ((form.attr('id')) == "form2" && (!validateChecklist(form2))) {
            swal("Error", "Debe completar el checklist.", "error");
            return;
        }

        //Si todo ha salido bien construimos el objeto y nos preparamos para insertar...

        var obj = new Object();
        __mergeObj(obj, form1.getFormData());
        __mergeObj(obj, form2.getFormData());
        __mergeObj(obj, form3.getFormData());
        __mergeObj(obj, form4.getFormData());

        var formGlobal = $('#formGlobalAcs');
        var uri = formGlobal.attr('data-action');
        var forInsert = true;
        if (formGlobal.attr('data-mode') == "FOR_UPDATE") {
            uri = form.attr('data-action-update');
            forInsert = false;
        }

        //Realizamos la petición ajax...
        formGlobal.find('fieldset, input, textarea, button, fieldset, select').prop('disabled', true);
        app.post(uri, obj)
                .complete(function () {
                    formGlobal.find('fieldset, input, textarea, button, fieldset, select').prop('disabled', false);
                })
                .success(function (response) {
                    var v = app.successResponse(response);
                    if (v) {
                        swal("Guardado", "Se ha " + ((forInsert) ? "registrado" : "actualizado") + " el registro correctamente.", "success");
                    } else {
                        swal("Lo sentimos", "No se pudo " + ((forInsert) ? "insertar" : "actualizar") + " el registro.", "error");
                    }
                })
                .error(function () {
                    swal("Error inesperado", "Se ha producido un error al " + ((forInsert) ? "insertar" : "actualizar") + " el registro.", "error");
                });

        console.log(obj);
    }
};
$(function () {
    vista.init();
});