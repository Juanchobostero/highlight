<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Marcas_controller extends CI_Controller
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
		$data['title'] = 'Marcas';
		$data['act'] = '5_1Mar';
		$data['act_desplegado'] = 'active';
		$data['item_desplegado'] = 'menu-is-opening menu-open';
		$this->load->view('admin/marcas/index', $data);
	}

	//--------------------------------------------------------------
	public function getMarcas($estado)
	{
		verificarConsulAjax();

		if ($estado == 'activas') {
			$data['marcas'] = $this->Marcas->get_marcas();
			$this->load->view('admin/marcas/_tblMarcas', $data);
		}
	}

	//--------------------------------------------------------------
	public function frmNueva()
	{
		verificarConsulAjax();
		$this->load->view('admin/marcas/frmNuevaMarca');
	}

	//--------------------------------------------------------------
	public function frmEditar($id_marca)
	{
		verificarConsulAjax();

		$data['marca'] = $this->Marcas->get_marca($id_marca);
		$this->load->view('admin/marcas/frmEditarMarca', $data);
	}

	//--------------------------------------------------------------
	public function frmVer($id_marca)
	{
		verificarConsulAjax();

		$data['marca'] = $this->Marcas->get_marca($id_marca);
		$this->load->view('admin/marcas/frmVerMarca', $data);
	}

	//--------------------------------------------------------------
	public function crear()
	{
		verificarConsulAjax();

		$this->form_validation->set_rules('marca', 'Marca', 'required|trim|is_unique[marcas.descripcionM]');

		if ($this->form_validation->run()) :
			$marca = [
				'descripcionM'	=> $this->input->post('marca')
			];

			$resp = $this->Marcas->crear($marca); // se inserta en bd

			if ($resp) {
				$this->output->set_output(json_encode(['result' => 1, 'titulo' => 'Excelente!', 'msj' => 'Marca creada con éxito.', 'tabs' => 'marcas', 'tab' => 'activas']));
				return;
			} else {
				$this->output->set_output(json_encode(['result' => 2, 'titulo' => 'Ooops.. error!', 'msj' => 'Ha ocurrido un error al intentar crear una nueva marca.']));
				return;
			}
		endif;

		$this->output->set_output(json_encode(['result' => 3, 'titulo' => 'Ooops.. error!', 'errores' => $this->form_validation->error_array()]));
		return;
	} // fin de metodo crear

	//--------------------------------------------------------------
	public function editar($id_marca)
	{
		verificarConsulAjax();

		$marc  = $this->input->post('marca');

		// Reglas
		$restriccion = '';
		if (strtolower($marc) != strtolower($this->input->post('marcaAct'))) {
			$restriccion = '|is_unique[marcas.descripcionM=]';
		}
		$this->form_validation->set_rules('marca', 'Marca', 'required|trim' . $restriccion);

		if ($this->form_validation->run()) : //Si la validación es correcta
			$marca = [
				'descripcionM' => $marc
			];

			$resp = $this->Marcas->actualizar($id_marca, $marca); // se hace un update en bd

			if ($resp) {
				$this->output->set_output(json_encode(['result' => 1, 'titulo' => 'Excelente!', 'msj' => 'Marca actualizada con éxito.', 'tabs' => 'marcas', 'tab' => 'activas']));
				return;
			} else {
				$this->output->set_output(json_encode(['result' => 2, 'titulo' => 'Ooops.. error!', 'msj' => 'Ha ocurrido un error al intentar actualizar la marca.']));
				return;
			}
		endif;

		$this->output->set_output(json_encode(['result' => 3, 'titulo' => 'Ooops.. error!', 'errores' => $this->form_validation->error_array()]));
		return;
	} // fin de metodo editar
}
