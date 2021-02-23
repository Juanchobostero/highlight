<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Productos_model extends CI_Model {

  //--------------------------------------------
  public function get(){
    $this->db->select('productos.*, pf.foto, marcas.descripcionM, subcategorias.descripcionSC, categorias.descripcionCAT');
    $this->db->join('marcas', 'marcas.id_marca = productos.id_mar');
    $this->db->join('subcategorias', 'subcategorias.id_subcategoria = productos.id_subcat');
    $this->db->join('productos_fotos as pf', 'productos.id_producto = pf.id_prod');
    $this->db->where('pf.foto IS NOT NULL');
    $this->db->join('categorias', 'categorias.id_categoria = subcategorias.id_cat');
    return $this->db->get('productos')->result();
  }

//--------------------------------------------
  public function get_productos($cat, $subcat, $limit, $start)
  {
    $this->db->select('productos.*, pf.foto, marcas.descripcionM, subcategorias.descripcionSC, categorias.descripcionCAT');
    $this->db->join('marcas', 'marcas.id_marca = productos.id_mar');
    $this->db->join('subcategorias', 'subcategorias.id_subcategoria = productos.id_subcat');
    $this->db->join('productos_fotos as pf', 'productos.id_producto = pf.id_prod');
    $this->db->where('pf.foto IS NOT NULL');
    if($cat) $this->db->where('categorias.id_categoria', $cat);
    if($subcat) $this->db->where('productos.id_subcat', $subcat);
    $this->db->join('categorias', 'categorias.id_categoria = subcategorias.id_cat');
    $this->db->limit($limit, $start);
    return $this->db->get('productos')->result();
  }

  public function get_producto($id)
	{
    $this->db->join('subcategorias as sc', 'productos.id_subcat = sc.id_subcategoria');
    $this->db->join('categorias as cat', 'sc.id_cat = cat.id_categoria');
    $this->db->join('productos_fotos as pf', 'productos.id_producto = pf.id_prod');
    $this->db->where('pf.foto IS NOT NULL');
    $this->db->where('productos.id_producto', $id);

    $producto = $this->db->get('productos')->row();
    return $producto;
  }

  public function get_fotos($id)
  {
    $this->db->select('productos_fotos.*');
    $this->db->where('productos_fotos.id_prod', $id);

    return  $this->db->get('productos_fotos')->result();
  }

  
  //retorna los productos destacados
  public function get_destacados($limit, $start){

    $this->db->select('pr.id_producto, pr.nombrePR, pr.precio_ventaPR, pf.foto');
    $this->db->from('productos as pr');
    $this->db->join('productos_fotos as pf', 'pf.id_prod = pr.id_producto'); 
    $this->db->where('pf.foto IS NOT NULL');
    $this->db->where('pr.destacadoPR', 'SI');
    $this->db->where('pr.estadoPR', 1);
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
    $this->db->where('pr.destacadoPR', 'NO');
    $this->db->where('pr.estadoPR', 1);
    $this->db->group_by('pr.id_producto');
    $this->db->order_by('pr.id_producto', 'desc');
    $this->db->limit($limit, $start);
    $novedades = $this->db->get()->result();

    return $novedades;
  }

  public function get_ofertas($limit, $start){

    $this->db->select('pr.id_producto, pr.nombrePR, pr.precio_ventaPR, pf.foto, 
                      TRUNCATE(((pr.precio_ventaPR * po.porcentaje) / 100), 2) as precio_nuevo');
    $this->db->from('productos as pr');
    $this->db->join('productos_ofertas as po', 'po.id_produc = pr.id_producto'); 
    $this->db->join('productos_fotos as pf', 'pf.id_prod = pr.id_producto'); 
    $this->db->where('pf.foto IS NOT NULL');
    $this->db->where('po.id_produc IS NOT NULL');
    $this->db->where('po.estado_oferta', 1);
    $this->db->group_by('pr.id_producto');
    $this->db->order_by('pr.id_producto', 'desc');
    $this->db->limit($limit, $start);
    $ofertas = $this->db->get()->result();

    return $ofertas;
  }

  public function get_count($cat = null, $subcat = null){
    $this->db->select('id_producto');
    $this->db->join('subcategorias', 'id_subcat = id_subcategoria');
    $this->db->join('categorias', 'id_cat = id_categoria');
    $this->db->join('productos_fotos as pf', 'productos.id_producto = pf.id_prod');
    $this->db->where('stockPR >', 0);
    if($cat) $this->db->where('id_cat', $cat);
    if($subcat) $this->db->where('id_subcat', $subcat);
    $this->db->group_by('id_producto');
    $this->db->from('productos');
    return $this->db->count_all_results();
  }

  public function get_count_all() {
    $this->db->select('id_producto');
    $this->db->join('subcategorias', 'id_subcat = id_subcategoria');
    $this->db->join('categorias', 'id_cat = id_categoria');
    $this->db->join('productos_fotos as pf', 'productos.id_producto = pf.id_prod');
    $this->db->where('stockPR >', 0);
    $this->db->group_by('id_producto');
    $this->db->from('productos');
    return $this->db->count_all_results();
  }

  public function get_count_productos_destacados(){
    $this->db->select('id_producto');
    $this->db->where('stockPR >', 0);
    $this->db->where('destacadoPR', 'SI');
    $this->db->where('estadoPR', 1);
    $this->db->group_by('id_producto');
    $this->db->from('productos');
    return $this->db->count_all_results();
  }

  public function get_count_productos_novedades(){
    $this->db->select('id_producto');
    $this->db->where('stockPR >', 0);
    $this->db->where('destacadoPR', 'NO');
    $this->db->where('estadoPR', 1);
    $this->db->group_by('id_producto');
    $this->db->from('productos');
    return $this->db->count_all_results();
  }

  public function get_count_productos_ofertas(){
    $this->db->select('id_producto');
    $this->db->where('stockPR >', 0);
    $this->db->where('destacadoPR', 'NO');
    $this->db->group_by('id_producto');
    $this->db->from('productos');
    return $this->db->count_all_results();
  }
}