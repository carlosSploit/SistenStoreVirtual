<!--
	Copyright (c) 2020 Codigos de Programacion
	Punto de Venta CDP
	Desarrollado por Codigos de Programacion
	www.codigosdeprogramacion.com
-->

<script>
	$(document).ready(function(e){
		var base_url = "<?php echo base_url();?>";
		$('#dataTable').DataTable({
			"pageLength" : 10,
			"serverSide": true,
			"order": [[3, "desc" ]],
			"ajax":{
					url :  base_url+'index.php/ventas/mostrarVentas',
					type : 'POST',
					data: { activo: "0" }
					},
		});
	});

	$(document).ready(function() {
		$('[data-toggle="tooltip"]').tooltip()
	});
</script>

<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12">
		<div class="panel">
			<h4><?php echo $titulo; ?></h4>
			<div class="centrado">
				<p>
					<a href="<?php echo base_url() ?>index.php/ventas" class="btn btn-info">Ventas</a>
				</p>
			</div>
			<div class="table-responsive">
				<table class="table table-bordered table-hover table-sm" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>Folio</th>
							<th>Cliente</th>
							<th>Total</th>
							<th>Fecha</th>
							<th>Cajero</th>
							<th width="3%"></th>
						</tr>
					</thead>
					<tbody>

					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
