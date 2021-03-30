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
		verificarConsulAjax();

		switch ($estado) {
			case 'nuevas':
				$data['id_tabla'] = 'tblnuevas';
				$data['ventas'] = $this->Ventas->get_ventas(1);
				break;
			case 'confirmadas':
				$data['id_tabla'] = 'tblconfirmadas';
				$data['ventas'] = $this->Ventas->get_ventas(2);
				break;
			case 'entregadas':
				$data['id_tabla'] = 'tblentregadas';
				$data['ventas'] = $this->Ventas->get_ventas(3);
				break;
			case 'canceladas':
				$data['id_tabla'] = 'tblcanceladas';
				$data['ventas'] = $this->Ventas->get_ventas(4);
				break;
		}

		$this->load->view('admin/ventas/_tblVentas', $data);
	}

	//--------------------------------------------------------------
	public function frmVer($id_venta)
	{
		verificarConsulAjax();

		$venta = $this->Ventas->get_venta($id_venta);
		$venta->detalle = $this->Ventas_detalle->get_detalle_venta($id_venta);
		$this->load->view('admin/ventas/frmVerVenta', ['venta' => $venta]);
	}

	//--------------------------------------------------------------
	public function cancelar($id_venta)
	{
		$venta['fechaCancelado'] = date('Y-m-d H:i:s');
		$venta['estadoVENT'] = 4;

		$resp = $this->Ventas->actualizar($id_venta, $venta);

		$detalleVenta = $this->Ventas_detalle->get_detalle_venta($id_venta);

		foreach ($detalleVenta as $item) {
			$this->Productos->devolverStock($item->id_producto, $item->cantidadVENT);
		}
	}
}
