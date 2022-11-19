<?php 
$pesan = "";
$email = "";
$no_wa = "";
$nama_calon = "";
$is_submitted = 0;

if(isset($_POST['email'])){
  $email = strip_tags($_POST['email']);
  $no_wa = strip_tags($_POST['no_wa']);
  $nama_calon = strip_tags($_POST['nama_calon']);


  require_once "config.php";
  $s = "INSERT INTO tb_akun 
  (email,password,nama_calon,no_wa) values 
  ('$email','$no_wa','$nama_calon','$no_wa')";
  $q = mysqli_query($cn,$s) or die(mysqli_error($cn));



  $a = "_".microtime(); 
  $a = str_replace("0.", "_", $a);
  $a = str_replace("0,", "_", $a);
  $a = str_replace(" ", "_", $a);
  $a = str_replace("__", "_", $a);
  $folder_uploads = $a;

  $s = "INSERT INTO tb_daftar (email,folder_uploads,id_gelombang) values ('$email','$folder_uploads',$id_gelombang_aktif)";
  $q = mysqli_query($cn,$s) or die(mysqli_error($cn));

  $s = "INSERT INTO tb_calon (email) values ('$email')";
  $q = mysqli_query($cn,$s) or die(mysqli_error($cn));

  $pesan = "Submit Sukses! Welcome $nama_calon <hr>Untuk pertama kali login Anda dapat menggunakan <b>nomor whatsApp sebagai password login</b>. Untuk selanjutnya Anda disarankan agar segera mengganti password Anda.";
  $is_submitted = 1;

}else{
  $pesan = "Not Set";

}

?>

<!DOCTYPE html>
<html>
<head>
  <title>Daftar Akun</title>
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
        <h3 class="text-center">PENDAFTARAN AKUN</h3>
        <hr>
        <p>Pada tahap awal Anda harus melakukan pendaftaran akun menggunakan email dan nomor whatsApp yang aktif.</p>
        <hr>
        <div class="text-center"><img src="assets/img/logo/logo-pmb.png" height="100px"></div>
        <hr>
        <?php if($is_submitted){ 
          echo "
          <div class='alert alert-success'>
            $pesan
            <hr>
            <a href='?' class='btn btn-primary'>Login PMB</a>
          </div>
          ";
        }else{ ?>

        <form method="post">
          
          <div class="row form-group">
            <div class="col-4 text-right">Nama Anda:</div><div class="col-8">
              <input type="text" class="form-control" id="nama_calon" name="nama_calon" required="" minlength="3" maxlength="50" value="<?=$nama_calon ?>">
            </div>
          </div>
          
          <div class="row form-group">
            <div class="col-4 text-right">Email:</div><div class="col-8">
              <input type="email" class="form-control" id="email" name="email" required=""  minlength="10" maxlength="50" value="<?=$email ?>">
              <small>Pakailah akun Gmail!</small>
            </div>
          </div>
          
          <div class="row form-group">
            <div class="col-4 text-right">Nomor WA:</div><div class="col-8">
              <input type="text" class="form-control" id="no_wa" name="no_wa" required="" minlength="10" maxlength="13" value="<?=$no_wa ?>">
              <small>Gunakanlah nomor-whatsApp yang aktif! Petugas akan memverifikasi nomor Anda, jika tidak aktif Anda tidak dapat menuju tahapan berikutnya</small>
            </div>
          </div>
          
          <hr>

          <div class="form-group">
            <button class="btn btn-primary btn-block" style="width:100%">Daftar Akun</button>
            <p style="text-align:center; margin-top:10px"><small><a href="?">Login</a></small></p>

          </div>
        </form>

        <?php } ?>
        

      </div>
      
    </div>

    
  </div>

</body>
</html>



<script type="text/javascript">
  $(document).ready(function(){

    (function($) {
      $.fn.inputFilter = function(inputFilter) {
        return this.on("input keydown keyup mousedown mouseup select contextmenu drop", function() {
          if (inputFilter(this.value)) {
            this.oldValue = this.value;
            this.oldSelectionStart = this.selectionStart;
            this.oldSelectionEnd = this.selectionEnd;
          } else if (this.hasOwnProperty("oldValue")) {
            this.value = this.oldValue;
            this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
          } else {
            this.value = "";
          }
        });
      };
    }(jQuery));
    //=======================================================================
    // INPUT NUMBER ONLY
    //=======================================================================
    $("#no_wa").inputFilter(function(value) {return /^\d*$/.test(value); });
    $("#no_wa").keyup(function(){

    })

    $("#no_wa").keyup(function(){
      var no_wa = $(this).val(); if(no_wa=="")return;
      if(no_wa.length>3){
        var x = ['081','082','083','085','087','088','089'];

        var awalan = no_wa.substring(0,3);

        if(!x.includes(awalan)){
          $("#no_wa").val("");
          alert("Silahkan awali nomor whatsApp Anda dengan 08... !");
        }
      }
    })

    $("#nama_calon").focusout(function(){
 
      var nama_calon = $(this).val(); if(nama_calon=="")return;
      var format = /[`!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~0123456789]/;
      if(format.test(nama_calon)){
        alert("Input terdapat Special Character atau Angka.\n\nMasukanlah Nama Anda sesuai KTP !");
        $("#nama_calon").val("")
      }


    })

    $("#email").focusout(function(){
      var email = $(this).val().toLowerCase(); if(email=="")return;
      // if(!email.search('gmail.com')){
      //   $("#email").val("");
      //   alert("Silahkan Anda gunakan Akun Gmail!");

      // }
    })

  })
</script>