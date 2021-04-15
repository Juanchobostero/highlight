<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Usuarios extends CI_Model
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
		$this->db->from('usuarios');
		return $this->db->count_all_results();
	}
}
