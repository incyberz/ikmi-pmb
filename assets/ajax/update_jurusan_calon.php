<?php 
include "../../config.php";
if (!isset($_GET['id_calon'])) die("Error #ajax_update_jur missing calon id");
if (!isset($_GET['id_biaya'])) die("Error #ajax_update_jur missing biaya id");
if (!isset($_GET['id_referal'])) die("Error #ajax_update_jur missing ref id");
if (!isset($_GET['id_gel'])) die("Error #ajax_update_jur missing gelombang id");
if (!isset($_GET['id_gel_calon'])) die("Error #ajax_update_jur missing gelombang_calon id");

$id_calon = $_GET['id_calon'];
$id_biaya = $_GET['id_biaya'];
$id_referal = $_GET['id_referal'];
$id_gel = $_GET['id_gel'];
$id_gel_calon = $_GET['id_gel_calon'];

$sql_gel = " id_gel = '$id_gel' ";
# JIKA PROSES UPDATE DI GELOMBANG YG LAIN -> JGN UPDATE ID_GEL
if($id_gel!=$id_gel_calon) $sql_gel = '';
if($id_gel_calon=="") $sql_gel = " id_gel = '$id_gel' ";

$s = "
	UPDATE tb_daftar set 
	id_biaya = '$id_biaya',
	id_referal = '$id_referal',
	$sql_gel 
	where id_calon = '$id_calon'
	";

	// die($s);

$q = mysqli_query($cn,$s) or die("Error #ajax_update_jur");
if ($q) echo "Update penjurusan berhasil.";
?>