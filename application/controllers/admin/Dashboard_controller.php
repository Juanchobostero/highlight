<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard_controller extends CI_Controller
{
	//--------------------------------------------------------------
	public function __construct()
	{
		parent::__construct();
		verificarSesionAdmin();
		// if (!isset($_SESSION['id'])) {
		// 	show_404();
		// }
	}

	//--------------------------------------------------------------
	public function index()
	{
		$data['title'] = 'Inicio';
		$data['act'] = '0D';
		$data['desplegado'] = '';
		$data['msjs_ult_tres'] = $this->Mensajes->get_mensajes_ult_tres();
		$data['msj_no_leidos'] = $this->Mensajes->get_mensajes_no_leidos();
		$data['total_productos'] = $this->Productos->total_productos();
		$data['total_ventas'] = $this->Ventas->total_ventas();
		$data['total_clientes'] = $this->Usuarios->total_clientes();
		$data['ult_ventas'] = $this->Ventas->ult_ventas();
		$data['ult_productos'] = $this->Productos->ult_productos();
		$this->load->view('admin/dashboard/index', $data);
	}
}
