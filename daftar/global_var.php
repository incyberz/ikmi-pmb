<?php




# ============================================================
# IS IDENTITY
# ============================================================
$nama_si 	= "SIAKAD STMIK IKMI";
$judul_menu = "SIAKAD IKMI";
$lembaga 	= "STMIK IKMI";
$title 		= "$judul_menu :: $lembaga"; // muncul di title
$nama_author = "Iin Sholihin";
$tahun_release = 2021;
$dev_kontak = '';
$dev_name = "Iin Sholihin, M.Kom";









# ============================================================
# DATE AND TIMEZONE
# ============================================================
date_default_timezone_set("Asia/Jakarta");
$saat_ini = date("Y-m-d H:i:sa");
$jam_skg = date("H:i");
$tahun_skg = date("Y");
$thn_skg = date("y");
$waktu = "Pagi";
if (date("H")>=9) {
    $waktu = "Siang";
}
if (date("H")>=15) {
    $waktu = "Sore";
}
if (date("H")>=18) {
    $waktu = "Malam";
}
$nama_hari = ["Ahad","Senin","Selasa","Rabu","Kamis","Jumat","Sabtu"];
$nama_bulan = ["Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember"];
$nama_bln = ["Jan","Feb","Mar","Apr","Mei","Jun","Jul","Ags","Sep","Okt","Nov","Des"];

$weekday = date("w");
$tanggal_skg = date("d")." ".$nama_bulan[(intval(date("m"))-1)]." ".date("Y");




# ===========================================
# DATA GELOMBANG
# ===========================================
$s = "SELECT * from tb_gelombang WHERE status_gel=1";
$q = mysqli_query($cn, $s) or die(mysqli_error($cn));
// if(mysqli_num_rows($q)<1) die("Tidak ada gelombang yang aktif.");
if (mysqli_num_rows($q)>1) {
    die("Terdapat gelombang aktif secara ganda.");
}
$d = mysqli_fetch_assoc($q);
$id_gelombang = $d['id_gelombang'];
$tanggal_awal_gel = $d['tanggal_awal_gel'];
$tanggal_akhir_gel = $d['tanggal_akhir_gel'];
$nama_gel = $d['nama_gel'];

$tanggal_awal_gel_show = date("d", strtotime($tanggal_awal_gel))." "
.$nama_bulan[intval(date("m", strtotime($tanggal_awal_gel)))-1]." "
.date("Y", strtotime($tanggal_awal_gel));

$tanggal_akhir_gel_show = date("d", strtotime($tanggal_akhir_gel))." "
.$nama_bulan[intval(date("m", strtotime($tanggal_akhir_gel)))-1]." "
.date("Y", strtotime($tanggal_akhir_gel));




# ============================================================
# DEFAULT UI
# ============================================================
$link_back = "<a href='javascript:history.go(-1)'>Kembali</a>";
$btn_back = "<a href='javascript:history.go(-1)'><button class='btn btn-primary' style='margin-top:5px;margin-bottom:5px'>Kembali</button></a>";

$bm = '<span style="color: red;font-weight: bold">*</span>';

$img_help = "<img src='assets/img/icons/help.png' width='20px'>";
$img_check = "<img src='assets/img/icons/check.png' width='20px'>";
$img_wa = "<img src='assets/img/icons/wa.png' width='30px'>";
$img_loading = "<img src='assets/img/icons/loading6.gif' width='20px'>";
$img_warning = "<img src='assets/img/icons/warning.png' width='20px'>";
$img_reject = "<img src='assets/img/icons/reject.png' width='20px'>";


$periode_ta = "2023/2024";

$no_wa_petugas_iin = "087729007318";
$no_wa_petugas_bani = "085659788817"; //mas abni
$no_wa_petugas_anam = "082130148448"; //Anam
$no_wa_petugas = "083821651265"; //Front Office
$no_wa_petugas = "082316055422"; //Front Office Kedua

$biaya_daftar = 'Rp 200.000,-';
