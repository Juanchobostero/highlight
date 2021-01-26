<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mensajes_controller extends CI_Controller
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
		$data['title'] = 'Mensajes';
		$data['act'] = '8Msj';
		$data['act_desplegado'] = '';
		$data['item_desplegado'] = '';
		$data['mensajes'] = $this->Mensajes->get_mensajes();
		$this->load->view('admin/mensajes/index', $data);
	}
}
