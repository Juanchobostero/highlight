<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Inicio_controller extends CI_Controller
{
	//--------------------------------------------------------------
	public function admin()
	{

		if (isset($_SESSION['id'])) {
			redirect('admin/dashboard');
		} else {
			redirect('admin/login');
		}
	}

	
	public function index()
	{
		//Paginado
		$perPage = 10;
		$start = 0;

		$data['categorias'] = $this->Categorias_model->get_full();
		$data['herramientas'] = $this->Categorias_model->get_cat_herramientas();
		$data['iluminacion'] = $this->Categorias_model->get_cat_iluminacion();
		$data['portadas'] = $this->Portadas_model->get_habs();
		$data['productos'] = $this->Productos_model->get_productos($cat = null, $subcat = null, $perPage, $start);
		$total_dest = $this->Productos_model->get_count_productos_destacados();
		$total_nov = $this->Productos_model->get_count_productos_novedades();
		$total_ofe = $this->Productos_model->get_count_productos_ofertas();
		$data['total_destacados'] = ceil($total_dest/$perPage);
		$data['total_novedades'] = ceil($total_nov/$perPage);
		$data['total_ofertas'] = ceil($total_ofe/$perPage);
		$data['destacados'] = $this->Productos_model->get_destacados($perPage, $start);
		$data['novedades'] = $this->Productos_model->get_novedades($perPage, $start);
		$data['ofertas'] = $this->Productos_model->get_ofertas($perPage, $start);
		$data['imagen'] = $this->Portadas_model->get_imagenes();

		$this->load->view('public/index', $data);
	}

	//--------------------------------------------------------------
	// acceso a login de admin
	public function login()
	{
		$data['title'] = 'Acceso';
		$this->load->view('admin/login', $data);
		// $this->validar();
	}

	//--------------------------------------------------------------
	// acceso a login publico
	public function login_public()
	{
		$data['title'] = 'Iniciar Sesión';
		$data['categorias'] = $this->Categorias_model->get_full();
		$this->load->view('public/login', $data);
	}

	//--------------------------------------------------------------
	// Carrito
	public function cart(){
		$data['title'] = 'Mi carrito';
		$data['categorias'] = $this->Categorias_model->get_full();

		foreach($this->cart->contents() as $items){
			$producto = $this->Productos_model->get_producto($items['id']);
			$items['stock'] = $producto->stockPR;
			$this->cart->update(['rowid' => $items['rowid']]);
		}

		$this->load->view('public/carrito', $data);
	}

	//--------------------------------------------------------------
	// Perfil
	public function profile(){
		$data['title'] = 'Completá tus datos';
		if(!$this->session->userdata('login')){
			redirect('login');
		  }
		  $usuario = $this->Usuarios_model->get_user($this->session->userdata('id'));
		  $usuario->localidad = $this->Usuarios_model->get_localidad($usuario->id_loc);

		  if($usuario->localidad){
			$usuario->provincia = $this->Usuarios_model->get_provincia($usuario->localidad->id_prov);
			$data['localidades'] = $this->Usuarios_model->get_prov_localidades($usuario->provincia->id_provincia);
		  }else{
			$usuario->provincia = null;
			$data['localidades'] = null;
		  }
		  
		  $data['usuario'] = $usuario;
		  $data['provincias'] = $this->Usuarios_model->get_provincias();
		  $data['categorias'] = $this->Categorias_model->get_full();
		  $this->load->view('public/perfil', $data);
		
	}

	public function register()
	{
		$data['title'] = 'Registrarse';
		$data['categorias'] = $this->Categorias_model->get_full();
		$this->load->view('public/register', $data);
	}

	public function contact()
	{
		$data['title'] = 'Contactanos';
		$data['categorias'] = $this->Categorias_model->get_full();
		$this->load->view('public/contacto', $data);
	}

	public function cerrar_sesion(){
		$this->session->set_userdata('login', FALSE);
		$this->session->sess_destroy();
		redirect('login');
  }

	//--------------------------------------------------------------
	public function validar()
	{
		verificarConsulAjax();

		$email = $this->input->post('email');
		$pass = $this->input->post('pass');

		$this->form_validation->set_rules('email', 'E-mail', 'required|valid_email');
		$this->form_validation->set_rules('pass', 'Contraseña', 'required');

		if ($this->form_validation->run()) {
			$users = new Usuarios;
			$user = $users->get_user_correo($email);

			if ($user and password_verify($pass, $user->passwordU)) {
				$data = [
					'id'			 => $user->id_usuario,
					'tipo'		 => $user->id_tu,
					'nombre'	 => $user->nombreU,
					'apellido' => $user->apellidoU,
					'usuario'	 => $user->nombreU . ' ' . $user->apellidoU,
					'telefono' => $user->telefonoU,
					'correo'	 => $user->emailU,
					'foto'		 => $user->fotoU,
					'estado'	 => $user->estadoU,
					'login'		 => TRUE
				];
				$this->session->set_userdata($data);
				// redirect('admin');
				$this->output->set_output(json_encode(['result' => 1, 'titulo' => 'Excelente!', 'msj' => 'Bienvenido ' . $user->nombreU . '!', 'url' => base_url('admin/dashboard')]));
				return;
			}
			$this->output->set_output(json_encode(['result' => 2, 'titulo' => 'Ooops.. error!', 'errores' => ['Email y/o contraseña incorrectos']]));
			return;
		} else {
			$this->output->set_output(json_encode(['result' => 3, 'titulo' => 'Ooops.. error!', 'errores' => $this->form_validation->error_array()]));
			return;
		}
	} // fin de metodo validar

	//--------------------------------------------------------------
	public function frmSalir()
	{
		$this->load->view('admin/cerrar-sesion');
	}

	//--------------------------------------------------------------
	public function cerrarSesion()
	{
		$this->session->sess_destroy();
		redirect('admin/login');
	}

	//--------------------------------------------------------------
	public function producto($id){
		$data['categorias'] = $this->Categorias_model->get_full();
		$data['producto'] = $this->Productos_model->get_producto($id);
		$data['fotos'] = $this->Productos_model->get_fotos($id);
	
		/* if(!$data['producto']){
		  show_404($page = '', $log_error = TRUE);
		  return;
		}
		 */
		$this->load->view('public/producto', $data);
	}

	public function productos_todos(){

		$perPage = 8;
		$totalProducts = $this->Productos_model->get_count_all();
		$data['total_pages']  = ceil($totalProducts/$perPage);
		$cat = null;
		$subcat = null;

		$data['categorias'] = $this->Categorias_model->get_full();

		if(!empty($this->input->get("page"))){
			$start = $perPage * $this->input->get('page');
			$productos = $this->Productos_model->get_productos($cat, $subcat, $perPage, $start); //limit,start
			if($productos){
			  $data['productos'] = $productos;
			  $html = $this->load->view('public/ajax/productos', $data, TRUE);
			  $this->output->set_output(json_encode(['result' => 1, 'html' => $html]));
			  return;
			}else{
			  $this->output->set_output(json_encode(['result' => 0]));
			  return;
			}
			
		  }
		  else{
			$start =0;
			$data['productos'] = $this->Productos_model->get_productos($cat, $subcat, $perPage, $start);
			$this->load->view('public/productos', $data);
		  }

	}


	public function productos($cat, $subcat = null){

		$data['categorias'] = $this->Categorias_model->get_full();
		$data['categoria'] = $this->Categorias_model->get_categoria($cat);
		$data['subcategoria'] = $this->Categorias_model->get_subcategoria($subcat);
		$totalProducts = $this->Productos_model->get_count($cat, $subcat);
		$perPage = 8;
		$data['total_pages'] = ceil($totalProducts/$perPage);

		if(!empty($this->input->get("page"))){
			$start = $perPage * $this->input->get('page');
			$productos = $this->Productos_model->get_productos($cat, $subcat, $perPage, $start); //limit,start
			if($productos){
			  $data['productos'] = $productos;
			  $html = $this->load->view('public/ajax/productos', $data, TRUE);
			  $this->output->set_output(json_encode(['result' => 1, 'html' => $html]));
			  return;
			}else{
			  $this->output->set_output(json_encode(['result' => 0]));
			  return;
			}
			
		  }
		  else{
			$start =0;
			$data['productos'] = $this->Productos_model->get_productos($cat, $subcat, $perPage, $start);
			$this->load->view('public/productos', $data);
		  }

		
	}

	public function nosotros(){
		$data['categorias'] = $this->Categorias_model->get_full();
		$data['nosotros'] = $this->Institucional_model->get_nosotros();
		$this->load->view('public/nosotros', $data);
	}

	public function pedir_presupuesto(){
		$data['categorias'] = $this->Categorias_model->get_full();
		$data['title'] = 'Pedir presupuesto';

		$this->load->view('public/presupuesto', $data);
	}

	public function pagar() {
		$data['categorias'] = $this->Categorias_model->get_full();
		$data['title'] = 'Confirmar pago';

		foreach($this->cart->contents() as $items){
			$producto = $this->Productos_model->get_producto($items['id']);
			$items['stock'] = $producto->stockPR;
			$this->cart->update(['rowid' => $items['rowid']]);
		}

		$data['cart'] = $this->cart->contents();

		$usuario = $this->Usuarios_model->get_user($this->session->userdata('id'));
		$data['usuario'] = $usuario;

		$this->load->view('public/pagar', $data);
	}

	public function finalizar_compra(){
		$data['categorias'] = $this->Categorias_model->get_full();
		$data['title'] = 'Confirmar pago';
		$estado_pago = $_GET['status'];

		//Solo inserta pago si el estado es aprobado
		if($estado_pago == 'approved') {
			$id_pedido = $this->Productos_model->guardar_pedido();
			$data['pedido'] = $this->Productos_model->get_pedido($id_pedido);

			$this->cart->destroy();
			$this->load->view('public/pedido', $data);
		//Si no es aprobado redirige al carrito
		}else{
			$data['title'] = 'Mi carrito';
			$this->load->view('public/carrito', $data);
		}
		
	}

	public function pedido($id){
		$data['categorias'] = $this->Categorias_model->get_full();
		$data['title'] = 'Pedido';
		$data['pedido'] = $this->Productos_model->get_pedido($id);

		$this->load->view('public/pedido', $data);
	}

	public function pedidos(){
		$data['categorias'] = $this->Categorias_model->get_full();
		$data['title'] = 'Mis pedidos';

		if(!$this->session->userdata('login')){
			redirect('login');
		}else{
			$id_user = $this->session->userdata('id');
			$data['pedidos'] = $this->Productos_model->get_pedidos($id_user);
			$this->load->view('public/pedidos', $data);
		}
		
	}

}
