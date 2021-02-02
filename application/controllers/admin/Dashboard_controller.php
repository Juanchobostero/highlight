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
		$data['desplegado'] = '';
		$data['msjs_ult_tres'] = $this->Mensajes->get_mensajes_ult_tres();
		$data['msj_no_leidos'] = $this->Mensajes->get_mensajes_no_leidos();
		$data['tot_clients'] = $this->Usuarios->total_clientes();
		$this->load->view('admin/index', $data);
	}
}
