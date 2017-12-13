<!DOCTYPE html>
<html lang="en">
    <?php $this->load->view('parts/generic/head'); ?>
    <link rel="stylesheet" href="<?= URL::to('assets/css/styleAcsForm.css') ?>" />
    <body data-base="<?= URL::base() ?>">
        <?php $this->load->view('parts/generic/header'); ?>
        <div class="container autoheight p-t-20 m-t-20">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bhoechie-tab-container">
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 bhoechie-tab-menu">
                        <div class="list-group">
                            <a href="#" class="list-group-item active text-center">
                                <h4 class="glyphicon glyphicon-plane"></h4><br/>Creación de Ventanas
                            </a>
                            <a href="#" class="list-group-item text-center">
                                <h4 class="glyphicon glyphicon-road"></h4><br/>Apertura de VM
                            </a>
                            <a href="#" class="list-group-item text-center">
                                <h4 class="glyphicon glyphicon-home"></h4><br/>Punto de Control
                            </a>
                            <a class="list-group-item text-center">
                                <h4 class="glyphicon glyphicon-eye-open"></h4><br/>Cierre de VM
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 bhoechie-tab">

                        <!-- creacion ventana section -->
                        <div class="bhoechie-tab-content active" id="contentTab1">
                            <center>
                                <form class="well form-horizontal" action="" method="post"  id="assignEng" name="assignEng">
                                    <fieldset class="col-md-6 control-label">
                                        <div class="form-group">
                                            <label for="txtFechaSolicitud" class="col-md-3 control-label">Fecha de Solicitud:</label>
                                            <div class="col-md-8 selectContainer">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-fw fa-calendar"></i></span>
                                                    <input type='datetime-local' name="txtFechaSolicitud" id="txtFechaSolicitud" class="form-control" style="width: 230px;">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="cmbEstacion" class="col-md-3 control-label">Estacion:</label>
                                            <div class="col-md-8 selectContainer">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-fw fa-location-arrow"></i></span>
                                                    <select class="form-control selectpicker" id="cmbEstacion" name="cmbEstacion">
                                                        <option value="">Seleccione</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="cmbBanda" class="col-md-3 control-label">Banda:</label>
                                            <div class="col-md-8 selectContainer">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-fw fa-globe"></i></span>
                                                    <select class="form-control selectpicker" id="cmbBanda" name="cmbBanda">
                                                        <option value="">Seleccione</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="cmbEnteEjecutor" class="col-md-3 control-label">Ente Ejecutor:</label>
                                            <div class="col-md-8 selectContainer">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-fw fa-address-book"></i></span>
                                                    <select class="form-control selectpicker" name="cmbEnteEjecutor" id="cmbEnteEjecutor">
                                                        <option value="">Seleccione</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="txtNombreGrupoSkype" class="col-md-3 control-label">Nombre Grupo Skype:</label>
                                            <div class="col-md-8 selectContainer">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-fw fa-id-card"></i></span>
                                                    <input type='text' name="txtNombreGrupoSkype" id="txtNombreGrupoSkype" class="form-control"  >
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="txtHoraAperturaGrupo" class="col-md-3 control-label">Hora Apertura Grupo:</label>
                                            <div class="col-md-8 selectContainer">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-fw fa-id-card"></i></span>
                                                    <input type='text' name="txtHoraAperturaGrupo" id="txtHoraAperturaGrupo" class="form-control"  >
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="cmbIncidente" class="col-md-3 control-label">Incidente:</label>
                                            <div class="col-md-8 selectContainer">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-fw fa-drivers-license"></i></span>
                                                    <select class="form-control selectpicker" name="cmbIncidente" id="cmbIncidente">
                                                        <option value="">Seleccione</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <!--  fin seccion izquierda form---->

                                    <!--  inicio seccion derecha form---->
                                    <fieldset>
                                        <div class="form-group">
                                            <label for="txtIdSiteAccess" class="col-md-3 control-label">ID Site Access :</label>
                                            <div class="col-md-8 selectContainer">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-fw fa-tablet"></i></span>
                                                    <input type='text' name="txtIdSiteAccess" id="txtIdSiteAccess" class="form-control"  >
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="cmbTecnologia" class="col-md-3 control-label">Tecnologia:</label>
                                            <div class="col-md-8 selectContainer">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-fw fa-briefcase"></i></span>
                                                    <select class="form-control selectpicker" id="cmbTecnologia" name="cmbTecnologia">
                                                        <option value="">Seleccione</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="cmbTipoTrabajo" class="col-md-3 control-label">Tipo de Trabajo:</label>
                                            <div class="col-md-8 selectContainer">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-fw fa-signal"></i></span>
                                                    <select class="form-control selectpicker" id="cmbTipoTrabajo" name="cmbTipoTrabajo">
                                                        <option value="">Seleccione</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="txtPersonaSolicita" class="col-md-3 control-label">Persona que Solicita:</label>
                                            <div class="col-md-8 selectContainer">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-fw fa-calendar-o"></i></span>
                                                    <input type='text' name="txtPersonaSolicita" id="txtPersonaSolicita" class="form-control"  >
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="cmbRegionalSkype" class="col-md-3 control-label">Regional Skype:</label>
                                            <div class="col-md-8 selectContainer">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-fw fa-thumbs-o-up"></i></span>
                                                    <select class="form-control selectpicker" id="cmbRegionalSkype" name="cmbRegionalSkype">
                                                        <option value="">Seleccione</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="cmbIngCreadorGrupo" class="col-md-3 control-label">Ingeniero Creador Grupo:</label>
                                            <div class="col-md-8 selectContainer">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-fw fa-thumbs-o-up"></i></span>
                                                    <select class="form-control selectpicker" id="cmbIngCreadorGrupo" name="cmbIngCreadorGrupo">
                                                        <option value="">Seleccione</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <!--   fin seccion derecha---->
                                    <!-- Button -->
                                    <center>
                                        <div class="form-group">
                                            <label class="col-md-12 control-label"></label>
                                            <div class="col-md-12">
                                                <button type="submit" id="btnGuardar" class="btn btn-success" onclick = "">Guardar <span class="fa fa-fw fa-save"></span></button>
                                            </div>
                                        </div>
                                    </center>
                                </form>
                            </center>
                        </div>

                        <!-- apertura VM section -->
                        <div class="bhoechie-tab-content" id="contentTab2">
                            <center>
                                <form class="well form-horizontal" action="" method="post">
                                    <div class="form-group">
                                        <label for="cmbRiesgoId" class="col-sm-2 control-label">Riesgo</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" id="cmbRiesgoId" name="cmbRiesgoId">
                                                <option value="">Seleccione</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="txtTipoActividad" class="col-sm-2 control-label">Tipo de Actividad</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="txtTipoActividad" name="txtTipoActividad">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="txtTipoEventoNivel1" class="col-sm-2 control-label">Tipo de evento (nivel 1)</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="txtTipoEventoNivel1" name="txtTipoEventoNivel1">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="txtTipoEventoNivel2" class="col-sm-2 control-label">Tipo de evento (nivel 2)</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="txtTipoEventoNivel2" name="txtTipoEventoNivel2">
                                        </div>
                                    </div>
                                    <div id="contenedorCausas">
                                        <div class="form-inline form-group">
                                            <label for="txtCausa" class="col-sm-2 control-label">Causa</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="txtCausa" name="txtCausa[]" style="width: 93%;">
                                                <button type="button" class="btn btn-success" onclick="AgregarCausas()"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="cmbFactorRiesgo" class="col-sm-2 control-label">Factor de riesgo</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" id="cmbFactorRiesgo" name="cmbFactorRiesgo">
                                                <option value="">Seleccione</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="cmbProbabilidad" class="col-sm-2 control-label">Probabilidad</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" id="cmbProbabilidad" name="cmbProbabilidad">
                                                <option value="">Seleccione</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="cmbSoporteProbabilidad" class="col-sm-2 control-label">Soporte Probabilidad</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" id="cmbSoporteProbabilidad" name="cmbSoporteProbabilidad" onchange="cambiarSoporteImpacto()">
                                                <option value="">Seleccione</option>
                                                <option value="1">Eventualidad que no es probable o es muy poco probable (una vez al año)</option>
                                                <option value="2">Eventualidad poco común  o relativa frecuencia (dos veces al año).</option>
                                                <option value="3">Puede ocurrir en algún momento. Eventualidad con frecuencia moderada. (doce veces al año)</option>
                                                <option value="4">Hay buenas razones para creer que se verificará o sucederá el riesgo en muchas circunstancias. Eventualidad de frecuencia alta. (cuarenta y ocho  veces al año)</option>
                                                <option value="5">Se espera que el riesgo ocurra en la mayoría de las circunstancias. Eventualidad frecuente. (Trescientos sesenta y cinco veces al año)</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="cmbImpacto" class="col-sm-2 control-label">Impacto</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" id="cmbImpacto" name="cmbImpacto">
                                                <option value="">Seleccione</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="cmbSoporteImpacto1" class="col-sm-2 control-label">Soporte Impacto</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" id="cmbSoporteImpacto1" name="cmbSoporteImpacto1">
                                                <option value="">Seleccione</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="cmbSoporteImpacto2" class="col-sm-2 control-label">Soporte Impacto</label>
                                        <div class="col-sm-10">
                                            <select class="form-control" id="cmbSoporteImpacto2" name="cmbSoporteImpacto2">
                                                <option value="">Seleccione</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!--                                    <div class="form-group">
                                                                            <label for="txtConsecuencia" class="col-sm-2 control-label">Consecuencia</label>
                                                                            <div class="col-sm-10">
                                                                                <input type="text" class="form-control" id="txtConsecuencia" name="txtConsecuencia">
                                                                            </div>
                                                                        </div>-->
                                    <div class="form-group">
                                        <label for="txtSeveridadRiesgoInherente" class="col-sm-2 control-label">Severidad del Riesgo Inherente</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="txtSeveridadRiesgoInherente" name="txtSeveridadRiesgoInherente">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10">
                                            <button type="submit" class="btn btn-primary"><span class="fa fa-fw fa-floppy-o"></span>&nbsp;&nbsp;Guardar</button>
                                        </div>
                                    </div>
                                </form>
                            </center>
                        </div>

                        <!-- punto de control section -->
                        <div class="bhoechie-tab-content" id="contentTab3">
                            <center>
                                <form class="well form-horizontal" action="" method="post"  id="assignEng" name="assignEng">
                                    <fieldset class="col-md-6 control-label">
                                        <div class="form-group">
                                            <label for="txtFechaSolicitud" class="col-md-3 control-label">Fecha de Solicitud:</label>
                                            <div class="col-md-8 selectContainer">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-fw fa-calendar"></i></span>
                                                    <input type='datetime-local' name="txtFechaSolicitud" id="txtFechaSolicitud" class="form-control" style="width: 230px;">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="cmbEstacion" class="col-md-3 control-label">Estacion:</label>
                                            <div class="col-md-8 selectContainer">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-fw fa-location-arrow"></i></span>
                                                    <select class="form-control selectpicker" id="cmbEstacion" name="cmbEstacion">
                                                        <option value="">Seleccione</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="cmbBanda" class="col-md-3 control-label">Banda:</label>
                                            <div class="col-md-8 selectContainer">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-fw fa-globe"></i></span>
                                                    <select class="form-control selectpicker" id="cmbBanda" name="cmbBanda">
                                                        <option value="">Seleccione</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="cmbEnteEjecutor" class="col-md-3 control-label">Ente Ejecutor:</label>
                                            <div class="col-md-8 selectContainer">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-fw fa-address-book"></i></span>
                                                    <select class="form-control selectpicker" name="cmbEnteEjecutor" id="cmbEnteEjecutor">
                                                        <option value="">Seleccione</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="txtNombreGrupoSkype" class="col-md-3 control-label">Nombre Grupo Skype:</label>
                                            <div class="col-md-8 selectContainer">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-fw fa-id-card"></i></span>
                                                    <input type='text' name="txtNombreGrupoSkype" id="txtNombreGrupoSkype" class="form-control"  >
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="txtHoraAperturaGrupo" class="col-md-3 control-label">Hora Apertura Grupo:</label>
                                            <div class="col-md-8 selectContainer">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-fw fa-id-card"></i></span>
                                                    <input type='text' name="txtHoraAperturaGrupo" id="txtHoraAperturaGrupo" class="form-control"  >
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="cmbIncidente" class="col-md-3 control-label">Incidente:</label>
                                            <div class="col-md-8 selectContainer">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-fw fa-drivers-license"></i></span>
                                                    <select class="form-control selectpicker" name="cmbIncidente" id="cmbIncidente">
                                                        <option value="">Seleccione</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <!--  fin seccion izquierda form---->

                                    <!--  inicio seccion derecha form---->
                                    <fieldset>
                                        <div class="form-group">
                                            <label for="txtIdSiteAccess" class="col-md-3 control-label">ID Site Access :</label>
                                            <div class="col-md-8 selectContainer">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-fw fa-tablet"></i></span>
                                                    <input type='text' name="txtIdSiteAccess" id="txtIdSiteAccess" class="form-control"  >
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="cmbTecnologia" class="col-md-3 control-label">Tecnologia:</label>
                                            <div class="col-md-8 selectContainer">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-fw fa-briefcase"></i></span>
                                                    <select class="form-control selectpicker" id="cmbTecnologia" name="cmbTecnologia">
                                                        <option value="">Seleccione</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="cmbTipoTrabajo" class="col-md-3 control-label">Tipo de Trabajo:</label>
                                            <div class="col-md-8 selectContainer">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-fw fa-signal"></i></span>
                                                    <select class="form-control selectpicker" id="cmbTipoTrabajo" name="cmbTipoTrabajo">
                                                        <option value="">Seleccione</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="txtPersonaSolicita" class="col-md-3 control-label">Persona que Solicita:</label>
                                            <div class="col-md-8 selectContainer">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-fw fa-calendar-o"></i></span>
                                                    <input type='text' name="txtPersonaSolicita" id="txtPersonaSolicita" class="form-control"  >
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="cmbRegionalSkype" class="col-md-3 control-label">Regional Skype:</label>
                                            <div class="col-md-8 selectContainer">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-fw fa-thumbs-o-up"></i></span>
                                                    <select class="form-control selectpicker" id="cmbRegionalSkype" name="cmbRegionalSkype">
                                                        <option value="">Seleccione</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="cmbIngCreadorGrupo" class="col-md-3 control-label">Ingeniero Creador Grupo:</label>
                                            <div class="col-md-8 selectContainer">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-fw fa-thumbs-o-up"></i></span>
                                                    <select class="form-control selectpicker" id="cmbIngCreadorGrupo" name="cmbIngCreadorGrupo">
                                                        <option value="">Seleccione</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <!--   fin seccion derecha---->
                                    <!-- Button -->
                                    <center>
                                        <div class="form-group">
                                            <label class="col-md-12 control-label"></label>
                                            <div class="col-md-12">
                                                <button type="submit" id="btnGuardar" class="btn btn-success" onclick = "">Guardar <span class="fa fa-fw fa-save"></span></button>
                                            </div>
                                        </div>
                                    </center>
                                </form>
                            </center>
                        </div>

                        <!-- cierre VM section -->
                        <div class="bhoechie-tab-content" id="contentTab4">
                            <center>
                                <!--<div class="row form-md">-->
                                <form class="well form-horizontal" action="" method="post">
                                    <div id="contenedorControles">
                                        <div class="form-inline form-group" >
                                            <label for="cmbControles" class="col-sm-2 control-label">Control</label>
                                            <div class="col-sm-10">
                                                <select class="form-control" id="cmbControles" name="cmbControles[]" style="width: 93%;">
                                                    <option value="">Seleccione</option>
                                                </select>
                                                <button type="button" class="btn btn-success" onclick="AgregarControles()"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                            </div>
                                        </div>
                                    </div>

                                </form>
                                <!--</div>-->
                            </center>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <br>
        <!--footer Section -->
        <div class="for-full-back" id="footer">
            Zolid By ZTE Colombia | All Right Reserved
        </div>
        <?php $this->load->view('parts/generic/scripts'); ?>
        <!-- CUSTOM SCRIPT   -->
        <script src="<?= URL::to('assets/js/modules/acsForm.js') ?>" type="text/javascript"></script>
    </body>
</html>
