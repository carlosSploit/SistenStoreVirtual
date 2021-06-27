<script>
	$(document).ready(function(e) {
		var base_url = "<?php echo base_url(); ?>";
		$('#dataTable').DataTable({
			"pageLength": 10,
			"serverSide": true,
			"order": [
				[4, "desc"]
			],
			"ajax": {
				url: base_url + 'index.php/logs/mostrarLogs',
				type: 'POST',
				data: {
					activo: "1"
				}
			},
		});
	});
</script>

<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12">
		<div class="panel">
			<h4><?php echo $titulo; ?></h4>

			<div class="table-responsive">
				<table class="table table-bordered table-hover table-sm" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>Usuario</th>
							<th>IP</th>
							<th>Evento</th>
							<th>Detalles</th>
							<th>Fecha y hora</th>
						</tr>
					</thead>
					<tbody>

					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>