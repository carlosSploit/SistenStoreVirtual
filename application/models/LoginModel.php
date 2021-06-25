<?php
	/*
		Copyright (c) 2019 Codigos de Programacion
		Punto de Venta CDP
		Desarrollado por Codigos de Programacion
		www.codigosdeprogramacion.com
	*/
	class loginModel extends CI_model
	{
		public function __construct()
		{
			$this->load->database();
		}
		
		//Valida usuario por usuario y password
		public function login($usuario, $password)
		{
			$query = $this->db->get_where('usuarios', array('usuario' => $usuario, 'activo' => 1));
			
			if($query->num_rows() > 0)
			{
				$row=$query->row();
				
				$hash = password_hash($password, PASSWORD_DEFAULT);
				
				if(password_verify($password, $row->password))
				{
					$this->session->set_userdata('login', $row->activo);
					$this->session->set_userdata('id_usuario', $row->id);
					$this->session->set_userdata('usuario', $row->usuario);
					$this->session->set_userdata('nombre', $row->nombre);
					$this->session->set_userdata('id_rol', $row->id_rol);
					$this->session->set_userdata('id_caja', $row->id_caja);
					$this->last_session($row->id);
					
					return true;
				}
			}
			$this->session->unset_userdata('user_data');
			return false;
		}
		
		//Actualiza ultimo inicio de session
		public function last_session($id_usuario)
		{
			$this->db->set('last_session', "NOW()" , FALSE);
			$this->db->where('id', $id_usuario);
			$this->db->update('usuarios');
		}
	}							