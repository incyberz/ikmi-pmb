
<?php
$debug_mode = 0;
if (!isset($_POST['folder_uploads'])) die("Error #ghjklastyug56");
if (!isset($_POST['no_daf'])) die("Error #gtyghjklastyug56");
if (!isset($_POST['id_new_event'])) die("Error #g9juht6g6tyug56");
if (!isset($_POST['id_calon'])) die("Error #g5fs0d76tyug56");
if (!isset($_POST['id_syarat'])) die("Error #9hrf2h7tyug56");

include "config.php";

$folder_uploads = $_POST['folder_uploads'];
$id_new_event = $_POST['id_new_event'];
$id_calon = $_POST['id_calon'];
$id_syarat = $_POST['id_syarat'];
//$no_daf = $_POST['no_daf'];
$no_daf = '';

$nama_file= '';
if ($debug_mode) {
  echo "
  <br> folder_uploads : $folder_uploads
  <br> id_new_event : $id_new_event
  <br> id_calon : $id_calon
  <br> id_syarat : $id_syarat
  <br> 
  ";
}

if (isset($_POST['btn_upload_bukti_bayar'])) $nama_file = "bukti_bayar";
if (isset($_POST['btn_upload_pas_photo'])) $nama_file = "pas_photo";
if (isset($_POST['btn_upload_ijazah_sma'])) $nama_file = "ijazah_sma";
if (isset($_POST['btn_upload_transkrip_sma'])) $nama_file = "transkrip_sma";
if (isset($_POST['btn_upload_kartu_keluarga'])) $nama_file = "kartu_keluarga";
if (isset($_POST['btn_upload_ktp'])) $nama_file = "ktp";

if (isset($_POST['btn_upload_ijazah_pt'])) $nama_file = "ijazah_pt";
if (isset($_POST['btn_upload_transkrip_pt'])) $nama_file = "transkrip_pt";
if (isset($_POST['btn_upload_ktm'])) $nama_file = "ktm";
if (isset($_POST['btn_upload_sk_pindah_studi'])) $nama_file = "sk_pindah_studi";
if (isset($_POST['btn_upload_laporan_pdpt'])) $nama_file = "laporan_pdpt";
if (isset($_POST['btn_upload_s_rekom_lldikti'])) $nama_file = "s_rekom_lldikti";

if (isset($_POST['btn_upload_rapot1'])) $nama_file = "rapot1";
if (isset($_POST['btn_upload_rapot2'])) $nama_file = "rapot2";
if (isset($_POST['btn_upload_rapot3'])) $nama_file = "rapot3";

if (isset($_POST['btn_upload_hasil_to'])) $nama_file = "hasil_to";
if (isset($_POST['btn_upload_sertif_juara'])) $nama_file = "sertif_juara";
if (isset($_POST['btn_upload_sk_jalur_khusus'])) $nama_file = "sk_jalur_khusus";

if (isset($_POST['btn_upload_kip'])) $nama_file = "kip";

if (isset($_POST['btn_upload_foto_keluarga'])) $nama_file = "foto_keluarga";
if (isset($_POST['btn_upload_dok_eko'])) $nama_file = "dok_eko";
if (isset($_POST['btn_upload_foto_rumah'])) $nama_file = "foto_rumah";
if (isset($_POST['btn_upload_foto_ruang_klg'])) $nama_file = "foto_ruang_klg";

if (!file_exists("uploads/".$folder_uploads)) mkdir("uploads/".$folder_uploads);

$target_dir = "uploads/$folder_uploads/";
$target_file = $target_dir .$no_daf."__".$nama_file.".jpg";
$up_error = 0;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

# ================================================================
# SWITCH FILES
# ================================================================
switch ($nama_file) {
  case 'bukti_bayar':
    $file_size = $_FILES["file_bukti_bayar"]["size"];
    $file_name = $_FILES["file_bukti_bayar"]["name"];
    $tmp_name  = $_FILES["file_bukti_bayar"]["tmp_name"];
    $nama_file_cap = "Bukti Bayar Pendaftaran";
    break;
  
  case 'pas_photo':
    $file_size = $_FILES["file_pas_photo"]["size"];
    $file_name = $_FILES["file_pas_photo"]["name"];
    $tmp_name  = $_FILES["file_pas_photo"]["tmp_name"];
    $nama_file_cap = "Pas Photo";
    break;
  
  case 'ijazah_sma':
    $file_size = $_FILES["file_ijazah_sma"]["size"];
    $file_name = $_FILES["file_ijazah_sma"]["name"];
    $tmp_name  = $_FILES["file_ijazah_sma"]["tmp_name"];
    $nama_file_cap = "Ijazah SMA";
    break;
  
  case 'transkrip_sma':
    $file_size = $_FILES["file_transkrip_sma"]["size"];
    $file_name = $_FILES["file_transkrip_sma"]["name"];
    $tmp_name  = $_FILES["file_transkrip_sma"]["tmp_name"];
    $nama_file_cap = "Transkrip SMA/Nilai UN";
    break;
  
  case 'kartu_keluarga':
    $file_size = $_FILES["file_kartu_keluarga"]["size"];
    $file_name = $_FILES["file_kartu_keluarga"]["name"];
    $tmp_name  = $_FILES["file_kartu_keluarga"]["tmp_name"];
    $nama_file_cap = "Kartu Keluarga";
    break;
  
  case 'ktp':
    $file_size = $_FILES["file_ktp"]["size"];
    $file_name = $_FILES["file_ktp"]["name"];
    $tmp_name  = $_FILES["file_ktp"]["tmp_name"];
    $nama_file_cap = "KTP";
    break;







  // ====================================================
  // TRANSFER 
  // ====================================================
  case 'ijazah_pt':
    $file_size = $_FILES["file_ijazah_pt"]["size"];
    $file_name = $_FILES["file_ijazah_pt"]["name"];
    $tmp_name  = $_FILES["file_ijazah_pt"]["tmp_name"];
    $nama_file_cap = "Ijazah Perguruan Tinggi";
    break;
  case 'transkrip_pt':
    $file_size = $_FILES["file_transkrip_pt"]["size"];
    $file_name = $_FILES["file_transkrip_pt"]["name"];
    $tmp_name  = $_FILES["file_transkrip_pt"]["tmp_name"];
    $nama_file_cap = "Transkrip PT Asal";
    break;
  case 'ktm':
    $file_size = $_FILES["file_ktm"]["size"];
    $file_name = $_FILES["file_ktm"]["name"];
    $tmp_name  = $_FILES["file_ktm"]["tmp_name"];
    $nama_file_cap = "KTM";
    break;
  case 'sk_pindah_studi':
    $file_size = $_FILES["file_sk_pindah_studi"]["size"];
    $file_name = $_FILES["file_sk_pindah_studi"]["name"];
    $tmp_name  = $_FILES["file_sk_pindah_studi"]["tmp_name"];
    $nama_file_cap = "Surat Keterangan Pindah Studi";
    break;
  case 'laporan_pdpt':
    $file_size = $_FILES["file_laporan_pdpt"]["size"];
    $file_name = $_FILES["file_laporan_pdpt"]["name"];
    $tmp_name  = $_FILES["file_laporan_pdpt"]["tmp_name"];
    $nama_file_cap = "Laporan PDPT/EPSBED";
    break;
  case 's_rekom_lldikti':
    $file_size = $_FILES["file_s_rekom_lldikti"]["size"];
    $file_name = $_FILES["file_s_rekom_lldikti"]["name"];
    $tmp_name  = $_FILES["file_s_rekom_lldikti"]["tmp_name"];
    $nama_file_cap = "Surat Rekomendasi LLDIKTI";
    break;


  
  
  
  
  // ====================================================
  // JALUR BEASISWA 
  // ====================================================
  case 'rapot1':
    $file_size = $_FILES["file_rapot1"]["size"];
    $file_name = $_FILES["file_rapot1"]["name"];
    $tmp_name  = $_FILES["file_rapot1"]["tmp_name"];
    $nama_file_cap = "Scan Rapor Kelas 1";
    break;
  case 'rapot2':
    $file_size = $_FILES["file_rapot2"]["size"];
    $file_name = $_FILES["file_rapot2"]["name"];
    $tmp_name  = $_FILES["file_rapot2"]["tmp_name"];
    $nama_file_cap = "Scan Rapor Kelas 2";
    break;
  case 'rapot3':
    $file_size = $_FILES["file_rapot3"]["size"];
    $file_name = $_FILES["file_rapot3"]["name"];
    $tmp_name  = $_FILES["file_rapot3"]["tmp_name"];
    $nama_file_cap = "Scan Rapor Kelas 3";
    break;


  case 'hasil_to':
    $file_size = $_FILES["file_hasil_to"]["size"];
    $file_name = $_FILES["file_hasil_to"]["name"];
    $tmp_name  = $_FILES["file_hasil_to"]["tmp_name"];
    $nama_file_cap = "Hasil Try-Out";
    break;
  case 'sertif_juara':
    $file_size = $_FILES["file_sertif_juara"]["size"];
    $file_name = $_FILES["file_sertif_juara"]["name"];
    $tmp_name  = $_FILES["file_sertif_juara"]["tmp_name"];
    $nama_file_cap = "Sertifikat Kejuaraan";
    break;
  case 'sk_jalur_khusus':
    $file_size = $_FILES["file_sk_jalur_khusus"]["size"];
    $file_name = $_FILES["file_sk_jalur_khusus"]["name"];
    $tmp_name  = $_FILES["file_sk_jalur_khusus"]["tmp_name"];
    $nama_file_cap = "SK Jalur Khusus";
    break;

  case 'kip':
    $file_size = $_FILES["file_kip"]["size"];
    $file_name = $_FILES["file_kip"]["name"];
    $tmp_name  = $_FILES["file_kip"]["tmp_name"];
    $nama_file_cap = "KIP";
    break;

  case 'foto_keluarga':
    $file_size = $_FILES["file_foto_keluarga"]["size"];
    $file_name = $_FILES["file_foto_keluarga"]["name"];
    $tmp_name  = $_FILES["file_foto_keluarga"]["tmp_name"];
    $nama_file_cap = "Foto Bersama Keluarga";
    break;

  case 'dok_eko':
    $file_size = $_FILES["file_dok_eko"]["size"];
    $file_name = $_FILES["file_dok_eko"]["name"];
    $tmp_name  = $_FILES["file_dok_eko"]["tmp_name"];
    $nama_file_cap = "Dokumen Pendukung Keadaan Ekonomi";
    break;

  case 'foto_rumah':
    $file_size = $_FILES["file_foto_rumah"]["size"];
    $file_name = $_FILES["file_foto_rumah"]["name"];
    $tmp_name  = $_FILES["file_foto_rumah"]["tmp_name"];
    $nama_file_cap = "Foto Rumah Tampak Depan";
    break;

  case 'foto_ruang_klg':
    $file_size = $_FILES["file_foto_ruang_klg"]["size"];
    $file_name = $_FILES["file_foto_ruang_klg"]["name"];
    $tmp_name  = $_FILES["file_foto_ruang_klg"]["tmp_name"];
    $nama_file_cap = "Foto Ruang Keluarga";
    break;
  default: die("Error #upload Unknown nama_file. $link_back");
      
}

$file_size =intval($file_size/1000);

$cek_dim = getimagesize($tmp_name);
$file_type = strtolower(pathinfo(basename($file_name),PATHINFO_EXTENSION));
$panjang = $cek_dim[0];
$lebar = $cek_dim[1];

if($panjang<100 or $lebar<100){
  $pesan = "<hr>Error upload #5544h445s. <hr>Dimensi gambar terlalu kecil, <100px, atau file terdeteksi bukan gambar.";
  $up_error=1;
}elseif($file_size>2048000){
  $pesan = "<hr>Error upload #ds6s7es7hs. <hr>Ukuran gambar melebihi 200kB, silahkan diperkecil dahulu.";
  $up_error=1;
}elseif ($file_type!="jpg") {
  $pesan = "<hr>Error upload #cdshs6e6hs. <hr>Tipe gambar bukan .JPG, silahkan dikonversi dahulu.";
  $up_error=1;
}

if (!$up_error) {
  if (move_uploaded_file($tmp_name, $target_file)) {
    $pesan = "<hr>Upload $nama_file_cap berhasil.";

    # ===================================================
    # INSERT/UPDATE EVENT
    # ===================================================
    # if id_calon + file_name exits then update
    # else insert
    # 
    # update: status_event = 0
    # ===================================================
    $id_file_name = $id_calon."__".$nama_file;
    $id_file_name_exists_indb = 0;
    # ---------------------------------------------------
    # CEK-DB IF id_file_name exists
    $s = "SELECT id_file_name from tb_event where id_file_name = '$id_file_name'";
    $q = mysqli_query($cn,$s);
    if(mysqli_num_rows($q)) $id_file_name_exists_indb = 1;

    $s = "INSERT into tb_event (
    id_event,
    id_calon, 
    id_file_name,
    nama_event,
    tipe_event
    ) values (
    '$id_new_event',
    '$id_calon',
    '$id_file_name',
    '$nama_file_cap',
    '1' 
    )";

    if($id_file_name_exists_indb) $s = "UPDATE tb_event set 
    status_event=0,
    date_event=CURRENT_TIMESTAMP 
    where id_file_name = '$id_file_name'";

    if ($debug_mode) echo "<hr>id_file_name_exists_indb: $id_file_name_exists_indb";
    if ($debug_mode) echo "<hr>SQL save/upd events: $s";

    $q = mysqli_query($cn,$s);
    if ($debug_mode) echo "<hr>$s<hr>";
    if ($q and !$id_file_name_exists_indb) $pesan.="<br>Mengirimkan notifikasi ke petugas berhasil.";
    if ($q and $id_file_name_exists_indb) $pesan.="<br>Update notifikasi untuk petugas berhasil.";


    # ===================================================
    # UPDATE STATUS VERIFIKASI -> NOT VERIFIED
    # ===================================================
    $s = "UPDATE tb_daftar_syarat set 
    $nama_file = 0 
    where id_syarat = '$id_syarat'";
    $q = mysqli_query($cn,$s);
    if ($debug_mode) echo "<hr>$s<hr>";
    if ($q) $pesan.="<br>Update status verifikasi file upload berhasil.";


  }else{
    $pesan = "<hr>Move upload file gagal.";
  }
  $pesan.="    
    <hr> - Ukuran Gambar: $panjang x $lebar pixel
    <br> - Tipe: $file_type
    <br> - Size: $file_size kB
    ";
}

$style_div = "alert-success";
if($up_error) $style_div = "alert-warning";

?>

<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<div class="alert <?=$style_div?>">
  <?=$pesan?>
  <hr>
  <a class="btn btn-primary" href='javascript:history.go(-1)'>Kembali</a>
</div>


