<?php
	class roles extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model("rolesModel");
			$this->load->helper(array('form', 'url'));
			$this->load->library('form_validation');
			$this->load->library('session');
		}
		
		//Cargar catalogo
		public function index(){
			if($this->session->userdata('login') != 1){ redirect('login'); }
			$datos["titulo"] = "Roles";
			$datos["datos"] = $this->rolesModel->obtener(1);
			$this->load->view("encabezado");
			$this->load->view("roles/roles", $datos);
			$this->load->view("pie");
		}
		
		//Cargar catalogo eliminados
		public function eliminados(){
			if($this->session->userdata('login') != 1){ redirect('login'); }
			$datos["titulo"] = "Roles eliminados";
			$datos["datos"] = $this->rolesModel->obtener(0);
			$this->load->view("encabezado");
			$this->load->view("roles/roles_eliminados", $datos);
			$this->load->view("pie");
		}
		
		//Cargar vista nuevo
		public function agregar(){ 
			if($this->session->userdata('login') != 1){ redirect('login'); }
			$data['title'] = 'Agregar rol';
			$this->load->view("encabezado");
			$this->load->view("roles/roles_agregar", $data);
			$this->load->view("pie");
		}
		
		//Inserta y valida formulario nuevo 
		public function insertar(){
			$nombre = $this->input->post("nombre");
			
			$this->form_validation->set_rules('nombre', 'Nombre', 'required|is_unique[roles.nombre]');
			$this->form_validation->set_message('required','El campo {field} es obligatorio.');
			$this->form_validation->set_message('is_unique','El campo {field} debe contener un valor único.');
			
			if ($this->form_validation->run() == TRUE){
				$resultado = $this->rolesModel->insertar($nombre, 1);
				if($resultado){
					redirect("roles/");
					}else{
					$this->agregar();
				}
				} else {
				$this->agregar();
			}
		}
		
		//Cargar vista editar
		public function editar($id){
			if($this->session->userdata('login') != 1){ redirect('login'); }
			$datoParaEditar = $this->rolesModel->porId($id);
			$data['title'] = 'Modificar rol';
			$data['dato'] = $datoParaEditar;
			$this->load->view("encabezado");
			$this->load->view("roles/roles_editar", $data);
			$this->load->view("pie");
		}
		
		//Actualiza y valida formulario editar 
		public function actualizar(){
			$id = $this->input->post("id");
			$nombre = $this->input->post("nombre");
			$nombre_org = $this->input->post("nombre_org");
			
			if($nombre != $nombre_org) {
				$is_unique =  '|is_unique[roles.nombre]';
			 } else {
				$is_unique =  '';
			}

			$this->form_validation->set_rules('nombre', 'Nombre', 'required'.$is_unique);
			$this->form_validation->set_message('required','El campo {field} es obligatorio.');
			$this->form_validation->set_message('is_unique','El rol ya existe.');
			
			if ($this->form_validation->run() == TRUE){
				$resultado = $this->rolesModel->guardarCambios($id, $nombre, 1);
				
				if($resultado){
					redirect("roles/");
					}else{
					$this->editar($id);
				}
				} else {
				$this->editar($id);
			}
		}
		
		//Elimina producto
		public function eliminar($id){
			$resultado = $this->rolesModel->eliminar($id);
			redirect("roles/");
		}
		
		//Reingresa producto
		public function reingresar($id){
			$resultado = $this->rolesModel->reingresar($id);
			redirect("roles/eliminados");
		}

		//Valida si existe rol por nombre
		public function validarNombre($nombre){
			$datos = $this->rolesModel->porNombre($nombre);
			$num_rows = $datos->num_rows();
			echo $num_rows;
		}
	}
