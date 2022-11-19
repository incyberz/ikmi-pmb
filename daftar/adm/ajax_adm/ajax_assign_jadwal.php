<?php 
include 'cek_login_petugas.php';

if(!isset($_GET['id_jadwal_tes'])) die("Index id_jadwal_tes belum terdefinisi.");
$id_jadwal_tes = $_GET['id_jadwal_tes'];
if(!isset($_GET['id_daftar'])) die("Index id_daftar belum terdefinisi.");
$id_daftar = $_GET['id_daftar'];

include '../../config.php';
$id_peserta_tes = $id_jadwal_tes."_$id_daftar";
$s = "INSERT INTO tb_peserta_tes 
(id_peserta_tes, id_jadwal_tes,id_daftar) values 
('$id_peserta_tes', '$id_jadwal_tes','$id_daftar')";
// die($s);
$q = mysqli_query($cn,$s) or die("gagal insert peserta tes. ". mysqli_error($cn));

// $s = "UPDATE tb_daftar SET id_peserta_tes";




echo "1__";

?>


