<?php
/*
		Copyright (c) 2019 Codigos de Programacion
		Punto de Venta CDP
		Desarrollado por Codigos de Programacion
		www.codigosdeprogramacion.com
	*/
class clientes extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model("clientesModel");
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->library('session');
	}

	//Cargar catalogo
	public function index()
	{
		if ($this->session->userdata('login') != 1) {
			redirect('login');
		}
		$datos["titulo"] = "Clientes";
		$datos["datos"] = $this->clientesModel->obtener(1);
		$this->load->view("encabezado");
		$this->load->view("clientes/clientes", $datos);
		$this->load->view("pie");
	}

	//Cargar catalogo eliminados
	public function eliminados()
	{
		if ($this->session->userdata('login') != 1) {
			redirect('login');
		}
		$datos["titulo"] = "Clientes eliminados";
		$datos["datos"] = $this->clientesModel->obtener(0);
		$this->load->view("encabezado");
		$this->load->view("clientes/clientes_eliminados", $datos);
		$this->load->view("pie");
	}

	//Cargar vista nuevo
	public function agregar()
	{
		if ($this->session->userdata('login') != 1) {
			redirect('login');
		}
		$data['title'] = 'Agregar cliente';
		$this->load->view("encabezado");
		$this->load->view("clientes/clientes_agregar", $data);
		$this->load->view("pie");
	}

	//Inserta y valida formulario nuevo 
	public function insertar()
	{
		$nombre = $this->input->post("nombre");
		$direccion = $this->input->post("direccion");
		$telefono = $this->input->post("telefono");
		$correo = $this->input->post("correo");

		$this->form_validation->set_rules('nombre', 'Nombre', 'required');
		$this->form_validation->set_message('required', 'El campo {field} es obligatorio.');

		if ($this->form_validation->run() == TRUE) {
			$resultado = $this->clientesModel->insertar($nombre, $direccion, $telefono, $correo, 1);
			if ($resultado) {
				redirect("clientes/");
			} else {
				$this->agregar();
			}
		} else {
			$this->agregar();
		}
	}

	//Cargar vista editar
	public function editar($id)
	{
		if ($this->session->userdata('login') != 1) {
			redirect('login');
		}
		$datoParaEditar = $this->clientesModel->porId($id);
		$data['title'] = 'Modificar cliente';
		$data['dato'] = $datoParaEditar;
		$this->load->view("encabezado");
		$this->load->view("clientes/clientes_editar", $data);
		$this->load->view("pie");
	}

	//Actualiza y valida formulario editar 
	public function actualizar()
	{
		$id = $this->input->post("id");
		$nombre = $this->input->post("nombre");
		$direccion = $this->input->post("direccion");
		$telefono = $this->input->post("telefono");
		$correo = $this->input->post("correo");
		$this->form_validation->set_rules('nombre', 'Nombre', 'required');
		$this->form_validation->set_message('required', 'El campo {field} es obligatorio.');

		if ($this->form_validation->run() == TRUE) {
			$resultado = $this->clientesModel->guardarCambios($id, $nombre, $direccion, $telefono, $correo, 1);

			if ($resultado) {
				redirect("clientes/");
			} else {
				$this->editar($id);
			}
		} else {
			$this->editar($id);
		}
	}

	//Elimina producto
	public function eliminar($id)
	{
		$resultado = $this->clientesModel->eliminar($id);
		redirect("clientes/");
	}

	//Reingresa producto
	public function reingresar($id)
	{
		$resultado = $this->clientesModel->reingresar($id);
		redirect("clientes/eliminados");
	}

	//Valida si existe cliente por nombre
	public function validarNombre($nombre)
	{
		$datos = $this->clientesModel->porNombre($nombre);
		$num_rows = $datos->num_rows();
		echo $num_rows;
	}

	function autocompleteData()
	{
		$returnData = array();

		$condiciones['searchTerm'] = $this->input->get('term');
		$condiciones['conditions']['activo'] = '1';
		$clientes = $this->clientesModel->getRows($condiciones);

		// Generate array
		if (!empty($clientes)) {
			foreach ($clientes as $row) {
				$data['id'] = $row['id'];
				$data['value'] = $row['nombre'];
				$data['tel'] = $row['telefono'];
				$data['dic'] = $row['direccion'];
				array_push($returnData, $data);
			}
		}

		// Return results as json encoded array
		echo json_encode($returnData);
		die;
	}

	function mostrarClientes()
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

		$aColumns = array('nombre', 'direccion', 'telefono', 'correo', 'id');
		$sTable = "clientes";
		$sWhere = "activo = $activo";
		$sWhereoRG = "activo = $activo";

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
		$prodcutos = $this->db->get($sTable);

		$data = array();

		if ($activo == 1) {
			foreach ($prodcutos->result() as $rows) {
				$data[] = array(
					$rows->nombre, $rows->direccion, $rows->telefono, $rows->correo,
					"<a href='" . base_url() . "index.php/clientes/editar/" . $rows->id . "' class='button' data-toggle='tooltip' data-placement='top' title='Modificar registro'><span class='fas fa-edit'></span></a>",
					"<a href='#' data-href='" . base_url() . "index.php/clientes/eliminar/" . $rows->id . "' data-toggle='modal' data-target='#confirm-delete' data-placement='top' title='Eliminar registro'><span class='fas fa-trash-alt'></span></a>"
				);
			}
		} else {
			foreach ($prodcutos->result() as $rows) {
				$data[] = array(
					$rows->nombre, $rows->direccion, $rows->telefono, $rows->correo,
					"<a href='#' data-href='" . base_url() . "index.php/clientes/reingresar/" . $rows->id . "' data-toggle='modal' data-target='#confirm-delete' data-placement='top' title='Eliminar registro'><span class='fas fa-arrow-alt-circle-up'></span></a>"
				);
			}
		}

		$total_registros = $this->totalRegistro($sTable, $sWhereoRG);
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

	public function totalRegistro($sTable, $sWhereoRG)
	{
		$query = $this->db->select("COUNT(*) as num")->where($sWhereoRG)->get($sTable)->row();
		if (isset($query)) return $query->num;
		return 0;
	}

	public function totalRegistroFiltrados($sTable, $where)
	{
		$query = $this->db->select("COUNT(*) as num")->where($where)->get($sTable)->row();

		if (isset($query)) return $query->num;
		return 0;
	}
}
