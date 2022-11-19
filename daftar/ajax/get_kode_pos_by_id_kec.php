<?php 
include "../config.php";
if (!isset($_GET['id_kec'])) die("Error @ajax :: id_kec index belum terdefinisi.");

$id_kec = $_GET['id_kec'];

$s = " SELECT a.kode_pos, c.kode_pos_prov from tb_kec a 
join tb_kab b on a.id_kab=b.id_kab 
join tb_prov c on b.id_prov=c.id_prov 
where id_kec = '$id_kec'";
$q = mysqli_query($cn,$s) or die("Error id_kec-AJAX-File at Query. ".mysqli_error($cn));
if(mysqli_num_rows($q)!=1) die("Error id_kec-AJAX-File, hasil query harus satu baris.");
$d = mysqli_fetch_array($q);

$kode_pos = $d['kode_pos'];
$kode_pos_prov = $d['kode_pos_prov'];

echo "1__$kode_pos;$kode_pos_prov";
?>