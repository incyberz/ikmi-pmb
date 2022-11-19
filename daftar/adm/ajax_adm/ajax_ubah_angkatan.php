<?php 
include 'cek_login_petugas.php';

if(!isset($_GET['id_angkatan'])) die("Index id_angkatan belum terdefinisi.");
$acuan_id_angkatan = $_GET['id_angkatan'];

if(!isset($_GET['field'])) die("Index field belum terdefinisi.");
$field = $_GET['field'];

if(!isset($_GET['isi'])) die("Index isi belum terdefinisi.");
$isi = $_GET['isi'];

include '../../config.php';
$s = "UPDATE tb_angkatan SET $field='$isi' WHERE id_angkatan='$acuan_id_angkatan'";
// die($s);
$q = mysqli_query($cn,$s) or die("Gagal mengubah jadwal tes baru. ". mysqli_error($cn));

echo "1__";

?>


