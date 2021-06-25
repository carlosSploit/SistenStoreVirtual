<?php
/*
		Copyright (c) 2019 Codigos de Programacion
		Punto de Venta CDP
		Desarrollado por Codigos de Programacion
		www.codigosdeprogramacion.com
	*/
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
    public function insertar($folio, $direccion, $telefono, $estado)
    {
        return $this->db->insert("pedido", [
            "folio" => $folio,
            "direccion" => $direccion,
            "telefono" => $telefono,
            "estado" => $estado,
        ]);
    }

    public function Actualizar($id, $direccion, $telefono)
    {
        $datos = [
            "direccion" => $direccion,
            "telefono" => $telefono
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

    //Elimina producto de tabla temporal por id_producto e id_venta
    // public function eliminar($id_producto, $id_venta)
    // {
    //     return $this->db->delete("caja", ["id_producto" => $id_producto, "id_venta" => $id_venta]);
    // }

    //Elimina productos de tabla temporal por id_venta
    // public function eliminarVenta($id_venta)
    // {
    //     return $this->db->delete("caja", ["id_venta" => $id_venta]);
    // }

    //Consulta ventas por id_venta
    // public function porVenta($id_venta)
    // {
    //     return $this->db->get_where("caja", ["id_venta" => $id_venta])->result();
    // }

    //Busca producto en tabla temporal por codigo e id_venta
    // public function porCodigoVenta($codigo, $id_transaccion)
    // {
    //     return $this->db->get_where("movimientos", ["codigo" => $codigo, "id_transaccion" => $id_transaccion, "tipo" => 'V'])->row();
    // }

    //Busca producto en tabla temporal por id_producto e id_venta
    // public function porIdProductoVenta($id_producto, $id_venta)
    // {
    //     return $this->db->get_where("caja", ["id_producto" => $id_producto, "id_venta" => $id_venta])->row();
    // }

    //Actualiza cantidad y subtotal de producto si existe en tabla temporal por codigo e id_venta
    // public function actualizaProductoVenta($codigo, $id_transaccion, $cantidad, $subtotal)
    // {
    //     $datos = [
    //         "cantidad" => $cantidad,
    //         "subtotal" => $subtotal,
    //     ];
    //     return $this->db->update("movimientos", $datos, ["codigo" => $codigo, "id_transaccion" => $id_transaccion, "tipo" => "C"]);
    // }
}
