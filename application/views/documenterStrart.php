<!DOCTYPE html>
<html lang="en">
    <?php $this->load->view('parts/generic/head'); ?>
    <!--   SWEET ALERT    -->
    <link rel="stylesheet" href="<?= URL::to('assets/plugins/sweetalert-master/dist/sweetalert.css') ?>" />
    <script type="text/javascript" src="<?= URL::to('assets/plugins/sweetalert-master/dist/sweetalert.min.js') ?>"></script>
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
        <div class="container">

            <!--asignacion-->
            <div class='tab-content' id='tab1'><br><br>
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

            <div class='tab-content' id='tab3'>
                <div class="container">
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
                                        <select name="k_id_work" id="tipotrabajo" class="form-control selectpicker select-tipotrabajo" required>
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
                                        <textarea class="form-control" name="n_comentario_doc" id="n_comentario_doc" placeholder="Observaciones coordinador"></textarea>
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

                    <div class="panel-group" id="accordion">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a data-toggle="collapse" data-parent="#accordion" href="#collapse2"><i class="fa fa-fw fa-list"></i> Nueva estación</a>
                                </h4>
                            </div>
                            <div id="collapse2" class="panel-collapse collapse">
                                <div class="panel-body">
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
                                                                        dom.submitDirect(form, function (response) {
                                                                            if (response.code > 0) {
                                                                                $('#btnCheckSectores').html('<i class="fa fa-fw fa-check-square-o"></i> Seleccionar sectores');
                                                                            }
                                                                        });
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
                                                                                        $('#d_ingreso_on_air').val(formatDate(response.data, "yyyy-MM-ddThh:mm", "yyyy-MM-dd HH:mm"));
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
                                                                                            tabla.append(dom.fillString('<tr data-id="{k_id_sector}" data-name="{name}"><td>{name}</td><td><div class="checkbox checkbox-primary" style=""><input id="checkbox_block_{k_id_sector}" type="checkbox" name="check_{k_id_sector}" value="1" /><label for="checkbox_block_{k_id_sector}" class="text-bold">Seleccionar</label></div></td></tr>', dat));
                                                                                        }
                                                                                    } else {
                                                                                        $('#tblSectores tbody').html('<tr><td colspan="3"><i class="fa fa-fw fa-warning"></i> No hay sectores disponibles.</td></tr>');
                                                                                    }
                                                                                }).error(function () {
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
                                                                        $('#btnCheckSectores').html('<i class="fa fa-fw fa-check-square-o"></i> (' + $('#tblSectores').find('input:checked').length + ') Sectores agregados');
                                                                        if (sectores.length > 0) {
                                                                            $('.estado-sectores').removeClass('hidden');
                                                                            $('#cmbEstadoSectores').prop('required', true);
                                                                        } else {
                                                                            $('.estado-sectores').addClass('hidden');
                                                                            $('#cmbEstadoSectores').prop('required', false);
                                                                        }
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
                                    <thead><tr>
                                            <th class="vertical-middle"><i class="fa fa-fw fa-wrench"></i> Sector</th><th class="p-l-5"><div class="checkbox checkbox-primary" style=""><input id="checkbox_head_sectores" type="checkbox" name="check_sectores" class="check-head" value="1" ><label for="checkbox_head_sectores" class="text-bold">Seleccionar todos</label></div></th>
                                        </tr></thead>
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
</body>
</html>
