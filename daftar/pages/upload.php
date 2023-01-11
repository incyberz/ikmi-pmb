<section id="upload" class="">
  <div class="container">

    <?php
    include 'cek_submit_formulir.php';
    include "upload_process.php";
    include "upload_logic.php";
    ?>

    <div class="section-title">
      <h2>Upload Persyaratan</h2>
      <p>Persyaratan <span style="color:#005"><b>Jalur <?=$nama_jalur ?></b></span> adalah sebagai berikut:</p>
    </div>

    <style type="text/css">
      #upload table{width: 100%; margin-bottom: 30px;}
      #upload th,td{padding: 10px; border: solid 1px #afa;}
      #upload th{padding: 9px 5px;text-align: center;background: linear-gradient(#fff,#afa)}
      #upload td{padding: 10px; background-color: #eff;}
      .bundle{border: solid 1px #afa; padding: 15px; border-radius: 10px; background-color: #ffe; margin: 20px 0;}

      /*.form-group {margin-bottom: 10px;}*/
      #upload label {margin: 10px 0  5px 0;font-sizea: small;}
    </style>

    <div style="
      padding:15px;
      border-radius: 15px;
      border: solid 1px #ccf;
      background: linear-gradient(#ffd,#dfd); 
      margin-bottom: 20px;
    "> 
      <?=$rows_persyaratan ?>
      
    </div>


    <div class="alert alert-info">
      Saat Anda sudah melengkapi formulir dan upload persyaratan maka Petugas PMB akan memberikan Jadwal Tes untuk Anda.
      <hr>
      <?php
      // disable jadwal test dan download formulir jika ada belum upload
      if ($ada_belum_upload) {
          //echo "<div class='alert alert-info'>Belum bisa download formulir karena ada persyaratan yang belum diupload/diverifikasi</div>";
      } else {
          echo "
          <a href='?jadwal_tes' class='btn btn-primary btn-sm'>Lihat Jadwal Tes</a> 
          <a href='?formulir_download' class='btn btn-primary btn-sm'>Download Formulir</a> 
        ";
      }

    ?>
    </div>


   


  </div>
</section>
<?php if ($tanggal_lulus_tes!="" and $status_lulus==1) {
    include "pages/upload_regisu.php";
} ?>


<script type="text/javascript">
  $(document).ready(function(){
    $(".file").change(function(){
      var id = $(this).prop("id");
      var val = $(this).val();

      var ext = val.split('.').pop();
      if(ext=="") return;

      var ext_allowed = $("#ext_allowed_"+id).val().split(",");

      if(!ext_allowed.includes(ext)){
        $("#"+id).val("");
        $("#btn_"+id).prop("disabled",true);
        alert("Maaf, hanya ekstensi jpg, jpeg, png, dan png yang diperbolehkan.");
      }else{
        $("#btn_"+id).prop("disabled",false);
      }

    })


  })



  // return filename.split('.').pop();
</script>