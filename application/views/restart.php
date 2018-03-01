<!DOCTYPE html>
<html lang="en">
    <?php $this->load->view('parts/generic/head'); ?>
    <body data-base="<?= URL::base() ?>">
        <?php $this->load->view('parts/generic/header'); ?>
        <div class="container autoheight p-t-20">
            <form class="form-horizontal well" name="restartForm" id="restartForm" action="TicketOnair/recordRestart">
                <div class="panel-body">
                    <fieldset class="col-md-6 control-label">
                        <div class="form-group">
                            <label for="txtEstacion" class="col-md-3 control-label">Estación:</label>
                            <div class="col-md-8 selectContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-fw fa-street-view"></i></span>
                                    <input type="text" name="n_name_station" id="n_name_station" class="form-control" value="" readonly="false">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="txtBanda" class="col-md-3 control-label">Banda:</label>
                            <div class="col-md-8 selectContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-fw fa-signal"></i></span>
                                    <input type="text" name="n_name_band" id="n_name_band" class="form-control" value="" readonly="false">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="txtRegional" class="col-md-3 control-label">Regional:</label>
                            <div class="col-md-8 selectContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-fw fa-globe"></i></span>
                                    <input type="text" name="n_name_regional" id="n_name_regional" class="form-control" value="" readonly="false">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="txtIngeniero" class="col-md-3 control-label">Ingeniero:</label>
                            <div class="col-md-8 selectContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-fw fa-user"></i></span>
                                    <input type="text" name="n_name_user" id="n_name_user" class="form-control" value="" readonly="false">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="txtFechaIngresoOnAir" class="col-md-3 control-label">Fecha ingreso On Air:</label>
                            <div class="col-md-8 selectContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-fw fa-calendar"></i></span>
                                    <input type="text" name="txtFechaIngresoOnAir" id="txtFechaIngresoOnAir" class="form-control" value="" readonly="false" placeholder="DD/MM/AAAA">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="txtCRQ" class="col-md-3 control-label">CRQ:</label>
                            <div class="col-md-8 selectContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-fw fa-drivers-license"></i></span>
                                    <input type="text" name="n_crq" id="n_crq" class="form-control" value="" readonly="false">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="txtWP" class="col-md-3 control-label">WP:</label>
                            <div class="col-md-8 selectContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-fw fa-drivers-license"></i></span>
                                    <input type="text" name="n_wp" id="n_wp" class="form-control" value="" readonly="false">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="txtAtribuibleNokia2" class="col-md-3 control-label">Tipificacion solucion:</label>
                            <div class="col-md-8 selectContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-fw fa-location-arrow"></i></span>
                                    <select name="n_tipificacion_solucion" id="n_tipificacion_solucion" class="form-control selectpicker" required>
                                        <option value="">Seleccione</option>
                                        <option value="Actualización de DF">Actualización de DF</option>
                                        <option value="Ajuste cableado OVP">Ajuste cableado OVP</option>
                                        <option value="Ajuste de Sistema Radiante">Ajuste de Sistema Radiante</option>
                                        <option value="ajuste fisico RF">Ajuste fisico RF</option>
                                        <option value="Aval RF">Aval RF</option>
                                        <option value="Cambio de HW">Cambio de HW</option>
                                        <option value="Cambio de Jumper">Cambio de Jumper</option>
                                        <option value="Cambio de Parámetros">Cambio de Parámetros</option>
                                        <option value="Cambio de RET">Cambio de RET</option>
                                        <option value="Comportamiento Esperado Handover">Comportamiento Esperado Handover</option>
                                        <option value="Corrección de Parámetros">Corrección de Parámetros</option>
                                        <option value="Corrección de Políticas">Corrección de Políticas</option>
                                        <option value="Corrección física de transporte">Corrección física de transporte</option>
                                        <option value="Corrección Lógica Transporte">Corrección Lógica Transporte</option>
                                        <option value="Correción de Parámetros">Correción de Parámetros</option>
                                        <option value="Culminación de Actividades">Culminación de Actividades</option>
                                        <option value="Envio de Evidencias">Envio de Evidencias</option>
                                        <option value="Excepción GRI">Excepción GRI</option>
                                        <option value="No hay solución del Ejecutor">No hay solución del Ejecutor</option>
                                        <option value="Optimización Física RF">Optimización Física RF</option>
                                        <option value="Optimizacion logica RF">Optimizacion logica RF</option>
                                        <option value="Recomisionamiento">Recomisionamiento</option>
                                        <option value="Reinicio RF Module">Reinicio RF Module</option>
                                        <option value="Se corrige DF">Se corrige DF</option>
                                        <option value="Solución de Fallas de Energía">Solución de Fallas de Energía</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="txtUltimoSubestadoEscalamiento" class="col-md-3 control-label">Ultimo subestado de escalamiento:</label>
                            <div class="col-md-8 selectContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-fw fa-location-arrow"></i></span>
                                    <input type='text' name="n_ultimo_subestado_de_escalamiento" id="n_ultimo_subestado_de_escalamiento" class="form-control" value='' readonly>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="txtAtribuibleNokia2" class="col-md-3 control-label">Detalle solucion:</label>
                            <div class="col-md-8 selectContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-fw fa-location-arrow"></i></span>
                                    <!--<input type='text' name="n_detalle_solucion" id="n_detalle_solucion" class="form-control" >-->
                                    <textarea class="form-control" name="n_detalle_solucion" id="n_detalle_solucion" required></textarea>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <!--  fin seccion izquierda form---->

                    <!--  inicio seccion derecha form---->
                    <fieldset>
                        <div class="form-group">
                            <label for="txtTecnologia" class="col-md-3 control-label">Tecnología:</label>
                            <div class="col-md-8 selectContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-fw fa-tablet"></i></span>
                                    <input type="text" name="n_name_technology" id="n_name_technology" class="form-control" value="" readonly="false">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="txtTipotrabajo" class="col-md-3 control-label">Tipo de trabajo:</label>
                            <div class="col-md-8 selectContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-fw fa-briefcase"></i></span>
                                    <input type="text" name="n_name_ork" id="n_name_ork" class="form-control" value="" readonly="false">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="txtciudad" class="col-md-3 control-label">Ciudad:</label>
                            <div class="col-md-8 selectContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-fw fa-location-arrow"></i></span>
                                    <input type="text" name="n_name_city" id="n_name_city" class="form-control" value="" readonly="false">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="txtEnteEjecutor" class="col-md-3 control-label">Ente Ejecutor:</label>
                            <div class="col-md-8 selectContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-fw fa-address-book"></i></span>
                                    <input type="text" name="n_enteejecutor" id="n_enteejecutor" class="form-control" value="" readonly="false">

                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="txtEstado" class="col-md-3 control-label">Estado:</label>
                            <div class="col-md-8 selectContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-fw fa-thumbs-o-up"></i></span>
                                    <input type="text" name="n_name_status" id="n_name_status" class="form-control" value="" readonly="false">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="txtSubestado" class="col-md-3 control-label">Subestado:</label>
                            <div class="col-md-8 selectContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-fw fa-thumbs-o-up"></i></span>
                                    <input type="text" name="n_name_substatus" id="n_name_substatus" class="form-control" value="" readonly="false">
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
                            <label class="col-md-3 control-label">Observaciones de Creación</label>
                            <div class="col-md-8 inputGroupContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
                                    <textarea class="form-control" name="n_comentario_doc" id="n_comentario_doc" placeholder="Observaciones coordinador" readonly="false"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="cmbEstado" class="col-md-3 control-label">Estado:</label>
                            <div class="col-md-8 selectContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-fw fa-location-arrow"></i></span>
                                    <input type="text" name="txtStatus" id="txtStatus" class="form-control" value="Seguimiento FO" readonly="false">
                                    <input type="hidden" name="k_id_status" id="status" value="9" >
<!--                                    <select class="form-control" id="status" name="k_id_status" onchange="editSubstatus()" required>
                                        <option value="">Seleccione</option>
                                    </select>-->
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="cmbSubEstado" class="col-md-3 control-label">Subestado:</label>
                            <div class="col-md-8 selectContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-fw fa-location-arrow"></i></span>
                                    <select class="form-control" id="substatus" name="k_id_status_onair" required>
                                        <option value="">Seleccione</option>
                                        <option value="80">Reinicio Precheck</option>
                                        <option value="79">Reinicio 12H</option>
                                        <option value="108">Reinicio 24H</option>
                                        <option value="109">Reinicio 36H</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="cmbSubEstado" class="col-md-3 control-label">Persona que solicita el reinicio:</label>
                            <div class="col-md-8 selectContainer">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-fw fa-user"></i></span>
                                    <input type="text" class="form-control" name="solicitante_reinicio" />
                                </div>
                            </div>
                        </div>
                        <input type='hidden' name="k_id_onair" id="k_id_onair" class="form-control" value="<?= $_GET['id']; ?>" >
                        <input type='hidden' name="k_id_scaled_on_air" id="k_id_scaled_on_air" class="form-control" >
                    </fieldset>
                    <!--   fin seccion derecha---->
                </div>

                <!-- Button -->
                <center>
                    <div class="form-group">
                        <label class="col-md-12 control-label"></label>
                        <div class="col-md-12">
                            <button type="submit" id="btnAsignar" class="btn btn-success" onclick = "">Reiniciar <span class="fa fa-fw fa-undo"></span></button>
                        </div>
                    </div>
                </center>
            </form>

        </div>
        <!--footer Section -->
        <div class="for-full-back" id="footer">
            Zolid By ZTE Colombia | All Right Reserved
        </div>
        <?php $this->load->view('parts/generic/scripts'); ?>
        <!-- CUSTOM SCRIPT   -->
        <link href="<?= URL::to('assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') ?>" rel="stylesheet" type="text/css"/>
        <script>
            $(function () {
                var fields = <?php echo $fields; ?>;

                console.log(fields);

                for (var j = 0; j < fields.status.data.length; j++) {
                    $('#status').append($('<option>', {
                        value: fields.status.data[j].k_id_status,
                        text: fields.status.data[j].n_name_status
                    }));
                }

                var users = <?php echo $users; ?>;
                console.log(users);
                var cmb = $('#cmbSolicitanteReinicio');
                dom.llenarCombo(cmb, users.data, {text: ["n_name_user", "n_last_name_user"], value: "k_id_user"});
//                editSubstatus();

                $('input[name=n_name_station]').val(fields.k_id_station.n_name_station);
                $('input[name=n_name_band]').val(fields.k_id_band.n_name_band);
                $('input[name=n_name_regional]').val(fields.k_id_station.k_id_city.k_id_regional.n_name_regional);
                $('input[name=n_name_user]').val(fields.k_id_preparation.n_contratista);
                $('input[name=txtFechaIngresoOnAir]').val(fields.k_id_preparation.d_ingreso_on_air);
                $('input[name=n_crq]').val(fields.k_id_preparation.n_crq);
                $('input[name=n_wp]').val(fields.k_id_preparation.n_wp);
                $('input[name=n_name_technology]').val(fields.k_id_technology.n_name_technology);
                $('input[name=n_name_ork]').val(fields.k_id_work.n_name_ork);
                $('input[name=n_name_city]').val(fields.k_id_station.k_id_city.n_name_city);
                $('input[name=n_enteejecutor]').val(fields.k_id_preparation.n_enteejecutor);
                $('input[name=n_name_status]').val(fields.k_id_status_onair.k_id_status.n_name_status);
                $('input[name=n_name_substatus]').val(fields.k_id_status_onair.k_id_substatus.n_name_substatus);
                $('input[name=n_bcf_wbts_id]').val(fields.k_id_preparation.n_bcf_wbts_id);
                $('textarea[name=n_comentario_doc]').val(fields.k_id_preparation.n_comentario_doc);
                $('input[name=n_ultimo_subestado_de_escalamiento]').val(fields.k_id_status_onair.k_id_substatus.n_name_substatus);
                if (fields.scaledOnair !== null) {
                    $('input[name=k_id_scaled_on_air]').val(fields.scaledOnair.k_id_scaled_on_air);
                }

                if (fields.i_precheck_realizado === null) {
                    $('#substatus option[value="80"]').attr('selected', 'selected');
                } else {
                    $('#substatus option[value="79"]').attr('selected', 'selected');
                }

            });

            function editSubstatus() {
                var status = $("#status").val();
                var info = <?php echo $fields; ?>;
                $('#substatus').empty();
                for (var j = 0; j < info.statusOnAir.data.length; j++) {
                    if (status === info.statusOnAir.data[j].k_id_status) {
                        $('#substatus').append($('<option>', {
                            value: info.statusOnAir.data[j].k_id_status_onair,
                            text: info.statusOnAir.data[j].n_name_substatus
                        }));
                    }
                }
            }
        </script>

        <script src="<?= URL::to('assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js?v=1') ?>" type="text/javascript"></script>
        <script src="<?= URL::to('assets/plugins/jquery.mask.js') ?>" type="text/javascript"></script>
        <script src="<?= URL::to("assets/plugins/jquery.validate.min.js") ?>" type="text/javascript"></script>
        <script src="<?= URL::to("assets/plugins/HelperForm.js?v=1.0") ?>" type="text/javascript"></script>
        <script type="text/javascript">
            $(function () {
                dom.submit($('#restartForm'), function () {
                    window.location = app.urlTo('User/principal');
                }, false);
            })
            // , function(){location.href = app.urlTo('User/principalView');}
        </script>
    </body>
</html>
