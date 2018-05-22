<!DOCTYPE html>
<html lang="en">
    <?php $this->load->view('parts/generic/head'); ?>
    <link rel="stylesheet" href="<?= URL::to('assets/css/styleAcsForm.css') ?>" />
    <body data-base="<?= URL::base() ?>">
        <?php $this->load->view('parts/generic/header'); ?>
        <div class="container autoheight p-t-20 m-t-20">
            <div class="row">
                <div class="content-wrapper">
                    <!-- Content Header (Page header) -->
                    <section class="content-header p-t-0">
                        <h1>
                            PLANES DE MEJORA DETECTADOS
                            <small></small>
                        </h1>
                    </section>

                    <!-- Main content -->
                    <section class="content container-fluid p-t-0">
                        <div class="container autoheight">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bhoechie-tab-container">
                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 bhoechie-tab-menu">
                                        <div class="list-group">
                                            <a href="#" class="list-group-item active text-center">
                                                <h4 class="glyphicon glyphicon-file"></h4><br/>Descripción de la Acción
                                            </a>
                                            <a href="#" class="list-group-item text-center">
                                                <h4 class="glyphicon glyphicon-alert"></h4><br/>Analisis de Causa
                                            </a>
                                            <a href="#" class="list-group-item text-center">
                                                <h4 class="glyphicon glyphicon-list-alt"></h4><br/>Plan de Acción
                                            </a>
                                            <a href="#" class="list-group-item text-center">
                                                <h4 class="glyphicon glyphicon-bullhorn"></h4><br/>Verificación / Cierre de Acción
                                            </a>
                                            <a href="#" class="list-group-item text-center" id="contentAll">
                                                <h4 class="glyphicon glyphicon-eye-open"></h4><br/>Ver Todo
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9 bhoechie-tab" >
                                        <div id="formsRisk" data-action="Risk/insertRiskFull" data-action-update="Risk/updateRiskFull" >
                                            <input type="hidden" id="idRecord" value="<?= isset($_GET["id"]) ? $_GET["id"] : "" ?>" />

                                            <div class="bhoechie-tab-content active" id="contentTab1">
                                                <form class="content-center m-b-20 well form-horizontal" id="form1">
                                                    <h2 class="h4"><i class="fa fa-eye"></i> &nbsp; Registrar Acción</h2>
                                                    <div class="alert alert-success alert-dismissable hidden">
                                                        <a href="#" class="close" >&times;</a>
                                                        <p class="p-b-0" id="text"></p>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="codigoAccion" class="col-sm-2 control-label">Código</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control input-lg" id="codigoAccion" name="codigoAccion" >
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="fechaSolicitudAccion" class="col-sm-2 control-label">Fecha Solicitud de Acción</label>
                                                        <div class="col-sm-10">
                                                            <div class="input-group date">
                                                                <input type="text" class="form-control" id="fechaSolicitudAccion" name="fechaSolicitudAccion" ><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="prioridadAtencion" class="col-sm-2 control-label">Estatus de Acción</label>
                                                        <div class="col-sm-10">
                                                            <select class="form-control" id="prioridadAtencion" name="prioridadAtencion">
                                                                <option value="">Seleccione Estaus</option>
                                                                <option value="Abierta">Abierta</option>
                                                                <option value="Cerrada">Cerrada</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="tipoAccion" class="col-sm-2 control-label">Tipo de Acción</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control input-lg" id="tipoAccion" name="tipoAccion" >
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="sistemaDeGestion" class="col-sm-2 control-label">Sistema de Gestión</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control input-lg" id="sistemaDeGestion" name="sistemaDeGestion" >
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="consecutivoAccion" class="col-sm-2 control-label">Consecutivo Acción</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control input-lg" id="consecutivoAccion" name="consecutivoAccion" >
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="fechaElaboracionPlan" class="col-sm-2 control-label">Fecha Elaboración Plan</label>
                                                        <div class="col-sm-10">
                                                            <div class="input-group date">
                                                                <input type="text" class="form-control" id="fechaElaboracionPlan" name="fechaElaboracionPlan" ><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="reportanteAccion" class="col-sm-2 control-label">Reportante(s) de Acción</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control input-md" id="reportanteAccion" name="reportanteAccion" placeholder=" 1.">
                                                            <input class="form-control input-md" id="reportanteAccion" name="reportanteAccion" placeholder=" 2.">
                                                            <input class="form-control input-md" id="reportanteAccion" name="reportanteAccion" placeholder=" 3.">
                                                            <input class="form-control input-md" id="reportanteAccion" name="reportanteAccion" placeholder=" 4.">
                                                            <input class="form-control input-md" id="reportanteAccion" name="reportanteAccion" placeholder=" 5.">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="responsableAccion" class="col-sm-2 control-label">Responsable(s) de Acción</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control input-md" id="responsableAccion" name="responsableAccion" placeholder=" 1.">
                                                            <input class="form-control input-md" id="responsableAccion" name="responsableAccion" placeholder=" 2.">
                                                            <input class="form-control input-md" id="responsableAccion" name="responsableAccion" placeholder=" 3.">
                                                            <input class="form-control input-md" id="responsableAccion" name="responsableAccion" placeholder=" 4.">
                                                            <input class="form-control input-md" id="responsableAccion" name="responsableAccion" placeholder=" 5.">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="fuenteAccion" class="col-sm-2 control-label">Fuente de la Acción</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control input-md" id="fuenteAccion" name="fuenteAccion" >
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="descripcionHallazgo" class="col-sm-2 control-label">Descripción del Hallazgo</label>
                                                        <div class="col-sm-10">
                                                            <input class="form-control input-md" id="requisitoDescripcionHallazgo" name="requisitoDescripcionHallazgo" placeholder="Requisito en caso que aplique"><br>
                                                            <textarea name="descripcionHallazgo" class="form-control txt-plataforma" id="descripcionHallazgo " cols="6" rows="4" placeholder="Descripción del hallazgo u oportunidad de mejora" ></textarea>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- analizar riegos section -->
                                            <div class="bhoechie-tab-content" id="contentTab3">
                                                <form class="m-b-20 content-center well form-horizontal" id="form2">
                                                    <h2 class="h4"><i class="fa fa-dot-circle-o"></i> Análisis de Causa Raíz</h2>

                                                    <div class="form-group">
                                                        <label for="analisisCausa" class="col-sm-2 control-label">Causa</label>
                                                        <div class="col-sm-10">
                                                            <textarea name="analisisCausa" class="form-control txt-plataforma" id="analisisCausa" cols="4" rows="3" placeholder="Detalle las causas necesarias separadas por números"></textarea>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="analisisSubCausa" class="col-sm-2 control-label">SubCausa</label>
                                                        <div class="col-sm-10">
                                                            <textarea name="analisisSubCausa" class="form-control txt-plataforma" id="analisisSubCausa" cols="4" rows="3" placeholder="Detalle las causas necesarias separadas por números" ></textarea>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="analisisUltraCausa" class="col-sm-2 control-label">UltraCausa</label>
                                                        <div class="col-sm-10">
                                                            <textarea name="analisisUltraCausa" class="form-control txt-plataforma" id="analisisUltraCausa" cols="4" rows="3" placeholder="Detalle las causas necesarias separadas por números" ></textarea>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="conclusionAnalisisCausa" class="col-sm-2 control-label">Conclusión</label>
                                                        <div class="col-sm-10">
                                                            <textarea name="conclusionAnalisisCausa" class="form-control txt-plataforma" id="conclusionAnalisisCausa" cols="4" rows="3" placeholder="Causa raíz real principal"></textarea><br>
                                                            <input class="form-control input-md" id="categoriaAnalisisCausa" name="categoriaAnalisisCausa" placeholder="Categoría">
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <!-- escribe reporte de la actividad -->
                                            <div class="bhoechie-tab-content" id="contentTab2">
                                                <form class="content-center m-b-20 well form-horizontal" id="form3" >
                                                    <h2 class="h4"><i class="fa fa-dot-circle-o"></i> Acciones que permitiran desarrollar la oportunidad de mejora</h2>
                                                    <div class="alert alert-success alert-dismissable hidden">
                                                        <a href="#" class="close" >&times;</a>
                                                        <p class="p-b-0" id="text"></p>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="accionesDeMejora" class="col-sm-2 control-label">Acciones</label>
                                                        <div class="col-sm-10">
                                                            <textarea name="accionesDeMejora" class="form-control txt-plataforma" id="accionesDeMejora" cols="6" rows="4" placeholder="Detalle las acciones necesarias separadas por números"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="responsableAccionesDeMejora" class="col-sm-2 control-label">Responsable(s)</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control" id="responsableAccionesDeMejora" name="responsableAccionesDeMejora" >
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="tiempoSolucionMejora1" class="col-sm-2 control-label">Fecha</label>
                                                        <div class="col-sm-10 input-daterange input-group" id="tiempoSolucionMejora1">
                                                            <input type="text" class="input-sm form-control" name="fechaInicio" placeholder="Día inicio" />
                                                            <span class="input-group-addon">hasta</span>
                                                            <input type="text" class="input-sm form-control" name="fechaFin" placeholder="Día fin" />
                                                        </div>
                                                    </div>

                                                    <div class="form-group p-t-15">
                                                        <div class="col-xs-12">
                                                            <a type="submit" class="btn btn-primary" href="<?= URL::to('Reports_pdf/accionesMejora') ?>"><span class="fa fa-fw fa-floppy-o"></span>&nbsp;&nbsp;Generar Informe</a>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>

                                            <div class="bhoechie-tab-content" id="contentTab4">
                                                <form class="m-b-20 content-center well form-horizontal" id="form4">
                                                    <h2 class="h4"><i class="fa fa-fw fa-check-square-o"></i>Verificación de Acción de Mejora</h2>

                                                    <div class="form-group">
                                                        <label for="verificacionMejora" class="col-sm-2 control-label">Descripción</label>
                                                        <div class="col-sm-10">
                                                            <textarea name="verificacionMejora" class="form-control txt-plataforma" id="verificacionMejora" cols="6" rows="4" placeholder="Verificación de la eficacia de la acción"></textarea><br>
                                                            <input type="text" class="form-control" id="conceptoDeMejora" name="conceptoDeMejora" placeholder="Concepto">	
                                                        </div>
                                                    </div>

                                                    <h2 class="h4"><i class="fa fa-fw fa-check-square-o"></i>Cierre de Acción de Mejora</h2>

                                                    <div class="form-group">
                                                        <label for="fechaCierreTotal" class="col-sm-2 control-label">Fecha Cierre Total de Acción</label>
                                                        <div class="col-sm-10">
                                                            <div class="input-group date">
                                                                <input type="text" class="form-control" id="fechaCierreTotal" name="fechaCierreTotal" ><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="reportanteMejora" class="col-sm-2 control-label">Reportante</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control input-lg" id="reportanteMejora" name="reportanteMejora" placeholder="Nombre">
                                                            <input type="text" class="form-control input-lg" id="reportanteMejora" name="reportanteMejora" placeholder="Cargo">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="responsableMejora" class="col-sm-2 control-label">Responsable</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control input-lg" id="responsableMejora" name="responsableMejora" placeholder="Nombre">
                                                            <input type="text" class="form-control input-lg" id="responsableMejora" name="responsableMejora" placeholder="Cargo">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="evaluadorMejora" class="col-sm-2 control-label">Evaluador de Eficacia</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control input-lg" id="evaluadorMejora" name="evaluadorMejora" placeholder="Nombre">
                                                            <input type="text" class="form-control input-lg" id="evaluadorMejora" name="evaluadorMejora" placeholder="Cargo">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="coordinadorMejora" class="col-sm-2 control-label">Coordinador HSEQ</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" class="form-control input-lg" id="coordinadorMejora" name="coordinadorMejora" placeholder="Nombre">
                                                            <input type="text" class="form-control input-lg" id="coordinadorMejora" name="coordinadorMejora" placeholder="Cargo">
                                                        </div>
                                                    </div>

                                                    <div class="form-group p-t-15">
                                                        <div class="col-xs-12">
                                                            <a type="submit" class="btn btn-primary" href="<?= URL::to('Reports_pdf/accionesMejora') ?>"><span class="fa fa-fw fa-floppy-o"></span>&nbsp;&nbsp;Generar Informe</a>
                                                        </div>
                                                    </div>

                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- /.content -->
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
        <script src="<?= URL::to("assets/plugins/jquery.mask.js") ?>" type="text/javascript"></script>
        <script src="<?= URL::to("assets/plugins/jquery.validate.min.js") ?>" type="text/javascript"></script>
        
        <script src="<?= URL::to('assets/js/modules/planes-mejora.js?v=' . time()) ?>" type="text/javascript"></script>
    </body>
</html>