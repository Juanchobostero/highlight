<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class APISearch extends CI_Controller {

  public function __construct(){
		parent::__construct();
        $this->load->model('Productos_model');
  }

  public function get(){
    $value = $this->input->post('value');
    $productos = $this->Productos_model->buscar($value);

    if($productos){
      $result = 1;
      $html = $this->load->view('public/ajax/search',compact('productos'), TRUE);
    }else{
      $result = 0;
      $html = '<div class="search-msg">No se encontraron resultados...</div>';
    }
    $this->output->set_output(json_encode(compact('result', 'html')));
  }

  
}