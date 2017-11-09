<!DOCTYPE html>
<html lang="en">
    <?php $this->load->view('parts/generic/head'); ?>
    <body data-base="<?= URL::base() ?>">
        <?php $this->load->view('parts/generic/header'); ?>
        <div class="container autoheight">
            <div class='tab-content' id='tab3'><brt><br>
                    <div class="container">
                        <form class="well form-horizontal" action=" " method="post"  id="assignService" name="assignServie">
                            <legend>Escalar Actividad</legend>
                            <fieldset class="col-md-6 control-label">
                                <div class="form-group">
                                    <label for="txtAtribuibleNokia" class="col-md-3 control-label">Atribuible a nokia:</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-street-view"></i></span>
                                            <select class="form-control input-sm" name="" id="txtAtribuibleNokia" name="txtAtribuibleNokia">
                                                <option value="">Seleccione</option>
                                                <option value="1">SI</option>
                                                <option value="2">NO</option>
                                                <option value="3">NA</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="txtTimeEscalado" class="col-md-3 control-label">Time escalado:</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-calendar"></i></span>
                                            <input type='text' name="txtTimeEscalado" id="txtTimeEscalado" class="form-control" value='' placeholder="DD/MM/YYYY">
                                            <div class="input-group-btn"><button class="btn btn-default"><i class="fa fa-fw fa-calendar"></i></button></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="txtFechaEscalado" class="col-md-3 control-label">Fecha de escalado:</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-globe"></i></span>
                                            <input type='text' name="txtFechaEscalado" id="txtFechaEscalado" class="form-control" value='' >
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="txtContEscImp" class="col-md-3 control-label">Cont esc imp:</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-user"></i></span>
                                            <input type='text' name="txtContEscImp" id="txtContEscImp" class="form-control" value='' >
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="txtTimeEscImp" class="col-md-3 control-label">Time esc imp:</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-calendar"></i></span>
                                            <input type='text' name="txtTimeEscImp" id="txtTimeEscImp" class="form-control" value='' >
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="txtContEscRF" class="col-md-3 control-label">Cont esc RF:</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-user"></i></span>
                                            <input type='text' name="txtContEscRF" id="txtContEscRF" class="form-control" value='' >
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="txtTimeEscRF" class="col-md-3 control-label">Time esc RF:</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-calendar"></i></span>
                                            <input type='text' name="txtTimeEscRF" id="txtTimeEscRF" class="form-control" value='' >
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="txtContEscNpo" class="col-md-3 control-label">Cont esc NPO:</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-user"></i></span>
                                            <input type='text' name="txtContEscNpo" id="txtContEscNpo" class="form-control" value='' >
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="txtTimeEscNpo" class="col-md-3 control-label">Time Esc NPO:</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-calendar"></i></span>
                                            <input type='text' name="txtContEscNpo" id="txtContEscNpo" class="form-control" value='' >
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="txtContEscCare" class="col-md-3 control-label">Cont esc care:</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-user"></i></span>
                                            <input type='text' name="txtContEscCare" id="txtContEscCare" class="form-control" value='' >
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="txtTimeEscCare" class="col-md-3 control-label">Time esc care:</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-calendar"></i></span>
                                            <input type='text' name="txtTimeEscCare" id="txtTimeEscCare" class="form-control" value='' >
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <!--  fin seccion izquierda form---->

                            <!--  inicio seccion derecha form---->
                            <fieldset>
                                <div class="form-group">
                                    <label for="txtContEscGDRT" class="col-md-3 control-label">Cont esc GDRT:</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-tablet"></i></span>
                                            <input type='text' name="txtContEscGDRT" id="txtContEscGDRT" class="form-control" value='' >
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="txtTimeEscGDRT" class="col-md-3 control-label">Time esc GDRT:</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-calendar"></i></span>
                                            <input type='text' name="txtTimeEscGDRT" id="txtTimeEscGDRT" class="form-control" value='' >
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="txtContEscOym" class="col-md-3 control-label">Cont esc OyM:</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-location-arrow"></i></span>
                                            <input type='text' name="txtContEscOym" id="txtContEscOym" class="form-control" value='' >
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="txtTimeEscOym" class="col-md-3 control-label">Time esc OyM:</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-calendarw"></i></span>
                                            <input type='text' name="txtTimeEscOym" id="txtTimeEscOym" class="form-control" value='' >
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="txtContEscCalidad" class="col-md-3 control-label">Cont esc calidad:</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-location-arrow"></i></span>
                                            <input type='text' name="txtContEscCalidad" id="txtContEscCalidad" class="form-control" value='' >
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="txtTimeEscCalidad" class="col-md-3 control-label">Time esc calidad:</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-calendar"></i></span>
                                            <input type='text' name="txtTimeEscCalidad" id="txtTimeEscCalidad" class="form-control" value='' >
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="txtAtribuibleNokia2" class="col-md-3 control-label">Atribuible a nokia 2:</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-location-arrow"></i></span>
                                            <select class="form-control" name="" id="txtAtribuibleNokia2" name="txtAtribuibleNokia2">
                                                <option value="">Seleccione</option>
                                                <option value="1">SI</option>
                                                <option value="2">NO</option>
                                                <option value="3">NA</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="txtAtribuibleNokia2" class="col-md-3 control-label">Tipificacion solucion:</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-location-arrow"></i></span>
                                            <input type='text' name="txtAtribuibleNokia2" id="txtAtribuibleNokia2" class="form-control" value='' >
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="txtAtribuibleNokia2" class="col-md-3 control-label">Detalle solucion:</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-location-arrow"></i></span>
                                            <input type='text' name="txtAtribuibleNokia2" id="txtAtribuibleNokia2" class="form-control" value='' >
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="txtUltimoSubestadoEscalamiento" class="col-md-3 control-label">Ultimo subestado de escalamiento:</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-location-arrow"></i></span>
                                            <input type='text' name="txtUltimoSubestadoEscalamiento" id="txtUltimoSubestadoEscalamiento" class="form-control" value='' >
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
                                        <button type="submit" id="btnAsignar" class="btn btn-success" onclick = "">Escalar <span class="fa fa-fw fa-user-plus"></span></button>
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
        <script src="<?= URL::to('assets/plugins/jquery.mask.js') ?>" type="text/javascript"></script>
        <script src="<?= URL::to('assets/js/modules/scaling.js') ?>" type="text/javascript"></script>
    </body>
</html>
