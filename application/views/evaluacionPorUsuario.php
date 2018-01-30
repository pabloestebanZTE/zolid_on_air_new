<!DOCTYPE html>
<html lang="en">
    <?php $this->load->view('parts/generic/head'); ?>
    <body data-base="<?= URL::base() ?>">
        <script type="text/javascript" >
            var stadistics = '<?= json_encode($stadistics); ?>';
        </script>
        <?php $this->load->view('parts/generic/header'); ?>
        <div class="container autoheight p-t-40">
            <div class="alert alert-success alert-dismissable hidden" id="principalAlert">
                <a href="#" class="close">&times;</a>
                <p id="text" class="m-b-0 p-b-0"></p>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <div class= 'form-horizontal' method='post'  id='assignService' name='assignServie' enctype='multipart/form-data'>
                        <fieldset class="panel panel-default">
                            <div class="panel-heading bg-white">
                                <h1 class="h3 m-all-0 m-b-5 text-capitalize"><span class=""><span class="text-muted"><i class="fa fa-fw fa-line-chart m-r-10"></i>Rendimiento:</span> <?= mb_strtolower($user->n_name_user . " " . $user->n_last_name_user) ?></span></h1>
                            </div>
                            <div class="panel-body bg-gray">
                                <div class="row contentPrincipal">                                
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 bhoechie-tab-menu">
                                            <div class="list-group">
                                                <a href="#" class="list-group-item active text-center">
                                                    <h4 class="fa fa-fw fa-calendar-o"></h4><br/>Hoy
                                                </a>
                                                <a href="#" class="list-group-item text-center">
                                                    <h4 class="fa fa-fw fa-line-chart"></h4><br/>Todo
                                                </a>
                                                <a href="#" class="list-group-item text-center">
                                                    <h4 class="fa fa-fw fa-check-square-o"></h4><br/>Precheck
                                                </a>
                                                <a href="#" class="list-group-item text-center">
                                                    <h4 class="fa fa-fw fa-clock-o"></h4><br/>PostCheck
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 bhoechie-tab bg-gray p-all-0">
                                            <!-- establecer contexto section -->
                                            <div class="bhoechie-tab-content active bg-gray p-all-0" id="contentTab0">
                                                <div class="ibox-content">
                                                    <div>                                
                                                        <h1 class="h4 m-all-0 m-b-15 text-normal"><i class="fa fa-fw fa-line-chart"></i> Rendimiento <strong>díario</strong> del usuario.</h1>
                                                        <small>Actividades ejecutadas a tiempo vs no ejecutadas a tiempo</small>
                                                    </div>
                                                    <div>
                                                        <canvas id="lineChart0" height="70"></canvas>
                                                    </div>
                                                    <div class="m-t-15 p-b-5">
                                                        <small class="pull-right">
                                                            <i class="fa fa-clock-o"> </i> 
                                                            Actualización del: <?= Hash::getDateForView() ?>
                                                        </small>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="bhoechie-tab-content bg-gray p-all-0" id="contentTab1">
                                                <div class="ibox-content">
                                                    <div>                                
                                                        <h1 class="h4 m-all-0 m-b-15 text-normal"><i class="fa fa-fw fa-line-chart"></i> Rendimiento <strong>mensual de todas las actividades</strong> del usuario.</h1>
                                                        <small>Actividades ejecutadas a tiempo vs no ejecutadas a tiempo</small>
                                                    </div>
                                                    <div>
                                                        <canvas id="lineChart" height="70"></canvas>
                                                    </div>
                                                    <div class="m-t-15 p-b-5">
                                                        <small class="pull-right">
                                                            <i class="fa fa-clock-o"> </i> 
                                                            Actualización del: <?= Hash::getDateForView() ?>
                                                        </small>
                                                    </div>

                                                </div>
                                            </div>

                                            <!-- identificar riesgos section -->
                                            <div class="bhoechie-tab-content bg-gray" id="contentTab2">
                                                <div class="ibox-content">
                                                    <div>                                
                                                        <h1 class="h4 m-all-0 m-b-15 text-normal"><i class="fa fa-fw fa-line-chart"></i> Rendimiento <strong>mensual de actividades precheck</strong> del usuario.</h1>
                                                        <small>Actividades ejecutadas a tiempo vs no ejecutadas a tiempo</small>
                                                    </div>
                                                    <div>
                                                        <canvas id="lineChart2" height="70"></canvas>
                                                    </div>
                                                    <div class="m-t-15 p-b-5">
                                                        <small class="pull-right">
                                                            <i class="fa fa-clock-o"> </i> 
                                                            Actualización del: <?= Hash::getDateForView() ?>
                                                        </small>
                                                    </div>

                                                </div>
                                            </div>

                                            <!-- analizar riegos section -->
                                            <div class="bhoechie-tab-content bg-gray" id="contentTab3">
                                                <div class="ibox-content">
                                                    <div>                                
                                                        <h1 class="h4 m-all-0 m-b-15 text-normal"><i class="fa fa-fw fa-line-chart"></i> Rendimiento <strong>mensual de actividades postcheck</strong> del usuario.</h1>
                                                        <small>Actividades ejecutadas a tiempo vs no ejecutadas a tiempo</small>
                                                    </div>
                                                    <div>
                                                        <canvas id="lineChart3" height="70"></canvas>
                                                    </div>
                                                    <div class="m-t-15 p-b-5">
                                                        <small class="pull-right">
                                                            <i class="fa fa-clock-o"> </i> 
                                                            Actualización del: <?= Hash::getDateForView() ?>
                                                        </small>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>                    
                                </div>
                            </div>                            
                        </fieldset>
                        <!--                        <fieldset class="well hidden">
                                                    <div class="col-xs-12">
                                                        <div class="display-block p-l-15 p-r-15">
                                                            <h2 class="h3 m-t-5 m-b-15"><i class="fa fa-fw fa-line-chart"></i> Estadísticas por usuario</h2>
                                                            <hr/>
                                                            <div class="display-block p-l-15 p-r-15">
                                                                <table id="tablaUsuarios" class="table table-hover table-condensed table-striped"></table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </fieldset>-->
                    </div>
                </div>
            </div>

        </div>
        <!--footer Section -->
        <div class="for-full-back" id="footer">
            Zolid By ZTE Colombia | All Right Reserved
        </div>        
        <!-- CUSTOM SCRIPT   -->
        <?php $this->load->view('parts/generic/scripts'); ?>
        <script scr="<?= URL::to("assets/plugins/sweetalert-master/dist/sweetalert.min.js") ?>" ></script>
        <script type="text/javascript" src="<?= URL::to("assets/plugins/charjs/js.js?v=1.0") ?>"></script>
        <script type="text/javascript" src="<?= URL::to("assets/js/modules/principal/evaluacion_individual.js?v=1.0") ?>"></script>
    </body>
</html>
