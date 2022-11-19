<?php 
include "../../config.php";
if (!isset($_GET['email'])) die("Error #bcc443241");
if (!isset($_GET['nik'])) die("Error #bcc4432d2");
if (!isset($_GET['nisn'])) die("Error #bcc4432h3");
if (!isset($_GET['tempat_lahir'])) die("Error #bcc443h24");
if (!isset($_GET['tanggal_lahir'])) die("Error #bcc44g325");
if (!isset($_GET['jenis_kelamin'])) die("Error #bcc443s26");
if (!isset($_GET['status_menikah'])) die("Error #bcc44f327");
if (!isset($_GET['agama'])) die("Error #bcc44328s");
if (!isset($_GET['warga_negara'])) die("Error #bcc4432a9");
if (!isset($_GET['alamat_jalan'])) die("Error #bcc4433d0");
if (!isset($_GET['id_kec'])) die("Error #bcc4432z1");

$email = $_GET['email'];
$nik = $_GET['nik'];
$nisn = $_GET['nisn'];
$tempat_lahir = $_GET['tempat_lahir'];
$tanggal_lahir = $_GET['tanggal_lahir'];
$jenis_kelamin = $_GET['jenis_kelamin'];
$status_menikah = $_GET['status_menikah'];
$agama = $_GET['agama'];
$warga_negara = $_GET['warga_negara'];
$alamat_jalan = $_GET['alamat_jalan'];
$id_kec = $_GET['id_kec'];

$email = strtoupper(trim($email));
$nik = strtoupper(trim($nik));
$nisn = strtoupper(trim($nisn));
$tempat_lahir = strtoupper(trim($tempat_lahir));
$tanggal_lahir = strtoupper(trim($tanggal_lahir));
$jenis_kelamin = strtoupper(trim($jenis_kelamin));
$status_menikah = strtoupper(trim($status_menikah));
$agama = strtoupper(trim($agama));
$warga_negara = strtoupper(trim($warga_negara));
$alamat_jalan = strtoupper(trim($alamat_jalan));
$id_kec = strtoupper(trim($id_kec));

$sql_nisn = "nisn = '$nisn'";
if ($nisn=="") $sql_nisn = "nisn = NULL";

$s = "
	UPDATE tb_calon set 
	nik = '$nik',
	$sql_nisn,
	tempat_lahir = '$tempat_lahir',
	tanggal_lahir = '$tanggal_lahir',
	jenis_kelamin = '$jenis_kelamin',
	status_menikah = '$status_menikah',
	agama = '$agama',
	warga_negara = '$warga_negara',
	alamat_jalan = '$alamat_jalan',
	id_kec = '$id_kec' 
	where email = '$email'
	";

	//die($s);

$q = mysqli_query($cn,$s) or die("Error #bcd3d55dcdb6a ".mysqli_error($cn));
if ($q) {
	echo "Update biodata berhasil.";
}else{
	echo "Update Failed";
}
?>