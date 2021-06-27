<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12">
		<div class="panel">

			<h4><?php echo $titulo; ?></h4>

			<form id="form_reporte" name="form_reporte" class="form-horizontal" method="post" action="muestra_reporte_ventas" autocomplete="off">
				<div class="form-row">
					<div class="form-group col-md-4">
						<label><span class="text-danger">*</span>Fecha de inicio:</label>
						<input type='date' id="fecha_inicio" name="fecha_inicio" class="form-control" required />
					</div>

					<div class="form-group col-md-4">
						<label><span class="text-danger">*</span>Fecha de fin:</label>
						<input type='date' id="fecha_fin" name="fecha_fin" class="form-control" required />
					</div>

					<div class="form-group col-md-4">
						<label><span class="text-danger">*</span>Caja:</label>
						<select id="caja" name="caja" class="form-control" required>
							<option value="0">Todas</option>
							<?php foreach ($cajas as $caja) { ?>
								<option value="<?php echo $caja->id; ?>"><?php echo $caja->nombre; ?></option>
								<?php } ?>>
						</select>
					</div>
				</div>

				<div class="form-group">
					<div class="row">
						<div class="col-12">
							<label class="text-danger">( * ) Campo obligatorio</label>
						</div>
					</div>
				</div>

				<div class="form-row">
					<div class="form-group col-md-12">
						<button type="button" id="butacped" class="btn btn-success">Generar reporte</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript">
	$("#butacped").click(function(e) {
		if (validador()) {
			notify(1, "Realizo", "El reporte se realizó con exito", 'R', "success");
			setTimeout(messeg(), 4000);
		} else {
			notify(1, "Realizo", "Error de reporte", 'R', "error");
		}
	});

	/* Validacion de agregar */
	function validador() {
		var valida = false;
		if (($("#fecha_inicio").val() != "") && ($("#fecha_fin").val() != "") && ($("#caja").val() != "")) {
			valida = true;
		}
		return valida;
	}

	function messeg() {
		$("#form_reporte").submit();
	}
</script>