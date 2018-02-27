<!DOCTYPE html>
<html lang="en">
    <?php $this->load->view('parts/generic/head'); ?>
    <style type="text/css">
        .nav li a {
            background-color:#207be5;
            text-decoration:'Open Sans', sans-serif;
            padding:20px 12px;
            display:block;
            color: #FFF;
        }
    </style>
    <body data-base="<?= URL::base() ?>">
        <?php $this->load->view('parts/generic/header'); ?>
        <input type="hidden" id="link_view_ticket" value="User/trackingDetails" />
        <input type="hidden" id="isBlock" value="<?= $block ?>" />
        <div class="container autoheight p-t-20">
            <div class="alert alert-success alert-dismissable hidden" id="principalAlert">
                <a class="close">&times;</a>
                <p id="text" class="m-b-0 p-b-0"></p>
            </div>
            <!-- TRACKING DETAILS FORM -->
            <div class="col-md-12 hidden" id="trackingDetails">
                <div class="panel-group m-b-5 m-t-15" id="accordion">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" data-parent="#accordion" href="#collapse1"><i class="fa fa-fw fa-info"></i> Información básica</a>
                            </h4>
                        </div>
                        <div id="collapse1" class="panel-collapse collapse">
                            <div class="panel-body">
                                <?php $view = (Auth::isDocumentador() || Auth::isCoordinador() || Auth::isIngeniero()); ?>
                                <?php if ($view) { ?>
                                    <ul class="nav nav-tabs">
                                        <li class="active"><a data-toggle="tab" href="#basic_information"><i class="fa fa-fw fa-info-circle"></i> Información básica</a></li>
                                        <li><a data-toggle="tab" href="#related_tickets" id="tabRelacionarTickets" ><i class="fa fa-fw fa-rebel"></i> Tickets relacionados (<span id="spanRelatedTickets">0</span>)</a></li>
                                    </ul>
                                <?php } ?>
                                <?php if ($view) { ?>
                                    <div class="tab-content">
                                        <div id="basic_information" class="tab-pane fade in active">
                                        <?php } ?>
                                        <form class="form-horizontal well" id="formDetallesBasicos" action="TicketOnair/updateTicketDetails">
                                            <input type="hidden" name="idOnAir" value="<?php echo isset($_GET["id"]) ? $_GET["id"] : "0" ?>" />
                                            <div class="alert alert-success alert-dismissable hidden">
                                                <a class="close" >&times;</a>
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
                                                                <select class="form-control" id="cmbBanda" name="k_id_band.k_id_band">
                                                                    <option value="">Seleccione</option>
                                                                </select>
                                                                <!--<input type="text" name="k_id_band.n_name_band" id="txtBanda" class="form-control" value="" readonly="false">-->
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
                                                                <input type="text" name="i_actualEngineer" id="txtIngeniero" class="form-control" readonly="false">
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
                                                                <select class="form-control helper-change" id="cmbTecnologia" name="k_id_technology.k_id_technology">
                                                                    <option value="">Seleccione</option>
                                                                </select>
        <!--                                                        <input type="text" name="k_id_technology.n_name_technology" id="txtTecnologia" class="form-control" value="" readonly="false">-->
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="txtTipotrabajo" class="col-md-3 control-label">Tipo de trabajo:</label>
                                                        <div class="col-md-8 selectContainer">
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class="fa fa-fw fa-briefcase"></i></span>
                                                                <select class="form-control" id="cmbTipoTrabajo" name="k_id_work.k_id_work">
                                                                    <option value="">Seleccione</option>
                                                                </select>
                                                                <!--<input type="text" name="k_id_work.n_name_ork" id="txtTipotrabajo" class="form-control" value="" readonly="false">-->
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
                                                        <label class="col-md-3 control-label">Observaciones de Creación:</label>
                                                        <div class="col-md-8 inputGroupContainer">
                                                            <div class="input-group">
                                                                <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
                                                                <textarea class="form-control" name="k_id_preparation.n_comentario_doc" id="n_comentario_doc" placeholder="Observaciones de creación" readonly="false"></textarea>
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
                                        <?php if ($view) { ?>
                                        </div>
                                    <?php } ?>
                                    <?php if ($view) { ?>
                                        <div id="related_tickets" class="tab-pane fade">
                                            <div class="form-horizontal well" method="post"  id="stationForm" name="stationForm">
                                                <div class="alert alert-info alert-dismissable">
                                                    <a href="#" class="close" >&times;</a>
                                                    <p class="p-b-0" id="text">
                                                        <i class="fa fa-fw fa-info-circle"></i> Utiliza este panel para relacionar tickets. Selecciona el ticket y has clic en el botón agregar.
                                                    </p>
                                                </div>
                                                <div class="panel-body">
                                                    <div class="relation-content-editor">
                                                        <div class="form-group">
                                                            <label for="cmbRegional" class="col-md-3 control-label">Ticket:</label>
                                                            <div class="col-md-8 selectContainer">
                                                                <div class="input-group">
                                                                    <span class="input-group-addon"><i class="fa fa-fw fa-check-circle"></i></span>
                                                                    <select id="cmbTicketRelation" class="form-control selectpicker" required>
                                                                        <option value="">Seleccione</option>
                                                                    </select>
                                                                    <div class="input-group-btn"><button type="button" id="btnAddTicketRelation" title="Agregar" class="btn btn-primary"><i class="fa fa-fw fa-plus"></i></button></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <hr/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <table class="table table-bordered table-condensed table-striped table-hover" id="tableRelacionTickets" width="100%">
                                                            <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>Ticket</th>
                                                                    <th><i class="fa fa-fw fa-cog"></i> Opciones</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr class="no-found"><td colspan="3"><i class="fa fa-fw fa-warning"></i> No se han agregado relaciones para este ticket.</td></tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <!--  fin seccion izquierda form---->

                                                    <!-- Button -->
                                                    <center>
                                                        <div class="form-group">
                                                            <label class="col-md-12 control-label"></label>
                                                            <div class="col-md-12">
                                                                <button type="submit" id="btnGuardarRelacionTickets" class="btn btn-primary" >Guardar <span class="fa fa-fw fa-floppy-o"></span></button>
                                                            </div>
                                                        </div>
                                                    </center>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <?php if ($view) { ?>
                                    </div>
                                <?php } ?>
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
                                        <a class="close" >&times;</a>
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
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="txtResponsableTicket">Responsable ticket:</label>
                                                    <input type="text" class="form-control input-sm" placeholder="Responsable Ticket" id="txtResponsableTicket" name="ticket_on_air.n_responsable_ticket" disabled=""/>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group p-t-15">
                                                    <div class="checkbox checkbox-primary">
                                                        <input id="checkbox23" type="checkbox" name="ticket_on_air.i_priority">
                                                        <label for="checkbox23" class="text-bold">
                                                            Marcar como Prioritario
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--ingenieroPrecheck y FinPre los generará el sistema.-->
                                        </div>
                                    </div>
                                    <div class="hidden display-block p-l-40 p-r-40 m-b-0 well step-panel" id="step-1">
                                        <div class="row form-xs">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="txtCorrecionPendientes">Corrección pendientes:</label>
                                                    <input type="datetime-local" class="form-control input-sm" id="txtCorrecionPendientes" name="preparation_stage.d_correccionespendientes" value="" placeholder="DD/MM/YYYY"  style="width: 189px;" data-callback="dom.formatDateForPrint"/>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="txtTicketTremedy">Ticket Remedy:</label>
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
                                            <!--                                            <div class="col-md-3">
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
                                                                                        </div>-->
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
                                            <input type="hidden" name="estado_sectores" id="txtEstadoSectores"/>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="cmbEstadosTD">Estado:</label>
                                                    <select class="form-control select-fill input-sm" name="ticket_on_air.k_id_status" id="cmbEstadosTD" <?= (Auth::isCoordinador() || Auth::isDocumentador()) ? '' : 'disabled=""' ?>>
                                                        <option>Seleccione</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="cmbSubEstadosTD">SubEstado:</label>
                                                    <select class="form-control input-sm" name="ticket_on_air.k_id_substatus" id="cmbSubEstadosTD" <?= (Auth::isCoordinador() || Auth::isDocumentador()) ? '' : 'disabled=""' ?>>
                                                        <option>Seleccione</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="txtFechaBloqueado">Bloqueado:</label>
                                                    <input type="datetime-local" disabled="disabled" class="form-control input-sm" id="txtFechaBloqueado" placeholder="DD/MM/YYYY" name="ticket_on_air.d_bloqueo" style="width: 189px;" data-callback="dom.formatDateForPrint"/>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="txtFechaDesBloqueado">Desbloqueado:</label>
                                                    <input type="datetime-local" disabled="disabled" class="form-control input-sm" id="txtFechaDesBloqueado" placeholder="DD/MM/YYYY" name="ticket_on_air.d_desbloqueo" style="width: 189px;" data-callback="dom.formatDateForPrint"/>
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
                                            <?php if (Auth::isCoordinador()) { ?>
                                                <div class="col-md-12 hidden" id="comment_change_stated">
                                                    <div class="form-group">
                                                        <label for="txtCoordinadorComment">Comentario:</label>
                                                        <textarea class="form-control" id="txtCoordinadorComment" name="ticket_on_air.coordinador_comment" placeholder="Escriba su comentario aquí."></textarea>
                                                    </div>
                                                </div>
                                            <?php } ?>
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
                                    <?php
                                    if (!$block) {
                                        ?>
                                        <button class="btn btn-success pull-right m-t-10"><i class="fa fa-fw fa-save"></i> Actualizar</button>
                                        <button class="btn btn-primary pull-right m-t-10 m-r-5" id="btnEscalar"><i class="fa fa-fw fa-undo"></i> Escalar</button>
                                    <?php } ?>
                                </form>
                            </div>
                        </div>
                    </div>

                    <?php if (!Auth::isIngeniero()) { ?>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse22"><i class="fa fa-fw fa-list"></i> Detalles de seguimiento</a>
                                </h4>
                            </div>
                            <div id="collapse22" class="panel-collapse collapse">
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
                                                                <option value="NOKIA-ZTE">NOKIA ZTE</option>
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
                    <?php } ?>
                </div>
                <div class="well">
                    <div class="alert alert-info alert-dismissable m-b-0" id="alertFases">
                        <a class="close">&times;</a>
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
                    <div class="hidden" id="alertReinicio24h">
                        <div class="row">
                            <div class="col-xs-12 p-l-25 p-r-25">
                                <p class="m-t-0 m-b-0">La actividad actual se encuentra en estado: <b>Reinicio 24h</b> haga clic en el siguiente botón si desea iniciarla.</p>
                                <button class="btn btn-primary" id="btnRunActividad24"><i class="fa fa-fw fa-play"></i> Iniciar Actividad</button>
                            </div>
                        </div>
                    </div>
                    <div class="hidden" id="alertReinicio36h">
                        <div class="row">
                            <div class="col-xs-12 p-l-25 p-r-25">
                                <p class="m-t-0 m-b-0">La actividad actual se encuentra en estado: <b>Reinicio 36h</b> haga clic en el siguiente botón si desea iniciarla.</p>
                                <button class="btn btn-primary" id="btnRunActividad36"><i class="fa fa-fw fa-play"></i> Iniciar Actividad</button>
                            </div>
                        </div>
                    </div>
                    <div id="contentFases" class="hidden">
                        <div class="col-xs-12 text-right">
                            <div class="display-block pull-right hidden" style="width: 400px;">
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
                            <div class="comment-step">
                                <i class="fa fa-fw fa-comments"></i>
                                <label>Comentarios</label>
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
                                <div class="row content-wiget hidden" id="contentComments">
                                    <div class="col-xs-12 p-t-0">
                                        <div id="alertComments" class="alert alert-success alert-dismissable hidden"><a class="close" data-dismiss="alert" aria-label="close">&times;</a><p id="text" class="m-b-0 p-b-0"></div>
                                    </div>
                                    <div class="col-xs-12 wiget">

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
                            <a href="javascript:;" data-action="SCALED"><span class="icon-state theme4"><i class="fa fa-fw fa-undo"></i></span> Escalar Proceso</a>
                        </li>
                    </ul>
                    <div class="row">
                        <div class="col-xs-12 p-b-15">
                            <label class="center-block" id="lblSectoresSeleccionados"><i class="fa fa-fw fa-wrench"></i> (<span class="length-sectores">0</span>) Sectores<span class="state-sectores"></span>:</label>
                            <div class="btn-group p-t-5 p-l-15">
                                <button type="button" class="btn btn-default btn-sectores view"><i class="fa fa-fw fa-check"></i> Verificar</button>
<!--                                <button type="button" class="btn btn-danger btn-sectores lock"><i class="fa fa-fw fa-lock"></i> Bloquear</button>
                                <button type="button" class="btn btn-success btn-sectores unlock"><i class="fa fa-fw fa-unlock"></i> Desbloquear</button>-->
                            </div>
                        </div>
                    </div>
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
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group">
                                <div class="selectContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-fw fa-briefcase"></i></span>
                                        <input type="text" class="form-control" id="txtTipoTrabajoModal" disabled="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="selectContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-fw fa-tablet"></i></span>
                                        <input type="text" class="form-control" id="txtTecnologiaModal" disabled="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="selectContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-fw fa-signal"></i></span>
                                        <input type="text" class="form-control" id="txtBandaModal" disabled="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row p-t-15">
                        <div class="col-xs-12">
                            <div style="display: block; overflow: auto; overflow-x: hidden; max-height: 200px; border: 1px solid #ddd;">
                                <table class="table table-bordered table-condensed table-striped table-sm" id="tblSectores" width="100%">
                                    <thead><tr><th class="vertical-middle">Sector</th><th><div class="checkbox checkbox-primary" style=""><input id="checkbox_tdheader_1" type="checkbox" name="checkbox_tdheader_1" class="checkbox-head" value="1" ><label for="checkbox_tdheader_1" class="text-bold">Seleccionar todos</label></div></th><th class="p-all-0 vertical-middle text-right"><button class="btn btn-default btn-sm m-r-15 btn-add-sector" ><i class="fa fa-fw fa-plus"></i> Agregar sector</button></th></tr></thead>
                                    <tbody>
                                        <tr><td colspan="3"><i class="fa fa-fw fa-warning"></i> Ningún sector disponible</td></tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <hr/>
                    <div class="row">
                        <div class="col-md-3 text-right">
                            <label class="m-t-5">Estado sectores:</label>
                        </div>
                        <div class="col-md-9">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-fw fa-wrench"></i>
                                </div>
                                <select id="cmbEstadoSectores" class="form-control" >
                                    <option value="">Seleccione</option>
                                    <option value="1">Bloqueados</option>
                                    <option value="0">Desbloqueados</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row hidden m-t-15" id="sectionComentarioSectores">
                        <div class="col-md-3 text-right">
                            <label class="m-t-5">Observaciones:</label>
                        </div>
                        <div class="col-md-9">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-fw fa-comment"></i>
                                </div>
                                <textarea class="form-control" placeholder="Observaciones" id="txtComentarioStartPrecheck"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="btnAceptarModalSectores">Aceptar</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal" id="btnClosedModalSectores">Cerrar</button>
                </div>
            </div>

        </div>
    </div>
    <!--FIN MODAL SECTORES-->

    <?php $this->load->view('parts/generic/scripts'); ?>
    <script type="text/javascript" >
        var rgPermisesUpdate = <?= (Auth::isDocumentador()) ? "true" : "false"; ?>
    </script>
    <script src="<?= URL::to('assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js?v=1') ?>" type="text/javascript"></script>
    <script src="<?= URL::to('assets/js/related_tickets.js?v=' . time()) ?>" type="text/javascript"></script>
    <script src="<?= URL::to('assets/plugins/jquery.mask.js') ?>" type="text/javascript"></script>
    <script src="<?= URL::to("assets/plugins/jquery.validate.min.js") ?>" type="text/javascript"></script>
    <script src="<?= URL::to('assets/js/modules/tracking-details.js?v=' . time()) ?>" type="text/javascript"></script>    
</body>
</html>
