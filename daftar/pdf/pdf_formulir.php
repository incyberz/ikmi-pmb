<?php

// echo "<pre>";
// echo var_dump($_SESSION);
// echo "</pre>";

// $id_daftar = isset($_SESSION['pendaftar_id_daftar']) ? $_SESSION['pendaftar_id_daftar'] : die("id_daftar not set.");
// $pendaftar_email = isset($_SESSION['pendaftar_pendaftar_email']) ? $_SESSION['pendaftar_pendaftar_email'] : die("pendaftar_email not set.");
// $pendaftar_nama = isset($_SESSION['pendaftar_pendaftar_nama']) ? $_SESSION['pendaftar_pendaftar_nama'] : die("pendaftar_nama not set.");
// $pendaftar_id_calon = isset($_SESSION['pendaftar_pendaftar_id_calon']) ? $_SESSION['pendaftar_pendaftar_id_calon'] : die("pendaftar_id_calon not set.");






// require_once "../config.php";

$s = "SELECT id_pekerjaan,pekerjaan from tb_pekerjaan";
$q = mysqli_query($cn, $s) or die(mysqli_error($cn));
while ($d=mysqli_fetch_assoc($q)) {
    $i = $d['id_pekerjaan'];
    $rpekerjaan[$i] = $d['pekerjaan'];
}



$s = "SELECT id_prodi,nama_prodi,jenjang from tb_prodi";
$q = mysqli_query($cn, $s) or die(mysqli_error($cn));
while ($d=mysqli_fetch_assoc($q)) {
    $i = $d['id_prodi'];
    $rnama_prodi[$i] = $d['nama_prodi'];
    $rjenjang[$i] = $d['jenjang'];
}


$s = "SELECT id_jalur,nama_jalur from tb_jalur";
$q = mysqli_query($cn, $s) or die(mysqli_error($cn));
while ($d=mysqli_fetch_assoc($q)) {
    $i = $d['id_jalur'];
    $rnama_jalur[$i] = $d['nama_jalur'];
}


$s = "SELECT * from tb_pekerjaan";
$q = mysqli_query($cn, $s) or die(mysqli_error($cn));
while ($d=mysqli_fetch_assoc($q)) {
    $i = $d['id_pekerjaan'];
    $rpekerjaan[$i] = $d['pekerjaan'];
}

$id_persyaratan = 2; //bukti_bayar
if ($id_jalur==3) {
    $id_persyaratan = 3;
} //bukti kip

$s = "SELECT a.tanggal_verifikasi_upload,b.nama_persyaratan from tb_verifikasi_upload a 
join tb_persyaratan b on a.id_persyaratan=b.id_persyaratan 
where a.id_daftar=$id_daftar and a.id_persyaratan=$id_persyaratan";
$q = mysqli_query($cn, $s) or die(mysqli_error($cn));
if (mysqli_num_rows($q)!=1) {
    die("Persyaratan tidak ditemukan. ".mysqli_error($cn));
}
while ($d=mysqli_fetch_assoc($q)) {
    $tanggal_verifikasi_upload = $d['tanggal_verifikasi_upload'];
    $nama_persyaratan = $d['nama_persyaratan'];
}
$tanggal_verifikasi_upload = date("F d, Y, H:i:s", strtotime($tanggal_verifikasi_upload));



$rstatus_menikah = ["","Belum Menikah","Menikah","Janda/Duda"];
$ragama = ["","Islam","Katolik","Protestan","Hindu","Budha","Konghucu","Lainnya"];
$rwarga_negara = ["","WNI","WNA"];


$id_gelombang_show = substr($id_gelombang, 0, 4)."-".substr($id_gelombang, 4, 1);
$email_show = substr($email_calon, 0, 4)."***@gmail.com";
$no_wa_show = substr($no_wa, 0, 3)."***".substr($no_wa, 9, 4);
$no_hp_show = substr($no_hp, 0, 3)."***".substr($no_hp, 9, 4);

$no_ayah_show = $no_ayah;
$no_ibu_show = $no_ibu;
$no_saudara_show = $no_saudara;
if (strlen($no_ayah)>9) {
    $no_ayah_show = substr($no_ayah, 0, 3)."***".substr($no_ayah, 9, 4);
}
if (strlen($no_ibu)>9) {
    $no_ibu_show = substr($no_ibu, 0, 3)."***".substr($no_ibu, 9, 4);
}
if (strlen($no_saudara)>9) {
    $no_saudara_show = substr($no_saudara, 0, 3)."***".substr($no_saudara, 9, 4);
}

if ($no_ayah=="") {
    $no_ayah_show = "-";
}
if ($no_ibu=="") {
    $no_ibu_show = "-";
}

$nama_kab_ktp = ucwords(strtolower($nama_kab_ktp));
$nama_kab_domisili = ucwords(strtolower($nama_kab_domisili));
$tempat_lahir = ucwords(strtolower($tempat_lahir));






















$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();

$pdf->SetFont('Arial', '', 9);

//garis pasca judul
$pdf->Cell(190, 3, ' ', "T", 1);

$cell_border = 0;
$pdf->SetFillColor(0, 255, 255);


// 1
$pdf->Cell(30, 5, 'No. Pendaftaran', $cell_border, 0);
$pdf->Cell(2, 5, ':', $cell_border, 0);
$pdf->Cell(130, 5, "$id_daftar", $cell_border, 0);

$foto_profil = "../uploads/$folder_uploads/img_profile__$id_daftar.$ekstensi_foto_profil";
if (!file_exists($foto_profil)) {
    die("Foto Profil not found.<hr><small><i>foto_profil: $foto_profil</i></small>");
}
#                        Image(string file , x,            y,             w [, float h [, string type [, mixed link]]]]]])
$pdf->Cell(30, 30, $pdf->Image($foto_profil, $pdf->GetX(), $pdf->GetY(), null, 25), 0, 0, 'L', false);
$pdf->Ln(5);

// 2
$pdf->Cell(30, 5, 'Gelombang', $cell_border, 0);
$pdf->Cell(2, 5, ':', $cell_border, 0);
$pdf->Cell(130, 5, "$id_gelombang_show", $cell_border, 1);

// 3
$pdf->Cell(30, 5, 'Pilihan Prodi 1', $cell_border, 0);
$pdf->Cell(2, 5, ':', $cell_border, 0);
$pdf->Cell(130, 5, $rnama_prodi[$id_prodi1], $cell_border, 1);

// 4
$pdf->Cell(30, 5, 'Pilihan Prodi 2', $cell_border, 0);
$pdf->Cell(2, 5, ':', $cell_border, 0);
$pdf->Cell(130, 5, $rnama_prodi[$id_prodi2], $cell_border, 1);

// 5
$pdf->Cell(30, 5, 'Jalur Daftar', $cell_border, 0);
$pdf->Cell(2, 5, ':', $cell_border, 0);
$pdf->Cell(130, 5, $rnama_jalur[$id_jalur], $cell_border, 1);


$pdf->Ln(3);
$pdf->Cell(190, 10, 'BIODATA CALON MAHASISWA', "TB", 0);
$pdf->Ln(13);


// 6
$pdf->Cell(30, 5, 'Nama', $cell_border, 0);
$pdf->Cell(2, 5, ':', $cell_border, 0);
$pdf->Cell(73, 5, "$nama_calon", $cell_border, 0);

$pdf->Cell(30, 5, 'Asal Sekolah', $cell_border, 0);
$pdf->Cell(2, 5, ':', $cell_border, 0);
$pdf->Cell(50, 5, "$asal_sekolah", $cell_border, 1);


// 7
$pdf->Cell(30, 5, 'NIK', $cell_border, 0);
$pdf->Cell(2, 5, ':', $cell_border, 0);
$pdf->Cell(73, 5, "$nik", $cell_border, 0);

$pdf->Cell(30, 5, 'Tahun Lulus', $cell_border, 0);
$pdf->Cell(2, 5, ':', $cell_border, 0);
$pdf->Cell(50, 5, "$tahun_lulus", $cell_border, 1);

// 8
$pdf->Cell(30, 5, 'TTL', $cell_border, 0);
$pdf->Cell(2, 5, ':', $cell_border, 0);
$pdf->Cell(73, 5, "$tempat_lahir, ".date("d-m-Y", strtotime($tanggal_lahir)), $cell_border, 0);

$pdf->Cell(30, 5, 'Jurusan / NISN', $cell_border, 0);
$pdf->Cell(2, 5, ':', $cell_border, 0);
$pdf->Cell(50, 5, "$prodi_asal / $nisn", $cell_border, 1);

// 9
$pdf->Cell(30, 5, 'Alamat KTP', $cell_border, 0);
$pdf->Cell(2, 5, ':', $cell_border, 0);
$pdf->Cell(73, 5, "$alamat_desa_ktp", $cell_border, 0);

$pdf->Cell(30, 5, ' ', $cell_border, 0);
$pdf->Cell(2, 5, ' ', $cell_border, 0);
$pdf->Cell(50, 5, ' ', $cell_border, 1);

// 10
$pdf->Cell(30, 5, ' ', $cell_border, 0);
$pdf->Cell(2, 5, ' ', $cell_border, 0);
$pdf->Cell(73, 5, "$nama_kab_ktp $kode_pos_nama_kec_ktp", $cell_border, 0);

$pdf->Cell(30, 5, ' ', $cell_border, 0);
$pdf->Cell(2, 5, ' ', $cell_border, 0);
$pdf->Cell(50, 5, " ", $cell_border, 1);

// 11
$pdf->Cell(30, 5, 'Alamat Domisili', $cell_border, 0);
$pdf->Cell(2, 5, ':', $cell_border, 0);
$pdf->Cell(73, 5, "$alamat_desa_domisili", $cell_border, 0);

$pdf->Cell(30, 5, ' ', $cell_border, 0);
$pdf->Cell(2, 5, ' ', $cell_border, 0);
$pdf->Cell(50, 5, ' ', $cell_border, 1);

// 12
$pdf->Cell(30, 5, ' ', $cell_border, 0);
$pdf->Cell(2, 5, ' ', $cell_border, 0);
$pdf->Cell(73, 5, "$nama_kab_domisili $kode_pos_nama_kec_domisili", $cell_border, 0);

$pdf->Cell(30, 5, 'Ayah / Ibu', $cell_border, 0);
$pdf->Cell(2, 5, ':', $cell_border, 0);
$pdf->Cell(50, 5, "$nama_ayah / $nama_ibu", $cell_border, 1);

// 13
$pdf->Cell(30, 5, 'Status', $cell_border, 0);
$pdf->Cell(2, 5, ':', $cell_border, 0);
$pdf->Cell(73, 5, $rstatus_menikah[$status_menikah], $cell_border, 0);

$pdf->Cell(30, 5, 'Pekerjaan Ayah', $cell_border, 0);
$pdf->Cell(2, 5, ':', $cell_border, 0);
$pdf->Cell(50, 5, $rpekerjaan[$id_pekerjaan_ayah], $cell_border, 1);

// 14
$pdf->Cell(30, 5, 'Agama', $cell_border, 0);
$pdf->Cell(2, 5, ':', $cell_border, 0);
$pdf->Cell(73, 5, $ragama[$agama], $cell_border, 0);

$pdf->Cell(30, 5, 'Pekerjaan Ibu', $cell_border, 0);
$pdf->Cell(2, 5, ':', $cell_border, 0);
$pdf->Cell(50, 5, $rpekerjaan[$id_pekerjaan_ibu], $cell_border, 1);

// 15
$pdf->Cell(30, 5, 'Kewarganegaraan', $cell_border, 0);
$pdf->Cell(2, 5, ':', $cell_border, 0);
$pdf->Cell(73, 5, $rwarga_negara[$warga_negara], $cell_border, 0);

$pdf->Cell(30, 5, 'No. Ayah', $cell_border, 0);
$pdf->Cell(2, 5, ':', $cell_border, 0);
$pdf->Cell(50, 5, "$no_ayah_show", $cell_border, 1);

// 16
$pdf->Cell(30, 5, 'Email', $cell_border, 0);
$pdf->Cell(2, 5, ':', $cell_border, 0);
$pdf->Cell(73, 5, "$email_show", $cell_border, 0);

$pdf->Cell(30, 5, 'No. Ibu', $cell_border, 0);
$pdf->Cell(2, 5, ':', $cell_border, 0);
$pdf->Cell(50, 5, "$no_ibu_show", $cell_border, 1);

// 17
$pdf->Cell(30, 5, 'No. WA/HP', $cell_border, 0);
$pdf->Cell(2, 5, ':', $cell_border, 0);
$pdf->Cell(73, 5, "$no_wa_show / $no_hp_show", $cell_border, 0);

$pdf->Cell(30, 5, 'No. Saudara', $cell_border, 0);
$pdf->Cell(2, 5, ':', $cell_border, 0);
$pdf->Cell(50, 5, "$no_saudara_show", $cell_border, 1);

$pdf->Ln(3);
$pdf->Cell(190, 7, "$nama_persyaratan telah terverifikasi pada $tanggal_verifikasi_upload oleh Petugas PMB STMIK IKMI Cirebon", "T", 1);

// $pdf->Cell(190, 1, ' ', 0, 1);

$pdf->Cell(74, 1, ' ', '', 0);
$pdf->Image('cap_lunas.jpg', null, null, 40);

$pdf->Cell(1, 1, ' ', '', 1);
$pdf->Cell(190, 1, ' ', "B", 1);
$pdf->Ln(5);


// Cell 1  2  3    4       5   6      7     8
    //      w  h  txt  border  ln  align  fill  link
$pdf->Cell(0, 5, '', 0, 1, '');
// $pdf->Cell(0,5,'Cirebon, 11 September 2021',1,1,'');
$pdf->Cell(106, 8, '', 0, 0, '');

$pdf->SetFont('Arial', 'i', 7);
$pdf->Cell(84, 8, 'Generated by:', 0, 1, '');

$pdf->SetFont('Arial', 'b', 9);
$pdf->Cell(106, 5, '', 0, 0, '');

$pdf->SetFont('Arial', 'ib', 9);
$pdf->Cell(84, 5, 'Academic Information System of STMIK IKMI Cirebon', 0, 1, '');

$pdf->SetFont('Arial', '', 9);
$pdf->Cell(106, 5, '', 0, 0, '');

$pdf->SetFont('Arial', 'i', 7);
$pdf->Cell(84, 5, "Cirebon City, ".date("F d, Y H:i:s"), 0, 1, '');

$pdf->Cell(106, 5, '', 0, 0, '');
$pdf->Image('qr.png', null, null, 30);

$pdf->Output('D', "Formulir-PMB-$id_daftar - $nama_calon.pdf");
ob_end_flush();
