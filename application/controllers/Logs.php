<?php

	class logs extends CI_Controller{
		public function __construct(){
			parent::__construct();
			$this->load->library('session');
			$this->load->model("logsModel");
		}
		
		//Cargar catalogo
		public function index(){
			if($this->session->userdata('login') != 1){ redirect('login'); }
			$datos["titulo"] = "Logs de acceso";
			$datos["datos"] = $this->logsModel->obtener();
			$this->load->view("encabezado");
			$this->load->view("logs/logs", $datos);
			$this->load->view("pie");
		}
		
		function mostrarLogs(){

			$draw = intval($this->input->post("draw"));
			$start = intval($this->input->post("start"));
			$length = intval($this->input->post("length"));
			$order = $this->input->post("order");
			$search = $this->input->post("search");
			$activo = $this->input->post("activo");
			$search = $search['value'];
			$col = 0;
			$dir = "";

			$aColumns = array('usuarios.usuario','logs_acceso.ip','logs_acceso.evento','logs_acceso.detalles','logs_acceso.fecha', 'logs_acceso.id');
			$sTable = "logs_acceso";
			$sWhere = "1=1";
			$sWhereOrg = "1=1";

			$this->db->select($aColumns);

			if(!empty($order))
			{
				foreach($order as $o)
				{
					$col = $o['column'];
					$dir= $o['dir'];
				}
			}
	
			if($dir != "asc" && $dir != "desc") 
				$dir = "desc";

			if(!isset($aColumns[$col]))
				$order = null;
			else
				$order = $aColumns[$col];

			if($order !=null)
				$this->db->order_by($order, $dir);
			
			if(!empty($search))
			{	
				$x=0;
				foreach($aColumns as $sterm)
				{
					if($x==0)
					{
						$sWhere .= " AND (". $sterm . " LIKE '%" . $search . "%' ";
					}
					else
					{
						$sWhere .= " OR " . $sterm . " LIKE '%" . $search . "%' ";
					}
					$x++;
				}
				$sWhere .= ")";         
			}

			$this->db->where($sWhere);
			$this->db->limit($length,$start);
			$this->db->from($sTable);
			$this->db->join('usuarios', 'logs_acceso.id_usuario = usuarios.id');
			$prodcutos = $this->db->get();
  
			$data = array();

			foreach($prodcutos->result() as $rows)
			{
				$data[]= array($rows->usuario, $rows->ip, $rows->evento, $rows->detalles,  $rows->fecha);
			}

			$total_registros = $this->totalRegistro($sTable, $sWhereOrg);
			$total_registros_filtrado = $this->totalRegistroFiltrados($sTable, $sWhere);
			$output = array(
				"draw" => $draw,
				"recordsTotal" => $total_registros,
				"recordsFiltered" => $total_registros_filtrado,
				"data" => $data
			);
			echo json_encode($output);
			exit();
		}

		public function totalRegistro($sTable, $sWhereOrg)
		{
			$this->db->select('COUNT(*) as num');    
			$this->db->from($sTable);
			$this->db->join('usuarios', 'logs_acceso.id_usuario = usuarios.id');
			$this->db->where($sWhereOrg);
			$query = $this->db->get()->row();

			if(isset($query)) return $query->num;
			return 0;
		}

		public function totalRegistroFiltrados($sTable, $where)
		{
			$this->db->select('COUNT(*) as num');    
			$this->db->from($sTable);
			$this->db->join('usuarios', 'logs_acceso.id_usuario = usuarios.id');
			$this->db->where($where);
			$query = $this->db->get()->row();

			if(isset($query)) return $query->num;
			return 0;
		}
		
	}
