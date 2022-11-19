<?php include 'upload_regisu_logic.php'; ?>
<section id="upload_regisu" class="">
  <div class="container">

    <div class="section-title">
      <h2>Upload Persyaratan Registrasi Ulang</h2>
      <p>Persyaratan Registrasi Ulang <span style="color:#005"><b>Jalur <?=$nama_jalur ?></b></span> adalah sebagai berikut:</p>
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
      <?=$rows_persyaratan_regisu ?>
      
    </div>

  </div>
</section>


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