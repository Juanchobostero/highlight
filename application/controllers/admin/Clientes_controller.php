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
		$data['act'] = '1C';
		$this->load->view('admin/clientes/index', $data);
	}

	//--------------------------------------------------------------
	public function getClientes($estado)
	{
		verificarConsulAjax();

		switch ($estado) {
			case 'activos':
				$clientes = $this->Usuarios->get_users(2); // Devuelve clientes activos
				$this->load->view('admin/clientes/_tblClientes', ['clientes' => $clientes]);
				break;
			case 'deshabilitados':
				$clientes = $this->Usuarios->get_users(2, 0); // Devuelve clientes eliminados
				$this->load->view('admin/clientes/_tblClientesEliminados', ['clientes' => $clientes]);
				break;
		}
	}

	//--------------------------------------------------------------
	public function frmVer($id)
	{
		verificarConsulAjax();

		$data['cliente'] = $this->Usuarios->get_user($id);
		$this->load->view('admin/clientes/frmVerCliente', $data);
	}

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
