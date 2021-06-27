<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12">

		<h4><?php echo $title; ?></h4>

		<?php if (validation_errors()) : ?>
			<div class="alert alert-danger col-md-12" role="alert">
				<?php echo validation_errors();  ?>
			</div>
		<?php endif; ?>

		<form method="post" action="<?php echo base_url() ?>index.php/categorias/actualizar" autocomplete="off">

			<input type="hidden" name="id" value="<?php echo $dato->id; ?>">

			<div id="divNombre" class="form-group">
				<label for="nombre"><span class="text-danger">*</span> sNombre</label>
				<div class="control">
					<input class="form-control" id="nombre" type="text" name="nombre" aria-describedby="helpNombre" placeholder="Escribe aquí el nombre" value="<?php echo $dato->nombre; ?>" autofocus required>
					<span class="help-block"></span>
				</div>
			</div>

			<div class="form-group">
				<div class="row">
					<div class="col-12">
						<label class="text-danger">( * ) Campo obligatorio</label>
					</div>
				</div>
			</div>

			<a href="<?php echo base_url() ?>index.php/categorias" class="btn btn-primary">Volver</a>
			<button class="btn btn-success" type="button" id="guardar">Guardar</button>
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

	$("#guardar").click(function(e) {
		if (validador()) {
			notify(1, "Editar", "La Categoria se a editar con exito", 'R', "success");
			setTimeout(messeg(), 4000);
		} else {
			notify(1, "Editar", "La Categoria se a editar con exito", 'R', "error");
		}
	});

	/* Validacion de agregar */
	function validad() {
		var band = false;
		if ($("#nombre").val() != "") {
			band = true;
		}
		return band;
	}

	function messeg() {
		$("#form_categoria").submit();
	}
</script>