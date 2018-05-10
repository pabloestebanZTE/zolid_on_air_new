<!DOCTYPE html>
<html lang="en">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.css"/>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="<?= URL::to('assets/css/tablasEdicion.css') ?>"/>
	<?php $this->load->view('parts/generic/head'); ?>
	<body data-base="<?= URL::base() ?>">
		<?php $this->load->view('parts/generic/header'); ?>
		<div class="container autoheight p-t-20">
			<?php
			?>
			<!----work---->
			<div class="modal fade" id="newWork" role="dialog">
				<div class="modal-dialog modal-sm">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title" id="title-newWork">Agregar tipo de trabajo</h4>
						</div>
						<div class="modal-body">
							<center>
							<form action="<?= URL::to('Editartodosparametros/newWork') ?>" method="post" id="formWork">
								<label id="title_newWork">Agregar nombre de trabajo:</label><br>
								<input type="text" name="n_name_ork" id="n_name_ork" required><br>
								<label id="title_newWork2">Abreviacion:</label><br>
								<input type="text" name="n_abreviacion" id="n_abreviacion">
								<br><br>
								<div class="form-group aplica-bloqueo">
									<label id="title_newWork3">Aplica bloqueo</label><br>
									<input type="radio" name="b_aplica_bloqueo" value="1" id="bl_1" required>
									<label >SI</label>
									<input type="radio" name="b_aplica_bloqueo" value="0" id="bl_0" required>
									<label>NO</label>
									<center>
								</div>
								<input type="hidden" id="hidden_work" name="id" value="">
								<div class="modal-footer">
									<input type="submit" name="" value="guardar" class="btn btn-success" id="btn-sub-work" >
								</form>
								<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row resetMargin">
				<fieldset class="col-sm-12 box boxRigth-wo">
					<button type="button" class="btn btn-info btn-lg btn_Agreg_Work" id="btn_new_Work">Agregar</button>
					<table class="table table-sm table-bordered table-striped table-hover" id="tableWork">
						<thead>
							<h1 style="text-align: center;">Tipo de trabajo</h1>
							<tr>
								<th>Nombre</th>
								<th>Abreviación</th>
								<th>Aplica bloqueo</th>
							</tr>
						</thead>
						<tbody>
							<?php for ($i=0; $i < count($work); $i++) { 	?>
							<tr>
								<?php  if (isset($work[$i]->n_name_ork)) { echo "<td id='".$work[$i]->k_id_work."'>".$work[$i]->n_name_ork ."</td>";}else echo "<td></td>"; ?>
								<?php  if (isset($work[$i]->n_abreviacion)) { echo "<td id='".$work[$i]->k_id_work."'>".$work[$i]->n_abreviacion ."</td>";} else echo "<td></td>"; ?>
								<?php  
								if (isset($work[$i]->b_aplica_bloqueo)){
									if ($work[$i]->b_aplica_bloqueo == 0) {
										$work[$i]->b_aplica_bloqueo = 'No';
									}else{
										$work[$i]->b_aplica_bloqueo = 'Si';
									}

									 echo "<td id='".$work[$i]->k_id_work."'>".$work[$i]->b_aplica_bloqueo ."</td>";

								}	else {
									echo "<td></td>"; 
								}	?>
							</tr>
							<?php  } ?>
						</tbody>
					</table>
				</fieldset>
				<!--User-->
				<fieldset class="col-sm-12 box boxLeft-us ">
					<button type="button" class="btn btn-info btn-lg btn_Agreg_user" id="btn_new_User">Agregar</button>
					<div class="modal fade" id="newUser" role="dialog" id="newUser">
						<div class="modal-dialog modal-sm">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h4 class="modal-title" id="title-newUser2">Agregar</h4>
								</div>
								<div class="modal-body">
									<center>
									<form action="<?= URL::to('Editartodosparametros/newUser') ?>" method="post" id="formUserMdl">
										<label>Cedula</label><br>
										<input type="text" minlength="5" name="k_id_user" id="k_id_user" required><br>
										<label>Nombre usuario</label><br>
										<input type="text" name="n_name_user" id="n_name_user" required><br>
										<label>Apellidos usuario</label><br>
										<input type="text" name="n_last_name_user" id="n_last_name_user" required><br>
										<label>E-mail usuario</label><br>
										<input type="email" name="n_mail_user" id="n_mail_user" ><br>
										<label>Rol usuario</label><br>
										<select name="n_role_user" id="n_role_user" required>
											<option value="">SELECCIONE</option>
											<option value="Coordinador">Coordinador</option>
											<option value="Ingeniero">Ingeniero</option>
											<option value="Evaluador">Evaluador</option>
											<option value="Documentador">Documentador</option>
										</select><br>
										<label>User name</label><br>
										<input type="text" name="n_username_user" id="n_username_user" required>	<br>
										<center>
									</div>
									<input type="hidden" id="hidden_user" name="id" value="">
									<div class="modal-footer">
										<input type="submit" name="" value="guardar" id="btn-sub-user" class="btn btn-success">
									</form>
									<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
								</div>
							</div>
						</div>
					</div>
				</form>
				<table class="table table-bordered table-striped table-hover" id="tableUser">
					<thead>
						<h1 style="text-align: center;">Usarios</h1>
						<tr>
							<th>Cedula</th>
							<th>Nombre</th>
							<th>Apellidos usuario</th>
							<th>Email</th>
							<th>Rol</th>
							<th>User name</th>
						</tr>
					</thead>
					<tbody>
						<?php for ($i=0; $i < count($user); $i++) { 	?>
						<?php if ($user[$i]->n_role_user != null) { ?>
						<tr>
							<?php  if (isset($user[$i]->k_id_user)) { echo "<td id='".$user[$i]->k_id_user."'>".$user[$i]->k_id_user."</td>";}else echo ""; ?>
							<?php  if (isset($user[$i]->n_name_user)) {  echo "<td id='".$user[$i]->k_id_user."'>".$user[$i]->n_name_user."</td>";}else echo ""; ?>
							<?php  if (isset($user[$i]->n_last_name_user)) {  echo "<td id='".$user[$i]->k_id_user."'>".$user[$i]->n_last_name_user."</td>";}else echo ""; ?>
							<?php  if (isset($user[$i]->n_mail_user)) { echo "<td id='".$user[$i]->k_id_user."'>".$user[$i]->n_mail_user."</td>";}else echo ""; ?>
							<?php  if (isset($user[$i]->n_role_user)) { echo "<td id='".$user[$i]->k_id_user."'>".$user[$i]->n_role_user."</td>";}else echo ""; ?>
							<?php  if (isset($user[$i]->n_username_user)) {  echo "<td id='".$user[$i]->k_id_user."'>".$user[$i]->n_username_user."</td>";}else echo ""; ?>
							<?php }
									}
							?>
						</tbody>
					</table>
				</div>
			</div>
		</fieldset>
		<!----Technology---->
		<fieldset class="col-sm-5 box boxLeft-te">
			<button type="button" class="btn btn-info btn-lg btn_Agreg_Tec" id="btn_new_Tech">Agregar</button>
			<div class="modal fade" id="newTech" role="dialog">
				<div class="modal-dialog modal-sm">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title" id="title-newTech">Agregar tecnologia</h4>
						</div>
						<div class="modal-body">
							<center>
							<form action="<?= URL::to('Editartodosparametros/newTech') ?>" method="post" id="formTechnology">
								<label for="n_name_technology" id="title-newTech2">Agregar:</label><br>
								<input type="text" name="n_name_technology" id="n_name_technology" required>
								<center>
							</div>
							<div class="modal-footer">
								<input type="submit" name="" id="btn-sub-tech" value="guardar" class="btn btn-success">
								<input type="hidden" value="" name="id" id="hidden_tech">
							</form>
							<button type="button" class="btn btn-default" data-dismiss="modal" id="btn-close-tech">Cerrar</button>
						</div>
					</div>
				</div>
			</div>
		</form>
		<table class="table table-bordered table-striped table-hover" id="tableTech">
			<thead>
				<h1 style="text-align: center;">Tecnologia</h1>
				<tr>
					<th>Nombre</th>
				</tr>
			</thead>
			<tbody>
				<?php for ($i=0; $i < count($tecnologia); $i++) { 	?>
				<tr>
					<?php  if (isset($tecnologia[$i]->n_name_technology)) { echo "<td id='".$tecnologia[$i]->k_id_technology."'>".$tecnologia[$i]->n_name_technology."</td>";}else echo "<td></td>"; ?>
				</tr>
				<?php  } ?>
			</tbody>
		</table>
	</fieldset>
</div>
</div>
<!----Band---->
<fieldset class="col-sm-5 box boxRigh-ba">
<button type="button" class="btn btn-info btn-lg btn_Agreg_band" id="btn_new_Band">Agregar</button>
<div class="modal fade" id="newBand" role="dialog">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title" id="title-newBand">Agregar</h4>
			</div>
			<div class="modal-body">
				<center>
				<form action="<?= URL::to('Editartodosparametros/newBand') ?>" method="post" id="formBand">
					<label id="title-newBand2">Agregar nombre de banda</label><br>
					<input type="text" name="n_name_band" id="n_name_band" required>
					<div class="modal-footer">
						<input type="submit" name="" value="guardar" class="btn btn-success" id="btn-sub-band">
						<input type="hidden" value="" name="id" id="hidden_band">
					</form>
					<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				</div>
			</div>
		</div>
	</div>
</div>
<table class="table table-sm table-bordered table-striped table-hover" id="tableBand">
	<thead>
		<h1 style="text-align: center;">Banda</h1>
		<tr>
			<th>Nombres </th>
			
		</thead>
		<tbody>
			<?php for ($i=0; $i < count($Band); $i++) { 	?>
			<tr>
				<?php  if (isset($Band[$i]->n_name_band)) { echo "<td id='".$Band[$i]->k_id_band."'>".$Band[$i]->n_name_band."</td>";}else echo ""; ?>
			</tr>
			<?php  } ?>
		</tbody>
	</table>
</fieldset>
<script type="text/javascript"
src="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.js"></script>
<script type="text/javascript">
		$(document).ready(
			function () {
				$('#tableWork, #tableUser').DataTable();
				/*$('#tableUser').DataTable();*/
		});
		/*EDITAR WORK***************************************************************************************************/
		$('#tableWork').on('click', 'td', function(){
		$('#newWork').modal('show');
var tdWork = $(this).attr("id");
var fila = $(this);
var nombre = fila.parents('tr').find('td').eq(0).html();
var abre = fila.parents('tr').find('td').eq(1).html();
var apl = fila.parents('tr').find('td').eq(2).html();

apl = (apl == 'Si') ? 1 : 0;

$('#n_name_ork').val(nombre);
$('#n_abreviacion').val(abre);
$('#bl_' + apl).attr('checked', true);
$('#title-newWork').html('Editar');
document.getElementById('btn-sub-work').value = "Actualizar";
document.forms.formWork.action= "<?= URL::to('Editartodosparametros/updateWork') ?>";
document.getElementById('hidden_work').value = tdWork;
});



	$('#btn_new_Work').on('click', function(){
		$('#newWork').modal('show');
		$('#n_name_ork').val('');
		$('#n_abreviacion').val('');
		$('#bl_').attr('checked', true);
		$('#title_newWork').html('Agregar tecnologia');
		$('#title_newWork2').html('Agregar');
		$('#title_newWork3').html('Aplica bloqueo');
document.getElementById('btn-sub-work').value = "Agregar";
document.forms.formTechnology.action= "<?= URL::to('Editartodosparametros/newWork') ?>";
});
/***************************************************************************************************************/
/*TECHNOLOGY****************************************************************************************************/
//Al darle click en cualquier td de la tabla desplegara un modal de edicion
$('#tableTech').on('click', 'td', function(){
$('#newTech').modal('show');
//esta variable muestra el id de cada td
var tdTech = $(this).attr("id");
var valTech = $(this).html();
$('#n_name_technology').val(valTech);
$('#title-newTech').html('Editar');
$('#title-newTech2').html('Editar');
document.getElementById('btn-sub-tech').value = "Actualizar";
document.forms.formTechnology.action= "<?= URL::to('Editartodosparametros/updateTech') ?>";
document.getElementById('hidden_tech').value = tdTech;
});
// al darle click al boton agregar5 tecnologia se mostrara el modal de agregar
$('#btn_new_Tech').on('click', function(){
$('#newTech').modal('show');
$('#n_name_technology').val('');
$('#title-newTech').html('Agregar tecnologia');
$('#title-newTech2').html('Agregar');
document.getElementById('btn-sub-tech').value = "Agregar";
document.forms.formTechnology.action= "<?= URL::to('Editartodosparametros/newTech') ?>";
//document.getElementById('hidden_tech').value = tdTech;
});
/***************************************************************************************************************/
/*EDITAR BANDA**************************************************************************************************/
$('#tableBand').on('click', 'td', function(){
$('#newBand').modal('show');
var td = $(this).attr("id");
var val = $(this).html();
$('#n_name_band').val(val);
$('#title-newBand').html('Editar');
$('#title-newBand2').html('Editar');
//$('btn-sub-band').html('Actualizar')
document.getElementById('btn-sub-band').value = "Actualizar";
document.forms.formBand.action= "<?= URL::to('Editartodosparametros/updateBand') ?>";
document.getElementById('hidden_band').value = td;
});
// al darle click al boton agregar5 tecnologia se mostrara el modal de agregar
$('#btn_new_Band').on('click', function(){
$('#newBand').modal('show');
$('#n_name_band').val('');
$('#title-newBand').html('Agregar banda');
$('#title-newBand2').html('Agregar');
document.getElementById('btn-sub-band').value = "Agregar";
document.forms.formTechnology.action= "<?= URL::to('Editartodosparametros/newBand') ?>";
});
/***************************************************************************************************************/
/*EDITAR USER***************************************************************************************************/
$('#tableUser').on('click', 'td', function(){
$('#newUser').modal('show');
var tdUser = $(this).attr("id");
var fila =$(this);
var cedulaUs = fila.parents('tr').find('td').eq(0).html();
var nombreUs = fila.parents('tr').find('td').eq(1).html();
var apellidoUs = fila.parents('tr').find('td').eq(2).html();
var emailUs = fila.parents('tr').find('td').eq(3).html();
var rolUs = fila.parents('tr').find('td').eq(4).html();
var usernameUs = fila.parents('tr').find('td').eq(5).html();
$('#k_id_user').val(cedulaUs);
$('#n_name_user').val(nombreUs);
$('#n_last_name_user').val(apellidoUs);
$('#n_mail_user').val(emailUs);
$('#n_role_user').val(rolUs);
$('#n_role_user option[value="'+rolUs+'"]').attr('selectet', true);
$('#n_username_user').val(usernameUs);
$('#title-newUser2').html('Editar');
document.getElementById('btn-sub-user').value = "Actualizar";
document.forms.formUserMdl.action="<?= URL::to('Editartodosparametros/updateUser') ?>";
document.getElementById('hidden_user').value = tdUser;
})

//Agregar usuarios
$('#btn_new_User').on('click', function(){
$('#newUser').modal('show');
$('#k_id_user').val('');
$('#n_name_user').val('');
$('#n_last_name_user').val('');
$('#n_mail_user').val('');
$('#n_role_user').val('');
$('#n_role_user option[value=""]').attr('selectet', true);
$('#n_username_user').val('');
$('#title-newUser').html('Agregar Usuario');
$('#title-newUser2').html('Agregar');
document.getElementById('btn-sub-user').value = "Agregar";
document.forms.formTechnology.action= "<?= URL::to('Editartodosparametros/newUser') ?>";
});
/***************************************************************************************************************/
</script>
</body>
</html>