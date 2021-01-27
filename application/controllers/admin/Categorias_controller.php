<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Categorias_controller extends CI_Controller
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
		$data['title'] = 'Categorias y subcategorias';
		$data['act'] = '5_0Cat';
		$data['act_desplegado'] = 'active';
		$data['item_desplegado'] = 'menu-is-opening menu-open';
		$data['msjs_ult_tres'] = $this->Mensajes->get_mensajes_ult_tres();
		$data['msj_no_leidos'] = $this->Mensajes->get_mensajes_no_leidos();
		$this->load->view('admin/categorias/index', $data);
	}

	//--------------------------------------------------------------
	public function getCategorias($estado)
	{
		verificarConsulAjax();

		switch ($estado) {
			case 'categorias':
				$data['categorias'] = $this->Categorias->get_categorias();
				$this->load->view('admin/categorias/_tblCategorias', $data);
				break;
			case 'subcategorias':
				$data['subcategorias'] = $this->Subcategorias->get_subcategorias();
				$this->load->view('admin/categorias/_tblSubcategorias', $data);
				break;
		}
	}

	//--------------------------------------------------------------
	public function frmNueva()
	{
		verificarConsulAjax();
		$this->load->view('admin/categorias/frmNuevaCategoria');
	}

	//--------------------------------------------------------------
	public function frmEditar($id_categoria)
	{
		verificarConsulAjax();

		$data['categoria'] = $this->Categorias->get_categoria($id_categoria);
		$this->load->view('admin/categorias/frmEditarCategoria', $data);
	}

	//--------------------------------------------------------------
	public function frmVer($id_categoria)
	{
		verificarConsulAjax();

		$data['categoria'] = $this->Categorias->get_categoria($id_categoria);
		$this->load->view('admin/categorias/frmVerCategoria', $data);
	}

	//--------------------------------------------------------------
	public function crear()
	{
		verificarConsulAjax();

		$this->form_validation->set_rules('categoria', 'Categoría', 'required|trim|is_unique[categorias.descripcionCAT]');

		if ($this->form_validation->run()) :
			$categoria = [
				'descripcionCAT'	=> $this->input->post('categoria')
			];

			$resp = $this->Categorias->crear($categoria); // se inserta en bd

			if ($resp) {
				$this->output->set_output(json_encode(['result' => 1, 'titulo' => 'Excelente!', 'msj' => 'Categoría creada con éxito.', 'tabs' => 'categoria', 'tab' => 'categorias']));
				return;
			} else {
				$this->output->set_output(json_encode(['result' => 2, 'titulo' => 'Ooops.. error!', 'errores' => ['No se pudo crear la categoría. Intente más tarde!']]));
				return;
			}
		endif;

		$this->output->set_output(json_encode(['result' => 3, 'titulo' => 'Ooops.. controle!', 'errores' => $this->form_validation->error_array()]));
		return;
	} // fin de metodo crear

	//--------------------------------------------------------------
	public function editar($id_categoria)
	{
		verificarConsulAjax();

		$categ  = $this->input->post('categoria');

		// Reglas
		$restriccion = '';
		if (strtolower($categ) != strtolower($this->input->post('categoriaAct'))) {
			$restriccion = '|is_unique[categorias.descripcionCAT=]';
		}
		$this->form_validation->set_rules('categoria', 'Categoría', 'required|trim' . $restriccion);

		if ($this->form_validation->run()) : //Si la validación es correcta
			$categoria = [
				'descripcionCAT' => $categ
			];

			$resp = $this->Categorias->actualizar($id_categoria, $categoria); // se hace un update en bd

			if ($resp) {
				$this->output->set_output(json_encode(['result' => 1, 'titulo' => 'Excelente!', 'msj' => 'Categoría actualizada con éxito.', 'tabs' => 'categoria', 'tab' => 'categorias']));
				return;
			} else {
				$this->output->set_output(json_encode(['result' => 2, 'titulo' => 'Ooops.. error!', 'errores' => ['No se pudo actualizar la categoría. Intente más tarde!']]));
				return;
			}
		endif;

		$this->output->set_output(json_encode(['result' => 3, 'titulo' => 'Ooops.. controle!', 'errores' => $this->form_validation->error_array()]));
		return;
	} // fin de metodo editar
}
