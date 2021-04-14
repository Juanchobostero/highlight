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
  public function get_productos($cat = null, $subcat = null, $limit, $start)
  {
    $this->db->select('productos.*, pf.foto, marcas.descripcionM, subcategorias.descripcionSC, categorias.descripcionCAT');
    $this->db->join('marcas', 'marcas.id_marca = productos.id_mar');
    $this->db->join('subcategorias', 'subcategorias.id_subcategoria = productos.id_subcat');
    $this->db->join('categorias', 'categorias.id_categoria = subcategorias.id_cat');
    $this->db->join('productos_fotos as pf', 'productos.id_producto = pf.id_prod');
    $this->db->where('pf.foto IS NOT NULL');
    $this->db->where('productos.stockPR >', 0);
    if($cat) $this->db->where('categorias.id_categoria', $cat);
    if($subcat) $this->db->where('productos.id_subcat', $subcat);
    
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
    $this->db->join('productos_ofertas as po', 'po.id_produc = productos.id_producto');
    $this->db->join('productos_fotos as pf', 'productos.id_producto = pf.id_prod'); 
    $this->db->where('pf.foto IS NOT NULL');
    $this->db->where('po.id_produc IS NOT NULL');
    $this->db->where('stockPR >', 0);
    $this->db->group_by('id_producto');
    $this->db->from('productos');
    return $this->db->count_all_results();
  }

  public function buscar($stg){
    $this->db->select('productos.*, pf.foto');
    $this->db->join('productos_fotos as pf', 'pf.id_prod = productos.id_producto');
    $this->db->where('pf.foto IS NOT NULL');
    $this->db->where('stockPR >', 0);
    $this->db->like('nombrePR', $stg);
    $this->db->or_like('descripcionPR', $stg);
    $this->db->group_by('id_producto');
    return $this->db->get('productos')->result();
  
  }

  public function guardar_pedido() {
    $fechaPedido = date("Y-m-d H:i:s");
    $id_mercadoPago = $_GET['payment_id'];
    $pedcab = [
      'id_us' => $this->session->userdata('id'),
      'totalVENT' => $this->cart->total(),
      'fechaENVIO' => $fechaPedido,
      'estadoPAGO' => 'Aprobado',
      'nroPago' => $id_mercadoPago,
    ];

    $this->db->insert('ventas', $pedcab);
    $pedcab_id = $this->db->insert_id();

    foreach($this->cart->contents() as $item){
      $ped_det = [
        'id_vent' => $pedcab_id,
        'id_product' => $item['id'],
        'cantidadVENT' => $item['qty'],
        'precioVENT' => $item['price'],
        'subtotalVENT' => $item['price'] * $item['qty']
      ];
      $this->db->insert('ventasdetalle', $ped_det);
      $this->descontar_stock($ped_det);
    }

    return $pedcab_id;
  }

  public function descontar_stock($detalle){
    $this->db->where('id_producto', $detalle['id_product']);
    $producto = $this->db->get('productos')->row();
    $newStock = $producto->stockPR - $detalle['cantidadVENT'];
    $this->db->where('id_producto', $producto->id_producto);
    $this->db->set('stockPR', $newStock);
    $this->db->update('productos'); 
  }

  public function get_pedidos($iduser){
    $this->db->where('id_us', $iduser);
    $this->db->order_by('id_venta', 'DESC');
    return $this->db->get('ventas')->result();
  }

  public function get_detalle_pedido($idpedido){
    $this->db->select('productos.*, ventasdetalle.*, productos_fotos.*');
    $this->db->join('productos', 'id_product = id_producto');
    $this->db->join('productos_fotos', 'id_prod = productos.id_producto');
    $this->db->where('id_vent', $idpedido);
    $detalle = $this->db->get('ventasdetalle')->result();
    
    return $detalle;
  }

  public function get_pedido($id){
    $this->db->where('id_venta', $id);
    $pedido = $this->db->get('ventas')->row();
    if(!$pedido){
      return null;
    }
    $pedido->detalle = $this->get_detalle_pedido($pedido->id_venta);
    return $pedido;
  }

  //retorna un arreglo de imagenes de un producto
  public function get_img($id_producto){
    $this->db->where('id_prod', $id_producto);
    return $this->db->get('productos_fotos')->result();
  }
}