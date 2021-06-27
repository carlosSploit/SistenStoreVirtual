<?php
class configuracion extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model("configuracionModel");
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->library('session');
	}

	//Cargar formulario
	public function index()
	{
		if ($this->session->userdata('login') != 1) {
			redirect('login');
		}
		$datos["titulo"] = "Configuración";
		$this->load->view("encabezado");
		$this->load->view("configuracion/configuracion", $datos);
		$this->load->view("pie");
	}


	//Actualiza y valida formulario editar 
	public function actualizar()
	{
		$tienda_nombre = $this->input->post("tienda_nombre");
		$tienda_rfc = $this->input->post("tienda_rfc");
		$tienda_telefono = $this->input->post("tienda_telefono");
		$tienda_correo = $this->input->post("tienda_correo");
		$tienda_direccion = $this->input->post("tienda_direccion");
		$ticket_leyenda = $this->input->post("ticket_leyenda");

		$this->form_validation->set_rules('tienda_nombre', 'Nombre de tienda', 'required');
		$this->form_validation->set_rules('tienda_rfc', 'RFC de tienda', 'required');
		$this->form_validation->set_rules('tienda_telefono', 'Tel&eacute;fono de tienda', 'required');
		$this->form_validation->set_rules('tienda_correo', 'Correo electr&acute;nico de tienda', 'required');
		$this->form_validation->set_rules('tienda_direccion', 'Direcci&oacute;n de tienda', 'required');
		$this->form_validation->set_rules('ticket_leyenda', 'Leyenda para ticket de venta', 'required');
		$this->form_validation->set_message('required', 'El campo {field} es obligatorio.');


		if ($this->form_validation->run() == TRUE) {
			$this->configuracionModel->guardarCambios('tienda_nombre', $tienda_nombre);
			$this->configuracionModel->guardarCambios('tienda_rfc', $tienda_rfc);
			$this->configuracionModel->guardarCambios('tienda_telefono', $tienda_telefono);
			$this->configuracionModel->guardarCambios('tienda_correo', $tienda_correo);
			$this->configuracionModel->guardarCambios('tienda_direccion', $tienda_direccion);
			$this->configuracionModel->guardarCambios('ticket_leyenda', $ticket_leyenda);
			if ($_FILES['tienda_logo']['type'] == "image/png") {
				$ruta = $_SERVER['DOCUMENT_ROOT'] . '/' . basename(base_url()) . '/images/logo.png';
				$resultado = move_uploaded_file($_FILES["tienda_logo"]["tmp_name"], $ruta);
			}
			redirect("configuracion/");
		} else {
			$this->index();
		}
	}

	public function subirLogo()
	{
		if ($_FILES['tienda_logo']['type'] == "image/png") {
			$ruta = $_SERVER['DOCUMENT_ROOT'] . '/' . basename(base_url()) . '/images/logo_tmp.png';
			$resultado = move_uploaded_file($_FILES["tienda_logo"]["tmp_name"], $ruta);
			echo 0;
		} else {
			echo 1;
		}
	}
}
