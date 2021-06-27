<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12">

		<h4><?php echo $title; ?></h4>

		<?php if (validation_errors()) : ?>
			<div class="alert alert-danger col-md-12" role="alert">
				<?php echo validation_errors();  ?>
			</div>

		<?php endif; ?>

		<form id="form_categoria" method="post" action="<?php echo base_url() ?>index.php/categorias/insertar" autocomplete="off">

			<div id="divNombre" class="form-group">
				<label for="nombre"><span class="text-danger">*</span> Nombre</label>
				<div class="control">
					<input class="form-control" id="nombre" type="text" name="nombre" aria-describedby="helpNombre" onBlur="validaNombre(this.value, this, '.help-block');" placeholder="Escribe aquí el nombre" autofocus required>
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
	$("#guardar").click(function(e) {
		if (validador()) {
			notify(1, "Insertar", "La Categoria se a insertado con exito", 'R', "success");
			setTimeout(messeg(), 4000);
		} else {
			notify(1, "Insertar", "La Categoria se a insertado con exito", 'R', "error");
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

	$(document).on("keypress", 'form', function(e) {
		var code = e.keyCode || e.which;
		console.log(code);
		if (code == 13) {
			console.log('Inside');
			e.preventDefault();
			return false;
		}
	});

	function validaNombre(nombre, tagNombre, tagSpan) {

		$.ajax({
			url: '<?php echo base_url(); ?>index.php/categorias/validarNombre/' + nombre,
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