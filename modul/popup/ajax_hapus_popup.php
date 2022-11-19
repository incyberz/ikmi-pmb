<?php 
// include 'cek_login_petugas.php';

if(!isset($_GET['id_popup'])) die("Index id_popup belum terdefinisi.");
$id_popup = $_GET['id_popup'];

include '../../config.php';
$s = "DELETE FROM tb_popup WHERE id_popup=$id_popup";
// die($s);
$q = mysqli_query($cn,$s) or die("Gagal menghapus popup. ". mysqli_error($cn));

echo "1__";

?>


