<!DOCTYPE html>
<html lang="en">
    <?php $this->load->view('parts/generic/head'); ?>
    <!--   SWEET ALERT    -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.0.3/sweetalert2.min.css" />
    <style type="text/css">
        .nav li a {
            background-color:#207be5;
            text-decoration:'Open Sans', sans-serif;
            padding:20px 12px;
            display:block;
            color: #FFF;
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.0.3/sweetalert2.all.min.js"></script>
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
            <!--asignacion-->
            <div class='tab-content hidden' id='tab1'><br><br>
                <div class='container'>
                    <form class= 'well form-horizontal' action='' method='post'  id='assignService' name='assignServie' enctype= 'multipart/form-data'>
                        <fieldset>
                            <legend>Actividad</legend>
                            <!-- <div class= 'form-group'>
                                <label class= 'col-md-4 control-label'>Elegir Archivo</label>
                                <div class= 'col-md-6 inputGroupContainer'>
                                    <div class= 'input-group'>
                                        <span class= 'input-group-addon'><i class= 'fa fa-fw fa-envelope-open'></i></span>
                                        <input  name= 'idarchivo' class= 'src-file'  type= 'file'>
                                    </div>
                                </div>
                            </div> -->
                        </fieldset>
                    </form>
                </div>
            </div>

            <div class="panel with-nav-tabs panel-primary">
                <div class="panel panel-heading">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#crear_actividad" id="tabCrearActividad"><i class="fa fa-fw fa-plus"></i> Crear Actividad</a></li>
                        <li><a data-toggle="tab" href="#relacionar" id="tabRelacionarTickets"><i class="fa fa-fw fa-rebel"></i> Relacionar Tickets</a></li>
                        <li><a data-toggle="tab" href="#crear_nueva_estacion"><i class="fa fa-fw fa-plus"></i> Crear nueva estación</a></li>
                    </ul>
                </div>
                <div class="panel-body">
                    <div class="tab-content">
                        <div id="crear_actividad" class="tab-pane fade in active">
                            <form class="well form-horizontal" action="TicketOnair/insertTicketOnair" method="post"  id="assignServie2" name="assignServie2">
                                <div class="alert alert-success alert-dismissable hidden">
                                    <a href="#" class="close" >&times;</a>
                                    <p class="p-b-0" id="text"></p>
                                </div>
                                <legend >Crear Actividad</legend>
                                <fieldset class="col-md-6 control-label">
                                    <!-- Input Text -->
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Estacion:</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-street-view"></i></span>
                                                <select name="k_id_station" id="estacion" class="form-control selectpicker" onchange="editTextCityRegional()" required>
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
                                                <input type='text' name="ciudad" id="ciudad" class="form-control" value='' disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Select Basic -->
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Regional:</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-globe"></i></span>
                                                <input type='text' name="regional" id="regional" class="form-control" value='' disabled>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Ente Ejecutor:</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-address-book"></i></span>
                                                <select name="n_enteejecutor" id="n_enteejecutor" class="form-control selectpicker" required>
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
                                                <input type='datetime-local' name="d_ingreso_on_air" id="d_ingreso_on_air" class="form-control" value='' required>
                                                <div class="input-group-btn">
                                                    <button type="button" id="btnTodayDate" class="btn btn-primary" title="Fecha Actual"><i class="fa fa-fw fa-calendar-check-o"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-8 selectContainer">
                                            <div class="radio radio-primary" style="text-align: left; margin-left: 140px;">
                                                <input id="CRQ" type="radio" name="crq_chg" value="CRQ" onclick="changeCrqChg()" checked>
                                                <label for="CRQ" class="text-bold">
                                                    CRQ
                                                </label><br/>
                                                <input id="CHG" type="radio" name="crq_chg" value="CHG" onclick="changeCrqChg()">
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
                                                <input type='text' name="n_crq" id="n_crq" class="form-control" value='' required onfocusout="validateCrqChg()">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">WP:</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-id-card"></i></span>
                                                <input type='text' name="n_wp" id="n_wp" class="form-control" value='' >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">bcf_wbts_id:</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="fa fa-fw fa-id-card"></i></span>
                                                <input type='text' name="n_bcf_wbts_id" id="n_bcf_wbts_id" class="form-control" value='' >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-8 selectContainer">
                                            <div class="checkbox checkbox-primary" style="text-align: left; margin-left: 140px;">
                                                <input id="checkbox2" type="checkbox" name="i_priority" >
                                                <label for="checkbox2" class="text-bold">
                                                    Prioritario
                                                </label>
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
                                                <select name="k_id_work" id="tipotrabajo" class="form-control selectpicker select-tipotrabajo" onchange="validateSln()" required>
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
                                                <select name="k_id_technology" id="tecnologia" class="form-control selectpicker select-tecnologia helper-change" required>
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
                                                <select name="k_id_band" id="banda" class="form-control selectpicker select-banda" required>
                                                    <option value="" >Seleccione la banda</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="n_sectoresbloqueados" id="sectoresBloqueados" />
                                    <input type="hidden" name="n_sectoresdesbloqueados" id="sectoresDebloqueados"/>
                                    <input type="hidden" name="n_json_sectores" id="jsonSectores" />
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Sectores:</label>
                                        <div class="col-md-8 selectContainer">
                                            <button type="button" id="btnCheckSectores" class="btn btn-primary btn-block"><i class="fa fa-fw fa-check-square-o"></i> Seleccionar Sectores</button>
                                        </div>
                                    </div>
                                    <div class="form-group estado-sectores hidden">
                                        <label class="col-md-3 control-label">Estado sectores:</label>
                                        <div class="col-md-8 selectContainer">
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-fw fa-wrench"></i>
                                                </div>
                                                <select class="form-control" name="estado_sectores" id="cmbEstadoSectores">
                                                    <option value="">Seleccione</option>
                                                    <option value="1">Bloqueados</option>
                                                    <option value="0">Desbloqueados</option>
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
                                                <select name="k_id_status" id="status" class="form-control selectpicker" onchange="editSubstatus()" required>
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
                                                <select name="k_id_status_onair" id="substatus" class="form-control selectpicker" required>
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
                                                <input type='text' name="n_persona_solicita_notificacion" id="n_persona_solicita_notificacion" class="form-control" value='' >
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
                        <div id="crear_nueva_estacion" class="tab-pane fade">
                            <form class="form-horizontal well"  action="Station/createCity" method="post"  id="stationForm" name="stationForm">
                                <div class="panel-body">
                                    <fieldset class="col-md-6 control-label">
                                        <div class="form-group">
                                            <label for="cmbRegional" class="col-md-3 control-label">Regional:</label>
                                            <div class="col-md-8 selectContainer">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-fw fa-check-circle"></i></span>
                                                    <select name="regional_field" id="regional_field" class="form-control selectpicker" onchange="fillCities()" required>
                                                        <option value="">Seleccione la Regional</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="txtNombreEstacion" class="col-md-3 control-label">Nombre estación:</label>
                                            <div class="col-md-8 selectContainer">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-fw fa-user"></i></span>
                                                    <input type="text" class="form-control input-sm" id="n_name_city" name="n_name_city" value="" />
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <!--  fin seccion izquierda form---->

                                    <!--  inicio seccion derecha form---->
                                    <fieldset>
                                        <div class="form-group">
                                            <label for="cmbPrelaunch" class="col-md-3 control-label">Ciudad:</label>
                                            <div class="col-md-8 selectContainer">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-fw fa-check-circle"></i></span>
                                                    <select name="city_id" id="city_id" class="form-control selectpicker" required>
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
                                                <button type="submit" id="btnGuardar" class="btn btn-primary" onclick = "">Guardar <span class="fa fa-fw fa-floppy-o"></span></button>
                                            </div>
                                        </div>
                                    </center>
                                </div>
                            </form>
                        </div>
                        <div id="relacionar" class="tab-pane fade">
                            <div class="form-horizontal well" method="post"  id="stationForm" name="stationForm">
                                <div class="alert alert-info alert-dismissable">
                                    <a href="#" class="close" >&times;</a>
                                    <p class="p-b-0" id="text">
                                        <i class="fa fa-fw fa-info-circle"></i> Utiliza este panel para relacionar tickets. Selecciona el ticket y has clic en el botón agregar.
                                    </p>
                                </div>
                                <div class="panel-body">
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
                                    <div class="form-group">
                                        <table class="table table-bordered table-condensed table-striped table-hover" id="tableRelacionTickets">
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
                                                            console.log(info);
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
                                                                $('#estacion').append($('<option>', {
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
                                                            for (var j = 0; j < info.regions.data.length; j++) {
                                                                $('#regional_field').append($('<option>', {
                                                                    value: info.regions.data[j].k_id_regional,
                                                                    text: info.regions.data[j].n_name_regional
                                                                }));
                                                            }
                                                            $('select').select2({"width": "100%"});
                                                            //dom.configCalendar($('#d_ingreso_on_air'));
                                                            changeCrqChg();

                                                        });

                                                        function changeCrqChg() {
                                                            var valRadio = $('input:radio[name=crq_chg]:checked').val();
                                                            switch (valRadio) {
                                                                case "CRQ":
                                                                    $('#n_crq').mask("CRQ999999999999", {placeholder: "CRQ000009999999"});
                                                                    break;
                                                                case "CHG":
                                                                    $('#n_crq').mask("CHG99999", {placeholder: "CHG99999"});
                                                                    break;
                                                            }
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
                                                            var estacion = $("#estacion").val();
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
    </script>
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
                                                                    $('#cmbEstadoSectores').prop('required', true);
                                                                } else {
                                                                    $('.estado-sectores').addClass('hidden');
                                                                    $('#cmbEstadoSectores').prop('required', false);
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

                                                            $('#estacion').on('change', function () {
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
                                        <select id="tipoTrabajoModal" class="form-control selectpicker select-tipotrabajo" required>
                                            <option value="" >Seleccione el tipo de trabajo</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="selectContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-fw fa-tablet"></i></span>
                                        <select id="tecnologiaModal" class="form-control selectpicker select-tecnologia helper-change" required>
                                            <option value="" >Seleccione la tecnología</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="selectContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-fw fa-signal"></i></span>
                                        <select id="bandaModal" class="form-control selectpicker select-banda" required>
                                            <option value="" >Seleccione la banda</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="m-all-0"/>
                    <div class="row p-t-15">
                        <div class="col-xs-12">
                            <div style="display: block; overflow: auto; overflow-x: hidden; max-height: 300px; border: 1px solid #ddd;">
                                <table class="table table-bordered table-condensed table-striped table-sm" id="tblSectores">
                                    <thead>
                                        <tr>
                                            <th class="vertical-middle"><i class="fa fa-fw fa-wrench"></i> Sector</th><th class="p-l-5"><div class="checkbox checkbox-primary" style=""><input id="checkbox_head_sectores" type="checkbox" name="check_sectores" class="check-head" value="1" ><label for="checkbox_head_sectores" class="text-bold">Seleccionar todos</label></div></th>
                                            <th class="p-all-0 vertical-middle text-right"><button class="btn btn-default btn-sm m-r-15 btn-add-sector" ><i class="fa fa-fw fa-plus"></i> Agregar sector</button></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="no-found"><td colspan="3"><i class="fa fa-fw fa-warning"></i> Ningún sector disponible</td></tr>
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
</body>
</html>
