<!DOCTYPE html>
    <html lang="en">
        <style>

      body {
        /*margin: 40px 10px;*/
        /*margin-top: 50%;*/
        /*padding: 0;*/
      }

      #calendar {
        margin-top: 50px !important;
        max-width: 700px;
        margin: 0 auto;
        margin-bottom: 20px;
        font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif !important;
        font-size: 14px !important;
      }
    </style>
    <?php $this->load->view('parts/generic/head'); ?>
        <link href="<?= URL::to('assets/plugins/fullcalendar/fullcalendar.min.css') ?>" rel="stylesheet" />
        <link href="<?= URL::to('assets/plugins/fullcalendar/fullcalendar.print.min.css') ?>" rel="stylesheet" media="print" />
        <link href="<?= URL::to('assets/css/styleTableCrono.css') ?>" rel="stylesheet" />
        <script src="<?= URL::to('assets/plugins/fullcalendar/lib/moment.min.js') ?>"></script>
        <script src="<?= URL::to('assets/plugins/fullcalendar/lib/jquery.min.js') ?>"></script>
        <script src="<?= URL::to('assets/plugins/fullcalendar/fullcalendar.min.js') ?>"></script>
        <script src="<?= URL::to('assets/plugins/fullcalendar/locale/es.js') ?>"></script>
    <body data-base="<?= URL::base() ?>">
            

        <?php $this->load->view('parts/generic/header'); ?>
        <div class="container autoheight p-t-20">

          <!-- ============================INICIO MENU STICKY============================ -->
          <div class="contenedor closed" id="content_fixed">

            <div id="btn_fixed" >
              <span class="rotate-90 text">
                <i class="glyphicon glyphicon-chevron-up"></i><span class="title_sticky">Total %</span>
              </span>
            </div>
            <div class="hidden" id="menu_fixed">
              <span id="btn_close_fixed">
                <i class="glyphicon glyphicon-chevron-right"></i> Cerrar
              </span>
              <div class='containerfluid'>
                <div class='row'>
                  <h1 id="total_total">...</h1><hr> 
                  <div class='col-md-12'><h4>Ejecutadas</h4>
                    <div class='progress'>
                      <div id="bar_eje" class='progress-bar progress-bar-success progress-bar-striped active' role='progressbar'>
                        <div id="porc_eje" class="f-s-10_m-t-3">...</div>
                      </div>
                    </div>
                  </div>
                </div>
                <h5 id="cant_eje">...</h5><hr>

                <div class='row'>
                  <div class='col-md-12'><strong><h4>Programadas</h4></strong> 
                    <div class='progress'>
                      <div id="bar_prog" class='progress-bar progress-bar-primary progress-bar-striped active' role='progressbar'>
                        <div id="porc_prog" class="f-s-10_m-t-3">...</div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <h5 id="cant_prog">...</h5><br>

            </div>
          </div>
          <!-- ====================================FIN MENU STICKY==================================== -->

          <!-- ====================================INICIO MODAL HOY ====================================-->
          <!-- Modal Graficas Mes-->
          <div class="modal fade" id="modal_hoy" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><i class="fa fa-fw fa-close" alt="cerrar" class="modalImage" ></i></button>
                  <h4 class="modal-title" id="titleType">...</h4>
                </div>
                <div class="modal-body">   

                  <table id="table_modal" class="table table-bordered">
                      <thead>
                          <tr>
                            <th>ACTIVIDADES</th>
                            <th>Frecuencia</th>
                            <th>H Max</th>
                            <?php $fecha = new DateTime(); ?>
                            <th class="td_hoy">hoy <?= $fecha->format('d') ?></th>
                          </tr>
                      </thead>
                      <tbody id="body_table_modal">
                        
                      </tbody>




                  </table>
                    


                </div>
                <div class="modal-footer">
                  <!-- <h4 class="foot">Zolid By ZTE Colombia | All Right Reserved</h4> -->
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar  <i class="glyphicon glyphicon-chevron-up"></i></button>
                </div>
              </div>
            </div>
          </div>


          <div class="panel-cronograma">
                <!-- select -->
                <div class="form-group" style="margin-top: 25px">
                  <label for="mes" class="col-sm-1 control-label">Mes:</label>
                  <div class="col-sm-3 selectContainer">
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-fw fa-calendar"></i></span>
                      <select class="form-control" id="mes" name="mes" required>
                        <option value="1">Enero</option>
                        <option value="2">Febrero</option>
                        <option value="3">Marzo</option>
                        <option value="4">Abril</option>
                        <option value="5">Mayo</option>
                        <option value="6">Junio</option>
                        <option value="7">Julio</option>
                        <option value="8">Agosto</option>
                        <option value="9">Septiembre</option>
                        <option value="10">Octubre</option>
                        <option value="11">Noviembre</option>
                        <option value="12">Diciembre</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-1">
                      <button id="btn-calendario" class="btn btn-primary">Calendario</button>
                  </div>
                  <div class="col-sm-4">
                      <button type="button" class="btn btn-warning" id="btn-hoy" title="Pendientes Hoy">hoy <span id="hoyBadge" class="badge">...</span></button>
                  </div>

                </div><br><br><br>


                <table id="table_cronograma" class="table table-bordered">
                  <thead>
                    <tr id="tb_header">
                      <th>ACTIVIDADES</th>
                      <th>Frecuen cia</th>
                      <th>H Max</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr id="report_1">
                      <th>Envio de Dash board de KPI Contractuales</th>
                      <td>Lunes</td>
                      <td>18:00</td>    
                    </tr>
                    <tr id="report_2">
                      <th>Envio Reporte ON AIR </th>
                      <td>Diario</td>
                      <td>10:00</td>    
                    </tr>
                    <tr id="report_3">
                      <th>Envio reporte ON AIR-Comentarios</th>
                      <td>Diario</td>
                      <td>12:00</td>    
                    </tr>
                    <tr id="report_4">
                      <th>Reporte tareas Remedy</th>
                      <td>Diario</td>
                      <td>18:00</td>    
                    </tr>
                    <tr id="report_5">
                      <th>Reporte KPI-ALARMAS-PRODUCCION depues del medio dia</th>
                      <td>Miercoles</td>
                      <td>18:00</td>    
                    </tr>
                    <tr id="report_6">
                      <th>Reporte escalados O&M depues del medio dia</th>
                      <td>Martes</td>
                      <td>10:00</td>    
                    </tr>
                    <tr id="report_7">
                      <th>Reporte Reubicaciones depues del medio dia</th>
                      <td>Martes</td>
                      <td>10:00</td>    
                    </tr>
                    <tr id="report_8">
                      <th>Reporte P&D  depues del medio dia </th>
                      <td>Martes</td>
                      <td>18:00</td>    
                    </tr>
                    <tr id="report_9">
                      <th>Reporte de gestion ACS Despues del medio dia</th>
                      <td>Martes</td>
                      <td>18:00</td>    
                    </tr>
                    <tr id="report_10">
                      <th>Presentacion Gestion del proyecto ACS-ONAIR </th>
                      <td>Miercoles</td>
                      <td>18:00</td>    
                    </tr>
                    <tr id="report_11">
                      <th>Reporte tarea 53</th>
                      <td>Viernes</td>
                      <td>18:00</td>    
                    </tr>
                    <tr id="report_12">
                      <th>Reporte de estado de tk generados antes de las 6:00 a.m</th>
                      <td>Diario</td>
                      <td>06:00</td>    
                    </tr>
                    <tr id="report_13">
                      <th>Reporte de sitios con afectacion de servicios antes de las 6:00 a.m</th>
                      <td>Diario</td>
                      <td>06:00</td>    
                    </tr>
                    <tr id="report_14">
                      <th>Reporte de sitios con degradacion de servicio antes de las 6:00 a.m</th>
                      <td>Diario</td>
                      <td>06:00</td>    
                    </tr>
                    <tr id="report_15">
                      <th>Reporte de revision de KPI noche antes de las 6:00 a.m</th>
                      <td>Diario</td>
                      <td>06:00</td>    
                    </tr>
                  </tbody>
                </table>
          </div>
          <div class="calendario" style="display: none; margin-top: 25px">
            <div class="col-sm-3 col-md-offset-4">
                      <button id="btn-cronograma" class="btn btn-primary">Cronograma</button>
            </div>
            <br>
            <div id='calendar'></div>
          </div>

        </div>
        <!--footer Section -->
        <div class="for-full-back" id="footer">
            Zolid By ZTE Colombia | All Right Reserved
        </div>
    <script src="<?= URL::to('assets/plugins/bootstrap/js/bootstrap.min.js') ?>" /></script>
    <script type="text/javascript">var baseurl = "<?php echo URL::base(); ?>";</script>


    <script src="<?= URL::to("assets/plugins/sweetalert-master/sweetalert2.min.js") ?>" type="text/javascript"></script>
    <script src="<?= URL::to("assets/js/modules/cronograma/getCronograma.js") ?>" type="text/javascript"></script>
    <script src="<?= URL::to("assets/js/modules/cronograma/getCalendarDates.js") ?>" type="text/javascript"></script>
    </body>
</html>