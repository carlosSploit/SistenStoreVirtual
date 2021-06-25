<?php
	/*
		Copyright (c) 2019 Codigos de Programacion
		Punto de Venta CDP
		Desarrollado por Codigos de Programacion
		www.codigosdeprogramacion.com
	*/
	
defined('BASEPATH') OR exit('No direct script access allowed');?>

<!doctype html>
<html lang="es">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport"
		content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<title>Tienda</title>
		<link rel="icon" href="<?php echo base_url() ?>images/favicon.png" sizes="32x32" />
		
		<link href="<?php echo base_url() ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
		
		<!-- Custom styles for this template-->
		<link href="<?php echo base_url() ?>css/sb-admin.css" rel="stylesheet">
		
		<script src="<?php echo base_url() ?>vendor/jquery/jquery.min.js"></script>
		
	</head>
	
	<body class="bg-dark">
		<div class="container">
			<div class="card card-login mx-auto mt-5">
				<div class="card-header"><h4>Iniciar sesi&oacute;n</h4></div>
				<div class="card-body">
					<form id="form_login" name="form_login" method="POST" action="<?php echo base_url() ?>index.php/login/verifica" autocomplete="off">

						<div class="form-group">
							<div class="input-group mb-2">
								<input type="text" id="usuario" name="usuario" class="form-control" placeholder="Usuario" required="required" autofocus="autofocus">	
								<div class="input-group-prepend">
									<div class="input-group-text"><span class="fas fa-fw fa-user"></span></div>
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="input-group mb-2">
								<input type="password" id="password" name="password" class="form-control" placeholder="Contrase&ntilde;a" required="required">	
								<div class="input-group-prepend">
									<div class="input-group-text"><span class="fas fa-fw fa-key"></span></div>
								</div>
							</div>
						</div>
						
						<button type="submit" class="btn btn-primary btn-block">Entrar</button>
					</form>
					
					<?php if (validation_errors()): ?>
					<div class="alert alert-danger col-sm-12" role="alert">
						<?php print_r(validation_errors());  ?>
					</div>
					<?php endif; ?>
					
					<?php if(isset($error)){ ?>
						<div class="alert alert-danger col-sm-12" role="alert">
							<?php echo $error;  ?>
						</div>
					<?php } ?>
					
					<!--<div class="text-center">
						<a class="d-block small" href="forgot-password.html">Forgot Password?</a>
					</div>-->
				</div>		
			</div>	
		</div>	
		
		<!-- Bootstrap core JavaScript-->
		<script src="<?php echo base_url() ?>vendor/jquery/jquery.min.js"></script>
		<script src="<?php echo base_url() ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
		
		<!-- Core plugin JavaScript-->
		<script src="<?php echo base_url() ?>vendor/jquery-easing/jquery.easing.min.js"></script>
		
	</body>
</html>	