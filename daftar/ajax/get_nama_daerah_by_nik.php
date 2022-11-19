<?php 
include "../config.php";
if (!isset($_GET['nik'])) die("Error @ajax :: nik index belum terdefinisi.");

$nik = $_GET['nik'];
$id_kec = substr($nik,0,6);

$s = " SELECT * from tb_kec a 
join tb_kab b on a.id_kab=b.id_kab 
join tb_prov c on b.id_prov=c.id_prov 
where id_kec = '$id_kec'";
$q = mysqli_query($cn,$s) or die("Error NIK-AJAX-File at Query. ".mysqli_error($cn));
if(mysqli_num_rows($q)==0) die("Error NIK-AJAX-File, kode kecamatan tidak terdaftar. id_kec:$id_kec");
if(mysqli_num_rows($q)>1) die("Error NIK-AJAX-File, hasil query harus satu baris. id_kec:$id_kec");
$d = mysqli_fetch_array($q);

$nama_kec = $d['nama_kec'];
$nama_kab = $d['nama_kab'];
$nama_prov = $d['nama_prov'];
$kode_pos = $d['kode_pos'];

$nama_kec = ucwords(strtolower($nama_kec));
$nama_kab = ucwords(strtolower($nama_kab));
$nama_prov = ucwords(strtolower($nama_prov));

echo "1__$nama_kec;$nama_kab;$nama_prov;$kode_pos";
?>