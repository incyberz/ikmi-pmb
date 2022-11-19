<?php 
include 'cek_login_petugas.php';

$email = isset($_GET['email']) ? $_GET['email'] : die("Index email belum terdefinisi.");
$field = isset($_GET['field']) ? $_GET['field'] : die("Index field belum terdefinisi.");
$nilai = isset($_GET['nilai']) ? $_GET['nilai'] : die("Index nilai belum terdefinisi.");
$alasan_resign = isset($_GET['alasan_resign']) ? $_GET['alasan_resign'] : die("Index alasan_resign belum terdefinisi.");
$alasan_resign = $alasan_resign == "" ? "NULL" : "'$alasan_resign'";

include '../../config.php';

$s = "UPDATE tb_akun SET $field='$nilai', alasan_resign= $alasan_resign where email='$email'";
// die($s);
$q = mysqli_query($cn,$s) or die("gagal update akun. ". mysqli_error($cn));

echo "Sukses update akun.";

?>