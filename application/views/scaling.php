<!DOCTYPE html>
<html lang="en">
    <?php $this->load->view('parts/generic/head'); ?>
    <body data-base="<?= URL::base() ?>">
        <?php $this->load->view('parts/generic/header'); ?>
        <div class="container autoheight">
            <div class='tab-content' id='tab3'><brt><br>
                    <div class="container">
                        <form class="well form-horizontal" action="TicketOnair/createScaling" method="post"  id="createScaling" name="createScaling">
                            <legend>Escalar Actividad</legend>
                            <fieldset class="col-md-6 control-label">
                                <div class="form-group">
                                    <label for="txtAtribuibleNokia" class="col-md-3 control-label">Atribuible a nokia:</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-street-view"></i></span>
                                            <select class="form-control input-sm" id="n_atribuible_nokia" name="n_atribuible_nokia">
                                                <option value="">Seleccione</option>
                                                <option value="SI">SI</option>
                                                <option value="NO">NO</option>
                                                <option value="NA">NA</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="txtFechaEscalado" class="col-md-3 control-label">Fecha de escalado:</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-calendar"></i></span>
                                            <input type='datetime-local' name="d_fecha_escalado" id="d_fecha_escalado" class="form-control" value='' placeholder="DD/MM/YYYY">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="txtAtribuibleNokia2" class="col-md-3 control-label">Tipificacion solucion:</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-location-arrow"></i></span>
                                            <input type='text' name="n_tipificacion_solucion" id="n_tipificacion_solucion" class="form-control" value='' >
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="txtUltimoSubestadoEscalamiento" class="col-md-3 control-label">Ultimo subestado de escalamiento:</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-location-arrow"></i></span>
                                            <input type='text' name="n_ultimo_subestado_de_escalamiento" id="n_ultimo_subestado_de_escalamiento" class="form-control" value='' >
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="txtKpi1" class="col-md-3 control-label">KPI 1:</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-location-arrow"></i></span>
                                            <input type='text' name="n_kpi1" id="n_kpi1" class="form-control" value='' >
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="txtKpi2" class="col-md-3 control-label">KPI 2:</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-location-arrow"></i></span>
                                            <input type='text' name="n_kpi2" id="n_kpi2" class="form-control" value='' >
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="txtKpi3" class="col-md-3 control-label">KPI 3:</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-location-arrow"></i></span>
                                            <input type='text' name="n_kpi3" id="n_kpi3" class="form-control" value='' >
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="txtKpi4" class="col-md-3 control-label">KPI 4:</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-location-arrow"></i></span>
                                            <input type='text' name="n_kpi4" id="n_kpi4" class="form-control" value='' >
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="txtAlarma1" class="col-md-3 control-label">Alarma 1:</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-location-arrow"></i></span>
                                            <input type='text' name="n_alarma1" id="n_alarma1" class="form-control" value='' >
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="txtAlarma3" class="col-md-3 control-label">Alarma 3:</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-location-arrow"></i></span>
                                            <input type='text' name="n_alarma3" id="n_alarma3" class="form-control" value='' >
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <!--  fin seccion izquierda form parte superior---->

                            <!--  inicio seccion derecha form parte superior---->
                            <fieldset>
                                <div class="form-group">
                                    <label for="txtTimeEscalado" class="col-md-3 control-label">Time escalado:</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-globe"></i></span>
                                            <input type='datetime-local' name="d_time_escalado" id="d_time_escalado" class="form-control" value='' >
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="txtAtribuibleNokia2" class="col-md-3 control-label">Atribuible a nokia 2:</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-location-arrow"></i></span>
                                            <select class="form-control" id="n_atribuible_nokia2" name="n_atribuible_nokia2">
                                                <option value="">Seleccione</option>
                                                <option value="SI">SI</option>
                                                <option value="NO">NO</option>
                                                <option value="NA">NA</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="txtAtribuibleNokia2" class="col-md-3 control-label">Detalle solucion:</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-location-arrow"></i></span>
                                            <input type='text' name="n_detalle_solucion" id="n_detalle_solucion" class="form-control" value='' >
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group" style="height: 100px;"></div>

                                <div class="form-group">
                                    <label for="txtValorKpi1" class="col-md-3 control-label">Valor KPI 1:</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-location-arrow"></i></span>
                                            <input type='text' name="i_valor_kpi1" id="i_valor_kpi1" class="form-control" value='' >
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="txtValorKpi2" class="col-md-3 control-label">Valor KPI 2:</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-location-arrow"></i></span>
                                            <input type='text' name="i_valor_kpi2" id="i_valor_kpi2" class="form-control" value='' >
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="txtValorKpi3" class="col-md-3 control-label">Valor KPI 3:</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-location-arrow"></i></span>
                                            <input type='text' name="i_valor_kpi3" id="i_valor_kpi3" class="form-control" value='' >
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="txtValorKpi4" class="col-md-3 control-label">Valor KPI 4:</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-location-arrow"></i></span>
                                            <input type='text' name="i_valor_kpi4" id="i_valor_kpi4" class="form-control" value='' >
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="txtAlarma2" class="col-md-3 control-label">Alarma 2:</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-location-arrow"></i></span>
                                            <input type='text' name="n_alarma2" id="n_alarma2" class="form-control" value='' >
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="txtAlarma4" class="col-md-3 control-label">Alarma 4:</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-location-arrow"></i></span>
                                            <input type='text' name="n_alarma4" id="n_alarma4" class="form-control" value='' >
                                        </div>
                                    </div>
                                </div>
                                <input type='hidden' name="k_id_onair" id="k_id_onair" class="form-control" value="<?= $_GET['id']; ?>" >
                            </fieldset>
                            <!--   fin seccion derecha parte superior---->
                            
                            <!--  inicio seccion derecha form parte media---->
                            <legend>&nbsp;&nbsp;</legend>
                            <fieldset class="col-md-6 control-label">
                                <div class="form-group">
                                    <label for="txtContEscImp" class="col-md-3 control-label">Cont esc imp:</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-user"></i></span>
                                            <input type='text' name="i_cont_esc_imp" id="i_cont_esc_imp" class="form-control" value='' disabled>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="txtContEscRF" class="col-md-3 control-label">Cont esc RF:</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-user"></i></span>
                                            <input type='text' name="i_cont_esc_rf" id="i_cont_esc_rf" class="form-control" value='' disabled>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="txtContEscNpo" class="col-md-3 control-label">Cont esc NPO:</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-user"></i></span>
                                            <input type='text' name="cont_esc_npo" id="cont_esc_npo" class="form-control" value='' disabled>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="txtContEscCare" class="col-md-3 control-label">Cont esc care:</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-user"></i></span>
                                            <input type='text' name="cont_esc_care" id="cont_esc_care" class="form-control" value='' disabled>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="txtContEscOym" class="col-md-3 control-label">Cont esc OyM:</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-location-arrow"></i></span>
                                            <input type='text' name="i_cont_esc_oym" id="i_cont_esc_oym" class="form-control" value='' disabled>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="txtContEscGDRT" class="col-md-3 control-label">Cont esc GDRT:</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-tablet"></i></span>
                                            <input type='text' name="i_cont_esc_gdrt" id="i_cont_esc_gdrt" class="form-control" value='' disabled>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="txtContEscCalidad" class="col-md-3 control-label">Cont esc calidad:</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-location-arrow"></i></span>
                                            <input type='text' name="cont_esc_calidad" id="cont_esc_calidad" class="form-control" value='' disabled>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <!--  fin seccion izquierda form parte media---->

                            <!--  inicio seccion derecha form parte media---->
                            <fieldset>
                                <div class="form-group">
                                    <label for="txtTimeEscImp" class="col-md-3 control-label">Time esc imp:</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-calendar"></i></span>
                                            <input type='text' name="time_esc_imp" id="time_esc_imp" class="form-control" value='' disabled>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="txtTimeEscRF" class="col-md-3 control-label">Time esc RF:</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-calendar"></i></span>
                                            <input type='text' name="i_time_esc_rf" id="i_time_esc_rf" class="form-control" value='' disabled>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="txtTimeEscNpo" class="col-md-3 control-label">Time Esc NPO:</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-calendar"></i></span>
                                            <input type='text' name="i_time_esc_npo" id="i_time_esc_npo" class="form-control" value='' disabled>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="txtTimeEscCare" class="col-md-3 control-label">Time esc care:</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-calendar"></i></span>
                                            <input type='text' name="i_time_esc_care" id="i_time_esc_care" class="form-control" value='' disabled>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="txtTimeEscOym" class="col-md-3 control-label">Time esc OyM:</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-calendar"></i></span>
                                            <input type='text' name="time_esc_oym" id="time_esc_oym" class="form-control" value='' disabled>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label for="txtTimeEscGdrt" class="col-md-3 control-label">Time Esc GDRT:</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-calendar"></i></span>
                                            <input type='text' name="i_time_esc_gdrt" id="i_time_esc_gdrt" class="form-control" value='' disabled>
                                        </div>
                                    </div>
                                </div>
                                

                                <div class="form-group">
                                    <label for="txtTimeEscCalidad" class="col-md-3 control-label">Time esc calidad:</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-calendar"></i></span>
                                            <input type='text' name="i_time_esc_calidad" id="i_time_esc_calidad" class="form-control" value='' disabled>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <!--  fin seccion derecha form parte media---->
                            
                            <!--  inicio seccion derecha form parte baja---->
                            <legend>&nbsp;&nbsp;</legend>
                            <fieldset class="col-md-6 control-label">
                                <div class="form-group">
                                    <label for="cmbEstado" class="col-md-3 control-label">Estado:</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-location-arrow"></i></span>
                                            <select class="form-control" id="status" name=k_id_status" onchange="editSubstatus()" required>
                                                <option value="">Seleccione</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <!--  fin seccion izquierda form parte baja---->

                            <!--  inicio seccion derecha form parte baja---->
                            <fieldset>
                                <div class="form-group">
                                    <label for="cmbSubEstado" class="col-md-3 control-label">Subestado:</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-location-arrow"></i></span>
                                            <select class="form-control" id="substatus" name="k_id_status_onair" required>
                                                <option value="">Seleccione</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <!--  fin seccion derecha form parte baja---->

                            <!-- Button -->
                            <center>
                                <div class="form-group">
                                    <label class="col-md-12 control-label"></label>
                                    <div class="col-md-12">
                                        <button type="button" id="btnAsignar" class="btn btn-success" onclick = "confirmar()">Escalar <span class="fa fa-fw fa-user-plus"></span></button>
                                    </div>
                                </div>
                            </center>
                        </form>
                    </div>
            </div>
        </div>
        <!--footer Section -->
        <div class="for-full-back" id="footer">        
            Zolid By ZTE Colombia | All Right Reserved
        </div>
        <?php $this->load->view('parts/generic/scripts'); ?>
        <!-- CUSTOM SCRIPT   -->
        <script src="<?= URL::to('assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js?v=1') ?>" type="text/javascript"></script>
        <script>
          $(function () {
            var items = <?php echo $items; ?>;
            console.log(items);
            
            for (var j = 0; j < items.status.data.length; j++){
                if (items.status.data[j].k_id_status === '3' || items.status.data[j].k_id_status === '4' || items.status.data[j].k_id_status === '5' || items.status.data[j].k_id_status === '6' || items.status.data[j].k_id_status === '7') {
                    $('#status').append($('<option>', {
                        value: items.status.data[j].k_id_status,
                        text: items.status.data[j].n_name_status
                    }));
                }
              
            }
            
            $('#createScaling').fillForm(items);

            $('#n_atribuible_nokia option[value="'+items.scaledOnair.n_atribuible_nokia+'"]').attr('selected', 'selected');
             // $('input[name=d_time_escalado]').val(items.scaledOnair.d_time_escalado);
             // $('input[name=d_fecha_escalado]').val(items.scaledOnair.d_fecha_escalado);
            $('input[name=i_cont_esc_imp]').val(items.scaledOnair.i_cont_esc_imp);
            $('input[name=time_esc_imp]').val(items.scaledOnair.time_esc_imp);
            $('input[name=i_cont_esc_rf]').val(items.scaledOnair.i_cont_esc_rf);
            $('input[name=i_time_esc_rf]').val(items.scaledOnair.i_time_esc_rf);
            $('input[name=cont_esc_npo]').val(items.scaledOnair.cont_esc_npo);
            $('input[name=i_time_esc_npo]').val(items.scaledOnair.i_time_esc_npo);
            $('input[name=cont_esc_care]').val(items.scaledOnair.cont_esc_care);
            $('input[name=i_time_esc_care]').val(items.scaledOnair.i_time_esc_care);
            $('input[name=i_cont_esc_gdrt]').val(items.scaledOnair.i_cont_esc_gdrt);
            $('input[name=i_time_esc_gdrt]').val(items.scaledOnair.i_time_esc_gdrt);
            $('input[name=i_cont_esc_oym]').val(items.scaledOnair.i_cont_esc_oym);
            $('input[name=time_esc_oym]').val(items.scaledOnair.time_esc_oym);
            $('input[name=cont_esc_calidad]').val(items.scaledOnair.cont_esc_calidad);
            $('input[name=i_time_esc_calidad]').val(items.scaledOnair.i_time_esc_calidad);
            $('#n_atribuible_nokia2 option[value="'+items.scaledOnair.n_atribuible_nokia2+'"]').attr('selected', 'selected');
            $('input[name=n_tipificacion_solucion]').val(items.scaledOnair.n_tipificacion_solucion);
            $('input[name=n_detalle_solucion]').val(items.scaledOnair.n_detalle_solucion);
            $('input[name=n_ultimo_subestado_de_escalamiento]').val(items.scaledOnair.n_ultimo_subestado_de_escalamiento);
          });
          
          function editSubstatus(){
            var status = $( "#status" ).val();
            console.log(status);
            var info = <?php echo $items; ?>;
            $('#substatus').empty();
            for (var j = 0; j < info.statusOnAir.data.length; j++){
              if(status === info.statusOnAir.data[j].k_id_status){
                  $('#substatus').append($('<option>', {
                      value: info.statusOnAir.data[j].k_id_status_onair,
                      text: info.statusOnAir.data[j].n_name_substatus
                  }));
              }
            }
          }
          
          function confirmar(){
            swal({
                title: "¿Está seguro que desea escalar el ticket?",
                icon: "warning",
                buttons: {
                    cancel: "Cancelar",
                    confirm: "Confirmar",
                },
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    dom.submitDirect($('#createScaling'),null, false);
                }
            });
          }
        </script>

        <script src="<?= URL::to('assets/plugins/jquery.mask.js') ?>" type="text/javascript"></script>
        <script src="<?= URL::to('assets/js/modules/scaling.js') ?>" type="text/javascript"></script>
        <script src="<?= URL::to("assets/plugins/jquery.validate.min.js") ?>" type="text/javascript"></script>
        <script src="<?= URL::to("assets/plugins/HelperForm.js") ?>" type="text/javascript"></script>
        <script type="text/javascript">
        $(function(){
        })
        // , function(){location.href = app.urlTo('User/principalView');}
        </script>
    </body>
</html>
