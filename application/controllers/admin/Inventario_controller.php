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
		$data['act'] = '6Inv';
		$data['act_desplegado'] = '';
		$data['item_desplegado'] = '';
		$data['inventario'] = $this->Productos->get_inventario();
		$this->load->view('admin/inventario/index', $data);
	}
}
