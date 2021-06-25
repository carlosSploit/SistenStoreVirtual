<!--
	Copyright (c) 2019 Codigos de Programacion
	Punto de Venta CDP
	Desarrollado por Codigos de Programacion
	www.codigosdeprogramacion.com
-->

<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12">
		
		<h4><?php echo $title; ?></h4>
		
		<?php if (validation_errors()) : ?>
		<div class="alert alert-danger" role="alert">
			<?php echo validation_errors();  ?>
		</div>
		<?php endif; ?>

		<div class="card mb-3" style="max-width: 540px;">
			<div class="row no-gutters">
    			<div class="col-md-4">
					<img src="<?php echo base_url() ?>/images/blank-profile.png" class="img-thumbnail " >
    			</div>
    			<div class="col-md-8">
      				<div class="card-body">
        				<h5 class="card-title"><?php echo $dato->nombre; ?></h5>
						<table width="90%">
							<tr>
								<td width="30%"><b>Usuario:</b></td>
								<td width="70%"><?php echo $dato->usuario; ?></td>
							</tr>
							<tr>
								<td><b>Rol:</b></td>
								<td><?php echo $dato->rol; ?></td>
							</tr>
							<tr>
								<td><b>Caja:</b></td>
								<td><?php echo $dato->caja; ?></td>
							</tr>
							</table>
						<!--<p class="card-text"><?php echo $dato->usuario; ?></p>
						<p class="card-text"><?php echo $dato->rol; ?></p>
						<p class="card-text"><?php echo $dato->caja; ?></p>-->
      				</div>
    			</div>
  			</div>
		</div>
		
		<a href="<?php echo base_url() . "index.php/usuarios/editar/" . $dato->id. "/0" ?>" class="btn btn-success">Actualizar informaci&oacute;n</a>
	</div>
</div>