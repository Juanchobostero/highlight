<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class APIUser extends CI_Controller {

  public function __construct(){
    parent::__construct();
    $this->load->model('public/Usuarios_model');
    $this->load->library('form_validation');
    $this->load->library('cart');
  }


  //---------------------------------------
  
  public function login() {
    $correo = $this->input->post('correo');
    $pass = $this->input->post('pass');
    $user =  $this->Usuarios_model->get_user_correo($correo);
    if($user && password_verify($pass, $user->passwordU)) {
      $data = [
        'id'          => $user->id_usuario,
        'nombreU'   => $user->nombreU,
        'apellidoU'   => $user->apellidoU,
        'telefonoU'   => $user->telefonoU,
        'fotoU'   => $user->fotoU,
        'emailU'    => $user->emailU,
        'id_tu'  => $user->id_tu,
        'estado'  => $user->estadoU,
        'nickU' => $user->nickU,
        'login'       => TRUE
      ];
      $this->session->set_userdata($data);
      $result = 1;
      $msg = 'Bienvenido a Highlight !';
      if(!$user->nombreU || !$user->apellidoU || !$user->telefonoU || !$user->nickU){
        $_SESSION['flash_msg'] = 'Completa tu perfil por unica vez para Continuar';
        $this->session->mark_as_flash('flash_msg');
        $url = base_url('perfil');
      }else if($this->cart->total_items() > 0){
        $url = base_url('carrito');
      }else{
        $url = base_url();
      }
     
      $this->output->set_output(json_encode(compact('result', 'url', 'msg')));
      return;

    }else{
      $result = 0;
      $errors = ['login' => 'Correo y/o Contraseña Incorrectos'];
      $this->output->set_output(json_encode(compact('result', 'errors')));
      return;
    }
  }
  
}