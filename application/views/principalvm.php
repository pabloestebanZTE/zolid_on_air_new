<!DOCTYPE html>
<html lang="en">
    <?php $this->load->view('parts/generic/head'); ?>
    <body data-base="<?= URL::base() ?>">
        <?php $this->load->view('parts/generic/header'); ?>
        <div class="container autoheight p-t-20 m-t-20">
            <div class="alert alert-success alert-dismissable hidden" id="principalAlert">
                <a href="#" class="close">&times;</a>
                <p id="text" class="m-b-0 p-b-0"></p>
            </div>
            <div class="well">
                <a href="<?= URL::to("Acs/vmAcs") ?>" class="btn btn-primary"><i class="fa fa-fw fa-plus"></i> Nueva ventana</a>
                <hr/>
                <div class="clearfix"></div>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="table-responsive min-h-300">
                            <table id="tablaVm" class="table table-hover table-condensed table-striped" width='100%'></table>
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
                        <form class="form-horizontal well">
                            <div class="form-group">
                                <label for="i_ingeniero_asignado_vm" class="col-sm-2 control-label">Creación de Ventanas</label>
                                <div class="col-sm-10">
                                    <select id="i_ingeniero_asignado_vm" name="i_ingeniero_asignado_vm" class="form-control selectpicker select-ingeniero">
                                        <option value="">Seleccione</option>
                                    </select>
                                    <input type="hidden" name="k_id_vm" id="k_id_vm">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="i_ingeniero_asignado_avm" class="col-sm-2 control-label">Apertura de VM</label>
                                <div class="col-sm-10">
                                    <select id="i_ingeniero_asignado_avm" name="i_ingeniero_asignado_avm" class="form-control selectpicker select-ingeniero">
                                        <option value="">Seleccione</option>
                                    </select>
                                    <input type="hidden" name="k_id_avm" id="k_id_avm">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="i_ingeniero_asignado_pvm" class="col-sm-2 control-label">Punto de Control</label>
                                <div class="col-sm-10">
                                    <select id="i_ingeniero_asignado_pvm" name="i_ingeniero_asignado_pvm" class="form-control selectpicker select-ingeniero">
                                        <option value="">Seleccione</option>
                                    </select>
                                    <input type="hidden" name="k_id_pvm" id="k_id_pvm">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="i_ingeniero_asignado_cvm" class="col-sm-2 control-label">Cierre de VM</label>
                                <div class="col-sm-10">
                                    <select id="i_ingeniero_asignado_cvm" name="i_ingeniero_asignado_cvm" class="form-control selectpicker select-ingeniero">
                                        <option value="">Seleccione</option>
                                    </select>
                                    <input type="hidden" name="k_id_cvm" id="k_id_cvm">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                    <button type="button" class="btn btn-success"><span class="fa fa-fw fa-floppy-o"></span>Guardar</button>
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

        <!--footer Section -->
        <div class="for-full-back" id="footer">
            Zolid By ZTE Colombia | All Right Reserved
        </div>        
        <!-- CUSTOM SCRIPT   -->
        <?php $this->load->view('parts/generic/scripts'); ?>
        <script src="<?= URL::to("assets/js/modules/acs.js"); ?>" type = "text/javascript"></script>
        <script>
        $(function () {
            var info = <?php echo $usuarios; ?>;
            console.log(info);
            dom.llenarCombo($('.select-ingeniero'),info.users.data, {text:"n_name_user", value:"k_id_user"});
        });
        </script>
    </body>
</html>
