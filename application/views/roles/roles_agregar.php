<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12">

		<h4><?php echo $title; ?></h4>

		<?php if (validation_errors()) : ?>
			<div class="alert alert-danger col-md-12" role="alert">
				<?php echo validation_errors();  ?>
			</div>

		<?php endif; ?>

		<form id="form_roles" method="post" action="<?php echo base_url() ?>index.php/roles/insertar" autocomplete="off">
			<br>
			<div class="form-group">
				<label for="nombre"><span class="text-danger">*</span>Nombre</label>
				<div class="control">
					<input class="form-control" id="nombre" type="text" name="nombre" placeholder="Escribe aquí el nombre" autofocus required>
				</div>
			</div>

			<div class="form-group">
				<div class="row">
					<div class="col-12">
						<label class="text-danger">( * ) Campo obligatorio</label>
					</div>
				</div>
			</div>

			<a href="<?php echo base_url() ?>index.php/roles" class="btn btn-primary">Volver</a>
			<button class="btn btn-success" type="button" id="guardar">Guardar</button>
		</form>
	</div>
</div>

<script type="text/javascript">
	$("#guardar").click(function(e) {
		if (validador()) {
			console.log("hola");
			notify(1, "Agregar", "Producto se agregó con exito", 'R', "success");
			setTimeout(messeg(), 4000);
		} else {
			notify(1, "Agregar", "Error al agregar el Producto", 'R', "error");
		}
	});

	function validador() {
		var valida = false;
		if (($("#nombre").val() != "")) {
			valida = true;
		}
		return valida;
	}

	function messeg() {
		$("#form_roles").submit();
	}

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