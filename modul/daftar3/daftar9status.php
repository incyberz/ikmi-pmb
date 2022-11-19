<?php
if(!isset($_SESSION['email'])) {die(tampil_error("Maaf, Anda belum login. <hr>$link_login"));}
if(!isset($_SESSION['nama_calon'])) {die(tampil_error("Maaf, Sesi Nama Calon belum diset. Silahkan hubungi programmer!<hr>$link_login"));}

if($status_daftar<1 or $jumlah_input_data_penting_user<$jumlah_input_data_penting){die(tampil_error("Maaf, Anda belum melengkapi Formulir Pendaftaran. Silahkan Anda lengkapi data wajib terlebih dahulu.<hr>Kode Status Daftar: $status_daftar<br>Jumlah input data wajib: $jumlah_input_data_penting_user of 14<hr><a href='?p=daftar4' class='btn btn-primary'>Lengkapi Formulir Pendaftaran</a>"));}

$is_lulus=0; //zzz
$no_wa_petugas = "6287734602661";
$isi_wa_bukti_bayar = urlencode("Halo, saya $nama_calon, No.Daf: $no_daf, saya telah melakukan daftar PMB Online dan telah mengupload Bukti Bayar Pendaftaran. Mohon segera diverifikasi! Terimakasih.");
$isi_wa_all_syarat = urlencode("Halo, saya $nama_calon, No.Daf: $no_daf, saya telah mengupload Seluruh Persyaratan Pendaftaran. Mohon segera diverifikasi! Terimakasih.");
$link_wa_bukti_bayar = "https://api.whatsapp.com/send?phone=$no_wa_petugas&text=$isi_wa_bukti_bayar";
$link_wa_all_syarat = "https://api.whatsapp.com/send?phone=$no_wa_petugas&text=$isi_wa_all_syarat";

 ?>
<section id="about" class="about">
  <div class="container" data-aos="fade-up">

    <div class="section-title">
      <h2>IKMI</h2>
      <p>Status Pendaftaran</p>
    </div>

    <style type="text/css">
      .pointlist {
        /*border-radius: 15px;*/
        width: 100%;
        border: 1px solid #73AD21;
      }

      .table_header{
        background-color: #ddffff;
      }

      th, td {
        /*padding: 10px;*/
        padding-left: 10px;
        padding-right: 10px;
      }
      .tdjudul{
        text-align: center;
        font-weight: bold;
        background-color: #eeffdd;
      }
      .tdc{
        text-align: center;
      }

    </style>








    
    <table class="pointlist" cellpadding="10px">
      <tr class="table_header pointlist"><td>Layanan bagi Anda</td></tr>
      <tr>
        <td>
          <form action="cetak.php" method="post" target="_blank">
            <small>
              <div class="row">

                <div class="col-lg-4 hideit" id="down_profil" style="margin-bottom: 40px">
                  <table class="table-bordered" width="100%" cellpadding="15px">
                    <tr><td class="tdjudul">Download Profil IKMI</td></tr>
                    <tr>
                      <td>
                        <a href="https://drive.google.com/file/d/1ANd8tS3IjuRQuCjDWKhIrYfGy4Nzl1hT/view?usp=sharing" target="_blank" name="btn_download_profil_ikmi" class="btn btn-primary btn-block" <?=$btn_download_profil_ikmi_disabled?>><?=$btn_download_profil_ikmi_cap?></a>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <small style="color: green">
                          <?=$bull?> Registrasi Email ... <?=$penanda_step0 ?><br>
                          <?=$bull?> <a href="?p=daftar4&aksi=isi_form">Melengkapi Data Wajib</a> ... <?php echo "$jumlah_input_data_penting_user of $jumlah_input_data_penting $penanda_step1"; ?><br>
                        </small>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <small>
                          )* 
                          <?php 
                          if ($btn_download_profil_ikmi_disabled=="") {
                            echo "Terimakasih Anda telah melengkapi data Anda.";
                          }else{
                            echo "Silahkan Anda lengkapi dahulu data Anda.";
                          }

                          ?> 
                        </small>
                      </td>
                    </tr>
                  </table>
                </div>
                <div class="col-lg-4" id="cetak_formulir" style="margin-bottom: 40px">
                  <table class="table-bordered" width="100%" cellpadding="15px">
                    <tr><td class="tdjudul">Cetak Hasil Formulir</td></tr>
                    <tr>
                      <td>
                        <button type="submit" name="btn_cetak_formulir" class="btn btn-primary btn-block" <?=$btn_cetak_formulir_disabled?>><?=$btn_cetak_formulir_cap?></button>
                      </td>
                    </tr>
                    <tr>
                      <td>
                          <?=$bull?> Registrasi Email ... <?=$penanda_step0 ?><br>
                          <?=$bull?> <a href="?p=daftar4&aksi=isi_form">Melengkapi Data Wajib</a> ... <?php echo "$jumlah_input_data_penting_user of $jumlah_input_data_penting $penanda_step1"; ?><br>
                      </td>
                    </tr>
                    <tr>
                      <td>
                          [Optional] Formulir dapat Anda cetak sebagai tanda bukti bahwa Anda sudah melakukan Proses Pendaftaran di PMB STMIK IKMI Cirebon.
                      </td>
                    </tr>
                  </table>
                </div>
                <div class="col-lg-4" id="cetak_kartu_tes" style="margin-bottom: 40px">
                  <table class="table-bordered" width="100%" cellpadding="15px">
                    <tr><td colspan="2" class="tdjudul">Cetak Kartu Tes PMB</td></tr>
                    <tr>
                      <td>
                        <button type="submit" name="btn_cetak_kartu_tes" class="btn btn-primary btn-block" <?=$btn_cetak_kartu_tes_disabled?>><?=$btn_cetak_kartu_tes_cap?></button>
                      </td>
                    </tr>
                    <tr>
                      <td>
                          <?=$bull?> Registrasi Email ... <?=$penanda_step0 ?><br>
                          <?php if($id_jndaftar==1 or $id_jndaftar==2){ ?>
                          <?=$bull?> <a href="?p=daftar8#input_bukti_bayar">Bukti Bayar</a> ... <?=$penanda_step3 ?><br>
                          <?php } ?>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <style type="text/css">ul,li{margin:0;padding: 10px}</style>
                        <ul>
                          <li>Jika masih belum diverifikasi. |  <a href="<?=$link_wa_bukti_bayar?>" target="_blank">hubungi FO</a></li>
                          <li>Kartu Tes PMB adalah salah satu syarat untuk mengikuti Tes CBT-PMB STMIK IKMI Cirebon jika tes diselenggarakan secara offline.</li>
                        </ul>
                      </td>
                    </tr>
                  </table>
                </div>
                <div class="col-lg-4" id="cetak_kartu_prasyarat_regu" style="margin-bottom: 40px">
                  <table class="table-bordered" width="100%" cellpadding="15px">
                    <tr><td colspan="2" class="tdjudul">Kartu Prasyarat Registrasi Ulang</td></tr>
                    <tr>
                      <td>
                        <button type="submit" name="btn_cetak_regis" class="btn btn-primary btn-block" <?=$btn_cetak_regis_disabled?>><?=$btn_cetak_regis_cap?></button>
                      </td>
                    </tr>
                    <tr>
                      <td>
                          <?=$bull?> <a href="?p=daftar4&aksi=isi_form">Melengkapi Data Wajib</a> ... <?php echo "$jumlah_input_data_penting_user of $jumlah_input_data_penting $penanda_step1"; ?><br>
                          <?=$bull?> <a href="?p=daftar8">Persyaratan (Accepted)</a> ... <?php echo "$jumlah_persyaratan_user_verified of $jumlah_persyaratan_user $penanda_step2"; ?><br>
                          <?=$bull?> <span class="note_red">Belum ikut Tes PMB</span> | <a href="?p=daftar4">lihat Jadwal Tes</a><br>
                          <?=$bull?> <span class="note_red">Kelulusan Tes PMB</span> | <a href="https://ikmi.ac.id" onclick="return confirm('Pengumuman Kelulusan Tes PMB dapat Anda lihat di Web Utama STMIK IKMI Cirebon.')">lihat Web Utama</a><br>
                      </td>
                    </tr>
                    <tr>
                      <td>
                          )* Kartu Prasyarat Registrasi Ulang adalah salah satu syarat bagi Anda dalam tahap Registrasi Ulang menjadi Mahasiswa Baru STMIK IKMI Cirebon.
                      </td>
                    </tr>

                  </table>
                </div>
              </div>
            </small>            
          </form>
        </td>
      </tr>
    </table> 

    <div class="row" style="margin-top: 15px">
      <div class="col-lg-4" style="margin-bottom: 15px">
        <a href="?p=daftar4" class="btn btn-warning btn-block">Cek Ulang Formulir</a>
      </div>
      <div class="col-lg-4">
        <a href="?p=daftar8" class="btn btn-warning btn-block">Cek Ulang Persyaratan</a>
      </div>
      
    </div>
  </div>
</section>