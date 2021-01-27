<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Imagenes_controller extends CI_Controller
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
		$data['title'] = 'Imágenes';
		$data['act'] = '3Img';
		$data['act_desplegado'] = '';
		$data['item_desplegado'] = '';
		$data['msjs_ult_tres'] = $this->Mensajes->get_mensajes_ult_tres();
		$data['msj_no_leidos'] = $this->Mensajes->get_mensajes_no_leidos();
		$data['imagenes'] = $this->Imagenes->get_imagenes();
		$this->load->view('admin/imagenes/index', $data);
	}

	//--------------------------------------------------------------
	public function editar($id_img)
	{
		verificarConsulAjax();
		
		// verifica si hay imagenes para subir
		if (empty($_FILES['file_1']['name']) && empty($_FILES['file_2']['name'])) {
			$this->output->set_output(json_encode(['result' => 1, 'titulo' => 'Excelente!', 'msj' => 'Imágenes actualizadas sin cambios.', 'url' => base_url('admin/imagenes')]));
			return;
		}

		$imagenes = $this->Imagenes->get_imagen($id_img);

		if (!empty($_FILES['file_1']['name'])) {
			$imgs['imagen_1'] = subirImagen('file_1', 'imagenes', '', 1);
			unlink('./' . $imagenes->imagen_1); // se elimina el archivo
		}
		if (!empty($_FILES['file_2']['name'])) {
			$imgs['imagen_2'] = subirImagen('file_2', 'imagenes', '', 2);
			unlink('./' . $imagenes->imagen_2); // se elimina el archivo
		}

		$resp = $this->Imagenes->actualizar($id_img, $imgs);

		if ($resp) {
			$this->output->set_output(json_encode(['result' => 1, 'titulo' => 'Excelente!', 'msj' => 'Imágenes actualizadas.', 'url' => base_url('admin/imagenes')]));
			return;
		} else {
			$this->output->set_output(json_encode(['result' => 2, 'titulo' => 'Ooops.. error!', 'errores' => ['No se pudo actualizar las imágenes. Intente más tarde!']]));
			return;
		}
	} // fin de metodo editar
}
