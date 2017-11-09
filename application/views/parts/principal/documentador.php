<div class='tab-content contentPrincipal hidden' id='tab1'>
    <div class='container'>
        <form class= 'well form-horizontal' action='' method='post'  id='assignService' name='assignServie' enctype= 'multipart/form-data'>
            <fieldset>
                <div class="row">
                    <div class="col col-md-12 p-t-20">
                        <a class="btn btn-primary" href="<?= URL::to('User/createTicketOnair') ?>"><span class="fa fa-fw fa-plus-circle"></span>&nbsp;</a>
                    </div>
                    <div class="col col-md-12">
                        <hr/>
                        <input type="hidden" value="<?= Auth::getRole() ?>" id="rol">
                        <table id="tablaPrincipal" class="table table-hover table-condensed table-striped"></table>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</div>
<?php $this->load->view('parts/generic/scripts'); ?>
<script type="text/javascript" src="<?= URL::to("assets/js/modules/principal/documentador.js") ?>"></script>