<?php
	/*
		Copyright (c) 2019 Codigos de Programacion
		Punto de Venta CDP
		Desarrollado por Codigos de Programacion
		www.codigosdeprogramacion.com
	*/
	class logsModel extends CI_Model {
		
		private $id;
		private $folio;
		private $total;
		private $fecha;
		private $vendedor;
		private $activo;
		
		public function __construct(){
			parent::__construct();
			$this->load->database();
		}
		
		//Obtener logs
		public function obtener(){			
			$this->db->select('l.*,u.usuario AS usuario');
			$this->db->from('logs_acceso l');
			$this->db->join('usuarios u', 'l.id_usuario = u.id');
			$this->db->order_by('l.fecha', 'DESC');
			return $this->db->get()->result();
		}
		
		//Inserta acceso a logs
		public function log_acceso($id_usuario, $evento)
		{
			$ip = $_SERVER['REMOTE_ADDR'];
			$detalles = $_SERVER['HTTP_USER_AGENT'];
			$fecha = date('Y-m-d H:i:s');

			$this->db->insert("logs_acceso", [
				"id_usuario" => $id_usuario,
				"ip" => $ip,
				"evento" => $evento,
				"detalles" => $detalles,
				"fecha" => $fecha,
				]);
		}
	}
?>
