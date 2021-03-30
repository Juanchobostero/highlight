<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ventas extends CI_Model
{
	//--------------------------------------------------------------
	public function get_ventas($estado)
	{
		$this->db->select('ventas.*, usuarios.nombreU, usuarios.apellidoU');
		$this->db->join('usuarios', 'usuarios.id_usuario = ventas.id_us');
		$this->db->where('ventas.estadoVENT', $estado);
		return $this->db->get('ventas')->result();
	}

	//--------------------------------------------------------------
	public function get_venta($id_venta)
	{
		$this->db->select('ventas.*, usuarios.nombreU, usuarios.apellidoU');
		$this->db->join('usuarios', 'usuarios.id_usuario = ventas.id_us');
		$this->db->where('ventas.id_venta', $id_venta);
		return $this->db->get('ventas')->row();
	}

	//--------------------------------------------------------------
	public function actualizar($id_venta, $venta)
	{
		$this->db->where('id_venta', $id_venta);
		return $this->db->update('ventas', $venta);
	}
}
