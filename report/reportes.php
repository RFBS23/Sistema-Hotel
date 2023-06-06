<?php

require_once '../vendor/autoload.php';
require_once '../model/reservacion.php';

use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;

try {

  //Instanciar clase superhero
  $reservacion = new Reservaciones();
  $datos = $reservacion->listarSuperHero($_GET['idreservacion']);
  $titulo = $_GET['titulo'];

  ob_start();

  //Archivos que componen PDF
  //Hoja de estilos
  include './estilos.report.html';
  //Archivos con datos(estaticos/dinamicos)
  include './reportes.data.php';

  $content = ob_get_clean();

  $html2pdf = new Html2Pdf('P', 'A4', 'es');
  $html2pdf->writeHTML($content);
  $html2pdf->output('registro_reservacion.pdf');
} catch (Html2PdfException $e) {
  $html2pdf->clean();

  $formatter = new ExceptionFormatter($e);
  echo $formatter->getHtmlMessage();
}