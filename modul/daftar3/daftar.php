<?php
echo "
<script>
  window.location='https://pmb.ikmi.ac.id/daftar/';
</script>
";
exit();

if ($debug_mode) {
    echo "<br><br><br><br><br><br>";
} else {
    echo "<br><br>";
}
?>
<hr>
<section id="about" class="about">
  <div class="container" data-aos="fade-up">

    <div class="section-title">
      <h2>IKMI</h2>
      <p>Pendaftaran Mahasiswa Baru</p>
    </div>

    <?php
    if (isset($_SESSION['email'])) {
        if ($debug_mode) {
            echo "<hr>";
            echo var_dump($_SESSION);
            echo "<hr>";
        }

        ?>

    <p>Halo <?=$nama_calon ?>, Anda sedang login!</p>
    <p>Jika bukan Anda silahkan Logout.</p>

    <div class="row col-lg-4">
      <div class="col-lg-6">
        <a href="?p=daftar3" class="btn btn-primary btn-block">Next</a>  
      </div>
      <div class="col-lg-6">
        <a href="?p=logout" class="btn btn-warning btn-block">Logout</a>
      </div>

      
    </div>

    

    <?php } else {?>


    <p class="tebal biru">Halo calon Mahasiswa Baru IKMI, silahkan Anda login atau daftar baru terlebih dahulu!<br><small>)* Kami tidak akan pernah men-share data pribadi Anda.</small></p>
    



    <!-- <form class="form-horizontal" action="?p=daftar2" method="post">
      <div class="form-group">
        <div class="col-md-10">
          <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Lengkap" required="" value="Mr. Debugger">
          <small id="nama_ket"></small>
        </div>
      </div>
      <div class="form-group">
        <div class="col-md-10">
          <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required="" value="admin@debug.co">
          <small id="nohp_ket"></small>
        </div>
      </div>
      <div class="form-group">
        <div class="col-md-10">
          <input type="text" class="form-control" id="no_hp" name="no_hp" placeholder="No. HP / WA" required="" value="081122223333">
          <small id="nohp_ket"></small>
        </div>
      </div>

      <div class="form-group">
        <div class="row">
          <div class="col-md-4">
            <button class="btn btn-primary btn-block" type="submit">Daftarkan Saya !</button>
          </div>
          <div class="col-md-4">
            <a href="?p=daftar3" class="btn btn-primary btn-block">Login</a>
            <small>Jika Anda pernah daftar silahkan Login!</small>
          </div>

        </div>
      </div>
    </form>  -->
    <div class="row" style="display:none">
      <div class="col-lg-4">
        <a href="?p=login_gmail">
          <img class="img-fluid" src="assets/img/login_via_google.png">
        </a>
      </div>
      <div class="col-lg-12">
        <p style="padding-left: 10px "><small>Jika "Sign in with Google" tidak bisa, silahkan pakai jalur "Daftar Baru"</small></p>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-4">
        <a href="?p=daftar3&aksi=daftar_baru">
          <img class="img-fluid" src="assets/img/daftar_baru.png">
        </a>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-12">
        <hr>
        <p style="padding-left: 10px; display:none"><small>Jika Anda sudah pernah daftar dan "Sign in with Google" tidak bisa, Anda dapat login via Email dan Password.</small></p>
      </div>
    </div>


    <div class="row">
      <div class="col-lg-4">
        <a href="?p=login_email">
          <img class="img-fluid" src="assets/img/login_via_email.png">
        </a>
      </div>
    </div>


    <?php } ?>





  </div>
</section>