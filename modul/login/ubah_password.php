<?php
$pesan_e= '';

if (isset($_POST['btn_update_pass'])) {

  $password_baru = $_POST['password_baru'];
  $password_baru2 = $_POST['password_baru2'];
  $password_lama = $_POST['password_lama'];
  $id_calon = $_POST['id_calon'];
  // $id_calon = 

  function sete($a){
    return "<div class='alert alert-danger'>Error Ubah Password. $a.<hr><a href='?p=daftar9' class='btn btn-primary'>Lihat Status Pendaftaran</a></div>";
  }

  if ($password_baru!=$password_baru2) $pesan_e=sete("Konfirmasi Password tidak sesuai");

  $s = "SELECT password from tb_calon where id_calon = $id_calon";
  $q = mysqli_query($cn,$s) or $pesan_e=sete("Tidak dapat mengakses data calon");

  if (mysqli_num_rows($q)==1 and $pesan_e=="") {
    $d = mysqli_fetch_assoc($q);
    $password = $d['password'];
    if ($password_lama!=$password) $pesan_e=sete("Password lama tidak sesuai");

    if($pesan_e==""){
      # ======================================================
      # START UPDATE HERE
      # ======================================================
      $s = "UPDATE tb_calon set password = '$password_baru' where id_calon=$id_calon";
      $q = mysqli_query($cn,$s) or $pesan_e=sete("Tidak dapat mengupdate password");
      if($q) $pesan_e = "<div class='alert alert-success'>Update Password berhasil.<hr><a href='?p=daftar9' class='btn btn-primary'>Lihat Status Pendaftaran</a></div>";



    }




  }

}
?>

<section id="" class="about">
  <div class="container" data-aos="fade-up">

   <div class="section-title">
    <h2>IKMI</h2>
    <p>Ubah Password</p>
  </div>

  <?=$pesan_e ?>

    <form class="form-horizontal" method="post">
      <input type="hidden" name="id_calon" value="<?=$id_calon?>">

      <div class="form-group col-md-4">
        <label>Password Baru</label>
        <input type="password" class="form-control" id="password_baru" name="password_baru" required minlength="6" maxlength="50">
      </div>
      <div class="form-group col-md-4">
        <label>Konfirmasi Password</label>
        <input type="password" class="form-control" id="password_baru2" name="password_baru2" required minlength="6" maxlength="50">
      </div>
      <div class="form-group col-md-4">
        <label>Password Lama</label>
        <input type="password" class="form-control" id="password_lama" name="password_lama" required minlength="6" maxlength="50">
      </div>

      <div class="form-group col-md-4">
        <button class="btn btn-primary btn-block" type="submit" name="btn_update_pass" id="btn_update_pass">Update Password</button>
      </div>
      <div class="form-group col-md-4">
        <a class="btn btn-warning btn-block" href="javascript:history.go(-1)">Kembali</a></button>
      </div>
    </form> 

</div>
</section>


