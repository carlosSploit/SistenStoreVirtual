<?php
class pedido extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model("pedidoModel");
        $this->load->model("ventasModel");
        $this->load->model("clientesModel");
    }

    //Carga caja
    public function index($id1 = 0, $mess = "mensegprueba", $estade = "")
    {
        if ($this->session->userdata('login') != 1) {
            redirect('login');
        }
        $this->load->view("encabezado");
        $this->load->view("pedido/pedido", ["titulo" => "Pedidos"]);
        $data['id'] = $id1;
        $data['mesg'] = $mess;
        $data['estade'] = $estade;
        $this->load->view("pie", $data);
    }

    //Cargar catalogo eliminados
    public function eliminadas($id1 = 0, $mess = "mensegprueba", $estade = "")
    {
        if ($this->session->userdata('login') != 1) {
            redirect('login');
        }
        $datos["titulo"] = "Pedidos Eliminados";
        $this->load->view("encabezado");
        $this->load->view("pedido/pedidos_eliminados", $datos);
        $data['id'] = $id1;
        $data['mesg'] = $mess;
        $data['estade'] = $estade;
        $this->load->view("pie", $data);
    }

    //Cargar vista editar
    public function editar($id, $id1 = 0, $mess = "mensegprueba", $estade = "")
    {
        if ($this->session->userdata('login') != 1) {
            redirect('login');
        }

        $aColumns = array('ventas.id', 'pedido.id_pedido', 'pedido.folio', 'clientes.nombre', 'pedido.direccion', 'pedido.telefono', 'pedido.datep', 'pedido.estado');
        $sTable = "pedido";

        $this->db->select($aColumns);
        $this->db->from($sTable);
        $this->db->join('ventas', 'ventas.folio = pedido.folio');
        $this->db->join('clientes', 'ventas.id_cliente = clientes.id');
        $prodcutos = $this->db->get();

        $data['title'] = 'Modificar pedido';
        $dataA = array();
        foreach ($prodcutos->result() as $rows) {
            if (($rows->id_pedido) == $id) {
                $dataA['id_pedido'] =  $rows->id_pedido;
                $dataA['folio'] =  $rows->folio;
                $dataA['nombre'] = $rows->nombre;
                $dataA['direccion'] = $rows->direccion;
                $dataA['telefono'] = $rows->telefono;
                $dataA['date'] = ($rows->datep !== NULL) ? $rows->datep : (getdate()['year'] . '-' . ((strlen(getdate()['mon']) == 1) ? '0' . getdate()['mon'] : getdate()['mon']) . '-' . getdate()['mday']);
            }
        }
        $data['dato'] = $dataA;
        $this->load->view("encabezado");
        $this->load->view("pedido/pedido_editar", $data);
        $data['id'] = $id1;
        $data['mesg'] = $mess;
        $data['estade'] = $estade;
        $this->load->view("pie", $data);
    }

    public function Actualizar()
    {
        if (isset($_POST["id"])) {
            $id = $this->input->post("id");
            $direccion = $this->input->post("direccion");
            $telefono = $this->input->post("telefono");
            $datep = $this->input->post("datep");

            if (($direccion != "") && ($telefono != "") && ($datep != "")) {
                $resultado = $this->pedidoModel->Actualizar($id, $direccion, $telefono, $datep);
                $this->index(1, "El pedido se a acutalizado con exito", "success");
            } else {
                $this->editar($id, 1, "Error al editar el pedido", "error");
            }
        } else {
            redirect("/pedido");
        }
    }

    public function ActualizarEstado($id, $val, $idv)
    {
        if ($val != 2) {
            $resultado = $this->ventasModel->eliminar($idv);
        } else {
            $resultado = $this->ventasModel->reactivar($idv);
        }
        $resultado = $this->pedidoModel->Actualizar_Estado($id, $val);
        redirect("pedido/");
    }

    public function EliminarPedido($id, $val, $idv)
    {
        $resultado = $this->ventasModel->eliminar($idv);
        $resultado2 = $this->pedidoModel->EliminarPedido($id, $val);
        $this->index(1, "La insercion se a dado con exito", "success");
    }

    function mostrarPedido()
    {
        // $fWhere = '';
        $draw = intval($this->input->post("draw"));
        //$start = intval($this->input->post("start"));
        //$length = intval($this->input->post("length"));
        // $order = $this->input->post("order");
        $activo = $this->input->post("activo");

        // $col = 0;
        // $dir = "";

        //$aColumns = array('ventas.id', 'pedido.id_pedido', 'pedido.folio', 'clientes.nombre', 'pedido.direccion', 'pedido.telefono', 'pedido.estado');
        $aColumns = array('ventas.id', 'pedido.id_pedido', 'pedido.folio', 'clientes.nombre', 'pedido.direccion', 'pedido.telefono', 'pedido.datep', 'pedido.estado');
        $sTable = "pedido";
        $sWhere = "1";
        //$sWhereOrg = "pedido.estado < 2";

        $this->db->select($aColumns);

        // if (!empty($order)) {
        //     foreach ($order as $o) {
        //         $col = $o['column'];
        //         $dir = $o['dir'];
        //     }
        // }

        // if ($dir != "asc" && $dir != "desc")
        //     $dir = "desc";

        // if (!isset($aColumns[$col]))
        //     $order = null;
        // else
        //     $order = $aColumns[$col];

        // if ($order != null)
        //     $this->db->order_by($order, $dir);

        if (!empty($search)) {
            $x = 0;
            foreach ($aColumns as $sterm) {
                if ($x == 0) {
                    $sWhere .= " AND (" . $sterm . " LIKE '%" . $search . "%' ";
                } else {
                    $sWhere .= " OR " . $sterm . " LIKE '%" . $search . "%' ";
                }
                $x++;
            }
            $sWhere .= ")";
        }

        //$this->db->where($sWhere);
        //$this->db->limit($length, $start);
        $this->db->from($sTable);
        $this->db->join('ventas', 'ventas.folio = pedido.folio');
        $this->db->join('clientes', 'ventas.id_cliente = clientes.id');
        $prodcutos = $this->db->get();

        $data = array();

        if ($activo == 1) {
            foreach ($prodcutos->result() as $rows) {
                if (($rows->estado) < 3) {
                    $data[] = array(
                        $rows->folio, $rows->nombre, $rows->direccion, $rows->telefono, (($rows->datep !== NULL) ? $rows->datep : 'Fecha Des.'),
                        "<div class='row m-0 justify-content-center col-auto'>" . "<div class='form-check form-check-inline'>" . "<input class='form-check-input' type='radio' name='opcionbuton" . $rows->id_pedido . "' onclick='ActualEstado(" . $rows->id_pedido . ",0," . $rows->id . ")' id='opcionbuton" . $rows->id_pedido . "' value='option1' " . ((($rows->estado) == 0) ? "checked" : "") . ">" . "<input class='form-check-input' type='radio' name='opcionbuton" . $rows->id_pedido . "' onclick='ActualEstado(" . $rows->id_pedido . ",1," . $rows->id . ")' id='opcionbuton" . $rows->id_pedido . "' value='option2' " . ((($rows->estado) == 1) ? "checked" : "") . ">" . "<input class='form-check-input' type='radio' name='opcionbuton" . $rows->id_pedido . "' onclick='ActualEstado(" . $rows->id_pedido . ",2," . $rows->id . ")' id='opcionbuton" . $rows->id_pedido . "' value='option3' " . ((($rows->estado) == 2) ? "checked" : "") . ">" . "</div>" . "</div>",
                        "<a href='" . base_url() . "index.php/pedido/editar/" . $rows->id_pedido . "' class='button' data-toggle='tooltip'  data-placement='top' title='Editar pedido' ><span class='fas fa-edit'></span></a>",
                        "<a href='" . base_url() . "index.php/caja/muestraTicket/" . $rows->id . "' class='button' data-toggle='tooltip'  data-placement='top' title='Ver ticket' ><span class='fas fa-list-alt'></span></a>",
                        "<a href='#' data-href='" . base_url() . "index.php/pedido/EliminarPedido/" . $rows->id_pedido . "/" . $rows->estado . "/" . $rows->id . "' data-toggle='modal' data-target='#confirm-delete' data-placement='top' title='Cancelar Pedido'><span class='fas fa-ban'></span></a>"
                    );
                }
            }
        } else {
            foreach ($prodcutos->result() as $rows) {
                if (($rows->estado) > 2) {
                    $data[] = array(
                        $rows->folio, $rows->nombre, $rows->direccion, $rows->telefono,
                        "<a href='" . base_url() . "index.php/caja/muestraTicket/" . $rows->id . "' class='button' data-toggle='tooltip'  data-placement='top' title='Ver ticket' ><span class='fas fa-list-alt'></span></a>",
                    );
                }
            }
        }

        //echo json_encode($data);

        $total_registros = $this->totalRegistro($sTable, '1');
        $total_registros_filtrado = $this->totalRegistroFiltrados($sTable, '1');
        $output = array(
            "draw" => $draw,
            "recordsTotal" => $total_registros,
            "recordsFiltered" => $total_registros_filtrado,
            "data" => $data
        );
        echo json_encode($output);
        exit();
    }

    public function totalRegistro($sTable)
    {
        $this->db->select('COUNT(*) as num');
        $this->db->from($sTable);
        //$this->db->where($sWhereOrg);
        $query = $this->db->get()->row();

        if (isset($query)) return $query->num;
        return 0;
    }

    public function totalRegistroFiltrados($sTable, $where)
    {
        $this->db->select('COUNT(*) as num');
        $this->db->from($sTable);
        //$this->db->where($where);
        $query = $this->db->get()->row();

        if (isset($query)) return $query->num;
        return 0;
    }
}
