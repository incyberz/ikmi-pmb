<?php 
include 'cek_login_petugas.php';
require_once "../../config.php";

$field = isset($_GET['field']) ? $_GET['field'] : die("Index field undefined.");
$isi = isset($_GET['isi']) ? $_GET['isi'] : die("Index isi undefined.");
$email_calon = isset($_GET['email_calon']) ? $_GET['email_calon'] : die("Index email_calon undefined.");

$s = "UPDATE tb_akun set $field = '$isi' where email = '$email_calon'";
$q = mysqli_query($cn,$s) or die("Error @ajax #1. SQL: $s. ".mysqli_error($cn));

if($field=="no_wa"){
	$s = "UPDATE tb_akun set password = '$isi' where email = '$email_calon'";
	$q = mysqli_query($cn,$s) or die("Error @ajax #2. SQL: $s. ".mysqli_error($cn));
}

echo "1__";
?>