<?php
	/*
		Copyright (c) 2020 Codigos de Programacion
		Punto de Venta CDP
		Desarrollado por Codigos de Programacion
		www.codigosdeprogramacion.com
	*/
	class cajas extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model("cajasModel");
			$this->load->helper(array('form', 'url'));
			$this->load->library('form_validation');
			$this->load->library('session');
		}
		
		//Cargar catalogo
		public function index(){
			if($this->session->userdata('login') != 1){ redirect('login'); }
			$datos["titulo"] = "Cajas";
			$datos["datos"] = $this->cajasModel->obtener(1);
			$this->load->view("encabezado");
			$this->load->view("cajas/cajas", $datos);
			$this->load->view("pie");
		}
		
		//Cargar catalogo eliminados
		public function eliminados(){
			if($this->session->userdata('login') != 1){ redirect('login'); }
			$datos["titulo"] = "Cajas eliminadas";
			$datos["datos"] = $this->cajasModel->obtener(0);
			$this->load->view("encabezado");
			$this->load->view("cajas/cajas_eliminados", $datos);
			$this->load->view("pie");
		}
		
		//Cargar vista nuevo
		public function agregar(){ 
			if($this->session->userdata('login') != 1){ redirect('login');}
			$data['title'] = 'Agregar caja';
			$this->load->view("encabezado");
			$this->load->view("cajas/cajas_agregar", $data);
			$this->load->view("pie");
		}
		
		//Inserta y valida formulario nuevo 
		public function insertar(){
			$no_caja = $this->input->post("no_caja");
			$nombre = $this->input->post("nombre");
			$remision = $this->input->post("remision");
			
			$this->form_validation->set_rules('no_caja', 'NÚmero de caja', 'required');
			$this->form_validation->set_rules('nombre', 'Nombre', 'required');
			$this->form_validation->set_rules('remision', 'Remision', 'required|numeric');
			$this->form_validation->set_message('required','El campo {field} es obligatorio.');
			$this->form_validation->set_message('numeric','El campo {field} deber ser numérico.');
			
			if ($this->form_validation->run() == TRUE){
				$resultado = $this->cajasModel->insertar($no_caja, $nombre, $remision, 1);
				if($resultado){
					redirect("cajas/");
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
			$dato = $this->cajasModel->porId($id);
			$data['title'] = 'Modificar caja';
			$data['dato'] = $dato;
			$this->load->view("encabezado");
			$this->load->view("cajas/cajas_editar", $data);
			$this->load->view("pie");
		}
		
		//Actualiza y valida formulario editar 
		public function actualizar(){
			$id = $this->input->post("id");
			$no_caja = $this->input->post("no_caja");
			$nombre = $this->input->post("nombre");
			$remision = $this->input->post("remision");
			$this->form_validation->set_rules('no_caja', 'NÚmero de caja', 'required');
			$this->form_validation->set_rules('nombre', 'Nombre', 'required');
			$this->form_validation->set_rules('remision', 'Remision', 'required|numeric');
			$this->form_validation->set_message('required','El campo {field} es obligatorio.');
			$this->form_validation->set_message('numeric','El campo {field} deber ser numérico.');
			
			/*if($id_usuario != $id_usuario_org) {
				$is_unique =  '|is_unique[cajas.id_usuario]';
			 } else {
				$is_unique =  '';
			 }*/			
			
			if ($this->form_validation->run() == TRUE){
				$resultado = $this->cajasModel->guardarCambios($id, $no_caja, $nombre, $remision);
				
				if($resultado){
					redirect("cajas/");
					}else{
					$this->editar($id);
				}
				} else {
				$this->editar($id);
			}
		}
		
		//Elimina caja
		public function eliminar($id){
			$resultado = $this->cajasModel->eliminar($id);
			redirect("cajas/");
		}
		
		//Reingresa caja
		public function reingresar($id){
			$resultado = $this->cajasModel->reingresar($id);
			redirect("cajas/eliminados");
		}
	}
?>					