<?php
	class unidadesModel extends CI_Model{
		
		private $id;
		private $nombre;
		private $nombre_corto;
		private $activo;
		
		public function __construct(){
			parent::__construct();
			$this->load->database();
		}
		
		//Obtener unidades, recibe activo 1 o 0
		public function obtener($activo = 1){
			$this->db->order_by('nombre', 'ASC');
			return $this->db->get_where("unidades", array('activo' => $activo))->result();
		}
		
		//Consulta categoria por ID
		public function porId($id){
			return $this->db->get_where("unidades", ["id" => $id])->row();
		}
		
		//Consulta rol por nombre
		public function porNombre($nombre){
			return $this->db->get_where("unidades", ["nombre" => $nombre, "activo" => 1]);
		}
		
		//Insertar categoria
		public function insertar($nombre, $nombre_corto, $activo){
			return $this->db->insert("unidades", [
			"nombre" => $nombre,
			"nombre_corto" => $nombre_corto,
			"activo" => $activo
			]);
		}
		
		//Actualiza categoria
		public function guardarCambios($id, $nombre, $nombre_corto, $activo){
			$datos = [
			"nombre" => $nombre,
			"nombre_corto" => $nombre_corto,
			"activo" => $activo
			];
			return $this->db->update("unidades", $datos, ["id" => $id]);
		}
		
		//Actualiza activo de categoria a 0
		public function eliminar($id){
			$datos = ["activo" => 0];
			return $this->db->update("unidades", $datos, ["id" => $id]);
		}
		
		//Actualiza activo de categoria a 1
		public function reingresar($id){
			$datos = ["activo" => 1];
			return $this->db->update("unidades", $datos, ["id" => $id]);
		}
	}
