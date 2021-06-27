<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('session');
	}

	//Carga vista inicio de sesion
	public function index()
	{
		if ($this->session->userdata('login') != 1) {
			redirect('login');
		}
		$this->load->view("encabezado");
		$this->load->view('welcome');
		$this->load->view("pie");
	}
}
