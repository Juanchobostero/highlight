<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mensajes_controller extends CI_Controller
{

	//--------------------------------------------------------------
	public function __construct()
	{
		parent::__construct();
		verificarSesionAdmin();
	}

	//--------------------------------------------------------------
	public function index()
	{
		$data['title'] = 'Mensajes';
		$data['act'] = '8Msj';
		$data['desplegado'] = '';
		$data['msjs_ult_tres'] = $this->Mensajes->get_mensajes_ult_tres();
		$data['msj_no_leidos'] = $this->Mensajes->get_mensajes_no_leidos();
		$data['lectura'] = false;
		$data['mensajes'] = $this->Mensajes->get_mensajes();
		$this->load->view('admin/mensajes/index', $data);
	}

	//--------------------------------------------------------------
	public function leerMensaje($id_mensaje)
	{
		$this->Mensajes->actualizar($id_mensaje, ['estado_mensaje' => 1]);
		$data['title'] = 'Lectura de mensaje';
		$data['act'] = '8Msj';
		$data['desplegado'] = '';
		$data['msjs_ult_tres'] = $this->Mensajes->get_mensajes_ult_tres();
		$data['msj_no_leidos'] = $this->Mensajes->get_mensajes_no_leidos();
		$data['lectura'] = true;
		$data['msj'] = $this->Mensajes->get_mensaje($id_mensaje);
		$this->load->view('admin/mensajes/leer-mensaje', $data);
	}

	//--------------------------------------------------------------
	public function enviarRespuesta()
	{
		verificarConsulAjax();

		$this->form_validation->set_rules('para', 'Para', 'required|trim|valid_email');
		$this->form_validation->set_rules('asunto', 'Asunto', 'required|trim');
		$this->form_validation->set_rules('mensaje', 'Mensaje', 'required|trim');

		if ($this->form_validation->run()) :
			$resp_msj = array(
				'de'      => 'prueba.softcre@gmail.com',
				'titulo'  => 'Highlight',
				'para'    => $this->input->post('para'),
				'asunto'  => $this->input->post('asunto'),
				'mensaje' => $this->input->post('mensaje')
			);

			if (enviar_email($resp_msj)) {
				$this->output->set_output(json_encode(['result' => 1, 'titulo' => 'Excelente!', 'msj' => 'Mensaje enviado con éxito.', 'url' => base_url('admin/mensajes')]));
				return;
			} else {
				$this->output->set_output(json_encode(['result' => 2, 'titulo' => 'Ooops.. error!', 'errores' => ['No se pudo enviar el mensaje. Intente más tarde!']]));
				return;
			}
		endif;

		$this->output->set_output(json_encode(['result' => 3, 'titulo' => 'Ooops.. controle!', 'errores' => $this->form_validation->error_array()]));
		return;
	} // fin de metodo enviarRespuesta
}
