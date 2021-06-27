<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12">

		<h4><?php echo $title; ?></h4>

		<?php if (validation_errors()) : ?>
			<div class="alert alert-danger col-md-12" role="alert">
				<?php echo validation_errors();  ?>
			</div>

		<?php endif; ?>

		<form id="form_unida" method="post" action="<?php echo base_url() ?>index.php/unidades/insertar" autocomplete="off">
			<div class="form-group">
				<div class="row">
					<div id="divNombre" class="col-12 col-sm-6">
						<label for="nombre"><span class="text-danger">*</span> Nombre</label>
						<input class="form-control" id="nombre" type="text" name="nombre" aria-describedby="helpNombre" onBlur="validaNombre(this.value, this, '.help-block');" placeholder="Escribe aquí el nombre" autofocus required>
						<span class="help-block"></span>
					</div>

					<div class="col-12 col-sm-6">
						<label for="nombre_corto"><span class="text-danger">*</span> Nombre corto</label>
						<input class="form-control" id="nombre_corto" type="text" name="nombre_corto" placeholder="Escribe aquí el nombre corto" required>
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
			notify(1, "Insertar", "La unidad se a insertado con exito", 'R', "success");
			setTimeout(messeg(), 4000);
		} else {
			notify(1, "Insertar", "La unidad se a insertado con exito", 'R', "error");
		}
	});

	function validador() {
		var valida = false;
		if (($("#nombre").val() != "") || ($("#nombre_corto").val() != "")) {
			valida = true;
		}
		return valida;
	}

	function messeg() {
		$("#form_unida").submit();
	}

	function validaNombre(nombre, tagNombre, tagSpan) {

		$.ajax({
			url: '<?php echo base_url(); ?>index.php/unidades/validarNombre/' + nombre,
			success: function(response) {
				if (response > 0) {
					$(tagSpan).text('El nombre ya existe');
					$(divNombre).addClass("form-group has-error");
					$(tagNombre).val('');
				} else {
					$(tagSpan).text('');
					$(divNombre).removeClass("has-error");
				}
			},

			error: function() {
				console.log("No se ha podido obtener la información");
			}
		});
	}
</script>