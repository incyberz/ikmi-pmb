<?php 
if ($dm) { echo "<br><br><br><br><br><br>";}else{echo "<br><br>";}
?>
<hr>
<section id="daftar_baru" class="about">
  <div class="container" data-aos="fade-up">

    <div class="section-title">
      <h2>IKMI</h2>
      <p>Daftar Baru</p>
    </div>


    <p style="font-weight: bold; color: blue">Selamat <?=$waktu?> Calon Mahasiswa Baru IKMI, untuk pendaftaran silahkan Anda lengkapi form berikut.</small></p>
    
    <form class="form-horizontal" action="?p=daftar2" method="post">
      <div class="form-group col-md-4">
        <label>Nama</label>
        <input type="text" class="form-control" id="nama" name="nama" required="" minlength="3" maxlength="50">
        <small id="nama_ket"></small>
      </div>
      <div class="form-group col-md-4">
        <label>Email</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="emailAnda@gmail.com" required minlength="15" maxlength="50">
        <small id="email_ket"></small>
      </div>
      <div class="form-group col-md-4">
        <label>Password</label>
        <input type="password" class="form-control" required="" minlength="6" maxlength="30">
        <small id="password_ket"></small>
      </div>
      <div class="form-group col-md-4">
        <label>Nomor WhatsApp</label>
        <input type="text" class="form-control" id="no_wa" name="no_wa" required minlength="10" maxlength="13">
        <small id="nowa_ket">Jika Anda lupa password, kami akan mengirimkan verifikasi via whatsApp</small>
      </div>


      <div class="form-group col-md-4">
        <button class="btn btn-primary btn-block" type="submit">Daftar</button>
      </div>
    </form> 
  </div>
</section>