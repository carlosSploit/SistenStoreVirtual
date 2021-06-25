<!--
	Copyright (c) 2020 Codigos de Programacion
	Punto de Venta CDP
	Desarrollado por Codigos de Programacion
	www.codigosdeprogramacion.com
-->

<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12">
		
		<h4><?php echo $title; ?></h4>
		
		<?php if (validation_errors()) : ?>
		<div class="alert alert-danger col-md-12" role="alert">
			<?php echo validation_errors();  ?>
		</div>
		
		<?php endif; ?>
		
		<form method="post" action="<?php echo base_url() ?>index.php/clientes/insertar" autocomplete="off">
			<br>
			<div class="form-group">
				<label for="nombre"><span class="text-danger">*</span>Nombre</label>
				<div class="control">
					<input class="form-control" id="nombre" type="text" name="nombre" aria-describedby="helpNombre" onBlur="validaNombre(this.value, this, '.help-block');" placeholder="Escribe aquí el nombre" autofocus required>
					<span class="help-block"></span>
				</div>
			</div>

			<div class="form-group">
				<label for="direccion">Direcci&oacute;n</label>
				<div class="control">
					<input class="form-control" id="direccion" type="text" name="direccion" placeholder="Escribe aquí la direcci&oacute;n">
				</div>
			</div>

			<div class="form-group">
				<div class="row">
					<div class="col-12 col-sm-6">
						<label for="telefono">Teléfono:</label>
						<input class="form-control" id="telefono" type="text" name="telefono" placeholder="Escribe aquí el tel&eacute;no direcci&oacute;n">
					</div>
						
					<div class="col-12 col-sm-6">
						<label for="correo">Correo electr&oacute;nico</label>
						<input class="form-control" id="correo" type="email" name="correo" placeholder="Escribe aquí el correo electr&oacute;nico">
					</div>
				</div>
			</div>

			<div class="form-group">
				<div class="row">
					<div class="col-12">
						<label class="text-danger">( * ) Campo obligatorio</label>
					</div>
				</div>
			</div>
			
			<a href="<?php echo base_url() ?>index.php/clientes" class="btn btn-primary">Volver</a>
			<button class="btn btn-success" type="submit">Guardar</button>
		</form>
	</div>
</div>

<script type="text/javascript">

	$(document).on("keypress", 'form', function (e) {
		var code = e.keyCode || e.which;
		console.log(code);
		if (code == 13) {
			console.log('Inside');
			e.preventDefault();
			return false;
		}
	});
</script>