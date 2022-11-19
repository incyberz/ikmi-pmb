<?php 
include 'cek_login_petugas.php';

$id_sekolah = isset($_GET['id_sekolah']) ? $_GET['id_sekolah'] : die("Index id_sekolah belum terdefinisi.");

include '../../config.php';
$s = "DELETE FROM tb_sekolah WHERE id_sekolah=$id_sekolah";
// die($s);
$q = mysqli_query($cn,$s) or die("Gagal menghapus. ". mysqli_error($cn));

echo "1__";

?>


