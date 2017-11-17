$(function () {
    var principal = {
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
            app.post('TicketOnair/ticketUser')
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
        getButtons: function (obj) {

            var m = "";
            if (obj.i_precheck_realizado) {
                m = "style= 'display: none'";
            }
            return '<div class="btn-group">'
                    + '<a href="' + app.urlTo('User/trackingDetails?id=' + obj.k_id_onair) + '" class="btn btn-default btn-xs" data-toggle="tooltip" title="Seguimiento"><span class="fa fa-fw fa-history"></span></a>'
                    + '<a  href="' + app.urlTo('User/doPrecheck?idOnair=' + obj.k_id_onair) + '" class="btn btn-default btn-xs" data-toggle="tooltip" title="Precheck"' + m + '><span class="fa fa-fw fa-file-archive-o"></span></a>'
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
        setTimer: function (obj, style, none, settings) {
            var time = obj.k_id_status_onair.time;
            var timer = {time: time, settings: settings, idTimer: 'timer_' + obj.k_id_onair + settings.row + '-' + settings.col};
            principal.timers.push(timer);
            return '<span id="' + timer.idTimer + '"><i class="fa fa-fw fa-info-circle"></i> No asignado</span>';
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
