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
		$this->load->view('admin/balance/index', $data);
	}

	//--------------------------------------------------------------
	public function getBalance($estado)
	{
		verificarConsulAjax();

		if ($estado == 'productos-mas-vendidos') {
			$data['productos'] = $this->Productos->productos_mas_vendidos();
			$this->load->view('admin/balance/_tblProductosMasVendidos', $data);
		}
	}
}
