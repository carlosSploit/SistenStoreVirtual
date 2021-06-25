<?php

	class detalle_venta_producto extends CI_Controller{
        public function __construct(){
            parent::__construct();
			$this->load->library('session');
            $this->load->model("detalle_venta_productoModel");
		}
        public function index(){
            $this->listar(1);
		}
        public function listar($pagina = 1){
            $totalDeFilas = $this->detalle_venta_productoModel->totalDeFilas();
            $paginas = ceil( $totalDeFilas / DATOS_MOSTRAR_POR_PAGINA);
            $this->load->view("encabezado");
            $this->load->view("detalle_venta_producto",
			[
			"titulo" => "Detalle_venta_producto",
			"datos" => $this->detalle_venta_productoModel->obtener($pagina),
			"paginaActual" => $pagina,
			"paginas" => $paginas,
			]
            );
            $this->load->view("pie");
		}
        public function json($pagina = 1){
            echo json_encode($this->detalle_venta_productoModel->obtener($pagina), JSON_NUMERIC_CHECK);
		}
        public function eliminar($id){
            $resultado = $this->detalle_venta_productoModel->eliminar($id);
            if($resultado){
                $mensaje = "detalle_venta_producto eliminado correctamente";
                $clase = "is-success";
				}else{
                $mensaje = "Error al eliminar detalle_venta_producto";
                $clase = "is-danger";
			}
            $this->session->set_flashdata(array(
			"mensaje" => $mensaje,
			"clase" => $clase,
            ));
            redirect("detalle_venta_producto/");
		}
		
        public function editar($id){
            $datoParaEditar = $this->detalle_venta_productoModel->porId($id);
            $this->load->view("encabezado");
            $this->load->view("detalle_venta_producto_editar", ["dato" => $datoParaEditar]);
            $this->load->view("pie");
		}
		
        public function agregar(){
            $this->load->view("encabezado");
            $this->load->view("detalle_venta_producto_agregar");
            $this->load->view("pie");
		}
        public function insertar(){
            $resultado = $this->detalle_venta_productoModel->insertar($this->input->post("id_venta"),
            $this->input->post("id_producto"),
            $this->input->post("cantidad"),
            $this->input->post("precio_unitario"));
            if($resultado){
                $mensaje = "detalle_venta_producto insertado correctamente";
                $clase = "is-success";
				}else{
                $mensaje = "Error al insertar detalle_venta_producto";
                $clase = "is-danger";
			}
            $this->session->set_flashdata(array(
			"mensaje" => $mensaje,
			"clase" => $clase,
            ));
            redirect("detalle_venta_producto/");
		}
        public function actualizar(){
            $resultado = $this->detalle_venta_productoModel->guardarCambios($this->input->post("id"),
            $this->input->post("id_venta"),
            $this->input->post("id_producto"),
            $this->input->post("cantidad"),
            $this->input->post("precio_unitario"));
            if($resultado){
                $mensaje = "detalle_venta_producto actualizado correctamente";
                $clase = "is-success";
				}else{
                $mensaje = "Error al actualizar detalle_venta_producto";
                $clase = "is-danger";
			}
            $this->session->set_flashdata(array(
			"mensaje" => $mensaje,
			"clase" => $clase,
            ));
            redirect("detalle_venta_producto/");
		}
	}
?>