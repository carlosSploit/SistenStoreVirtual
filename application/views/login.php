<?php
defined('BASEPATH') or exit('No direct script access allowed');
$varid =  $this->session->userdata('id_rol');
if ($varid != NULL) :
	redirect('/welcome');
endif
?>

<!doctype html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Login de empresa</title>
	<link rel="icon" href="<?php echo base_url() ?>images/ln.png" sizes="32x32" />
	<!-- <link rel="icon" href="<?php echo base_url() ?>images/ln.png" sizes="32x32" /> -->

	<link href="<?php echo base_url() ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

	<!-- Custom styles for this template-->
	<link href="<?php echo base_url() ?>css/sb-admin.css" rel="stylesheet">

	<script src="<?php echo base_url() ?>vendor/jquery/jquery.min.js"></script>
	<link href="<?php echo base_url() ?>css/login-act.css" rel="stylesheet">
	<link href="<?php echo base_url() ?>css/style.css" rel="stylesheet">
</head>

<body class="bg-dark w-100 blockscr">

	<div class='ripple-background'>
		<div class='circle xxlarge shade1'></div>
		<div class='circle xlarge shade2'></div>
		<div class='circle large shade3'></div>
		<div class='circle mediun shade4'></div>
		<div class='circle small shade5'></div>
	</div>

	<nav class="navbar navbar-expand-lg">
		<div class="container-fluid">
			<a class="navbar-brand mt-3" href="#"><img width="150" height="30" src="<?php echo base_url() ?>images/logoPron.png"></a>
		</div>
	</nav>
	<div class="container w-100 continer-center d-sm-flex align-items-center justify-content-center">
		<!-- <div class="container red h-100"> -->
		<div class="row mx-auto mt-10">
			<div class="col card card-login box-sh">
				<div class="card-title text-center color-t mt-2">
					<img class="mt-3 mb-3" width="150" height="150" src="<?php echo base_url() ?>images/ln.png">
					<h4 class="fw-bold">Iniciar sesi&oacute;n</h4>
					<div class="separed mx-auto w-25"></div>
					<h6 class="text-cr text-muted mx-3 mt-3">Bienvenido a la aplicacion de tienda virtual, coloque sus credenciales </h6>
				</div>
				<div class="card-body">
					<form id="form_login" name="form_login" method="POST" action="<?php echo base_url() ?>index.php/login/verifica" autocomplete="off">

						<div class="form-group">
							<div class="input-group mb-4">
								<input type="text" id="usuario" name="usuario" class="form-control input-text w-50" placeholder="Usuario" required="required" autofocus="autofocus">
							</div>
						</div>

						<div class="form-group">
							<div class="input-group mb-3">
								<input type="password" id="password" name="password" class="form-control input-text w-50" placeholder="Contrase&ntilde;a" required="required">
							</div>
						</div>

						<button type="submit" class="btn btn-secondary btn-block mx-auto mb-2 mt-5">Entrar</button>
					</form>

					<?php if (validation_errors()) : ?>
						<div class="alert alert-danger col-sm-12" role="alert">
							<?php print_r(validation_errors());  ?>
						</div>
					<?php endif; ?>

					<?php if (isset($error)) { ?>
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

	</div>

	<!-- Bootstrap core JavaScript-->
	<script src="<?php echo base_url() ?>vendor/jquery/jquery.min.js"></script>
	<script src="<?php echo base_url() ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

	<!-- Core plugin JavaScript-->
	<script src="<?php echo base_url() ?>vendor/jquery-easing/jquery.easing.min.js"></script>

</body>

</html>