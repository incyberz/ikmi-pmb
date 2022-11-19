<?php 
session_start();
require_once "../config.php";
require_once "../pendaftar_var.php";

if (!isset($_GET['nama_tabel'])) die("Error AJAX. File acuan #1 undefined.");
if (!isset($_GET['field'])) die("Error AJAX. File acuan #2 undefined.");
if (!isset($_GET['isi'])) die("Error AJAX. File acuan #3 undefined.");
if (!isset($_GET['field_acuan'])) die("Error AJAX. File acuan #4 undefined.");
if (!isset($_GET['isi_acuan'])) die("Error AJAX. Isi acuan #5 undefined.");

$nama_tabel=trim($_GET['nama_tabel']);
$field=trim($_GET['field']);
$isi=trim($_GET['isi']);

if(strpos($isi,"=") || strpos(strtolower($isi),"where 1")){

	$isi_csv = "\n\n".date("Y-m-d H:i:s")
	. "\nPHP_SELF: "
	. $_SERVER['PHP_SELF']
	. "\nSERVER_NAME: "
	. $_SERVER['SERVER_NAME']
	. "\nHTTP_HOST: "
	. $_SERVER['HTTP_HOST']
	. "\nHTTP_REFERER: "
	. $_SERVER['HTTP_REFERER']
	. "\nHTTP_USER_AGENT: "
	. $_SERVER['HTTP_USER_AGENT']
	. "\nSCRIPT_NAME: "
	. $_SERVER['SCRIPT_NAME']
	. "\nFIELD: "
	. $field
	. "\nISI: "
	. $isi;

	$isi = str_replace("=","",$isi);
	$isi = str_replace("where 1","",$isi);
	$isi = str_replace("WHERE 1","",$isi);

	$path_csv = "breach__".date("Y-m-d").".log";
	$fcsv = fopen("$path_csv","a+") or die("file cannot accesible.");
	fwrite($fcsv, $isi_csv);
	fclose($fcsv);

}

if($field=="tahun_lulus") $isi = intval($isi);


# ============================================
# STOP PERUBAHAN DATA JIKA SUDAH ASSIGN TES
# ============================================
$s = "SELECT 1 from tb_peserta_tes where id_daftar=$id_daftar";
$q = mysqli_query($cn,$s) or die(mysqli_error($cn));
if(mysqli_num_rows($q)>0) die("Maaf, Anda saat ini tidak dapat melakukan perubahan data karena Anda sudah dijadwalkan oleh Petugas menjadi Peserta Tes PMB (lihat pada Menu Jadwal Tes). Hubungi Petugas via whatsApp jika ingin melakukan perubahan data.");
# ============================================



switch($nama_tabel){
	case 'tb_referal': $field_acuan="id_referal";$isi_acuan=$id_referal;break;
	case 'tb_calon': $field_acuan="id_calon";$isi_acuan=$id_calon;break;
	case 'tb_daftar': $field_acuan="id_daftar";$isi_acuan=$id_daftar;break;
	case 'tb_sekolah': $field_acuan="id_sekolah";$isi_acuan=$_GET['isi_acuan'];break;
	default: die("field_acuan belum terdefinisi untuk tabel: $nama_tabel");
}


$s = "UPDATE $nama_tabel set $field = '$isi' where $field_acuan = '$isi_acuan'";
$q = mysqli_query($cn,$s) or die("Error @ajax update_data_calon. SQL: $s. ".mysqli_error($cn));

if($field=="tahun_lulus"){
	$s = "UPDATE tb_daftar set id_jalur = NULL where id_daftar = '$id_daftar'";
	$q = mysqli_query($cn,$s) or die("Error @ajax update tambahan id_jalur. SQL: $s. ".mysqli_error($cn));
}

# =====================================================
# DELETE TABEL VERIFIKASI UPLOAD JIKA GANTI JALUR
# =====================================================
if($field=="id_jalur"){
	$s = "SELECT id_jalur from tb_daftar where id_daftar=$id_daftar";
	$q = mysqli_query($cn,$s) or die("Error @ajax get id_jalur. SQL: $s. ".mysqli_error($cn));
	if(mysqli_num_rows($q)!=1) die("Data jalur tidak ditemukan.");
	$d = mysqli_fetch_assoc($q);
	$id_jalur_db = $d['id_jalur'];

	if($isi != $id_jalur_db){
		# =====================================================
		# DELETE DATA UPLOAD
		# =====================================================
		$s2 = "DELETE from tb_verifikasi_upload where id_daftar=$id_daftar and id_persyaratan=2 or id_persyaratan=3";
		$q2 = mysqli_query($cn,$s2) or die("Tidak dapat menghapus data upload.". mysqli_error($cn));

	}

}



echo "1__Sukses mengupdate field: $field dengan nilai: $isi. $s";





?>