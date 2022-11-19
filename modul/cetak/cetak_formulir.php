<?php 
$alamat_lengkap = "$alamat_jalan, $nama_kec ";
$alamat_lengkap = str_replace("RT /,", "", $alamat_lengkap);
$alamat_lengkap = str_replace("  ", " ", $alamat_lengkap);
$alamat_lengkap = str_replace("  ", " ", $alamat_lengkap);
$alamat_lengkap = str_replace(", ,", ",", $alamat_lengkap);
$alamat_lengkap = str_replace(", ,", ",", $alamat_lengkap);

?>


<div class="row">
  <div class="col-md-4 divpadding">
    <div class="divborder divpadding2 huruf14">
      No Pendaftaran: <b><u><?=$no_daf?></u></b>
    </div>
  </div>
  <div class="col-md-4 divpadding">
    <div class="divborder divpadding2 huruf14">
      Tanggal Daftar: <?=$tanggal_daftar?>
    </div>
  </div>
  <div class="col-md-4 divpadding">
    <div class="divborder divpadding2 huruf14">
      Referal: <?=$tipe_referal?>
    </div>
  </div>
</div>

<div class="row divpadding">
  <div class="col-md-4 divpadding divborder">
    <div class=" divpadding5">
      <span class="huruf12">
        <b>BIODATA DIRI</b>
        <br><?=$bull?> Nama : <?=$nama_calon?>
        <br><?=$bull?> TTL : <?=$tempat_lahir?>, <?=$tanggal_lahir?>
        <br><?=$bull?> Jenis Kelamin : <?=$jenis_kelamin?>
        <br><?=$bull?> Status : <?=$status_menikah?>
        <br><?=$bull?> Agama : <?=$agama?>
        <br><?=$bull?> Kewarganegaraan : <?=$warga_negara?>
        <br><?=$bull?> Alamat : <?=$alamat_lengkap?>
        <br><?=$bull?> No. HP/WA : <?=$no_hp?> / <?=$no_wa?>
        <br><?=$bull?> Email : <?=$email?>
        <br><?=$bull?> NIK : <?=$nik?>
        <br><?=$bull?> NISN : <?=$nisn?>
        <br><?=$bull?> NPWP : <?=$npwp?>

        <hr><b>DATA KIP/KPS</b>
        <br><?=$bull?> No. KIP : <?=$no_kip?>
        <br><?=$bull?> No. Pendaftaran KIP : <?=$no_daf_kip?>
        <br><?=$bull?> No. KPS : <?=$no_kps?>

      </span>
    </div>
  </div>
  <div class="col-md-4 divpadding divborder">
    <div class="divpadding5">
      <span class="huruf12">
        <b>DATA ORANG TUA</b>
        <br><?=$bull?> Nama Ayah : <?=$nama_ayah?>
        <br><?=$bull?> Nama Ibu : <?=$nama_ibu?>
        <br><?=$bull?> Pekerjaan Ayah : <?=$pekerjaan_ayah?>
        <br><?=$bull?> Pekerjaan Ibu : <?=$pekerjaan_ibu?>
        <hr><b>DATA PEKERJAAN</b>
        <br><?=$bull?> Bekerja di : <?=$instansi_kerja?>
        <br><?=$bull?> Sebagai : <?=$jabatan_kerja?>
        <br><?=$bull?> Alamat Kerja : <?=$alamat_kerja?>
        <hr><b>DATA PENDIDIKAN</b>
        <br><?=$bull?> Lulusan : <?=$lulusan?>
        <br><?=$bull?> Asal Sekolah/PT : <?=$sekolah_asal?>
        <br><?=$bull?> Tahun Lulus : <?=$tahun_lulus?>
        <br><?=$bull?> No. Ijazah : <?=$no_ijazah?>
        <br><?=$bull?> Jurusan/Prodi : <?=$prodi_asal?>

      </span>
    </div>
  </div>
  <div class="col-md-4 divpadding divborder">
    <div class="divpadding5">
      <span class="huruf12">
        <b>PENJURUSAN</b>
        <br><?=$bull?> Jenis Daftar : <?=$id_jndaftar_cap?>
        <br><?=$bull?> Jalur Beasiswa : <?=$id_jalur?>
        <br><?=$bull?> Prodi : <?=$jenjang?> - <?=$nama_prodi?> - <?=$nama_jnkelas?>
        <br><?=$bull?> Tipe Bayar : <?=$tipe_bayar?>
        <hr><b>PERSYARATAN UTAMA</b>
        <br>
        <?php 
        $syarat_utama_ke=1;
        if ($id_jndaftar==3 or $id_jndaftar==4) $syarat_utama_ke=2;

        function konversi_status_ke_icon($a){
          $a = strtolower($a);
          if (strpos($a, "belum upload")) return '<a href="index.php?p=daftar8" alt="Anda belum upload atau ditolak oleh petugas."><img src="assets/img/icons/na_small.png" width="12px"></a>';
          if (strpos($a, "not verified")) return '<a href="index.php?p=daftar8" alt="Anda sudah upload tetapi belum diverifikasi oleh petugas."><img src="assets/img/icons/question_small.png" width="12px"></a>';
          if (strpos($a, "accepted")) return '<img src="assets/img/icons/check_small.png" width="12px">';
        }

        for ($i=$syarat_utama_ke; $i <=6 ; $i++) { 
          echo "
          <span><img src='assets/img/icons/next_small.png' width='15px'> <a href='#input_".$file_syarat[$i]."'>".$file_syarat_cap[$i]."</a></span> ".konversi_status_ke_icon($status_file_syarat_html[$i])."<br>
          ";
        }
        ?>
        
        <hr><b>PERSYARATAN TAMBAHAN</b>
        <br>
        <?php for ($i=1; $i <=10 ; $i++) { echo $html_syarat_tambahan2[$i];} ?>

      </span>
    </div>
  </div>

</div>
