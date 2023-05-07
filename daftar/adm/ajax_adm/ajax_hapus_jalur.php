<?php 
include 'cek_login_petugas.php';

$acuan_id_jalur = isset($_GET['id_jalur']) ? $_GET['id_jalur'] : die("Index id_jalur belum terdefinisi.");

include '../../config.php';
$s = "DELETE FROM tb_jalur WHERE id_jalur=$acuan_id_jalur";
// die($s);
$q = mysqli_query($cn,$s) or die("Gagal menghapus. ". mysqli_error($cn));

echo "1__";

?>