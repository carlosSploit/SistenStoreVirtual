<?php
	class productosModel extends CI_Model{
		
		private $id;
		private $codigo;
		private $nombre;
		private $precio_venta;
		private $precio_compra;
		private $existencia;
		private $stock_minimo;
		private $inventariable;
		private $activo;
		
		public function __construct(){
			parent::__construct();
			$this->load->database();
		}
		
		//Obtener productos, recibe activo 1 o 0
		public function obtener($activo = 1){
			$this->db->order_by('codigo', 'ASC');
			return $this->db->get_where("productos", array('activo' => $activo))->result();
		}
		
		//Consulta producto por ID
		public function porId($id){
			return $this->db->get_where("productos", ["id" => $id])->row();
		}
		
		//Consulta producto por codigo
		public function porCodigo($codigo){
			return $this->db->get_where("productos", ["codigo" => $codigo, "activo" => 1]);
		}
		
		//Consulta producto por codigo
		public function porCodigoRes($codigo){
			return $this->db->get_where("productos", ["codigo" => $codigo, "activo" => 1])->row();
		}
		//Consulta producto por existecia
		public function porExistencia($existencia){
			return $this->db->get_where("productos", ["existencia" => $existencia, "activo" => 1])->result();
		}

		//Consulta producto por stock minimo
		public function porStockMinimo(){
			return $this->db->get_where("productos", "stock_minimo>=existencia AND activo=1 AND inventariable=1")->result();
		}		
		
		//Insertar producto
		public function insertar($codigo, $nombre, $id_unidad, $id_categoria, $precio_venta, $precio_compra, $stock_minimo, $inventariable, $activo){
			return $this->db->insert("productos", [
			"codigo" => $codigo,
			"nombre" => $nombre,
			"id_unidad" => $id_unidad,
			"id_categoria" => $id_categoria,
			"precio_venta" => $precio_venta,
			"precio_compra" => $precio_compra,
			"stock_minimo" => $stock_minimo,
			"inventariable" => $inventariable,
			"activo" => $activo
			]);
		}
		
		//Actualiza producto
		public function guardarCambios($id, $codigo, $nombre, $id_unidad, $id_categoria, $precio_venta, $precio_compra, $stock_minimo, $inventariable, $activo){
			$datos = [
			"codigo" => $codigo,
			"nombre" => $nombre,
			"id_unidad" => $id_unidad,
			"id_categoria" => $id_categoria,
			"precio_venta" => $precio_venta,
			"precio_compra" => $precio_compra,
			"stock_minimo" => $stock_minimo,
			"inventariable" => $inventariable,
			"activo" => $activo
			];
			return $this->db->update("productos", $datos, ["id" => $id]);
		}
		
		//Actualiza activo de producto a 0
		public function eliminar($id){
			$datos = ["activo" => 0];
			return $this->db->update("productos", $datos, ["id" => $id]);
		}
		
		//Actualiza activo de producto a 1
		public function reingresar($id){
			$datos = ["activo" => 1];
			return $this->db->update("productos", $datos, ["id" => $id]);
		}
		
		//Actualiza actistencias
		public function actualizaExistencia($id, $cantidad, $movimiento){
			$this->db->set('existencia', "existencia $movimiento $cantidad" , FALSE);
			$this->db->where('id', $id);
			return $this->db->update("productos");
		}

		//Busqueda para autocompletado por nombre
		function getRows($params = array()){
			$this->db->select("*");
			$this->db->from("productos");
			
			//fetch data by conditions
			if(array_key_exists("conditions",$params)){
				foreach ($params['conditions'] as $key => $value) {
					$this->db->where($key,$value);
				}
			}
			
			//search by terms
			if(!empty($params['searchTerm'])){
				$this->db->like('codigo', $params['searchTerm']);
				$this->db->or_like('nombre', $params['searchTerm']);
			}
			
			$this->db->order_by('nombre', 'asc');
			$this->db->limit(5);
			
			if(array_key_exists("id",$params)){
				$this->db->where('id',$params['id']);
				$query = $this->db->get();
				$result = $query->row_array();
			}else{
				$query = $this->db->get();
				$result = ($query->num_rows() > 0)?$query->result_array():FALSE;
			}
	
			//return fetched data
			return $result;
		}
	}
