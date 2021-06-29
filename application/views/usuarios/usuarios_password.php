<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12">

		<h4><?php echo $title; ?></h4>

		<form method="post" action="<?php echo base_url() ?>index.php/usuarios/actualizar_password" autocomplete="off">

			<input type="hidden" name="id" value="<?php echo $dato->id; ?>">

			<div class="form-group">
				<label for="usuario">Usuario</label>
				<div class="control">
					<input class="form-control" id="usuario" type="text" name="usuario" placeholder="Escribe aquí el usuario" value="<?php echo $dato->usuario; ?>" readonly>
				</div>
			</div>

			<div class="form-group">
				<div class="row">
					<div class="col-12 col-sm-6">
						<label for="password"><span class="text-danger">*</span>Contrase&ntilde;a:</label>
						<input onkeypress="limit(this.value,'password',8)" class="form-control" id="password" type="password" name="password" placeholder="Escribe aquí la contrase&ntilde;a" autofocus>
					</div>

					<div class="col-12 col-sm-6">
						<label for="repassword"><span class="text-danger">*</span>Confirmar contrase&ntilde;a:</label>
						<input onkeypress="limit(this.value,'repassword',8)" class="form-control" id="repassword" type="password" name="repassword" placeholder="Escribe aquí la contrase&ntilde;a">
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

			<a href="<?php echo base_url() ?>index.php/usuarios" class="btn btn-primary">Volver</a>
			<button class="btn btn-success" type="submit">Guardar</button>
		</form>
	</div>
</div>

<script type="text/javascript">
	function validador() {
		var valida = false;
		if (($("#password").val() != "") && ($("#repassword").val() != "")) {
			valida = true;
		}
		return valida;
	}
	$(document).on("keypress", 'form', function(e) {
		var code = e.keyCode || e.which;
		console.log(code);
		if (code == 13) {
			console.log('Inside');
			e.preventDefault();
			return false;
		}
	});
</script>