<?php
	
	class detalle_almacen_movimientoModel extends CI_Model{
		
		private $id_movimiento;
		private $id_producto;
		private $descripcion;
		private $cantidad;
		private $precio_unitario;
		
		public function __construct(){
			parent::__construct();
			$this->load->database();
		}
		
		//Inserta detalles de venta (conceptos)
		public function insertar($id_movimiento, $id_producto, $descripcion, $cantidad, $precio_unitario){
			return $this->db->insert("detalle_almacen_movimiento", [
			"id_movimiento" => $id_movimiento,
			"id_producto" => $id_producto,
			"descripcion" => $descripcion,
			"cantidad" => $cantidad,
			"precio_unitario" => $precio_unitario,
			]);
		}
	}
?>
