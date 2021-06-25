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
     "order": [[2, "desc" ]],
     "ajax":{
              url :  base_url+'index.php/compras/mostrarCompras',
			  type : 'POST',
			  data: { activo: "1" }
            },
  });
});

$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip();
});
</script>

<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12">
		<div class="panel">
			<h4><?php echo $titulo; ?></h4>
			<div class="centrado">
				<p>
					<a href="<?php echo base_url() ?>index.php/compras/eliminadas" class="btn btn-warning" data-toggle='tooltip' title='Ver compras eliminadas'>Eliminadas</a>
				</p>
			</div>
			<div class="table-responsive">
				<table class="table table-bordered table-hover table-sm" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>Folio</th>
							<th>Total</th>
							<th>Fecha</th>
							<th>Cajero</th>
							<th width="3%"></th>
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

<!-- Modal -->
<div class="modal" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Cancelar compra</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<p>¿Desea cancelar esta compra?</p>
			</div>
			<div class="modal-footer">
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