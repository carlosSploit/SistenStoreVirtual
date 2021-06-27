<?php
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
