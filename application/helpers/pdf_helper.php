<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once('./assets/TCPDF/config/tcpdf_config.php');
require_once('./assets/TCPDF/tcpdf.php');

/**
 * Clase que extiende del plugin TCPDF
 * Contiene una serie de funciones que hace mas facil la creacion de un documento PDF.
 */
class Pdf extends TCPDF
{
	private $borderCelda;

	public function __construct()
	{
		parent::__construct('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
	}

	/**
	 * Setea el formato para los bordes de la celda de una tabla
	 * 
	 * @access public
	 * @param array $borderCelda Formato de bordes para celda
	 */
	public function setBorderCelda($borderCelda = 0)
	{
		$this->borderCelda = $borderCelda;
	}

	/**
	 * Obtiene el formato para los bordes de la celda de una tabla
	 * 
	 * @access public
	 * @return borderCelda
	 */
	public function getBorderCelda()
	{
		return $this->borderCelda;
	}

	/**
	 * Dibuja el encabezado del PDF, con sus respectivos margenes y fuente
	 * 
	 * @access public
	 * @param string $titulo Titulo de html
	 * @param string $subTituloEncabezado Subtitulo del encabezado del PDF
	 * @param int $size Tamaño de la fuente
	 */
	public function encabezado($titulo, $subTituloEncabezado, $size = 10)
	{
		$this->SetCreator(PDF_CREATOR);
		$this->SetAuthor(APP_NAME);
		$this->setPrintFooter(false);
		$this->SetTitle($titulo . ' | Highlight');
		$this->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, APP_NAME, $subTituloEncabezado);
		$this->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		$this->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$this->SetHeaderMargin(PDF_MARGIN_HEADER);
		$this->SetFooterMargin(PDF_MARGIN_FOOTER);
		$this->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		$this->setImageScale(PDF_IMAGE_SCALE_RATIO);
		$this->setFontSubsetting(true);
		$this->SetFont(PDF_FONT_NAME_MAIN, '', $size, '', true);
		$this->AddPage();
		$this->setCellPaddings(0, 0, 0, 0);
	}

	/**
	 * Configura el header de la tabla (color de letra, fondo y fuente)
	 * 
	 * @access public
	 * @param array $colorLetra Color de letra en formato RGB [R, G, B]
	 * @param array $colorFondo Color de fondo en formato RGB [R, G, B]
	 * @param int $size Tamaño de la fuente
	 */
	public function configHeaderTabla($colorLetra = [255, 255, 255], $colorFondo = [52, 58, 64], $size = 10)
	{
		$this->SetFillColor($colorFondo[0], $colorFondo[1], $colorFondo[2]); // color de fondo
		$this->SetTextColor($colorLetra[0], $colorLetra[1], $colorLetra[2]); // color de letra
		$this->SetFont(PDF_FONT_NAME_MAIN, '', $size, '', TRUE);
	}

	/**
	 * Configura el cuerpo de la tabla (color de letra y fuente)
	 * 
	 * @access public
	 * @param array $colorLetra Color de letra en formato RGB [R, G, B]
	 * @param int $size Tamaño de la fuente
	 */
	public function configBodyTabla($colorLetra = [0, 0, 0], $size = 9)
	{
		$this->SetTextColor($colorLetra[0], $colorLetra[1], $colorLetra[2]); // color de letra
		$this->SetFont(PDF_FONT_NAME_MAIN, '', $size, '', TRUE);
	}

	/**
	 * Configura el footer de la tabla (fuente).
	 * Usado para colocar el total de algo, o que tenga que resaltarse.
	 * 
	 * @access public
	 * @param int $size Tamaño de la fuente
	 */
	public function configFooterTabla($size = 10)
	{
		$this->SetFont(PDF_FONT_NAME_MAIN, 'B', $size, '', TRUE);
	}

	/**
	 * Dibuja una celda de la tabla.
	 * 
	 * @access public
	 * @param int $ancho Ancho (width) de la celda
	 * @param int $alto Alto (height) de la celda
	 * @param string $txt Texto que se imprime en la celda
	 * @param string $align Alineacion de texto. 'L' => izquierda, 'C' => centrada, 'R' => derecha, 'J' => justificado
	 * @param bool $permitPintar Si se permite pintar la celda. TRUE => SI, FALSE => NO
	 * @param bool $ishtml Si se permite ingresar en $txt codigo HTML. TRUE => SI, FALSE => NO
	 */
	public function celda($ancho, $alto, $txt, $align, $permitPintar = FALSE, $ishtml = FALSE)
	{
		// parametros
		//$width,$height,$txt,$border = 0,$align = 'J',$fill = false,$ln = 1,$x = '',$y = '',
		//$reseth = true,$stretch = 0,$ishtml = false,$autopadding = true,$maxh = 0,$valign = 'T',$fitcell = false
		$this->MultiCell($ancho, $alto, $txt, $this->getBorderCelda(), $align, $permitPintar, 0, '', '', TRUE, 1, $ishtml, TRUE, 0, 'M', TRUE);
	}
}
