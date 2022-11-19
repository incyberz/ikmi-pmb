<?php 
session_start();

$index_session = [
	"admpmb_email",
	"admpmb_id_petugas",
	"admpmb_nama_petugas",
	"admpmb_admin_level",
	"admpmb_jabatan_petugas"
];

for ($i=0; $i < count($index_session) ; $i++) 
	if(!isset($_SESSION[$index_session[$i]])) die("Anda belum login sebagai Petugas PMB. #$i");

$admpmb_email = $_SESSION['admpmb_email'];
$id_petugas = $_SESSION['admpmb_id_petugas'];
$nama_petugas = $_SESSION['admpmb_nama_petugas'];
$admin_level = $_SESSION['admpmb_admin_level'];
$jabatan_petugas = $_SESSION['admpmb_jabatan_petugas'];

function undef($z){ return "Error @AJAX. Index $z belum terdefinisi.";}

?>