<?php 
include 'cek_login_petugas.php';

if(!isset($_GET['id_jadwal_tes'])) die("Index id_jadwal_tes belum terdefinisi.");
if(!isset($_GET['id_daftar'])) die("Index id_daftar belum terdefinisi.");

$id_jadwal_tes = $_GET['id_jadwal_tes'];
$id_daftar = $_GET['id_daftar'];

include '../../config.php';
$id_peserta_tes = $id_jadwal_tes."_$id_daftar";
$s = "DELETE FROM tb_peserta_tes where id_jadwal_tes='$id_jadwal_tes' and id_daftar='$id_daftar'";
// die($s);
$q = mysqli_query($cn,$s) or die("gagal drop peserta tes. ". mysqli_error($cn));

echo "1__";

?>


