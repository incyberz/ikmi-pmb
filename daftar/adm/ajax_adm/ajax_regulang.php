<?php  
// die("ajax kelulusan");
include 'cek_login_petugas.php';

$id_daftar = isset($_GET['id_daftar']) ? $_GET['id_daftar'] : die("undefined-idx: id_daftar");
$set_reg = isset($_GET['set_reg']) ? $_GET['set_reg'] : die("undefined-idx: set_reg");
$tgl_reg = isset($_GET['tgl_reg']) ? $_GET['tgl_reg'] : die("undefined-idx: tgl_reg");


include '../../config.php';

$sql_tgreg = $set_reg=="1" ? " '$tgl_reg' " : "NULL";

$s = "UPDATE tb_daftar SET 
tanggal_registrasi_ulang = $sql_tgreg   
WHERE id_daftar='$id_daftar'
";

// die($s);
$q = mysqli_query($cn,$s) or die("gagal update tanggal registrasi ulang. ". mysqli_error($cn));

echo "1__";

?>


