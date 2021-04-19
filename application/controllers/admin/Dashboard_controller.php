<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard_controller extends CI_Controller
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
		$data['title'] = 'Inicio';
		$data['act'] = '0D';
		$data['desplegado'] = '';
		$data['total_productos'] = $this->Productos->total_productos();
		$data['total_mensajes'] = $this->Mensajes->total_mensajes();
		$data['total_ventas'] = $this->Ventas->total_ventas();
		$data['total_clientes'] = $this->Usuarios->total_clientes();
		$data['ult_ventas'] = $this->Ventas->ult_ventas();
		$data['ult_productos'] = $this->Productos->ult_productos();
		$data['prods_mas_vendidos'] = $this->Productos->productos_mas_vendidos_con_foto();
		$this->load->view('admin/dashboard/index', $data);
	}

	//--------------------------------------------------------------
	public function notificaciones()
	{
		verificarConsulAjax();
		// $msjs_ult_tres = $this->Mensajes->get_mensajes_ult_tres();
		$msj_no_leidos = $this->Mensajes->get_mensajes_no_leidos();
		$nuevas_ventas = $this->Ventas->nuevas_ventas();

		$this->output->set_output(json_encode(['result' => 1, 'msj_no_leidos' => $msj_no_leidos, 'nuevas_ventas' => $nuevas_ventas]));
		return;
	}

	//--------------------------------------------------------------
	public function ultimos_msjs()
	{
		verificarConsulAjax();

		$data['msjs_ult_tres'] = $this->Mensajes->get_mensajes_ult_tres();

		$this->load->view('admin/components/_mensajes', $data);
	}

	//--------------------------------------------------------------
	public function graficoVentas()
	{
		$resp = $this->Ventas->grafico_ventas();

		if ($resp) {
			foreach ($resp as $k) {
				$periodos[] = strftime("%b '%y", strtotime($k->Periodo));
				$totales[] = $k->Total;
			}
			$this->output->set_output(json_encode(['result' => 1, 'periodos' => $periodos, 'totales' => $totales]));
			return;
		} else {
			$this->output->set_output(json_encode(['result' => 2, 'titulo' => 'Ooops.. error!', 'errores' => ['No se pudo crear el grafico de ventas. Intente más tarde!']]));
			return;
		}
	}
}
