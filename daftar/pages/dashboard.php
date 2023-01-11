<?php include "dashboard_logic.php"; ?>
<style type="text/css">
  #langkah {font-size: 20px; list-style-type: none; padding: 0;}
  #langkah li{padding: 5px 15px; border-radius: 5px;}
  #langkah .step{cursor: pointer;}
  #langkah .sudah:hover{background-color: #cfc;padding: 5px 15px;}
  #langkah .belum:hover{background-color: #efefef;padding: 5px 15px;}
  #langkah .sedang:hover{background-color: #aff;padding: 5px 15px;font-weight: bold; border: solid 3px #7ff;}
  #langkah .sudah {color: green; background-color: #efe;}
  #langkah .sedang {color: blue;background-color: #dff;border: solid 3px #aff; font-weight: bold;}
  #langkah .belum {color: #f55;background-color: #fefefe;}
  .ket_step{font-size: small;display: none;}
  .opsi_step{margin-left: 15px;}
</style>
<section id="dashboard" class="">
  <div class="container">

    <div class="section-title">
      <h2>Dashboard</h2>
      <p>Anda dapat mengecek history pendaftaran pada dashboard</p>
    </div>

    <input type="hidden" id="cActive_step" value="<?=$cActive_step?>">


    <!-- =============================================================== -->
    <!-- DAFTAR AKUN -->
    <!-- =============================================================== -->
    <ul id="langkah">
    	<li class="<?=$langkah_class[1]?>"><?=$rimg_check[1] ?> <span id="step1" class="step"><?=$rlangkah[1]?></span>
    		<div class="ket_step" id="ket_step1">
          <div class="opsi_step"><hr></div>
          <ol>
            <li>Anda mendaftarkan diri dengan email dan nomor whatsApp</li>
            <li>Sistem akan memberikan password login via whatsApp/email</li>
            <li>Anda login menggunakan password yang telah diberikan</li>
            <li>Anda sangat disarankan untuk mengubah password default Anda</li>
            <li>Setelah login Anda dapat mengisi Formulir Pendaftaran</li>
          </ol>
          <div class="opsi_step">
            <hr>
            Anda sudah mendaftar akun pada <?=$akun_created_show?>
            <hr>
            <button class="btn btn-success btn-sm not_ready">Ubah Password</button> 
            <button class="btn btn-success btn-sm not_ready">Update Nomor WA</button> 
            <hr>
          </div>

        </div>
    	</li>








      <!-- =============================================================== -->
      <!-- FORMULIR -->
      <!-- =============================================================== -->
    	<li class="<?=$langkah_class[2]?>"><?=$rimg_check[2] ?> <span id="step2" class="step"><?=$rlangkah[2]?></span>
    		<div class="ket_step" id="ket_step2">
          <ol>
            <li>Siapkanlah KTP dan Kartu Keluarga Anda agar proses pengisian formulir berjalan lancar</li>
            <li>Silahkan Anda pilih Prodi dan Jalur Pendaftaran</li>
            <li>Setelah itu isilah biodata secara lengkap</li>
            <li>Anda boleh download formulir jika sudah melengkapinya</li>
          </ol>

          <div class="opsi_step">
            <hr>
            <?php if ($langkah_class[2]=="sudah") { ?>
              Anda sudah melengkapi formulir pada Kamis, 12 November 2021 19:42 WIB <?=$img_check ?>

              <hr>
              <a class="btn btn-success btn-sm" href="?formulir">Update Formulir</a>

              <a href="?formulir_download" class="btn btn-success btn-sm" id="download_formulir">Download Formulir</a>

            <?php } else { ?>
              <hr>
              <a href="?formulir" class="btn btn-primary">Lengkapi Formulir</a>


            <?php } ?>

            <hr>
          </div>

        </div>

    	</li>





      <!-- =============================================================== -->
      <!--  -->
      <!-- =============================================================== -->
      <!-- Upload Persyaratan -->
    	<li class="<?=$langkah_class[3]?>"><?=$rimg_check[3] ?> <span id="step3" class="step"><?=$rlangkah[3]?></span>
    		<div class="ket_step" id="ket_step3">
          <div class="opsi_step"><hr></div>
          <ol>
            <li>Segera lakukan pembayaran biaya pendaftaran Sebesar Rp. 200.000 ke rekening BRI an. STMIK IKMI Cirebon No Rek. 4149-01-000004-30-5</li>
            <li>Segera upload pas photo dan bukti transfer pembayaran biaya pendaftaran ke Menu Upload dibawah ini</li>
            <li>Tunggu proses verifikasi dari admin petugas 
            pendaftaran</li>
          </ol>

          <div class="opsi_step">

            <hr>
            <a class="btn btn-success btn-sm" href="?upload">Goto Menu Upload</a> 
            <a class="btn btn-success btn-sm" href="?formulir_download">Download Formulir</a> 
            <hr>
          </div>

        </div>

    	</li>



















      <!-- =============================================================== -->
      <!--  -->
      <!-- =============================================================== -->
      <!-- Mengikuti Tes PMB -->
    	<li class="<?=$langkah_class[4]?>"><?=$rimg_check[4] ?> <span id="step5" class="step"><?=$rlangkah[4]?></span>
    		<div class="ket_step" id="ket_step5">
          <ol>
            <li>Tes dan Wawancara dilakukan secara Offline / Tatap Muka</li>
            <li>Undangan Tes dan Wawancara di Informasikan oleh Admin pada Menu Jadwal Tes</li>
            <li>Apabila tidak menghadiri undangan Tes dan Wawancara dari jadwal yang telah ditentukan, peserta dapat diberikan kesempatan pada jadwal tes berikutnya.</li>
            <li>Hasil kelulusan dari Tes dan Wawancara akan diumumkan pada Menu Hasil Tes dengan mempertimbangkan Passing Grade yang diperoleh peserta.</li>
          </ol>
        </div>
    	
    	</li>











      <!-- =============================================================== -->
      <!--  -->
      <!-- =============================================================== -->
      <!-- Registrasi Ulang -->
    	<li class="<?=$langkah_class[5]?>"><?=$rimg_check[5] ?> <span id="step6" class="step"><?=$rlangkah[5]?></span>
    		<div class="ket_step" id="ket_step6">

          <style type="text/css">
            .div_regulang{
              border: solid 1px #ccc;
              padding: 10px;
              border-radius: 15px;
              margin: 15px 0 30px 15px;
            }
          </style>

          <div class="row">
            <div class="col-lg-6">
              <div class="div_regulang">
                <h4>Registrasi Ulang Jalur Reguler/Startup</h4>
                <ol>
                  <li>Jika Anda dinyatakan lulus tes PMB, maka Anda boleh melanjutkan ke proses Registrasi ulang</li>

                  <li>Pembayaran registrasi ulang dilakukan sekali bayar maksimal 7 hari setelah pengumuman kelulusan tes PMB sebesar Rp.1.150.000</li>

                  <li>Bagi yang jatuh tempo dalam melakukan pembayaran Registrasi Ulang dianggap mengundurkan diri</li>

                  <li>Silahkan Anda upload bukti pembayaran registrasi ulang pada menu Upload</li>

                  <li>Tunggulah hingga bukti pembayaran Anda diverifikasi oleh petugas</li>

                  <li>Kirimkan dokumen persyaratan seperti :
                    <ul>
                      <li>Pas Foto ukuran 4x6 (2 lembar)</li>
                      <li>FC Ijazah terakhir</li>
                      <li>FC KTP calon mahasiswa</li>
                      <li>FC KTP orang tua</li>
                      <li>FC Kartu Keluarga</li>
                      <li>FC Akte Lahir</li>
                    </ul>
                  </li>

                </ol>
              </div>
            </div>



            <div class="col-lg-6">
              <div class="div_regulang">
                <h4>Registrasi Ulang Jalur KIP</h4>
                <ol>

                  <li>Jika Anda dinyatakan lulus tes PMB, maka Anda boleh melanjutkan ke proses Registrasi ulang</li>

                  <li>Silahkan Anda upload bukti pendaftaran Akun KIP Kuliah Kemdikbud / KIP Pelajar / Kartu Keluarga Sejahtera / Kartu Program Keluarga Harapan / SKTM dari Desa atau Kelurahan pada menu Upload</li>

                  <li>Tunggulah hingga bukti upload persyaratan Anda diverifikasi oleh petugas</li>

                  <li>Kirimkan dokumen persyaratan seperti :
                    <ul>
                      <li>Pas Foto ukuran 4x6 (2 lembar)</li>
                      <li>FC Ijazah terakhir</li>
                      <li>FC KTP calon mahasiswa</li>
                      <li>FC KTP orang tua</li>
                      <li>FC Kartu Keluarga</li>
                      <li>FC Akte Lahir</li>
                      <li>FC KIP Pelajar / Kartu Keluarga Sejahtera / Kartu Program Keluarga Harapan / SKTM dari Desa atau Kelurahan</li>
                      <li>Foto bersama keluarga (di cetak ukuran 4R) sebanyak 1 lembar</li>
                      <li>Foto tampak depan rumah (di cetak ukuran 4R) sebanyak 1 lembar</li>
                      <li>Foto ruang keluarga (dicetak ukuran 4R) sebanyak 1 lembar</li>
                      
                    </ul>
                  </li>


                </ol>
              </div>
            </div>

          </div>


          
        </div>
    	
    	</li>










      <!-- =============================================================== -->
      <!--  -->
      <!-- =============================================================== -->
      <!-- Penyerahan Bukti Fisik -->
    	<!-- <li class="<?=$langkah_class[7]?> hideit"><?=$rimg_check[7] ?> <span id="step7" class="step"><?=$rlangkah[7]?></span>
    		<div class="ket_step" id="ket_step7">
          <div class="row">
            <div class="col-lg-6">
              <div class="div_regulang">
                <ol>
                  <li>Setelah bukti bayar diverifikasi maka Anda kami undang secara offline untuk melihat kampus STMIK IKMI Cirebon
                  </li>
                  <li>Siapkan seluruh bukti fisik persyaratan pendaftaran yang wajib Anda bawa</li>
                  <li>Bukti fisik yang harus Anda bawa adalah dokumen asli (bukan fotocopy)</li>
                  <li>Perlihatkan bukti fisik Anda ke bagian Front Office STMIK IKMI</li>
                  <li>Jika Bukti fisik Anda sesuai maka Anda diberikan NIM sementara dan lulus menjadi Mahasiswa Baru STMIK IKMI Cirebon</li>
                </ol>
              </div>
            </div>
            
          </div>
        </div>

    	</li> -->
    	
    </ul>
  </div>
</section>


<script type="text/javascript" src="pages/dashboard.js"></script>