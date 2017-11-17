$(function () {
    principal = {
        timers: [],
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
            app.post('TicketOnair/getListTicketDocumentador')
                    .complete(function () {
                        alert.hide();
                        $('.contentPrincipal').removeClass('hidden');
                    })
                    .success(function (response) {
                        console.log(response);
                        if (app.successResponse(response)) {
                            principal.fillTable(response.data.tracingList);
                            principal.fillTablePriority(response.data.priorityList);
                            principal.fillTableRestart(response.data.restartList);
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
        getButtons: function (obj) {
            return '<div class="btn-group">'
                    + '<a href="' + app.urlTo('Documenter/documenterFields?id=' + obj.k_id_onair) + '" class="btn btn-default btn-xs" data-toggle="tooltip" title="Documentación"><span class="fa fa-fw fa-file-archive-o"></span></a>'
                    + '</div>';
        },
        getButtonsRestar: function (obj) {
            return '<div class="btn-group">'
                    + '<a href="' + app.urlTo('Documenter/restartFields?id=' + obj.k_id_onair) + '" class="btn btn-default btn-xs" data-toggle="tooltip" title="Reinicio"><span class="fa fa-fw fa-undo"></span></a>'
                    + '<a href="' + app.urlTo('Documenter/documenterFields?id=' + obj.k_id_onair) + '" class="btn btn-default btn-xs" data-toggle="tooltip" title="Documentación"><span class="fa fa-fw fa-file-archive-o"></span></a>'
                    + '</div>';
        },
        setTimer: function (obj, style, none, settings) {
            var time = obj.k_id_status_onair.time;
            var timer = {time: time, settings: settings, idTimer: 'timer_' + obj.k_id_onair + settings.row + '-' + settings.col};
            principal.timers.push(timer);
            return '<span id="' + timer.idTimer + '"><i class="fa fa-fw fa-clock-o"></i> No asignado</span>';
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
                        {title: "SubEstado", data: 'k_id_status_onair.k_id_substatus.n_name_substatus'},
                        {title: "Tiempo", data: principal.setTimer},
                        {title: "Tecnologia", data: 'k_id_technology.n_name_technology'},
                        {title: "Banda", data: 'k_id_band.n_name_band'},
                        {title: "Fecha Creacion Onair", data: 'k_id_preparation.d_ingreso_on_air'},
                        {title: "Encargado", data: 'i_actualEngineer'},
                        {title: "Opciones", data: principal.getButtons},
                    ], principal.runTimers
                    ));
        },
        fillTablePriority: function (data) {
            if (principal.tablaPrioritarios) {
                dom.refreshTable(principal.tablaPrioritarios, data);
                return;
            }

            principal.tablaPrioritarios = $('#tablaPrioritarios').DataTable(dom.configTable(data,
                    [
                        {title: "Estación", data: "k_id_station.n_name_station"},
                        {title: "Tipo de trabajo", data: 'k_id_work.n_name_ork'},
                        {title: "Estado", data: 'k_id_status_onair.k_id_status.n_name_status'},
                        {title: "SubEstado", data: 'k_id_status_onair.k_id_substatus.n_name_substatus'},
                        {title: "Tiempo", data: principal.setTimer},
                        {title: "Tecnologia", data: 'k_id_technology.n_name_technology'},
                        {title: "Banda", data: 'k_id_band.n_name_band'},
                        {title: "Fecha Creacion Onair", data: 'k_id_preparation.d_ingreso_on_air'},
                        {title: "Encargado", data: 'i_actualEngineer'},
                        {title: "Opciones", data: principal.getButtons},
                    ], principal.runTimers
                    ));
        },
        fillTableRestart: function (data) {
            if (principal.tablaReinicios) {
                dom.refreshTable(principal.tablaReinicios, data);
                return;
            }

            principal.tablaReinicios = $('#tablaReinicios').DataTable(dom.configTable(data,
                    [
                        {title: "Estación", data: "k_id_station.n_name_station"},
                        {title: "Tipo de trabajo", data: 'k_id_work.n_name_ork'},
                        {title: "Estado", data: 'k_id_status_onair.k_id_status.n_name_status'},
                        {title: "SubEstado", data: 'k_id_status_onair.k_id_substatus.n_name_substatus'},
                        {title: "Tiempo", data: principal.setTimer},
                        {title: "Tecnologia", data: 'k_id_technology.n_name_technology'},
                        {title: "Banda", data: 'k_id_band.n_name_band'},
                        {title: "Fecha Creacion Onair", data: 'k_id_preparation.d_ingreso_on_air'},
                        {title: "Encargado", data: 'i_actualEngineer'},
                        {title: "Opciones", data: principal.getButtonsRestar},
                    ], principal.runTimers
                    ));
        },
        runTimers: function () {
            var max = principal.timers.length;
            for (var i = 0; i < max; i++) {
                var obj = principal.timers[i];
                if (obj.time != null) {
                    dom.timer($('#' + obj.idTimer), null, null, obj.time);
                }
            }
        }
    };


    principal.init();
});
