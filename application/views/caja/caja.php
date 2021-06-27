<?php

$idVentaTmp = uniqid();
$formas_pago = $this->db->get_where('forma_pago')->result();
?>

<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12">
		<div class="panel">
			<form id="form_venta" name="form_venta" class="form-horizontal" method="post" action="ventas/insertar" autocomplete="off">

				<input type="hidden" id="id_venta" name="id_venta" value="<?php echo $idVentaTmp; ?>">

				<div class="form-group">
					<div class="row">
						<div class="col-sm-12 col-md-6 col-lg-6">
							<div class="ui-widget">
								<label><span class="text-danger">*</span>Cliente:</label>
								<input id="id_cliente" name="id_cliente" value="1" type="hidden" />
								<input class="form-control" id="cliente" name="cliente" type="text" placeholder="Escribe el nombre del cliente" value="<?php echo $this->db->get_where('clientes', array('id' => 1))->row()->nombre; ?>" onkeyup="agregarProducto(event, this, this.value, total.value, '<?php echo $idVentaTmp; ?>')" autocomplete="off" required>
							</div>
						</div>
						<div class="w-100 d-block d-lg-none d-md-none d-sm-none m-2"></div>
						<div class="col-sm-12 col-md-6 col-lg-6">
							<label><span class="text-danger">*</span>Forma de pago:</label>
							<select id="forma_pago" name="forma_pago" class="form-control" required>
								<?php foreach ($formas_pago as $forma) { ?>
									<option value="<?php echo $forma->forma_pago; ?>"><?php echo $forma->descripcion; ?></option>
								<?php } ?>
							</select>
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="row">
						<!--<div class="col-sm-4">
							<label>Código de barras:</label>
							<input class="form-control" id="codigo" name="codigo" type="text" placeholder="Escribe el código y presiona enter" onkeyup="agregarProducto(event, this.value, total.value, '<?php echo $idVentaTmp; ?>')" autocomplete="off" autofocus>
						</div>-->

						<div class="col-sm-12 col-md-6 col-lg-6">
							<div class="row m-1">
								<label>Código de barras:</label>
								<div class="row">
									<div class="input-group col">
										<div class="input-group-prepend">
											<div class="input-group-text"><span class="fas fa-fw fa-barcode"></span></div>
										</div>
										<input class="form-control" id="codigo" name="codigo" type="text" placeholder="Escribe el código y presiona enter" onkeyup="agregarProducto(event, this.value, total.value, '<?php echo $idVentaTmp; ?>')" autocomplete="off" autofocus>
									</div>
									<div class="w-100 d-block d-lg-none m-2"></div>
									<div class="input-group col">
										<div class="input-group-prepend">
											<div class="input-group-text"><span class="fas fa-sort-amount-up-alt"></span></div>
										</div>
										<input class="form-control" id="cantiprod" type="text" placeholder="stock">
									</div>
								</div>
							</div>
							<br>
							<div class="row m-1">
								<div class="row m-1">
									<div class="form-check">
										<input class="form-check-input" type="checkbox" value="true" name="chekpedido1" id="chekpedido1">
										<label class="form-check-label" for="flexCheckDefault">
											Si desear hacer pedido precione aqui:
										</label>
									</div>
								</div>
								<br>
								<div class="row" id="datpedido">
									<div class="input-group col-auto">
										<div class="input-group-prepend">
											<div class="input-group-text"><span class="fas fa-street-view"></span></div>
										</div>
										<input class="form-control" id="direc" name="direc" type="text" placeholder="Direccion">
									</div>
									<div class="w-100 d-block m-2"></div>
									<div class="input-group col">
										<div class="input-group-prepend">
											<div class="input-group-text"><span class="fas fa-mobile-alt"></span></div>
										</div>
										<input class="form-control" name="telf" id="telf" type="text" placeholder="Telefono">
									</div>
									<div class="w-100 d-block d-lg-none m-2"></div>
									<div class="input-group col">
										<div class="input-group-prepend">
											<div class="input-group-text"><span class="fas fa-calendar-alt"></span></div>
										</div>
										<input class="form-control" name="date" id="date" type="date" placeholder="Telefono">
									</div>
								</div>
								<br>
							</div>
						</div>
						<!-- <div class="col-lg-2">
							<label for="codigo" id="resultado_error" style="color:red"></label>
						</div> -->
						<div class="w-100 d-block d-lg-none d-md-none d-sm-block m-2"></div>
						<div class="col-lg-6 col-sm-12 col-md-6">
							<div class="row">
								<div class="col">
									<label style='font-weight:bold; font-size:30px; text-align:center;'> Total $</label>
									<div class="w-100 d-none d-lg-block d-md-block d-sm-block m-2"></div>
									<input type="text" name="total" id="total" size="7" readonly="true" value="0.00" style='font-weight:bold; font-size:30px; text-align:center; border:#E2EBED; background:#ffffff' />
								</div>
								<div class="w-100 d-block d-lg-none d-md-none d-sm-none m-2"></div>
								<div class="form-group col">
									<div class="row">
										<div class="col">
											<button id="completa_venta" type="button" class="col-lg-8 col-sm-12 col-md-8 btn btn-success">Completar venta</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<br>

				<table id="tablaProductos" class="table table-hover table-striped table-sm table-responsive tablaProductos">
					<thead class="thead-dark">
						<tr>
							<th>#</th>
							<th>C&oacute;digo</th>
							<th>Nombre</th>
							<th>Precio</th>
							<th>Cantidad</th>
							<th>Total</th>
							<th width='1%'></th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>

			</form>
		</div>
	</div>
</div>

<br>

<div id="modalito" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Caja</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<h6>Debe agregar un producto para completar la venta.</h6>
			</div>
			<div class="modal-footer">
				<a class="btn btn-info" data-dismiss="modal">Aceptar</a>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		$(window).keydown(function(event) {
			if (event.keyCode == 13) {
				event.preventDefault();
				return false;
			}
		});
		// inicializar datos de entrada para el pedido
		$("#datpedido").hide();
		$("#chekpedido1").click(function() {

			if ($('#chekpedido1').prop('checked')) {
				$('#datpedido').show();
				$('#chekpedido1').val($('#chekpedido1').prop('checked'));
			} else {
				$("#datpedido").hide();
				$('#chekpedido1').val($('#chekpedido1').prop('checked'));
			}
		});
		//inicializar datos en el pedido
	});

	$(document).ready(function() {
		$('#modalito').on('hidden.bs.modal', function(e) {
			$('#codigo').focus();
		})
	});

	function agregarProducto(e, codigo, total, idVentaTmp) {
		var enterKey = 13;
		if (codigo != '') {
			if (e.which == enterKey) {
				canti = $("#cantiprod").val();
				$.ajax({
					url: '<?php echo base_url(); ?>index.php/caja/buscarProductoCodigo/' + codigo + '/' + idVentaTmp + '/' + canti,
					success: function(response) {
						if (response == 0) {
							$(tagCodigo).val('');
						} else {
							$("#codigo").removeClass('has-error');
							var resultado = JSON.parse(response);
							$("#resultado_error").html(resultado.error);
							$('#tablaProductos tbody').empty();
							$("#tablaProductos tbody").append(resultado.datos);
							$("#total").val(resultado.total);
							$("#codigo").val('');
							$("#cantiprod").val('');
							$('#codigo').autocomplete('close');
						}
					}
				});
			}
		}
	}

	function eliminarProducto(id, idVentaTmp) {
		$.ajax({
			url: '<?php echo base_url(); ?>index.php/caja/eliminarProductoVenta/' + id + '/' + idVentaTmp,
			success: function(response) {
				if (response == 0) {
					$(tagCodigo).val('');
				} else {
					var resultado = JSON.parse(response);
					$("#resultado_error").html('');
					$('#tablaProductos tbody').empty();
					$("#tablaProductos tbody").append(resultado.datos);
					$("#total").val(resultado.total);
					$("#codigo").val('');
				}
			}
		});
	}

	$(function() {
		$("#completa_venta").click(function() {
			var nFilas = $("#tablaProductos tr").length;
			if (nFilas < 2) {
				notify(1, "Venta", "Error al realizar la venta", 'R', "error");
				//$('#modalito').modal('show');
			} else {
				if (validad()) {
					notify(1, "Insercion", "La venta se realizo con exito", 'R', "success");
					setTimeout(metSub(), 4000);
				} else {
					notify(1, "Venta", "Error, unas de las casillas esta vacia, para el pedido", 'R', "error");
				}
			}
		});
		/* Replicar en las casillas 
		   "#telf" es la id de cada capmo.
		*/
		function validad() {
			var band = false;
			if (($("#telf").val() != "") || ($("#direc").val() != "")) {
				band = true;
			}
			return band;
		}

		function metSub() {
			$("#form_venta").submit();
		}
	});



	$(function() {
		$("#cliente").autocomplete({
			source: "<?php echo base_url(); ?>index.php/clientes/autocompleteData",
			minLength: 3,
			select: function(event, ui) {
				event.preventDefault();
				console.log(ui.item);
				$("#id_cliente").val(ui.item.id);
				$("#cliente").val(ui.item.value);
				$("#direc").val(ui.item.dic);
				$("#telf").val(ui.item.tel);
			}
		});
	});

	$(document).ready(function() {
		$("#codigo").autocomplete({
			source: "<?php echo base_url(); ?>index.php/productos/autocompleteData",
			minLength: 3,
			focus: function() {
				return false;
			},
			select: function(event, ui) {
				event.preventDefault();
				$("#codigo").val(ui.item.value);
				setTimeout(
					function() {
						e = jQuery.Event("keypress");
						e.which = 13;
						agregarProducto(e, codigo.value, total.value, '<?php echo $idVentaTmp; ?>');
					}, 500);
			}
		});
	});
</script>