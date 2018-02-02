var rg = {
    init: function () {
        rg.events();
    },
    events: function () {
        $('#btnAddTicketRelation').on('click', rg.onClickAddTicketRelation);
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

        $('#txtRelatedTickets').val(JSON.stringify(rg.relatedTickets));
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
        var estacion = $('#cmbTicketRelation').val();
        var obj = rg.dataEstaciones[estacion];
        var content = $('#tableRelacionTickets tbody');
        content.find('.no-found').remove();
        console.log(obj);
        obj.i = content.find('tr').length + 1;
        content.append(dom.fillString('<tr data-i="{k_id_onair}"><td>{i}</td><td><a href="' + app.urlTo('Documenter/documenterFields?id=') + '{k_id_onair}" target="_blank">#{k_id_onair} - {k_id_station.n_name_station} / {k_id_band.n_name_band}</td><td><div class="btn-group"><a href="' + app.urlTo('Documenter/documenterFields?id=') + '{k_id_onair}" target="_blank" class="btn btn-xs btn-default" title="Ver ticket"><i class="fa fa-fw fa-eye"></i></a><button class="btn btn-xs btn-danger btn-delete-relation" title="Eliminar"><i class="fa fa-fw fa-times"></i></button></div></td></tr>', obj));
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
                            content.append(dom.fillString('<tr class="saved" data-i="{k_id_onair}"><td>{i}</td><td><a href="' + app.urlTo('Documenter/documenterFields?id=') + '{k_id_onair}" target="_blank">#{k_id_onair} - {k_id_station.n_name_station} / {k_id_band.n_name_band}</td><td><div class="btn-group"><a href="' + app.urlTo('Documenter/documenterFields?id=') + '{k_id_onair}" target="_blank" class="btn btn-xs btn-default" title="Ver ticket"><i class="fa fa-fw fa-eye"></i></a><button class="btn btn-xs btn-danger btn-delete-relation" title="Eliminar"><i class="fa fa-fw fa-times"></i></button></div></td></tr>', obj));
                        }
                    } else {
                        content.html('<tr><td colspan="3"><i class="fa fa-fw fa-warning"></i> No se han agregado relaciones para este tikcet.</td></tr>');
                    }
                })
                .error(function (e) {
                    console.error(e)
                })
                .send();
    },
    getTickets: function (idStation) {
        console.log(idStation, " Se consulta por ese id");
        app.post('Utils/getTicketsByStations', {idStation: idStation})
                .success(function (response) {
                    var cmb = $('#cmbTicketRelation');
                    var data = app.parseResponse(response);
                    if (data && data.length > 0) {
                        rg.dataEstaciones = {};
                        cmb.html('');
                        var max = data.length;
                        for (var i = 0; i < max; i++) {
                            var obj = data[i];
                            rg.dataEstaciones[obj.k_id_onair] = obj;
                            obj.i = i + 1;
                            $el = $(dom.fillString('<option value="{k_id_onair}">#{k_id_onair} - {k_id_station.n_name_station} / {k_id_band.n_name_band}</option>', obj));
                            cmb.append($el);
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