<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mensajes extends CI_Model
{
	//--------------------------------------------------------------
	public function get_mensajes()
	{
		$this->db->order_by('fecha_envio', 'desc');
		return $this->db->get('mensajes')->result();
	}

	//--------------------------------------------------------------
	public function get_mensaje($id_mensaje)
	{
		$this->db->where('id_mensaje', $id_mensaje);
		return $this->db->get('mensaje')->row();
	}

	//--------------------------------------------------------------
	public function crear($mensaje)
	{
		return $this->db->insert('mensajes', $mensaje);
	}

	//--------------------------------------------------------------
	public function actualizar($id_mensaje, $mensaje)
	{
		$this->db->where('id_mensaje', $id_mensaje);
		return $this->db->update('mensajes', $mensaje);
	}
}
