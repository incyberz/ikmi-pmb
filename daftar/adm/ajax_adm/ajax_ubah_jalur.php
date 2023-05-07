<?php 
include 'cek_login_petugas.php';

$id_jalur = isset($_GET['id_jalur']) ? $_GET['id_jalur'] : die("Index id_jalur belum terdefinisi.");
$kolom = isset($_GET['kolom']) ? $_GET['kolom'] : die("Index kolom belum terdefinisi.");
$isi = isset($_GET['isi']) ? $_GET['isi'] : die("Index isi belum terdefinisi.");

include '../../config.php';

$s = "UPDATE tb_jalur SET $kolom='$isi' WHERE id_jalur='$id_jalur'";
// die($s);
$q = mysqli_query($cn,$s) or die("Update Failed. ". mysqli_error($cn));


echo "1__";

?>


