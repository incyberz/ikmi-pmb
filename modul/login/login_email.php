
<?php
$input_email= '';
$password= '';
$is_login=0;
$is_pass_default=0;
$hasil_proses="<p style='font-weight: bold; color: blue'>Selamat $waktu Calon Mahasiswa Baru IKMI, silahkan Anda login!</small></p>";


if(isset($_GET['input_email'])) $input_email=$_GET['input_email'];

if (isset($_POST['btn_login'])) {
  $input_email = filter_var(strtolower($_POST['input_email']));
  $input_password = filter_var($_POST['input_password']);

  $s = "SELECT 
  a.nama_calon, 
  a.email, 
  a.no_wa,
  b.status_daftar 
  from tb_calon a 
  join tb_daftar b on a.id_calon=b.id_calon 
  where (a.email = '$input_email') 
  and a.password = '$input_password' ";

  $q = mysqli_query($cn,$s) or die("Error query. Tidak dapat login.");
  if (mysqli_num_rows($q)==1) {
    $d = mysqli_fetch_assoc($q);
    $nama_calon = ucwords(strtolower($d['nama_calon']));
    $input_email = $d['email'];
    $no_wa = $d['no_wa'];
    $status_daftar = $d['status_daftar'];
    if($no_wa==$input_password) $is_pass_default=1;

    $_SESSION['nama_calon'] = $nama_calon;
    $_SESSION['email'] = $input_email;

    $link_isi_form = '';
    $link_tes = '';
    // echo "<br><hr>status_daftar:$status_daftar";

    if($status_daftar<1)$link_isi_form = "<a href='?p=daftar4&aksi=isi_form' class='btn btn-primary btn-block' style='margin-bottom:10px'>Isi Formulir PMB</a>";
    if($status_daftar==1)$link_tes = "<a href='?p=daftar4' class='btn btn-primary btn-block' style='margin-bottom:10px'>Lihat Jadwal Tes</a>";

    $hasil_proses = "
    <div class='alert alert-success col-lg-4'>
    Selamat Datang kembali $nama_calon !
    <hr>
    <div class='row'>
      <div class='col-lg-12'>
        $link_isi_form
        $link_tes 
        <a href='?p=daftar9' class='btn btn-primary btn-block' style='margin-bottom:10px'>Cek Status PMB</a> 
        <a href='?p=ubahpass' class='btn btn-primary btn-block'>Ubah Password</a> 
      </div>
    </div>
    </div>
    ";

    $is_login=1;

  }else{
    $hasil_proses = "
    <div class='alert alert-danger'>
      Maaf, Email dan Password tidak sesuai. Silahkan Anda coba kembali!
    </div>
    ";
  }
}








?>


<section id="login_email" class="about">
  <div class="container" data-aos="fade-up">

   <div class="section-title">
    <h2>IKMI</h2>
    <p>Login via Email</p>
  </div>

  <?=$hasil_proses ?>

  <?php if(!$is_login){ ?>
    <form class="form-horizontal" action="?p=login_email" method="post" autocomplete="off">

      <div class="form-group col-md-4">
        <label>Email</label>
        <input type="email" class="form-control" id="input_email" name="input_email" required minlength="10" maxlength="50" value="<?=$input_email?>">
        <small id="email_ket" style="display: none">
          Anda dapat login dengan <span style='color:darkblue'>alamat gmail</span>.
        </small>
      </div>
      <div class="form-group col-md-4">
        <label>Password</label>
        <input type="password" class="form-control" required="" minlength="6" maxlength="30" id="input_password" name="input_password">
        <small id="password_ket"></small>
      </div>

      <div class="form-group col-md-4">
        <button class="btn btn-primary btn-block" type="submit" name="btn_login" id="btn_login">Login</button>
        <small><a href="#" onclick="alert('Silahkan hubungi Front Office STMIK IKMI via WhatsApp Anda ke nomor 085659788817 (Bani), 082130148448 (Anam), 088238626447 (Rifai). Terimakasih.')">Lupa input_password</a></small>
      </div>
    </form> 
    <?php 
  }else{ 
    if($is_pass_default) {
      echo "<small><b><span style='color: red'>Perhatian!</span> Password Anda masih default (sama dengan Nomor WA), silahkan Anda menggantinya.</b></small>";
    }
  } 
  ?>

</div>
</section>


<script type="text/javascript">
  $(document).ready(function(){
    // alert(0)
    $("#input_email").focus(function(){
      $("#email_ket").fadeIn(2000);
      $("#email_ket").show()
    })

    $("#input_email").focusout(function(){
      $("#email_ket").hide()
    })

    $("#input_password").focus(function(){
      $("#password_ket").html("Jika Anda pertama kali, maka default input_password adalah nomor whatsapp Anda (diawali dengan 08... tanpa spasi, tanpa strip), setelah login Anda dapat segera mengubahnya pada menu User.");
      $("#password_ket").fadeIn(2000);
      $("#password_ket").show()
    })

    $("#input_password").focusout(function(){
      // $("#password_ket").hide()
    })
  })
</script>
