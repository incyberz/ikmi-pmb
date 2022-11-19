<?php 
// include 'cek_login_petugas.php';

include '../../config.php';
$s = "INSERT INTO tb_popup (

judul_popup, upload_by, ekstensi_file, ket_popup, status_popup
) values(
'[Click to edit]',1,    'jpg','[Click to edit]',  0
)
";
// die($s);
$q = mysqli_query($cn,$s) or die("Gagal menambah popup baru. ". mysqli_error($cn));

echo "1__";

?>


