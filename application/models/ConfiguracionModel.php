<?php
	/*
		Copyright (c) 2019 Codigos de Programacion
		Punto de Venta CDP
		Desarrollado por Codigos de Programacion
		www.codigosdeprogramacion.com
	*/
	class configuracionModel extends CI_Model{
		
		private $id;
		private $nombre;
		private $valor;
		
		public function __construct(){
			parent::__construct();
			$this->load->database();
		}

		//Consulta producto por codigo
		public function porNombre($nombre){
			return $this->db->get_where("configuracion", ["nombre" => $nombre]);
		}
		
		//Actualiza campo
		public function guardarCambios($nombre, $valor){
			return $this->db->update("configuracion", ["valor" => $valor], ["nombre" => $nombre]);
		}
		
		//Consulta producto por codigo
		public function getNombreTienda(){
			return $this->db->get_where("configuracion", array('nombre' =>'tienda_nombre'))->row()->valor;
		}
	}
?>
