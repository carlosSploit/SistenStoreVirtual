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
		<div class="alert alert-danger col-md-12" role="alert">
			<?php echo validation_errors();  ?>
		</div>
		<?php endif; ?>
		
		<form method="post" action="<?php echo base_url() ?>index.php/categorias/actualizar" autocomplete="off">
			
			<input type="hidden" name="id" value="<?php echo $dato->id; ?>">
			
			<div id="divNombre" class="form-group">
				<label for="nombre"><span class="text-danger">*</span> sNombre</label>
				<div class="control">
					<input class="form-control" id="nombre" type="text" name="nombre" aria-describedby="helpNombre" placeholder="Escribe aquí el nombre" value="<?php echo $dato->nombre; ?>" autofocus required>
					<span class="help-block"></span>
				</div>
			</div>

			<div class="form-group">
				<div class="row">
					<div class="col-12">
						<label class="text-danger">( * ) Campo obligatorio</label>
					</div>
				</div>
			</div>
			
			<a href="<?php echo base_url() ?>index.php/categorias" class="btn btn-primary">Volver</a>
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