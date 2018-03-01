var dom = {
//Para agregar todas las interacciones del dom genericas.
    init: function () {
        try {
            $('body').on('click', '.alert .close', function () {
                $(this).parent().hide();
            });
            $('[data-toggle="tooltip"]').tooltip();
            $('.container.autoheight').css('min-height', screen.height + 'px');
            dom.events();
        } catch (e) {
        }
    },
    events: function () {
        //Configuración panel.
        $(document).on('click', '.panel .panel-heading .panel-title a', function () {
            var link = $(this);
            var panel = link.parents('.panel');
            panel.parents('.panel-group').find('.panel-primary').attr('class', 'panel panel-default');
            if (link.attr('aria-expanded') == "true") {
                panel.attr('class', 'panel panel-primary');
            }
        });
        //Steps...
        $('.stepwizard-step a').on('click', function (e) {
            app.stopEvent(e);
            var step = $(this);
            var content = step.parents('.stepwizard').parent();
            var stepPanel = content.find('.step-panel' + step.attr('href'));
            content.find('.stepwizard-step a').attr('class', 'btn btn-default btn-circle');
            step.attr('class', 'btn btn-primary btn-circle');
            content.find('.step-panel').addClass('hidden');
            stepPanel.removeClass('hidden').hide().fadeIn(500);
        });
        //Shortcuts...
        var keyPrev = null;
        window.addEventListener('keydown', function (e) {
            var isKey = function (e, code) {
                return e.which == code || e.keyCode == code;
            };
            if (keyPrev == 17) { //Tecla Control.
                if (isKey(e, 81)) {//Q = Quit - Salir...
                    location.href = $('#exitLink').attr('href');
                }
            }
            keyPrev = (e.which) ? e.which : e.keyCode;
        });
    },
    /**
     *
     * @param {Element} cmb
     * @param {Array} array
     * @param {Object} keyNames : Ej: {text:"keyName", value:"keyName"}; value también soporta un array para concatenar keyNames,
     * @returns {undefined}
     */
    llenarCombo: function (cmb, array, keyNames) {
        window.setTimeout(function () {
            cmb.html("");
            cmb.append(new Option("Selecciona", ""));
            if (Array.isArray(array) && array.length > 0) {
                for (var i = 0; i < array.length; i++) {
                    var dato = array[i];
                    var value = "";
                    if (Array.isArray(keyNames.text)) {
                        var keys = keyNames.text.length;
                        for (var j = 0; j < keys; j++) {
                            value += dato[keyNames.text[j]] + ((j < (keys - 1)) ? " " : "");
                        }
                    } else {
                        value = dato[keyNames.text];
                    }
                    cmb.append(new Option(value, dato[keyNames.value]));
                }
            } else {
                dom.comboVacio(cmb);
            }
            cmb.select2({width: "100%"});
            cmb.trigger('select2fill');
            cmb.trigger('selectfilled');
        }, 10);
    },
    /**
     * Llenará un <select> con una opción No hay registros.
     * @param {type} cmb
     */
    comboVacio: function (cmb) {
        cmb.html("");
        cmb.append(new Option("No hay registros", "-1"));
    },
    /**
     *
     * @param {type} mensaje
     * @param {type} tipo
     * @param {type} alerta
     * @returns alert with methods...
     */
    printAlert: function (message, tipo, alerta) {
        var icon = function (tipo) {
            switch (tipo) {
                case 'success':
                    return '<i class="fa fa-fw fa-info-circle"></i> ';
                case 'loading':
                    return '<i class="fa fa-fw fa-refresh fa-spin"></i> ';
                case 'danger':
                    return '<i class="fa fa-fw fa-times-circle"></i> ';
                default:
                    return '<i class="fa fa-fw fa-warning"></i> ';
            }
        };
        alerta.find('#text').html(icon(tipo) + message);
        tipo = (tipo == 'loading') ? 'info' : tipo;
        alerta.attr('class', 'alert alert-' + tipo + ' alert-dismissable');
        alerta.hide().slideDown(500);
        return {
            print: function (message, tipo) {
                alerta.find('#text').html(icon(tipo) + message);
                alerta.attr('class', 'alert alert-' + tipo + ' alert-dismissable');
            },
            clear: function () {
                alerta.find('#text').html("");
            },
            add: function (message) {
                if (alerta.find('ul').length == 0) {
                    alerta.find('#text').html("<ul></ul>");
                }
                alerta.find('#text ul').append('<li>' + icon(tipo) + message + '</li>');
            },
            hide: function () {
                alerta.hide();
            },
            show: function () {
                alerta.slideDown(500);
            }
        };
    },
    alertControl: function (response, alert, hideOnSuccess) {
        if (app.successResponse(response)) {
            if (hideOnSuccess != true) {
                dom.printAlert(response.message, 'success', alert);
            } else {
                alert.addClass('hidden').hide();
            }
        } else
        if (response.code == 0) {
            dom.printAlert(response.message, 'warning', alert);
        } else {
            dom.printAlert(response.message, 'danger', alert);
        }
        return alert;
    },
    alertError: function (alert) {
        var messageError = 'Se ha producido un error desconocido, por favor compruebe su conexión a internet y vuelva a intenarlo nuevamente.';
        dom.printAlert(messageError, 'danger', alert);
    },
    parseTime: function (time) {
        if (typeof time === "string") {
            var parts = time.split(':');
            var h = parts[0];
            var m = parts[1];
            if (m == 60) {
                h = parseInt(h) + 1;
                m = 0;
            }
            return ((h < 10) ? '0' + h : h) + ':' + ((m < 10) ? '0' + m : m);
        } else {
            return "00:00";
        }
    },
    betweenHours: function (hms_inicio, hms_fin, hms_referencia) {
        hms_inicio = formatDate(hms_inicio, 'HH:mm:ss');
        hms_fin = formatDate(hms_fin, 'HH:mm:ss');
        hms_referencia = formatDate(hms_referencia, 'HH:mm:ss');
//        console.log(hms_referencia);
        var h, m, s;
        //HORA INICIO.
        hms_inicio = hms_inicio.split(/[^\d]+/);
        h = hms_inicio[0];
        m = hms_inicio[1];
        s = hms_inicio[2];
        s_inicio = 3600 * h + 60 * m + s;
        //HORA FIN.
        hms_fin = hms_fin.split(/[^\d]+/);
        h = hms_fin[0];
        m = hms_fin[1];
        s = hms_fin[2];
        var s_fin = 3600 * h + 60 * m + s;
        //HORA REFERENCIA.
        hms_referencia = hms_referencia.split(/[^\d]+/);
        h = hms_referencia[0];
        m = hms_referencia[1];
        s = hms_referencia[2];
        var s_referencia = 3600 * h + 60 * m + s;
        if (s_inicio <= s_fin) {
            return s_referencia >= s_inicio && s_referencia <= s_fin;
        } else {
            return s_referencia >= s_inicio || s_referencia <= s_fin;
        }
    },
    mathTimer: function (time) {
        var diffMs = time; // Milisegundos entre la fecha y hoy.
        var diffHrs = Math.floor(Math.abs(diffMs) / 36e5); // hours
        var diffMins = Math.round(((diffMs % 86400000) % 3600000) / 60000); // minutes
        if (diffHrs < 0) {
            diffHrs *= -1;
        }
        if (diffMins < 0) {
            diffMins *= -1;
        }
        return diffHrs + ":" + diffMins;
    },
    timesInLimit: 0,
    timeForNotifyLimit: 1,
    /**
     * Crea un timer de tiempo en el emento que se le atribulla.
     * @param {Elem} element : El elemento donde actuará el timer...
     * @param {Long} time : La fecha en la que inició el proceso...
     * @param {Elem} progressElement : El elemento progress del timer...
     * @returns {undefined}
     */
    timer: function (element, progressElement, callback, obj) {
        var timeInterval = (1000 * 60);
        var timeInit = obj.time;
        var time = obj.i_timestamp;
        var timeTotal = obj.i_timetotal;
        var state = obj.i_state;
        var percentValue = obj.i_percent;
        var today = obj.today;
        var interval = null;
        if (typeof callback === "function" && (state == "CHANGE_FASE")) {
            location.reload();
        }

        var parent = element.parents('.hour-step');
        if (state == 3) {
            progressElement.css('width', 100 + '%');
            parent.removeClass('prorroga').addClass('escalado');
            parent.addClass('warning');
            element.html('<span class="text-danger"><i class="fa fa-fw fa-undo"></i> Escalado</span>');
            return;
        }

        var parseTimer = function (time, element, progress, progressValue) {
            if (element.length == 0) {
                window.clearInterval(interval);
                interval = null;
                return;
            }

            var parent = element.parents('.hour-step');
            if (element) {
                if (parent.hasClass('finish')) {
                    window.clearInterval(interval);
                }
                if (state == 1) {
                    parent.addClass('warning');
                }
                if (state != 2 && element.hasClass('prorroga')) {
                    window.clearInterval(interval);
                    interval = null;
                    return;
                }
                if (state == 2) {
                    var parent = element.parents('.hour-step');
                    parent.removeClass('warning').addClass('prorroga');
                }
                if (progressValue < 100) {
                    element.html('<i class="fa fa-fw fa-clock-o"></i> -' + dom.parseTime(dom.mathTimer(time)));
                } else {
                    progressValue = 100;
                    element.parents('.hour-step').addClass('warning');
                    element.html('<span class="text-danger" title="Excedido"><i class="fa fa-fw fa-warning"></i> ' + dom.parseTime(dom.mathTimer(obj.i_timeexceeded)) + '</span>');
                    if (interval != null) {
                        window.clearInterval(interval);
                        interval = window.setInterval(function () {
                            obj.i_timeexceeded += (1000 * 60);
                            element.html('<span class="text-danger" title="Excedido"><i class="fa fa-fw fa-warning"></i> ' + dom.parseTime(dom.mathTimer(obj.i_timeexceeded)) + '</span>');
                        }, timeInterval);
                        //Se crea otra vez el intervalo para las 3 horas.
                    }
                    if (typeof callback === "function" && (state == 0 || state == 2)) {
                        callback();
                    }
//                    if (state == 1) {
//                        element.html('<span class="text-danger"><i class="fa fa-fw fa-warning"></i> Tiempo agotado</span>');
//                    }
                }
            }
            if (progress) {
                progress.css('width', progressValue + '%');
            }
        };
        var timeRecord = time;
        var timePaused = false;
//        var timeProgress = time;
//        percentValue = (percentValue == 0) ? 1 : percentValue;
//        var timeTotal = ((time / percentValue) * 100);

        var refresh = function () {
            var mathTime = (1000 * 60);
            today += mathTime;
            var v = dom.betweenHours(new Date('01/01/2017 06:00'), new Date('01/01/2017 18:00'), new Date(today));
//            var hrs = 0;
//            var hour = formatDate(new Date(today), 'HH');
            if (!v) {
                timePaused = true;
                return;
            }
            if (timePaused) {
                location.reload();
            }
//            timeProgress += (1000 * 60);
//            percentValue = (timeProgress / timeTotal) * 100;

            percentValue = Math.round(((today - timeInit) / (timeTotal - timeInit)) * 100);
            timeRecord -= mathTime;
            parseTimer(timeRecord, element, progressElement, percentValue);
        };
        //Número de tiempos al límite...
        if (element) {
            element.html('<i class="fa fa-fw fa-refresh fa-spin"></i> --:--');
        }
        parseTimer(time, element, progressElement, percentValue);
        //Creamos el intervalo a un minuto...
        interval = window.setInterval(function () {
            refresh();
        }, timeInterval);
    },
    configCalendar: function (control, fechaInicio, fechaFin, fechaDefecto, btnToday) {
        control.datepicker('remove');
        control.mask("99/99/9999");
        control.attr('placeholder', 'DD/MM/AAAA');
        var args = {
            format: 'dd/mm/yyyy',
            weekStart: 1,
            todayBtn: (btnToday) ? 'linked' : false,
            clearBtn: false,
            language: 'es',
            calendarWeeks: true,
            autoclose: true,
            todayHighlight: true
        };
        if (!!fechaInicio) {
            args.startDate = fechaInicio;
        }
        if (!!fechaFin) {
            args.endDate = fechaFin;
        }
        if (!!fechaDefecto) {
            args.defaultViewDate = fechaDefecto;
            control.val(fechaDefecto);
        }

        control.parents(".input-group").find("button").attr('type', 'button').on('click', function () {
            control.trigger("focus");
        });
        if (control.parent('.input-group.date').length > 0) {
            return control.parent('.input-group.date').datepicker(args);
        }

        return control.datepicker(args);
    },
    scrollTop: function () {
        $("html, body").animate({scrollTop: 0}, "slow");
    },
    controlSubmit: function (form, callback, clearForm) {
        form.find('fieldset').prop('disabled', true);
        btnSubmit = form.find('button[type="submit"]');
        btnSubmit.prop('disabled', true);
        btnSubmit.find('.fa-save').attr('class', 'fa fa-fw fa-refresh fa-spin');
        var obj = form.getFormData();
        var ajax = null;
        dom.printAlert("Enviando, por favor espere...", 'loading', form.find('.alert'));
        ajax = app.post(form.attr('action'), obj);
        ajax.complete(function () {
            form.find('fieldset').prop('disabled', false);
            btnSubmit.prop('disabled', false);
            form.find('button[type="submit"] .fa-refresh.fa-spin').attr('class', 'fa fa-fw fa-save');
        }).success(function (response) {
            if (app.successResponse(response)) {
                dom.printAlert(response.message, 'success', form.find('.alert'));
                if (clearForm != false) {
                    form.find('input:not([type="hidden"]),textarea,select').val('');
                    form.find('select.select2-hidden-accessible').trigger('change.select2');
                }
                if (typeof callback === "function") {
                    callback(response);
                }
            } else {
                dom.printAlert(response.message, 'danger', form.find('.alert'));
            }
        }).error(function (e) {
//            console.error(e);
            dom.alertError(form.find('.alert'));
        });
        return ajax;
    },
    submitDirect: function (form, callback, clearForm) {
        dom.controlSubmit(form, callback, clearForm).send();
    },
    /**
     * 
     * @param {type} form
     * @param {type} callback
     * @param {type} clearForm = Recibe falso, cuando no quiera limpiar...
     * @returns {undefined}
     */
    submit: function (form, callback, clearForm) {
        form.validate();
        var onSubmitForm = function (e) {
            if (e.isDefaultPrevented())
            {
                return;
            }
            app.stopEvent(e);
            var form = $(this);
            dom.submitDirect(form, callback, clearForm);
        };
        form.on('submit', onSubmitForm);
    },
    fillString: function (dom, obj) {
        var getKeyPart = function (keyPart, key) {
            if (keyPart.trim("") != "") {
                keyPart += "." + key;
            } else {
                keyPart = key;
            }
            return keyPart;
        };
        var getValueFromObjet = function (obj, keyPart) {
            for (var key in obj) {
                //Evalua si el atributo actual es un objeto...
                var o = obj[key];
                if (typeof o === "object") {
                    getValueFromObjet(o, getKeyPart(keyPart, key));
                } else {
                    keyTemp = getKeyPart(keyPart, key);
                    var reg = new RegExp("{" + keyTemp + "}", "g");
                    dom = dom.replace(reg, o);
                }
            }
        };
        getValueFromObjet(obj, "");
        return dom;
    },
    configTable: function (data, columns, onDraw) {
        return {
            data: data,
            columns: columns,
            "language": {
                "url": app.urlbase + "assets/plugins/datatables/lang/es.json"
            },
            columnDefs: [{
                    defaultContent: "",
                    targets: -1,
                    orderable: false,
                }],
            order: [[1, 'asc']],
            drawCallback: onDraw
        }
    },
    refreshTable: function (tabla, data) {
        tabla.clear().draw();
        tabla.rows.add(data);
        tabla.columns.adjust().draw();
    },
    notify: {
        asignar: function () {
            swal({
                title: "NUEVAS ASIGNACIONES!!",
                text: "Tienes nuevas asignaciones pendientes.",
                icon: "info",
                button: "Aceptar",
            });
        },
        vencimiento: function () {
            swal({
                title: "TICKETS POR VENCER!!",
                text: "Tienes tickets que estan apunto de vencer.",
                icon: "warning",
                button: "Aceptar",
            });
        },
        nuevas: function () {
            swal({
                title: "NUEVOS TICKETS!!",
                text: "Tienes nuevos tickes para asignar",
                icon: "info",
                button: "Aceptar",
            });
        }

    },
    parsearFecha: function (fecha) {
        return fecha.slice(0, 10).split('-').reverse().join().replace(/\,/g, '/');
    },
    /**
     * Recibe una fecha string y la parsea en el formato yyyy-MM-dd
     * @param {type} dateString
     * @returns fecha en formato yyyy-MM-dd
     */
    formatDate(dateString, method) {
        if (dateString && dateString.trim() != "") {
            if (method === "month") {
//dateString, outputFormat, inputFormat...            
                return formatDate(dateString, 'dd/NNN/yyyy', 'yyyy/MM/dd');
            } else if (method === "fillForm") {
//dateString, outputFormat, inputFormat...            
                return formatDate(dateString, 'dd/MM/yyyy', 'yyyy/MM/dd');
            } else if (method === "getFormData") {
//dateString, outputFormat, inputFormat...
                return formatDate(dateString, 'yyyy-MM-dd', 'dd/MM/yyyy');
            }
        } else {
            return "Indefinido";
        }
    },
    formatDateForPrint(dateString, method) {
        if (dateString && dateString.trim() != "") {
            if (method === "fillForm") {
                //dateString, outputFormat, inputFormat...            
                return formatDate(dateString, "yyyy-MM-ddTHH:mm", "yyyy-MM-dd HH:mm");
            } else if (method === "getFormData") {
                return dateString;
            }
        } else {
            return "Indefinido";
        }
    },
    confirmar: function (texto, callbackconfirm, callbackcancel, close) {
        swal({
            title: "Confirmar",
            text: texto,
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Confirmar",
            cancelButtonText: "Cancelar",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            closeOnConfirm: ((close === false) ? false : true),
            closeOnCancel: ((close === false) ? false : true)
        }).then(function (isConfirm) {
            if (isConfirm.value) {
                if (typeof callbackconfirm === "function") {
                    callbackconfirm();
                }
            } else {
                if (typeof callbackcancel === "function") {
                    callbackcancel();
                }
            }
        });
    },
};
$(function () {
    dom.init();
});
