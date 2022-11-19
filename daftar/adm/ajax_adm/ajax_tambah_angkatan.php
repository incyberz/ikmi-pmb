<?php 
include 'cek_login_petugas.php';

$new_id_angkatan = isset($_GET['id_angkatan']) ? $_GET['id_angkatan'] : die("Index id_angkatan belum terdefinisi.");

include '../../config.php';
$s = "INSERT INTO tb_angkatan 
(id_angkatan, tgl_pembukaan, tgl_penutupan) values
($new_id_angkatan, CURRENT_DATE, CURRENT_DATE)";
// die($s);
$q = mysqli_query($cn,$s) or die("AddNew Failed. \n\n". mysqli_error($cn));

echo "1__";

?>


