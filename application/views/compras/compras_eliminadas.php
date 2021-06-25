<!--
	Copyright (c) 2019 Codigos de Programacion
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
     "order": [[0, "asc" ]],
     "ajax":{
              url :  base_url+'index.php/compras/mostrarCompras',
			  type : 'POST',
			  data: { activo: "0" }
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
					<a href="<?php echo base_url() ?>index.php/compras" class="btn btn-info" data-toggle='tooltip' title='Ver compras'>Compras</a>
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
						</tr>
					</thead>
					<tbody>

					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>