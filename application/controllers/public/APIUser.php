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
        'domicilioU' => $user->domicilioU,
        'fotoU'   => $user->fotoU,
        'emailU'    => $user->emailU,
        'id_tu'  => $user->id_tu,
        'estado'  => $user->estadoU,
        'login'       => TRUE
      ];
      $this->session->set_userdata($data);
      $result = 1;
      $msg = 'Bienvenido a Highlight !';
      if(!$user->nombreU || !$user->apellidoU || !$user->telefonoU || !$user->domicilioU){
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

      $emailEnvio = $data['emailU'];

      //enviar mail
			$emailUser = array(
				'de'      => APP_MAIL,
				'titulo'  => APP_NAME,
				'para'    => $emailEnvio,
				'asunto'  => 'Registro aceptado',
				'mensaje' => 'Gracias por registrarse a nuestra web. <br>Ya se encuentra en condiciones de comprar. <br> Esto es un correo automático.<br>No conteste este mail. <br>Atte. HIGHLIGHT',
				);

      if($this->Usuarios_model->add($data)){
        enviar_email($emailUser);
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
    $this->form_validation->set_rules('domicilio', 'Domicilio de Usuario', 'required');
    $this->form_validation->set_message("required", "El campo ({field}) es Requerido!");

    if ($this->form_validation->run()){
      $id = $this->input->post('id_usuario');
      $data['nombreU'] = $this->input->post('nombre');
      $data['apellidoU'] = $this->input->post('apellido');
      $data['telefonoU'] = $this->input->post('telefono');
      $data['domicilioU'] = $this->input->post('domicilio');
      $data['id_loc'] = $this->input->post('localidad');

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

  public function get_prov_localidades() {
    $id_prov = $this->input->post('id_prov');
    $data['localidades'] = $this->Usuarios_model->get_prov_localidades($id_prov);
    $html = $this->load->view('public/ajax/localidades', $data, TRUE);
    $this->output->set_output(json_encode(['result' => 1, 'html' => $html]));
    
    return;
  }

  //----------------Envío de email para modificar contraseña perdida
  public function enviar_email_recu(){

    $correo = $this->input->post('correo_r');
    $user =  $this->Usuarios_model->get_user_correo($correo);

    if($user){
      $result = 1;
      $id_usuario = $user->id_usuario;
      //Envio de email
      $url = base_url('recuperar_contra/'.$id_usuario);
      $msg = "<html><body>";
      $msg .= '
        ¡Hola! <br>Recibiste este e-mail porque desde el sitio de HighLight, solicitaste recuperar la clave del mail: ' .$correo. '
  
          <p> Haga click en el siguiente enlace para recuperar su contraseña: <a href='.$url.'>Recuperar contraseña</a></p>
  
          <p><br>Esto es un correo automático.<br>No conteste este mail. <br>Atte. HighLight Herramientas</p>';
      $msg .= "</body></html>";

      $data = [
        'de'   => APP_MAIL,
        'titulo' => APP_NAME,
        'para' => $user->emailU,
        'asunto' => 'Cambio de contraseña',
        'mensaje' => $msg,
      ];

      enviar_email($data);

      $url = base_url('login');
      $msg = 'Correo enviado satisfactoriamente. Verifique su casilla de correo para proseguir. Puede cerrar esta ventana';
      $this->output->set_output(json_encode(compact('result', 'url', 'msg')));
      return;

    }else{
      $result = 2;
      $errors = ['login' => 'El correo no existe y/o es invalido'];
      $this->output->set_output(json_encode(compact('result', 'errors')));
      return;
    }
  }

    //--------------------------------------------
    public function nuevaContrasena($id_user) {

      $config = array(
        array(
          'field'          => 'nc',
          'label'          => 'Nc',
          'rules'   => 'required',
          'errors' => array(
            'required'    => 'La nueva contraseña no puede estar vacía.',
          ),
        ),
        array(
          'field'          => 'rc',
          'label'          => 'Rc',
          'rules'          => 'required',
          'errors' => array(
            'required'    => 'La confirmación no puede estar vacia.',
    
          ),
        ),
      );
      
      $this->form_validation->set_rules($config);
  
      if($this->form_validation->run()) {
        $usuario = new Usuarios_model;
  
  
        if($this->input->post('nc') != $this->input->post('rc')) {
  
          $mensaje = "Las contraseñas no coinciden";
          $result = 2;
          $this->output->set_output(json_encode(compact('result', 'mensaje')));
          return;
  
        } else {
        if($usuario->nuevaContrasena($this->input->post('nc'), $id_user)) {
            $mensaje = "Su contraseña ha sido modificada.";
            $result = 1;
            $url = base_url('login');
  
            $u = $usuario->search($id_user)[0];
            $datosEnvio = array(
              'de'      => APP_MAIL,
              'titulo'  => APP_NAME,
              'para'    => $u->correo,
              'asunto'  => 'Contraseña modificada',
              'mensaje' => "Contraseña modificada correctamente.<br>Esto es un correo automático.<br>No conteste este mail.<br>Muchas gracias.<br>Atte. Highlight",
            );
  
            enviar_email($datosEnvio);

            $this->output->set_output(json_encode(compact('result', 'url', 'mensaje')));
            return;
          
        
      }}
    } else {
        $html = '';
        $this->form_validation->set_error_delimiters('<li>', '</li>');
        foreach ($this->input->post() as $campo => $valor) if(!empty(form_error($campo))) $html = $html.trim(form_error($campo));
  
        $mensaje = "Los campos no deben estar vacios";
  
        $this->output->set_output(json_encode(compact('mensaje')));
        return;
      }
    }
  
    //------------------------------------
}