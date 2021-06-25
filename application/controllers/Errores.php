<?php

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
