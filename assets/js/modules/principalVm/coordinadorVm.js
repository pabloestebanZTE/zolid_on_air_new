$(function () {
    var ini = {
        timers: [],
        init: function () {
            ini.events();
            ini.listVm();
        },
        //Eventos de la ventana.
        events: function () {

        },
        /**
         * Listará las actividades de los usuarios que ingresan al sistema...
         */
        listVm: function () {
            //Invoca fillTable para configurar la TABLA.
            // ini.fillTable([]);
            //Realiza la petición AJAX para traer los datos...
            var alert = dom.printAlert('Consultando registros, por favor espere.', 'loading', $('#principalAlert'));
            app.post('Acs/getAllVm')
                    .complete(function () {
                        alert.hide();
                        $('.contentPrincipal').removeClass('hidden');
                    })
                    .success(function (response) {
                        console.log(response);
                        if (app.successResponse(response)) {
                            ini.fillTable(response.data.hoy);
                            ini.fillTable2(response.data.historico);
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
                    + '<a onclick="showModalAssign(' + obj.k_id_vm + ')" class="btn btn-default btn-xs" data-toggle="tooltip" title="Asignar Ingeniero"><span class="fa fa-fw fa-list-ul"></span></a>'
                    + '</div>';
        },
        fillTable: function (data) {
            if (ini.tablaVmHoy) {
                dom.refreshTable(ini.tablaVmHoy, data);
                return;
            }
            ini.tablaVmHoy = $('#tablaVmHoy').DataTable(dom.configTable(data,
                    [
                        {title: "Id ZTE", data: "k_id_vm"},
                        {title: "Site Acces", data: "i_id_site_access"},
                        {title: "Estación", data: "n_name_station"},
                        {title: "tecnología", data: "n_name_technology"},
                        {title: "Tipo Trabajo", data: "n_name_ork"},
                        {title: "Banda", data: "n_name_band"},
                        {title: "Estado", data: "n_estado_vm"},
                        {title: "SubEstado", data: "n_sub_estado"},
                        {title: "Tipo Falla Final", data: "n_falla_final"},
                        {title: "Ing. Crea Grupo", data: "ingeniero_creador_grupo"},
                        {title: "Ing. Apertura", data: "ingeniero_apertura"},
                        {title: "Ing. Punto Control", data: "ingeniero_control"},
                        {title: "Ing. Cierre", data: "ingeniero_cierre"},
                        {title: "Opciones", data: ini.getButtons},
                    ],
                    ));
        },
        fillTable2: function (data) {
            if (ini.tablaVmHis) {
                dom.refreshTable(ini.tablaVmHis, data);
                return;
            }
            ini.tablaVmHis = $('#tablaVmHis').DataTable(dom.configTable(data,
                    [
                        {title: "Id ZTE", data: "k_id_vm"},
                        {title: "Site Acces", data: "i_id_site_access"},
                        {title: "Estación", data: "n_name_station"},
                        {title: "tecnología", data: "n_name_technology"},
                        {title: "Tipo Trabajo", data: "n_name_ork"},
                        {title: "Banda", data: "n_name_band"},
                        {title: "Estado", data: "n_estado_vm"},
                        {title: "SubEstado", data: "n_sub_estado"},
                        {title: "Tipo Falla Final", data: "n_falla_final"},
                        {title: "Ing. Crea Grupo", data: "ingeniero_creador_grupo"},
                        {title: "Ing. Apertura", data: "ingeniero_apertura"},
                        {title: "Ing. Punto Control", data: "ingeniero_control"},
                        {title: "Ing. Cierre", data: "ingeniero_cierre"},
                        {title: "Opciones", data: ini.getButtons},
                    ],
                    ));
        }

    };

    ini.init();
});

function showModalAssign(k_id_vm) {
    $('#k_id_vm').val(k_id_vm);
    $('#modalChangeState').modal('show');
}