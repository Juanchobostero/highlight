<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Productos_destacados_controller extends CI_Controller
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
		$data['title'] = 'Productos Destacados';
		$data['act'] = '5_3Dest';
		$data['act_desplegado'] = 'active';
		$data['item_desplegado'] = 'menu-is-opening menu-open';
		$data['msjs_ult_tres'] = $this->Mensajes->get_mensajes_ult_tres();
		$data['msj_no_leidos'] = $this->Mensajes->get_mensajes_no_leidos();
		$data['productos_destacados'] = $this->Productos->get_productos_destacados();
		$this->load->view('admin/productos_destacados/index', $data);
	}

	//--------------------------------------------------------------
	public function quitarDestacado($id_producto)
	{
		verificarConsulAjax();

		$resp  = $this->Productos->actualizar($id_producto, ['destacadoPR' => 2]);

		if ($resp) {
			$this->output->set_output(json_encode(['result' => 1, 'titulo' => 'Excelente!', 'msj' => 'Producto NO destacado']));
			return;
		}
		$this->output->set_output(json_encode(['result' => 2, 'titulo' => 'Ooops.. error!', 'errores' => ['No se pudo quitar el destacado al producto. Intente más tarde!']]));
		return;
	}
}
