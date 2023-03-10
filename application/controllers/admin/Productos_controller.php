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
		$data['act'] = '5_2Prod';
		$data['desplegado'] = 'prod';
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
	public function frmEditar($id_producto)
	{
		verificarConsulAjax();

		$data['marcas'] = $this->Marcas->get_marcas();
		$data['categorias'] = $this->Categorias->get_categorias();
		$data['producto'] = $this->Productos->get_producto($id_producto);
		$data['fotos'] = $this->Productos_fotos->get_producto_fotos($id_producto);
		$this->load->view('admin/productos/frmEditarProducto', $data);
	}

	//--------------------------------------------------------------
	public function frmVer($id_producto)
	{
		verificarConsulAjax();

		$data['producto'] = $this->Productos->get_producto($id_producto);
		$data['fotos'] = $this->Productos_fotos->get_producto_fotos($id_producto);
		$this->load->view('admin/productos/frmVerProducto', $data);
	}

	//--------------------------------------------------------------
	public function crear()
	{
		verificarConsulAjax();

		// Reglas
		$this->form_validation->set_rules('codigo', 'C??digo', 'required|trim|is_unique[productos.codigoPR]');
		$this->form_validation->set_rules('nombre', 'Nombre', 'required|trim');
		$this->form_validation->set_rules('stock', 'Stock', 'required|trim');
		$this->form_validation->set_rules('marca_id', 'Marca', 'required|trim');
		$this->form_validation->set_rules('categoria_id', 'Categor??a', 'required|trim');
		$this->form_validation->set_rules('subcategoria_id', 'Subcategor??a', 'required|trim');
		$this->form_validation->set_rules('pLista', 'Precio lista', 'required|trim');
		$this->form_validation->set_rules('pVenta', 'Precio venta', 'required|trim');
		$this->form_validation->set_rules('file[]', 'Archivo', 'callback_verificarArchivos');

		if ($this->form_validation->run()) :
			$pausado = $this->input->post('pausar') ? 1 : 2; // 1 => SI; 2 => NO
			$destacado = $this->input->post('destacar') ? 1 : 2; // 1 => SI; 2 => NO

			$producto = [
				'id_subcat' 			=> $this->input->post('subcategoria_id'),
				'id_mar'					=> $this->input->post('marca_id'),
				'codigoPR' 				=> $this->input->post('codigo'),
				'nombrePR' 				=> $this->input->post('nombre'),
				'descripcionPR'		=> $this->input->post('descripcion'),
				'stockPR' 				=> $this->input->post('stock'),
				'precio_listaPR'	=> $this->input->post('pLista'),
				'precio_ventaPR'	=> $this->input->post('pVenta'),
				'pausadoPR'				=> $pausado,
				'destacadoPR'			=> $destacado,
				'estadoPR' 				=> 1
			];

			$id_producto = $this->Productos->crear($producto); // se inserta en bd

			if (!empty($_FILES)) :
				$imgs = subirImagenes('productos');

				if (!empty($imgs)) :
					$this->Productos_fotos->crear($id_producto, $imgs);
				endif;
			endif;

			if ($id_producto) {
				$this->output->set_output(json_encode(['result' => 1, 'titulo' => 'Excelente!', 'msj' => 'Producto creado con ??xito.', 'tabs' => 'productos', 'tab' => 'activos']));
				return;
			} else {
				$this->output->set_output(json_encode(['result' => 2, 'titulo' => 'Ooops.. error!', 'errores' => ['No se pudo crear el producto. Intente m??s tarde!']]));
				return;
			}
		endif;

		$this->output->set_output(json_encode(['result' => 3, 'titulo' => 'Ooops.. controle!', 'errores' => $this->form_validation->error_array()]));
		return;
	}

	//--------------------------------------------------------------
	public function editar($id_producto)
	{
		verificarConsulAjax();

		$codigo  = $this->input->post('codigo');

		// Reglas
		$restriccion = ($codigo != $this->input->post('codigoAct')) ? '|is_unique[productos.codigoPR]' : '';
		$this->form_validation->set_rules('codigo', 'C??digo', 'required|trim' . $restriccion);
		$this->form_validation->set_rules('nombre', 'Nombre', 'required|trim');
		$this->form_validation->set_rules('stock', 'Stock', 'required|trim');
		$this->form_validation->set_rules('marca_id', 'Marca', 'required|trim');
		$this->form_validation->set_rules('categoria_id', 'Categor??a', 'required');
		$this->form_validation->set_rules('subcategoria_id', 'Subcategor??a', 'required');
		$this->form_validation->set_rules('pLista', 'Precio lista', 'required|trim');
		$this->form_validation->set_rules('pVenta', 'Precio venta', 'required|trim');
		$this->form_validation->set_rules('file[]', 'Archivo', 'callback_verificarArchivos');

		if ($this->form_validation->run()) :
			$pausado = $this->input->post('pausar') ? 1 : 2; // 1 => SI; 2 => NO
			$destacado = $this->input->post('destacar') ? 1 : 2; // 1 => SI; 2 => NO

			$producto = [
				'id_subcat' 			=> $this->input->post('subcategoria_id'),
				'id_mar'					=> $this->input->post('marca_id'),
				'codigoPR' 				=> $codigo,
				'nombrePR' 				=> $this->input->post('nombre'),
				'descripcionPR'		=> $this->input->post('descripcion'),
				'stockPR' 				=> $this->input->post('stock'),
				'precio_listaPR'	=> $this->input->post('pLista'),
				'precio_ventaPR'	=> $this->input->post('pVenta'),
				'pausadoPR'				=> $pausado,
				'destacadoPR'			=> $destacado
			];

			$resp = $this->Productos->actualizar($id_producto, $producto); // se inserta en bd

			if (!empty($_FILES)) :
				$imgs = subirImagenes('productos');

				if (!empty($imgs)) :
					$this->Productos_fotos->crear($id_producto, $imgs);
				endif;
			endif;

			if ($resp) {
				$this->output->set_output(json_encode(['result' => 1, 'titulo' => 'Excelente!', 'msj' => 'Producto actualizado con ??xito.', 'tabs' => 'productos', 'tab' => 'activos']));
				return;
			} else {
				$this->output->set_output(json_encode(['result' => 2, 'titulo' => 'Ooops.. error!', 'errores' => ['No se pudo actualizar el producto. Intente m??s tarde!']]));
				return;
			}
		endif;

		$this->output->set_output(json_encode(['result' => 3, 'titulo' => 'Ooops.. controle!', 'errores' => $this->form_validation->error_array()]));
		return;
	}

	//--------------------------------------------------------------
	public function pausar()
	{
		verificarConsulAjax();

		if ($this->input->post('prom') == 'true') {
			$prom = 1; // SI
			$msj = 'pausado';
		} else {
			$prom = 2; // NO
			$msj = 'NO pausado';
		}

		$resp  = $this->Productos->actualizar($this->input->post('id'), ['pausadoPR' => $prom]);

		if ($resp) {
			$this->output->set_output(json_encode(['result' => 1, 'titulo' => 'Excelente!', 'msj' => 'Producto ' . $msj]));
			return;
		}
		$this->output->set_output(json_encode(['result' => 2, 'titulo' => 'Ooops.. error!', 'errores' => ['No se pudo llevar a cabo la operaci??n. Intente m??s tarde!']]));
		return;
	}

	//--------------------------------------------------------------
	public function destacar()
	{
		verificarConsulAjax();

		if ($this->input->post('prom') == 'true') {
			$prom = 1; // SI
			$msj = 'destacado';
		} else {
			$prom = 2; // NO
			$msj = 'NO destacado';
		}

		$resp  = $this->Productos->actualizar($this->input->post('id'), ['destacadoPR' => $prom]);

		if ($resp) {
			$this->output->set_output(json_encode(['result' => 1, 'titulo' => 'Excelente!', 'msj' => 'Producto ' . $msj]));
			return;
		}
		$this->output->set_output(json_encode(['result' => 2, 'titulo' => 'Ooops.. error!', 'errores' => ['No se pudo llevar a cabo la operaci??n. Intente m??s tarde!']]));
		return;
	}

	//--------------------------------------------------------------
	public function eliminar($id_producto)
	{
		verificarConsulAjax();

		$resp  = $this->Productos->actualizar($id_producto, ['estadoPR' => 0]);

		if ($resp) {
			$this->output->set_output(json_encode(['result' => 1, 'titulo' => 'Excelente!', 'msj' => 'Producto eliminado!']));
			return;
		}
		$this->output->set_output(json_encode(['result' => 2, 'titulo' => 'Ooops.. error!', 'errores' => ['No se pudo eliminar el producto. Intente m??s tarde!']]));
		return;
	}

	//--------------------------------------------------------------
	public function eliminarFoto($id_foto)
	{
		verificarConsulAjax();

		$foto = $this->Productos_fotos->get_foto($id_foto);
		$resp = $this->Productos_fotos->eliminar($id_foto);

		if ($resp) {
			unlink('./' . $foto->foto); // se elimina el archivo
			$this->output->set_output(json_encode(['result' => 1, 'titulo' => 'Excelente!', 'msj' => 'Foto eliminada.']));
			return;
		} else {
			$this->output->set_output(json_encode(['result' => 2, 'titulo' => 'Ooops.. error!', 'msj' => 'Ha ocurrido un error al intentar eliminar una foto.']));
			return;
		}
	}

	//--------------------------------------------------------------
	function verificarArchivos()
	{
		if (!empty($_FILES)) :
			if (!verificarTipoArchivo()) {
				$this->form_validation->set_message('verificarArchivos', 'Un o varios archivos no son im??genes.');
				return false;
			}
		endif;
		return true;
	}
}
