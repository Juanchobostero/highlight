<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Productos extends CI_Model
{
	//--------------------------------------------------------------
	public function get_productos()
	{
		$this->db->select('productos.*, marcas.descripcionM, subcategorias.descripcionSC, categorias.descripcionCAT');
		$this->db->join('marcas', 'marcas.id_marca = productos.id_mar');
		$this->db->join('subcategorias', 'subcategorias.id_subcategoria = productos.id_subcat');
		$this->db->join('categorias', 'categorias.id_categoria = subcategorias.id_cat');
		return $this->db->get('productos')->result();
	}

	//--------------------------------------------------------------
	public function crear($producto)
	{
		return $this->db->insert('productos', $producto);
	}
}
