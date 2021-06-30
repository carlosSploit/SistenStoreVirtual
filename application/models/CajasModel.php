<?php
class cajasModel extends CI_Model
{

	private $id;
	private $no_caja;
	private $nombre;
	private $remision;
	private $activo;

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	//Obtener cajas, recibe activo 1 o 0 y omite campo 0
	public function obtener($activo = 1)
	{
		return $this->db->get_where("cajas", array('activo' => $activo, 'id !=' => 0))->result();
	}

	//Obtener cajas, recibe activo 1 o 0
	public function obtenerCajas($activo = 1)
	{
		return $this->db->get_where("cajas", array('activo' => $activo))->result();
	}

	//Consulta caja por ID
	public function porId($id)
	{
		return $this->db->get_where("cajas", ["id" => $id])->row();
	}

	//Insertar caja
	public function insertar($no_caja, $nombre, $remision, $activo)
	{
		return $this->db->insert("cajas", [
			"no_caja" => $no_caja,
			"nombre" => $nombre,
			"remision" => $remision,
			"activo" => $activo
		]);
	}

	//Actualiza caja
	public function guardarCambios($id, $no_caja, $nombre, $remision)
	{
		$datos = [
			"no_caja" => $no_caja,
			"nombre" => $nombre,
			"remision" => $remision,
		];
		return $this->db->update("cajas", $datos, ["id" => $id]);
	}

	//Actualiza activo de caja a 0
	public function eliminar($id)
	{
		$datos = ["activo" => 0];
		return $this->db->update("cajas", $datos, ["id" => $id]);
	}

	//Actualiza activo de caja a 1
	public function reingresar($id)
	{
		$datos = ["activo" => 1];
		return $this->db->update("cajas", $datos, ["id" => $id]);
	}

	//Consulta ultimo folio
	public function ultimoFolio($id)
	{
		return $this->db->get_where("cajas", ["id" => $id])->row()->remision;
	}

	//Actualiza siguiente folio
	public function siguienteFolio($id)
	{
		$this->db->set('remision', "LPAD(remision+1,10,'0')", FALSE);
		$this->db->where('id', $id);
		$this->db->update('cajas');
	}

	//Busqueda para autocompletado por nombre
	function getRowsidState($id = 0)
	{
		$this->db->select("activo");
		$this->db->from("cajas");
		$this->db->where(["id" => $id]);
		$prodcutos = $this->db->get();
		$state = 0;

		foreach ($prodcutos->result() as $rows) {
			$state = $rows->activo;
		}
		return $state;
	}
}
