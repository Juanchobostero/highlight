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
	} // fin metodo envioADestino

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
	} // fin metodo envioASucursal

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
	} // fin metodo entregar

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
	} // fin metodo cancelar

	//--------------------------------------------------------------
	public function PDFDetalleVenta($id_venta)
	{
		// Datos de la venta
		$venta = $this->Ventas->get_venta($id_venta);
		$venta->items = $this->Ventas_detalle->get_detalle_venta($id_venta);

		// Datos a imprimir
		$numVenta = '<b>Venta N°:</b> ' . $id_venta;
		$cliente = '<b>Cliente:</b> ' . $venta->apellidoU . ', ' . $venta->nombreU;
		$estadoPago = '<b>Estado del Pago:</b> ' . $venta->estadoPago;

		if ($venta->estadoVENT == 'Nuevo') :
			$fecha = '<b>Fecha:</b> ' . strftime("%d-%m-%Y", strtotime($venta->fechaEnvio));
		elseif ($venta->estadoVENT == 'Enviado') :
			$fecha = '<b>Fecha Enviado:</b> ' . strftime("%d-%m-%Y", strtotime($venta->fechaConfirmado));
		elseif ($venta->estadoVENT == 'Entregado') :
			$fecha = '<b>Fecha Entregado:</b> ' . strftime("%d-%m-%Y", strtotime($venta->fechaEntregado));
		else :
			$fecha = '<b>Fecha Cancelado:</b> ' . strftime("%d-%m-%Y", strtotime($venta->fechaCancelado));
		endif;

		$pdf = new Pdf();
		$pdf->encabezado('Venta N°' . $id_venta, 'Orden de venta');
		// Datos de la venta
		$pdf->celda(60, 6, $numVenta, 'L', FALSE, TRUE);
		$pdf->celda(60, 6, $fecha, 'C', FALSE, TRUE);
		$pdf->celda(60, 6, $estadoPago, 'R', FALSE, TRUE);
		$pdf->ln(); // salto de linea
		$pdf->celda(150, 8, $cliente, 'L', FALSE, TRUE);
		$pdf->ln(); // salto de linea

		$pdf->configHeaderTabla(); // letra, color etc para el encabezado de la tabla
		// ------ Cabecera Tabla Detalle de venta ------
		$pdf->celda(22, 10, 'Código', 'C', TRUE);
		$pdf->celda(68, 10, 'Producto', 'C', TRUE);
		$pdf->celda(25, 10, 'Cantidad', 'C', TRUE);
		$pdf->celda(30, 10, 'Precio Unitario', 'C', TRUE);
		$pdf->celda(35, 10, 'Subtotal', 'C', TRUE);
		$pdf->Ln();

		$pdf->configBodyTabla(); // letra, color etc para el cuerpo de la tabla
		$pdf->setBorderCelda(['B'	=> ['width'	=> 0.2]]); // linea de abajo
		// ------ Cuerpo Tabla Detalle de venta ------
		foreach ($venta->items as $item) :
			$pdf->celda(22, 10, $item->codigoPR, 'L');
			$pdf->celda(68, 10, $item->nombrePR, 'L');
			$pdf->celda(25, 10, number_format($item->cantidadVENT, 0), 'C');
			$pdf->celda(30, 10, '$' . number_format($item->precioVENT, 2, ',', '.'), 'R');
			$pdf->celda(35, 10, '$' . number_format($item->subtotalVENT, 2, ',', '.'), 'R');
			$pdf->Ln();
			if ($pdf->getY() >= 260) $pdf->AddPage();
		endforeach;

		$pdf->configFooterTabla(); // letra, color etc para el total
		$pdf->setBorderCelda(['T'	=> ['width'	=> 0.5]]); // linea superior
		// ------ Total a pagar ------
		$pdf->celda(145, 10, 'Total a pagar', 'R');
		$pdf->celda(35, 10, '$' . number_format($venta->totalVENT, 2, ',', '.'), 'R');
		$pdf->Ln();

		$pdf->Output("Highlight_VentaN$id_venta.pdf", 'I');
	}

	// public function PDFDetalleVenta($id_venta)
	// {
	// 	// Datos de la venta
	// 	$venta = $this->Ventas->get_venta($id_venta);
	// 	$venta->items = $this->Ventas_detalle->get_detalle_venta($id_venta);

	// 	// Datos a imprimir
	// 	$numVenta = '<b>Venta N°:</b> ' . $id_venta;
	// 	$cliente = '<b>Cliente:</b> ' . $venta->apellidoU . ', ' . $venta->nombreU;
	// 	$estadoPago = '<b>Estado del Pago:</b> ' . $venta->estadoPago;

	// 	if ($venta->estadoVENT == 'Nuevo') : 
	// 		$fecha = '<b>Fecha:</b> ' . strftime("%d-%m-%Y", strtotime($venta->fechaEnvio));
	// 	elseif ($venta->estadoVENT == 'Enviado') : 
	// 		$fecha = '<b>Fecha Enviado:</b> ' . strftime("%d-%m-%Y", strtotime($venta->fechaConfirmado));
	// 	elseif ($venta->estadoVENT == 'Entregado') : 
	// 		$fecha = '<b>Fecha Entregado:</b> ' . strftime("%d-%m-%Y", strtotime($venta->fechaEntregado));
	// 	else : 
	// 		$fecha = '<b>Fecha Cancelado:</b> ' . strftime("%d-%m-%Y", strtotime($venta->fechaCancelado));
	// 	endif;

	// 	require_once('./assets/TCPDF/config/tcpdf_config.php');
	// 	require_once('./assets/TCPDF/tcpdf.php');

	// 	$pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
	// 	$pdf->SetCreator(PDF_CREATOR);
	// 	$pdf->SetAuthor('HighLight');
	// 	$pdf->setPrintFooter(false);
	// 	$pdf->SetTitle('Venta N°' . $id_venta . ' | Highlight');
	// 	$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, "HighLight", 'Orden de compra');
	// 	$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
	// 	$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
	// 	$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
	// 	$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
	// 	$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
	// 	$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
	// 	$pdf->setFontSubsetting(true);
	// 	$pdf->SetFont(PDF_FONT_NAME_MAIN, '', 10, '', true);
	// 	$pdf->AddPage();

	// 	// Datos de la venta
	// 	$pdf->MultiCell(61, 6, $numVenta, 0, 'L', FALSE, 0, '', '', TRUE, 1, TRUE, TRUE, 0, 'M', TRUE);
	// 	$pdf->MultiCell(60, 6, $fecha, 0, 'C', FALSE, 0, '', '', TRUE, 1, TRUE, TRUE, 0, 'M', TRUE);
	// 	$pdf->MultiCell(61, 6, $estadoPago, 0, 'R', FALSE, 0, '', '', TRUE, 1, TRUE, TRUE, 0, 'M', TRUE);
	// 	$pdf->ln();
	// 	$pdf->MultiCell(150, 8, $cliente, 0, 'L', FALSE, 0, '', '', TRUE, 1, TRUE, TRUE, 0, 'M', TRUE);

	// 	$pdf->ln();

	// 	// ------ Config Cabecera Tabla ------
	// 	$pdf->setCellPaddings(0, 0, 0, 0);
	// 	$pdf->SetFillColor(52, 58, 64); // color de fondo
	// 	$pdf->SetTextColor(255, 255, 255); // color de letra
	// 	$pdf->SetFont(PDF_FONT_NAME_MAIN, '', 10, '', TRUE);
	// 	// ------ Cabecera Tabla Detalle de venta ------
	// 	$pdf->MultiCell(22, 10, 'Código', 0, 'C', 1, 0, '', '', TRUE, 0, FALSE, TRUE, 10, 'M');
	// 	$pdf->MultiCell(68, 10, 'Producto', 0, 'C', 1, 0, '', '', TRUE, 0, FALSE, TRUE, 10, 'M');
	// 	$pdf->MultiCell(25, 10, 'Cantidad', 0, 'C', 1, 0, '', '', TRUE, 0, FALSE, TRUE, 10, 'M');
	// 	$pdf->MultiCell(30, 10, 'Precio Unitario', 0, 'C', 1, 0, '', '', TRUE, 0, FALSE, TRUE, 10, 'M');
	// 	$pdf->MultiCell(37, 10, 'Subtotal', 0, 'C', 1, 0, '', '', TRUE, 0, FALSE, TRUE, 10, 'M');
	// 	$pdf->Ln();

	// 	// ------ Config Cuerpo Tabla ------
	// 	$pdf->SetTextColor(0, 0, 0); // color de letra
	// 	$pdf->SetFont(PDF_FONT_NAME_MAIN, '', 9, '', TRUE);
	// 	$bordeCuerpo = ['B'	=> ['width'	=> 0.2]]; // linea inferior

	// 	// ------ Cuerpo Tabla Detalle de venta ------
	// 	foreach ($venta->items as $item) :
	// 		// MultiCell(w, h, txt, border, align, fill, ln, x, y, reseth, stretch, ishtml, autopadding, maxh)
	// 		$pdf->MultiCell(25, 10, $item->codigoPR, $bordeCuerpo, 'L', FALSE, 0, '', '', TRUE, 1, FALSE, TRUE, 10,
	// 		'M', TRUE);
	// 		$pdf->MultiCell(65, 10, $item->nombrePR, $bordeCuerpo, 'L', FALSE, 0, '', '', TRUE, 1, FALSE, TRUE, 10,
	// 		'M', TRUE);
	// 		$pdf->MultiCell(25, 10, number_format($item->cantidadVENT, 0), $bordeCuerpo, 'C', FALSE, 0, '', '', TRUE, 1, FALSE, TRUE, 10, 'M', TRUE);
	// 		$pdf->MultiCell(30, 10, '$'.number_format($item->precioVENT, 2, ',', '.'), $bordeCuerpo, 'R', FALSE, 0, '', '', TRUE, 1, FALSE, TRUE, 10, 'M', TRUE);
	// 		$pdf->MultiCell(37, 10, '$'.number_format($item->subtotalVENT, 2, ',', '.'), $bordeCuerpo, 'R', FALSE, 0, '', '', TRUE, 1, FALSE, TRUE, 10, 'M', TRUE);
	// 		$pdf->Ln();

	// 		if($pdf->getY() >= 260) $pdf->AddPage();
	// 	endforeach;

	// 	// ------ Config Total Tabla ------
	//   $pdf->SetFont(PDF_FONT_NAME_MAIN, 'B', 10, '', TRUE);
	//   $bordeCuerpo = ['T'	=> ['width'	=> 0.5]]; // linea superior

	//   // ------ Total a pagar ------
	// 	$pdf->MultiCell(25, 10, '', $bordeCuerpo, 'L', FALSE, 0, '', '', TRUE, 1, FALSE, TRUE, 10, 'M', TRUE);
	// 	$pdf->MultiCell(65, 10,'', $bordeCuerpo, 'L', FALSE, 0, '', '', TRUE, 1, FALSE, TRUE, 10, 'M', TRUE);
	// 	$pdf->MultiCell(25, 10, '', $bordeCuerpo, 'C', FALSE, 0, '', '', TRUE, 1, FALSE, TRUE, 10, 'M', TRUE);
	// 	$pdf->MultiCell(30, 10, 'Total a pagar', $bordeCuerpo, 'R', FALSE, 0, '', '', TRUE, 1, FALSE, TRUE, 10,'M', TRUE);
	// 	$pdf->MultiCell(37, 10, '$'.number_format($venta->totalVENT, 2, ',', '.'), $bordeCuerpo, 'R', FALSE, 0, '', '', TRUE, 1, FALSE, TRUE, 10, 'M', TRUE);
	// 	$pdf->Ln();

	// 	$pdf->Output("Highlight_VentaN$id_venta.pdf", 'I'); // nombre para descargar pdf
	// }
}
