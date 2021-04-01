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

	//--------------------------------------------------------------
	public function total_ventas()
	{
		$this->db->where('estadoVENT <>', 4);
		$this->db->from('ventas');
		return $this->db->count_all_results();
	}

	//--------------------------------------------------------------
	public function ult_ventas() {
		$this->db->select('ventas.*, usuarios.nombreU, usuarios.apellidoU');
		$this->db->join('usuarios', 'usuarios.id_usuario = ventas.id_us');
		$this->db->where('ventas.estadoVENT', 'Nuevo');
		$this->db->order_by('ventas.id_venta', 'desc');
    $this->db->limit('8');
		return $this->db->get('ventas')->result();
	}
}
