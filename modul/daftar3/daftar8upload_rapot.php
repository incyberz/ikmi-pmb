
<!-- === RAPORT KELAS 1 ======================================== -->
<div class="form-group col-md-5 blok_input_persyaratan" id="input_rapot1" style="display: ">
  <table class="table table-bordered" >

    <tr class="jdgreen">
      <td>
        <b style="color: blue">Raport Kelas 1 <?=$bm?></b>
      </td>
    </tr>
    <?php if (file_exists($file_rapot1)) {
      $btn_upload_rapot1_cap = "Replace";
    ?>
    <tr>
      <td align="center">
        <a href="javascript:newPopup('<?=$file_rapot1?>')"><img class="img-fluid rounded" src="<?=$file_rapot1?>"></a>
      </td>
    </tr>
    <?php }else{$btn_upload_rapot1_cap = "Upload"; } ?>
    <tr>
      <td align="center">
        <input type="file" class="form-control-file" id="file_rapot1" name="file_rapot1" accept="image/jpeg">
        <script type="text/javascript">
          var uploadField = document.getElementById("file_rapot1");

          uploadField.onchange = function() {
              if(this.files[0].size > 512000){
                alert("Ukuran File terlalu besar, maksimal 500KB. Silahkan Anda kecilkan ukurannya, atau Anda cari file lain yang lebih sesuai.");
                this.value = '';
                document.getElementById("btn_upload_rapot1").disabled = true;
              }else{
                document.getElementById("btn_upload_rapot1").disabled = false;
              }
          };
        </script>

      </td>
    </tr>
    <tr>
      <td align="center">
        <button type="submit" class="btn btn-primary btn-block" id="btn_upload_rapot1" name="btn_upload_rapot1" disabled><?=$btn_upload_rapot1_cap ?></button>

      </td>
    </tr>
  </table>
</div>
<!-- === END RAPORT KELAS 1 ======================================== -->

<!-- === RAPORT KELAS 2 ======================================== -->
<div class="form-group col-md-5 blok_input_persyaratan" id="input_rapot2" style="display: ">
  <table class="table table-bordered" >

    <tr class="jdgreen">
      <td>
        <b style="color: blue">Raport Kelas 2 <?=$bm?></b>
      </td>
    </tr>
    <?php if (file_exists($file_rapot2)) {
      $btn_upload_rapot2_cap = "Replace";
    ?>
    <tr>
      <td align="center">
        <a href="javascript:newPopup('<?=$file_rapot2?>')"><img class="img-fluid rounded" src="<?=$file_rapot2?>"></a>
      </td>
    </tr>
    <?php }else{$btn_upload_rapot2_cap = "Upload"; } ?>
    <tr>
      <td align="center">
        <input type="file" class="form-control-file" id="file_rapot2" name="file_rapot2" accept="image/jpeg">
        <script type="text/javascript">
          var uploadField = document.getElementById("file_rapot2");

          uploadField.onchange = function() {
              if(this.files[0].size > 512000){
                alert("Ukuran File terlalu besar, maksimal 500KB. Silahkan Anda kecilkan ukurannya, atau Anda cari file lain yang lebih sesuai.");
                this.value = '';
                document.getElementById("btn_upload_rapot2").disabled = true;
              }else{
                document.getElementById("btn_upload_rapot2").disabled = false;
              }
          };
        </script>

      </td>
    </tr>
    <tr>
      <td align="center">
        <button type="submit" class="btn btn-primary btn-block" id="btn_upload_rapot2" name="btn_upload_rapot2" disabled><?=$btn_upload_rapot2_cap ?></button>

      </td>
    </tr>
  </table>
</div>
<!-- === END RAPORT KELAS 2 ======================================== -->
<!-- === RAPOT KELAS 3 ======================================== -->
<div class="form-group col-md-5 blok_input_persyaratan" id="input_rapot3" style="display: ">
  <table class="table table-bordered" >

    <tr class="jdgreen">
      <td>
        <b style="color: blue">Raport Kelas 3 <?=$bm?></b>
      </td>
    </tr>
    <?php if (file_exists($file_rapot3)) {
      $btn_upload_rapot3_cap = "Replace";
    ?>
    <tr>
      <td align="center">
        <a href="javascript:newPopup('<?=$file_rapot3?>')"><img class="img-fluid rounded" src="<?=$file_rapot3?>"></a>
      </td>
    </tr>
    <?php }else{$btn_upload_rapot3_cap = "Upload"; } ?>
    <tr>
      <td align="center">
        <input type="file" class="form-control-file" id="file_rapot3" name="file_rapot3" accept="image/jpeg">
        <script type="text/javascript">
          var uploadField = document.getElementById("file_rapot3");

          uploadField.onchange = function() {
              if(this.files[0].size > 512000){
                alert("Ukuran File terlalu besar, maksimal 500KB. Silahkan Anda kecilkan ukurannya, atau Anda cari file lain yang lebih sesuai.");
                this.value = '';
                document.getElementById("btn_upload_rapot3").disabled = true;
              }else{
                document.getElementById("btn_upload_rapot3").disabled = false;
              }
          };
        </script>

      </td>
    </tr>
    <tr>
      <td align="center">
        <button type="submit" class="btn btn-primary btn-block" id="btn_upload_rapot3" name="btn_upload_rapot3" disabled><?=$btn_upload_rapot3_cap ?></button>

      </td>
    </tr>
  </table>
</div>
<!-- === END RAPORT KELAS 3 ======================================== -->
