<?php 
include 'cek_login_petugas.php';

if(!isset($_GET['id_jadwal_tes'])) die("Index id_jadwal_tes belum terdefinisi.");
$id_jadwal_tes = $_GET['id_jadwal_tes'];

include '../../config.php';
$s = "DELETE FROM tb_jadwal_tes WHERE id_jadwal_tes=$id_jadwal_tes";
// die($s);
$q = mysqli_query($cn,$s) or die("Gagal menghapus jadwal tes baru. ". mysqli_error($cn));

echo "1__";

?>


