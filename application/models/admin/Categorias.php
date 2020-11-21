<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Categorias extends CI_Model
{
	//--------------------------------------------------------------
	public function get_categorias()
	{
		return $this->db->get('categorias')->result();
	}

	//--------------------------------------------------------------
	public function get_categoria($id_categoria)
	{
		$this->db->where('id_categoria', $id_categoria);
		return $this->db->get('categorias')->row();
	}

	//--------------------------------------------------------------
	public function crear($categoria)
	{
		return $this->db->insert('categorias', $categoria);
	}

	//--------------------------------------------------------------
	public function actualizar($id_categoria, $categoria)
	{
		$this->db->where('id_categoria', $id_categoria);
		return $this->db->update('categorias', $categoria);
	}
}
