<?php
$link_wa_tanya_jadwal_tes = "https://api.whatsapp.com/send?phone=62$no_wa_petugas&text=Selamat $waktu, saya $nama_calon dengan id pendaftaran: $id_daftar, ingin menanyakan perihal Jadwal Tes PMB untuk gelombang $nama_gel, dimohon segera diposting di web PMB. Terimakasih. [Sisfo-PMB, ".date("d M Y h:i:s")."]";



?>

<style type="text/css">
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

    <?php 
    include 'cek_submit_formulir.php';
    include 'cek_persyaratan.php';

    $blok_jadwal_tes = "<p>Jadwal Tes belum ada.</p>";

    ?>

    <div class="section-title">
      <h2>Jadwal Tes PMB</h2>
      <p>Jika Anda sudah melengkapi formulir dan persyaratan pendaftaran, Petugas akan memosting Jadwal Tes PMB disini!</p>
    </div>

    <table>
      <tr>
        <td>

          <h5>Jadwal Tes PMB</h5>
          <hr>
          <ul>
            <li><?=$li_sub ?></li>
            <li><?=$li_up ?></li>
            <li><?=$li_diterima ?></li>

            <?php 

            $s = "SELECT * from tb_jadwal_tes WHERE status_jadwal is null or status_jadwal = 0";
            $q = mysqli_query($cn,$s) or die(mysqli_error($cn));
            if(mysqli_num_rows($q)==0){
              // belum ada jadwal baru
              echo "
              <li style='color:red'>Petugas belum memosting Jadwal Tes PMB | <a href='$link_wa_tanya_jadwal_tes'  target='_blank' style='margin: 15px 0'>Hubungi Petugas $img_wa</a></li>
              ";
            }else{
              // ada jadwal yang belum terlaksana
              echo "
              <li style='color:green'>Sudah ada Jadwal Tes PMB terbaru $img_check</li>
              ";
            }


            $s = "SELECT * from tb_peserta_tes a  
            join tb_jadwal_tes b on a.id_jadwal_tes=b.id_jadwal_tes 
            where id_daftar='$id_daftar'";
            $q = mysqli_query($cn,$s) or die(mysqli_error($cn));
            if(mysqli_num_rows($q)!=1){
              echo "<li style='color:red'>Anda belum didaftarkan oleh Petugas pada Jadwal Tes Terbaru | <a href='$link_wa_tanya_jadwal_tes'  target='_blank' style='margin: 15px 0'>Hubungi Petugas $img_wa</a></li>";
            }else{
              echo "<li style='color:green'>Anda sudah didaftarkan oleh Petugas $img_check</li>";

              $d = mysqli_fetch_assoc($q);

              $id_gelombang = $d['id_gelombang'];
              $nama_tes = $d['nama_tes'];
              $keterangan = $d['keterangan'];
              $link_tes = $d['link_tes'];
              $status_jadwal = $d['status_jadwal'];
              $tanggal_pelaksanaan = $d['tanggal_pelaksanaan'];
              $tanggal_tes = $d['tanggal_tes'];

              $status_jadwal_show = "<small><i style='color:#999'>belum dilaksanakan</i></small>";
              if($status_jadwal) $status_jadwal_show = "<small><i style='color:green'>sudah dilaksanakan</i></small>";


              // function durasi_hari($a,$b){
              //   if (intval($a) == 0 || intval($b) == 0) {
              //     return "-";
                  
              //   } 
              //   $dStart = new DateTime($a);
              //   $dEnd  = new DateTime($b);
              //   $dDiff = $dStart->diff($dEnd);
              //   return $dDiff->format('%r%a'); 

              // }

              $jumlah_selisih_hari = durasi_hari(date("Y-m-d"),$tanggal_tes);

              if($jumlah_selisih_hari>0){
                $ket_telat = "[ $jumlah_selisih_hari hari lagi ]";
              }elseif($jumlah_selisih_hari==0){
                $ket_telat = "[ hari ini ]";
              }else{
                $ket_telat = "[ <span style='color:red'><b>sudah berlalu</b></span> ]";
              }


              $tanggal_tes_show = $nama_hari[date('w',strtotime($tanggal_tes))].", ".date("d M Y H:i",strtotime($tanggal_tes)). " WIB $ket_telat";



              $blok_jadwal_tes = "<h4>Jadwal Tes Anda</h4>
              <table class='table table-striped'>
                <tr><td>ID Gelombang</td><td>$id_gelombang</td></tr>
                <tr><td>Nama Tes</td><td>$nama_tes</td></tr>
                <tr><td>Tanggal Tes</td><td>$tanggal_tes_show</td></tr>
                <tr><td>Keterangan</td><td>$keterangan</td></tr>
                <tr><td>Link-test</td><td>$link_tes</td></tr>
                <tr><td>Status Jadwal</td><td>$status_jadwal_show</td></tr>
              </table>
              ";


            }

            



            ?>

            
          </ul>

          <hr>
          <?=$blok_jadwal_tes?>
          <hr>
          
          <!-- <button class="btn btn-primary not_ready" disabled="">Saya Siap Mengikuti Tes PMB</button> -->

        </td>
      </tr>
    </table>


    <!-- <hr>.<br>.<br>.<br>.<br>Design saat sudah tes dan lulus:<hr>
    <div class="section-title">
      <h2>Hasil Tes PMB</h2>
      <p>Anda sudah melakukan Tes PMB dengan hasil sebagai berikut:</p>
    </div>

    <table>
      <tr>
        <td>

          <h5>Hasil Tes PMB</h5>
          <hr>
          <ul>
          	<li>Login CBT: 21 November 2021 08:34</li>
          	<li>Durasi Tes: 94 menit</li>
          	<li>Hasil: Sangat Bagus</li>
          	<li>Nilai Akhir: 92</li>
          </ul>
          <hr>

          <span style="font-size: 20px; color: blue; font-weights:bold">
          	Selamat! Anda Lulus Tes PMB.
          </span>
          <hr>
          <button class="btn btn-primary not_ready" disableda="">Download Pengumuman Hasil Tes</button>


        </td>
      </tr>
    </table>






    <hr>.<br>.<br>.<br>.<br>Design saat sudah tes dan belum lulus:<hr>
    <div class="section-title">
      <h2>Hasil Tes PMB</h2>
      <p>Anda sudah melakukan Tes PMB dengan hasil sebagai berikut:</p>
    </div>

    <table>
      <tr>
        <td>

          <h5>Hasil Tes PMB</h5>
          <hr>
          <ul>
          	<li>Login CBT: 21 November 2021 08:34</li>
          	<li>Durasi Tes: 94 menit</li>
          	<li>Hasil: Kurang</li>
          	<li>Nilai Akhir: 61</li>
          	<li>KKM: 70</li>
          </ul>
          <hr>

          <span style="font-size: 20px; color: brown; font-weights:bold">
          	Maaf! Anda belum Lulus Tes PMB
          </span>
          <hr>
          <small>Anda masih punya 1 kali kesempatan lagi agar lulus Tes PMB STMIK IKMI Cirebon <?=$periode_ta ?>. Belajarlah kembali dan jika Anda sudah siap mengikuti kembali tes silahkan tekan tombol Ikuti Tes ke-2 PMB.</small>
          <hr>
          <button class="btn btn-primary not_ready" disableda="">Ikuti Tes ke-2 PMB</button>


        </td>
      </tr>
    </table> -->







  </div>
</section>