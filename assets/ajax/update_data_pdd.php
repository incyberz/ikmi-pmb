<?php 
include "../../config.php";
if (!isset($_GET['email'])) die("Error #7dcbcc443241");
if (!isset($_GET['lulusan'])) die("Error #zasd7bcc4432d2");
if (!isset($_GET['asal_sekolah'])) die("Error #hds7bcc4432h3");
if (!isset($_GET['tahun_lulus'])) die("Error #3e7bcc443h24");
if (!isset($_GET['no_ijazah'])) die("Error #h47bcc443h24");
if (!isset($_GET['prodi_asal'])) die("Error #vaf67bcc443h24");

$email = $_GET['email'];
$lulusan = $_GET['lulusan'];
$asal_sekolah = $_GET['asal_sekolah'];
$tahun_lulus = $_GET['tahun_lulus'];
$no_ijazah = trim($_GET['no_ijazah']);
$prodi_asal = $_GET['prodi_asal'];

$lulusan = strtoupper(trim($lulusan));
$asal_sekolah = strtoupper(trim($asal_sekolah));
$tahun_lulus = strtoupper(trim($tahun_lulus));
$no_ijazah = strtoupper(trim($no_ijazah));
$prodi_asal = strtoupper(trim($prodi_asal));

$sql_ijz = " no_ijazah = '$no_ijazah' ";
if($no_ijazah=="")$sql_ijz = " no_ijazah = NULL ";


$s = "
	UPDATE tb_calon set 
	lulusan = '$lulusan',
	sekolah_asal = '$asal_sekolah',
	tahun_lulus = '$tahun_lulus',
	$sql_ijz,
	prodi_asal = '$prodi_asal' 
	where email = '$email'
	";

	// die($s);

$q = mysqli_query($cn,$s) or die("Error #bcasd4dasd55dcdb6a ".mysqli_error($cn));
if ($q) {
	echo "Update data pendidikan berhasil.";
}else{
	echo "Failed";
}
?>