<br>
<script type="text/javascript">
  var j_terisi = 0;
  var j_terisi_wajib = 0;
  var j_isian = 26;
  var j_isian_wajib = 14; //default for kelas reguler
  var link_bt = '';
  const days = ['Ahad', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
  const months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
</script>
<?php
// exit();
# ==========================================================================
# PENGAMAN SESSION LOGIN
# ==========================================================================
if (!isset($_SESSION['email'])) {die(tampil_error("Maaf, Anda belum login. <hr>$link_login"));}
if (!isset($_SESSION['nama_calon'])) {die(tampil_error("Maaf, Sesi Nama Calon belum diset. Silahkan hubungi programmer!<hr>$link_login"));}
$aksi= ''; if(isset($_GET['aksi'])) $aksi=$_GET['aksi'];






# ==========================================================================
# VARIABEL AWAL
# ==========================================================================
$nama_calon = $_SESSION['nama_calon'];
$nama_prodi = '';
$sudah_kerja = '';
if ($instansi_kerja !="") {$sudah_kerja = "checked";}
$kip_invitation_code= '';




# ==========================================================================
# DATA DARI DATABASE
# ==========================================================================
# KIP OPTIONZ
$s = "SELECT * from tb_daftar_jndaftar where jenis_jalur = 'KIP'";
$q = mysqli_query($cn,$s) or die("Error @index. Tidak dapat mendapatkan list Jenis Daftar KIP.");
if(mysqli_num_rows($q)==0) die("Error @index. List Jenis Daftar KIP harus minimal satu baris.");
$jndaftar_kip_options= '';
while ($d = mysqli_fetch_assoc($q)) {
  $id_jndaftar = $d['id_jndaftar'];
  $nama_jndaftar = $d['nama_jndaftar'];
  $jndaftar_kip_options.="<option value='$id_jndaftar'>$nama_jndaftar</option>";
}

# ==========================================================================
# IKMI OPTIONZ
$s = "SELECT * from tb_daftar_jndaftar where jenis_jalur = 'IKMI'";
$q = mysqli_query($cn,$s) or die("Error @index. Tidak dapat mendapatkan list Jenis Daftar IKMI.");
if(mysqli_num_rows($q)==0) die("Error @index. List Jenis Daftar IKMI harus minimal satu baris.");
$jndaftar_ikmi_options= '';
while ($d = mysqli_fetch_assoc($q)) {
  $id_jndaftar = $d['id_jndaftar'];
  $nama_jndaftar = $d['nama_jndaftar'];
  $jndaftar_ikmi_options.="<option value='$id_jndaftar'>$nama_jndaftar</option>";
}

# ==========================================================================
# DATA CALON
$email = $_SESSION['email'];
$s = "SELECT * from tb_calon a join tb_daftar b on a.id_calon=b.id_calon where a.email='$email'";
$q = mysqli_query($cn,$s) or die("Tidak dapat mengakses data calon dengan email: $email");
if(mysqli_num_rows($q)!=1) die("Query harus satu baris rows. SQL: $s");
$d = mysqli_fetch_assoc($q);

$id_daftar = $d['id_daftar'];
$id_pegawai = $d['id_pegawai'];
$id_calon = $d['id_calon'];
$id_gel = $d['id_gel'];
$id_biaya = $d['id_biaya'];
$id_jndaftar = $d['id_jndaftar'];
$id_jalur = $d['id_jalur'];
$id_referal = $d['id_referal'];
$id_syarat = $d['id_syarat'];
$id_tahap = $d['id_tahap'];
$no_daf = $d['no_daf'];
$no_daf_kip = $d['no_daf_kip'];
$status_daftar = $d['status_daftar'];
$is_lengkap_data = $d['is_lengkap_data'];
$is_lengkap_syarat = $d['is_lengkap_syarat'];
$is_ikut_tes = $d['is_ikut_tes'];
$is_lulus_tes = $d['is_lulus_tes'];
$tanggal_daftar = $d['tanggal_daftar'];
$id_durasi_bayar = $d['id_durasi_bayar'];
$folder_uploads = $d['folder_uploads'];
$last_notif_wa = $d['last_notif_wa'];
$last_notif_email = $d['last_notif_email'];
$last_notif_hp = $d['last_notif_hp'];
$alasan_reject = $d['alasan_reject'];
$id_calon = $d['id_calon'];
$id_sekolah = $d['id_sekolah'];
$id_kec = $d['id_kec'];
$nama_calon = $d['nama_calon'];
$email = $d['email'];
$password = $d['password'];
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
$nama_ayah = $d['nama_ayah'];
$pekerjaan_ayah = $d['pekerjaan_ayah'];
$nama_ibu = $d['nama_ibu'];
$pekerjaan_ibu = $d['pekerjaan_ibu'];
$instansi_kerja = $d['instansi_kerja'];
$jabatan_kerja = $d['jabatan_kerja'];
$alamat_kerja = $d['alamat_kerja'];
$lulusan = $d['lulusan'];
$sekolah_asal = $d['sekolah_asal'];
$tahun_lulus = $d['tahun_lulus'];
$no_ijazah = $d['no_ijazah'];
$prodi_asal = $d['prodi_asal'];
$alamat_domisili = $d['alamat_domisili'];
$id_jnkelas = $d['id_jnkelas'];

$id_prodi = $d['id_prodi'];
$id_jalur_daftar = $d['id_jalur_daftar'];
$kip_invitation_code = $d['kip_invitation_code'];
$id_jenis_kip = $d['id_jenis_kip'];
$id_jenis_beaikmi = $d['id_jenis_beaikmi'];
$id_durasi_bayar = $d['id_durasi_bayar'];
$tanggal_submit = $d['tanggal_submit'];
$tanggal_tes = $d['tanggal_tes'];

$id_kec_nik = $d['id_kec_nik'];
$nama_kec = '';$nama_kab = '';$nama_prov = '';
$lokasi_kec = '';
if($id_kec_nik!=""){
  $s = "SELECT * from tb_nik_kec a 
  join tb_nik_kab b on a.id_kab=b.id_kab 
  join tb_nik_prov c on b.id_prov=c.id_prov 
  where a.id_kec='$id_kec_nik'";
  $q = mysqli_query($cn,$s) or die("Tidak bisa mengakses data NIK-Kecamatan.");
  $d = mysqli_fetch_assoc($q);
  $nama_kec = ucwords(strtolower($d['nama_kec']));
  $nama_kab = ucwords(strtolower($d['nama_kab']));
  $nama_prov = ucwords(strtolower($d['nama_prov']));

  $lokasi_kec = "$nama_kec - $nama_kab - $nama_prov";
}

$cek_alamat_domisili_checked = '';
if($alamat_domisili==$alamat_jalan and $alamat_jalan!="") $cek_alamat_domisili_checked = "checked";

$sty_option4 = '';
if($id_prodi==2 or $id_prodi==3) $sty_option4 = "display:none";

$nama_calon = ucwords(strtolower($nama_calon));
if($nik!=""){
  $username_cbt = $nik;
  $tgl_nik = substr($nik,6,2);
  if($tgl_nik>40)$tgl_nik-=40;
  $password_cbt = $tgl_nik.substr($nik, 8,4);
}
if($id_tahap>=10)$username_cbt = "cbt$id_daftar";

$blok_hasil_submit_sty_class= '';
$blok_formulir_pendaftaran_sty_class= '';
if($status_daftar<1 or $aksi=="isi_form"){
  $blok_hasil_submit_sty_class="hideit";
}else{
  $blok_formulir_pendaftaran_sty_class="hideit";
}

if($tahun_lulus=="") $tahun_lulus=date("Y");

# ========================================================================== -->
# PRA-MAINTENANCE -->
# ========================================================================== -->
$tanggal_daftar_span = date("d M Y",strtotime($tanggal_daftar));
$id_daftar_max = 2212; //terakhir pra maintenance
if($tanggal_submit==""){
  $tabel_kontainer_tes_sty="hideit";
  $ket_pra_maintenance="Anda mendaftar pada tanggal $tanggal_daftar_span sebelum revisi web PMB (tanggal 12 Juni 2021). Untuk mendapatkan Jadwal Tes, silahkan Anda klik tombol Perbaiki Isian Formulir, lalu Submit Ulang Formulir Pendaftaran.";
  $ket_pra_maintenance="Untuk mendapatkan Jadwal Tes, silahkan Anda klik tombol Perbaiki Isian Formulir, lalu Submit Ulang Formulir Pendaftaran.";
}else{
  $ket_pra_maintenance= '';
}
// if($status_daftar==0)

$disabled_sudah_tes = '';
if($status_daftar>3) $disabled_sudah_tes = "disabled";

$tanggal_lahir_indo = date("dmY",strtotime($tanggal_lahir));

if($status_daftar==4 and $status_daftar==5) //zzz here

?>


<!-- ========================================================================== -->
<!-- GLOBAL STYLES -->
<!-- ========================================================================== -->
<style type="text/css">
  .pointlist {width: 100%; border: 1px solid #73AD21;}
  .table_header{background-color: #ddffff;}

  th, td {padding: 7px 10px;}
  .ket_input{font-weight: bold;color: blue;}
  .input_wajib{background-color: #ffaaaa;}
  .input_terisi{background-color: #aaffaa;}


</style>






































































<section id="blok_formulir_pendaftaran" class="about <?=$blok_formulir_pendaftaran_sty_class?>">
  <div class="container" data-aos="fade-up">


    <div>

      <div class="section-title">
        <h2>IKMI</h2>
        <p style="font-size: 20pt">Formulir Pendaftaran</p>
      </div>
      
      <div class="row">
        <div class="col-lg-10">
          <p style="font-weight: bold;color: blue">)* <?=$nama_calon?>, silahkan Anda lengkapi Formulir Pendaftaran Anda!
            <br>
            <small>Gelombang Pendaftaran saat ini: Gel-<?=$nama_gel ?>. Tahun Angkatan: <?=$tahun_angkatan ?></small>
            <br><small style="color: green">Bintang merah <?=$bm?> wajib diisi.</small>

          </p>
        </div>
      </div>

      <!-- ======================================================================== -->
      <!-- HIDDEN VARIABEL -->
      <!-- ======================================================================== -->
      <style type="text/css">.hidden_input{display: none}</style>
      <input class="hidden_input" type="text" id="id_daftar" value="<?=$id_daftar?>">
      <input class="hidden_input" type="text" id="email" value="<?=$email ?>">
      <input class="hidden_input" type="text" id="id_calon" value="<?=$id_calon ?>">
      <input class="hidden_input" type="text" id="id_gel" value="<?=$id_gel ?>">
      <input class="hidden_input" type="text" id="id_gel_calon" value="<?=$id_gel_calon ?>">
      <input class="hidden_input" type="text" id="id_angkatan" value="<?=$id_angkatan ?>">

      <input class="hidden_input" type="text" id="jenis_kelamin" value="<?=$jenis_kelamin ?>">
      <input class="hidden_input" type="text" id="id_kec" value="<?=$id_kec ?>">

      <input class="hidden_input" type="text" id="nama_kec" value="<?=$nama_kec?>">
      <input class="hidden_input" type="text" id="nama_kab" value="<?=$nama_kab?>">
      <input class="hidden_input" type="text" id="nama_prov" value="<?=$nama_prov?>">


      <input class='hidden_input' type='text' id='agama_db' value='<?=$agama?>'>
      <input class='hidden_input' type='text' id='alamat_domisili_db' value='<?=$alamat_domisili?>'>
      <input class='hidden_input' type='text' id='alamat_jalan_db' value='<?=$alamat_jalan?>'>
      <input class='hidden_input' type='text' id='alamat_kerja_db' value='<?=$alamat_kerja?>'>
      <input class='hidden_input' type='text' id='id_biaya_db' value='<?=$id_biaya?>'>
      <input class='hidden_input' type='text' id='id_durasi_bayar_db' value='<?=$id_durasi_bayar?>'>
      <input class='hidden_input' type='text' id='id_durasi_bayar_db' value='<?=$id_durasi_bayar?>'>
      <input class='hidden_input' type='text' id='id_jalur_daftar_db' value='<?=$id_jalur_daftar?>'>
      <input class='hidden_input' type='text' id='id_jalur_db' value='<?=$id_jalur?>'>
      <input class='hidden_input' type='text' id='id_jenis_beaikmi_db' value='<?=$id_jenis_beaikmi?>'>
      <input class='hidden_input' type='text' id='id_jenis_kip_db' value='<?=$id_jenis_kip?>'>
      <input class='hidden_input' type='text' id='id_jndaftar_db' value='<?=$id_jndaftar?>'>
      <input class='hidden_input' type='text' id='id_jnkelas_db' value='<?=$id_jnkelas?>'>
      <input class='hidden_input' type='text' id='id_prodi_db' value='<?=$id_prodi?>'>
      <input class='hidden_input' type='text' id='id_referal_db' value='<?=$id_referal?>'>
      <input class='hidden_input' type='text' id='id_sekolah_db' value='<?=$id_sekolah?>'>
      <input class='hidden_input' type='text' id='instansi_kerja_db' value='<?=$instansi_kerja?>'>
      <input class='hidden_input' type='text' id='jabatan_kerja_db' value='<?=$jabatan_kerja?>'>
      <input class='hidden_input' type='text' id='kip_invitation_code_db' value='<?=$kip_invitation_code?>'>
      <input class='hidden_input' type='text' id='lulusan_db' value='<?=$lulusan?>'>
      <input class='hidden_input' type='text' id='nama_ayah_db' value='<?=$nama_ayah?>'>
      <input class='hidden_input' type='text' id='nama_ibu_db' value='<?=$nama_ibu?>'>
      <input class='hidden_input' type='text' id='nik_db' value='<?=$nik?>'>
      <input class='hidden_input' type='text' id='nisn_db' value='<?=$nisn?>'>
      <input class='hidden_input' type='text' id='no_ijazah_db' value='<?=$no_ijazah?>'>
      <input class='hidden_input' type='text' id='no_kip_db' value='<?=$no_kip?>'>
      <input class='hidden_input' type='text' id='no_daf_kip_db' value='<?=$no_daf_kip?>'>
      <input class='hidden_input' type='text' id='pekerjaan_ayah_db' value='<?=$pekerjaan_ayah?>'>
      <input class='hidden_input' type='text' id='pekerjaan_ibu_db' value='<?=$pekerjaan_ibu?>'>
      <input class='hidden_input' type='text' id='prodi_asal_db' value='<?=$prodi_asal?>'>
      <input class='hidden_input' type='text' id='sekolah_asal_db' value='<?=$sekolah_asal?>'>
      <input class='hidden_input' type='text' id='status_menikah_db' value='<?=$status_menikah?>'>
      <input class='hidden_input' type='text' id='tahun_lulus_db' value='<?=$tahun_lulus?>'>
      <input class='hidden_input' type='text' id='tanggal_daftar_db' value='<?=$tanggal_daftar?>'>
      <input class='hidden_input' type='text' id='tempat_lahir_db' value='<?=$tempat_lahir?>'>
      <input class='hidden_input' type='text' id='warga_negara_db' value='<?=$warga_negara?>'>
      <input class='hidden_input' type='text' id='alamat_kodepos_db' value='<?=$alamat_kodepos?>'>
      <input class='hidden_input' type='text' id='tanggal_submit_db' value='<?=$tanggal_submit?>'>
      <input class='hidden_input' type='text' id='status_daftar_db' value='<?=$status_daftar?>'>
      <input class='hidden_input' type='text' id='tanggal_lahir_indo_db' value='<?=$tanggal_lahir_indo?>'>
      <input class='hidden_input' type='text' id='tanggal_tes_db' value='<?=$tanggal_tes?>'>




      <!-- ======================================================================== -->
      <!-- HIDDEN VARIABEL FOR GAMIFIED-SYSTEM -->
      <!-- ======================================================================== -->
      <!-- <input class='hidden_inputa' type='text' id='id_jndaftar_tmp' value="0"> -->








      <table class="pointlist"><tr class="table_header pointlist"><td>Jurusan Pendaftaran</td></tr>
        <tr>
          <td>

            <div class="form-group" id="blok_isian1">
              <div class="col-lg-10">
                <label class="control-label" for="tahun_lulus">1. Tahun Anda Lulus <?=$bm?> <imgas src="assets/img/icons/check_small.png" height="20px"></small></label>
                  <input value="<?=$tahun_lulus?>" type="text" class="form-control input_wajib isian_wajib input_isian" id="tahun_lulus" maxlength=4 minlength=4 required>
                  <small class="ket_input" id="tahun_lulus_ket">Beasiswa IKMI dan Beasiswa KIP hanya berlaku bagi lulusan tahun sekarang dan 2 (dua) tahun sebelumnya.</small>
                </div>
              </div>

              <div class="form-group" id="blok_isian2">
                <label class="control-label col-md-12" for="id_prodi">2. Prodi yang Anda Pilih <?=$bm?></label>
                <div class="col-lg-10">
                  <select class="form-control input_wajib input_pilihan pilihan_wajib" id="id_prodi">
                    <option value="0">--Pilih--</option>
                    <option value="1">S1 - Teknik Informatika</option>
                    <option value="2">S1 - Rekayasa Perangkat Lunak</option>
                    <option value="3">S1 - Sistem Informasi</option>
                    <option value="4">D3 - Manajemen Informatika</option>
                    <option value="5">D3 - Komputerisasi Akuntansi</option>
                  </select>
                  <small class="ket_input" id="id_prodi_ket">Untuk saat ini beasiswa KIP hanya pada Prodi TI, MI, dan KA.</small>
                </div>
              </div>


              <div id="penjurusan" style="border: solid #aaaaaa 1px; border-radius: 15px; padding: 15px 5px; background-color: lightyellow; margin:0 15px 15px 15px">
                <div class="form-group" id="blok_isian3">
                  <div class="col-lg-10">
                    <label for="id_jalur_daftar">3. Jalur Pendaftaran <?=$bm?></label>

                    <div class="row">
                      <div class="col-9">
                        <select class="form-control" id="id_jalur_daftar">
                          <option value="0">--Pilih--</option>
                          <option value="1" id="id_jalur_daftar_option1">Reguler</option> <!-- 3a -->
                          <option value="2" id="id_jalur_daftar_option2">Transfer</option> <!-- 3b -->
                          <option value="3" id="id_jalur_daftar_option3" class="hideit">Beasiswa IKMI</option> <!-- 3c -->
                          <option value="4" id="id_jalur_daftar_option4" style="<?=$sty_option4?>">Beasiswa KIP-Kuliah</option> <!-- 3d -->
                        </select>
                      </div>
                      <div class="col-3">
                        <input type="text" class="form-control" id="id_jndaftar" disabled="" value="<?=$id_jndaftar?>" style="text-align: center">
                      </div>
                    </div>
                    <small class="ket_input" id="id_jalur_daftar_ket"></small>
                  </div>
                </div>

                <div id="blok_sub_jalur_daftar" style="padding-left: 30px">

                  <div id="blok_jenis_kip" class="form-group hideit nonreg">
                    <div class="col-lg-10">
                      <label for="id_jenis_kip">-- Jenis KIP Kuliah<?=$bm?></label>
                      <select class="form-control input_wajib pilihan_wajib" id="id_jenis_kip">
                        <!-- <option value="0">--Pilih--</option> -->
                        <?=$jndaftar_kip_options?>
                      </select>
                      <small class="ket_input" id="id_jenis_kip_ket"></small>
                    </div>
                  </div>


                  <!-- ======================================================== -->
                  <!-- BLOK KIP KULIAH -->
                  <!-- ======================================================== -->
                  <div id="blok_kip_kuliah_umum" class="hideit blok_kip_kuliah nonreg">

                    <div class="form-group">
                      <label class="control-label col-md-12" for="no_daf_kip">---- Nomor Pendaftaran KIP <?=$bm?>
                      <br><small>Daftar dan lihat pada <a href="https://kip-kuliah.kemdikbud.go.id/" target="_blank">Web Kemdikbud</a>! 19 Digit, Tanpa spasi, tanpa strip.</small>
                    </label>
                    <div class="col-lg-10">
                      <input type="text" class="form-control input_wajib isian_wajib input_isian" id="no_daf_kip" name="no_daf_kip" maxlength="19" value="<?=$no_daf_kip?>">
                      <small class="ket_input" id="no_daf_kip_ket"></small>
                    </div>
                  </div>

                  <div class="form-group hideit">
                    <label class="control-label col-md-12" for="no_kip">---- Nomor Kartu-KIP-Kuliah<?=$bm?>
                    <br><small>Lihat pada Kartu-KIP-Kuliah Anda! 16 Digit, Tanpa spasi, tanpa strip.</small>
                  </label>
                  <div class="col-lg-10">
                    <input type="text" class="form-control input_wajib isian_wajib input_isian" id="no_kip" name="no_kip" maxlength="16" value="<?=$no_kip?>">
                    <small class="ket_input" id="no_kip_ket"></small>
                  </div>
                </div>


              </div>





              <!-- ======================================================== -->
              <!-- BLOK KIP PKH -->
              <!-- ======================================================== -->
              <div id="blok_kip_pkh" class="hideit blok_kip_kuliah nonreg">
                <div class="form-group">
                  <label class="col-lg-10">---- KIP Code <?=$bm?><br><small>Tanpa spasi, tanpa strip, hanya huruf dan angka. KIP Code bisa Anda dapatkan dari Petugas Koordinator KIP di tiap wilayah. Jika masih kesulitan silahkan Anda hubungi Front-Office IKMI!</small></label>
                  <div class="col-lg-10">
                    <input type="text" class="form-control input_wajib isian_wajib input_isian" id="kip_invitation_code" maxlength="20"  value="<?=$kip_invitation_code?>">
                    <small class="ket_input" id="kip_invitation_code_ket"></small>
                  </div>
                </div>
              </div>


              <!-- ======================================================== -->
              <!-- BLOK KIP SEMENTARA -->
              <!-- ======================================================== -->
              <div id="blok_kip_sementara" class="hideit blok_kip_kuliah nonreg">
                <div class="form-group">
                  <label class="col-lg-10">---- KIP Kuliah Sementara</label>
                </div>
              </div>



              <!-- ======================================================== -->
              <!-- BLOK BEA-IKMI -->
              <!-- ======================================================== -->
              <div id="blok_beaikmi" class="form-group hideit nonreg">
                <div class="col-lg-10">
                  <label for="id_jenis_beaikmi">-- Jenis Beasiswa IKMI <?=$bm?></label>
                  <select class="form-control input_wajib input_pilihan pilihan_wajib" id="id_jenis_beaikmi" >
                    <option value="0">--Pilih--</option>
                    <?=$jndaftar_ikmi_options?>
                  </select>
                  <small class="ket_input" id="id_jenis_beaikmi_ket"></small>
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="col-lg-10">
                <small class="ket_input nonreg" id="id_jndaftar_ket"></small>
              </div>
            </div>
          </div>




          <div class="form-group" id="blok_isian4">
            <label class="control-label col-md-12" for="id_jnkelas">4. Kelas Pagi/Sore</label>
            <div class="col-lg-10">
              <select class="form-control input_terisi input_pilihan" id="id_jnkelas">
                <option value="1" >Kelas pagi - 08.00 s.d 16.00</option>
                <option value="2" >Kelas sore - 17.00 s.d 21.30</option>
              </select>
              <small class="ket_input" id="id_jnkelas_ket"></small>
            </div>
          </div>


          <div class="form-group" id="blok_isian5">
            <label class="control-label col-md-12" for="id_durasi_bayar">5. Durasi Pembayaran SPP</label>
            <div class="col-lg-10">
              <select class="form-control input_terisi input_pilihan" id="id_durasi_bayar">
                <option value="1">Tiap Semester</option>
                <option value="2">Tiap Bulan</option>
                <option value="3">Tiap Dua Semester</option>
              </select>
              <small class="ket_input" id="id_durasi_bayar_ket"></small>
            </div>
          </div>

          <div class="form-group" id="blok_isian6">
            <label class="control-label col-md-12" for="id_referal">6. Saya mendapatkan info pendaftaran IKMI dari: <?=$bm?></label>
            <div class="col-lg-10">
              <select class="form-control input_wajib input_pilihan pilihan_wajib" id="id_referal">
                <option value="0">--Pilih--</option>
                <option value="1">Langsung (sendiri)</option>
                <option value="2">Kakak kelas (IKMI)</option>
                <option value="3">Dosen/Civitas IKMI</option>
                <option value="4">Saudara</option>
                <option value="5">Teman</option>
                <option value="6">Sekolah (Guru)</option>
                <option value="7">Website IKMI</option>
                <option value="8">Browsing Internet</option>
                <option value="9">Media Sosial</option>
                <option value="10">Baligo/Spanduk</option>
                <option value="11">Iklan Koran</option>
                <option value="12">Iklan Radio</option>
                <option value="13">Iklan Televisi</option>
                <option value="14">Email</option>
                <option value="99">Lainnya</option>
              </select>
              <small class="ket_input" id="id_referal_ket"></small>
            </div>
          </div>
        </td>
      </tr>
    </table> 
    <p>&nbsp;</p>


    <table class="pointlist"><tr class="table_header pointlist"><td>Biodata Diri Anda</td></tr>
      <tr>
        <td>

          <div class="form-group" id="blok_isian7">
            <label class="control-label col-md-12" for="nik">7. NIK KTP <?=$bm?><small>16 digit</small></label>
            <div class="col-lg-10">
              <input type="text" class="form-control input_wajib isian_wajib input_isian" id="nik"  value="<?=$nik?>" maxlength="16" minlength="16">
              <div id="nik_divide" style="text-align: center;font-size: 16pt; display: none"><b>3211-1111-0687-0004</b></div>
              <div style="text-align: right" id="div_nik"><small><b><span id="ket_gender"></span><span id="ket_ttl"></span><span id="ket_usia"></span></b></small></div>
              <small class="ket_input" id="nik_ket"></small>
            </div>
          </div>

          <div class="form-group" id="blok_isian72">
            <label class="control-label col-md-12" for="tanggal_lahir">7b. Tanggal Lahir <?=$bm?><small>8 digit, format DDMMYYYY</small></label>
            <div class="col-lg-10">
              <input type="text" class="form-control input_wajib isian_wajib input_isian" id="tanggal_lahir_indo"  value="<?=$tanggal_lahir_indo?>" maxlength="8">
              <small class="ket_input" id="tanggal_lahir_indo_ket">Tanggal lahir otomatis terisi saat Anda mengetik NIK KTP</small>
            </div>
          </div>

          <div class="form-group" id="blok_isian8">
            <label class="control-label col-md-12" for="tempat_lahir">8. Tempat Lahir <?=$bm?></label>
            <div class="col-lg-10">
              <input type="text" class="form-control input_wajib isian_wajib input_isian" id="tempat_lahir" value="<?=$tempat_lahir?>" maxlength="30">
              <div id="list_kab" style="margin: 5px 0 15px 0"></div>
              <style type="text/css">
                .item_kab{cursor: pointer;color: darkblue; font-size: small;}
              </style>
              <script type="text/javascript">
                $(document).ready(function(){
                  $("#tempat_lahir").keyup(function(){

                    var a = $("#tempat_lahir").val();
                    var a_db = $("#tempat_lahir_db").val();
                    if(a.length<3) {$("#list_kab").html(""); return;}
                    if(a!=a_db){
                      $("#list_kab").show();
                      var link_ajax = "assets/ajax/get_nama_kabs.php?q="+a;

                      $.ajax({
                        url:link_ajax,
                        success:function(b){

                          $("#list_kab").html(b);

                        }
                      })
                    }
                  })
                })

                $(document).on("click",".item_kab",function(){
                  var x = $(this).text();
                  $("#list_kab").hide();
                  $("#tempat_lahir").val(x);
                  $("#tempat_lahir").focus();
                })
              </script>
              <small class="ket_input" id="tempat_lahir_ket"></small>
            </div>
          </div>


          <div class="form-group" id="blok_isian9">
            <label class="control-label col-md-12" for="status_menikah">9. Status Pernikahan</label>
            <div class="col-lg-10">
              <select class="form-control input_terisi input_pilihan" id="status_menikah">
                <option value="1" selected="">Belum Menikah</option>
                <option value="2">Menikah</option>
                <option value="3">Janda/Duda</option>
              </select>
              <small class="ket_input" id="status_menikah_ket"></small>
            </div>
          </div>

          <div class="form-group" id="blok_isian10">
            <label class="control-label col-md-12" for="agama">10. Agama</label>
            <div class="col-lg-10">
              <select class="form-control input_terisi input_pilihan" id="agama">
                <option value="1" selected="">Islam</option>
                <option value="2">Katolik</option>
                <option value="3">Protestan</option>
                <option value="4">Hindu</option>
                <option value="5">Budha</option>
                <option value="6">Konghucu</option>
                <option value="7">Lainnya</option>
              </select>
              <small class="ket_input" id="agama_ket"></small>
            </div>
          </div>

          <div class="form-group" id="blok_isian11">
            <label class="control-label col-md-12" for="warga_negara">11. Warga Negara</label>
            <div class="col-lg-10">
              <select class="form-control input_terisi input_pilihan" id="warga_negara">
                <option value="1" selected="">WNI</option>
                <option value="2">WN Asing</option>
              </select>
              <small class="ket_input" id="warga_negara_ket"></small>
            </div>
          </div>


          <div class="form-group" id="blok_isian12">
            <label class="control-label col-lg-10" for="alamat_jalan">12. Alamat Lengkap, RT/RW, Desa (sesuai KTP) <?=$bm?></label>
            <div class="col-lg-10">
              <textarea id="alamat_jalan" class="form-control input_wajib isian_wajib input_isian" rows=5><?=$alamat_jalan?></textarea>
              <p style="text-align: right; margin:0">
                <small>
                  <b>Kec: <span id="lokasi_kec"><?=$lokasi_kec?></span>
                  </b>
                </small>
              </p>
              <br><small class="ket_input" id="alamat_jalan_ket"></small>
            </div>
          </div>

          <div class="form-group" id="blok_isian13">
            <label class="control-label col-md-12" for="alamat_kodepos">13. Kode Pos</label>
            <div class="col-lg-10">
              <input type="text" class="form-control input_isian" id="alamat_kodepos" maxlength="5" value="<?=$alamat_kodepos?>">
              <small class="ket_input" id="alamat_kodepos_ket"></small>
            </div>
          </div>





          <div class="form-group" id="blok_isian14">

            <label class="control-label col-lg-10"><input type="checkbox" id="alamat_domisili_check" <?=$cek_alamat_domisili_checked?>> Domisili saya sesuai KTP</label>
            <script type="text/javascript">
              $(document).ready(function(){
                $("#alamat_domisili_check").click(function(){
                  if($("#alamat_domisili_check").is(":checked")) {
                      // $("#alamat_domisili").prop("disabled",true);
                      $("#alamat_domisili").prop("style","");
                      $("#alamat_domisili").val($("#alamat_jalan").val());
                      $("#alamat_domisili_ket").fadeOut();
                    }else{
                      // $("#alamat_domisili").prop("disabled",false);
                      // $("#alamat_domisili").val("");
                      $("#alamat_domisili").focus();
                    }
                  })
              })
            </script>
            <hr>
            <div class="col-lg-10">
              <label>14. Alamat Domisili, RT/RW, Desa, Kec, Kab</label>
              <textarea rows="5" class="form-control input_isian" id="alamat_domisili"><?=$alamat_domisili?></textarea>
              <small class="ket_input" id="alamat_domisili_ket"></small>
            </div>
          </div>


        </td>
      </tr>
    </table> 
    <p>&nbsp;</p>


    <table class="pointlist"><tr class="table_header pointlist"><td>Data Pendidikan</td></tr>
      <tr>
        <td>
          <div class="form-group" id="blok_isian15">
            <label class="control-label col-md-12" for="lulusan">15. Anda Lulusan <?=$bm?></label>
            <div class="col-lg-10">
              <select class="form-control input_wajib input_pilihan pilihan_wajib" id="lulusan">
                <option value="0">--Pilih--</option>
                <option value="1">SMAN</option>
                <option value="2">SMA Swasta</option>
                <option value="3">SMKN</option>
                <option value="4">SMK Swasta</option>
                <option value="5">MAN</option>
                <option value="6">MA Swasta</option>
                <option value="7">Akademi</option>
                <option value="8">Institute</option>
                <option value="9">Sekolah Tinggi</option>
                <option value="10">Universitas</option>
                <option value="11">Paket C (biasa)</option>
                <option value="12">Paket C Homeschooling</option>
                <option value="13">Lulusan Luar Negeri</option>
              </select>
              <small class="ket_input" id="pilih_lulusan_ket"></small>
            </div>
          </div>

          <div class="form-group" id="blok_isian16">
            <label class="control-label col-md-12" for="sekolah_asal">16. Asal Sekolah/PT <?=$bm?> </label>
            <div class="col-lg-10">
              <input type="text" class="form-control input_wajib isian_wajib input_isian" id="sekolah_asal" maxlength="50" required="" value="<?=$sekolah_asal ?>">
              <small class="ket_input" id="asal_sekolah_ket"></small>
            </div>
          </div>

          <div class="form-group" id="blok_isian17">
            <label class="control-label col-md-12" for="nisn">17. NISN  <small>10 digit</small></label>
            <div class="col-lg-10">
              <input type="text" class="form-control input_isian" id="nisn" value="<?=$nisn?>" maxlength="10">
              <small class="ket_input" id="nisn_ket"></small>
            </div>
          </div>

          <div class="form-group" id="blok_isian18">
            <label class="control-label col-md-12" for="no_ijazah">18. No. Ijazah <br><small>Contoh: DN-01 Ma 0007343</small></label>
            <div class="col-lg-10">
              <input type="text" class="form-control input_isian" id="no_ijazah" maxlength="20" value="<?=$no_ijazah?>">
              <small class="ket_input" id="no_ijazah_ket"></small>
            </div>
          </div>

          <div class="form-group" id="blok_isian19">
            <label class="control-label col-md-12" for="prodi_asal">19. Jurusan/Prodi Asal Sekolah</label>
            <div class="col-lg-10">
              <input type="text" class="form-control input_isian" id="prodi_asal" maxlength="20" value="<?=$prodi_asal?>">
              <small class="ket_input" id="prodi_asal_ket"></small>
            </div>
          </div>


        </td>
      </tr>
    </table> 
    <p>&nbsp;</p>


    <table class="pointlist"><tr class="table_header pointlist"><td>Data Orang Tua</td></tr>
      <tr>
        <td>



          <div class="form-group" id="blok_isian20">
            <label class="control-label col-md-12" for="nama_ayah">20. Nama Ayah <?=$bm?></label>
            <div class="col-lg-10">
              <input type="text" class="form-control input_wajib isian_wajib input_isian" id="nama_ayah" maxlength="30" value="<?=$nama_ayah ?>">
              <small class="ket_input" id="nama_ayah_ket"></small>
            </div>
          </div>

          <div class="form-group" id="blok_isian21">
            <label class="control-label col-lg-10" for="pekerjaan_ayah">21. Pekerjaan Ayah <?=$bm?></label>
            <div class="col-lg-10">
              <select class="form-control input_wajib input_pilihan pilihan_wajib" id="pekerjaan_ayah">
                <option value="0">--Pilih--</option>
                <option value="1">PNS Dosen/Guru</option>
                <option value="2">PNS Non Kependidikan</option>
                <option value="3">Dosen/Guru Swasta</option>
                <option value="4">TNI/Polri</option>
                <option value="5">BUMN</option>
                <option value="6">Swasta</option>
                <option value="7">Pedagang</option>
                <option value="8">Petani/Peternak</option>
                <option value="9">Nelayan</option>
                <option value="10">Wirausaha Lainnya</option>
                <option value="11">Anggota Dewan</option>
                <option value="12">TKI</option>
                <option value="98">Tidak bekerja</option>
                <option value="99">Lainnya</option>
              </select>
              <small class="ket_input" id="pekerjaan_ayah_ket"></small>
            </div>
          </div>


          <div class="form-group" id="blok_isian22">
            <label class="control-label col-md-12" for="nama_ibu">22. Nama Ibu <?=$bm?></label>
            <div class="col-lg-10">
              <input type="text" class="form-control input_wajib isian_wajib input_isian" id="nama_ibu" maxlength="30" value="<?=$nama_ibu ?>">
              <small class="ket_input" id="nama_ibu_ket"></small>
            </div>
          </div>

          <div class="form-group" id="blok_isian23">
            <label class="control-label col-lg-10" for="pekerjaan_ibu">23. Pekerjaan Ibu <?=$bm?></label>
            <div class="col-lg-10">
              <select class="form-control input_wajib input_pilihan pilihan_wajib" id="pekerjaan_ibu">
                <option value="0">--Pilih--</option>
                <option value="1">PNS Dosen/Guru</option>
                <option value="2">PNS Non Kependidikan</option>
                <option value="3">Dosen/Guru Swasta</option>
                <option value="4">TNI/Polri</option>
                <option value="5">BUMN</option>
                <option value="6">Swasta</option>
                <option value="7">Pedagang</option>
                <option value="8">Petani/Peternak</option>
                <option value="9">Nelayan</option>
                <option value="10">Wirausaha Lainnya</option>
                <option value="11">Anggota Dewan</option>
                <option value="12">TKI</option>
                <option value="90">Ibu Rumah Tangga</option>
                <option value="98">Tidak bekerja</option>
                <option value="99">Lainnya</option>
              </select>
              <small class="ket_input" id="pekerjaan_ibu_ket"></small>
            </div>
          </div>
        </td>
      </tr>
    </table> 
    <p>&nbsp;</p>


    <table class="pointlist"><tr class="table_header pointlist"><td>Data Pekerjaan</td></tr>
      <tr>
        <td>


          <div class="form-group">
            <div class="col-lg-10">
              <input type="checkbox" id="cek_bekerja" <?=$sudah_kerja ?>>
              <label for="cek_bekerja">Saya sudah bekerja</label>
            </div>
          </div>


          <div class="form-group" id="blok_isian24">
            <label class="control-label col-md-12" for="instansi_kerja">24. Saya Bekerja di</label>
            <div class="col-lg-10">
              <input type="text" class="form-control input_isian data_pekerjaan" id="instansi_kerja" maxlength="50" value="<?=$instansi_kerja ?>">
              <small class="ket_input ket_kerja" id="instansi_kerja_ket"></small>
            </div>
          </div>

          <div class="form-group" id="blok_isian25">
            <label class="control-label col-md-12" for="jabatan_kerja">25. Sebagai</label>
            <div class="col-lg-10">
              <input type="text" class="form-control input_isian data_pekerjaan" id="jabatan_kerja"  maxlength="20" value="<?=$jabatan_kerja ?>">
              <small class="ket_input ket_kerja" id="jabatan_kerja_ket"></small>
            </div>
          </div>

          <div class="form-group" id="blok_isian26">
            <label class="control-label col-md-12" for="alamat_kerja">26. Alamat Bekerja</label>
            <div class="col-lg-10">
              <input type="text" class="form-control input_isian data_pekerjaan" id="alamat_kerja" maxlength="100" value="<?=$alamat_kerja ?>">
              <small class="ket_input ket_kerja" id="alamat_kerja_ket"></small>
            </div>
          </div>
        </td>
      </tr>
    </table> 
    <p>&nbsp;</p>

    <table class="pointlist"><tr class="table_header pointlist"><td>Progres Pengisian</td></tr>
      <tr>
        <td>

          <div class="form-group">
            <label class="control-label col-md-12" >Jumlah Pengisian: <span id="j_terisi_span"></span> of <span id="j_isian_span"></span></label>
            <div class="col-lg-10">
              <div class="progress">
                <div class="progress-bar" role="progressbar" style="width: 75%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="progres_pengisian">25%</div>
              </div>
              <small id="link_bt"></small>
              <div id="ngisi_belum_lengkap">
                <style type="text/css">.belum_lengkap{color: red;font-weight: bold}</style>
                <hr>
                <p class="belum_lengkap">Untuk Submit Formulir, silahkan Anda lengkapi isian wajib yang berbintang merah! <span class="hideit">[<span id="j_terisi_wajib_span"></span> of <span id="j_isian_wajib_span"></span>]</span></p>
              </div>
            </div>
          </div>
        </td>
      </tr>
    </table> 
    <div class="row">
      <div class="col-lg-10">
        <button type="submit" class="btn btn-primary btn-block" style="margin-top: 15px" id="btn_submit_formulir" disabled="">Submit Formulir Pendaftaran</button>
        <?php if ($aksi=="isi_form"): ?>
          <a href="?p=daftar8" class="btn btn-warning btn-block" style="margin-top: 15px">Kembali ke Upload Persyaratan</a>
        <?php endif ?>
      </div>
    </div>

  </div>

  <br>
  <br>
  <hr>
  <div class="form-group">
    <div class="col-md-3">
      <a href="#" class="back-to-top">Back to Top</a>
    </div>
  </div>
</div>
</section>

<!-- =================================================================== -->
<!-- SECTION HASIL SUBMIT -->
<!-- =================================================================== -->

<section id="blok_hasil_submit" class="about <?=$blok_hasil_submit_sty_class?>">
  <div class="container" data-aos="fade-up">


    <div>

      <div class="section-title">
        <h2>IKMI</h2>
        <p style="font-size: 20pt">Hasil Submit</p>
      </div>
      

      <div class="row" style="margin: 10px 0;">
        <div class="col-lg-12" style="font-weight: bold; font-size: small;padding: 0"><h5 style="color: #33ff33">Terimakasih <?=$nama_calon?>, Anda telah mengisi Formulir Pendaftaran!</h5> 
          <span style="color: #4444ff">
            Silahkan catat baik-baik Jadwal-Tes-PMB Anda! Kemudian Anda boleh mengunduh Panduan-Upload-Persyaratan, atau Langsung Menuju Laman-Upload-Persyaratan.
          </span>
        </div>
        <div class="col-lg-3 offset-lg-9" style="padding: 0">
          <button class="btn btn-warning btn-block" style="margin: 10px 0;" id="btn_perbaiki_isian">Perbaiki Isian Formulir</button>
          <script type="text/javascript">
            $(document).ready(function(){
              $("#btn_perbaiki_isian").click(function(){
                var x = confirm("Lanjut ke Perbaikan Isian Formulir Pendafaran?");
                if(!x) return;
                $("#blok_hasil_submit").fadeOut();
                $("#blok_formulir_pendaftaran").fadeIn();
              })
            })
          </script>
        </div>
      </div>


      <table class="pointlist"><tr class="table_header pointlist biru"><td><b>Jadwal Tes PMB</b></td></tr>
        <tr>
          <td>
            <?=$ket_pra_maintenance?>
            <table id="tabel_kontainer_tes" class="<?=$tabel_kontainer_tes_sty?>">
              <tr>
                <td>Tanggal Daftar</td>
                <td>:</td>
                <td class="" id="tanggal_daftar_span">-</td>
              </tr>
              <tr>
                <td>Tanggal Submit</td>
                <td>:</td>
                <td class="biru tebal" id="tanggal_submit_span">-</td>
              </tr>
              <tr>
                <td>Tanggal Tes</td>
                <td>:</td>
                <td class="biru tebal" id="tanggal_tes_span">-</td>
              </tr>
              <tr>
                <td>Sesi</td>
                <td>:</td>
                <td class="biru tebal" id="sesi_tes_span">-</td>
              </tr>
              <tr>
                <td>Link</td>
                <td>:</td>
                <td class="biru tebal">
                  <a href="https://cbtpmb.ikmi.ac.id" target="_blank">
                    CBT-PMB STMIK IKMI Cirebon 
                    <br>
                    <i>https://cbtpmb.ikmi.ac.id</i>
                  </a>
                </td>
              </tr>
              <tr>
                <td>Username</td>
                <td>:</td>
                <td>
                  <span id="username_cbt" class="biru tebal"><?=$username_cbt?></span>
                </td>
              </tr>
              <tr>
                <td>Password</td>
                <td>:</td>
                <td>
                  <span id="password_cbt" class="biru tebal"><?=$password_cbt?></span> <small><i>(TTL Anda, 6 digit, Format: DDMMYY)</i></small>
                </td>
              </tr>
              <tr>
                <td>Tempat</td>
                <td>:</td>
                <td>Online (dari rumah masing-masing)</td>
              </tr>

            </table>

          </td>
        </tr>
      </table> 
      <div class="row">
        <div class="col-lg-3">
          <a href="<?=$link_panduan?>" target="_blank" class="btn btn-primary btn-block" style="margin-top: 15px">Unduh Panduan Upload</a>
        </div>
        <div class="col-lg-3">
          <a href="?p=daftar8" class="btn btn-primary btn-block" style="margin-top: 15px">Upload Persyaratan</a>
        </div>
        <div class="col-lg-3">
          <a href="?p=daftar9" class="btn btn-primary btn-block" style="margin-top: 15px">Status Pendaftaran</a>
        </div>
      </div>

    </div>

    <br>
    <br>
    <hr>
    <div class="form-group">
      <div class="col-md-3">
        <a href="#" class="back-to-top">Back to Top</a>
      </div>
    </div>
  </div>
</section>













































































































<script type="text/javascript">
  $(document).ready(function(){
    //=======================================================================
    // GLOBAL VARIABEL SCRIPT
    //=======================================================================







    //=======================================================================
    // SET TAMPILAN PERTAMA LOADING
    //=======================================================================
    $("#j_isian_span").text(j_isian);
    $("#j_isian_wajib_span").text(j_isian_wajib);

    // SET TAMPILAN PERTAMA ISIAN
    var sthj = "background-color:#aaffaa";
    var stred = "background-color:#ffaaaa";
    function setgreen(d){$("#"+d).prop("style",sthj);}
    function setred(d){$("#"+d).prop("style",stred);}



    // SET TAMPILAN PERTAMA BERDASARKAN DATABASE
    function setview_pilihan_pertama(d){
      if($("#"+d+"_db").val()!=""){
        $("#"+d).val($("#"+d+"_db").val()).change();
        $("#"+d).prop("style",sthj);
      }
      // console.log("setview_pilihan_pertama("+d+")");
      if(d=="id_jenis_kip"){
        var id_jenis_kip = $("#"+d).val();
        $("#id_jndaftar").val(id_jenis_kip);
        // console.log("enter here: id_jenis_kip, val:"+$("#"+d).val());
      }
      if(d=="id_jenis_beaikmi")$("#id_jndaftar").val($("#"+d).val());
    }

    setview_pilihan_pertama("id_prodi");
    setview_pilihan_pertama("id_jalur_daftar");
    setview_pilihan_pertama("id_jenis_kip");
    setview_pilihan_pertama("id_jenis_beaikmi");
    setview_pilihan_pertama("id_durasi_bayar");
    setview_pilihan_pertama("id_referal");

    setview_pilihan_pertama("status_menikah");
    setview_pilihan_pertama("agama");
    setview_pilihan_pertama("warga_negara");

    setview_pilihan_pertama("lulusan");
    setview_pilihan_pertama("pekerjaan_ayah");
    setview_pilihan_pertama("pekerjaan_ibu");


    if($("#alamat_domisili").val()!="")$("#cek_alamat_domisili").prop("checked",true);










    //=======================================================================
    // JQUERY FUNCTIONS
    //=======================================================================
    function hitung_jadwal_tes(){

      // =================================================================
      // HITUNG JADWAL TES
      // =================================================================
      var tanggal_daftar = $("#tanggal_daftar_db").val();
      var tanggal_submit = $("#tanggal_submit_db").val();

      $("#tanggal_daftar_span").text(tanggal_daftar);
      $("#tanggal_submit_span").text(tanggal_submit);


      var id_daftar = parseInt($("#id_daftar").val());
      var id_jnkelas = parseInt($("#id_jnkelas_db").val());
      var sesi_tes = (id_daftar % 4)+1;
      var sesi_tes_ket = '';

      switch(sesi_tes){
        case 1: sesi_tes_ket = "08.00 s.d 10.00 WIB"; break;
        case 2: sesi_tes_ket = "10.00 s.d 12.00 WIB"; break;
        case 3: sesi_tes_ket = "12.00 s.d 14.00 WIB"; break;
        case 4: sesi_tes_ket = "14.00 s.d 16.00 WIB"; break;
      }

      if(id_jnkelas==2) {sesi_tes=5; sesi_tes_ket = "16.00 s.d 20.00 WIB"}
      $("#sesi_tes_span").text("Sesi "+sesi_tes+", Pukul "+sesi_tes_ket);


      // IF STATUS DAFTAR = 4 ZZZ BLOK HASIL TES


      // CETAK KARTU TES EDIT ZZZ

      // HASIL SUBMIT :: ONLINE DARI RUMAH ZZZ

      // CSV FIELD SEMUA SHOW ZZZ

      // ZZZ STATUS DAFTAR:
      // ZZZ . ANDA LULUS
      // ZZZ . BAGI REG/TRANS
      // ZZZ . BAGI KIP KUMPUL BERKAS FISIK

      // ZZZ .RENCANA KRS
      // ZZZ .PKKMB-KU
      // ZZZ .AWAL PERKULIAHAN

      // zzz iklan masih ada kuota di IKMI

      
      if(tanggal_submit!=""){
        var y = new Date(tanggal_submit);
        // year, month, day, hour, minute, second, and millisecond (in that order):
        var z = new Date(y.getFullYear(),y.getMonth(),y.getDate());
        var zday = z.getDay();
        var hari_ini = days[z.getDay()];
        var selisih_ke_jumat = 5 - zday;
        var plus_day = 9;
        if(zday<6)plus_day=8-zday;

        function addDays(date, days) {
          var result = new Date(date);
          result.setDate(result.getDate() + days);
          return result;
        }

        var jadwal = addDays(z,plus_day);
        var tanggal_tes = jadwal.getFullYear()+"-"+(jadwal.getMonth()+1)+"-"+jadwal.getDate();
        var tanggal_tes_span = days[jadwal.getDay()]+", "+jadwal.getDate()+" "+months[jadwal.getMonth()]+" "+jadwal.getFullYear();
        // alert("Hari ini hari "+hari_ini+", Tanggal "+z.getDate()+" "+months[z.getMonth()]+" "+z.getFullYear());
        // alert("Jadwal Tes Tanggal: "+jadwal.getDate()+" "+months[jadwal.getMonth()]+" "+jadwal.getFullYear());
        $("#tanggal_tes").val(tanggal_tes);
        $("#tanggal_tes_span").text(tanggal_tes_span);
      }

    }



    function addlbt(id){link_bt+= "<a href='#blok_isian"+id+"' style='color:red;font-weight:bold'>"+id+"</a> | ";}


    function hitung_j_terisi(){
      j_terisi=0;
      j_terisi_wajib=0;
      link_bt = '';
      // if($("#no_kip").val().length==16) {setgreen("no_kip");}
      if($("#kip_invitation_code").val().length>=5)  {setgreen("kip_invitation_code");}
      if($("#no_daf_kip").val().length==19)  {setgreen("no_daf_kip");}

      // CODING INI HARUS TERURUT SESUAI DG FORM-NUMBER
      var i = 1;
      // NO.1
      if($("#tahun_lulus").val().length==4) {setgreen("tahun_lulus");j_terisi++;j_terisi_wajib++;}else{addlbt(i);}i++;
      if($("#id_prodi").val()!="0") {j_terisi++;j_terisi_wajib++;}else{addlbt(i);}i++;
      if(parseInt($("#id_jndaftar").val())!=0) {j_terisi++;j_terisi_wajib++;}else{addlbt(i);}i++;
      if($("#id_jnkelas").val()!="0") {j_terisi++;j_terisi_wajib++;}else{addlbt(i);}i++;
      if($("#id_durasi_bayar").val()!="0") {j_terisi++;}else{addlbt(i);}i++;
      if($("#id_referal").val()!="0") {j_terisi++;j_terisi_wajib++;}else{addlbt(i);}i++;
      // NO.6
      // NO.7
      if($("#tanggal_lahir_indo").val().length==8)  {setgreen("tanggal_lahir_indo");}else{addlbt(i);}
      // console.log("zzz hitung_j_terisi: tanggal_lahir: "+$("#tanggal_lahir_indo").val()+", i:"+i);

      if($("#nik").val().length==16)  {setgreen("nik");j_terisi++;j_terisi_wajib++;}else{addlbt(i);}i++;
      

      if($("#tempat_lahir").val().length>=5)  {setgreen("tempat_lahir");j_terisi++;j_terisi_wajib++;}else{addlbt(i);}i++;
      if($("#status_menikah").val()!="0") {j_terisi++;}else{addlbt(i);}i++;
      if($("#agama").val()!="0") {j_terisi++;}else{addlbt(i);}i++;
      if($("#warga_negara").val()!="0") {j_terisi++;}else{addlbt(i);}i++;
      if($("#alamat_jalan").val().length>=4)  {setgreen("alamat_jalan");j_terisi++;j_terisi_wajib++;}else{addlbt(i);}i++;
      if($("#alamat_kodepos").val().length==5)  {setgreen("alamat_kodepos");j_terisi++;}else{addlbt(i);}i++;
      if($("#alamat_domisili").val().length>=4)  {setgreen("alamat_domisili");j_terisi++;}else{addlbt(i);}i++;
      // NO.14

      // NO.15
      if($("#lulusan").val()!="0") {j_terisi++;j_terisi_wajib++;}else{addlbt(i);}i++;
      if($("#sekolah_asal").val().length>=4)  {setgreen("sekolah_asal");j_terisi++;j_terisi_wajib++;}else{addlbt(i);}i++;
      if($("#nisn").val().length==10)  {setgreen("nisn");j_terisi++;}else{addlbt(i);}i++;
      if($("#no_ijazah").val().length>=10)  {setgreen("no_ijazah");j_terisi++;}else{addlbt(i);}i++;
      if($("#prodi_asal").val().length>=2)  {setgreen("prodi_asal");j_terisi++;}else{addlbt(i);}i++;
      // NO.19
      // NO.20
      if($("#nama_ayah").val().length>=3)  {setgreen("nama_ayah");j_terisi++;j_terisi_wajib++;}else{addlbt(i);}i++;
      if($("#pekerjaan_ayah").val()!="0") {j_terisi++;j_terisi_wajib++;}else{addlbt(i);}i++;
      if($("#nama_ibu").val().length>=3)  {setgreen("nama_ibu");j_terisi++;j_terisi_wajib++;}else{addlbt(i);}i++;
      if($("#pekerjaan_ibu").val()!="0") {j_terisi++;j_terisi_wajib++;}else{addlbt(i);}i++;

      // NO.24
      if($("#instansi_kerja").val().length>=5)  {setgreen("instansi_kerja");j_terisi++;}else{addlbt(i);}i++;
      if($("#jabatan_kerja").val().length>=5)  {setgreen("jabatan_kerja");j_terisi++;}else{addlbt(i);}i++;
      if($("#alamat_kerja").val().length>=5)  {setgreen("alamat_kerja");j_terisi++;}else{addlbt(i);}i++;


      if(link_bt!=""){link_bt="Belum terisi: "+link_bt;}
      $("#link_bt").html(link_bt);

      $("#j_terisi_span").text(j_terisi);
      $("#j_terisi_wajib_span").text(j_terisi_wajib);
      var persen_isian = j_terisi/j_isian*100;
      $("#progres_pengisian").prop("style","width:"+persen_isian.toFixed()+"%");
      $("#progres_pengisian").text(persen_isian.toFixed()+"%");

      if(j_terisi_wajib==j_isian_wajib){
        $("#ngisi_belum_lengkap").hide();
        $("#btn_submit_formulir").prop("disabled",false);
        // alert("Anda sudah mengisi semua isian wajib. Saat ini Anda boleh Submit Formulir.");

      }else{
        $("#ngisi_belum_lengkap").show();
        $("#btn_submit_formulir").prop("disabled",true);

        // AUTO-SAVE WHEN ADA ERROR =============================
        // auto_save("status_daftar","-1","tb_daftar"); // zzz sementara
        // alert("j_terisi_wajib"+j_terisi_wajib+"j_isian_wajib"+j_isian_wajib);
        $("#blok_formulir_pendaftaran").show();
        $("#blok_hasil_submit").hide();

      }

    }

    function auto_save(id,isi,tb){
      // if(id=="nik") console.log("isi:"+isi);
      // alert("at auto_save,, id:"+id+", isi:"+isi);
      var id_calon = $("#id_calon").val();
      $.ajax({
        url:"assets/ajax/auto_save_form_daftar.php?id="+id+"&isi="+isi+"&tb="+tb+"&id_calon="+id_calon,
        success:function(a){
          if(a.substring(0,3)=="1__"){

            //update data mirror-db
            $("#"+id+"_db").val(isi);
            // alert("Autosave Sukses, ajax_respond: "+a);

          }else{
            alert("Autosave Gagal, ajax_respond: "+a);
          }
        }
      })
    }

    function setview_input(a,b){ //a=id, b=boolean
      if(parseInt(b)==0){
        setgreen(a);
        $("#"+a+"_ket").fadeOut();
      }else{
        setred(a);
        $("#"+a+"_ket").show();
      }

      // alert("from setview_input id:"+a+" boolean: "+b);
      hitung_j_terisi();
    }

    function setview_error(a,b){
      // a = id
      // b = komentar error
      // $("#"+a).prop("style",sthj);
      setred(a);
      $("#"+a+"_ket").text(b);
      $("#"+a+"_ket").prop("style","color:#ff0000");
    }


    (function($) {
      $.fn.inputFilter = function(inputFilter) {
        return this.on("input keydown keyup mousedown mouseup select contextmenu drop", function() {
          if (inputFilter(this.value)) {
            this.oldValue = this.value;
            this.oldSelectionStart = this.selectionStart;
            this.oldSelectionEnd = this.selectionEnd;
          } else if (this.hasOwnProperty("oldValue")) {
            this.value = this.oldValue;
            this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
          } else {
            this.value = '';
          }
        });
      };
    }(jQuery));
    //=======================================================================
    // INPUT NUMBER ONLY
    //=======================================================================
    $("#tahun_lulus").inputFilter(function(value) {return /^\d*$/.test(value); });
    // $("#no_kip").inputFilter(function(value) {return /^\d*$/.test(value); });
    $("#no_daf_kip").inputFilter(function(value) {return /^\d*$/.test(value); });
    $("#nik").inputFilter(function(value) {return /^\d*$/.test(value); });
    $("#tanggal_lahir_indo").inputFilter(function(value) {return /^\d*$/.test(value); });
    $("#nisn").inputFilter(function(value) {return /^\d*$/.test(value); });
    $("#alamat_kodepos").inputFilter(function(value) {return /^\d*$/.test(value); });



    // =======================================================================
    // SET TAMPILAN PER ITEM
    // =======================================================================
    function set_jalur_and_save_idjndaftar(a){
      // console.log("set_jalur_and_save_idjndaftar, id_jndaftar:"+a);
      $("#id_jndaftar").val(a);
      if(parseInt(a)==0){
        $("#id_jndaftar").prop("style","background-color:#ffaaaa; text-align:center");
      }else{
        $("#id_jndaftar").prop("style","text-align:center");
        auto_save("id_jndaftar",a,"tb_daftar");
      }

      // var id_jndaftar_tmp = parseInt($("#id_jndaftar_tmp").val());

      if(a!=0){

        var url_ajax = "assets/ajax/get_keterangan_jalur_daftar.php?id_jndaftar="+a;
        $.ajax({
          url:url_ajax,
          success:function(b){
            if(b.substring(0,3)=="1__"){
              var c = b.split("__");
              var ket_jalur = c[1];
              $("#id_jndaftar_ket").text(ket_jalur);
              $("#id_jndaftar_ket").show();
              // alert("id_jndaftar_tmp:"+id_jndaftar_tmp);
              // alert("ket_jalur:"+ket_jalur);

            }else{
              alert("AJAX-Gagal, ajax return: "+b);
              $("#id_jndaftar_ket").text("");
              $("#id_jndaftar_ket").hide();
              // alert("Gagal. id_jndaftar_tmp:"+id_jndaftar_tmp);

            }
          }
        })
      }
      // alert("From set_jalur_and_save_idjndaftar, jalur:"+a);
      hitung_j_terisi();
    }










    //  =====================================================
    //  JALUR DAFTAR CHANGE :: LEVEL 1
    //  =====================================================
    $("#id_jalur_daftar").change(function(){

      var id = $(this).prop("id");
      var isi = parseInt($(this).val());
      var isi_db = parseInt($("#id_jalur_daftar_db").val());
      $(".nonreg").hide();

      if(isi==0) {
        setview_error(id,"Silahkan Anda Pilih Jalur Pendaftaran."); 
        // alert("From id_jalur_daftar.change, set(0), isi:"+isi);
        set_jalur_and_save_idjndaftar(0);
        return;
      } 


      if(isi!=isi_db) setview_input(id,0);
      // JALUR BEAIKMI DI BLOK
      if(isi!=isi_db && isi!=3) auto_save(id,isi,"tb_daftar");
      // alert("isi:"+isi+" vs isi_db:"+isi_db);

      if(isi==1 || isi==2) {
        $("#id_jnkelas").prop("disabled",false);
        $("#id_durasi_bayar").prop("disabled",false);
        // alert("From id_jalur_daftar.change, set(isi), isi:"+isi+" isi_db: "+isi_db);
        if(isi!=isi_db) set_jalur_and_save_idjndaftar(isi);
        return;
      }

      if(isi==3){

        // JALUR BEAIKMI DITUTUP ==============================================
        alert("Mohon maaf, untuk saat ini Jalur Beasiswa IKMI masih ditutup.");
        var id_jndaftar = parseInt($("#id_jndaftar").val()); 
        if(id_jndaftar==0){
          $("#id_jalur_daftar").val(0); 
          setview_error(id,"Silahkan Anda Pilih Jalur Pendaftaran selain Jalur Beasiswa IKMI."); 
        }else{
          $("#id_jalur_daftar").val(id_jndaftar); 
        }
        return;


        $("#blok_beaikmi").fadeIn();
        set_jalur_and_save_idjndaftar($("#id_jenis_beaikmi").val());
        // alert("id_jalur_daftar value:"+isi);
        // $("#id_jndaftar_tmp").val(isi);
        return;
      }

      if(isi==4){

        $("#id_jnkelas").val(1).change(); // SET KE KELAS PAGI
        $("#id_durasi_bayar").val(1).change(); // SET KE TIAP SEMESTER
        $("#id_jnkelas").prop("disabled",true);
        $("#id_durasi_bayar").prop("disabled",true);
        $("#id_jnkelas").prop("style","");
        $("#id_durasi_bayar").prop("style","");

        $("#blok_jenis_kip").fadeIn();
        set_jalur_and_save_idjndaftar($("#id_jenis_kip").val());
        $("#id_jenis_kip").change(); 
        return;
      }

    })
    $("#id_jalur_daftar").change();
    //  =====================================================
    //  END LEVEL 1
    //  =====================================================






    //  =====================================================
    //  JENIS KIP CHANGE :: LEVEL 2
    //  =====================================================
    $("#id_jenis_kip").change(function(){

      var id = $(this).prop("id");
      var id_jalur_daftar = parseInt($("#id_jalur_daftar").val());
      var isi = parseInt($(this).val());
      var isi_db = parseInt($("#id_jenis_kip_db").val());
      var no_daf_kip = $("#no_daf_kip").val();
      var kip_invitation_code = $("#kip_invitation_code").val();

      if(id_jalur_daftar!=4) {return;}
      // STOP JIKA BUKAN JALUR DAFTAR KIP

      $(".blok_kip_kuliah").hide();

      // 3 KIP-UMUM
      // 4 KIP-SEMENTARA
      // 5 KIP-BANTIM
      // 6 KIP-PKH KOTA CRB
      // 7 KIP-PKH KAB CRB
      // 8 KIP-PKH KAB KUNINGAN
      // 9 KIP-PKH KAB INDRAMAYU
      // 10 KIP-PKH KAB MAJALENGKA
      // 11 KIP-PKH KAB CIAMIS
      // 12 KIP-PKH KAB SUBANG

      var syarat_tambahan_kip = 0; 

      switch(isi){
        case 3: $("#blok_kip_kuliah_umum").show(); if(no_daf_kip.length==19){syarat_tambahan_kip=1;};break;
        case 4: $("#blok_kip_sementara").show();syarat_tambahan_kip=1; break;
        case 5:
        case 6:
        case 7:
        case 8:
        case 9:
        case 10:
        case 11:
        case 12: $("#blok_kip_pkh").show(); if(kip_invitation_code.length>=5){syarat_tambahan_kip=1;}; break;
      }


      if(isi!=isi_db || isi==4) {

        if (syarat_tambahan_kip) {

          setview_input(id,0);
          set_jalur_and_save_idjndaftar(isi);
          auto_save(id,isi,"tb_daftar"); //auto_save(id_jenis_kip,isi,tb);

        }else{
          $("#id_jndaftar").val(0); 
        }


        hitung_j_terisi();
      }else{
        console.log("isi = isi_db");
      }
    });
    $("#id_jenis_kip").change();
























    // =======================================================================
    // INPUT ISIAN
    // =======================================================================
    $(".input_isian").focusout(function(){
      var id = $(this).prop("id");
      var isi = $(this).val().trim();
      var isi_db = $("#"+id+"_db").val().trim();
      if(isi==isi_db) return;


      var nilai = parseInt(isi);
      var ada_error = 1;
      var tb = "tb_calon";



      // =======================================================================
      // NIK KTP
      // =======================================================================
      if(id=="nik"){
        if(isi.length!=16){
          setview_error(id,"Silahkan masukan 16 digit NIK KTP sesuai yang tertera di KTP/KK Anda.");
          $("#nik_divide").show();
          $("#div_nik").hide();
          $("#nik_divide").text(isi.substring(0,4)+"-"+isi.substring(4,8)+"-"+isi.substring(8,12)+"-"+isi.substring(12,16));
          $("#nama_kec").text("");
          $("#nama_kab").text("");
          $("#nama_prov").text("");

        }else{

          $("#div_nik").fadeIn();
          $("#nik_divide").hide();

          var nik = isi;
          var err_nik = 0;

          var prv = nik.substring(0,2);
          var kab = nik.substring(2,4);
          var kec = nik.substring(4,6);
          var tgl = nik.substring(6,8);
          var bln = nik.substring(8,10);
          var thn = nik.substring(10,12);
          var nur = nik.substring(12,16); //no_urut
          // var akh = nik.substring(15,16); //1 digit terakhir


          // =======================================================================
          // CEK FORMAT NIK
          // =======================================================================
          if(parseInt(prv)<11) err_nik=1;
          if(parseInt(kab)==0) err_nik=1;
          if(parseInt(kec)==0) err_nik=1;
          if(parseInt(tgl)==0) err_nik=1;
          if(parseInt(bln)==0) err_nik=1;
          if(parseInt(nur)==0) err_nik=1;
          // if(parseInt(akh)==0) err_nik=1;

          if(parseInt(tgl)>71 || (parseInt(tgl)>31 && parseInt(tgl)<41)) err_nik=1;
          if(parseInt(bln)>12) err_nik=1;
          if(parseInt(thn)>10 && parseInt(thn)<60) err_nik=1;

          if(err_nik) {
            setview_error(id,"Format NIK yang Anda masukan tidak benar. Silahkan masukan 16 digit NIK KTP sesuai yang tertera di KTP/KK Anda."); 
            // setview_input(id,0);
            return;
          }
          // =======================================================================
          // CEK FORMAT NIK
          // =======================================================================

          var gender = "Laki-laki";
          var true_tgl = parseInt(tgl);
          if(parseInt(tgl)>40) {gender = "Perempuan"; true_tgl = parseInt(tgl)-40; }

          var nama_bulan = '';
          switch(bln){
            case "01": nama_bulan = "Januari"; break;
            case "02": nama_bulan = "Februari"; break;
            case "03": nama_bulan = "Maret"; break;
            case "04": nama_bulan = "April"; break;
            case "05": nama_bulan = "Mei"; break;
            case "06": nama_bulan = "Juni"; break;
            case "07": nama_bulan = "Juli"; break;
            case "08": nama_bulan = "Agustus"; break;
            case "09": nama_bulan = "September"; break;
            case "10": nama_bulan = "Oktober"; break;
            case "11": nama_bulan = "November"; break;
            case "12": nama_bulan = "Desember"; break;
            default: alert("Kode bulan error.");
          }

          var tahun = '';
          if(parseInt(thn)<50) tahun = "20"+thn;
          if(parseInt(thn)>=50) tahun = "19"+thn;

          var ttl = true_tgl+" "+nama_bulan+" "+tahun;

          var today = new Date();
          var birthday = new Date(bln+"/"+true_tgl+"/"+tahun);

          var ageDifMs = Date.now() - birthday.getTime();
          var ageDate = new Date(ageDifMs); // miliseconds from epoch
          var usia = Math.abs(ageDate.getUTCFullYear() - 1970);

          $("#ket_gender").text("Anda "+gender+", ");
          $("#ket_ttl").text("TTL: "+ttl+", ");
          $("#ket_usia").text("Usia "+usia+" tahun");

          var link_ajax = "assets/ajax/get_data_nik.php?nik="+nik;

          $.ajax({
            url:link_ajax,
            success:function(a){
              if(a.substring(0,3)=="1__"){
                // alert("Sukses, a: "+a);
                var z = a.split("__");
                var ra = z[1].split(";");
                var nama_kec = ra[0];
                var nama_kab = ra[1];
                var nama_prov = ra[2];
                $("#lokasi_kec").text(nama_kec+" - "+nama_kab+" - "+nama_prov);
                $("#username_cbt").text(nik);
                $("#password_cbt").text(true_tgl+bln+thn);

                ada_error=0;
                setview_input(id,ada_error);
                auto_save(id,isi,tb);


                // PERBARUI TAMPILAN ALAMAT JALAN

                return;

              }else{
                alert("Error on AJAX-NIK; return: "+a);


              }
            }
          })

          // alert("Lanjut: ada_error:"+ada_error);

        }
      }

      // =======================================================================
      // TANGGAL LAHIR
      // =======================================================================

      if (id=="tanggal_lahir_indo") {
         if (isi.length!=8) {
          setview_error(id,"Silahkan masukan tanggal lahir Anda dengan format DDMMYYYY !");
         }else{
          var dd = parseInt(isi.substring(0,2));
          var mm = parseInt(isi.substring(2,4));
          var yy = parseInt(isi.substring(4,8));
          var tgl_skg = new Date();
          var tahun_ini = tgl_skg.getFullYear();
          // console.log("tanggal_lahir_indo: dd : "+dd+", mm : "+mm+", yyyy : "+yy);

          if(dd<=0 || dd>31 || mm<=0 || mm>12 || yy<1970 || yy>tahun_ini){
            $("#tanggal_lahir_indo").val("");
            setview_error(id,"Sepertinya `"+dd+"-"+mm+"-"+yy+"` bukanlah sebuah tanggal yang benar. Silahkan Anda ulangi! Format 8 digit, DDMMYYYY");
          }else{
            ada_error = 0;
          }
        }
      }

      // =======================================================================
      // TAHUN LULUS
      // =======================================================================
      if (id=="tahun_lulus") {
        var d = new Date();
        var tahun_sekarang = d.getFullYear();

        if(nilai>=tahun_sekarang || nilai<1980){
          setview_error(id,"Silahkan masukan tahun lulus antara 1990 s.d "+tahun_sekarang);
          $("#tahun_lulus").val("");
          $("#tahun_lulus").focus();
        }else{ 
          ada_error = 0;
        }
      }


      // =======================================================================
      // NOMOR KIP
      // =======================================================================
      if(id=="no_kip"){
        if(isi.length!=16){
          setview_error(id,"Masukan Nomor KIP Anda sebanyak 16 digit.");
          $("#id_jndaftar").val(0);
        }else{
          ada_error=0;
        }
      }


      // =======================================================================
      // KIP INVITATION CODE
      // =======================================================================
      if(id=="kip_invitation_code"){
        if(isi.length<5){          
          setview_error(id,"Silahkan masukan kode Invitation KIP dengan benar.");
          $("#id_jndaftar").val(0);
        }else{
          ada_error=0;
          tb = "tb_daftar";
          var id_jenis_kip = $("#id_jenis_kip").val();
          $("#id_jndaftar").val(id_jenis_kip);
        }
      }

      // =======================================================================
      // NO PENDAFTARAN KIP
      // =======================================================================
      if(id=="no_daf_kip"){
        if(isi.length<19){
          $("#id_jndaftar").val(0);
          // set_jalur_and_save_idjndaftar(0);
          setview_error(id,"Silahkan masukan 19 digit Nomor Pendaftaran KIP dari website Kemdikbud dengan benar.");
        }else{
          set_jalur_and_save_idjndaftar(3); // 3 KIP-UMUM
          ada_error=0;
          tb="tb_daftar";
        }
      }



      // =======================================================================
      // TEMPAT LAHIR
      // =======================================================================
      if(id=="tempat_lahir"){
        if(isi.length<3){
          setview_error(id,"Silahkan masukan Tempat Lahir Anda dengan benar.");
        }else{
          ada_error=0;
        }
      }

      // =======================================================================
      // ALAMAT LENGKAP
      // =======================================================================
      if(id=="alamat_jalan"){
        if(isi.length<5){
          setview_error(id,"Silahkan masukan Alamat dengan benar sesuai KTP Anda.");
        }else{ada_error=0;}
      }

      // =======================================================================
      // KODE POS
      // =======================================================================
      if(id=="alamat_kodepos"){
        if(isi.length<5 && isi.length>0){
          setview_error(id,"Silahkan masukan 5 digit Kode Pos daerah/kecamatan Anda.");
        }else{ada_error=0;}
      }

      // =======================================================================
      // ALAMAT DOMISILI
      // =======================================================================
      if(id=="alamat_domisili"){
        if(isi.length<5 && isi.length>0){
          setview_error(id,"Mohon masukan alamat domisili Anda jika alamat Anda berbeda dengan yang tertera di KTP.");
        }else{ada_error=0;}
      }

      // =======================================================================
      // ASAL SEKOLAH
      // =======================================================================
      if(id=="sekolah_asal"){
        if(isi.length<5){
          setview_error(id,"Mohon masukan Nama Sekolah Asal Anda dengan benar.");
        }else{ada_error=0;}
      }

      // =======================================================================
      // NAMA AYAH
      // =======================================================================
      if(id=="nama_ayah"){
        if(isi.length<3){
          setview_error(id,"Mohon masukan Nama Ayah Anda dengan benar.");
        }else{ada_error=0;}
      }

      // =======================================================================
      // NAMA IBU
      // =======================================================================
      if(id=="nama_ibu"){
        if(isi.length<3){
          setview_error(id,"Mohon masukan Nama Ibu Anda dengan benar.");
        }else{ada_error=0;}
      }

      // =======================================================================
      // NAMA INSTANSI KERJA
      // =======================================================================
      if(id=="instansi_kerja"){
        if(isi.length<5 && isi.length>0){
          setview_error(id,"Mohon masukan Nama Perusahaan tempat Anda bekerja atau Nama Wirausaha Anda dengan benar.");
        }else{
          ada_error=0;
          if($("#alamat_kerja").val()=="") setview_error("alamat_kerja");
          if($("#jabatan_kerja").val()=="") setview_error("jabatan_kerja");
        }
      }

      // =======================================================================
      // NAMA ALAMAT KERJA
      // =======================================================================
      if(id=="alamat_kerja"){
        if(isi.length<5 && isi.length>0){
          setview_error(id,"Mohon masukan Alamat Perusahaan / Lokasi Wirausaha Anda dengan benar.");
        }else{
          ada_error=0;
          if($("#instansi_kerja").val()=="") setview_error("instansi_kerja");
          if($("#jabatan_kerja").val()=="") setview_error("jabatan_kerja");

        }
      }

      // =======================================================================
      // JABATAN KERJA
      // =======================================================================
      if(id=="jabatan_kerja"){
        if(isi.length<5 && isi.length>0){
          setview_error(id,"Mohon masukan Posisi Anda di Perusahaan Anda.");
        }else{
          ada_error=0;
          if($("#instansi_kerja").val()=="") setview_error("instansi_kerja");
          if($("#alamat_kerja").val()=="") setview_error("alamat_kerja");

        }
      }

      // =======================================================================
      // ISIAN OPTIONAL
      // =======================================================================
      if(id=="nisn" || id=="no_ijazah" || id=="prodi_asal"){
        ada_error=0;
      }

      setview_input(id,ada_error);
      if(!ada_error && isi!="") auto_save(id,isi,tb);

      // =======================================================================
      // ISIAN OPTIONAL BOLEH BLANK
      // =======================================================================
      if(!ada_error && isi=="" && (id=="alamat_kodepos" || id=="alamat_domisili")) auto_save(id,isi,tb);
      if(!ada_error && isi=="" && (id=="nisn" || id=="no_ijazah" || id=="prodi_asal")) auto_save(id,isi,tb);
      if(!ada_error && isi=="" && (id=="instansi_kerja" || id=="jabatan_kerja" || id=="alamat_kerja")) auto_save(id,isi,tb);



    })


$(".input_pilihan").change(function(){
  var id = $(this).prop("id");
  var isi = $(this).val();
  var nilai = parseInt(isi);
  var ada_error = 1;
  var tb = "tb_calon";
  var id_jalur_daftar = parseInt($("#id_jalur_daftar").val());

      // =======================================================================
      // ID PRODI
      // =======================================================================
      if(id=="id_prodi"){

        var id_prodi = parseInt($("#id_prodi").val());
        if(id_jalur_daftar!=0){
          var x = confirm("Perhatian! Mengubah Pilihan Prodi akan mereset Pilihan Jalur.");
          if(!x) {$("#id_prodi").val(0); return;}

          $("#id_jalur_daftar").val(0).change();


        }


        if(isi=="0"){
          setview_error(id,"Anda wajib memilih prodi sebelum mengisi data lainnya.");
        }else{

          // BLOK TRANSFER DAN KIP UNTUK PRODI RPL DAN SI
          if(id_prodi==2 || id_prodi==3){
            $("#id_jalur_daftar_option2").prop("style","display:none");
            $("#id_jalur_daftar_option4").prop("style","display:none");
            $("#id_prodi_ket").text("Perhatian! Untuk saat ini Prodi RPL/SI belum bisa untuk Jalur Beasiswa KIP.");
            $("#id_prodi_ket").fadeIn();
            auto_save("id_jalur_daftar",0,"tb_daftar"); //SET 


          }else{
            $("#id_jalur_daftar_option2").prop("style","");
            $("#id_jalur_daftar_option4").prop("style","");
            $("#id_prodi_ket").text("");
          }


          ada_error=0; 
          tb="tb_daftar";
        }
      }

      var asdfa=8;
      // =======================================================================
      // ID JALUR DAFTAR :: REG / TRANS / BEAIKMI / KIP
      // =======================================================================
      // di handle sendiri


      // =======================================================================
      // ID JENIS KIP
      // =======================================================================
      if(id=="id_jenis_kip"){
        // set_jalur_and_save_idjndaftar($("#id_jenis_kip").val());
        if(isi=="0"){
          setview_error(id,"Silahkan Anda Pilih Jenis Beasiswa KIP.");
        }else{
          ada_error=0;
          tb="tb_daftar";
        }
      }

      // =======================================================================
      // ID JENIS BEA-IKMI
      // =======================================================================
      if(id=="id_jenis_beaikmi"){
        set_jalur_and_save_idjndaftar($("#id_jenis_beaikmi").val());
        if(isi=="0"){
          setview_error(id,"Silahkan Anda Pilih Jenis Beasiswa IKMI.");
        }else{
          ada_error=0; 
          tb="tb_daftar";
        }
      }

      // =======================================================================
      // ID JENIS KELAS PAGI/SORE
      // =======================================================================
      if(id=="id_jnkelas"){
        ada_error=0; tb="tb_daftar";
      }

      // =======================================================================
      // ID DURASI BAYAR
      // =======================================================================
      if(id=="id_durasi_bayar"){
        ada_error=0; tb="tb_daftar";
      }

      // =======================================================================
      // INFO ASAL
      // =======================================================================
      if(id=="id_referal"){
        if(isi=="0"){
          setview_error(id,"Silahkan Anda Pilih dari mana Anda mendapatkan Informasi Pendaftaran di IKMI.");
        }else{ada_error=0; tb="tb_daftar";}
      }

      // =======================================================================
      // STATUS PERNIKAHAN / AGAMA / WARGANEGARA
      // =======================================================================
      if(id=="status_menikah" || id=="agama" || id=="warga_negara") {ada_error=0;}

      // =======================================================================
      // LULUSAN
      // =======================================================================
      if(id=="lulusan"){
        if(isi=="0"){
          setview_error(id,"Silahkan Anda Pilih Jenis Sekolah Asal Anda.");
        }else{ada_error=0;}
      }

      // =======================================================================
      // PEKERJAAN AYAH
      // =======================================================================
      if(id=="pekerjaan_ayah"){
        if(isi=="0"){
          setview_error(id,"Silahkan Anda Pilih Jenis Pekerjaan Ayah Anda.");
        }else{ada_error=0;}
      }

      // =======================================================================
      // PEKERJAAN IBU
      // =======================================================================
      if(id=="pekerjaan_ibu"){
        if(isi=="0"){
          setview_error(id,"Silahkan Anda Pilih Jenis Pekerjaan Ibu Anda.");
        }else{ada_error=0;}
      }

      setview_input(id,ada_error);
      if(!ada_error && isi!="0") auto_save(id,isi,tb);

    })


$("#cek_bekerja").click(function(){

  if ($('#cek_bekerja').is(":checked")){
    $("#instansi_kerja").focus();
  }else{
    if(!confirm("Jika Anda memilih belum bekerja maka semua Data Pekerjaan akan terhapus. Yakin Anda belum bekerja?")) {
      $('#cek_bekerja').prop("checked",true);
      return;
    }
    $(".data_pekerjaan").val("");
    $(".ket_kerja").hide();

    $("#instansi_kerja").prop("style","");
    $("#jabatan_kerja").prop("style","");
    $("#alamat_kerja").prop("style","");

    auto_save("instansi_kerja","","tb_calon");
    auto_save("jabatan_kerja","","tb_calon");
    auto_save("alamat_kerja","","tb_calon");
  }
})

$("#btn_submit_formulir").click(function(){
  var id_jndaftar = $("#id_jndaftar").val();
  var kip_invitation_code = $("#kip_invitation_code").val().toUpperCase();

  if(
    id_jndaftar==5 && kip_invitation_code!="D8MNVH" || 
    id_jndaftar==6 && kip_invitation_code!="QLBRDP" || 
    id_jndaftar==7 && kip_invitation_code!="PR6HB7" || 
    id_jndaftar==8 && kip_invitation_code!="PBAUFV" || 
    id_jndaftar==9 && kip_invitation_code!="N1JY95" || 
    id_jndaftar==10 && kip_invitation_code!="MEH7DS" || 
    id_jndaftar==11 && kip_invitation_code!="6SKRTE" || 
    id_jndaftar==12 && kip_invitation_code!="4BZFRV" 
    )
  {
    setview_error("kip_invitation_code","Silahkan masukan kode Invitation KIP dengan benar.");
    alert("Maaf, Code-KIP Anda keliru. Silahkan Anda tanyakan ke Koordinator-KIP tiap wilayah atau silahkan hubungi Front-Office-IKMI-Cirebon!");
    $("#kip_invitation_code").val("");
    $("#kip_invitation_code").focus();

    return;
  }




  // =================================================================
  // NO ERROR FOUND - GO SUBMIT - IS LENGKAP DATA = 1
  // =================================================================
  auto_save("j_terisi",$("#j_terisi_span").text(),"tb_daftar");
  auto_save("j_terisi_wajib",$("#j_terisi_wajib_span").text(),"tb_daftar");
  auto_save("status_daftar",1,"tb_daftar");
  auto_save("is_lengkap_data",1,"tb_daftar");

  var status_daftar = parseInt($("#status_daftar_db").val());

  if(status_daftar>0 && status_daftar < 3){
    var tanggal_submit = new Date();
    var tanggal_submit_new = tanggal_submit.getFullYear()+"-"+(tanggal_submit.getMonth()+1)+"-"+tanggal_submit.getDate();
    var tanggal_submit_span = tanggal_submit.getDate()+"-"+months[tanggal_submit.getMonth()]+"-"+tanggal_submit.getFullYear();
    

    // =================================================================
    // UPDATE TANGGAL SUBMIT
    // =================================================================
    var tanggal_submit_db = $("#tanggal_submit_db").val();
    if(tanggal_submit_db=="") {
      auto_save("tanggal_submit",tanggal_submit_new,"tb_daftar");
      $("#tanggal_submit_span").text(tanggal_submit_span);
      $("#tanggal_submit_db").text(tanggal_submit_new);
    }else{
      $("#tanggal_submit_span").text(tanggal_submit_db);
    }


    hitung_jadwal_tes();
    $("#tabel_kontainer_tes").show();
  }

  alert("Terima kasih Anda telah mengisi Formulir Pendaftaran!");
  $("#blok_formulir_pendaftaran").hide();
  $("#blok_hasil_submit").fadeIn();

  window.location.reload();

  
  






  
})

$("#id_jndaftar").val($("#id_jndaftar_db").val());
// AUTO HITUNG WHEN DOCUMENT READY ============
hitung_j_terisi();
hitung_jadwal_tes();
setview_pilihan_pertama("id_jnkelas");

})
</script>