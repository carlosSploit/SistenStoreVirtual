<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12">

		<h4><?php echo $title; ?></h4>

		<!-- < if (validation_errors()) : ?>
			<div class="alert alert-danger col-md-12" role="alert">
				< echo validation_errors();  ?>
			</div>
		< endif; ?> -->

		<form id="form_unida" method="post" action="<?php echo base_url() ?>index.php/unidades/actualizar" autocomplete="off">

			<input type="hidden" name="id" value="<?php echo $dato->id; ?>">

			<div class="form-group">
				<div class="row">
					<div id="divNombre" class="col-12 col-sm-6">
						<label for="nombre"><span class="text-danger">*</span> Nombre</label>
						<input onkeypress="limit(this.value,'nombre',50)" class="form-control" id="nombre" type="text" name="nombre" aria-describedby="helpNombre" onBlur="validaNombre(this.value, this, '.help-block');" placeholder="Escribe aquí el nombre" value="<?php echo $dato->nombre; ?>" autofocus>
						<span class="help-block"></span>
					</div>

					<div class="col-12 col-sm-6">
						<label for="nombre_corto"><span class="text-danger">*</span> Nombre corto</label>
						<input onkeypress="limit(this.value,'nombre_corto',20)" class="form-control" id="nombre_corto" type="text" name="nombre_corto" placeholder="Escribe aquí el nombre corto" value="<?php echo $dato->nombre_corto; ?>">
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

			<a href="<?php echo base_url() ?>index.php/unidades" class="btn btn-primary">Volver</a>
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