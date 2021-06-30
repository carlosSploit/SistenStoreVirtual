<?php
class categorias extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model("categoriasModel");
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
		$datos["titulo"] = "Categorias";
		$datos["datos"] = $this->categoriasModel->obtener(1);
		$this->load->view("encabezado");
		$this->load->view("categorias/categorias", $datos);
		$data['id'] = $id;
		$data['mesg'] = $mess;
		$data['estade'] = $estade;
		$this->load->view("pie", $data);
	}

	//Cargar catalogo eliminados
	public function eliminados($id1 = 0, $mess = "mensegprueba", $estade = "")
	{
		if ($this->session->userdata('login') != 1) {
			redirect('login');
		}
		$datos["titulo"] = "Categorias eliminadas";
		$datos["datos"] = $this->categoriasModel->obtener(0);
		$this->load->view("encabezado");
		$this->load->view("categorias/categorias_eliminados", $datos);
		$data['id'] = $id1;
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
		$data['title'] = 'Agregar categoria';
		$this->load->view("encabezado");
		$this->load->view("categorias/categorias_agregar", $data);
		$data['id'] = $id1;
		$data['mesg'] = $mess;
		$data['estade'] = $estade;
		$this->load->view("pie", $data);
	}

	//Inserta y valida formulario nuevo 
	public function insertar()
	{
		$nombre = $this->input->post("nombre");

		$this->form_validation->set_rules('nombre', 'Nombre', 'required|is_unique[categorias.nombre]');
		$this->form_validation->set_message('required', 'El campo {field} es obligatorio.');
		$this->form_validation->set_message('is_unique', 'El campo {field} debe contener un valor único.');

		if ($this->form_validation->run() == TRUE) {
			$resultado = $this->categoriasModel->insertar($nombre, 1);
			if ($resultado) {
				$this->index(1, "La Categoria se a insertado con exito", "success");
			} else {
				$this->agregar(1, "Error al ingresar la categoria", "error");
			}
		} else {
			$this->agregar(1, "Error al ingresar la categoria", "error");
		}
	}

	//Cargar vista editar
	public function editar($id, $id1 = 0, $mess = "mensegprueba", $estade = "")
	{
		if ($this->session->userdata('login') != 1) {
			redirect('login');
		}
		$datoParaEditar = $this->categoriasModel->porId($id);
		$data['title'] = 'Modificar categoria';
		$data['dato'] = $datoParaEditar;
		$this->load->view("encabezado");
		$this->load->view("categorias/categorias_editar", $data);
		$data['id'] = $id1;
		$data['mesg'] = $mess;
		$data['estade'] = $estade;
		$this->load->view("pie", $data);
	}

	//Actualiza y valida formulario editar 
	public function actualizar()
	{
		if (isset($_POST["id"])) {
			$id = $this->input->post("id");
			$nombre = $this->input->post("nombre");
			$this->form_validation->set_rules('nombre', 'Nombre', 'required');
			$this->form_validation->set_message('required', 'El campo {field} es obligatorio.');

			if ($this->form_validation->run() == TRUE) {
				$resultado = $this->categoriasModel->guardarCambios($id, $nombre, 1);

				if ($resultado) {
					$this->index(1, "La categoria se a actualizado con exito", "success");
				} else {
					$this->editar($id, 1, "Error al actualizar la categoria", "error");
				}
			} else {
				$this->editar($id, 1, "Error al actualizar la categoria", "error");
			}
		} else {
			redirect("/categorias");
		}
	}

	//Elimina producto
	public function eliminar($id)
	{
		$resultado = $this->categoriasModel->getRowsidState($id);
		if ($resultado == 1) {
			$resultado = $this->categoriasModel->eliminar($id);
			$this->index(1, "La categoria se a eliminado con exito", "success");
		} else {
			redirect("categorias/");
		}
	}

	//Reingresa producto
	public function reingresar($id)
	{
		$resultado = $this->categoriasModel->reingresar($id);
		redirect("categorias/eliminados");
	}

	//Valida si existe categoria por nombre
	public function validarNombre($nombre)
	{
		$datos = $this->categoriasModel->porNombre($nombre);
		$num_rows = $datos->num_rows();
		echo $num_rows;
	}
}
