<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Institucional_controller extends CI_Controller
{

	//--------------------------------------------------------------
	public function __construct()
	{
		parent::__construct();
		verificarSesionAdmin();
	}

	//--------------------------------------------------------------
	public function nosotros()
	{
		$data['title'] = 'Nosotros';
		$data['act'] = '0_1Nos';
		$data['desplegado'] = 'ins';
		$data['msjs_ult_tres'] = $this->Mensajes->get_mensajes_ult_tres();
		$data['msj_no_leidos'] = $this->Mensajes->get_mensajes_no_leidos();
		$data['institucional'] = $this->Institucional->get_institucional(1);
		$this->load->view('admin/institucional/index', $data);
	}
	//--------------------------------------------------------------
	public function terminos()
	{
		$data['title'] = 'Términos y condiciones';
		$data['act'] = '0_2Ter';
		$data['desplegado'] = 'ins';
		$data['msjs_ult_tres'] = $this->Mensajes->get_mensajes_ult_tres();
		$data['msj_no_leidos'] = $this->Mensajes->get_mensajes_no_leidos();
		$data['institucional'] = $this->Institucional->get_institucional(2);
		$this->load->view('admin/institucional/index', $data);
	}
	//--------------------------------------------------------------
	public function politica()
	{
		$data['title'] = 'Política de Privacidad';
		$data['act'] = '0_3Pri';
		$data['desplegado'] = 'ins';
		$data['msjs_ult_tres'] = $this->Mensajes->get_mensajes_ult_tres();
		$data['msj_no_leidos'] = $this->Mensajes->get_mensajes_no_leidos();
		$data['institucional'] = $this->Institucional->get_institucional(3);
		$this->load->view('admin/institucional/index', $data);
	}

	//--------------------------------------------------------------
	public function editar($id_institucional)
	{
		// verificarConsulAjax();

		// Reglas
		$this->form_validation->set_rules('descripcion', 'Descripción', 'required|trim');

		if ($this->form_validation->run()) : //Si la validación es correcta
			switch ($id_institucional) {
				case '1':
					$nombreIns = 'Nosotros';
					$nombreRuta = 'nosotros';
					break;
				case '2':
					$nombreIns = 'Términos y condiciones';
					$nombreRuta = 'terminos-y-condiciones';
					break;
				case '3':
					$nombreIns = 'Política de privacidad';
					$nombreRuta = 'politica-de-privacidad';
					break;
			}

			$institucional = [
				'descripcion'		=> $this->input->post('descripcion'),
				'fecha_update' 	=> date('Y-m-d H:i:s')
			];

			$resp = $this->Institucional->actualizar($id_institucional, $institucional); // se hace un update en bd

			if ($resp) {
				$this->output->set_output(json_encode(['result' => 1, 'titulo' => 'Excelente!', 'msj' => $nombreIns . ' actualizada con éxito.', 'url' => base_url('admin/' . $nombreRuta)]));
				return;
			} else {
				$this->output->set_output(json_encode(['result' => 2, 'titulo' => 'Ooops.. error!', 'errores' => ['No se pudo actualizar ' . $nombreIns . '. Intente más tarde!']]));
				return;
			}
		endif;

		$this->output->set_output(json_encode(['result' => 3, 'titulo' => 'Ooops.. controle!', 'errores' => $this->form_validation->error_array()]));
		return;
	} // fin de metodo editar
}
