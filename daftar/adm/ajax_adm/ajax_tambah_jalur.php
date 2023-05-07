<?php 
include 'cek_login_petugas.php';

$nama_jalur = isset($_GET['nama_jalur']) ? $_GET['nama_jalur'] : die("Index nama_jalur belum terdefinisi.");

$tahun = date('Y');
$singkatan_jalur = 'NEW JALUR';
include '../../config.php';
$s = "INSERT INTO tb_jalur (id_angkatan,nama_jalur,singkatan_jalur) values
($tahun,'$nama_jalur','$singkatan_jalur')";
// die($s);
$q = mysqli_query($cn,$s) or die("AddNew Failed. \n\n". mysqli_error($cn));

echo "1__";

?>


