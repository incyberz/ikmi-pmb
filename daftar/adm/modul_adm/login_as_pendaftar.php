<h2>Login As Pendaftar</h2>
<?php 
function undef($z){ return "<hr><span style='color:red'>Error at AJAX. Index <u>$z</u> belum terdefinisi.</span><hr>";}


$email_calon = isset($_GET['email_calon']) ? $_GET['email_calon'] : die(undef("email_calon"));
$nama_calon = isset($_GET['nama_calon']) ? $_GET['nama_calon'] : die(undef("nama_calon"));
$id_daftar = isset($_GET['id_daftar']) ? $_GET['id_daftar'] : die(undef("id_daftar"));
$id_calon = isset($_GET['id_calon']) ? $_GET['id_calon'] : die(undef("id_calon"));

$_SESSION['pendaftar_email'] = $email_calon;
$_SESSION['pendaftar_nama'] = $nama_calon;
$_SESSION['pendaftar_admin_level'] = 1;
$_SESSION['pendaftar_id_daftar'] = $id_daftar;
$_SESSION['pendaftar_id_calon'] = $id_calon;

?>

<hr>
Anda sudah login sebagai Pendaftar.
<hr>
<a href="../" target="_blank">Go to Pendaftar Home</a>