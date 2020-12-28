<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Clientes_controller extends CI_Controller
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
		$data['title'] = 'Clientes';
		$data['act'] = '2C';
		$data['act_desplegado'] = '';
		$data['item_desplegado'] = '';
		$this->load->view('admin/clientes/index', $data);
	}

	//--------------------------------------------------------------
	public function getClientes($estado)
	{
		verificarConsulAjax();

		switch ($estado) {
			case 'activos':
				$data['clientes'] = $this->Usuarios->get_users(2); // Devuelve clientes activos
				$this->load->view('admin/clientes/_tblClientes', $data);
				break;
			case 'deshabilitados':
				$data['clientes'] = $this->Usuarios->get_users(2, 0); // Devuelve clientes eliminados
				$this->load->view('admin/clientes/_tblClientesEliminados', $data);
				break;
		}
	}

	//--------------------------------------------------------------
	public function frmEditar($id)
	{
		verificarConsulAjax();

		$data['cliente'] = $this->Usuarios->get_user($id);
		$this->load->view('admin/clientes/frmEditarCliente', $data);
	}

	//--------------------------------------------------------------
	public function frmVer($id)
	{
		verificarConsulAjax();

		$data['cliente'] = $this->Usuarios->get_user($id);
		$this->load->view('admin/clientes/frmVerCliente', $data);
	}

	//--------------------------------------------------------------
	public function editar($id)
	{
		verificarConsulAjax();

		$this->form_validation->set_rules('nombre', 'Nombre', 'required|trim');

		if ($this->form_validation->run()) :
			$cliente = [
				'nombreU' 	=> $this->input->post('nombre'),
				'apellidoU' => $this->input->post('apellido'),
				'telefonoU' => $this->input->post('telefono'),
			];

			if (!empty($_FILES['file']['name'])) {
				$cliente['fotoU'] = subirImagen('file', 'perfiles', 'no-user.png');
			}

			$resp = $this->Usuarios->editar($id, $cliente); // se hace un update en bd

			if ($resp) {
				$this->output->set_output(json_encode(['result' => 1, 'titulo' => 'Excelente!', 'msj' => 'Cliente actualizado con éxito.', 'tabs' => 'clientes', 'tab' => 'activos']));
				return;
			} else {
				$this->output->set_output(json_encode(['result' => 2, 'titulo' => 'Ooops.. error!', 'msj' => 'Ha ocurrido un error al intentar actualizar un cliente.']));
				return;
			}
		endif;

		$this->output->set_output(json_encode(['result' => 3, 'titulo' => 'Ooops.. error!', 'errores' => $this->form_validation->error_array()]));
		return;
	} // fin de metodo editar

	//--------------------------------------------------------------
	public function habilitarDeshabilitar($id)
	{
		verificarConsulAjax();

		$estado = ($this->input->post('est') == 1) ? true : false;
		$msj = ($estado) ? 'habilitado' : 'deshabilitado';

		$resp  = $this->Usuarios->editar($id, ['estadoU' => $estado]);

		if ($resp) {
			$this->output->set_output(json_encode(['result' => 1, 'titulo' => 'Excelente!', 'msj' => 'Cliente ' . $msj . '!']));
			return;
		}
		$this->output->set_output(json_encode(['result' => 2, 'titulo' => 'Error', 'msj' => 'Intente más tarde.']));
		return;
	}
}
