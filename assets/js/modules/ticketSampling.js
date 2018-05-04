$(function () {
    var ini = {
        timers: [],
        init: function () {
            ini.events();
            ini.listTickets();
        },
        //Eventos de la ventana.
        events: function () {
            //Al darle clic a una fila llama la funcion onClickTrTablaTicketSampling
            $('#ticketSampling').on('click', 'tr', ini.onClickTrTablaTicketSampling);
            $('#k_id_estado_ot').on('change', ini.onChangeTextStateOt);
            $('#btnGuardar').on('click', ini.onSubmitForm);
        },
        onSubmitForm: function (e) {
            app.stopEvent(e);
//            var form = $(this);
//        dom.confirmar("¿Está seguro que desea escalar el ticket?", function () {
            dom.submitDirect($('#formModal'), function (response) {
                if (response.code > 0) {
                    swal("Guardado", "Se guardaron los cambios exitosamente", "success").then(function () {
                        //$('#modalEditTicket').modal('hide');
                        location.reload();
                    });
                } else {
                    swal("Error", "Lo sentimos se ha producido un error", "error");
                }
            });
//        }, function () {
//            swal("Cancelado", "Se ha cancelado la acción", "error");
//        });
        },
        onClickTrTablaTicketSampling: function () {
            var tr = $(this);
            ini.tr = tr;
            if (ini.ticketSampling) {
                var registro = ini.ticketSampling.row(tr).data();
                //si selecciona el header de la tabla no se muestre el modal
                if (registro != undefined) {
                    ini.modalEditar(registro);
                }
            }

        },
        //llama el modal
        modalEditar: function (registro) {
            $('#k_id_onair').val(registro.k_id_on_air);
            $('#n_nombre_estacion_eb').val(registro.n_nombre_estacion_eb);
            $('#n_tecnologia').val(registro.n_tecnologia);
            $('#n_tipo_trabajo').val(registro.n_tipo_trabajo);
            $('#n_banda').val(registro.n_banda);
            $('#n_estado_eb_resucomen').val(registro.n_estado_eb_resucomen);
            $('#n_usuario_encargado').val(registro.usuario_resucomen);
            //mostrar modal
            $('#modalEditTicket').modal('show');
        },
        /**
         * Listará las actividades de los usuarios que ingresan al sistema...
         */
        listTickets: function () {
            //Invoca fillTable para configurar la TABLA.
            // ini.fillTable([]);
            //Realiza la petición AJAX para traer los datos...
            var alert = dom.printAlert('Consultando registros, por favor espere.', 'loading', $('#principalAlert'));
            app.post('TicketOnair/getTicketSampling')
                    .complete(function () {
                        alert.hide();
                        $('.contentPrincipal').removeClass('hidden');
                    })
                    .success(function (response) {
//                        console.log(response);
                        if (app.successResponse(response)) {
                            ini.fillTable(response.data);
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
        fillTable: function (data) {
            if (ini.ticketSampling) {
                dom.refreshTable(ini.ticketSampling, data);
                return;
            }
            ini.ticketSampling = $('#ticketSampling').DataTable(dom.configTable(data,
                    [
                        {title: "Fecha", data: "hora_actualizacion_resucomen"},
                        {title: "Estación", data: "n_nombre_estacion_eb"},
                        {title: "Tipo de Trabajo", data: "n_tipo_trabajo"},
                        {title: "Estado", data: "n_estado_eb_resucomen"},
                        {title: "Tecnología", data: "n_tecnologia"},
                        {title: "Banda", data: "n_banda"},
                        {title: "Encargado", data: "usuario_resucomen"}
                    ],
                    ));
        }
    };

    ini.init();
});
