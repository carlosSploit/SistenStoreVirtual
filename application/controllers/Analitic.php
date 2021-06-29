<?php
class Analitic extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("AnaliticModel");
        $this->load->library('session');
    }

    //Carga Analitic
    public function index($id1 = 1, $mess = "Los graficos se realizaron con exito", $estade = "success")
    {
        if ($this->session->userdata('login') != 1) {
            redirect('login');
        }
        $this->load->view("encabezado");
        $this->load->view("Analitic/Analitic");
        $data['id'] = $id1;
        $data['mesg'] = $mess;
        $data['estade'] = $estade;
        $this->load->view("pie", $data);
    }
    //metodo de api de analitic
    public function Analitic($anction)
    {
        $respuesta = $this->AnaliticModel->listar($anction);

        $MaxLabel = "";
        $MaxData = 0;
        $AbrerLabel = array();
        $labels = array();
        $data = array();
        $datag = array();

        if ($anction == 0) {
            $respuesta2 = array_reverse($respuesta);
            foreach ($respuesta2 as $row) {
                $labels[] =  $row['Dias'];
                $data[] = $row['total'];
                if ($MaxData < $row['total']) {
                    $MaxData = $row['total'];
                    $MaxLabel = $row['Dias'];
                }
            }
        } elseif ($anction > 0) {
            foreach ($respuesta as $row) {
                $abrebiatura = "";
                $porciones = explode(" ", $row['nombre']);
                foreach ($porciones as $tex) {
                    $abrebiatura .= $tex[0];
                }
                $AbrerLabel[] = $abrebiatura;
                $labels[] =  mb_strtolower($row['nombre']);
                $data[] = $row['total'];
                $datag[] = array(
                    "nombre" => mb_strtolower($row['nombre']),
                    "total" => $row['total']
                );
            }
        }

        $output = array(
            "MA" => $MaxLabel,
            "DA" => $datag,
            "LA" => $AbrerLabel,
            "L" => $labels,
            "D" => $data
        );

        echo (json_encode($output));
    }
}
