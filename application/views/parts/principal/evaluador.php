<style type="text/css">
    body{
        background: #f3f3f4;
    }
    h1{
        font-weight: 100;
    }
    h1, h2, h3{
        color: #676a6c !important;
    }    
    .contentPrincipal .list-group-item .fa{
        font-size: 20px;
    }
    .list-group-item{
        border-right: 0px !important;
    }
    table td:nth-child(1){
        width: 150px;
        text-align: center;
        vertical-align: middle !important;
    }
    table td:nth-child(2){
        width: 150px;
        text-align: center;
        vertical-align: middle !important;
    }
    table td:nth-child(5){
        width: 200px;
        text-align: center;
        vertical-align: middle !important;
    }
</style>
<script type="text/javascript">
    var stadistics = '<?= json_encode($stadistics); ?>';
</script>

<div class='tab-content contentPrincipal' id='tab1'>
    <div class=''>
        <div class= 'form-horizontal' method='post'  id='assignService' name='assignServie' enctype='multipart/form-data'>
            <fieldset class="well">
                <div class="row contentPrincipal">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 bhoechie-tab-menu">
                            <div class="list-group">
                                <a href="#" class="list-group-item active text-center">
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
                            <div class="bhoechie-tab-content active bg-gray p-all-0" id="contentTab1">
                                <div class="ibox-content">
                                    <div>                                
                                        <h1 class="h4 m-all-0 m-b-15 text-normal"><i class="fa fa-fw fa-line-chart"></i> Rendimiento mensual de <strong>todas las actividades</strong>.</h1>
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
                                        <h1 class="h4 m-all-0 m-b-15 text-normal"><i class="fa fa-fw fa-line-chart"></i> Rendimiento mensual de <strong>actividades precheck</strong>.</h1>
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
                                        <h1 class="h4 m-all-0 m-b-15 text-normal"><i class="fa fa-fw fa-line-chart"></i> Rendimiento mensual de <strong>actividades postcheck</strong>.</h1>
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
            </fieldset>
            <fieldset class="well">
                <div class="col-xs-12">
                    <div class="display-block p-l-15 p-r-15">
                        <h2 class="h3 m-t-5 m-b-15"><i class="fa fa-fw fa-line-chart"></i> Estadísticas por usuario</h2>
                        <hr/>
                        <div class="display-block p-l-15 p-r-15">
                            <table id="tablaUsuarios" class="table table-hover table-condensed table-striped"></table>
                        </div>
                    </div>
                </div>
            </fieldset>
        </div>
    </div>
</div>
<?php $this->load->view('parts/generic/scripts'); ?>
<script type="text/javascript" src="<?= URL::to("assets/plugins/charjs/js.js?v=1.0") ?>"></script>
<script type="text/javascript" src="<?= URL::to("assets/js/modules/principal/evaluador.js?v=1.0") ?>"></script>