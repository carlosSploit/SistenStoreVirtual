<?php
class almacenModel extends CI_Model
{

	private $folio;
	private $tipo;
	private $total;
	private $fecha;
	private $id_usuario;

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	//Inserta producto en tabla almacen
	public function insertar($folio, $tipo, $total, $fecha, $id_usuario)
	{
		$this->db->insert("almacen_movimiento", [
			"folio" => $folio,
			"tipo" => $tipo,
			"total" => $total,
			"fecha" => $fecha,
			"id_usuario" => $id_usuario,
			"activo" => 1
		]);
		return $this->db->insert_id();
	}

	//Consulta ultimo folio
	public function ultimoFolio($id)
	{
		return $this->db->get_where("folio", ["id" => $id])->row()->folio;
	}

	//Actualiza siguiente folio
	public function siguienteFolio($id)
	{
		$this->db->set('folio', "LPAD(folio+1,10,'0')", FALSE);
		$this->db->where('id', $id);
		$this->db->update('folio');
	}

	//Obtener transacciones, recibe activo 1 o 0
	public function obtener($activo = 1)
	{
		$this->db->select('a.*,u.usuario AS cajero');
		$this->db->from('almacen_movimiento a');
		$this->db->join('usuarios u', 'a.id_usuario = u.id');
		$this->db->where('a.activo', $activo);
		$this->db->order_by('a.fecha', 'DESC');
		return $this->db->get()->result();
	}

	//Cambia activo de transaccion a 0
	public function eliminar($id)
	{
		$datos = ["activo" => 0];
		return $this->db->update("almacen_movimiento", $datos, ["id" => $id]);
	}

	function getRowsidState($id = 0)
	{
		$this->db->select("activo");
		$this->db->from("almacen_movimiento");
		$this->db->where(["id" => $id]);
		$prodcutos = $this->db->get();
		$state = 0;

		foreach ($prodcutos->result() as $rows) {
			$state = $rows->activo;
		}
		return $state;
	}
}
