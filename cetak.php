<?php 

session_start(); 
$debug_mode = 0;
if (isset($_GET['get_cetak'])) {
  $get_cetak=$_GET['get_cetak'];
  $tmp = explode("__", $get_cetak);
  $tmp_em = explode("=", $tmp[1]);



  $file_cetak = $tmp[0];
  $email = $tmp_em[1];


}else{
  if (!isset($_SESSION['email'])) {die("Error #cetak mail session");}
  if (!isset($_SESSION['nama_calon'])) {die("Error #cetak nama calon session");}

  if (isset($_POST['btn_cetak_formulir'])) $file_cetak="formulir";
  if (isset($_POST['btn_cetak_kartu_tes'])) $file_cetak="kartu_tes";
  if (isset($_POST['btn_cetak_regis'])) $file_cetak="regis";

  $email = $_SESSION['email'];

}

if (!isset($file_cetak)) die("Error #cetak Undefined jenis cetak");


include "config.php";
include "user_var.php";
include "cek_stsyarat.php";

$file_pas_photo = "uploads/$folder_uploads/__pas_photo.jpg";
$file_pas_photo_na = "assets/img/icons/user_na.png";

if (file_exists($file_pas_photo)) {
  $img_pas_photo = "<img src='$file_pas_photo' height='120px'>";
  if ($debug_mode)echo "<h1>$file_pas_photo</h1>";
}else{
  $img_pas_photo = "<img src='$file_pas_photo_na' height='120px'>";
}
$img_qr_code = "<img src='assets/img/qr-codes/anamdari.png' height='80px'>";

$tipe_referal = strtoupper($tipe_referal);

if ($nisn=="") $nisn="-";
if ($npwp=="") $npwp="-";
if ($no_daf_kip=="") $no_daf_kip="-";
if ($no_kip=="") $no_kip="-";
if ($no_kps=="") $no_kps="-";
if ($instansi_kerja=="") $instansi_kerja="-";
if ($jabatan_kerja=="") $jabatan_kerja="-";
if ($alamat_kerja=="") $alamat_kerja="-";
if (trim($no_ijazah)=="") $no_ijazah="-";
if ($prodi_asal=="") $prodi_asal="-";

if($tanggal_lahir==""){$tanggal_lahir="-";}
else{$tanggal_lahir = date("d M Y", strtotime($tanggal_lahir));}

$tanggal_tes = date("d M Y", strtotime($tanggal_tes_gel));
$tanggal_daftar = date("d M Y", strtotime($tanggal_daftar));
$jam_daftar = date("H:i:sa", strtotime($tanggal_daftar));

switch ($jenis_kelamin) {
  case 'L': $jenis_kelamin = "Laki-laki";break;
  case 'P': $jenis_kelamin = "Perempuan";break;
  default: $jenis_kelamin = "-";
}

switch ($status_menikah) {
  case 1: $status_menikah = "Belum Menikah";break;
  case 2: $status_menikah = "Menikah";break;
  case 3: $status_menikah = "Janda/Duda";break;
  default: $status_menikah = "-";
}

switch ($agama) {
  case 1: $agama = "Islam";break;
  case 2: $agama = "Katolik";break;
  case 3: $agama = "Protestan";break;
  case 4: $agama = "Hindu";break;
  case 5: $agama = "Budha";break;
  case 6: $agama = "Konghucu";break;
  case 7: $agama = "Lainnya";break;
  default: $agama = "-";
}

switch ($warga_negara) {
  case 1: $warga_negara = "WNI";break;
  case 2: $warga_negara = "WNA";break;
  default: $warga_negara = "-";
}

$no_hp = substr($no_hp, 0,5)."***";
$no_wa = substr($no_wa, 0,5)."***";
$email = substr($email, 0,5)."***@gmail.com";

switch ($pekerjaan_ayah) {
  case 1: $pekerjaan_ayah = "PNS DOSEN/GURU";break;
  case 2: $pekerjaan_ayah = "PNS NON KEPENDIDIKAN";break;
  case 3: $pekerjaan_ayah = "DOSEN/GURU SWASTA";break;
  case 4: $pekerjaan_ayah = "TNI/POLRI";break;
  case 5: $pekerjaan_ayah = "BUMN";break;
  case 6: $pekerjaan_ayah = "SWASTA";break;
  case 7: $pekerjaan_ayah = "PEDAGANG";break;
  case 8: $pekerjaan_ayah = "PETANI";break;
  case 9: $pekerjaan_ayah = "NELAYAN";break;
  case 10: $pekerjaan_ayah = "WIRAUSAHA LAINNYA";break;
  case 11: $pekerjaan_ayah = "ANGGOTA DEWAN";break;
  case 12: $pekerjaan_ayah = "TKI";break;
  case 98: $pekerjaan_ayah = "TIDAK BEKERJA";break;
  case 99: $pekerjaan_ayah = "LAINNYA";break;
  default: $pekerjaan_ayah = "-";
}

switch ($pekerjaan_ibu) {
  case 1: $pekerjaan_ibu = "PNS DOSEN/GURU";break;
  case 2: $pekerjaan_ibu = "PNS NON KEPENDIDIKAN";break;
  case 3: $pekerjaan_ibu = "DOSEN/GURU SWASTA";break;
  case 4: $pekerjaan_ibu = "TNI/POLRI";break;
  case 5: $pekerjaan_ibu = "BUMN";break;
  case 6: $pekerjaan_ibu = "SWASTA";break;
  case 7: $pekerjaan_ibu = "PEDAGANG";break;
  case 8: $pekerjaan_ibu = "PETANI";break;
  case 9: $pekerjaan_ibu = "NELAYAN";break;
  case 10: $pekerjaan_ibu = "WIRAUSAHA LAINNYA";break;
  case 11: $pekerjaan_ibu = "ANGGOTA DEWAN";break;
  case 12: $pekerjaan_ibu = "TKI";break;
  case 90: $pekerjaan_ibu = "IBU RUMAH TANGGA";break;
  case 98: $pekerjaan_ibu = "TIDAK BEKERJA";break;
  case 99: $pekerjaan_ibu = "LAINNYA";break;
  default: $pekerjaan_ibu = "-";
}

switch ($lulusan) {
  case 1: $lulusan = "SMA NEGERI";break;
  case 2: $lulusan = "SMA SWASTA";break;
  case 3: $lulusan = "SMK NEGERI";break;
  case 4: $lulusan = "SMK SWASTA";break;
  case 5: $lulusan = "MA NEGERI";break;
  case 6: $lulusan = "MA SWASTA";break;
  case 7: $lulusan = "AKADEMI";break;
  case 8: $lulusan = "INSTITUTE";break;
  case 9: $lulusan = "SEKOLAH TINGGI";break;
  case 10: $lulusan = "UNIVERSITAS";break;
  case 11: $lulusan = "PAKET C";break;
  case 12: $lulusan = "PAKET HOMESCHOOLING";break;
  case 13: $lulusan = "lulusan LUAR NEGERI";break;
  default: $lulusan = "-";
}

$nama_prodi = strtoupper($nama_prodi);

switch ($id_jndaftar) {
  case 1: $id_jndaftar_cap = "REGULER";break;
  case 2: $id_jndaftar_cap = "TRANSFER";break;
  case 3: $id_jndaftar_cap = "KIP KULIAH";break;
  case 4: $id_jndaftar_cap = "KIP KULIAH SEMENTARA";break;
  default: die("Error #H5G5F5F5GGHG6");
}

switch ($id_jalur) {
  case 1: $id_jalur = "REGULER";break;
  case 2: $id_jalur = "JUARA SEKOLAH TK 1 - 5";break;
  case 3: $id_jalur = "JUARA SEKOLAH TK 6 - 10";break;
  case 4: $id_jalur = "JUARA TRY-OUT TK 1 - 5";break;
  case 5: $id_jalur = "JUARA TRY-OUT TK 6 - 10";break;
  case 6: $id_jalur = "JUARA TRY-OUT TK 11 - 20";break;
  case 7: $id_jalur = "JUARA 1 TK KOTA";break;
  case 8: $id_jalur = "JUARA 2 TK KOTA";break;
  case 9: $id_jalur = "JUARA 3 TK KOTA";break;
  case 10: $id_jalur = "JUARA 1 TK PROVINSI";break;
  case 11: $id_jalur = "JUARA 2 TK PROVINSI";break;
  case 12: $id_jalur = "JUARA 3 TK PROVINSI";break;
  case 13: $id_jalur = "JUARA 1 TK NASIONAL";break;
  case 14: $id_jalur = "JUARA 2 TK NASIONAL";break;
  case 15: $id_jalur = "JUARA 3 TK NASIONAL";break;
  case 16: $id_jalur = "JUARA TK INTERNASIONAL";break;
  case 17: $id_jalur = "PENGURUS MESJID";break;
  case 18: $id_jalur = "ANAK GURU/DOSEN";break;
  case 19: $id_jalur = "SAUDARA CIVITAS IKMI";break;
  case 20: $id_jalur = "ANAK KANDUNG CIVITAS IKMI";break;
  default: die("Error #KHS4H6J34H345H");
}

switch ($jenjang) {
  case 'E': $jenjang = "D3"; break;
  case 'C': $jenjang = "S1"; break;
  default: $jenjang = "-";
}

switch ($tipe_bayar) {
  case 'A': $tipe_bayar = "PER SEMESTER"; break;
  case 'B': $tipe_bayar = "PER BULAN"; break;
  case 'C': $tipe_bayar = "PER TAHUN"; break;
  default: $tipe_bayar = "-";
}




switch ($file_cetak) {
  case 'kartu_tes': $nama_dokumen = "KARTU TES SELEKSI PMB";break;
  case 'formulir': $nama_dokumen = "FORMULIR PMB STMIK IKMI 2021";break;
  default: die("Error #ff45gra9d9s");
}

// $id_prodi=3;
switch ($id_prodi) {
  case '1': $sty="background-color: lightblue";break;
  case '2': $sty="background-color: #faa";break;
  case '3': $sty="background-color: lightgray";break;
  case '4': $sty="background-color: yellow";break;
  case '5': $sty="background-color: lightgreen";break;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>PMB IKMI</title>
  <meta content="" name="descriptison">
  <meta content="" name="keywords">

  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">

  <script type="text/javascript" src="assets/js/jquery.min.js"></script>
  <style type="text/css">
    .divborder{
      border: solid 1px #ddd;
    }
    .divpadding{
      padding: 2px;
    }
    .divpadding2{
      padding: 4px;
    }
    .divpadding3{
      padding: 6px;
    }
    .divpadding4{
      padding: 8px;
    }
    .divpadding5{
      padding: 10px;
    }

    .huruf6{ font-size: 6px; }
    .huruf8{ font-size: 8px; }
    .huruf10{ font-size: 10px; }
    .huruf12{ font-size: 12px; }
    .huruf14{ font-size: 14px; }
    .huruf16{ font-size: 16px; }
  </style>

</head>
<body>
  <div style="padding: 25px">
    <?php include "modul/cetak/header_cetak.php"; ?>

    <div class="row divpadding">
      <div class="col-md-12 divborder divpadding" style="padding-top: 10px;background-color: #efe;font-weight: bold;color: darkblue">
        <center>
          <h4><b><?=$nama_dokumen?></b></h4>
        </center>
      </div>
    </div>

    <?php include "modul/cetak/cetak_".$file_cetak.".php"; ?>
    
    <?php include "modul/cetak/footer_cetak.php"; ?>
  </div>
</body>

</html>


<script type="text/javascript">
  $(document).ready(function(){
    // alert("Silahkan Anda klik File -> Print Preview, \natau Settings -> Print, \n\nlalu seting Page Setup (Ukuan kertas A4, border left/right 0cm) \n\ndan aktifkan pula Opsi 'print background color'.");
    // var link_ajax = "cetak_fetch.php?get_cetak=formulir";

    // $.ajax({
    //   url:link_ajax,
    //   success:function(a){
    //     alert(a);
    //   }
    // });
  })
</script>
