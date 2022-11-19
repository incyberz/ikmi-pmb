<?php 
include 'cek_login_petugas.php';

$id_gelombang = isset($_GET['id_gelombang']) ? $_GET['id_gelombang'] : die("Index id_gelombang belum terdefinisi.");

include '../../config.php';
$s = "DELETE FROM tb_gelombang WHERE id_gelombang=$id_gelombang";
// die($s);
$q = mysqli_query($cn,$s) or die("Gagal menghapus. ". mysqli_error($cn));

echo "1__";

?>


