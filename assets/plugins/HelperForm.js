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

            //Comprobamos si el elemento es múltiple...
            if ($el.length > 1) {
                console.log("IS MULTIPLE", val);
                for (var i = 0; i < $el.length; i++) {
                    var $elTemp = $($el[i]);
                    fill($elTemp.attr('type'), $elTemp, val);
                }
            }

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
                    val = ((val != null) && ((val + '').search('<br/>')) >= 0) ? val.replace(new RegExp('<br/>', 'g'), '') : val;
                    var callback = $el.attr('data-callback');
                    if (callback) {
                        val = eval(callback + '("' + val + '", "fillForm")');
                    }
                    if ($el.is('select') && $el.find('option').length <= 1) {
                        $el.attr('data-value', val);
                        $el.on('selectfilled', function () {
                            $el = $(this);
                            var interval = window.setInterval(function () {
                                if ($el.find('option').length > 1) {
                                    clearInterval(interval);
                                } else {
                                    return;
                                }
                                $el.val($el.attr('data-value'));
                                $el.removeAttr('data-value');
                                $el.off('selectfilled');
                                if ($el.hasClass('helper-change')) {
                                    $el.trigger('change');
                                }
                                if ($el.hasClass('select2-hidden-accessible')) {
                                    $el.trigger('change.select2');
                                }
                            }, 100);
                        });
                    }
                    $el.val(val);
                    if ($el.hasClass('select2-hidden-accessible')) {
                        $el.trigger('change.select2');
                    }
            }
        };
        var finder = function (parsekey, data) {
            if (data == null) {
                return;
            }
            $.each(data, function (name, val) {
                var $el = form.find('[name="' + parsekey + name + '"]');
                var type = $el.attr('type');
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
                        y = objTemp[partes[i]];
                    } else if (i == (partes.length - 1)) {
                        if (name.indexOf('[]') >= 0) {
                            if (!Array.isArray(y[partes[i]])) {
                                y[partes[i]] = [];
                            }
                            y[partes[i]].push(val);
                        } else {
                            y[partes[i]] = val;
                        }
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
                    if (name.indexOf('[]') >= 0) {
                        if (!obj[nameEntity]) {
                            obj[nameEntity] = new Object();
                        }
                        if (!Array.isArray(obj[nameEntity][name])) {
                            obj[nameEntity][name] = [];
                        }
                        obj[nameEntity][name].push(val);
                    } else {
                        objFinal[nameEntity] = new Object();
                        objFinal[nameEntity][name] = val;
                    }
                } else {
                    if (name.indexOf('[]') >= 0) {
                        if (!Array.isArray(obj[name])) {
                            obj[name] = [];
                        }
                        obj[name].push(val);
                    } else {
                        objFinal[name] = val;
                    }
                }
            }
            __mergeObj(obj, objFinal);
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


__mergeObj = function (obj1, obj2) {
    for (var key in obj2) {
        if (typeof obj2[key] != "number" && typeof obj2[key] != "undefined" && obj2[key] != null && obj2[key].constructor()) {
            if (Array.isArray(obj2[key])) {
                if (!obj1[key]) {
                    obj1[key] = [];
                }
                for (var i = 0; i < obj2[key].length; i++) {
                    obj1[key].push(obj2[key][i]);
                }
            } else {
                if (typeof obj1[key] == "undefined") {
                    obj1[key] = new Object();
                }
                __mergeObj(obj1[key], obj2[key]);
            }
        } else {
            obj1[key] = obj2[key];
        }
    }
};
