<?php 
include "../../config.php";
if (!isset($_GET['id_daftar'])) die("Error #3ee7bcc443241");
if (!isset($_GET['id_jndaftar'])) die("Error #3ee7bcc4432d2");
if (!isset($_GET['id_jalur'])) die("Error #3ee7bcc4432h3");
if (!isset($_GET['no_daf'])) die("Error #7a2g3eebcc443h24");
if (!isset($_GET['no_daf_kip'])) die("Error #73eebcc443h24");
if (!isset($_GET['kip_invitation_code'])) die("Error #kip_invitation_code");

$id_daftar = $_GET['id_daftar'];
$id_jndaftar = $_GET['id_jndaftar'];
$id_jalur = $_GET['id_jalur'];
$no_daf= $_GET['no_daf'];
$no_daf_kip= $_GET['no_daf_kip'];
$kip_invitation_code= $_GET['kip_invitation_code'];

if (strtoupper($kip_invitation_code)!="D8MNVH" and $id_jndaftar==5) die("KIP Bantim Invitation Code invalid or expire.\n\nSilahkan Anda hubungi Front Office STMIK IKMI Cirebon.");

if (strtoupper($kip_invitation_code)!="QLBRDP" and $id_jndaftar==6) die("KIP PKH Kota Cirebon Invitation Code invalid or expire.\n\nSilahkan Anda hubungi Front Office STMIK IKMI Cirebon.");

if (strtoupper($kip_invitation_code)!="PR6HB7" and $id_jndaftar==7) die("KIP PKH Kab Cirebon Invitation Code invalid or expire.\n\nSilahkan Anda hubungi Front Office STMIK IKMI Cirebon.");

if (strtoupper($kip_invitation_code)!="PBAUFV" and $id_jndaftar==8) die("KIP PKH Kab Kuningan Invitation Code invalid or expire.\n\nSilahkan Anda hubungi Front Office STMIK IKMI Cirebon.");

if (strtoupper($kip_invitation_code)!="N1JY95" and $id_jndaftar==9) die("KIP PKH Kab Indramayu Invitation Code invalid or expire.\n\nSilahkan Anda hubungi Front Office STMIK IKMI Cirebon.");

if (strtoupper($kip_invitation_code)!="MEH7DS" and $id_jndaftar==10) die("KIP PKH Kab Majalengka Invitation Code invalid or expire.\n\nSilahkan Anda hubungi Front Office STMIK IKMI Cirebon.");

if (strtoupper($kip_invitation_code)!="6SKRTE" and $id_jndaftar==11) die("KIP PKH Kab Ciamis Invitation Code invalid or expire.\n\nSilahkan Anda hubungi Front Office STMIK IKMI Cirebon.");

if (strtoupper($kip_invitation_code)!="4BZFRV" and $id_jndaftar==12) die("KIP PKH Kab Subang Invitation Code invalid or expire.\n\nSilahkan Anda hubungi Front Office STMIK IKMI Cirebon.");

if($id_jndaftar>12 or $id_jndaftar<1) die("Maaf, Jalur Daftar: $id_jndaftar saat ini ditutup.");


$s = "
	UPDATE tb_daftar set 
	id_jndaftar = '$id_jndaftar',
	id_jalur = '$id_jalur',
	no_daf = '$no_daf',
	no_daf_kip = '$no_daf_kip'
	where id_daftar = '$id_daftar'
	";

	// die($s);

$q = mysqli_query($cn,$s) or die("Error #bcdcdasd55dcdb6a ".mysqli_error($cn));
if ($q) echo "Update Jalur Daftar berhasil.";
?>