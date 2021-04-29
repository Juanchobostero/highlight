<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$autoload['packages'] = array();


$autoload['libraries'] = array('database', 'form_validation', 'email', 'session', 'cart', 'pagination', 'upload');


$autoload['drivers'] = array();


$autoload['helper'] = array('url', 'file', 'form', 'funciones', 'download','text', 'pdf');


$autoload['config'] = array();


$autoload['language'] = array();


$autoload['model'] = array(
	'admin/Categorias',
	'admin/Imagenes',
	'admin/Institucional',
	'admin/Marcas',
	'admin/Mensajes', 
    'admin/Portadas', 
    'admin/Productos', 
	'admin/Productos_fotos', 
	'admin/Productos_ofertas',
    'admin/Subcategorias', 
    'admin/Usuarios',
	'admin/Ventas', 
	'admin/Ventas_detalle',
    'public/Portadas_model', 
    'public/Productos_model',
    'public/Categorias_model',
    'public/Usuarios_model',
    'public/Institucional_model',
);
