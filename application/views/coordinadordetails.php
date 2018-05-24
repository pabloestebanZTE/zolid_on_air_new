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
            <!-- TRACKING DETAILS FORM -->
            <div class="col-md-12">
                <div class="panel-group m-b-5" id="accordion">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse1"><i class="fa fa-fw fa-info"></i> Información básica</a>
                            </h4>
                        </div>
                        <div id="collapse1" class="panel-collapse collapse">
                            <div class="panel-body">
                                <form class="form-horizontal well">
                                    <div class="panel-body">
                                        <fieldset class="col-md-6 control-label">
                                            <div class="form-group">
                                                <div class="col-md-8 selectContainer">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-fw fa-street-view"></i></span>
                                                        <input type="text" name="txtEstacion" id="txtEstacion" class="form-control" value="" readonly="false">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Banda</label>
                                                <div class="col-md-8 selectContainer">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-fw fa-signal"></i></span>
                                                        <input type="text" name="txtBanda" id="txtBanda" class="form-control" value="" readonly="false">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Regional</label>
                                                <div class="col-md-8 selectContainer">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-fw fa-globe"></i></span>
                                                        <input type="text" name="txtRegional" id="txtRegional" class="form-control" value="" readonly="false">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Ingeniero</label>
                                                <div class="col-md-8 selectContainer">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-fw fa-user"></i></span>
                                                        <select name="cbmIngeniero" id="cbmIngeniero" class="form-control selectpicker" required="">
                                                            <option value="">Seleccione el ingeniero</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                        <!--  fin seccion izquierda form---->

                                        <!--  inicio seccion derecha form---->
                                        <fieldset>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Tecnologia</label>
                                                <div class="col-md-8 selectContainer">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-fw fa-tablet"></i></span>
                                                        <input type="text" name="txtTecnologia" id="txtTecnologia" class="form-control" value="" readonly="false">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Tipo de trabajo</label>
                                                <div class="col-md-8 selectContainer">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-fw fa-briefcase"></i></span>
                                                        <input type="text" name="txtTipotrabajo" id="txtTipotrabajo" class="form-control" value="" readonly="false">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Ciudad</label>
                                                <div class="col-md-8 selectContainer">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-fw fa-location-arrow"></i></span>
                                                        <input type="text" name="txtTipotrabajo" id="txtTipotrabajo" class="form-control" value="" readonly="false">
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
                                <div class="stepwizard col-md-offset-3 m-t-10 m-b-25">
                                    <div class="stepwizard-row setup-panel">
                                        <div class="stepwizard-step">
                                            <a href="#step-1" type="button" class="btn btn-primary btn-circle">1</a>
                                            <!--<p>Parte 1</p>-->
                                        </div>
                                        <div class="stepwizard-step">
                                            <a href="#step-2" type="button" class="btn btn-default btn-circle" >2</a>
                                            <!--<p>Parte 2</p>-->
                                        </div>
                                        <!--                                        <div class="stepwizard-step">
                                                                                    <a href="#step-3" type="button" class="btn btn-default btn-circle" >3</a>
                                                                                    <p>Step 3</p>
                                                                                </div>-->
                                    </div>
                                </div>
                                <div class="display-block p-l-40 p-r-40 m-b-0 well step-panel" id="step-1">
                                    <form class="row form-xs">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="txtBCFWBTS">BCF WBTS:</label>
                                                <input type="text" class="form-control input-sm" id="txtBCFWBTS" placeholder="BCF WBTS" />
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="txtBTS">BTS:</label>
                                                <input type="text" class="form-control input-sm" id="txtBTS" name="preparation_stage" placeholder="BTS" />
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="txtFechaIngresoOnAir">Fecha ingreso On Air:</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control input-sm" id="txtFechaIngresoOnAir" placeholder="DD/MM/YYYY" />
                                                    <div class="input-group-btn"><button class="btn btn-default btn-sm"><i class="fa fa-fw fa-calendar"></i></button></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group p-t-10 p-b-10">                                                
                                                <div class="checkbox checkbox-primary">
                                                    <input id="checkbox2" type="checkbox">
                                                    <label for="checkbox2" class="text-bold">
                                                        VistaMM
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="cmbEnteEjecutor">Ente Ejecutor:</label>
                                                <select id="cmbEnteEjecutor" class="form-control input-sm">
                                                    <option value="">Seleccione</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="txtControlador">Controlador:</label>
                                                <input type="text" id="txtControlador" class="form-control input-sm" placeholder="Controlador" />
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="txtCorrecionPendientes">Correción pendientes:</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control input-sm" id="txtCorrecionPendientes" name="" value="" placeholder="DD/MM/YYYY" />
                                                    <div class="input-group-btn">
                                                        <button class="btn btn-default btn-sm"><i class="fa fa-fw fa-calendar"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="txtBtsIpAddress">BTS IP Address:</label>
                                                <input type="text" class="form-control input-sm" placeholder="BTS IP Address" id="txtBtsIpAddress" />
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="txtIntegrador">Integrador:</label>
                                                <input type="text" class="form-control input-sm" id="txtIntegrador" placeholder="Integrador" />
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="txtWP">WP:</label>
                                                <input type="text" class="form-control input-sm" id="txtWP" placeholder="WP" />
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="txtCRQ">CRQ:</label>
                                                <input type="txtCRQ" class="form-control input-sm" id="txtCRQ" placeholder="CRQ" />
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="txtTestGestion">Test Gestión:</label>
                                                <select class="form-control input-sm" name="" id="txtTestGestion">
                                                    <option value="">Seleccione</option>
                                                    <option value="1">SI</option>
                                                    <option value="2">NO</option>
                                                    <option value="3">NA</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="cmbSitioLimpio">Instalación HW Sitio:</label>
                                                <select id="cmbSitioLimpio" class="form-control input-sm">
                                                    <option value="">Seleccione</option>
                                                    <option value="1">SI</option>
                                                    <option value="2">NO</option>
                                                    <option value="3">NA</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="cmbCambiosConfigSolicitados">Cambios Config Solicitados:</label>
                                                <select id="cmbCambiosConfigSolicitados" class="form-control input-sm">
                                                    <option value="">Seleccione</option>
                                                    <option value="1">SI</option>
                                                    <option value="2">NO</option>
                                                    <option value="3">NA</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="cmbCambiosFin">Cambios Config Fin:</label>
                                                <select class="form-control input-sm" id="cmbCambiosFin" >
                                                    <option>Seleccione</option>
                                                    <option value="1">SI</option>
                                                    <option value="2">NO</option>
                                                    <option value="3">NA</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="txtContratista">Contratista:</label>
                                                <input type="text" class="form-control input-sm" id="txtContratista" placeholder="Contratista" />
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="txtComentarioSocial">Comentario Social:</label>
                                                <textarea class="form-control input-sm" id="txtComentarioSocial" rows="3" placeholder="Escriba aquí..."></textarea>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="hidden well display-block p-l-40 p-r-40 m-b-0 step-panel" id="step-2">
                                    <form class="row form-xs">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="txtTicketTremedy">Ticket Tremedy:</label>
                                                <input type="text" class="form-control input-sm" id="txtTicketTremedy" placeholder="Tiecket Tremedy"/>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="txtLAC">LAC:</label>
                                                <input type="text" class="form-control input-sm" id="txtLAC" placeholder="LAC" />
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="txtRAC">RAC:</label>
                                                <input type="text" class="form-control input-sm" id="txtRAC" placeholder="RAC" />
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="txtSAC">SAC:</label>                                        
                                                <input type="text" class="form-control input-sm" id="txtSAC" placeholder="SAC"/>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="cmbIntegracionGestionYTrafica">Int. Gestión y Tráfica:</label>
                                                <select class="form-control input-sm" id="cmbIntegracionGestionYTrafica">
                                                    <option value="">Seleccione</option>
                                                    <option value="1">SI</option>
                                                    <option value="1">NO</option>
                                                    <option value="1">NA</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="cmbPuestaServicioSitioNuevoLTE">Puesta Sitio Nuevo LTE:</label>
                                                <select class="form-control input-sm" id="cmbPuestaServicioSitioNuevoLTE">
                                                    <option value="">Seleccione</option>
                                                    <option value="1">SI</option>
                                                    <option value="1">NO</option>
                                                    <option value="1">NA</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="cmbInstalacionHW4GSitio">Instalación HW 4G Sitio:</label>
                                                <select id="cmbInstalacionHW4GSitio" class="form-control input-sm">
                                                    <option value="">Seleccione</option>
                                                    <option value="1">SI</option>
                                                    <option value="1">NO</option>
                                                    <option value="1">NA</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="cmbPrelaunch">Prelaunch:</label>
                                                <select class="form-control input-sm" id="cmbPrelaunch">
                                                    <option value="">Seleccione</option>
                                                    <option value="1">SI</option>
                                                    <option value="1">NO</option>
                                                    <option value="1">NA</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="txtEvidenciaSL">Evidencia SL:</label>
                                                <input type="text" class="form-control input-sm" placeholder="Evidencia SL" />
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="txtEvidenciaTG">Evidencia TG:</label>
                                                <input type="text" class="form-control input-sm" id="txtEvidenciaTG" placeholder="Evidencia TG" />
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="nmbWeek">WEEK:</label>
                                                <input type="number" class="form-control input-sm" placeholder="Week" />
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="txtIdNotificacion">Id Notificación:</label>
                                                <input type="text" class="form-control input-sm" id="txtIdNotificacion" placeholder="Id Notificación" />
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="txtIdDocumentacion">Id Documentación:</label>
                                                <input type="text" class="form-control input-sm" id="txtIdDocumentacion" placeholder="Id Documentación" />
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="txtIdRFTools">Id RFTools:</label>
                                                <input type="text" class="form-control input-sm" id="txtIdRFTools" placeholder="Id RFTools" />
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="txtFechaApertura">Fecha de apertura:</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control input-sm" id="txtFechaApertura" name="" value="" placeholder="DD/MM/YYYY">
                                                    <div class="input-group-btn">
                                                        <button class="btn btn-default btn-sm"><i class="fa fa-fw fa-calendar"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
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
                                <span class="progress-step" id="progressStep1"></span>
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
        </form>
        <!-- FIN TRACKING DETAILS FORM -->
    </div>


    <!--MODAL CHANGE STATE-->
    <div id="modalChangeState" class="modal fade" role="dialog">
        <div class="modal-dialog modal-xs">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-fw fa-edit"></i> Cambiar estado</h4>
                </div>
                <div class="modal-body">
                    <ul class="states-modal">
                        <li>
                            <a href="javascript:;"><span class="icon-state theme2"><i class="fa fa-fw fa-pause"></i></span> Crear Prorroga</a>
                        </li>                        
                        <li>
                            <a href="javascript:;"><span class="icon-state theme3"><i class="fa fa-fw fa-forward"></i></span> Siguiente fase</a>
                        </li>
                        <li>
                            <a href="<?= URL::to("User/scaling"); ?>"><span class="icon-state theme4"><i class="fa fa-fw fa-undo"></i></span> Escalar proceso</a>
                        </li>
                    </ul>
                    <label for="txtObservations">Observaciones:</label>
                    <textarea id="txtObservations" class="form-control" rows="5" placeholder="Escriba aquí las observaciones por las cuales está realizando el cambio."></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-fw fa-check"></i> Aceptar</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-fw fa-times"></i> Cerrar</button>
                </div>
            </div>

        </div>
    </div>
    <!--MODAL CHANGE STATE-->


    <!--MODAL CHANGE STATE-->
    <div id="modalChangeState" class="modal fade" role="dialog">
        <div class="modal-dialog modal-xs">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-fw fa-edit"></i> Cambiar estado</h4>
                </div>
                <div class="modal-body">
                    <ul class="states-modal">
                        <li>
                            <a href="#"><span class="icon-state theme1"><i class="fa fa-fw fa-pause"></i></span> Crear Prorroga</a>
                        </li>
                        <li>
                            <a href="#"><span class="icon-state theme2"><i class="fa fa-fw fa-stop"></i></span> Detener Prorroga</a>
                        </li>
                        <li>
                            <a href="#"><span class="icon-state theme3"><i class="fa fa-fw fa-refresh"></i></span> Reiniciar Prorroga</a>
                        </li>
                        <li>
                            <a href="#"><span class="icon-state theme4"><i class="fa fa-fw fa-undo"></i></span> Escalar proceso</a>
                        </li>
                    </ul>
                    <label for="txtObservations">Observaciones:</label>
                    <textarea id="txtObservations" class="form-control" rows="5" placeholder="Escriba aquí las observaciones por las cuales está realizando el cambio."></textarea>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-fw fa-check"></i> Aceptar</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-fw fa-times"></i> Cerrar</button>
                </div>
            </div>

        </div>
    </div>
    <!--MODAL CHANGE STATE-->

    <!--footer Section -->
    <div class="for-full-back" id="footer">
        Zolid By ZTE Colombia | All Right Reserved
    </div>
    <!--End footer Section -->

    <?php $this->load->view('parts/generic/scripts'); ?>    
    <script src="<?= URL::to('assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js?v=1') ?>" type="text/javascript"></script>
    <script src="<?= URL::to('assets/plugins/jquery.mask.js') ?>" type="text/javascript"></script>
    <script src="<?= URL::to('assets/js/modules/tracking-details.js?v=1.1') ?>" type="text/javascript"></script>
</body>
</html>
