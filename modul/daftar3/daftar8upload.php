<?php
if(!isset($_SESSION['email'])) {die(tampil_error("Maaf, Anda belum login. <hr>$link_login"));}
if(!isset($_SESSION['nama_calon'])) {die(tampil_error("Maaf, Sesi Nama Calon belum diset. Silahkan hubungi programmer!<hr>$link_login"));}

if($status_daftar<1 or $jumlah_input_data_penting_user<$jumlah_input_data_penting){die(tampil_error("Maaf, Anda belum melengkapi Formulir Pendaftaran. Silahkan Anda lengkapi data wajib terlebih dahulu.<hr>Kode Status Daftar: $status_daftar<br>Jumlah input data wajib: $jumlah_input_data_penting_user of 14<hr><a href='?p=daftar4' class='btn btn-primary'>Lengkapi Formulir Pendaftaran</a>"));}







$fileloc = "uploads/$folder_uploads/";

$file_bukti_bayar     = $fileloc."__bukti_bayar.jpg";
$file_pas_photo       = $fileloc."__pas_photo.jpg";
$file_ijazah_sma      = $fileloc."__ijazah_sma.jpg";
$file_transkrip_sma   = $fileloc."__transkrip_sma.jpg";
$file_kartu_keluarga  = $fileloc."__kartu_keluarga.jpg";
$file_ktp             = $fileloc."__ktp.jpg";

$file_rapot1          = $fileloc."__rapot1.jpg";
$file_rapot2          = $fileloc."__rapot2.jpg";
$file_rapot3          = $fileloc."__rapot3.jpg";

$file_hasil_to        = $fileloc."__hasil_to.jpg";
$file_sertif_juara    = $fileloc."__sertif_juara.jpg";
$file_sk_jalur_khusus = $fileloc."__sk_jalur_khusus.jpg";

$file_ijazah_pt       = $fileloc."__ijazah_pt.jpg";
$file_transkrip_pt    = $fileloc."__transkrip_pt.jpg";
$file_laporan_pdpt    = $fileloc."__laporan_pdpt.jpg";
$file_ktm             = $fileloc."__ktm.jpg";
$file_sk_pindah_studi = $fileloc."__sk_pindah_studi.jpg";
$file_s_rekom_lldikti = $fileloc."__s_rekom_lldikti.jpg";

$file_kip             = $fileloc."__kip.jpg";

$file_foto_keluarga   = $fileloc."__foto_keluarga.jpg";
$file_dok_eko         = $fileloc."__dok_eko.jpg";
$file_foto_rumah      = $fileloc."__foto_rumah.jpg";
$file_foto_ruang_klg  = $fileloc."__foto_ruang_klg.jpg";

if ($no_daf_kip=="") $no_daf_kip = "-";




switch ($id_jalur) {
  Case "1" : $nama_jalur = "Reguler (Tanpa Beasiswa)";break;
  Case "2" : $nama_jalur = "Jalur Akademik - Juara Sekolah tk 1 s.d 5";break;
  Case "3" : $nama_jalur = "Jalur Akademik - Juara Sekolah tk 6 s.d 10";break;
  Case "4" : $nama_jalur = "Jalur Akademik - Juara TO-SBMPTN tk 1 - 5";break;
  Case "5" : $nama_jalur = "Jalur Akademik - Juara TO-SBMPTN tk 6 - 10";break;
  Case "6" : $nama_jalur = "Jalur Akademik - Juara TO-SBMPTN tk 11 - 20";break;
  Case "7" : $nama_jalur = "Non Akademik - Juara 1 tk Kotamadya";break;
  Case "8" : $nama_jalur = "Non Akademik - Juara 2 tk Kotamadya";break;
  Case "9" : $nama_jalur = "Non Akademik - Juara 3 tk Kotamadya";break;
  Case "10" : $nama_jalur = "Non Akademik - Juara 1 tk Provinsi";break;
  Case "11" : $nama_jalur = "Non Akademik - Juara 2 tk Provinsi";break;
  Case "12" : $nama_jalur = "Non Akademik - Juara 3 tk Provinsi";break;
  Case "13" : $nama_jalur = "Non Akademik - Juara 1 tk Nasional";break;
  Case "14" : $nama_jalur = "Non Akademik - Juara 2 tk Nasional";break;
  Case "15" : $nama_jalur = "Non Akademik - Juara 3 tk Nasional";break;
  Case "16" : $nama_jalur = "Non Akademik - Juara tk Internasional";break;
  Case "17" : $nama_jalur = "Jalur Anak Pengurus Mesjid";break;
  Case "18" : $nama_jalur = "Jalur Anak Guru/Dosen";break;
  Case "19" : $nama_jalur = "Saudara Civitas IKMI";break;
  Case "20" : $nama_jalur = "Anak kandung Civitas IKMI";break;
}



if ($dm) {
  echo "<h1>syarat_tambahan_tidak_lengkap : $syarat_tambahan_tidak_lengkap
  <br>
  <br>

  </h1>";
}
?>




<script type="text/javascript">
  function newPopup(url) {
      popupWindow = window.open(
          url,'popUpWindow','height=700,width=800,left=10,top=10,resizable=yes,scrollbars=no,toolbar=no,menubar=no,location=no,directories=no,status=yes')
  }
</script>

<!-- <h1><a href="javascript:newPopup('sign-in-with-google.png')">aaaaaaaaaaaaaaaa</a></h1> -->
<section id="about" class="about">
  <div class="container" data-aos="fade-up">

    <div class="section-title">
      <h2>IKMI</h2>
      <p style="font-size: 24px">Upload Persyaratan</p>
    </div>
    <?php //include "steps.php"; ?>

    <!-- <?=$pesan?> -->
    <style type="text/css">
      ul,ol {padding-left: 10px;}
      .blok_input_persyaratan{margin-top: 50px;}
    ​</style>
    <small>
      <div class="row">
        <div class="col-md-4">
          <table class="table-bordered" width="100%" cellpadding="10px">
            <tr><td><b>Pilihan Anda</b></td></tr>
            <tr>
              <td>
                <ul>
                <li>Prodi: <span class="tebal coklat"><?=$nama_prodi ?></span></li>
                <li>Jalur Pendaftaran: <span class="tebal coklat"><?=$nama_jndaftar ?></span></li>
                <!-- <li>Jalur Beasiswa: <span class="note_blue"><?=$nama_jalur?></span></li>
                <li>No Pendaftaran KIP: <span class="note_blue"><?=$no_daf_kip?></span></li> -->
                </ul>
                <a href="?p=daftar4&aksi=isi_form" class="btn btn-warning  btn-block">Ubah Jalur Daftar</a>
              </td>
            </tr>
          </table>
        </div>
        <div class="col-md-4">
          <table class="table-bordered" width="100%" cellpadding="10px">
            <tr><td><b>Persyaratan Utama <?=$jumlah_persyaratan_utama_lengkap ?> of 
              <?=$jumlah_persyaratan_utama_total ?></b></td></tr>
            <tr>
              <td>
                <?php 
                $syarat_utama_ke=1;
                if ($id_jndaftar==3 or $id_jndaftar==4) $syarat_utama_ke=2;

                for ($i=$syarat_utama_ke; $i <=6 ; $i++) { 
                  echo "
                  <span><img src='assets/img/icons/next_small.png' width='15px'> <a href='#input_".$file_syarat[$i]."'>".$file_syarat_cap[$i]."</a></span> ..... ".$status_file_syarat_html[$i]."<br>
                 ";
                }
                ?>
              </td>
            </tr>
          </table>
        </div>
        <div class="col-md-4">
          <table class="table-bordered" width="100%" cellpadding="10px">
            <tr><td><b>Persyaratan Tambahan <?=$jumlah_persyaratan_tambahan_lengkap ?> of <?=$jumlah_persyaratan_tambahan_total ?></b></td></tr>
            <tr>
              <td>
                <?php for ($i=1; $i <=14 ; $i++) { echo $html_syarat_tambahan[$i];} ?>
              </td>
            </tr>
          </table>
        </div>
      </div>
      <small>
        
      <p>Ket: 
        <br>- <span class="note_purple">Not verified</span>: belum di cek oleh Petugas FO, 
        <br>- <span class="note_green">Accepted</span>: telah diverifikasi Petugas, 
        <br>- <span class="note_red">Rejected</span>: ditolak karena data tidak sesuai atau hasil scan tidak jelas.
        <br>- <span class="note_red">N/A</span>: <i>not available</i>, gagal atau belum upload.
      </p>
      </small>

    </small>



    <hr>
    <p class="note_blue"><?=$nama_calon ?>, silahkan upload file persyaratan Anda !
      <br>
      

    </p>

    <style type="text/css">
      .pointlist {
        /*border-radius: 15px;*/
        width: 100%;
        border: 1px solid #73AD21;
      }

      .table_header{
        background-color: #ddffff;
      }
      .jdgreen{
        background-color: #A1FFA8;
      }

      th, td {
        padding: 10px;
      }

    </style>
    <table class="pointlist"><tr class="table_header pointlist"><td>Upload Persyaratan</td></tr>
      <tr>
        <td>




          <form class="form-horizontal" action="uplod_syarat_daftar.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="folder_uploads" value="<?=$folder_uploads?>">
            <input type="hidden" name="no_daf" value="<?=$no_daf?>">

            <?php 
            # ==================================================================
            # GET AUTO_INCREMENT ID_EVENT
            # ==================================================================
            $s = "SELECT auto_increment from information_schema.tables 
            where table_schema = '$db_name' 
            and table_name = 'tb_event'";
            $q = mysqli_query($cn,$s) or die("Error #bsb34bb32ac4b ".mysqli_error($cn));
            $d = mysqli_fetch_array($q);
            $id_new_event = $d['auto_increment'];
            if($dm) echo "<hr>
            id_new_event: $id_new_event 
            <br>id_syarat: $id_syarat
            <br>SQL: $s
            <hr>";


            ?>
            <input type="hidden" name="id_new_event" value="<?=$id_new_event?>">
            <input type="hidden" name="id_calon" value="<?=$id_calon?>">
            <input type="hidden" name="id_syarat" value="<?=$id_syarat?>">

            <?php 
            include "modul/daftar3/daftar8upload_wajib.php"; 

            if ($id_jndaftar==2) include "modul/daftar3/daftar8upload_trans.php";
            if ($id_jndaftar==3) include "modul/daftar3/daftar8upload_kip.php";
            if ($id_jndaftar==4) include "modul/daftar3/daftar8upload_kip_smt.php";

            if ($id_jalur>=2 and $id_jalur<=4 ) include "modul/daftar3/daftar8upload_rapot.php";
            if ($id_jalur>=5 and $id_jalur<=6 ) include "modul/daftar3/daftar8upload_to.php";
            if ($id_jalur>=7 and $id_jalur<=16 ) include "modul/daftar3/daftar8upload_juara.php";
            if ($id_jalur>=17 and $id_jalur<=20 ) include "modul/daftar3/daftar8upload_khusus.php";
            ?>



          </form>
        </td>
      </tr>
    </table> 
    
  <hr>
  <div class="row">
    <div class="col-lg-4">
      <a href="?p=daftar9" class="btn btn-primary btn-block">Lihat Status Pendaftaran</a>
    </div>
    
  </div>
  
  





  </div>
</section>