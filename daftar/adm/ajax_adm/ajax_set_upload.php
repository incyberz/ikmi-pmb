<?php 
include 'cek_login_petugas.php';

if(!isset($_GET['id_verifikasi'])) die("Index id_verifikasi belum terdefinisi.");
// if(!isset($_GET['field'])) die("Index field belum terdefinisi.");
if(!isset($_GET['nilai'])) die("Index nilai belum terdefinisi.");
if(!isset($_GET['alasan_reject'])) die("Index alasan_reject belum terdefinisi.");

$id_verifikasi = $_GET['id_verifikasi'];
// $field = $_GET['field'];
$nilai = $_GET['nilai'];
$alasan_reject = $_GET['alasan_reject'];

if($alasan_reject==""){
	$alasan_reject = "NULL";
}else{
	$alasan_reject = "'$alasan_reject'";
}

include '../../config.php';
$s = "UPDATE tb_verifikasi_upload SET 
id_petugas='$id_petugas', 
tanggal_verifikasi_upload=CURRENT_TIMESTAMP, 
status_upload=$nilai, 
alasan_reject=$alasan_reject 
where id_verifikasi='$id_verifikasi'";
// die($s);
$q = mysqli_query($cn,$s) or die("gagal update verifikasi_upload. ". mysqli_error($cn));

echo "Sukses update verifikasi_upload.";

?>


