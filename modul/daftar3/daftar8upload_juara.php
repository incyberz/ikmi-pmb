
<!-- === SERTIF JUARA ======================================== -->
<div class="form-group col-md-5 blok_input_persyaratan" id="input_sertif_juara" style="display: ">
  <table class="table table-bordered" >

    <tr class="jdgreen">
      <td>
        <b style="color: blue">Sertifikat Kejuaraan <?=$bm?></b>
      </td>
    </tr>
    <?php if (file_exists($file_sertif_juara)) {
      $btn_upload_sertif_juara_cap = "Replace";
    ?>
    <tr>
      <td align="center">
        <a href="javascript:newPopup('<?=$file_sertif_juara?>')"><img class="img-fluid rounded" src="<?=$file_sertif_juara?>"></a>
      </td>
    </tr>
    <?php }else{$btn_upload_sertif_juara_cap = "Upload"; } ?>
    <tr>
      <td align="center">
        <input type="file" class="form-control-file" id="file_sertif_juara" name="file_sertif_juara" accept="image/jpeg">
        <script type="text/javascript">
          var uploadField = document.getElementById("file_sertif_juara");

          uploadField.onchange = function() {
              if(this.files[0].size > 512000){
                alert("Ukuran File terlalu besar, maksimal 500KB. Silahkan Anda kecilkan ukurannya, atau Anda cari file lain yang lebih sesuai.");
                this.value = '';
                document.getElementById("btn_upload_sertif_juara").disabled = true;
              }else{
                document.getElementById("btn_upload_sertif_juara").disabled = false;
              }
          };
        </script>

      </td>
    </tr>
    <tr>
      <td align="center">
        <button type="submit" class="btn btn-primary btn-block" id="btn_upload_sertif_juara" name="btn_upload_sertif_juara" disabled><?=$btn_upload_sertif_juara_cap ?></button>

      </td>
    </tr>
  </table>
</div>
<!-- === END SERTIFJUARA ======================================== -->