$(function () {
    var ini = {
        timers: [],
        init: function () {
            ini.events();
            ini.listActivities();
        },
        //Eventos de la ventana.
        events: function () {

        },
        /**
         * Listará las actividades de los usuarios que ingresan al sistema...
         */
        listActivities: function () {
            //Invoca fillTable para configurar la TABLA.
            // ini.fillTable([]);
            //Realiza la petición AJAX para traer los datos...
            var alert = dom.printAlert('Consultando registros, por favor espere.', 'loading', $('#principalAlert'));
            app.post('Acs/getAllVm')
                    .complete(function () {
                        alert.hide();
                        $('.contentPrincipal').removeClass('hidden');
                    })
                    .success(function (response) {
                        console.log(response);
                        if (app.successResponse(response)) {
                            ini.fillTable(response.data);
                        } else {
                            ini.fillTable([]);
                        }
                    }).error(function (e) {
                console.error(e);
            }).send();
        },
        //Temporalmente...
        fillNA: function () {
            return "N/A";
        },
        getButtons: function (obj) {

            var m = "";
            if (obj.k_control_asinado) {
                if (obj.k_control_asinado === "0") {
                    m = "style= 'display: none'";
                }
            }
            return '<div class="btn-group">'
                    + '<a href="' + app.urlTo('Control/findControlById?idControl=' + obj.k_id_control) + '" class="btn btn-default btn-xs" data-toggle="tooltip" title="Editar Control"><span class="fa fa-fw fa-pencil-square-o"></span></a>'
                    + '<a onclick="showModalqualificationControls(\'' + obj.k_id_control + '\')" class="btn btn-default btn-xs" data-toggle="tooltip" title="ver Riesgos Asociados"' + m + '><span class="fa fa-fw fa-list-ul"></span></a>'
                    + '</div>';
        },
        fillTable: function (data) {
            if (ini.tablaPrincipal) {
                dom.refreshTable(ini.tablaPrincipal, data);
                return;
            }
            ini.tablaPrincipal = $('#tablaVm').DataTable(dom.configTable(data,
                    [
                        {title: "Id ZTE", data: "k_id_vm"},
                        {title: "Site Acces", data: "i_id_site_access"},
                        {title: "Estación", data: "n_name_station"},
                        {title: "tecnología", data: "n_name_technology"},
                        {title: "Tipo Trabajo", data: "n_name_ork"},
                        {title: "Banda", data: "n_name_band"},
                        {title: "Estado", data: "n_estado_vm"},
                        {title: "SubEstado", data: "n_sub_estado"},
                        {title: "Est. Notificación", data: ini.fillNA},
                        {title: "Tipo Falla Final", data: "n_falla_final"},
                        {title: "Ing. Crea Grupo", data: "ingeniero_creador_grupo"},
                        {title: "Ing. Apertura", data: "ingeniero_apertura"},
                        {title: "Ing. Punto Control", data: "i_ingeniero_control"},
                        {title: "Ing. Cierre", data: "ingeniero_cierre"},
                        {title: "VM hoy", data: ini.fillNA},
                        {title: "Opciones", data: ini.getButtons},
                    ],
                    ));
        }

    };

    ini.init();
});