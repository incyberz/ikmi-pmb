<?php

$jumlah_upload=0;
$jumlah_verif=0;
$verified_by = '';
$s = "SELECT a.* from tb_persyaratan a";
$q = mysqli_query($cn, $s) or die("Tidak bisa mengakses data persyaratan. ".mysqli_error($cn));
if (mysqli_num_rows($q)) {
    while ($d=mysqli_fetch_assoc($q)) {
        $id_persyaratan = $d['id_persyaratan'];
        $format_nama_file = $d['format_nama_file'];
        $nama_persyaratan = $d['nama_persyaratan'];
        $ext_allowed = $d['ext_allowed'];

        $s2 = "SELECT a.*,
    (select nama_petugas from tb_petugas where id_petugas=a.id_petugas) as verified_by  
    from tb_verifikasi_upload a 
    where a.id_persyaratan=$id_persyaratan and a.id_daftar=$id_daftar";

        $q2 = mysqli_query($cn, $s2) or die("Tidak dapat mengakses data verifikasi upload");

        if (mysqli_num_rows($q2)>1) {
            die("Tidak boleh dua persyaratan sejenis dalam 1 pendaftaran, id_persyaratan=$id_persyaratan, id_daftar=$id_daftar");
        }

        $ekstensi_file = '';
        $tanggal_verifikasi_upload = '';
        $status_upload = '';
        if (mysqli_num_rows($q2)) {
            $d2 = mysqli_fetch_assoc($q2);
            $ekstensi_file = $d2['ekstensi_file'];
            $tanggal_verifikasi_upload = $d2['tanggal_verifikasi_upload'];
            $verified_by = $d2['verified_by'];
            $status_upload = $d2['status_upload'];
        }

        $softcopy[$id_persyaratan] = "uploads/$folder_uploads/$format_nama_file"."__$id_daftar.$ekstensi_file";
        $softcopy_exist[$id_persyaratan] = 1;
        $img_persyaratan = "<div style='margin-top:10px'><a href='$softcopy[$id_persyaratan]' target='_blank'><img src='$softcopy[$id_persyaratan]' width='100px'></a></div>";
        if (!file_exists($softcopy[$id_persyaratan])) {
            $softcopy_exist[$id_persyaratan] = 0;
            $softcopy[$id_persyaratan] = "uploads/img_na.jpg";
            $img_persyaratan = '';
        }


        if (($id_jalur==3 and $id_persyaratan==2) or ($id_jalur!=3 and $id_persyaratan==3)) {
        } else {
            $jumlah_upload++;
            if ($verified_by!="") {
                $jumlah_verif++;
            }
        }
    }
}

$jumlah_exist = array_sum($softcopy_exist);


// echo "<pre>";
// var_dump($softcopy_exist);
// echo "</pre>";

// echo "<br>jumlah_upload: $jumlah_upload";
// echo "<br>jumlah_verif: $jumlah_verif";
// echo "<br>jumlah_exist: $jumlah_exist";
// echo "<br>tanggal_registrasi_ulang: $tanggal_registrasi_ulang";
// echo "<br>tanggal_lulus_tes: $tanggal_lulus_tes";
// echo "<br>status_lulus: $status_lulus";


























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
if ($tanggal_submit_formulir!="") {
    $rimg_check[2] = $img_check;
    $langkah_class[2] = "sudah";

    $rimg_check[3] = $img_loading;
    $langkah_class[3] = "sedang";

    $cActive_step = "step3";
}



# ===========================================
# JIKA SUDAH UPLOAD PERSYARATAN
# JIKA SUDAH DIIKUTSERTAKAN TES
# ===========================================
if ($jumlah_upload==$jumlah_verif and $jumlah_upload==$jumlah_exist) {
    $rimg_check[3] = $img_check;
    $langkah_class[3] = "sudah";

    $rimg_check[4] = $img_loading;
    $langkah_class[4] = "sedang";

    $cActive_step = "step4";
}


# ===========================================
# JIKA SEDANG TES PMB
# JIKA SUDAH PUNYA TANGGAL LULUS DAN STATUS LULUS=1
# ===========================================
if ($tanggal_lulus_tes!="" and $status_lulus=1) {
    $rimg_check[4] = $img_check;
    $langkah_class[4] = "sudah";

    $rimg_check[5] = $img_loading;
    $langkah_class[5] = "sedang";

    $cActive_step = "step5";
}


# ===========================================
# REGIS ULANG
# JIKA SUDAH PUNYA TANGGAL LULUS DAN STATUS LULUS=1
# DAN
# ===========================================
if ($tanggal_lulus_tes!="" and $tanggal_registrasi_ulang!="" and $status_lulus=1) {
    $rimg_check[5] = $img_check;
    $langkah_class[5] = "sudah";
}
