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
	public function get_mensajes_ult_tres()
	{
		$this->db->limit(3);
		$this->db->order_by('fecha_envio', 'desc');
		return $this->db->get('mensajes')->result();
	}

	//--------------------------------------------------------------
	public function get_mensajes_no_leidos()
	{
		$this->db->where('estado_mensaje', 0);
		$this->db->from('mensajes');
		return $this->db->count_all_results();
	}

	//--------------------------------------------------------------
	public function get_mensaje($id_mensaje)
	{
		$this->db->where('id_mensaje', $id_mensaje);
		return $this->db->get('mensajes')->row();
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
