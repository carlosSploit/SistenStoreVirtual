<?php
class pedidoModel extends CI_Model
{

    private $id;
    private $id_venta;
    private $id_producto;
    private $codigo;
    private $nombre;
    private $cantidad;
    private $precio;
    private $subtotal;


    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    //Inserta producto en tabla temporal
    public function insertar($folio, $direccion, $telefono, $date, $estado)
    {
        return $this->db->insert("pedido", [
            "folio" => $folio,
            "direccion" => $direccion,
            "telefono" => $telefono,
            "datep" => $date,
            "estado" => $estado,
        ]);
    }

    public function Actualizar($id, $direccion, $telefono, $date)
    {
        $datos = [
            "direccion" => $direccion,
            "telefono" => $telefono,
            "datep" => $date
        ];
        return $this->db->update("pedido", $datos, ["id_pedido" => $id]);
    }

    //Cambia activo de venta a 0
    public function Actualizar_Estado($id, $val)
    {
        $datos = ["estado" => $val];
        return $this->db->update("pedido", $datos, ["id_pedido" => $id]);
    }

    public function EliminarPedido($id, $val)
    {
        $datos = ["estado" => $val + 3];
        return $this->db->update("pedido", $datos, ["id_pedido" => $id]);
    }

    function getRowsidState($id = 0)
    {
        $this->db->select("estado");
        $this->db->from("pedido");
        $this->db->where(["id_pedido" => $id]);
        $prodcutos = $this->db->get();
        $state = 0;

        foreach ($prodcutos->result() as $rows) {
            $state = (($rows->estado) > 2) ? 0 : 1;
        }

        return $state;
    }
}
