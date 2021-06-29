<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12">

		<h4><?php echo $title; ?></h4>

		<!-- < if (validation_errors()) : ?>
			<div class="alert alert-danger col-md-12" role="alert">
				< echo validation_errors();  ?>
			</div>
		< endif; ?> -->

		<form id="form_cliente" method="post" action="<?php echo base_url() ?>index.php/clientes/insertar" autocomplete="off">
			<br>
			<div class="form-group">
				<label for="nombre"><span class="text-danger">*</span>Nombre</label>
				<div class="control">
					<input onkeypress="limit(this.value,'nombre',80)" class="form-control" id="nombre" type="text" name="nombre" aria-describedby="helpNombre" onBlur="validaNombre(this.value, this, '.help-block');" placeholder="Escribe aquí el nombre" autofocus>
					<span class="help-block"></span>
				</div>
			</div>

			<div class="form-group">
				<label for="direccion">Direcci&oacute;n</label>
				<div class="control">
					<input onkeypress="limit(this.value,'direccion',150)" class="form-control" id="direccion" type="text" name="direccion" placeholder="Escribe aquí la direcci&oacute;n">
				</div>
			</div>

			<div class="form-group">
				<div class="row">
					<div class="col-12 col-sm-6">
						<label for="telefono">Teléfono:</label>
						<input onkeypress="limit(this.value,'telefono',9)" type="number" class="form-control" id="telefono" name="telefono" placeholder="Escribe aquí el tel&eacute;no direcci&oacute;n">
					</div>

					<div class="col-12 col-sm-6">
						<label for="correo">Correo electr&oacute;nico</label>
						<input onkeypress="limit(this.value,'correo',40)" class="form-control" id="correo" type="email" name="correo" placeholder="Escribe aquí el correo electr&oacute;nico">
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
			<button class="btn btn-success" type="submit" id="guardar">Guardar</button>
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
</script>