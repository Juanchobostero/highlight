<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ventas_detalle extends CI_Model
{
	//--------------------------------------------------------------
	public function get_detalle_venta($id_venta)
	{
		$this->db->select('ventasdetalle.*, productos.codigoPR, productos.nombrePR');
		$this->db->join('ventas', 'ventas.id_venta = ventasdetalle.id_vent');
		$this->db->join('productos', 'productos.id_producto = ventasdetalle.id_product');
		$this->db->where('ventasdetalle.id_vent', $id_venta);
		return $this->db->get('ventasdetalle')->result();
	}
}
