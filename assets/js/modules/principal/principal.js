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
            app.post('TicketOnair/listTicketOnair')
                    .complete(function () {
                        alert.hide();
                        $('.contentPrincipal').removeClass('hidden');
                    })
                    .success(function (response) {
                        console.log(response);
                        if (app.successResponse(response)) {
                            principal.fillTable(response.data);
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
        getButtons: function () {
            return '<div class="btn-group">'
                    + '<a href="#" class="btn btn-default btn-xs" data-toggle="tooltip" title="Detalle"><span class="fa fa-fw fa-eye"></span></a>'
                    + '<a href="#" class="btn btn-default btn-xs" data-toggle="tooltip" title="Documentación"><span class="fa fa-fw fa-file-archive-o"></span></a>'
                    + '<a href="' + app.urlTo('User/toAssign') + '" class="btn btn-default btn-xs" data-toggle="tooltip" title="Asignar"><span class="fa fa-fw fa-sign-in"></span></a>'
                    + '</div>';
        },
        fillTable: function (data) {
            if (principal.tablaPrincipal) {
                dom.refreshTable(principal.tablaPrincipal, data);
                return;
            }
            principal.tablaPrincipal = $('#tablaPrincipal').DataTable(dom.configTable(data,
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
                        {title: "Opciones", data: principal.getButtons},
                    ]
                    ));
        },
    };

    principal.init();
});
