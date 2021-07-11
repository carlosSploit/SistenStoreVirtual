<?php

defined('BASEPATH') or exit('No direct script access allowed');
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
	public function index($id = 0, $mess = "mensegprueba", $estade = "")
	{
		if ($this->session->userdata('login') != 1) {
			redirect('login');
		}
		$datos["titulo"] = "Usuarios";
		$datos["datos"] = $this->usuariosModel->obtener(1);
		$this->load->view("encabezado");
		$this->load->view("usuarios/usuarios", $datos);
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
		$datos["titulo"] = "Usuarios eliminados";
		$datos["datos"] = $this->usuariosModel->obtener(0);
		$this->load->view("encabezado");
		$this->load->view("usuarios/usuarios_eliminados", $datos);
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
		$roles = $this->rolesModel->obtener(1);
		$cajas = $this->cajasModel->obtenerCajas(1);
		$data['roles'] = $roles;
		$data['cajas'] = $cajas;
		$data['title'] = 'Agregar usuario';
		$this->load->view("encabezado");
		$this->load->view("usuarios/usuarios_agregar", $data);
		$data['id'] = $id;
		$data['mesg'] = $mess;
		$data['estade'] = $estade;
		$this->load->view("pie", $data);
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
				$this->index(1, "Usuario se agregar con exito", "success");
			} else {
				$this->agregar(1, "Error al agregar el Usuario", "error");
			}
		} else {
			$this->agregar(2, (""), "error");
		}
	}

	//Cargar vista editar public function editar($id, $funcion)
	public function editar($id, $funcion, $id1 = 0, $mess = "mensegprueba", $estade = "")
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
					$this->index(1, "Usuario se a editado con exito", "success");
				} else {
					$this->editar($id, 0, 1, "Error al editar el Usuario", "error");
				}
			} else {
				$this->editar($id, 0, 2, "Error al editar el Usuario", "error");
			}
		} else {
			redirect("/usuarios");
		}
	}

	//Elimina producto
	public function eliminar($id)
	{
		$resultado = $this->usuariosModel->getRowsidState($id);
		if ($resultado == 1) {
			$resultado = $this->usuariosModel->eliminar($id);
			$this->index(1, "Eliminado Usuario se a eliminado con exito", "success");
		} else {
			redirect("/usuarios");
		}
	}

	//Reingresa producto
	public function reingresar($id)
	{
		$resultado = $this->usuariosModel->reingresar($id);
		redirect("usuarios/eliminados");
	}

	//Cargar vista editar contraseña
	public function editar_password($id, $id1 = 0, $mess = "Los graficos se realizaron con exito", $estade = "success")
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
			$data['id'] = $id1;
			$data['mesg'] = $mess;
			$data['estade'] = $estade;
			$this->load->view("pie", $data);
		}
	}

	//Actualiza y valida formulario editar 
	public function actualizar_password()
	{
		if (isset($_POST["id"])) {

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
					$this->editar_password($id, 1, "error al ingresar la contraseña", "error");
				}
			} else {
				$this->editar_password($id, 2, "error al ingresar la contraseña", "error");
			}
		} else {
			redirect("/usuarios");
		}
	}

	//Cargar vista perfil
	public function perfil($id, $id1 = 0, $mess = "Los graficos se realizaron con exito", $estade = "success")
	{
		if ($this->session->userdata('login') != 1) {
			redirect('login');
		}
		$datoPerfil = $this->usuariosModel->porIdCompleto($id);
		$data['title'] = 'Perfil de usuario';
		$data['dato'] = $datoPerfil;
		$this->load->view("encabezado");
		$this->load->view("usuarios/usuarios_perfil", $data);
		$data['id'] = $id1;
		$data['mesg'] = $mess;
		$data['estade'] = $estade;
		$this->load->view("pie", $data);
	}
}
