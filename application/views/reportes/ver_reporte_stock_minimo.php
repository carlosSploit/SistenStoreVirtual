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

			<div class="embed-responsive embed-responsive-4by3" style="margin-top: 25px;">
				<iframe class="embed-responsive-item" style="max-height: 90%; " src="<?php echo base_url() . "index.php/reportes/pdf_reporte_stock_minimo"; ?>"></iframe>
			</div>
		</div>
	</div>
</div>