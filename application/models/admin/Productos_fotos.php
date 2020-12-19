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
	public function get_foto($id_foto)
	{
		$this->db->where('id_foto', $id_foto);
		return $this->db->get('productos_fotos')->row();
	}

	//--------------------------------------------------------------
	public function crear($id_producto, $imgs)
	{
		for ($i = 0; $i < count($imgs); $i++) {
			$fotos[$i]['id_prod'] = $id_producto;
			$fotos[$i]['foto'] = $imgs[$i];
		}
		return $this->db->insert_batch('productos_fotos', $fotos);
	}

	//--------------------------------------------------------------
	public function eliminar($id_foto)
	{
		$this->db->where('id_foto', $id_foto);
		return $this->db->delete('productos_fotos');
	}
}
