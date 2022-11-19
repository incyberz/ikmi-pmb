 <?php 

$akun_created_show = " ".date("d F Y h:i:s", strtotime($akun_created))." WIB $img_check";

$rlangkah = [
  "",
  "Daftar Akun",
  "Melengkapi Formulir",
  "Upload Persyaratan",
  "Mengikuti Tes PMB",
  "Registrasi Ulang",
];

for ($i=1; $i <= count($rlangkah) ; $i++) {
  $rimg_check[$i] = "-";
  $langkah_class[$i] = "belum";
}

# ===========================================
# TAMPILAN DEFAULT SETELAH DAFTAR AKUN
# ===========================================
$rimg_check[1] = $img_check;
$langkah_class[1] = "sudah";
$rimg_check[2] = $img_loading;
$langkah_class[2] = "sedang";


# ===========================================
# JIKA SUDAH MENGISI FORMULIR
# ===========================================
if($tanggal_submit_formulir!=""){
  $rimg_check[2] = $img_check;
  $langkah_class[2] = "sudah";

  $rimg_check[3] = $img_loading;
  $langkah_class[3] = "sedang";
}



# ===========================================
# JIKA SUDAH UPLOAD PERSYARATAN
# JIKA SUDAH DIIKUTSERTAKAN TES
# ===========================================
// if($tanggal_lulus_tes!="" and $status_lulus=1){
//   $rimg_check[3] = $img_check;
//   $langkah_class[3] = "sudah";

//   $rimg_check[4] = $img_loading;
//   $langkah_class[4] = "sedang";
// }


# ===========================================
# JIKA SEDANG TES PMB
# JIKA SUDAH PUNYA TANGGAL LULUS DAN STATUS LULUS=1
# ===========================================
if($tanggal_lulus_tes!="" and $status_lulus=1){
  $rimg_check[4] = $img_check;
  $langkah_class[4] = "sudah";

  $rimg_check[5] = $img_loading;
  $langkah_class[5] = "sedang";
}


# ===========================================
# REGIS ULANG
# JIKA SUDAH PUNYA TANGGAL LULUS DAN STATUS LULUS=1
# DAN 
# ===========================================
// if($tanggal_lulus_tes!="" and $status_lulus=1){
//   $rimg_check[3] = $img_check;
//   $langkah_class[3] = "sudah";

//   $rimg_check[4] = $img_loading;
//   $langkah_class[4] = "sedang";
// }





$cActive_step = "step3";

?>