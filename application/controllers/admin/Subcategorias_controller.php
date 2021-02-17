<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Subcategorias_controller extends CI_Controller
{

	//--------------------------------------------------------------
	public function __construct()
	{
		parent::__construct();
		verificarSesionAdmin();
	}

	//--------------------------------------------------------------
	public function frmNueva()
	{
		verificarConsulAjax();

		$data['categorias'] = $this->Categorias->get_categorias();
		$this->load->view('admin/categorias/frmNuevaSubcategoria', $data);
	}

	//--------------------------------------------------------------
	public function frmEditar($id_subcategoria)
	{
		verificarConsulAjax();

		$data['categorias'] = $this->Categorias->get_categorias();
		$data['subcategoria'] = $this->Subcategorias->get_subcategoria($id_subcategoria);
		$this->load->view('admin/categorias/frmEditarSubcategoria', $data);
	}

	//--------------------------------------------------------------
	public function frmVer($id_subcategoria)
	{
		verificarConsulAjax();

		$subcategoria = $this->Subcategorias->get_subcategoria($id_subcategoria);
		$subcategoria->categoria = $this->Categorias->get_categoria($subcategoria->id_cat);
		$this->load->view('admin/categorias/frmVerSubcategoria', ['subcategoria' => $subcategoria]);
	}

	//--------------------------------------------------------------
	public function crear()
	{
		verificarConsulAjax();

		$categoria_id = $this->input->post('categoria_id');

		// Reglas
		$this->form_validation->set_rules('categoria_id', 'Categoría', 'required|trim');
		$this->form_validation->set_rules('subcategoria', 'Subcategoría', 'required|trim|is_unique[subcategorias.id_cat='.$categoria_id.' AND '.'descripcionSC=]');

		if ($this->form_validation->run()) :
			$subcategoria = [
				'id_cat' 				=> $categoria_id,
				'descripcionSC'	=> $this->input->post('subcategoria'),
				'imagenSC'			=> subirImagen('file', 'subcategorias', 'no-subcategoria.png')
			];

			$resp = $this->Subcategorias->crear($subcategoria); // se inserta en bd

			if ($resp) {
				$this->output->set_output(json_encode(['result' => 1, 'titulo' => 'Excelente!', 'msj' => 'Subcategoría creada con éxito.', 'tabs' => 'categoria', 'tab' => 'subcategorias']));
				return;
			} else {
				$this->output->set_output(json_encode(['result' => 2, 'titulo' => 'Ooops.. error!', 'errores' => ['No se pudo crear la subcategoría. Intente más tarde!']]));
				return;
			}
		endif;

		$this->output->set_output(json_encode(['result' => 3, 'titulo' => 'Ooops.. controle!', 'errores' => $this->form_validation->error_array()]));
		return;
	} // fin de metodo crear

	//--------------------------------------------------------------
	public function editar($id_subcategoria)
	{
		verificarConsulAjax();

		$categoria_id  = $this->input->post('categoria_id');
		$subcateg = $this->input->post('subcategoria');

		// Reglas
		$restriccion = '';
		if ($categoria_id != $this->input->post('categoriaAct_id') || strtolower($subcateg) != strtolower($this->input->post('subcategoriaAct'))) {
			$restriccion = '|is_unique[subcategorias.id_cat='.$categoria_id.' AND '.'descripcionSC=]';
		}
		$this->form_validation->set_rules('categoria_id', 'Categoría', 'required|trim');
		$this->form_validation->set_rules('subcategoria', 'Subcategoría', 'required|trim' . $restriccion);

		if ($this->form_validation->run()) : //Si la validación es correcta
			$subcategoria = [
				'id_cat'				=> $categoria_id,
				'descripcionSC' => $this->input->post('subcategoria')
			];

			if (!empty($_FILES['file']['name'])) {
				$subcategoria['imagenSC'] = subirImagen('file', 'subcategorias', 'no-subcategoria.png');
			}

			$resp = $this->Subcategorias->actualizar($id_subcategoria, $subcategoria); // se hace un update en bd

			if ($resp) {
				$this->output->set_output(json_encode(['result' => 1, 'titulo' => 'Excelente!', 'msj' => 'Subcategoría actualizada con éxito.', 'tabs' => 'categoria', 'tab' => 'subcategorias']));
				return;
			} else {
				$this->output->set_output(json_encode(['result' => 2, 'titulo' => 'Ooops.. error!', 'errores' => ['No se pudo actualizar la subcategoría. Intente más tarde!']]));
				return;
			}
		endif;

		$this->output->set_output(json_encode(['result' => 3, 'titulo' => 'Ooops.. controle!', 'errores' => $this->form_validation->error_array()]));
		return;
	} // fin de metodo editar

	//--------------------------------------------------------------
	public function get_x_categoria() {
    $id_categoria = $this->input->post('id_cat');
		$subcategorias = $this->Subcategorias->get_subcategorias_x_categoria($id_categoria);
  
    if ($subcategorias) {
      echo json_encode($subcategorias);
    } else {
      echo json_encode(false);
    }
  }
}
