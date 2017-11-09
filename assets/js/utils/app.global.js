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
        console.log(c);
        return c;
    }
};
