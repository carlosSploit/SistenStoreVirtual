<?php
	/*
		Copyright (c) 2019 Codigos de Programacion
		Punto de Venta CDP
		Desarrollado por Codigos de Programacion
		www.codigosdeprogramacion.com
	*/
	class comprasModel extends CI_Model{
		
		private $folio;
		private $tipo;
		private $total;
		private $fecha;
		private $id_usuario;		
		
		public function __construct(){
			parent::__construct();
			$this->load->database();
		}

	}
?>
