<?php
class caja extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model("movimientosModel");
		$this->load->model("almacenModel");
		$this->load->model("productosModel");
		$this->load->library('session');
	}

	//Carga caja
	public function index($id1 = 0, $mess = "Los graficos se realizaron con exito", $estade = "success")
	{
		if ($this->session->userdata('login') != 1) {
			redirect('login');
		}
		$this->load->view("encabezado");
		$this->load->view("caja/caja", ["titulo" => "Caja"]);
		$data['id'] = $id1;
		$data['mesg'] = $mess;
		$data['estade'] = $estade;
		$this->load->view("pie", $data);
	}

	//Busca producto por codigo e id_venta en tabla temporal
	public function buscarProductoCodigo($codigo, $id_venta, $cant)
	{
		$cantidad = $cant;
		$error = '';
		$datos = $this->productosModel->porCodigoRes($codigo);
		if ($datos) {

			$datosExiste = $this->movimientosModel->porIdProductoTransaccion($datos->id, $id_venta, 'V');

			if ($datosExiste) {
				$cantidad = $datosExiste->cantidad + $cantidad;

				if ($datos->inventariable == 1) {
					if ($datos->existencia >= $cantidad) {
						$subtotal = $cantidad * $datosExiste->precio;
						$this->movimientosModel->actualizaProductoTransaccion($datos->id, $id_venta, 'V', $cantidad, $subtotal);
					} else {
						$error = 'NO hay suficientes existencia';
					}
				} else {
					$subtotal = $cantidad * $datosExiste->precio;
					$this->movimientosModel->actualizaProductoTransaccion($datos->id, $id_venta, 'V', $cantidad, $subtotal);
				}
			} else {

				if ($datos->inventariable == 1) {
					if ($datos->existencia >= $cantidad) {
						$datos->subtotal = $cantidad * $datos->precio_venta;
						$datosInserta = json_decode(json_encode($datos), True);
						$this->movimientosModel->insertar($datosInserta, $id_venta, 'V', $cantidad);
					} else {
						$error = 'NO hay suficientes existencia';
					}
				} else {
					$datos->subtotal = $cantidad * $datos->precio_venta;
					$datosInserta = json_decode(json_encode($datos), True);
					$this->movimientosModel->insertar($datosInserta, $id_venta, 'V', $cantidad);
				}
			}
		} else {
			$error = 'No existe producto';
		}

		$res['datos'] = $this->cargaProductosCaja($id_venta);
		$res['total'] = number_format(round($this->totalProductosCaja($id_venta), 2), 2, '.', ',');
		$res['error'] = $error;

		echo json_encode($res);
	}

	//Elimina producto de tabla temporal por id_producto e id_venta
	public function eliminarProductoVenta($id_producto, $id_venta)
	{
		$datos = $this->movimientosModel->porIdProductoTransaccion($id_producto, $id_venta, 'V');
		if ($datos) {
			// if ($datos->cantidad > 1) {
			// 	$cantidad = $datos->cantidad - 1;
			// 	$subtotal = $cantidad * $datos->precio;
			// 	$this->movimientosModel->actualizaProductoTransaccion($id_producto, $id_venta, 'V', $cantidad, $subtotal);
			// } else {
			$this->movimientosModel->eliminar($id_producto, $id_venta);
			// }
		}
		$res['datos'] = $this->cargaProductosCaja($id_venta);
		$res['total'] = number_format(round($this->totalProductosCaja($id_venta), 2), 2, '.', ',');
		$res['error'] = '';

		echo json_encode($res);
	}

	//Llena tabla de productos en caja por id_venta
	public function cargaProductosCaja($id_transaccion)
	{
		$resultadoVenta = $this->movimientosModel->porTransaccion($id_transaccion, 'V');
		$fila = '';
		$numFila = 0;

		foreach ($resultadoVenta as $row) {
			$numFila++;
			$fila .= "<tr id='fila" . $numFila . "'>";
			$fila .= "<td>" . $numFila . "</td>";
			$fila .= "<td><input type='hidden' id='id" . $numFila . "' name='id[]' value='" . $row->id_producto . "' >" . $row->codigo . "</td>";
			$fila .= "<td><input type='hidden' id='codigo" . $numFila . "'  name='codigo[]' value='" . $row->codigo . "' >" . $row->nombre . "</td>";
			$fila .= "<td><input type='hidden' id='precio_venta" . $numFila . "' name='precio_[]' value='" . $row->precio . "' >" . number_format($row->precio, 2, '.', ',') . "</td>";
			$fila .= "<td><input type='hidden' id='cantidad" . $numFila . "' name='cantidad[]' value='" . $row->cantidad . "' >" . $row->cantidad . "</td>";
			$fila .= "<td><input type='hidden' id='subtotal" . $numFila . "' name='subtotal[]' value='" . $row->subtotal . "' >" . number_format($row->subtotal, 2, '.', ',') . "</td>";
			$fila .= "<td style='text-align: center;'><a onclick=\"eliminarProducto(" . $row->id_producto . ", '" . $id_transaccion . "')\" class='borrar'><span class='fas fa-fw fa-trash'></span></a></td>";
			$fila .= '</tr>';
		}

		return $fila;
	}

	//Suma el importe total de producto por $id_transaccion
	public function totalProductosCaja($id_transaccion)
	{
		$resultadoVenta = $this->movimientosModel->porTransaccion($id_transaccion, 'V');
		$total = 0;

		foreach ($resultadoVenta as $row) {
			$total += $row->subtotal;
		}

		return $total;
	}

	//Genera ticket en PDF 
	function generaTicket($id_venta)
	{
		if ($this->session->userdata('login') != 1) {
			redirect('login');
		}
		$data['id_venta'] = $id_venta;
		$this->load->view('caja/ticket', $data);
	}

	//Muestra ticket en div
	function muestraTicket($id_venta, $id1 = 0, $mess = "Los graficos se realizaron con exito", $estade = "success")
	{
		if ($this->session->userdata('login') != 1) {
			redirect('login');
		}
		$data['id_venta'] = $id_venta;
		$this->load->view("encabezado");
		$this->load->view('caja/ver_ticket', $data);
		$data['id'] = $id1;
		$data['mesg'] = $mess;
		$data['estade'] = $estade;
		$this->load->view("pie", $data);
	}
}
