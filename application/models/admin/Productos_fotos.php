<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Productos_fotos extends CI_Model
{
	//--------------------------------------------------------------
	public function get_producto_fotos($id_producto)
	{
		$this->db->where('id_prod', $id_producto);
		return $this->db->get('productos_fotos')->result();
	}

	//--------------------------------------------------------------
	public function crear($fotos)
	{
		return $this->db->insert_batch('productos_fotos', $fotos);
	}
}
