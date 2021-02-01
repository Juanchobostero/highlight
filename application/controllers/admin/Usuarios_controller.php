<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Usuarios_controller extends CI_Controller
{
	//--------------------------------------------------------------
	public function __construct()
	{
		parent::__construct();
		if (!isset($_SESSION['id'])) {
			show_404();
		}
	}

	//--------------------------------------------------------------
	public function index()
	{
		$data['title'] = 'Usuarios';
		$data['act'] = '1U';
		$data['desplegado'] = '';
		$data['msjs_ult_tres'] = $this->Mensajes->get_mensajes_ult_tres();
		$data['msj_no_leidos'] = $this->Mensajes->get_mensajes_no_leidos();
		$this->load->view('admin/usuarios/index', $data);
	}

	//--------------------------------------------------------------
	public function getUsuarios($estado)
	{
		verificarConsulAjax();

		switch ($estado) {
			case 'activos':
				$data['usuarios'] = $this->Usuarios->get_users(1); // Devuelve usuarios activos
				$this->load->view('admin/usuarios/_tblUsuarios', $data);
				break;
			case 'deshabilitados':
				$data['usuarios'] = $this->Usuarios->get_users(1, 0); // Devuelve usuarios eliminados
				$this->load->view('admin/usuarios/_tblUsuariosEliminados', $data);
				break;
		}
	}

	//--------------------------------------------------------------
	public function frmEditarPerfil()
	{
		$data['title'] = 'Perfil';
		$data['act'] = '';
		$data['desplegado'] = '';
		$data['msjs_ult_tres'] = $this->Mensajes->get_mensajes_ult_tres();
		$data['msj_no_leidos'] = $this->Mensajes->get_mensajes_no_leidos();
		$this->load->view('admin/perfil/editarPerfil', $data);
	}

	//--------------------------------------------------------------
	public function editarPerfil()
	{
		verificarConsulAjax();

		$nombre = $this->input->post('nombre');
		$apellido = $this->input->post('apellido');
		$telefono = $this->input->post('telefono');
		$email = $this->input->post('mail');

		$this->form_validation->set_rules('mail', 'E-mail', 'required|valid_email|trim');

		if ($this->form_validation->run()) {
			$user = [
				'nombreU'		=> $nombre,
				'apellidoU'	=> $apellido,
				'telefonoU'	=> $telefono,
				'emailU' 		=> $email
			];

			if (!empty($_FILES['file']['name'])) {
				$foto = subirImagen('file', 'perfiles', 'no-user.jpg');
				$user['fotoU'] = $foto;
				$datosSession['foto'] = $foto;
			}

			$resp = $this->Usuarios->actualizar($_SESSION['id'], $user); // se hace un update en bd

			if ($resp) {
				$datosSession = [
					'nombre'		=> $nombre,
					'apellido' 	=> $apellido,
					'usuario'		=> $nombre . ' ' . $apellido,
					'telefono' 	=> $telefono,
					'correo'		=> $email,
				];
				$this->session->set_userdata($datosSession);

				$this->output->set_output(json_encode(['result' => 1, 'titulo' => 'Excelente!', 'msj' => 'Perfil actualizado.', 'url' => base_url('admin')]));
				return;
			} else {
				$this->output->set_output(json_encode(['result' => 2, 'titulo' => 'Ooops.. error!', 'errores' => ['No se pudo actualizar el perfil de usuario. Intente más tarde!']]));
				return;
			}
		}
		$this->output->set_output(json_encode(['result' => 3, 'titulo' => 'Ooops.. controle!', 'errores' => $this->form_validation->error_array()]));
		return;
	} // fin de metodo editar
}
