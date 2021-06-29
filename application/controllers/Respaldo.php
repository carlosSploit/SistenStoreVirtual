<?php
class respaldo extends CI_Controller
{
	public function __construct()
	{
		header('Access-Control-Allow-Origin: *');
		parent::__construct();
		$this->load->library('session');
		$this->load->model("logsModel");
	}

	//Carga caja
	public function index($id = 0, $mess = "mensegprueba", $estade = "")
	{
		if ($this->session->userdata('login') != 1) {
			redirect('login');
		}
		$datos["titulo"] = "Respaldo";
		$this->load->view("encabezado");
		$this->load->view("respaldo/respaldo", $datos);
		$data['id'] = $id;
		$data['mesg'] = $mess;
		$data['estade'] = $estade;
		$this->load->view("pie", $data);
	}
}
