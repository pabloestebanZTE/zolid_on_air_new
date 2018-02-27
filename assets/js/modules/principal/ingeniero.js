$(function () {
    var vista = {
        timers: [],
        init: function () {
            vista.events();
            vista.listActivities();
            vista.getPriorityList();
        },
        //Eventos de la ventana.
        events: function () {

        },
        genericCogDataTable: function (url, table) {
            $('.contentPrincipal').removeClass('hidden');
            return {
                columns: [
                    {title: "Estación", data: "k_id_station.n_name_station"},
                    {title: "Tipo de trabajo", data: 'k_id_work.n_name_ork'},
                    {title: "Estado", data: 'k_id_status_onair.k_id_status.n_name_status'},
                    {title: "SubEstado", data: 'k_id_status_onair.k_id_substatus.n_name_substatus'},
                    {title: "Tiempo", data: function (obj, style, none, settings) {
                            return vista.setTimer(obj, style, none, settings, table);
                        }
                    },
                    {title: "Tecnologia", data: 'k_id_technology.n_name_technology'},
                    {title: "Banda", data: 'k_id_band.n_name_band'},
                    {title: "Fecha Creacion Onair", data: 'k_id_preparation.d_ingreso_on_air'},
                    {title: "Fecha Última revisión", data: 'd_fecha_ultima_rev'},
                    {title: "Encargado", data: function (obj) {
                            if (typeof obj.i_actualEngineer === "object") {
                                return obj.i_actualEngineer.n_name_user + " " + obj.i_actualEngineer.n_last_name_user;
                            } else {
                                return obj.i_actualEngineer;
                            }
                        }
                    },
                    {title: "Opciones", data: vista.getButtons},
                ],
                "language": {
                    "url": app.urlbase + "assets/plugins/datatables/lang/es.json"
                },
                columnDefs: [{
                        defaultContent: "",
                        targets: -1,
                        orderable: false,
                    }],
                order: [[1, 'asc']],
                "bProcessing": true,
                "serverSide": true,
                drawCallback: function () {
                    vista.runTimers(table);
                },
                "ajax": {
                    url: app.urlTo(url), // json datasource
                    type: "get", // type of method  , by default would be get
                    error: function () {  // error handling code
                        $("#employee_grid_processing").css("display", "none");
                    }
                }
            };
        },
        /**
         * Listará las actividades de los usuarios que ingresan al sistema...
         */
        listActivities: function () {
            vista.tablaPrincipal = $('#tablaPrincipal').DataTable(vista.genericCogDataTable("TicketOnair/ticketUser", "tablaPendientes"));
        },
        getPriorityList: function () {
            vista.tablaPrioritarios = $('#tablaPrioritarios').DataTable(vista.genericCogDataTable("TicketOnair/getPriorityList?hidescaled=true&byIngener=true", "tablaPrioritarios"));
        },
        //Temporalmente...
        fillNA: function () {
            return "N/A";
        },
        getButtons: function (obj) {
            return '<div class="btn-group">'
                    + ((obj.k_id_substatus != 31 && obj.k_id_substatus != 18 && obj.k_id_substatus != 20) ? '<a href="' + app.urlTo('User/trackingDetails?id=' + obj.k_id_onair) + '" class="btn btn-default btn-xs" data-toggle="tooltip" title="Seguimiento"><span class="fa fa-fw fa-history"></span></a>' : '')
                    + ((obj.i_precheck_realizado != 1) ? '<a  href="' + app.urlTo('User/doPrecheck?idOnair=' + obj.k_id_onair) + '" class="btn btn-default btn-xs" data-toggle="tooltip" title="Precheck"><span class="fa fa-fw fa-file-archive-o"></span></a>' : '')
                    + '</div>';
        },
        setTimer: function (obj, style, none, settings, table) {
            if (!vista.timers[table]) {
                vista.timers[table] = [];
            }
            var time = obj.k_id_status_onair.time;
            var timeStamp = (new Date()).getTime();
            var timer = {time: time, settings: settings, idTimer: 'timer_' + timeStamp + obj.k_id_onair + settings.row + '-' + settings.col};
            vista.timers[table].push(timer);
            return '<span id="' + timer.idTimer + '"><i class="fa fa-fw fa-clock-o"></i> No asignado</span>';
        },
        runTimers: function (table) {
            if (!vista.timers[table]) {
                return;
            }
            var max = vista.timers[table].length;
            for (var i = 0; i < max; i++) {
                var obj = vista.timers[table][i];
                if (obj.time != null) {
                    dom.timer($('#' + obj.idTimer), null, null, obj.time);
                }
            }
        }
    };

    vista.init();
});
