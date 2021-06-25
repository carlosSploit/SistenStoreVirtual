<!--
	Copyright (c) 2020 Codigos de Programacion
	Punto de Venta CDP
	Desarrollado por Codigos de Programacion
	www.codigosdeprogramacion.com
-->

<script>
	$(document).ready(function() {
		$('#dataTable').DataTable({
			"order": [[1, "asc"]]
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
				<a href="<?php echo base_url() ?>index.php/usuarios/agregar" class="btn btn-info">Agregar</a>
				<a href="<?php echo base_url() ?>index.php/usuarios/eliminados" class="btn btn-warning">Eliminados</a>
			</p>
		</div>
		
		<div class="table-responsive">
			<table class="table table-bordered table-hover table-sm" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>#</th>
						<th>Usuario</th>
						<th>Nombre</th>
						<th>Caja</th>
						<th>Rol</th>
						<th>&Uacute;ltimo inicio</th>
						<th width="3%"></th>
						<th width="3%"></th>
						<th width="3%"></th>
					</tr>
				</thead>
				<tbody>
					<?php $a=1; foreach ($datos as $dato) { ?>
						<tr>
							<td><?php echo $a; ?></td>
							<td><?php echo $dato->usuario; ?></td>
							<td><?php echo $dato->nombre; ?></td>
							<td><?php echo $dato->caja; ?></td>
							<td><?php echo $dato->rol; ?></td>
							<td><?php echo $dato->last_session; ?></td>
							<td>
								<a href="<?php echo base_url() . "index.php/usuarios/editar_password/" . $dato->id ?>" data-toggle="tooltip" data-placement="top" title="Cambiar contrase&ntilde;a">
									<span class='fas fa-fw fa-wrench'></span>
								</a>
							</td>
							<td>
								<a href="<?php echo base_url() . "index.php/usuarios/editar/" . $dato->id . "/1" ?>" data-toggle="tooltip" class="button" data-placement="top" title="Modificar registro">
									<span class='fas fa-edit'></span>
								</a>
							</td>
							<td>
								<a href="#" data-href="<?php echo base_url() . "index.php/usuarios/eliminar/" . $dato->id ?>" data-toggle="modal" data-target="#confirm-delete" title="Eliminar registro">
									<span class="fas fa-trash-alt"></span>
								</a>
							</td>
						</tr>
					<?php $a++; } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<div class="modal" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Eliminar registro</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<p>¿Desea eliminar este registro?</p>
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
	$('#confirm-delete').on('show.bs.modal', function(event) {
		$(this).find('.btn-ok').attr('href', $(event.relatedTarget).data('href'));
		
		$('.debug-url').html('Delete URL: <strong>' + $(this).find('.btn-ok').attr('href') + '</strong>');
	});
</script>	