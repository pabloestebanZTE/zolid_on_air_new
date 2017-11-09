<!DOCTYPE html>
<html>
<head>
	<title>Index</title>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	<style>
	label.error{
		color: red;
		font-size: 12px;
		font-weight: normal;
	}
	</style>
</head>
<body data-base="<?= URL::to('')?>">
	<div class="container">
<h1>Prueba Formularios</h1>
<hr/>
<div class="panel panel-primary" style="display: block; max-width: 500px; margin: 0 auto;">
	<div class="panel-heading">
		<h2 class="h4"><i class="fa fa-fw fa-user"></i> Registrar usuario:</h2>
	</div>
	<div class="panel-body">
<form class="form-horizontal" id="form1" action="welcome/insertuser" method="POST">
	<div class="alert alert-success alert-dismissable hidden">
  	<a href="#" class="close">&times;</a>
  	<p id="text"></p>
  </div>
	<fieldset>
	<div class="form-group">
    <label class="control-label col-sm-2" for="username">Username:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="username" placeholder="Ingrese un usuario" name="username" required="">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="email">Email:</label>
    <div class="col-sm-10">
      <input type="email" class="form-control" id="email" placeholder="Ingrese un correo" name="email" required="">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="pwd">Clave:</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" id="pwd" placeholder="Ingrese la clave" name="password" required="">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default"><i class="fa fa-fw fa-save"></i> Registrar</button>
    </div>
  </div>
</fieldset>
</form>
</div>
</div>
</div>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="<?= URL::to('assets/plugins/HelperForm.js')?>" ></script>
<script type="text/javascript" src="<?= URL::to('assets/js/utils/app.global.js'); ?>" ></script>
<script type="text/javascript" src="<?= URL::to('assets/js/utils/app.dom.js'); ?>" ></script>
<script type="text/javascript" src="<?= URL::to('assets/plugins/jquery.validate.min.js'); ?>" ></script>
<script type="text/javascript">
  $(function(){
			dom.submit($('#form1'));
  });
</script>
</body>
</html>
