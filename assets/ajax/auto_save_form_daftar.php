<?php 
include "../../config.php";
if (!isset($_GET['id_calon'])) die("Error #id_calon field is missing");
if (!isset($_GET['id'])) die("Error #id field is missing");
if (!isset($_GET['isi'])) die("Error #isi field is missing");
if (!isset($_GET['tb'])) die("Error #tb field is missing");

$id_calon = $_GET['id_calon'];
$id = trim(strtolower($_GET['id']));
$isi = trim($_GET['isi']);
$tb = $_GET['tb'];

if($id=="tanggal_lahir_indo"){
	$id = "tanggal_lahir"; //11 06 1987
	$dd = substr($isi,0,2);//01 23 4567
	$mm = substr($isi,2,2);
	$yy = substr($isi,4,4);
	$isi = "$yy-$mm-$dd";
}

$sql_isi = " $id = '$isi' ";
if($isi=="") $sql_isi = " $id = NULL ";

if($id=="nik"){
	$id_kec_nik = substr($isi,0,6);
	$tgl = substr($isi,6,2);
	$bln = substr($isi,8,2);
	$thn = substr($isi,10,2);
	$tahun = "19$thn";
	if($thn<50)$tahun="20$thn";

	$jenis_kelamin = "L";
	if($tgl>40) $jenis_kelamin = "P";

	if($tgl>40) $tgl=$tgl-40;
	$tanggal_lahir = "$tahun-$bln-$tgl";

	$sql_isi = " $id = $isi, jenis_kelamin='$jenis_kelamin', tanggal_lahir='$tanggal_lahir', id_kec_nik='$id_kec_nik' ";
}

if ($id=="id_prodi") {
	$id_biaya = 31+$isi;
	$sql_isi = " $id = $isi, id_biaya='$id_biaya'  ";
}


$s = "
	UPDATE $tb set 
	$sql_isi 
	where id_calon = '$id_calon'
	";

	// die($s);

$q = mysqli_query($cn,$s) or die("Error ajax::auto_save #1, s:$s, ".mysqli_error($cn));
echo "1__Update data berhasil. $s. SQL-ISI: $sql_isi";
?>