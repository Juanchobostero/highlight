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
		$data['act'] = '4Port';
		$data['desplegado'] = '';
		$data['msjs_ult_tres'] = $this->Mensajes->get_mensajes_ult_tres();
		$data['msj_no_leidos'] = $this->Mensajes->get_mensajes_no_leidos();
		$this->load->view('admin/portadas/index', $data);
	}

	//--------------------------------------------------------------
	public function getPortadas($estado)
	{
		verificarConsulAjax();

		switch ($estado) {
			case 'publicadas':
				$data['portadas'] = $this->Portadas->get_portadas(1, 1);
				$data['id_tabla'] = 'tblpublicadas';
				break;
			case 'no-publicadas':
				$data['portadas'] = $this->Portadas->get_portadas(1, 2);
				$data['id_tabla'] = 'tblno-publicadas';
				break;
		}
		$this->load->view('admin/portadas/_tblPortadas', $data);
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

		$data['portada'] = $this->Portadas->get_portada($id);
		$this->load->view('admin/portadas/frmEditarPortada', $data);
	}

	//--------------------------------------------------------------
	public function crear()
	{
		verificarConsulAjax();

		$this->form_validation->set_rules('titulo', 'Título', 'required|trim');

		if ($this->form_validation->run()) :
			if ($this->input->post('publicar')) {
				$publicado = 1; // SI
				$tab = 'publicadas';
			} else {
				$publicado = 2; // NO
				$tab = 'no-publicadas';
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
				$this->output->set_output(json_encode(['result' => 2, 'titulo' => 'Ooops.. error!', 'errores' => ['No se pudo crear la portada. Intente más tarde!']]));
				return;
			}
		endif;

		$this->output->set_output(json_encode(['result' => 3, 'titulo' => 'Ooops.. controle!', 'errores' => $this->form_validation->error_array()]));
		return;
	} // fin de metodo crear

	//--------------------------------------------------------------
	public function editar($id)
	{
		verificarConsulAjax();

		$this->form_validation->set_rules('titulo', 'Título', 'required|trim');

		if ($this->form_validation->run()) :
			if ($this->input->post('publicar')) {
				$publicado = 1; // SI
				$tab = 'publicadas';
			} else {
				$publicado = 2; // NO
				$tab = 'no-publicadas';
			}

			$port = [
				'titulo' 		=> $this->input->post('titulo'),
				'publicado' => $publicado
			];

			if (!empty($_FILES['file']['name'])) {
				$port['imagen'] = subirImagen('file', 'portadas', 'no-portada.png');
			}

			$resp = $this->Portadas->actualizar($id, $port); // se hace un update en bd

			if ($resp) {
				$this->output->set_output(json_encode(['result' => 1, 'titulo' => 'Excelente!', 'msj' => 'Portada actualizada con éxito.', 'tabs' => 'portadas', 'tab' => $tab]));
				return;
			} else {
				$this->output->set_output(json_encode(['result' => 2, 'titulo' => 'Ooops.. error!', 'errores' => ['No se pudo actualizar la portada. Intente más tarde!']]));
				return;
			}
		endif;

		$this->output->set_output(json_encode(['result' => 3, 'titulo' => 'Ooops.. controle!', 'errores' => $this->form_validation->error_array()]));
		return;
	} // fin de metodo editar

	//--------------------------------------------------------------
	public function publicar()
	{
		verificarConsulAjax();

		if ($this->input->post('prom') == 'true') {
			$prom = 1; // SI
			$msj = 'publicada';
		} else {
			$prom = 2; // NO
			$msj = 'NO publicada';
		}

		$resp  = $this->Portadas->actualizar($this->input->post('id'), ['publicado' => $prom]);

		if ($resp) {
			$this->output->set_output(json_encode(['result' => 1, 'titulo' => 'Excelente!', 'msj' => 'Portada ' . $msj]));
			return;
		}
		$this->output->set_output(json_encode(['result' => 2, 'titulo' => 'Ooops.. error!', 'errores' => ['No se pudo llevar a cabo la operación. Intente más tarde!']]));
		return;
	}

	//--------------------------------------------------------------
	public function eliminar($id_portada)
	{
		verificarConsulAjax();

		$resp  = $this->Portadas->actualizar($id_portada, ['estado' => 0]);

		if ($resp) {
			$this->output->set_output(json_encode(['result' => 1, 'titulo' => 'Excelente!', 'msj' => 'Portada eliminada!']));
			return;
		}
		$this->output->set_output(json_encode(['result' => 2, 'titulo' => 'Ooops.. error!', 'errores' => ['No se pudo eliminar la portada. Intente más tarde!']]));
		return;
	}
}
