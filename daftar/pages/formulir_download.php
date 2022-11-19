<?php 

include 'cek_persyaratan.php';

if($true_count===3){
  $a = date("mydih").$email_calon;
  $download_formulir_token = md5($a);
  $btn_download_formulir = "
  <form method='post' action='./pdf/' target='_blank'>
    <input type='hidden' name='download_formulir_token' value='$download_formulir_token'>
    <button class='btn btn-primary' name='btn_download_formulir'>Download Formulir $img_pdf</button>
  </form>";
}

?>

<section id="download_formulir" class="">
  <div class="container">

    <?php include 'cek_submit_formulir.php'; ?>


    <div class="section-title">
      <h2>Download Formulir PMB</h2>
      <p>Setelah Anda melengkapi Formulir dan upload semua persyaratan Anda dapat mendownload Formulir PMB</p>
    </div>

    <ul>
      <li><?=$li_sub ?></li>
      <li><?=$li_up ?></li>
      <li><?=$li_diterima ?></li>
    </ul>

    <hr>
    <?=$btn_download_formulir?>
    <hr>
    <br>
    &nbsp;



  </div>
</section>