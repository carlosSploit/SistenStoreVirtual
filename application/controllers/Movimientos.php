<?php

	class movimientos extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->model("movimientosModel");
			$this->load->library('session');
		}
		
		//Busca producto por codigo e id_venta en tabla temporal
		public function buscarProductoCodigo($codigo, $id_venta){
			$cantidad = 1;
			$error = '';
			$this->load->model("productosModel");
			$datos = $this->productosModel->porCodigoRes($codigo);
			if($datos){
				
				$datosExiste = $this->movimientosModel->porCodigoVenta($codigo, $id_venta);
				
				if($datosExiste){
					
					$cantidad = $datosExiste->cantidad + 1;
					
					if($datos->existencia >= $cantidad){
						$subtotal = $cantidad * $datosExiste->precio_venta;
						$this->movimientosModel->actualizaProductoVenta($codigo, $id_venta, $cantidad, $subtotal);
						} else {
						$error = 'NO hay suficientes existencia';
					}
					
					} else {
					
					if($datos->existencia >= $cantidad){
						$datosInserta = json_decode(json_encode($datos), True);
						$this->movimientosModel->insertar($datosInserta, $id_venta);
						} else {
						$error = 'NO hay suficientes existencia';
					}
				}
				
				} else {
				$error = 'No existe producto';
			}
			
			$res['datos'] = $this->cargaProductosCaja($id_venta);
			$res['total'] = number_format(round($this->totalProductosCaja($id_venta), 2), 2, '.', ',');
			$res['error'] = $error;
			
			echo json_encode($res);
		}
		
		//Elimina producto de tabla temporal por id_producto e id_venta
		public function eliminarProductoVenta($id_producto, $id_venta){
			$datos = $this->movimientosModel->porIdProductoVenta($id_producto, $id_venta);
			if($datos){
				if($datos->cantidad > 1){
					$cantidad = $datos->cantidad - 1;
					$subtotal = $cantidad * $datos->precio_venta;
					$this->movimientosModel->actualizaProductoVenta($datos->codigo, $id_venta, $cantidad, $subtotal);
					} else {
					$this->movimientosModel->eliminar($id_producto, $id_venta);
				}
			}
			$res['datos'] = $this->cargaProductosCaja($id_venta);
			$res['total'] = number_format(round($this->totalProductosCaja($id_venta), 2), 2, '.', ',');
			$res['error'] = '';
			
			echo json_encode($res);
		}
		
		//Llena tabla de productos en caja por id_venta
		public function cargaProductosCaja($id_venta){
			$resultadoVenta = $this->movimientosModel->porVenta($id_venta);
			$fila = '';
			$numFila=0;
			
			foreach($resultadoVenta as $row){ 
				$numFila++;
				$fila.= "<tr id='fila".$numFila."'>";
				$fila.= "<td>".$numFila."</td>";
				$fila.= "<td><input type='hidden' id='id".$numFila."' name='id[]' value='".$row->id_producto."' >".$row->codigo."</td>";
				$fila.= "<td><input type='hidden' id='codigo".$numFila."'  name='codigo[]' value='".$row->codigo."' >".$row->nombre."</td>";
				$fila.= "<td><input type='hidden' id='precio_venta".$numFila."' name='precio_venta[]' value='".$row->precio_venta."' >".$row->precio_venta."</td>";
				$fila.= "<td><input type='hidden' id='cantidad".$numFila."' name='cantidad[]' value='".$row->cantidad."' >".$row->cantidad."</td>";
				$fila.= "<td><input type='hidden' id='subtotal".$numFila."' name='subtotal[]' value='".$row->subtotal."' >".$row->subtotal."</td>";
				$fila.= "<td style='text-align: center;'><a onclick=\"eliminarProducto(".$row->id_producto.", '".$id_venta."')\" class='borrar'><span class='fas fa-fw fa-trash'></span></a></td>";
				$fila.= '</tr>';
				
			}
			
			return $fila;
		}
		
		//Suma el importe total de producto por $id_venta
		public function totalProductosCaja($id_venta){
			$resultadoVenta = $this->movimientosModel->porVenta($id_venta);
			$total = 0;
			
			foreach($resultadoVenta as $row){ 
				$total+=$row->subtotal;
			}
			
			return $total;
		}
		
		//Genera ticket en PDF 
		function generaTicket($id_venta) 
		{
			if($this->session->userdata('login') != 1){ redirect('login'); }
			$data['id_venta'] = $id_venta;			
			$this->load->view('caja/ticket', $data);
		}
		
		//Muestra ticket en div
		function muestraTicket($id_venta) 
		{
			if($this->session->userdata('login') != 1){ redirect('login'); }
			$data['id_venta'] = $id_venta;	
			$this->load->view("encabezado");
			$this->load->view('caja/ver_ticket', $data);
			$this->load->view("pie");
		}
	}
