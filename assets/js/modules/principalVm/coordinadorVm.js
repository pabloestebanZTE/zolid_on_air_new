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
                        if (app.successResponse(response)) {
                            ini.fillTableHoy(response.data.hoy);    
                            ini.fillTableHis(response.data.historico);
                            ini.fillTableAper(response.data.apertura);
                            ini.fillTableCont(response.data.control);
                            ini.fillTableCierre(response.data.cierre);
                            ini.fillTableTick(response.data.remedy);
                        } else {
                            ini.fillTableHoy([]);
                            ini.fillTableHis([]);
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
                    + '<a onclick="showModalAssign(' + obj.k_id_vm + ',' + obj.i_ingeniero_apertura + ',' + obj.i_ingeniero_punto_control + ',' + obj.i_ingeniero_cierre + ')" class="btn btn-default btn-xs" data-toggle="tooltip" title="Asignar Ingeniero"><span class="fa fa-fw fa-list-ul"></span></a>'
                    + '</div>';
        },
        fillTableHoy: function (data) {
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
                    {title: "Ing. Crea Grupo", data: "ingeniero_creador_grupo"},
                    {title: "Ing. Apertura", data: "ingeniero_apertura"},
                    {title: "Ing. Punto Control", data: "ingeniero_control"},
                    {title: "Ing. Cierre", data: "ingeniero_cierre"},
                    {title: "Fase Actual", data: "n_fase_ventana"},
                    {title: "Opciones", data: ini.getButtons},
                ],
                )
            );
        },
        fillTableHis: function (data) {
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
                    {title: "Ing. Crea Grupo", data: "ingeniero_creador_grupo"},
                    {title: "Ing. Apertura", data: "ingeniero_apertura"},
                    {title: "Ing. Punto Control", data: "ingeniero_control"},
                    {title: "Ing. Cierre", data: "ingeniero_cierre"},
                    {title: "Fase Actual", data: "n_fase_ventana"},
                    {title: "Opciones", data: ini.getButtons},
                ],
                )
            );
        },
        fillTableAper: function (data) {
            if (ini.tablaVmApertura) {
                dom.refreshTable(ini.tablaVmApertura, data);
                return;
            }
            ini.tablaVmApertura = $('#tablaVmApertura').DataTable(dom.configTable(data,
                [
                    {title: "Id ZTE", data: "k_id_vm"},
                    {title: "Site Acces", data: "i_id_site_access"},
                    {title: "Estación", data: "n_name_station"},
                    {title: "tecnología", data: "n_name_technology"},
                    {title: "Tipo Trabajo", data: "n_name_ork"},
                    {title: "Banda", data: "n_name_band"},
                    {title: "Ing. Crea Grupo", data: "ingeniero_creador_grupo"},
                    {title: "Ing. Apertura", data: "ingeniero_apertura"},
                    {title: "Ing. Punto Control", data: "ingeniero_control"},
                    {title: "Ing. Cierre", data: "ingeniero_cierre"},
                    {title: "Opciones", data: ini.getButtons},
                ],
                )
            );
        },
        fillTableCont: function (data) {
            if (ini.tablaVmControl) {
                dom.refreshTable(ini.tablaVmControl, data);
                return;
            }
            ini.tablaVmControl = $('#tablaVmControl').DataTable(dom.configTable(data,
                [
                    {title: "Id ZTE", data: "k_id_vm"},
                    {title: "Site Acces", data: "i_id_site_access"},
                    {title: "Estación", data: "n_name_station"},
                    {title: "tecnología", data: "n_name_technology"},
                    {title: "Tipo Trabajo", data: "n_name_ork"},
                    {title: "Banda", data: "n_name_band"},
                    {title: "Ing. Crea Grupo", data: "ingeniero_creador_grupo"},
                    {title: "Ing. Apertura", data: "ingeniero_apertura"},
                    {title: "Ing. Punto Control", data: "ingeniero_control"},
                    {title: "Ing. Cierre", data: "ingeniero_cierre"},
                    {title: "Opciones", data: ini.getButtons},
                ],
                )
            );
        },
        fillTableCierre: function (data) {
            if (ini.tablaVmCierre) {
                dom.refreshTable(ini.tablaVmCierre, data);
                return;
            }
            ini.tablaVmCierre = $('#tablaVmCierre').DataTable(dom.configTable(data,
                [
                    {title: "Id ZTE", data: "k_id_vm"},
                    {title: "Site Acces", data: "i_id_site_access"},
                    {title: "Estación", data: "n_name_station"},
                    {title: "tecnología", data: "n_name_technology"},
                    {title: "Tipo Trabajo", data: "n_name_ork"},
                    {title: "Banda", data: "n_name_band"},
                    {title: "Ing. Crea Grupo", data: "ingeniero_creador_grupo"},
                    {title: "Ing. Apertura", data: "ingeniero_apertura"},
                    {title: "Ing. Punto Control", data: "ingeniero_control"},
                    {title: "Ing. Cierre", data: "ingeniero_cierre"},
                    {title: "Opciones", data: ini.getButtons},
                ],
                )
            );
        },
        fillTableTick: function (data) {
            if (ini.tablaVmTick) {
                dom.refreshTable(ini.tablaVmTick, data);
                return;
            }

            ini.tablaVmTick = $('#tablaVmTick').DataTable(dom.configTable(data,
                [
                    {title: "Ticket N°", data: "k_id_tiket_remedy"},
                    {title: "Id ZTE", data: "k_id_vm"},
                    {title: "Número de Incidente", data: "n_numero_incidente"},
                    {title: "Estado Ticket", data: "n_estado_ticket"},
                    {title: "Tipo de Afectación", data: "n_tipo_afectacion"},
                    {title: "Ingeniero Apertura Ticket", data: "i_ingeniero_apertura_ticket"},
                    {title: "Grupo Soporte", data: "n_grupo_soporte"},
                    {title: "Inicio Afectación", data: "d_inicio_afectacion"},
                    {title: "Responsable OyM", data: "n_responsable_oym"},
                    {title: "Responsable Ticket", data: "n_responsable_ticket"},
                    {title: "Fm Claro", data: "n_fm_claro"},
                    {title: "Fm Nokia", data: "n_fm_nokia"},
                    {title: "Ingeniero Cierre Ticket", data: "i_ingeniero_cierre_ticket"},
                    {title: "Fin Afectación", data: "d_fin_afectacion"},
                    {title: "Opciones", data: ini.getButtons},
                ], 
                )
            );
        }
    };

    ini.init();
});

function showModalAssign(k_id_vm, ingeniero_apertura, ingeniero_control, ingeniero_cierre) {
    $("#i_ingeniero_asignado_avm").val(ingeniero_apertura).trigger('change.select2');
    $("#i_ingeniero_asignado_pvm").val(ingeniero_control).trigger('change.select2');
    $("#i_ingeniero_asignado_cvm").val(ingeniero_cierre).trigger('change.select2');
    $('#k_id_vm').val(k_id_vm);
    $('#modalChangeState').modal('show');
}