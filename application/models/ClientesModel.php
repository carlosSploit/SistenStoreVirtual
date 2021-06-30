<?php
class clientesModel extends CI_Model
{

	private $nombre;
	private $direccion;
	private $telefono;
	private $correo;

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	//Obtener clientes, recibe activo 1 o 0
	public function obtener($activo = 1)
	{
		$this->db->order_by('nombre', 'ASC');
		return $this->db->get_where("clientes", array('activo' => $activo))->result();
	}

	//Consulta clientes por ID
	public function porId($id)
	{
		return $this->db->get_where("clientes", ["id" => $id])->row();
	}

	//Consulta rol por nombre
	public function porNombre($nombre)
	{
		return $this->db->get_where("clientes", ["nombre" => $nombre, "activo" => 1]);
	}

	//Insertar categoria
	public function insertar($nombre, $direccion, $telefono, $correo, $activo)
	{
		return $this->db->insert("clientes", [
			"nombre" => $nombre,
			"direccion" => $direccion,
			"telefono" => $telefono,
			"correo" => $correo,
			"activo" => $activo
		]);
	}

	//Actualiza clientes
	public function guardarCambios($id, $nombre, $direccion, $telefono, $correo, $activo)
	{
		$datos = [
			"nombre" => $nombre,
			"direccion" => $direccion,
			"telefono" => $telefono,
			"correo" => $correo,
			"activo" => $activo
		];
		return $this->db->update("clientes", $datos, ["id" => $id]);
	}

	//Actualiza activo de clientes a 0
	public function eliminar($id)
	{
		$datos = ["activo" => 0];
		return $this->db->update("clientes", $datos, ["id" => $id]);
	}

	//Actualiza activo de clientes a 1
	public function reingresar($id)
	{
		$datos = ["activo" => 1];
		return $this->db->update("clientes", $datos, ["id" => $id]);
	}

	//Busqueda para autocompletado por nombre
	function getRows($params = array())
	{
		$this->db->select("*");
		$this->db->from("clientes");

		//fetch data by conditions
		if (array_key_exists("conditions", $params)) {
			foreach ($params['conditions'] as $key => $value) {
				$this->db->where($key, $value);
			}
		}

		//search by terms
		if (!empty($params['searchTerm'])) {
			$this->db->like('nombre', $params['searchTerm']);
		}

		$this->db->order_by('nombre', 'asc');

		if (array_key_exists("id", $params)) {
			$this->db->where('id', $params['id']);
			$query = $this->db->get();
			$result = $query->row_array();
		} else {
			$query = $this->db->get();
			$result = ($query->num_rows() > 0) ? $query->result_array() : FALSE;
		}

		//return fetched data
		return $result;
	}

	//Busqueda para autocompletado por nombre
	function getRowsidState($id = 0)
	{
		$this->db->select("activo");
		$this->db->from("clientes");
		$this->db->where(["id" => $id]);
		$prodcutos = $this->db->get();
		$state = 0;

		foreach ($prodcutos->result() as $rows) {
			$state = $rows->activo;
		}
		return $state;
	}
}
