<!DOCTYPE html>
<html lang="en">
    <?php $this->load->view('parts/generic/head'); ?>
    <body data-base="<?= URL::base() ?>">
        <?php $this->load->view('parts/generic/header'); ?>
        <div class="container autoheight">
            <div class='tab-content' id='tab3'><brt><br>
                    <div class="container">
                        <form class="well form-horizontal" action="Precheck/doPrecheck" method="post"  id="precheckForm" name="precheckForm">
                            <input type="hidden" id="jsonSectores" name="jsonSectores" />
                            <input type="hidden" id="sectoresBloqueados" name="sectoresBloqueados" />
                            <input type="hidden" id="sectoresDebloqueados" name="sectoresDebloqueados" />
                            <input type="hidden" id="typeBlock" name="typeBlock" />
                            <input type="hidden" id="txtComentarioIng" name="n_comentario_ing" />

                            <legend class="p-b-15">Confirmar precheck<button type="button" class="display-block hidden btn btn-primary m-t-10" id="runPrecheck" title="Iniciar Precheck"><i class="fa fa-fw fa-play"></i> Iniciar Precheck</button></legend>
                            <fieldset class="col-md-6 control-label">
                                <div class="form-group">
                                    <label for="txtEstacion" class="col-md-3 control-label">Estacion:</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-street-view"></i></span>
                                            <input type='text' name="txtEstacion" id="txtEstacion" class="form-control" value='' readonly="false">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="txtRegional" class="col-md-3 control-label">Regional:</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-globe"></i></span>
                                            <input type='text' name="txtRegional" id="txtRegional" class="form-control" value='' readonly="false">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="txtCiudad" class="col-md-3 control-label">Ciudad:</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-location-arrow"></i></span>
                                            <input type='text' name="txtCiudad" id="txtCiudad" class="form-control" value='' readonly="false">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="txtCiudad" class="col-md-3 control-label">Ente Ejecutor:</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-address-book"></i></span>
                                            <input type='text' name="txtEnte" id="txtEnte" class="form-control" value='' readonly="false">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="txtCiudad" class="col-md-3 control-label">CRQ:</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-id-card"></i></span>
                                            <input type='text' name="txtCRQ" id="txtCRQ" class="form-control" value='' readonly="false">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="txtCiudad" class="col-md-3 control-label">WP:</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-id-card"></i></span>
                                            <input type='text' name="txtWP" id="txtWP" class="form-control" value='' readonly="false">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="txtIngeniero" class="col-md-3 control-label">Ingeniero:</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-user"></i></span>
                                            <input type='text' name="txtIngeniero" id="txtIngeniero" class="form-control" value='' readonly="false">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Observaciones de Creación</label>
                                    <div class="col-md-8 inputGroupContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
                                            <textarea class="form-control" name="n_comentario_doc" id="n_comentario_doc" placeholder="Observaciones coordinador" readonly="false"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">Observaciones de Asignacion</label>
                                    <div class="col-md-8 inputGroupContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
                                            <textarea class="form-control" name="n_comentario_coor" id="n_comentario_coor"  readonly="false"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 control-label">controlador:</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-id-card"></i></span>
                                            <input type='text' name="n_controlador" id="n_controlador" class="form-control disabledchange" disabled="" value='' required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">idcontrolador:</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-id-card"></i></span>
                                            <input type='text' name="n_idcontrolador" id="n_idcontrolador" class="form-control disabledchange" disabled="" value='' required>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <!--  fin seccion izquierda form---->

                            <!--  inicio seccion derecha form---->
                            <fieldset>
                                <div class="form-group">
                                    <label for="txtTecnologia" class="col-md-3 control-label">Tecnologia:</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-tablet"></i></span>
                                            <input type='text' name="txtTecnologia" id="txtTecnologia" class="form-control" value='' readonly="false">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="txtTipotrabajo" class="col-md-3 control-label">Tipo de trabajo:</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-briefcase"></i></span>
                                            <input type='text' name="txtTipotrabajo" id="txtTipotrabajo" class="form-control" value='' readonly="false">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="txtBanda" class="col-md-3 control-label">Banda:</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-signal"></i></span>
                                            <input type='text' name="txtBanda" id="txtBanda" class="form-control" value='' readonly="false">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="txtCiudad" class="col-md-3 control-label">Fecha Ingreso On-Air:</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-calendar-o"></i></span>
                                            <input type='text' name="txtFecha" id="txtFecha" class="form-control" value='' readonly="false">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="txtCiudad" class="col-md-3 control-label">Estado Actual:</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-thumbs-o-up"></i></span>
                                            <input type='text' name="txtEstado" id="txtEstado" class="form-control" value='' readonly="false" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="txtCiudad" class="col-md-3 control-label">Subestado Actual:</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-thumbs-o-up"></i></span>
                                            <input type='text' name="txtSubestado" id="txtSubestado" class="form-control" value='' readonly="false" required  >
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">btsipaddress:</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-id-card"></i></span>
                                            <input type='text' name="n_btsipaddress" id="n_btsipaddress" class="form-control disabledchange" disabled="" value='' required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">bcf_wbts_id:</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-id-card"></i></span>
                                            <input type='text' name="n_bcf_wbts_id" id="n_bcf_wbts_id" class="form-control disabledchange" disabled="" value='' required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">BTS_ID:</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-id-card"></i></span>
                                            <input type='text' name="n_bts_id" id="n_bts_id" class="form-control disabledchange" disabled="">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">vistamm:</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-tablet"></i></span>
                                            <select name="b_vistamm" id="b_vistamm" class="form-control selectpicker disabledchange" disabled="" required>
                                                <option value="True">TRUE</option><option value="False" >FALSE</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!--                                <div class="form-group">
                                                                    <label class="col-md-3 control-label">Observaciones Precheck</label>
                                                                    <div class="col-md-8 inputGroupContainer">
                                                                        <div class="input-group">
                                                                            <span class="input-group-addon"><i class="glyphicon glyphicon-pencil"></i></span>
                                                                            <textarea class="form-control disabledchange" disabled="" name="n_comentario_ing" id="n_comentario_ing" placeholder="Observaciones Precheck"></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>-->
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Próximo Estado:</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-thumbs-o-up"></i></span>
                                            <select name="k_id_status" id="k_id_status" class="form-control selectpicker disabledchange" disabled="" required>
                                                <option value="" >Seleccione el Estado</option>
                                                <option value="0">Seguimiento FO</option>
                                                <option value="8">Producción</option>
                                                <option value="9">Prórroga</option>
                                                <option value="10">Stand By</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label">Próximo Subestado:</label>
                                    <div class="col-md-8 selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-thumbs-o-up"></i></span>
                                            <select name="k_id_status_onair" id="k_id_status_onair" class="form-control selectpicker disabledchange" disabled="" required>
                                                <option value="">Seleccione el Subestado</option>
                                            </select>
                                        </div>
                                        <div class="display-block hidden" id="divAnottations">
                                            <label class="display-block m-t-15">Anotaciones:</label>
                                            <div class="checkbox checkbox-primary display-block p-l-25" id="productionList">
                                                <div class="display-block">
                                                    <input id="chk_p_1" type="checkbox">
                                                    <label for="chk_p_1" class="text-bold">
                                                        Activación Cuarta Portadora.
                                                    </label>
                                                </div>
                                                <div class="display-block">
                                                    <input id="chk_p_2" type="checkbox">
                                                    <label for="chk_p_2" class="text-bold">
                                                        Pendiente ID RF Tools
                                                    </label>
                                                </div>
                                                <div class="display-block">
                                                    <input id="chk_p_3" type="checkbox">
                                                    <label for="chk_p_3" class="text-bold">
                                                        Pendiente Sitio Limpio.
                                                    </label>
                                                </div>
                                                <div class="display-block">
                                                    <input id="chk_p_4" type="checkbox">
                                                    <label for="chk_p_4" class="text-bold">
                                                        Activación Cuarta Portadora.
                                                    </label>
                                                </div>
                                                <div class="display-block">
                                                    <input id="chk_p_5" type="checkbox">
                                                    <label for="chk_p_5" class="text-bold">
                                                        Pendiente Testgestión.
                                                    </label>
                                                </div>
                                                <div class="display-block">
                                                    <input id="chk_p_6" type="checkbox">
                                                    <label for="chk_p_6" class="text-bold">
                                                        Pendiente Pruebas Alarmas.
                                                    </label>
                                                </div>
                                                <div class="display-block">
                                                    <input id="chk_p_7" type="checkbox">
                                                    <label for="chk_p_7" class="text-bold">
                                                        Error de instalación.
                                                    </label>
                                                </div>
                                                <div class="display-block">
                                                    <input id="chk_p_8" type="checkbox">
                                                    <label for="chk_p_8" class="text-bold">
                                                        Pendiente Evidencias.
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="display-block form-group hidden m-t-15" id="prorrogaContent">
                                            <label class="col-md-4 control-label">Tiempo Prórroga:</label>
                                            <div class="col-md-8 selectContainer">
                                                <input type="number" class="form-control" name="prorrogaHours" id="numHoursProrroga" placeholder="0" value="0" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <input type='hidden' name="k_id_preparation" id="k_id_preparation" class="form-control" value='' required>
                            <input type='hidden' name="k_id_precheck" id="k_id_precheck" class="form-control" value='' required>
                            <input type="hidden" class="form-control input-sm" id="idOnair" name="idOnair" value="<?= $_GET['idOnair']; ?>" />
                            <!--   fin seccion derecha---->

                            <!-- Button -->
                            <center>
                                <div class="form-group">
                                    <label class="col-md-12 control-label"></label>
                                    <div class="col-md-12">
                                        <button type="submit" id="btnAsignar" class="btn btn-success disabledchange" disabled="" > Confirmar <span class="fa fa-fw fa-check"></span></button>
                                        <button type="button" id="btnNoexitiso" class="btn btn-primary disabledchange" disabled="" >No exitoso <span class="fa fa-fw fa-times"></span></button>
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



        <!--MODAL SECTORES-->
        <div id="modalSectores" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title"><i class="fa fa-fw fa-check-square-o"></i> Seleccionar sectores</h4>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <div class="selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-briefcase"></i></span>
                                            <input type="text" class="form-control" id="txtTipoTrabajoModal" disabled="" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-tablet"></i></span>
                                            <input type="text" class="form-control" id="txtTecnologiaModal" disabled="" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="selectContainer">
                                        <div class="input-group">
                                            <span class="input-group-addon"><i class="fa fa-fw fa-signal"></i></span>
                                            <input type="text" class="form-control" id="txtBandaModal" disabled="" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row p-t-15">
                            <div class="col-xs-12">
                                <div style="display: block; overflow: auto; overflow-x: hidden; max-height: 200px; border: 1px solid #ddd;">
                                    <table class="table table-bordered table-condensed table-striped table-sm" id="tblSectores">
                                        <thead><tr><th class="vertical-middle">Sector</th><th><div class="checkbox checkbox-primary" style=""><input id="checkbox_tdheader_1" type="checkbox" name="checkbox_tdheader_1" class="checkbox-head" value="1" ><label for="checkbox_tdheader_1" class="text-bold">Seleccionar todos</label></div></th><th class="p-all-0 vertical-middle text-right"><button class="btn btn-default btn-sm m-r-15 btn-add-sector" ><i class="fa fa-fw fa-plus"></i> Agregar sector</button></th></tr></thead>
                                        <tbody>
                                            <tr><td colspan="3"><i class="fa fa-fw fa-warning"></i> Ningún sector disponible</td></tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <hr/>
                        <div class="controls-modal">
                            <div class="row m-b-15">
                                <div class="col-md-3 text-right">
                                    <label class="m-t-5">Estado sectores:</label>                            
                                </div>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-fw fa-wrench"></i>
                                        </div>
                                        <select id="cmbEstadoSectores" class="form-control" >
                                            <option value="">Seleccione</option>
                                            <option value="1">Bloqueados</option>
                                            <option value="0">Desbloqueados</option>
                                        </select>
                                    </div>                            
                                </div>
                            </div>
                            <div class="row" id="contentCommentSectores">
                                <div class="col-md-3 text-right">
                                    <label class="m-t-5">Observaciones:</label>                            
                                </div>
                                <div class="col-md-9">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-fw fa-comment"></i>
                                        </div>
                                        <textarea class="form-control" placeholder="Observaciones" id="txtComentarioStartPrecheck" >Se inicia el precheck.</textarea>
                                    </div>                            
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" id="btnAceptarModalSectores">Aceptar</button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>

            </div>
        </div>
        <!--FIN MODAL SECTORES-->

        <?php $this->load->view('parts/generic/scripts'); ?>
        <!-- CUSTOM SCRIPT   -->
        <script>
            var hasSectores = true;
            var fillTableSectores = function (data) {
                if (!data.n_json_sectores) {
                    hasSectores = false;
                    return;
                }
                data = JSON.parse(data.n_json_sectores);
                if (data && data.length > 0) {
                    $('#jsonSectores').val(data.n_json_sectores);
                    $('#sectoresBloqueados').val(data.n_sectoresbloqueados);
                    $('#sectoresDebloqueados').val(data.n_sectoresdesbloqueados);
                    var estadoSectores = "";
                    var table = $('#tblSectores tbody');
                    table.html('');
                    var selecteds = 0;
                    //Llenamos la tabla sectores...
                    for (var i = 0; i < data.length; i++) {
                        var dat = data[i];
                        if (dat.state != -1) {
                            selecteds++;
                            estadoSectores = dat.state;
                        }
                        table.append(dom.fillString('<tr data-id="{id}" data-name="{name}"><td>{name}</td><td colspan="2"><div class="checkbox checkbox-primary" style=""><input ' + ((dat.state == 1 || dat.state == 0) ? 'checked="true"' : '') + ' id="checkbox_block_{id}" type="checkbox" name="check_{id}" value="1" ><label for="checkbox_block_{id}" class="text-bold">Seleccionar</label></div></td></tr>', dat));
                    }
                    $('#cmbEstadoSectores').val(estadoSectores).trigger('change.select2');
                    $('.length-sectores').html(selecteds);
                    if (estadoSectores == 1) {
                        $('.btn-sectores.lock').prop('disabled', true);
                        $('.state-sectores').html(' Bloqueados');
                    } else if (estadoSectores == 0) {
                        $('.btn-sectores.unlock').prop('disabled', true);
                        $('.state-sectores').html(' Desbloqueados');
                    }
                    $('#btnEditarSectores').html('<i class="fa fa-fw fa-check-square-o"></i> (' + selecteds + ') Sectores seleccionados');
                } else {
                    hasSectores = false;
                    $('#tblSectores tbody').html('<tr class="no-found"><td colspan="3"><i class="fa fa-fw fa-warning"></i> No hay sectores disponibles.</td></tr>');
                }
                if ($('#tblSectores td input:checked').length > 0) {
                    $('#tblSectores input.checkbox-head').prop('checked', true);
                }
            };
            $(function () {
                var ticket = <?php echo $ticket; ?>;
                console.log(ticket);
                fillTableSectores(ticket);
                if (ticket.k_id_status_onair.k_id_status_onair == 80 || ticket.k_id_status_onair.k_id_status_onair == 97) {
                    $('#runPrecheck').removeClass('hidden');
                } else {
                    $('#runPrecheck').addClass('hidden');
                    $('.disabledchange').prop('disabled', false);
                    $('#txtComentarioStartPrecheck').val("Se confirma el precheck.");
                }
                $('input[name=txtEstacion]').val(ticket.k_id_station.n_name_station);
                $('input[name=txtBanda]').val(ticket.k_id_band.n_name_band);
                $('#txtBandaModal').val(ticket.k_id_band.n_name_band);
                $('input[name=txtRegional]').val(ticket.k_id_station.k_id_city.k_id_regional.n_name_regional);
                $('input[name=txtTecnologia]').val(ticket.k_id_technology.n_name_technology);
                $('#txtTecnologiaModal').val(ticket.k_id_technology.n_name_technology);
                $('input[name=txtTipotrabajo]').val(ticket.k_id_work.n_name_ork);
                $('#txtTipoTrabajoModal').val(ticket.k_id_work.n_name_ork);
                $('input[name=txtCiudad]').val(ticket.k_id_station.k_id_city.n_name_city);
                $('input[name=txtEnte]').val(ticket.k_id_preparation.n_enteejecutor);
                $('input[name=txtCRQ]').val(ticket.k_id_preparation.n_crq);
                $('input[name=txtWP]').val(ticket.k_id_preparation.n_wp);
                $('input[name=txtFecha]').val(ticket.k_id_preparation.d_ingreso_on_air);
                $('input[name=txtEstado]').val(ticket.k_id_status_onair.k_id_status.n_name_status);
                $('input[name=txtSubestado]').val(ticket.k_id_status_onair.k_id_substatus.n_name_substatus);
                $('input[name=k_id_ticket]').val(ticket.k_id_onair);
                $('input[name=txtIngeniero]').val(ticket.k_id_precheck.k_id_user.n_name_user + " " + ticket.k_id_precheck.k_id_user.n_last_name_user);
                $('input[name=k_id_preparation]').val(ticket.k_id_preparation.k_id_preparation);
                $('input[name=k_id_precheck]').val(ticket.k_id_precheck.k_id_precheck);
                $('input[name=n_bcf_wbts_id]').val(ticket.k_id_preparation.n_bcf_wbts_id);
                $('textarea[name=n_comentario_doc]').val(ticket.k_id_preparation.n_comentario_doc);
                $('textarea[name=n_comentario_coor]').val(ticket.n_comentario_coor);
                $('textarea[name=n_comentario_coor]').val(ticket.n_comentario_coor);
                $('input[name=n_controlador]').val(ticket.k_id_preparation.n_controlador);
                $('input[name=n_idcontrolador]').val(ticket.k_id_preparation.n_idcontrolador);
                $('input[name=n_btsipaddress]').val(ticket.k_id_preparation.n_btsipaddress);
                $('input[name=n_bcf_wbts_id]').val(ticket.k_id_preparation.n_bcf_wbts_id);
                $('#b_vistamm').val(ticket.k_id_preparation.b_vistamm);
                $('input[name=n_bts_id]').val(ticket.k_id_preparation.n_bts_id);
                $('#txtComentarioStartPrecheck').val(ticket.n_comentario_sectores);

            });
        </script>
        <script src="<?= URL::to("assets/plugins/jquery.validate.min.js") ?>" type="text/javascript"></script>
        <script src="<?= URL::to("assets/plugins/HelperForm.js?v=1.0") ?>" type="text/javascript"></script>
        <script type="text/javascript">
            $(function () {
                $('#tblSectores').on('change', 'input:checkbox', function () {
                    var chk = $(this);
                    if (chk.hasClass('checkbox-head')) {
                        $('#tblSectores input:checkbox').prop('checked', chk.is(':checked'));
                        return;
                    }
                    if ($('#tblSectores td input:checked').length == 0 || chk.is(':checked')) {
                        $('#tblSectores input.checkbox-head').prop('checked', chk.is(':checked'));
                    }
                });

                var opciones = {
                    '0': '<option value="">Seleccione el Subestado</option><option value="81">Seguimiento 12H</option><option value="82">Seguimiento 24H</option><option value="83">Seguimiento 36H</option>',
                    '8': '<option value="">Seleccione el Subestado</option><option value="87">Pendiente Tareas Remedy</option><option value="89">Producción</option>',
                    '9': '<option value="0">Prórroga</option>',
                    '10': '<option value="10">Stand By</option>'
                };

                var submitForm = function (form) {
                    if ($('#k_id_status').val() == "9" && $('#numHoursProrroga').val() <= 0) {
                        swal("Error", "El tiempo de prórroga debe ser mayor a 0", "error");
                        return;
                    }
                    dom.controlSubmit(form, function () {
                        location.href = app.urlTo('User/principalView');
                    }).before(function () {
                        var joinText = "";
                        var joinItems = $('#productionList').find('input:checked');
                        for (var i = 0; i < joinItems.length; i++) {
                            joinText += $(joinItems[i]).next('label').text() + ((i < (joinItems.length - 1)) ? ", " : "");
                        }
                        $('#n_comentario_ing').val(joinText + "-----\n" + $('#n_comentario_ing').val());
                    }).send();
                };

                $('#k_id_status').on('change', function () {
                    $('#k_id_status_onair').html(opciones[$(this).val()]);
                    if ($(this).val() == 8) {
                        $('#divAnottations').removeClass('hidden').hide().slideDown(500);
                        $('#prorrogaContent').slideUp(500);
                        $('#numHoursProrroga').val("0").prop("disabled", true);
                    } else if ($(this).val() == 9) {
                        $('#prorrogaContent').removeClass('hidden').hide().slideDown(500);
                        $('#divAnottations').slideUp(500);
                        $('#numHoursProrroga').val("12").prop("disabled", false);
                    } else {
                        $('#prorrogaContent').slideUp(500);
                        $('#divAnottations').slideUp(500);
                        $('#numHoursProrroga').val("0").prop("disabled", true);
                    }
                });
                var form = $('#precheckForm');
                form.validate();
                var onSubmitForm = function (e) {
                    if (e.isDefaultPrevented())
                    {
                        return;
                    }
                    $('#modalSectores #contentCommentSectores').show();
                    app.stopEvent(e);
                    var form = $(this);
                    if (hasSectores) {
                        $('#modalSectores').modal('show');
                    } else {
                        submitForm($('#precheckForm'));
                    }
                };

                form.on('submit', onSubmitForm);

                var sendPrecheck = function () {
                    var cmbSectores = $('#cmbEstadoSectores');
                    var lg = $('#tblSectores').find('input:checked').not('.checkbox-head').length;
                    if (lg == 0) {
                        $('#modalSectores').modal('hide');
                        return;
                    }
                    if (cmbSectores.val().trim() == "") {
                        if (!cmbSectores.parents('.input-group').next().hasClass('error')) {
                            cmbSectores.parents('.input-group').after('<label class="error m-l-40 m-t-5 text-right center-block"><i class="fa fa-fw fa-warning"></i> Seleccione el estado para los sectores.</label>');
                        }
                        return;
                    }
                    applySectores();
                    $('#txtComentarioIng').val($('#txtComentarioStartPrecheck').val());
                    submitForm($('#precheckForm'));
                };

//                $('#btnAceptarModalSectores').on('click', sendPrecheck);
                var startPrecheck = function () {
                    $('#modalSectores').modal('hide');
                    app.post('Precheck/runPrecheck', {
                        idOnAir: $('#idOnair').val(),
                        n_json_sectores: $('#jsonSectores').val(),
                        n_sectores_bloqueados: $('#sectoresBloqueados').val(),
                        n_sectores_desbloqueados: $('#sectoresDebloqueados').val(),
                        typeBlock: $('#typeBlock').val(),
                        n_comentario_ing: $('#txtComentarioStartPrecheck').val(),
                    })
                            .success(function (response) {
                                if (response.code > 0) {
                                    swal("Iniciado", "Se ha inciado el precheck correctamente.", "success").then(function () {
                                        location.reload();
                                    });
                                    $('.disabledchange').prop('disabled', false);
                                    $('#runPrecheck').remove();
//                                    $('#modalSectores').attr('data-action', 'precheck').modal('show');
                                } else {
                                    swal("Iniciado", "No se pudo iniciar el precheck.", "error");
                                }
                            })
                            .error(function () {
                                swal("Error", "Se ha producido un error inesperado al iniciar el precheck.", "error");
                            })
                            .send();
                };


                var applySectores = function () {
                    var cmbSectores = $('#cmbEstadoSectores');
                    if (cmbSectores.val().trim() == "") {
                        if (!cmbSectores.parents('.input-group').next().hasClass('error')) {
                            cmbSectores.parents('.input-group').after('<label class="error m-l-40 m-t-5 text-right center-block"><i class="fa fa-fw fa-warning"></i> Seleccione el estado para los sectores.</label>');
                            $('#modalSectores').modal('show');
                            return false;
                        }
                    }
                    //Preparamos los sectores...
                    var sectores = [];
                    var sectoresBloqueados = "";
                    var sectoresDesbloqueados = "";
                    var sectoresSeleccionados = 0;
                    var inputs = $('#tblSectores').find('input:checkbox').not('.checkbox-head');
                    for (var i = 0; i < inputs.length; i++) {
                        var input = $(inputs[i]);
                        var tr = input.parents('tr');
                        var temp = {
                            id: tr.attr('data-id'),
                            name: tr.attr('data-name'),
                            state: ((input.is(':checked')) ? cmbSectores.val() : -1)
                        };
                        sectores.push(temp);
                        if (temp.state == 1) {
                            sectoresBloqueados += temp.name + ((i < (inputs.length - 1) ? ", " : ""));
                        } else if (temp.state == 0) {
                            sectoresDesbloqueados += temp.name + ((i < (inputs.length - 1) ? ", " : ""));
                        }
                        if (temp.state != -1) {
                            sectoresSeleccionados++;
                            estadoSectores = temp.state;
                        }
                    }
                    $('#typeBlock').val($('#cmbEstadoSectores').val());
                    $('#jsonSectores').val(JSON.stringify(sectores));
                    $('#sectoresBloqueados').val(sectoresBloqueados);
                    $('#sectoresDebloqueados').val(sectoresDesbloqueados);
                    $('#modalSectores').modal('hide');
                    return true;
                };



                $('#runPrecheck').on('click', function () {
                    dom.confirmar("Se iniciará el proceso de precheck, ¿está seguro de continuar con esta operación?", function () {
                        $('#modalSectores').attr('data-action', 'start_precheck').modal('show');
//                        applySectores();
//                        startPrecheck();
                    }, function () {
                        swal("Cancelado", "Se ha cancelado la operación", "error");
                    });
                });

                var confirmRedirect = function () {
                    swal({
                        title: "Error",
                        message: "No se pudo guardar los guardar los cambios, ¿Desea continuar?",
                        type: "error",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Continuar",
                        cancelButtonText: "Cancelar",
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                    }).then(function (res) {
                        if (res.value) {
                            location.href = app.urlTo("User/scaling?id=" + $('#idOnair').val());
                        }
                    });
                };

                //Se controla Click del botón no exitoso.
                $('#btnNoexitiso').on('click', function (e) {
                    var btn = $(this);
                    app.stopEvent(e);

                    //Antes que nada, verificamos los sectores...
                    $('#modalSectores #contentCommentSectores').hide();
                    $('#modalSectores').attr('data-action', 'PRECHECK_NO_EXITOSO').modal('show');
                });

                //Sectores dinámicos.
                function addSector() {
                    var table = $('#tblSectores tbody');
                    var tr = $('<tr><td class="" colspan="3"><div style="width: 100%; display: table" class="input-group"><div class="input-group-addon">Sector:</div><input type="text" class="form-control" placeholder="Nombre del sector" /><div class="input-group-btn"><button type="button" class="btn btn-success push-sector-btn"><i class="fa fa-fw fa-save"></i></button><button type="button" class="btn btn-danger delete-sector-btn"><i class="fa fa-fw fa-trash"></i></button></div></div></td></tr>');
                    table.find('.no-found').remove();
                    table.prepend(tr);
                    tr.find('input').focus();
                }

                function onClickPushSector() {
                    var btn = $(this);
                    var tr = btn.parents('tr');
                    var table = $('#tblSectores');
                    if (tr.find('input').val().trim() == "") {
                        return;
                    }
                    var dat = {
                        id: tr.find('input').val(),
                        name: tr.find('input').val(),
                        state: 1,
                    };
                    tr.remove();
                    table.append(dom.fillString('<tr data-id="{id}" data-name="{name}"><td>{name}</td><td colspan="2"><div class="checkbox checkbox-primary" style=""><input ' + ((dat.state == 1 || dat.state == 0) ? 'checked="true"' : '') + ' id="checkbox_block_{id}" type="checkbox" name="check_{id}" value="1" ><label for="checkbox_block_{id}" class="text-bold">Seleccionar</label> <button class="close btn-remove-sector-added m-r-15" title="Eliminar sector">&times</button></div></td></tr>', dat));
                }


                function onClickDeleteSector() {
                    var btn = $(this);
                    var tr = btn.parents('tr');
                    tr.remove();
                }

                function onClickPushRemoveSector() {
                    var tr = $(this).parents('tr');
                    tr.remove();
                }

                $('.btn-add-sector').on('click', addSector);
                $('#tblSectores').on('click', '.push-sector-btn', onClickPushSector);
                $('#tblSectores').on('click', '.delete-sector-btn', onClickDeleteSector);
                $('#tblSectores').on('click', '.btn-remove-sector-added', onClickPushRemoveSector);
                //Fin sectores dinámicos.

                $('#btnAceptarModalSectores').on('click', function () {
                    if (!applySectores()) {
                        return;
                    }
                    if ($('#modalSectores').attr('data-action') === "start_precheck") {
                        startPrecheck();
                    } else if ($('#modalSectores').attr('data-action') === 'PRECHECK_NO_EXITOSO') {
                        applySectores();
                        var obj = $('#precheckForm').getFormData();
                        app.post('Precheck/updateBasicTicket', obj)
                                .before(function () {
                                    $('#precheckForm input, button, select, fieldset, textarea').prop('disabled', true);
                                })
                                .success(function (response) {
                                    if (app.validResponse(response)) {
                                        location.href = app.urlTo("User/scaling?id=" + $('#idOnair').val());
                                    } else {
                                        confirmRedirect();
                                    }
                                })
                                .error(function (error) {
                                    console.error(error);
                                    confirmRedirect();
                                })
                                .send();
                    } else {
                        sendPrecheck();
                    }
                });
            })
            // , function(){location.href = app.urlTo('User/principalView');}
        </script>
    </body>
</html>
