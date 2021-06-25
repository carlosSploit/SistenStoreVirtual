<!--
	Copyright (c) 2020 Codigos de Programacion
	Punto de Venta CDP
	Desarrollado por Codigos de Programacion
	www.codigosdeprogramacion.com
-->



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
						<select id="caja" name="caja" class="form-control" required >
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
						<button type="submit" class="btn btn-success">Generar reporte</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>