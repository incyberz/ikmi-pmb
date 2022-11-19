<?php  
// die("ajax kelulusan");
include 'cek_login_petugas.php';




$id_jadwal_tes = isset($_GET['id_jadwal_tes']) ? $_GET['id_jadwal_tes'] : die(undef("id_jadwal_tes"));
$id_daftar = isset($_GET['id_daftar']) ? $_GET['id_daftar'] : die(undef("id_daftar"));
$status_lulus = isset($_GET['status_lulus']) ? $_GET['status_lulus'] : die(undef("status_lulus"));
$grade_lulus = isset($_GET['grade_lulus']) ? $_GET['grade_lulus'] : die(undef("grade_lulus"));
$tanggal_lulus_tes = isset($_GET['tanggal_lulus_tes']) ? $_GET['tanggal_lulus_tes'] : die(undef("tanggal_lulus_tes"));
$alasan_tidak_tes = isset($_GET['alasan_tidak_tes']) ? $_GET['alasan_tidak_tes'] : die(undef("alasan_tidak_tes"));


$alasan_tidak_tes2 = $alasan_tidak_tes=="" ? "NULL" : "'$alasan_tidak_tes'";
$grade_lulus2 = $grade_lulus=="" ? "NULL" : "'$grade_lulus'";
$tanggal_lulus_tes2 = $tanggal_lulus_tes=="" ? "NULL" : "'$tanggal_lulus_tes'";


include '../../config.php';
$id_peserta_tes = $id_jadwal_tes."_$id_daftar";

$s = "UPDATE tb_daftar SET 
alasan_tidak_tes = $alasan_tidak_tes2, 
grade_lulus = $grade_lulus2, 
status_lulus = $status_lulus, 
tanggal_lulus_tes = $tanggal_lulus_tes2 
WHERE id_daftar='$id_daftar'
";
// die($s);
$q = mysqli_query($cn,$s) or die("gagal update kelulusan. ". mysqli_error($cn));


if($grade_lulus!=""){
	$s = "UPDATE tb_daftar SET grade_lulus = '$grade_lulus' where id_daftar=$id_daftar";
	// die($s);
	$q = mysqli_query($cn,$s) or die("gagal update grade lulus. ". mysqli_error($cn));
}


if(strtoupper($grade_lulus)!="A"){
	# ====================================================
	# EXCEPTION FEATURE
	# ====================================================
	# Switch Prodi bagi Jalur KIP Grade != A dan Prodi != TI
	# ====================================================
	$s = "SELECT id_jalur, id_prodi1, id_prodi2 from tb_daftar where id_daftar=$id_daftar";
	$q = mysqli_query($cn,$s) or die("Tidak dapat GET id_jalur. ".mysqli_error($cn));
	$d = mysqli_fetch_assoc($q);

	$id_jalur = $d['id_jalur'];
	$id_prodi1 = $d['id_prodi1'];
	$id_prodi2 = $d['id_prodi2'];

	if($id_jalur==3 and $id_prodi1==1){
		$s = "UPDATE tb_daftar SET id_prodi1 = $id_prodi2, id_prodi2 = $id_prodi1 WHERE id_daftar=$id_daftar";
		$q = mysqli_query($cn,$s) or die("Tidak dapat Switch Prodi. ".mysqli_error($cn));

		die("Grading Sukses dengan Auto-Switch Prodi.");
	}
}

// die($s);

echo "1__";

?>


