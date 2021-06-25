<?php
	
	class detalle_venta_productoModel extends CI_Model{
		
		private $id;
		private $id_venta;
		private $id_producto;
		private $descripcion;
		private $cantidad;
		private $precio_unitario;
		
		public function __construct(){
			parent::__construct();
			$this->load->database();
		}
		
		//Inserta detalles de venta (conceptos)
		public function insertar($id_venta, $id_producto, $descripcion, $cantidad, $precio_unitario){
			return $this->db->insert("detalle_venta_producto", [
			"id_venta" => $id_venta,
			"id_producto" => $id_producto,
			"descripcion" => $descripcion,
			"cantidad" => $cantidad,
			"precio_unitario" => $precio_unitario,
			]);
		}
	}
?>
