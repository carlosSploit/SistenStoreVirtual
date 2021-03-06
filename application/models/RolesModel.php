<?php
class rolesModel extends CI_Model
{

	private $id;
	private $nombre;
	private $activo;

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	//Obtener productos, recibe activo 1 o 0
	public function obtener($activo = 1)
	{
		$this->db->order_by('nombre', 'ASC');
		return $this->db->get_where("roles", array('activo' => $activo))->result();
	}

	//Consulta producto por ID
	public function porId($id)
	{
		return $this->db->get_where("roles", ["id" => $id])->row();
	}

	//Consulta rol por nombre
	public function porNombre($nombre)
	{
		return $this->db->get_where("roles", ["nombre" => $nombre, "activo" => 1]);
	}

	//Insertar producto
	public function insertar($nombre, $activo)
	{
		return $this->db->insert("roles", [
			"nombre" => $nombre,
			"activo" => $activo
		]);
	}

	//Actualiza producto
	public function guardarCambios($id, $nombre, $activo)
	{
		$datos = [
			"nombre" => $nombre,
			"activo" => $activo
		];
		return $this->db->update("roles", $datos, ["id" => $id]);
	}

	//Actualiza activo de producto a 0
	public function eliminar($id)
	{
		$datos = ["activo" => 0];
		return $this->db->update("roles", $datos, ["id" => $id]);
	}

	//Actualiza activo de producto a 1
	public function reingresar($id)
	{
		$datos = ["activo" => 1];
		return $this->db->update("roles", $datos, ["id" => $id]);
	}

	//Busqueda para autocompletado por nombre
	function getRowsidState($id = 0)
	{
		$this->db->select("activo");
		$this->db->from("roles");
		$this->db->where(["id" => $id]);
		$prodcutos = $this->db->get();
		$state = 0;

		foreach ($prodcutos->result() as $rows) {
			$state = $rows->activo;
		}
		return $state;
	}
}
