<?php
/*
		Copyright (c) 2020 Codigos de Programacion
		Punto de Venta CDP
		Desarrollado por Codigos de Programacion
		www.codigosdeprogramacion.com
	*/
class AnaliticModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function listar($data)
    {
        $sql = "CALL analitic_proc(?)";
        $result = $this->db->query($sql, $data);
        return $result->result_array();
    }
}
