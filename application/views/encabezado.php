<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Lo Nuestro Productos Regionales</title>
	<link rel="icon" href="<?php echo base_url() ?>images/ln.png" sizes="32x32" />
	<!-- Custom fonts for this template-->
	<link href="<?php echo base_url() ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

	<!-- Page level plugin CSS-->
	<link href="<?php echo base_url() ?>vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

	<!-- Custom styles for this template-->
	<link href="<?php echo base_url() ?>css/sb-admin.css" rel="stylesheet">
	<link href="<?php echo base_url() ?>css/vanillatoasts.css" rel="stylesheet">

	<!-- Custom styles for this template-->
	<link href="<?php echo base_url() ?>vendor/jquery-ui/jquery-ui.css" rel="stylesheet">
	<link href="<?php echo base_url() ?>css/analitic.css" rel="stylesheet">
	<script src="<?php echo base_url() ?>vendor/jquery/jquery.min.js"></script>
	<script src="<?php echo base_url() ?>vendor/jquery-ui/jquery-ui.js"></script>
	<script src="<?php echo base_url() ?>js/vanillatoasts.js"></script>

</head>

<body id="page-top">
	<?php
	$varid =  $this->session->userdata('id_rol');
	$vartipe =   $this->db->get_where("roles", array('id' => $varid))->row()->nombre; ?>
	<nav class="navbar navbar-expand navbar-dark bg-dark static-top">
		<!--<?php echo $this->db->get_where("configuracion", array('nombre' => 'tienda_nombre'))->row()->valor; ?>-->
		<a class="navbar-brand mr-1" href="<?php echo base_url() ?>index.php/welcome">
			<!--<img class="d-block d-sm-none d-md-none d-lg-none" width="32" height="32" src="<?php echo base_url() ?>images/ln.png">---> <img width="150" height="30" src="<?php echo base_url() ?>images/logoPron.png">
		</a>

		<button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
			<i class="fas fa-bars"></i>
		</button>

		<form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0"></form>

		<!-- Navbar -->
		<ul class="navbar-nav ml-auto ml-md-0">
			<li class="nav-item dropdown no-arrow">
				<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i class="fas fa-user-circle fa-fw"></i>
					<span><?php echo $this->session->userdata('nombre'); ?></span>
				</a>
				<div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
					<a class="dropdown-item" href="<?php echo base_url() ?>index.php/usuarios/perfil/<?php echo $this->session->userdata('id_usuario'); ?>"><i class="fas fa-fw fa-user"></i> Perfil</a>
					<a class="dropdown-item" href="<?php echo base_url() ?>index.php/usuarios/editar_password/<?php echo $this->session->userdata('id_usuario'); ?>"><i class="fas fa-fw fa-key"></i> Cambiar contrase&ntilde;a</a>
					<div class="dropdown-divider"></div>
					<a class="dropdown-item" href="<?php echo base_url() ?>index.php/login/logout"><i class="fas fa-fw fa-sign-out-alt"></i> Cerrar sesi&oacute;n</a>
				</div>
			</li>
		</ul>
	</nav>

	<div id="wrapper">

		<ul class="sidebar navbar-nav">
			<!--<li class="nav-item dropdown">
					<a href="#" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<i class="fas fa-fw fa-user"></i>
						<span>Usuarios</span>
					</a>
					
					<div class="dropdown-menu" aria-labelledby="pagesDropdown">
						<a class="dropdown-item" href="<?php echo base_url() ?>index.php/usuarios">Usuarios</a>
						<a class="dropdown-item" href="<?php echo base_url() ?>index.php/roles">Roles</a>
					</div>
				</li>-->

			<li class="nav-item dropdown">
				<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
					<i class="fas fa-fw fa-shopping-basket"></i>
					<span>Productos </span>
				</a>

				<div class="dropdown-menu" aria-labelledby="pagesDropdown">
					<a class="dropdown-item" href="<?php echo base_url() ?>index.php/productos">Productos</a>
					<a class="dropdown-item <?php echo (($vartipe == 'Trabajador') ? 'd-none' : 'd-block'); ?>" href="<?php echo base_url() ?>index.php/unidades">Unidades</a>
					<a class="dropdown-item <?php echo (($vartipe == 'Trabajador') ? 'd-none' : 'd-block'); ?>" href="<?php echo base_url() ?>index.php/categorias">Categorias</a>
				</div>
			</li>

			<li class="nav-item dropdown">
				<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
					<i class="fas fa-fw fa-user-friends"></i>
					<span>Clientes </span>
				</a>

				<div class="dropdown-menu" aria-labelledby="pagesDropdown">
					<a class="dropdown-item" href="<?php echo base_url() ?>index.php/clientes">Clientes</a>
				</div>
			</li>

			<li class="nav-item dropdown <?php echo (($vartipe == 'Trabajador') ? 'd-none' : 'd-block'); ?>">
				<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
					<i class="fas fa-fw fa-truck"></i>
					<span>Compras </span>
				</a>

				<div class="dropdown-menu" aria-labelledby="pagesDropdown">
					<a class="dropdown-item" href="<?php echo base_url() ?>index.php/compras/nueva">Nueva compra</a>
					<a class="dropdown-item" href="<?php echo base_url() ?>index.php/compras">Compras</a>
				</div>
			</li>

			<li class="nav-item">
				<a class="nav-link" href="<?php echo base_url() ?>index.php/caja">
					<i class="fas fa-fw fa-cash-register"></i>
					<span>Caja</span></a>
			</li>

			<li class="nav-item">
				<a class="nav-link" href="<?php echo base_url() ?>index.php/pedido">
					<i class="fas fa-truck-loading"></i>
					<span>Pedido</span></a>
			</li>

			<li class="nav-item">
				<a class="nav-link" href="<?php echo base_url() ?>index.php/ventas">
					<i class="fas fa-fw fa-shopping-cart"></i>
					<span>Ventas</span>
				</a>
			</li>

			<li class="nav-item <?php echo (($vartipe == 'Trabajador') ? 'd-none' : 'd-block'); ?>">
				<a class="nav-link" href="<?php echo base_url() ?>index.php/Analitic">
					<i class="fas fa-chart-area"></i>
					<span>Analiticas</span>
				</a>
			</li>

			<li class="nav-item dropdown <?php echo (($vartipe == 'Trabajador') ? 'd-none' : 'd-block'); ?>">
				<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
					<i class="fas fa-fw fa-list-alt"></i>
					<span>Reportes</span>
				</a>

				<div class="dropdown-menu" aria-labelledby="pagesDropdown">
					<a class="dropdown-item" href="<?php echo base_url() ?>index.php/reportes/detalle_reporte_venta">Reporte de ventas</a>
					<a class="dropdown-item" href="<?php echo base_url() ?>index.php/reportes/muestra_reporte_productos">Reporte de productos</a>
					<a class="dropdown-item" href="<?php echo base_url() ?>index.php/reportes/detalle_productos_categoria">Productos x categor&iacute;a</a>
				</div>
			</li>

			<li class="nav-item dropdown <?php echo (($vartipe == 'Trabajador') ? 'd-none' : 'd-block'); ?>">
				<a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
					<i class="fas fa-fw fa-wrench"></i>
					<span>Administraci&oacute;n</span>
				</a>

				<div class="dropdown-menu " aria-labelledby="pagesDropdown">
					<a class="dropdown-item" href="<?php echo base_url() ?>index.php/configuracion">Configuraci&oacute;n</a>
					<a class="dropdown-item" href="<?php echo base_url() ?>index.php/usuarios">Usuarios</a>
					<a class="dropdown-item" href="<?php echo base_url() ?>index.php/roles">Roles</a>
					<a class="dropdown-item" href="<?php echo base_url() ?>index.php/cajas">Cajas</a>
					<a class="dropdown-item" href="<?php echo base_url() ?>index.php/logs">Logs de acceso</a>
					<a class="dropdown-item" href="<?php echo base_url() ?>index.php/respaldo">Respaldo</a>
				</div>
			</li>
		</ul>

		<div id="content-wrapper">

			<div class="container-fluid">