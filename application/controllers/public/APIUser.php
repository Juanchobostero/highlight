<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class APIUser extends CI_Controller {

  public function __construct(){
    parent::__construct();
    $this->load->model('public/Usuarios_model');
    $this->load->library('form_validation');
    $this->load->library('cart');
  }


  //----------------------------------------------------------

  public function mandar_email($data){
    $config = array(
      'protocol'  => 'smtp',
      'smtp_host' => 'ssl://smtp.gmail.com',
      'smtp_user' => 'prueba.softcre@gmail.com',
      'smtp_pass' => 'prueba123456softcre',
      'smtp_port' => '465',
      'charset'   => 'utf-8',
      'mailtype'  => 'html',
      'validate'  => TRUE,
      'wordwrap'  => TRUE,
    );

    $this->email->initialize($config);
    $msg = 'Gracias por registrarse a nuestra web. <br>Ya se encuentra en condiciones de comprar. <br> Esto es un correo automático.<br>No conteste este mail. <br>Atte. HIGHLIGHT';

    $this->email->from('prueba.softcre@gmail.com');
    $this->email->to($data['emailU']);
    $this->email->subject($data['asunto']);
    $this->email->message($msg);
    $this->email->set_newline("\r\n");
    //$this->email->attach(base_url('assets/PDFs/prueba.pdf'));
    return $this->email->send();
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
      if(!$user->nombreU || !$user->apellidoU || !$user->telefonoU){
        $_SESSION['flash_msg'] = 'Completá tu perfil por única vez para Continuar';
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

  public function signin(){
    $this->form_validation->set_rules('correo', 'Correo', 'required|valid_email|is_unique[usuarios.emailU]');
    $this->form_validation->set_rules('pass', 'Contraseña', 'required');
    $this->form_validation->set_rules('pass2', 'Confirmar Contraseña', 'required|matches[pass]');
    $this->form_validation->set_message("required", "El campo ({field}) es Requerido!");
    $this->form_validation->set_message("valid_email", "Ingreser un ({field}) Valido!");
    $this->form_validation->set_message("is_unique", "Ya existe el ({field})!");
    $this->form_validation->set_message("matches", "Las contraseñas no coinciden!");

    if ($this->form_validation->run()){
      $data['emailU'] = $this->input->post('correo');
      $data['passwordU'] = password_hash($this->input->post('pass'), PASSWORD_DEFAULT);

      $data['id_tu'] = 2; //tipo cliente
      $data['estadoU'] = 1; //habilitado

      if($this->Usuarios_model->add($data)){
        $data['asunto'] = 'Registro aceptado';
        $this->mandar_email($data);
        $result = 1;
        $url = base_url('login');
        $msg = 'Para continuar debe Iniciar Sesion';
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

  public function set_profile(){
    $this->form_validation->set_rules('nombre', 'Nombre de Usuario', 'required');
    $this->form_validation->set_rules('apellido', 'Apellido de Usuario', 'required');
    $this->form_validation->set_rules('telefono', 'Telefono de Usuario', 'required');
    $this->form_validation->set_message("required", "El campo ({field}) es Requerido!");

    if ($this->form_validation->run()){
      $id = $this->input->post('id_usuario');
      $data['nombreU'] = $this->input->post('nombre');
      $data['apellidoU'] = $this->input->post('apellido');
      $data['telefonoU'] = $this->input->post('telefono');

      if(!empty($_FILES['foto']['name'])) {
        $nombre_foto = 'foto';
        $carpeta_foto = 'perfiles';
        $img_default = 'no-user.jpg';
        $data['fotoU'] = subirImagen($nombre_foto, $carpeta_foto, $img_default);
      }
      

      if($this->Usuarios_model->set_profile($id, $data)){
        $result = 1;
        if($this->cart->total()){
          $url = base_url('carrito');
        }else{
          $url = base_url();
        }
        $msg = 'Gracias por Completar su perfil, ahora puede seguir Comprando';
        $this->output->set_output(json_encode(compact('result', 'url', 'msg')));
        return;
      }else{
        $result = 2;
        $msg = 'No se pudo guardar los datos. Intente mas tarde!';
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