<?php 
include "../../config.php";
if (!isset($_GET['id_prodi'])) die("Error #4rtc443241");
if (!isset($_GET['id_angkatan'])) die("Error #4rtfzasd7bcc4432d2");
if (!isset($_GET['id_jnkelas'])) die("Error #4rtehds7bcc4432h3");
if (!isset($_GET['tipe_bayar'])) die("Error #4rtd3e7bcc443h24");

$id_prodi = $_GET['id_prodi'];
$id_angkatan = $_GET['id_angkatan'];
$id_jnkelas = $_GET['id_jnkelas'];
$tipe_bayar = $_GET['tipe_bayar'];


$s = "SELECT id_biaya,besar_dpp,besar_spp from tb_biaya 
where id_prodi = '$id_prodi' 
and id_angkatan = '$id_angkatan' 
and id_jnkelas = '$id_jnkelas' 
and tipe_bayar = '$tipe_bayar'	
";

//die($s);

// die("0,".$s);

$q = mysqli_query($cn,$s) or die("Error #zxaade2cdb6a ".mysqli_error($cn));
if (mysqli_num_rows($q)==1) {
	$d = mysqli_fetch_array($q);
	$id_biaya = $d['id_biaya'];
	$besar_dpp = $d['besar_dpp'];
	$besar_spp = $d['besar_spp'];
	$hasil = "1,$id_biaya,$besar_dpp,$besar_spp";
}else{die("0, Error #ajax::get_id_biaya: Empty row or row found more than one.");}
if ($q) echo "$hasil";

?>