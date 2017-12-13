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
                            <a href="#" class="list-group-item text-center">
                                <h4 class="glyphicon glyphicon-plane"></h4><br/>Creación de Ventanas
                            </a>
                            <a href="#" class="list-group-item text-center">
                                <h4 class="glyphicon glyphicon-road"></h4><br/>Apertura de VM
                            </a>
                            <a href="#" class="list-group-item text-center">
                                <h4 class="glyphicon glyphicon-home"></h4><br/>Punto de Control
                            </a>
                            <a class="list-group-item active text-center">
                                <h4 class="glyphicon glyphicon-eye-open"></h4><br/>Cierre de VM
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 bhoechie-tab">

                        <!-- creacion ventana section -->
                        <div class="bhoechie-tab-content" id="contentTab1">
                            <center>
                                <form class="well form-horizontal" action="TicketOnair/assignTicket" method="post"  id="assignEng" name="assignEng">
                                    <fieldset class="col-md-6 control-label">
                                        <div class="form-group">
                                            <label for="txtFechaSolicitud" class="col-md-3 control-label">Fecha de Solicitud:</label>
                                            <div class="col-md-8 selectContainer">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-fw fa-calendar"></i></span>
                                                    <input type='datetime-local' name="txtFechaSolicitud" id="txtFechaSolicitud" class="form-control" value='' readonly="false">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="cmbEstacion" class="col-md-3 control-label">Estacion:</label>
                                            <div class="col-md-8 selectContainer">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-fw fa-location-arrow"></i></span>
                                                    <select class="form-control selectpicker" id="cmbEstacion" name="cmbEstacion">
                                                        <option value="">Seleccione</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="cmbBanda" class="col-md-3 control-label">Banda:</label>
                                            <div class="col-md-8 selectContainer">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-fw fa-globe"></i></span>
                                                    <select class="form-control selectpicker" id="cmbBanda" name="cmbBanda">
                                                        <option value="">Seleccione</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="txtCiudad" class="col-md-3 control-label">Ente Ejecutor:</label>
                                            <div class="col-md-8 selectContainer">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-fw fa-address-book"></i></span>
                                                    <input type='text' name="txtEnte" id="txtEnte" class="form-control" value='' readonly="false">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="txtCiudad" class="col-md-3 control-label">CRQ:</label>
                                            <div class="col-md-8 selectContainer">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-fw fa-id-card"></i></span>
                                                    <input type='text' name="txtCRQ" id="txtCRQ" class="form-control" value='' readonly="false">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="txtCiudad" class="col-md-3 control-label">WP:</label>
                                            <div class="col-md-8 selectContainer">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-fw fa-id-card"></i></span>
                                                    <input type='text' name="txtWP" id="txtWP" class="form-control" value='' readonly="false">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="txtwbts" class="col-md-3 control-label">WBTS:</label>
                                            <div class="col-md-8 selectContainer">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-fw fa-drivers-license"></i></span>
                                                    <input type="text" name="n_bcf_wbts_id" id="n_bcf_wbts_id" class="form-control" value="" readonly="false">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="cbmIngeniero" class="col-md-3 control-label">Ingeniero:</label>
                                            <div class="col-md-8 selectContainer">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-fw fa-user"></i></span>
                                                    <select name="k_id_user" id="k_id_user" class="form-control selectpicker" required>
                                                        <option value="" >Seleccione el ingeniero</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <!--  fin seccion izquierda form---->

                                    <!--  inicio seccion derecha form---->
                                    <fieldset>
                                        <div class="form-group">
                                            <label for="txtIdSiteAccess" class="col-md-3 control-label">ID Site Access :</label>
                                            <div class="col-md-8 selectContainer">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-fw fa-tablet"></i></span>
                                                    <input type='text' name="txtIdSiteAccess" id="txtIdSiteAccess" class="form-control" value='' readonly="false">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="cmbTecnologia" class="col-md-3 control-label">Tecnologia:</label>
                                            <div class="col-md-8 selectContainer">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-fw fa-briefcase"></i></span>
                                                    <select class="form-control selectpicker" id="cmbTecnologia" name="cmbTecnologia">
                                                        <option value="">Seleccione</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="cmbTipoTrabajo" class="col-md-3 control-label">Tipo de Trabajo:</label>
                                            <div class="col-md-8 selectContainer">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-fw fa-signal"></i></span>
                                                    <select class="form-control selectpicker" id="cmbTipoTrabajo" name="cmbTipoTrabajo">
                                                        <option value="">Seleccione</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="txtCiudad" class="col-md-3 control-label">Fecha Ingreso On-Air:</label>
                                            <div class="col-md-8 selectContainer">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-fw fa-calendar-o"></i></span>
                                                    <input type='text' name="txtFecha" id="txtFecha" class="form-control" value='' readonly="false">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="txtCiudad" class="col-md-3 control-label">Estado:</label>
                                            <div class="col-md-8 selectContainer">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-fw fa-thumbs-o-up"></i></span>
                                                    <input type='text' name="txtEstado" id="txtEstado" class="form-control" value='' readonly="false">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label for="txtCiudad" class="col-md-3 control-label">Subestado:</label>
                                            <div class="col-md-8 selectContainer">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="fa fa-fw fa-thumbs-o-up"></i></span>
                                                    <input type='text' name="txtSubestado" id="txtSubestado" class="form-control" value='' readonly="false">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Observaciones de Creación</label>
                                            <div class="col-md-8 inputGroupContainer">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
                                                    <textarea class="form-control" name="n_comentario_doc" id="n_comentario_doc" placeholder="Observaciones Creación" readonly="false"></textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-3 control-label">Observaciones de Asignación</label>
                                            <div class="col-md-8 inputGroupContainer">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
                                                    <textarea class="form-control" name="n_comentario_coor" id="n_comentario_coor" placeholder="Observaciones Coordinador"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <input type='hidden' name="k_id_ticket" id="k_id_ticket" class="form-control" value='' readonly="false">

                                    <!--   fin seccion derecha---->

                                    <!-- Button -->
                                    <center>
                                        <div class="form-group">
                                            <label class="col-md-12 control-label"></label>
                                            <div class="col-md-12">
                                                <button type="submit" id="btnAsignar" class="btn btn-success" onclick = "">Asignar <span class="fa fa-fw fa-user-plus"></span></button>
                                            </div>
                                        </div>
                                    </center>
                                </form>
                            </center>
                        </div>

                        <!-- apertura VM section -->
                        <div class="bhoechie-tab-content" id="contentTab2">
                            <center>
                                <form class="well form-horizontal" action="" method="post">
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label for="cmbRiesgoId" class="col-sm-4 control-label">ID ZTE:</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" placeholder="000" disabled="" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="cmbRiesgoId" class="col-sm-3 control-label"><span class="display-block">Estación:</span></label>
                                            <div class="col-sm-9">
                                                <select class="form-control" id="cmbRiesgoId" name="cmbRiesgoId">
                                                    <option value="">Seleccione</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-6">
                                            <label for="cmbRiesgoId" class="col-sm-4 control-label">Tecnología:</label>
                                            <div class="col-sm-8">
                                                <select class="form-control" id="cmbRiesgoId" name="cmbRiesgoId">
                                                    <option value="">Seleccione</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="cmbRiesgoId" class="col-sm-3 control-label"><span class="display-block">Banda:</span></label>
                                            <div class="col-sm-9">
                                                <select class="form-control" id="cmbRiesgoId" name="cmbRiesgoId">
                                                    <option value="">Seleccione</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>                                    
                                    <div class="form-group p-l-10 p-r-10">
                                        <label for="cmbFactorRiesgo" class="col-sm-2 control-label">Tipo de trabajo:</label>
                                        <div class="col-sm-10 ">
                                            <select class="form-control" id="cmbFactorRiesgo" name="cmbFactorRiesgo">
                                                <option value="">Seleccione</option>
                                            </select>
                                        </div>
                                    </div>    
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label for="cmbRiesgoId" class="col-sm-4 control-label">Estado VM:</label>
                                            <div class="col-sm-8">
                                                <select class="form-control" id="cmbRiesgoId" name="cmbRiesgoId">
                                                    <option value="">Seleccione</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="cmbRiesgoId" class="col-sm-3 control-label"><span class="display-block">Motivo:</span></label>
                                            <div class="col-sm-9">
                                                <select class="form-control" id="cmbRiesgoId" name="cmbRiesgoId">
                                                    <option value="">Seleccione</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group p-l-10 p-r-10">
                                        <label for="cmbFactorRiesgo" class="col-sm-2 control-label">Ingeniero:</label>
                                        <div class="col-sm-10 ">
                                            <select class="form-control" id="cmbFactorRiesgo" name="cmbFactorRiesgo">
                                                <option value="">Seleccione</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="">
                                        <div class="bg-white widget bg-gray p-l-25 p-r-25">
                                            <div class="row">
                                                <div class="col-md-5">
                                                    <label>DATOS SITE ACCESS:</label>
                                                    <input type="text" class="form-control" value="12341324"/>
                                                </div>
                                                <div class="col-md-7">
                                                    <div class="form-group">
                                                        <label class="col-md-5 text-right">Inicio Programado SA:</label>
                                                        <div class="col-md-7">
                                                            <input type="datetime-local" class="form-control" />
                                                        </div>
                                                    </div>
                                                    <div class="form-group m-b-0">
                                                        <label class="col-md-5 text-right">Fin Programado SA:</label>
                                                        <div class="col-md-7">
                                                            <input type="datetime-local" class="form-control" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clearfix m-t-20"></div>
                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <label for="cmbTecnologiasAfectadas" class="col-sm-4 control-label">Tecnologías Afectadas:</label>
                                                <div class="col-sm-8">
                                                    <select class="form-control" id="cmbTecnologiasAfectadas" name="cmbFactorRiesgo">
                                                        <option value="">Seleccione</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="cmbBandasAfectadas" class="col-sm-3 control-label">Bandas afectadas:</label>
                                                <div class="col-sm-9">
                                                    <select class="form-control" id="cmbBandasAfectadas">
                                                        <option value="">Seleccione</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group p-l-10 p-r-10">
                                            <label for="txtPersonaQueSolicitaLaVMLC" class="col-sm-2 control-label text-right">Persona que solicita la VMLC:</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="txtPersonaQueSolicitaLaVMLC" />
                                            </div>
                                        </div>
                                        <!--                                        <div class="form-group">
                                                                                    <label for="cmbEnteEjecutor" class="col-sm-4 control-label">Ente Ejecutor:</label>
                                                                                    <div class="col-sm-8 ">
                                                                                        <select class="form-control" id="cmbEnteEjecutor" name="cmbEnteEjecutor">
                                                                                            <option value="">Seleccione</option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>    -->
                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <label for="cmbFMNokia" class="col-sm-4 control-label">FM Nokia:</label>
                                                <div class="col-sm-8">
                                                    <select class="form-control" id="cmbFMNokia" name="cmbFMNokia">
                                                        <option value="">Seleccione</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="cmbFMClaro" class="col-sm-3 control-label">FM Claro:</label>
                                                <div class="col-sm-9">
                                                    <select class="form-control" id="cmbFMClaro" name="cmbFMClaro">
                                                        <option value="">Seleccione</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>                                           
                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <label for="txtTelefonoFM" class="col-sm-4 control-label">Teléfono FM:</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="txtTelefonoFM" />
                                                </div>
                                            </div>    
                                            <div class="col-md-6">
                                                <label for="txtWP" class="col-sm-3 control-label">WP:</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="txtWP" />
                                                </div>
                                            </div>
                                        </div>                                            
                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <label for="txtCRQ" class="col-sm-4 control-label">CRQ:</label>
                                                <div class="col-sm-8 ">
                                                    <input class="form-control" id="txtCRQ" name="txtCRQ" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="txtIDRFTOOL" class="col-sm-3 control-label">ID_RF TOOL:</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="txtIDRFTOOL" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <label for="txtbsc_name" class="col-sm-4 control-label">BSC_Name:</label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" id="txtbsc_name" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="txtRNCName" class="col-sm-3 control-label">RNC_Name:</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="txtRNCName" />
                                                </div>
                                            </div>
                                        </div>                                            
                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <label for="cmbFactorRiesgo" class="col-sm-4 control-label">Servidor MSS:</label>
                                                <div class="col-sm-8">
                                                    <select class="form-control" id="cmbFactorRiesgo" name="cmbFactorRiesgo">
                                                        <option value="">Seleccione</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="cmbFactorRiesgo" class="col-sm-3 control-label">Regional Cluster:</label>
                                                <div class="col-sm-9">
                                                    <select class="form-control" id="cmbFactorRiesgo" name="cmbFactorRiesgo">
                                                        <option value="">Seleccione</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group p-l-10 p-r-10">
                                            <label for="txtIntegradorBackoffice" class="col-sm-2 control-label text-right">Integrador y/o Backoffice:</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="txtIntegradorBackoffice" />
                                            </div>
                                        </div>
                                        <div class="form-group p-l-10 p-r-10">
                                            <label for="txtLiderCuadrillaVM" class="col-sm-2 control-label text-right">Lider de cuadrilla VM:</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="txtLiderCuadrillaVM" />
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-md-6">
                                                <label for="txtTelefonoLiderCuadrilla" class="col-sm-4 control-label">Teléfono Líder de Cuadrilla:</label>
                                                <div class="col-sm-8">
                                                    <input type="text" id="txtTelefonoLiderCuadrilla" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="cmbVistasMM" class="col-sm-4 control-label">VISTAS MM:</label>
                                                <div class="col-sm-8 ">
                                                    <select class="form-control" id="cmbVistasMM" name="cmbVistasMM">
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
                                                <label for="cmbFactorRiesgo" class="col-sm-4 control-label">Hora Atención VM:</label>
                                                <div class="col-sm-8">
                                                    <input type="datetime" class="form-control" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="cmbFactorRiesgo" class="col-sm-4 control-label">Hora Inicio Real VM:</label>
                                                <div class="col-sm-8">
                                                    <input type="datetime" class="form-control" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group p-l-10 p-r-10">
                                            <label for="cmbContratista" class="col-sm-2 control-label">Contratista:</label>
                                            <div class="col-sm-10">
                                                <select name="" id="cmbContratista" class="form-control">
                                                    <option>Seleccione</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10 text-left ">
                                            <hr/>
                                            <button type="submit" class="btn btn-primary"><span class="fa fa-fw fa-floppy-o"></span>&nbsp;&nbsp;Generar apertura</button>
                                        </div>
                                    </div>
                                </form>
                            </center>
                        </div>

                        <!-- punto de control section -->
                        <div class="bhoechie-tab-content" id="contentTab3">
                            <center>
                                <!--<div class="row form-md">-->
                                <form class="well form-horizontal" action="" method="post">
                                    <div id="contenedorControles">
                                        <div class="form-inline form-group" >
                                            <label for="cmbControles" class="col-sm-2 control-label">Control</label>
                                            <div class="col-sm-10">
                                                <select class="form-control" id="cmbControles" name="cmbControles[]" style="width: 93%;">
                                                    <option value="">Seleccione</option>
                                                </select>
                                                <button type="button" class="btn btn-success" onclick="AgregarControles()"><i class="fa fa-plus" aria-hidden="true"></i></button>
                                            </div>
                                        </div>
                                    </div>

                                </form>
                                <!--</div>-->
                            </center>
                        </div>

                        <!-- cierre VM section -->
                        <div class="bhoechie-tab-content active" id="contentTab4">
                            <center>
                                <form class="well form-horizontal" action="" method="post">
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label for="cmbRiesgoId" class="col-sm-4 control-label">ID ZTE:</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" placeholder="000" disabled="" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="cmbRiesgoId" class="col-sm-3 control-label"><span class="display-block">Estación:</span></label>
                                            <div class="col-sm-9">
                                                <select class="form-control" id="cmbRiesgoId" name="cmbRiesgoId">
                                                    <option value="">Seleccione</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-6">
                                            <label for="cmbRiesgoId" class="col-sm-4 control-label">Tecnología:</label>
                                            <div class="col-sm-8">
                                                <select class="form-control" id="cmbRiesgoId" name="cmbRiesgoId">
                                                    <option value="">Seleccione</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="cmbRiesgoId" class="col-sm-3 control-label"><span class="display-block">Banda:</span></label>
                                            <div class="col-sm-9">
                                                <select class="form-control" id="cmbRiesgoId" name="cmbRiesgoId">
                                                    <option value="">Seleccione</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>                                    
                                    <div class="form-group p-l-10 p-r-10">
                                        <label for="cmbFactorRiesgo" class="col-sm-2 control-label">Tipo de trabajo:</label>
                                        <div class="col-sm-10 ">
                                            <select class="form-control" id="cmbFactorRiesgo" name="cmbFactorRiesgo">
                                                <option value="">Seleccione</option>
                                            </select>
                                        </div>
                                    </div>    
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label for="cmbRiesgoId" class="col-sm-4 control-label">Estado VM:</label>
                                            <div class="col-sm-8">
                                                <select class="form-control" id="cmbRiesgoId" name="cmbRiesgoId">
                                                    <option value="">Seleccione</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="cmbRiesgoId" class="col-sm-3 control-label"><span class="display-block">Motivo:</span></label>
                                            <div class="col-sm-9">
                                                <select class="form-control" id="cmbRiesgoId" name="cmbRiesgoId">
                                                    <option value="">Seleccione</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label for="cmbRiesgoId" class="col-sm-4 control-label">RET:</label>
                                            <div class="col-sm-8">
                                                <select class="form-control" id="cmbRiesgoId" name="cmbRiesgoId">
                                                    <option value="">Seleccione</option>
                                                    <option value="">VERDADERO</option>
                                                    <option value="">FALSO</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="cmbRiesgoId" class="col-sm-3 control-label"><span class="display-block">Ampliación Dualbeam:</span></label>
                                            <div class="col-sm-9">
                                                <select class="form-control" id="cmbRiesgoId" name="cmbRiesgoId">
                                                    <option value="">Seleccione</option>
                                                    <option value="">VERDADERO</option>
                                                    <option value="">FALSO</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label for="cmbRiesgoId" class="col-sm-4 control-label">Sectores Dualbeam:</label>
                                            <div class="col-sm-8">
                                                <select class="form-control" id="cmbRiesgoId" name="cmbRiesgoId">
                                                    <option value="">Seleccione</option>
                                                    <option value="">VERDADERO</option>
                                                    <option value="">FALSO</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="cmbRiesgoId" class="col-sm-3 control-label"><span class="display-block">Tipo de solución:</span></label>
                                            <div class="col-sm-9">
                                                <select class="form-control" id="cmbRiesgoId" name="cmbRiesgoId">
                                                    <option value="">Seleccione</option>
                                                    <option value="">N/A</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label for="cmbRiesgoId" class="col-sm-4 control-label">Teléfono líder cambio:</label>
                                            <div class="col-sm-8">
                                                <input type="text" id="txtTelefonoLiderCambio" class="form-control" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="cmbRiesgoId" class="col-sm-3 control-label"><span class="display-block">Estado de VM:</span></label>
                                            <div class="col-sm-9">
                                                <select class="form-control" id="cmbRiesgoId" name="cmbRiesgoId">
                                                    <option value="">Seleccione</option>
                                                    <option value="">Abierto</option>
                                                    <option value="">Cerrado</option>
                                                    <option value="">N/A</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label for="cmbSubEstado" class="col-sm-4 control-label">Sub-Estado:</label>
                                            <div class="col-sm-8">
                                                <select class="form-control" id="cmbSubEstado">
                                                    <option>Seleccione</option>
                                                    <option>Abierto</option>
                                                    <option>Cerrado</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="txtAlIniciarVMSeEncontro" class="col-sm-3 control-label"><span class="display-block">Al iniciar VM se encontró:</span></label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="txtAlIniciarVMSeEncontro" />
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label for="cmbRiesgoId" class="col-sm-4 control-label">¿Presentó falla final?:</label>
                                            <div class="col-sm-8">
                                                <select class="form-control" id="cmbRiesgoId" name="cmbRiesgoId">
                                                    <option value="">Seleccione</option>
                                                    <option value="">SI</option>
                                                    <option value="">NO</option>
                                                    <option value="">N/A</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="cmbRiesgoId" class="col-sm-3 control-label"><span class="display-block">Tipo de Falla Final:</span></label>
                                            <div class="col-sm-9">
                                                <select class="form-control" id="cmbRiesgoId" name="cmbRiesgoId">
                                                    <option value="">Seleccione</option>
                                                    <option value="">Rollback</option>
                                                    <option value="">N/A</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label for="cmbRiesgoId" class="col-sm-4 control-label">VISTAS MM:</label>
                                            <div class="col-sm-8">
                                                <select class="form-control" id="cmbRiesgoId" name="cmbRiesgoId">
                                                    <option value="">Seleccione</option>
                                                    <option value="">SI</option>
                                                    <option value="">NO</option>
                                                    <option value="">N/A</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="cmbRiesgoId" class="col-sm-3 control-label"><span class="display-block">Estado Notificación:</span></label>
                                            <div class="col-sm-9">
                                                <select class="form-control" id="cmbRiesgoId" name="cmbRiesgoId">
                                                    <option value="">Seleccione</option>
                                                    <option value="">N/A</option>
                                                </select>
                                            </div>
                                        </div>

                                    </div>


                                    <div class="form-group p-l-10 p-r-10">
                                        <label for="cmbFactorRiesgo" class="col-sm-2 control-label">Ingeniero Cierre:</label>
                                        <div class="col-sm-10 ">
                                            <select class="form-control" id="cmbFactorRiesgo" name="cmbFactorRiesgo">
                                                <option value="">Seleccione</option>
                                            </select>
                                        </div>
                                    </div>  


                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label for="cmbSubEstado" class="col-sm-4 control-label">Hora de atención cierre:</label>
                                            <div class="col-sm-8">
                                                <input type="text" id="txtHoraAtencionCierre" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="txtAlIniciarVMSeEncontro" class="col-sm-3 control-label"><span class="display-block">Hora de cierre confirmado:</span></label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" id="txtAlIniciarVMSeEncontro" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group p-l-10 p-r-10">                                        
                                        <label class="col-xs-12 text-left m-t-15" for="txtcomentarioCierre">Comentarios Cierre:</label>
                                        <div class="col-xs-12">
                                            <textarea class="form-control" placeholder="Comentario..." id="txtcomentarioCierre"></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-offset-2 col-sm-10 text-left ">
                                            <hr/>
                                            <button type="submit" class="btn btn-primary"><span class="fa fa-fw fa-floppy-o"></span>&nbsp;&nbsp;Generar apertura</button>
                                        </div>
                                    </div>
                                </form>
                            </center>
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
        <script src="<?= URL::to('assets/js/modules/acsForm.js') ?>" type="text/javascript"></script>
    </body>
</html>
