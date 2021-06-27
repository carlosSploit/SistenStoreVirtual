<script>
	$(document).ready(function() {
		$('#dataTable').DataTable({
			"order": [
				[1, "asc"]
			]
		});
	});

	$(document).ready(function() {
		$('[data-toggle="tooltip"]').tooltip()
	});
</script>

<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12">

		<h4><?php echo $titulo; ?></h4>
		<div class="centrado">
			<p>
				<a href="<?php echo base_url() ?>index.php/unidades" class="btn btn-info">Unidades</a>
			</p>
		</div>

		<div class="table-responsive">
			<table class="table table-bordered table-hover table-sm" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>Id</th>
						<th>Nombre</th>
						<th>Nombre corto</th>
						<th width="3%"></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($datos as $dato) { ?>
						<tr>
							<td><?php echo $dato->id; ?></td>
							<td><?php echo $dato->nombre; ?></td>
							<td><?php echo $dato->nombre_corto; ?></td>
							<td>
								<a href="#" data-href="<?php echo base_url() . "index.php/unidades/reingresar/" . $dato->id ?>" data-toggle="modal" data-target="#confirm-delete" data-placement="top" title="Reingresar registro">
									<span class="fas fa-arrow-alt-circle-up"></span>
								</a>
							</td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<br>

<!-- Modal -->
<div class="modal" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Reingresar registro</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<p>¿Desea reingresar este registro?</p>
			</div>
			<div class="modal-footer">
				<a class="btn btn-light" data-dismiss="modal">Cancelar</a>
				<a class="btn btn-light" data-dismiss="modal">No</a>
				<a class="btn btn-danger btn-ok">Si</a>
			</div>
		</div>
	</div>
</div>

<script>
	$('#confirm-delete').on('show.bs.modal', function(e) {
		$(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));

		$('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
	});
</script>