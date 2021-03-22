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
		$data['act'] = '5_5Ofer';
		$data['desplegado'] = 'prod';
		$data['msjs_ult_tres'] = $this->Mensajes->get_mensajes_ult_tres();
		$data['msj_no_leidos'] = $this->Mensajes->get_mensajes_no_leidos();
		$this->load->view('admin/productos_ofertas/index', $data);
	}

	//--------------------------------------------------------------
	public function getOfertas($estado)
	{
		verificarConsulAjax();

		switch ($estado) {
			case 'individuales':
				$data['ofertas_individuales'] = $this->Productos_ofertas->get_ofertas_individuales();
				$this->load->view('admin/productos_ofertas/_tblOfertasIndividuales', $data);
				break;
			case 'subcategorias':
				$data['ofertas_subcategorias'] = $this->Productos_ofertas->get_ofertas_por_subcategorias();
				$this->load->view('admin/productos_ofertas/_tblOfertasPorSubcategorias', $data);
				break;
		}
	}

	//--------------------------------------------------------------
	public function getProducto($id_producto)
	{
		verificarConsulAjax();

		$data['estado_producto'] = $this->Productos_ofertas->get_oferta_producto($id_producto) ? 1 : 0;
		$data['producto'] = $this->Productos->get_producto($id_producto);

		if ($data['estado_producto'] == 0) {
			$data['estado_producto'] = $this->Productos_ofertas->get_oferta_subcategoria($data['producto']->id_subcat) ? 2 : 0;
		}

		$this->load->view('admin/productos_ofertas/_detalleProducto', $data);
	}

	//--------------------------------------------------------------
	public function getSubcategoria($id_subcategoria)
	{
		verificarConsulAjax();

		$data['estado_subcategoria'] = $this->Productos_ofertas->get_oferta_subcategoria($id_subcategoria) ? true : false;
		$data['subcategoria'] = $this->Subcategorias->get_subcategoria($id_subcategoria);
		$data['productos_en_oferta'] = $this->Productos_ofertas->num_ofertas_individuales_por_subcategoria($id_subcategoria);
		$data['total_productos'] = $this->Productos->total_productos_por_subcategoria($id_subcategoria);
		$this->load->view('admin/productos_ofertas/_detalleSubcategoria', $data);
	}

	//--------------------------------------------------------------
	public function frmNuevaIndividual()
	{
		verificarConsulAjax();

		$data['productos'] = $this->Productos->get_productos();
		$this->load->view('admin/productos_ofertas/frmNuevaOfertaIndividual', $data);
	}

	//--------------------------------------------------------------
	public function frmNuevaPorSubcategoria()
	{
		verificarConsulAjax();

		$data['subcategorias'] = $this->Subcategorias->get_subcategorias();
		$this->load->view('admin/productos_ofertas/frmNuevaOfertaPorSubcategoria', $data);
	}

	//--------------------------------------------------------------
	public function frmEditarIndividual($id_oferta)
	{
		verificarConsulAjax();

		$data['oferta_ind'] = $this->Productos_ofertas->get_oferta_individual($id_oferta);
		$this->load->view('admin/productos_ofertas/frmEditarOfertaIndividual', $data);
	}

	//--------------------------------------------------------------
	public function frmEditarPorSubcategoria($id_oferta)
	{
		verificarConsulAjax();

		$data['oferta_sub'] = $this->Productos_ofertas->get_oferta_por_subcategoria($id_oferta);
		$data['oferta_sub']->total_productos = $this->Productos->total_productos_por_subcategoria($data['oferta_sub']->id_subcat);
		$this->load->view('admin/productos_ofertas/frmEditarOfertaPorSubcategoria', $data);
	}

	//--------------------------------------------------------------
	public function crearIndividual()
	{
		verificarConsulAjax();

		// Reglas
		$this->form_validation->set_rules('producto_id', 'Producto', 'required|trim');
		$this->form_validation->set_rules('porcentaje', 'Porcentaje', 'required|trim|greater_than[0]|less_than_equal_to[100]');
		$this->form_validation->set_rules('pOferta', 'Precio de Oferta', 'required|trim');

		if ($this->form_validation->run()) :
			$oferta = [
				'id_produc' 		=> $this->input->post('producto_id'),
				'porcentaje'		=> $this->input->post('porcentaje'),
				'fecha_inicio'	=> date('Y-m-d'),
				'estado_oferta' => 1
			];

			$resp = $this->Productos_ofertas->crear($oferta); // se inserta en bd

			if ($resp) {
				$this->output->set_output(json_encode(['result' => 1, 'titulo' => 'Excelente!', 'msj' => 'Oferta individual creada con éxito.', 'tabs' => 'ofertas', 'tab' => 'individuales']));
				return;
			} else {
				$this->output->set_output(json_encode(['result' => 2, 'titulo' => 'Ooops.. error!', 'errores' => ['No se pudo crear la oferta individual. Intente más tarde!']]));
				return;
			}
		endif;

		$this->output->set_output(json_encode(['result' => 3, 'titulo' => 'Ooops.. controle!', 'errores' => $this->form_validation->error_array()]));
		return;
	}

	//--------------------------------------------------------------
	public function crearPorSubcategoria()
	{
		verificarConsulAjax();

		// Reglas
		$this->form_validation->set_rules('subcategoria_id', 'Subcategoría', 'required|trim');
		$this->form_validation->set_rules('porcentaje', 'Porcentaje', 'required|trim|greater_than[0]|less_than_equal_to[100]');
		$this->form_validation->set_rules('fecha_inicio', 'Fecha de inicio', 'required|trim');

		if ($this->form_validation->run()) :
			$id_subcategoria = $this->input->post('subcategoria_id');
			$oferta = [
				'id_subcat' 		=> $id_subcategoria,
				'porcentaje'		=> $this->input->post('porcentaje'),
				'fecha_inicio'	=> $this->input->post('fecha_inicio'),
				'estado_oferta' => 1
			];

			if ($this->input->post('fecha_fin')) {
				$oferta['fecha_fin'] = $this->input->post('fecha_fin');
			}

			$resp = $this->Productos_ofertas->crear($oferta); // se inserta en bd

			if ($resp) {
				$ofertasIndividuales = $this->Productos_ofertas->get_ofertas_individuales_por_subcategoria($id_subcategoria);
				foreach ($ofertasIndividuales as $ind) :
					// se dan de baja ofertas individuales que pertenence a la oferta por subcategoria creada 
					$this->Productos_ofertas->actualizar($ind->id_oferta, ['fecha_cancelado' => date('Y-m-d H:i:s'), 'estado_oferta' => 0]);
				endforeach;

				$this->output->set_output(json_encode(['result' => 1, 'titulo' => 'Excelente!', 'msj' => 'Oferta por subcategoría creada con éxito.', 'tabs' => 'ofertas', 'tab' => 'subcategorias']));
				return;
			} else {
				$this->output->set_output(json_encode(['result' => 2, 'titulo' => 'Ooops.. error!', 'errores' => ['No se pudo crear la oferta por subcategoría. Intente más tarde!']]));
				return;
			}
		endif;

		$this->output->set_output(json_encode(['result' => 3, 'titulo' => 'Ooops.. controle!', 'errores' => $this->form_validation->error_array()]));
		return;
	}

	//--------------------------------------------------------------
	public function editarIndividual($id_oferta)
	{
		verificarConsulAjax();

		// Reglas
		$this->form_validation->set_rules('porcentaje', 'Porcentaje', 'required|trim|greater_than[0]|less_than_equal_to[100]');
		$this->form_validation->set_rules('pOferta', 'Precio de Oferta', 'required|trim');

		if ($this->form_validation->run()) :
			$oferta = [
				'porcentaje'	=> $this->input->post('porcentaje')
			];

			$resp = $this->Productos_ofertas->actualizar($id_oferta, $oferta); // se actualiza bd

			if ($resp) {
				$this->output->set_output(json_encode(['result' => 1, 'titulo' => 'Excelente!', 'msj' => 'Oferta individual actualizada.', 'tabs' => 'ofertas', 'tab' => 'individuales']));
				return;
			} else {
				$this->output->set_output(json_encode(['result' => 2, 'titulo' => 'Ooops.. error!', 'errores' => ['No se pudo actualizar la oferta individual. Intente más tarde!']]));
				return;
			}
		endif;

		$this->output->set_output(json_encode(['result' => 3, 'titulo' => 'Ooops.. controle!', 'errores' => $this->form_validation->error_array()]));
		return;
	}

	//--------------------------------------------------------------
	public function editarPorSubcategoria($id_oferta)
	{
		verificarConsulAjax();

		// Reglas
		$this->form_validation->set_rules('porcentaje', 'Porcentaje', 'required|trim|greater_than[0]|less_than_equal_to[100]');
		$this->form_validation->set_rules('fecha_inicio', 'Fecha de inicio', 'required|trim');

		if ($this->form_validation->run()) :
			$oferta = [
				'porcentaje'		=> $this->input->post('porcentaje'),
				'fecha_inicio'	=> $this->input->post('fecha_inicio'),
				'fecha_fin'			=> ($this->input->post('fecha_fin')) ? $this->input->post('fecha_fin') : null
			];

			$resp = $this->Productos_ofertas->actualizar($id_oferta, $oferta); // se actualiza bd

			if ($resp) {
				$this->output->set_output(json_encode(['result' => 1, 'titulo' => 'Excelente!', 'msj' => 'Oferta por subcategoría actualizada.', 'tabs' => 'ofertas', 'tab' => 'subcategorias']));
				return;
			} else {
				$this->output->set_output(json_encode(['result' => 2, 'titulo' => 'Ooops.. error!', 'errores' => ['No se pudo actualizar la oferta por subcategoría. Intente más tarde!']]));
				return;
			}
		endif;

		$this->output->set_output(json_encode(['result' => 3, 'titulo' => 'Ooops.. controle!', 'errores' => $this->form_validation->error_array()]));
		return;
	}

	//--------------------------------------------------------------
	public function eliminar($id_oferta)
	{
		verificarConsulAjax();

		$resp  = $this->Productos_ofertas->actualizar($id_oferta, ['fecha_cancelado' => date('Y-m-d H:i:s'), 'estado_oferta' => 0]);

		if ($resp) {
			$this->output->set_output(json_encode(['result' => 1, 'titulo' => 'Excelente!', 'msj' => 'Oferta eliminada!']));
			return;
		}
		$this->output->set_output(json_encode(['result' => 2, 'titulo' => 'Ooops.. error!', 'errores' => ['No se pudo eliminar la oferta. Intente más tarde!']]));
		return;
	}
}
