<style type="text/css">
    table td:nth-child(5){
        width: 160px;
        text-align: center;
        vertical-align: middle !important;
    }
</style>
<div class='tab-content contentPrincipal hidden' id='tab1'>
    <div class='container'>
        <form class= 'well form-horizontal' action='' method='post'  id='assignService' name='assignServie' enctype= 'multipart/form-data'>
            <fieldset>
                <div class="row contentPrincipal hidden">
                    <div class="col col-md-12 p-t-40">
                        <input type="hidden" value="<?= Auth::getRole() ?>" id="rol">
                        <br/>
                        <div class="row">
                            <div class="col col-md-12 p-b-20" style="text-align: right;">
                                <a class="btn btn-primary" href="<?= URL::to('User/getAllTickets') ?>"><i class="fa fa-list" aria-hidden="true"></i>&nbsp;&nbsp;Ver todo</a>
                            </div>
                            <div class="col-md-12">
                                <div class="panel with-nav-tabs panel-primary">
                                    <div class="panel-heading">
                                        <ul class="nav nav-tabs">
                                            <li class="active"><a href="#tab1default" data-toggle="tab">Pendientes</a></li>
                                            <li><a href="#tab2default" data-toggle="tab">Ya asignados</a></li>
                                        </ul>
                                    </div>
                                    <div class="panel-body">
                                        <div class="tab-content">
                                            <div class="tab-pane fade in active" id="tab1default">
                                                <h1 class="m-t-0">Pendientes para asignación</h1>
                                                <table id="tablaPendientes" class="table table-hover table-condensed table-striped" width='100%'></table>
                                            </div>
                                            <div class="tab-pane fade" id="tab2default">
                                                <h1 class="m-t-0">Ya asignados</h1>
                                                <table id="tablaAsignados" class="table table-hover table-condensed table-striped" width='100%'></table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br/>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</div>

<!--Modal Preview Detalle-->
<div class="modal fade" role="dialog" id="modalPreview">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><i class="fa fa-fw fa-align-justify"></i> Detalles de la actividad</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal well" id="formDetallesBasicos">
                    <div class="alert alert-success alert-dismissable hidden">
                        <a href="#" class="close">×</a>
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
                                        <input type="text" name="txtIngeniero" id="txtIngeniero" class="form-control" value="FRANKLIN ROBERTO CHACON MENDEZ" readonly="false">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="txtFechaIngresoOnAir" class="col-md-3 control-label">Fecha ingreso On Air:</label>
                                <div class="col-md-8 selectContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-fw fa-calendar"></i></span>
                                        <input type="text" name="k_id_preparation.d_ingreso_on_air" id="txtFechaIngresoOnAir" class="form-control" value="" readonly="false" maxlength="10" placeholder="DD/MM/AAAA">
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

                            <div class="form-group">
                                <label for="txtwbts" class="col-md-3 control-label">WBTS:</label>
                                <div class="col-md-8 selectContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-fw fa-drivers-license"></i></span>
                                        <input type="text" name="k_id_preparation.n_bcf_wbts_id" id="k_id_preparation.n_bcf_wbts_id" class="form-control" value="" readonly="false">
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
                                        <textarea class="form-control" name="n_comentario_coor" id="n_comentario_coor" readonly="false"></textarea>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <!--   fin seccion derecha---->
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>

    </div>
</div>
<!--Fin Modal Preveiw Detalle-->
<?php $this->load->view('parts/generic/scripts'); ?>
<script type="text/javascript" src="<?= URL::to("assets/js/modules/principal/coordinador.js") ?>"></script>