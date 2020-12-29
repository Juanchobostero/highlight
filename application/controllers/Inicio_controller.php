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
		//Paginado
		$perPage = 10;
		$start = 0;

		$data['categorias'] = $this->Categorias_model->get_full();
		$data['portadas'] = $this->Portadas_model->get_habs();
		$data['productos'] = $this->Productos_model->get_productos();
		$total_dest = $this->Productos_model->get_count_productos_destacados();
		$total_nov = $this->Productos_model->get_count_productos_novedades();
		$total_ofe = $this->Productos_model->get_count_productos_ofertas();
		$data['total_destacados'] = ceil($total_dest/$perPage);
		$data['total_novedades'] = ceil($total_nov/$perPage);
		$data['total_ofertas'] = ceil($total_ofe/$perPage);
		$data['destacados'] = $this->Productos_model->get_destacados($perPage, $start);
		$data['novedades'] = $this->Productos_model->get_novedades($perPage, $start);
		$data['ofertas'] = $this->Productos_model->get_ofertas($perPage, $start);

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

	//--------------------------------------------------------------
	public function producto($id){
		$data['categorias'] = $this->Categorias_model->get_full();
		$data['producto'] = $this->Productos_model->get_producto($id);
	
		/* if(!$data['producto']){
		  show_404($page = '', $log_error = TRUE);
		  return;
		}
		 */
		$this->load->view('public/producto', $data);
		
	  }
}
