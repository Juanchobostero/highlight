<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard_controller extends CI_Controller
{
	//--------------------------------------------------------------
	public function __construct()
	{
		parent::__construct();
		if (!isset($_SESSION['id'])) {
			show_404();
		}
	}

	//--------------------------------------------------------------
	public function index()
	{
		$data['title'] = 'Inicio';
		$data['act'] = '0D';
		$data['act_desplegado'] = '';
		$data['item_desplegado'] = '';
		$data['tot_clients'] = $this->Usuarios->total_clientes();
		$this->load->view('admin/index', $data);
	}
}
