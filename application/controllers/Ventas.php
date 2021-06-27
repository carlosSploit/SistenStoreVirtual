<?php
class ventas extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->model("movimientosModel");
		$this->load->model("ventasModel");
		$this->load->model("cajasModel");
	}

	//Cargar catalogo
	public function index()
	{
		if ($this->session->userdata('login') != 1) {
			redirect('login');
		}
		$datos["titulo"] = "Ventas";
		$datos["datos"] = $this->ventasModel->obtener(1);
		$this->load->view("encabezado");
		$this->load->view("ventas/ventas", $datos);
		$this->load->view("pie");
	}

	//Cargar catalogo eliminados
	public function eliminadas()
	{
		if ($this->session->userdata('login') != 1) {
			redirect('login');
		}
		$datos["titulo"] = "Ventas eliminadas";
		$datos["datos"] = $this->ventasModel->obtener(0);
		$this->load->view("encabezado");
		$this->load->view("ventas/ventas_eliminadas", $datos);
		$this->load->view("pie");
	}

	//Valida e inserta venta
	public function insertar()
	{
		$fecha = date('Y-m-d H:i:s');
		$id_venta_tmp = $this->input->post("id_venta");
		$id_cliente = $this->input->post("id_cliente");
		$forma_pago = $this->input->post("forma_pago");
		$id_caja = $this->session->userdata('id_caja');
		$id_usuario = $this->session->userdata('id_usuario');
		$total = preg_replace('/[\$,]/', '', $this->input->post("total"));
		$statepedido = $this->input->post("chekpedido1");
		$ultimoFolio = $this->cajasModel->ultimoFolio($id_caja);

		echo "resultado : " . $statepedido;

		if ($statepedido) {
			$resultado = $this->ventasModel->insertar($ultimoFolio, $total, $fecha, $id_usuario, $id_caja, $id_cliente, $forma_pago, 0);
			$this->load->model("pedidoModel");
			$direccion = $this->input->post("direc");
			$telefono = $this->input->post("telf");
			$date = $this->input->post("date");

			$this->pedidoModel->insertar($ultimoFolio, $direccion, $telefono, $date, 0);
		} else {
			$resultado = $this->ventasModel->insertar($ultimoFolio, $total, $fecha, $id_usuario, $id_caja, $id_cliente, $forma_pago, 1);
		}
		//si es un pedido el estado de la venta es 0 y si no lo es, el estado sera 1


		//si el estado es 0 se ingresa un pedido
		// if ($statepedido == 0) {

		// }

		if ($resultado) {

			$ultimoFolio = $this->cajasModel->siguienteFolio($id_caja);
			$resultadoTransaccion = $this->movimientosModel->porTransaccion($id_venta_tmp, 'V');

			$this->load->model("detalle_venta_productoModel");
			$this->load->model("productosModel");

			foreach ($resultadoTransaccion as $row) {
				$this->detalle_venta_productoModel->insertar($resultado, $row->id_producto, $row->nombre, $row->cantidad, $row->precio);
				$this->productosModel->actualizaExistencia($row->id_producto, $row->cantidad, '-');
			}
			$this->movimientosModel->eliminarTransaccion($id_venta_tmp, 'V');
		}

		redirect("caja/muestraTicket/$resultado");
	}

	//Cancela venta
	public function eliminar($id)
	{
		$resultado = $this->ventasModel->eliminar($id);
		redirect("ventas/");
	}

	//Cargar ventas por caja
	public function ventas_caja()
	{
		if ($this->session->userdata('login') != 1) {
			redirect('login');
		}
		$datos["titulo"] = "Ventas del día";
		$this->load->view("encabezado");
		$this->load->view("ventas/ventas_caja", $datos);
		$this->load->view("pie");
	}

	function mostrarVentas()
	{
		$fWhere = '';
		$draw = intval($this->input->post("draw"));
		$start = intval($this->input->post("start"));
		$length = intval($this->input->post("length"));
		$order = $this->input->post("order");
		$search = $this->input->post("search");
		$activo = $this->input->post("activo");
		if ($this->input->post("fecha")) {
			$fecha = $this->input->post("fecha");
			$fWhere .= " AND DATE(ventas.fecha) = '$fecha'";
		}

		if ($this->input->post("id_caja")) {
			$id_caja = $this->input->post("id_caja");
			$fWhere .= " AND ventas.id_caja = '$id_caja'";
		}

		$search = $search['value'];
		$col = 0;
		$dir = "";

		$aColumns = array('ventas.folio', 'clientes.nombre', 'ventas.total', 'ventas.fecha', 'usuarios.usuario', 'ventas.id');
		$sTable = "ventas";
		$sWhere = "ventas.activo = $activo $fWhere";
		$sWhereOrg = "ventas.activo = $activo $fWhere";

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
		$this->db->join('usuarios', 'ventas.id_usuario = usuarios.id');
		$this->db->join('clientes', 'ventas.id_cliente = clientes.id');
		$prodcutos = $this->db->get();

		$data = array();

		if ($activo == 1) {
			foreach ($prodcutos->result() as $rows) {
				$data[] = array(
					$rows->folio, $rows->nombre, number_format($rows->total, 2, '.', ','), $rows->fecha, $rows->usuario,
					"<a href='" . base_url() . "index.php/caja/muestraTicket/" . $rows->id . "' class='button' data-toggle='tooltip'  data-placement='top' title='Ver ticket' ><span class='fas fa-list-alt'></span></a>",
					"<a href='#' data-href='" . base_url() . "index.php/ventas/eliminar/" . $rows->id . "' data-toggle='modal' data-target='#confirm-delete' data-placement='top' title='Cancelar venta'><span class='fas fa-ban'></span></a>"
				);
			}
		} else {
			foreach ($prodcutos->result() as $rows) {
				$data[] = array(
					$rows->folio, $rows->nombre, number_format($rows->total, 2, '.', ','), $rows->fecha, $rows->usuario,
					"<a href='" . base_url() . "index.php/caja/muestraTicket/" . $rows->id . "' class='button' data-toggle='tooltip'  data-placement='top' title='Ver ticket'>
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
		$this->db->join('usuarios', 'ventas.id_usuario = usuarios.id');
		$this->db->join('clientes', 'ventas.id_cliente = clientes.id');
		$this->db->where($sWhereOrg);
		$query = $this->db->get()->row();

		if (isset($query)) return $query->num;
		return 0;
	}

	public function totalRegistroFiltrados($sTable, $where)
	{
		$this->db->select('COUNT(*) as num');
		$this->db->from($sTable);
		$this->db->join('usuarios', 'ventas.id_usuario = usuarios.id');
		$this->db->join('clientes', 'ventas.id_cliente = clientes.id');
		$this->db->where($where);
		$query = $this->db->get()->row();

		if (isset($query)) return $query->num;
		return 0;
	}
}
