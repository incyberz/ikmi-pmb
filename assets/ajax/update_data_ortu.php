<?php 
include "../../config.php";
if (!isset($_GET['email'])) die("Error #44cf43241");
if (!isset($_GET['nama_ayah'])) die("Error #44cfbcc4432d2");
if (!isset($_GET['nama_ibu'])) die("Error #bc44cfc4432h3");
if (!isset($_GET['pekerjaan_ayah'])) die("Error #bcs44cfc443h24");
if (!isset($_GET['pekerjaan_ibu'])) die("Error #bsdfvcc44g325");

$email = $_GET['email'];
$nama_ayah = $_GET['nama_ayah'];
$nama_ibu = $_GET['nama_ibu'];
$pekerjaan_ayah = $_GET['pekerjaan_ayah'];
$pekerjaan_ibu = $_GET['pekerjaan_ibu'];

$nama_ayah = strtoupper(trim($nama_ayah));
$nama_ibu = strtoupper(trim($nama_ibu));
$pekerjaan_ayah = strtoupper(trim($pekerjaan_ayah));
$pekerjaan_ibu = strtoupper(trim($pekerjaan_ibu));


$s = "
	UPDATE tb_calon set 
	nama_ayah = '$nama_ayah',
	nama_ibu = '$nama_ibu',
	pekerjaan_ayah = '$pekerjaan_ayah',
	pekerjaan_ibu = '$pekerjaan_ibu'
	where email = '$email'
	";

	// die($s);

$q = mysqli_query($cn,$s) or die("Error #b3d3cd55dcdb6a ".mysqli_error($cn));
if ($q) {
	echo "Update data Orangtua berhasil.";
}else{
	echo "Failed";
}
?>