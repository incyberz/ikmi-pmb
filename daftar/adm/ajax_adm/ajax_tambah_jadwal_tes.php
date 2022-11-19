<?php 
include 'cek_login_petugas.php';

include '../../config.php';
$s = "INSERT INTO tb_jadwal_tes (nama_tes, id_gelombang) values('[Click to edit]',$id_gelombang_aktif)";
// die($s);
$q = mysqli_query($cn,$s) or die("Gagal menambah jadwal tes baru. ". mysqli_error($cn));

echo "1__";

?>


