<?php
	/*
		Copyright (c) 2020 Codigos de Programacion
		Punto de Venta CDP
		Desarrollado por Codigos de Programacion
		www.codigosdeprogramacion.com
	*/
	class movimientosModel extends CI_Model{
		
		private $id;
		private $id_transaccion;
		private $id_producto;
		private $codigo;
		private $nombre;
		private $cantidad;
		private $precio_venta;
		private $subtotal;
		
		
		public function __construct(){
			parent::__construct();
			$this->load->database();
		}
		
		//Inserta producto en tabla temporal
		public function insertar($datos, $id_transaccion, $tipo, $cantidad){

			if($tipo == 'C'){
				return $this->db->insert("movimientos", [
				"id_transaccion" => $id_transaccion,
				"tipo" => $tipo,
				"id_producto" => $datos['id'],
				"codigo" => $datos['codigo'],
				"nombre" => $datos['nombre'],
				"cantidad" => $cantidad,
				"precio" => $datos['precio_compra'],
				"subtotal" => $datos['subtotal'],
				]);
			} else if($tipo == 'V') {
				return $this->db->insert("movimientos", [
					"id_transaccion" => $id_transaccion,
					"tipo" => $tipo,
					"id_producto" => $datos['id'],
					"codigo" => $datos['codigo'],
					"nombre" => $datos['nombre'],
					"cantidad" => $cantidad,
					"precio" => $datos['precio_venta'],
					"subtotal" => $datos['subtotal'],
					]);
			}
		}
		
		//Elimina producto de tabla temporal por id_producto e id_transaccion
		public function eliminar($id_producto, $id_transaccion){
			return $this->db->delete("movimientos", ["id_producto" => $id_producto, "id_transaccion" => $id_transaccion]);
		}
		
		//Elimina productos de tabla temporal por id_transaccion
		public function eliminarTransaccion($id_transaccion, $tipo){
			return $this->db->delete("movimientos", ["id_transaccion" => $id_transaccion, "tipo" => $tipo]);
		}
		
		//Consulta ventas por id_transaccion
		public function porTransaccion($id_transaccion, $tipo){
			return $this->db->get_where("movimientos", ["id_transaccion" => $id_transaccion, "tipo" => $tipo])->result();
		}
		
		//Busca producto en tabla temporal por codigo e id_transaccion
		public function porCodigoVenta($codigo, $id_transaccion){
			return $this->db->get_where("movimientos", ["codigo" => $codigo, "id_transaccion" => $id_transaccion])->row();
		}
		
		//Busca producto en tabla temporal por id_producto e id_transaccion
		public function porIdProductoTransaccion($id_producto, $id_transaccion, $tipo){
			return $this->db->get_where("movimientos", ["id_producto" => $id_producto, "id_transaccion" => $id_transaccion, "tipo" => $tipo])->row();
		}
		
		//Actualiza cantidad y subtotal de producto si existe en tabla temporal por codigo e id_transaccion
		public function actualizaProductoTransaccion($id_producto, $id_transaccion, $tipo, $cantidad, $subtotal){
			$datos = [
			"cantidad" => $cantidad,
			"subtotal" => $subtotal,
			];
			return $this->db->update("movimientos", $datos, ["id_producto" => $id_producto, "id_transaccion" => $id_transaccion, "tipo" => $tipo]);
		}
	}
?>
