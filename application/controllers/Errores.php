<?php
	/*
		Copyright (c) 2019 Codigos de Programacion
		Punto de Venta CDP
		Desarrollado por Codigos de Programacion
		www.codigosdeprogramacion.com
	*/
	class errores extends CI_controller
	{
		public function __construct()
		{
			parent::__construct();
			$this->load->library('session');
		}
		
		//Carga vista inicio de sesion
		public function index()
		{
			$this->load->view('login');
			//$this->load->view('pie');
		}

		//Carga vista 403
		public function error_403()
		{
			$this->load->view('error_403');
			//$this->load->view('pie');
		}
		
	}														