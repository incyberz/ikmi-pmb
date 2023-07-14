<?php 
$id_daftar = $_GET['id_daftar'];
$zzz = "zzz";


$img_help = "<img src='../assets/img/icons/help.png' width='20px'>";
$img_check = "<img src='../assets/img/icons/check.png' width='20px'>";
$img_wa = "<img src='../assets/img/icons/wa.png' width='30px'>";
$img_loading = "<img src='../assets/img/icons/loading6.gif' width='20px'>";
$img_warning = "<img src='../assets/img/icons/warning.png' width='20px'>";


$link_grup_wa = "https://chat.whatsapp.com/INisQLmreivH56hTMbuo7H";

$s = "SELECT 

a.*,
b.*,
c.no_wa,
c.status_no_wa,
c.status_email,
c.akun_created,
c.nama_calon,
c.status_akun,
(select nama_kab from tb_kab where id_kab=a.id_kab_tempat_lahir) as tempat_lahir, 
(select nama_kec from tb_kec where id_kec=a.id_nama_kec_sekolah) as nama_kec_sekolah,
(select nama_kec from tb_kec where id_kec=a.id_nama_kec_ktp) as nama_kec_ktp,
(select nama_kec from tb_kec where id_kec=a.id_nama_kec_domisili) as nama_kec_domisili, 

(select x.nama_kab from tb_kab x join tb_kec y on x.id_kab=y.id_kab where y.id_kec=a.id_nama_kec_sekolah) as nama_kab_sekolah,
(select x.nama_kab from tb_kab x join tb_kec y on x.id_kab=y.id_kab where y.id_kec=a.id_nama_kec_ktp) as nama_kab_ktp,
(select x.nama_kab from tb_kab x join tb_kec y on x.id_kab=y.id_kab where y.id_kec=a.id_nama_kec_domisili) as nama_kab_domisili, 
(select nama_prodi from tb_prodi where id_prodi=b.id_prodi1) as nama_prodi1, 
(select nama_prodi from tb_prodi where id_prodi=b.id_prodi2) as nama_prodi2, 
(select singkatan_prodi from tb_prodi where id_prodi=b.id_prodi1) as singkatan_prodi1, 
(select singkatan_prodi from tb_prodi where id_prodi=b.id_prodi2) as singkatan_prodi2, 
(select jenjang from tb_prodi where id_prodi=b.id_prodi1) as jenjang1, 
(select jenjang from tb_prodi where id_prodi=b.id_prodi2) as jenjang2, 
(select nama_jalur from tb_jalur where id_jalur=b.id_jalur) as nama_jalur 

from tb_calon a 
join tb_akun c on a.email=c.email 
join tb_daftar b on a.email=b.email 
where b.id_daftar='$id_daftar'";
$q = mysqli_query($cn,$s) or die("Global var error. ".mysqli_error($cn));
if(mysqli_num_rows($q)!=1) die("Data calon tidak ada. email_calon: $email_calon");


$d = mysqli_fetch_assoc($q);

if(0){echo "<pre>"; echo var_dump($d); echo "</pre>"; exit();}
// $id_calon = $d['id_calon'];
// $id_daftar = $d['id_daftar'];

# ===========================================
# DATA AKUN
# ===========================================
$no_wa = $d['no_wa'];
$status_no_wa = $d['status_no_wa'];
$status_email = $d['status_email'];
$akun_created = $d['akun_created'];
$nama_calon = $d['nama_calon'];
$email_calon = $d['email'];
$status_akun = $d['status_akun'];



# ===========================================
# DATA CALON
# ===========================================
$id_calon   = $d['id_calon'];
$id_sekolah   = $d['id_sekolah'];
$tahun_lulus  = $d['tahun_lulus'];
$nisn   = $d['nisn'];
$prodi_asal  = $d['prodi_asal'];
$nik   = $d['nik'];
$tanggal_lahir  = $d['tanggal_lahir'];
$jenis_kelamin  = $d['jenis_kelamin'];
$status_menikah  = $d['status_menikah'];
$agama  = $d['agama'];
$warga_negara  = $d['warga_negara'];
$alamat_desa_ktp  = $d['alamat_desa_ktp'];
$alamat_desa_domisili  = $d['alamat_desa_domisili'];
$nama_ayah  = $d['nama_ayah'];
$nama_ibu  = $d['nama_ibu'];
$id_pekerjaan_ayah  = $d['id_pekerjaan_ayah'];
$id_pekerjaan_ibu  = $d['id_pekerjaan_ibu'];
$no_hp   = $d['no_hp'];
$no_ayah  = $d['no_ayah'];
$no_ibu  = $d['no_ibu'];
$no_saudara  = $d['no_saudara'];
$is_bekerja  = $d['is_bekerja'];
$is_wirausaha  = $d['is_wirausaha'];
$kode_pos_nama_kec_ktp  = $d['kode_pos_nama_kec_ktp'];
$kode_pos_nama_kec_domisili  = $d['kode_pos_nama_kec_domisili'];
$id_nama_kec_sekolah = $d['id_nama_kec_sekolah'];
$id_nama_kec_ktp = $d['id_nama_kec_ktp'];
$id_nama_kec_domisili = $d['id_nama_kec_domisili'];
$id_kab_tempat_lahir = $d['id_kab_tempat_lahir'];
$tempat_lahir = $d['tempat_lahir'];

# ===========================================
# TO PROPER NAMA ORANG
# ===========================================
$nama_calon = ucwords(strtolower($nama_calon));
$nama_ayah = ucwords(strtolower($nama_ayah));
$nama_ibu = ucwords(strtolower($nama_ibu));







# ===========================================
# DATA DAFTAR
# ===========================================
$id_gelombang = $d['id_gelombang'];
$id_prodi1 = $d['id_prodi1'];
$id_prodi2 = $d['id_prodi2'];
$id_jalur = $d['id_jalur'];
$id_kelas = $d['id_kelas'];
$id_jadwal_tes = $d['id_jadwal_tes'];
$id_referal = $d['id_referal'];
$status_daftar = $d['status_daftar'];
$status_lulus = $d['status_lulus'];
$tanggal_daftar = $d['tanggal_daftar'];
$tanggal_submit_formulir = $d['tanggal_submit_formulir'];
$tanggal_tes_pmb = $d['tanggal_tes_pmb'];
$tanggal_lulus_tes = $d['tanggal_lulus_tes'];
$folder_uploads = $d['folder_uploads'];



# ===========================================
# GET NAMA PRODI/SINGKATAN PRODI
# ===========================================
$nama_prodi1 = $d['nama_prodi1'];
$nama_prodi2 = $d['nama_prodi2'];
$singkatan_prodi1 = $d['singkatan_prodi1'];
$singkatan_prodi2 = $d['singkatan_prodi2'];
$jenjang1 = $d['jenjang1'];
$jenjang2 = $d['jenjang2'];

$nama_jalur = $d['nama_jalur'];


# ===========================================
# NAMA KECAMATAN/KAB
# ===========================================
$nama_kec_sekolah = $d['nama_kec_sekolah'];
$nama_kec_ktp = $d['nama_kec_ktp'];
$nama_kec_domisili = $d['nama_kec_domisili'];

$nama_kab_sekolah = $d['nama_kab_sekolah'];
$nama_kab_ktp = $d['nama_kab_ktp'];
$nama_kab_domisili = $d['nama_kab_domisili'];

if($nama_kec_sekolah!="") $nama_kec_sekolah = strtoupper("Kec $nama_kec_sekolah $nama_kab_sekolah");
if($nama_kec_ktp!="") $nama_kec_ktp = strtoupper("Kec $nama_kec_ktp $nama_kab_ktp");
if($nama_kec_domisili!="") $nama_kec_domisili = strtoupper("Kec $nama_kec_domisili $nama_kab_domisili");



# ===========================================
# DATA SEKOLAH
# ===========================================
$asal_sekolah = '';
$jenis_sekolah = '';
$status_sekolah = '';
$id_kec_sekolah = '';

$nama_kec_sekolah_disabled = '';
$jenis_sekolah_disabled = '';
$status_sekolah_disabled = '';

if($id_sekolah!=""){
	$s = "SELECT * from tb_sekolah where id_sekolah='$id_sekolah'";
	$q = mysqli_query($cn,$s) or die("Tidak bisa retrieve data sekolah. ".mysqli_error($cn));
	if(mysqli_num_rows($q)!=1) die("Data sekolah tidak ditemukan. <hr>$s");
	$d=mysqli_fetch_assoc($q);

	$id_kec_sekolah = $d['id_kec_sekolah'];
	$nama_sekolah = $d['nama_sekolah'];
	$alamat_sekolah = $d['alamat_sekolah'];
	$jenis_sekolah = $d['jenis_sekolah'];
	$status_sekolah = $d['status_sekolah'];
	$is_validated = $d['is_validated'];

	$asal_sekolah = $nama_sekolah;
	if($status_sekolah=="") $status_sekolah="-";
	if($jenis_sekolah=="") $jenis_sekolah="-";
	// $jenis_sekolah_disabled = "disabled";
	// $status_sekolah_disabled = "disabled";

	if($id_kec_sekolah!=""){
		$s = "SELECT nama_kec,nama_kab from tb_kec a 
		join tb_kab b on a.id_kab=b.id_kab 
		where id_kec='$id_kec_sekolah'";
		$q = mysqli_query($cn,$s) or die("Tidak bisa retrieve data kec/kab sekolah. ".mysqli_error($cn));
		$d = mysqli_fetch_assoc($q);
		$nama_kec_sekolah = strtoupper("KEC ".$d['nama_kec']." ".$d['nama_kab']);

		$id_nama_kec_sekolah = $id_kec_sekolah;
		$nama_kec_sekolah_disabled = "disabled";

	}

}



$sudah_upload_foto_profil = 0;
$sudah_upload_bukti_bayar = 0;
$sudah_upload_bukti_kip = 0;
$img_user = "../uploads/profile_na.jpg";
$jumlah_uploads = 0;

$s = "SELECT * from tb_verifikasi_upload a 
join tb_persyaratan b on a.id_persyaratan=b.id_persyaratan 
where id_daftar='$id_daftar'";

$q = mysqli_query($cn,$s) or die("Tidak bisa retrieve data verifikasi upload. ".mysqli_error($cn));
if(mysqli_num_rows($q)){
	$i=0;
	$jumlah_uploads=0;
	$jumlah_uploads_diterima = 0;
	$total_uploads = 2; //zzz
	$ekstensi_foto_profil = '';

	while ($d=mysqli_fetch_assoc($q)) {
		$i++;
		$rid_verifikasi[$i] = $d['id_verifikasi'];
		$rtanggal_upload[$i] = $d['tanggal_upload'];
		$rid_persyaratan[$i] = $d['id_persyaratan'];
		$ekstensi_file = $d['ekstensi_file'];

		$rid_petugas[$i] = $d['id_petugas'];
		$rtanggal_verifikasi_upload[$i] = $d['tanggal_verifikasi_upload'];

		$id_persyaratan = $d['id_persyaratan'];
		$format_nama_file = $d['format_nama_file'];

		if($format_nama_file=="img_profile") $ekstensi_foto_profil = $ekstensi_file;

		$rid_persyaratan[$i] = $id_persyaratan;
		$rnama_persyaratan[$i] = $d['nama_persyaratan'];
		$rketerangan_persyaratan[$i] = $d['keterangan_persyaratan'];

		$softcopy[$i] = "../uploads/$folder_uploads/$format_nama_file"."__$id_daftar.$ekstensi_file";

		// echo "<hr>$softcopy[$i]";

		$softcopy_exist[$i] = 1; 
		if(!file_exists($softcopy[$i])){
			$softcopy_exist[$i] = 0;
			$softcopy[$i] = "uploads/img_na.jpg";
		}else{
			$jumlah_uploads++;
		}

		if($rtanggal_verifikasi_upload[$i]!="") $jumlah_uploads_diterima++;

		if($id_persyaratan==1) $img_user = "../uploads/$folder_uploads/img_profile__$id_daftar.$ekstensi_file";

	}
}






$img_profile = "../uploads/profile_na.jpg";
if(file_exists($img_user)) $img_profile = $img_user;
$img_profile = $img_user;

$img_status_email = $img_warning;
if($status_email==1) $img_status_email = $img_check;

$img_status_no_wa = $img_warning;
if($status_no_wa==1) $img_status_no_wa = $img_check;

$status_akun_show = $img_warning;
if($status_akun==1) $status_akun_show = "Active $img_check";

$icon_edit = "<img class='img_zoom' src='../assets/img/icons/edit2.png' width='25px'>";
$icon_edit_nama = "<span id='icon_edit__nama_calon' class='icon_edit'>$icon_edit</span>";
$icon_edit_no_wa = "<span id='icon_edit__no_wa' class='icon_edit'>$icon_edit</span>";

$data_akun = "
<table class='table table-bordered'>
	<tr><td>Nama Calon</td><td><span id='nama_calon'>$nama_calon</span> ~ $icon_edit_nama</td></tr>
	<tr><td>Tanggal Daftar</td><td>$akun_created</td></tr>
	<tr><td>Email $status_email</td><td><span id='email_calon'>$email_calon</span> $img_status_email</td></tr>
	<tr><td>No WhatsApp $status_no_wa</td><td><span id='no_wa'>$no_wa</span> $img_status_no_wa ~ $icon_edit_no_wa</td></tr>
	<tr><td>Status Akun $status_akun</td><td>$status_akun_show</td></tr>
</table>
";

$data_jurusan = "
<table class='table table-bordered'>
	<tr><td>Pilihan Prodi 1</td><td>$nama_prodi1</li>
	<tr><td>Pilihan Prodi 2</td><td>$nama_prodi2</li>
	<tr><td>Jalur Daftar</td><td>$nama_jalur</li>
</table>
";

$biodata_calon = "
<table class='table table-bordered'>
	<tr><td>NIK</td><td>$nik</td></tr>
	<tr><td>Nama</td><td>$nama_calon</td></tr>
	<tr><td>TTL</td><td>$tempat_lahir, $tanggal_lahir</td></tr>
	<tr><td>Alamat KTP</td><td>$alamat_desa_ktp, $nama_kec_ktp, $nama_kab_ktp $kode_pos_nama_kec_ktp</td></tr>
	<tr><td>Domisili</td><td>$alamat_desa_domisili, $nama_kec_domisili, $nama_kab_domisili $kode_pos_nama_kec_domisili</td></tr>
	<tr><td>Status Menikah</td><td>$status_menikah</td></tr>
	<tr><td>Agama</td><td>$agama</td></tr>
	<tr><td>Kewarganegaraan</td><td>$warga_negara</td></tr>
</table>
";

$data_sekolah_asal = "
<table class='table table-bordered'>
	<tr><td>Sekolah Asal</td><td>$asal_sekolah</td></tr>
	<tr><td>Alamat Sekolah Asal</td><td>$nama_kec_sekolah</td></tr>
	<tr><td>Jenis Sekolah</td><td>$jenis_sekolah</td></tr>
	<tr><td>Status Sekolah</td><td>$status_sekolah</td></tr>
	<tr><td>Prodi Asal</td><td>$prodi_asal</td></tr>
	<tr><td>NISN</td><td>$nisn</td></tr>
</table>
";

$data_ortu = "
<table class='table table-bordered'>
	<tr><td>Ayah</td><td>$nama_ayah</td></tr>
	<tr><td>Pekerjaan</td><td>$id_pekerjaan_ayah</td></tr>
	<tr><td>No. WA Ayah</td><td>$no_ayah</td></tr>
	<tr><td>Ibu</td><td>$nama_ibu</td></tr>
	<tr><td>Pekerjaan</td><td>$id_pekerjaan_ibu</td></tr>
	<tr><td>No. WA Ibu</td><td>$no_ibu</td></tr>
	<tr><td>No. WA Saudara</td><td>$no_saudara</td></tr>
</table>
";


$data_persyaratan = "
<table class='table table-bordered'>
	<tr><td>Jumlah upload: $jumlah_uploads</td></tr>
</table>
";

$data_tes_pmb = "
<table class='table table-bordered'>
	<tr><td>Belum ada data Tes PMB</td></tr>
</table>
";

?>



