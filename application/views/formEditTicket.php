<!DOCTYPE html>
<html lang="en">
    <?php $this->load->view('parts/generic/head'); ?>
    <link rel="stylesheet" href="<?= URL::to('assets/css/styleModalCami.css') ?>"/>
    <!--   SWEET ALERT    -->
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.0.3/sweetalert2.min.css" /> -->
    <style type="text/css">
        .nav li a {
            background-color:#207be5;
            text-decoration:'Open Sans', sans-serif;
            padding:20px 12px;
            display:block;
            color: #FFF;
        }
    </style>
    <!-- Push.js   -->
    <script type="text/javascript" src="<?= URL::base()?>/assets/plugins/push.min.js"></script>

    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.0.3/sweetalert2.all.min.js"></script> -->
    <!--   SCRIPT PROPIOS   -->
    <script type="text/javascript" charset="utf-8" async defer>
        //Funcion para mostrar mensaje de error de validacion de datos
        function showMessage() {
            swal({
                title: "Error de autentificación!",
                text: "Por favor verificar los datos",
                type: "error",
                confirmButtonText: "Ok"
            });
        }
    </script>
    <body data-base="<?= URL::base() ?>">
        <?php $this->load->view('parts/generic/header'); ?>
        <div class="container p-t-35 autoheight">
            <div class="panel-body">

            <ul class="nav nav-tabs navCami">
              <li class="li_nav_ticket active"><a data-toggle="tab" href="#nav_ticket">Editar Ticket &nbsp;<i class="fa fa-fw fa-ticket"></i></a></li>
              <li class="li_comentarios"><a data-toggle="tab" href="#comentarios">Editar comentario &nbsp;<i class="fa fa-fw fa-comments"></i></a></li>
            </ul>




                <div class="tab-content">

                    <div id="nav_ticket" class="tab-pane fade in active">

                        <div id="crear_actividad" class="tab-pane fade in active">
                            <form class="well form-horizontal" action="<?= URL::to('TicketOnair/editarTicket') ?>" method="post"  id="formEditTicket" name="formEditTicket">
                                <div class="alert alert-success alert-dismissable hidden">
                                    <a href="#" class="close" >&times;</a>
                                    <p class="p-b-0" id="text"></p>
                                </div>
                                <legend >Crear Actividad</legend>
                                <fieldset class="col-md-6 control-label">
                                    <input type="hidden" name="k_id_onair" id="k_id_onair" value="">
                                    <!-- Input Text -->
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Estacion:</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-street-view"></i></span>
                                                <select name="k_id_station" id="estacion" class="form-control selectpicker select-estacion" onchange="editTextCityRegional()">
                                                    <option value="" >Seleccione la estación</option>
                                                </select>
                                                <div class="input-group-btn">
                                                    <button type="button" id="copyToClipBoard" class="btn btn-primary" title="Copiar al portapapeles"><i class="fa fa-fw fa-copy"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Select Basic -->
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Ciudad:</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-location-arrow"></i></span>
                                                <input type='text' name="ciudad" id="ciudad" class="form-control"  disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Select Basic -->
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Regional:</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-globe"></i></span>
                                                <input type='text' name="regional" id="regional" class="form-control"  disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Ente Ejecutor:</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-address-book"></i></span>
                                                <select name="n_enteejecutor" id="n_enteejecutor" class="form-control selectpicker">
                                                    <option value="" >Seleccione el ente ejecutor</option><option value="Claro" >Claro</option><option value="Nokia" >Nokia</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Fecha Ingreso On-Air:</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-calendar-o "></i></span>
                                                <input type='datetime-local' name="d_ingreso_on_air" id="d_ingreso_on_air" class="form-control"  data-callback="dom.formatDateForPrint">
                                                <div class="input-group-btn">
                                                    <button type="button" id="btnTodayDate" class="btn btn-primary" title="Fecha Actual"><i class="fa fa-fw fa-calendar-check-o"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-8 selectContainer">
                                            <div class="radio radio-primary" style="text-align: left; margin-left: 140px;">
                                                <input id="CRQ" type="radio" name="crq_chg" value="CRQ" onclick="changeCrqChg('CRQ')" checked>
                                                <label for="CRQ" class="text-bold">
                                                    CRQ
                                                </label><br/>
                                                <input id="CHG" type="radio" name="crq_chg" value="CHG" onclick="changeCrqChg('CHG')">
                                                <label for="CHG" class="text-bold">
                                                    CHG
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">&nbsp;</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-id-card"></i></span>
                                                <input type='text' name="n_crq" id="n_crq" class="form-control"  onfocusout="validateCrqChg()">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">WP:</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-id-card"></i></span>
                                                <input type='text' name="n_wp" id="n_wp" class="form-control"  >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">bcf_wbts_id:</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-id-card"></i></span>
                                                <input type='text' name="n_bcf_wbts_id" id="n_bcf_wbts_id" class="form-control"  >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">bts_id:</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-id-card"></i></span>
                                                <input type='text' name="n_bts_id" id="n_bts_id" class="form-control"  >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Fecha ingreso On Air:</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-id-card"></i></span>
                                                <input type='datetime-local' name="d_ingreso_on_air" id="d_ingreso_on_air" class="form-control"  data-callback="dom.formatDateForPrint">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Fecha ultima revisión:</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-id-card"></i></span>
                                                <input type='datetime-local' name="d_fecha_ultima_rev" id="d_fecha_ultima_rev" class="form-control"  data-callback="dom.formatDateForPrint">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Vista mm:</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-briefcase"></i></span>
                                                <select name="b_vistamm" id="b_vistamm" class="form-control selectpicker">
                                                    <option value="" >Seleccione</option>
                                                    <option value="TRUE">TRUE</option>
                                                    <option value=">FALSE">FALSE</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Controlador:</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-briefcase"></i></span>
                                                <input type='text' name="n_controlador" id="n_controlador" class="form-control"  >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Id controlador:</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-briefcase"></i></span>
                                                <input type='text' name="n_idcontrolador" id="n_idcontrolador" class="form-control"  >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Desbloqueo:</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-briefcase"></i></span>
                                                <input type='datetime-local' name="d_desbloqueo" id="d_desbloqueo" class="form-control"  data-callback="dom.formatDateForPrint">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Bloqueado:</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-briefcase"></i></span>
                                                <input type='datetime-local' name="d_desbloqueo" id="d_desbloqueo" class="form-control"  data-callback="dom.formatDateForPrint">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Reviewedfo:</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-briefcase"></i></span>
                                                <input type='text' name="n_reviewedfo" id="n_reviewedfo" class="form-control"  >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Corrección pendientes:</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-briefcase"></i></span>
                                                <input type='datetime-local' name="d_correccionespendientes" id="d_correccionespendientes" class="form-control"  data-callback="dom.formatDateForPrint">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Btsipaddress:</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-briefcase"></i></span>
                                                <input type='text' name="n_btsipaddress" id="n_btsipaddress" class="form-control"  >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Integrador:</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-briefcase"></i></span>
                                                <input type='text' name="n_integrador" id="n_integrador" class="form-control"  >
                                            </div>
                                        </div>
                                    </div>



                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Test gestion:</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-fw fa-wrench"></i>
                                                </div>
                                                <select class="form-control selectpicker" name="n_testgestion" id="n_testgestion">
                                                    <option value="">Seleccione</option>
                                                    <option value="ABIERTO">ABIERTO</option>
                                                    <option value="CERRADO">CERRADO</option>
                                                    <option value="NA">NA</option>
                                                    <option value="SI">SI</option>
                                                    <option value="NO">NO</option>
                                                </select>
                                            </div>                             
                                        </div>
                                    </div>
                                    <div class="form-group sitio-limpio">
                                        <label class="col-md-3 control-label">Sitio limpio:</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-fw fa-wrench"></i>
                                                </div>
                                                <select class="form-control" name="n_sitiolimpio" id="n_sitiolimpio">
                                                    <option value="ABIERTO">ABIERTO</option>
                                                    <option value="CERRADO">CERRADO</option>
                                                    <option value="N/A">N/A</option>
                                                    <option value="NA">NA</option>
                                                    <option value="SI">SI</option>
                                                </select>
                                            </div>                             
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Fecha produccion:</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-calendar-o"></i></span>
                                                <input type='datetime-local' name="d_fechaproduccion" id="d_fechaproduccion" class="form-control" data-callback="dom.formatDateForPrint" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Instalacion HW Sitio:</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-briefcase"></i></span>
                                                <input type='text' name="n_instalacion_hw_sitio" id="n_instalacion_hw_sitio" class="form-control"  >
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Cambios config Solicitados:</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-briefcase"></i></span>
                                                <input type='text' name="n_cambios_config_solicitados" id="n_cambios_config_solicitados" class="form-control"  >
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Cambios Config Final:</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-briefcase"></i></span>
                                                <input type='text' name="n_cambios_config_final" id="n_cambios_config_final" class="form-control"  >
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Estado On air:</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-briefcase"></i></span>
                                                <input type='text' name="n_estadoonair" id="n_estadoonair" class="form-control"  >
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Atribuible nokia:</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-briefcase"></i></span>
                                                <!--<input type='text'  class="form-control"  >-->
                                                <select class="form-control" name="n_atribuible_nokia" id="n_atribuible_nokia">
                                                    <option value="">Seleccione</option>
                                                    <option value="SI">SI</option>
                                                    <option value="NO">NO</option>
                                                    <option value="NA">NA</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Contratista:</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-briefcase"></i></span>
                                                <input type='text' name="n_contratista" id="n_contratista" class="form-control"  >
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">comentario opccional:</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-briefcase"></i></span>
                                                <input type='textarea' name="n_comentarioccial" id="n_comentarioccial" class="form-control"  >
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Ticket remedy:</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-briefcase"></i></span>
                                                <input type='text' name="n_ticketremedy" id="n_ticketremedy" class="form-control"  >
                                            </div>
                                        </div>
                                    </div> 

                                    <div class="form-group">
                                        <label class="col-md-3 control-label">LAC:</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-briefcase"></i></span>
                                                <input type='text' name="n_lac" id="n_lac" class="form-control"  >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">RAC:</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-briefcase"></i></span>
                                                <input type='text' name="n_rac" id="n_rac" class="form-control"  >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">SAC:</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-briefcase"></i></span>
                                                <input type='text' name="n_sac" id="n_sac" class="form-control"  >
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Integracion gestion y trafica:</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-briefcase"></i></span>
                                                <!--<input type='text' name="n_integracion_gestion_y_trafica" id="n_integracion_gestion_y_trafica" class="form-control"  >-->
                                                <select name="n_integracion_gestion_y_trafica" id="n_integracion_gestion_y_trafica" class="form-control selectpicker">
                                                    <option value="">Seleccione</option>
                                                    <option value="ABIERTO">ABIERTO</option>
                                                    <option value="CERRADO">CERRADO</option>
                                                    <option value="NA">NA</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Puesta de Servicio Sitio Nuevo LTE:</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-briefcase"></i></span>
                                                <!--<input type='text' name="puesta_servicio_sitio_nuevo_lte" id="puesta_servicio_sitio_nuevo_lte" class="form-control"  >-->
                                                <select name="puesta_servicio_sitio_nuevo_lte" id="puesta_servicio_sitio_nuevo_lte" class="form-control selectpicker">
                                                    <option value="">Seleccione</option>
                                                    <option value="ABIERTO">ABIERTO</option>
                                                    <option value="CERRADO">CERRADO</option>
                                                    <option value="NA">NA</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>  
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Instalacion HW 4G Sitio:</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-briefcase"></i></span>
                                                <!--<input type='text' name="n_instalacion_hw_4g_sitio" id="n_instalacion_hw_4g_sitio" class="form-control"  >-->
                                                <select name="n_instalacion_hw_4g_sitio" id="n_instalacion_hw_4g_sitio" class="form-control selectpicker">
                                                    <option value="">Seleccione</option>
                                                    <option value="ABIERTO">ABIERTO</option>
                                                    <option value="CERRADO">CERRADO</option>
                                                    <option value="NA">NA</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group pre-launch">
                                        <label class="col-md-3 control-label">Pre-launch:</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-fw fa-wrench"></i>
                                                </div>
                                                <select class="form-control" name="pre_launch" id="pre_launch">
                                                    <option value="ABIERTO">ABIERTO</option>
                                                    <option value="CERRADO">CERRADO</option>
                                                    <option value="NA">NA</option>
                                                </select>
                                            </div>                             
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Actualizacion final:</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-calendar-o"></i></span>
                                                <input type='datetime-local' name="d_actualizacion_final" id="d_actualizacion_final" class="form-control" data-callback="dom.formatDateForPrint" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Asignacion Final:</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-calendar-o"></i></span>
                                                <input type='datetime-local' name="d_asignacion_final" id="d_asignacion_final" class="form-control" data-callback="dom.formatDateForPrint" >
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Evidencia SL:</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-briefcase"></i></span>
                                                <input type='text' name="n_evidenciasl" id="n_evidenciasl" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Evidencia TG:</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-briefcase"></i></span>
                                                <input type='text' name="n_evidenciatg" id="n_evidenciatg" class="form-control"  >
                                            </div>
                                        </div>
                                    </div>
      
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">T from notif:</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-briefcase"></i></span>
                                                <input type='datetime-local' name="d_t_from_notif" id="d_t_from_notif" class="form-control" data-callback="dom.formatDateForPrint">
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                                <!--  fin seccion izquierda form---->

                                <!--  inicio seccion derecha form---->
                                <fieldset class="col-md-6">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Tipo de trabajo:</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-briefcase"></i></span>
                                                <select name="k_id_work" id="tipotrabajo" class="form-control selectpicker select-tipotrabajo" onchange="validateSln()">
                                                    <option value="" >Seleccione el tipo de trabajo</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Select Basic -->
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Tecnologia:</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-tablet"></i></span>
                                                <select name="k_id_technology" id="tecnologia" class="form-control selectpicker select-tecnologia helper-change">
                                                    <option value="" >Seleccione la tecnologia</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Select Basic -->
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Banda:</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-signal"></i></span>
                                                <select name="k_id_band" id="banda" class="form-control selectpicker select-banda">
                                                    <option value="" >Seleccione la banda</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Select Basic -->
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Estado:</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-thumbs-o-up"></i></span>
                                                <select name="k_id_status" id="status" class="form-control selectpicker" onchange="editSubstatus()">
                                                    <option value="" >Seleccione el Estado</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Subestado:</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-thumbs-o-up"></i></span>
                                                <select name="k_id_status_onair" id="substatus" class="form-control selectpicker">
                                                    <option value="">Seleccione el Subestado</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Observaciones de Creación</label>
                                        <div class="col-md-8 inputGroupContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
                                                <textarea class="form-control" name="n_comentario_doc" id="n_comentario_doc" placeholder="Observaciones de Creación"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">GRI</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-thumbs-o-up"></i></span>
                                                <select name="b_excpetion_gri" id="b_excpetion_gri" class="form-control selectpicker">
                                                    <option value="">Seleccione la aprobación</option>
                                                    <option value="FALSO">FALSO</option>
                                                    <option value="OK - CONTROL CAMBIOS">OK - CONTROL CAMBIOS</option>
                                                    <option value="OK GRI">OK GRI</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group" id="cmbModernizacion" style="display: none;">
                                        <label class="col-md-3 control-label">SLN Modernizacion:</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-id-card"></i></span>
                                                <select name="n_sln_modernizacion" id="n_sln_modernizacion" class="form-control selectpicker">
                                                    <option value="">Seleccione la SLN Modernizacion</option>
                                                    <option value="mod dedicada">mod dedicada</option>
                                                    <option value="mod concurrente">mod concurrente</option>
                                                    <option value="rf sharing">rf sharing</option>
                                                    <option value="rx diversity">rx diversity</option>
                                                    <option value="N/A">N/A</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Persona Solicita notificación:</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-id-card"></i></span>
                                                <input type='text' name="n_persona_solicita_notificacion" id="n_persona_solicita_notificacion" class="form-control"  >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label">T from asign:</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-briefcase"></i></span>
                                                <input type='datetime-local' name="d_t_from_asign" id="d_t_from_asign" class="form-control" data-callback="dom.formatDateForPrint" >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Kpis Degraded:</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-briefcase"></i></span>
                                                <input type='text' name="n_kpis_degraded" id="n_kpis_degraded" class="form-control"  >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Id Notificacion:</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-briefcase"></i></span>
                                                <input type='text' name="id_notificacion" id="id_notificacion" class="form-control"  >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Id Documentacion:</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-briefcase"></i></span>
                                                <input type='text' name="id_documentacion" id="id_documentacion" class="form-control"  >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">ID RFTools:</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-briefcase"></i></span>
                                                <input type='text' name="id_rftools" id="id_rftools" class="form-control"  >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label">KPI1:</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-briefcase"></i></span>
                                                <input type='text' name="n_kpi1" id="n_kpi1" class="form-control"  >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Valor KPI1:</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-briefcase"></i></span>
                                                <input type='text' name="i_valor_kpi1" id="i_valor_kpi1" class="form-control"  >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">KPI2:</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-briefcase"></i></span>
                                                <input type='text' name="n_kpi2" id="n_kpi2" class="form-control"  >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Valor KPI2:</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-briefcase"></i></span>
                                                <input type='text' name="i_valor_kpi2" id="i_valor_kpi2" class="form-control"  >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">KPI3:</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-briefcase"></i></span>
                                                <input type='text' name="n_kpi3" id="n_kpi3" class="form-control"  >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Valor KPI3:</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-briefcase"></i></span>
                                                <input type='text' name="i_valor_kpi3" id="i_valor_kpi3" class="form-control"  >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">KPI4:</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-briefcase"></i></span>
                                                <input type='text' name="n_kpi4" id="n_kpi4" class="form-control"  >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Valor_KPI4:</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-briefcase"></i></span>
                                                <input type='text' name="i_valor_kpi4" id="i_valor_kpi4" class="form-control"  >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Alarma 1:</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-briefcase"></i></span>
                                                <input type='text' name="n_alarma1" id="n_alarma1" class="form-control"  >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Alarma 2:</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-briefcase"></i></span>
                                                <input type='text' name="n_alarma2" id="n_alarma2" class="form-control"  >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Alarma 3:</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-briefcase"></i></span>
                                                <input type='text' name="n_alarma3" id="n_alarma3" class="form-control"  >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Alarma 4:</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-briefcase"></i></span>
                                                <input type='text' name="n_alarma4" id="n_alarma4" class="form-control"  >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label">OLA:</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-briefcase"></i></span>
                                                <input type='text' name="n_ola" id="n_ola" class="form-control"  >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">OLA excedido:</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-briefcase"></i></span>
                                                <input type='text' name="n_ola_excedido" id="n_ola_excedido" class="form-control"  >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Lider cambio:</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-briefcase"></i></span>
                                                <input type='text' name="i_lider_cambio" id="i_lider_cambio" class="form-control"  >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Lider cuadrilla:</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-briefcase"></i></span>
                                                <input type='text' name="i_lider_cuadrilla" id="i_lider_cuadrilla" class="form-control"  >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">OLA areas:</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-briefcase"></i></span>
                                                <input type='text' name="n_ola_areas" id="n_ola_areas" class="form-control"  >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">OLA areas excedido:</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-briefcase"></i></span>
                                                <input type='text' name="n_ola_areas_excedido" id="n_ola_areas_excedido" class="form-control"  >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group Implementacion-campo">
                                        <label class="col-md-3 control-label">Implementacion campo:</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-fw fa-wrench"></i>
                                                </div>
                                                <select class="form-control" name="n_implementacion_campo" id="n_implementacion_campo">
                                                    <option value="ABIERTO">ABIERTO</option>
                                                    <option value="CERRADO">CERRADO</option>
                                                    <option value="NA">NA</option>
                                                </select>
                                            </div>                             
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Implementacion remota</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-briefcase"></i></span>
                                                <!--<input type='text' name="n_implementacion_remota" id="n_implementacion_remota" class="form-control"  >-->
                                                <select name="n_implementacion_remota" id="n_implementacion_remota" class="form-control selectpicker">
                                                    <option value="">Seleccione</option>
                                                    <option value="ABIERTO">ABIERTO</option>
                                                    <option value="CERRADO">CERRADO</option>
                                                    <option value="NA">NA</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>  
                                    <div class="form-group gestion-power">
                                        <label class="col-md-3 control-label">Gestion power:</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-fw fa-wrench"></i>
                                                </div>
                                                <select class="form-control" name="n_gestion_power" id="n_gestion_power">
                                                    <option value="ABIERTO">ABIERTO</option>
                                                    <option value="CERRADO">CERRADO</option>
                                                    <option value="NA">NA</option>
                                                </select>
                                            </div>                             
                                        </div>
                                    </div>
                                    <div class="form-group obra-social">
                                        <label class="col-md-3 control-label">Obra civil:</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-fw fa-wrench"></i>
                                                </div>
                                                <select class="form-control" name="n_obra_civil" id="n_obra_civil">
                                                    <option value="ABIERTO">ABIERTO</option>
                                                    <option value="CERRADO">CERRADO</option>
                                                    <option value="NA">NA</option>
                                                </select>
                                            </div>                             
                                        </div>
                                    </div>
                                    <div class="form-group on-air">
                                        <label class="col-md-3 control-label">On Air:</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-fw fa-wrench"></i>
                                                </div>
                                                <select class="form-control" name="on_air" id="on_air">
                                                    <option value="ABIERTO">ABIERTO</option>
                                                    <option value="CERRADO">CERRADO</option>
                                                    <option value="NA">NA</option>
                                                </select>
                                            </div>                             
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Fecha RFT:</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-calendar-o"></i></span>
                                                <input type='datetime-local' name="fecha_rft" id="fecha_rft" class="form-control" data-callback="dom.formatDateForPrint" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Fecha CG:</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-calendar-o"></i></span>
                                                <input type='datetime-local' name="d_fecha_cg" id="d_fecha_cg" class="form-control" data-callback="dom.formatDateForPrint" >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Exclusion bajo trafico:</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-briefcase"></i></span>
                                                <input type='text' name="n_exclusion_bajo_trafico" id="n_exclusion_bajo_trafico" class="form-control"  >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Ticket:</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-briefcase"></i></span>
                                                <input type='text' name="n_ticket" id="n_ticket" class="form-control"  >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Estado ticket:</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-briefcase"></i></span>
                                                <input type='text' name="n_estado_ticket" id="n_estado_ticket" class="form-control"  >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">SLN Modernizacion:</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-briefcase"></i></span>
                                                <input type='text' name="n_sln_modernizacion" id="n_sln_modernizacion" class="form-control"  >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group en-prorroga">
                                        <label class="col-md-3 control-label">En Prorroga:</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-fw fa-wrench"></i>
                                                </div>
                                                <select class="form-control" name="n_en_prorroga" id="n_en_prorroga">
                                                    <option value="FALSO">FALSO</option>
                                                    <option value="VERDADERO">VERDADERO</option>
                                                </select>
                                            </div>                             
                                        </div>
                                    </div>


                                    <div class="form-group NOC">
                                        <label class="col-md-3 control-label">NOC:</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-fw fa-wrench"></i>
                                                </div>
                                                <select class="form-control" name="n_noc" id="n_noc">
                                                    <option value="NOKIA-ZTE">NOKIA-ZTE</option>
                                                    <option value="ZTE">ZTE</option>

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
                                            <button type="submit" class="btn btn-primary" onclick = "">Guardar <span class="fa fa-fw fa-floppy-o"></span></button>
                                        </div>
                                    </div>
                                </center>
                            </form>
                        </div>

                    </div>  

    
                    <!-- INICIO SEGUNDA PESTAÑA -->
                    <div id="comentarios" class="tab-pane fade">

                        <h3 class="dis-in-line-blk">Editar Comentarios </h3>
                        <button id="newComment" class="btn btn-primary" style="margin-left: 20%;"><i class="fa fa-fw fa-plus"></i>Nuevo Comentario</button>

                        <table class="table table-hover table-bordered" id="table_comments">
                            <thead>
                                <th>Estación</th>
                                <th>Tecn.</th>
                                <th>Banda</th>
                                <th>Tipo</th>
                                <th>Estado</th>
                                <th>Comentario</th>
                                <th>Actulización</th>
                                <th>Usuario</th>
                                <th>Ejecutor</th>
                                <th>Tipificación</th>
                                <th>Noc</th>
                            </thead>
                            <?php for ($i=0; $i < count($comentarios) ; $i++) { ?>
                            
                            <tr id="<?= $comentarios[$i]->k_id_primary?>">
                                <?= "<td>".$comentarios[$i]->n_nombre_estacion_eb."</td>"; ?>
                                <?= "<td>".$comentarios[$i]->n_tecnologia."</td>"; ?>
                                <?= "<td>".$comentarios[$i]->n_banda."</td>"; ?>
                                <?= "<td>".$comentarios[$i]->n_tipo_trabajo."</td>"; ?>
                                <?= "<td>".$comentarios[$i]->n_estado_eb_resucomen."</td>"; ?>
                                <?= "<td>".$comentarios[$i]->comentario_resucoment."</td>"; ?>
                                <?= "<td>".$comentarios[$i]->hora_actualizacion_resucomen."</td>"; ?>
                                <?= "<td>".$comentarios[$i]->usuario_resucomen."</td>"; ?>
                                <?= "<td>".$comentarios[$i]->ente_ejecutor."</td>"; ?>
                                <?= "<td>".$comentarios[$i]->tipificacion_resucomen."</td>"; ?>
                                <?= "<td>".$comentarios[$i]->noc."</td>"; ?>
                            </tr>

                            <?php } ?>
                        </table>                     
    




                        
                    </div>


                    

            









                </div>
            </div>
        </div>
        <!--footer Section -->
        <div class="for-full-back" id="footer">
            Zolid By ZTE Colombia | All Right Reserved
        </div>
        <!-- CUSTOM SCRIPT   -->


        <div class="incorrect-type info-box error-msg" style="display: none;">
            Sorry, the file you selected is not MSG type
        </div>

        <div class="file-api-not-available info-box error-msg" style="display: none;">
            Sorry, your browser isn't supported
        </div>

        <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.2.1.min.js"></script>
        <script src="<?= URL::to("assets/js/utils/app.global.js?v=1.0") ?>" type="text/javascript"></script>
        <script src="<?= URL::to("assets/js/utils/app.dom.js?v=1.1") ?>" type="text/javascript"></script>
        <script src="<?= URL::to('assets/plugins/bootstrap/js/bootstrap.min.js') ?>" /></script>
    <link href="<?= URL::to("assets/plugins/select2/select2.css") ?>" rel="stylesheet" type="text/css"/>
    <script src="<?= URL::to("assets/plugins/select2/select2.js") ?>" type="text/javascript"></script>
    <script src="<?= URL::to("assets/plugins/FormatDate.js") ?>" type="text/javascript"></script>
    <script src="<?= URL::to('assets/plugins/jquery.mask.js') ?>" type="text/javascript"></script>
    <script src="<?= URL::to('assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js?v=1') ?>" type="text/javascript"></script>
    <script type="text/javascript" src="<?= URL::to('assets/js/DataStream.js') ?>"></script>
    <script type="text/javascript" src="<?= URL::to('assets/js/msg.reader.js') ?>"></script>
    <script type="text/javascript">
                                                $(function () {

                                                    $('.select-tecnologia').on('change', function () {
                                                        app.get('Utils/bandsByTech', {
                                                            id_technology: $('.select-tecnologia').val()
                                                        })
                                                                .success(function (response) {
                                                                    var data = app.parseResponse(response);
                                                                    if (data) {
                                                                        dom.llenarCombo($('.select-banda'), data, {text: "n_name_band", value: "k_id_band"});
                                                                    }
                                                                    dom.comboVacio($('.select-banda'));
                                                                })
                                                                .error(function () {
                                                                    dom.comboVacio($('.select-banda'));
                                                                }).send();
                                                    });

                                                    var info = <?php echo $respuesta; ?>;
                                                    // console.log(info);
//                                                                    for (var j = 0; j < info.bands.data.length; j++) {
//                                                                        $('.select-banda').append($('<option>', {
//                                                                            value: info.bands.data[j].k_id_band,
//                                                                            text: info.bands.data[j].n_name_band
//                                                                        }));
//                                                                    }
                                                    for (var j = 0; j < info.technologies.data.length; j++) {
                                                        $('.select-tecnologia').append($('<option>', {
                                                            value: info.technologies.data[j].k_id_technology,
                                                            text: info.technologies.data[j].n_name_technology
                                                        }));
                                                    }
                                                    for (var j = 0; j < info.works.data.length; j++) {
                                                        $('.select-tipotrabajo').append($('<option>', {
                                                            value: info.works.data[j].k_id_work,
                                                            text: info.works.data[j].n_name_ork
                                                        }));
                                                    }
                                                    for (var j = 0; j < info.stations.data.length; j++) {
                                                        $('.select-estacion').append($('<option>', {
                                                            value: info.stations.data[j].k_id_station,
                                                            text: info.stations.data[j].n_name_station
                                                        }));
                                                    }
                                                    for (var j = 0; j < info.status.data.length; j++) {
                                                        $('#status').append($('<option>', {
                                                            value: info.status.data[j].k_id_status,
                                                            text: info.status.data[j].n_name_status
                                                        }));
                                                    }
                                                    for (var j = 0; j < info.status.data.length; j++) {
                                                        $('#modalStatus').append($('<option>', {
                                                            value: info.status.data[j].k_id_status,
                                                            text: info.status.data[j].n_name_status
                                                        }));
                                                    }
                                                    for (var j = 0; j < info.regions.data.length; j++) {
                                                        $('#regional_field').append($('<option>', {
                                                            value: info.regions.data[j].k_id_regional,
                                                            text: info.regions.data[j].n_name_regional
                                                        }));
                                                    }
                                                    for (var j = 0; j < info.user.data.length; j++) {
                                                        $('.select-usuarios').append($('<option>', {
                                                            value: info.user.data[j].k_id_user,
                                                            text: info.user.data[j].n_name_user + ' ' + info.user.data[j].n_last_name_user
                                                        }));
                                                    }
                                                    $('select').select2({"width": "100%"});
                                                    //dom.configCalendar($('#d_ingreso_on_air'));
                                                    changeCrqChg('CRQ');
                                                    paintForm();

                                                });


                                                function paintForm() {
                                                    var ticketOnAir = <?php echo $respuesta; ?>;
                                                    var form = $('#formEditTicket');
                                                    form.fillForm(ticketOnAir.ticket.data);
                                                    form.fillForm(ticketOnAir.preparationStage.data);
                                                    form.fillForm(ticketOnAir.precheck.data);
                                                    bandsByTech();
                                                    $("#n_ingenieroprecheck").val(ticketOnAir.precheck.data.k_id_user).trigger('change.select2');
                                                    for (var j = 0; j < ticketOnAir.statusOnAir.data.length; j++) {
                                                        if (ticketOnAir.statusOnAir.data[j].k_id_status_onair == ticketOnAir.ticket.data.k_id_status_onair) {
                                                            $("#status").val(ticketOnAir.statusOnAir.data[j].k_id_status).trigger('change.select2');
                                                            $("#substatus").val(ticketOnAir.statusOnAir.data[j].k_id_status_onair).trigger('change.select2');
                                                        }
                                                    }
                                                }

                                                function bandsByTech() {
                                                    app.post('Utils/bandsByTech', {
                                                        id_technology: $('.select-tecnologia').val()
                                                    }).success(function (response) {
                                                        var data = app.parseResponse(response);
                                                        if (data) {
                                                            dom.llenarCombo($('.select-banda'), data, {text: "n_name_band", value: "k_id_band"});
                                                        }
                                                        dom.comboVacio($('.select-banda'));
                                                    }).error(function () {
                                                        dom.comboVacio($('.select-banda'));
                                                    }).send();
                                                }

                                                function changeCrqChg(cod) {
                                                    switch (cod) {
                                                        case "CRQ":
                                                            $('#n_crq').mask("CRQ999999999999", {placeholder: "CRQ000009999999"});
                                                            break;
                                                        case "CHG":
                                                            $('#n_crq').mask("CHG99999", {placeholder: "CHG99999"});
                                                            break;
                                                    }
                                                    // console.log(valRadio);
                                                }

                                                function validateSln() {
                                                    var valTipoTrabajo = $('#tipotrabajo option:selected').text();
                                                    if (valTipoTrabajo === 'Modernizacion Multiradio' || valTipoTrabajo === 'Modernización Multiradio') {
                                                        $("#n_sln_modernizacion").val('').trigger('change.select2');
                                                        $('#cmbModernizacion').css("display", "block");
                                                    } else {
                                                        $("#n_sln_modernizacion").val('N/A').trigger('change.select2');
                                                        $('#cmbModernizacion').css("display", "none");
                                                    }

                                                }

                                                function validateCrqChg() {
                                                    var valinput = $('#n_crq').val();
                                                    var valRadio = $('input:radio[name=crq_chg]:checked').val();
                                                    var info = <?php echo $respuesta; ?>;
                                                    for (var m = 0; m < info.crq.data.length; m++) {
                                                        if (valinput == info.crq.data[m].n_crq) {
                                                            swal("Código " + valRadio + " invalido", "Lo sentimos, el código " + valRadio + " ya existe.", "warning");
                                                        }
                                                    }
                                                }

                                                function editTextCityRegional() {
                                                    var estacion = $(".select-estacion").val();
                                                    var info = <?php echo $respuesta; ?>;
                                                    var city;
                                                    for (var j = 0; j < info.stations.data.length; j++) {
                                                        if (info.stations.data[j].k_id_station == estacion) {
                                                            for (var m = 0; m < info.cities.data.length; m++) {
                                                                if (info.stations.data[j].k_id_city == info.cities.data[m].k_id_city) {
                                                                    city = info.cities.data[m].k_id_regional;
                                                                    $('input[name=ciudad]').val(info.cities.data[m].n_name_city);
                                                                }
                                                            }
                                                            for (var x = 0; x < info.regions.data.length; x++) {
                                                                if (info.regions.data[x].k_id_regional == city) {
                                                                    $('input[name=regional]').val(info.regions.data[x].n_name_regional);
                                                                }
                                                            }
                                                        }
                                                    }
                                                }

                                                function fillCities() {
                                                    var regional = $("#regional_field").val();
                                                    var info = <?php echo $respuesta; ?>;
                                                    for (var j = 0; j < info.cities.data.length; j++) {
                                                        if (info.cities.data[j].k_id_regional == regional) {
                                                            $('#city_id').append($('<option>', {
                                                                value: info.cities.data[j].k_id_city,
                                                                text: info.cities.data[j].n_name_city
                                                            }));
                                                        }
                                                    }
                                                }

                                                function editSubstatus() {
                                                    var status = $("#status").val();
                                                    console.log(status);
                                                    var info = <?php echo $respuesta; ?>;
                                                    $('#substatus').empty();
                                                    for (var j = 0; j < info.statusOnAir.data.length; j++) {
                                                        if (status == info.statusOnAir.data[j].k_id_status) {
                                                            if (info.statusOnAir.data[j].k_id_status_onair != 78) {
                                                                $('#substatus').append($('<option>', {
                                                                    value: info.statusOnAir.data[j].k_id_status_onair,
                                                                    text: info.statusOnAir.data[j].n_name_substatus
                                                                }));
                                                            }
                                                        }
                                                        if (status == 9) {
                                                            $('#substatus').val(97);
                                                        }
                                                    }
                                                }

                                                function editModalSubstatus() {
                                                    var status = $("#modalStatus").val();
                                                    console.log(status);
                                                    var info = <?php echo $respuesta; ?>;
                                                    $('#modalSubstatus').empty();
                                                    for (var j = 0; j < info.statusOnAir.data.length; j++) {
                                                        if (status == info.statusOnAir.data[j].k_id_status) {
                                                            if (info.statusOnAir.data[j].k_id_status_onair != 78) {
                                                                $('#modalSubstatus').append($('<option>', {
                                                                    value: info.statusOnAir.data[j].k_id_status_onair,
                                                                    text: info.statusOnAir.data[j].n_name_substatus
                                                                }));
                                                            }
                                                        }
                                                        if (status == 9) {
                                                            $('#modalSubstatus').val(97);
                                                        }
                                                    }
                                                }
    </script>

    <script type="text/javascript" src="<?= URL::to('assets/js/modules/modals/commentsEdit.js') ?>"></script>
    <script src="<?= URL::to("assets/plugins/jquery.validate.min.js") ?>" type="text/javascript"></script>
    <script src="<?= URL::to("assets/plugins/HelperForm.js?v=1.0") ?>" type="text/javascript"></script>
    <script type="text/javascript">
                                                $(function () {

                                                    $('#tblSectores').on('change', 'input:checkbox', function () {
                                                        var chk = $(this);
                                                        if (chk.hasClass('check-head')) {
                                                            $('#tblSectores input:checkbox').prop('checked', chk.is(':checked'));
                                                            return;
                                                        }
                                                        if ($('#tblSectores td input:checked').length == 0 || chk.is(':checked')) {
                                                            $('#tblSectores input.check-head').prop('checked', chk.is(':checked'));
                                                        }
                                                    });


                                                    var form = $('#assignServie2');



                                                    form.validate();
                                                    var onSubmitForm = function (e) {
                                                        if (e.isDefaultPrevented())
                                                        {
                                                            return;
                                                        }
                                                        app.stopEvent(e);
                                                        $('#btnAceptarModalSectores').trigger('click');
                                                        var json = $('#jsonSectores').val();
                                                        if (json.trim() != "") {
                                                            json = JSON.parse(json);
                                                            var input = $('#cmbEstadoSectores');
                                                            var sectoresIncluidos = "";
                                                            var sectoresDesbloqueados = "";

                                                            for (var i = 0; i < json.length; i++) {
                                                                var temp = json[i];
                                                                if (temp.state != -1) {
                                                                    temp.state = input.val();
                                                                }

                                                                if (input.val() == 1 && temp.state == 1) {
                                                                    sectoresIncluidos += temp.name + ((i < (json.length - 1) ? ", " : ""));
                                                                } else if (input.val() == 0 && temp.state == 0) {
                                                                    sectoresDesbloqueados += temp.name + ((i < (json.length - 1) ? ", " : ""));
                                                                }
                                                            }
                                                            $('#sectoresBloqueados').val(sectoresIncluidos);
                                                            $('#sectoresDebloqueados').val(sectoresDesbloqueados);
                                                            $('#jsonSectores').val(JSON.stringify(json));
                                                        }

                                                        var form = $(this);

                                                        var submitFtn = function () {
                                                            relatedTickets = [];
                                                            var trs = $('#tableRelacionTickets tbody tr');
                                                            for (var i = 0; i < trs.length; i++) {
                                                                var tr = $(trs[i]);
                                                                if (tr.attr('data-i')) {
                                                                    relatedTickets.push(tr.attr('data-i'));
                                                                }
                                                            }

                                                            $('#txtRelatedTickets').val(JSON.stringify(relatedTickets));
                                                            dom.submitDirect(form, function (response) {
                                                                if (response.code > 0) {
                                                                    $('#btnCheckSectores').html('<i class="fa fa-fw fa-check-square-o"></i> Seleccionar sectores');
                                                                    $('#cmbTicketRelation').html('<option value="">Seleccione</option>').trigger('change.select2');
                                                                    $('#tableRelacionTickets tbody').html('<tr class="no-found"><td colspan="3"><i class="fa fa-fw fa-warning"></i> No se han agregado relaciones para este ticket.</td></tr>');
                                                                }
                                                            });
                                                        };
                                                        //Comprobamos si la banda seleccionada contiene dos bandas...
                                                        if ($('#banda option:selected').text().search('/') >= 0 && !form.attr('data-rt')) {
                                                            dom.confirmar("Este caso tiene dos bandas, ¿desea relacionar otro(s) tickets para este caso?", function () {
                                                                $('#tabRelacionarTickets').trigger('click');
                                                                form.attr('data-rt', 'true');
                                                                dom.scrollTop();
                                                            }, function () {
                                                                form.attr('data-rt', 'false');
                                                                submitFtn();
                                                            });
                                                        } else {
                                                            submitFtn();
                                                        }
                                                    };
                                                    form.on('submit', onSubmitForm);

//                                                                    dom.submit($('#assignServie2'), function (response) {
//                                                                        if (response.code > 0) {
//                                                                            $('#btnCheckSectores').html('<i class="fa fa-fw fa-check-square-o"></i> Seleccionar sectores');
//                                                                        }
//                                                                    });
                                                    dom.submit($('#stationForm'), function () {
                                                        location.href = app.urlTo('User/createTicketOnair');
                                                    });

                                                    $('#btnTodayDate').on('click', function () {
                                                        app.get('Utils/getActualDate')
                                                                .success(function (response) {
                                                                    console.log(response);
                                                                    if (response.code > 0) {
                                                                        $('#d_ingreso_on_air').val(formatDate(response.data, "yyyy-MM-ddTHH:mm", "yyyy-MM-dd HH:mm"));
                                                                    }
                                                                })
                                                                .send();
                                                    });

                                                    $('#copyToClipBoard').on('click', function () {
                                                        var temp = document.getElementById('inputForClipBoard');
                                                        temp = document.createElement('input');
                                                        temp.id = 'inputForClipBoard';
                                                        temp.style.opacity = '0';
                                                        temp.style.position = 'absolute';
                                                        temp.style.bottom = '0';
                                                        document.body.appendChild(temp);
                                                        temp.value = $('select#estacion option:selected').text();
                                                        temp.select();
                                                        document.execCommand("Copy");
                                                        temp.remove();
                                                    });

                                                    function getSectores() {
                                                        var obj = {
                                                            idTipoTrabajo: $('#tipotrabajo').val(),
                                                            idTecnologia: $('#tecnologia').val(),
                                                            idBanda: $('#banda').val()
                                                        };
                                                        var valid = 0;
                                                        if (obj.idTipoTrabajo.trim() == "") {
                                                            valid--;
                                                        }
                                                        if (obj.idTecnologia.trim() == "") {
                                                            valid--;
                                                        }
                                                        if (obj.idBanda.trim() == "") {
                                                            valid--;
                                                        }
                                                        if (valid != 0) {
                                                            return;
                                                        }

                                                        $('#tblSectores tbody').html('<tr><td colspan="2"><i class="fa fa-fw fa-refresh fa-spin"></i> Consultando...</td></tr>');
                                                        app.post('TicketOnair/getSectores', obj)
                                                                .success(function (response) {
                                                                    var data = app.parseResponse(response);
                                                                    if (data && data.length > 0) {
                                                                        var tabla = $('#tblSectores tbody');
                                                                        tabla.html('');
                                                                        //Llenamos la tabla sectores...
                                                                        for (var i = 0; i < data.length; i++) {
                                                                            var dat = data[i];
                                                                            tabla.append(dom.fillString('<tr data-id="{k_id_sector}" data-name="{name}"><td>{name}</td><td colspan="2"><div class="checkbox checkbox-primary" style=""><input id="checkbox_block_{k_id_sector}" type="checkbox" name="check_{k_id_sector}" value="1" /><label for="checkbox_block_{k_id_sector}" class="text-bold">Seleccionar</label></div></td></tr>', dat));
                                                                        }
                                                                    } else {
                                                                        $('#tblSectores tbody').html('<tr><td colspan="3" class="no-found"><i class="fa fa-fw fa-warning"></i> No hay sectores disponibles.</td></tr>');
                                                                    }
                                                                    $('#btnCheckSectores').html('<i class="fa fa-fw fa-check-square-o"></i> (' + $('#tblSectores').find('input:checked:not(.check-head)').length + ') Sectores seleccionados');
                                                                }).error(function () {
                                                            $('#btnCheckSectores').html('<i class="fa fa-fw fa-check-square-o"></i> (' + $('#tblSectores').find('input:checked:not(.check-head)').length + ') Sectores seleccionados');
                                                            swal("Error", "Se ha producido un error inesperado y no se pudo consultar los sectores.", "error");
                                                        }).send();
                                                    }


                                                    $('#btnCheckSectores').on('click', function () {
                                                        $('#modalSectores').modal('show');
                                                    });

                                                    $('.select-tipotrabajo').on('change', function () {
                                                        $('.select-tipotrabajo').val($(this).val()).trigger('change.select2');
                                                        getSectores();
                                                    });

                                                    $('.select-tecnologia').on('change', function () {
                                                        $('.select-tecnologia').val($(this).val()).trigger('change.select2');
                                                        getSectores();
                                                    });

                                                    $('.select-banda').on('change', function () {
                                                        $('.select-banda').val($(this).val()).trigger('change.select2');
                                                        getSectores();
                                                    });

                                                    $('#btnAceptarModalSectores').on('click', function () {
                                                        var sectores = [];
//                                                                        var sectoresIncluidos = "";
//                                                                        var sectoresDesbloqueados = "";
                                                        var inputs = $('#tblSectores').find('input:checkbox').not('.check-head');
                                                        for (var i = 0; i < inputs.length; i++) {
                                                            var input = $(inputs[i]);
                                                            var tr = input.parents('tr');
                                                            var temp = {
                                                                id: tr.attr('data-id'),
                                                                name: tr.attr('data-name'),
                                                                state: ((input.is(':checked')) ? true : -1)
                                                            };
                                                            sectores.push(temp);
//                                                                            if (input.val() == 1) {
//                                                                                sectoresIncluidos += temp.name + ((i < (inputs.length - 1) ? ", " : ""));
//                                                                            } else if (input.val() == 0) {
//                                                                                sectoresDesbloqueados += temp.name + ((i < (inputs.length - 1) ? ", " : ""));
//                                                                            }
                                                        }
                                                        $('#jsonSectores').val(JSON.stringify(sectores));
//                                                                        $('#sectoresBloqueados').val(sectoresIncluidos);
//                                                                        $('#sectoresDebloqueados').val(sectoresDesbloqueados);
                                                        $('#btnCheckSectores').html('<i class="fa fa-fw fa-check-square-o"></i> (' + $('#tblSectores').find('input:checked:not(.check-head)').length + ') Sectores seleccionados');
                                                        if (sectores.length > 0) {
                                                            $('.estado-sectores').removeClass('hidden');
                                                            $('#cmbEstadoSectores').prop(', true');
                                                        } else {
                                                            $('.estado-sectores').addClass('hidden');
                                                            $('#cmbEstadoSectores').prop(', false');
                                                        }
                                                    });


                                                    //Se ajusta el panel de relacionar tickets...
                                                    $('#btnAddTicketRelation').on('click', function () {
                                                        if (typeof dataEstaciones == "undefined") {
                                                            return;
                                                        }
                                                        ($('#assignServie2 #txtRelatedTickets').length == 0) && $('#assignServie2').append('<input type="hidden" name="related_tickets" id="txtRelatedTickets" />');
                                                        var content = $('#tableRelacionTickets tbody');
                                                        var estacion = $('#cmbTicketRelation').val();
                                                        if (content.find('[data-i="' + estacion + '"]').length > 0) {
                                                            return;
                                                        }
                                                        var obj = dataEstaciones[estacion];
                                                        content.find('.no-found').remove();
                                                        console.log(obj);
                                                        obj.i = content.find('tr').length + 1;
                                                        content.append(dom.fillString('<tr data-i="{k_id_onair}"><td>{i}</td><td><a href="' + app.urlTo('Documenter/documenterFields?id=') + '{k_id_onair}" target="_blank">#{k_id_onair} - {k_id_station.n_name_station} / {k_id_band.n_name_band}</td><td><div class="btn-group"><a href="' + app.urlTo('Documenter/documenterFields?id=') + '{k_id_onair}" target="_blank" class="btn btn-xs btn-default" title="Ver ticket"><i class="fa fa-fw fa-eye"></i></a><button class="btn btn-xs btn-danger btn-delete-relation" title="Eliminar"><i class="fa fa-fw fa-times"></i></button></div></td></tr>', obj));
                                                    });

                                                    $('.select-estacion').on('change', function () {
                                                        app.post('Utils/getTicketsByStations', {idStation: $(this).val()})
                                                                .success(function (response) {
                                                                    var cmb = $('#cmbTicketRelation');
                                                                    var data = app.parseResponse(response);
                                                                    if (data && data.length > 0) {
                                                                        dataEstaciones = {};
                                                                        cmb.html('');
                                                                        var max = data.length;
                                                                        for (var i = 0; i < max; i++) {
                                                                            var obj = data[i];
                                                                            dataEstaciones[obj.k_id_onair] = obj;
                                                                            obj.i = i + 1;
                                                                            $el = $(dom.fillString('<option value="{k_id_onair}">#{k_id_onair} - {k_id_station.n_name_station} - {k_id_technology.n_name_technology} - {k_id_band.n_name_band}</option>', obj));
                                                                            cmb.append($el);
//                                                                                content.append(dom.fillString('<tr><td>{i}</td><td><a href="' + app.urlTo('Documenter/documenterFields?id=') + '{k_id_onair}" target="_blank">#{k_id_onair} - {k_id_station.n_name_station} / {k_id_band.n_name_band}</td></tr>', obj));
                                                                        }
                                                                        cmb.trigger('change.select2');
                                                                    } else {
                                                                        cmb.html('');
                                                                        cmb.append($('<option>', {
                                                                            value: "",
                                                                            text: "No hay tickets para relacionar"
                                                                        }));
//                                                                            cmb.html('<tr><td colspan="3"><i class="fa fa-fw fa-warning"></i> No se han agregado relaciones para este tikcet.</td></tr>');
                                                                    }
                                                                })
                                                                .error(function (error) {
                                                                    console.error(error);
                                                                })
                                                                .send();
                                                    });


                                                    //Se implementa el evento clic para el botón agregar sector de la tabla sectores...
                                                    $('.btn-add-sector').on('click', function () {
                                                        var table = $('#tblSectores tbody');
                                                        var tr = $('<tr><td class="" colspan="3"><div style="width: 100%; display: table" class="input-group"><div class="input-group-addon">Sector:</div><input type="text" class="form-control" placeholder="Nombre del sector" /><div class="input-group-btn"><button type="button" class="btn btn-success push-sector-btn"><i class="fa fa-fw fa-save"></i></button><button type="button" class="btn btn-danger delete-sector-btn"><i class="fa fa-fw fa-trash"></i></button></div></div></td></tr>');
                                                        table.find('.no-found').remove();
                                                        table.prepend(tr);
                                                        tr.find('input').focus();
                                                    });

                                                    $('#tblSectores').on('click', '.push-sector-btn', function () {
                                                        var btn = $(this);
                                                        var tr = btn.parents('tr');
                                                        var table = $('#tblSectores');
                                                        if (tr.find('input').val().trim() == "") {
                                                            return;
                                                        }
                                                        table.find('tr.no-found').remove();
                                                        var dat = {
                                                            id: tr.find('input').val(),
                                                            name: tr.find('input').val(),
                                                            state: 1,
                                                        };
                                                        tr.remove();
                                                        table.append(dom.fillString('<tr data-id="{id}" data-name="{name}"><td>{name}</td><td colspan="2"><div class="checkbox checkbox-primary" style=""><input ' + ((dat.state == 1 || dat.state == 0) ? 'checked="true"' : '') + ' id="checkbox_block_{id}" type="checkbox" name="check_{id}" value="1" ><label for="checkbox_block_{id}" class="text-bold">Seleccionar</label> <button class="close btn-remove-sector-added m-r-15" title="Eliminar sector">&times</button></div></td></tr>', dat));
                                                    });
                                                    $('#tblSectores').on('click', '.delete-sector-btn', function () {
                                                        var tr = $(this).parents('tr');
                                                        tr.remove();
                                                    });
                                                    $('#tblSectores').on('click', '.btn-remove-sector-added', function () {
                                                        var tr = $(this).parents('tr');
                                                        tr.remove();
                                                    });

                                                    $('#btnGuardarRelacionTickets').on('click', function () {
                                                        $('#tabCrearActividad').trigger('click');
                                                        $('#assignServie2').trigger('submit');
                                                    });
                                                });
    </script>
    <?php
    if (isset($error)) {
        echo '<script type="text/javascript">showMessage();</script>';
    }
    ?>
    
    <!-- Modal Cierre -->
    <div id="modalEditComment" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><img src="<?= URL::base() ?>/assets/img/close.png" alt="cerrar" id="modalImage" ></button>
                    <h3 class="modal-title" id="modalTitle"></h3>
                </div>
                <div class="modal-body">
                    <div>
                        <form class="well form-horizontal" id="formModal" action=""  method="post" data-action="FOR_UPDATE" novalidate="novalidate">
                            <fieldset>
                                <div class="widget bg_white m-t-25 display-block">
                                    <fieldset class="col-md-6 control-label">
                                        <!-- valores ocultos -->
                                        <input type="hidden" id="mtxtTicket" value="">

                                        <!-- select -->
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Estacion:</label>
                                            <div class="col-md-5 selectContainer">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-fw fa-street-view"></i></span>
                                                    <select name="k_id_station" id="estacion_modal" class="form-control selectpicker select-estacion" onchange="editTextCityRegional()">
                                                        <option value="" >Seleccione la estación</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Select Basic -->
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Tecnologia:</label>
                                            <div class="col-md-8 selectContainer">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-fw fa-tablet"></i></span>
                                                    <select name="k_id_technology" id="modalTecnologia" class="form-control selectpicker select-tecnologia helper-change">
                                                        <option value="" >Seleccione la tecnologia</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Select Basic -->
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Banda:</label>
                                            <div class="col-md-8 selectContainer">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-fw fa-signal"></i></span>
                                                    <select name="k_id_band" id="modalBanda" class="form-control selectpicker select-banda">
                                                        <option value="" >Seleccione la banda</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>


                                    </fieldset>
                                    <!--  fin seccion izquierda form-->
                                    <!--  inicio seccion derecha form-->
                                    <fieldset>

                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Tipo de trabajo:</label>
                                            <div class="col-md-8 selectContainer">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-fw fa-briefcase"></i></span>
                                                    <select name="k_id_work" id="modalTipotrabajo" class="form-control selectpicker select-tipotrabajo" onchange="validateSln()">
                                                        <option value="" >Seleccione el tipo de trabajo</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Select Basic -->
                                        <!-- <div class="form-group">
                                            <label class="col-md-3 control-label">Estado:</label>
                                            <div class="col-md-8 selectContainer">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-fw fa-thumbs-o-up"></i></span>
                                                    <select name="k_id_status" id="modalStatus" class="form-control selectpicker" onchange="editModalSubstatus()">
                                                        <option value="" >Seleccione el Estado</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Subestado:</label>
                                            <div class="col-md-8 selectContainer">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-fw fa-thumbs-o-up"></i></span>
                                                    <select name="k_id_status_onair" id="modalSubstatus" class="form-control selectpicker">
                                                        <option value="">Seleccione el Subestado</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div> -->
                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Estado Comentario:</label>
                                            <div class="col-md-8 selectContainer">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-fw fa-briefcase"></i></span>
                                                    <input type='text' name="n_estado_eb_resucomen" id="mdl_n_estado_eb_resucomen" class="form-control"  >
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="mtxtUserCom" class="col-md-3 control-label">Usuario Comentario &nbsp;</label>
                                            <div class="col-md-8 selectContainer">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class='glyphicon glyphicon-user'></i></span>
                                                    <select name="mtxtUserCom" id="mtxtUserCom" class="form-control mtxtTecnico select-usuarios"> <!-- onchange="realizarCalificacion()" -->
                                                        <option value=""></option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>



                                    </fieldset>
                                    <!--  fin seccion derecha form---->
                                </div>


                                <div class="widget bg_white m-t-25 display-block">
                                    <fieldset class="col-md-6 control-label">

                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Fecha Actualización:</label>
                                            <div class="col-md-8 selectContainer">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-fw fa-calendar-o "></i></span>
                                                    <input type='datetime-local' name="mdl_d_ingreso_on_air" id="mdl_d_ingreso_on_air" class="form-control" value="">
                                                    
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Ente Ejecutor:</label>
                                            <div class="col-md-8 selectContainer">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-fw fa-address-book"></i></span>
                                                    <select name="n_enteejecutor" id="mdl_n_enteejecutor" class="form-control selectpicker">
                                                        <option value="" >Seleccione el ente ejecutor</option><option value="Claro" >Claro</option><option value="Nokia" >Nokia</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <!--  fin seccion izquierda form---->

                                    <!--  inicio seccion derecha form---->
                                    <fieldset>

                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Tipificación:</label>
                                            <div class="col-md-8 selectContainer">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-fw fa-briefcase"></i></span>
                                                    <input type='text' name="tipificacion_resucomen" id="tipificacion_resucomen" class="form-control"  >
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group NOC">
                                            <label class="col-md-3 control-label">NOC:</label>
                                            <div class="col-md-8 selectContainer">
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-fw fa-wrench"></i>
                                                    </div>
                                                    <select class="form-control" name="mdl_n_noc" id="mdl_n_noc">
                                                        <option value="">Seleccione</option>
                                                        <option value="NOKIA-ZTE">NOKIA-ZTE</option>    
                                                        <option value="ZTE">ZTE</option>

                                                    </select>
                                                </div>                             
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>

                                <div class="widget bg_white m-t-25 display-block">
                                    <div class="form-group" id="formCenter">
                                        <!-- <label for="mtxtObservaciones" class="col-md-3 control-label">Observaciones: &nbsp;</label> -->
                                        <div class="form-group">
                                            <label class="col-md-2 control-label">Comentario</label>
                                            <div class="col-md-9 inputGroupContainer">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
                                                    <textarea class="form-control" name="comentario_resucoment" id="mdl_comentario_resucoment" placeholder="comentario actual" rows="5"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>                
                                </div>
                                <input type="hidden" name="" id="id_comentario" value="">

                            </fieldset>
                        </form>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" id="mbtnDeleteComentario" style="float: left;"><i class='glyphicon glyphicon-remove'></i>&nbsp;Eliminar</button>
                    <button type="button" class="btn btn-default" id="mbtnCerrarModal" data-dismiss="modal"><i class='glyphicon glyphicon-chevron-up'></i>&nbsp;Cancelar</button>
                    <button type="button" class="btn btn-info" id="mbtnUpdComentario"><i class='glyphicon glyphicon-save'></i>&nbsp;Actualizar</button>
                    <button type="button" class="btn btn-primary" id="mbtnNewComentario"><i class='glyphicon glyphicon-save'></i>&nbsp;Insertar</button>
                </div>
            </div>
        </div>
    </div>

    
    <?php if (isset($_GET['msj'])): ?>
        <script type="text/javascript">
            var inicial = $('body').attr('data-base');
            var ticketAct = "<?= $_GET['id']?>";

            Push.create( "El ticket " + ticketAct, {
                      body: "Fue actualizado exitosamente",
                      icon: inicial + '/assets/img/logoblue.png',
                      timeout: 4000,
                      onClick: function () {
                          window.focus();
                          this.close();
                      }
           });
        </script>
        
    <?php endif ?>

    

    <script src="<?= URL::to("assets/plugins/sweetalert-master/sweetalert2.min.js") ?>" type="text/javascript"></script>
        


</body>
</html>
