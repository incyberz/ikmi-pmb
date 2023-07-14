<?php 
include "../config.php";
if (!isset($_GET['id_sekolah'])) die("Error @ajax :: id_sekolah index belum terdefinisi.");

$id_sekolah = $_GET['id_sekolah'];

$s = " SELECT * from tb_sekolah where id_sekolah = '$id_sekolah'";
$q = mysqli_query($cn,$s) or die("Error @ajax-get-data-sekolah. ".mysqli_error($cn));
if(mysqli_num_rows($q)!=1) die("Error @ajax-get-data-sekolah. Data sekolah tidak ditemukan.");
$d = mysqli_fetch_array($q);

$jenis_sekolah = $d['jenis_sekolah'];
$status_sekolah = $d['status_sekolah'];
$id_kec_sekolah = $d['id_kec_sekolah'];

$nama_kec_sekolah = '';
if($id_kec_sekolah!=""){
	$s = "SELECT a.nama_kec,b.nama_kab from tb_kec a  
	join tb_kab b on a.id_kab=b.id_kab 
	where id_kec = '$id_kec_sekolah'";
	$q = mysqli_query($cn,$s) or die("Error @ajax-get-data-sekolah-kec. ".mysqli_error($cn));
	if(mysqli_num_rows($q)!=1) die("Error @ajax-get-data-sekolah-kec. Data kecamatan tidak ditemukan.");

	$d = mysqli_fetch_array($q);

	$nama_kec = $d['nama_kec'];
	$nama_kab = $d['nama_kab'];

	$nama_kec_sekolah = strtoupper("KEC. $nama_kec $nama_kab");
}

echo "1 ~ $jenis_sekolah ~ $status_sekolah ~ $id_kec_sekolah ~ $nama_kec_sekolah";
?>