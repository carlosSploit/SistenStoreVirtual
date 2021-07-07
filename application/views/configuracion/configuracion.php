<?php
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 1 Jul 2000 05:00:00 GMT"); // Fecha en el pasado
?>
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12">
		<div class="panel">
			<h4><?php echo $titulo; ?></h4>

			<!-- < if (validation_errors()) : ?>
				<div class="bg-danger col-md-4">
					< echo validation_errors();  ?>
				</div>
				<br>
			< endif; ?> -->

			<form method="post" action="<?php echo base_url() ?>index.php/configuracion/actualizar" enctype="multipart/form-data" autocomplete="off">
				<br>

				<div class="form-group">
					<div class="row">
						<div class="col-12 col-sm-6">
							<label for="tienda_nombre"><span class="text-danger">*</span>Nombre de la tienda:</label>
							<input onkeypress="limit(this.value,'nombre',50)" class="form-control form-control-sm" id="tienda_nombre" type="text" name="tienda_nombre" value="<?php echo htmlspecialchars($this->db->get_where('configuracion', array('nombre' => 'tienda_nombre'))->row()->valor); ?>" autofocus>
						</div>

						<div class="col-12 col-sm-6">
							<label for="tienda_rfc"><span class="text-danger">*</span>RFC</label>
							<input class="form-control form-control-sm" id="tienda_rfc" type="text" name="tienda_rfc" value="<?php echo $this->db->get_where('configuracion', array('nombre' => 'tienda_rfc'))->row()->valor; ?>">
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="row">
						<div class="col-12 col-sm-6">
							<label for="tienda_telefono"><span class="text-danger">*</span>Teléfono:</label>
							<input onkeypress="limit(this.value,'tienda_telefono',9)" class="form-control form-control-sm" id="tienda_telefono" type="number" name="tienda_telefono" value="<?php echo $this->db->get_where('configuracion', array('nombre' => 'tienda_telefono'))->row()->valor; ?>">
						</div>

						<div class="col-12 col-sm-6">
							<label for="tienda_correo"><span class="text-danger">*</span>Correo electrónico</label>
							<input class="form-control form-control-sm" id="tienda_correo" type="text" name="tienda_correo" value="<?php echo $this->db->get_where('configuracion', array('nombre' => 'tienda_correo'))->row()->valor; ?>">
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="row">
						<div class="col-12 col-sm-6">
							<label for="tienda_direccion"><span class="text-danger">*</span>Direcci&oacute;n:</label>
							<textarea class="form-control form-control-sm" id="tienda_direccion" name="tienda_direccion"><?php echo htmlspecialchars($this->db->get_where('configuracion', array('nombre' => 'tienda_direccion'))->row()->valor); ?></textarea>
						</div>

						<div class="col-12 col-sm-6">
							<label for="ticket_leyenda"><span class="text-danger">*</span>Leyenda ticket</label>
							<textarea class="form-control form-control-sm" id="ticket_leyenda" name="ticket_leyenda"><?php echo htmlspecialchars($this->db->get_where('configuracion', array('nombre' => 'ticket_leyenda'))->row()->valor); ?></textarea>
						</div>
					</div>
				</div>

				<div class="form-group">
					<label for="tienda_logo">Logotipo</label><br />
					<img id="load_img" class="img-responsive" src="<?php echo base_url() . 'images/logo.png?n=' . time(); ?>" alt="Logo" width="200" /> <br />
					<input type="file" id="tienda_logo" name="tienda_logo" accept="image/png" onChange='upload_image();'>
					<p class="help-block">Cargar imagen en formato png de 200x200 píxeles</p>
				</div>

				<div class="form-group">
					<div class="row">
						<div class="col-12">
							<label class="text-danger">( * ) Campo obligatorio</label>
						</div>
					</div>
				</div>

				<button class="btn btn-success" type="submit">Guardar</button>
			</form>
		</div>
	</div>
</div>

<div id="modalito" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Alerta</h4>
			</div>
			<div class="modal-body">
				<p>Imagen no compatible</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).on("keypress", 'form', function(e) {
		var code = e.keyCode || e.which;
		console.log(code);
		if (code == 13) {
			console.log('Inside');
			e.preventDefault();
			return false;
		}
	});

	function upload_image() {

		var inputFileImage = document.getElementById("tienda_logo");
		var file = inputFileImage.files[0];
		if ((typeof file === "object") && (file !== null)) {
			var data = new FormData();
			data.append('tienda_logo', file);

			$.ajax({
				url: '<?php echo base_url(); ?>index.php/configuracion/subirLogo',
				type: "POST",
				data: data,
				contentType: false,
				cache: false,
				processData: false,
				success: function(data) {
					console.log(data);
					if (data != 0) {
						$('#modalito').modal('show')
					} else {
						$("#load_img").attr("src", "");
						$("#load_img").attr("src", "<?php echo base_url() . 'images/logo_tmp.png'; ?>");
					}
				}
			});
		}
	}
</script>