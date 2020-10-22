<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Portadas_controller extends CI_Controller
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
		$data['title'] = 'Portadas';
		$data['act'] = '2Port';
		$this->load->view('admin/portadas/index', $data);
	}

	//--------------------------------------------------------------
	public function getPortadas($estado)
	{
		verificarConsulAjax();

		switch ($estado) {
			case 'activas':
				$portadas = $this->Portadas->getPortadas(1, 1);
				$this->load->view('admin/portadas/_tblPortadasActivas', ['portadas' => $portadas]);
				break;
			case 'todas':
				$portadas = $this->Portadas->getPortadas(1);
				$this->load->view('admin/portadas/_tblPortadasTodas', ['portadas' => $portadas]);
				break;
			case 'eliminadas':
				$portadas = $this->Portadas->getPortadas(0);
				$this->load->view('admin/portadas/_tblPortadasEliminadas', ['portadas' => $portadas]);
				break;
		}
	}

	//--------------------------------------------------------------
	public function frmNueva()
	{
		verificarConsulAjax();
		$this->load->view('admin/portadas/frmNuevaPortada');
	}

	//--------------------------------------------------------------
	public function frmEditar($id)
	{
		verificarConsulAjax();

		$portada = $this->Portadas->getPortada($id);
		$this->load->view('admin/portadas/frmEditarPortada', ['port' => $portada]);
	}

	//--------------------------------------------------------------
	public function crear()
	{
		verificarConsulAjax();

		$this->form_validation->set_rules('titulo', 'Título', 'required|trim');

		if ($this->form_validation->run()) :
			if ($this->input->post('publicar')) {
				$publicado = 1; // SI
				$tab = 'activas';
			} else {
				$publicado = 2; // NO
				$tab = 'todas';
			}

			$port = [
				'titulo' 		=> $this->input->post('titulo'),
				'imagen' 		=> subirImagen('file', 'portadas', 'no-portada.png'),
				'publicado' => $publicado,
				'estado'		=> 1
			];

			$resp = $this->Portadas->crear($port); // se inserta en bd

			if ($resp) {
				$this->output->set_output(json_encode(['result' => 1, 'titulo' => 'Excelente!', 'msj' => 'Portada creada con éxito.', 'tabs' => 'portadas', 'tab' => $tab]));
				return;
			} else {
				$this->output->set_output(json_encode(['result' => 2, 'titulo' => 'Ooops.. error!', 'msj' => 'Ha ocurrido un error al intentar crear una nueva portada.']));
				return;
			}
		endif;

		$this->output->set_output(json_encode(['result' => 3, 'titulo' => 'Ooops.. error!', 'errores' => $this->form_validation->error_array()]));
		return;
	} // fin de metodo altaPortada

	//--------------------------------------------------------------
	public function editar($id)
	{
		verificarConsulAjax();

		$this->form_validation->set_rules('titulo', 'Título', 'required|trim');

		if ($this->form_validation->run()) :
			if ($this->input->post('publicar')) {
				$publicado = 1; // SI
				$tab = 'activas';
			} else {
				$publicado = 2; // NO
				$tab = 'todas';
			}

			$port = [
				'titulo' 		=> $this->input->post('titulo'),
				'publicado' => $publicado
			];

			if (!empty($_FILES['file']['name'])) {
				$port['imagen'] = subirImagen('file', 'portadas', 'no-portada.png');
			}

			$resp = $this->Portadas->editar($id, $port); // se hace un update en bd

			if ($resp) {
				$this->output->set_output(json_encode(['result' => 1, 'titulo' => 'Excelente!', 'msj' => 'Portada actualizada con éxito.', 'tabs' => 'portadas', 'tab' => $tab]));
				return;
			} else {
				$this->output->set_output(json_encode(['result' => 2, 'titulo' => 'Ooops.. error!', 'msj' => 'Ha ocurrido un error al intentar crear una nueva portada.']));
				return;
			}
		endif;

		$this->output->set_output(json_encode(['result' => 3, 'titulo' => 'Ooops.. error!', 'errores' => $this->form_validation->error_array()]));
		return;
	} // fin de metodo editarPortada

	// ----------------------------------------------------------------------------------------------------
	public function habilitarDeshabilitar($id)
	{
		verificarConsulAjax();

		$estado = ($this->input->post('est') == 1) ? true : false;
		$msj = ($estado) ? 'habilitada' : 'deshabilitada';

		$resp  = $this->Portadas->editar($id, ['estado' => $estado]);

		if ($resp) {
			$this->output->set_output(json_encode(['result' => 1, 'titulo' => 'Excelente!', 'msj' => 'Portada ' . $msj . '!']));
			return;
		}
		$this->output->set_output(json_encode(['result' => 2, 'titulo' => 'Error', 'msj' => 'Intente más tarde.']));
		return;
	}

	// ----------------------------------------------------------------------------------------------------
	public function publicar()
	{
		verificarConsulAjax();

		if ($this->input->post('prom') == 'true') {
			$prom = 1; // SI
			$msj = 'publicada';
		} else {
			$prom = 2; // NO
			$msj = 'dejada de publicar';
		}

		$resp  = $this->Portadas->editar($this->input->post('id'), ['publicado' => $prom]);

		if ($resp) {
			$this->output->set_output(json_encode(['result' => 1, 'titulo' => 'Excelente!', 'msj' => 'Portada ' . $msj]));
			return;
		}
		$this->output->set_output(json_encode(['result' => 2, 'titulo' => 'Error', 'msj' => 'Intente más tarde.', 'est' => $prom]));
		return;
	}
}
