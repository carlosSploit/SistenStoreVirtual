<?php
class usuariosModel extends CI_Model
{

	private $id;
	private $usuario;
	private $password;
	private $nombre;
	private $last_session;
	private $id_caja;
	private $id_rol;
	private $activo;

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	//Obtener usuarios, recibe activo 1 o 0
	public function obtener($activo = 1)
	{
		$this->db->select('u.*,r.nombre AS rol, c.nombre AS caja');
		$this->db->from('usuarios u');
		$this->db->join('roles r', 'u.id_rol = r.id');
		$this->db->join('cajas c', 'u.id_caja = c.id');
		$this->db->where('u.activo', $activo);
		$this->db->order_by('u.usuario', 'ASC');
		$aResult = $this->db->get();
		return $aResult->result();
		//return $this->db->get_where("usuarios", array('activo' => $activo))->result();
	}

	//Obtener usuarios
	public function obtenerUsuarios()
	{
		return $this->db->get_where("usuarios", array('activo' => 1))->result();
	}


	//Consulta usuario por ID
	public function porId($id)
	{
		return $this->db->get_where("usuarios", ["id" => $id])->row();
	}

	//Consulta usuario compelto por ID
	public function porIdCompleto($id)
	{
		$this->db->select('u.*,r.nombre AS rol, c.nombre AS caja');
		$this->db->from('usuarios u');
		$this->db->join('roles r', 'u.id_rol = r.id');
		$this->db->join('cajas c', 'u.id_caja = c.id');
		$this->db->where('u.id', $id);
		$aResult = $this->db->get();
		return $aResult->row();
	}

	//Consulta usuario por codigo
	public function porUsuario($usuario)
	{
		return $this->db->get_where("usuarios", ["usuario" => $usuario, "activo" => 1]);
	}

	//Consulta usuario por codigo
	public function porCodigoRes($usuario)
	{
		return $this->db->get_where("usuarios", ["usuario" => $usuario, "activo" => 1])->row();
	}

	//Insertar usuario
	public function insertar($usuario, $password, $nombre, $id_caja, $id_rol, $activo)
	{
		return $this->db->insert("usuarios", [
			"usuario" => $usuario,
			"password" => $password,
			"nombre" => $nombre,
			"id_caja" => $id_caja,
			"id_rol" => $id_rol,
			"activo" => $activo
		]);
	}

	//Actualiza usuarios
	public function guardarCambios($id, $nombre, $id_caja, $id_rol)
	{
		$datos = [
			"nombre" => $nombre,
			"id_caja" => $id_caja,
			"id_rol" => $id_rol
		];
		return $this->db->update("usuarios", $datos, ["id" => $id]);
	}

	//Actualiza password de usuario
	public function guardarPassword($id, $password)
	{
		$datos = [
			"password" => $password
		];
		return $this->db->update("usuarios", $datos, ["id" => $id]);
	}

	//Actualiza activo de usuario a 0
	public function eliminar($id)
	{
		$datos = ["activo" => 0, "id_caja" => 0];
		return $this->db->update("usuarios", $datos, ["id" => $id]);
	}

	//Actualiza activo de usuario a 1
	public function reingresar($id)
	{
		$datos = ["activo" => 1];
		return $this->db->update("usuarios", $datos, ["id" => $id]);
	}

	function getRowsidState($id = 0)
	{
		$this->db->select("activo");
		$this->db->from("usuarios");
		$this->db->where(["id" => $id]);
		$prodcutos = $this->db->get();
		$state = 0;

		foreach ($prodcutos->result() as $rows) {
			$state = $rows->activo;
		}
		return $state;
	}
}
