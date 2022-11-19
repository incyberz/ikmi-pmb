<?php 
if (!isset($_SESSION['email'])) {die("Error #6asd5321434b234as");}
if (!isset($_SESSION['nama_calon'])) {die("Error #6d3f345j34k5345");}
// if (!isset($_POST['id_prodi'])) die("Error #asda76fs5sd");

?>
<div class="row divpadding">
  <div class="col-md-4 divborder divpadding2 huruf14" style="<?=$sty?>">
      Nomor Tes: <b><?=$no_daf?></b>
  </div>
  <div class="col-md-4 divborder divpadding2 huruf14" style="<?=$sty?>">
      Gelombang: <b><?=$nama_gel?> - TA <?=$id_angkatan?></b>
  </div>
  <div class="col-md-4 divborder divpadding2 huruf14" style="<?=$sty?>">
      Prodi: <b><?=$jenjang?> - <?=$nama_prodi?></b>
  </div>
</div>

<div class="row divpadding">
  <div class="col-4 divpadding divborder">
    <div class=" divpadding5">
      <span class="huruf12">
        <b>BIODATA PESERTA</b>
        <br><?=$bull?> Nama : <?=$nama_calon?>
        <br><?=$bull?> TTL : <?=$tempat_lahir?>, <?=$tanggal_lahir?>
        <br><?=$bull?> Jenis Kelamin : <?=$jenis_kelamin?>
      </span>
    </div>
  </div>

  <div class="col-8 divpadding divborder">
    <div class=" divpadding5" style="background-color: yellow">
      <span class="huruf12">
        <h3 style="color: blue">Saat ini Anda tidak perlu mencetak Kartu Tes PMB</h3>
        <h1 style="color: green">Tes PMB diselenggarakan secara Online!</h1>
        <h4>Silahkan Anda kunjungi <a href="https://cbtpmb.ikmi.ac.id">CBT PMB IKMI</a></h4>
      </span>
    </div>
  </div>

<!--   <div class="col-md-4 divpadding divborder">
    <div class=" divpadding5">
      <span class="huruf12">
        <b>JADWAL TES</b>
        <br><?=$bull?> Tanggal : <?=$tanggal_tes?>
        <br><?=$bull?> Pukul : <?=$durasi_pukul?>
        <br><?=$bull?> Tempat : <?=$tempat_tes?>
      </span>
    </div>
  </div>
  <div class="col-md-4 divpadding divborder">
    <div class=" divpadding5">
      <span class="huruf12">
        <b>MATERI TES</b>
        <br><?=$bull?> Matematika
        <br><?=$bull?> Bahasa Inggris
        <br><?=$bull?> Tes Potensi Akademik
      </span>
    </div>
  </div>
 -->
</div>

<script type="text/javascript">
  $(document).ready(function(){
    // alert("Kartu Tes PMB ini tidak perlu dicetak jika Tes diselenggarakan secara online.");
    // var link_ajax = "cetak_fetch.php?get_cetak=formulir";

    // $.ajax({
    //   url:link_ajax,
    //   success:function(a){
    //     alert(a);
    //   }
    // });
  })
</script>
