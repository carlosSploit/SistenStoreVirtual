<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12">
		<div class="panel">
			<h4><?php echo $title; ?></h4>

			<!--  if (validation_errors()) : ?>
				<-------------------Alerta en messeng----------------------->
			<!-- <div id="vanillatoasts-container" class="toasts-top-right"></div> -->
			<!-------------------------------------------------------------->
			<!-- <script type="text/javascript">
					notify(1, "Insercion", "Producto se a actualizado con exito", "R", "error");
				</script> -->
			<!-- <div class="bg-danger col-md-4">
					< echo validation_errors();  ?>
				</div> -->
			<br>
			<!--  endif; ?> -->

			<form id="form_product" method="post" action="<?php echo base_url() ?>index.php/productos/insertar" autocomplete="off">
				<br>
				<div id="divCodigo" class="form-group">
					<div class="row">
						<div class="col-4">
							<label for="codigo"><span class="text-danger">*</span>C&oacute;digo</label>
							<input onkeypress="limit(this.value,'codigo',20)" class="form-control" id="codigo" type="text" name="codigo" aria-describedby="helpCodigo" onBlur="validaCodigo(this.value, this, '.help-block');" placeholder="Escribe aquí el código del producto" autofocus>
							<span class="help-block"></span>
						</div>

						<div class="col-8">
							<label for="nombre"><span class="text-danger">*</span>Nombre</label>
							<input onkeypress="limit(this.value,'nombre',200)" class="form-control" id="nombre" type="text" name="nombre" placeholder="Escribe aquí el nombre">
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="row">
						<div class="col">
							<label for="id_unidad"><span class="text-danger">*</span>Unidad</label>
							<select class="form-control" id="id_unidad" name="id_unidad">
								<option value="">Seleccione unidad</option>
								<?php foreach ($unidades as $uni) { ?>
									<option value="<?php echo $uni->id; ?>"><?php echo $uni->nombre; ?></option>
								<?php } ?>
							</select>
						</div>

						<div class="col">
							<label for="id_categoria"><span class="text-danger">*</span>Categor&iacute;a</label>
							<select class="form-control" id="id_categoria" name="id_categoria">
								<option value="">Seleccione categor&iacute;a</option>
								<?php foreach ($categorias as $cat) { ?>
									<option value="<?php echo $cat->id; ?>"><?php echo $cat->nombre; ?></option>
								<?php } ?>
							</select>
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="row">
						<div class="col">
							<label for="precio_venta"><span class="text-danger">*</span>Precio de venta</label>
							<input onkeypress="limit(this.value,'precio_venta',12)" class="form-control" id="precio_venta" type="number" step=".01" name="precio_venta" onkeypress="return validateDecimal(this.value);" placeholder="Escribe aquí el precio de venta">
						</div>

						<div class="col">
							<label for="precio_compra">Precio de compra</label>
							<input onkeypress="limit(this.value,'precio_compra',12)" class="form-control" id="precio_compra" type="number" step=".01" name="precio_compra" onkeypress="return validateDecimal(this.value);" placeholder="Escribe aquí el precio de compra">
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="row">
						<div class="col">
							<label for="precio_venta"><span class="text-danger">*</span>Es inventariable</label>
							<select class="form-control" id="inventariable" name="inventariable">
								<option value="1">Si</option>
								<option value="0">No</option>
							</select>
						</div>

						<div class="col">
							<label for="precio_compra">Stock m&iacute;nimo</label>
							<input onkeypress="limit(this.value,'stock_minimo',5)" type="number" class="form-control" id="stock_minimo" name="stock_minimo" onkeypress="return validateDecimal(this.value);" placeholder="Escribe aquí el stock m&iacute;nimo">
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

				<a href="<?php echo base_url() ?>index.php/productos" class="btn btn-primary">Volver</a>
				<button class="btn btn-success" type="submit" id="">Guardar</button>
			</form>
		</div>
	</div>
</div>

<script type="text/javascript">
	function validaCodigo(codigo, tagCodigo, tagSpan) {
		if (codigo != '' || codigo !== null) {
			$.ajax({
				url: '< echo base_url(); ?>index.php/productos/validarCodigo/' + codigo,
				success: function(response) {
					if (response > 0) {
						$(tagSpan).text('El codigo ya existe');
						$(divCodigo).addClass("form-group has-error");
						$(tagCodigo).val('');
					} else {
						$(tagSpan).text('');
						$(divCodigo).removeClass("has-error");
					}
				},

				error: function() {
					console.log("No se ha podido obtener la información");
				}
			});
		}
	}
</script>

<script type="text/javascript">
	// $(document).on("keypress", 'form', function(e) {
	// 	var code = e.keyCode || e.which;
	// 	if (code == 13) {
	// 		e.preventDefault();
	// 		return false;
	// 	}
	// });

	function validateDecimal(valor) {
		var RE = /^\d*\.?\d*$/;
		if (RE.test(valor)) {
			return true;
		} else {
			return false;
		}
	}

	$(document).ready(function() {
		$("#inventariable").change(function() {
			var option = $(this).children("option:selected").val();

			if (option == 1) {
				$("#stock_minimo").prop('disabled', false);
			} else {
				$("#stock_minimo").prop('disabled', true);
				$("#stock_minimo").val(0);
			}
		});
	});
</script>