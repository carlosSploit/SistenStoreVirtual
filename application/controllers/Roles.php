<?php
class roles extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model("rolesModel");
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
		$datos["titulo"] = "Roles";
		$datos["datos"] = $this->rolesModel->obtener(1);
		$this->load->view("encabezado");
		$this->load->view("roles/roles", $datos);
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
		$datos["titulo"] = "Roles eliminados";
		$datos["datos"] = $this->rolesModel->obtener(0);
		$this->load->view("encabezado");
		$this->load->view("roles/roles_eliminados", $datos);
		$data['id'] = $id;
		$data['mesg'] = $mess;
		$data['estade'] = $estade;
		$this->load->view("pie", $data);
	}

	//Cargar vista nuevo
	public function agregar($id = 0, $mess = "mensegprueba", $estade = "")
	{
		if ($this->session->userdata('login') != 1) {
			redirect('login');
		}
		$data['title'] = 'Agregar rol';
		$this->load->view("encabezado");
		$this->load->view("roles/roles_agregar", $data);
		$data['id'] = $id;
		$data['mesg'] = $mess;
		$data['estade'] = $estade;
		$this->load->view("pie", $data);
	}

	//Inserta y valida formulario nuevo 
	public function insertar()
	{
		$nombre = $this->input->post("nombre");

		$this->form_validation->set_rules('nombre', 'Nombre', 'required|is_unique[roles.nombre]');
		$this->form_validation->set_message('required', 'El campo {field} es obligatorio.');
		$this->form_validation->set_message('is_unique', 'El campo {field} debe contener un valor único.');

		if ($this->form_validation->run() == TRUE) {
			$resultado = $this->rolesModel->insertar($nombre, 1);
			if ($resultado) {
				$this->index(1, "Rol se agregó con exito", "success");
			} else {
				$this->agregar(1, "Error al agregar el Rol", "error");
			}
		} else {
			$this->agregar(2, "Error al agregar el Rol", "error");
		}
	}

	//Cargar vista editar
	public function editar($id, $id1 = 0, $mess = "mensegprueba", $estade = "")
	{
		if ($this->session->userdata('login') != 1) {
			redirect('login');
		}
		$datoParaEditar = $this->rolesModel->porId($id);
		$data['title'] = 'Modificar rol';
		$data['dato'] = $datoParaEditar;
		$this->load->view("encabezado");
		$this->load->view("roles/roles_editar", $data);
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
			$nombre_org = $this->input->post("nombre_org");

			if ($nombre != $nombre_org) {
				$is_unique =  '|is_unique[roles.nombre]';
			} else {
				$is_unique =  '';
			}

			$this->form_validation->set_rules('nombre', 'Nombre', 'required' . $is_unique);
			$this->form_validation->set_message('required', 'El campo {field} es obligatorio.');
			$this->form_validation->set_message('is_unique', 'El rol ya existe.');

			if ($this->form_validation->run() == TRUE) {
				$resultado = $this->rolesModel->guardarCambios($id, $nombre, 1);

				if ($resultado) {
					$this->index(1, "Rol se a editado con exito", "success");
				} else {
					$this->editar($id, 1, "Error al editar el Rol", "error");
				}
			} else {
				$this->editar($id, 2, "Error al editar el Rol", "error");
			}
		} else {
			redirect("/roles");
		}
	}

	//Elimina producto
	public function eliminar($id)
	{
		$resultado = $this->rolesModel->getRowsidState($id);
		if ($resultado == 1) {
			$resultado = $this->rolesModel->eliminar($id);
			$this->index(1, "El rol se elimino con exito", "success");
		} else {
			redirect("unidades/");
		}
	}

	//Reingresa producto
	public function reingresar($id)
	{
		$resultado = $this->rolesModel->reingresar($id);
		redirect("roles/eliminados");
	}

	//Valida si existe rol por nombre
	public function validarNombre($nombre)
	{
		$datos = $this->rolesModel->porNombre($nombre);
		$num_rows = $datos->num_rows();
		echo $num_rows;
	}
}
