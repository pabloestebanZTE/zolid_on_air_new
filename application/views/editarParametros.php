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
				/*	header('content-type: text/plain');
			print_r($tecnologia);*/
			
			?>
			
			<!----work---->
			
			<div class="modal fade" id="newWork" role="dialog">
				<div class="modal-dialog modal-sm">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Agregar tipo de trabajo</h4>
						</div>
						<div class="modal-body">
							<center>
							<form action="<?= URL::to('Editartodosparametros/newWork') ?>" method="post" >
								<label>Agregar nombre de trabajo:</label><br>
								<input type="text" name="n_name_ork" required><br>
								<label>Abreviacion:</label><br>
								<input type="text" name="n_abreviacion">
								<br><br>
								<div class="form-group aplica-bloqueo">
									<label>Aplica bloqueo</label><br>
									<input type="radio" name="b_aplica_bloqueo" value="1" required>
									<label >SI</label>
									<input type="radio" name="b_aplica_bloqueo" value="0" required>
									<label>NO</label>
									<center>
								</div>
								<div class="modal-footer">
									<input type="submit" name="" value="guardar" class="btn btn-success">
								</form>
								<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="row">
				<fieldset class="col-sm-5 box boxRigth-wo">
					<button type="button" class="btn btn-info btn-lg btn_Agreg_Work" data-toggle="modal" data-target="#newWork">Agregar</button>
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
								<td><?php  if (isset($work[$i]->n_name_ork)) { echo $work[$i]->n_name_ork;}else echo ""; ?></td>
								<td><?php  if (isset($work[$i]->n_abreviacion)) { echo $work[$i]->n_abreviacion;}else echo ""; ?></td>
								<td><?php  if (isset($work[$i]->b_aplica_bloqueo)) { echo $work[$i]->b_aplica_bloqueo;}else echo ""; ?></td>
							</tr>
							<?php  } ?>
						</tbody>
					</table>
				</fieldset>
				<!----Technology---->
				<fieldset class="col-sm-5 box boxLeft-te">
					<button type="button" class="btn btn-info btn-lg btn_Agreg_Tec" data-toggle="modal" data-target="#newTech">Agregar</button>
					<div class="modal fade" id="newTech" role="dialog">
						<div class="modal-dialog modal-sm">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h4 class="modal-title">Agregar tecnologia</h4>
								</div>
								<div class="modal-body">
									<center>
									<form action="<?= URL::to('Editartodosparametros/newTech') ?>" method="post" >
										<label for="n_name_technology">Agregar:</label><br>
										<input type="text" name="n_name_technology" required>
										<center>
									</div>
									<div class="modal-footer">
										<input type="submit" name="" value="guardar" class="btn btn-success">
									</form>
									<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
								</div>
							</div>
						</div>
					</div>
				</form>
				<table class="table table-bordered table-striped table-hover" id="tecnologia ">
					<thead>
						<h1 style="text-align: center;">Tecnologia</h1>
						<tr>
							<th>Nombre</th>
							
						</tr>
					</thead>
					<tbody>
						<?php for ($i=0; $i < count($tecnologia); $i++) { 	?>
						<tr>
							
							<td><?php  if (isset($tecnologia[$i]->n_name_technology)) { echo $tecnologia[$i]->n_name_technology;}else echo ""; ?></td>
							
						</tr>
						<?php  } ?>
					</tbody>
				</table>
			</fieldset>
		</div>
	</div>
	<!----Band---->
	<fieldset class="col-sm-5 box boxRigth-ba">
		<button type="button" class="btn btn-info btn-lg btn_Agreg_band" data-toggle="modal" data-target="#newBand" >Agregar</button>

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
							<label>Agregar nombre de banda</label>
							<input type="text" name="n_name_band" id="n_name_band" required>
							<div class="modal-footer">
								<input type="submit" name="" value="guardar" class="btn btn-success" id="btn-sub-band">
								<input type="hidden" value="" name="id" id="hidden_band">
								<!-- <button type="submit" class="btn btn-default Agreg_Work" data-dismiss="modal">Guardar</button> -->
							</form>
							<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
						</div>
					</div>
				</div>
			</div>
		</div>
																														<!-- MODAL DE EDICION -->
		<!-- ***************************************************************************************************************************** -->

		<!-- *********************************************************************************************************************************** -->
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
		
		<!--User-->
		
		<fieldset class="col-sm-5 box boxLeft-us ">
			<button type="button" class="btn btn-info btn-lg btn_Agreg_user" data-toggle="modal" data-target="#newUser">Agregar</button>
			<div class="modal fade" id="newUser" role="dialog">
				<div class="modal-dialog modal-sm">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal">&times;</button>
							<h4 class="modal-title">Agregar</h4>
						</div>
						<div class="modal-body">
							<center>
							<form action="<?= URL::to('Editartodosparametros/newUser') ?>" method="post" id="acForm">
								<label>Cedula</label><br>
								<input type="text" minlength="5" name="k_id_user" required><br>
								<label>Nombre usuario</label><br>
								<input type="text" name="n_name_user" required><br>
								<label>Apellidos usuario</label><br>
								<input type="text" name="n_last_name_user" required><br>
								<label>E-mail usuario</label><br>
								<input type="email" name="n_mail_user" ><br>
								<label>Rol usuario</label><br>
								<select name="n_role_user" id="" required>
									<option value="">SELECCIONE</option>
									<option value="Coordinador">Coordinador</option>
									<option value="Ingeniero">Ingeniero</option>
									<option value="Evaluador">Evaluador</option>
									<option value="Documentador">Documentador</option>
								</select><br>
								<label>User name</label><br>
								<input type="text" name="n_username_user" required>	<br>
								<center>
							</div>
							<div class="modal-footer">
								<input type="submit" name="" value="guardar" class="btn btn-success">
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
					<td><?php  if (isset($user[$i]->k_id_user)) { echo $user[$i]->k_id_user;}else echo ""; ?></td>
					<td><?php  if (isset($user[$i]->n_name_user)) { echo $user[$i]->n_name_user;}else echo ""; ?></td>
					<td><?php  if (isset($user[$i]->n_last_name_user)) { echo $user[$i]->n_last_name_user;}else echo ""; ?></td>
					<td><?php  if (isset($user[$i]->n_mail_user)) { echo $user[$i]->n_mail_user;}else echo ""; ?></td>
					<td><?php  if (isset($user[$i]->n_role_user)) { echo $user[$i]->n_role_user;}else echo ""; ?></td>
					<td><?php  if (isset($user[$i]->n_username_user)) { echo $user[$i]->n_username_user;}else echo ""; ?></td>
				</tr>
				<?php }
						}
							/*	print_r($user);*/
				?>
			</tbody>
		</table>
	</div>
</div>
</fieldset>
<script type="text/javascript"
src="https://cdn.datatables.net/v/dt/dt-1.10.16/datatables.min.js"></script>
<script type="text/javascript">
		$(document).ready(
			function () {
				$('#tableWork, #tableUser').DataTable();
				/*$('#tableUser').DataTable();*/
		});
		$('#tableBand').on('click', 'td', function(){
		$('#newBand').modal('show');
			var td = $(this).attr("id");
			var val = $(this).html();
			$('#n_name_band').val(val);
			$('#title-newBand').html('Editar');
			//$('btn-sub-band').html('Actualizar')
			document.getElementById('btn-sub-band').value = "actualizar";
			document.forms.formBand.action= "<?= URL::to('Editartodosparametros/updateBand') ?>";
			document.getElementById('hidden_band').value = td;
			console.log(td);
		});
</script>
</body>
</html>