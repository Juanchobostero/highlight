<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Inventario_controller extends CI_Controller
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
		$data['title'] = 'Inventario';
		$data['act'] = '8Inv';
		$data['desplegado'] = '';
		$data['inventario'] = $this->Productos->get_inventario();
		$this->load->view('admin/inventario/index', $data);
	}
}
