<!DOCTYPE html>
<html lang="en">
    <?php $this->load->view('parts/generic/head'); ?>
    <body data-base="<?= URL::base() ?>">
        <?php $this->load->view('parts/generic/header'); ?>
        <div class="container autoheight">
            <div class='tab-content' id='tab3'><brt><br>
                    <div class="container">
                        <form class="well form-horizontal" action="TicketOnair/assignTicket" method="post"  id="assignEng" name="assignEng">
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
                                    <label for="txtCiudad" class="col-md-3 control-label">Fecha Ingreso On-Air:</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-calendar-o"></i></span>
                                            <input type='text' name="txtFecha" id="txtFecha" class="form-control" value='' readonly="false">
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
                var ticket = <?php echo $ticket; ?>;
                var users = <?php echo $users; ?>;

                for (var j = 0; j < users.data.length; j++) {
                    $('#k_id_user').append($('<option>', {
                        value: users.data[j].k_id_user,
                        text: users.data[j].n_name_user + " " + users.data[j].n_last_name_user
                    }));
                }
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
                $('input[name=k_id_ticket]').val(ticket.k_id_onair);

            })
        </script>
        <script src="<?= URL::to("assets/plugins/jquery.validate.min.js") ?>" type="text/javascript"></script>
        <script src="<?= URL::to("assets/plugins/HelperForm.js") ?>" type="text/javascript"></script>
        <script type="text/javascript">
            $(function () {
                dom.submit($('#assignEng'), function () {
                    location.href = app.urlTo('User/principalView');
                });
            })
        </script>
        <script src="<?= URL::to("assets/plugins/jquery.validate.min.js") ?>" type="text/javascript"></script>
        <script src="<?= URL::to("assets/plugins/HelperForm.js") ?>" type="text/javascript"></script>
        <script type="text/javascript">
        $(function(){
          dom.submit($('#assignEng'));
        })
        // , function(){location.href = app.urlTo('User/principalView');}
        </script>
    </body>
</html>
