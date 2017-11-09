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
            <div class="col-md-12 hidden" id="trackingDetails">
                <div class="panel-group m-b-5" id="accordion">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse1"><i class="fa fa-fw fa-info"></i> Información básica</a>
                            </h4>
                        </div>
                        <div id="collapse1" class="panel-collapse collapse">
                            <div class="panel-body">
                                <form class="form-horizontal well" id="formDetallesBasicos">
                                    <div class="alert alert-success alert-dismissable hidden">
                                        <a href="#" class="close" >&times;</a>
                                        <p class="p-b-0" id="text"></p>
                                    </div>
                                    <div class="panel-body">
                                        <fieldset class="col-md-6 control-label">
                                            <div class="form-group">
                                                <label for="txtEstacion" class="col-md-3 control-label">Estacion:</label>
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
                                                <label for="txtTecnologia" class="col-md-3 control-label">Tecnologia:</label>
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
                                                        <input type="text" name="k_id_preparation.n_enteejecutor" id="txtEnteEjecuto" class="form-control" value="" readonly="false">
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
                                                <label for="txtSubestado" class="col-md-3 control-label">subestado:</label>
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
                                <div class="stepwizard col-md-offset-3 m-t-10 m-b-25">
                                    <div class="stepwizard-row setup-panel">
                                        <div class="stepwizard-step">
                                            <a href="#step-0" type="button" class="btn btn-primary btn-circle">1</a>
                                            <!--<p>Parte 1</p>-->
                                        </div>
                                        <div class="stepwizard-step">
                                            <a href="#step-1" type="button" class="btn btn-default btn-circle">2</a>
                                            <!--<p>Parte 1</p>-->
                                        </div>
                                        <div class="stepwizard-step">
                                            <a href="#step-2" type="button" class="btn btn-default btn-circle" >3</a>
                                            <!--<p>Parte 2</p>-->
                                        </div>
                                        <!--                                        <div class="stepwizard-step">
                                                                                    <a href="#step-3" type="button" class="btn btn-default btn-circle" >3</a>
                                                                                    <p>Step 3</p>
                                                                                </div>-->
                                    </div>
                                </div>
                                <form id="formTrackingDetails" action="TicketOnair/updateTicket">
                                    <div class="alert alert-success alert-dismissable hidden">
                                        <a href="#" class="close" >&times;</a>
                                        <p class="p-b-0" id="text"></p>
                                    </div>
                                    <input type="hidden" name="ticket_on_air.id_onair" value="<?php echo isset($_GET["id"]) ? $_GET["id"] : 0 ?>" />
                                    <input type="hidden" name="ticket_on_air.id_onair" value="<?php echo isset($_GET["id"]) ? $_GET["id"] : "0" ?>" />
                                    <div class="display-block p-l-40 p-r-40 m-b-0 well step-panel" id="step-0">
                                        <div class="row form-xs">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="txtBCFWBTS">BCF WBTS:</label>
                                                    <input type="text" class="form-control input-sm" id="txtBCFWBTS" placeholder="BCF WBTS" name="preparation_stage.n_bcf_wbts_id" />
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="txtBTS">BTS:</label>
                                                    <input type="text" class="form-control input-sm" id="txtBTS" name="preparation_stage.n_bts_id" placeholder="BTS" />
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group p-t-15">
                                                    <div class="checkbox checkbox-primary">
                                                        <input id="checkbox2" type="checkbox" name="preparation_stage.b_vistamm">
                                                        <label for="checkbox2" class="text-bold">
                                                            VistaMM
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="txtControlador">Controlador:</label>
                                                    <input type="text" id="txtControlador" class="form-control input-sm" placeholder="Controlador" name="preparation_stage.n_controlador" />
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="txtIdControlador">ID Controlador:</label>
                                                    <input type="text" id="txtIdControlador" class="form-control input-sm" placeholder="Id Controlador" name="preparation_stage.n_idcontrolador" />
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="txtBtsIpAddress">BTS IP Address:</label>
                                                    <input type="text" class="form-control input-sm" placeholder="BTS IP Address" id="txtBtsIpAddress" name="preparation_stage.n_btsipaddress" />
                                                </div>
                                            </div>
                                            <div class="col-md-3 p-t-20">
                                                <button type="button" class="btn btn-primary"><i class="fa fa-fw fa-check"></i> Revisado</button>
                                            </div>
                                            <!--ingenieroPrecheck y FinPre los generará el sistema.-->
                                        </div>
                                    </div>
                                    <div class="hidden display-block p-l-40 p-r-40 m-b-0 well step-panel" id="step-1">
                                        <div class="row form-xs">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="txtCorrecionPendientes">Correción pendientes:</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control input-sm" id="txtCorrecionPendientes" name="preparation_stage.d_correccionespendientes" value="" placeholder="DD/MM/YYYY"  data-callback="dom.formatDate" />
                                                        <div class="input-group-btn">
                                                            <button class="btn btn-default btn-sm"><i class="fa fa-fw fa-calendar"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="txtTicketTremedy">Ticket Tremedy:</label>
                                                    <input type="text" class="form-control input-sm" id="txtTicketTremedy" placeholder="Tiecket Tremedy" name="preparation_stage.n_ticketremedy" />
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="txtLAC">LAC:</label>
                                                    <input type="text" class="form-control input-sm" id="txtLAC" placeholder="LAC" name="preparation_stage.n_lac" />
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="txtRAC">RAC:</label>
                                                    <input type="text" class="form-control input-sm" id="txtRAC" placeholder="RAC" name="preparation_stage.n_rac" />
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="txtSAC">SAC:</label>
                                                    <input type="text" class="form-control input-sm" id="txtSAC" placeholder="SAC" name="preparation_stage.n_sac" />
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="txtIdNotificacion">Id Notificación:</label>
                                                    <input type="text" class="form-control input-sm" id="txtIdNotificacion" placeholder="Id Notificación" name="preparation_stage.id_notificacion" />
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="txtIdDocumentacion">Id Documentación:</label>
                                                    <input type="text" class="form-control input-sm" id="txtIdDocumentacion" placeholder="Id Documentación" name="preparation_stage.id_documentacion" />
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="txtComentarioSocial">Comentario Social:</label>
                                                    <textarea class="form-control input-sm" id="txtComentarioSocial" rows="3" placeholder="Escriba aquí..." name="preparation_stage.n_comentarioccial"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="hidden well display-block p-l-40 p-r-40 m-b-0 step-panel" id="step-2">
                                        <div class="row form-xs">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="cmbEstadosTD">Estado:</label>
                                                    <select class="form-control select-fill input-sm" id="cmbEstadosTD" name="ticket_on_air.k_id_status_onair.k_id_status" >
                                                        <option>Seleccione</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="cmbSubEstadosTD">SubEstado:</label>
                                                    <select class="form-control select-fill input-sm" id="cmbSubEstadosTD" name="ticket_on_air.k_id_status_onair.k_id_substatus" >
                                                        <option>Seleccione</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="txtFechaBloqueado">Bloqueado:</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control input-sm" id="txtFechaBloqueado" placeholder="DD/MM/YYYY" name="ticket_on_air.d_bloqueo" data-callback="dom.formatDate"/>
                                                        <div class="input-group-btn">
                                                            <button class="btn btn-default btn-sm"><i class="fa fa-fw fa-calendar"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="txtFechaDesBloqueado">Desbloqueado:</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control input-sm" id="txtFechaDesBloqueado" placeholder="DD/MM/YYYY" name="ticket_on_air.d_desbloqueo" data-callback="dom.formatDate" />
                                                        <div class="input-group-btn">
                                                            <button class="btn btn-default btn-sm"><i class="fa fa-fw fa-calendar"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group has-error">
                                                    <label>Sectores bloqueados:</label>
                                                    <select class="form-control input-sm" id="cmbSectoresBloqueados">
                                                        <option value="">Seleccione</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group has-error">
                                                    <label>Sectores desbloqueados:</label>
                                                    <select class="form-control input-sm" id="cmbSectoresDesloqueados">
                                                        <option value="">Seleccione</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="txtFechaRFT">Fecha RFT:</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control input-sm" id="txtFechaRFT" placeholder="DD/MM/YYYY" name="ticket_on_air.fecha_rft" data-callback="dom.formatDate" />
                                                        <div class="input-group-btn">
                                                            <button class="btn btn-default btn-sm"><i class="fa fa-fw fa-calendar"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="txtFechaCG">Fecha CG:</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control input-sm" id="txtFechaCG" placeholder="DD/MM/YYYY" name="ticket_on_air.d_fecha_cg" data-callback="dom.formatDate" />
                                                        <div class="input-group-btn">
                                                            <button class="btn btn-default btn-sm"><i class="fa fa-fw fa-calendar"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="txtExclusionTrafico">Exclusión bajo tráfico:</label>
                                                    <input type="text" class="form-control input-sm" id="txtExclusionTrafico" placeholder="Exclusión bajo tráfico" name="ticket_on_air.n_exclusion_bajo_trafico" />
    <!--                                                <select class="form-control input-sm" id="cmbExclusionTrafico">
                                                        <option value="">Seleccione</option>
                                                    </select>-->
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="txtTicket">Ticket:</label>
                                                    <input type="text" class="form-control input-sm" id="txtTicket" placeholder="Ticket" name="ticket_on_air.n_ticket"/>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="cmbEstadoTicket">Estado Ticket:</label>
                                                    <select class="form-control input-sm" id="cmbEstadoTicket" name="ticket_on_air.n_estado_ticket">
                                                        <option value="">Seleccione</option>
                                                        <option value="Abierto">Abierto</option>
                                                        <option value="Cerrado">Cerrado</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="cmbSLNModernizacion">SLN Modernización:</label>
                                                    <select class="form-control input-sm" id="cmbSLNModernizacion" name="ticket_on_air.n_sln_modernizacion">
                                                        <option value="">Seleccione</option>
                                                        <option value="1">Concurrente</option>
                                                        <option value="2">Dedicadas Sencillas</option>
                                                        <option value="3">RF Sharing Dedicado</option>
                                                        <option value="4">RF Diversity Sharihg</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn btn-success pull-right m-t-10"><i class="fa fa-fw fa-save"></i> Actualizar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="well">
                    <div>
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
                                <table id="tblTrackingDetails" class="table table-hover table-condensed table-striped" width="100%"></table>
                            </div>
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
    <script src="<?= URL::to("assets/plugins/jquery.validate.min.js") ?>" type="text/javascript"></script>
    <script src="<?= URL::to('assets/js/modules/tracking-details.js?v=1.1') ?>" type="text/javascript"></script>
</body>
</html>
