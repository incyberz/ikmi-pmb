<div style="padding: 15px;">
	<h5>Submit Processing</h5>
	<hr>
	
<?php 

// echo "<pre>";
// echo var_dump($_POST);
// echo "</pre>";




// $id_prodi1 = $_POST['id_prodi1'];
// $id_prodi2 = $_POST['id_prodi2'];
// $id_jalur = $_POST['id_jalur'];
// $nik = $_POST['nik'];
// $jenis_kelamin = $_POST['jenis_kelamin'];
// $tempat_lahir = $_POST['tempat_lahir'];
// $tanggal_lahir = $_POST['tanggal_lahir'];
// $id_nama_kec_ktp = $_POST['id_nama_kec_ktp'];
// $alamat_desa_ktp = $_POST['alamat_desa_ktp'];
// $kode_pos_nama_kec_ktp = $_POST['kode_pos_nama_kec_ktp'];
// $alamat_desa_domisili = $_POST['alamat_desa_domisili'];
// $kode_pos_nama_kec_domisili = $_POST['kode_pos_nama_kec_domisili'];
// $status_menikah = $_POST['status_menikah'];
// $agama = $_POST['agama'];
// $warga_negara = $_POST['warga_negara'];
// $no_hp = $_POST['no_hp'];
// $no_ayah = $_POST['no_ayah'];
// $no_ibu = $_POST['no_ibu'];
// $no_saudara = $_POST['no_saudara'];
// $id_referal = $_POST['id_referal'];
// $is_bekerja = $_POST['is_bekerja'];
// $is_wirausaha = $_POST['is_wirausaha'];

# =====================================================
# BLOK JALUR KIP
# =====================================================
$id_jalur = $_POST['id_jalur'];
if($id_jalur==3) die("
	Maaf, Jalur KIP sudah ditutup, silahkan Pilih Jalur lainnya.
	<hr>
	<a class='btn btn-primary' href='?formulir'>Kembali ke Formulir</a>
	");

# =====================================================
# PROSES PERSETUJUAN
# =====================================================
$syarat_indisabilitas = $_POST['syarat_indisabilitas'];
$syarat_input_benar = $_POST['syarat_input_benar'];
$syarat_bersedia = $_POST['syarat_bersedia'];

if($syarat_indisabilitas!="on" or $syarat_input_benar!="on" or $syarat_bersedia!="on")
	die("<div class='alert alert-danger'>Maaf, Anda belum menceklis semua persetujuan. | $link_back </div>");







# =====================================================
# AUTOSAVE NEW SEKOLAH PROCESSING
# =====================================================
$id_sekolah = $_POST['id_sekolah'];
$asal_sekolah = $_POST['asal_sekolah'];
$id_nama_kec_sekolah = $_POST['id_nama_kec_sekolah'];


if($id_sekolah==""){

	$jenis_sekolah = $_POST['jenis_sekolah'];
	$status_sekolah = $_POST['status_sekolah'];

	$id_kec_sekolah_sql = $id_nama_kec_sekolah; 
	if($id_nama_kec_sekolah=="") $id_kec_sekolah_sql = "NULL";

	$s = "INSERT INTO tb_sekolah 
	(id_kec_sekolah, nama_sekolah, alamat_sekolah,jenis_sekolah, status_sekolah) values 
	($id_kec_sekolah_sql, '$asal_sekolah', NULL, $jenis_sekolah, $status_sekolah)";
	$q = mysqli_query($cn,$s) or die(mysqli_error($cn));

	echo "Save New Sekolah sukses.<hr>";

}else{
	//cek id_kec sekolah
	//zzz here duplicate save sekolah
	$s = "SELECT id_kec_sekolah from tb_sekolah where id_sekolah=$id_sekolah";
	$q = mysqli_query($cn,$s) or die(mysqli_error($cn));
	if(mysqli_num_rows($q)!=1) die("Sekolah asal dengan id: $id_sekolah tidak ditemukan.");
	$d = mysqli_fetch_assoc($q);

	$id_kec_sekolah = $d['id_kec_sekolah'];

	if($id_kec_sekolah==""){
		//update id_kec_sekolah
		$s = "UPDATE tb_sekolah set id_kec_sekolah=$id_nama_kec_sekolah where id_sekolah=$id_sekolah";
		$q = mysqli_query($cn,$s) or die(mysqli_error($cn));

		echo "Updating data sekolah.. OK";
	}else{
		echo "Data sekolah asal.. OK<hr>";
	}
}



# =====================================================
# TIMESTAMPS SUBMIT FORMULIR
# =====================================================
$s = "UPDATE tb_daftar set tanggal_submit_formulir=CURRENT_TIMESTAMP where id_daftar=$id_daftar";
$q = mysqli_query($cn,$s) or die(mysqli_error($cn));

echo "<div class='alert alert-info'>Pilihan Prodi:
<ol>
	<li>$jenjang1 - $nama_prodi1</li>
	<li>$jenjang2 - $nama_prodi2</li>
</ol>
Jalur Pendaftaran: $nama_jalur </div>
";
echo "<hr>";
echo "Submit Data Pendaftaran berhasil.<hr>";

?>
<a href="?" class="btn btn-primary">Kembali ke Dashboard</a>

</div>
