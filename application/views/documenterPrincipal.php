<!DOCTYPE html>
<html lang="en">
    <?php $this->load->view('parts/generic/head'); ?>
    <body data-base="<?= URL::base() ?>">
        <?php $this->load->view('parts/generic/header'); ?>
        <div class="container autoheight p-t-20">
            <div class="alert alert-success alert-dismissable hidden" id="principalAlert">
                <a href="#" class="close">&times;</a>
                <p id="text" class="m-b-0 p-b-0"></p>
            </div>
            <div class="col-md-12 hidden" id="trackingDetails">
                <div class="panel-group" id="accordion">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse1"><i class="fa fa-fw fa-info"></i> Información básica</a>
                            </h4>
                        </div>
                        <div id="collapse1" class="panel-collapse collapse in">
                            <div class="panel-body">

                                <form class="form-horizontal well">

                                    <div class="panel-body">
                                        <fieldset class="col-md-6 control-label">
                                            <div class="form-group">
                                                <label for="txtEstacion" class="col-md-3 control-label">Estación:</label>
                                                <div class="col-md-8 selectContainer">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-fw fa-street-view"></i></span>
                                                        <input type="text" name="k_id_station.n_name_station" id="txtEstacion" class="form-control" value="" readonly="false">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="txtBanda" class="col-md-3 control-label">Banda:</label>
                                                <div class="col-md-8 selectContainer">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-fw fa-signal"></i></span>
                                                        <input type="text" name="k_id_band.n_name_band" id="txtBanda" class="form-control" value="" readonly="false">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="txtRegional" class="col-md-3 control-label">Regional:</label>
                                                <div class="col-md-8 selectContainer">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-fw fa-globe"></i></span>
                                                        <input type="text" name="k_id_regional.n_name_regional" id="txtRegional" class="form-control" value="" readonly="false">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="txtIngeniero" class="col-md-3 control-label">Ingeniero:</label>
                                                <div class="col-md-8 selectContainer">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-fw fa-user"></i></span>
                                                        <input type="text" name="txtIngeniero" id="txtIngeniero" class="form-control" value="" readonly="false">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="txtFechaIngresoOnAir" class="col-md-3 control-label">Fecha ingreso On Air:</label>
                                                <div class="col-md-8 selectContainer">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-fw fa-calendar"></i></span>
                                                        <input type="text" name="txtFechaIngresoOnAir" id="txtFechaIngresoOnAir" class="form-control" value="" readonly="false" maxlength="10" placeholder="DD/MM/AAAA">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="txtCRQ" class="col-md-3 control-label">CRQ:</label>
                                                <div class="col-md-8 selectContainer">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-fw fa-drivers-license"></i></span>
                                                        <input type="text" name="k_id_preparation.n_crq" id="txtCRQ" class="form-control" value="" readonly="false">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="txtWP" class="col-md-3 control-label">WP:</label>
                                                <div class="col-md-8 selectContainer">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-fw fa-drivers-license"></i></span>
                                                        <input type="text" name="k_id_preparation.n_wp" id="txtWP" class="form-control" value="" readonly="false">
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
                                                        <input type="text" name="k_id_technology.n_name_technology" id="txtTecnologia" class="form-control" value="" readonly="false">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="txtTipotrabajo" class="col-md-3 control-label">Tipo de trabajo:</label>
                                                <div class="col-md-8 selectContainer">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-fw fa-briefcase"></i></span>
                                                        <input type="text" name="k_id_work.n_name_ork" id="txtTipotrabajo" class="form-control" value="" readonly="false">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="txtciudad" class="col-md-3 control-label">Ciudad:</label>
                                                <div class="col-md-8 selectContainer">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-fw fa-location-arrow"></i></span>
                                                        <input type="text" name="k_id_station.k_id_city.n_name_city" id="txtciudad" class="form-control" value="" readonly="false">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="txtEnteEjecutor" class="col-md-3 control-label">Ente Ejecutor:</label>
                                                <div class="col-md-8 selectContainer">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-fw fa-address-book"></i></span>
                                                        <input type="text" name="txtEnteEjecutor" id="txtEnteEjecutor" class="form-control" value="" readonly="false">

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="txtEstado" class="col-md-3 control-label">Estado:</label>
                                                <div class="col-md-8 selectContainer">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-fw fa-thumbs-o-up"></i></span>
                                                        <input type="text" name="k_id_status_onair.k_id_status.n_name_status" id="txtEstado" class="form-control" value="" readonly="false">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="txtSubestado" class="col-md-3 control-label">Subestado:</label>
                                                <div class="col-md-8 selectContainer">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-fw fa-thumbs-o-up"></i></span>
                                                        <input type="text" name="k_id_status_onair.k_id_substatus.n_name_substatus" id="txtSubestado" class="form-control" value="" readonly="false">
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                        <!--   fin seccion derecha---->
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse2"><i class="fa fa-fw fa-list"></i> Detalles</a>
                            </h4>
                        </div>
                        <div id="collapse2" class="panel-collapse collapse">
                            <div class="panel-body">
                                <form class="form-horizontal well"  action="Documenter/updateDetails" method="post"  id="detailsForm" name="detailsForm">
                                    <div class="panel-body">
                                        <div class="alert alert-success alert-dismissable hidden" id="principalAlert">
                                            <a href="#" class="close">&times;</a>
                                            <p id="text" class="m-b-0 p-b-0"></p>
                                        </div>
                                        <fieldset class="col-md-6 control-label">
                                            <div class="form-group">
                                                <label for="txtIntegrador" class="col-md-3 control-label">Integrador:</label>
                                                <div class="col-md-8 selectContainer">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-fw fa-user"></i></span>
                                                        <input type="text" name="n_integrador" id="n_integrador" class="form-control" value="" >

                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="cmbTestGestion" class="col-md-3 control-label">Test gestión:</label>
                                                <div class="col-md-8 selectContainer">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-fw fa-check-circle"></i></span>
                                                        <select name="n_testgestion" id="n_testgestion" class="form-control selectpicker" required>
                                                            <option value="ABIERTO">ABIERTO</option>
                                                            <option value="CERRADO">CERRADO</option>
                                                            <option value="NA">NA</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="cmbSitioLimpio" class="col-md-3 control-label">Sitio limpio:</label>
                                                <div class="col-md-8 selectContainer">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-fw fa-check-circle"></i></span>
                                                        <select name="n_sitiolimpio" id="n_sitiolimpio" class="form-control selectpicker" required>
                                                            <option value="ABIERTO">ABIERTO</option>
                                                            <option value="CERRADO">CERRADO</option>
                                                            <option value="NA">NA</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="cmbInstalacionHWSitio" class="col-md-3 control-label">Instalación HW Sitio:</label>
                                                <div class="col-md-8 selectContainer">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-fw fa-unlock"></i></span>
                                                        <select name="n_instalacion_hw_sitio" id="n_instalacion_hw_sitio" class="form-control selectpicker" required>
                                                            <option value="ABIERTO">ABIERTO</option>
                                                            <option value="CERRADO">CERRADO</option>
                                                            <option value="NA">NA</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="cmbCambiosConfigSolicitados" class="col-md-3 control-label">Cambios config solicitados:</label>
                                                <div class="col-md-8 selectContainer">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-fw fa-unlock"></i></span>
                                                        <select name="n_cambios_config_solicitados" id="n_cambios_config_solicitados" class="form-control selectpicker" required>
                                                            <option value="ABIERTO">ABIERTO</option>
                                                            <option value="CERRADO">CERRADO</option>
                                                            <option value="NA">NA</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="cmbCambiosConfigFinal" class="col-md-3 control-label">Cambios config final:</label>
                                                <div class="col-md-8 selectContainer">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-fw fa-unlock"></i></span>
                                                        <select name="n_cambios_config_final" id="n_cambios_config_final" class="form-control selectpicker" required>
                                                            <option value="ABIERTO">ABIERTO</option>
                                                            <option value="CERRADO">CERRADO</option>
                                                            <option value="NA">NA</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="txtContratista" class="col-md-3 control-label">Contratista:</label>
                                                <div class="col-md-8 selectContainer">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-fw fa-user"></i></span>
                                                        <input type="text" class="form-control input-sm" id="n_contratista" name="n_contratista" value="" />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="cmbIntegracionGestionTrafica" class="col-md-3 control-label">integración Gestión y Trafica:</label>
                                                <div class="col-md-8 selectContainer">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-fw fa-check-circle"></i></span>
                                                        <select name="n_integracion_gestion_y_trafica" id="n_integracion_gestion_y_trafica" class="form-control selectpicker" required>
                                                            <option value="ABIERTO">ABIERTO</option>
                                                            <option value="CERRADO">CERRADO</option>
                                                            <option value="NA">NA</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="cmbPuestaServicioSitioNuevoLTE" class="col-md-3 control-label">Puesta Servicio Sitio Nuevo LTE:</label>
                                                <div class="col-md-8 selectContainer">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-fw fa-check-circle"></i></span>
                                                        <select name="puesta_servicio_sitio_nuevo_lte" id="puesta_servicio_sitio_nuevo_lte" class="form-control selectpicker" required>
                                                            <option value="ABIERTO">ABIERTO</option>
                                                            <option value="CERRADO">CERRADO</option>
                                                            <option value="NA">NA</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="cmbInstalacionHW4GSitio" class="col-md-3 control-label">instalación HW 4G Sitio:</label>
                                                <div class="col-md-8 selectContainer">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-fw fa-check-circle"></i></span>
                                                        <select name="n_instalacion_hw_4g_sitio" id="n_instalacion_hw_4g_sitio" class="form-control selectpicker" required>
                                                            <option value="ABIERTO">ABIERTO</option>
                                                            <option value="CERRADO">CERRADO</option>
                                                            <option value="NA">NA</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                        <!--  fin seccion izquierda form---->

                                        <!--  inicio seccion derecha form---->
                                        <fieldset>
                                            <div class="form-group">
                                                <label for="cmbPrelaunch" class="col-md-3 control-label">Prelaunch:</label>
                                                <div class="col-md-8 selectContainer">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-fw fa-check-circle"></i></span>
                                                        <select name="pre_launch" id="pre_launch" class="form-control selectpicker" required>
                                                            <option value="ABIERTO">ABIERTO</option>
                                                            <option value="CERRADO">CERRADO</option>
                                                            <option value="NA">NA</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="txtEvidenciaSL" class="col-md-3 control-label">Evidencia SL:</label>
                                                <div class="col-md-8 selectContainer">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-fw fa-file-text"></i></span>
                                                        <input type="text" class="form-control input-sm" id="n_evidenciasl" name="n_evidenciasl" value="" />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="txtEvidenciaTG" class="col-md-3 control-label">Evidencia TG:</label>
                                                <div class="col-md-8 selectContainer">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-fw fa-file-text"></i></span>
                                                        <input type="text" class="form-control input-sm" id="n_evidenciatg" name="n_evidenciatg" value="" />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="txtIDRFTools" class="col-md-3 control-label">ID RFTools:</label>
                                                <div class="col-md-8 selectContainer">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-fw fa-key"></i></span>
                                                        <input type="text" class="form-control input-sm" id="id_rftools" name="id_rftools" value="" />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="txtLiderCambio" class="col-md-3 control-label">Líder Cambio:</label>
                                                <div class="col-md-8 selectContainer">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-fw fa-user"></i></span>
                                                        <input type="text" class="form-control input-sm" id="i_lider_cambio" name="i_lider_cambio" value="" />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="txtLiderCuadrilla" class="col-md-3 control-label">Líder Cuadrilla:</label>
                                                <div class="col-md-8 selectContainer">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-fw fa-user"></i></span>
                                                        <input type="text" class="form-control input-sm" id="i_lider_cuadrilla" name="i_lider_cuadrilla" value="" />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="cmbImplementacionCampo" class="col-md-3 control-label">Implementación Campo:</label>
                                                <div class="col-md-8 selectContainer">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-fw fa-unlock"></i></span>
                                                        <select name="n_implementacion_campo" id="n_implementacion_campo" class="form-control selectpicker" required>
                                                            <option value="ABIERTO">ABIERTO</option>
                                                            <option value="CERRADO">CERRADO</option>
                                                            <option value="NA">NA</option>                                                            <option value="TAREA">TAREA</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="cmbGestionPower" class="col-md-3 control-label">Gestión Power:</label>
                                                <div class="col-md-8 selectContainer">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-fw fa-unlock"></i></span>
                                                        <select name="n_gestion_power" id="n_gestion_power" class="form-control selectpicker" required>
                                                            <option value="ABIERTO">ABIERTO</option>
                                                            <option value="CERRADO">CERRADO</option>
                                                            <option value="NA">NA</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="cmbObraCivil" class="col-md-3 control-label">Obra Civil:</label>
                                                <div class="col-md-8 selectContainer">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-fw fa-unlock"></i></span>
                                                        <select name="n_obra_civil" id="n_obra_civil" class="form-control selectpicker" required>
                                                            <option value="ABIERTO">ABIERTO</option>
                                                            <option value="CERRADO">CERRADO</option>
                                                            <option value="NA">NA</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="cmbOnAIR" class="col-md-3 control-label">On AIR:</label>
                                                <div class="col-md-8 selectContainer">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-fw fa-unlock"></i></span>
                                                        <select name="on_air" id="on_air" class="form-control selectpicker" required>
                                                            <option value="ABIERTO">ABIERTO</option>
                                                            <option value="CERRADO">CERRADO</option>
                                                            <option value="NA">NA</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="cmbNOC" class="col-md-3 control-label">NOC:</label>
                                                <div class="col-md-8 selectContainer">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-fw fa-building"></i></span>
                                                        <select name="n_noc" id="n_noc" class="form-control selectpicker" required>
                                                            <option value="NOKIA">NOKIA</option>
                                                            <option value="NOKIA_ZTE">NOKIA ZTE</option>
                                                            <option value="SEGUIMIENTO_FO">SIGUIMIENTO FO</option>
                                                            <option value="ZTE">ZTE</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="txtLac" class="col-md-3 control-label">LAC:</label>
                                                <div class="col-md-8 selectContainer">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-fw fa-user"></i></span>
                                                        <input type="text" class="form-control input-sm" id="txtLac" name="txtLac" value="" />
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="txtSac" class="col-md-3 control-label">SAC:</label>
                                                <div class="col-md-8 selectContainer">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-fw fa-user"></i></span>
                                                        <input type="text" class="form-control input-sm" id="txtSac" name="txtSac" value="" />
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="txtRac" class="col-md-3 control-label">RAC:</label>
                                                <div class="col-md-8 selectContainer">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-fw fa-user"></i></span>
                                                        <input type="text" class="form-control input-sm" id="txtRac" name="txtRac" value="" />
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <input type="hidden" class="form-control input-sm" id="k_id_ticket" name="k_id_ticket" value="" />
                                            <input type="hidden" class="form-control input-sm" id="k_id_prep" name="k_id_prep" value="" />
                                        </fieldset>
                                        <!--   fin seccion derecha---->

                                        <!-- Button -->
                                        <center>
                                            <div class="form-group">
                                                <label class="col-md-12 control-label"></label>
                                                <div class="col-md-12">
                                                    <button type="submit" id="btnGuardar" class="btn btn-primary" onclick = "">Guardar <span class="fa fa-fw fa-floppy-o"></span></button>
                                                </div>
                                            </div>
                                        </center>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="well">
                    <div class="col-xs-12 text-right">
                        <div class="display-block pull-right" style="width: 300px;">
                            <div class="col-xs-4 text-right p-r-0 p-t-5">
                                <label class="">Grupos:</label>
                            </div>
                            <div class="col-xs-8 p-r-0">
                                <select class="form-control" id="cmbGruposTracking">
                                    <option value="">Seleccione</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="display-block">
                        <div class="hour-step active">
                            <div class="body-step">
                                <label>12H</label>
                                <span class="icon-step"><i class="fa fa-fw fa-clock-o"></i></span>
                            </div>
                            <div class="back-progress-step">
                                <span class="progress-step" style="width: 30%;"></span>
                            </div>
                            <div class="footer-step">
                                <label id="timeStep"><i class="fa fa-fw fa-clock-o"></i> -01:35</label>
                            </div>
                        </div>
                        <div class="hour-step">
                            <div class="body-step">
                                <label>24H</label>
                                <span class="icon-step"><i class="fa fa-fw fa-clock-o"></i></span>
                            </div>
                            <div class="back-progress-step">
                                <span class="progress-step"></span>
                            </div>
                            <div class="footer-step">
                                <label id="timeStep"><i class="fa fa-fw fa-clock-o"></i> -00:00</label>
                            </div>
                        </div>
                        <div class="hour-step">
                            <div class="body-step">
                                <label>36H</label>
                                <span class="icon-step"><i class="fa fa-fw fa-clock-o"></i></span>
                            </div>
                            <div class="back-progress-step">
                                <span class="progress-step"></span>
                            </div>
                            <div class="footer-step">
                                <label id="timeStep"><i class="fa fa-fw fa-clock-o"></i> -00:00</label>
                            </div>
                        </div>
                    </div>
                    <div class="well white p-t-5 p-b-5 p-r-5 p-l-5">
                        <div class="well m-b-0">
                            <table id="tblTrackingDetails" class="table table-hover table-condensed table-striped"></table>
                        </div>
                    </div>
                </div>
            </div>

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
                $('input[name=n_integrador]').val(fields.k_id_preparation.n_integrador);
                $('#n_testgestion option[value="' + fields.k_id_preparation.n_testgestion + '"]').attr('selected', 'selected');
                $('#n_sitiolimpio option[value="' + fields.k_id_preparation.n_sitiolimpio + '"]').attr('selected', 'selected');
                $('#n_instalacion_hw_sitio option[value="' + fields.k_id_preparation.n_instalacion_hw_sitio + '"]').attr('selected', 'selected');
                $('#n_cambios_config_solicitados option[value="' + fields.k_id_preparation.n_cambios_config_solicitados + '"]').attr('selected', 'selected');
                $('#n_cambios_config_final option[value="' + fields.k_id_preparation.n_cambios_config_final + '"]').attr('selected', 'selected');
                $('input[name=n_contratista]').val(fields.k_id_preparation.n_contratista);
                $('#n_integracion_gestion_y_trafica option[value="' + fields.k_id_preparation.n_integracion_gestion_y_trafica + '"]').attr('selected', 'selected');
                $('#puesta_servicio_sitio_nuevo_lte option[value="' + fields.k_id_preparation.puesta_servicio_sitio_nuevo_lte + '"]').attr('selected', 'selected');
                $('#n_instalacion_hw_4g_sitio option[value="' + fields.k_id_preparation.n_instalacion_hw_4g_sitio + '"]').attr('selected', 'selected');
                $('#pre_launch option[value="' + fields.k_id_preparation.pre_launch + '"]').attr('selected', 'selected');
                $('input[name=n_evidenciasl]').val(fields.k_id_preparation.n_evidenciasl);
                $('input[name=n_evidenciatg]').val(fields.k_id_preparation.n_evidenciatg);
                $('input[name=id_rftools]').val(fields.k_id_preparation.id_rftools);
                $('input[name=i_lider_cambio]').val(fields.i_lider_cambio);
                $('input[name=i_lider_cuadrilla]').val(fields.i_lider_cuadrilla);
                $('#n_implementacion_campo option[value="' + fields.n_implementacion_campo + '"]').attr('selected', 'selected');
                $('#n_gestion_power option[value="' + fields.n_gestion_power + '"]').attr('selected', 'selected');
                $('#n_obra_civil option[value="' + fields.n_obra_civil + '"]').attr('selected', 'selected');
                $('#on_air option[value="' + fields.on_air + '"]').attr('selected', 'selected');
                $('#n_noc option[value="' + fields.n_noc + '"]').attr('selected', 'selected');
                $('input[name=k_id_ticket]').val(fields.k_id_onair);
                $('input[name=k_id_prep]').val(fields.k_id_preparation.k_id_preparation);

            })
        </script>
        <script src="<?= URL::to('assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js?v=1') ?>" type="text/javascript"></script>
        <script src="<?= URL::to('assets/plugins/jquery.mask.js') ?>" type="text/javascript"></script>
        <script src="<?= URL::to('assets/js/modules/documenterPrincipal.js') ?>" type="text/javascript"></script>
        <script src="<?= URL::to("assets/plugins/jquery.validate.min.js") ?>" type="text/javascript"></script>
        <script src="<?= URL::to("assets/plugins/HelperForm.js") ?>" type="text/javascript"></script>
        <script type="text/javascript">
            $(function () {
                dom.submit($('#detailsForm'), null, false);
            })
            // , function(){location.href = app.urlTo('User/principalView');}
        </script>
    </body>
</html>
