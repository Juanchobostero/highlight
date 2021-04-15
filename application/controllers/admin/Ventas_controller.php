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
	public function confirmar($id_venta)
	{
		verificarConsulAjax();

		$venta['fechaConfirmado'] = date('Y-m-d H:i:s');
		$venta['estadoVENT'] = 2;

		$resp = $this->Ventas->actualizar($id_venta, $venta);

		if ($resp) {
			$this->output->set_output(json_encode(['result' => 1, 'titulo' => 'Excelente!', 'msj' => 'Venta N°' . $id_venta . ' confirmada']));
			return;
		}
		$this->output->set_output(json_encode(['result' => 2, 'titulo' => 'Ooops.. error!', 'errores' => ['No se pudo cancelar la venta. Intente más tarde!']]));
		return;
	}

	//--------------------------------------------------------------
	public function cancelar($id_venta)
	{
		verificarConsulAjax();

		$venta['fechaCancelado'] = date('Y-m-d H:i:s');
		$venta['estadoVENT'] = 4;

		$resp = $this->Ventas->actualizar($id_venta, $venta);

		// $detalleVenta = $this->Ventas_detalle->get_detalle_venta($id_venta);

		// foreach ($detalleVenta as $item) {
		// 	$this->Productos->devolverStock($item->id_producto, $item->cantidadVENT);
		// }

		if ($resp) {
			$this->output->set_output(json_encode(['result' => 1, 'titulo' => 'Excelente!', 'msj' => 'Venta N°' . $id_venta . ' cancelada']));
			return;
		}
		$this->output->set_output(json_encode(['result' => 2, 'titulo' => 'Ooops.. error!', 'errores' => ['No se pudo cancelar la venta. Intente más tarde!']]));
		return;
	}
}
