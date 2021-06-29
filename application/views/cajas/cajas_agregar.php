<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12">

		<h4><?php echo $title; ?></h4>

		<!-- < if (validation_errors()) : ?>
			<div class="alert alert-danger col-md-12" role="alert">
				< echo validation_errors();  ?>
			</div>
		< endif; ?> -->

		<form id="form_cajas" method="post" action="<?php echo base_url() ?>index.php/cajas/insertar" autocomplete="off">
			<br>

			<div class="form-group">
				<div class="row">
					<div class="col-6">
						<label for="no_caja"><span class="text-danger">*</span>N&uacute;mero de caja</label>
						<input onkeypress="limit(this.value,'no_caja',10)" class="form-control" id="no_caja" type="number" name="no_caja" placeholder="Escribe aquí el n&uacute;mero" value="" autofocus>
					</div>

					<div class="col-6">
						<label for="nombre"><span class="text-danger">*</span>Nombre</label>
						<input onkeypress="limit(this.value,'nombre',200)" class="form-control" id="nombre" type="text" name="nombre" placeholder="Escribe aquí el nombre" value="">
					</div>
				</div>
			</div>

			<div class="form-group">
				<div class="row">
					<div class="col-6">
						<label for="remision"><span class="text-danger">*</span>Remisi&oacute;n</label>
						<input onkeypress="limit(this.value,'remision',10)" class="form-control" id="remision" type="number" step="1" min="0" name="remision" placeholder="Escribe aquí la remisi&oacute;n" value="">
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

			<a href="<?php echo base_url() ?>index.php/cajas" class="btn btn-primary">Volver</a>
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