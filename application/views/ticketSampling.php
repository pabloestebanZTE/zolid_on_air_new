<!DOCTYPE html>
<html lang="en">
    <?php $this->load->view('parts/generic/head'); ?>
    <body data-base="<?= URL::base() ?>">
        <?php $this->load->view('parts/generic/header'); ?>
        <div class="container autoheight p-t-20 m-t-20">
            <div class="alert alert-success alert-dismissable hidden" id="principalAlert">
                <a href="#" class="close">&times;</a>
                <p id="text" class="m-b-0 p-b-0"></p>
            </div>
            <label id="lblProgressInformation" class="hidden">0 de 0</label>
            <div class="progress hidden" id="progressProcessImportData">
                <div class="progress-bar progress-bar-striped active" role="progressbar"
                     aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:0%">
                    0%
                </div>
            </div>
            <form class= 'well form-horizontal' action='' method='post' enctype= 'multipart/form-data'>
                <fieldset>
                    <div class="row">
                        <div class="col col-md-12 p-b-20" style="text-align: right;">
                            <a class="btn btn-primary" href="<?= URL::to('User/SeeStats') ?>"><i class="glyphicon glyphicon-stats" aria-hidden="true"></i>&nbsp;&nbsp;Ver Estadísticas</a>
                        </div>
                        <div class="col col-md-12 p-t-40">
                            <input type="hidden" value="<?= Auth::getRole() ?>" id="rol">
                            <table id="ticketSampling" class="table table-hover table-striped" width="100%"></table>
                            <br/>
                        </div>
                    </div>
                </fieldset>
            </form>

            <!-- Modal Cierre -->
            <div id="modalEditTicket" class="modal fade" role="dialog" >
                <div class="modal-dialog modal-lg2" style="width: 1000px;">
                    <form class="well form-horizontal" id="formModal" action="<?= URL::to('TicketOnair/insertQualityReport') ?>" method="post" novalidate="novalidate">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></button>
                            <h3 class="modal-title" id="myModalLabel"></h3>
                        </div>
                        <div class="modal-body">
                            <div>

                                    <fieldset>
                                        <div class="widget bg_white m-t-25 display-block">
                                            <fieldset class="col-md-6">
                                                <div class="form-group">
                                                    <label for="n_nombre_estacion_eb" class="col-md-3 control-label">Estación: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-fw fa-street-view"></i></span>
                                                            <input name="n_nombre_estacion_eb" id="n_nombre_estacion_eb" class="form-control" type="text" disabled="true">
                                                            <input name="k_id_onair" id="k_id_onair" class="form-control" type="hidden">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="n_tipo_trabajo" class="col-md-3 control-label">Tipo de Trabajo: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-fw fa-briefcase"></i></span>
                                                            <input name="n_tipo_trabajo" id="n_tipo_trabajo" class="form-control" type="text" disabled="true">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="n_estado_eb_resucomen" class="col-md-3 control-label">Estado: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-fw fa-thumbs-o-up"></i></span>
                                                            <input name="n_estado_eb_resucomen" id="n_estado_eb_resucomen" class="form-control" type="text" disabled="true">
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <!--  fin seccion izquierda form-->

                                            <!--  inicio seccion derecha form-->
                                            <fieldset>
                                                <div class="form-group">
                                                    <label for="n_tecnologia" class="col-md-3 control-label">Tecnología: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon" id="statusColor"><i class="fa fa-fw fa-tablet"></i></span>
                                                            <input name="n_tecnologia" id="n_tecnologia" class="form-control" type="text" disabled="true">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="n_banda" class="col-md-3 control-label">Banda: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-fw fa-signal"></i></span>
                                                            <input name="n_banda" id="n_banda" class="form-control" type="text" disabled="true">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="n_usuario_encargado" class="col-md-3 control-label">Encargado: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class="fa fa-fw fa-user"></i></span>
                                                            <input name="n_usuario_encargado" id="n_usuario_encargado" class="form-control" type="text" readonly >
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <!--  fin seccion derecha form---->
                                        </div>

                                        <div class="widget bg_white m-t-25 display-block" style="height: 200px;">
                                            <fieldset class="col-md-12 control-label">
                                                <div class="form-group">
                                                    <label for="n_hallazgo" class="col-md-3 control-label">Hallazgo: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='fa fa-fw fa-eye'></i></span>
                                                            <select name="n_hallazgo" id="n_hallazgo" class="form-control">
                                                                <option value="">Seleccione...</option>
                                                                <option value="Análisis erróneo">Análisis erróneo</option>
                                                                <option value="Error en documentación">Error en documentación</option>
                                                                <option value="Error en proceso">Error en proceso</option>
                                                                <option value="Pendientes en documentación">Pendientes en documentación</option>
                                                                <option value="Proceso OK">Proceso OK</option>
                                                                <option value="Retraso en tiempos">Retraso en tiempos</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="n_observaciones" class="col-md-3 control-label">Observaciones: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <textarea name="n_observaciones" id="n_observaciones" class="form-control" rows="4" cols="100"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <fieldset>
                                                <div class="form-group m-t-40 p-b-40"></div>
                                            </fieldset>
                                        </div>
                                    </fieldset>
                                    <!-- Tercera seccion -->

                                    <fieldset>
                                        <div class="widget bg_white m-t-25 display-block">
                                            <fieldset class="col-md-6">
                                                <div class="form-group">
                                                    <label for="n_checklist" class="col-md-3 control-label">CheckList: &nbsp;</label>

                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='fa fa-fw fa-eye'></i></span>
                                                            <select name="n_checklist" id="n_checklist" class="form-control">
                                                                    <option value="">Seleccione...</option>
                                                                    <option value="Actualizado NOK">Actualizado NOK</option>
                                                                    <option value="Actualizado OK">Actualizado OK </option>
                                                                    <option value="Desactualizado NOK">Desactualizado NOK</option>
                                                                    <option value="Desactualizado OK ">Desactualizado OK</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="n_precheck" class="col-md-3 control-label">Precheck: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='fa fa-fw fa-eye'></i></span>
                                                            <select name="n_precheck" id="n_precheck" class="form-control">
                                                                    <option value="">Seleccione...</option>
                                                                    <option value="Ok"> Ok</option>
                                                                    <option value="No">No </option>
                                                                    <option value="N/A">N/A</option>

                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="n_kpis" class="col-md-3 control-label">KPI'S: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='fa fa-fw fa-eye'></i></span>
                                                            <select name="n_kpis" id="n_kpis" class="form-control">
                                                                    <option value="">Seleccione...</option>
                                                                    <option value="Ok"> Ok</option>
                                                                    <option value="No">No </option>
                                                                    <option value="N/A">N/A</option>

                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="n_alarma" class="col-md-3 control-label">Alarma: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='fa fa-fw fa-eye'></i></span>
                                                            <select name="n_alarma" id="n_alarma" class="form-control">
                                                                    <option value="">Seleccione...</option>
                                                                    <option value="Ok"> Ok</option>
                                                                    <option value="No">No </option>
                                                                    <option value="N/A">N/A</option>

                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="form-group">
                                                    <label for="n_evidencia_sectores_dbl" class="col-md-3 control-label">Evidencia sectores DBL: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='fa fa-fw fa-eye'></i></span>
                                                            <select name="n_evidencia_sectores_dbl" id="n_evidencia_sectores_dbl" class="form-control">
                                                                    <option value="">Seleccione...</option>
                                                                    <option value="Ok"> Ok</option>
                                                                    <option value="No">No </option>
                                                                    <option value="N/A">N/A</option>

                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="form-group">
                                                    <label for="n_vista_mm" class="col-md-3 control-label">Vista MM: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='fa fa-fw fa-eye'></i></span>
                                                            <select name="n_vista_mm" id="n_vista_mm" class="form-control">
                                                                    <option value="">Seleccione...</option>
                                                                    <option value="Ok"> Ok</option>
                                                                    <option value="No">No </option>
                                                                    <option value="N/A">N/A</option>

                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="n_alarmas_activas" class="col-md-3 control-label">Alarmas activas: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='fa fa-fw fa-eye'></i></span>
                                                            <select name="n_alarmas_activas" id="n_alarmas_activas" class="form-control">
                                                                    <option value="">Seleccione...</option>
                                                                    <option value="Ok"> Ok</option>
                                                                    <option value="No">No </option>
                                                                    <option value="N/A">N/A</option>

                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="n_rx_signal_level" class="col-md-3 control-label">Rx signal level-Antenna line: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='fa fa-fw fa-eye'></i></span>
                                                            <select name="n_rx_signal_level" id="n_rx_signal_level" class="form-control">
                                                                    <option value="">Seleccione...</option>
                                                                    <option value="Ok"> Ok</option>
                                                                    <option value="No">No </option>
                                                                    <option value="N/A">N/A</option>

                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="n_coordenadas" class="col-md-3 control-label">Coordenadas: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='fa fa-fw fa-eye'></i></span>
                                                            <select name="n_coordenadas" id="n_coordenadas" class="form-control">
                                                                    <option value="">Seleccione...</option>
                                                                    <option value="Ok"> Ok</option>
                                                                    <option value="No">No </option>
                                                                    <option value="N/A">N/A</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                            </fieldset>

                                            <!--  fin seccion izquierda form-->

                                            <!--  inicio seccion derecha form-->
                                            <fieldset>
                                                <div class="form-group">
                                                    <label for="n_matriz_de_alarmas" class="col-md-3 control-label">Matriz de alarma: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='fa fa-fw fa-eye'></i></span>
                                                            <select name="n_matriz_de_alarmas" id="n_matriz_de_alarmas" class="form-control">
                                                                    <option value="">Seleccione...</option>
                                                                    <option value="Ok"> Ok</option>
                                                                    <option value="No">No </option>
                                                                    <option value="N/A">N/A</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="n_log_prueba_de_alarma" class="col-md-3 control-label">Log prueba de alarmas ext: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='fa fa-fw fa-eye'></i></span>
                                                            <select name="n_log_prueba_de_alarma" id="n_log_prueba_de_alarma" class="form-control">
                                                                    <option value="">Seleccione...</option>
                                                                    <option value="Ok"> Ok</option>
                                                                    <option value="No">No </option>
                                                                    <option value="N/A">N/A</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="n_alarmas_ext" class="col-md-3 control-label">Alarmas ext pre-post: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='fa fa-fw fa-eye'></i></span>
                                                            <select name="n_alarmas_ext" id="n_alarmas_ext" class="form-control">
                                                                    <option value="">Seleccione...</option>
                                                                    <option value="Ok"> Ok</option>
                                                                    <option value="No">No </option>
                                                                    <option value="N/A">N/A</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="n_power zte" class="col-md-3 control-label">Power ZTE: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='fa fa-fw fa-eye'></i></span>
                                                            <select name="n_power zte" id="n_power zte" class="form-control">
                                                                    <option value="">Seleccione...</option>
                                                                    <option value="Ok"> Ok</option>
                                                                    <option value="No">No </option>
                                                                    <option value="N/A">N/A</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="n_maximo" class="col-md-3 control-label">Maximo: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='fa fa-fw fa-eye'></i></span>
                                                            <select name="n_maximo" id="n_maximo" class="form-control">
                                                                    <option value="">Seleccione...</option>
                                                                    <option value="Ok"> Ok</option>
                                                                    <option value="No">No </option>
                                                                    <option value="N/A">N/A</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="n_rf" class="col-md-3 control-label">RF: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='fa fa-fw fa-eye'></i></span>
                                                            <select name="n_rf" id="n_rf" class="form-control">
                                                                    <option value="">Seleccione...</option>
                                                                    <option value="Ok"> Ok</option>
                                                                    <option value="No">No </option>
                                                                    <option value="N/A">N/A</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="n_calidad_gestion_sectores" class="col-md-3 control-label">Calidad gestion sectores: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='fa fa-fw fa-eye'></i></span>
                                                            <select name="n_calidad_gestion_sectores" id="n_calidad_gestion_sectores" class="form-control">
                                                                    <option value="">Seleccione...</option>
                                                                    <option value="Ok"> Ok</option>
                                                                    <option value="No">No </option>
                                                                    <option value="N/A">N/A</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="n_tarea_remedy" class="col-md-3 control-label">Tareas remedy/maximo: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='fa fa-fw fa-eye'></i></span>
                                                            <select name="n_tarea_remedy" id="n_tarea_remedy" class="form-control">
                                                                    <option value="">Seleccione...</option>
                                                                    <option value="Ok"> Ok</option>
                                                                    <option value="No">No </option>
                                                                    <option value="N/A">N/A</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="n_calidad_gestion" class="col-md-3 control-label">Calidad gestion: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <span class="input-group-addon"><i class='fa fa-fw fa-eye'></i></span>
                                                            <select name="n_calidad_gestion" id="n_calidad_gestion" class="form-control">
                                                                    <option value="">Seleccione...</option>
                                                                    <option value="Ok"> Ok</option>
                                                                    <option value="No">No </option>
                                                                    <option value="N/A">N/A</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="n_observaciones_final" class="col-md-3 control-label">Observaciones: &nbsp;</label>
                                                    <div class="col-md-8 selectContainer">
                                                        <div class="input-group">
                                                            <textarea name="n_observaciones_final" id="n_observaciones_final" class="form-control" rows="4" cols="100"></textarea>
                                                        </div>
                                                    </div>
                                                </div>


                                            </fieldset>
                                            <!--  fin seccion derecha form---->
                                        </div>
                                    </fieldset>

<<<<<<< HEAD
                                </form>
=======
>>>>>>> d079e1c7b1309e5222f262eb4c5fa5cfdb906a71
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" id="mbtnCerrarModal" data-dismiss="modal"><i class='glyphicon glyphicon-remove'></i>&nbsp;Cancelar</button>
                            <button type="submit" class="btn btn-info"><i class='glyphicon glyphicon-save'></i>&nbsp;Guardar</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>



        <?php
            if (!isset($msj)) {
                $msj = "";
            }


         ?>


        <!--footer Section -->
        <div class="for-full-back" id="footer">
            Zolid By ZTE Colombia | All Right Reserved
        </div>
        <?php $this->load->view('parts/generic/scripts'); ?>
        <!-- CUSTOM SCRIPT   -->
        <script scr="<?= URL::to("assets/plugins/sweetalert-master/dist/sweetalert.min.js") ?>" ></script>
        <script type="text/javascript" src="<?= URL::to("assets/js/modules/ticketSampling.js") ?>"></script>
        <script type="text/javascript">
            var message = "<?php echo $msj; ?>";
                if (message == 'ok') {
                    swal("Bien!", "Se Guardo correctamente!", "success");
                } else if(message == 'error'){
                    swal("Ups!", "Hay un error en la insercion!", "error");

                }



        </script>
    </body>
</html>
