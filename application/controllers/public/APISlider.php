<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class APISlider extends CI_Controller {

public function masDestacados() {
    $this->load->model('Productos_model');
    $perPage = 10;

    if(!empty($this->input->get("page"))){
      $start = $perPage * $this->input->get('page');
      $productos = $this->Productos_model->get_destacados($perPage, $start);
      if($productos){
        $data['productos'] = $productos;
        $html = $this->load->view('public/ajax/slider-cells', $data, TRUE);
        $this->output->set_output(json_encode(['result' => 1, 'html' => $html]));
        return;
      }else{
        $this->output->set_output(json_encode(['result' => 0]));
        return;
      }
    }
    else{
      $this->output->set_output(json_encode(['result' => 0]));
      return;
    }
}

}