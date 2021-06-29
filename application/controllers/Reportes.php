<?php
class reportes extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model("ventasModel");
		$this->load->model("cajasModel");
		$this->load->library('session');
	}

	//Muestra vista para filtrar reporte
	function detalle_reporte_venta($id = 0, $mess = "mensegprueba", $estade = "")
	{
		if ($this->session->userdata('login') != 1) {
			redirect('login');
		}
		$data['titulo'] = "Genera reporte de ventas";
		$data['cajas'] = $this->cajasModel->obtener(1);
		$this->load->view("encabezado");
		$this->load->view('reportes/detalle_reporte_venta', $data);
		$data['id'] = $id;
		$data['mesg'] = $mess;
		$data['estade'] = $estade;
		$this->load->view("pie", $data);
	}

	//Muestra div con reporte de ventas
	function muestra_reporte_ventas($id = 0, $mess = "mensegprueba", $estade = "")
	{
		if ($this->session->userdata('login') != 1) {
			redirect('login');
		}
		if (!$this->input->post()) {
			redirect('reportes/detalle_reporte_venta');
		}
		$titulo = 'Reporte de ventas';
		$fecha_inicio = $this->input->post("fecha_inicio");
		$fecha_fin = $this->input->post("fecha_fin");
		$caja = $this->input->post("caja");

		$data['titulo'] = $titulo;
		$data['fecha_inicio'] = $fecha_inicio;
		$data['fecha_fin'] = $fecha_fin;
		$data['caja'] = $caja;
		$this->load->view("encabezado");
		$this->load->view('reportes/ver_reporte_ventas', $data);
		$data['id'] = $id;
		$data['mesg'] = $mess;
		$data['estade'] = $estade;
		$this->load->view("pie", $data);
	}

	//Genera PDF de reporte de ventas
	function pdf_reporte_ventas($fecha_inicio, $fecha_fin, $caja, $id = 0, $mess = "mensegprueba", $estade = "")
	{
		$data['fecha_inicio'] = $fecha_inicio;
		$data['fecha_fin'] = $fecha_fin;
		$data['caja'] = $caja;
		$this->load->view('reportes/reporte_ventas', $data);
	}

	//Muestra div con reporte de producto
	function muestra_reporte_productos($id = 0, $mess = "mensegprueba", $estade = "")
	{
		if ($this->session->userdata('login') != 1) {
			redirect('login');
		}

		$titulo = 'Reporte de productos';
		$data['titulo'] = $titulo;

		$this->load->view("encabezado");
		$this->load->view('reportes/ver_reporte_productos', $data);
		$data['id'] = $id;
		$data['mesg'] = $mess;
		$data['estade'] = $estade;
		$this->load->view("pie", $data);
	}

	//Genera PDF de reporte de productos
	function pdf_reporte_productos()
	{
		$this->load->view('reportes/reporte_productos');
	}

	//Muestra div con reporte de producto stock minimo
	function muestra_reporte_stock_minimo($id = 0, $mess = "mensegprueba", $estade = "")
	{
		if ($this->session->userdata('login') != 1) {
			redirect('login');
		}

		$titulo = 'Reporte de productos con stock mínimo';
		$data['titulo'] = $titulo;

		$this->load->view("encabezado");
		$this->load->view('reportes/ver_reporte_stock_minimo', $data);
		$data['id'] = $id;
		$data['mesg'] = $mess;
		$data['estade'] = $estade;
		$this->load->view("pie", $data);
	}

	//Genera PDF de reporte de productos stock minimo
	function pdf_reporte_stock_minimo()
	{
		$this->load->view('reportes/reporte_stock_minimo');
	}

	//Muestra vista para filtrar reporte producto categoria
	function detalle_productos_categoria($id = 0, $mess = "mensegprueba", $estade = "")
	{
		if ($this->session->userdata('login') != 1) {
			redirect('login');
		}
		$this->load->model("categoriasModel");
		$data['categorias'] = $this->categoriasModel->obtener(1);
		$data['titulo'] = "Genera reporte productos por categoría";
		$this->load->view("encabezado");
		$this->load->view('reportes/detalle_productos_categoria', $data);
		$data['id'] = $id;
		$data['mesg'] = $mess;
		$data['estade'] = $estade;
		$this->load->view("pie", $data);
	}

	//Muestra div con reporte de ventas
	function muestra_productos_categoria($id = 0, $mess = "mensegprueba", $estade = "")
	{
		if ($this->session->userdata('login') != 1) {
			redirect('login');
		}
		if (!$this->input->post()) {
			redirect('reportes/detalle_productos_categoria');
		}
		$titulo = 'Reporte de productos por categor&iacute;a';
		$categoria = $this->input->post("categoria");

		$data['titulo'] = $titulo;
		$data['categoria'] = $categoria;
		$this->load->view("encabezado");
		$this->load->view('reportes/ver_reporte_productos_categoria', $data);
		$data['id'] = $id;
		$data['mesg'] = $mess;
		$data['estade'] = $estade;
		$this->load->view("pie", $data);
	}

	//Genera PDF de reporte de productos stock minimo
	function pdf_productos_categoria($categoria)
	{
		$data['categoria'] = $categoria;
		$this->load->view('reportes/reporte_productos_categoria', $data);
	}
}
