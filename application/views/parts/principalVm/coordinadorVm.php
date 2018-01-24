<div class="well">
    <a href="<?= URL::to("Acs/vmAcs") ?>" class="btn btn-primary"><i class="fa fa-fw fa-plus"></i> Nueva ventana</a>
    <hr/>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel with-nav-tabs panel-primary">
                <div class="panel-heading">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab1default" class="tab-tables" data-toggle="tab" ><i class="fa fa-fw fa-tag"></i> Apertura de VM</a></li>
                        <li><a href="#tab2default" class="tab-tables" data-toggle="tab" ><i class="fa fa-fw fa-tag"></i> Punto de Control</a></li>
                        <li><a href="#tab3default" class="tab-tables" data-toggle="tab" ><i class="fa fa-fw fa-tag"></i> Cierre de VM</a></li>
                        <li><a href="#tab4default" class="tab-tables" data-toggle="tab" ><i class="fa fa-fw fa-tag"></i> VM hoy</a></li>
                        <li><a href="#tab5default" class="tab-tables" data-toggle="tab"><i class="fa fa-fw fa-list-ul"></i> VM historico</a></li>
                    </ul>
                </div>
                <div class="panel-body">
                    <div class="tab-content">
                        <div class="tab-pane fade in active table-responsive min-h-300" id="tab1default">
                            <h1 class="m-t-0">Apertura de VM</h1>
                            <table id="tablaVmApertura" class="table table-hover table-condensed table-striped" width='100%'></table>
                        </div>
                        <div class="tab-pane table-responsive min-h-300" id="tab2default">
                            <h1 class="m-t-0">Punto de Control</h1>
                            <table id="tablaVmControl" class="table table-hover table-condensed table-striped" width='100%'></table>
                        </div>
                        <div class="tab-pane table-responsive min-h-300" id="tab3default">
                            <h1 class="m-t-0">Cierre de VM</h1>
                            <table id="tablaVmCierre" class="table table-hover table-condensed table-striped" width='100%'></table>
                        </div>
                        <div class="tab-pane table-responsive min-h-300" id="tab4default">
                            <h1 class="m-t-0">VM hoy</h1>
                            <table id="tablaVmHoy" class="table table-hover table-condensed table-striped" width='100%'></table>
                        </div>
                        <div class="tab-pane table-responsive min-h-300" id="tab5default">
                            <h1 class="m-t-0">VM historico</h1>
                            <table id="tablaVmHis" class="table table-hover table-condensed table-striped" width='100%'></table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--modal asignacion-->
<div id="modalChangeState" class="modal fade" role="dialog">
    <div class="modal-dialog modal-xs">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><i class="fa fa-fw fa-edit"></i> Asignar Ingeniero</h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal well" action="Acs/toAssign" id="assignForm">
                    <div class="alert alert-success alert-dismissable hidden">
                        <a href="#" class="close" >&times;</a>
                        <p class="p-b-0" id="text"></p>
                    </div>
                    <div class="form-group">
                        <label for="i_ingeniero_asignado_avm" class="col-sm-2 control-label">Apertura de VM</label>
                        <div class="col-sm-10">
                            <select id="i_ingeniero_asignado_avm" name="i_ingeniero_asignado_avm" class="form-control selectpicker select-ingeniero">
                                <option value="">Seleccione</option>
                            </select>
                            <input type="hidden" name="k_id_vm" id="k_id_vm">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="i_ingeniero_asignado_pvm" class="col-sm-2 control-label">Punto de Control</label>
                        <div class="col-sm-10">
                            <select id="i_ingeniero_asignado_pvm" name="i_ingeniero_asignado_pvm" class="form-control selectpicker select-ingeniero">
                                <option value="">Seleccione</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="i_ingeniero_asignado_cvm" class="col-sm-2 control-label">Cierre de VM</label>
                        <div class="col-sm-10">
                            <select id="i_ingeniero_asignado_cvm" name="i_ingeniero_asignado_cvm" class="form-control selectpicker select-ingeniero">
                                <option value="">Seleccione</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-success"><span class="fa fa-fw fa-floppy-o"></span>Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-fw fa-times"></i> Cerrar</button>
            </div>
        </div>

    </div>
</div>
<!--modal asignacion-->
<!-- CUSTOM SCRIPT   -->
<?php $this->load->view('parts/generic/scripts'); ?>
<script src="<?= URL::to("assets/plugins/jquery.validate.min.js") ?>" type="text/javascript"></script>
<script src="<?= URL::to("assets/js/modules/principalVm/coordinadorVm.js"); ?>" type = "text/javascript"></script>
<script>
    $(function () {
        var info = <?php echo $usuarios; ?>;
        console.log(info);
        dom.llenarCombo($('.select-ingeniero'), info.users.data, {text: ["n_name_user", "n_last_name_user"], value: "k_id_user"});
        dom.submit($('#assignForm'), function () {
                location.reload();
        }, false);
    });
</script>