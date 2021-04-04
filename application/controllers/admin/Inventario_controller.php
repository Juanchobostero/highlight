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
		$data['act'] = '9Inv';
		$data['desplegado'] = '';
		$data['inventario'] = $this->Productos->get_inventario();
		$this->load->view('admin/inventario/index', $data);
	}

	//--------------------------------------------------------------
	public function getInventario($estado)
	{
		verificarConsulAjax();

		if ($estado == 'productos-bajo-stock') {
			$data['productos'] = $this->Productos->get_inventario_bajo_stock();
			$this->load->view('admin/inventario/_tblProductosBajoStock', $data);
		}
	}

	//--------------------------------------------------------------
	public function frmVer($id_producto)
	{
		verificarConsulAjax();
		
		$data['producto'] = $this->Productos->get_producto($id_producto);
		$data['fotos'] = $this->Productos_fotos->get_producto_fotos($id_producto);
		$this->load->view('admin/productos/frmVerProducto', $data);
	}
}
