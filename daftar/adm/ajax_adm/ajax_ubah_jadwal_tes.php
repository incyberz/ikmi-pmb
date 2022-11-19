<?php 
include 'cek_login_petugas.php';

if(!isset($_GET['id_jadwal_tes'])) die("Index id_jadwal_tes belum terdefinisi.");
$id_jadwal_tes = $_GET['id_jadwal_tes'];

if(!isset($_GET['field'])) die("Index field belum terdefinisi.");
$field = $_GET['field'];

if(!isset($_GET['isi'])) die("Index isi belum terdefinisi.");
$isi = $_GET['isi'];

include '../../config.php';
$s = "UPDATE tb_jadwal_tes SET $field='$isi' WHERE id_jadwal_tes='$id_jadwal_tes'";
// die($s);
$q = mysqli_query($cn,$s) or die("Gagal mengubah jadwal tes baru. ". mysqli_error($cn));

echo "1__";

?>


