$(function () {
    var principal = {
        init: function () {
            principal.events();
            principal.listActivities();
        },
        //Eventos de la ventana.
        events: function () {

        },
        /**
         * Listará las actividades de los usuarios que ingresan al sistema...
         */
        listActivities: function () {
            //Invoca fillTable para configurar la TABLA.
            // principal.fillTable([]);
            //Realiza la petición AJAX para traer los datos...
            var alert = dom.printAlert('Consultando registros, por favor espere.', 'loading', $('#principalAlert'));
            app.post('Precheck/getListPrecheckCoordinador')
                    .complete(function () {
                        alert.hide();
                        $('.contentPrincipal').removeClass('hidden');
                    })
                    .success(function (response) {
                        if (app.successResponse(response)) {
                            principal.fillTablePending(response.data.pendingList);
                            principal.fillTableAssing(response.data.assingList);
                        } else {
                            principal.fillTable([]);
                        }
                    }).error(function (e) {
                console.error(e);
            }).send();
        },
        //Temporalmente...
        fillNA: function () {
            return "N/A";
        },
        getButtonsPending: function (obj) {
            return '<div class="btn-group">'
                    + '<a href="' + app.urlTo('User/trackingDetails?id=' + obj.k_id_onair) + '" class="btn btn-default btn-xs" data-toggle="tooltip" title="Detalle"><span class="fa fa-fw fa-eye"></span></a>'
                    + '<a href="' + app.urlTo('User/assignEngineer?idOnair=' + obj.k_id_onair) + '" class="btn btn-default btn-xs" data-toggle="tooltip" title="Asignar"><span class="fa fa-fw fa-sign-in"></span></a>'
                    + '</div>';
        },
        getButtonsAssing: function () {
            return '<div class="btn-group">'
                    + '<a href="' + app.urlTo('User/trackingDetails') + '" class="btn btn-default btn-xs" data-toggle="tooltip" title="Detalle"><span class="fa fa-fw fa-eye"></span></a>'
                    + '</div>';
        },
        fillTablePending: function (data) {
            if (principal.tablaPendientes) {
                dom.refreshTable(principal.tablaPendientes, data);
                return;
            }
            principal.tablaPendientes = $('#tablaPendientes').DataTable(dom.configTable(data,
                    [
                        {title: "Estación", data: "k_id_station.n_name_station"},
                        {title: "Tipo de trabajo", data: 'k_id_work.n_name_ork'},
                        {title: "Estado", data: 'k_id_status_onair.k_id_status.n_name_status'},
                        //Este campo no está trayendo nada...
                        {title: "SubEstado", data: 'k_id_status_onair.k_id_substatus'},
                        {title: "Tiempo", data: 'k_id_precheck'},
                        {title: "Tecnologia", data: 'k_id_technology.n_name_technology'},
                        {title: "Banda", data: 'k_id_band.n_name_band'},
                        {title: "Encargado", data: principal.fillNA},
                        {title: "Opciones", data: principal.getButtonsPending},
                    ]
                    ));
        },
        fillTableAssing: function (data) {
            if (principal.tablaAsignados) {
                dom.refreshTable(principal.tablaAsignados, data);
                return;
            }
            principal.tablaAsignados = $('#tablaAsignados').DataTable(dom.configTable(data,
                    [
                        {title: "Estación", data: "k_id_station.n_name_station"},
                        {title: "Tipo de trabajo", data: 'k_id_work.n_name_ork'},
                        {title: "Estado", data: 'k_id_status_onair.k_id_status.n_name_status'},
                        //Este campo no está trayendo nada...
                        {title: "SubEstado", data: 'k_id_status_onair.k_id_substatus'},
                        {title: "Tiempo", data: 'k_id_precheck'},
                        {title: "Tecnologia", data: 'k_id_technology.n_name_technology'},
                        {title: "Banda", data: 'k_id_band.n_name_band'},
                        {title: "Encargado", data: principal.fillNA},
                        {title: "Opciones", data: principal.getButtonsAssing},
                    ]
                    ));
        },
    };

    principal.init();
});
