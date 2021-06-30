<?php
class compras extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model("movimientosModel");
		$this->load->model("almacenModel");
		$this->load->model("productosModel");
		$this->load->library('session');
	}

	//Carga vista para compras
	public function index($id = 0, $mess = "mensegprueba", $estade = "")
	{
		if ($this->session->userdata('login') != 1) {
			redirect('login');
		}
		$datos["titulo"] = "Compras";
		//$datos["datos"] = $this->almacenModel->obtener(1);
		$this->load->view("encabezado");
		$this->load->view("compras/compras", $datos);
		$data['id'] = $id;
		$data['mesg'] = $mess;
		$data['estade'] = $estade;
		$this->load->view("pie", $data);
	}

	//Cargar catalogo eliminados
	public function eliminadas($id = 0, $mess = "mensegprueba", $estade = "")
	{
		if ($this->session->userdata('login') != 1) {
			redirect('login');
		}
		$datos["titulo"] = "Compras eliminadas";
		//$datos["datos"] = $this->almacenModel->obtener(0);
		$this->load->view("encabezado");
		$this->load->view("compras/compras_eliminadas", $datos);
		$data['id'] = $id;
		$data['mesg'] = $mess;
		$data['estade'] = $estade;
		$this->load->view("pie", $data);
	}

	//Carga vista para compra
	public function nueva($id = 0, $mess = "mensegprueba", $estade = "")
	{
		if ($this->session->userdata('login') != 1) {
			redirect('login');
		}
		$this->load->view("encabezado");
		$this->load->view("compras/compra", ["titulo" => "Compra"]);
		$data['id'] = $id;
		$data['mesg'] = $mess;
		$data['estade'] = $estade;
		$this->load->view("pie", $data);
	}

	//Cancela compra
	public function eliminar($id)
	{
		$resultado = $this->almacenModel->getRowsidState($id);
		if ($resultado == 1) {
			$resultado = $this->almacenModel->eliminar($id);
			$this->index(1, "La compra se elimino con exito", "success");
		} else {
			redirect("compras/");
		}
	}

	//Busca producto por codigo
	public function buscarProductoCodigo($codigo)
	{
		$existe = false;
		$res['datos'] = '';
		$error = '';
		$datos = $this->productosModel->porCodigoRes($codigo);
		if ($datos) {
			if ($datos->inventariable == 1) {
				$res['datos'] = $datos;
				$existe = true;
			} else {
				$error = 'El producto no es inventariable';
				$existe = false;
			}
		} else {
			$error = 'No existe producto';
			$existe = false;
		}
		$res['existe'] = $existe;
		$res['error'] = $error;

		echo json_encode($res);
	}

	//Agrega producto por id a tabla temporal
	public function agregaProductoId($id_producto, $cantidad, $id_compra)
	{
		$error = '';

		$datos = $this->productosModel->porId($id_producto);
		if ($datos) {

			$datosExiste = $this->movimientosModel->porIdProductoTransaccion($id_producto, $id_compra, 'C');

			if ($datosExiste) {
				$cantidad = $datosExiste->cantidad + $cantidad;
				$subtotal = $cantidad * $datosExiste->precio;
				$this->movimientosModel->actualizaProductoTransaccion($id_producto, $id_compra, 'C', $cantidad, $subtotal);
			} else {
				$datos->subtotal = $cantidad * $datos->precio_compra;
				$datosInserta = json_decode(json_encode($datos), True);
				$this->movimientosModel->insertar($datosInserta, $id_compra, 'C', $cantidad);
			}
		} else {
			$error = 'No existe producto';
		}

		$res['datos'] = $this->cargaProductos($id_compra);
		$res['total'] = number_format(round($this->totalProductos($id_compra), 2), 2, '.', ',');
		$res['error'] = $error;

		echo json_encode($res);
	}

	//Elimina producto de tabla temporal por id_producto e id_compra
	public function eliminarProducto($id_producto, $id_compra)
	{
		$datos = $this->movimientosModel->porIdProductoTransaccion($id_producto, $id_compra, 'C');
		if ($datos) {
			if ($datos->cantidad > 1) {
				$cantidad = $datos->cantidad - 1;
				$subtotal = $cantidad * $datos->precio;
				$this->movimientosModel->actualizaProductoTransaccion($id_producto, $id_compra, 'C', $cantidad, $subtotal);
			} else {
				$this->movimientosModel->eliminar($id_producto, $id_compra);
			}
		}
		$res['datos'] = $this->cargaProductos($id_compra);
		$res['total'] = number_format(round($this->totalProductos($id_compra), 2), 2, '.', ',');
		$res['error'] = '';

		echo json_encode($res);
	}

	//Llena tabla de productos en caja por id_compra
	public function cargaProductos($id_compra)
	{
		$resultado = $this->movimientosModel->porTransaccion($id_compra, 'C');
		$fila = '';
		$numFila = 0;

		foreach ($resultado as $row) {
			$numFila++;
			$fila .= "<tr id='fila" . $numFila . "'>";
			$fila .= "<td>" . $numFila . "</td>";
			$fila .= "<td><input type='hidden' id='id" . $numFila . "' name='id[]' value='" . $row->id_producto . "' >" . $row->codigo . "</td>";
			$fila .= "<td><input type='hidden' id='codigo" . $numFila . "'  name='codigo[]' value='" . $row->codigo . "' >" . $row->nombre . "</td>";
			$fila .= "<td><input type='hidden' id='precio" . $numFila . "' name='precio[]' value='" . $row->precio . "' >" . number_format($row->precio, 2, '.', ',') . "</td>";
			$fila .= "<td><input type='hidden' id='cantidad" . $numFila . "' name='cantidad[]' value='" . $row->cantidad . "' >" . $row->cantidad . "</td>";
			$fila .= "<td><input type='hidden' id='subtotal" . $numFila . "' name='subtotal[]' value='" . $row->subtotal . "' >" . number_format($row->subtotal, 2, '.', ',') . "</td>";
			$fila .= "<td style='text-align: center;'><a onclick=\"eliminarProducto(" . $row->id_producto . ", '" . $id_compra . "')\" class='borrar'><span class='fas fa-fw fa-trash'></span></a></td>";
			$fila .= '</tr>';
		}

		return $fila;
	}

	//Suma el importe total de producto por $id_compra
	public function totalProductos($id_compra)
	{
		$resultadoVenta = $this->movimientosModel->porTransaccion($id_compra, 'C');
		$total = 0;

		foreach ($resultadoVenta as $row) {
			$total += $row->subtotal;
		}

		return $total;
	}

	//Valida e inserta compra
	public function insertar()
	{

		$ultimoFolio = $this->almacenModel->ultimoFolio(2);
		$fecha = date('Y-m-d H:i:s');
		$id_compra_tmp = $this->input->post("id_compra");
		$total = preg_replace('/[\$,]/', '', $this->input->post("total"));
		$id_usuario = $this->session->userdata('id_usuario');

		$resultado = $this->almacenModel->insertar($ultimoFolio, 'C', $total, $fecha, $id_usuario, 1);
		if ($resultado) {
			$ultimoFolio = $this->almacenModel->siguienteFolio(2);

			$resultadoTransaccion = $this->movimientosModel->porTransaccion($id_compra_tmp, 'C');

			$this->load->model("detalle_almacen_movimientoModel");

			foreach ($resultadoTransaccion as $row) {
				$this->detalle_almacen_movimientoModel->insertar($resultado, $row->id_producto, $row->nombre, $row->cantidad, $row->precio);
				$this->productosModel->actualizaExistencia($row->id_producto, $row->cantidad, '+');
			}
			$this->movimientosModel->eliminarTransaccion($id_compra_tmp, 'C');
		}

		redirect("compras/muestraCompraPdf/$resultado");
	}

	//Muestra cmpra en div
	function muestraCompraPdf($id_compra, $id = 0, $mess = "mensegprueba", $estade = "")
	{
		if ($this->session->userdata('login') != 1) {
			redirect('login');
		}
		$data['id_compra'] = $id_compra;
		$this->load->view("encabezado");
		$this->load->view('compras/ver_compra_pdf', $data);
		$data['id'] = $id;
		$data['mesg'] = $mess;
		$data['estade'] = $estade;
		$this->load->view("pie", $data);
	}

	//Genera ticket en PDF 
	function generaCompraPdf($id_compra)
	{
		if ($this->session->userdata('login') != 1) {
			redirect('login');
		}
		$data['id_compra'] = $id_compra;
		$this->load->view('compras/compra_pdf', $data);
	}

	function mostrarCompras()
	{

		$draw = intval($this->input->post("draw"));
		$start = intval($this->input->post("start"));
		$length = intval($this->input->post("length"));
		$order = $this->input->post("order");
		$search = $this->input->post("search");
		$activo = $this->input->post("activo");
		$search = $search['value'];
		$col = 0;
		$dir = "";

		$aColumns = array('almacen_movimiento.folio', 'almacen_movimiento.total', 'almacen_movimiento.fecha', 'usuarios.usuario', 'almacen_movimiento.id');
		$sTable = "almacen_movimiento";
		$sWhere = "almacen_movimiento.activo = $activo AND almacen_movimiento.tipo = 'C'";
		$sWhereOrg = "almacen_movimiento.activo = $activo  AND almacen_movimiento.tipo = 'C'";

		$this->db->select($aColumns);

		if (!empty($order)) {
			foreach ($order as $o) {
				$col = $o['column'];
				$dir = $o['dir'];
			}
		}

		if ($dir != "asc" && $dir != "desc")
			$dir = "desc";

		if (!isset($aColumns[$col]))
			$order = null;
		else
			$order = $aColumns[$col];

		if ($order != null)
			$this->db->order_by($order, $dir);

		if (!empty($search)) {
			$x = 0;
			foreach ($aColumns as $sterm) {
				if ($x == 0) {
					$sWhere .= " AND (" . $sterm . " LIKE '%" . $search . "%' ";
				} else {
					$sWhere .= " OR " . $sterm . " LIKE '%" . $search . "%' ";
				}
				$x++;
			}
			$sWhere .= ")";
		}

		$this->db->where($sWhere);
		$this->db->limit($length, $start);
		$this->db->from($sTable);
		$this->db->join('usuarios', 'almacen_movimiento.id_usuario = usuarios.id');
		$prodcutos = $this->db->get();

		$data = array();

		if ($activo == 1) {
			foreach ($prodcutos->result() as $rows) {
				$data[] = array(
					$rows->folio, number_format($rows->total, 2, '.', ','), $rows->fecha, $rows->usuario,
					"<a href='" . base_url() . "index.php/compras/muestraCompraPdf/" . $rows->id . "' class='button'><span class='fas fa-list-alt' title='Ver compra'></span></a>",
					"<a href='#' data-href='" . base_url() . "index.php/compras/eliminar/" . $rows->id . "' data-toggle='modal' data-target='#confirm-delete' title='Cancelar compra'><span class='fas fa-ban'></span></a>"
				);
			}
		} else {
			foreach ($prodcutos->result() as $rows) {
				$data[] = array(
					$rows->folio, number_format($rows->total, 2, '.', ','), $rows->fecha, $rows->usuario,
					"<a href='" . base_url() . "index.php/compras/muestraCompraPdf/" . $rows->id . "' class='button' title='Ver compra'>
							<span class='fas fa-list-alt'></span></a>"
				);
			}
		}

		$total_registros = $this->totalRegistro($sTable, $sWhereOrg);
		$total_registros_filtrado = $this->totalRegistroFiltrados($sTable, $sWhere);
		$output = array(
			"draw" => $draw,
			"recordsTotal" => $total_registros,
			"recordsFiltered" => $total_registros_filtrado,
			"data" => $data
		);
		echo json_encode($output);
		exit();
	}

	public function totalRegistro($sTable, $sWhereOrg)
	{
		$this->db->select('COUNT(*) as num');
		$this->db->from($sTable);
		$this->db->join('usuarios', 'almacen_movimiento.id_usuario = usuarios.id');
		$this->db->where($sWhereOrg);
		$query = $this->db->get()->row();

		if (isset($query)) return $query->num;
		return 0;
	}

	public function totalRegistroFiltrados($sTable, $where)
	{
		$this->db->select('COUNT(*) as num');
		$this->db->from($sTable);
		$this->db->join('usuarios', 'almacen_movimiento.id_usuario = usuarios.id');
		$this->db->where($where);
		$query = $this->db->get()->row();

		if (isset($query)) return $query->num;
		return 0;
	}
}
