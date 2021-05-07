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
function subirImagen($nombre, $carpeta, $imgDefault, $num = '')
{
	$CI = &get_instance();
	$tipos  = array('image/jpeg', 'image/pjpeg', 'image/bmp', 'image/png', 'imagen/x-png');
	$destino = 'assets/img/' . $carpeta . '/';

	if (isset($_FILES[$nombre]['name'])) {
		$mime  =  get_mime_by_extension($_FILES[$nombre]['name']); //obtiene la extension del file

		if (in_array($mime,  $tipos)) {
			//cargar configuración 
			$config['upload_path'] = $destino;
			$config['allowed_types'] = 'bmp|jpeg|jpg|png';
			$config['file_name'] = date('dmY') . '_' . time() . $num;

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
 * @param string $carpeta Nombre de la carpeta donde se subira la imagen
 * @return array Rutas del archivo.
 */
function subirImagenes($carpeta)
{
	$CI = &get_instance();
	$tipos  = array('image/jpeg', 'image/pjpeg', 'image/bmp', 'image/png', 'imagen/x-png');
	$destino = 'assets/img/' . $carpeta . '/';

	$i = 0;
	foreach ($_FILES as $file) :
		if (!is_array($file['name'])) :
			$mime  =  get_mime_by_extension($file['name']); //obtiene la extension del file

			if (in_array($mime,  $tipos)) {
				$_FILES['arch']['name'] = $file['name'];
				$_FILES['arch']['type'] = $file['type'];
				$_FILES['arch']['tmp_name'] = $file['tmp_name'];
				$_FILES['arch']['error'] = $file['error'];
				$_FILES['arch']['size'] = $file['size'];

				//cargar configuración 
				$config['upload_path'] = $destino;
				$config['allowed_types'] = 'bmp|jpeg|jpg|png';
				$config['file_name'] = date('dmY') . '_' . time() . '_' . $i;

				$CI->upload->initialize($config); // Se inicializa la config

				// subir el archivo al directorio 
				if ($CI->upload->do_upload('arch')) {
					$imgSubida = $CI->upload->data();
					$imgs[$i] = $destino . $imgSubida['orig_name'];
					$i++;
				}
			}
		endif;
	endforeach;

	return isset($imgs) ? $imgs : '';
}

/**
 * Verifica que los archivos por subir sean todos imagenes
 * @return bool El resultado del analisis
 */
function verificarTipoArchivo()
{
	$tipos  = array('image/jpeg', 'image/pjpeg', 'image/bmp', 'image/png', 'imagen/x-png');

	foreach ($_FILES as $file) :
		if (!is_array($file['name'])) :
			if (!empty($file['name'])) :
				$mime  =  get_mime_by_extension($file['name']); //obtiene la extension del file

				if (!in_array($mime,  $tipos)) {
					return false;
				}
			endif;
		endif;
	endforeach;

	return true;
}

/**
 * Envia un email a quien corresponda.
 * @param array $datosEnvio datos del destinatario del mensaje.
 * @return boolean true si se envio correctamente o false por lo contrario
 */
function enviar_email($datosEnvio)
{
	$CI = &get_instance();

	$config = array(
		'protocol'    => 'smtp',
		'smtp_host'   => APP_SMTP_HOST,
		'smtp_user'   => APP_SMTP_USER,
		'smtp_pass'   => APP_SMTP_PASS,
		'smtp_port'   => APP_SMTP_PORT,
		'charset'     => 'utf-8',
		'mailtype'    => 'html',
		'validate'    => TRUE,
		'wordwrap'    => TRUE,
	);

	$CI->email->initialize($config);

	$CI->email->from($datosEnvio['de'], $datosEnvio['titulo']);
	$CI->email->to($datosEnvio['para']);
	$CI->email->subject($datosEnvio['asunto']);
	$CI->email->message($datosEnvio['mensaje']);
	$CI->email->set_newline("\r\n");

	return $CI->email->send();
}
