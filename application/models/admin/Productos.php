<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Productos extends CI_Model
{
	//--------------------------------------------------------------
	public function get_productos()
	{
		// $this->db->select('productos.*, marcas.descripcionM, subcategorias.descripcionSC, categorias.descripcionCAT');
		$this->db->select('productos.*, marcas.descripcionM');
		$this->db->join('marcas', 'marcas.id_marca = productos.id_mar');
		// $this->db->join('subcategorias', 'subcategorias.id_subcategoria = productos.id_subcat');
		// $this->db->join('categorias', 'categorias.id_categoria = subcategorias.id_cat');
		$this->db->where('estadoPR', 1);
		return $this->db->get('productos')->result();
	}

	//--------------------------------------------------------------
	public function get_productos_destacados()
	{
		$this->db->select('productos.*, marcas.descripcionM, subcategorias.descripcionSC, categorias.descripcionCAT');
		$this->db->join('marcas', 'marcas.id_marca = productos.id_mar');
		$this->db->join('subcategorias', 'subcategorias.id_subcategoria = productos.id_subcat');
		$this->db->join('categorias', 'categorias.id_categoria = subcategorias.id_cat');
		$this->db->where('estadoPR', 1);
		$this->db->where('destacadoPR', 'SI');
		return $this->db->get('productos')->result();
	}

	//--------------------------------------------------------------
	public function get_productos_pausados()
	{
		$this->db->select('productos.*, marcas.descripcionM, subcategorias.descripcionSC, categorias.descripcionCAT');
		$this->db->join('marcas', 'marcas.id_marca = productos.id_mar');
		$this->db->join('subcategorias', 'subcategorias.id_subcategoria = productos.id_subcat');
		$this->db->join('categorias', 'categorias.id_categoria = subcategorias.id_cat');
		$this->db->where('estadoPR', 1);
		$this->db->where('pausadoPR', 'SI');
		return $this->db->get('productos')->result();
	}

	//--------------------------------------------------------------
	public function get_producto($id_producto)
	{
		$this->db->join('marcas', 'marcas.id_marca = productos.id_mar');
		$this->db->join('subcategorias', 'subcategorias.id_subcategoria = productos.id_subcat');
		$this->db->join('categorias', 'categorias.id_categoria = subcategorias.id_cat');
		$this->db->where('id_producto', $id_producto);
		return $this->db->get('productos')->row();
	}

	//--------------------------------------------------------------
	public function crear($producto)
	{
		$this->db->insert('productos', $producto);
		return $this->db->insert_id();
	}

	//--------------------------------------------------------------
	public function actualizar($id_producto, $producto)
	{
		$this->db->where('id_producto', $id_producto);
		return $this->db->update('productos', $producto);
	}

	//--------------------------------------------------------------
	public function devolverStock($id_producto, $cant)
	{
		$this->db->set('stockPR', "stockPR + $cant", FALSE);
		$this->db->where('id_producto', $id_producto);
		return $this->db->update('productos');
	}

	//--------------------------------------------------------------
	public function total_productos_por_subcategoria($id_subcategoria)
	{
		$this->db->where('id_subcat', $id_subcategoria);
		$this->db->from('productos');
		return $this->db->count_all_results();
	}

	//--------------------------------------------------------------
	public function get_inventario()
	{
		$this->db->select('COUNT(*) as total_productos, SUM(precio_listaPR) as total_costo');
		$this->db->where('estadoPR', 1);
		return $this->db->get('productos')->row();
	}

	//--------------------------------------------------------------
	public function get_inventario_bajo_stock()
	{
		$this->db->where('stockPR <', 5);
		$this->db->where('estadoPR', 1);
		$this->db->order_by('stockPR', 'desc');
		return $this->db->get('productos')->result();
	}

	//--------------------------------------------------------------
	public function total_productos()
	{
		$this->db->where('estadoPR', 1);
		$this->db->from('productos');
		return $this->db->count_all_results();
	}

	//--------------------------------------------------------------
	public function ult_productos()
	{
		$this->db->select('productos.*, productos_fotos.foto');
		$this->db->join('productos', 'productos.id_producto = productos_fotos.id_prod');
		$this->db->where('productos.estadoPR', 1);
		$this->db->order_by('productos.id_producto', 'desc');
		$this->db->limit('4');
		$this->db->group_by('productos.id_producto');
		return $this->db->get('productos_fotos')->result();
	}

	//--------------------------------------------------------------
	public function productos_mas_vendidos()
	{
		$this->db->select('p.*, SUM(vd.cantidadVENT) as cantidad');
		$this->db->from('ventasdetalle vd');
		$this->db->join('productos p', 'p.id_producto = vd.id_product');
		$this->db->group_by('vd.id_product');
		$this->db->order_by('SUM(vd.cantidadVENT)', 'desc');
		return $this->db->get()->result();
	}
	
	//--------------------------------------------------------------
	public function productos_mas_vendidos_con_foto()
	{
		$this->db->select('p.*, (SELECT foto FROM productos_fotos WHERE id_prod = p.id_producto LIMIT 1) as foto, SUM(vd.cantidadVENT) as cantidad');
		$this->db->from('ventasdetalle vd');
		$this->db->join('productos p', 'p.id_producto = vd.id_product');
		$this->db->group_by('vd.id_product');
		$this->db->order_by('SUM(vd.cantidadVENT)', 'desc');
		$this->db->limit('6');
		return $this->db->get()->result();
	}
}
