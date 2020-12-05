<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Marcas extends CI_Model
{
	//--------------------------------------------------------------
	public function get_marcas()
	{
		return $this->db->get('marcas')->result();
	}

	//--------------------------------------------------------------
	public function get_marca($id_marca)
	{
		$this->db->where('id_marca', $id_marca);
		return $this->db->get('marcas')->row();
	}

	//--------------------------------------------------------------
	public function crear($marca)
	{
		return $this->db->insert('marcas', $marca);
	}

	//--------------------------------------------------------------
	public function actualizar($id_marca, $marca)
	{
		$this->db->where('id_marca', $id_marca);
		return $this->db->update('marcas', $marca);
	}
}
