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

	'admin/clientes'					=> 'admin/Clientes_controller',
	'admin/clientes/(:any)'		=> 'admin/Clientes_controller/getClientes/$1',
	'frmEditarCliente/(:num)'	=> 'admin/Clientes_controller/frmEditar/$1',
	'frmVerCliente/(:num)'		=> 'admin/Clientes_controller/frmVer/$1',
	'editarCliente/(:num)'		=> 'admin/Clientes_controller/editar/$1',
	'habDesCliente/(:num)' 		=> 'admin/Clientes_controller/habilitarDeshabilitar/$1',

	'admin/portadas'					=> 'admin/Portadas_controller',
	'admin/portadas/(:any)' 	=> 'admin/Portadas_controller/getPortadas/$1',
	'frmNuevaPortada'					=> 'admin/Portadas_controller/frmNueva',
	'frmEditarPortada/(:num)'	=> 'admin/Portadas_controller/frmEditar/$1',
	'altaPortada'							=> 'admin/Portadas_controller/crear',
	'editarPortada/(:num)'		=> 'admin/Portadas_controller/editar/$1',
	'habDesPortada/(:num)'		=> 'admin/Portadas_controller/habilitarDeshabilitar/$1',
	'publicarPort'						=> 'admin/Portadas_controller/publicar',

	'admin/usuarios'				=> 'admin/Usuarios_controller',
	'admin/usuarios/(:any)'	=> 'admin/Usuarios_controller/getUsuarios/$1',
	'admin/perfil/editar'		=> 'admin/Usuarios_controller/frmEditarPerfil',
	'editarPerfil'					=> 'admin/Usuarios_controller/editarPerfil',
);

$route['admin/validar']['post'] = 'Inicio_controller/validar';
$route['cerrarSesion']['post'] = 'Inicio_controller/cerrarSesion';
