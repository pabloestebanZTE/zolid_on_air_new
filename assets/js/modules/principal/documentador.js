$(function () {
    vista = {
        timers: [],
        init: function () {
            vista.events();
            $('.contentPrincipal').removeClass('hidden');
            vista.getPriorityList();
            vista.getTracingList();
            vista.getRestartList();
//            vista.listActivities();
        },
        getPriorityList: function () {
            $('#tablaPrioritarios').DataTable({
                columns: [
                    {title: "Estación", data: "k_id_station.n_name_station"},
                    {title: "Tipo de trabajo", data: 'k_id_work.n_name_ork'},
                    {title: "Estado", data: 'k_id_status_onair.k_id_status.n_name_status'},
                    {title: "SubEstado", data: 'k_id_status_onair.k_id_substatus.n_name_substatus'},
                    {title: "Tiempo", data: vista.setTimer},
                    {title: "Tecnologia", data: 'k_id_technology.n_name_technology'},
                    {title: "Banda", data: 'k_id_band.n_name_band'},
                    {title: "Fecha Creacion Onair", data: 'k_id_preparation.d_ingreso_on_air'},
                    {title: "Fecha Última revisión", data: 'd_fecha_ultima_rev'},
                    {title: "Encargado", data: function (obj) {
                            if (typeof obj.i_actualEngineer == "string") {
                                return obj.i_actualEngineer;
                            } else {
                                return obj.i_actualEngineer.n_name_user + " " + obj.i_actualEngineer.n_last_name_user;
                            }
                        }},
                    {title: "Opciones", data: vista.getButtons},
                ],
                "language": {
                    "url": app.urlbase + "assets/plugins/datatables/lang/es.json"
                },
                columnDefs: [{
                        defaultContent: "",
                        targets: 0,
                        orderable: false,
                    }],
                order: [[1, 'asc']],
                "bProcessing": true,
                "serverSide": true,
                drawCallback: vista.runTimers,
                "ajax": {
                    url: app.urlTo("TicketOnair/getPriorityList"), // json datasource
                    type: "get", // type of method  , by default would be get
                    error: function () {  // error handling code
                        $("#employee_grid_processing").css("display", "none");
                    }
                }
            });
        },
        getTracingList: function () {
            $('#tablaPrincipal').DataTable({
                columns: [
                    {title: "Estación", data: "k_id_station.n_name_station"},
                    {title: "Tipo de trabajo", data: 'k_id_work.n_name_ork'},
                    {title: "Estado", data: 'k_id_status_onair.k_id_status.n_name_status'},
                    {title: "SubEstado", data: 'k_id_status_onair.k_id_substatus.n_name_substatus'},
                    {title: "Tiempo", data: vista.setTimer},
                    {title: "Tecnologia", data: 'k_id_technology.n_name_technology'},
                    {title: "Banda", data: 'k_id_band.n_name_band'},
                    {title: "Fecha Creacion Onair", data: 'k_id_preparation.d_ingreso_on_air'},
                    {title: "Fecha Última revisión", data: 'd_fecha_ultima_rev'},
                    {title: "Encargado", data: 'i_actualEngineer'},
                    {title: "Opciones", data: vista.getButtons},
                ],
                "language": {
                    "url": app.urlbase + "assets/plugins/datatables/lang/es.json"
                },
                columnDefs: [{
                        defaultContent: "",
                        targets: 0,
                        orderable: false,
                    }],
                order: [[1, 'asc']],
                "bProcessing": true,
                "serverSide": true,
                drawCallback: vista.runTimers,
                "ajax": {
                    url: app.urlTo("TicketOnair/getTracingList"), // json datasource
                    type: "get", // type of method  , by default would be get
                    error: function () {  // error handling code
                        $("#employee_grid_processing").css("display", "none");
                    }
                }
            });
        },
        getRestartList: function () {
            $('#tablaReinicios').DataTable({
                columns: [
                    {title: "Estación", data: "k_id_station.n_name_station"},
                    {title: "Tipo de trabajo", data: 'k_id_work.n_name_ork'},
                    {title: "Estado", data: 'k_id_status_onair.k_id_status.n_name_status'},
                    {title: "SubEstado", data: 'k_id_status_onair.k_id_substatus.n_name_substatus'},
                    {title: "Tiempo", data: vista.setTimer},
                    {title: "Tecnologia", data: 'k_id_technology.n_name_technology'},
                    {title: "Banda", data: 'k_id_band.n_name_band'},
                    {title: "Fecha Creacion Onair", data: 'k_id_preparation.d_ingreso_on_air'},
                    {title: "Fecha Última revisión", data: 'd_fecha_ultima_rev'},
                    {title: "Encargado", data: 'i_actualEngineer'},
                    {title: "Opciones", data: vista.getButtonsRestar},
                ],
                "language": {
                    "url": app.urlbase + "assets/plugins/datatables/lang/es.json"
                },
                columnDefs: [{
                        defaultContent: "",
                        targets: 0,
                        orderable: false,
                    }],
                order: [[1, 'asc']],
                "bProcessing": true,
                "serverSide": true,
                drawCallback: vista.runTimers,
                "ajax": {
                    url: app.urlTo("TicketOnair/getRestartList"), // json datasource
                    type: "get", // type of method  , by default would be get
                    error: function () {  // error handling code
                        $("#employee_grid_processing").css("display", "none");
                    }
                }
            });
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
            app.post('TicketOnair/getListTicketDocumentador')
                    .complete(function () {
                        alert.hide();
                        $('.contentPrincipal').removeClass('hidden');
                    })
                    .success(function (response) {
                        console.log(response);
                        if (app.successResponse(response)) {
                            vista.fillTable(response.data.tracingList);
                            vista.fillTablePriority(response.data.priorityList);
                            vista.fillTableRestart(response.data.restartList);
                        } else {
                            vista.fillTable([]);
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
                    + '<a href="' + app.urlTo('User/trackingDetails?id=' + obj.k_id_onair) + '" class="btn btn-default btn-xs" data-toggle="tooltip" title="Documentación"><span class="fa fa-fw fa-file-archive-o"></span></a>'
                    + '</div>';
        },
        getButtonsRestar: function (obj) {
            return '<div class="btn-group">'
                    + '<a href="' + app.urlTo('Documenter/restartFields?id=' + obj.k_id_onair) + '" class="btn btn-default btn-xs" data-toggle="tooltip" title="Reinicio"><span class="fa fa-fw fa-undo"></span></a>'
                    + '<a href="' + app.urlTo('User/trackingDetails?id=' + obj.k_id_onair) + '" class="btn btn-default btn-xs" data-toggle="tooltip" title="Documentación"><span class="fa fa-fw fa-file-archive-o"></span></a>'
                    + '</div>';
        },
        setTimer: function (obj, style, none, settings) {
            var time = obj.k_id_status_onair.time;
            var timeStamp = (new Date()).getTime();
            var timer = {time: time, settings: settings, idTimer: 'timer_' + timeStamp + obj.k_id_onair + settings.row + '-' + settings.col};
            vista.timers.push(timer);
            return '<span id="' + timer.idTimer + '"><i class="fa fa-fw fa-clock-o"></i> No asignado</span>';
        },
        fillTable: function (data) {
            if (vista.tablaPrincipal) {
                dom.refreshTable(vista.tablaPrincipal, data);
                return;
            }

            vista.tablaPrincipal = $('#tablaPrincipal').DataTable(dom.configTable(data,
                    [
                        {title: "Estación", data: "k_id_station.n_name_station"},
                        {title: "Tipo de trabajo", data: 'k_id_work.n_name_ork'},
                        {title: "Estado", data: 'k_id_status_onair.k_id_status.n_name_status'},
                        {title: "SubEstado", data: 'k_id_status_onair.k_id_substatus.n_name_substatus'},
                        {title: "Tiempo", data: vista.setTimer},
                        {title: "Tecnologia", data: 'k_id_technology.n_name_technology'},
                        {title: "Banda", data: 'k_id_band.n_name_band'},
                        {title: "Fecha Creacion Onair", data: 'k_id_preparation.d_ingreso_on_air'},
                        {title: "Fecha Última revisión", data: 'd_fecha_ultima_rev'},
                        {title: "Encargado", data: 'i_actualEngineer'},
                        {title: "Opciones", data: vista.getButtons},
                    ], vista.runTimers
                    ));
        },
        fillTablePriority: function (data) {
            if (vista.tablaPrioritarios) {
                dom.refreshTable(vista.tablaPrioritarios, data);
                return;
            }

            vista.tablaPrioritarios = $('#tablaPrioritarios').DataTable(dom.configTable(data,
                    [
                        {title: "Estación", data: "k_id_station.n_name_station"},
                        {title: "Tipo de trabajo", data: 'k_id_work.n_name_ork'},
                        {title: "Estado", data: 'k_id_status_onair.k_id_status.n_name_status'},
                        {title: "SubEstado", data: 'k_id_status_onair.k_id_substatus.n_name_substatus'},
                        {title: "Tiempo", data: vista.setTimer},
                        {title: "Tecnologia", data: 'k_id_technology.n_name_technology'},
                        {title: "Banda", data: 'k_id_band.n_name_band'},
                        {title: "Fecha Creacion Onair", data: 'k_id_preparation.d_ingreso_on_air'},
                        {title: "Fecha Última revisión", data: 'd_fecha_ultima_rev'},
                        {title: "Encargado", data: 'i_actualEngineer'},
                        {title: "Opciones", data: vista.getButtons},
                    ], vista.runTimers
                    ));
        },
        fillTableRestart: function (data) {
            if (vista.tablaReinicios) {
                dom.refreshTable(vista.tablaReinicios, data);
                return;
            }

            vista.tablaReinicios = $('#tablaReinicios').DataTable(dom.configTable(data,
                    [
                        {title: "Estación", data: "k_id_station.n_name_station"},
                        {title: "Tipo de trabajo", data: 'k_id_work.n_name_ork'},
                        {title: "Estado", data: 'k_id_status_onair.k_id_status.n_name_status'},
                        {title: "SubEstado", data: 'k_id_status_onair.k_id_substatus.n_name_substatus'},
                        {title: "Tiempo", data: vista.setTimer},
                        {title: "Tecnologia", data: 'k_id_technology.n_name_technology'},
                        {title: "Banda", data: 'k_id_band.n_name_band'},
                        {title: "Fecha Creacion Onair", data: 'k_id_preparation.d_ingreso_on_air'},
                        {title: "Fecha Última revisión", data: 'd_fecha_ultima_rev'},
                        {title: "Encargado", data: 'i_actualEngineer'},
                        {title: "Opciones", data: vista.getButtonsRestar},
                    ], vista.runTimers
                    ));
        },
        runTimers: function () {
            var max = vista.timers.length;
            for (var i = 0; i < max; i++) {
                var obj = vista.timers[i];
                if (obj.time != null) {
                    dom.timer($('#' + obj.idTimer), null, null, obj.time);
                }
            }
            vista.timers = [];
        }
    };


    vista.init();
});
