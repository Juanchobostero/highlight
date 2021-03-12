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

}