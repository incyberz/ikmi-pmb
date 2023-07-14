<?php
$email_calon = $_GET['email_calon'];
echo "<input type='hidden' id='email_calon' value='$email_calon'>";


$img_wa = "<img src='../assets/img/icons/wa.png' width='30px'>";
$img_email = "<img src='../assets/img/icons/email.png' width='30px'>";

// ganti * dg spesifik
$s = "SELECT * from tb_akun where email='$email_calon'";

$q = mysqli_query($cn, $s) or die(mysqli_error($cn));
if (mysqli_num_rows($q)!=1) {
    die("Data upload tidak ditemukan.");
}

$d = mysqli_fetch_assoc($q);

$nama_calon = $d['nama_calon'];
$no_wa = $d['no_wa'];

$status_email = $d['status_email'];
$status_no_wa = $d['status_no_wa'];
$status_akun = $d['status_akun'];

// $no_wa = "085659788817";


$link_wa_verifikasi = "https://api.whatsapp.com/send?phone=62$no_wa&text=[No-Reply] Selamat $nama_calon! Nomor WhatsApp Anda telah kami verifikasi. Segera lengkapi formulir pendaftaran di https://pmb.ikmi.ac.id, dengan cara menggunakan username: email, dan password: nomor whatsapp. Kemudian uploadkan persyaratan pendaftaran pada menu upload -- Mohon tidak berganti nomor selama proses Pendaftaran PMB. Terimakasih [Petugas PMB STMIK IKMI Cirebon, ".date("F d, Y, H:i:s")."] [No-Reply]";

$btn_verifikasi_email_disabled = '';
$status_email_show = "<span style='color:red'>Email Belum diverifikasi</span>";
if ($status_email) {
    $btn_verifikasi_email_disabled = "disabled";
    $status_email_show = "<span style='color:green'>Email Terverifikasi $img_check</span>";
}

if ($status_email==="0") {
    $btn_verifikasi_email_disabled = '';
    $status_email_show = "<span style='color:red'>Email Invalid $img_warning</span>";
}


$btn_verifikasi_wa_disabled = '';
$status_no_wa_show = "<span style='color:red'>WhatsApp Belum diverifikasi</span>";
if ($status_no_wa) {
    $btn_verifikasi_wa_disabled = "disabled";
    $status_no_wa_show = "<span style='color:green'>WhatsApp Terverifikasi $img_check</span>";
}
if ($status_no_wa===0) {
    $btn_verifikasi_wa_disabled = '';
    $status_no_wa_show = "<span style='color:red'>WhatsApp Invalid $img_warning</span>";
}


$btn_enable_akun = "<button id='btn_verif__status_akun__1' class='btn_verif btn btn-success' >Enable Akun</button>";
if ($status_akun) {
    $btn_enable_akun = "<button id='btn_verif__status_akun__0' class='btn_verif btn btn-danger' >Disable Akun (Set Resign)</button>";
    $btn_invalid_email_disabled = '';
    $btn_invalid_wa_disabled = '';
} else {
    $btn_invalid_email_disabled = "disabled";
    $btn_verifikasi_email_disabled = "disabled";
    $btn_invalid_wa_disabled = "disabled";
    $btn_verifikasi_wa_disabled = "disabled";
}






?>

<h4>Verifikasi Akun atas nama <span style="color: #004; font-size: 20px;"><?=$nama_calon ?></span></h4>
<style type="text/css">
.box_outside{border: solid 1px #ccc; background: linear-gradient(#fff,#cfc); padding: 15px; border-radius: 15px;} 
.box_inside{border: solid 1px #ddd; background: linear-gradient(#fff,#eff) ; margin: 10px 0; border-radius: 10px; padding: 10px}</style>

<div class="row">
  <div class="col-lg-6">
    <div class="box_outside">
      <h5><?=$status_email_show ?></h5>
      <div class="box_inside">
        <p>Email: </p>
        <span style="font-size:30px "><?=$email_calon ?></span>
        <p style="text-align:right"><a href="mailto:<?=$email_calon?>" target="_blank"><?=$img_email?> Kirim Tes Email</a></p>
      </div>

      <div>
        <button id="btn_verif__status_email__1" class="btn btn_verif btn-primary" <?=$btn_verifikasi_email_disabled ?>>Email OK</button> 
        <button id="btn_verif__status_email__0" class="btn btn_verif btn-danger" <?=$btn_invalid_email_disabled ?>>Set Invalid</button> 
      </div>
    </div>    
  </div>
  <div class="col-lg-6">
    <div class="box_outside">
      <h5><?=$status_no_wa_show ?></h5>
      <div class="box_inside">
        <p>WhatsApp: </p>
        <span style="font-size:30px "><?=$no_wa ?></span>
        <p style="text-align:right"><a href="<?=$link_wa_verifikasi ?>" target="_blank"><?=$img_wa?> Kirim Notif</a></p>
      </div>

      <div>
        <button id="btn_verif__status_no_wa__1" class="btn btn_verif btn-primary" <?=$btn_verifikasi_wa_disabled ?>>WhatsApp OK</button> 
        <button id="btn_verif__status_no_wa__0" class="btn btn_verif btn-danger" <?=$btn_invalid_wa_disabled ?>>Set Invalid</button> 
      </div>
    </div>    
  </div>
</div>

<hr>
<button class="btn btn-success" onclick="history.go(-1)">Back</button> 
<?=$btn_enable_akun?>

<script type="text/javascript">
  $(document).ready(function(){
    $(".btn_verif").click(function(){
      var tid = $(this).prop("id");
      var rid = tid.split("__");
      var field = rid[1];
      var nilai = rid[2];
      var email = $("#email_calon").val();

      var x = confirm("Apakah Anda yakin set:\n\n"+field+" = "+nilai); if(!x) return;

      if(nilai == '0'){
        var alasan_resign = prompt("Alasan Resign:", "Diterima Bekerja / Diterima di PT Lain / Lain-lain");
        if(!alasan_resign) return;
      }else{
        var alasan_resign = '';
      }

      var link_ajax = "ajax_adm/ajax_set_akun.php"
      +"?email="+email
      +"&field="+field
      +"&nilai="+nilai
      +"&alasan_resign="+alasan_resign
      +"";

      $.ajax({
        url:link_ajax,
        success:function(a){
          alert(a);
          location.reload();
        }
      })
    })
  })
</script>