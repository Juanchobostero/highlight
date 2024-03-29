<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route = array(
  'default_controller'    => 'Inicio_controller',
  '404_override'          => '',
  'translate_uri_dashes'  => FALSE,

	'admin'				=> 'Inicio_controller/admin',
	'admin/login'	=> 'Inicio_controller/login',
	'salir' 			=> 'Inicio_controller/frmSalir',

	'admin/dashboard'	=> 'admin/Dashboard_controller',
	'notificaciones' 	=> 'admin/Dashboard_controller/notificaciones',
	'ultimos_msjs'		=> 'admin/Dashboard_controller/ultimos_msjs',
	'graficoVentas'		=> 'admin/Dashboard_controller/graficoVentas',

	'admin/balance'					=> 'admin/Balance_controller',
	'admin/balance/(:any)'	=> 'admin/Balance_controller/getBalance/$1',
	
	'admin/categorias'					=> 'admin/Categorias_controller',
	'admin/categorias/(:any)'		=> 'admin/Categorias_controller/getCategorias/$1',
	'frmNuevaCategoria'					=> 'admin/Categorias_controller/frmNueva',
	'frmEditarCategoria/(:num)'	=> 'admin/Categorias_controller/frmEditar/$1',
	'frmVerCategoria/(:num)'		=> 'admin/Categorias_controller/frmVer/$1',
	'altaCategoria'							=> 'admin/Categorias_controller/crear',
	'editarCategoria/(:num)'		=> 'admin/Categorias_controller/editar/$1',

	'admin/clientes'					=> 'admin/Clientes_controller',
	'admin/clientes/(:any)'		=> 'admin/Clientes_controller/getClientes/$1',
	'frmEditarCliente/(:num)'	=> 'admin/Clientes_controller/frmEditar/$1',
	'frmVerCliente/(:num)'		=> 'admin/Clientes_controller/frmVer/$1',
	'editarCliente/(:num)'		=> 'admin/Clientes_controller/editar/$1',
	'habDesCliente/(:num)' 		=> 'admin/Clientes_controller/habilitarDeshabilitar/$1',

	'admin/imagenes' 				=> 'admin/Imagenes_controller',
	'editarImagenes/(:num)'	=> 'admin/Imagenes_controller/editar/$1',

	'admin/nosotros'								=> 'admin/Institucional_controller/nosotros',
	'admin/terminos-y-condiciones'	=> 'admin/Institucional_controller/terminos',
	'admin/politica-de-privacidad'	=> 'admin/Institucional_controller/politica',
	'editarInstitucional/(:num)'		=> 'admin/Institucional_controller/editar/$1',

	'admin/inventario'								=> 'admin/Inventario_controller',
	'admin/inventario/(:any)'					=> 'admin/Inventario_controller/getInventario/$1',
	'frmVerProductoBajoStock/(:num)'	=> 'admin/Inventario_controller/frmVer/$1',

	'admin/marcas'					=> 'admin/Marcas_controller',
	'admin/marcas/(:any)'		=> 'admin/Marcas_controller/getMarcas/$1',
	'frmNuevaMarca'					=> 'admin/Marcas_controller/frmNueva',
	'frmEditarMarca/(:num)'	=> 'admin/Marcas_controller/frmEditar/$1',
	'frmVerMarca/(:num)'		=> 'admin/Marcas_controller/frmVer/$1',
	'altaMarca'							=> 'admin/Marcas_controller/crear',
	'editarMarca/(:num)'		=> 'admin/Marcas_controller/editar/$1',

	'admin/mensajes'										=> 'admin/Mensajes_controller',
	'admin/mensajes/nro-mensaje/(:num)'	=> 'admin/Mensajes_controller/leerMensaje/$1',
	'enviarRespuesta'										=> 'admin/Mensajes_controller/enviarRespuesta',

	'admin/portadas'					=> 'admin/Portadas_controller',
	'admin/portadas/(:any)' 	=> 'admin/Portadas_controller/getPortadas/$1',
	'frmNuevaPortada'					=> 'admin/Portadas_controller/frmNueva',
	'frmEditarPortada/(:num)'	=> 'admin/Portadas_controller/frmEditar/$1',
	'altaPortada'							=> 'admin/Portadas_controller/crear',
	'editarPortada/(:num)'		=> 'admin/Portadas_controller/editar/$1',
	'publicarPort'						=> 'admin/Portadas_controller/publicar',
	'eliminarPort/(:num)'			=> 'admin/Portadas_controller/eliminar/$1',

	'admin/productos'							=> 'admin/Productos_controller',
	'admin/productos/(:any)'			=> 'admin/Productos_controller/getProductos/$1',
	'frmNuevoProducto'						=> 'admin/Productos_controller/frmNuevo',
	'frmEditarProducto/(:num)'		=> 'admin/Productos_controller/frmEditar/$1',
	'frmVerProducto/(:num)'				=> 'admin/Productos_controller/frmVer/$1',
	'altaProducto'								=> 'admin/Productos_controller/crear',
	'editarProducto/(:num)'				=> 'admin/Productos_controller/editar/$1',
	'pausarProducto'							=> 'admin/Productos_controller/pausar',
	'destacarProducto'						=> 'admin/Productos_controller/destacar',
	'eliminarProducto/(:num)'			=> 'admin/Productos_controller/eliminar/$1',
	'eliminarFoto/(:num)'					=> 'admin/Productos_controller/eliminarFoto/$1',

	'admin/productos-destacados'	=> 'admin/Productos_destacados_controller',
	'quitarDestacado/(:num)'			=> 'admin/Productos_destacados_controller/quitarDestacado/$1',

	'admin/productos-ofertas'								=> 'admin/Productos_ofertas_controller',
	'admin/productos-ofertas/(:any)'				=> 'admin/Productos_ofertas_controller/getOfertas/$1',
	'getProductoOferta/(:num)'							=> 'admin/Productos_ofertas_controller/getProducto/$1',
	'getSubcategoriaOferta/(:num)'					=> 'admin/Productos_ofertas_controller/getSubcategoria/$1',
	'frmNuevaOfertaIndividual'							=> 'admin/Productos_ofertas_controller/frmNuevaIndividual',
	'frmNuevaOfertaPorSubcategoria'					=> 'admin/Productos_ofertas_controller/frmNuevaPorSubcategoria',
	'frmEditarOfertaIndividual/(:num)'			=> 'admin/Productos_ofertas_controller/frmEditarIndividual/$1',
	'frmEditarOfertaPorSubcategoria/(:num)'	=> 'admin/Productos_ofertas_controller/frmEditarPorSubcategoria/$1',
	'altaOfertaIndividual'									=> 'admin/Productos_ofertas_controller/crearIndividual',
	'altaOfertaPorSubcategoria'							=> 'admin/Productos_ofertas_controller/crearPorSubcategoria',
	'editarOfertaIndividual/(:num)'					=> 'admin/Productos_ofertas_controller/editarIndividual/$1',
	'editarOfertaPorSubcategoria/(:num)'		=> 'admin/Productos_ofertas_controller/editarPorSubcategoria/$1',
	'eliminarOferta/(:num)'									=> 'admin/Productos_ofertas_controller/eliminar/$1',

	'admin/productos-pausados'	=> 'admin/Productos_pausados_controller',
	'quitarPausado/(:num)'			=> 'admin/Productos_pausados_controller/quitarPausado/$1',

	'frmNuevaSubcategoria'					=> 'admin/Subcategorias_controller/frmNueva',
	'frmEditarSubcategoria/(:num)'	=> 'admin/Subcategorias_controller/frmEditar/$1',
	'frmVerSubcategoria/(:num)'			=> 'admin/Subcategorias_controller/frmVer/$1',
	'altaSubcategoria'							=> 'admin/Subcategorias_controller/crear',
	'editarSubcategoria/(:num)'			=> 'admin/Subcategorias_controller/editar/$1',
	'getSubcategorias'							=> 'admin/Subcategorias_controller/get_x_categoria',

	'admin/usuarios'				=> 'admin/Usuarios_controller',
	'admin/usuarios/(:any)'	=> 'admin/Usuarios_controller/getUsuarios/$1',
	'admin/perfil/editar'		=> 'admin/Usuarios_controller/frmEditarPerfil',
	'editarPerfil'					=> 'admin/Usuarios_controller/editarPerfil',

	'admin/ventas'													=> 'admin/Ventas_controller',
	'admin/ventas/(:any)'										=> 'admin/Ventas_controller/getVentas/$1',
	'frmVerVenta/(:num)'										=> 'admin/Ventas_controller/frmVer/$1',
	'frmEnviarVenta/(:num)'									=> 'admin/Ventas_controller/frmEnviar/$1',
	'enviarVentaDestino/(:num)'							=> 'admin/Ventas_controller/enviarADestino/$1',
	'enviarVentaSucursal/(:num)'						=> 'admin/Ventas_controller/envioASucursal/$1',
	'entregarVenta/(:num)'									=> 'admin/Ventas_controller/entregar/$1',
	'cancelarVenta/(:num)'									=> 'admin/Ventas_controller/cancelar/$1',
	'admin/ventas/PDF-detalle-venta/(:num)'	=> 'admin/Ventas_controller/PDFDetalleVenta/$1'
);

$route['admin/validar']['post'] = 'Inicio_controller/validar';
$route['cerrarSesion']['post'] = 'Inicio_controller/cerrarSesion';
$route['producto/(:num)'] = 'Inicio_controller/producto/$1';
$route['productos'] = 'Inicio_controller/productos_todos';
$route['productos/(:any)'] = 'Inicio_controller/productos/$1';
$route['productos/(:num)/(:num)'] = 'Inicio_controller/productos/$1/$2';
$route['nosotros'] = 'Inicio_controller/nosotros';
$route['terminos'] = 'Inicio_controller/terminos';
$route['privacidad'] = 'Inicio_controller/privacidad';
$route['login'] = 'Inicio_controller/login_public';
$route['registro'] = 'Inicio_controller/register';
$route['contacto'] = 'Inicio_controller/contact';
$route['carrito'] = 'Inicio_controller/cart';
$route['perfil'] = 'Inicio_controller/profile';
$route['logout'] = 'Inicio_controller/cerrar_sesion';
$route['presupuesto'] = 'Inicio_controller/pedir_presupuesto';
$route['pagar'] = 'Inicio_controller/pagar/$1';
$route['finalizar_compra/(:num)'] = 'Inicio_controller/finalizar_compra/$1';
$route['pedido/(:num)'] = 'Inicio_controller/pedido/$1';
$route['pedidos'] = 'Inicio_controller/pedidos';
$route['recuperar'] = 'Inicio_controller/frmRecuperar';
$route['recuperar_contra/(:any)'] = 'Inicio_controller/frmNuevaContraseña/$1';


$route['message'] = 'public/Consultas_controller/mensaje';

$route['api/destacados'] = 'public/APISlider/masDestacados';
$route['api/novedades'] = 'public/APISlider/masNovedades';
$route['api/ofertas'] = 'public/APISlider/masOfertas';

//APIS
$route['api/user/login'] = 'public/APIUser/login';
$route['api/user/signin'] = 'public/APIUser/signin';
$route['api/user/complete_profile'] = 'public/APIUser/set_profile';
$route['api/user/localidades'] = 'public/APIUser/get_prov_localidades';
$route['api/carrito/add'] = 'public/APICarrito/agregar';
$route['api/carrito/update/qty'] = 'public/APICarrito/update_qty';
$route['api/carrito/vaciar'] = 'public/APICarrito/vaciar';
$route['api/carrito/delete'] = 'public/APICarrito/eliminar';
$route['api/carrito/gettotal'] = 'public/APICarrito/total_items';
$route['api/search/get'] = 'public/APISearch/get';
$route['api/carrito/save'] = 'public/APICarrito/guardar_compra';
$route['api/user/recuperar_contra'] = 'public/APIUser/enviar_email_recu';
$route['api/user/nuevaContrasena/(:any)'] = 'public/APIUser/nuevaContrasena/$1';



