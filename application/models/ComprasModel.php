<?php
class comprasModel extends CI_Model
{

	private $folio;
	private $tipo;
	private $total;
	private $fecha;
	private $id_usuario;

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}
}
