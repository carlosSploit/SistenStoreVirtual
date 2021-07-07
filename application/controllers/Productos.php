<?php
class productos extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model("productosModel");
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->library('session');
	}

	//Cargar catalogo
	public function index($id = 0, $mess = "mensegprueba", $estade = "")
	{
		if ($this->session->userdata('login') != 1) {
			redirect('login');
		}
		$datos["titulo"] = "Productos";
		$datos["datos"] = $this->productosModel->obtener(1);
		$this->load->view("encabezado");
		$this->load->view("productos/productos", $datos);
		$data['id'] = $id;
		$data['mesg'] = $mess;
		$data['estade'] = $estade;
		$this->load->view("pie", $data);
	}

	//Cargar catalogo eliminados
	public function eliminados($id = 0, $mess = "mensegprueba", $estade = "")
	{
		if ($this->session->userdata('login') != 1) {
			redirect('login');
		}
		$datos["titulo"] = "Productos eliminados";
		$datos["datos"] = $this->productosModel->obtener(0);
		$this->load->view("encabezado");
		$this->load->view("productos/productos_eliminados", $datos);
		$data['id'] = $id;
		$data['mesg'] = $mess;
		$data['estade'] = $estade;
		$this->load->view("pie", $data);
	}

	//Cargar catalogo sin existencia
	public function sinExistencia($existencia, $id = 0, $mess = "mensegprueba", $estade = "")
	{
		if ($this->session->userdata('login') != 1) {
			redirect('login');
		}
		$datos["titulo"] = "Productos sin existencia";
		$datos["datos"] = $this->productosModel->porExistencia($existencia);
		$this->load->view("encabezado");
		$this->load->view("productos/sin_existencia", $datos);
		$data['id'] = $id;
		$data['mesg'] = $mess;
		$data['estade'] = $estade;
		$this->load->view("pie", $data);
	}

	//Cargar catalogo stock minimo
	public function stockMinimo($id = 0, $mess = "mensegprueba", $estade = "")
	{
		if ($this->session->userdata('login') != 1) {
			redirect('login');
		}
		$datos["titulo"] = "Productos con stock mínimo";
		$datos["datos"] = $this->productosModel->porStockMinimo();
		//print_r($this->db->last_query()); 
		$this->load->view("encabezado");
		$this->load->view("productos/stock_minimo", $datos);
		$data['id'] = $id;
		$data['mesg'] = $mess;
		$data['estade'] = $estade;
		$this->load->view("pie", $data);
	}

	//Cargar vista nuevo
	public function agregar($id1 = 0, $mess = "mensegprueba", $estade = "")
	{
		if ($this->session->userdata('login') != 1) {
			redirect('login');
		}
		$this->load->model("unidadesModel");
		$this->load->model("categoriasModel");
		$unidades = $this->unidadesModel->obtener(1);
		$categorias = $this->categoriasModel->obtener(1);
		$data['unidades'] = $unidades;
		$data['categorias'] = $categorias;
		$data['title'] = 'Agregar producto';
		$this->load->view("encabezado");
		$this->load->view("productos/productos_agregar", $data);
		$data['id'] = $id1;
		$data['mesg'] = $mess;
		$data['estade'] = $estade;
		$this->load->view("pie", $data);
	}

	//Inserta y valida formulario nuevo 
	public function insertar()
	{
		$codigo = $this->input->post("codigo");
		$nombre = $this->input->post("nombre");
		$id_unidad = $this->input->post("id_unidad");
		$id_categoria = $this->input->post("id_categoria");
		$precio_venta = preg_replace('([^0-9\.])', '', $this->input->post("precio_venta"));
		$precio_compra = preg_replace('([^0-9\.])', '', $this->input->post("precio_compra"));
		$stock_minimo = preg_replace('([^0-9])', '', $this->input->post("stock_minimo"));
		$inventariable = $this->input->post("inventariable");

		$this->form_validation->set_rules('codigo', 'Código', 'required|is_unique[productos.codigo]');
		$this->form_validation->set_rules('nombre', 'Nombre', 'required');
		$this->form_validation->set_rules('id_unidad', 'Unidad', 'required');
		$this->form_validation->set_rules('id_categoria', 'Categoria', 'required');
		$this->form_validation->set_rules('precio_venta', 'Precio de venta', 'required|numeric');
		$this->form_validation->set_rules('stock_minimo', 'Stock m&iacute;nimo', 'numeric');
		$this->form_validation->set_message('required', 'El campo {field} es obligatorio.');
		$this->form_validation->set_message('numeric', 'El campo {field} debe contener solo números.');
		$this->form_validation->set_message('is_unique', 'El campo {field} debe contener un valor único.');

		if ($this->form_validation->run() == TRUE) {
			$resultado = $this->productosModel->insertar($codigo, $nombre, $id_unidad, $id_categoria, $precio_venta, $precio_compra, $stock_minimo, $inventariable, 1);
			if ($resultado) {
				$this->index(1, "Producto se agregadó con exito", "success");
			} else {
				$this->agregar(1, "Error al agregar el producto", "error");
			}
		} else {
			$this->agregar(2, "Error al agregar el producto", "error");
		}
	}

	//Cargar vista editar
	public function editar($id, $id1 = 0, $mess = "mensegprueba", $estade = "")
	{
		if ($this->session->userdata('login') != 1) {
			redirect('login');
		}
		$datoParaEditar = $this->productosModel->porId($id);
		$this->load->model("unidadesModel");
		$this->load->model("categoriasModel");
		$unidades = $this->unidadesModel->obtener(1);
		$categorias = $this->categoriasModel->obtener(1);
		$data['unidades'] = $unidades;
		$data['categorias'] = $categorias;
		$data['title'] = 'Modificar producto';
		$data['dato'] = $datoParaEditar;
		$this->load->view("encabezado");
		$this->load->view("productos/productos_editar", $data);
		$data['id'] = $id1;
		$data['mesg'] = $mess;
		$data['estade'] = $estade;
		$this->load->view("pie", $data);
	}

	//Actualiza y valida formulario editar 
	public function actualizar($redice = 0)
	{
		if (isset($_POST["id"])) {

			$id = $this->input->post("id");
			$codigo = $this->input->post("codigo");
			$codigo_org = $this->input->post("codigo_org");
			$nombre = $this->input->post("nombre");
			$id_unidad = $this->input->post("id_unidad");
			$id_categoria = $this->input->post("id_categoria");
			$precio_venta = preg_replace('([^0-9\.])', '', $this->input->post("precio_venta"));
			$precio_compra = preg_replace('([^0-9\.])', '', $this->input->post("precio_compra"));
			$stock_minimo = preg_replace('([^0-9])', '', $this->input->post("stock_minimo"));
			$inventariable = $this->input->post("inventariable");

			if ($codigo != $codigo_org) {
				$is_unique =  '|is_unique[productos.codigo]';
			} else {
				$is_unique =  '';
			}

			$this->form_validation->set_rules('codigo', 'Código', 'required');
			$this->form_validation->set_rules('nombre', 'Nombre', 'required');
			$this->form_validation->set_rules('id_unidad', 'Unidad', 'required');
			$this->form_validation->set_rules('id_categoria', 'Categoria', 'required');
			$this->form_validation->set_rules('precio_venta', 'Precio de venta', 'required|numeric');
			$this->form_validation->set_rules('stock_minimo', 'Stock m&iacute;nimo', 'numeric');
			$this->form_validation->set_message('required', 'El campo {field} es obligatorio.');
			$this->form_validation->set_message('numeric', 'El campo {field} debe contener solo números.');
			$this->form_validation->set_message('is_unique', 'El campo {field} debe contener un valor único.');

			if ($this->form_validation->run() == TRUE) {
				$resultado = $this->productosModel->guardarCambios($id, $codigo, $nombre, $id_unidad, $id_categoria, $precio_venta, $precio_compra, $stock_minimo, $inventariable, 1);

				if ($resultado) {
					$this->index(1, "Producto se a editado con exito", "success");
				} else {
					$this->editar($id, 1, "Error al editar un producto", "error");
				}
			} else {
				$this->editar($id, 2, "Error al editar un producto", "error");
			}
		} else {
			echo '<script type = "text/javascript" > alert("Evitar recargar este link"); </script>';
			redirect("productos/");
		}
	}

	//Elimina producto
	public function eliminar($id)
	{
		echo $id;
		$resultado = $this->productosModel->getRowsidState($id);
		if ($resultado == 1) {
			$resultado = $this->productosModel->eliminar($id);
			$this->index(1, "El producto se elimino con exito", "success");
		} else {
			redirect("productos/");
		}
	}

	//Reingresa producto
	public function reingresar($id)
	{
		$resultado = $this->productosModel->reingresar($id);
		redirect("productos/eliminados");
	}

	//Valida si existe producto por codigo
	public function validarCodigo($codigo)
	{
		$datos = $this->productosModel->porCodigo($codigo);
		$num_rows = $datos->num_rows();
		echo $num_rows;
	}

	private function esPositivo($numero)
	{
		return (is_numeric($numero) and $numero > -1) ? true : false;
	}

	function autocompleteData()
	{
		$returnData = array();

		$condiciones['searchTerm'] = $this->input->get('term');
		$condiciones['conditions']['activo'] = '1';
		$productos = $this->productosModel->getRows($condiciones);

		// Generate array
		if (!empty($productos)) {
			foreach ($productos as $row) {
				$data['id'] = $row['id'];
				$data['label'] = $row['codigo'] . ' - ' . $row['nombre'];
				$data['value'] = $row['codigo'];
				array_push($returnData, $data);
			}
		}

		// Return results as json encoded array
		echo json_encode($returnData);
		die;
	}

	function mostrarProductos()
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

		$aColumns = array('codigo', 'nombre', 'precio_venta', 'precio_compra', 'existencia', 'id');
		$sTable = "productos";
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
					$rows->codigo, $rows->nombre, $rows->precio_venta, $rows->precio_compra, $rows->existencia,
					"<a href='" . base_url() . "index.php/productos/editar/" . $rows->id . "' class='button' data-toggle='tooltip' data-placement='top' title='Modificar registro'><span class='fas fa-edit'></span></a>",
					"<a href='#' data-href='" . base_url() . "index.php/productos/eliminar/" . $rows->id . "' data-toggle='modal' data-target='#confirm-delete' data-placement='top' title='Eliminar registro'><span class='fas fa-trash-alt'></span></a>"
				);
			}
		} else {
			foreach ($prodcutos->result() as $rows) {
				$data[] = array(
					$rows->codigo, $rows->nombre, $rows->precio_venta, $rows->precio_compra, $rows->existencia,
					"<a href='#' data-href='" . base_url() . "index.php/productos/reingresar/" . $rows->id . "' data-toggle='modal' data-target='#confirm-delete' data-placement='top' title='Reingresar registro'><span class='fas fa-arrow-alt-circle-up'></span></a>"
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
