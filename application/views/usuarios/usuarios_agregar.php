<!--
	Copyright (c) 2019 Codigos de Programacion
	Punto de Venta CDP
	Desarrollado por Codigos de Programacion
	www.codigosdeprogramacion.com
-->

<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12">
		
		<h4><?php echo $title; ?></h4>
		
		<?php if (validation_errors()) : ?>
		<div class="alert alert-danger" role="alert">
			<?php echo validation_errors();  ?>
		</div>
		<?php endif; ?>
		
		<form method="post" action="<?php echo base_url() ?>index.php/usuarios/insertar" autocomplete="off">

			<div class="form-group">
				<div class="row">
					<div id="divUsuario" class="col-12 col-sm-6">
						<label for="usuario"><span class="text-danger">*</span>Usuario:</label>
						<input class="form-control" id="usuario" type="text" name="usuario" aria-describedby="helpUsuario" onBlur="validaUsuario(this.value, this, '.help-block');" placeholder="Escribe aquí el usuario" value="<?php echo set_value('usuario'); ?>" autofocus required>
						<span class="help-block"></span>
					</div>

					<div class="col-12 col-sm-6">
						<label for="nombre"><span class="text-danger">*</span>Nombre:</label>
						<input class="form-control" id="nombre" type="text" name="nombre" placeholder="Escribe aquí el nombre" value="<?php echo set_value('nombre'); ?>" required>
					</div>
				</div>
			</div>
			
			<div class="form-group">
				<div class="row">
					<div class="col-12 col-sm-6">
						<label for="password"><span class="text-danger">*</span>Contrase&ntilde;a:</label>
						<input class="form-control" id="password" type="password" name="password" placeholder="Escribe aquí la contrase&ntilde;a" required>
					</div>

					<div class="col-12 col-sm-6">
						<label for="repassword"><span class="text-danger">*</span>Confirmar contrase&ntilde;a:</label>
						<input class="form-control" id="repassword" type="password" name="repassword" placeholder="Escribe aquí la contrase&ntilde;a" required>
					</div>
				</div>
			</div>

			<div class="form-group">
				<div class="row">
					<div class="col-12 col-sm-6">
						<label for="id_rol"><span class="text-danger">*</span>Rol:</label>
						<select class="form-control" id="id_rol" name="id_rol" required>
							<option value="">Seleccionar rol</option>
							<?php foreach ($roles as $rol) { ?>
								<option value="<?php echo $rol->id; ?>"><?php echo $rol->nombre; ?></option>
							<?php } ?>
						</select>
					</div>

					<div class="col-12 col-sm-6">
						<label for="id_caja"><span class="text-danger">*</span>Caja:</label>
						<select class="form-control" id="id_caja" name="id_caja" required>
							<option value="">Seleccionar caja</option>
							<?php foreach ($cajas as $caja) { ?>
								<option value="<?php echo $caja->id; ?>"><?php echo $caja->nombre; ?></option>
							<?php } ?>
						</select>
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
			
			<a href="<?php echo base_url() ?>index.php/usuarios" class="btn btn-primary">Volver</a>
			<button class="btn btn-success" type="submit">Guardar</button>
		</form>
	</div>
</div>

<script type="text/javascript">
	function validaUsuario(usuario, tagUsuario, tagSpan) {
		
		$.ajax({
			url: '<?php echo base_url(); ?>index.php/usuarios/validarUsuario/' + usuario,
			success: function(response) {
				if (response > 0) {
					$(tagSpan).text('El usuario ya existe');
					$(divUsuario).addClass("form-group has-error");
					$(tagUsuario).val('');
					} else {
					$(tagSpan).text('');
					$(divUsuario).removeClass("has-error");
				}
			},
			
			error: function() {
				console.log("No se ha podido obtener la información");
			}
		});
	}

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