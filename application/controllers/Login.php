<?php
	/*
		Copyright (c) 2019 Codigos de Programacion
		Punto de Venta CDP
		Desarrollado por Codigos de Programacion
		www.codigosdeprogramacion.com
	*/
	class login extends CI_controller
	{
		public function __construct()
		{
			parent::__construct();
			$this->load->model("loginModel");
			$this->load->model("logsModel");
			$this->load->helper(array('form', 'url'));
			$this->load->library('form_validation');
			$this->load->library('session');
		}
		
		//Carga vista inicio de sesion
		public function index()
		{
			$this->load->view('login');
		}
		
		//Verifica si usuario y password es correcto
		public function verifica()
		{
			$usuario = $this->input->post('usuario');
			$password = $this->input->post('password');
			
			$this->form_validation->set_rules('usuario' ,'Usuario', 'required');
			$this->form_validation->set_rules('password' ,'Contrase&ntilde;a', 'required');
			$this->form_validation->set_message('required','El campo {field} es obligatorio.');
			
			if($this->form_validation->run() == TRUE)
			{
				if($this->loginModel->login($usuario, $password))
				{
					$this->logsModel->log_acceso($this->session->userdata('id_usuario'), 'INICIO DE SESIÓN');
					redirect('welcome');
					} else {
					$data['error'] = 'La contrase&ntilde;a no coincide';
					$this->load->view('login', $data);
				}
				
				} else {
				
				$this->load->view('login');
				$this->load->view('pie');
			}
		}
		
		//Cierra sesion
		public function logout()  
		{  
			$this->logsModel->log_acceso($this->session->userdata('id_usuario'), 'CIERRE DE SESIÓN');
			$this->session->sess_destroy(); 
			redirect("login"); 
		}  
	}														