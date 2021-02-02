<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Institucional extends CI_Model
{
	//--------------------------------------------------------------
	public function get_institucional($id_institucional)
	{
		$this->db->where('id_institucional', $id_institucional);
		return $this->db->get('institucional')->row();
	}

	//--------------------------------------------------------------
	public function actualizar($id_institucional, $institucional)
	{
		$this->db->where('id_institucional', $id_institucional);
		return $this->db->update('institucional', $institucional);
	}
}
