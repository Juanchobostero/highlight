<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Usuarios_model extends CI_Model
{
	//--------------------------------------------------------------
	public function get_users($id_tu, $estado = 1) {
		if ($id_tu == 1) {
			$this->db->where('id_usuario <> ' . $_SESSION['id']);
		}
		$this->db->where('id_tu', $id_tu);
		$this->db->where('estadoU', $estado);
		return $this->db->get('usuarios')->result();
	}

	public function add($data){
		return $this->db->insert('usuarios',$data);
	}

	public function set_profile($id, $data) {
		$this->db->where('id_usuario', $id);
    	return $this->db->update('usuarios',$data);
	}

	//--------------------------------------------------------------
	public function get_user_correo($correo)
	{
		$this->db->where('emailU', $correo);
		return $this->db->get('usuarios')->row();
	}

	//--------------------------------------------------------------
	public function get_user($id)
	{
		$this->db->where('id_usuario', $id);
		return $this->db->get('usuarios')->row();
	}

	//--------------------------------------------------------------
	public function actualizar($id, $user) {
		$this->db->where('id_usuario', $id);
		return $this->db->update('usuarios', $user);
	}

	//--------------------------------------------------------------
	public function total_clientes() {
		$this->db->where('id_tu', 2);
		return $this->db->get('usuarios')->num_rows();
	}

	//--------------------------------------------------------------
	public function get_localidad($id) {
		$this->db->where('id_localidad', $id);
		return $this->db->get('localidades')->row();
	}

	//--------------------------------------------------------------
	public function get_provincia($id) {
		$this->db->where('id_provincia', $id);
		return $this->db->get('provincias')->row();
	}

	//--------------------------------------------------------------
	public function get_prov_localidades($id_prov) {
		$this->db->where('id_prov', $id_prov);
		return $this->db->get('localidades')->result();
	}

	//--------------------------------------------------------------
	public function get_provincias() {
		return $this->db->get('provincias')->result();
	}

	// -------------------------------------------------------------------
	public function nuevaContrasena($contrasena, $id_user) {
		$id = $id_user;
		$data = array(
		  'contrasena' => password_hash($contrasena, PASSWORD_DEFAULT),
		);
		$this->db->where(['id_usuario' => $id]);
		return $this->db->update('usuarios', $data);
	  }

	// -------------------------------------------------------------------
	public function search($data) {
		$this->db->where('id_usuario', $data);
		return $this->db->get('usuarios')->result();
	  }
}
