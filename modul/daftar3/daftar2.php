<?php 
if ($dm) { echo "<br><br><br><br><br><br>";}else{echo "<br><br>";}
?>
<hr>
<section id="about" class="about">
  <div class="container" data-aos="fade-up">

    <div class="section-title">
      <h2>IKMI</h2>
      <p>Pendaftaran Mahasiswa Baru</p>
    </div>

    <?php
    if (isset($_SESSION['email'])){ 

    ?>

    <p>Halo <?=$nama_calon2 ?>, Email Anda sudah terferivikasi!</p>
    <p>Jika bukan Anda silahkan Logout.</p>

    <div class="row col-lg-4">
      <div class="col-lg-6">
        <a href="?p=daftar3" class="btn btn-primary btn-block">Next</a>  
      </div>
      <div class="col-lg-6">
        <a href="?p=logout" class="btn btn-warning btn-block">Logout</a>
      </div>

      
    </div>

    

    <?php }?>

  </div>
</section>