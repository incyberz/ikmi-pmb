<style type="text/css">.pesan_aksi_sukses{border:solid 1px #99cf99; background-color: lightgreen}</style>
<?php
$debug_mode=0;
//if (!isset($_SESSION['email'])) {die("Error #3 mail session");}
//if (!isset($_SESSION['nama_calon'])) {die("Error #3 nama calon session");}
// $debug_mode=1;
if ($debug_mode) { echo "<br><br><br><br><br><br>";}else{echo "<br><br>";}
$cstep=3;
$do_update=0;
$do_insert=0;
if(!isset($nama_calon))$nama_calon="";
if(!isset($no_hp))$no_hp="";
if(!isset($no_wa))$no_wa="";
$style_email_calon = "disabled";



# =======================================================
# TAMPILAN AWAL / DAFTAR BARU
# =======================================================
if (!isset($_SESSION['email'])) {
  $pesan_aksi = "
  <div class='alert alert-succes pesan_aksi_sukses' role='alert' style='border:solid 1px'>
    <span style='color:darkblue'>Silahkan Anda mengisi Nama, Email, dan Nomor WhatsApp Anda untuk Data Awal Pendaftaran !</span>
  </div>
  ";
}else{
  $pesan_aksi = "
  <div class='alert alert-succes pesan_aksi_sukses' role='alert' style='border:solid 1px'>
    <span style='color:darkblue'>Halo $nama_calon Anda sedang login. Anda boleh mengupdate data awal atau silahkan Anda lengkapi Formulir Pendaftaran !</span>
    <hr>
    <a class='btn btn-primary' href='?p=daftar4'>Isi Formulir Pendaftaran</a>
  </div>
  ";

}
 



# =======================================================
# DO UPDATE DATA AWAL
# =======================================================
if (isset($_POST['btn_update'])) {
  $do_update=1;

  if ($debug_mode) echo "<br>btn_update isset, Go Update.";

  $nama_calon = str_replace("'", "`",strtoupper(filter_var($_POST['nama_calon'])));
  $no_hp = filter_var($_POST['no_hp']);
  $no_wa = filter_var($_POST['no_wa2']);
  $email = filter_var($_POST['email2']);

  $s = "UPDATE tb_calon set 
  nama_calon = '$nama_calon',
  no_hp = '$no_hp',
  no_wa = '$no_wa'
  where email = '$email'
  ";
  // die("Update: $s");
  $q = mysqli_query($cn,$s);
  if ($q) {
    $pesan_aksi = "<div class='alert alert-succes' role='alert'><h4 style='color:green'>
    Update Data Awal Sukses!
    <hr>
    <a class='btn btn-primary' href='?p=daftar4'>Isi Formulir Pendaftaran</a>
    </h4></div>";
  }else{
    $pesan_aksi = "<div class='alert alert-danger' role='alert'><h4 style='color:red'>Update Data Awal Gagal!</h4></div>";
  }
}


# =======================================================
# DO INSERT DATA AWAL
# =======================================================
if (isset($_POST['btn_daftar'])) {
  $do_insert=1;

  if ($debug_mode) echo "<br>btn_daftar isset, Go INSERT.";
  $nama_calon = str_replace("'", "`",strtoupper(filter_var($_POST['nama_calon'])));
  $no_hp = filter_var($_POST['no_hp']);
  $no_wa = filter_var($_POST['no_wa']);
  $email = filter_var($_POST['email']);

  if(strlen($email)<10) die("Panjang Email kurang dari 10 huruf.");
  if(strlen($nama_calon)<3) die("Panjang Nama Calon kurang dari 3 huruf.");
  if(strlen($no_hp)<10) die("Panjang Nomor HP kurang dari 10 huruf.");
  if(strlen($no_wa)<10) die("Panjang Nomor WhatsApp kurang dari 10 huruf.");


  $s = "SELECT auto_increment from information_schema.tables 
  where table_schema = '$db_name' 
  and table_name = 'tb_calon'";
  $q = mysqli_query($cn,$s) or die("Error #3 auto increment calon ");
  $d = mysqli_fetch_array($q);
  $id_calon = $d['auto_increment'];

  $s2 = "SELECT auto_increment from information_schema.tables 
  where table_schema = '$db_name' 
  and table_name = 'tb_daftar'";
  $q2 = mysqli_query($cn,$s2) or die("Error #3 auto increment daftar ");
  $d2 = mysqli_fetch_array($q2);
  $id_daftar = $d2['auto_increment'];
  // die($s2);

  if ($id_daftar<10) {$id_daftar2 = "000".$id_daftar;}
  elseif ($id_daftar<100) {$id_daftar2 = "00".$id_daftar;}
  elseif ($id_daftar<1000) {$id_daftar2 = "0".$id_daftar;}
  else {$id_daftar2 = $id_daftar;}

  $a = "_".microtime(); 
  $a = str_replace("0.", "_", $a);
  $a = str_replace("0,", "_", $a);
  $a = str_replace(" ", "_", $a);
  $a = str_replace("__", "_", $a);
  $folder_uploads = $a;

  $no_daf = date("y")."01".$id_daftar2;

  $s = "INSERT into tb_calon (
  id_calon,
  email,
  nama_calon,
  no_hp,
  no_wa,
  password

  ) values (
  '$id_calon',
  '$email',
  '$nama_calon',
  '$no_hp',
  '$no_wa',
  '$no_wa'
  )";


  if ($debug_mode) echo "
    <br><br><br><br><br>
    <br> ======================================
    <br> DEBUG
    <br> ======================================
    <br> id_calon = $id_calon
    <br> id_daftar = $id_daftar
    <br> id_daftar2 = $id_daftar2
    <br> no_daf = $no_daf
    <br> folder_uploads = $folder_uploads
    <br> email = $email
    <br> nama_calon = $nama_calon
    <br> no_hp = $no_hp
    <br> no_wa = $no_wa

    ";

  // die($s);


  $q = mysqli_query($cn,$s);


  if ($q) {
    $pesan_aksi = "<div class='alert alert-succes' role='alert'><h4 style='color:blue'>Save Sukses!</h4></div>";


    # GET LAST ID_SYARAT =============================
    $s = "SELECT auto_increment from information_schema.tables 
    where table_schema = '$db_name' 
    and table_name = 'tb_daftar_syarat'";
    $q = mysqli_query($cn,$s) or die("Error #fgr54gs46s Get AUTO_INCREMENT Persyaratan.");
    $d = mysqli_fetch_array($q);
    $id_syarat_new = $d['auto_increment'];

    if($debug_mode) echo "<hr>id_syarat_new: $id_syarat_new <hr>";



    # INSERT NEW ID_SYARAT =============================
    $s = "INSERT into tb_daftar_syarat (id_syarat) values ($id_syarat_new)";
    $q = mysqli_query($cn,$s) or die("Error #4es6d6f8g INSERT New Persyaratan.");

    if($debug_mode) echo "<hr>SQL Insert New Persyaratan: $s <hr>";




    //LANJTKAN INSERT =================================
    $s = "INSERT into tb_daftar (
    id_daftar,
    id_calon,
    id_gel,
    no_daf,
    folder_uploads,
    id_syarat
    ) values (
    '$id_daftar',
    '$id_calon',
    '$id_gel',
    '$no_daf',
    '$folder_uploads',
    '$id_syarat_new'
    )";
    $q = mysqli_query($cn,$s);
    if ($q) {
      $pesan_aksi = "<div class='alert alert-succes' role='alert'><h4 style='color:green'>Data awal tersimpan. Silahkan lanjutkan Proses Pendaftaran dengan mengisi Formulir Pendaftaran!</h4><hr><a href='?p=daftar4' class='btn btn-primary'>Isi Formulir Pendaftaran</a></div>";

      # ========================================================
      # AUTO SET SESSION JIKA 3X BERHASIL ADD SAVE DATA
      # ========================================================
      if(!isset($_SESSION)) session_start();
      $_SESSION['nama_calon'] = $nama_calon;
      $_SESSION['email'] = $email;



    }else{
      if($debug_mode) echo "<hr>SQL Daftar: $s<hr>";
      if($debug_mode) echo "<hr>SQL Error: ".mysqli_error($cn)."<hr>";
      $pesan_aksi = "<div class='alert alert-danger' role='alert'><h4 style='color:red'>Save Data Pendaftaran Failed!</h4></div>";
    }

  }else{

    if(!isset($_SESSION)) session_start();


    if(isset($_SESSION['email'])){
      $pesan_aksi = "<div class='alert alert-succes' role='alert'><h4 style='color:blue'>Anda sedang login. Silahkan Anda lanjutkan ke Pengisian Formulir!</h4>
      <a href='?p=daftar4' class='btn btn-primary'>Isi Formulir Pendaftaran</a>
      <hr>
      </div>";

    }else{
      if($debug_mode) echo "<hr>SQL Calon : $s<hr>";
      if($debug_mode) echo "<hr>SQL Error: ".mysqli_error($cn)."<hr>";

      $err = mysqli_error($cn);
      // $err = var_dump($_SESSION);

      $pesan_aksi = "<div class='alert alert-danger' role='alert'><h4 style='color:red'>Gagal Menyimpan Data Awal!</h4>
      <small>Error code: $err</small> 
      <hr>
      <a href='?p=daftar' class='btn btn-primary'>Coba Lagi</a>

      </div>";

    }
  }
}


















if ($debug_mode) echo "<br>No INSERT nor UPDATE, Go First Load from Sign Google.";

//include('modul/login/gconfig.php');

$nama_calon_ket="Silahkan isi nama Anda sesuai KTP.";
$no_hp_ket="Silahkan isi No Handphone Anda!";
$no_wa_ket="";

$style_div_terdaftar="display:none";
$style_div_blm_terdaftar="";
$style_div_btn_next="display:none";

if(isset($_GET["code"])){
  if ($debug_mode) echo "<br>Google code isset.";

  $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);

  if(!isset($token['error'])){

    if ($debug_mode) echo "<br>Token isset and not error.";

    $google_client->setAccessToken($token['access_token']);
    $_SESSION['access_token'] = $token['access_token'];
    $google_service = new Google_Service_Oauth2($google_client);
    $data = $google_service->userinfo->get();

    if(!empty($data['given_name'])){
      $_SESSION['user_first_name'] = $data['given_name'];
    }

    if(!empty($data['family_name'])){
      $_SESSION['user_last_name'] = $data['family_name'];
    }

    if(!empty($data['email'])){
      $_SESSION['user_email_address'] = $data['email'];
    }

    if(!empty($data['gender'])){
      $_SESSION['user_gender'] = $data['gender'];
    }

    if(!empty($data['picture'])){
      $_SESSION['user_image'] = $data['picture'];
    }
  }
}

if(isset($_SESSION['access_token']) or isset($_SESSION['email'])){
  if ($debug_mode) echo "<br>Google access_token isset, Go set session[email].";
 
  if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
  }else{
    $email = $_SESSION['user_email_address'];
  }
  $is_login=1;

  $s = "SELECT email,nama_calon,no_hp,no_wa from tb_calon where email = '$email'";
  $q = mysqli_query($cn,$s) or die("Error #3 cek is terdaftar");
  if (mysqli_num_rows($q) == 1) {
    $is_terdaftar=1;
    if ($debug_mode) echo "<hr>SQL: $s<hr>";
    $d = mysqli_fetch_array($q);

    $nama_calon = $d['nama_calon'];
    $no_hp = $d['no_hp'];
    $no_wa = $d['no_wa'];

    # =============================================
    # ADD SESSION GOOGLE -> SESSION DB
    # =============================================
    $_SESSION['nama_calon'] = $nama_calon;
    $_SESSION['email'] = $email;




    $style_div_terdaftar="";
    $style_div_blm_terdaftar="display:none";
    $style_div_btn_next="";

    $nama_calon_ket="";
    $no_hp_ket="";
    $no_wa_ket="";
    
  }

  if($debug_mode) echo "<br><hr>session_id: ".session_id()."<hr>";

}else{

  if ($debug_mode) {
    echo "<br>Google access_token NOT isset, CAN'T set session[email].";
    echo "<br>Token error: ".$token['error'];
  }

  if ($do_update or $do_insert) {
    if ($debug_mode) echo "<br>Google access_token NOT isset (LOST), but.. RE-Session
    <br>do_insert : $do_insert
    <br>do_update : $do_update
    <br>email : $email
    <br>nama_calon : $nama_calon
    <br>no_hp : $no_hp
    <br>no_wa : $no_wa
    ";

    $style_div_terdaftar="";
    $style_div_blm_terdaftar="display:none";
    $style_div_btn_next="";

    $nama_calon_ket="";
    $no_hp_ket="";
    $no_wa_ket="";

  }else{
    if($debug_mode) echo "<br>Google access_token NOT isset, CAN'T set session[email].
    <br>No Update NOR INSERT";

    # =======================================================
    # INJECT NEW PMB BY ADMIN
    # =======================================================
    if (isset($_GET['mode'])) {
      if ($_GET['mode']!="admin_pmb") die("Invalid View Mode Type.");
      if (!isset($_SESSION['admin_pmb_email'])) die("Admin Requirement #1 not set.");
      if (!isset($_SESSION['admin_pmb_id_pegawai'])) die("Admin Requirement #2 not set.");
      if (!isset($_SESSION['admin_pmb_nama_pegawai'])) die("Admin Requirement #3 not set.");
      if (!isset($_SESSION['admin_pmb_admin_level'])) die("Admin Requirement #4 not set.");
      if (!isset($_SESSION['admin_pmb_jabatan_pegawai'])) die("Admin Requirement #5 not set.");
      // if (!isset($_SESSION['admin_pmb_img_pegawai'])) die("Admin Requirement #6 not set.");
      // session_destroy();

      $style_email_calon = "";
      $pesan_aksi = "<div class='alert alert-danger' role='alert'><h4 style='color:red'>Add New Calon by Petugas PMB</h4>
      <p>
        Untuk menambah data calon silahkan Anda masukan email calon, nama calon, no. wa, dan nomor hp calon!
      </p>
      </div>";
    }else{
      if(!isset($_GET['aksi'])) die("<br><br><br><br><br><br><b><center>Silahkan <a href='?p=daftar'>login</a> terlebih dahulu !</center></b>");
      $aksi = $_GET['aksi'];

      if($aksi!="daftar_baru") die("<br><br><br><br><br><br><b><center>Aksi tidak tepat. Silahkan <a href='?p=daftar'>login</a> terlebih dahulu !</center></b>");
      $style_email_calon = ""; //membolehkan mengedit email saat Sign in with Google error
    }
  }
}


if ($is_terdaftar) {
  $petunjuk_tahap = ")* Email Anda sudah terdaftar. Silahkan edit data awal atau Next ke tahap selanjutnya.";
}else{
  $petunjuk_tahap = ")* Email Anda belum terdaftar. Silahkan input data awal!";
}
$petunjuk_tahap =""; //zzz
if ($debug_mode) echo "
<br> =================================================
<br> DEBUGGING
<br> =================================================
<br> is_login : $is_login
<br> is_terdaftar : $is_terdaftar
<br> email : $email
<br> nama_calon : $nama_calon
<br> no_hp : $no_hp
<br> no_wa : $no_wa
";

if ($debug_mode) {
  echo "<hr>";
  echo var_dump($_SESSION);
  echo "<hr>";
}
?>


























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


    $("#btn_daftar").mouseover(function(){
      var nama_calon_ket = $("#nama_calon").val();
      var no_hp_ket = $("#no_hp").val();
      var no_wa_ket = $("#no_wa").val();
      var email = $("#email").val();

      if (nama_calon_ket.length<3 || no_hp_ket.length<10 || no_wa_ket.length<10 || email.length<10) {
        $("#btn_daftar").prop("disabled",true);
        $("#btn_update").prop("disabled",true);
        $("#btn_next").prop("disabled",true);
      }else{
        $("#btn_daftar").prop("disabled",false);
        $("#btn_update").prop("disabled",false);
        $("#btn_next").prop("disabled",false);
      }
    });


    $("#nama_calon").focusout(function(){
      var nama_calon = $(this).val();
      if (nama_calon.length< 3){
        $("#nama_calon_ket").text("Nama kurang dari 3 huruf.");
      }else{
        $("#nama_calon_ket").text("");
      }
      $("#btn_daftar").mouseover();
    });


    $("#no_hp").keyup(function(){
      var no_hp = $(this).val();

      if (no_hp.length< 10 || no_hp.substring(0,2)!="08"){
        $("#no_hp_ket").html("Silahkan masukan nomor HP Anda yang valid agar Anda mendapat kesempatan untuk mendapatkan bantuan kuota internet dari pemerintah. Awali No. HP Anda dengan '08...'");
      }else{
        $("#no_hp_ket").text("");
      }
      $("#btn_daftar").mouseover();

      if ($('#cek_wa').is(":checked")){
        var no_hp = $("#no_hp").val();
        $("#no_wa").val(no_hp);
        $("#no_wa2").val(no_hp);
      }
      // $(".biodata").focusout();
    });

    $("#email").keyup(function(){
      $("#email2").val($(this).val());
      $("#btn_daftar").mouseover();
    });

    $("#no_hp").inputFilter(function(value) {
      return /^\d*$/.test(value); });

    
    $("#cek_wa").click(function(){
      if ($('#cek_wa').is(":checked")){
        var no_hp = $("#no_hp").val();
        //$("#no_wa").prop("disabled",true);
        $("#no_wa").val(no_hp);
        $("#no_wa2").val(no_hp);
        $("#no_wa").focusout();
      }else{
        //$("#no_wa").prop("disabled",false);
        $("#no_wa").focus();
      }

      $("#btn_daftar").mouseover();
      // $(".biodata").focusout();
    });

    $("#no_wa").inputFilter(function(value) {
      return /^\d*$/.test(value); });

    $("#no_wa").keyup(function(){
      var no_wa = $(this).val();
      if (no_wa.length< 10 || no_wa.substring(0,2)!="08"){
        $("#no_wa_ket").text("Silahkan masukan nomor WhatsApp Anda yang valid agar Anda dapat menerima panduan atau informasi pendaftaran selanjutnya. Awali nomor dengan '08...'");
      }else{
        $("#no_wa_ket").text("");
        $("#no_wa2").val(no_wa);
      }
      $("#btn_daftar").mouseover();

    }); 



  });
</script>































<style type="text/css">
  input{
    text-transform: uppercase;
  }
  .pointlist {
    /*border-radius: 15px;*/
    width: 100%;
    border: 1px solid #73AD21;
  }

  .table_header{
    background-color: #ddffff;
  }

  th, td {
    padding: 10px;
  }

</style>

<section id="about" class="about">
  <div class="container" data-aos="fade-up">

    <div class="section-title">
      <h2>IKMI</h2>
      <p>Daftar BARU</p>
    </div>

    <?php //include "steps.php"; ?>


    <!-- <hr> -->
    <?=$pesan_aksi?>
    <p class="note_blue"><?=$petunjuk_tahap?></p>

    <form method="post">
      <table class="pointlist"><tr class="table_header pointlist"><td>Form Data Awal Pendaftaran</td></tr>
        <tr>
          <td>

            <div class="form-group">
              <label class="control-label col-md-3" for="email">Email (Akun GMail) <?=$bm?></label>
              <div class="col-md-10">
                <input type="email" class="form-control" id="email" placeholder="" name="email" <?=$style_email_calon ?>  value="<?=$email?>">
                <input type="hidden" id="email2" name="email2" value="<?=$email?>">
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-3" for="nama_calon">Nama Lengkap <?=$bm?></label>
              <div class="col-md-10">
                <input type="text" class="form-control" id="nama_calon" placeholder="" name="nama_calon" value="<?=$nama_calon?>" maxlength="50">
                <small id="nama_calon_ket" style="color: red;font-weight: bold"><?=$nama_calon_ket ?></small>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-3" for="no_hp">No. HP <?=$bm?> <small>(awali dg 08...)</small></label>
              <div class="col-md-10">
                <input type="text" class="form-control" id="no_hp" placeholder="" name="no_hp" value="<?=$no_hp?>" maxlength=13>
                <small id="no_hp_ket" style="color: red;font-weight: bold"><?=$no_hp_ket ?></small>

              </div>
            </div>

            
            <div class="form-group">
              
              <div class="col-md-10">
                <input type="checkbox" id="cek_wa" placeholder="" name="">
                <label for="cek_wa">No. WA saya sama dengan No. HP</label>
              </div>
            </div>

            <div class="form-group">
              <label class="control-label col-md-3" for="no_wa">No. WA <?=$bm?></label>
              <div class="col-md-10">
                <input type="text" class="form-control" id="no_wa" placeholder="" name="no_wa" value="<?=$no_wa?>" maxlength="13">
                <input type="hidden" name="no_wa2" id="no_wa2" value="<?=$no_wa?>">
                <small>)* Dimohon memberikan nomor HP/WA yg aktif agar kami dapat memberikan informasi penting untuk Anda!</small><br>
                <small id="no_wa_ket" style="color: red;font-weight: bold"></small>
              </div>
            </div>


            <div class="form-group" style="<?=$style_div_terdaftar?>" id="div_terdaftar">
              <div class="col-md-3">
                <button class="btn btn-primary btn-block" name="btn_update" id="btn_update" disabled="">Update</button>
              </div>
            </div>

            <div class="form-group"  style="<?=$style_div_blm_terdaftar?>" id="div_blm_terdaftar">
              <div class="col-md-3">
                <button type="submit" class="btn btn-primary btn-block" name="btn_daftar" id="btn_daftar" disabled="">Daftar</button>
              </div>
            </div>




          </td>
        </tr>
      </table>
    </form> 
    <hr>
    <div class="row" style="<?=$style_div_btn_next ?>">
    </div>

    <?php //include "steps.php"; ?>

   




  </div>
</section>