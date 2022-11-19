<!-- === HASIL TO ======================================== -->
<div class="form-group col-md-5 blok_input_persyaratan" id="input_hasil_to" style="display: ">
  <table class="table table-bordered" >

    <tr class="jdgreen">
      <td>
        <b style="color: blue">Hasil Try Out <?=$bm?></b>
        <br><small>Bukti hasil try-out SBMPTN yang otentik dari sekolah ataupun dari lembaga pendidikan non formal lainnya.</small>
      </td>
    </tr>
    <?php if (file_exists($file_hasil_to)) {
      $btn_upload_hasil_to_cap = "Replace Hasil TO";
    ?>
    <tr>
      <td align="center">
        <a href="javascript:newPopup('<?=$file_hasil_to?>')"><img class="img-fluid rounded" src="<?=$file_hasil_to?>"></a>
      </td>
    </tr>
    <?php }else{$btn_upload_hasil_to_cap = "Upload Hasil TO"; } ?>
    <tr>
      <td align="center">
        <input type="file" class="form-control-file" id="file_hasil_to" name="file_hasil_to" accept="image/jpeg">
        <script type="text/javascript">
          var uploadField = document.getElementById("file_hasil_to");

          uploadField.onchange = function() {
              if(this.files[0].size > 512000){
                alert("Ukuran File terlalu besar, maksimal 500KB. Silahkan Anda kecilkan ukurannya, atau Anda cari file lain yang lebih sesuai.");
                this.value = "";
                document.getElementById("btn_upload_hasil_to").disabled = true;
              }else{
                document.getElementById("btn_upload_hasil_to").disabled = false;
              }
          };
        </script>

      </td>
    </tr>
    <tr>
      <td align="center">
        <button type="submit" class="btn btn-primary btn-block" id="btn_upload_hasil_to" name="btn_upload_hasil_to" disabled><?=$btn_upload_hasil_to_cap ?></button>

      </td>
    </tr>
  </table>
</div>
<!-- === END HASIL TO ======================================== -->