$(function () {
    vista = {
        timers: [],
        init: function () {
            vista.events();
            vista.listActivities();
        },
        /**
         * Listará las actividades de los usuarios que ingresan al sistema...
         */
        listActivities: function () {
            $('.contentPrincipal').removeClass('hidden');
            vista.tablaPrincipal = $('#tablaPrincipal').DataTable({
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
                drawCallback: vista.runTimers,
                "ajax": {
                    url: app.urlTo("Precheck/getAllTickets"), // json datasource
                    type: "get", // type of method  , by default would be get
                    error: function () {  // error handling code
                        $("#employee_grid_processing").css("display", "none");
                    }
                }
            });
        },
        //Eventos de la ventana.
        events: function () {
            $('table').off('click', '.btn-preview', vista.onClickPreviewBtn);
            $('table').on('click', '.btn-preview', vista.onClickPreviewBtn);
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
        getButtons: function (obj) {
            return '<div class="btn-group">'
                    + '<a href="' + app.urlTo('User/trackingDetails?id=' + obj.k_id_onair) + '" class="btn btn-default btn-xs" data-toggle="tooltip" title="Documentación"><span class="fa fa-fw fa-file-archive-o"></span></a>'
                    + '</div>';
        },
        setTimer: function (obj, style, none, settings) {
            var time = obj.k_id_status_onair.time;
            var timer = {time: time, settings: settings, idTimer: 'timer_' + settings.row + '-' + settings.col};
            vista.timers.push(timer);
            return '<span id="' + timer.idTimer + '"><i class="fa fa-fw fa-clock-o"></i> No disponible</span>';
        },
        runTimers: function () {
            var max = vista.timers.length;
            for (var i = 0; i < max; i++) {
                var obj = vista.timers[i];
                if (obj.time != null) {
                    dom.timer($('#' + obj.idTimer), null, vista.listActivities, obj.time);
                }
            }
        }
    };


    vista.init();
});
