/*
 @author: Starlly
 Creado por Starlly === http://starlly.com.
 Licencia gratuita, mantenga este encabezado de archivo para no infringir los derechos
 de autor.
 */

/**
 * Recibe un objeto y llena el formulario o contenedor que ha invocado el prototipo.
 * @param {type} obj : Recibe el objeto que se usará para llenar el formulario.
 * @returns {undefined}
 */

$.fn.fillForm = function (data) {
    if (typeof this === "object") {
        var form = $(this);
        var fill = function (type, $el, val) {
            switch (type) {
                case 'checkbox':
                    if (val == true || val == 1) {
                        $el.prop('checked', true);
                    } else {
                        $el.prop('checked', false);
                    }
                    break;
                case 'radio':
                    $el.filter('[value="' + val + '"]').attr('checked', 'checked');
                    break;
                default:
                    var callback = $el.attr('data-callback');
                    if (callback) {
                        val = eval(callback + '("' + val + '", "fillForm")');
                    }
                    $el.val(val);
            }
        };
        var finder = function (parsekey, data) {
            if (data == null) {
                return;
            }
            $.each(data, function (name, val) {
                var $el = form.find('[name="' + parsekey + name + '"]'),
                        type = $el.attr('type');
                if (typeof val === "object") {
                    finder(parsekey + "" + name + ".", val);
                } else {
                    fill(type, $el, val);
                }
            });
        };
        finder("", data);
        return form;
    } else {
        console.error("Error JJFillForm: El objeto seleccionado no es un elemento del DOM.");
    }
};

/**
 * Al invocarse desde un formulario, este prototipo obtendrá el modelo de datos en un objeto JSON.
 * @returns {Object}
 */
$.fn.getFormData = function () {
    var form = $(this);
    var fields = $(form).find("input, select, textarea");
    var obj = new Object();
    $.each(fields, function (i, $el) {
        var pushObject = function (name, val, nameEntity) {
            if (!name) {
                return;
            }
            var hasClass = typeof nameEntity === "string";
            var partes = name.split(".");
            var objTemp = new Object();
            var objFinal = null;
            var y = null;
            if (partes.length > 1) {
                for (var i = 0; i < partes.length; i++) {
                    if (i == 0) {
                        objTemp[partes[i]] = new Object();
                        y = objTemp[partes[i]]
                    } else if (i == (partes.length - 1)) {
                        y[partes[i]] = val;
                    } else {
                        y[partes[i]] = new Object();
                        y = y[partes[i]];
                    }
                }
                objFinal = new Object();
                if (hasClass) {
                    objFinal[nameEntity] = objTemp;
                } else {
                    objFinal = objTemp;
                }
            } else {
                objFinal = new Object();
                if (hasClass) {
                    objFinal[nameEntity] = new Object();
                    objFinal[nameEntity][name] = val;
                } else {
                    objFinal[name] = val;
                }
            }
            $.extend(true, obj, objFinal);
        };

        $el = $($el);
        var nameEl = $el.attr('name');
        var hasClass = (($el.attr("data-class")) ? true : false);
        var nameEntity = ((hasClass) ? $el.attr("data-class") + "." : null);
        switch ($el.attr('type')) {
            case "radio":
                var valTemp = form.find('[name="' + nameEl + '"]:checked').val();
                pushObject(nameEl, valTemp, nameEntity);
                break;
            case "checkbox":
                pushObject(nameEl, (($el.is(":checked")) ? 1 : 0), nameEntity);
                break;
            default:
                let val = $el.val();
                var callback = $el.attr('data-callback');
                if (callback) {
                    val = eval(callback + '("' + val + '", "getFormData")');
                }
                if ($el.is('select')) {
                    if ($el.attr('data-value') && val.trim() == "") {
                        val = $el.attr('data-value');
                    }
                }
                pushObject(nameEl, val, nameEntity);
                break;
        }
    });
    return obj;
};
