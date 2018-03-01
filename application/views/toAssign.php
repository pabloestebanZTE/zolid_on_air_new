<!DOCTYPE html>
<html lang="es">
    <?php $this->load->view('parts/generic/head'); ?>
    <body data-base="<?= URL::base() ?>">
        <?php $this->load->view('parts/generic/header'); ?>
        <div class="container autoheight">
            <div class='tab-content' id='tab3'><brt><br>
                    <div class="container">
                        <form class="well form-horizontal" action="TicketOnair/assignTicket" method="post"  id="assignEng" name="assignEng">
                            <div class="alert alert-success alert-dismissable hidden">
                                <a href="#" class="close" >&times;</a>
                                <p class="p-b-0" id="text"></p>
                            </div>
                            <legend>Asignar Actividad</legend>
                            <fieldset class="col-md-6 control-label">
                                <div class="form-group">
                                    <label for="txtEstacion" class="col-md-3 control-label">Estacion:</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-street-view"></i></span>
                                            <input type='text' name="txtEstacion" id="txtEstacion" class="form-control" value='' readonly="false">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="txtCiudad" class="col-md-3 control-label">Ciudad:</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-location-arrow"></i></span>
                                            <input type='text' name="txtCiudad" id="txtCiudad" class="form-control" value='' readonly="false">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="txtRegional" class="col-md-3 control-label">Regional:</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-globe"></i></span>
                                            <input type='text' name="txtRegional" id="txtRegional" class="form-control" value='' readonly="false">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="txtCiudad" class="col-md-3 control-label">Ente Ejecutor:</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-address-book"></i></span>
                                            <input type='text' name="txtEnte" id="txtEnte" class="form-control" value='' readonly="false">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="txtCiudad" class="col-md-3 control-label">CRQ:</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-id-card"></i></span>
                                            <input type='text' name="txtCRQ" id="txtCRQ" class="form-control" value='' readonly="false">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="txtCiudad" class="col-md-3 control-label">WP:</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-id-card"></i></span>
                                            <input type='text' name="txtWP" id="txtWP" class="form-control" value='' readonly="false">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="txtwbts" class="col-md-3 control-label">WBTS:</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-drivers-license"></i></span>
                                            <input type="text" name="n_bcf_wbts_id" id="n_bcf_wbts_id" class="form-control" value="" readonly="false">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="txtCiudad" class="col-md-3 control-label">Fecha Ingreso On-Air:</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-calendar-o"></i></span>
                                            <input type='text' name="txtFecha" id="txtFecha" class="form-control" value='' readonly="false">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="cbmIngeniero" class="col-md-3 control-label">Ingeniero:</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-user"></i></span>
                                            <select name="k_id_user" id="k_id_user" class="form-control selectpicker" required>
                                                <option value="" >Seleccione el ingeniero</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <!--  fin seccion izquierda form---->

                            <!--  inicio seccion derecha form---->
                            <fieldset>
                                <div class="form-group">
                                    <label for="txtTecnologia" class="col-md-3 control-label">Tecnologia:</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-tablet"></i></span>
                                            <input type='text' name="txtTecnologia" id="txtTecnologia" class="form-control" value='' readonly="false">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="txtTipotrabajo" class="col-md-3 control-label">Tipo de trabajo:</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-briefcase"></i></span>
                                            <input type='text' name="txtTipotrabajo" id="txtTipotrabajo" class="form-control" value='' readonly="false">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="txtBanda" class="col-md-3 control-label">Banda:</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-signal"></i></span>
                                            <input type='text' name="txtBanda" id="txtBanda" class="form-control" value='' readonly="false">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="txtCiudad" class="col-md-3 control-label">Estado:</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-thumbs-o-up"></i></span>
                                            <input type='text' name="txtEstado" id="txtEstado" class="form-control" value='' readonly="false">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="txtCiudad" class="col-md-3 control-label">Subestado:</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-thumbs-o-up"></i></span>
                                            <input type='text' name="txtSubestado" id="txtSubestado" class="form-control" value='' readonly="false">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Observaciones de Creación</label>
                                    <div class="col-md-8 inputGroupContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
                                            <textarea class="form-control" name="n_comentario_doc" id="n_comentario_doc" placeholder="Observaciones Creación" readonly="false"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Observaciones de Asignación:</label>
                                    <div class="col-md-8 inputGroupContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
                                            <textarea class="form-control" name="n_comentario_coor" id="n_comentario_coor" placeholder="Observaciones de asignación"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                if (isset($tck) && $tck->k_id_status_onair["k_id_status_onair"] == ConstStates::STAND_BY_SEGUIMIENTO_FO) {
                                    ?>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Estado StandBy:</label>
                                        <div class="col-md-8 inputGroupContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-caret-right"></i></span>
                                                <select class="form-control" id="cmbEstadoStandBy" name="new_state_standby">
                                                    <option value="">Seleccione</option>
                                                    <option value="<?= ConstStates::PRECHECK ?>" <?= (isset($stateStandBy) && $stateStandBy == ConstStates::PRECHECK) ? 'selected="true" data-selected="true"' : '' ?>>Precheck</option>
                                                    <option value="<?= ConstStates::SEGUIMIENTO_12H ?>" <?= (isset($stateStandBy) && $stateStandBy == ConstStates::SEGUIMIENTO_12H) ? 'selected="true" data-selected="true"' : '' ?>>Seguimiento 12h</option>
                                                    <option value="<?= ConstStates::SEGUIMIENTO_24H ?>" <?= (isset($stateStandBy) && $stateStandBy == ConstStates::SEGUIMIENTO_24H) ? 'selected="true" data-selected="true"' : '' ?>>Seguimiento 24h</option>
                                                    <option value="<?= ConstStates::SEGUIMIENTO_36H ?>" <?= (isset($stateStandBy) && $stateStandBy == ConstStates::SEGUIMIENTO_36H) ? 'selected="true" data-selected="true"' : '' ?>>Seguimiento 36h</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group" id="reloadTimePanel">
                                        <label class="col-md-3 control-label">Recuperar tiempo:</label>
                                        <div class="col-md-8 inputGroupContainer">
                                            <div class="input-group">
                                                <span disabled="true" id="txtTimeStandBy" class="form-control" >--:--</span>
                                                <div class="input-group-btn"><button type="button" id="btnRecuperarTiempo" title="Recuperar tiempo" class="btn btn-primary"><i class="fa fa-fw fa-undo"></i> Recuperar</button></div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                            </fieldset>
                            <input type='hidden' name="k_id_ticket" id="k_id_ticket" class="form-control" value='' readonly="false">

                            <!--   fin seccion derecha---->

                            <!-- Button -->
                            <center>
                                <div class="form-group">
                                    <label class="col-md-12 control-label"></label>
                                    <div class="col-md-12">
                                        <button type="submit" id="btnAsignar" class="btn btn-success" onclick = "">Asignar <span class="fa fa-fw fa-user-plus"></span></button>
                                    </div>
                                </div>
                            </center>
                        </form>
                    </div>
            </div>
        </div>
        <!--footer Section -->
        <div class="for-full-back" id="footer">
            Zolid By ZTE Colombia | All Right Reserved
        </div>
        <?php $this->load->view('parts/generic/scripts'); ?>
        <!-- CUSTOM SCRIPT   -->
        <script>
            $(function () {
                ticket = <?php echo $ticket; ?>;
                var users = <?php echo $users; ?>;
                var valuesTime = <?= isset($valuesTime) ? $valuesTime : "null"; ?>;
                if (valuesTime && $('#cmbEstadoStandBy').val() > 0) {
                    dom.timer($('#txtTimeStandBy'), null, null, valuesTime);
                } else {
                    $('#reloadTimePanel').hide();
                }
                for (var j = 0; j < users.data.length; j++) {
                    $('#k_id_user').append($('<option>', {
                        value: users.data[j].k_id_user,
                        text: users.data[j].n_name_user + " " + users.data[j].n_last_name_user + " (" + users.data[j].n_code_user + ") "
                    }));
                }
                console.log(ticket);
                $('input[name=txtEstacion]').val(ticket.k_id_station.n_name_station);
                $('input[name=txtBanda]').val(ticket.k_id_band.n_name_band);
                $('input[name=txtRegional]').val(ticket.k_id_station.k_id_city.k_id_regional.n_name_regional);
                $('input[name=txtTecnologia]').val(ticket.k_id_technology.n_name_technology);
                $('input[name=txtTipotrabajo]').val(ticket.k_id_work.n_name_ork);
                $('input[name=txtCiudad]').val(ticket.k_id_station.k_id_city.n_name_city);
                $('input[name=txtEnte]').val(ticket.k_id_preparation.n_enteejecutor);
                $('input[name=txtCRQ]').val(ticket.k_id_preparation.n_crq);
                $('input[name=txtWP]').val(ticket.k_id_preparation.n_wp);
                $('input[name=txtFecha]').val(ticket.k_id_preparation.d_ingreso_on_air);
                $('input[name=txtEstado]').val(ticket.k_id_status_onair.k_id_status.n_name_status);
                $('input[name=txtSubestado]').val(ticket.k_id_status_onair.k_id_substatus.n_name_substatus);
                $('input[name=n_bcf_wbts_id]').val(ticket.k_id_preparation.n_bcf_wbts_id);
                $('textarea[name=n_comentario_doc]').val(ticket.k_id_preparation.n_comentario_doc);
                $('input[name=k_id_ticket]').val(ticket.k_id_onair);
                $('textarea[name=n_comentario_coor]').val(ticket.n_comentario_coor);

                $('#btnRecuperarTiempo').on('click', function () {
                    var btn = $(this);
                    if (btn.hasClass('added')) {
                        btn.attr('class', 'btn btn-primary');
                        btn.html('<i class="fa fa-fw fa-undo"></i> Recuperar').attr('title', 'Recupearar Tiempo');
                        $('#txtTimeStandBy').parent().removeClass('has-success');
                        $('#hdnReloadTime').remove();
                    } else {
                        btn.attr('class', 'btn btn-default added');
                        btn.html('<i class="fa fa-fw fa-times"></i> Cancelar').attr('title', 'Cancelar');
                        $('#txtTimeStandBy').parent().addClass('has-success');
                        $('#assignEng').append('<input type="hidden" name="reload_time" value="true" id="hdnReloadTime" />');
                    }
                });


                $('#cmbEstadoStandBy').on('change', function () {
                    var cmb = $(this);
                    var v = cmb.find('option:selected').attr('data-selected') == "true";
                    if (v) {
                        $('#reloadTimePanel').show();
                    } else {
                        var btn = $('#btnRecuperarTiempo');
                        btn.attr('class', 'btn btn-primary');
                        btn.html('<i class="fa fa-fw fa-undo"></i> Recuperar').attr('title', 'Recupearar Tiempo');
                        $('#txtTimeStandBy').parent().removeClass('has-success');
                        $('#hdnReloadTime').remove();
                        $('#reloadTimePanel').hide();
                    }
                });

            })
        </script>
        <link href="<?= URL::to("assets/plugins/select2/select2.css") ?>" rel="stylesheet" type="text/css"/>
        <script src="<?= URL::to("assets/plugins/select2/select2.js") ?>" type="text/javascript"></script>
        <script src="<?= URL::to("assets/plugins/jquery.validate.min.js") ?>" type="text/javascript"></script>
        <script src="<?= URL::to("assets/plugins/HelperForm.js?v=1.0") ?>" type="text/javascript"></script>
        <script type="text/javascript">
            $(function () {
                dom.submit($('#assignEng'), function () {
                    location.href = app.urlTo('User/principalView');
                });
                $('select').select2({width: '100%'});
            })
        </script>
        <script src="<?= URL::to("assets/plugins/jquery.validate.min.js") ?>" type="text/javascript"></script>
        <script src="<?= URL::to("assets/plugins/HelperForm.js?v=1.0") ?>" type="text/javascript"></script>
        <script type="text/javascript">
            $(function () {
                dom.submit($('#assignEng'), function () {
                    location.href = app.urlTo('User/principalView');
                });
            })
            // , function(){location.href = app.urlTo('User/principalView');}
        </script>
    </body>
</html>