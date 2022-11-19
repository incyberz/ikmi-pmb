<?php 
// include 'cek_login_petugas.php';

if(!isset($_GET['id_popup'])) die("Index id_popup belum terdefinisi.");
$id_popup = $_GET['id_popup'];

if(!isset($_GET['field'])) die("Index field belum terdefinisi.");
$field = $_GET['field'];
if($field=="") die("Index field berisi null.");

if(!isset($_GET['isi'])) die("Index isi belum terdefinisi.");
$isi = $_GET['isi'];

include '../../config.php';
$s = "UPDATE tb_popup SET $field='$isi' WHERE id_popup='$id_popup'";
// die($s);
$q = mysqli_query($cn,$s) or die("Gagal mengubah data popup. $s ". mysqli_error($cn));

echo "1__";

?>