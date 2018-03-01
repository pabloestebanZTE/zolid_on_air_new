$(function () {
    vista = {
        timers: [],
        init: function () {
            var path = sessionStorage.getItem('path_tab_tables');
            if (path) {
                $('a[href="' + path + '"]').trigger('click');
            }
            vista.events();
            vista.getPendingList();
            vista.getAssignList();
            vista.getNotificationList();
            vista.getPrecheckList();
            vista.getSeguimiento12h();
            vista.getSeguimiento24h();
            vista.getSeguimiento36h();
            vista.getReinicioPrecheck();
            vista.getReinicio12h();
            vista.getStandBy();
            vista.getPriorityList();
        },
        getPendingList: function () {
            vista.tablaPendientes = $('#tablaPendientes').DataTable(vista.genericCogDataTable("Precheck/getPendingList", "tablaPendientes"));
        },
        getAssignList: function () {
            vista.tablaAsignados = $('#tablaAsignados').DataTable(vista.genericCogDataTable("Precheck/getAssignList", "tablaAsignados"));
        },
        getNotificationList: function () {
            vista.tablaNotification = $('#tablaNotification').DataTable(vista.genericCogDataTable("Precheck/getNotificationList", "tablaNotification"));
        },
        getPrecheckList: function () {
            vista.tablaPrecheck = $('#tablaPrecheck').DataTable(vista.genericCogDataTable("Precheck/getPrecheckList", "tablaPrecheck"));
        },
        getSeguimiento12h: function () {
            vista.tablaSeguimiento12h = $('#tablaSeguimiento12h').DataTable(vista.genericCogDataTable("Precheck/getSeguimiento12hList", "tablaSeguimiento12h"));
        },
        getSeguimiento24h: function () {
            vista.tablaSeguimiento24h = $('#tablaSeguimiento24h').DataTable(vista.genericCogDataTable("Precheck/getSeguimiento24hList", "tablaSeguimiento24h"));
        },
        getSeguimiento36h: function () {
            vista.tablaSeguimiento36h = $('#tablaSeguimiento36h').DataTable(vista.genericCogDataTable("Precheck/getSeguimiento36hList", "tablaSeguimiento36h"));
        },
        getReinicioPrecheck: function () {
            vista.tablaReinicioPrecheck = $('#tablaReinicioPrecheck').DataTable(vista.genericCogDataTable("Precheck/getReinicioPrecheckList", "tablaReinicioPrecheck"));
        },
        getReinicio12h: function () {
            vista.tablaReinicio12h = $('#tablaReinicio12h').DataTable(vista.genericCogDataTable("Precheck/getReinicio12hList", "tablaReinicio12h"));
        },
        getStandBy: function () {
            vista.tablaStandBy = $('#tablaStandBy').DataTable(vista.genericCogDataTable("Precheck/getStandByList", "tablaStandBy"));
        },
        getPriorityList: function () {
            vista.tablaPrioritarios = $('#tablaPrioritarios').DataTable(vista.genericCogDataTable("TicketOnair/getPriorityList", "tablaPrioritarios"));
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
                    {title: "Opciones", data: function (obj) {
                            return vista.getButtonsPending(obj, table);
                        }},
                ],
                "language": {
                    "url": app.urlbase + "assets/plugins/datatables/lang/es.json"
                },
                columnDefs: [{
                        defaultContent: "",
                        targets: -1,
                        orderable: false,
                    }],
                order: [[4, 'desc']],
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
        //Eventos de la ventana.
        events: function () {
            $('table').off('click', '.btn-preview', vista.onClickPreviewBtn);
            $('table').on('click', '.btn-preview', vista.onClickPreviewBtn);
            $('.tab-tables').on('click', vista.onClickTabTables);
        },
        onClickTabTables: function () {
            var tab = $(this);
            var path = tab.attr('href');
            sessionStorage.setItem('path_tab_tables', path);
        },
        onClickPreviewBtn: function () {
            var btn = $(this);
            var tr = btn.parents('tr');
            var table = vista[btn.attr('data-table')];
            if (!table) {
                return;
            }
            var record = table.row(tr).data();
            console.log(tr, record);
            $('#formDetallesBasicos').fillForm(record);
            $('#modalPreview').modal('show');
        },
        //Temporalmente...
        fillNA: function () {
            return "N/A";
        },
        getButtonsPending: function (obj, table) {
            return '<div class="btn-group">'
                    + '<a href="javascript:;" class="btn btn-default btn-xs btn-preview" data-toggle="tooltip" data-table="' + table + '" title="Vista previa"><span class="fa fa-fw fa-eye"></span></a>'
                    + '<a href="' + app.urlTo('User/trackingDetails?id=' + obj.k_id_onair) + '" class="btn btn-default btn-xs" data-toggle="tooltip" title="Ir al Detalle"><span class="fa fa-fw fa-search"></span></a>'
                    + '<a href="' + app.urlTo('User/assignEngineer?idOnair=' + obj.k_id_onair) + '" class="btn btn-default btn-xs" data-toggle="tooltip" title="Asignar"><span class="fa fa-fw fa-tag"></span></a>'
                    + '</div>';
        },
        getButtonsAssing: function (obj) {
            return '<div class="btn-group">'
                    + '<a href="javascript:;" class="btn btn-default btn-xs btn-preview" data-toggle="tooltip" data-table="tablaAsignados" title="Vista previa"><span class="fa fa-fw fa-eye"></span></a>'
                    + '<a href="' + app.urlTo('User/trackingDetails?id=' + obj.k_id_onair) + '" class="btn btn-default btn-xs" data-toggle="tooltip" title="Ir al Detalle"><span class="fa fa-fw fa-search"></span></a>'
                    + '<a href="' + app.urlTo('User/assignEngineer?idOnair=' + obj.k_id_onair) + '" class="btn btn-default btn-xs" data-toggle="tooltip" title="Reasignar"><span class="fa fa-fw fa-tag"></span></a>'
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
