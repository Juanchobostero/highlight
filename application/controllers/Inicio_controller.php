<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Inicio_controller extends CI_Controller
{
	//--------------------------------------------------------------
	public function admin()
	{

		if (isset($_SESSION['id'])) {
			redirect('admin/dashboard');
		} else {
			redirect('admin/login');
		}
	}

	
	public function index()
	{
		$data['portadas'] = $this->Portadas_model->get_habs();
		$this->load->view('public/index', $data);
	}

	//--------------------------------------------------------------
	// acceso a login de admin
	public function login()
	{
		$data['title'] = 'Acceso';
		$this->load->view('admin/login', $data);
		// $this->validar();
	}

	//--------------------------------------------------------------
	// Validacion del login del admin
	public function validar()
	{
		verificarConsulAjax();

		$email = $this->input->post('email');
		$pass = $this->input->post('pass');

		$this->form_validation->set_rules('email', 'E-mail', 'required|valid_email');
		$this->form_validation->set_rules('pass', 'Contraseña', 'required');

		if ($this->form_validation->run()) {
			$users = new Usuarios;
			$user = $users->get_user_correo($email);

			if ($user and password_verify($pass, $user->passwordU)) {
				$data = [
					'id'			 => $user->id_usuario,
					'tipo'		 => $user->id_tu,
					'nombre'	 => $user->nombreU,
					'apellido' => $user->apellidoU,
					'usuario'	 => $user->nombreU . ' ' . $user->apellidoU,
					'telefono' => $user->telefonoU,
					'correo'	 => $user->emailU,
					'foto'		 => $user->fotoU,
					'estado'	 => $user->estadoU,
					'login'		 => TRUE
				];
				$this->session->set_userdata($data);
				// redirect('admin');
				$this->output->set_output(json_encode(['result' => 1, 'titulo' => 'Excelente!', 'msj' => 'Bienvenido ' . $user->nombreU . '!', 'url' => base_url('admin/dashboard')]));
				return;
			}
			$this->output->set_output(json_encode(['result' => 2, 'titulo' => 'Ooops.. error!', 'errores' => ['Email y/o contraseña incorrectos']]));
			return;
		} else {
			$this->output->set_output(json_encode(['result' => 3, 'titulo' => 'Ooops.. error!', 'errores' => $this->form_validation->error_array()]));
			return;
		}
	} // fin de metodo validar

	//--------------------------------------------------------------
	public function frmSalir()
	{
		$this->load->view('admin/cerrar-sesion');
	}

	//--------------------------------------------------------------
	public function cerrarSesion()
	{
		$this->session->sess_destroy();
		redirect('admin/login');
	}
}
