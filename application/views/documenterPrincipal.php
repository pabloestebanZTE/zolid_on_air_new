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

                                <form class="form-horizontal well" name="basicForm" id="basicForm">

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
                                                        <input type="text" name="txtFechaIngresoOnAir" id="txtFechaIngresoOnAir" class="form-control" value="" readonly="false" maxlength="10" placeholder="DD/MM/AAAA">
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
                                                <label for="txtContratista" class="col-md-3 control-label">Contratista:</label>
                                                <div class="col-md-8 selectContainer">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-fw fa-user"></i></span>
                                                        <input type="text" class="form-control " id="n_contratista" name="n_contratista" value="" />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="txtEvidenciaSL" class="col-md-3 control-label">Evidencia SL:</label>
                                                <div class="col-md-8 selectContainer">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-fw fa-file-text"></i></span>
                                                        <input type="text" class="form-control " id="n_evidenciasl" name="n_evidenciasl" value="" />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="txtEvidenciaTG" class="col-md-3 control-label">Evidencia TG:</label>
                                                <div class="col-md-8 selectContainer">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-fw fa-file-text"></i></span>
                                                        <input type="text" class="form-control " id="n_evidenciatg" name="n_evidenciatg" value="" />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="txtIDRFTools" class="col-md-3 control-label">ID RFTools:</label>
                                                <div class="col-md-8 selectContainer">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-fw fa-key"></i></span>
                                                        <input type="text" class="form-control " id="id_rftools" name="id_rftools" value="" />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="txtLiderCambio" class="col-md-3 control-label">Líder Cambio:</label>
                                                <div class="col-md-8 selectContainer">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-fw fa-user"></i></span>
                                                        <input type="text" class="form-control " id="i_lider_cambio" name="i_lider_cambio" value="" />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="txtLiderCuadrilla" class="col-md-3 control-label">Líder Cuadrilla:</label>
                                                <div class="col-md-8 selectContainer">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-fw fa-user"></i></span>
                                                        <input type="text" class="form-control " id="i_lider_cuadrilla" name="i_lider_cuadrilla" value="" />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="txtLac" class="col-md-3 control-label">LAC:</label>
                                                <div class="col-md-8 selectContainer">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-fw fa-user"></i></span>
                                                        <input type="text" class="form-control " id="n_lac" name="n_lac" value="" />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="txtSac" class="col-md-3 control-label">SAC:</label>
                                                <div class="col-md-8 selectContainer">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-fw fa-user"></i></span>
                                                        <input type="text" class="form-control " id="n_sac" name="n_sac" value="" />
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="txtRac" class="col-md-3 control-label">RAC:</label>
                                                <div class="col-md-8 selectContainer">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-fw fa-user"></i></span>
                                                        <input type="text" class="form-control " id="n_rac" name="n_rac" value="" />
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
                                                            <option value="">Seleccione</option>
                                                            <option value="ABIERTO">ABIERTO</option>
                                                            <option value="CERRADO">CERRADO</option>
                                                            <option value="NA">NA</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="cmbTestGestion" class="col-md-3 control-label">Test gestión:</label>
                                                <div class="col-md-8 selectContainer">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-fw fa-check-circle"></i></span>
                                                        <select name="n_testgestion" id="n_testgestion" class="form-control selectpicker" required>
                                                            <option value="">Seleccione</option>
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
                                                            <option value="">Seleccione</option>
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
                                                            <option value="">Seleccione</option>
                                                            <option value="ABIERTO">ABIERTO</option>
                                                            <option value="CERRADO">CERRADO</option>
                                                            <option value="NA">NA</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="cmbCambiosConfigSolicitados" class="col-md-3 control-label">Ejecutar cambios de configuración solicitados:</label>
                                                <div class="col-md-8 selectContainer">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-fw fa-unlock"></i></span>
                                                        <select name="n_cambios_config_solicitados" id="n_cambios_config_solicitados" class="form-control selectpicker" required>
                                                            <option value="">Seleccione</option>
                                                            <option value="ABIERTO">ABIERTO</option>
                                                            <option value="CERRADO">CERRADO</option>
                                                            <option value="NA">NA</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="cmbCambiosConfigFinal" class="col-md-3 control-label">Realizar cambios configuración final:</label>
                                                <div class="col-md-8 selectContainer">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-fw fa-unlock"></i></span>
                                                        <select name="n_cambios_config_final" id="n_cambios_config_final" class="form-control selectpicker" required>
                                                            <option value="">Seleccione</option>
                                                            <option value="ABIERTO">ABIERTO</option>
                                                            <option value="CERRADO">CERRADO</option>
                                                            <option value="NA">NA</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="cmbIntegracionGestionTrafica" class="col-md-3 control-label">Integración Gestión y Trafica:</label>
                                                <div class="col-md-8 selectContainer">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-fw fa-check-circle"></i></span>
                                                        <select name="n_integracion_gestion_y_trafica" id="n_integracion_gestion_y_trafica" class="form-control selectpicker" required>
                                                            <option value="">Seleccione</option>
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
                                                            <option value="">Seleccione</option>
                                                            <option value="ABIERTO">ABIERTO</option>
                                                            <option value="CERRADO">CERRADO</option>
                                                            <option value="NA">NA</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="cmbInstalacionHW4GSitio" class="col-md-3 control-label">Realizar instalación HW 4G en Sitio:</label>
                                                <div class="col-md-8 selectContainer">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-fw fa-check-circle"></i></span>
                                                        <select name="n_instalacion_hw_4g_sitio" id="n_instalacion_hw_4g_sitio" class="form-control selectpicker" required>
                                                            <option value="">Seleccione</option>
                                                            <option value="ABIERTO">ABIERTO</option>
                                                            <option value="CERRADO">CERRADO</option>
                                                            <option value="NA">NA</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

<!--                                            <div class="form-group">
                                                <label for="cmbDoc" class="col-md-3 control-label">DOC:</label>
                                                <div class="col-md-8 selectContainer">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-fw fa-check-circle"></i></span>
                                                        <select name="n_doc" id="n_doc" class="form-control selectpicker">
                                                            <option value="">Seleccione</option>
                                                            <option value="ABIERTO">ABIERTO</option>
                                                            <option value="CERRADO">CERRADO</option>
                                                            <option value="NA">NA</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>-->

                                            <div class="form-group">
                                                <label for="cmbImplementacionCampo" class="col-md-3 control-label">Implementación en Campo:</label>
                                                <div class="col-md-8 selectContainer">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-fw fa-unlock"></i></span>
                                                        <select name="n_implementacion_campo" id="n_implementacion_campo" class="form-control selectpicker" required>
                                                            <option value="">Seleccione</option>
                                                            <option value="ABIERTO">ABIERTO</option>
                                                            <option value="CERRADO">CERRADO</option>
                                                            <option value="NA">NA</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="cmbImplementacionCampo" class="col-md-3 control-label">Implementación Remota:</label>
                                                <div class="col-md-8 selectContainer">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-fw fa-unlock"></i></span>
                                                        <select name="n_implementacion_remota" id="n_implementacion_remota" class="form-control selectpicker" required>
                                                            <option value="">Seleccione</option>
                                                            <option value="ABIERTO">ABIERTO</option>
                                                            <option value="CERRADO">CERRADO</option>
                                                            <option value="NA">NA</option>
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
                                                            <option value="">Seleccione</option>
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
                                                            <option value="">Seleccione</option>
                                                            <option value="ABIERTO">ABIERTO</option>
                                                            <option value="CERRADO">CERRADO</option>
                                                            <option value="NA">NA</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="cmbOnAIR" class="col-md-3 control-label">Ejecución On AIR:</label>
                                                <div class="col-md-8 selectContainer">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-fw fa-unlock"></i></span>
                                                        <select name="on_air" id="on_air" class="form-control selectpicker" required>
                                                            <option value="">Seleccione</option>
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
                                                            <option value="">Seleccione</option>
                                                            <option value="NOKIA">NOKIA</option>
                                                            <option value="NOKIA_ZTE">NOKIA ZTE</option>
                                                            <option value="ZTE">ZTE</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="hidden" class="form-control " id="k_id_ticket" name="k_id_ticket" value="" />
                                            <input type="hidden" class="form-control " id="k_id_prep" name="k_id_prep" value="" />
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
                    <div class="alert alert-info alert-dismissable m-b-0" id="alertFases">
                        <a href="#" class="close">&times;</a>
                        <p id="text" class="m-b-0 p-b-0"><i class="fa fa-fw fa-refresh fa-spin"></i> Consultado, por favor espere...</p>
                    </div>
                    <div id="contentFases" class="hidden">
                        <div class="col-xs-12 text-right">
                            <div class="display-block pull-right" style="width: 400px;">
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
                            <div class="hour-step active" data-ref="#contentDetails_12h" data-value="12">
                                <div class="body-step">
                                    <label>12H</label>
                                    <span class="icon-step no-action"><i class="fa fa-fw fa-clock-o"></i></span>
                                </div>
                                <div class="back-progress-step">
                                    <span class="progress-step" id="progressStep1"></span>
                                </div>
                                <div class="footer-step">
                                    <label id="timeStep" class="timerstamp"><i class="fa fa-fw fa-clock-o"></i> -00:00</label>
                                </div>
                            </div>
                            <div class="hour-step" data-ref="#contentDetails_24h" data-value="24">
                                <div class="body-step">
                                    <label>24H</label>
                                    <span class="icon-step no-action"><i class="fa fa-fw fa-clock-o"></i></span>
                                </div>
                                <div class="back-progress-step">
                                    <span class="progress-step"></span>
                                </div>
                                <div class="footer-step">
                                    <label id="timeStep" class="timerstamp"><i class="fa fa-fw fa-clock-o"></i> -00:00</label>
                                </div>
                            </div>
                            <div class="hour-step" data-ref="#contentDetails_36h" data-value="36">
                                <div class="body-step">
                                    <label>36H</label>
                                    <span class="icon-step no-action"><i class="fa fa-fw fa-clock-o"></i></span>
                                </div>
                                <div class="back-progress-step">
                                    <span class="progress-step"></span>
                                </div>
                                <div class="footer-step">
                                    <label id="timeStep" class="timerstamp"><i class="fa fa-fw fa-clock-o"></i> -00:00</label>
                                </div>
                            </div>
                        </div>
                        <div class="well white p-t-5 p-b-5 p-r-5 p-l-5">
                            <div id="modelWiget" class="hidden">
                                <div class="col-md-3 wiget-list">
                                    <div class="item-wiget">
                                        <div class="icon-wiget"><i class="fa fa-fw fa-calendar"></i></div>
                                        <div class="details-wiget">
                                            <span class="title display-block">Fecha Inicio: </span>
                                            <span class="text display-block" id="d_start">{d_start}</span>
                                        </div>
                                    </div>
                                    <div class="item-wiget">
                                        <div class="icon-wiget"><i class="fa fa-fw fa-calendar"></i></div>
                                        <div class="details-wiget">
                                            <span class="title display-block">Fecha Fin: </span>
                                            <span class="text display-block" id="d_end">{d_end}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <p class="text-justify m-all-0 p-all-0"><b class="display-block m-b-10"><i class="fa fa-fw fa-comment"></i> Comentario:</b><span id="n_comentario">{n_comentario}</span></p>
                                </div>
                                <div class="col-md-4 wiget-list p-l-25 users">
                                    <div class="item-wiget">
                                        <div class="icon-wiget"><i class="fa fa-fw fa-user"></i></div>
                                        <div class="details-wiget">
                                            <span class="title display-block">{user_name}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="well m-b-0 p-t-5 p-b-5">
                                <div class="row wiget" id="contentDetails_12h">

                                </div>
                                <div class="row wiget hidden" id="contentDetails_24h">

                                </div>
                                <div class="row wiget hidden" id="contentDetails_36h">

                                </div>
                            </div>
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
                // console.log(fields);
                $('#detailsForm').fillForm(fields);

                $('input[name=n_integrador]').val(fields.k_id_preparation.n_integrador);
                $('input[name=n_contratista]').val(fields.k_id_preparation.n_contratista);
                $('input[name=n_evidenciasl]').val(fields.k_id_preparation.n_evidenciasl);
                $('input[name=n_evidenciatg]').val(fields.k_id_preparation.n_evidenciatg);
                $('input[name=id_rftools]').val(fields.k_id_preparation.id_rftools);
                $('input[name=i_lider_cambio]').val(fields.i_lider_cambio);
                $('input[name=i_lider_cuadrilla]').val(fields.i_lider_cuadrilla);
                $('input[name=n_lac]').val(fields.k_id_preparation.n_lac);
                $('input[name=n_rac]').val(fields.k_id_preparation.n_rac);
                $('input[name=n_sac]').val(fields.k_id_preparation.n_sac);
//                $('#n_testgestion option[value="' + fields.k_id_preparation.n_testgestion + '"]').attr('selected', 'selected');
//                $('#n_sitiolimpio option[value="' + fields.k_id_preparation.n_sitiolimpio + '"]').attr('selected', 'selected');
//                $('#n_instalacion_hw_sitio option[value="' + fields.k_id_preparation.n_instalacion_hw_sitio + '"]').attr('selected', 'selected');
//                $('#n_cambios_config_solicitados option[value="' + fields.k_id_preparation.n_cambios_config_solicitados + '"]').attr('selected', 'selected');
//                $('#n_cambios_config_final option[value="' + fields.k_id_preparation.n_cambios_config_final + '"]').attr('selected', 'selected');
//                $('#n_integracion_gestion_y_trafica option[value="' + fields.k_id_preparation.n_integracion_gestion_y_trafica + '"]').attr('selected', 'selected');
//                $('#puesta_servicio_sitio_nuevo_lte option[value="' + fields.k_id_preparation.puesta_servicio_sitio_nuevo_lte + '"]').attr('selected', 'selected');
//                $('#n_instalacion_hw_4g_sitio option[value="' + fields.k_id_preparation.n_instalacion_hw_4g_sitio + '"]').attr('selected', 'selected');
//                $('#pre_launch option[value="' + fields.k_id_preparation.pre_launch + '"]').attr('selected', 'selected');
//                $('#n_implementacion_campo option[value="' + fields.n_implementacion_campo + '"]').attr('selected', 'selected');
//                $('#n_gestion_power option[value="' + fields.n_gestion_power + '"]').attr('selected', 'selected');
//                $('#n_obra_civil option[value="' + fields.n_obra_civil + '"]').attr('selected', 'selected');
//                $('#on_air option[value="' + fields.on_air + '"]').attr('selected', 'selected');
//                $('#n_noc option[value="' + fields.n_noc + '"]').attr('selected', 'selected');


                $('input[name=k_id_ticket]').val(fields.k_id_onair);
                $('input[name=k_id_prep]').val(fields.k_id_preparation.k_id_preparation);

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
                $('#n_implementacion_campo option[value=""]').attr('selected', 'selected');
                $('#n_doc option[value=""]').attr('selected', 'selected');
                $('#n_gestion_power option[value=""]').attr('selected', 'selected');
                $('#n_obra_civil option[value=""]').attr('selected', 'selected');
                $('#on_air option[value=""]').attr('selected', 'selected');
                $('#n_noc option[value=""]').attr('selected', 'selected');

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
