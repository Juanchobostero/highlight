<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Productos_ofertas extends CI_Model
{
	//--------------------------------------------------------------
	public function get_ofertas_individuales()
	{
		$this->db->join('productos', 'productos.id_producto = productos_ofertas.id_produc');
		$this->db->where('productos_ofertas.estado_oferta', 1);
		return $this->db->get('productos_ofertas')->result();
	}

	//--------------------------------------------------------------
	public function get_ofertas_por_subcategorias()
	{
		$this->verificarOfertas();

		$this->db->select('*, (SELECT COUNT(*) FROM Productos pr WHERE pr.id_subcat = po.id_subcat AND pr.estadoPR = 1) as total_productos');
		$this->db->join('subcategorias', 'subcategorias.id_subcategoria = po.id_subcat');
		$this->db->join('categorias', 'categorias.id_categoria = subcategorias.id_cat');
		$this->db->from('productos_ofertas po');
		$this->db->where('po.estado_oferta', 1);
		return $this->db->get()->result();
	}

	//--------------------------------------------------------------
	public function get_oferta_producto($id_producto)
	{
		$this->db->where('id_produc', $id_producto);
		$this->db->where('estado_oferta', 1);
		return $this->db->get('productos_ofertas')->row();
	}

	//--------------------------------------------------------------
	public function get_oferta_subcategoria($id_subcategoria)
	{
		$this->db->where('id_subcat', $id_subcategoria);
		$this->db->where('estado_oferta', 1);
		return $this->db->get('productos_ofertas')->row();
	}

	//--------------------------------------------------------------
	public function get_oferta_individual($id_oferta)
	{
		$this->db->join('productos', 'productos.id_producto = po.id_produc');
		$this->db->where('po.id_oferta', $id_oferta);
		return $this->db->get('productos_ofertas po')->row();
	}

	//--------------------------------------------------------------
	public function get_oferta_por_subcategoria($id_oferta)
	{
		$this->db->select('po.*, subcategorias.descripcionSC, categorias.descripcionCAT');
		$this->db->join('subcategorias', 'subcategorias.id_subcategoria = po.id_subcat');
		$this->db->join('categorias', 'categorias.id_categoria = subcategorias.id_cat');
		$this->db->where('po.id_oferta', $id_oferta);
		return $this->db->get('productos_ofertas po')->row();
	}

	//--------------------------------------------------------------
	public function get_ofertas_individuales_por_subcategoria($id_subcategoria)
	{
		$this->db->select('po.*, productos.*');
		$this->db->join('productos', 'productos.id_producto = po.id_produc');
		$this->db->from('productos_ofertas po');
		$this->db->where('productos.id_subcat', $id_subcategoria);
		$this->db->where('productos.estadoPR', 1);
		$this->db->where('po.estado_oferta', 1);
		return $this->db->get()->result();
	}

	//--------------------------------------------------------------
	public function num_ofertas_individuales_por_subcategoria($id_subcategoria)
	{
		$this->db->join('productos', 'productos.id_producto = po.id_produc');
		$this->db->from('productos_ofertas po');
		$this->db->where('productos.id_subcat', $id_subcategoria);
		$this->db->where('productos.estadoPR', 1);
		$this->db->where('po.estado_oferta', 1);
		return $this->db->count_all_results();
	}

	//--------------------------------------------------------------
	public function crear($oferta)
	{
		return $this->db->insert('productos_ofertas', $oferta);
	}

	//--------------------------------------------------------------
	public function actualizar($id_oferta, $oferta)
	{
		$this->db->where('id_oferta', $id_oferta);
		return $this->db->update('productos_ofertas', $oferta);
	}

	//--------------------------------------------------------------
	public function verificarOfertas()
	{
		$this->db->where('"' . date("Y-m-d") . '" > fecha_fin AND estado_oferta = 1');
		$this->db->update('productos_ofertas', ['fecha_cancelado' => date('Y-m-d H:m:s'), 'estado_oferta' => 0]);
	}
}
