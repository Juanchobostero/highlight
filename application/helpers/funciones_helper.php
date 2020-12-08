<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Verifica si hay una sesion de usuario 'admin' en curso
 */
function verificarSesionAdmin()
{
	if (isset($_SESSION['tipo']) != 1) {
		show_404();
	}
}

/**
 * Verifica si es una llamada (request) desde Ajax
 */
function verificarConsulAjax()
{
	$CI = &get_instance();

	if (!$CI->input->is_ajax_request()) {
		show_404();
	}
}

/**
 * Sube una imagen
 * @param string $nombre Nombre del input de donde se recibe el archivo
 * @param string $carpeta Nombre de la carpeta donde se subira la imagen
 * @param string $imgDefault Nombre de imagen por defecto, en caso de que no haya nada
 */
function subirImagen($nombre, $carpeta, $imgDefault)
{
	$CI = &get_instance();
	$tipos  = array('image/jpeg', 'image/pjpeg', 'image/bmp', 'image/png', 'imagen/x-png');
	$destino = 'assets/img/' . $carpeta . '/';

	if (isset($_FILES[$nombre]['name'])) {
		$mime  =  get_mime_by_extension($_FILES[$nombre]['name']); //obtiene la extension del file

		if (in_array($mime,  $tipos)) {
			//cargar configuración 
			$config['upload_path'] = $destino;
			$config['allowed_types'] = 'bmp|jpg|png';
			$config['file_name'] = date('dmY') . '_' . time();

			$CI->upload->initialize($config); // Se inicializa la config

			// subir el archivo al directorio 
			if ($CI->upload->do_upload($nombre)) {
				$imgSubida = $CI->upload->data();
				return $destino . $imgSubida['orig_name'];
			}
		}
	}
	return $destino . $imgDefault;
}

/**
 * Sube una coleccion de imagen
 * @param string $nombre Nombre del input de donde se recibe el archivo
 * @param string $carpeta Nombre de la carpeta donde se subira la imagen
 * @param string $id_producto Id del producto al que pertenece el conjunto de imagenes
 */
function subirImagenes($nombre, $carpeta, $id_producto)
{
	$CI = &get_instance();
	$tipos  = array('image/jpeg', 'image/pjpeg', 'image/bmp', 'image/png', 'imagen/x-png');
	$destino = 'assets/img/' . $carpeta . '/';

	for ($i = 0; $i < count($_FILES[$nombre]['name']); $i++) :
		$mime  =  get_mime_by_extension($_FILES[$nombre]['name'][$i]); //obtiene la extension del file

		if (in_array($mime,  $tipos)) {
			$_FILES['arch']['name'] = $_FILES[$nombre]['name'][$i];
			$_FILES['arch']['type'] = $_FILES[$nombre]['type'][$i];
			$_FILES['arch']['tmp_name'] = $_FILES[$nombre]['tmp_name'][$i];
			$_FILES['arch']['error'] = $_FILES[$nombre]['error'][$i];
			$_FILES['arch']['size'] = $_FILES[$nombre]['size'][$i];

			//cargar configuración 
			$config['upload_path'] = $destino;
			$config['allowed_types'] = 'bmp|jpg|png';
			$config['file_name'] = date('dmY') . '_' . time() . '_' . $i;

			$CI->upload->initialize($config); // Se inicializa la config

			// subir el archivo al directorio 
			if ($CI->upload->do_upload('arch')) {
				$imgSubida = $CI->upload->data();
				$imgs[$i]['id_prod'] = $id_producto;
				$imgs[$i]['foto'] = $destino . $imgSubida['orig_name'];
			}
		}
	endfor;

	return isset($imgs) ? $imgs : '';
}
