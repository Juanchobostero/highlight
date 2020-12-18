<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Productos_model extends CI_Model {

//--------------------------------------------
  public function get_productos()
  {
    $this->db->select('productos.*, marcas.descripcionM, subcategorias.descripcionSC, categorias.descripcionCAT');
    $this->db->join('marcas', 'marcas.id_marca = productos.id_mar');
    $this->db->join('subcategorias', 'subcategorias.id_subcategoria = productos.id_subcat');
    $this->db->join('categorias', 'categorias.id_categoria = subcategorias.id_cat');
    return $this->db->get('productos')->result();
  }

  public function get_producto($id)
	{
		$this->db->where('id_producto', $id);
		return $this->db->get('productos')->row();
  }

  /* public function get_foto_producto($id)
  {
    $this->db->select('productos_fotos.foto');
    $this->db->where('id_prod', $id);
    return $this->db->get('productos_fotos')->row();
  } */

  /* public function tiene_foto()
  {
    $this->db->select('productos_fotos.foto');
    $this->db->join('productos', 'productos.id_producto = productos_fotos.id_prod');
    
    $res = $this->db->get('productos_fotos')->row();

    if($res != null)
    {
      return true;
    }else{
      return false;
    }
  } */
  
  //retorna los productos destacados
  public function get_destacados($limit, $start){

    $this->db->select('pr.id_producto, pr.nombrePR, pr.precio_ventaPR, pf.foto');
    $this->db->from('productos as pr');
    $this->db->join('productos_fotos as pf', 'pf.id_prod = pr.id_producto'); 
    $this->db->where('pf.foto IS NOT NULL');
    $this->db->where('pr.destacadoPR', 'SI');
    $this->db->group_by('pr.id_producto');
    $this->db->order_by('pr.id_producto', 'desc');
    $this->db->limit($limit, $start);
    $detacados = $this->db->get()->result();

    return $detacados;
   
  }

  public function get_novedades($limit, $start){

    $this->db->select('pr.id_producto, pr.nombrePR, pr.precio_ventaPR, pf.foto');
    $this->db->from('productos as pr');
    $this->db->join('productos_fotos as pf', 'pf.id_prod = pr.id_producto'); 
    $this->db->where('pf.foto IS NOT NULL');
    $this->db->where('pr.destacadoPR', 'SI');
    $this->db->group_by('pr.id_producto');
    $this->db->order_by('pr.id_producto', 'desc');
    $this->db->limit($limit, $start);
    $novedades = $this->db->get()->result();

    return $novedades;
  }

  public function get_ofertas($limit, $start){

    $this->db->select('pr.id_producto, pr.nombrePR, pr.precio_ventaPR, pf.foto');
    $this->db->from('productos as pr');
    $this->db->join('productos_fotos as pf', 'pf.id_prod = pr.id_producto'); 
    $this->db->where('pf.foto IS NOT NULL');
    $this->db->where('pr.destacadoPR', 'SI');
    $this->db->group_by('pr.id_producto');
    $this->db->order_by('pr.id_producto', 'desc');
    $this->db->limit($limit, $start);
    $ofertas = $this->db->get()->result();

    return $ofertas;
  }
}