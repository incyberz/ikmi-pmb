<?php 
include 'cek_login_petugas.php';

if(!isset($_GET['email'])) die("Index email belum terdefinisi.");
if(!isset($_GET['field'])) die("Index field belum terdefinisi.");
if(!isset($_GET['nilai'])) die("Index nilai belum terdefinisi.");

$email = $_GET['email'];
$field = $_GET['field'];
$nilai = $_GET['nilai'];

include '../../config.php';
$s = "UPDATE tb_akun SET $field='$nilai' where email='$email'";
// die($s);
$q = mysqli_query($cn,$s) or die("gagal update akun. ". mysqli_error($cn));

echo "Sukses update akun.";

?>