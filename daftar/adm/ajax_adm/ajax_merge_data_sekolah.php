<?php 
include 'cek_login_petugas.php';

$id_sekolah_1 = isset($_GET['id_sekolah_1']) ? $_GET['id_sekolah_1'] : die("Index id_sekolah_1 belum terdefinisi.");
$id_sekolah_2 = isset($_GET['id_sekolah_2']) ? $_GET['id_sekolah_2'] : die("Index id_sekolah_2 belum terdefinisi.");

include '../../config.php';
$s = "UPDATE tb_calon SET id_sekolah=$id_sekolah_1 WHERE id_sekolah=$id_sekolah_2";
$s2 = "DELETE FROM tb_sekolah WHERE id_sekolah=$id_sekolah_2";
// die("$s <hr> $s2");
$q = mysqli_query($cn,$s) or die("Gagal Merge. ". mysqli_error($cn));
$q2 = mysqli_query($cn,$s2) or die("Gagal menghapus. ". mysqli_error($cn));

echo "1__";

?>


