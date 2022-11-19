<?php 
include 'cek_login_petugas.php';

if(!isset($_GET['id_gelombang'])) die("Index id_gelombang belum terdefinisi.");
$id_gelombang = $_GET['id_gelombang'];

if(!isset($_GET['field'])) die("Index field belum terdefinisi.");
$field = $_GET['field'];

if(!isset($_GET['isi'])) die("Index isi belum terdefinisi.");
$isi = $_GET['isi'];

include '../../config.php';

if($field=="status_gel" and $isi==1){
	$s = "UPDATE tb_gelombang SET status_gel = 0 WHERE 1";
	$q = mysqli_query($cn,$s) or die("Gagal update all to zero. ". mysqli_error($cn));
}

$s = "UPDATE tb_gelombang SET $field='$isi' WHERE id_gelombang='$id_gelombang'";
// die($s);
$q = mysqli_query($cn,$s) or die("Update Failed. ". mysqli_error($cn));


echo "1__";

?>


