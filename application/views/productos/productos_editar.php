<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12">
		<div class="panel">
			<h4><?php echo $title; ?></h4>

			<form id="form_product" method="post" action="<?php echo base_url() ?>index.php/productos/actualizar" autocomplete="off">
				<br>
				<input type="hidden" name="id" value="<?php echo $dato->id; ?>">
				<input type="hidden" name="codigo_org" value="<?php echo $dato->codigo; ?>">

				<div class="form-group">
					<div class="row">
						<div class="col-4">
							<label for="codigo"><span class="text-danger">*</span>C&oacute;digo</label>
							<input onkeypress="limit(this.value,'codigo',20)" class="form-control" id="codigo" type="text" name="codigo" placeholder="Escribe aquí el código del producto" value="<?php echo $dato->codigo; ?>">
						</div>

						<div class="col-8">
							<label for="nombre"><span class="text-danger">*</span>Nombre</label>
							<input onkeypress="limit(this.value,'nombre',200)" class="form-control" id="nombre" type="text" name="nombre" placeholder="Escribe aquí el nombre" value="<?php echo htmlspecialchars($dato->nombre); ?>">
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
									<option value="<?php echo $uni->id; ?>" <?php if ($dato->id_unidad == $uni->id) {
																				echo 'selected';
																			} ?>><?php echo $uni->nombre; ?></option>
								<?php } ?>
							</select>
						</div>

						<div class="col">
							<label for="id_categoria"><span class="text-danger">*</span>Cateogria</label>
							<select class="form-control" id="id_categoria" name="id_categoria">
								<option value="">Seleccione unidad</option>
								<?php foreach ($categorias as $cat) { ?>
									<option value="<?php echo $cat->id; ?>" <?php if ($dato->id_categoria == $cat->id) {
																				echo 'selected';
																			} ?>><?php echo $cat->nombre; ?></option>
								<?php } ?>
							</select>
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="row">
						<div class="col">
							<label for="precio_venta"><span class="text-danger">*</span>Precio de venta</label>
							<input onkeypress="limit(this.value,'precio_venta',8)" class="form-control" id="precio_venta" type="number" step=".01" name="precio_venta" placeholder="Escribe aquí el precio de venta" value="<?php echo $dato->precio_venta; ?>" onkeypress="return validateDecimal(this.value);">
						</div>

						<div class="col">
							<label for="precio_compra">Precio de compra</label>
							<input onkeypress="limit(this.value,'precio_compra',8)" class="form-control" id="precio_compra" type="number" step=".01" name="precio_compra" placeholder="Escribe aquí el precio de compra" value="<?php echo $dato->precio_compra; ?>" onkeypress="return validateDecimal(this.value);">
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="row">
						<div class="col">
							<label for="precio_venta"><span class="text-danger">*</span>Es inventariable</label>
							<select class="form-control" id="inventariable" name="inventariable">
								<option value="1" <?php if ($dato->inventariable == 1) {
														echo 'selected';
													} ?>>Si</option>
								<option value="0" <?php if ($dato->inventariable == 0) {
														echo 'selected';
													} ?>>No</option>
							</select>
						</div>

						<div class="col">
							<label for="precio_compra">Stock m&iacute;nimo</label>
							<input onkeypress="limit(this.value,'stock_minimo',5)" class="form-control" id="stock_minimo" type="number" min="0" name="stock_minimo" placeholder="Escribe aquí el stock m&iacute;nimo" value="<?php echo $dato->stock_minimo; ?>" <?php if ($dato->inventariable == 0) {
																																																																		echo 'disabled';
																																																																	} ?>>
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
				<button class="btn btn-success" type="submit" id="guardar">Guardar</button>
			</form>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).on("keypress", 'form', function(e) {
		var code = e.keyCode || e.which;
		if (code == 13) {
			e.preventDefault();
			return false;
		}
	});

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