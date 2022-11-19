<?php 
include "../../config.php";
if (!isset($_GET['email'])) die("Error #7bcc443241");
if (!isset($_GET['instansi_kerja'])) die("Error #7bcc4432d2");
if (!isset($_GET['jabatan_kerja'])) die("Error #7bcc4432h3");
if (!isset($_GET['alamat_kerja'])) die("Error #7bcc443h24");

$email = $_GET['email'];
$instansi_kerja = $_GET['instansi_kerja'];
$jabatan_kerja = $_GET['jabatan_kerja'];
$alamat_kerja = $_GET['alamat_kerja'];

$instansi_kerja = strtoupper(trim($instansi_kerja));
$jabatan_kerja = strtoupper(trim($jabatan_kerja));
$alamat_kerja = strtoupper(trim($alamat_kerja));

$s = "
	UPDATE tb_calon set 
	instansi_kerja = '$instansi_kerja',
	jabatan_kerja = '$jabatan_kerja',
	alamat_kerja = '$alamat_kerja'
	where email = '$email'
	";

	// die($s);

$q = mysqli_query($cn,$s) or die("Error #bcdasd55dcdb6a ".mysqli_error($cn));
if ($q) {
	echo "Update data pekerjaan berhasil.";
}else{
	echo "Failed";
}
?>