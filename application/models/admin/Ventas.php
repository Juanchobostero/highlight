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
		$this->db->order_by('ventas.id_venta', 'DESC');
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
	public function nuevas_ventas()
	{
		$this->db->where('estadoVENT =', 1);
		$this->db->from('ventas');
		return $this->db->count_all_results();
	}

	//--------------------------------------------------------------
	public function total_ventas()
	{
		$this->db->where('estadoVENT <>', 4);
		$this->db->from('ventas');
		return $this->db->count_all_results();
	}

	//--------------------------------------------------------------
	public function ult_ventas()
	{
		$this->db->select('ventas.*, usuarios.nombreU, usuarios.apellidoU');
		$this->db->join('usuarios', 'usuarios.id_usuario = ventas.id_us');
		$this->db->where('ventas.estadoVENT', 'Nuevo');
		$this->db->order_by('ventas.id_venta', 'desc');
		$this->db->limit('8');
		return $this->db->get('ventas')->result();
	}

	//--------------------------------------------------------------
	public function grafico_ventas()
	{
		$fecha_actual = date('d-m-Y');
		$periodo_atras = date('Y-m', strtotime($fecha_actual . ' - 6 month'));
		$periodo_actual = date('Y-m');

		$this->db->select("DATE_FORMAT(fechaEnvio, '%Y-%m') as Periodo, SUM(totalVENT) as Total");
		$this->db->where('estadoVENT <>', 'Cancelado');
		$this->db->where("DATE_FORMAT(fechaEnvio, '%Y-%m') BETWEEN '$periodo_atras' AND '$periodo_actual'");
		$this->db->from('ventas');
		$this->db->group_by("DATE_FORMAT(fechaEnvio, '%Y-%m')");
		return $this->db->get()->result();
	}
}
