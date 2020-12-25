<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$autoload['packages'] = array();


$autoload['libraries'] = array('database', 'session', 'form_validation', 'upload');


$autoload['drivers'] = array();


$autoload['helper'] = array('url', 'file', 'funciones');


$autoload['config'] = array();


$autoload['language'] = array();


$autoload['model'] = array(
	'admin/Categorias',
	'admin/Imagenes',
    'admin/Marcas' , 
    'admin/Portadas', 
    'admin/Productos', 
    'admin/Productos_fotos', 
    'admin/Subcategorias', 
    'admin/Usuarios', 
    'public/Portadas_model', 
    'public/Productos_model',
    'public/Categorias_model',
);
