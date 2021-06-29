<?php
$idCompraTmp = uniqid();
?>
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12">
		<div class="panel">
			<form id="form_compra" name="form_compra" class="form-horizontal" method="post" action="<?php echo base_url() ?>index.php/compras/insertar" autocomplete="off">

				<input type="hidden" id="id_compra" name="id_compra" value="<?php echo $idCompraTmp; ?>">

				<div class="row">
					<div class="col-12 col-sm-4">
						<label>Código de barras:</label>
						<input id="id_producto" name="id_producto" type="hidden" />
						<input class="form-control" id="codigo" name="codigo" type="text" placeholder="Escribe el código y presiona enter" onkeyup="buscarProducto(event, this, this.value)" autocomplete="off" autofocus>
						<label for="codigo" id="resultado_error" style="color:red"></label>
					</div>

					<div class="col-12 col-sm-4">
						<label>Nombre de producto:</label>
						<input class="form-control" id="nombre" name="nombre" type="text" readonly>
					</div>

					<div class="col-12 col-sm-4">
						<label>Cantidad:</label>
						<input onkeypress="limit(this.value,'cantidad',5)" class="form-control" id="cantidad" type="number" min="0" name="cantidad" onkeypress="return filterFloat(event,this);" placeholder="Escribe aquí el precio de compra">
					</div>
				</div>

				<div class="row">
					<div class="col-12 col-sm-4">
						<label>Precio de compra:</label>
						<input class="form-control" id="precio_compra" name="precio_compra" type="number" readonly>
					</div>

					<div class="col-12 col-sm-4">
						<label>Subtotal:</label>
						<input class="form-control" id="subtotal_producto" name="subtotal_producto" type="number" readonly>
					</div>

					<div class="col-12 col-sm-4">
						<label> </label>
						<button id="agregar_producto" name="agregar_producto" type="button" class="btn btn-primary" onClick="agregarProducto(id_producto.value, cantidad.value, '<?php echo $idCompraTmp; ?>')">Agregar producto</button>
					</div>
				</div>

				<br>

				<table id="tablaProductos" class="table table-hover table-striped table-sm table-responsive tablaProductos" width="100%">
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

				<div class="row">
					<div class="col-12 col-sm-6 offset-md-6">
						<label style='font-weight:bold; font-size:30px; text-align:center;'> Total $</label><input type="text" name="total" id="total" size="7" readonly="true" value="0.00" style='font-weight:bold; font-size:30px; text-align:center; border:#E2EBED; background:#ffffff' />
						<button id="completa_compra" type="button" class="btn btn-success">Completar compra</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<div class="modal fade" id="AvanzaModal" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<div id="modal-title"></div>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			</div>
			<div class="modal-body" id="modal-body"></div>
			<div class="modal-footer clearfix">
				<button type="button" class="pull-left btn btn-primary" data-dismiss="modal">Aceptar</button>
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
	});

	$(document).ready(function() {
		$('#AvanzaModal').on('hidden.bs.modal', function(e) {
			$('#codigo').focus();
		})
	});

	function muestraModal(titulo, mensaje) {
		$(document).ready(function() {
			$('#modal-title').html('<b>' + titulo + '</b>');
			$('#modal-body').html('<p>' + mensaje + '</p>');
			$('#AvanzaModal').modal('show');
		});
	}

	function buscarProducto(e, tagCodigo, codigo) {
		var enterKey = 13;
		if (codigo != '') {
			if (e.which == enterKey) {
				$.ajax({
					url: '<?php echo base_url(); ?>index.php/compras/buscarProductoCodigo/' + codigo,
					success: function(response) {
						if (response == 0) {
							$(tagCodigo).val('');
						} else {
							$(tagCodigo).removeClass('has-error');
							var resultado = JSON.parse(response);
							$("#resultado_error").html(resultado.error);

							if (resultado.existe) {
								$("#id_producto").val(resultado.datos.id);
								$("#nombre").val(resultado.datos.nombre);
								$("#cantidad").val(1);
								$("#precio_compra").val(resultado.datos.precio_compra);
								$("#subtotal_producto").val(resultado.datos.precio_compra);
								$("#cantidad").focus();
							} else {
								$("#id_producto").val('');
								$("#codigo").val('');
								$("#nombre").val('');
								$("#cantidad").val('');
								$("#precio_compra").val('');
								$("#subtotal_producto").val('');
							}
						}
					}
				});
			}
		}
	}

	function agregarProducto(id_producto, cantidad, id_compra) {
		if (id_producto != null && id_producto != 0 && cantidad > 0) {
			$.ajax({
				url: '<?php echo base_url(); ?>index.php/compras/agregaProductoId/' + id_producto + '/' + cantidad + '/' + id_compra,
				success: function(response) {
					if (response == 0) {

					} else {
						var resultado = JSON.parse(response);

						if (resultado.error == '') {
							$("#resultado_error").html(resultado.error);
							$('#tablaProductos tbody').empty();
							$("#tablaProductos tbody").append(resultado.datos);
							$("#total").val(resultado.total);
							$("#id_producto").val('');
							$("#codigo").val('');
							$("#nombre").val('');
							$("#cantidad").val('');
							$("#precio_compra").val('');
							$("#subtotal_producto").val('');
							$("#codigo").focus();
						} else {
							$("#resultado_error").html(resultado.error);
						}
					}
				}
			});
		} else {
			muestraModal('Aviso', 'Debe completar los datos del producto.');
		}
	}

	function eliminarProducto(id_producto, id_compra) {
		$.ajax({
			url: '<?php echo base_url(); ?>index.php/compras/eliminarProducto/' + id_producto + '/' + id_compra,
			success: function(response) {
				if (response == 0) {
					$(tagCodigo).val('');
				} else {
					var resultado = JSON.parse(response);
					$("#resultado_error").html('');
					$('#tablaProductos tbody').empty();
					$("#tablaProductos tbody").append(resultado.datos);
					$("#total").val(resultado.total);
				}
			}
		});
	}

	$(function() {
		$("#completa_compra").click(function() {
			var nFilas = $("#tablaProductos tr").length;

			if (nFilas < 2) {
				notify(1, "Insercion", "Error al ingresar la compra", 'R', "error");
			} else {
				notify(1, "Insercion", "La compra se a ingresado con exito", 'R', "success");
				setTimeout(metSub(), 4000);
			}
		});
	});

	function metSub() {
		$("#form_compra").submit();
	}

	function filterFloat(evt, input) {
		// Backspace = 8, Enter = 13, ‘0′ = 48, ‘9′ = 57, ‘.’ = 46, ‘-’ = 43
		var key = window.Event ? evt.which : evt.keyCode;
		var chark = String.fromCharCode(key);
		var tempValue = input.value + chark;
		if (key >= 48 && key <= 57) {
			if (filter(tempValue) === false) {
				return false;
			} else {
				return true;
			}
		} else {
			if (key == 8 || key == 13 || key == 0) {
				return true;
			} else if (key == 46) {
				if (filter(tempValue) === false) {
					return false;
				} else {
					return true;
				}
			} else {
				return false;
			}
		}
	}

	function filter(__val__) {
		var preg = /^([0-9]+\.?[0-9]{0,2})$/;
		if (preg.test(__val__) === true) {
			return true;
		} else {
			return false;
		}

	}
</script>