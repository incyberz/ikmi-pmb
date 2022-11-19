<?php 
if (!isset($_GET['get_cetak'])) die("Error #print2pdf Data for Cetak can't be found.");
$get_cetak = $_GET['get_cetak'];
$tmp = explode("&", $get_cetak);
$file_cetak = $tmp[0];
$email = $tmp[1];

switch ($get_cetak) {
  case 'formulir': $html_cetak = file_get_contents("http://localhost/ikmi/pmb2/cetak.php?$get_cetak");break;
}

require_once 'vendors/dompdf/autoload.inc.php';
use Dompdf\Dompdf;
$dompdf = new Dompdf();

$dompdf->loadHtml($html_cetak);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream();

?>