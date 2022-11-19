<?php 
if (!isset($cn)) die("Error #user_var lost connection");
if (!isset($_SESSION['email'])) die("Error #user_var email session");
$s = "SELECT * from tb_calon where email = '$email'";
$q = mysqli_query($cn,$s) or die("Error #user_var get data calon.");

if (mysqli_num_rows($q) == 1) {
  $d = mysqli_fetch_array($q);

  $id_calon = $d['id_calon'];
  $id_sekolah = $d['id_sekolah'];
  $id_kec = $d['id_kec'];
  $nama_calon = ucwords(strtolower($d['nama_calon']));
  $no_hp = $d['no_hp'];
  $no_wa = $d['no_wa'];
  $nik = $d['nik'];
  $nisn = $d['nisn'];
  $npwp = $d['npwp'];
  $tempat_lahir = $d['tempat_lahir'];
  $tanggal_lahir = $d['tanggal_lahir'];
  $jenis_kelamin = $d['jenis_kelamin'];
  $status_menikah = $d['status_menikah'];
  $agama = $d['agama'];
  $warga_negara = $d['warga_negara'];
  $alamat_jalan = $d['alamat_jalan'];
  $alamat_dusun = $d['alamat_dusun'];
  $alamat_rt = $d['alamat_rt'];
  $alamat_rw = $d['alamat_rw'];
  $alamat_desa = $d['alamat_desa'];
  $alamat_kodepos = $d['alamat_kodepos'];
  
  $no_kip = $d['no_kip'];
  $no_kps = $d['no_kps'];

  $nama_ayah = strtoupper($d['nama_ayah']);
  $nama_ibu = strtoupper($d['nama_ibu']);
  $pekerjaan_ayah = $d['pekerjaan_ayah'];
  $pekerjaan_ibu = $d['pekerjaan_ibu'];

  $instansi_kerja = strtoupper($d['instansi_kerja']);
  $jabatan_kerja = strtoupper($d['jabatan_kerja']);
  $alamat_kerja = strtoupper($d['alamat_kerja']);

  $lulusan = $d['lulusan'];
  $sekolah_asal = strtoupper($d['sekolah_asal']);
  $tahun_lulus = $d['tahun_lulus'];
  $no_ijazah = $d['no_ijazah'];
  $prodi_asal = strtoupper($d['prodi_asal']);




  # ==============================================
  # CHECK IF ID_KEC STILL EMPTY
  $kecamatan = "";
  $kabupaten = "";
  $nama_kec = "";
  $nama_kab = "";

  if ($id_kec!="") {
    $s = "SELECT b.nama_kec, c.nama_kab 
    from tb_calon a 
    join tb_alamat_kec b ON a.id_kec = b.id_kec 
    join tb_alamat_kab c ON b.id_kab = c.id_kab 
    where a.email = '$email'";

    $q = mysqli_query($cn,$s) or die("Error #user_var Can't get data kecamatan.");

    $d = mysqli_fetch_array($q);
    $kecamatan = strtoupper($d['nama_kec']);
    $kabupaten = strtoupper($d['nama_kab']);
    $nama_kec = strtoupper($d['nama_kec']);
    $nama_kab = strtoupper($d['nama_kab']);
  }


  # ==============================================
  # CHECK IF ID_SEKOLAH STILL EMPTY
  $jenis_sekolah="";
  $nama_sekolah="";
  if ($id_sekolah!="") {
    $s = "SELECT a.* from tb_sekolah_asal a 
    join tb_calon b ON a.id_sekolah = b.id_sekolah  
    where b.email = '$email'";

    $q = mysqli_query($cn,$s) or die("Error #user_var  Can't get data sekolah asal.");

    $d = mysqli_fetch_array($q);
    $jenis_sekolah = strtoupper($d['jenis_sekolah']);
    $nama_sekolah = strtoupper($d['nama_sekolah']);
  }





  # =============================================================
  # GET SUB DATA DAFTAR
  # =============================================================
  $s = "SELECT * FROM tb_daftar a 
  join tb_calon b on a.id_calon = b.id_calon 
  join tb_daftar_jndaftar c on a.id_jndaftar = c.id_jndaftar 
  where b.email = '$email'
  ";

  // $id_syarat = "";

  if($debug_mode)echo "<hr>Debug #user_var SQL Get Sub Data Daftar: $s<hr>";

  $q = mysqli_query($cn,$s) or die("Error #user_var Can't get data daftar. ");
  if (mysqli_num_rows($q)==1){
    $d = mysqli_fetch_array($q);
    $id_daftar = $d['id_daftar'];
    $id_pegawai = $d['id_pegawai'];
    $id_gel_calon = $d['id_gel']; //handle proses UPDATE di Gelombang lain
    $id_biaya = $d['id_biaya'];
    $id_jndaftar = $d['id_jndaftar'];
    $nama_jndaftar = $d['nama_jndaftar'];
    $id_jalur = $d['id_jalur'];
    $id_referal = $d['id_referal'];
    $id_syarat = $d['id_syarat'];
    $no_daf = $d['no_daf'];
    $no_daf_kip = $d['no_daf_kip'];
    $status_daftar = $d['status_daftar'];
    $is_ikut_tes = $d['is_ikut_tes'];
    $is_lulus_tes = $d['is_lulus_tes'];
    $is_lengkap_data = $d['is_lengkap_data'];
    $is_lengkap_syarat = $d['is_lengkap_syarat'];
    $tanggal_daftar = $d['tanggal_daftar'];
    $tipe_bayar = $d['tipe_bayar'];
    $folder_uploads = $d['folder_uploads'];
    $id_durasi_bayar = $d['id_durasi_bayar'];
    $alamat_domisili = $d['alamat_domisili'];

    $nama_jndaftar = ucwords(strtolower($nama_jndaftar));

    # ==============================================
    # CHECK IF ID_PEGAWAI STILL EMPTY
    $nama_pegawai="";
    $nama_petugas = "<b>Iin Sholihin, M.Kom</b><br>NIK: 2020.1987.073"; //zzz

    if ($id_pegawai!="") {
      $s = "SELECT a.* from tb_pegawai a 
      join tb_daftar b ON a.id_pegawai = b.id_pegawai  
      where b.id_daftar = '$id_daftar'";
      $q = mysqli_query($cn,$s) or die("Error #user_var  Can't get data pegawai.");
      $d = mysqli_fetch_array($q);
      $nama_pegawai = strtoupper($d['nama_pegawai']);
    }



    # ==============================================
    # CHECK IF ID_GEL STILL EMPTY
    // $id_angkatan="";
    // $nama_gel="";
    // $tanggal_awal="";
    // $tanggal_akhir = "";
    // $tanggal_tes = "";
    // $durasi_pukul = "";
    // $tempat_tes = "";
    // $ruang_tes = "";
    // if ($id_gel!="") {
    //   $s = "SELECT a.* from tb_daftar_gel a 
    //   join tb_daftar b ON a.id_gel = b.id_gel  
    //   where b.id_daftar = '$id_daftar'";
    //   $q = mysqli_query($cn,$s) or die("Error #user_var  Can't get data gelombang.");
    //   $d = mysqli_fetch_array($q);
    //   $nama_gel = strtoupper($d['nama_gel']);
    //   $tanggal_awal = $d['tanggal_awal'];
    //   $tanggal_akhir = $d['tanggal_akhir'];
    //   $tanggal_tes = $d['tanggal_tes'];
    //   $durasi_pukul = $d['durasi_pukul'];
    //   $tempat_tes = $d['tempat_tes'];
    //   $ruang_tes = $d['ruang_tes'];
    // }



    # ==============================================
    # CHECK IF ID_BIAYA STILL EMPTY
    $id_prodi="";
    $id_jnkelas="";
    // $tipe_bayar="";
    // $besar_dpp="";
    // $besar_spp="";

    # ---------------------------------------------
    # SUB DATA ID_PRODI
    // $id_fakultas=""; 
    // $id_kaprodi=""; 
    // $kode_nim=""; 
    // $kode_pdpt=""; 
    // $jenjang=""; 
    // $nama_prodi=""; 
    // $nama_fakultas=""; 
    // $nama_pt=""; 
    // $no_akred=""; 
    // $akred=""; 
    // $tanggal_berdiri="";




    if ($id_biaya!="") {
      $s = "SELECT a.*,c.nama_jnkelas from tb_biaya a 
      join tb_daftar b ON a.id_biaya = b.id_biaya  
      join tb_daftar_jnkelas c on a.id_jnkelas = c.id_jnkelas 
      where b.id_daftar = '$id_daftar'";
      $q = mysqli_query($cn,$s) or die("Error #user_var  Can't get data biaya.");
      $d = mysqli_fetch_array($q);
      $id_prodi = $d['id_prodi'];
      $id_angkatan = $d['id_angkatan'];
      $id_jnkelas = $d['id_jnkelas'];
      $nama_jnkelas = $d['nama_jnkelas'];
      $tipe_bayar = $d['tipe_bayar'];
      $besar_dpp = $d['besar_dpp'];
      $besar_spp = $d['besar_spp'];

      $s = "SELECT a.*,c.* from tb_prodi a 
      join tb_prodi_fakultas c on a.id_fakultas = c.id_fakultas 
      join tb_biaya b ON a.id_prodi = b.id_prodi 
      where b.id_biaya = '$id_biaya'";
      $q = mysqli_query($cn,$s) or die("Error #user_var  Can't get data prodi.");
      $d = mysqli_fetch_array($q);

      $id_fakultas=$d['id_fakultas']; 
      $id_kaprodi=$d['id_kaprodi']; 
      $kode_nim=$d['kode_nim']; 
      $kode_pdpt=$d['kode_pdpt']; 
      $jenjang=$d['jenjang']; 
      $nama_prodi=$d['nama_prodi']; 
      $nama_fakultas=$d['nama_fakultas']; 
      $id_pt=$d['id_pt']; 
      $no_akred=$d['no_akred']; 
      $akred=$d['akred']; 
      $tanggal_berdiri=$d['tanggal_berdiri'];


    }




    # ==============================================
    # CHECK IF ID_REFERAL STILL EMPTY
    $tipe_referal="";
    $besar_fee="";
    $nama_referal="";
    $keterangan=""; //zzz tdk jelas
    if ($id_referal!="") {
      $s = "SELECT a.* from tb_daftar_referal a 
      join tb_daftar b ON a.id_referal = b.id_referal  
      where b.id_daftar = '$id_daftar'";
      $q = mysqli_query($cn,$s) or die("Error #user_var  Can't get data referal.");
      $d = mysqli_fetch_array($q);
      $tipe_referal = $d['tipe_referal'];
      $besar_fee = $d['besar_fee'];
      $nama_referal = $d['nama_referal'];
      $keterangan = $d['keterangan'];
    }

    # ==============================================
    # CHECK IF ID_JALUR BEA IKMI STILL EMPTY //zzzzz
    $id_kuota="";
    $nama_jalur="";
    $persen_pot_bpp="";
    $persen_pot_spp="";
    $jml_smt="";
    $ket_beasiswa="";
    $status_jalur="";

    $tahun_kuota="";
    $qty_kuota="";
    $nama_kuota="";

    if ($id_jalur!="") {
      $s = "SELECT a.*,c.* from tb_daftar_jalur a 
      join tb_daftar b ON a.id_jalur = b.id_jalur  
      join tb_daftar_jalur_kuota c on a.id_kuota = c.id_kuota 
      where b.id_daftar = '$id_daftar'";
      $q = mysqli_query($cn,$s) or die("Error #user_var  Can't get data Jalur Bea IKMI dan Kuota.");
      $d = mysqli_fetch_array($q);
      $id_kuota=$d['id_kuota'];
      $nama_jalur=$d['nama_jalur'];
      $persen_pot_bpp=$d['persen_pot_bpp'];
      $persen_pot_spp=$d['persen_pot_spp'];
      $jml_smt=$d['jml_smt'];
      $ket_beasiswa=$d['ket_beasiswa'];
      $status_jalur=$d['status_jalur'];

      $tahun_kuota=$d['tahun_kuota'];
      $qty_kuota=$d['qty_kuota'];
      $nama_kuota=$d['nama_kuota'];
    }


    # ==============================================
    # CHECK IF ID_SYARAT STILL EMPTY --> AUTOINSERT
    if($id_syarat=="") {
      $s = "SELECT auto_increment from information_schema.tables 
      where table_schema = '$db_name' 
      and table_name = 'tb_daftar_syarat'";
      $q = mysqli_query($cn,$s) or die("Error #user_var auto_increment syarat.");
      $d = mysqli_fetch_array($q);
      $id_syarat = $d['auto_increment'];


      $s = "INSERT into tb_daftar_syarat (id_syarat) values ('$id_syarat')";
      $q = mysqli_query($cn,$s) or die("Error #user_var insert new id_syarat.");
      if ($q) {
        $s = "UPDATE tb_daftar set id_syarat = '$id_syarat' where id_daftar = '$id_daftar'";
        $q = mysqli_query($cn,$s) or die("Error #user_var Update persyaratan.");
        if ($q) {
          $pesan = "<hr>Update <u>New ID Syarat</u> berhasil.";
        }
      }
    }





  }else{
    die("Error #user_var Gagal Join dengan Jenis Daftar Field. Query minimal harus satu baris.");
  }
}


# ======================================================
# CEK JUMLAH DATA PENTING
# ======================================================
$jumlah_input_data_all = 26; 
$jumlah_input_data_penting = 14;
$jumlah_input_data_all_user=0;
$jumlah_input_data_penting_user=0;

// echo "<hr>a<hr>a<hr>a";
// 1
if($tahun_lulus!="")$jumlah_input_data_penting_user++;
if($id_prodi!="")$jumlah_input_data_penting_user++;
if($id_jndaftar!="")$jumlah_input_data_penting_user++;
if($id_jnkelas!="")$jumlah_input_data_penting_user++;
if($id_durasi_bayar!="")$jumlah_input_data_penting_user++;

// 6
if($id_referal!="")$jumlah_input_data_penting_user++;
if($nik!="")$jumlah_input_data_penting_user++;
if($tempat_lahir!="")$jumlah_input_data_penting_user++;
if($status_menikah!="")$jumlah_input_data_penting_user++;
if($agama!="")$jumlah_input_data_penting_user++;

// 11
if($warga_negara!="")$jumlah_input_data_penting_user++;
if($alamat_jalan!="")$jumlah_input_data_penting_user++;
if($alamat_kodepos!="")$jumlah_input_data_penting_user++;
if($alamat_domisili!="")$jumlah_input_data_penting_user++;
if($lulusan!="")$jumlah_input_data_penting_user++;

// 16
if($sekolah_asal!="")$jumlah_input_data_penting_user++;
if($nisn!="")$jumlah_input_data_penting_user++;
if($no_ijazah!="")$jumlah_input_data_penting_user++;
if($prodi_asal!="")$jumlah_input_data_penting_user++;
if($nama_ayah!="")$jumlah_input_data_penting_user++;

// 21
if($pekerjaan_ayah!="")$jumlah_input_data_penting_user++;
if($nama_ibu!="")$jumlah_input_data_penting_user++;
if($pekerjaan_ibu!="")$jumlah_input_data_penting_user++;
if($instansi_kerja!="")$jumlah_input_data_penting_user++;
if($jabatan_kerja!="")$jumlah_input_data_penting_user++;
if($alamat_kerja!="")$jumlah_input_data_penting_user++;



// die("<hr>zzz");
















if (!isset($cn)) {die("Error #cek_stsyarat lost connection");}
if (!isset($_SESSION['email'])) {die("Error #cek_stsyarat mail session");}
if (!isset($_SESSION['nama_calon'])) {die("Error #cek_stsyarat nama calon session");}
if (!isset($id_syarat)) {die("Error #cek_stsyarat id syarat not defined");}
if (!isset($folder_uploads)) {die("Error #cek_stsyarat folder uploads not defined");}
if ($id_syarat=="") {die("Error #cek_stsyarat idSyarat cannot empty");}
if ($folder_uploads=="") {die("Error #cek_stsyarat folders cannot empty");}
// exit();

# ========================================================
# CEK STATUS PERSYARATAN
# ========================================================
# Output Variable (T/F)
# 1. kelengkapan_persyaratan_all
# 2. kelengkapan_persyaratan_utama
# 3. kelengkapan_persyaratan_tambahan
# 
# jumlah_persyaratan_utama_total: 6 fix
# jumlah_persyaratan_utama_lengkap: 0 ~ 6
# 
# jumlah_persyaratan_tambahan_total: 0 ~ 6
# jumlah_persyaratan_tambahan_lengkap: 0 ~ 6
# 
# statusdb_persyaratan[i] :   1 Accepted
#                             0 Not verified
#                            -1 Rejected
#                           n/a File not exist
# 
# 
# ========================================================

$jumlah_persyaratan_total = 19;
$jumlah_persyaratan_utama_total=6;
$blm_uplod = "<span class='note_red'>Belum Upload</span>";
$rejected = "<span class='note_red'>Rejected</span>";
$accepted = "<span class='note_green'>Accepted</span>";
$not_ver = "<span class='note_purple'>Not Verified</span>";

$bull = "<img src='assets/img/icons/next_small.png' width='20px'>";
$ceklis = '<img src="assets/img/icons/check_small.png" width="20px">'; 
$na = '<a href="index.php?p=daftar8" alt="Anda belum upload atau ditolak oleh petugas."><img src="assets/img/icons/na_small.png" width="12px"></a>'; 
$nv = '<a href="index.php?p=daftar8" alt="Anda sudah upload tetapi belum diverifikasi oleh petugas."><img src="assets/img/icons/question_small.png" width="12px"></a>'; 
$tdquest = '<a href="index.php?p=daftar8" alt="Syarat belum diverifikasi oleh petugas."><img src="assets/img/icons/question_small.png" width="12px"></a>'; 


$file_syarat[1] = "bukti_bayar";
$file_syarat[2] = "pas_photo";
$file_syarat[3] = "ijazah_sma";
$file_syarat[4] = "transkrip_sma";
$file_syarat[5] = "kartu_keluarga";
$file_syarat[6] = "ktp";
$file_syarat[7] = "rapot1";
$file_syarat[8] = "rapot2";
$file_syarat[9] = "rapot3";
$file_syarat[10] = "hasil_to";
$file_syarat[11] = "sertif_juara";
$file_syarat[12] = "sk_jalur_khusus";
$file_syarat[13] = "ijazah_pt";
$file_syarat[14] = "transkrip_pt";
$file_syarat[15] = "laporan_pdpt";
$file_syarat[16] = "ktm";
$file_syarat[17] = "sk_pindah_studi";
$file_syarat[18] = "s_rekom_lldikti";
$file_syarat[19] = "kip";

$file_syarat[20] = "foto_keluarga"; //kip kuliah sementara
$file_syarat[21] = "dok_eko";
$file_syarat[22] = "foto_rumah";
$file_syarat[23] = "foto_ruang_klg";

$file_syarat[24] = "";
$file_syarat[25] = "";

$file_syarat_cap[1] = "Biaya Formulir";
$file_syarat_cap[2] = "Pas Photo";
$file_syarat_cap[3] = "Ijazah SMA";
$file_syarat_cap[4] = "Transkrip UN SMA";
$file_syarat_cap[5] = "Kartu Keluarga";
$file_syarat_cap[6] = "KTP";
$file_syarat_cap[7] = "Rapor Kelas 1";
$file_syarat_cap[8] = "Rapor Kelas 2";
$file_syarat_cap[9] = "Rapor Kelas 3";
$file_syarat_cap[10] = "Hasil Try-Out SBMPTN";
$file_syarat_cap[11] = "Sertifikat Kejuaraan";
$file_syarat_cap[12] = "SK / S.Keterangan";
$file_syarat_cap[13] = "Ijazah PT";
$file_syarat_cap[14] = "Transkrip PT";
$file_syarat_cap[15] = "Laporan PDPT";
$file_syarat_cap[16] = "KTM";
$file_syarat_cap[17] = "S.Ket Pindah Studi";
$file_syarat_cap[18] = "S.Rekom LLDIKTI";
$file_syarat_cap[19] = "KIP Kuliah";

$file_syarat_cap[20] = "Foto Bersama Keluarga";
$file_syarat_cap[21] = "Dokumen Pendukung Keadaan Ekonomi";
$file_syarat_cap[22] = "Foto Rumah Tampak Depan";
$file_syarat_cap[23] = "Foto Ruang Keluarga";

$file_syarat_cap[24] = "";
$file_syarat_cap[25] = "";



# DATABASE STATUS ==============================================
$s = "SELECT * from tb_daftar_syarat where id_syarat = '$id_syarat'";
$q = mysqli_query($cn,$s) or die("Error #cek_stsyarat Get data syarat.");
$d = mysqli_fetch_array($q);

$statusdb_file_syarat[1] = $d['bukti_bayar'];
$statusdb_file_syarat[2] = $d['pas_photo'];
$statusdb_file_syarat[3] = $d['ijazah_sma'];
$statusdb_file_syarat[4] = $d['transkrip_sma'];
$statusdb_file_syarat[5] = $d['kartu_keluarga'];
$statusdb_file_syarat[6] = $d['ktp'];
$statusdb_file_syarat[7] = $d['rapot1'];
$statusdb_file_syarat[8] = $d['rapot2'];
$statusdb_file_syarat[9] = $d['rapot3'];
$statusdb_file_syarat[10] = $d['hasil_to'];
$statusdb_file_syarat[11] = $d['sertif_juara'];
$statusdb_file_syarat[12] = $d['sk_jalur_khusus'];
$statusdb_file_syarat[13] = $d['ijazah_pt'];
$statusdb_file_syarat[14] = $d['transkrip_pt'];
$statusdb_file_syarat[15] = $d['laporan_pdpt'];
$statusdb_file_syarat[16] = $d['ktm'];
$statusdb_file_syarat[17] = $d['sk_pindah_studi'];
$statusdb_file_syarat[18] = $d['s_rekom_lldikti'];
$statusdb_file_syarat[19] = $d['kip'];

$statusdb_file_syarat[20] = $d['foto_keluarga'];
$statusdb_file_syarat[21] = $d['dok_eko'];
$statusdb_file_syarat[22] = $d['foto_rumah'];
$statusdb_file_syarat[23] = $d['foto_ruang_klg'];

$statusdb_file_syarat[24] = "";
$statusdb_file_syarat[25] = "";


if ($debug_mode) {
  echo "<br><br><br><br><br><hr>";
  for ($i=1; $i <=25 ; $i++) { 
    echo "<br> statusdb_file_syarat[$i] = ".$statusdb_file_syarat[$i];
  }
  echo "<hr>";
}


# FILE EXISTS STATUS ==============================================
function artikan_status($kode_status){
  switch ($kode_status) {
    case -1: return "<span class='note_red'>Rejected</span>";break;
    case 0: return "<span class='note_purple'>Not verified</span>";break;
    case 1: return "<span class='note_green'>Accepted</span>";break;
    default: return "<span class='note_red'>Belum Upload</span>";break;
  }
}


# =====================================================
# SYARAT UTAMA
# =====================================================
$jumlah_persyaratan_utama_lengkap=0;
$jumlah_persyaratan_utama_verified=0;
for ($i=1; $i <=$jumlah_persyaratan_total ; $i++) { 
  if (file_exists("uploads/$folder_uploads/__".$file_syarat[$i].".jpg")) {
    $status_file_syarat[$i] = 1; //file exist
    $status_file_syarat_html[$i] = artikan_status($statusdb_file_syarat[$i]);
    if($i<=6){
      $jumlah_persyaratan_utama_lengkap++;
      if ($statusdb_file_syarat[$i]==1) {
        $jumlah_persyaratan_utama_verified++;
      }
    }
  }else{
    $status_file_syarat[$i] = 0; //not file exist
    $status_file_syarat_html[$i] = artikan_status(-9); //not available

    # UPDATE STATUS-DB FILE SYARAT JIKA FILE HILANG =========================
    if ($statusdb_file_syarat[$i]!=0) { // jika file hilang dan status-db ACCEPTED atau REJECTED
      $s = "UPDATE tb_daftar_syarat set ".$file_syarat[$i]." = 0 where id_syarat = '$id_syarat'";
      $q = mysqli_query($cn,$s) or die("Error cek_stsyarat Update inexist syarat.");
      $s = "UPDATE tb_daftar set is_lengkap_syarat = 0 where id_daftar = '$id_daftar'";
      $q = mysqli_query($cn,$s) or die("Error cek_stsyarat Update status lengkap syarat.");
      $statusdb_file_syarat[$i]=0; //reupdate list
    }
  }

  if ($debug_mode) {
    echo "<br><br><br>";
    echo "File ke-$i : uploads/$folder_uploads/__".$file_syarat[$i].".jpg";
  }

}
































# =====================================================
# SYARAT TAMBAHAN
# =====================================================
for ($i=1; $i <=14 ; $i++) { 
  $syarat_tambahan[$i]="";
  $status_file_syarat_tambahan[$i]="";
}

if ($id_jndaftar==2) {
  $syarat_tambahan[1] = $file_syarat[13]; //ijazah_pt
  $syarat_tambahan[2] = $file_syarat[14];
  $syarat_tambahan[3] = $file_syarat[15];
  $syarat_tambahan[4] = $file_syarat[16];
  $syarat_tambahan[5] = $file_syarat[17];
  $syarat_tambahan[6] = $file_syarat[18];

  $syarat_tambahan_cap[1] = $file_syarat_cap[13]; //ijazah_pt
  $syarat_tambahan_cap[2] = $file_syarat_cap[14];
  $syarat_tambahan_cap[3] = $file_syarat_cap[15];
  $syarat_tambahan_cap[4] = $file_syarat_cap[16];
  $syarat_tambahan_cap[5] = $file_syarat_cap[17];
  $syarat_tambahan_cap[6] = $file_syarat_cap[18];

  if (file_exists("uploads/$folder_uploads/__".$file_syarat[13].".jpg")) {
    $status_file_syarat_tambahan[1] = artikan_status($statusdb_file_syarat[13]);}else{
    $status_file_syarat_tambahan[1] = $blm_uplod;}
  if (file_exists("uploads/$folder_uploads/__".$file_syarat[14].".jpg")) {
    $status_file_syarat_tambahan[2] = artikan_status($statusdb_file_syarat[14]);}else{
    $status_file_syarat_tambahan[2] = $blm_uplod;}
  if (file_exists("uploads/$folder_uploads/__".$file_syarat[15].".jpg")) {
    $status_file_syarat_tambahan[3] = artikan_status($statusdb_file_syarat[15]);}else{
    $status_file_syarat_tambahan[3] = $blm_uplod;}
  if (file_exists("uploads/$folder_uploads/__".$file_syarat[16].".jpg")) {
    $status_file_syarat_tambahan[4] = artikan_status($statusdb_file_syarat[16]);}else{
    $status_file_syarat_tambahan[4] = $blm_uplod;}
  if (file_exists("uploads/$folder_uploads/__".$file_syarat[17].".jpg")) {
    $status_file_syarat_tambahan[5] = artikan_status($statusdb_file_syarat[17]);}else{
    $status_file_syarat_tambahan[5] = $blm_uplod;}
  if (file_exists("uploads/$folder_uploads/__".$file_syarat[18].".jpg")) {
    $status_file_syarat_tambahan[6] = artikan_status($statusdb_file_syarat[18]);}else{
    $status_file_syarat_tambahan[6] = $blm_uplod;}

};

if ($id_jndaftar==3) {
  $syarat_tambahan[1] = $file_syarat[19]; //kip
  $syarat_tambahan_cap[1] = $file_syarat_cap[19]; //kip
  if (file_exists("uploads/$folder_uploads/__".$file_syarat[19].".jpg")) {
    $status_file_syarat_tambahan[1] = artikan_status($statusdb_file_syarat[19]);}else{
    $status_file_syarat_tambahan[1] = $blm_uplod;}
};

if ($id_jndaftar==4 or $id_jndaftar==5) { //kip sementara
  $syarat_tambahan[1] = $file_syarat[20]; //foto kuluarga
  $syarat_tambahan[2] = $file_syarat[21]; //dok_eko
  $syarat_tambahan[3] = $file_syarat[22]; //foto rumah
  $syarat_tambahan[4] = $file_syarat[23]; //foto r kelg

  $syarat_tambahan_cap[1] = $file_syarat_cap[20]; 
  $syarat_tambahan_cap[2] = $file_syarat_cap[21]; 
  $syarat_tambahan_cap[3] = $file_syarat_cap[22]; 
  $syarat_tambahan_cap[4] = $file_syarat_cap[23]; 

  if (file_exists("uploads/$folder_uploads/__".$file_syarat[20].".jpg")) {
    $status_file_syarat_tambahan[1] = artikan_status($statusdb_file_syarat[20]);}else{
    $status_file_syarat_tambahan[1] = $blm_uplod;}
  if (file_exists("uploads/$folder_uploads/__".$file_syarat[21].".jpg")) {
    $status_file_syarat_tambahan[2] = artikan_status($statusdb_file_syarat[21]);}else{
    $status_file_syarat_tambahan[2] = $blm_uplod;}
  if (file_exists("uploads/$folder_uploads/__".$file_syarat[22].".jpg")) {
    $status_file_syarat_tambahan[3] = artikan_status($statusdb_file_syarat[22]);}else{
    $status_file_syarat_tambahan[3] = $blm_uplod;}
  if (file_exists("uploads/$folder_uploads/__".$file_syarat[23].".jpg")) {
    $status_file_syarat_tambahan[4] = artikan_status($statusdb_file_syarat[23]);}else{
    $status_file_syarat_tambahan[4] = $blm_uplod;}

};


# ===============================================================
# SYARAT TAMBAHAN BY JALUR BEASISWA
# ===============================================================
if ($id_jalur>=2 and $id_jalur<=3 ) {  
  $syarat_tambahan[1] = $file_syarat[7]; //rapot
  $syarat_tambahan[2] = $file_syarat[8];
  $syarat_tambahan[3] = $file_syarat[9];

  $syarat_tambahan_cap[1] = $file_syarat_cap[7]; //rapot
  $syarat_tambahan_cap[2] = $file_syarat_cap[8];
  $syarat_tambahan_cap[3] = $file_syarat_cap[9];

  if (file_exists("uploads/$folder_uploads/__".$file_syarat[7].".jpg")) {
    $status_file_syarat_tambahan[1] = artikan_status($statusdb_file_syarat[7]);}else{
    $status_file_syarat_tambahan[1] = $blm_uplod;}
  if (file_exists("uploads/$folder_uploads/__".$file_syarat[8].".jpg")) {
    $status_file_syarat_tambahan[2] = artikan_status($statusdb_file_syarat[8]);}else{
    $status_file_syarat_tambahan[2] = $blm_uplod;}
  if (file_exists("uploads/$folder_uploads/__".$file_syarat[9].".jpg")) {
    $status_file_syarat_tambahan[3] = artikan_status($statusdb_file_syarat[9]);}else{
    $status_file_syarat_tambahan[3] = $blm_uplod;}
};

if ($id_jalur>=4 and $id_jalur<=6 ) {
  $syarat_tambahan[1] = $file_syarat[10]; //to
  $syarat_tambahan_cap[1] = $file_syarat_cap[10]; //to

  if (file_exists("uploads/$folder_uploads/__".$file_syarat[10].".jpg")) {
    $status_file_syarat_tambahan[1] = artikan_status($statusdb_file_syarat[10]);}else{
    $status_file_syarat_tambahan[1] = $blm_uplod;}
};

if ($id_jalur>=7 and $id_jalur<=16 ) {
  $syarat_tambahan[1] = $file_syarat[11]; //juara
  $syarat_tambahan_cap[1] = $file_syarat_cap[11]; //juara

  if (file_exists("uploads/$folder_uploads/__".$file_syarat[11].".jpg")) {
    $status_file_syarat_tambahan[1] = artikan_status($statusdb_file_syarat[11]);}else{
    $status_file_syarat_tambahan[1] = $blm_uplod;}

};

if ($id_jalur>=17 and $id_jalur<=20 ) {
  $syarat_tambahan[1] = $file_syarat[12]; //khusus
  $syarat_tambahan_cap[1] = $file_syarat_cap[12]; //khusus

  if (file_exists("uploads/$folder_uploads/__".$file_syarat[12].".jpg")) {
    $status_file_syarat_tambahan[1] = artikan_status($statusdb_file_syarat[12]);}else{
    $status_file_syarat_tambahan[1] = $blm_uplod;}

};





for ($i=1; $i <=14 ; $i++) { 
  if ($syarat_tambahan[$i]=="") {
    $html_syarat_tambahan[$i]= "";
    $html_syarat_tambahan2[$i]= "";
  }else{
    $html_syarat_tambahan[$i]= "<span style='color:#003'><img src='assets/img/icons/next_small.png' width='15px'> <a href='#input_".$syarat_tambahan[$i]."'>".$syarat_tambahan_cap[$i]."</a></span> ..... ".$status_file_syarat_tambahan[$i]."<br>";

    $status_file_syarat_tambahan2[$i]="$na";
    if(strpos($status_file_syarat_tambahan[$i], "erified")) $status_file_syarat_tambahan2[$i] = $tdquest;
    if($status_file_syarat_tambahan[$i]==$accepted) $status_file_syarat_tambahan2[$i] = $ceklis;

    $html_syarat_tambahan2[$i]= "<span><img src='assets/img/icons/next_small.png' width='20px'> ".$syarat_tambahan_cap[$i]."</span>  ".$status_file_syarat_tambahan2[$i]."<br>";
  }
}

$syarat_tambahan_tidak_lengkap = 0;
$jumlah_persyaratan_tambahan_lengkap = 0;
$jumlah_persyaratan_tambahan_total = 0;
$jumlah_persyaratan_tambahan_verified=0;

for ($i=1; $i <=10 ; $i++) { 
  if ($syarat_tambahan[$i]!="") {
    $jumlah_persyaratan_tambahan_total++;
    if ($status_file_syarat_tambahan[$i]==$rejected or 
        $status_file_syarat_tambahan[$i]==$blm_uplod)  {
      $syarat_tambahan_tidak_lengkap = 1;
    }else{
      $jumlah_persyaratan_tambahan_lengkap++;
      if ($status_file_syarat_tambahan[$i]==$accepted) {
        $jumlah_persyaratan_tambahan_verified++;
      }
    }
  }
}

$jumlah_persyaratan_user = $jumlah_persyaratan_utama_total + $jumlah_persyaratan_tambahan_total;
$jumlah_persyaratan_user_lengkap = $jumlah_persyaratan_utama_lengkap + $jumlah_persyaratan_tambahan_lengkap;
$jumlah_persyaratan_user_verified = $jumlah_persyaratan_utama_verified + $jumlah_persyaratan_tambahan_verified;


# ======================================================
# HITUNG DATA TIDAK PENTING
# ======================================================
$jumlah_input_data_all_user=$jumlah_input_data_penting_user;
if($nisn!="")$jumlah_input_data_all_user++;
// zzz data tidak penting lainnya






# ======================================================
# SET STEP DAFTAR
# ======================================================
$step_daftar[0]="Registrasi Gmail";
$step_daftar[1]="Melengkapi Data";
$step_daftar[2]="Bayar Formulir";//upload bukti_bayar
$step_daftar[3]="Melengkapi Persyaratan"; //lengkap - belum tes
$step_daftar[4]="Tes Seleksi PMB"; // lengkap - sudah tes
$step_daftar[5]="Registrasi Ulang"; //registrasi ulang

for ($i=1; $i <= 6 ; $i++) { $status_step_daftar[$i] = 0;}

if ($email!="" 
  and $nama_calon!="" 
  and $no_hp!="" 
  and $no_wa!="") 
  $status_step_daftar[0]=1; //regis email

if ($jumlah_input_data_penting_user>=$jumlah_input_data_penting) 
  $status_step_daftar[1]=1; //lengkapi data

if ($status_file_syarat[1] and $statusdb_file_syarat[1]) //jika bukti_bayar exist dan juga di verified 
  $status_step_daftar[2]=1; //bayar formulir

if ($jumlah_persyaratan_user==$jumlah_persyaratan_user_verified and $status_step_daftar[1]) 
  $status_step_daftar[3]=1; //persyaratan lengkap

//if ($status_step_daftar[0]==1 and $statusdb_file_syarat[1]==1) $status_step_daftar[3]=1; //cetak kartu tes



# ======================================================
# SET-DB STATUS_DAFTAR NEW
# ======================================================
$status_daftar_new = 0;
if($status_step_daftar[1]) $status_daftar_new = 1;
if($status_step_daftar[2]) $status_daftar_new = 2;
if($status_step_daftar[3]) $status_daftar_new = 3;
if($status_daftar>3) $status_daftar_new = $status_daftar; //jika status daftar telah tes PMB

$sql_status_daftar = "";
if($status_daftar_new!=0) $sql_status_daftar = " ,status_daftar = $status_daftar_new "; 
$s = "UPDATE tb_daftar set 
is_lengkap_data = ".$status_step_daftar[1].",
is_lengkap_syarat = ".$status_step_daftar[3]."
$sql_status_daftar 
where id_daftar = '$id_daftar'";
$q = mysqli_query($cn,$s) or die("Error cek_stsyarat Update status daftar.");






$bull = '<img src="assets/img/icons/next_small.png" width="12px">';
$ceklis = '<img src="assets/img/icons/check_small.png" width="12px">'; 
$prev = "<span class='note_red'>incomplete</span>"; 

$penanda_step0 = $prev;
$penanda_step1 = $prev;
$penanda_step2 = $prev;
$penanda_step3 = $prev;
$penanda_step4 = $prev;
$penanda_step5 = $prev;

if ($status_step_daftar[0]) $penanda_step0 = $ceklis; //regis email
if ($status_step_daftar[1]) $penanda_step1 = $ceklis; //data
if ($status_step_daftar[2]) $penanda_step2 = $ceklis; //syarat

$btn_cetak_kartu_tes_disabled ="disabled";
$btn_cetak_kartu_tes_cap ="Belum bisa cetak";
$btn_cetak_formulir_disabled ="disabled";
$btn_download_profil_ikmi_disabled ="disabled";
$btn_cetak_formulir_cap ="Belum bisa cetak";
$btn_download_profil_ikmi_cap ="Belum bisa download";
$btn_cetak_regis_disabled ="disabled";
$btn_cetak_regis_cap ="Belum bisa cetak";

if ($status_step_daftar[1]) {
  $penanda_step1 = $ceklis; 
  $btn_cetak_formulir_disabled = "";
  $btn_download_profil_ikmi_disabled = "";
  $btn_cetak_formulir_cap ="Cetak Hasil Formulir";
  $btn_download_profil_ikmi_cap ="Download Profil IKMI";
} //lengkapi data

if ($status_step_daftar[0] and $status_step_daftar[2]) {
  $penanda_step3 = $ceklis; 
  $btn_cetak_kartu_tes_disabled = "";
  $btn_cetak_kartu_tes_cap ="Cetak Kartu Tes PMB";
} //bukti bayar
else if($status_file_syarat[1]==0){$penanda_step3 = "<span class='note_red'>Belum upload</span>";} 
else if($statusdb_file_syarat[1]==-1){$penanda_step3 = "<span class='note_red'>Bukti bayar Rejected</span>";} 
else if($statusdb_file_syarat[1]==0) {$penanda_step3 = "<span class='note_purple'>Belum diverifikasi</span>";}
else{$penanda_step3 = $ceklis;}

$is_lulus = 0; //zzz 
if ($status_step_daftar[1] and $status_step_daftar[2] and $is_lulus ) {
  $penanda_step4 = $ceklis; 
  $btn_cetak_regis_disabled = "";
  $btn_cetak_regis_cap ="Cetak Kartu Prasyarat Registrasi";
} //lengkapi data dan syarat dan lulus_tes


if ($status_step_daftar[4]) $penanda_step4 = ""; //seleksi
if ($status_step_daftar[5]) $penanda_step5 = ""; //regis ulang

if (($id_jndaftar==3 or $id_jndaftar==4 or $id_jndaftar==5) and trim($id_jndaftar!="")) {
  $btn_cetak_kartu_tes_disabled = "";
  $btn_cetak_kartu_tes_cap ="Cetak Kartu Tes PMB";

}






if (0) {
  echo "<br><br><br><hr>
  <br> status_step_daftar 1 : ".$step_daftar[0]." = ".$status_step_daftar[0]."
  <br> status_step_daftar 2 : ".$step_daftar[1]." = ".$status_step_daftar[1]."
  <br> status_step_daftar 3 : ".$step_daftar[2]." = ".$status_step_daftar[2]."
  <br> status_step_daftar 4 : ".$step_daftar[3]." = ".$status_step_daftar[3]."
  <br> status_step_daftar 5 : ".$step_daftar[4]." = ".$status_step_daftar[4]."
  <br> status_step_daftar 6 : ".$step_daftar[5]." = ".$status_step_daftar[5]."
  <br> 
  <br> statusdb_file_syarat 1 bukti_bayar : ".$statusdb_file_syarat[1]."
  <br> jumlah_persyaratan_user : $jumlah_persyaratan_user
  <br> jumlah_persyaratan_user_lengkap : $jumlah_persyaratan_user_lengkap
  <br> 
  <br> jumlah_input_data_penting : $jumlah_input_data_penting
  <br> jumlah_input_data_penting_user : $jumlah_input_data_penting_user
  <br> 
  <br> jumlah_persyaratan_total : $jumlah_persyaratan_total
  <br> 
  <br> jumlah_persyaratan_utama_total : $jumlah_persyaratan_utama_total
  <br> jumlah_persyaratan_utama_lengkap : $jumlah_persyaratan_utama_lengkap
  <br> 
  <br> jumlah_persyaratan_tambahan_total : $jumlah_persyaratan_tambahan_total
  <br> jumlah_persyaratan_tambahan_lengkap : $jumlah_persyaratan_tambahan_lengkap
  <br> 
  ";
  for ($i=1; $i <= 19; $i++) { 
    echo "<br> file_syarat[$i]: ".$file_syarat[$i]." status_file_syarat[$i]: " .$status_file_syarat[$i]." statusdb_file_syarat[$i]: ".$statusdb_file_syarat[$i];
  }
}
?>