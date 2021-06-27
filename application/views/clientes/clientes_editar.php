<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12">

		<h4><?php echo $title; ?></h4>

		<?php if (validation_errors()) : ?>
			<div class="alert alert-danger col-md-12" role="alert">
				<?php echo validation_errors();  ?>
			</div>
		<?php endif; ?>

		<form method="post" action="<?php echo base_url() ?>index.php/clientes/actualizar" autocomplete="off">

			<input type="hidden" name="id" value="<?php echo $dato->id; ?>">

			<div class="form-group">
				<label for="nombre"><span class="text-danger">*</span>Nombre</label>
				<div class="control">
					<input class="form-control" id="nombre" type="text" name="nombre" placeholder="Escribe aquí el nombre" value="<?php echo htmlspecialchars($dato->nombre); ?>" autofocus required>
				</div>
			</div>

			<div class="form-group">
				<label for="direccion">Direcci&oacute;n</label>
				<div class="control">
					<input class="form-control" id="direccion" type="text" name="direccion" placeholder="Escribe aquí la direcci&oacute;n" value="<?php echo $dato->direccion; ?>">
				</div>
			</div>

			<div class="form-group">
				<div class="row">
					<div class="col-12 col-sm-6">
						<label for="telefono">Teléfono:</label>
						<input class="form-control" id="telefono" type="text" name="telefono" placeholder="Escribe aquí el tel&eacute;no direcci&oacute;n" value="<?php echo $dato->telefono; ?>">
					</div>

					<div class="col-12 col-sm-6">
						<label for="correo">Correo electr&oacute;nico</label>
						<input class="form-control" id="correo" type="email" name="correo" placeholder="Escribe aquí el correo electr&oacute;nico" value="<?php echo $dato->correo; ?>">
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
	$(document).on("keypress", 'form', function(e) {
		var code = e.keyCode || e.which;
		console.log(code);
		if (code == 13) {
			console.log('Inside');
			e.preventDefault();
			return false;
		}
	});

	function validador() {
		var valida = false;
		if (($("#nombre").val() != "") || ($("#direccion").val() != "") || ($("#telefono").val() != "") || ($("#correo").val() != "")) {
			valida = true;
		}
		return valida;
	}
</script>