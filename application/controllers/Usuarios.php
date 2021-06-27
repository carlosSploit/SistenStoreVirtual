<?php
class usuarios extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model("usuariosModel");
		$this->load->model("cajasModel");
		$this->load->model("rolesModel");
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
		$datos["titulo"] = "Usuarios";
		$datos["datos"] = $this->usuariosModel->obtener(1);
		$this->load->view("encabezado");
		$this->load->view("usuarios/usuarios", $datos);
		$this->load->view("pie");
	}

	//Cargar catalogo eliminados
	public function eliminados()
	{
		if ($this->session->userdata('login') != 1) {
			redirect('login');
		}
		$datos["titulo"] = "Usuarios eliminados";
		$datos["datos"] = $this->usuariosModel->obtener(0);
		$this->load->view("encabezado");
		$this->load->view("usuarios/usuarios_eliminados", $datos);
		$this->load->view("pie");
	}

	//Cargar vista nuevo
	public function agregar()
	{
		if ($this->session->userdata('login') != 1) {
			redirect('login');
		}
		$roles = $this->rolesModel->obtener(1);
		$cajas = $this->cajasModel->obtenerCajas(1);
		$data['roles'] = $roles;
		$data['cajas'] = $cajas;
		$data['title'] = 'Agregar usuario';
		$this->load->view("encabezado");
		$this->load->view("usuarios/usuarios_agregar", $data);
		$this->load->view("pie");
	}

	//Inserta y valida formulario nuevo 
	public function insertar()
	{
		$usuario = $this->input->post("usuario");
		$password = $this->input->post("password");
		$repassword = $this->input->post("repassword");
		$nombre = $this->input->post("nombre");
		$id_caja = $this->input->post("id_caja");
		$id_rol = $this->input->post("id_rol");

		$this->form_validation->set_rules('usuario', 'Usuario', 'trim|required|min_length[5]|is_unique[usuarios.usuario]');
		$this->form_validation->set_rules('password', 'Contraseña', 'trim|required|min_length[8]');
		$this->form_validation->set_rules('repassword', 'Confirmar contraseña', 'trim|required|matches[password]');
		$this->form_validation->set_rules('nombre', 'Nombre', 'required');
		$this->form_validation->set_rules('id_caja', 'Caja', 'required');
		$this->form_validation->set_rules('id_rol', 'Rol', 'required');
		$this->form_validation->set_message('required', 'El campo {field} es obligatorio.');
		$this->form_validation->set_message('is_unique', 'El campo {field} debe contener un valor único.');
		$this->form_validation->set_message('matches', 'Las contraseñas no coinciden.');
		$this->form_validation->set_message('min_length', 'El campo {field} debe tener un minimo de {param} caracteres');

		if ($this->form_validation->run() == TRUE) {

			$hash = password_hash($password, PASSWORD_DEFAULT);

			//if(password_verify($password, $row->password))

			$resultado = $this->usuariosModel->insertar($usuario, $hash, $nombre, $id_caja, $id_rol, 1);
			if ($resultado) {
				redirect("usuarios/");
			} else {
				$this->agregar();
			}
		} else {
			$this->agregar();
		}
	}

	//Cargar vista editar public function editar($id, $funcion)
	public function editar($id, $funcion)
	{
		if ($this->session->userdata('login') != 1) {
			redirect('login');
		}
		$datoParaEditar = $this->usuariosModel->porId($id);
		$roles = $this->rolesModel->obtener(1);
		$cajas = $this->cajasModel->obtenerCajas(1);
		$data['roles'] = $roles;
		$data['cajas'] = $cajas;
		$data['funcion'] = $funcion;
		$data['title'] = 'Modificar usuario';
		$data['dato'] = $datoParaEditar;
		$this->load->view("encabezado");
		$this->load->view("usuarios/usuarios_editar", $data);
		$this->load->view("pie");
	}

	//Actualiza y valida formulario editar 
	public function actualizar()
	{
		$id = $this->input->post("id");
		$usuario = $this->input->post("usuario");
		$nombre = $this->input->post("nombre");
		$id_caja = $this->input->post("id_caja");
		$id_caja_org = $this->input->post("id_caja_org");
		$id_rol = $this->input->post("id_rol");

		if ($id_caja != $id_caja_org && $id_caja != 0) {
			$is_unique =  '|is_unique[usuarios.id_caja]';
		} else {
			$is_unique =  '';
		}

		$this->form_validation->set_rules('nombre', 'Nombre', 'required');
		$this->form_validation->set_rules('id_caja', 'Caja', 'required' . $is_unique);
		$this->form_validation->set_rules('id_rol', 'Rol', 'required');
		$this->form_validation->set_message('required', 'El campo {field} es obligatorio.');
		$this->form_validation->set_message('is_unique', 'La caja ya tiene usuario asignado.');

		if ($this->form_validation->run() == TRUE) {
			$resultado = $this->usuariosModel->guardarCambios($id, $nombre, $id_caja, $id_rol);

			if ($resultado) {
				redirect("usuarios/");
			} else {
				$this->editar($id, 0);
			}
		} else {
			$this->editar($id, 0);
		}
	}

	//Elimina producto
	public function eliminar($id)
	{
		$resultado = $this->usuariosModel->eliminar($id);
		redirect("usuarios/");
	}

	//Reingresa producto
	public function reingresar($id)
	{
		$resultado = $this->usuariosModel->reingresar($id);
		redirect("usuarios/eliminados");
	}

	//Cargar vista editar contraseña
	public function editar_password($id)
	{
		if ($this->session->userdata('login') != 1) {
			redirect('login');
		}

		$permitido = false;
		$idRol = $this->session->userdata('id_rol');
		$idUsuario = $this->session->userdata('id_usuario');

		if ($idRol == 1) {
			$permitido = true;
		} else {
			if ($id == $idUsuario) {
				$permitido = true;
			} else {
				$this->load->view("encabezado");
				$this->load->view('errores/error_403');
				$this->load->view("pie");
			}
		}

		if ($permitido) {
			$datoParaEditar = $this->usuariosModel->porId($id);
			$data['title'] = 'Modificar contraseña';
			$data['dato'] = $datoParaEditar;
			$this->load->view("encabezado");
			$this->load->view("usuarios/usuarios_password", $data);
			$this->load->view("pie");
		}
	}

	//Actualiza y valida formulario editar 
	public function actualizar_password()
	{
		$id = $this->input->post("id");
		$password = $this->input->post("password");
		$repassword = $this->input->post("repassword");

		$this->form_validation->set_rules('password', 'Contraseña', 'trim|required|min_length[8]');
		$this->form_validation->set_rules('repassword', 'Confirmar contraseña', 'trim|required|matches[password]');
		$this->form_validation->set_message('required', 'El campo {field} es obligatorio.');
		$this->form_validation->set_message('matches', 'Las contraseñas no coinciden.');
		$this->form_validation->set_message('min_length', 'El campo {field} debe tener un minimo de {param} caracteres');

		if ($this->form_validation->run() == TRUE) {

			$hash = password_hash($password, PASSWORD_DEFAULT);

			$resultado = $this->usuariosModel->guardarPassword($id, $hash);

			if ($resultado) {
				redirect("usuarios/");
			} else {
				$this->editar_password($id);
			}
		} else {
			$this->editar_password($id);
		}
	}

	//Cargar vista perfil
	public function perfil($id)
	{
		if ($this->session->userdata('login') != 1) {
			redirect('login');
		}
		$datoPerfil = $this->usuariosModel->porIdCompleto($id);
		$data['title'] = 'Perfil de usuario';
		$data['dato'] = $datoPerfil;
		$this->load->view("encabezado");
		$this->load->view("usuarios/usuarios_perfil", $data);
		$this->load->view("pie");
	}
}
