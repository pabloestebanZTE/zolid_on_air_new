<!DOCTYPE html>
<html lang="en">
    <?php $this->load->view('parts/generic/head'); ?>
    <link rel="stylesheet" href="<?= URL::to('assets/css/styleAcsForm.css') ?>" />
    <body data-base="<?= URL::base() ?>">
        <?php $this->load->view('parts/generic/header'); ?>
        <div class="container autoheight p-t-20 m-t-20">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bhoechie-tab-container">
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 bhoechie-tab-menu">
                        <div class="list-group">
                            <a href="#" class="list-group-item active text-center">
                                <h4 class="glyphicon glyphicon-plane"></h4><br/>Creación de Ventanas
                            </a>
                            <a href="#" class="list-group-item text-center">
                                <h4 class="glyphicon glyphicon-road"></h4><br/>Apertura de VM
                            </a>
                            <a href="#" class="list-group-item text-center">
                                <h4 class="glyphicon glyphicon-home"></h4><br/>Punto de Control
                            </a>
                            <a href="#" class="list-group-item text-center">
                                <h4 class="glyphicon glyphicon-eye-open"></h4><br/>Cierre de VM
                            </a>
                            <!--                            <a href="#" class="list-group-item text-center">
                                                            <h4 class="glyphicon glyphicon-compressed"></h4><br/>Archivos
                                                        </a>-->
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 bhoechie-tab" id="formGlobalAcs" data-action="Acs/insertAcs" data-action-update="Acs/updateAcs">
                        <input type="hidden" id="idAcs" value="" />
                        <!-- creacion ventana section -->
                        <div class="bhoechie-tab-content active" id="contentTab1">
                            <center>
                                <form class="well form-horizontal" action="insertVmAcs" method="post" id="form1">
                                    <div class="alert alert-success alert-dismissable hidden">
                                        <a href="#" class="close" >&times;</a>
                                        <p class="p-b-0" id="text"></p>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label for="d_fecha_solicitud" class="col-md-3 control-label">Fecha de Solicitud:</label>
                                            <div class="col-sm-8">
                                                <input type='datetime-local' name="vm.d_fecha_solicitud" id="d_fecha_solicitud" class="form-control" data-callback='dom.formatDateForPrint' required >
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="i_id_site_access" class="col-md-3 control-label">ID Site Access :</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="vm.i_id_site_access" id="i_id_site_access" class="form-control control-change" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label for="k_id_station" class="col-md-3 control-label">Estación :</label>
                                            <div class="col-sm-8">
                                                <select class="form-control control-change selectpicker select-estacion" id="k_id_station" name="vm.k_id_station" required>
                                                    <option value="">Seleccione</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="k_id_technology" class="col-md-3 control-label">Tecnología:</label>
                                            <div class="col-sm-8">
                                                <select class="form-control control-change selectpicker select-tecnologia" id="k_id_technology" name="vm.k_id_technology" required>
                                                    <option value="">Seleccione</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label for="k_id_band" class="col-md-3 control-label">Banda :</label>
                                            <div class="col-sm-8">
                                                <select class="form-control control-change selectpicker select-banda" id="k_id_band" name="vm.k_id_band" required>
                                                    <option value="">Seleccione</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="k_id_work" class="col-md-3 control-label">Tipo de Trabajo :</label>
                                            <div class="col-sm-8">
                                                <select class="form-control control-change selectpicker select-tipotrabajo" id="k_id_work" name="vm.k_id_work" required>
                                                    <option value="">Seleccione</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label for="n_enteejecutor" class="col-md-3 control-label">Ente Ejecutor :</label>
                                            <div class="col-sm-8">
                                                <select class="form-control selectpicker" name="vm.n_enteejecutor" id="n_enteejecutor" required>
                                                    <option value="">Seleccione</option>
                                                    <option value="Claro" >Claro</option>
                                                    <option value="Nokia" >Nokia</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="n_persona_solicita" class="col-md-3 control-label">Persona que Solicita :</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="vm.n_persona_solicita" id="n_persona_solicita" class="form-control" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label for="n_nombre_grupo_skype" class="col-md-3 control-label">Nombre Grupo Skype :</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="vm.n_nombre_grupo_skype" id="n_nombre_grupo_skype" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="n_regional_skype" class="col-md-3 control-label">Regional Skype :</label>
                                            <div class="col-sm-8">
                                                <select class="form-control selectpicker" id="n_regional_skype" name="vm.n_regional_skype" required>
                                                    <option value="">Seleccione</option>
                                                    <option value="prueba1">prueba1</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label for="n_hora_apertura_grupo" class="col-md-3 control-label">Hora Apertura Grupo :</label>
                                            <div class="col-sm-8">
                                                <input type="time" name="vm.n_hora_apertura_grupo" id="n_hora_apertura_grupo" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="i_ingeniero_creador_grupo" class="col-md-3 control-label">Ingeniero Creador Grupo :</label>
                                            <div class="col-sm-8">
                                                <select class="form-control selectpicker select-ingeniero" id="i_ingeniero_creador_grupo" name="vm.i_ingeniero_creador_grupo" required>
                                                    <option value="">Seleccione</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="widget bg-gray text-left m-t-25 display-block">
                                        <h2 class="h4"><i class="fa fa-fw fa-check-square-o"></i> CheckList</h2>
                                        <p class="muted m-b-0">Por favor, verifique los procesos a continuación y complete el checklist según sea el caso.</p>
                                        <div class="widget bg-white">
                                            <div class="checkbox checkbox-primary text-left" id="productionList">
                                                <div class="display-block">
                                                    <input id="chk_p_1" name="vm.checklist[]" type="checkbox">
                                                    <label for="chk_p_1" class="text-bold">
                                                        ID site access Correcto.
                                                    </label>
                                                </div>
                                                <div class="display-block">
                                                    <input id="chk_p_2" name="vm.checklist[]" type="checkbox">
                                                    <label for="chk_p_2" class="text-bold">
                                                        CRQ Remedy Correcto.
                                                    </label>
                                                </div>
                                                <div class="display-block">
                                                    <input id="chk_p_3" name="vm.checklist[]"  type="checkbox">
                                                    <label for="chk_p_3" class="text-bold">
                                                        Snapshot Liviano UMTS.
                                                    </label>
                                                </div>
                                                <div class="display-block">
                                                    <input id="chk_p_4" name="vm.checklist[]"  type="checkbox">
                                                    <label for="chk_p_4" class="text-bold">
                                                        Log Alarmas historico UMTS.
                                                    </label>
                                                </div>
                                                <div class="display-block">
                                                    <input id="chk_p_5" name="vm.checklist[]"  type="checkbox">
                                                    <label for="chk_p_5" class="text-bold">
                                                        Reporte Radiante Pre.
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="display-block m-t-15">
                                                <label for="txtComentario" class="text-bold">
                                                    Comentario
                                                </label>
                                                <textarea class="form-control" id="txtComentario" name="vm.txtComentario"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Button -->
                                    <div>
                                        <div class="form-group">
                                            <label class="col-md-12 control-label"></label>
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-success" id="btnGenerarVm" data-update-text='<span class="fa fa-fw fa-floppy-o"></span>&nbsp;&nbsp;Actualizar Ventana'><span class="fa fa-fw fa-floppy-o"></span>&nbsp;&nbsp;Generar Ventana</button>
                                                <button type="button" class="btn btn-primary"><span class="fa fa-fw fa-times"></span>&nbsp;&nbsp;Escalar</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </center>
                        </div>

                        <!-- apertura VM section -->
                        <div class="bhoechie-tab-content" id="contentTab2">
                            <center>
                                <form class="well form-horizontal" action="insertAvmAcs" method="post" id="form2">
                                    <div class="alert alert-success alert-dismissable hidden">
                                        <a href="#" class="close" >&times;</a>
                                        <p class="p-b-0" id="text"></p>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label for="k_id_vm" class="col-sm-4 control-label">ID ZTE:</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control control-change" placeholder="000" name="vm.k_id_vm" disabled />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="k_id_station" class="col-sm-3 control-label"><span class="display-block">Estación:</span></label>
                                            <div class="col-sm-9">
                                                <select class="form-control select-estacion control-change" id="k_id_station" name="vm.k_id_station">
                                                    <option value="">Seleccione</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-6">
                                            <label for="k_id_technology" class="col-sm-4 control-label">Tecnología:</label>
                                            <div class="col-sm-8">
                                                <select class="form-control select-tecnologia control-change" id="k_id_technology" name="vm.k_id_technology">
                                                    <option value="">Seleccione</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="k_id_band" class="col-sm-3 control-label"><span class="display-block">Banda:</span></label>
                                            <div class="col-sm-9">
                                                <select class="form-control select-banda control-change" id="k_id_band" name="vm.k_id_band">
                                                    <option value="">Seleccione</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>                                    
                                    <div class="form-group p-l-10 p-r-10">
                                        <label for="k_id_work" class="col-sm-2 control-label">Tipo de trabajo:</label>
                                        <div class="col-sm-10 ">
                                            <select class="form-control select-tipotrabajo control-change" id="k_id_work" name="vm.k_id_work">
                                                <option value="">Seleccione</option>
                                            </select>
                                        </div>
                                    </div>    
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label for="n_estado_vm" class="col-sm-4 control-label">Estado VM:</label>
                                            <div class="col-sm-8">
                                                <select class="form-control control-change" id="n_estado_vm" name="vm.n_estado_vm">
                                                    <option value="">Seleccione</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="n_motivo_estado" class="col-sm-3 control-label"><span class="display-block">Motivo:</span></label>
                                            <div class="col-sm-9">
                                                <select class="form-control control-change" id="n_motivo_estado" name="vm.n_motivo_estado">
                                                    <option value="">Seleccione</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group p-l-10 p-r-10">
                                        <label for="i_ingeniero_apertura" class="col-sm-2 control-label">Ingeniero:</label>
                                        <div class="col-sm-10 ">
                                            <select class="form-control select-ingeniero" id="i_ingeniero_apertura" name="avm.i_ingeniero_apertura">
                                                <option value="">Seleccione</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="">
                                        <div class="bg-white widget bg-gray p-l-25 p-r-25">
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <label>DATOS SITE ACCESS:</label>
                                                    <input type="text" class="form-control control-change" id="i_id_site_access" name="vm.i_id_site_access"/>
                                                </div>
                                                <div class="col-md-7">
                                                    <div class="form-group">
                                                        <label class="col-md-5 text-right">Inicio Programado SA:</label>
                                                        <div class="col-md-7">
                                                            <input type="datetime-local" class="form-control" id="d_inicio_programado_sa" name="avm.d_inicio_programado_sa" data-callback='dom.formatDateForPrint'/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-b-0">
                                                        <label class="col-md-5 text-right">Fin Programado SA:</label>
                                                        <div class="col-md-7">
                                                            <input type="datetime-local" class="form-control" id="d_fin_programado_sa" name="avm.d_fin_programado_sa" data-callback='dom.formatDateForPrint'/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clearfix m-t-20"></div>
                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <label for="k_tecnologia_afectada" class="col-sm-4 control-label">Tecnologías Afectadas:</label>
                                                <div class="col-sm-8">
                                                    <select class="form-control select-tecnologia" id="k_tecnologia_afectada" name="avm.k_tecnologia_afectada">
                                                        <option value="">Seleccione</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="k_banda_afectada" class="col-sm-3 control-label">Bandas afectadas:</label>
                                                <div class="col-sm-9">
                                                    <select class="form-control select-banda" id="k_banda_afectada" name="avm.k_banda_afectada">
                                                        <option value="">Seleccione</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group p-l-10 p-r-10">
                                            <label for="n_persona_solicita_vmlc" class="col-sm-2 control-label text-right">Persona que solicita la VMLC:</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="n_persona_solicita_vmlc" name="avm.n_persona_solicita_vmlc"/>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <label for="n_fm_nokia" class="col-sm-4 control-label">FM Nokia:</label>
                                                <div class="col-sm-8">
                                                    <select class="form-control" id="n_fm_nokia" name="avm.n_fm_nokia">
                                                        <option value="">Seleccione</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="n_fm_claro" class="col-sm-3 control-label">FM Claro:</label>
                                                <div class="col-sm-9">
                                                    <select class="form-control" id="n_fm_claro" name="avm.n_fm_claro">
                                                        <option value="">Seleccione</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>                                           
                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <label for="i_telefono_fm" class="col-sm-4 control-label">Teléfono FM:</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="i_telefono_fm" name="avm.i_telefono_fm"/>
                                                </div>
                                            </div>    
                                            <div class="col-md-6">
                                                <label for="n_wp" class="col-sm-3 control-label">WP:</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="n_wp" name="avm.n_wp"/>
                                                </div>
                                            </div>
                                        </div>                                            
                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <label for="n_crq" class="col-sm-4 control-label">CRQ:</label>
                                                <div class="col-sm-8 ">
                                                    <input class="form-control" id="n_crq" name="avm.n_crq" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="n_id_rftools" class="col-sm-3 control-label">ID_RF TOOL:</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="n_id_rftools" name="avm.n_id_rftools"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <label for="n_bsc_name" class="col-sm-4 control-label">BSC_Name:</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="n_bsc_name" name="avm.n_bsc_name"/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="n_rnc_name" class="col-sm-3 control-label">RNC_Name:</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="n_rnc_name" />
                                                </div>
                                            </div>
                                        </div>                                            
                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <label for="n_servidor_mss" class="col-sm-4 control-label">Servidor MSS:</label>
                                                <div class="col-sm-8">
                                                    <select class="form-control" id="n_servidor_mss" name="avm.n_servidor_mss">
                                                        <option value="">Seleccione</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="n_regional_cluster" class="col-sm-3 control-label">Regional Cluster:</label>
                                                <div class="col-sm-9">
                                                    <select class="form-control" id="n_regional_cluster" name="avm.n_regional_cluster">
                                                        <option value="">Seleccione</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group p-l-10 p-r-10">
                                            <label for="n_integrador_backoffice" class="col-sm-2 control-label text-right">Integrador y/o Backoffice:</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="n_integrador_backoffice" name="avm.n_integrador_backoffice"/>
                                            </div>
                                        </div>
                                        <div class="form-group p-l-10 p-r-10">
                                            <label for="n_lider_cuadrilla_vm" class="col-sm-2 control-label text-right">Lider de cuadrilla VM:</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="n_lider_cuadrilla_vm" name="avm.n_lider_cuadrilla_vm"/>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <label for="i_telefono_lider_cuadrilla" class="col-sm-4 control-label">Teléfono Líder de Cuadrilla:</label>
                                                <div class="col-sm-8">
                                                    <input type="text" id="i_telefono_lider_cuadrilla" name="avm.i_telefono_lider_cuadrilla" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="b_vistamm" class="col-sm-4 control-label">VISTAS MM:</label>
                                                <div class="col-sm-8 ">
                                                    <select class="form-control" id="b_vistamm" name="avm.b_vistamm">
                                                        <option value="">Seleccione</option>
                                                        <option value="">SI</option>
                                                        <option value="">NO</option>
                                                        <option value="">N/A</option>
                                                    </select>
                                                </div>  
                                            </div>
                                        </div>                                        
                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <label for="n_hora_atencion_vm" class="col-sm-4 control-label">Hora Atención VM:</label>
                                                <div class="col-sm-8">
                                                    <input type="time" class="form-control" name="avm.n_hora_atencion_vm" id="n_hora_atencion_vm"/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="n_hora_inicio_real_vm" class="col-sm-4 control-label">Hora Inicio Real VM:</label>
                                                <div class="col-sm-8">
                                                    <input type="time" class="form-control" name="avm.n_hora_inicio_real_vm" id="n_hora_inicio_real_vm"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group p-l-10 p-r-10">
                                            <label for="n_contratista" class="col-sm-2 control-label">Contratista:</label>
                                            <div class="col-sm-10">
                                                <select name="avm." id="n_contratista" name="avm.n_contratista" class="form-control">
                                                    <option>Seleccione</option>
                                                </select>
                                            </div>
                                        </div>
                                        <!--CHECKLIST APERTURA-->
                                        <div class="widget bg-gray text-left m-t-25 display-block">
                                            <h2 class="h4"><i class="fa fa-fw fa-check-square-o"></i> CheckList</h2>
                                            <p class="muted m-b-0">Por favor, verifique los procesos a continuación y complete el checklist según sea el caso.</p>
                                            <div class="widget bg-white">
                                                <div class="checkbox checkbox-primary text-left" id="productionList">
                                                    <div class="display-block">
                                                        <input id="chk_p_6" name="avm.checklist[]" type="checkbox">
                                                        <label for="chk_p_6" class="text-bold">
                                                            Se crea word evidencias.
                                                        </label>
                                                    </div>
                                                    <div class="display-block">
                                                        <input id="chk_p_7" name="avm.checklist[]" type="checkbox">
                                                        <label for="chk_p_7" class="text-bold">
                                                            Se crea Excel Precheck.
                                                        </label>
                                                    </div>
                                                    <div class="display-block">
                                                        <input id="chk_p_8" name="avm.checklist[]" type="checkbox">
                                                        <label for="chk_p_8" class="text-bold">
                                                            Se crea solicitud ID Access.
                                                        </label>
                                                    </div>
                                                    <div class="display-block">
                                                        <input id="chk_p_9" name="avm.checklist[]" type="checkbox">
                                                        <label for="chk_p_9" class="text-bold">
                                                            Se adjunta documento excel (gestión de calidad).
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--FIN CHECK LIST APERTURA-->
                                    </div>
                                    <div>
                                        <div class="form-group">
                                            <label class="col-md-12 control-label"></label>
                                            <div class="col-md-12">
                                                <button type="submit" id="btnGenerarApertura" class="btn btn-success"  data-update-text='<span class="fa fa-fw fa-floppy-o"></span>&nbsp;&nbsp;Actualizar apertura' ><span class="fa fa-fw fa-floppy-o"></span>&nbsp;&nbsp;Generar apertura</button>
                                                <button type="button" class="btn btn-primary"><span class="fa fa-fw fa-times"></span>&nbsp;&nbsp;Escalar</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </center>
                        </div>

                        <!-- punto de control section -->
                        <div class="bhoechie-tab-content" id="contentTab3">
                            <center>
                                <form class="well form-horizontal" action="insertCheckPointAcs" method="post" id="form3">
                                    <div class="alert alert-success alert-dismissable hidden">
                                        <a href="#" class="close" >&times;</a>
                                        <p class="p-b-0" id="text"></p>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label for="cmbRiesgoId" class="col-sm-4 control-label">ID ZTE:</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="vm.k_id_vm" class="form-control control-change" placeholder="000" disabled="" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="k_id_station" class="col-sm-2 control-label"><span class="display-block">Estación:</span></label>
                                            <div class="col-sm-10">
                                                <select class="form-control select-estacion control-change" id="k_id_station" name="vm.k_id_station">
                                                    <option value="">Seleccione</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label for="k_id_technology" class="col-sm-4 control-label">Tecnología:</label>
                                            <div class="col-sm-8">
                                                <select class="form-control select-tecnologia control-change" id="k_id_technology" name="vm.k_id_technology">
                                                    <option value="">Seleccione</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="k_id_band" class="col-sm-2 control-label"><span class="display-block">Banda:</span></label>
                                            <div class="col-sm-10">
                                                <select class="form-control select-banda control-change" id="k_id_band" name="vm.k_id_band">
                                                    <option value="">Seleccione</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>                                    
                                    <div class="form-group">
                                        <label for="k_id_work" class="col-sm-2 control-label">Tipo de trabajo:</label>
                                        <div class="col-sm-10 p-r-30">
                                            <select class="form-control select-tipotrabajo" id="k_id_work" name="vm.k_id_work">
                                                <option value="">Seleccione</option>
                                            </select>
                                        </div>
                                    </div>    
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label for="n_estado_vm" class="col-sm-4 control-label">Estado VM:</label>
                                            <div class="col-sm-8">
                                                <select class="form-control control-change" id="n_estado_vm" name="vm.n_estado_vm">
                                                    <option value="">Seleccione</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="n_motivo_estado" class="col-sm-2 control-label"><span class="display-block">Motivo:</span></label>
                                            <div class="col-sm-10">
                                                <select class="form-control control-change" id="n_motivo_estado" name="vm.n_motivo_estado">
                                                    <option value="">Seleccione</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bg-white widget bg-gray p-t-5 p-b-5 p-l-5 p-r-5">
                                        <div class="clearfix m-t-20"></div>
                                        <div class="form-group">
                                            <label for="i_ingeniero_control" class="col-sm-4 control-label">Ingeniero Control:</label>
                                            <div class="col-sm-8 p-r-30">
                                                <select class="form-control select-ingeniero" id="i_ingeniero_control" name="vm.i_ingeniero_control">
                                                    <option value="">Seleccione</option>
                                                </select>
                                            </div>
                                        </div>    
                                        <div class="form-group">
                                            <label for="n_hora_revision" class="col-sm-4 control-label">Hora revisión:</label>
                                            <div class="col-sm-8 p-r-30">
                                                <input type="time" class="form-control" id="n_hora_revision" name="vm.n_hora_revision">
                                            </div>
                                        </div>    
                                        <div class="form-group">
                                            <label for="n_comentario_punto_control" class="col-sm-4 control-label">Comentario Punto de Control:</label>
                                            <div class="col-sm-8 p-r-30">
                                                <textarea class="form-control" id="n_comentario_punto_control" name="vm.n_comentario_punto_control"></textarea>
                                            </div>
                                        </div>    
                                    </div>
                                    <div>
                                        <div class="form-group">
                                            <label class="col-md-12 control-label"></label>
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-success" data-update-text='<span class="fa fa-fw fa-floppy-o"></span>&nbsp;&nbsp;Atualizar control'><span class="fa fa-fw fa-floppy-o"></span>&nbsp;&nbsp;Generar Control</button>
                                                <button type="button" class="btn btn-primary"><span class="fa fa-fw fa-times"></span>&nbsp;&nbsp;Escalar</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </center>
                        </div>
                        <!-- cierre VM section -->
                        <div class="bhoechie-tab-content" id="contentTab4">
                            <center>
                                <form class="well form-horizontal" action="insertCvmAcs" method="post" id="form4">
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label for="cmbRiesgoId" class="col-sm-4 control-label">ID ZTE:</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="vm.k_id_vm" class="form-control control-change" placeholder="000" disabled="" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="k_id_station" class="col-sm-3 control-label"><span class="display-block">Estación:</span></label>
                                            <div class="col-sm-9">
                                                <select class="form-control select-estacion control-change" id="k_id_station" name="vm.k_id_station">
                                                    <option value="">Seleccione</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-6">
                                            <label for="k_id_technology" class="col-sm-4 control-label">Tecnología:</label>
                                            <div class="col-sm-8">
                                                <select class="form-control select-tecnologia control-change" id="k_id_technology" name="vm.k_id_technology">
                                                    <option value="">Seleccione</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="k_id_band" class="col-sm-3 control-label"><span class="display-block">Banda:</span></label>
                                            <div class="col-sm-9">
                                                <select class="form-control select-banda control-change" id="k_id_band" name="vm.k_id_band">
                                                    <option value="">Seleccione</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>                                    
                                    <div class="form-group p-l-10 p-r-10">
                                        <label for="k_id_work" class="col-sm-2 control-label">Tipo de trabajo:</label>
                                        <div class="col-sm-10 ">
                                            <select class="form-control select-tipotrabajo control-change" id="k_id_work" name="vm.k_id_work">
                                                <option value="">Seleccione</option>
                                            </select>
                                        </div>
                                    </div>    
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label for="n_estado_vm" class="col-sm-4 control-label">Estado VM:</label>
                                            <div class="col-sm-8">
                                                <select class="form-control control-change" id="n_estado_vm" name="vm.n_estado_vm">
                                                    <option value="">Seleccione</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="n_motivo_estado" class="col-sm-3 control-label"><span class="display-block">Motivo:</span></label>
                                            <div class="col-sm-9">
                                                <select class="form-control control-change" id="n_motivo_estado" name="vm.n_motivo_estado">
                                                    <option value="">Seleccione</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label for="n_ret" class="col-sm-4 control-label">RET:</label>
                                            <div class="col-sm-8">
                                                <select class="form-control" id="n_ret" name="cvm.n_ret">
                                                    <option value="">Seleccione</option>
                                                    <option value="VERDADERO">VERDADERO</option>
                                                    <option value="FALSO">FALSO</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="n_ampliacion_dualbeam" class="col-sm-3 control-label"><span class="display-block">Ampliación Dualbeam:</span></label>
                                            <div class="col-sm-9">
                                                <select class="form-control" id="n_ampliacion_dualbeam" name="cvm.n_ampliacion_dualbeam">
                                                    <option value="">Seleccione</option>
                                                    <option value="VERDADERO">VERDADERO</option>
                                                    <option value="FALSO">FALSO</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label for="n_sectores_dualbeam" class="col-sm-4 control-label">Sectores Dualbeam:</label>
                                            <div class="col-sm-8">
                                                <select class="form-control" id="n_sectores_dualbeam" name="cvm.n_sectores_dualbeam">
                                                    <option value="">Seleccione</option>
                                                    <option value="VERDADERO">VERDADERO</option>
                                                    <option value="FALSO">FALSO</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="n_tipo_solucion" class="col-sm-3 control-label"><span class="display-block">Tipo de solución:</span></label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="cvm.n_tipo_solucion" id="n_tipo_solucion" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label for="i_telefono_lider_cambio" class="col-sm-4 control-label">Teléfono líder cambio:</label>
                                            <div class="col-sm-8">
                                                <input type="text" id="i_telefono_lider_cambio" name="cvm.i_telefono_lider_cambio" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="n_estado_vm_cierre" class="col-sm-3 control-label"><span class="display-block">Estado de VM:</span></label>
                                            <div class="col-sm-9">
                                                <select class="form-control" id="n_estado_vm_cierre" name="cvm.n_estado_vm_cierre">
                                                    <option value="">Seleccione</option>
                                                    <option value="Abierto">Abierto</option>
                                                    <option value="Cerrado">Cerrado</option>
                                                    <option value="N/A">N/A</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label for="n_sub_estado" class="col-sm-4 control-label">Sub-Estado:</label>
                                            <div class="col-sm-8">
                                                <select class="form-control" id="n_sub_estado" name="cvm.n_sub_estado">
                                                    <option value="">Seleccione</option>
                                                    <option value="Abierto">Abierto</option>
                                                    <option value="Cerrado">Cerrado</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="n_iniciar_vm_encontro" class="col-sm-3 control-label"><span class="display-block">Al iniciar VM se encontró:</span></label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="n_iniciar_vm_encontro" name="cvm.n_iniciar_vm_encontro"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label for="n_falla_final" class="col-sm-4 control-label">¿Presentó falla final?:</label>
                                            <div class="col-sm-8">
                                                <select class="form-control" id="n_falla_final" name="cvm.n_falla_final">
                                                    <option value="">Seleccione</option>
                                                    <option value="SI">SI</option>
                                                    <option value="NO">NO</option>
                                                    <option value="N/A">N/A</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="n_tipo_falla_final" class="col-sm-3 control-label"><span class="display-block">Tipo de Falla Final:</span></label>
                                            <div class="col-sm-9">
                                                <select class="form-control" id="n_tipo_falla_final" name="cvm.n_tipo_falla_final">
                                                    <option value="">Seleccione</option>
                                                    <option value="Rollback">Rollback</option>
                                                    <option value="N/A">N/A</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label for="b_vistamm" class="col-sm-4 control-label">VISTAS MM:</label>
                                            <div class="col-sm-8">
                                                <select class="form-control" id="b_vistamm" name="cvm.b_vistamm">
                                                    <option value="">Seleccione</option>
                                                    <option value="SI">SI</option>
                                                    <option value="NO">NO</option>
                                                    <option value="N/A">N/A</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="n_estado_notificacion" class="col-sm-3 control-label"><span class="display-block">Estado Notificación:</span></label>
                                            <div class="col-sm-9">
                                                <select class="form-control" id="n_estado_notificacion" name="cvm.n_estado_notificacion">
                                                    <option value="">Seleccione</option>
                                                    <option value="No notificable">No notificable</option>
                                                    <option value="Pendiente notificar">Pendiente notificar</option>
                                                    <option value="Actividad notificada">Actividad notificada</option>
                                                    <option value="N/A">N/A</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group p-l-10 p-r-10">
                                        <label for="i_ingeniero_cierre" class="col-sm-2 control-label">Ingeniero Cierre:</label>
                                        <div class="col-sm-10 ">
                                            <select class="form-control select-ingeniero" id="i_ingeniero_cierre" name="cvm.i_ingeniero_cierre">
                                                <option value="">Seleccione</option>
                                            </select>
                                        </div>
                                    </div>  
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label for="d_hora_atencion_cierre" class="col-sm-4 control-label">Hora de atención cierre:</label>
                                            <div class="col-sm-8">
                                                <input type="time" id="d_hora_atencion_cierre" name="cvm.d_hora_atencion_cierre" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="d_hora_cierre_confirmado" class="col-sm-3 control-label"><span class="display-block">Hora de cierre confirmado:</span></label>
                                            <div class="col-sm-9">
                                                <input type="time" class="form-control" id="d_hora_cierre_confirmado" name="cvm.d_hora_cierre_confirmado"/>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group p-l-10 p-r-10">                                        
                                        <label class="col-xs-12 text-left m-t-15" for="n_comentarios_cierre">Comentarios Cierre:</label>
                                        <div class="col-xs-12">
                                            <textarea class="form-control" placeholder="Comentario..." id="n_comentarios_cierre" name="cvm.n_comentarios_cierre"></textarea>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="form-group">
                                            <label class="col-md-12 control-label"></label>
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-success" data-update-text='<span class="fa fa-fw fa-floppy-o"></span>&nbsp;&nbsp;actualizar apertura'><span class="fa fa-fw fa-floppy-o"></span>&nbsp;&nbsp;Generar apertura</button>
                                                <button type="button" class="btn btn-primary"><span class="fa fa-fw fa-times"></span>&nbsp;&nbsp;Escalar</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </center>
                        </div>

                        <!--Historíco archivos-->
                        <div class="bhoechie-tab-content" id="contentTab5">
                            <div class="well m-b-0 p-t-5 p-b-5">
                                <h2 class="h3"><i class="fa fa-fw fa-file-zip-o"></i> Lista de archivos</h2>
                                <?php for ($i = 0; $i < 10; $i++) { ?>
                                    <div class="row content-wiget" >
                                        <div class="col-md-12 wiget" id="contentDetails_12h" style="min-height: 88px;"><div class="form-group row wiget-comment">
                                                <div class="col-md-4 wiget-list">
                                                    <div class="item-wiget">
                                                        <div class="icon-wiget"><i class="fa fa-fw fa-calendar"></i></div>
                                                        <div class="details-wiget">
                                                            <span class="title display-block">Fecha: </span>
                                                            <span class="text display-block" id="d_start">13/Dic/2017</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-5">
                                                    <p class="text-left m-all-0 p-all-0"><b class="display-block m-b-5">Nombre archivo:</b><span id="n_comentario"><a href="#" ><i class="fa fa-fw fa-download"></i> Archivo 1.0</a></span></p>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="icon-wiget-user"><i class="fa fa-fw fa-user"></i></div>
                                                    <div class="details-wiget">                     
                                                        <span class="muted m-l-10">Subido por:</span>
                                                        <span class="wiget-user-name display-block">GÓMEZ SIERRA  (JDG)</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <br>
        <!--footer Section -->
        <div class="for-full-back" id="footer">
            Zolid By ZTE Colombia | All Right Reserved
        </div>
        <?php $this->load->view('parts/generic/scripts'); ?>

        <!-- CUSTOM SCRIPT   -->
        <script type="text/javascript">
            var dataForm = <?php echo $respuesta; ?>;
        </script>
        <script src="<?= URL::to("assets/plugins/jquery.mask.js") ?>" type="text/javascript"></script>
        <script src="<?= URL::to("assets/plugins/jquery.validate.min.js") ?>" type="text/javascript"></script>
        <script src="<?= URL::to('assets/js/modules/acsForm.js') ?>" type="text/javascript"></script>
    </body>
</html>
