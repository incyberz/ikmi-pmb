<!-- ======= Hero Section ======= -->
<section id="hero" class="d-flex justify-content-center align-items-center">
  <div class="container position-relative" data-aos="zoom-in" data-aos-delay="100">
    <?php 
    if ($is_terdaftar) {
     ?>
    <h1>Selamat Datang <span style="color: yellow"><u><?=$nama_calon ?></u></span>,</h1>
    <h2>Silahkan Anda cek Status Pendaftaran Anda !</h2>
    <a href="?p=daftar9" class="btn-get-started">Cek Status Daftar</a>
    <br><br>
    <small style="color: yellow;font-weight: bold">Jika ini bukan Anda silahkan <a href="?p=logout">Logout</a>.</small>
    <?php }else{ ?>
    <h1>Selamat Datang Calon Mahasiswa STMIK IKMI Cirebon TA. 2022/2023 !</h1>
    <h2>Segera dapatkan!</h2>
    <h1>POTONGAN BIAYA KULIAH !</h1>
    <a href="/pmb6/" class="btn-get-started">Ayo Daftar</a>
    <a href="<?=$link_panduan?>" class="btn-get-started" target="_blank">Unduh Panduan Pendaftaran</a>
    <?php } ?>  </div>
</section><!-- End Hero -->

<main id="main">


<?php 
// include "modul/count_pmb.php";
// include "modul/count_pmb_view.php"; 

?>
</main>