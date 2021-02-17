<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Balance_controller extends CI_Controller
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
		$data['title'] = 'Balance';
		$data['act'] = '10Bal';
		$data['desplegado'] = '';
		$data['msjs_ult_tres'] = $this->Mensajes->get_mensajes_ult_tres();
		$data['msj_no_leidos'] = $this->Mensajes->get_mensajes_no_leidos();
		// $data['inventario'] = $this->Productos->get_inventario();
		$this->load->view('admin/balance/index', $data);
	}

	// //--------------------------------------------------------------
	// public function getBalance($estado)
	// {
	// 	verificarConsulAjax();

	// 	if ($estado == 'productos-mas-vendidos') {
	// 		$data['productos'] = $this->Productos->get_inventario_bajo_stock();
	// 		$this->load->view('admin/inventario/_tblProductosBajoStock', $data);
	// 	}
	// }
}
