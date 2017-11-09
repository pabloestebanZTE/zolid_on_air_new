<div class='tab-content contentPrincipal hidden' id='tab1'>
    <div class='container'>
        <form class= 'well form-horizontal' action='' method='post'  id='assignService' name='assignServie' enctype= 'multipart/form-data'>
            <fieldset>
                <div class="row contentPrincipal hidden">
                    <div class="col col-md-12 p-t-40">
                        <input type="hidden" value="<?= Auth::getRole() ?>" id="rol">
                        <br/>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel with-nav-tabs panel-primary">
                                    <div class="panel-heading">
                                        <ul class="nav nav-tabs">
                                            <li class="active"><a href="#tab1default" data-toggle="tab">Pendientes</a></li>
                                            <li><a href="#tab2default" data-toggle="tab">Ya asignados</a></li>
                                        </ul>
                                    </div>
                                    <div class="panel-body">
                                        <div class="tab-content">
                                            <div class="tab-pane fade in active" id="tab1default">
                                                <h1 class="m-t-0">Pendientes para revisión</h1>
                                                <table id="tablaPendientes" class="table table-hover table-condensed table-striped"></table>
                                            </div>
                                            <div class="tab-pane fade" id="tab2default">
                                                <h1 class="m-t-0">Ya asignados</h1>
                                                <table id="tablaAsignados" class="table table-hover table-condensed table-striped"></table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br/>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</div>
<?php $this->load->view('parts/generic/scripts'); ?>
<script type="text/javascript" src="<?= URL::to("assets/js/modules/principal/coordinador.js") ?>"></script>