<?php 
include 'cek_login_petugas.php';

$acuan_id_angkatan = isset($_GET['id_angkatan']) ? $_GET['id_angkatan'] : die("Index id_angkatan belum terdefinisi.");

include '../../config.php';
$s = "DELETE FROM tb_angkatan WHERE id_angkatan=$acuan_id_angkatan";
// die($s);
$q = mysqli_query($cn,$s) or die("Gagal menghapus. ". mysqli_error($cn));

echo "1__";

?>