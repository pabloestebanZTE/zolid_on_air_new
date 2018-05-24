<style type="text/css">
    table td:nth-child(5){
        width: 160px;
        text-align: center;
        vertical-align: middle !important;
    }
</style>
<div class="panel with-nav-tabs panel-primary">
    <div class="panel-heading">
        <ul class="nav nav-tabs ">
            <li class="active"><a href="#tab_asignados" class="tab-tables" data-toggle="tab"><i class="fa fa-fw fa-tag"></i> Asignados</a></li>
            <li><a href="#tab_prioritarios" class="tab-tables" data-toggle="tab"><i class="fa fa-fw fa-star"></i> Prioritarios</a></li>
        </ul>
    </div>
    <div class="panel-body">
        <div class="tab-content">
            <div class="tab-pane fade in active" id="tab_asignados">
                <div class='contentPrincipal'>
                    <div class=''>
                        <form class= 'well form-horizontal' action='' method='post'  id='assignService' name='assignServie' enctype= 'multipart/form-data'>
                            <fieldset>
                                <div class="row">
                                    <div class="col col-md-12" style="text-align: right;">
                                        <a class="btn btn-primary" href="<?= URL::to('User/getAllTickets') ?>"><i class="fa fa-list" aria-hidden="true"></i>&nbsp;&nbsp;Ver todo</a>
                                    </div>
                                    <div class="col col-md-12 p-t-40">
                                        <input type="hidden" value="<?= Auth::getRole() ?>" id="rol">
                                        <table id="tablaPrincipal" class="table table-hover table-condensed table-striped" width="100%"></table>
                                        <br/>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="tab_prioritarios">
                <form class= 'well form-horizontal' action='' method='post'  id='assignService' name='assignServie' enctype= 'multipart/form-data'>
                    <fieldset>
                        <div class="row">
                            <div class="col col-md-12 p-t-40">
                                <table id="tablaPrioritarios" class="table table-hover table-condensed table-striped" width="100%"></table>
                                <br/>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>        
    </div>
</div>
<?php $this->load->view('parts/generic/scripts'); ?>
<script type="text/javascript" src="<?= URL::to("assets/js/modules/principal/ingeniero.js?v=1.1") ?>"></script>