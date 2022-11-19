<?php 
include "../../config.php";
if (!isset($_GET['id_jndaftar'])) die("Error @AJAX-File Get Keterangan Jalur. ID Jenis Daftar belum terdefinisi.");

$id_jndaftar = $_GET['id_jndaftar'];
if($id_jndaftar=="0" or $id_jndaftar==0) die("Error @AJAX-File Get Keterangan Jalur. ID Jenis Daftar tidak boleh nol.");

$s = " SELECT * from tb_daftar_jndaftar where id_jndaftar = '$id_jndaftar'
	";

	// die($s);

$q = mysqli_query($cn,$s) or die("Error @AJAX-File Get Keterangan Jalur. Query Gagal.");
if(mysqli_num_rows($q)!=1) die("Error @AJAX-File Get Keterangan Jalur. Query harus minimal satu baris.");
$d = mysqli_fetch_assoc($q);

$ket_jalur = $d['ket_jalur'];

echo "1__$ket_jalur";
?>