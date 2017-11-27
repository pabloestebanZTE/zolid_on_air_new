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
                                <form class="form-horizontal well" id="formDetallesBasicos" action="TicketOnair/updateTicketDetails">
                                    <input type="hidden" name="idOnAir" value="<?php echo isset($_GET["id"]) ? $_GET["id"] : "0" ?>" />
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
                                                        <input type="text" name="k_id_station.k_id_city.k_id_regional.n_name_regional" id="txtRegional" class="form-control" value="" readonly="false">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="txtIngeniero" class="col-md-3 control-label">Ingeniero:</label>
                                                <div class="col-md-8 selectContainer">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-fw fa-user"></i></span>
                                                        <input type="text" name="txtIngeniero" id="txtIngeniero" class="form-control" value="<?php echo Auth::user()->n_name_user . ' ' . Auth::user()->n_last_name_user; ?>" readonly="false">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="txtFechaIngresoOnAir" class="col-md-3 control-label">Fecha ingreso On Air:</label>
                                                <div class="col-md-8 selectContainer">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-fw fa-calendar"></i></span>
                                                        <input type="text" name="k_id_preparation.d_ingreso_on_air" id="txtFechaIngresoOnAir" class="form-control" value="" readonly="false" placeholder="DD/MM/AAAA">
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
                                                        <input type="text" name="k_id_preparation.n_wp" id="txtWP" class="form-control" value="" >
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="txtwbts" class="col-md-3 control-label">WBTS:</label>
                                                <div class="col-md-8 selectContainer">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-fw fa-drivers-license"></i></span>
                                                        <input type="text" name="k_id_preparation.n_bcf_wbts_id" id="k_id_preparation.n_bcf_wbts_id" class="form-control" value="" >
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
                                                <label class="col-md-3 control-label">Ente Ejecutor:</label>
                                                <div class="col-md-8 selectContainer">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="fa fa-fw fa-address-book"></i></span>
                                                        <select name="k_id_preparation.n_enteejecutor" id="n_enteejecutor" class="form-control selectpicker" required>
                                                            <option value="" >Seleccione</option><option value="Claro" >Claro</option><option value="Nokia" >Nokia</option>
                                                        </select>
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

                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Observaciones de Creación</label>
                                                <div class="col-md-8 inputGroupContainer">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
                                                        <textarea class="form-control" name="k_id_preparation.n_comentario_doc" id="n_comentario_doc" placeholder="Observaciones coordinador" readonly="false"></textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Observaciones de Asignacion</label>
                                                <div class="col-md-8 inputGroupContainer">
                                                    <div class="input-group">
                                                        <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
                                                        <textarea class="form-control" name="n_comentario_coor" id="n_comentario_coor"  readonly="false"></textarea>
                                                    </div>
                                                </div>
                                            </div>                                            
                                        </fieldset>
                                        <div class="form-group">
                                            <hr/>
                                            <div class="col-xs-12 text-center">
                                                <button class="btn btn-success"><i class="fa fa-fw fa-save"></i> Actualizar</button>                                    
                                            </div>
                                        </div>
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
                                    </div>
                                </div>
                                <form id="formTrackingDetails" action="TicketOnair/updateTicket">
                                    <div class="alert alert-success alert-dismissable hidden">
                                        <a href="#" class="close" >&times;</a>
                                        <p class="p-b-0" id="text"></p>
                                    </div>
                                    <input type="hidden" name="ticket_on_air.id_onair" value="<?php echo isset($_GET["id"]) ? $_GET["id"] : "0" ?>" id="idProceso" />
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
                                            <!--ingenieroPrecheck y FinPre los generará el sistema.-->
                                        </div>
                                    </div>
                                    <div class="hidden display-block p-l-40 p-r-40 m-b-0 well step-panel" id="step-1">
                                        <div class="row form-xs">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="txtCorrecionPendientes">Correción pendientes:</label>
                                                    <input type="datetime-local" class="form-control input-sm" id="txtCorrecionPendientes" name="preparation_stage.d_correccionespendientes" value="" placeholder="DD/MM/YYYY"  style="width: 189px;" data-callback="dom.formatDateForPrint"/>                                                       
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
                                                    <select class="form-control select-fill input-sm" id="cmbEstadosTD" disabled="">
                                                        <option>Seleccione</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="cmbSubEstadosTD">SubEstado:</label>
                                                    <select class="form-control select-fill input-sm" id="cmbSubEstadosTD" disabled="">
                                                        <option>Seleccione</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="txtFechaBloqueado">Bloqueado:</label>
                                                    <input type="datetime-local" class="form-control input-sm" id="txtFechaBloqueado" placeholder="DD/MM/YYYY" name="ticket_on_air.d_bloqueo" style="width: 189px;" data-callback="dom.formatDateForPrint"/>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="txtFechaDesBloqueado">Desbloqueado:</label>
                                                    <input type="datetime-local" class="form-control input-sm" id="txtFechaDesBloqueado" placeholder="DD/MM/YYYY" name="ticket_on_air.d_desbloqueo" style="width: 189px;" data-callback="dom.formatDateForPrint"/>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <input type="hidden" name="ticket_on_air.n_sectoresbloqueados" id="sectoresBloqueados" />
                                                <input type="hidden" name="ticket_on_air.n_sectoresdesbloqueados" id="sectoresDebloqueados"/>
                                                <input type="hidden" name="ticket_on_air.n_json_sectores" id="jsonSectores" />
                                                <div class="form-group">
                                                    <button type="button" id="btnEditarSectores" class="btn btn-primary m-t-20" title="Ver y editar sectores"><i class="fa fa-fw fa-check-square-o"></i> (0) Sectores agregados</button>
                                                </div>
                                            </div>                                            
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="txtFechaRFT">Fecha RFT:</label>
                                                    <input type="datetime-local" class="form-control input-sm" id="txtFechaRFT" placeholder="DD/MM/YYYY" name="ticket_on_air.fecha_rft" style="width: 189px;" data-callback="dom.formatDateForPrint"/>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="txtFechaCG">Fecha CG:</label>
                                                    <input type="datetime-local" class="form-control input-sm" id="txtFechaCG" placeholder="DD/MM/YYYY" name="ticket_on_air.d_fecha_cg" style="width: 189px;" data-callback="dom.formatDateForPrint"/>
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
                                            <!--                                            <div class="col-md-3">
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
                                                                                        </div>-->                                            
                                        </div>
                                    </div>
                                    <button class="btn btn-success pull-right m-t-10"><i class="fa fa-fw fa-save"></i> Actualizar</button>
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
                    <div class="hidden" id="alertReinicio12h">
                        <div class="row">
                            <div class="col-xs-12 p-l-25 p-r-25">
                                <p class="m-t-0 m-b-0">La actividad actual se encuentra en estado: <b>Reinicio 12h</b> haga clic en el siguiente botón si desea iniciarla.</p>
                                <button class="btn btn-primary" id="btnRunActividad"><i class="fa fa-fw fa-play"></i> Iniciar Actividad</button>
                            </div>
                        </div>
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
                            <div class="hour-step active" data-ref="#contentDetails_12h_content" data-value="12">
                                <div class="body-step">
                                    <label>12H</label>
                                    <span class="icon-step"><i class="fa fa-fw fa-clock-o"></i></span>
                                </div>
                                <div class="back-progress-step">
                                    <span class="progress-step" id="progressStep1"></span>
                                </div>
                                <div class="footer-step">
                                    <label id="timeStep" class="timerstamp"><i class="fa fa-fw fa-clock-o"></i> -00:00</label>
                                </div>
                            </div>
                            <div class="hour-step" data-ref="#contentDetails_24h_content" data-value="24">
                                <div class="body-step">
                                    <label>24H</label>
                                    <span class="icon-step"><i class="fa fa-fw fa-clock-o"></i></span>
                                </div>
                                <div class="back-progress-step">
                                    <span class="progress-step"></span>
                                </div>
                                <div class="footer-step">
                                    <label id="timeStep" class="timerstamp"><i class="fa fa-fw fa-clock-o"></i> -00:00</label>
                                </div>
                            </div>
                            <div class="hour-step" data-ref="#contentDetails_36h_content" data-value="36">
                                <div class="body-step">
                                    <label>36H</label>
                                    <span class="icon-step"><i class="fa fa-fw fa-clock-o"></i></span>
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
                            <div id="modelWiget" class="hidden form-group row wiget-comment">
                                <div class="col-md-3 wiget-list">
                                    <div class="item-wiget">
                                        <div class="icon-wiget"><i class="fa fa-fw fa-calendar"></i></div>
                                        <div class="details-wiget">
                                            <span class="title display-block">Fecha: </span>
                                            <span class="text display-block" id="d_start">{d_start}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <p class="text-left m-all-0 p-all-0"><b class="display-block m-b-5"><i class="fa fa-fw fa-comment"></i> Comentario:</b><span id="n_comentario">{n_comentario}</span></p>
                                </div>
                            </div>
                            <div class="item-wiget hidden" id="wigetUser">
                                <div class="icon-wiget"><i class="fa fa-fw fa-user"></i></div>
                                <div class="details-wiget">
                                    <span class="title display-block">Ningún usuario asignado</span>
                                </div>
                            </div>
                            <div class="well m-b-0 p-t-5 p-b-5">
                                <div class="row content-wiget" id="contentDetails_12h_content">
                                    <div class="col-md-8 wiget" id="contentDetails_12h">
                                    </div>
                                    <div class="col-md-4 wiget" id="contentDetails_12h_users">
                                        <div class="wiget-list p-l-25 users">                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="row content-wiget hidden" id="contentDetails_24h_content">
                                    <div class="col-md-8 wiget" id="contentDetails_24h">
                                    </div>
                                    <div class="col-md-4 wiget" id="contentDetails_24h_users">
                                        <div class="wiget-list p-l-25 users">                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="row content-wiget hidden" id="contentDetails_36h_content">
                                    <div class="col-md-8 wiget" id="contentDetails_36h">
                                    </div>
                                    <div class="col-md-4 wiget" id="contentDetails_36h_users">
                                        <div class="wiget-list p-l-25 users">                                            
                                        </div>
                                    </div>
                                </div>
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
                            <a href="javascript:;" data-action="PROR" data-focus="#txtTiempoProrroga"><span class="icon-state theme2"><i class="fa fa-fw fa-pause"></i></span> Crear Prórroga</a>
                            <ul class="content-state hidden">
                                <li>
                                    <label class="display-block" for="txtTiempoProrroga"><i class="fa fa-fw fa-clock-o"></i> Tiempo de la prórroga (Horas):</label>
                                    <div class="input-control">
                                        <input type="text" class="form-control" placeholder="Horas" id="txtTiempoProrroga"/>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript:;" data-action="NEXT"><span class="icon-state theme3"><i class="fa fa-fw fa-forward"></i></span> Cambiar Fase</a>
                            <ul class="content-state hidden">
                                <li>
                                    <label class="display-block" for="cmbSiguienteFase"><i class="fa fa-fw fa-forward"></i> Seleccione la fase:</label>
                                    <div class="input-control">                                        
                                        <select id="cmbSiguienteFase" class="form-control">
                                            <option value="12h">12H</option>
                                            <option value="24h">24H</option>
                                            <option value="36h">36H</option>
                                        </select>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript:;" data-action="PROD" ><span class="icon-state theme1"><i class="fa fa-fw fa-play"></i></span> Producción</a>
                            <ul class="content-state hidden">
                                <li>
                                    <div class="input-control">
                                        <div class="row">
                                            <select class="form-control" id="cmbEstadosProcesos">
                                                <option value="">Selecione</option>
                                                <option value="87">Pendiente Tareas Remedy</option>
                                                <option value="89">Producción</option>
                                            </select>
                                            <div class="checkbox checkbox-primary" id="productionList">
                                                <div class="display-block">
                                                    <input id="chk_p_1" type="checkbox" >
                                                    <label for="chk_p_1" class="text-bold">
                                                        Activación Cuarta Portadora.
                                                    </label>
                                                </div>
                                                <div class="display-block">
                                                    <input id="chk_p_2" type="checkbox" >
                                                    <label for="chk_p_2" class="text-bold">
                                                        Pendiente ID RF Tools
                                                    </label>
                                                </div>
                                                <div class="display-block">
                                                    <input id="chk_p_3" type="checkbox" >
                                                    <label for="chk_p_3" class="text-bold">
                                                        Pendiente Sitio Limpio.
                                                    </label>
                                                </div>
                                                <div class="display-block">
                                                    <input id="chk_p_4" type="checkbox" >
                                                    <label for="chk_p_4" class="text-bold">
                                                        Activación Cuarta Portadora.
                                                    </label>
                                                </div>
                                                <div class="display-block">
                                                    <input id="chk_p_5" type="checkbox" >
                                                    <label for="chk_p_5" class="text-bold">
                                                        Pendiente Testgestión.
                                                    </label>
                                                </div>
                                                <div class="display-block">
                                                    <input id="chk_p_6" type="checkbox" >
                                                    <label for="chk_p_6" class="text-bold">
                                                        Pendiente Pruebas Alarmas.
                                                    </label>
                                                </div>
                                                <div class="display-block">
                                                    <input id="chk_p_7" type="checkbox" >
                                                    <label for="chk_p_7" class="text-bold">
                                                        Error de instalación.
                                                    </label>
                                                </div>
                                                <div class="display-block">
                                                    <input id="chk_p_8" type="checkbox" >
                                                    <label for="chk_p_8" class="text-bold">
                                                        Pendiente Evidencias.
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="javascript:;" data-action="STANDBY"><span class="icon-state theme2"><i class="fa fa-fw fa-stop-circle"></i></span> Stand By</a>
                        </li>
                        <li>
                            <a href="<?= URL::to("User/scaling?id=" . $_GET['id']); ?>"><span class="icon-state theme4"><i class="fa fa-fw fa-undo"></i></span> Escalar Proceso</a>
                        </li>
                    </ul>
                    <label for="txtObservations">Observaciones:</label>
                    <textarea id="txtObservations" class="form-control" rows="5" placeholder="Escriba aquí las observaciones por las cuales está realizando el cambio."></textarea>
                </div>
                <div class="modal-footer">
                    <button id="btnAceptarModal" type="button" class="btn btn-primary" data-dismiss="modal"><i class="fa fa-fw fa-check"></i> Aceptar</button>
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


    <!--MODAL SECTORES-->
    <div id="modalSectores" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-fw fa-check-square-o"></i> Seleccionar sectores</h4>
                </div>
                <div class="modal-body">                    
                    <div class="row p-t-15">
                        <div class="col-xs-12">
                            <div style="display: block; overflow: auto; overflow-x: hidden; max-height: 300px; border: 1px solid #ddd;">
                                <table class="table table-bordered table-condensed table-striped table-sm" id="tblSectores">
                                    <thead><tr><th>Sector</th><th>Bloqueado</th><th>Desbloqueado</th></tr></thead>
                                    <tbody>
                                        <tr><td colspan="3"><i class="fa fa-fw fa-warning"></i> Ningún sector disponible</td></tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal" id="btnAceptarModalSectores">Aceptar</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                </div>
            </div>

        </div>
    </div>
    <!--FIN MODAL SECTORES-->

    <?php $this->load->view('parts/generic/scripts'); ?>
    <script src="<?= URL::to('assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js?v=1') ?>" type="text/javascript"></script>
    <script src="<?= URL::to('assets/plugins/jquery.mask.js') ?>" type="text/javascript"></script>
    <script src="<?= URL::to("assets/plugins/jquery.validate.min.js") ?>" type="text/javascript"></script>
    <script src="<?= URL::to('assets/js/modules/tracking-details.js?v=1.9') ?>" type="text/javascript"></script>
</body>
</html>
