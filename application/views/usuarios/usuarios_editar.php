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
		
		<form method="post" action="<?php echo base_url() ?>index.php/usuarios/actualizar" autocomplete="off">
			
			<input type="hidden" name="id" value="<?php echo $dato->id; ?>">
			<input type="hidden" name="id_caja_org" value="<?php echo $dato->id_caja; ?>">

			<div class="form-group">
				<div class="row">
					<div class="col-12 col-sm-6">
						<label for="usuario"><span class="text-danger">*</span>Usuario:</label>
						<input class="form-control" id="usuario" type="text" name="usuario" placeholder="Escribe aquí el usuario" value="<?php echo $dato->usuario; ?>" readonly >
					</div>

					<div class="col-12 col-sm-6">
						<label for="nombre"><span class="text-danger">*</span>Nombre:</label>
						<input class="form-control" id="nombre" type="text" name="nombre" placeholder="Escribe aquí el nombre" value="<?php echo $dato->nombre; ?>" autofocus required>
					</div>
				</div>
			</div>

			<div class="form-group">
				<div class="row">
					<div class="col-12 col-sm-6">
						<label for="id_rol"><span class="text-danger">*</span>Rol:</label>
						<select class="form-control" id="id_rol" name="id_rol" required>
							<option value="">Seleccionar rol</option>
							<?php foreach ($roles as $rol) { ?>
								<option value="<?php echo $rol->id; ?>" <?php if($rol->id == $dato->id_rol) { echo 'selected'; } ?>><?php echo $rol->nombre; ?></option>
							<?php } ?>
						</select>
					</div>

					<div class="col-12 col-sm-6">
						<label for="id_caja"><span class="text-danger">*</span>Caja:</label>
						<select class="form-control" id="id_caja" name="id_caja" required>
							<option value="">Seleccionar caja</option>
							<?php foreach ($cajas as $caja) { ?>
								<option value="<?php echo $caja->id; ?>" <?php if($caja->id == $dato->id_caja) { echo 'selected'; } ?>><?php echo $caja->nombre; ?></option>
							<?php } ?>
						</select>
					</div>
				</div>
			</div>

			<div class="form-group">
				<div class="row">
					<div class="col-12">
						<label class="text-danger">( * ) Campo obligatorio</label>
					</div>
				</div>
			</div>
			<?php if($funcion==1) { ?>
				<a href="<?php echo base_url() ?>index.php/usuarios" class="btn btn-primary">Volver</a>
			<?php } else if($funcion==0){ ?>
				<a href="<?php echo base_url() ?>index.php/usuarios/perfil/<?php echo $dato->id; ?>" class="btn btn-primary">Volver</a>
			<?php } ?>
			<button class="btn btn-success" type="submit">Guardar</button>
		</form>
	</div>
</div>

<script type="text/javascript">

	$(document).on("keypress", 'form', function (e) {
		var code = e.keyCode || e.which;
		console.log(code);
		if (code == 13) {
			console.log('Inside');
			e.preventDefault();
			return false;
		}
	});
</script>