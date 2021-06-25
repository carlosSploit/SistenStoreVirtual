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
     /*"pageLength" : 10,
     "serverSide": true,
     "order": [[0, "asc" ]],
     "ajax":{
              url :  base_url+'index.php/productos/mostrarProductos',
			  type : 'POST',
			  data: { activo: "1" }
            },*/
  });
});
</script>

<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12">
		<div class="panel">
			<h4><?php echo $titulo; ?></h4>
			<div class="centrado">
				<p>
					<a href="<?php echo base_url() ?>index.php/productos" class="btn btn-info">Productos</a>
					<a href="<?php echo base_url() ?>index.php/reportes/muestra_reporte_stock_minimo" class="btn btn-success">Generar reporte</a>
				</p>
			</div>

			<div class="table-responsive">
				<table class="table table-bordered table-hover table-sm" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>C&oacute;digo</th>
							<th>Nombre</th>
							<th>Precio Venta</th>
							<th>Precio Compra</th>
							<th>Existencia</th>
							<th>Stock m&iacute;nimo</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($datos as $dato) { ?>
							<tr>
								<td><?php echo $dato->codigo; ?></td>
								<td><?php echo $dato->nombre; ?></td>
								<td><?php echo number_format($dato->precio_venta, 2, '.', ','); ?></td>
								<td><?php echo number_format($dato->precio_compra, 2, '.', ','); ?></td>
								<td><?php echo $dato->existencia; ?></td>
								<td><?php echo $dato->stock_minimo; ?></td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>