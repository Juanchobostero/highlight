<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Productos_pausados_controller extends CI_Controller
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
		$data['title'] = 'Productos Pausados';
		$data['act'] = '5_3Paus';
		$data['desplegado'] = 'prod';
		$data['msjs_ult_tres'] = $this->Mensajes->get_mensajes_ult_tres();
		$data['msj_no_leidos'] = $this->Mensajes->get_mensajes_no_leidos();
		$data['productos_pausados'] = $this->Productos->get_productos_pausados();
		$this->load->view('admin/productos_pausados/index', $data);
	}

	//--------------------------------------------------------------
	public function quitarPausado($id_producto)
	{
		verificarConsulAjax();

		$resp  = $this->Productos->actualizar($id_producto, ['pausadoPR' => 2]);

		if ($resp) {
			$this->output->set_output(json_encode(['result' => 1, 'titulo' => 'Excelente!', 'msj' => 'Producto NO pausado']));
			return;
		}
		$this->output->set_output(json_encode(['result' => 2, 'titulo' => 'Ooops.. error!', 'errores' => ['No se pudo quitar el pausado al producto. Intente más tarde!']]));
		return;
	}
}
