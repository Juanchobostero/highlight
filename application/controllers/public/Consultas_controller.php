<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Consultas_controller extends CI_Controller {

public function __construct(){
    parent::__construct();
    $this->load->model('public/Consultas_model');
    $this->load->library('form_validation');
    $this->load->library('cart');
    }

public function mensaje(){
    $this->form_validation->set_rules('nombre', 'Nombre', 'required');
    $this->form_validation->set_rules('correo', 'Correo', 'required|valid_email');
    $this->form_validation->set_rules('telefono', 'Telefono', 'required');
    $this->form_validation->set_rules('mensaje', 'Mensaje', 'required');
    $this->form_validation->set_message("required", "El campo ({field}) es Requerido!");
    $this->form_validation->set_message("valid_email", "Ingreser un ({field}) Valido!");
    $this->form_validation->set_message("alpha_numeric", "Su mensaje solo debe contener letras y números !");

    if ($this->form_validation->run()){
        $data['nombre'] = $this->input->post('nombre');
        $data['correo'] = $this->input->post('correo');
        $data['teléfono'] = $this->input->post('telefono');
        $data['motivo'] = $this->input->post('mensaje');
        $data['fecha_envio'] = date("Y-m-d H:i:s");
  
        if($this->Consultas_model->add($data)){
          $result = 1;

          $emailUser = array(
            'de'      => APP_MAIL,
            'titulo'  => APP_NAME,
            'para'    => $data['correo'],
            'asunto'  => 'Mensaje recibido',
            'mensaje' => 'Tu mensaje ha sido enviado con exito. 
            Pronto nos comunicaremos con ud via correo o whatsapp. 
            <br> Esto es un correo automático.<br>No conteste este mail. <br>Atte. HIGHLIGHT',
          );

          enviar_email($emailUser);

          $url = base_url();
          $msg = 'Su consulta ha sido enviada con éxito !';
          $_SESSION['flash_msg'] = $msg;
          $this->session->mark_as_flash('flash_msg');
          $this->output->set_output(json_encode(compact('result', 'url', 'msg')));
          return;
        }else{
          $result = 2;
          $msg = 'No se pudieron guardar los datos. Intente mas tarde!';
          $this->output->set_output(json_encode(compact('result', 'msg')));
        }
  
      }else{
        $result = 0;
        $errors = $this->form_validation->error_array();
        $this->output->set_output(json_encode(compact('result', 'errors')));
        return;
      }
}

}