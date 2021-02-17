<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Ventas_controller extends CI_Controller
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
		$data['title'] = 'Ventas';
		$data['act'] = '6Vent';
		$data['desplegado'] = '';
		$data['msjs_ult_tres'] = $this->Mensajes->get_mensajes_ult_tres();
		$data['msj_no_leidos'] = $this->Mensajes->get_mensajes_no_leidos();
		$this->load->view('admin/ventas/index', $data);
	}

	//--------------------------------------------------------------
	public function getVentas($estado)
	{
		// verificarConsulAjax();

		switch ($estado) {
			case 'nuevas':
				$data['nuevas'] = '';//$this->Categorias->get_categorias();
				$this->load->view('admin/ventas/_tblNuevas', $data);
				break;
			case 'confirmadas':
				$data['subcategorias'] = $this->Subcategorias->get_subcategorias();
				$this->load->view('admin/ventas/_tblConfirmadas', $data);
				break;
			case 'entregadas':
				$data['subcategorias'] = $this->Subcategorias->get_subcategorias();
				$this->load->view('admin/ventas/_tblEntregadas', $data);
				break;
			case 'canceladas':
				$data['subcategorias'] = $this->Subcategorias->get_subcategorias();
				$this->load->view('admin/ventas/_tblCanceladas', $data);
				break;
		}
	}
}
