<style type="text/css">
    table td:nth-child(5){
        width: 180px;
        text-align: center;
        vertical-align: middle !important;
    }
</style>
<div class='tab-content contentPrincipal hidden' id='tab1'>
    <div class='container'>
        <form class= 'well form-horizontal' action='' method='post'  id='assignService' name='assignServie' enctype= 'multipart/form-data'>
            <fieldset>
                <div class="row">
                    <div class="col col-md-12 p-t-20">
                        <a class="btn btn-primary" href="<?= URL::to('User/createTicketOnair') ?>"><span class="fa fa-fw fa-plus-circle"></span>&nbsp;Nueva actividad</a>
                    </div>
                    <div class="col col-md-12">
                        <hr/>
                        <legend>Reinicios</legend>
                        <input type="hidden" value="<?= Auth::getRole() ?>" id="rol">
                        <table id="tablaReinicios" class="table table-hover table-condensed table-striped"></table>
                    </div>
                </div>
            </fieldset>
            <fieldset>
                <div class="row">
                    <div class="col col-md-12">
                        <hr/>
                        <legend>Prioritarios</legend>
                        <table id="tablaPrioritarios" class="table table-hover table-condensed table-striped"></table>
                    </div>
                </div>
            </fieldset>
            <fieldset>
                <div class="row">
                    <div class="col col-md-12">
                        <hr/>
                        <legend>Seguimiento</legend>
                        <table id="tablaPrincipal" class="table table-hover table-condensed table-striped"></table>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</div>
<?php $this->load->view('parts/generic/scripts'); ?>
<script type="text/javascript" src="<?= URL::to("assets/js/modules/principal/documentador.js") ?>"></script>
