<?php



?>

<!-- ======= Header ======= -->
<header id="header" class="fixed-top">
  <div class="container d-flex align-items-center">

    <h1 class="logo mr-auto"><a href="index.php">PMB-IKMI</a></h1>
    <!-- Uncomment below if you prefer to use an image logo -->
    <!-- <a href="index.php" class="logo mr-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

    <nav class="nav-menu d-none d-lg-block">
      <ul>
        <li class="active"><a href="index.php">Home</a></li>
        <li><a href="index.php?p=about">Tentang IKMI</a></li>
        <li><a href="index.php?p=keunggulan">Keunggulan IKMI</a></li>
        <li class="drop-down"><a href="">Informasi</a>
          <ul>
            <li><a href="index.php?p=prodi">Apa saja Jurusan di IKMI?</a></li>
            <li style="display: none"><a href="index.php?p=civitas">Siapakah Civitas IKMI?</a></li>
            <li><a href="index.php?p=alur">Bagaimana Alur Pendaftaran?</a></li>
            <li style="display: none"><a href="#">Download Brosur IKMI</a></li>
            <li class="drop-down" style="display: none"><a href="#">Download Brosur IKMI</a>
              <ul>
                <li><a href="index.php?p=brosur_ti">Prodi Teknik Informatika</a></li>
                <li><a href="index.php?p=brosur_rpl">Prodi Rekayasa Perangkat Lunak</a></li>
                <li><a href="index.php?p=brosur_si">Prodi Sistem Informasi</a></li>
                <li><a href="index.php?p=brosur_mi">Prodi Manajemen Informatika</a></li>
                <li><a href="index.php?p=brosur_ka">Prodi Komputerisasi Akuntansi</a></li>
              </ul>
            </li>
            <li><a href="index.php?p=biaya">Berapa Biaya Kuliah di IKMI?</a></li>
            <li><a href="index.php?p=lokasi">Dimanakah Lokasi Kampus?</a></li>
            <li><a href="index.php?p=trans">Bagaimana dg Transportasi Umum?</a></li>
            <li style="display: none"><a href="index.php?p=ukm">Apa saja UKM di IKMI?</a></li>
            <li><a href="index.php?p=kontak">Kontak FO IKMI</a></li>

          </ul>
        </li>

        <?php if ($is_login) {?>
          <li class="drop-down"><a href="" style="color: brown"><?=$nama_calon?></a>
            <ul>
              <li><a href="index.php?p=ubahpass">Ubah Password</a></li>
            </ul>
          </li>

        <li><a onclick="return confirm('Yakin untuk Logout?')" class="get-started-btn" href="?p=logout">Logout</a></li>'; 

        <?php } ?>

      </ul>
    </nav><!-- .nav-menu -->


    <?php if (!$is_login) {
        ?>
      <a href="daftar/" class="get-started-btn">Daftar/Login</a>
      <?php

    }
?>


  </div>
</header><!-- End Header -->
