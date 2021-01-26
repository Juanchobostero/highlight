<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$autoload['packages'] = array();


$autoload['libraries'] = array('database', 'form_validation', 'email', 'session', 'cart','pagination');


$autoload['drivers'] = array();


$autoload['helper'] = array('url', 'form', 'download','text');


$autoload['config'] = array();


$autoload['language'] = array();


$autoload['model'] = array(
	'admin/Categorias',
	'admin/Imagenes',
	'admin/Marcas',
	'admin/Mensajes', 
    'admin/Portadas', 
    'admin/Productos', 
	'admin/Productos_fotos', 
	'admin/Productos_ofertas',
    'admin/Subcategorias', 
    'admin/Usuarios', 
    'public/Portadas_model', 
    'public/Productos_model',
    'public/Categorias_model',
);
