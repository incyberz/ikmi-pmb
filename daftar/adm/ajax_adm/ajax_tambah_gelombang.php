<?php 
include 'cek_login_petugas.php';

$id_gelombang = isset($_GET['id_gelombang']) ? $_GET['id_gelombang'] : die("Index id_gelombang belum terdefinisi.");
$id_angkatan = date("Y");

include '../../config.php';
$s = "INSERT INTO tb_gelombang 
(id_gelombang, id_angkatan, nama_gel, tanggal_awal_gel, tanggal_akhir_gel, status_gel) values
($id_gelombang, $id_angkatan, 'nama_gel baru', CURRENT_DATE, CURRENT_DATE, 0)";
// die($s);
$q = mysqli_query($cn,$s) or die("AddNew Failed. \n\n". mysqli_error($cn));

echo "1__";

?>


