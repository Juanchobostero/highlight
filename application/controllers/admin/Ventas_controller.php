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
	public function frmEnviar($id_venta)
	{
		verificarConsulAjax();

		// $venta = $this->Ventas->get_venta($id_venta);
		// $venta->detalle = $this->Ventas_detalle->get_detalle_venta($id_venta);
		// $this->load->view('admin/ventas/frmVerVenta', ['venta' => $venta]);
		$this->load->view('admin/ventas/frmEnviar');
	}

	//--------------------------------------------------------------
	public function confirmarEnvioDestino($id_venta)
	{
		verificarConsulAjax();

		$this->form_validation->set_rules('nseguimiento', 'N° de seguimientp', 'required|trim');
		$this->form_validation->set_rules('empresa', 'Empresa', 'required|trim');
		$this->form_validation->set_rules('link', 'Link', 'required|trim');

		if ($this->form_validation->run()) :
			$link = $this->input->post('link');

			$venta['nroSeguimiento'] = $this->input->post('nseguimiento');
			$venta['empresa'] = $this->input->post('empresa');
			$venta['fechaConfirmado'] = date('Y-m-d H:i:s');
			$venta['estadoVENT'] = 2;

			$resp = $this->Ventas->actualizar($id_venta, $venta);

			if ($resp) {
				$venta = $this->Ventas->get_venta($id_venta);
				$cliente = $this->Clientes->get_cliente($venta->id_client);
				$envio_venta = [
					'de'      => 'prueba.softcre@gmail.com',
					'titulo'  => 'Highlight',
					'para'    => $cliente->email,
					'asunto'  => 'Envio de pedido N° ' . $id_venta,
					'mensaje' => "El pedido N° $id_venta ha sido enviado.<br><br> <b>Datos de envio para seguimiento</b><br>Empresa: " . $venta['empresa'] . "<br>Nro Seguimiento: " . $venta['nroSeguimiento'] . "<br>Enlace: $link"
				];

				enviar_email($envio_venta);

				$this->output->set_output(json_encode(['result' => 1, 'titulo' => 'Excelente!', 'msj' => 'Venta N°' . $id_venta . ' enviada a destino
				
				']));
			} else {
				$this->output->set_output(json_encode(['result' => 2, 'titulo' => 'Ooops.. error!', 'errores' => ['No se pudo crear la categoría. Intente más tarde!']]));
				return;
			}
		endif;

		$this->output->set_output(json_encode(['result' => 3, 'titulo' => 'Ooops.. controle!', 'errores' => $this->form_validation->error_array()]));
		return;
	}

	//--------------------------------------------------------------
	public function confirmarEnvioSucursal($id_venta)
	{
		verificarConsulAjax();

		$venta['fechaConfirmado'] = date('Y-m-d H:i:s');
		$venta['estadoVENT'] = 2;

		$resp = $this->Ventas->actualizar($id_venta, $venta);

		if ($resp) {
			$venta = $this->Ventas->get_venta($id_venta);
			$cliente = $this->Clientes->get_cliente($venta->id_client);
			$cancel_venta = [
				'de'      => 'prueba.softcre@gmail.com',
				'titulo'  => 'Highlight',
				'para'    => $cliente->email,
				'asunto'  => 'Cancelación de pedido N° ' . $id_venta,
				'mensaje' => 'El pedido N° ' . $id_venta . ' ha sido cancelado.'
			];

			enviar_email($cancel_venta);

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
			$venta = $this->Ventas->get_venta($id_venta);
			$cliente = $this->Clientes->get_cliente($venta->id_client);
			$cancel_venta = [
				'de'      => 'prueba.softcre@gmail.com',
				'titulo'  => 'Highlight',
				'para'    => $cliente->email,
				'asunto'  => 'Cancelación de pedido N° ' . $id_venta,
				'mensaje' => 'El pedido N° ' . $id_venta . ' ha sido cancelado.'
			];

			enviar_email($cancel_venta);

			$this->output->set_output(json_encode(['result' => 1, 'titulo' => 'Excelente!', 'msj' => 'Venta N°' . $id_venta . ' cancelada']));
			return;
		}
		$this->output->set_output(json_encode(['result' => 2, 'titulo' => 'Ooops.. error!', 'errores' => ['No se pudo cancelar la venta. Intente más tarde!']]));
		return;
	}
}
