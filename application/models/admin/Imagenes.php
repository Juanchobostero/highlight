<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Imagenes extends CI_Model
{
	//--------------------------------------------------------------
	public function get_imagenes()
	{
		return $this->db->get('imagenes')->row();
	}

	//--------------------------------------------------------------
	public function get_imagen($id_img)
	{
		$this->db->where('id_img', $id_img);
		return $this->db->get('imagenes')->row();
	}

	//--------------------------------------------------------------
	public function actualizar($id_img, $imagenes)
	{
		$this->db->where('id_img', $id_img);
		return $this->db->update('imagenes', $imagenes);
	}
}
