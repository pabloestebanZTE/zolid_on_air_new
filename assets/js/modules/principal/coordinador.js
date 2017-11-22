$(function () {
    vista = {
        timers: [],
        init: function () {
            vista.events();
            vista.getPendingList();
            vista.getAssignList();
//            vista.listActivities();
        },
        getPendingList: function () {
            $('.contentPrincipal').removeClass('hidden');
            $('#tablaPendientes').DataTable({
                columns: [
                    {title: "Estación", data: "k_id_station.n_name_station"},
                    {title: "Tipo de trabajo", data: 'k_id_work.n_name_ork'},
                    {title: "Estado", data: 'k_id_status_onair.k_id_status.n_name_status'},
                    {title: "SubEstado", data: 'k_id_status_onair.k_id_substatus.n_name_substatus'},
                    {title: "Tiempo", data: vista.setTimer},
                    {title: "Tecnologia", data: 'k_id_technology.n_name_technology'},
                    {title: "Banda", data: 'k_id_band.n_name_band'},
                    {title: "Fecha Creacion Onair", data: 'k_id_preparation.d_ingreso_on_air'},
                    {title: "Encargado", data: 'i_actualEngineer'},
                    {title: "Opciones", data: vista.getButtonsPending},
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
                    url: app.urlTo("Precheck/getPendingList"), // json datasource
                    type: "get", // type of method  , by default would be get
                    error: function () {  // error handling code
                        $("#employee_grid_processing").css("display", "none");
                    }
                }
            });
        },
        getAssignList: function () {
            $('.contentPrincipal').removeClass('hidden');
            $('#tablaAsignados').DataTable({
                columns: [
                    {title: "Estación", data: "k_id_station.n_name_station"},
                    {title: "Tipo de trabajo", data: 'k_id_work.n_name_ork'},
                    {title: "Estado", data: 'k_id_status_onair.k_id_status.n_name_status'},
                    {title: "SubEstado", data: 'k_id_status_onair.k_id_substatus.n_name_substatus'},
                    {title: "Tiempo", data: vista.setTimer},
                    {title: "Tecnologia", data: 'k_id_technology.n_name_technology'},
                    {title: "Banda", data: 'k_id_band.n_name_band'},
                    {title: "Fecha Creacion Onair", data: 'k_id_preparation.d_ingreso_on_air'},
                    {title: "Encargado", data: 'i_actualEngineer.n_name_user'},
                    {title: "Opciones", data: vista.getButtonsAssing},
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
                    url: app.urlTo("Precheck/getAssignList"), // json datasource
                    type: "get", // type of method  , by default would be get
                    error: function () {  // error handling code
                        $("#employee_grid_processing").css("display", "none");
                    }
                }
            });
        },
        //Eventos de la ventana.
        events: function () {
            $('#tab1default').on('click', '.btn-preview', vista.onClickPreviewBtn);
        },
        onClickPreviewBtn: function () {
            console.log("Click preview");
            var btn = $(this);
            var tr = btn.parents('tr');
            if (!vista.tablaAsignados) {
                return;
            }
            console.log("TR", tr);
            var record = vista.tablaPendientes.row(tr).data();
            console.log(tr, record);
            $('#formDetallesBasicos').fillForm(record);
            $('#modalPreview').modal('show');
        },
        //Temporalmente...
        fillNA: function () {
            return "N/A";
        },
        getButtonsPending: function (obj) {
            return '<div class="btn-group">'
                    + '<a href="javascript:;" class="btn btn-default btn-xs btn-preview" data-toggle="tooltip" title="Vista previa"><span class="fa fa-fw fa-eye"></span></a>'
                    + '<a href="' + app.urlTo('User/trackingDetails?id=' + obj.k_id_onair) + '" class="btn btn-default btn-xs" data-toggle="tooltip" title="Ir al Detalle"><span class="fa fa-fw fa-search"></span></a>'
                    + '<a href="' + app.urlTo('User/assignEngineer?idOnair=' + obj.k_id_onair) + '" class="btn btn-default btn-xs" data-toggle="tooltip" title="Asignar"><span class="fa fa-fw fa-tag"></span></a>'
                    + '</div>';
        },
        getButtonsAssing: function (obj) {
            return '<div class="btn-group">'
                    + '<a href="' + app.urlTo('User/trackingDetails?id=' + obj.k_id_onair) + '" class="btn btn-default btn-xs" data-toggle="tooltip" title="Detalle"><span class="fa fa-fw fa-eye"></span></a>'
                    + '</div>';
        },
        setTimer: function (obj, style, none, settings) {
            var time = obj.k_id_status_onair.time;
            var timeStamp = (new Date()).getTime();
            var timer = {time: time, settings: settings, idTimer: 'timer_' + timeStamp + obj.k_id_onair + settings.row + '-' + settings.col};
            vista.timers.push(timer);
            return '<span id="' + timer.idTimer + '"><i class="fa fa-fw fa-clock-o"></i> No asignado</span>';
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
