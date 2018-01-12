<div class='tab-content contentPrincipal hidden' id='tab1'>
    <div class='container'>
        <form class= 'well form-horizontal' action='' method='post'  id='assignService' name='assignServie' enctype= 'multipart/form-data'>
            <fieldset>
                <div class="row">
                    <div class="col col-md-12 p-t-40">
                        <h1 class="m-t-0">VM asignadas</h1><hr>
                        <input type="hidden" value="<?= Auth::getRole() ?>" id="rol">
                        <table id="tablaAsignaciones" class="table table-hover table-condensed table-striped"></table>
                        <br/>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</div>
<?php $this->load->view('parts/generic/scripts'); ?>
<script type="text/javascript" src="<?= URL::to("assets/js/modules/principalVm/ingenieroVm.js") ?>"></script>