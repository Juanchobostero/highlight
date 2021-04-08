<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class APICarrito extends CI_Controller {

    public function __construct(){
		parent::__construct();
        $this->load->library('cart');
        $this->load->model('Productos_model');
        $this->load->model('Usuarios_model');
    }

    public function agregar(){
        $idproducto = $this->input->post('idproducto');
        $stock = $this->input->post('stock');
        $cantidad = $this->input->post('cantidad');
        $precioVenta = $this->input->post('precioVenta');
        $producto = $this->Productos_model->get_producto($idproducto);

        if(!$producto){
            $result = 0;
            $msg = 'No existe el Producto!';
            $this->output->set_output(json_encode(compact('result', 'msg')));
            return;
        }


        if($cantidad <= 0 || $cantidad > $stock){
            $result = 0;
            $msg = 'Stock insuficiente!';
            $this->output->set_output(json_encode(compact('result', 'msg')));
            return;
        }

        $data = [
            'id'      => $producto->id_producto,
            'qty'     => $cantidad,
            'price'   => $precioVenta,
            'name'    => $producto->nombrePR,
            'foto'   => $producto->foto,
            'stock' => $producto->stockPR,
        ];

        $this->cart->insert($data);

        $result = 1;
        $msg = "Producto Agregado!";

        $this->output->set_output(json_encode(compact('result', 'msg')));
    }

    public function eliminar(){
        $rowid = $this->input->post('id');
        if($this->cart->remove($rowid)){
            $result = 1;
            $msg = "Producto Eliminado!";
            $html = $this->load->view('public/ajax/carrito', null, TRUE);
            $total = $this->cart->total();
        }else{
            $result = 0;
            $msg = "No se pudo Eliminar!";
            $html = '';
            $total = '';
        }

        $this->output->set_output(json_encode(compact('result', 'msg', 'html', 'total')));
    }

    public function total_items(){
        $total = $this->cart->total_items();
        $this->output->set_output(json_encode(compact('total')));
    }

    public function vaciar(){

        if($this->cart->total_items() > 0) {
            $this->cart->destroy();
            $result = 1;
            $msg = "El Carrito ha sido eliminado";
            $newTotal = $this->cart->total();
            $html = $this->load->view('public/ajax/carrito', null, TRUE);

        }else {
            $result = 0;
            $msg = "El Carrito ya se encuentra vacio !";
            $newTotal = $this->cart->total();
            $html = $this->load->view('public/ajax/carrito', null, TRUE);
        }
        
        

        

        $this->output->set_output(json_encode(compact('result', 'msg', 'html', 'newTotal')));
        
        }

     //actualizar cantidad item
    public function update_qty(){
        $rowid = $this->input->post('rowid');
        $qty = $this->input->post('qty');
        $item = $this->cart->get_item($rowid);
        
        //no existe item
        if(!$item){
            $result = 404;
            $msg = 'No Existe el item!';
            $this->output->set_output(json_encode(compact('result', 'msg')));
            return;
        }
        //actualizo stock con lo que esta en la bd
        $producto = $this->Productos_model->get_producto($item['id']);
        $item['stock'] = $producto->stockPR;
        $this->cart->update(['rowid' => $item['rowid']]);
        $item = $this->cart->get_item($rowid);

        //stock insuficiente
        if($item['stock'] < $qty){
            $result = 2;
            $msg = 'Stock Insuficiente!';
            $newStock = $item['stock'];
            $this->output->set_output(json_encode(compact('result', 'msg', 'newStock')));
            return;
        }

        $this->cart->update(['rowid' => $rowid, 'qty' => $qty]);

        $result = 1;
        $item = $this->cart->get_item($rowid);
        $newtotal = $this->cart->total();
        $newStock = $item['stock'];
        $price = $item['price'];
        $this->output->set_output(json_encode(compact('result','newtotal', 'newStock', 'price')));
        return;
    }

    public function guardar_compra() {
        
    if($this->cart->total() <= 0){
        $result = 0;
        $msg = 'No hay items en el Carrito!';
        $this->output->set_output(json_encode(compact('result', 'msg')));
        return;
      }
      /* 
      $monto_minimo = $this->Product->get_monto_minimo();
  
      if($this->cart->total() < $monto_minimo){
        $result = 0;
        $msg = 'El Monto Minimo de compra debe ser mayor o igual a: $'.$monto_minimo;
        $this->output->set_output(json_encode(compact('result', 'msg')));
        return;
      } */
  
      //si no esta logeado
      if(!$this->session->userdata('login')){
        $result = 2;
        $url = base_url('login');
        $msg = 'Debes iniciar sesión para continuar !';
        $this->output->set_output(json_encode(compact('result', 'msg', 'url')));
        return;
      }
  
      $user = $this->Usuarios_model->get_user($this->session->userdata('id'));
      //si no completo su perfil
      if(!$user->nombreU || !$user->apellidoU || !$user->id_loc || !$user->telefonoU){
        $msg = 'Completa tu perfil por unica vez para Continuar !';
        $result = 2;
        $url = base_url('perfil');
        $this->output->set_output(json_encode(compact('result', 'url', 'msg')));
        return;
      }
  
      // se controla por ultima vez el stock antes de guardar el pedido
      $flag_errors = false;
      $errors = [];
      foreach($this->cart->contents() as $item){
        $producto = $this->Productos_model->get_producto($item['id']);
        if($producto->stockPR < $item['qty']){
          $flag_errors = true;
          $errors[] = 'Stock insuficiente: '. $item['name'];
          
          $item['stock'] = $producto->stockPR;
          $this->cart->update(['rowid' => $item['rowid']]);
        }
      }
  
      if($flag_errors){
        $result = 0;
        $html = $this->load->view('public/ajax/carrito', null, TRUE);
        $this->output->set_output(json_encode(compact('result', 'errors', 'html')));
        return;
      }
  
  
      // salio todo bien, redirigir a pagar.php (formulario de mercado pago)
      $result = 1;
      $msg = "En breve serás redirigido para continuar con tu pago !";
      //$url = base_url('pedido/'.$idPedido);
      $url = base_url('pagar');
      //$this->cart->destroy();
      $this->output->set_output(json_encode(compact('result', 'msg', 'url')));
  
      /* //enviar mail
      $envioAlCliente = array(
        'de'      => 'server.email@nissijoyas.com',
        'titulo'  => 'NISSI Joyas',
        'para'    => $this->session->userdata('correo'),
        'asunto'  => 'Confirmación de pedido',
        'mensaje' => 'Hemos recibido su pedido nº '. $idPedido . '.<br/>No conteste este mail.<br/>Atte: NISSI Joyas',
        );
      
      $envioAlVendedor = array(
        'de'      => 'server.email@nissijoyas.com',
        'titulo'  => 'NUEVO PEDIDO',
        'para'    => 'joyasnissi@gmail.com',
        'asunto'  => 'Se registro un nuevo pedido',
        'mensaje' => 'Nuevo pedido alojado en el buzon nº '.$idPedido,
      );
  
      $this->email($envioAlCliente);
      $this->email($envioAlVendedor); */
    
    }

    

}