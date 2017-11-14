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
                                <label class="col-md-3 control-label">CRQ / CHG:</label>
                                <div class="col-md-8 selectContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-fw fa-id-card"></i></span>
                                        <input type='text' name="n_crq" id="n_crq" class="form-control" value='' required>
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
                        </fieldset>
                        <!--  fin seccion izquierda form---->

                        <!--  inicio seccion derecha form---->
                        <fieldset >
                            <!-- Select Basic -->
                            <div class="form-group">
                                <label class="col-md-3 control-label">Tecnologia:</label>
                                <div class="col-md-8 selectContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-fw fa-tablet"></i></span>
                                        <select name="k_id_technology" id="tecnologia" class="form-control selectpicker" required>
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
                                        <select name="k_id_band" id="banda" class="form-control selectpicker" required>
                                            <option value="" >Seleccione la banda</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- Select Basic -->
                            <div class="form-group">
                                <label class="col-md-3 control-label">Tipo de trabajo:</label>
                                <div class="col-md-8 selectContainer">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-fw fa-briefcase"></i></span>
                                        <select name="k_id_work" id="tipotrabajo" class="form-control selectpicker" required>
                                            <option value="" >Seleccione el tipo de trabajo</option>
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
                                    </div>
                                </div>
                            </div>
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
        <?php $this->load->view('parts/generic/scripts'); ?>
        <!-- CUSTOM SCRIPT   -->


        <div class="incorrect-type info-box error-msg" style="display: none;">
          Sorry, the file you selected is not MSG type
        </div>

        <div class="file-api-not-available info-box error-msg" style="display: none;">
          Sorry, your browser isn't supported
        </div>

        <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.2.1.min.js"></script>
        <script type="text/javascript" src="<?= URL::to('assets/js/DataStream.js') ?>"></script>
        <script type="text/javascript" src="<?= URL::to('assets/js/msg.reader.js') ?>"></script>
        <script>
          $(function () {
            var info = <?php echo $respuesta; ?>;
            console.log(info);
            for (var j = 0; j < info.bands.data.length; j++){
              $('#banda').append($('<option>', {
                  value: info.bands.data[j].k_id_band,
                  text: info.bands.data[j].n_name_band
              }));
            }
            for (var j = 0; j < info.technologies.data.length; j++){
              $('#tecnologia').append($('<option>', {
                  value: info.technologies.data[j].k_id_technology,
                  text: info.technologies.data[j].n_name_technology
              }));
            }
            for (var j = 0; j < info.works.data.length; j++){
              $('#tipotrabajo').append($('<option>', {
                  value: info.works.data[j].k_id_work,
                  text: info.works.data[j].n_name_ork
              }));
            }
            for (var j = 0; j < info.stations.data.length; j++){
              $('#estacion').append($('<option>', {
                  value: info.stations.data[j].k_id_station,
                  text: info.stations.data[j].n_name_station
              }));
            }
            for (var j = 0; j < info.status.data.length; j++){
              $('#status').append($('<option>', {
                  value: info.status.data[j].k_id_status,
                  text: info.status.data[j].n_name_status
              }));
            }
            for (var j = 0; j < info.regions.data.length; j++){
              $('#regional_field').append($('<option>', {
                  value: info.regions.data[j].k_id_regional,
                  text: info.regions.data[j].n_name_regional
              }));
            }
          })
          function editTextCityRegional(){
            var estacion = $( "#estacion" ).val();
            var info = <?php echo $respuesta; ?>;
            var city;
            for (var j = 0; j < info.stations.data.length; j++){
              if(info.stations.data[j].k_id_station == estacion){
                for(var m = 0; m < info.cities.data.length; m++){
                  if (info.stations.data[j].k_id_city == info.cities.data[m].k_id_city){
                    city = info.cities.data[m].k_id_regional;
                    $('input[name=ciudad]').val(info.cities.data[m].n_name_city);
                  }
                }
                for(var x = 0; x < info.regions.data.length; x++){
                  if(info.regions.data[x].k_id_regional == city){
                    $('input[name=regional]').val(info.regions.data[x].n_name_regional);
                  }
                }
              }
            }
          }

          function fillCities(){
            var regional = $( "#regional_field" ).val();
            var info = <?php echo $respuesta; ?>;
            for (var j = 0; j < info.cities.data.length; j++){
              if(info.cities.data[j].k_id_regional == regional){
                $('#city_id').append($('<option>', {
                    value: info.cities.data[j].k_id_city,
                    text: info.cities.data[j].n_name_city
                }));
              }
            }
          }

          function editSubstatus(){
            var status = $( "#status" ).val();
            console.log(status);
            var info = <?php echo $respuesta; ?>;
            $('#substatus').empty();
            for (var j = 0; j < info.statusOnAir.data.length; j++){
              if(status == info.statusOnAir.data[j].k_id_status){
                  $('#substatus').append($('<option>', {
                      value: info.statusOnAir.data[j].k_id_status_onair,
                      text: info.statusOnAir.data[j].n_name_substatus
                  }));
              }
            }
          }
        </script>
        <script src="<?= URL::to("assets/plugins/jquery.validate.min.js") ?>" type="text/javascript"></script>
        <script src="<?= URL::to("assets/plugins/HelperForm.js") ?>" type="text/javascript"></script>
        <script type="text/javascript">
        $(function(){
          dom.submit($('#assignServie2'));
        })
        $(function(){
          dom.submit($('#stationForm'), function () {
              location.href = app.urlTo('User/createTicketOnair');
          });
        })
        </script>
        <?php
        if (isset($error)) {
            echo '<script type="text/javascript">showMessage();</script>';
        }
        ?>
        <!--   ANIMACION DE LOGIN   -->
        <script src="<?= URL::to('assets/js/index.js') ?>"></script>
    </body>
</html>
