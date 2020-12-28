<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Productos_ofertas_controller extends CI_Controller
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
		$data['title'] = 'Ofertas';
		$data['act'] = '5_4Ofer';
		$data['act_desplegado'] = 'active';
		$data['item_desplegado'] = 'menu-is-opening menu-open';
		// $data['productos_destacados'] = $this->Productos->get_productos_destacados();
		$this->load->view('admin/productos_ofertas/index', $data);
	}

	//--------------------------------------------------------------
	public function frmNueva()
	{
		verificarConsulAjax();

		// $data['marcas'] = $this->Marcas->get_marcas();
		// $data['categorias'] = $this->Categorias->get_categorias();
		$this->load->view('admin/productos_ofertas/frmNuevaOferta');
	}
}
