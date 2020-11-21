<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Subcategorias extends CI_Model
{

	//--------------------------------------------------------------
	public function get_subcategorias()
	{
		$this->db->join('categorias', 'subcategorias.id_cat = categorias.id_categoria');
		return $this->db->get('subcategorias')->result();
	}

	//--------------------------------------------------------------
	public function get_subcategoria($id_subcategoria)
	{
		$this->db->where('id_subcategoria', $id_subcategoria);
		return $this->db->get('subcategorias')->row();
	}

	//--------------------------------------------------------------
	public function get_subcategorias_x_categoria($id_categoria)
	{
		$this->db->where('id_cat', $id_categoria);
		return $this->db->get('subcategorias')->result();
	}

	//--------------------------------------------------------------
	public function crear($subcategoria)
	{
		return $this->db->insert('subcategorias', $subcategoria);
	}

	//--------------------------------------------------------------
	public function actualizar($id_subcategoria, $subcategoria)
	{
		$this->db->where('id_subcategoria', $id_subcategoria);
		return $this->db->update('subcategorias', $subcategoria);
	}
}
