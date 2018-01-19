$(function () {
    var ini = {
        timers: [],
        init: function () {
            ini.events();
            ini.listVmAssigned();
        },
        //Eventos de la ventana.
        events: function () {

        },
        /**
         * Listará las actividades de los usuarios que ingresan al sistema...
         */
        listVmAssigned: function () {
            //Invoca fillTable para configurar la TABLA.
            // ini.fillTable([]);
            //Realiza la petición AJAX para traer los datos...
            var alert = dom.printAlert('Consultando registros, por favor espere.', 'loading', $('#principalAlert'));
            app.post('Acs/getVmAssigned')
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
            return '<div class="btn-group">'
                    + '<a href="' + app.urlTo('Acs/vmAcs?id=' + obj.k_id_vm) + '" class="btn btn-default btn-xs" data-toggle="tooltip" title="Editar Ventana"><span class="fa fa-fw fa-pencil-square-o"></span></a>'
                    + '</div>';
        },
        fillTable: function (data) {
            if (ini.tablaAsignaciones) {
                dom.refreshTable(ini.tablaAsignaciones, data);
                return;
            }
            ini.tablaAsignaciones = $('#tablaAsignaciones').DataTable(dom.configTable(data,
                    [
                        {title: "Id ZTE", data: "k_id_vm"},
                        {title: "Site Acces", data: "i_id_site_access"},
                        {title: "Estación", data: "n_name_station"},
                        {title: "tecnología", data: "n_name_technology"},
                        {title: "Tipo Trabajo", data: "n_name_ork"},
                        {title: "Banda", data: "n_name_band"},
                        {title: "Fase Actual", data: "n_fase_ventana"},
                        {title: "Opciones", data: ini.getButtons},
                    ],
                    ));
        }
    };

    ini.init();
});