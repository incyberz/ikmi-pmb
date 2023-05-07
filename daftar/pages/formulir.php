<?php
// include "../config.php";
// include "../pendaftar_var.php";
$tahun_skg = 2023;
$info_submit = ($tanggal_submit_formulir=='') ? '' : "<div class='alert alert-info'>Kamu sudah submit formulir pada tanggal : $tanggal_submit_formulir</div>";


$pesan_submit = '';
$is_show_formulir = '';
if (isset($_POST['btn_submit_formulir'])) {
    include 'formulir_processing.php';
    exit();
}


$opt_pekerjaan_ayah = "<option value='0'>--Pilih--</option>";
$opt_pekerjaan_ibu = '';

$s = "SELECT * from tb_pekerjaan";
$q = mysqli_query($cn, $s) or die(mysqli_error($cn));
while ($d=mysqli_fetch_assoc($q)) {
    $id_pekerjaan = $d['id_pekerjaan'];
    $pekerjaan = $d['pekerjaan'];

    if ($id_pekerjaan_ayah==$id_pekerjaan) {
        $opt_pekerjaan_ayah.= "<option value='$id_pekerjaan' selected>$pekerjaan</option>";
    } else {
        $opt_pekerjaan_ayah.= "<option value='$id_pekerjaan'>$pekerjaan</option>";
    }

    if ($id_pekerjaan_ibu==$id_pekerjaan) {
        $opt_pekerjaan_ibu.= "<option value='$id_pekerjaan' selected>$pekerjaan</option>";
    } else {
        $opt_pekerjaan_ibu.= "<option value='$id_pekerjaan'>$pekerjaan</option>";
    }
}



$s = "SELECT id_prodi,nama_prodi,singkatan_prodi,jenjang from tb_prodi";
$q = mysqli_query($cn, $s) or die(mysqli_error($cn));
$i=0;
while ($d=mysqli_fetch_assoc($q)) {
    $rid_prodi[$i] = $d['id_prodi'];
    $rnama_prodi[$i] = $d['nama_prodi'];
    $rsingkatan_prodi[$i] = $d['singkatan_prodi'];
    $rjenjang[$i] = $d['jenjang'];
    $i++;
}


$s = "SELECT id_jalur,nama_jalur,status_jalur from tb_jalur ";
$q = mysqli_query($cn, $s) or die(mysqli_error($cn));
$i=0;
while ($d=mysqli_fetch_assoc($q)) {
    $rid_jalur[$i] = $d['id_jalur'];
    $rnama_jalur[$i] = $d['nama_jalur'];
    $rstatus_jalur[$i] = $d['status_jalur'];
    $i++;
}


$id_referal=2;
$opt_referal = "<option value='0'>--Pilih--</option>";

$s = "SELECT * from tb_referal";
$q = mysqli_query($cn, $s) or die(mysqli_error($cn));
while ($d=mysqli_fetch_assoc($q)) {
    $id_referal = $d['id_referal'];
    $referal = $d['referal'];

    if ($id_referal==$id_referal) {
        $opt_referal.= "<option value='$id_referal' selected>$referal</option>";
    } else {
        $opt_referal.= "<option value='$id_referal'>$referal</option>";
    }
}

# ===========================================
# CHECKBOX HANDLE
# ===========================================
$no_ayah_required = "required";
$no_ibu_required = "required";
$cek_nowa__no_ayah_checked = '';
$cek_nowa__no_ibu_checked = '';
if ($no_ayah=="-") {
    $cek_nowa__no_ayah_checked = 'checked';
    $no_ayah_required = '';
}
if ($no_ibu=="-") {
    $cek_nowa__no_ibu_checked = 'checked';
    $no_ibu_required = '';
}


$is_bekerja_checked = '';
$is_wirausaha_checked = '';
if ($is_bekerja) {
    $is_bekerja_checked = 'checked';
}
if ($is_wirausaha) {
    $is_wirausaha_checked = 'checked';
}

$cek_no_hp_as_no_wa_checked = '';
if ($no_wa==$no_hp) {
    $cek_no_hp_as_no_wa_checked = 'checked';
}

// $batas_tahun_kip = $tahun_skg;
$batas_tahun_kip = $tahun_skg - 2;
$catatan_jalur_daftar = "<small>Catatan: hanya lulusan $batas_tahun_kip s.d $tahun_skg yang dapat mengambil Jalur KIP</small>";
// $catatan_jalur_daftar = "<small>Catatan: * hanya lulusan $tahun_skg yang dapat mengambil Jalur KIP dengan proses seleksi</small>";
$disable_kip = 'disabled';

?>
<style type="text/css">
	#formulir table{width: 100%; border: solid 1px #afa; margin-bottom: 30px;}
	#formulir th,td{padding: 10px;}
  #formulir th{padding: 9px 5px;text-align: center;background: linear-gradient(#fff,#afa)}
	#formulir td{padding: 10px; background-color: #eff;}
	.bundle{border: solid 1px #afa; padding: 15px; border-radius: 10px; background-color: #ffe; margin: 20px 0;}

  .form-group {margin-bottom: 10px;}
  #formulir label {margin: 10px 0  5px 0;font-sizea: small;}
  #formulir li {cursor: pointer;}
  #formulir li:hover {color: blue; font-weight: bold;}

  .list_rekomendasi{
    display: none;
    border: solid 1px #aaf;
    background-color: #cff;
    font-size: small;
    padding:  10px;
  }
</style>

<section id="formulir" class="">
  <div class="container">

    <?=$pesan_submit?>

    <form method="post" style="display: <?=$is_show_formulir?>;">

      <div class="section-title">
        <h2>Formulir Pendaftaran</h2>
        <p>Silahkan Anda isi Formulir Pendaftaran</p>
        <?=$info_submit?>
      </div>

      <table><thead><th>DATA AKUN</th></thead>
        <tr>
          <td>

            <div class="form-group">
              <label>Nama</label>
              <input type="text" class="form-control" value="<?=$nama_calon?>" disabled=""> 
            </div>

            <div class="form-group">
              <label>Email</label>
              <input type="text" class="form-control" value="<?=$email_calon?>" disabled=""> 
            </div>

            <div class="form-group">
              <label>Nomor WA</label>
              <input type="text" class="form-control" value="<?=$no_wa?>" disabled="" id="no_wa"> 
            </div>
            <div class="form-group" style="text-align:right;">
              <a href="<?=$link_wa_ubah_data_akun?>" class="btn btn-warning" target="_blank" onclick="return confirm('Perubahan Data Akun harus ditangani Petugas PMB.\n\nYakin untuk menghubungi Petugas PMB via WhatsApp?')"><?=$img_wa?> Ubah Data Akun</a>
            </div>

          </td>
        </tr>
      </table>

      <table><thead><th>PENJURUSAN</th></thead>
        <tr>
          <td>

            <div class="form-group">
              <label>Tahun Anda Lulus</label>
              <input type="text" class="input_isian form-control" required="" minlength="4" maxlength="4" id="tahun_lulus" nama="tahun_lulus" value="<?=$tahun_lulus?>">
              <small id="tahun_lulus_ket" class="merah tebal hideit">Silahkan Anda masukan 4 digit tahun lulus</small>
            </div>

            <div class="form-group">
              <label>Asal Sekolah/Perguruan Tinggi</label>
              <input type="text" class="input_isian_wid form-control" required minlength="10" maxlength="100" id="asal_sekolah" name="asal_sekolah" value="<?=$asal_sekolah?>">
              <div id="asal_sekolah_list" class="list_rekomendasi"></div>
              <input type="hidden" id="id_sekolah" name="id_sekolah" value="<?=$id_sekolah?>">
            </div>

            <div class="form-group">
              <div class="row">
                <div class="col-lg-6">
                  <?php
                  $rjenis_sekolah = ["","SMA","SMK","MA","Paket C","Perguruan Tinggi"];
for ($i=1; $i < count($rjenis_sekolah); $i++) {
    $jenis_sekolah_checked = '';
    if ($jenis_sekolah==$i) {
        $jenis_sekolah_checked='checked';
    }
    echo "<label><input type='radio' class='input_radio jenis_sekolah_radio' id='jenis_sekolah_$i' name='jenis_sekolah' value='$i' required $jenis_sekolah_checked $jenis_sekolah_disabled> $rjenis_sekolah[$i]</label> ";
} ?>
                </div>
                <div class="col-lg-6">
                  <?php
$rstatus_sekolah = ["","Negeri","Swasta"];
for ($i=1; $i < count($rstatus_sekolah); $i++) {
    $status_sekolah_checked = '';
    if ($status_sekolah==$i) {
        $status_sekolah_checked='checked';
    }
    echo "<label><input type='radio' class='input_radio status_sekolah_radio' id='status_sekolah_$i' name='status_sekolah' value='$i' required $status_sekolah_checked $status_sekolah_disabled> $rstatus_sekolah[$i]</label> ";
} ?>
                </div>
              </div>
            </div>


            <div class="form-group">
              <label>Kecamatan Asal Sekolah</label>
              <input type="text" class="input_isian_wid form-control nama_kec" required minlength="3" maxlength="50" required="" id="nama_kec_sekolah" name="nama_kec_sekolah" value="<?=$nama_kec_sekolah ?>" autocomplete="off" <?=$nama_kec_sekolah_disabled?>>
              <div id="list_nama_kec_sekolah" class="list_rekomendasi"></div>
              <input type="hidden" id="id_nama_kec_sekolah" name="id_nama_kec_sekolah" value="<?=$id_nama_kec_sekolah?>">
            </div>

            <div class="form-group">
              <label>Jurusan/Prodi Asal Sekolah</label>
              <input type="text" class="input_isian form-control" required minlength="3" maxlength="20"  id="prodi_asal" name="prodi_asal" value="<?=$prodi_asal?>" autocomplete="off">
            </div>

            <div class="form-group">
              <label>NISN</label>
              <input type="text" class="input_isian form-control" minlength="10" maxlength="10" id="nisn" name="nisn" value="<?=$nisn?>"> 
            </div>




            <!-- =========================================== -->
            <!-- PRODI JALUR KELAS -->
            <!-- =========================================== -->
            <div class="form-group bundle">
              <label>Pilihan Prodi Pertama:</label>
              <?php
              for ($i=0; $i < count($rnama_prodi); $i++) {
                  $j = $i+1;
                  $prodi1_checked= ($id_prodi1==$rid_prodi[$i]) ? 'checked' : '';
                  echo "<div><label><input class='pp1 input_radio' id='pp1$j' type='radio' name='id_prodi1' value='$j' required $prodi1_checked> $rjenjang[$i] - $rnama_prodi[$i]</label></div>";
              } ?>
            </div>

            <div class="form-group bundle">
              <label>Pilihan Prodi Kedua:</label>
              <?php
              for ($i=0; $i < count($rnama_prodi); $i++) {
                  $j = $i+1;
                  $prodi2_checked = ($id_prodi2==$rid_prodi[$i]) ? 'checked' : '';
                  $prodi2_disabled = ($id_prodi1==$rid_prodi[$i]) ? 'disabled' : '';
                  echo "
                <div><label><input class='pp2 input_radio' id='pp2$j' type='radio' name='id_prodi2' value='$j' required $prodi2_checked $prodi2_disabled> $rjenjang[$i] - $rnama_prodi[$i]</label></div>
                ";
              } ?>
            </div>


            <div class="form-group bundle">
              <?php
              // echo var_dump($rid_jalur);
              for ($i=0; $i < count($rnama_jalur); $i++) {
                $j = $i+1;
                $jalur_checked = ($id_jalur!="" and $id_jalur==$rid_jalur[$i]) ? 'checked' : '';

                $disable_jalur = $rstatus_jalur[$i]==1 ? '' : 'disabled';
                $disable_jalur_ket = $rstatus_jalur[$i]==1 ? '' : '<small style="font-style:italic">(Jalur ini sudah ditutup)</small>';
                $ket_jalur = '';
                $hide_jalur = '';
                // if($rid_jalur[$i]==3 and $tahun_lulus<$batas_tahun_kip) $disable_jalur = 'disabled';
                if ($rid_jalur[$i]==3 and $tahun_lulus<2021) {
                    $disable_jalur = 'disabled';
                    $jalur_checked = '';
                    // $hide_jalur = " style='display:none' ";
                    // $ket_jalur = "(Jalur KIP Kuliah Sudah Ditutup)";
                }

                if ($rid_jalur[$i]==4) {
                    $disable_jalur = 'disabled';
                    $hide_jalur = " style='display:none' ";
                    // $ket_jalur = "(Sudah Ditutup)";
                }

                echo "
                <div $hide_jalur><label><input type='radio' id='input_jalur__$rid_jalur[$i]' class='input_radio input_jalur' name='id_jalur' value='$j' required $jalur_checked $disable_jalur> $rnama_jalur[$i]</label> <span style='color:darkred'>$ket_jalur$disable_jalur_ket</span></div>
                ";
              } 
              
              
              ?>

            </div>
            <?=$catatan_jalur_daftar ?>

            

          </td>
        </tr>
      </table>




      <!-- =========================================== -->
      <!-- BIODATA PRIBADI -->
      <!-- =========================================== -->
      <table><thead><th>BIODATA PRIBADI</th></thead>
        <tr>
          <td>
            <p style="text-align:center;"><img src="assets/img/lihat_ktp.jpg" class="rounded-circle" width="200px"><br><small>Silahkan lihat KTP Anda untuk melihat Nomor Induk Kependudukan!</small></p>

            <div class="form-group">
              <label>Nomor Induk KTP</label>
              <input type="text" class="input_isian form-control" required minlength="16" maxlength="16" id="nik" name="nik" value="<?=$nik?>"> 
              <div id="nik_divide" style="font-size: 30px; font-weight: bold; font-family: courier;"></div>
              <small id="nik_ket" class="merah bold hideit">Silahkan masukan 16 digit NIK KTP sesuai yang tertera di KTP/KK Anda.</small>
              <div id="div_nik">
                <span id="ket_gender"></span> 
                <span id="ket_ttl"></span> 
                <span id="ket_usia"></span> 
              </div>
              <input type="hidden" name="jenis_kelamin" id="jenis_kelamin" value="<?=$jenis_kelamin ?>">
            </div>

            <div class="form-group">
              <div class="row">
                <div class="col-lg-6">
                  <label>Tempat Lahir</label>
                  <input type="text" class="form-control" required minlength="3" maxlength="50" id="tempat_lahir" name="tempat_lahir" value="<?=$tempat_lahir?>">
                  <div id="list_tempat_lahir" class="list_rekomendasi"></div>
                  <input type="hidden" name="" id="id_kab_tempat_lahir" value="<?=$id_kab_tempat_lahir ?>">
                  
                </div>
                <div class="col-lg-6">
                  <label>Tanggal Lahir</label>
                  <div class="row">
                    <div class="col-3">
                      <select class="input_select_ttl form-control ttl" id="ttl_tanggal">
                        <?php for ($i=1; $i < 32; $i++) {
                            $z='';
                            if ($ttl_tanggal==$i) {
                                $z="selected";
                            } echo "<option $z>$i</option>";
                        }  ?>
                      </select>
                    </div>
                    <div class="col-3">
                      <select class="input_select_ttl form-control ttl" id="ttl_bulan">
                        <?php
                        for ($i=1; $i < 13; $i++) {
                            echo "<option value=$i>".$nama_bln[$i-1]."</option>";
                        }
?>
                      </select>
                    </div>
                    <div class="col-6">
                      <select class="input_select_ttl form-control ttl" id="ttl_tahun">
                        <?php for ($i=date("Y"); $i > date("Y")-60; $i--) {
                            echo "<option>$i</option>";
                        }  ?>
                      </select>
                    </div>
                    
                  </div>
                  <input type="hidden" name="tanggal_lahir" id="tanggal_lahir" value="<?=$tanggal_lahir ?>">
                </div>
                
              </div>
            </div>



            <div class="form-group bundle">
              <label>Alamat sesuai KTP:</label>

              <div class="form-group">
                <label>Kecamatan</label>
                <input type="text" class="input_isian_wid form-control nama_kec" required minlength="3" maxlength="50" required="" id="nama_kec_ktp" value="<?=$nama_kec_ktp?>">
                <div id="list_nama_kec_ktp" class="list_rekomendasi"></div>
                <input type="hidden" id="id_nama_kec_ktp" name="id_nama_kec_ktp" value="<?=$id_nama_kec_ktp?>">
              </div>

              <div class="form-group">
                <label>Alamat Desa, Jalan, RT, RW</label>
                <input type="text" class="input_isian form-control" minlength="10" maxlength="100" required name="alamat_desa_ktp" id="alamat_desa_ktp" value="<?=$alamat_desa_ktp?>"> 
              </div>

              <div class="form-group">
                <label>Kode Pos</label>
                <input type="text" class="input_isian form-control" required minlength="5" maxlength="5" id="kode_pos_nama_kec_ktp" name="kode_pos_nama_kec_ktp" value="<?=$kode_pos_nama_kec_ktp?>">
                <small>Belum tahu Kode Pos Kecamatan Anda? 
                  <a id="cari_kode_pos_nama_kec_ktp" href="https://www.google.com/search?q=kode+pos+kecamatan" target="_blank">Tanya Google!</a>
                </small> 
              </div>
            </div>



            <div class="form-group bundle">
              Alamat Domisili/Kost:
              <div>
                <label><input type="checkbox" id="cek_domi_as_ktp"> Alamat domisili saya sesuai KTP</label>
              </div>

              <div class="form-group">
                <label>Kecamatan</label>
                <input type="text" class="input_isian_wid form-control nama_kec" required minlength="3" maxlength="50" required="" id="nama_kec_domisili" name="nama_kec_domisili" value="<?=$nama_kec_domisili?>">
                <div id="list_nama_kec_domisili" class="list_rekomendasi"></div>
                <input type="hidden" id="id_nama_kec_domisili" value="<?=$id_nama_kec_domisili?>">
              </div>


              <div class="form-group">
                <label>Alamat Desa, Jalan, RT, RW</label>
                <input type="text" class="input_isian form-control" required id="alamat_desa_domisili" name="alamat_desa_domisili" value="<?=$alamat_desa_domisili?>"> 
              </div>
              <div class="form-group">
                <label>Kode Pos</label>
                <input type="text" class="input_isian form-control" required minlength="5" maxlength="5" id="kode_pos_nama_kec_domisili" name="kode_pos_nama_kec_domisili" value="<?=$kode_pos_nama_kec_domisili?>">
                <small>Belum tahu Kode Pos Kecamatan Anda? 
                  <a id="cari_kode_pos_nama_kec_domisili" href="https://www.google.com/search?q=kode+pos+kecamatan" target="_blank">Tanya Google!</a>
                </small> 
              </div>
            </div>


            <div class="form-group">
              <?php
              $rstatus_menikah = ["","Belum Menikah","Menikah","Janda/Duda"];
for ($i=1; $i < count($rstatus_menikah); $i++) {
    $status_menikah_checked = '';
    if ($status_menikah==$i) {
        $status_menikah_checked='checked';
    }
    echo "<label><input type='radio' class='input_radio' name='status_menikah' value='$i' required $status_menikah_checked> $rstatus_menikah[$i]</label> ";
} ?>
            </div>

            <div class="form-group">
              <?php
$ragama = ["","Islam","Katolik","Protestan","Hindu","Budha","Konghucu","Lainnya"];
for ($i=1; $i < count($ragama); $i++) {
    $agama_checked = '';
    if ($agama==$i) {
        $agama_checked='checked';
    }
    echo "<label><input type='radio' class='input_radio' name='agama' value='$i' required $agama_checked> $ragama[$i]</label> ";
} ?>
            </div>

            <div class="form-group">
              <?php
$rwarga_negara = ["","WNI","WNA"];
for ($i=1; $i < count($rwarga_negara); $i++) {
    $warga_negara_checked = '';
    if ($warga_negara==$i) {
        $warga_negara_checked='checked';
    }
    echo "<label><input type='radio' class='input_radio' name='warga_negara' value='$i' required $warga_negara_checked> $rwarga_negara[$i]</label> ";
} ?>
            </div>
          </td>
        </tr>
      </table>







      <table><thead><th>DATA ORANG TUA</th></thead>
        <tr>
          <td>

            <div class="form-group">
              <label>Nama Ayah</label>
              <input type="text" class="input_isian form-control" required minlength="3" maxlength="30" id="nama_ayah" name="nama_ayah" value="<?=$nama_ayah?>"> 
            </div>

            <div class="form-group">
              <label>Nama Ibu</label>
              <input type="text" class="input_isian form-control" required minlength="3" maxlength="30" id="nama_ibu" name="nama_ibu" value="<?=$nama_ibu?>"> 
            </div>

            <div class="form-group">
              <label>Pekerjaan Ayah</label>
              <select class="input_select form-control" id="id_pekerjaan_ayah" name="id_pekerjaan_ayah">
                <?=$opt_pekerjaan_ayah ?>
              </select>

            </div>

            <div class="form-group">
              <label>Pekerjaan Ibu</label>
              <select class="input_select form-control" id="id_pekerjaan_ibu" name="id_pekerjaan_ibu">
                <option>--Pilih--</option>
                <?=$opt_pekerjaan_ibu ?>
              </select>
            </div>

            <div class="bundle">
              <div class="form-group">
                <label>No HP (selain WhatsApp)</label>
                <input type="text" class="input_isian form-control" required minlength="10" maxlength="13" id="no_hp" name="no_hp" value="<?=$no_hp?>"> 
                <div><label><input type="checkbox" id="cek_no_hp_as_no_wa" <?=$cek_no_hp_as_no_wa_checked?>> No HP saya sama dg WhatsApp</label></div>
              </div>

              <div class="form-group">
                <label>No WA Ayah</label>
                <input type="text" class="input_isian form-control" <?=$no_ayah_required?> minlength="10" maxlength="13" id="no_ayah" name="no_ayah" value="<?=$no_ayah?>">
                <div><label><input type="checkbox" class="cek_nowa" id="cek_nowa__no_ayah" <?=$cek_nowa__no_ayah_checked?>> Ayah saya tidak punya whatsApp</label></div>
              </div>

              <div class="form-group">
                <label>No WA Ibu</label>
                <input type="text" class="input_isian form-control" <?=$no_ayah_required?> minlength="10" maxlength="13" id="no_ibu" name="no_ibu" value="<?=$no_ibu?>"> 
                <div><label><input type="checkbox" class="cek_nowa" id="cek_nowa__no_ibu" <?=$cek_nowa__no_ibu_checked?>> Ibu saya tidak punya whatsApp</label></div>
              </div>

              <div class="form-group">
                <label>No WA Saudara (Tidak Serumah)</label>
                <input type="text" class="input_isian form-control" required minlength="10" maxlength="13" id="no_saudara" name="no_saudara" value="<?=$no_saudara?>"> 
              </div>
            </div>
          </td>
        </tr>
      </table>


      <table><thead><th>LAIN-LAIN</th></thead>
        <tr>
          <td>

            <div class="form-group">
              <label>Saya mendapatkan informasi pendaftaran dari:</label> 
              <select class="input_select form-control" name="id_referal" id="id_referal">
                <?=$opt_referal ?>
              </select>
            </div>

            <div class="form-group">
              <label><input type="checkbox" class="input_checkbox" id="is_bekerja" name="is_bekerja" <?=$is_bekerja_checked?>> Saya sudah bekerja di Instansi Perusahaan</label>
            </div>
            <div class="form-group">
              <label><input type="checkbox" class="input_checkbox" id="is_wirausaha" name="is_wirausaha" <?=$is_wirausaha_checked?>> Saat ini saya sedang berwirausaha/merintis Start-Up</label>
            </div>

          </td>
        </tr>
      </table>




      <table><thead><th>SUBMIT FORMULIR</th></thead>
        <tr>
          <td>

            <div class="form-group">
              <label><input type="checkbox" name="syarat_indisabilitas" id="sy1" class="sy"> Saya tidak berstatus sebagai penyandang disabilitas</label>
            </div>

            <div class="form-group">
              <label><input type="checkbox" name="syarat_input_benar" id="sy2" class="sy"> Saya menyatakan bahwa data yang saya masukan adalah benar sesuai dengan dokumen formal yang saya miliki dan saya mengisi formulir ini dengan kemauan saya sendiri</label>
            </div>

            <div class="form-group">
              <label><input type="checkbox" name="syarat_bersedia" id="sy3" class="sy"> Saya bersedia mengikuti proses Seleksi Penerimaan Mahasiswa Baru STMIK IKMI Cirebon hingga selesai</label>
            </div>
            <hr>
            <button type="submit" class="btn btn-primary" name="btn_submit_formulir" id="btn_submit_formulir" disabled="">Submit Formulir</button>

            <hr>

          </td>
        </tr>
      </table>
      
    </form>






  </div>
</section>



<script type="text/javascript" src="pages/formulir.js"></script>
<script type="text/javascript" src="pages/formulir_onclick.js"></script>
<script type="text/javascript" src="pages/formulir_nik_handle.js"></script>
<script type="text/javascript" src="pages/formulir_autosave.js"></script>