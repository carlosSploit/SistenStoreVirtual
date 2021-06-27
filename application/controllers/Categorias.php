<?php
	class categorias extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model("categoriasModel");
			$this->load->helper(array('form', 'url'));
			$this->load->library('form_validation');
			$this->load->library('session');
		}
		
		//Cargar catalogo
		public function index(){
			if($this->session->userdata('login') != 1){ redirect('login'); }
			$datos["titulo"] = "Categorias";
			$datos["datos"] = $this->categoriasModel->obtener(1);
			$this->load->view("encabezado");
			$this->load->view("categorias/categorias", $datos);
			$this->load->view("pie");
		}
		
		//Cargar catalogo eliminados
		public function eliminados(){
			if($this->session->userdata('login') != 1){ redirect('login'); }
			$datos["titulo"] = "Categorias eliminadas";
			$datos["datos"] = $this->categoriasModel->obtener(0);
			$this->load->view("encabezado");
			$this->load->view("categorias/categorias_eliminados", $datos);
			$this->load->view("pie");
		}
		
		//Cargar vista nuevo
		public function agregar(){ 
			if($this->session->userdata('login') != 1){ redirect('login'); }
			$data['title'] = 'Agregar categoria';
			$this->load->view("encabezado");
			$this->load->view("categorias/categorias_agregar", $data);
			$this->load->view("pie");
		}
		
		//Inserta y valida formulario nuevo 
		public function insertar(){
			$nombre = $this->input->post("nombre");
			
			$this->form_validation->set_rules('nombre', 'Nombre', 'required|is_unique[categorias.nombre]');
			$this->form_validation->set_message('required','El campo {field} es obligatorio.');
			$this->form_validation->set_message('is_unique','El campo {field} debe contener un valor único.');
			
			if ($this->form_validation->run() == TRUE){
				$resultado = $this->categoriasModel->insertar($nombre, 1);
				if($resultado){
					redirect("categorias/");
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
			$datoParaEditar = $this->categoriasModel->porId($id);
			$data['title'] = 'Modificar categoria';
			$data['dato'] = $datoParaEditar;
			$this->load->view("encabezado");
			$this->load->view("categorias/categorias_editar", $data);
			$this->load->view("pie");
		}
		
		//Actualiza y valida formulario editar 
		public function actualizar(){
			$id = $this->input->post("id");
			$nombre = $this->input->post("nombre");
			$this->form_validation->set_rules('nombre', 'Nombre', 'required');
			$this->form_validation->set_message('required','El campo {field} es obligatorio.');
			
			if ($this->form_validation->run() == TRUE){
				$resultado = $this->categoriasModel->guardarCambios($id, $nombre, 1);
				
				if($resultado){
					redirect("categorias/");
					}else{
					$this->editar($id);
				}
				} else {
				$this->editar($id);
			}
		}
		
		//Elimina producto
		public function eliminar($id){
			$resultado = $this->categoriasModel->eliminar($id);
			redirect("categorias/");
		}
		
		//Reingresa producto
		public function reingresar($id){
			$resultado = $this->categoriasModel->reingresar($id);
			redirect("categorias/eliminados");
		}

		//Valida si existe categoria por nombre
		public function validarNombre($nombre){
			$datos = $this->categoriasModel->porNombre($nombre);
			$num_rows = $datos->num_rows();
			echo $num_rows;
		}
	}
