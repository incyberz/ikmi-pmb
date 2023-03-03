<?php
$is_login = 0;
$link_wa_lupa_pass = "";
$no_wa_petugas = "083821651265"; //Nomor FO

$link_wa_lupa_pass = "https://api.whatsapp.com/send?phone=62$no_wa_petugas&text=Yth. Petugas PMB STMIK IKMI Cirebon saya lupa password akun PMB. Berikut adalah data saya: (silahkan ketik nama dan email Anda)";


$email = "";
$pesan = "Silahkan Anda login memakai email dan password pada saat Anda melakukan Pendaftaran Akun!";
if (isset($_POST['btn_login'])) {
    $email = strip_tags($_POST['email']);
    $password = strip_tags($_POST['password']);

    require_once "config.php";

    $s = "SELECT a.*,b.id_daftar,c.id_calon from tb_akun a 
  join tb_daftar b on a.email=b.email 
  join tb_calon c on a.email=c.email 
  where a.email='$email' and a.password='$password'";
    $q = mysqli_query($cn, $s) or die(mysqli_error($cn));
    if (mysqli_num_rows($q)==1) {
        $d = mysqli_fetch_assoc($q);

        $nama_calon = $d['nama_calon'];
        $no_wa = $d['no_wa'];
        $status_email = $d['status_email'];
        $status_no_wa = $d['status_no_wa'];
        $id_calon = $d['id_calon'];
        $id_daftar = $d['id_daftar'];

        $is_login = 1;

        $pesan = "Welcome $nama_calon!";

        if (!isset($_SESSION)) {
            session_start();
        }
        $_SESSION['pendaftar_email'] = $email;
        $_SESSION['pendaftar_nama'] = $nama_calon;
        $_SESSION['pendaftar_admin_level'] = 1;
        $_SESSION['pendaftar_id_daftar'] = $id_daftar;
        $_SESSION['pendaftar_id_calon'] = $id_calon;

        // header("Location: index.php?formulir");
        header("Location: index.php?formulir"); // update by kahoyong
        exit;
    } else {
        $pesan = "<div class='alert alert-danger'>Maaf, username dan password tidak cocok.</div>";
    }
}

?>
<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <meta content="Pendaftaran Akun Penerimaan Mahasiswa Baru STMIK IKMI Cirebon Tahun Ajaran 2022/2023" name="description">
  <meta content="" name="pendaftaran, daftar, kuliah, kampus, pmb, pkkmb, ospek">

  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <link href="assets/css/pmb.css" rel="stylesheet">

  
  <script src="assets/vendor/jquery/jquery.min.js"></script>

  <style type="text/css">
    body { 
      background: url('assets/img/bg/gedung-ikmi.png') no-repeat center center fixed; 
      -webkit-background-size: cover;
      -moz-background-size: cover;
      -o-background-size: cover;
      background-size: cover;
    }
    .form-group{margin-bottom: 10px;}
  </style>

</head>
<body>
  <div class="row">
    <div class="col-lg-4">&nbsp;</div>
    <div class="col-lg-4">
      <div style="background: linear-gradient(#fff,#ccf); border: solid 1px #cc2; border-radius: 10px; padding: 15px; margin: 30px 10px;">
        <h3 class="text-center">LOGIN PMB</h3>
        <hr>
        <div class="text-center"><img src="assets/img/logo/logo-pmb.png" height="100px"></div>
        <hr>
        <p><?=$pesan ?></p>
        <hr>

        <form method="post">
          <div class="row form-group">
            <div class="col-4 text-right">Email:</div><div class="col-8">
              <input type="email" class="form-control" id="email" name="email" required=""  minlength="10" maxlength="50" value="<?=$email?>">
            </div>
          </div>
          
          <div class="row form-group">
            <div class="col-4 text-right">Password</div><div class="col-8">
              <input type="password" class="form-control" id="password" name="password" required="" minlength="6" maxlength="20">
              <style type="text/css">.help{cursor: pointer;} .help:hover{color: blue;}</style>
              <p id="help1" class="help" style="text-align:right"><small>help <img src='assets/img/icons/help.png' width='20px'></small></p>
              <small id="help2" class="help hideit">Secara default password Anda adalah nomor whatsApp Anda yang digunakan saat Pendaftaran Akun. Setelah berhasil login Anda dapat segera menggantinya.<hr>OK</small>
            </div>
          </div>
          
          <hr>

          <div class="form-group">
            <button class="btn btn-primary btn-block" style="width:100%" name="btn_login" id="btn_login">Login</button>
            <p style="text-align:center; margin-top:10px"><small><a href="?daftar_akun">Daftar Akun Baru</a> | <a target="_blank" href="<?=$link_wa_lupa_pass?>" onclick="return confirm('Silahkan Anda hubungi Petugas PMB via WhatsApp untuk reset password.')">Lupa Password</a></small></p>
          </div>
        </form>
        

      </div>
      
    </div>

    
  </div>

</body>
</html>


<script type="text/javascript">
  $(document).ready(function(){
    $(".help").click(function(){
      var id = $(this).prop("id");

      if(id=="help1"){
        $("#"+id).slideUp();
        $("#help2").slideDown();
      }

      if(id=="help2"){
        $("#"+id).slideUp();
        $("#help1").slideDown();
      }
    })
  })
</script>