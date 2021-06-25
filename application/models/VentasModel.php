<?php
/*
		Copyright (c) 2020 Codigos de Programacion
		Punto de Venta CDP
		Desarrollado por Codigos de Programacion
		www.codigosdeprogramacion.com
	*/
class ventasModel extends CI_Model
{

	private $id;
	private $folio;
	private $total;
	private $fecha;
	private $vendedor;
	private $activo;

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	//Obtener ventas, recibe activo 1 o 0
	public function obtener($activo = 1)
	{
		$this->db->select('v.*, u.usuario AS cajero, c.nombre AS cliente');
		$this->db->from('ventas v');
		$this->db->join('usuarios u', 'v.id_usuario = u.id');
		$this->db->join('clientes c', 'v.id_cliente = c.id');
		$this->db->where('v.activo', $activo);
		$this->db->order_by('v.fecha', 'DESC');
		return $this->db->get()->result();
	}

	//Inserta venta
	public function insertar($folio, $total, $fecha, $id_usuario, $id_caja, $id_cliente, $forma_pago, $activo)
	{
		$this->db->insert("ventas", [
			"folio" => $folio,
			"total" => $total,
			"fecha" => $fecha,
			"id_usuario" => $id_usuario,
			"id_caja" => $id_caja,
			"id_cliente" => $id_cliente,
			"forma_pago" => $forma_pago,
			"activo" => $activo,
		]);
		return $this->db->insert_id();
	}

	public function porId($id)
	{
		return $this->db->get_where("ventas", ["id" => $id])->row();
	}

	//Obtener venta por inner join, recibe id_venta
	public function obtenerVenta($id_venta)
	{
		$this->db->select('v.*,c.nombre AS cliente');
		$this->db->from('ventas v');
		$this->db->join('clientes c', 'v.id_cliente = c.id');
		$this->db->where('v.id_venta', $id_venta);
		$this->db->order_by('v.fecha', 'DESC');
		return $this->db->get()->result();
	}

	//Cambia activo de venta a 0
	public function eliminar($id)
	{
		$datos = ["activo" => 0];
		return $this->db->update("ventas", $datos, ["id" => $id]);
	}

	//Cambia activo de venta a 1
	public function reactivar($id)
	{
		$datos = ["activo" => 1];
		return $this->db->update("ventas", $datos, ["id" => $id]);
	}

	//Consulta ultimo folio
	public function ultimoFolio()
	{
		return $this->db->get_where("folio", ["id" => 1])->row()->folio;
	}

	//Actualiza siguiente folio
	public function siguienteFolio()
	{
		$this->db->set('folio', "LPAD(folio+1,10,'0')", FALSE);
		$this->db->where('id', '1');
		$this->db->update('folio');
	}
}
