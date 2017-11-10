var ConstStates = {
    ADYACENCIAS_FALTANTES: 1,
    ALARMAS_DE_ENERGIA: 2,
    ALARMAS_DE_HW: 3,
    ALARMAS_DE_RX: 4,
    ALARMAS_DE_TX: 5,
    ALTO_RTWP: 6,
    CANCELADO: 7,
    DEGRADACION_KPI: 8,
    DESMONTADO: 9,
    ERROR_COMISIONAMIENTO_BTS: 10,
    ERROR_CONFIGURACION_ACCESO: 11,
    ERROR_INSTALACION: 12,
    PENDIENTE_CRQ: 13,
    PENDIENTE_EVIDENCIAS: 14,
    PENDIENTE_PRUEBAS_ALARMAS: 15,
    REVISION_PARCIAL: 17,
    SITIIO_FUERA_DE_SERVICIO: 17,
    PRECHECK: 18,
    REINICIO_12H: 19,
    REINICIO_PRECHECK: 20,
    SEGUIMIENTO_12H: 21,
    SEGUIMIENTO_24H: 22,
    SEGUIMIENTO_36H: 23,
    ACTIVACION_CUARTA_PORTADORA: 24,
    PENDIENTE_ID_RF_TOOLS: 25,
    PENDIENTE_SITIO_LIMPIO: 26,
    PENDIENTE_TAREAS_REMEDY: 27,
    PENDIENTE_TESTGESTION: 28,
    PRODUCCION: 29,
    TEMPORAL: 30
};
var app = {
    urlbase: $('body').attr('data-base').trim('/') + '/',
    validResponse: function (response) {
        switch (response.code) {
            case 1:
                response = response;
                break;
            case 0:
                response = response;
                break;
            case - 1:
                response = false;
                break;
            default :
                if (response.code < 0) {
                    response = false;
                } else {
                    response = response;
                }
                break;

        }
        return response;
    },
    urlTo: function (url) {
        return app.urlbase + url;
    },
    successResponse: function (response) {
        return response.code > 0;
    },
    parseResponse: function (response) {
        var data = app.validResponse(response);
        if (data) {
            return data.data;
        } else {
            return false;
        }
    },
    stopEvent: function (e) {
        if (e) {
            if (e.preventDefault) {
                e.preventDefault();
            }
            if (e.stopPropagation) {
                e.stopPropagation();
            }
            if (!!e.returnValue) {
                e.returnValue = false;
            }
        }
        return;
    },
    /**
     *
     * @param {String} url
     * @param {Object} data
     * @param {function} success
     * @param {function} error
     * @param {function} before
     * @param {function} complete
     */
    get: function (url, data, success, error, before, complete) {
        var ajax = app.getObjectAjax(url, data, success, error, "GET", before, complete);
        return $.extend({ajax: ajax}, app.methods);
    },
    /**
     * @param {String} url
     * @param {Object} data
     * @param {function} success
     * @param {function} error
     * @param {function} before
     * @param {function} complete
     */
    post: function (url, data, success, error, before, complete) {
        var ajax = app.getObjectAjax(url, data, success, error, "POST", before, complete);
        return $.extend({ajax: ajax}, app.methods);
        //app.ajax(ajax);
    },
    methods: {
        before: function (callback) {
            this.ajax.before = callback;
            return this;
        },
        complete: function (callback) {
            this.ajax.complete = callback;
            return this;
        },
        success: function (callback) {
            this.ajax.success = callback;
            return this;
        },
        error: function (callback) {
            this.ajax.error = callback;
            return this;
        },
        send: function () {
            app.ajax(this.ajax);
        }
    },
    getObjectAjax(url, data, success, error, method, before, complete) {
        var ajax = new Object();
        ajax.url = url;
        ajax.data = data;
        ajax.type = method;
        ajax.success = success;
        ajax.error = (error) ? error : app.ajaxError;
        ajax.beforeSend = (before) ? before : app.beforeSend;
        ajax.complete = (complete) ? complete : null;
        return ajax;
    },
    beforeSend: function (data) {
    },
    ajax: function (args) {
        var ajax = new Object();
        ajax.url = (app.urlbase + args.url);
        ajax.type = (args.type) ? args.type : "POST";
        ajax.data = (args.data);
        ajax.dataType = (args.dataType) ? args.dataType : "json";
//        ajax.beforeSend = (args.beforeSend) ? args.beforeSend : app.beforeSend;
        ajax.complete = args.complete;
        ajax.success = (args.success);
        ajax.error = (args.error) ? args.error : app.error;
        $.ajax(ajax);
    },
    error: function (error) {
//        __dom.imprimirToast("Error", "Se ha producido un error, "
//                + "compruebe su conexión, reintenlo o de lo contrario contacte "
//                + "el administrador.", "error");
    },
    formToJSON: function (formArray) {
        var returnArray = {};
        for (var i = 0; i < formArray.length; i++) {
            returnArray[formArray[i]['name']] = formArray[i]['value'];
        }
        return returnArray;
    },
    getParamURL: function (param) {
        var url = new URL(location.href);
        var c = url.searchParams.get(param);
        return c;
    }
};
