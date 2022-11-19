<?php 
include "../../config.php";
if (!isset($_GET['email'])) die("Error #abcc443241");
if (!isset($_GET['no_kip'])) die("Error #abcc4432d2");
if (!isset($_GET['no_kps'])) die("Error #abcc4432h3");

$email = $_GET['email'];
$no_kip = $_GET['no_kip'];
$no_kps = $_GET['no_kps'];

$s = "
	UPDATE tb_calon set 
	no_kip = '$no_kip',
	no_kps = '$no_kps'
	where email = '$email'
	";

if ($no_kip=="" and $no_kps!="") {
	$s = "
		UPDATE tb_calon set 
		no_kip = null,
		no_kps = '$no_kps'
		where email = '$email'
		";
}
if ($no_kip!="" and $no_kps=="") {
	$s = "
		UPDATE tb_calon set 
		no_kip = '$no_kip',
		no_kps = null
		where email = '$email'
		";
}
if ($no_kip=="" and $no_kps=="") {
	$s = "
		UPDATE tb_calon set 
		no_kip = null,
		no_kps = null 
		where email = '$email'
		";
}



	// die($s);

$q = mysqli_query($cn,$s) or die("Error #bcavdaad55dcdb6a ".mysqli_error($cn));
if ($q) {
	echo "Update data KIP/KPS berhasil.";
}else{
	echo "Update Failed";
}
?>