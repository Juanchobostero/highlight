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
			case 'enviados':
				$data['id_tabla'] = 'tblenviados';
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

		$this->load->view('admin/ventas/frmEnviar', ['idVenta' => $id_venta]);
	}

	//--------------------------------------------------------------
	public function enviarADestino($id_venta)
	{
		verificarConsulAjax();

		$this->form_validation->set_rules('nseguimiento', 'N° de seguimientp', 'required|trim');
		$this->form_validation->set_rules('empresa', 'Empresa', 'required|trim');
		$this->form_validation->set_rules('link', 'Link', 'required|trim');

		if ($this->form_validation->run()) :
			$nroSeguimiento = $this->input->post('nseguimiento');
			$empresa = $this->input->post('empresa');
			$link = $this->input->post('link');

			$venta['nroSeguimiento'] = $nroSeguimiento;
			$venta['empresa'] = $empresa;
			$venta['fechaConfirmado'] = date('Y-m-d H:i:s');
			$venta['estadoVENT'] = 2;

			$resp = $this->Ventas->actualizar($id_venta, $venta);

			if ($resp) {
				$venta = $this->Ventas->get_venta($id_venta); //obtiene datos de venta
				$cliente = $this->Usuarios->get_user($venta->id_us); // obtiene datos del cliente
				$envio_venta = [
					'de'      => APP_MAIL,
					'titulo'  => APP_NAME,
					'para'    => $cliente->emailU,
					'asunto'  => 'Envio de pedido N° ' . $id_venta,
					'mensaje' => "El pedido N° $id_venta ha sido enviado.<br><br> <b>Datos de envio para seguimiento</b><br>Empresa: $empresa <br>Nro Seguimiento: $nroSeguimiento <br>Enlace: $link"
				];
				// enviar_email($envio_venta);

				$this->output->set_output(json_encode(['result' => 1, 'titulo' => 'Excelente!', 'msj' => 'Venta N°' . $id_venta . ' enviada a destino', 'tabs' => 'ventas', 'tab' => 'nuevas']));
				return;
			} else {
				$this->output->set_output(json_encode(['result' => 2, 'titulo' => 'Ooops.. error!', 'errores' => ['No se pudo enviar la venta. Intente más tarde!']]));
				return;
			}
		endif;

		$this->output->set_output(json_encode(['result' => 3, 'titulo' => 'Ooops.. controle!', 'errores' => $this->form_validation->error_array()]));
		return;
	}

	//--------------------------------------------------------------
	public function envioASucursal($id_venta)
	{
		verificarConsulAjax();

		$venta['fechaConfirmado'] = date('Y-m-d H:i:s');
		$venta['estadoVENT'] = 2;

		$resp = $this->Ventas->actualizar($id_venta, $venta);

		if ($resp) {
			$venta = $this->Ventas->get_venta($id_venta);
			$cliente = $this->Usuarios->get_user($venta->id_us);
			$envio_venta = [
				'de'      => APP_MAIL,
				'titulo'  => APP_NAME,
				'para'    => $cliente->emailU,
				'asunto'  => 'Retiro de pedido N° ' . $id_venta,
				'mensaje' => 'El pedido N° ' . $id_venta . ' ya se encuetra en nuestra sucursal para ser retirado.'
			];

			// enviar_email($envio_venta);

			$this->output->set_output(json_encode(['result' => 1, 'titulo' => 'Excelente!', 'msj' => 'Venta N°' . $id_venta . ' enviado a sucursal']));
			return;
		}
		$this->output->set_output(json_encode(['result' => 2, 'titulo' => 'Ooops.. error!', 'errores' => ['No se pudo enviar la venta. Intente más tarde!']]));
		return;
	}

	//--------------------------------------------------------------
	public function entregar($id_venta)
	{
		verificarConsulAjax();

		$venta['fechaEntregado'] = date('Y-m-d H:i:s');
		$venta['estadoVENT'] = 3;

		$resp = $this->Ventas->actualizar($id_venta, $venta);

		if ($resp) {
			$venta = $this->Ventas->get_venta($id_venta);
			$cliente = $this->Usuarios->get_user($venta->id_us);
			$entregar_venta = [
				'de'      => APP_MAIL,
				'titulo'  => APP_NAME,
				'para'    => $cliente->emailU,
				'asunto'  => 'Entrega de pedido N° ' . $id_venta,
				'mensaje' => 'El pedido N° ' . $id_venta . ' ha sido entregado.'
			];

			// enviar_email($entregar_venta);

			$this->output->set_output(json_encode(['result' => 1, 'titulo' => 'Excelente!', 'msj' => 'Venta N°' . $id_venta . ' entregada']));
			return;
		}
		$this->output->set_output(json_encode(['result' => 2, 'titulo' => 'Ooops.. error!', 'errores' => ['No se pudo entregar la venta. Intente más tarde!']]));
		return;
	}

	//--------------------------------------------------------------
	public function cancelar($id_venta)
	{
		verificarConsulAjax();

		$venta['fechaCancelado'] = date('Y-m-d H:i:s');
		$venta['estadoVENT'] = 4;

		$resp = $this->Ventas->actualizar($id_venta, $venta);

		$detalleVenta = $this->Ventas_detalle->get_detalle_venta($id_venta);
		foreach ($detalleVenta as $item) {
			$this->Productos->devolverStock($item->id_product, $item->cantidadVENT);
		}

		if ($resp) {
			$venta = $this->Ventas->get_venta($id_venta);
			$cliente = $this->Usuarios->get_user($venta->id_us);
			$cancel_venta = [
				'de'      => APP_MAIL,
				'titulo'  => APP_NAME,
				'para'    => $cliente->emailU,
				'asunto'  => 'Cancelación de pedido N° ' . $id_venta,
				'mensaje' => 'El pedido N° ' . $id_venta . ' ha sido cancelado.'
			];

			// enviar_email($cancel_venta);

			$this->output->set_output(json_encode(['result' => 1, 'titulo' => 'Excelente!', 'msj' => 'Venta N°' . $id_venta . ' cancelada']));
			return;
		}
		$this->output->set_output(json_encode(['result' => 2, 'titulo' => 'Ooops.. error!', 'errores' => ['No se pudo cancelar la venta. Intente más tarde!']]));
		return;
	}
}
