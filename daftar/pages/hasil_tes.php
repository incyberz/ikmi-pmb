<?php
$id_jadwal_tes = '';
$hasil_tes = "
<p class='merah'>Anda belum mengikuti tes PMB atau Hasil Tes PMB belum diumumkan.</p>
<hr>
<a class='btn btn-primary' href='?jadwal_tes'>Lihat Jadwal Tes PMB</a>
";

$s = "SELECT 

a.tanggal_lulus_tes,
a.status_lulus,
b.id_jadwal_tes, 
c.tanggal_tes,
c.link_hasil_reg,
c.link_hasil_kip,
c.nama_tes 

from tb_daftar a 
join tb_peserta_tes b on a.id_daftar=b.id_daftar 
join tb_jadwal_tes c on b.id_jadwal_tes=c.id_jadwal_tes 
where a.id_daftar=$id_daftar 
order by c.tanggal_tes desc 
limit 1 
";
// die($s);

$q = mysqli_query($cn, $s) or die(mysqli_error($cn));

if (mysqli_num_rows($q)==1) {
  $d = mysqli_fetch_assoc($q);

  $hasil_tes = "
  <p class='merah'>Hasil Tes PMB untuk Anda belum diumumkan.</p>
  <hr>
  ";

  $tanggal_lulus_tes = $d['tanggal_lulus_tes'];
  $status_lulus = $d['status_lulus'];
  // $tanggal_lulus_tes = "2020-2-20";
  $tanggal_lulus_tes_show = date("d F Y", strtotime($tanggal_lulus_tes));

  if ($tanggal_lulus_tes != null) {
    $id_jadwal_tes = $d['id_jadwal_tes'];
    $tanggal_tes = $d['tanggal_tes'];
    $nama_tes = $d['nama_tes'];
    $link_hasil_reg = $d['link_hasil_reg'];
    $link_hasil_kip = $d['link_hasil_kip'];

    $ta = substr($id_gelombang, 0, 4);
    $ta2 = $ta+1;
    $gelombang_show = "Gelombang ".substr($id_gelombang, 4, 1)." Tahun Akademik $ta/$ta2";
    $tanggal_tes_show = date("d F Y", strtotime($tanggal_tes));

    if ($status_lulus) {
      $download_formulir_token = '';
      $img_pdf= '';

      $a = date("mydh").$id_jalur;
      $download_formulir_token = md5($a);

      $hasil_tes_download = $tahun_pmb==2023 ? 'hasil_tes_download__ta2023' : 'hasil_tes_download';

      $info_fakta_integ = $id_jalur==3 ? 'mengisi <u>Fakta Integritas</u> dan' : '';
      $link_fakta_integ = $id_jalur==3 ? '<a class="btn btn-primary" target=_blank href="pdf/fakta_integritas_kip_2023.pdf">Download Fakta Integritas</a>' : '';

      $hasil_tes = "
      <div class='alert alert-success'><h4>Selamat Anda Lulus Tes</h4><hr>
        <p>Tanggal Kelulusan: <span style='color:#a4f'>$tanggal_lulus_tes_show</span></p>
        <p>
          Berdasarkan hasil Tes Potensi Akademik dalam proses seleksi Penerimaan Mahasiswa Baru $gelombang_show, yang telah dilaksanakan pada Tanggal $tanggal_tes_show, bersama ini diumumkan bahwa Anda dinyatakan : <span style='color:green'><b>LULUS</b></span>
        </p>
        <p>
          Berdasarkan keputusan di atas, maka Anda wajib $info_fakta_integ melakukan <u>Registrasi Ulang</u> dengan ketentuan sesuai dengan Jalur Daftar yang Anda pilih, <u>maksimal 7 hari setelah Pengumuman Kelulusan Tes PMB</u>. Untuk informasi lebih lanjut silahkan Anda Download Dokumen Pengumuman Hasil Tes PMB berikut ini.
          <div>$link_fakta_integ</div>
        </p>
        <hr>
        <form method='post' action='./pdf/$hasil_tes_download.php' target='_blank'>
          <input type='hidden' name='download_formulir_token' value='$download_formulir_token'>
          <button class='btn btn-primary' name='btn_download_formulir'>Download PDF Hasil Tes $tahun_pmb</button>
        </form>
      
      </div>
      ";
      } else {
      $hasil_tes = "
      <div class='alert alert-danger'><h4>Maaf, Anda belum Lulus Tes</h4><hr>
        <p>Tanggal Keputusan: <span style='color:#a4f'>$tanggal_lulus_tes_show</span></p>
        <p>
          Berdasarkan hasil Tes Potensi Akademik dan Wawancara dalam proses seleksi Penerimaan Mahasiswa Baru $gelombang_show, yang telah dilaksanakan pada Tanggal $tanggal_tes_show, bersama ini diumumkan bahwa Anda dinyatakan : <span style='color:darkred'><b>BELUM LULUS</b></span>
        </p>
        <p>
          Berdasarkan keputusan di atas, maka Anda dapat melakukan pemindahan ke <b>JALUR REGULER</b> dengan datang langsung ke kampus STMIK IKMI Cirebon sampai dengan tanggal 4 Agustus 2022. 
        </p>        
      </div>
      ";
    } //end if $status_lulus
  } //end if tanggal_ulus_tes != null
} // end if mysqlinumrows==1


?>


<style type='text/css'>
  #tes table{width: 100%; margin-bottom: 30px;}
  #tes th,td{padding: 10px; border: solid 1px #afa;}
  #tes th{padding: 9px 5px;text-align: center;background: linear-gradient(#fff,#afa)}
  #tes td{padding: 10px; background-color: #eff;}
  .bundle{border: solid 1px #afa; padding: 15px; border-radius: 10px; background-color: #ffe; margin: 20px 0;}

  /*.form-group {margin-bottom: 10px;}*/
  #tes label {margin: 10px 0  5px 0;font-sizea: small;}
</style>

<section id="tes" class="">
  <div class="container">

    <?php include 'cek_submit_formulir.php'; ?>


    <div class="section-title">
      <h2>Hasil Tes PMB</h2>
    </div>
    <table>
      <tr>
        <td>
          Prodi Terpilih
        </td>
        <td>
          <?=$nama_prodi1 ?>
        </td>
      </tr>
      <tr>
        <td>
          Jalur Daftar
        </td>
        <td>
          <?=$nama_jalur ?>
        </td>
      </tr>

    </table>

    <p>Hasil Tes:</p>
    <?=$hasil_tes ?>

    <hr>


  </div>
</section>