<?php
	class unidades extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model("unidadesModel");
			$this->load->helper(array('form', 'url'));
			$this->load->library('form_validation');
			$this->load->library('session');
		}
		
		//Cargar catalogo
		public function index(){
			if($this->session->userdata('login') != 1){ redirect('login'); }
			$datos["titulo"] = "Unidades";
			$datos["datos"] = $this->unidadesModel->obtener(1);
			$this->load->view("encabezado");
			$this->load->view("unidades/unidades", $datos);
			$this->load->view("pie");
		}
		
		//Cargar catalogo eliminados
		public function eliminados(){
			if($this->session->userdata('login') != 1){ redirect('login'); }
			$datos["titulo"] = "Unidades eliminadas";
			$datos["datos"] = $this->unidadesModel->obtener(0);
			$this->load->view("encabezado");
			$this->load->view("unidades/unidades_eliminados", $datos);
			$this->load->view("pie");
		}
		
		//Cargar vista nuevo
		public function agregar(){ 
			if($this->session->userdata('login') != 1){ redirect('login'); }
			$data['title'] = 'Agregar unidad';
			$this->load->view("encabezado");
			$this->load->view("unidades/unidades_agregar", $data);
			$this->load->view("pie");
		}
		
		//Inserta y valida formulario nuevo 
		public function insertar(){
			$nombre = $this->input->post("nombre");
			$nombre_corto = $this->input->post("nombre_corto");
			$this->form_validation->set_rules('nombre', 'Nombre', 'required|is_unique[unidades.nombre]');
			$this->form_validation->set_rules('nombre_corto', 'Nombre corto', 'required');
			$this->form_validation->set_message('required','El campo {field} es obligatorio.');
			$this->form_validation->set_message('is_unique','El campo {field} debe contener un valor único.');
			
			if ($this->form_validation->run() == TRUE){
				$resultado = $this->unidadesModel->insertar($nombre, $nombre_corto, 1);
				if($resultado){
					redirect("unidades/");
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
			$datoParaEditar = $this->unidadesModel->porId($id);
			$data['title'] = 'Modificar unidad';
			$data['dato'] = $datoParaEditar;
			$this->load->view("encabezado");
			$this->load->view("unidades/unidades_editar", $data);
			$this->load->view("pie");
		}
		
		//Actualiza y valida formulario editar 
		public function actualizar(){
			$id = $this->input->post("id");
			$nombre = $this->input->post("nombre");
			$nombre_corto = $this->input->post("nombre_corto");
			$this->form_validation->set_rules('nombre', 'Nombre', 'required');
			$this->form_validation->set_rules('nombre_corto', 'Nombre corto', 'required');
			$this->form_validation->set_message('required','El campo {field} es obligatorio.');
			
			if ($this->form_validation->run() == TRUE){
				$resultado = $this->unidadesModel->guardarCambios($id, $nombre, $nombre_corto, 1);
				
				if($resultado){
					redirect("unidades/");
					}else{
					$this->editar($id);
				}
				} else {
				$this->editar($id);
			}
		}
		
		//Elimina producto
		public function eliminar($id){
			$resultado = $this->unidadesModel->eliminar($id);
			redirect("unidades/");
		}
		
		//Reingresa producto
		public function reingresar($id){
			$resultado = $this->unidadesModel->reingresar($id);
			redirect("unidades/eliminados");
		}

		//Valida si existe unidad por nombre
		public function validarNombre($nombre){
			$datos = $this->unidadesModel->porNombre($nombre);
			$num_rows = $datos->num_rows();
			echo $num_rows;
		}
	}
