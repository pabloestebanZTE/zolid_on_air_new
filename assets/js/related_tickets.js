var rg = {
    init: function () {
        rg.events();
        rg.configView();
    },
    events: function () {
        $('#btnAddTicketRelation').on('click', rg.onClickAddTicketRelation);
        $('#btnGuardarRelacionTickets').on('click', rg.onClickGuardarRelationTickets);
        $('#tableRelacionTickets').on('click', '.btn-delete-relation', rg.onClickDeleteRelatedTicket);
    },
    configView: function () {
        if (!rgPermisesUpdate) {
            $('#stationForm .alert').remove();
            $('.relation-content-editor').remove();
            $('#btnGuardarRelacionTickets').remove();
        }
    },
    onClickGuardarRelationTickets: function () {
        rg.relatedTickets = [];
        var trs = $('#tableRelacionTickets tbody tr');
        for (var i = 0; i < trs.length; i++) {
            var tr = $(trs[i]);
            if (tr.attr('data-i')) {
                rg.relatedTickets.push(tr.attr('data-i'));
            }
        }

        var relatedTickets = JSON.stringify(rg.relatedTickets);
        app.post('Utils/updateRelationsTicket', {
            idTicket: app.getParamURL('id'),
            related_tickets: relatedTickets
        })
                .success(function (response) {
                    if (app.successResponse(response)) {
                        swal("Actualizado", "Se han actualizado las relaciones del ticket", "success");
                    } else {
                        swal("Error", "No se pudo actualizar las relaciones del ticket", "error");
                    }
                })
                .error(function (e) {
                    swal("Error", "Se ha producido un error inesperado al actualizar las relaciones del ticket.", "error");
                    console.error(e);
                })
                .send();
    },
    onClickDeleteRelatedTicket: function () {
        var tr = $(this).parents('tr');
        if (tr.hasClass('saved')) {
            dom.confirmar("Se eliminará la relación del ticket permanentemente, ¿Desea continuar?", function () {
                app.post('Utils/deleteRelationTicket', {
                    idRTicket: tr.attr('data-id')
                })
                        .success(function (response) {
                            console.log(response);
                            if (app.successResponse(response)) {
                                swal('Removido', 'Se ha removido correctamente la relación', 'success');
                                tr.remove();
                            } else {
                                swal('Error', 'No se pudo eliminar la relación', 'error');
                            }
                        })
                        .error(function (e) {
                            swal('Error', 'Se ha producido un error inesperado al eliminar la relación', 'error');
                            console.error(e);
                        })
                        .send();
            });
        } else {
            tr.remove();
        }
    },
    getRelations: function (form) {
        rg.relatedTickets = [];
        if (form.attr('data-rt') == "true") {
            var trs = $('#tableRelacionTickets tbody tr');
            for (var i = 0; i < trs.length; i++) {
                var tr = $(trs[i]);
                if (tr.attr('data-i')) {
                    rg.relatedTickets.push(tr.attr('data-i'));
                }
            }
        }
        var relatedTickets = JSON.stringify(rg.relatedTickets);
        $('#txtRelatedTickets').val(relatedTickets);
    },
    confirmRelateds: function (form) {
        dom.confirmar("Este caso tiene dos bandas, ¿desea relacionar otro(s) tickets para este caso?", function () {
            $('#tabRelacionarTickets').trigger('click');
            form.attr('data-rt', 'true');
            dom.scrollTop();
        }, function () {
            form.attr('data-rt', 'false');
            submitFtn();
        });
    },
    onClickAddTicketRelation: function () {
        if (typeof rg.dataEstaciones == "undefined") {
            return;
        }
        ($('#assignServie2 #txtRelatedTickets').length == 0) && $('#assignServie2').append('<input type="hidden" name="related_tickets" id="txtRelatedTickets" />');
        content = $('#tableRelacionTickets tbody');
        var estacion = $('#cmbTicketRelation').val();
        if (content.find('[data-i="' + estacion + '"]').length > 0) {
            return;
        }
        var obj = rg.dataEstaciones[estacion];
        content.find('.no-found').remove();
        console.log(obj);
        obj.i = content.find('tr').length + 1;
        content.append(dom.fillString('<tr data-i="{k_id_onair}"><td>{i}</td><td><a href="' + app.urlTo($('#link_view_ticket')+'?id=') + '{k_id_onair}" target="_blank">#{k_id_onair} - {k_id_station.n_name_station} / {k_id_technology.n_name_technology} / {k_id_band.n_name_band}</td><td><div class="btn-group"><a href="' + app.urlTo('User/trackingDetails?id=') + '{k_id_onair}" target="_blank" class="btn btn-xs btn-default" title="Ver ticket"><i class="fa fa-fw fa-eye"></i></a><button class="btn btn-xs btn-danger btn-delete-relation" title="Eliminar"><i class="fa fa-fw fa-times"></i></button></div></td></tr>', obj));
    },
    getRelatedTickets: function (idTicket) {
        app.post('Utils/getRelatedTicketsByIdTicked', {
            idTicket: idTicket
        })
                .success(function (response) {
                    var data = app.parseResponse(response);
                    var content = $('#tableRelacionTickets tbody');
                    content.find('.no-found').remove();
                    if (data && data.length > 0) {
                        $('#spanRelatedTickets').html(data.length);
                        for (var i = 0; i < data.length; i++) {
                            var obj = data[i];
                            obj.i = i + 1;
                            content.append(dom.fillString('<tr class="saved" data-i="{k_id_onair}" data-id="{k_id_related_ticket}"><td>{i}</td><td><a href="' + app.urlTo('User/trackingDetails?id=') + '{k_id_onair}" target="_blank">#{k_id_onair} - {k_id_station.n_name_station} / {k_id_technology.n_name_technology} / {k_id_band.n_name_band}</td><td><div class="btn-group"><a href="' + app.urlTo('User/trackingDetails?id=') + '{k_id_onair}" target="_blank" class="btn btn-xs btn-default" title="Ver ticket"><i class="fa fa-fw fa-eye"></i></a>' + ((rgPermisesUpdate) ? '<button class="btn btn-xs btn-danger btn-delete-relation" title="Eliminar"><i class="fa fa-fw fa-times"></i></button>' : '') + '</div></td></tr>', obj));
                        }
                    } else {
                        content.html('<tr class="no-found"><td colspan="3"><i class="fa fa-fw fa-warning"></i> No se han agregado relaciones para este tikcet.</td></tr>');
                    }
                })
                .error(function (e) {
                    console.error(e)
                })
                .send();
    },
    getTickets: function (idStation) {
        app.post('Utils/getTicketsByStations', {idStation: idStation})
                .success(function (response) {
                    var cmb = $('#cmbTicketRelation');
                    var data = app.parseResponse(response);
                    if (data && data.length > 0) {
                        rg.dataEstaciones = {};
                        cmb.html('');
                        var id = app.getParamURL("id");
                        var max = data.length;
                        for (var i = 0; i < max; i++) {
                            var obj = data[i];
                            if (obj.k_id_onair != $('#idOnAir').val()) {
                                rg.dataEstaciones[obj.k_id_onair] = obj;
                                obj.i = i + 1;
                                if (id != obj.k_id_onair) {
                                    $el = $(dom.fillString('<option value="{k_id_onair}">#{k_id_onair} - {k_id_station.n_name_station} / {k_id_band.n_name_band}</option>', obj));
                                    cmb.append($el);
                                }
                            }
                        }
                        cmb.trigger('change.select2');
                    } else {
                        cmb.append($('<option>', {
                            value: "",
                            text: "No hay tickets para relacionar"
                        }));
                    }
                })
                .error(function (error) {
                    console.error(error);
                })
                .send();
    },

};

$(rg.init());