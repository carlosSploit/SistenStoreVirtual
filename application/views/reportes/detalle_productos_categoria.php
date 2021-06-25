<!--
	Copyright (c) 2019 Codigos de Programacion
	Punto de Venta CDP
	Desarrollado por Codigos de Programacion
	www.codigosdeprogramacion.com
-->
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12">
		<div class="panel">

			<h4><?php echo $titulo; ?></h4>

			<form id="form_reporte" name="form_reporte" class="form-horizontal" method="post" action="muestra_productos_categoria" autocomplete="off">
				<div class="form-row">
					<div class="form-group col-md-6">
						<label><span class="text-danger">*</span> Categor&iacute;a:</label>
						<select id="categoria" name="categoria" class="form-control" required>
						<option value="">Seleccionar categor&iacute;a</option>
						<?php foreach ($categorias as $categoria) { ?>
								<option value="<?php echo $categoria->id; ?>"><?php echo $categoria->nombre; ?></option>
							<?php } ?>
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