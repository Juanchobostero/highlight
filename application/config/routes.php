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

	'admin/marcas'					=> 'admin/Marcas_controller',
	'admin/marcas/(:any)'		=> 'admin/Marcas_controller/getMarcas/$1',
	'frmNuevaMarca'					=> 'admin/Marcas_controller/frmNueva',
	'frmEditarMarca/(:num)'	=> 'admin/Marcas_controller/frmEditar/$1',
	'frmVerMarca/(:num)'		=> 'admin/Marcas_controller/frmVer/$1',
	'altaMarca'							=> 'admin/Marcas_controller/crear',
	'editarMarca/(:num)'		=> 'admin/Marcas_controller/editar/$1',

	'admin/portadas'					=> 'admin/Portadas_controller',
	'admin/portadas/(:any)' 	=> 'admin/Portadas_controller/getPortadas/$1',
	'frmNuevaPortada'					=> 'admin/Portadas_controller/frmNueva',
	'frmEditarPortada/(:num)'	=> 'admin/Portadas_controller/frmEditar/$1',
	'altaPortada'							=> 'admin/Portadas_controller/crear',
	'editarPortada/(:num)'		=> 'admin/Portadas_controller/editar/$1',
	'habDesPortada/(:num)'		=> 'admin/Portadas_controller/habilitarDeshabilitar/$1',
	'publicarPort'						=> 'admin/Portadas_controller/publicar',

	'admin/productos'							=> 'admin/Productos_controller',
	'admin/productos/(:any)'			=> 'admin/Productos_controller/getProductos/$1',
	'frmNuevoProducto'						=> 'admin/Productos_controller/frmNuevo',
	'frmEditarProducto/(:num)'		=> 'admin/Productos_controller/frmEditar/$1',
	'frmEditarDescripcion/(:num)'	=> 'admin/Productos_controller/frmEditarDescripcion/$1',
	'altaProducto'								=> 'admin/Productos_controller/crear',
	'editarProducto/(:num)'				=> 'admin/Productos_controller/editar/$1',
	'editarDescripcion/(:num)'		=> 'admin/Productos_controller/editarDescripcion/$1',
	'destacarProducto'						=> 'admin/Productos_controller/destacar',
	'eliminarProducto/(:num)'			=> 'admin/Productos_controller/eliminar/$1',
	'eliminarFoto/(:num)'					=> 'admin/Productos_controller/eliminarFoto/$1',

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
);

$route['admin/validar']['post'] = 'Inicio_controller/validar';
$route['cerrarSesion']['post'] = 'Inicio_controller/cerrarSesion';
$route['api/destacados'] = 'APISlider/masDestacados';
