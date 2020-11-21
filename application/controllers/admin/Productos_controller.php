<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Productos_controller extends CI_Controller
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
		$data['title'] = 'Productos';
		$data['act'] = '3_2Prod';
		$data['act_desplegado'] = 'active';
		$data['item_desplegado'] = 'menu-is-opening menu-open';
		$this->load->view('admin/productos/index', $data);
	}

	//--------------------------------------------------------------
	public function getProductos($estado)
	{
		verificarConsulAjax();

		if ($estado == 'activos') :
			$data['productos'] = $this->Productos->get_productos();
			$this->load->view('admin/productos/_tblProductos', $data);
		endif;
	}

	//--------------------------------------------------------------
	public function frmNuevo()
	{
		verificarConsulAjax();

		$data['marcas'] = $this->Marcas->get_marcas();
		$data['categorias'] = $this->Categorias->get_categorias();
		$this->load->view('admin/productos/frmNuevoProducto', $data);
	}

	//--------------------------------------------------------------
	public function crear()
	{
		verificarConsulAjax();

		// Reglas
		$this->form_validation->set_rules('codigo', 'Código', 'required|trim');
		$this->form_validation->set_rules('nombre', 'Nombre', 'required|trim');
		$this->form_validation->set_rules('stock', 'Stock', 'required|trim');
		$this->form_validation->set_rules('marca_id', 'Marca', 'required|trim');
		$this->form_validation->set_rules('categoria_id', 'Categoría', 'required|trim');
		$this->form_validation->set_rules('subcategoria_id', 'Subcategoría', 'required|trim');
		$this->form_validation->set_rules('pLista', 'Precio lista', 'required|trim');
		$this->form_validation->set_rules('pVenta', 'Precio venta', 'required|trim');

		if ($this->form_validation->run()) :
			$producto = [
				'id_subcat' 			=> $this->input->post('subcategoria_id'),
				'id_mar'					=> $this->input->post('marca_id'),
				'codigoPR' 				=> $this->input->post('codigo'),
				'nombrePR' 				=> $this->input->post('nombre'),
				'stockPR' 				=> $this->input->post('stock'),
				'precio_listaPR'	=> $this->input->post('pLista'),
				'precio_ventaPR'	=> $this->input->post('pVenta'),
				'estadoPR' 				=> 1
			];

			$resp = $this->Productos->crear($producto); // se inserta en bd

			if ($resp) {
				$this->output->set_output(json_encode(['result' => 1, 'titulo' => 'Excelente!', 'msj' => 'Producto creado con éxito.', 'tabs' => 'productos', 'tab' => 'activos']));
				return;
			} else {
				$this->output->set_output(json_encode(['result' => 2, 'titulo' => 'Ooops.. error!', 'msj' => 'Ha ocurrido un error al intentar crear un nuevo producto.']));
				return;
			}
		endif;

		$this->output->set_output(json_encode(['result' => 3, 'titulo' => 'Ooops.. error!', 'errores' => $this->form_validation->error_array()]));
		return;
	}
}
