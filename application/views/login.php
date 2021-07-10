<?php
defined('BASEPATH') or exit('No direct script access allowed'); ?>

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
	<style rel="stylesheet">
		.continer-center {
			justify-content: center;
			align-items: center;
			height: 90vh;
		}

		.red {
			background-color: red;
		}

		.blue {
			background-color: blue;
		}

		.color-t {
			background-color: transparent;
		}

		.separed {
			border-color: black;
			border-radius: 5%;
			background-color: gray;
			height: 3px;
		}

		.text-cr {
			font-size: 15px;
		}

		.input-text {
			border-top: none;
			border-left: none;
			border-right: none;
			font-size: 15px;
		}

		.input-text::selection {
			border-top: none;
			border-left: none;
			border-right: none;
		}

		.carri,
		.cimg {
			width: 100%;
			height: auto;
		}

		.box-sh {
			box-shadow: 8px 10px 23px -6px rgba(0, 0, 0, 0.75);
			-webkit-box-shadow: 8px 10px 23px -6px rgba(0, 0, 0, 0.75);
			-moz-box-shadow: 8px 10px 23px -6px rgba(0, 0, 0, 0.75);
		}
	</style>
</head>

<body class="bg-dark w-100">
	<nav class="navbar navbar-expand-lg">
		<div class="container-fluid">
			<a class="navbar-brand mt-3" href="#"><img width="150" height="30" src="<?php echo base_url() ?>images/logoPron.png"></a>
		</div>
	</nav>
	<div class="container w-100 continer-center d-sm-flex align-items-center justify-content-center">
		<!-- <div class="container red h-100"> -->
		<div class="row mx-auto mt-10">
			<!-- <div class="col red d-none d-lg-block d-md-block d-sm-none">
				<div id="carouselExampleSlidesOnly" class="carousel slide cimg" data-bs-ride="carousel">
					<div class="carousel-inner">
						<div class="carousel-item active">
							<img src="https://scontent.fpiu1-1.fna.fbcdn.net/v/t1.6435-9/139433609_1695888413926284_4434317151225121113_n.jpg?_nc_cat=110&ccb=1-3&_nc_sid=730e14&_nc_eui2=AeFqqLKoi2DDHBnT01akbmt7JSMsnHdKk1AlIyycd0qTUK2pXPUAkH7tJ5t_MS5VpiEA0_f5G3knGZT4PxjULMP_&_nc_ohc=4ifrOiLaP8UAX8Slgv2&_nc_ht=scontent.fpiu1-1.fna&oh=ea538499edcd5f3f2e3e999e8cf723aa&oe=60EDFFD4" class="cimg" alt="...">
						</div>
						<div class="carousel-item">
							<img src="..." class="d-block w-100" alt="...">
						</div>
						<div class="carousel-item">
							<img src="..." class="d-block w-100" alt="...">
						</div>
					</div>
				</div>
			</div> -->
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