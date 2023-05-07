<?php 
include 'cek_login_petugas.php';

include '../../config.php';
$id_gelombang_selected = isset($_GET['id_gelombang_selected'])?$_GET['id_gelombang_selected']:die('Index id_gelombang_selected masih null.');
$s = "INSERT INTO tb_jadwal_tes (nama_tes, id_gelombang) values('[Click to edit]',$id_gelombang_selected)";
// die($s);
$q = mysqli_query($cn,$s) or die("Gagal menambah jadwal tes baru. ". mysqli_error($cn));

echo "1__";

?>


